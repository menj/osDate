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

/* Install Promo system tables */

include('../init.php');

/* Create Promo Tables */

$osDB->query("CREATE TABLE ".DB_PREFIX.
	"_promo (
  `id` int(11) NOT NULL auto_increment,
  `promocode` varchar(10) NOT NULL,
  `pdesc` varchar(50) NOT NULL,
  `promotype` varchar(20) NOT NULL,
  `memberlevel` int(1) NOT NULL,
  `increasedays` int(3) NOT NULL,
  `active` int(1) NOT NULL,
  PRIMARY KEY  (`id`)
)");

$osDB->query("CREATE TABLE ".DB_PREFIX."_promo_used (
  `id` int(11) NOT NULL auto_increment,
  `userid` int(11) NOT NULL,
  `promocode` varchar(10) NOT NULL,
  `used_date` date ,
  PRIMARY KEY  (`id`)
) ");

/* Now manage admin permissions table */
$osDB->query("alter table ".DB_PREFIX."_admin_permissions add
(promo_mgt    char(1))");

$osDB->query("update ".DB_PREFIX."_admin_permissions set promo_mgt=1 where adminid=1");
?>