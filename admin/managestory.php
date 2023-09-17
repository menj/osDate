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

define( 'PAGE_ID', 'story_mgt' );

if ( !checkAdminPermission( PAGE_ID ) ) {

	header( 'location: not_authorize.php' );
	exit;
}

$psize = getPageSize();

$rsuser = $osDB->getAll( 'SELECT id, username FROM ! ORDER BY username', array( USER_TABLE ) );

foreach( $rsuser as $row ) {

	$users[ $row['id'] ] = $row['username'];
}

$t->assign( 'users', $users );

unset($users, $rsuser);

if ( isset($_GET['edit']) ) {

	if (isset($_SESSION['modified']) && $_SESSION['modified'] != '') {

		$data = $_SESSION['modified'];

		$_SESSION['modified'] = '';
	} else {

		$data = $osDB->getRow( 'SELECT * from ! Where storyid = ?', array( STORIES_TABLE, $_GET['edit'] ) );
	}

	$t->assign( 'lang', $lang );

	if (isset($_GET['errid'])) {
		$t->assign( 'error_msg', get_lang('story_error', $_GET['errid'] ) );
	}
	$t->assign( 'story', $data );

	unset($data);

	$t->assign('rendered_page', $t->fetch('admin/storyedit.tpl'));

	$t->display( 'admin/index.tpl' );

	exit;
}

if ( isset($_POST['deletestory']) ) {

	$osDB->query( 'DELETE FROM ! Where storyid = ?', array( STORIES_TABLE, $_POST['deletestory'] ) );

}

$t->assign('psize', $psize);

$page_size = $psize;

$page = isset($_GET['offset'])?(int)$_GET['offset']:0;

if( $page == 0 ) { $page = 1; }

$upr = ($page)*$page_size - $page_size;

if( isset($_GET['sort']) && $_GET['sort'] == get_lang('col_head_sendtime') ) {

	$sort = 'date '. (isset($_GET['type'])?checkSortType ( $_GET['type'] ):'asc');

} else {

	$sort = findSortBy('storyid');

}

$t->assign ( 'total_recs', $osDB->getOne( 'SELECT count(*) as num FROM !', array( STORIES_TABLE ) ) );

$data = $osDB->getAll( 'SELECT * FROM ! ORDER BY ' . $sort . " LIMIT $upr,$page_size ", array( STORIES_TABLE ) );

$dta_array = array();

foreach ($data as $ke => $rec) {
	if ($rec['sender'] > 0) {
		$uname = $osDB->getOne('SELECT username FROM ! where id = ?', array(USER_TABLE, $rec['sender']));
		$rec['username'] = $uname;
	} else {
		$rec['username'] = '';
	}
	$dta_array[]=$rec;
}

$t->assign( 'data', $dta_array );
unset($data, $dta_array);

$t->assign( 'lang', $lang );

$t->assign( 'sort_type', (isset($_GET['type'])?checkSortType ( $_GET['type'] ):'asc') );

$t->assign( 'querystring', 'sort=' . (isset($_GET['sort'])?$_GET['sort']:'') . '&type=' . (isset($_GET['type'])?checkSortType ( $_GET['type'] ):'asc') );

$t->assign( 'upr', $upr );

$t->assign('rendered_page', $t->fetch('admin/managestories.tpl'));

$t->display( 'admin/index.tpl' );

?>