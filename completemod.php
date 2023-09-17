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

if ( isset( $_GET['txtconfcode'] ) && $_GET['txtconfcode'] ) {
	$confcode = $_GET['txtconfcode'];
} else {
	$confcode = isset($_GET['confcode']):$_GET['confcode']:'';
}


$row = $osDB->getRow( 'SELECT id, username, firstname, lastname, level FROM ! WHERE  actkey = ?', array( USER_TABLE, $confcode ) );

if ( isset($row) && $row['id'] > 0 ) {

	if ($config['default_active_status'] == 'Y') {

		$status = 'active';

	} else {

		$status = 'approval';

	}

	$osDB->query( 'UPDATE ! SET active=?, status = ?,  actkey=?,  lastvisit=?  WHERE id = ?', array( USER_TABLE, '1', $status, 'Confirmed',  time(), $row['id'] ) );

	$osDB->query( 'DELETE FROM ! WHERE userid = ?', array( ONLINE_USERS_TABLE, $row['id'] ) );

	$osDB->query( 'INSERT INTO ! ( userid, lastactivitytime , session_id ) VALUES ( ?, ?, ?)', array( ONLINE_USERS_TABLE, $row['id'], time(), session_id() ) );

	session_destroy();

	header('location: index.php?page=login&err='.MODIFY_COMPLETED);

} else {

	header( 'location: index.php?page=login&err='.INVALID_ACTIVATION_CODE );

}
exit;
?>