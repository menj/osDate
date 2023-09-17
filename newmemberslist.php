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

$list_newmembers_since_days = $config['list_newmembers_since_days'];

if ($list_newmembers_since_days == '') $list_newmembers_since_days=0;

$list_newmembers_since = strtotime("-$list_newmembers_since_days day",time());

$psize = getPageSize();

$sqlNew = "SELECT id, username, floor((to_days(curdate())-to_days(birth_date))/365.25)  as age, gender, city, country, state_province, county, regdate  FROM ! WHERE status in (?, ?)  and regdate >= ? ";


if (!isset($_REQUEST['orderby']) && (isset($_SESSION['orderby']) && $_SESSION['orderby'] != '') ) {

	$orderby = $_SESSION['orderby'];

} else {
	if (!isset($_REQUEST['orderby']) ) $_REQUEST['orderby'] = 'username';

	switch ($_REQUEST['orderby']) {
		case 'gender' :
			$orderby = ' gender ';
			break;
		case 'age' :
			$orderby = ' age ';
			break;
		case 'country':
			$orderby = ' country ';
			break;
		case 'city' :
			$orderby = ' country asc, city ';
			break;
		case 'sincedate':
			$orderby = ' regdate ';
			break;
		case 'username':
		default:
		$orderby = ' username ';
	}
	$_SESSION['orderby'] = trim($orderby);

}

if (!isset($_REQUEST['sortorder']) && isset($_SESSION['sortorder']) && $_SESSION['sortorder'] != '' ) {

	$sortorder = $_SESSION['sortorder'];

} else {

	$sortorder = checkSortType(isset($_REQUEST['sortorder'])?$_REQUEST['sortorder']:'asc');
}

$_SESSION['sortorder'] = $sortorder;

$sqlNew .=  ' ORDER BY '.$orderby.' '.$sortorder;

$newmembers = $osDB->getAll($sqlNew, array( USER_TABLE, 'active', get_lang('status_enum','active') , $list_newmembers_since ) );

unset($sqlNew);
$reccount = count($newmembers);

$t->assign ( 'psize',  $psize );

$page = isset($_REQUEST['page'])?(int)$_REQUEST['page']:'1';

if( $page == 0 ) $page = 1;

$upr = ($page * $psize )- $psize;

$pages = ceil( $reccount / $psize );

$cpage = $page;

if( $pages > 1 ) {

	if ( $cpage > 1 ) {

		$prev = $cpage - 1;

		$t->assign( 'prev', $prev );

	}

	$t->assign ( 'cpage', $cpage );

	$t->assign ( 'pages', $pages );

	if ( $cpage < $pages ) {

		$next = $cpage + 1;

		$t->assign ( 'next', $next );

	}

	$newmembers = array_slice($newmembers, $upr, $psize);
}

$newmemberslist = array();

foreach ($newmembers as $newmemrec) {
	$cityname = getCityName($newmemrec['country'],$newmemrec['state_province'], $newmemrec['city'], $newmemrec['county'] );
	$newmemrec['city'] = $cityname;
	$newmemberslist[] = $newmemrec;
}

$t->assign('newmemberslist',$newmemberslist);

unset($newmemberslist, $newmembers);

$t->assign ( 'pages',  $pages );

$t->assign ( 'reccount',  $reccount );

$t->assign('sortorder', trim($sortorder));

$t->assign('orderby', isset($_REQUEST['orderby'])?$_REQUEST['orderby']:'asc');

$t->assign( 'lang', $lang );

$t->assign('rendered_page', $t->fetch('newmemberslist.tpl') );

$t->display( 'index.tpl' );

exit;
?>