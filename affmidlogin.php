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

// to do: change error codes to PHP constants

if (!isset($_POST['txtusername']) || $_POST['txtusername'] == '' || !isset($_POST['txtpassword']) || $_POST['txtpassword'] == '') {

	$err = MANDATORY_FIELDS;

} else {

	$row = $osDB->getRow( 'select id, name, status from ! where email = ? and password = ?', array( AFFILIATE_TABLE, $_POST['txtusername'],  md5( $_POST['txtpassword'] ) ) );

	if( $row ){

		if( $row['status'] == 'active' || $row['status'] == get_lang('status_enum','active') ) {

			$_SESSION['AffId'] = $row['id'];

			$_SESSION['AffName'] = $row['name'];
			unset($row);
			header('location: affpanel.php');
			exit();

		} elseif( $row['status'] == 'approval' || $row['status'] == get_lang('status_enum','approval')) {

			$err = '171';

		} elseif( $row['status'] == 'rejected' || $row['status'] == get_lang('status_enum','rejected')) {

			$err = SUBMISSION_DECLINED;

		} elseif( $row['status'] == 'suspended' || $row['status'] == get_lang('status_enum','suspended')) {

			$err = ACCOUNT_SUSPENDED;
		}

		unset($row);
	} else {

		$err = INVALID_LOGIN;

	}
}

header( 'location: afflogin.php?errid=' . $err );
exit();

?>