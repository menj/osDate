<?php
/***********************************************
osDate Open-Source Dating and Matchmaking Script

(c) 2009 TUFaT.com

osDate was created by Darren Gates and Vijay Nair,
and can be downloaded freely from www.TUFaT.com.
It is distributed under the LGPL license.

osDate is free for commercial and non-commercial
uses. You may modify, re-sell, and re-distribute
osDate. Links back to TUFaT.com are appreciated.

This program is distributed in the hope that it
will be useful, but without any warranty, and
without even the implied warranty of merchantability
or fitness for a particular purpose. While strong
efforts have been taken to ensure the reliability,
security, and stability of osDate, all software
carries risk. Your use of osDate means that you
understand and accept the risks of using osDate.

For osDate documentation, change log, community
forum, latest updates, and project details,
please go to www.TUFaT.com  The osDate project is
supported through the sale of skins and add-ons,
which are entirely optional but help with the
development and design effort.
***********************************************/

if ( !defined( 'SMARTY_DIR' ) ) {
	include_once( '../init.php' );
}

include ( 'sessioninc.php' );

if (!isset($_REQUEST['show'])) $_REQUEST['show']='both';

// Processing 'show' option
if(isset($_REQUEST["show"])):
	if($_REQUEST["show"]=="public")
	{ $_SESSION["show_public"]=1;
	  $_SESSION["show_private"]=0;
	}
	if($_REQUEST["show"]=="private")
	{ $_SESSION["show_public"]=0;
	  $_SESSION["show_private"]=1;
	}
	if($_REQUEST["show"]=="both")
	{ $_SESSION["show_public"]=1;
	  $_SESSION["show_private"]=1;
	}
endif;
if(isset($_REQUEST["view"])):
	$_SESSION["calendar_view"]=$_REQUEST["view"];
endif;
if(!isset($_SESSION["show_public"])) $_SESSION["show_public"]=1;
if(!isset($_SESSION["show_private"])) $_SESSION["show_private"]=1;

if(empty($_SESSION["calendar_view"]))
	$_SESSION["calendar_view"]="month";

if(empty($_REQUEST["calendarid"]))
{	// Finding first calendar
	$query="select id from ! order by displayorder";
	$calendarid=$osDB->getOne($query,array(CALENDARS_TABLE));
} else {
	$calendarid = $_REQUEST['calendarid'];
}
$t->assign("calendarid",$calendarid);

$t->assign("display_events",$_REQUEST['show']);


if(!empty($_REQUEST["jump_to"]))
{	// Jumping to some date
	$timestamp=mktime(0,0,0,$_POST["jump_dateMonth"],(!empty($_POST["jump_dateDay"]))?$_POST["jump_dateDay"]:"1",$_POST["jump_dateYear"]);
}
elseif(empty($_REQUEST["timestamp"]))
{	// Making today as date
	$timestamp=mktime(0,0,0,date("m"),date("d"),date("Y"));
}
else
{
	$timestamp=$_REQUEST["timestamp"];
}
$t->assign("timestamp",$timestamp);

switch ($_SESSION["calendar_view"]) {
	case "month":
		// Finding begining of the month
		$cur_date=getdate_safe($timestamp);
		$t->assign("cur_date",$cur_date);
		$next=mktime(0,0,0,$cur_date["mon"]+1,1,$cur_date["year"]);
		$t->assign("next",$next);
		$prev=mktime(0,0,0,$cur_date["mon"]-1,1,$cur_date["year"]);
		$t->assign("prev",$prev);
		// $date_01 - 1 day of month
		$date_01=mktime(0,0,0,$cur_date["mon"],1,$cur_date["year"]);
		$date_01_array=getdate_safe($date_01);
		// $date_start - date from that monthly calendar starts
		$date_start_timestamp=mktime(0,0,0,$cur_date["mon"],1-$date_01_array["wday"]+1,$cur_date["year"]);

		$calendar=array();
		$date_start_array=getdate_safe($date_start_timestamp);

		// For each of 42 days on monthly calendar, selecting all events for that date
		for($i=0;$i<6*7;$i++)
		{	$date_timestamp=mktime(0,0,0,$date_start_array["mon"],$date_start_array["mday"]+$i,$date_start_array["year"]);
			$date_array=getdate_safe($date_timestamp);
			$date=$date_array["year"]."-".$date_array["mon"]."-".$date_array["mday"];
			// $date - current date in textual format
		//echo($date."<br>");
			$item=array();
			$item["timestamp"]=$date_timestamp;
			$item["date"]=$date_array;
			$item["events"]=array();
			// selecting all events for that date
			$rs = $osDB->getAll("select * ".
			       "from ! ".
				   "where 1 ".
				   "  and to_days(datetime_from)<=to_days(?)  ".
				   "  and to_days(datetime_to)>=to_days(?)  ".
				   "  and enabled='Y' ".
				   "  and calendarid=? ",array(EVENTS_TABLE,$date,$date,$calendarid));
			foreach ($rs as $event)
			{	// Check for private event here
				$add_event=true;
				if($event["private_to"]!="")
				{
					$private_to=explode(",",$event["private_to"]);
					$private_to=array_map("trim",$private_to);
				}
				// Processign Private+Public
				if($add_event)
				{	if(count($item["events"]) >= $config["calendar_month_day_events_limit"])
					{	$item["more_events"]=1;
						break;
					}
					$item["events"][]=$event;
				}
			}
			$calendar[]=$item;
			unset($rs);
		}
		$t->assign("calendar",$calendar);
		unset($calendar);
		$t->assign('txtoptions', (isset($txtoptions)?$txtoptions:'') );
		$t->assign('txtquestion', (isset($txtquestion)?$txtquestion:'') );
		$t->display( 'calendar_month.tpl' );
		break;
	case "week":
		// Finding begining of the week
		$cur_date=getdate_safe($timestamp);
		$t->assign("cur_date",$cur_date);
		$next=mktime(0,0,0,$cur_date["mon"],$cur_date["mday"]+7,$cur_date["year"]);
		$t->assign("next",$next);
		$prev=mktime(0,0,0,$cur_date["mon"],$cur_date["mday"]-7,$cur_date["year"]);
		$t->assign("prev",$prev);
		// $date_01 - current day of week
		$date_01=mktime(0,0,0,$cur_date["mon"],$cur_date["mday"],$cur_date["year"]);
		$date_01_array=getdate_safe($date_01);
		// $date_start - date from that weekly calendar starts
		$date_start_timestamp = mktime(0,0,0,$cur_date["mon"],$cur_date["mday"]-$date_01_array["wday"],$cur_date["year"]);
		$date_end_timestamp = mktime(0,0,0,$cur_date["mon"],$cur_date["mday"]-$date_01_array["wday"]+6,$cur_date["year"]);
		$t->assign("date_start_timestamp",$date_start_timestamp);
		$t->assign("date_end_timestamp",$date_end_timestamp);

		$calendar=array();
		$date_start_array=getdate_safe($date_start_timestamp);
		// For each of 7 days on week calendar, selecting all events for that date
		for($i=0;$i<7;$i++)
		{	$date_timestamp=mktime(0,0,0,$date_start_array["mon"],$date_start_array["mday"]+$i,$date_start_array["year"]);
			$date_array=getdate_safe($date_timestamp);
			$date=$date_array["year"]."-".$date_array["mon"]."-".$date_array["mday"];
			$date_array['dayname'] = get_lang('day_names',$date_array['weekday']);
			// $date - current date in textual format
			$item=array();
			$item["timestamp"]=$date_timestamp;
			$item["date"]=$date_array;
			$item["events"]=array();

			// selecting all events for that date
			$rs = $osDB->getAll("select * ".
			       "from ! ".
				   "where 1 ".
				   "  and to_days(datetime_from)<=to_days(?) ".
				   "  and to_days(datetime_to)>=to_days(?) ".
				   "  and enabled='Y' ".
				   "  and calendarid=? ",array(EVENTS_TABLE,$date,$date,$calendarid));
			foreach ($rs as $event)
			{	// Check for private event here
				$add_event=true;
				if($event["private_to"]!="")
				{	$add_event=false;
					$private_to=explode(",",$event["private_to"]);
					$private_to=array_map("trim",$private_to);
					if(in_array($user["username"],$private_to))
					{	$add_event=true;
					}
				}
				// Processign Private+Public
				if($_SESSION["show_private"]==0 && $event["private_to"]!="") $add_event=false;
				if($_SESSION["show_public"]==0 && $event["private_to"]=="") $add_event=false;
				if($add_event)
				{	if($i>=5)
						if(count($item["events"]) >= $config["calendar_week_end_events_limit"])
						{	$item["more_events"]=1;
							break;
						}
					if($i<5)
						if(count($item["events"]) >= $config["calendar_week_day_events_limit"])
						{	$item["more_events"]=1;
							break;
						}
					$item["events"][]=$event;
				}
			}
			unset($rs);
			$calendar[]=$item;
		}
		$t->assign("calendar",$calendar);
		unset($calendar);
		$t->assign('txtoptions', (isset($txtoptions)?$txtoptions:'') );
		$t->assign('txtquestion', (isset($txtquestion)?$txtquestion:'') );
		$t->display( 'calendar_week.tpl' );
		break;
	case "day":
		// Finding begining of the week
		$cur_date=getdate_safe($timestamp);
		$t->assign("cur_date",$cur_date);
		$next=mktime(0,0,0,$cur_date["mon"],$cur_date["mday"]+1,$cur_date["year"]);
		$t->assign("next",$next);
		$prev=mktime(0,0,0,$cur_date["mon"],$cur_date["mday"]-1,$cur_date["year"]);
		$t->assign("prev",$prev);

		// $date_start - date from that weekly calendar starts
		$date_start_timestamp=$timestamp;
		$t->assign("date_start_timestamp",$date_start_timestamp);

		$calendar=array();
		$date_start_array=getdate_safe($date_start_timestamp);

		$date_timestamp=$date_start_timestamp;
		$date_array=getdate_safe($date_timestamp);
		$date=$date_array["year"]."-".$date_array["mon"]."-".$date_array["mday"];
		// $date - current date in textual format
		$item=array();
		$item["timestamp"]=$date_timestamp;
		$item["date"]=$date_array;
		$item["events"]=array();

		// selecting all events for that date
		$rs = $osDB->getAll("SELECT id, ".
			   "       userid, ".
			   "       event, ".
			   "       description, ".
			   "       calendarid, ".
			   "       enabled, ".
			   "       timezone, ".
			   "       datetime_from, ".
			   "       datetime_to, ".
			   "       unix_timestamp(datetime_from) as dt_from, ".
			   "       unix_timestamp(datetime_to) as dt_to, ".
			   "       recurring, ".
			   "       recuroption, ".
			   "       private_to ".
			   "from ! ".
			   "where 1 ".
			   "  and to_days(datetime_from)<=to_days(?) ".
			   "  and to_days(datetime_to)>=to_days(?) ".
			   "  and enabled='Y' ".
			   "  and calendarid=? ".
			   "order by datetime_from ",array(EVENTS_TABLE,$date,$date,$calendarid));
		foreach($rs as $event)
		{	// Check for private event here
			$add_event=true;
			$event["dt_from"]=getdate_safe($event["dt_from"]);
			$event["dt_to"]=getdate_safe($event["dt_to"]);
			if($event["private_to"]!="")
			{	$add_event=false;
				$private_to=explode(",",$event["private_to"]);
				$private_to=array_map("trim",$private_to);
				if(in_array($user["username"],$private_to))
				{	$add_event=true;
				}
			}
			// Processign Private+Public
			if($_SESSION["show_private"]==0 && $event["private_to"]!="") $add_event=false;
			if($_SESSION["show_public"]==0 && $event["private_to"]=="") $add_event=false;
			if($add_event)
			{	if(count($item["events"]) >= $config["calendar_day_events_limit"])
				{	$item["more_events"]=1;
					break;
				}
				$item["events"][]=$event;
			}
		}
		$t->assign("item",$item);
		unset($item, $rs);
		$t->assign('txtoptions', (isset($txtoptions)?$txtoptions:'') );
		$t->assign('txtquestion', (isset($txtquestion)?$txtquestion:'') );
		$t->display( 'calendar_day.tpl' );
}
exit;
?>