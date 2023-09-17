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


if( trim($_POST['txtusername']) == '' ){

	$err = USERNAME_BLANK; // change to a constant later

} elseif( trim($_POST['txtpassword']) == '' ){

	$err = PASSWORD_BLANK; // change to a constant later

} else {
	$row = $osDB->getRow( 'SELECT *  FROM ! where username = ? and password = ?' , array( ADMIN_TABLE, $_POST['txtusername'], md5( trim( $_POST['txtpassword'] ) ) ) );

	if(isset($row['id']) &&  $row['id'] > 0 ) {

		$_SESSION['AdminId'] = $row['id'];

		$_SESSION['LastVisit'] = $row['lastvisit'];

		$_SESSION['AdminName'] = $row['fullname'];

		$_SESSION['UserName'] = $_POST['txtusername'];

		$_SESSION['UserId'] = '';

		$_SESSION['whatIneed'] = base64_encode( $_POST['txtpassword'] );

		$time = time();

		$osDB->query( 'UPDATE ! SET lastvisit = ? WHERE id = ?', array( ADMIN_TABLE, $time, $row['id'] ) );

		$_SESSION['Permissions'] = $osDB->getRow( 'SELECT * FROM ! WHERE adminid = ?', array( ADMIN_RIGHTS_TABLE, $row['id'] ) );

		unset($row);

		$_SESSION['opt_lang'] = $config['admin_lang'];

		header( 'location: panel.php' );

		exit();
	} else {

		$err = INVALID_LOGIN; // change to a constant later
	}
}

header( 'location: index.php?errid=' . $err );
exit();

?>