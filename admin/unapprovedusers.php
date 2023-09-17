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

define( 'PAGE_ID', 'profie_approval' );

if ( !checkAdminPermission( PAGE_ID ) ) {

	header( 'location: not_authorize.php' );
	exit;
}

$sort = findSortBy('username');

if (isset( $_POST['groupaction']) &&  $_POST['groupaction'] != '' && count($_POST['txtchk']) > 0 && $_POST['groupaction'] != get_lang('status_act','cancel') ){

	foreach ($lang['status_act'] as $key => $val ) {
		if ($val == $_POST['groupaction']) {
			$action = $key;
		}
	}

	$sql = 'UPDATE ! SET status =?, active = 1 WHERE 0 ';

	foreach( $_POST['txtchk'] as $item) {

		$sql .= ' OR id = \'' . $item .'\'';

		if ($action == 'active') {

			$activedays = $osDB->getOne('select distinct mem.activedays from ! as mem, ! as usr where usr.id = ? and mem.roleid = usr.level', array(MEMBERSHIP_TABLE, USER_TABLE, $item) );

			$levelend = strtotime("+$activedays day",time());

			$osDB->query('update ! set levelend = ? where id = ?',array( USER_TABLE, $levelend, $item) );

		}
	}
	if ($action == 'rejected') { $errid = PROFILES_REJECTED; }
	elseif ($action == 'active') { 	$errid = PROFILES_ACTIVATED; }
 	else { $errid = PROFILES_SUSPENDED; }

	$rs = $osDB->query( $sql, array( USER_TABLE, $action ) );

	header( 'location: ?errid='.$errid );

	exit;
}

$t->assign( 'sort_type', (isset($_GET['type'])?checkSortType( $_GET['type'] ):'asc' ));

$t->assign ( 'data' , $osDB->getAll ( 'SELECT * FROM ! WHERE status in (?, ?) ORDER BY ' . $sort, array( USER_TABLE, get_lang('status_enum','approval'), 'approval' ) ) );

if (isset($_GET['errid']) ) {
	$t->assign ( 'errid' , $_GET['errid'] );

	$t->assign("error_message", get_lang('errormsgs', $_GET['errid']) );

} elseif (isset($_GET['error_message'])) {
	$t->assign("error_message",  $_GET['error_message'] );
}
$t->assign ( 'lang', $lang );

$t->assign('rendered_page', $t->fetch('admin/unapprovedusers.tpl'));

$t->display ( 'admin/index.tpl' );

?>
