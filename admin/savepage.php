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
include( 'sessioninc.php' );

define( 'PAGE_ID', 'pages_mgt' );

if ( !checkAdminPermission( PAGE_ID ) ) {

	header( 'location: not_authorize.php' );
	exit;
}

$ptitle = $_POST['txttitle'];

$pkey = $_POST['txtkey'];

$pbody = ltrim(rtrim($_POST['txtbody']));

$err = 0;

if ( $ptitle == '' ) {

	$err = NO_PAGE_HDR;

} elseif ( $pkey == '' ) {

	$err = NO_PAGE_KEY;

} elseif( $pbody == '' or strlen($pbody) <= 0 ) {

	$err = NO_PAGE_TEXT;

}

$_SESSION['modifiedpage'] = array('title'	=>	$ptitle,
					'pagekey'	=>	$pkey,
					'pagetext'	=>	$pbody
					);
if ( $err != 0 ) {

	header ( 'location: managepages.php?errid=' . $err );
	exit;

}

$rs = $osDB->getOne( 'SELECT Count(*)  FROM !  WHERE pagekey = ? ', array(PAGES_TABLE, $pkey ) );

if ( $rs > 0 ) {

	header( 'location: managepages.php?errid='.PAGE_EXISTS );
	exit;

}

$osDB->query( 'INSERT INTO ! ( title, pagekey, pagetext) VALUES ( ?, ?, ? )', array( PAGES_TABLE, $ptitle, $pkey, $pbody ) );

$_SESSION['modifiedpage']['id'] = $osDB->getOne('select id from ! where title=? and pagekey = ?',array( PAGES_TABLE, $ptitle, $pkey)) ;

header( 'location: managepages.php' );

exit;
?>