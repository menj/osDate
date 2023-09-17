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

define( 'PAGE_ID', 'promo_mgt' );

if ( !checkAdminPermission( PAGE_ID ) ) {

	header( 'location: not_authorize.php' );
	exit;
}
$psize = getPageSize();

if ( isset($_GET['edit']) && $_GET['edit']!='' ) {

	if (isset($_GET['errid']) && $_GET['errid'] != '') {
		$data['date'] = $_SESSION['txtdate'];
		$data['header'] = $_SESSION['txttitle'];
		$data['text'] = $_SESSION['txttext'];
		$data['promoid'] = $_GET['edit'];
		$t->assign( 'error_msg', get_lang('promo_error', $_GET['errid'] ) );
	} else{
		$data = $osDB->getRow( 'SELECT * from ! Where id = ?', array(PROMO_TABLE, $_GET['edit']) );
	}
	$t->assign( 'lang', $lang );

	$t->assign( 'promos', $data );

	unset($data);

	$roles = array();

	$rs = $osDB->getAll( 'SELECT roleid, name FROM !',array( MEMBERSHIP_TABLE ) );

	foreach ( $rs as $row ) {

		$roles[$row['roleid']] = $row['name'];
	}

	$t->assign( 'memberships', $roles );

	unset($roles, $rs);

	$t->assign('rendered_page', $t->fetch('admin/promoedit.tpl'));

	$t->display( 'admin/index.tpl' );

	exit;
}

$id = isset($_REQUEST['promoid'])?$_REQUEST['promoid']:'';

if ( isset($_REQUEST['delete']) && $_REQUEST['delete'] == 'promo' ) {

	$osDB->query( 'DELETE FROM ! Where id = ?', array(PROMO_TABLE, $id ) );

	header('location: managepromo.php');

	exit;

}

if ( isset($_REQUEST['active']) && $_REQUEST['active'] == 'promo' ) {

	$osDB->query( 'UPDATE ! SET active = ? WHERE id = ?', array( PROMO_TABLE, '1', $id ) );

	header('location: managepromo.php');

	exit;
}

if ( isset($_REQUEST['inactive']) && $_REQUEST['inactive'] == 'promo' ) {

	$osDB->query( 'UPDATE ! SET active = ? WHERE id = ?', array( PROMO_TABLE, '0', $id ) );

	header('location: managepromo.php');

	exit;
}


$t->assign('psize', $psize);

$page = isset($_GET['offset'])? (int)$_GET['offset']:0;

if( $page == 0 ) $page = 1;

$upr = ($page)*$psize - $psize;

if (isset($_REQUEST['sort'])) {
	if( $_REQUEST['sort'] == get_lang('col_head_sendtime') ) {

		$sort = 'date '. checkSortType ( $_GET['type'] );

	} elseif ($_REQUEST['sort'] == 'promo_code') {

		$sort = ' promocode '.checkSortType ( $_GET['type'] );

	} elseif ($_REQUEST['sort'] == 'promo_desc') {

		$sort = ' pdesc '.checkSortType ( $_GET['type'] );

	} else {

		$sort = findSortBy('id');
	}
} else {
	$sort = findSortBy('id');
}

$t->assign ( 'total_recs', $osDB->getOne( 'SELECT count(*) as num FROM !', array(PROMO_TABLE) ) );

$t->assign( 'data', $osDB->getAll( 'SELECT * FROM ! ORDER BY ' . $sort . " LIMIT $upr,$psize ", array(PROMO_TABLE) ) );

$t->assign( 'lang', $lang );

$t->assign( 'sort_type', (isset($_GET['type'])?checkSortType( $_GET['type'] ):'asc') );

$t->assign( 'querystring', 'sort=' . (isset($_GET['sort'])?$_GET['sort']:'') . '&type=' . (isset($_GET['type'])?$_GET['type']:'asc'));

$t->assign( 'upr', $upr );

$t->assign('rendered_page', $t->fetch('admin/managepromo.tpl'));

$t->display( 'admin/index.tpl' );


?>