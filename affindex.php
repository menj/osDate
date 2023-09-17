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

if( isset( $_POST['frm'] ) && $_POST['frm'] == 'frmAffSignup' ) {

	$name = strip_tags(trim( $_POST[ 'txtname' ] ) );
	$password = strip_tags(trim( $_POST[ 'txtconpassword' ] ));
	$email = strip_tags(trim( $_POST[ 'txtemail' ] ));
	$t->assign('txtname', $name);
	$t->assign('txtemail',$email);
	// change later

	if( !$name ) {

		header( 'location: affindex.php?error=' . MANDATORY_FIELDS );
		exit;

	} elseif ( !$password ) {

		header( 'location: affindex.php?error=' . MANDATORY_FIELDS );
		exit;

	} elseif( !$email ) {

		header( 'location: affindex.php?error=' . MANDATORY_FIELDS );
		exit;

	} elseif( trim( $_POST['txtpassword'] ) != $password ){

		header( 'location: affindex.php?error=' . PASS_CONFIRMPASS);
		exit;

	}

	$rowc = $osDB->getRow( 'SELECT count(*) as aacount from ! where email = ?', array( AFFILIATE_TABLE, $email ) );

	if ( $rowc['aacount'] > 0 ) {

		header( 'location: affindex.php?error='.EMAIL_EXISTS);
		exit;
	}

	$status = 'approval';

	$regdate = time();

	$password = md5($password);

	// the affiliate confirmation code - finish this for osdate 1.1.0 release
	$code = md5( microtime() );

	$osDB->query ( 'INSERT INTO ! ( name, email, password, status, regdate ) VALUES ( ?, ?, ?, ?, ? )', array( AFFILIATE_TABLE, $name, $email, $password, $status, $regdate ) );

	$lastid = $osDB->getOne('select id from ! where name = ? and email = ?',array(AFFILIATE_TABLE, $name, $email));

	// send the affiliate email...

	$t->assign( 'affid', $lastid );

	$t->assign('rendered_page', $t->fetch('affsignupsuccess.tpl') );

	$t->display( 'index.tpl' );

	exit;
}

if( isset($_GET['error']) &&  $_GET['error'] ) {

	$t->assign( 'error', get_lang('affiliates_error',$_GET['error']) );

} else {

	$t->assign( 'error', '' );
}

$t->assign('rendered_page', $t->fetch('affindex.tpl') );

$t->display( 'index.tpl' );
?>