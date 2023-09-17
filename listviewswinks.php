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

include('sessioninc.php');

$act = isset($_REQUEST['act']) ? $_REQUEST['act']:'V';

if (isset($_POST['groupaction']) && $_POST['groupaction'] == get_lang('delete_selected') ) {

	if (isset($_POST['txtcheck']) ) {
		foreach ($_POST['txtcheck'] as $val) {

			$osDB->query('DELETE from ! where id = ? ', array( VIEWS_WINKS_TABLE, $val ) );

		}
	}
	$t->assign('error_message',get_lang('errormsgs',($act=='V'?'70':'71') ) );

}

if (isset($_REQUEST['id']) && $_REQUEST['id'] != '' && isset($_REQUEST['remove']) && $_REQUEST['remove'] == '1' ) {

	$osDB->query('delete from ! where id = ?', array( VIEWS_WINKS_TABLE, $_REQUEST['id'] ) );

	$t->assign('error_message',get_lang('errormsgs',($act=='V'?'70':'71') ) );
}

$viewswinks_since_days = ($config['last_viewswinks_since']=='')?0:$config['last_viewswinks_since'];

$viewswinks_since = strtotime("-$viewswinks_since_days day",time());

if (isset($_SESSION['lastvisit']) && $viewswinks_since > $_SESSION['lastvisit']) $viewswinks_since = $_SESSION['lastvisit'];

if (isset($_SESSION['regdate']) && $viewswinks_since < $_SESSION['regdate']) $viewswinks_since=$_SESSION['regdate'];

// $viewswinks_cnt = $config['no_last_viewswinks'];

$psize = getPageSize();

$t->assign ( 'psize',  $psize );

$cpage = isset($_GET['page'])?$_GET['page']:1;

$start = ( $cpage - 1 ) * $psize;

$list = $osDB->getAll('select SQL_CALC_FOUND_ROWS distinct lis.id, lis.userid, lis.ref_userid, lis.act_time, usr.username, usr.gender from ! as lis, ! as usr where lis.userid = ? and lis.ref_userid = usr.id and act = ? and lis.act_time >= ? order by act_time desc, usr.username asc limit  !, !', array( VIEWS_WINKS_TABLE, USER_TABLE, $_SESSION['UserId'], $act, $viewswinks_since, $start, $psize ) );

$totalcnt = $osDB->getOne('select FOUND_ROWS()');

$pages = ceil($totalcnt / $psize);

$t->assign('viewswinks_since', strftime($lang['DATE_FORMAT'],$viewswinks_since));

$t->assign("listcount", $totalcnt);

$t->assign('list', $list);
$t->assign('start', $start);

unset($list);

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
}

$t->assign('act', $act);

if ($act == 'V'){
	$t->assign('listname', get_lang('listofviews'));
} elseif ($act == 'W') {
	$t->assign('listname', get_lang('listofwinks'));
}

$t->assign('lang', $lang);

$t->assign('rendered_page', $t->fetch('listviewswinks.tpl') );

$t->display('index.tpl');


?>