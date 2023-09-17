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

define( 'PAGE_ID', 'send_letter' );

if ( !checkAdminPermission( PAGE_ID ) ) {

	header( 'location: not_authorize.php' );
	exit;
}

//check for delete parameter in URL; if yes then do delete action
if(isset($_GET['delete']) && $_GET['delete'] != '') {

	$osDB->query( 'DELETE FROM ! WHERE id = ? ', array( ADMIN_EMAILS_TABLE, trim( $_GET['delete']) ) );

	header ( 'location: ?' );
	exit;
}
elseif (isset($_POST['frm']) &&  $_POST['frm'] == 'frmAddEmail' ){

	$osDB->query( 'INSERT INTO ! ( email ) values( ? )', array( ADMIN_EMAILS_TABLE, $_POST['txtemail'] ) );

	header ( 'location: ?' );
	exit;
}

$t->assign( 'emails',$osDB->getAll( 'SELECT * FROM ! ORDER BY ' . findSortBy(), array( ADMIN_EMAILS_TABLE ) ) );

$t->assign( 'sort_type', checkSortType( isset($_GET['type'])?$_GET['type']:'asc' ) );

$t->display( 'admin/adminemail.tpl' );

exit;
?>