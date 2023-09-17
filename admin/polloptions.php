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

define( 'PAGE_ID', 'poll_mgt' );

if ( !checkAdminPermission( PAGE_ID ) ) {

	header( 'location: not_authorize.php' );
	exit;
}

if ( isset( $_GET['edit'] ) ) {

	$id = $_GET['edit'];

	$t->assign( 'data', $osDB->getRow( 'SELECT * FROM ! WHERE optionid = ?', array( POLLOPTS_TABLE, $id ) ) );

	if (isset($_GET['errid']) && $_GET['errid']!= '') {
		$t->assign( 'error	', get_lang('poll_error',$_GET['errid']) );
	}
	$t->assign('rendered_page', $t->fetch('admin/polloptsedit.tpl'));

	$t->display( 'admin/index.tpl' );

	exit;
}

if ( isset($_POST['groupaction'] ) ) {

	$pollid =  $_POST['txtpollid'];

	$optid =  $_POST['txtoptionid'];

	$opts =  $_POST['txtcheck'];

	if ( $_POST['groupaction']	== get_lang('enable_selected') ) {

		foreach( $opts as $val ) {

			$osDB->query('UPDATE ! SET enabled = ? WHERE optionid = ? AND pollid = ?', array( POLLOPTS_TABLE, 'Y', $val, $pollid ) );
		}
	} elseif ( $_POST['groupaction']	== get_lang('disable_selected') ) {

		foreach( $opts as $val ) {

			$osDB->query( 'UPDATE ! SET enabled = ? WHERE optionid = ? AND pollid = ?', array( POLLOPTS_TABLE, 'N', $val, $pollid ) );

		}

	} elseif ( $_POST['groupaction']	== get_lang('delete_selected') ) {

		foreach( $opts as $val ) {

			$osDB->query('DELETE FROM ! WHERE optionid = ? AND pollid = ?', array( POLLOPTS_TABLE, $val, $pollid ) );

		}

	}
	unset($opts);

}

if ( isset($_POST['frm']) && $_POST['frm'] == 'frmDelOption' ) {

	$pollid 	= $_POST['txtpollid'];

	$optid 	= $_POST['txtoptionid'];

	$osDB->query('DELETE FROM ! WHERE optionid = ? AND pollid = ?', array( POLLOPTS_TABLE, $optid, $pollid ) );

}

if ( isset($_REQUEST['pollid']) ) {

	$pollid = $_REQUEST['pollid'];

}

//Default Sorting

$sort = findSortBy('optionid');

$t->assign( 'data', $osDB->getAll('SELECT * from ! WHERE pollid = ? order by ' . $sort, array( POLLOPTS_TABLE, $pollid ) ) );

$t->assign( 'lang', $lang );

$t->assign( 'poll_question', stripslashes( $osDB->getOne( 'SELECT question from ! WHERE pollid = ?', array( POLLS_TABLE, $pollid ) ) ) );

$t->assign( 'pollid', $pollid );

$t->assign( 'sort_type', (isset($_GET['type'])?checkSortType( $_GET['type'] ):'asc') );

$t->assign('rendered_page', $t->fetch('admin/polloptions.tpl'));

$t->display( 'admin/index.tpl' );


?>