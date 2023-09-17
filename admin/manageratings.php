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

	//Include init.php
if ( !defined( 'SMARTY_DIR' ) ) {
	include_once( '../init.php' );
}

include ( 'sessioninc.php' );

define( 'PAGE_ID', 'profile_ratings' );
if ( !checkAdminPermission( PAGE_ID ) ) {
	header( 'location: not_authorize.php' );
	exit;
}

//Default Sorting
if( isset($_GET['sort']) && $_GET['sort'] == '' ) {
	$sort = 'displayorder asc ';
} elseif( isset($_GET['sort']) && $_GET['sort'] == get_lang('col_head_name') ) {
		$sort = 'rating '. checkSortType ( $_GET['type'] );
} else {
	$sort = findSortBy();
}

//For Editing ratings
if ( isset($_GET['edit']) ) {
	$data = $osDB->getRow( 'SELECT id, rating, description, enabled from ! Where id = ?', array( RATINGS_TABLE, $_GET['edit'] ));
	$t->assign( 'lang', $lang );
	if (isset($_GET['errid'])) {
		$t->assign( 'error', get_lang('admin_error_msgs', $_GET['errid'] ) );
	}
	$t->assign( 'data', $data );
	unset($data);
	$t->assign('rendered_page', $t->fetch('admin/ratingsedit.tpl'));
	$t->display( 'admin/index.tpl' );
	exit;
}

//For Deletion of ratings
if ( isset($_POST['frm']) && $_POST['frm'] == 'frmDelrating' && isset($_POST['delaction']) && $_POST['delaction'] == 'Yes' && isset($_POST['txtid']) ) {

	// Deleting rating
	$osDB->query( 'DELETE FROM ! WHERE id = ?', array( RATINGS_TABLE, $_POST['txtid'] ) );
	header('location: manageratings.php');
	exit;
}

//Insert in ratings with max displayorder
if ( isset($_POST['frm']) && $_POST['frm'] == 'frmAddrating') {
	$rating = isset($_POST['txtrating'])?stripslashes(trim( $_POST['txtrating'] )):'';
	$enabled = isset($_POST['txtenabled'] )?trim( $_POST['txtenabled'] ):'';
	$ordno = $osDB->getOne( 'SELECT MAX(displayorder)+1 as orderno FROM ! ', array( RATINGS_TABLE ) );
	$osDB->query( 'INSERT INTO ! (rating, enabled , displayorder) VALUES (?, ?, ? )', array( RATINGS_TABLE, $rating, $enabled,  (is_null($ordno)?"0":$ordno) ) );
	header('location: manageratings.php');
	exit;
}//End of if

if ( isset($_GET['moveup']) && $_GET['moveup'] ) {
	$nrowdispord = $osDB->getOne( 'SELECT displayorder FROM ! WHERE id = ?', array( RATINGS_TABLE, $_GET['moveup'] ) );
	//to check whether it is at the highest order
	//if not then move up
	if ( $nrowdispord != 0){
		$prow = $osDB->getRow( 'SELECT id, displayorder FROM ! WHERE displayorder = ?', array( RATINGS_TABLE, ($nrowdispord-1) ) );
		$osDB->query( 'UPDATE ! SET displayorder = ? WHERE displayorder = ? AND id = ?', array( RATINGS_TABLE, $nrowdispord, $prow['displayorder'], $prow['id'] ));
		$osDB->query( 'UPDATE ! SET displayorder = ? WHERE displayorder = ? AND id = ?', array( RATINGS_TABLE, $nrowdispord-1, $nrowdispord, $_GET['moveup'] ));
		header('location: manageratings.php');
		exit;
	}
	header('location: manageratings.php?msg=rating is already at the top');
	exit;
}

if (isset( $_GET['movedown']) &&  $_GET['movedown'] ) {
	$nrowdispord = $osDB->getOne( 'SELECT displayorder FROM ! WHERE id = ?', array( RATINGS_TABLE,$_GET['movedown'] ) );
	//get maximum order of ratings
	$maxorder = $osDB->getOne( 'SELECT MAX(displayorder) as maxorder FROM !', array( RATINGS_TABLE ) );
	//to check whether it is at the lowest order
	//if not then move down
	if ( $nrowdispord !=  $maxorder['maxorder'] ){
		$prow = $osDB->getRow( 'SELECT id, displayorder FROM ! WHERE displayorder = ?', array( RATINGS_TABLE,($nrowdispord+1) ) );
		$osDB->query( 'UPDATE ! SET displayorder = ? WHERE displayorder = ? AND
			id = ?' , array( RATINGS_TABLE, ($nrowdispord+1), $nrowdispord, $_GET['movedown'] ));
		$osDB->query( 'UPDATE ! SET displayorder = ? WHERE displayorder = ? AND
			id = ?' , array( RATINGS_TABLE, $nrowdispord, $prow['displayorder'], $prow['id'] ));
		header('location: manageratings.php');
		exit;
	}
	header('location: manageratings.php?msg=rating is already at the bottom');
	exit;
}

$t->assign( 'data', $osDB->getAll( 'SELECT id, rating, displayorder, enabled from ! order by ' . $sort, array(RATINGS_TABLE) ) );
$t->assign( 'lang', $lang );
$t->assign( 'sort_type', (isset($_GET['type'])?checkSortType( $_GET['type'] ):'asc') );
$t->assign('rendered_page', $t->fetch('admin/manageratings.tpl'));
$t->display( 'admin/index.tpl' );
?>
