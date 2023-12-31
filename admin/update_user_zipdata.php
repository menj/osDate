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

/* This will upload number of pictures and videos loaded by the user to user table for control purposes. */

include_once('../init.php');

$users = $osDB->getAll('select id, zip, country from ! where zip is not null', array(USER_TABLE));

foreach ($users as $usr) {
	$ziprec = $osDB->getRow('select * from ! where countrycode=? and code=? limit 1',array(ZIPCODES_TABLE, $usr['country'], $usr['zip']) );
	
	if (isset($ziprec) && isset($ziprec['latitude']) && isset($ziprec['longitude']) ) {
		$osDB->query('update ! set zip_latitude=?, zip_longitude=? where id=?', array(USER_TABLE, $ziprec['latitude'], $ziprec['longitude'], $usr['id']));
	}
}

echo("USER TABLE Update is over");

?>