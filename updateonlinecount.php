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


include_once('minimum_init.php');
$uid = isset($_SESSION['UserId'])?$_SESSION['UserId']:'-1';
$onlinecount = $osDB->getOne('SELECT count(ou.userid) as onlineusers FROM ! ou, ! as user where ou.userid <> ifnull(?,-1) and ou.userid = user.id and user.allow_viewonline = ? and ou.lastactivitytime > ?', array( ONLINE_USERS_TABLE, USER_TABLE, $uid, '1', (time()-120) ) );

echo '|||onlinecount|:|<a href="onlineusers.php">'.get_lang('online_users').'&nbsp;'.$onlinecount.'</a>'."|||statsonlinecounter|:|".$onlinecount;
?>