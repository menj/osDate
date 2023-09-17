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

if ($config['display_list_of_events'] > 0) {
	$timestamp=mktime(0,0,0,date("m"),date("d"),date("Y"));
	$events = array();

	// Finding begining of the week
	$cur_date=getdate_safe($timestamp);
	$t->assign("cur_date",$cur_date);

	// $date_start - date from that weekly calendar starts
	$date_start_timestamp=$timestamp;
	$date_start_array=getdate_safe($date_start_timestamp);
	$date_timestamp=$date_start_timestamp;
	$date_array=getdate_safe($date_timestamp);
	$date=$date_array["year"]."-".$date_array["mon"]."-".$date_array["mday"];

	if (isset($_SESSION['UserId']) && $_SESSION['UserId'] > 0) {
		$user = $osDB->getRow('select * from ! where id = ?', array(USER_TABLE, $_SESSION['UserId']) );
		/* Select only public events and this user's private events */

		$showevents = $osDB->getAll("SELECT id, ".
			   "       userid, ".
			   "       event, ".
			   "       description, ".
			   "       calendarid, ".
			   "       enabled, ".
			   "       timezone, ".
			   "       date_add(datetime_from, interval ! hour) as datetime_from, ".
			   "       date_add(datetime_to, interval ! hour) as datetime_to, ".
			   "       unix_timestamp(date_add(datetime_from, interval ! hour)) as dt_from, ".
			   "       unix_timestamp(date_add(datetime_to, interval ! hour)) as dt_to, ".
			   "       recurring, ".
			   "       recuroption, ".
			   "       private_to ".
			   "from ! ".
			   "where 1 ".
			   "  and to_days(date_add(datetime_from,interval ! hour))<=to_days(?) ".
			   "  and to_days(date_add(datetime_to,interval ! hour))>=to_days(?) ".
			   "  and enabled='Y' ".
			   "  and ((userid = ? or locate(?,private_to) > 0) or private_to is null) ".
			   " order by datetime_from limit !", array($user['timezone'],$user[
			   'timezone'],$user['timezone'],$user['timezone'],EVENTS_TABLE,$user['timezone'],$date,$user['timezone'],$date, $user['id'], $user['username'], $config['display_list_of_events'] ));
	} else {
		$showevents = $osDB->getAll("SELECT id, ".
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
			   " order by datetime_from limit ! ", array(EVENTS_TABLE,$date, $date, $config['display_list_of_events']));
	}
	$t->assign('showevents',$showevents);
}
?>