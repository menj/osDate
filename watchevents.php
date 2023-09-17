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

if ( isset($_GET['add']) ){
	$id = $_GET['add'];
	$osDB->query( 'replace ! set userid = ?, eventid = ? ', array( WATCHES_TABLE, $_SESSION["UserId"], $id) );
} elseif ( isset($_GET['delete']) ){
	$id = $_GET['delete'];
	$osDB->query( 'DELETE FROM ! WHERE userid = ? and eventid = ? ', array( WATCHES_TABLE, $_SESSION["UserId"], $id) );
}

// Get user's data (timezone)
$user = $osDB->getRow("select * from ! where id=?",array(USER_TABLE, $_SESSION["UserId"]));

$t->assign("user",$user);

// selecting all events for that date
$rs = $osDB->getAll("select e.id, e.userid, e.event, e.description, ".
	   "       date_add(e.datetime_from, interval ! hour) as datetime_from, ".
	   "       date_add(e.datetime_to, interval ! hour) as datetime_to, ".
	   "       e.calendarid, e.timezone, e.private_to ".
	   "from ! as e inner join ! as we on we.eventid = e.id ".
	   "where 1 ".
	   "  and we.userid=? ".
	   "  and date_add(e.datetime_to, interval ! hour) >= now() ".
	   "order by e.datetime_from ",array($user["timezone"], $user["timezone"], EVENTS_TABLE,WATCHES_TABLE,$_SESSION["UserId"], $config["server_timezone"]));

$events_count = $osDB->getOne('select count(*) from ! where datetime_to between  date_add(now(), interval ! hour) and date_add(date_add(now(), interval 30 day), interval ! hour)',array(EVENTS_TABLE,$user["timezone"],$user["timezone"] ) );

$events = array();
foreach ($rs as $event)
{	$event["watched"]=1;
	$event['username'] = $osDB->getOne('select username from ! where id = ?', array(USER_TABLE, $event['userid']) );
	$events[]=$event;
}

unset($rs, $user);

$noevent_msg = get_lang('no_watched_event');

$noevent_msg = str_replace('\n\r','<br />',$noevent_msg);

$noevent_msg = str_replace('#eventcount#',$events_count,$noevent_msg);

$noevent_msg = str_replace('#calenderlink#','href="#" onClick="javascript:popUpWindow(\'calendar.php\',\'center\',950,600);"',$noevent_msg);

$noevent_msg = str_replace('#glassicon#','<img src="./images/search_icon.gif" border="0" width="18" height="18" alt="" />', $noevent_msg);

$t->assign('events_count', $events_count);

$t->assign('noevent_msg',$noevent_msg);

if(empty($events)) $t->assign("error",1);

$t->assign('lang',$lang);

$t->assign("events",$events);

unset( $events);

$t->assign('rendered_page', $t->fetch('watchevents.tpl') );

$t->display ( 'index.tpl' );

exit;
?>