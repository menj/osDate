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

define( 'PAGE_ID', 'pages_mgt' );

if ( !checkAdminPermission( PAGE_ID ) ) {

	header( 'location: not_authorize.php' );
	exit;
}

$page = isset($_POST['txtpage'])?$_POST['txtpage']:'';

$t->assign('curpage', $page);

if (isset($_SESSION['modifiedpage']) && $_SESSION['modifiedpage'] != '') {

	$t->assign('pagerec', $_SESSION['modifiedpage']);

	$t->assign('curpage', $_SESSION['modifiedpage']['id']);

	$_SESSION['modifiedpage'] = '';

} elseif ( $page != '0' ) {

	if (isset($_REQUEST['delpage']) && $_REQUEST['delpage'] == get_lang('delete')) {

		$osDB->query('delete FROM ! WHERE id = ?', array( PAGES_TABLE, $page));

		$_GET['errid'] = 5;

	} else {

		$t->assign( 'pagerec',$osDB->getRow( 'SELECT id, lang, pagekey, title, pagetext FROM ! WHERE id = ?', array( PAGES_TABLE, $page ) ) );

	}
}

$rs = $osDB->getAll( 'SELECT id, title as answer FROM !', array( PAGES_TABLE ) );

if (isset($_GET['errid'])) {
	$t->assign ( 'error_msg', get_lang('pages_errormsgs',$_GET['errid']) );
}

$t->assign( 'pagedata', makeOptions( $rs ) );

unset($rs);

$t->assign('rendered_page', $t->fetch('admin/managepages.tpl'));

$t->display ( 'admin/index.tpl' );



?>