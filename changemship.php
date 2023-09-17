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

$mship = $_REQUEST['item_number'];

$mshipinfo = $osDB->getRow('select activedays, name from ! where roleid = ?', array( MEMBERSHIP_TABLE, $mship ) );

$activedays = $mshipinfo['activedays'];

$userrec = $osDB->getRow('select level, levelend from ! where id = ?', array(USER_TABLE, $_SESSION['UserId'] ) );

if ($userrec['levelend'] < time() || $userrec['level'] != $mship) { $userrec['levelend'] = time(); }

$levelend = strtotime("+$activedays day", $userrec['levelend']);

$osDB->query( 'UPDATE ! SET level = ?, levelend = ?  WHERE id = ?', array( USER_TABLE, $mship, $levelend, $_SESSION['UserId'] ) );

$t->assign('level', $mshipinfo['name']);

unset($userrec, $mshipinfo);

$t->assign('rendered_page', $t->fetch('mshipchanged.tpl') );

$t->display( 'index.tpl' );

?>