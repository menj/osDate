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

define( 'PAGE_ID', 'affiliate_stats' );

if ( !checkAdminPermission( PAGE_ID ) ) {

	header( 'location: not_authorize.php' );
	exit;
}

$sortby = ' a.name ';

if (!isset($_REQUEST['sortby']) && isset($_SESSION['sortby']) && $_SESSION['sortby'] != '') {

	$sortby = $_SESSION['sortby'];

} else {

//Default Sorting
	if (isset($_REQUEST['sortby'])) {
		if ($_REQUEST['sortby'] == 'refcnt') {
			$sortby = ' refcnt ';
		} elseif ($_REQUEST['sortby'] == 'refcnt') {
			$sortby = ' usercnt ';
		} else {
			$sortby = ' a.name ';
		}
	}
}

$_SESSION['sortby'] = trim($sortby);

if (!isset($_REQUEST['sortorder']) && isset($_SESSION['sortorder']) && $_SESSION['sortorder'] != '') {

	$sortorder = $_SESSION['sortorder'];

} elseif (isset($_REQUEST['sortorder'])) {

	$sortorder = checkSortType($_REQUEST['sortorder']);
} else {
	$sortorder = 'asc';
}

$page_size = getPageSize();

$_SESSION['sortorder'] = $sortorder;

//Paging View style

$page = isset($_GET['offset'])?(int)$_GET['offset']:0;

if( $page == 0 ) $page = 1;

$upr = ($page)*$page_size - $page_size;

$lwr = ($page)*$page_size ;

$rs = $osDB->getAll( 'SELECT a. * , count( b.id )  AS refcnt, sum( if(b.userid>0,1,0) )  AS usercnt FROM  !  AS a LEFT  JOIN ! AS b ON b.affid = a.id where a.status in (?, ?) GROUP  BY a.id '.' order by '.$sortby. ' ' . $sortorder, array( AFFILIATE_TABLE, AFFILIATE_REFERALS_TABLE, 'active', get_lang('status_act','active') ) );

$totalrecs = count($rs);

$pages = ceil($totalrecs / $page_size);

if ($pages > 1) {
	$rs = array_slice($rs, $upr, $page_size);
}
$data=array();

$t->assign('psize', $page_size);

$t->assign( 'upr', $upr );

$t->assign('pages', $pages);

$t->assign( 'sortorder', trim($sortorder) );

$t->assign( 'data', $rs );

unset($rs);

$t->assign('lang',$lang);

$t->assign('rendered_page', $t->fetch('admin/affiliatestats.tpl'));

$t->display( 'admin/index.tpl' );


?>