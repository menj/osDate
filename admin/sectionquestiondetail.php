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

define( 'PAGE_ID', 'section_mgt' );

if ( !checkAdminPermission( PAGE_ID ) ) {

	header( 'location: not_authorize.php' );
	exit;
}


$sort = findSortBy();

//Move order of question 1 level up
if ( isset($_REQUEST['moveup']) && $_REQUEST['moveup']!='' ) {

	$nrowduspord = $osDB->getOne( 'SELECT displayorder FROM ! WHERE id = ? and questionid = ?', array( OPTIONS_TABLE, $_REQUEST['moveup'], $_REQUEST['questionid'] ) );

	if ( $nrowduspord != 1){

		$prow = $osDB->getRow( 'SELECT id, displayorder FROM ! WHERE displayorder < ? and questionid = ? order by displayorder desc ', array( OPTIONS_TABLE, $nrowduspord, $_REQUEST['questionid'] ) );

		$osDB->query( 'UPDATE ! SET displayorder = ? WHERE id = ? ' , array( OPTIONS_TABLE, $nrowduspord, $prow['id'] ));

		$osDB->query( 'UPDATE ! SET displayorder = ? WHERE id = ? ' , array( OPTIONS_TABLE, $prow['displayorder'],  $_REQUEST['moveup'] ));

		header('location: sectionquestiondetail.php?sectionid=' . $_REQUEST['sectionid'].'&questionid='.$_REQUEST['questionid']);
		exit;

	}

	header('location: sectionquestiondetail.php?sectionid=' . $_REQUEST['sectionid'].'&questionid='.$_REQUEST['questionid'].'&err='.QUESTION_ON_TOP);

	exit;

}elseif ( isset($_REQUEST['movedown'] ) && $_REQUEST['movedown'] !='') {

//Move order of question 1 level down

	$nrowduspord = $osDB->getOne( 'SELECT displayorder FROM !  WHERE id = ? ', array( OPTIONS_TABLE , $_REQUEST['movedown'] ) );


	//get maximum order of sections
	$maxorder = $osDB->getOne( 'SELECT MAX(displayorder) as maxorder FROM ! WHERE questionid = ?', array( OPTIONS_TABLE, $_REQUEST['questionid'] ) );

	if ( $nrowduspord !=  $maxorder['maxorder'] ){
		$prow = $osDB->getRow( 'SELECT id, displayorder FROM ! WHERE displayorder > ? AND questionid = ? order by displayorder ', array( OPTIONS_TABLE, $nrowduspord, $_REQUEST['questionid'] ) );

		$osDB->query( 'UPDATE ! SET displayorder = ? WHERE id = ?' , array( OPTIONS_TABLE, $prow['displayorder'], $_REQUEST['movedown'] ));

		$osDB->query( 'UPDATE ! SET displayorder = ? WHERE id = ?' , array( OPTIONS_TABLE, $nrowduspord,  $prow['id'] ));

		header('location: sectionquestiondetail.php?sectionid=' . $_REQUEST['sectionid'].'&questionid='.$_REQUEST['questionid']);
		exit;
	}
	header('location: sectionquestiondetail.php?sectionid=' . $_REQUEST['sectionid'].'&questionid='.$_REQUEST['questionid'].'&err='.QUESTION_AT_BOTTOM);
	exit;
}

if ( isset($_REQUEST['questionid']) && $_REQUEST['questionid']!=''  && !isset($_REQUEST['edit'])  ) {

	//check for delete parameter in URL
	//if yes then do delete action
	if(isset($_GET['delete'])) {

		$osDB->query( 'DELETE FROM ! WHERE id = ?', array( OPTIONS_TABLE, trim( $_REQUEST['delete'] ) ) );

		//now after deletion remove delete parameter from URL
		header ( 'location: sectionquestiondetail.php?sectionid=' . $_REQUEST['sectionid'] . '&questionid=' . $_REQUEST['questionid']  );

		exit;
	}elseif (isset($_POST['frm']) && $_POST['frm'] == 'frmAddOption' ){

		$maxorder = $osDB->getOne( 'SELECT MAX(displayorder) as maxorder FROM ! WHERE questionid = ?', array( OPTIONS_TABLE, $_REQUEST['questionid'] ) );

		$osDB->query( 'INSERT INTO ! (answer,questionid,enabled, displayorder) values(?, ?, ?, ?)', array( OPTIONS_TABLE, $_POST['txtanswer'], $_POST['txtquestion'], $_POST['txtenabled'], $maxorder+1 ) );

		header ( 'location: sectionquestiondetail.php?sectionid=' . $_REQUEST['sectionid'] . '&questionid=' . $_REQUEST['questionid']  );
		exit;
	}

	$sort = findSortBy('displayorder');

	//get question from DB and add it to smarty
	$t->assign('question',$osDB->getRow( 'SELECT * from ! Where id = ?', array( QUESTIONS_TABLE, $_REQUEST['questionid'] ) ) );

	//get question options from DB and add it to smarty

	$optdata = $osDB->getAll( 'SELECT * from ! Where questionid = ? order by ' . $sort, array(OPTIONS_TABLE,$_REQUEST['questionid'] ) );

	$optds = array();

	foreach ( $optdata as $opts) {

		$opts['answer'] = stripslashes($opts['answer']);

		$optds[] = $opts;
	}


	$t->assign('options', $optds);

	unset($optds, $optdata);

	$t->assign( 'lang', $lang );

	$t->assign( 'sort_type', (isset($_GET['type'])?checkSortType ( $_GET['type'] ):'asc') );

	$t->assign('rendered_page', $t->fetch('admin/sectionquestiondetail.tpl'));

	$t->display( 'admin/index.tpl' );

	exit;

} elseif ( isset($_REQUEST['edit']) && $_REQUEST['edit']!='' ) {

	$opt = $osDB->getRow('SELECT * from ! Where id = ?', array( OPTIONS_TABLE, $_REQUEST['edit']) );

	$opt['answer'] =  stripslashes($opt['answer']);

	//get question from DB and add it to smarty

	$t->assign('question', $osDB->getRow( 'SELECT * from ! Where id = ?', array( QUESTIONS_TABLE, $_REQUEST['questionid'] ) ));

	$t->assign('option', $opt );

	unset($opt);

	$t->assign( 'lang', $lang );

	if (isset($_REQUEST['errid']) && $_REQUEST['errid']!='') {
		$t->assign( 'error', get_lang('admin_error_msgs', $_REQUEST['errid'] ) );
	}
	//Display index.tpl file

	$t->assign('rendered_page', $t->fetch('admin/optionedit.tpl'));

	$t->display( 'admin/index.tpl' );

	exit;

} else {

	header('location: section.php');
	exit;

}

?>