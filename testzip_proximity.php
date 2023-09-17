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


include ('init.php');

$lat = 34.1689;

$lng = -118.344;

$radius = 30;

$sql = "select DISTINCT code, (3958* 3.1415926 * sqrt((latitude - $lat) * (latitude- $lat) + cos(latitude / 57.29578) * cos($lat/57.29578)*(longitude - $lng) * (longitude - $lng))/180) as dist from ! where countrycode=? and (3958* 3.1415926 * sqrt((latitude - $lat) * (latitude- $lat) + cos(latitude / 57.29578) * cos($lat/57.29578)*(longitude - $lng) * (longitude - $lng))/180) < " . $radius ;
$zips = $osDB->getAll($sql, array(ZIPCODES_TABLE, 'US') );

print_r($zips);

?>