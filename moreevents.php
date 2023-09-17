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
	include_once( 'init.php' );
}

include ( 'sessioninc.php' );

// Get user's data (timezone)
$user = $osDB->getRow("select * from ! where id=?",array(USER_TABLE, $_SESSION["UserId"]));
$t->assign("user",$user);

if(empty($_REQUEST["calendarid"]))
{	// Finding first calendar
	$calendarid=$osDB->getOne("select id from ! order by displayorder",array(CALENDARS_TABLE));
} else {
	$calendarid=$_REQUEST["calendarid"];
}

$t->assign("calendarid",$calendarid);

$date_timestamp=$_REQUEST["timestamp"];
$date_array=getdate_safe($date_timestamp);
$date=$date_array["year"]."-".$date_array["mon"]."-".$date_array["mday"];

$item=array();
$item["timestamp"]=$date_timestamp;
$item["date"]=$date_array;
$item["cur_date"]=$date;
$item["events"]=array();

// selecting all events for that date
$rs = $osDB->getAll("select id, userid, event, description, ".
	   "       date_add(datetime_from, interval ! hour) as datetime_from, ".
	   "       date_add(datetime_to, interval ! hour) as datetime_to, ".
	   "       calendarid, timezone, private_to ".
	   "from !  ".
	   "where 1 ".
	   "  and to_days(date_add(datetime_from,interval ! hour))<=to_days(?) ".
	   "  and to_days(date_add(datetime_to,interval ! hour))>=to_days(?) ".
	   "  and enabled='Y' ".
	   "  and calendarid=? ".
	   "order by datetime_from ",array($user["timezone"], $user["timezone"], EVENTS_TABLE,$user["timezone"],$date,$user["timezone"],$date,$calendarid));

foreach($rs as $event) {	// Check for private event here
	$add_event=true;
	$event['username'] = $osDB->getOne('select username from ! where id = ?', array(USER_TABLE, $event['userid']) );
	if($event["private_to"]!="")
	{	$add_event=false;
		$private_to=explode(",",$event["private_to"]);
		$private_to=array_map("trim",$private_to);
		if(in_array($user["username"],$private_to))
		{	$add_event=true;
		}
	}
	if($add_event)
	{	// Checking for watch events
		$event["watched"]=$osDB->getOne("select count(*) from ! where userid=? and eventid=? ",array(WATCHES_TABLE, $_SESSION["UserId"], $event["id"]));
		$item["events"][]=$event;
	}

}

if (count($item["events"]) <= 0) {
	$t->assign('error','1');
}
$t->assign("date",$date);
$t->assign("events",$item["events"]);
unset( $rs, $item, $event);
$t->assign('rendered_page', $t->fetch('moreevents.tpl') );
$t->display ( 'index.tpl' );

exit;
?>