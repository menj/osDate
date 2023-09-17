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

include ( 'sessioninc.php' );

define( 'PAGE_ID', 'admin_mgt' );

if ( !checkAdminPermission( PAGE_ID ) ) {

	header( 'location: not_authorize.php' );
	exit;
}

$_SESSION['txtuname'] = $name = $_POST['txtuname'];

$pwd = $_POST['txtpassword'];

$_SESSION['txtfullname'] = $fullname = $_POST['txtfullname'];

$superuser = $_POST['txtsuperuser'];

$enabled = $_POST['txtenabled'];

$confpassword = $_POST['txtconfpassword'];
$err = 0 ;

if ( $name == '' ) {

	$err = USERNAME_BLANK;

} elseif ( $pwd == '' ) {

	$err = PASSWORD_BLANK;

} elseif ( $fullname == '' ) {

	$err = FULLNAME_BLANK;

} elseif ($pwd != $confpassword) {

	$err=18;

}

if ( $err > 0 ) {

	header( 'location: adminins.php?errid=' . $err );
	exit;

}

$rid = $osDB->getOne( 'SELECT id FROM ! WHERE username = ? ', array( ADMIN_TABLE, $name ) );

$rowc = $osDB->getOne( 'SELECT count(*) from ! where username = ?', array( USER_TABLE, $name, ) );

if ( $rid > 0 or $rowc > 0  ) {

	header( 'location: adminins.php?errid='.ALREADY_EXISTS );
	exit;
}

$pwd = md5( $pwd );

$osDB->query('INSERT INTO ! ( username, password, fullname, super_user, enabled ) VALUES ( ?, ?, ?, ?, ? )', array(ADMIN_TABLE, $name, $pwd, $fullname, $superuser, $enabled ) );

$lastid = $osDB->getOne('select id from ! where username = ?',array(ADMIN_TABLE, $name)) ;

$osDB->query("INSERT INTO ! (  adminid,  profie_approval, profile_mgt, change_pwd ) VALUES (  ?, ?, ?, ? )", array( ADMIN_RIGHTS_TABLE, $lastid, '1', '1', '1' ) );

if ($superuser == 'Y') {

	$admin_rights = $osDB->getRow('select * from ! where id = ?', array(ADMIN_RIGHTS_TABLE, 1));
	foreach ($admin_rights as $k => $vl) {
		if ($k != 'id' && $k != 'adminid') {
			$osDB->query('update ! set !=? where adminid=?',array(ADMIN_RIGHTS_TABLE, $k, $vl, $lastid));
		}
	}
	unset($admin_rights);
}

$userlevel=2;

if ($superuser == 'Y') { $userlevel = 1; }
header( 'location: manageadmin.php' );

exit;

?>