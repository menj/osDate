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

include_once( 'minimum_init.php' );

// Days
$osDB->query("update ! ".
	 "set datetime_from=date_add(datetime_from, interval recuroption day), ".
	 "    datetime_to=date_add(datetime_to, interval recuroption day)  ".
	 "where recurring = 1 ".
	 "  and to_days(date_add(datetime_from, interval recuroption day)) = to_days(date_sub(now(),interval ! hour)) ", array(EVENTS_TABLE, $config["server_timezone"]));

// Weeks
$osDB->query("update ! ".
	 "set datetime_from=date_add(datetime_from, interval recuroption*7 day), ".
	 "    datetime_to=date_add(datetime_to, interval recuroption*7 day)  ".
	 "where recurring = 2 ".
	 "  and to_days(date_add(datetime_from, interval recuroption*7 day)) = to_days(date_sub(now(),interval ! hour)) ", array(EVENTS_TABLE, $config["server_timezone"]));

// Months
$osDB->query("update ! ".
	 "set datetime_from=date_add(datetime_from, interval recuroption month), ".
	 "    datetime_to=date_add(datetime_to, interval recuroption month)  ".
	 "where recurring = 3 ".
	 "  and to_days(date_add(datetime_from, interval recuroption month)) = to_days(date_sub(now(),interval ! hour)) ", array(EVENTS_TABLE, $config["server_timezone"]));

// Years
$osDB->query("update ! ".
	 "set datetime_from=date_add(datetime_from, interval recuroption year), ".
	 "    datetime_to=date_add(datetime_to, interval recuroption year)  ".
	 "where recurring = 4 ".
	 "  and to_days(date_add(datetime_from, interval recuroption year)) = to_days(date_sub(now(),interval ! hour)) ", array(EVENTS_TABLE, $config["server_timezone"]));

exit;
?>