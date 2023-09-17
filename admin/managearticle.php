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

define( 'PAGE_ID', 'article_mgt' );

if ( !checkAdminPermission( PAGE_ID ) ) {

	header( 'location: not_authorize.php' );
	exit;
}

$psize = getPageSize();

if ( isset($_GET['edit']) ) {

	if (isset($_SESSION['modified']) && $_SESSION['modified'] != '') {

		$data = $_SESSION['modified'];

		$_SESSION['modified'] = '';

	} else {
		$data = $osDB->getRow( 'SELECT * from ! Where articleid = ?', array( ARTICLES_TABLE, $_GET['edit'] ) );
	}

	$t->assign( 'lang', $lang );

	if (isset($_GET['errid'])) {
		$t->assign( 'error_msg', get_lang('article_error', $_GET['errid'] ) );
	}
	$t->assign( 'article', $data );

	unset($data);

	$t->assign('rendered_page', $t->fetch('admin/articleedit.tpl'));

	$t->display( 'admin/index.tpl' );

	exit;
}
if ( isset($_POST['deletearticle'] ) ) {

	$osDB->query( 'DELETE FROM ! Where articleid = ?', array( ARTICLES_TABLE, $_POST['deletearticle'] ) );

}

$t->assign ( 'psize',  $psize );

$page_size = $psize;

$page = isset($_GET['offset'])?(int)$_GET['offset']:0;

if( $page == 0 ) $page = 1;

$upr = ($page)*$page_size - $page_size;

if (isset($_GET['sort']) && $_GET['sort'] == get_lang('col_head_sendtime')) {

	$sort = 'dat '.(isset($_GET['type'] )?checkSortType ( $_GET['type'] ):'asc');

} else {

	$sort = findSortBy('articleid');

}

$t->assign ( 'total_recs', $osDB->getOne( 'SELECT count(*) as num FROM !', array( ARTICLES_TABLE ) ) );

$t->assign( 'data', $osDB->getAll( 'SELECT * FROM ! ORDER BY ' . $sort . " LIMIT $upr,$page_size ", array( ARTICLES_TABLE ) ) );

$t->assign( 'lang', $lang );

$t->assign( 'sort_type', (isset($_GET['type'] )?checkSortType ( $_GET['type'] ):'asc') );

$t->assign( 'querystring', 'sort=' . (isset($_GET['sort'])?$_GET['sort']:'') . '&type=' . (isset($_GET['type'] )?checkSortType ( $_GET['type'] ):'asc') );

$t->assign( 'upr', $upr );

$t->assign('rendered_page', $t->fetch('admin/managearticles.tpl'));

$t->display( 'admin/index.tpl' );

?>