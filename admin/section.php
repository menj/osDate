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

define( 'PAGE_ID', 'section_mgt' );

if ( !checkAdminPermission( PAGE_ID ) ) {

	header( 'location: not_authorize.php' );
	exit;
}

//Default Sorting
if (isset($_GET['sort'] )) {
	if( $_GET['sort'] == '' ) {

		$sort = 'displayorder asc ';

	} else if( $_GET['sort'] == get_lang('col_head_name') ) {

			$sort = 'section '. checkSortType ( $_GET['type'] );

	} else {

		$sort = findSortBy();

	}
} else {
	$sort = 'displayorder asc ';

}
//For Editing Sections
if ( isset($_GET['edit']) && $_GET['edit'] != '' ) {

	$t->assign( 'lang', $lang );

	if (isset($_GET['errid']) && $_GET['errid']!='') {
		$t->assign( 'error', get_lang('admin_error_msgs', $_GET['errid']) );
	}
	$t->assign( 'data', $osDB->getRow( 'SELECT id, section, enabled from ! Where id = ?', array( SECTIONS_TABLE, $_GET['edit'] )) );

	$t->assign('rendered_page', $t->fetch('admin/sectionedit.tpl'));

	$t->display( 'admin/index.tpl' );
	exit;
}

//For Deletion of sections
if (isset($_POST['frm']) ) {
	if ( $_POST['frm'] == 'frmDelSection' && isset($_POST['delaction']) && $_POST['delaction'] == 'Yes') {

		$id = $_POST['txtid'];

		$displayorder = $osDB->getOne( 'SELECT displayorder FROM ! WHERE id = ?', array( SECTIONS_TABLE, $id ) );

		$maxorder = $osDB->getOne( 'SELECT MAX(displayorder) as maxorder FROM ! ', array( SECTIONS_TABLE ) );

		//move the records below this record up
		$i=$displayorder + 1;

		while ($i <= $maxorder['maxorder'] ){

			$osDB->query( 'UPDATE ! SET displayorder = ? WHERE displayorder = ? ', array( SECTIONS_TABLE,  $i-1 , $i ));

			$i++;
		}

		//now delete the record
		$osDB->query( 'DELETE FROM ! WHERE id = ?', array( SECTIONS_TABLE, $id ) );

		header('location: section.php');
		exit;
	}elseif ( $_POST['frm'] == 'frmAddSection') {

	//Insert in Section with max displayorder

		$maxorder = $osDB->getOne( 'SELECT MAX(displayorder)+1 as orderno FROM ! ', array( SECTIONS_TABLE ) );

		if ($maxorder <=0) $maxorder = 1;

		$osDB->query( 'INSERT INTO ! (section, enabled , displayorder) VALUES (?, ?, ? )', array( SECTIONS_TABLE, trim( $_POST['txtsection'] ), trim( $_POST['txtenabled'] ),  $maxorder ) );

		header('location: section.php');
		exit;
	}//End of if
}
if ( isset($_GET['moveup']) && $_GET['moveup'] != '' ) {

	$nrowdispord = $osDB->getOne( 'SELECT displayorder FROM ! WHERE id = ?', array( SECTIONS_TABLE, $_GET['moveup'] ) );

	//to check whether it is at the highest order
	//if not then move up
	if ( $nrow['displayorder'] != 1){

		$prow = $osDB->getRow( 'SELECT id, displayorder FROM ! WHERE displayorder = ?', array( SECTIONS_TABLE, ($nrowdispord-1) ) );

		$osDB->query( 'UPDATE ! SET displayorder = ? WHERE displayorder = ? AND id = ?', array( SECTIONS_TABLE, $nrowdispord, $prow['displayorder'], $prow['id'] ));

		$osDB->query( 'UPDATE ! SET displayorder = ? WHERE displayorder = ? AND id = ?', array( SECTIONS_TABLE, $nrowdispord-1, $nrowdispord, $_GET['moveup'] ));

		header('location: section.php');
		exit;
	}

	header('location: section.php?msg=Section is already at the top');

	exit;
}elseif ( isset($_GET['movedown']) && $_GET['movedown']!='' ) {

	$nrowdispord = $osDB->getOne( 'SELECT displayorder FROM ! WHERE id = ?', array( SECTIONS_TABLE,$_GET['movedown'] ) );

	//get maximum order of sections
	$maxorder = $osDB->getOne( 'SELECT MAX(displayorder) as maxorder FROM !', array( SECTIONS_TABLE ) );

	//to check whether it is at the lowest order
	//if not then move down
	if ( $nrowdispord !=  $maxorder['maxorder'] ){

		$prow = $osDB->getRow( 'SELECT id, displayorder FROM ! WHERE displayorder = ?', array( SECTIONS_TABLE,($nrowdispord+1) ) );

		$osDB->query( 'UPDATE ! SET displayorder = ? WHERE displayorder = ? AND
			id = ?' , array( SECTIONS_TABLE, ($nrowdispord+1), $nrowdispord, $_GET['movedown'] ));

		$osDB->query( 'UPDATE ! SET displayorder = ? WHERE displayorder = ? AND
			id = ?' , array( SECTIONS_TABLE, $nrowdispord, $prow['displayorder'], $prow['id'] ));

		header('location: section.php');
		exit;
	}

	header('location: section.php?msg=Section is already at the bottom');

	exit;
}elseif ( isset($_GET['insert']) && $_GET['insert'] == 'question') {
//Insert new section

	$lang['display_control_type'] = get_lang_values('display_control_type');

	$t->assign('sectionname', $osDB->getOne('SELECT section from ! Where id = ?', array( SECTIONS_TABLE, $_GET['sectionid'] ) ));

	$t->assign( 'lang', $lang );
	if (isset($_GET['errid']) && $_GET['errid']!='') {
		$t->assign( 'error', get_lang('admin_error_msgs', $_GET['errid'] ) );
	}
	$t->assign('rendered_page', $t->fetch('admin/questionins.tpl'));

	$t->display( 'admin/index.tpl' );

	exit;
}

$t->assign( 'lang', $lang );

$t->assign( 'sort_type', (isset($_GET['type'])?checkSortType ( $_GET['type'] ):'asc') );

$t->assign( 'data', $osDB->getAll( 'SELECT id, section, displayorder, enabled from ! order by ' . $sort, array(SECTIONS_TABLE) ));

$t->assign('rendered_page', $t->fetch('admin/section.tpl'));

$t->display( 'admin/index.tpl' );


?>