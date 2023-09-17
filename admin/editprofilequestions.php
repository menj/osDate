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

include('sessioninc.php');

define( 'PAGE_ID', 'profile_mgt' );

if ( !checkAdminPermission( PAGE_ID ) ) {

	header( 'location: not_authorize.php' );
	exit;
}

$userid = $_REQUEST['edit'];

$sectionid = $_REQUEST[ 'sectionid' ];

$user_rec = $osDB->getRow('select * from ! where id = ?', array( USER_TABLE, $userid ) );
$t->assign('username', $user_rec['username'] );

$t->assign('user', $user_rec);

if ( $sectionid == '' ) {
	$sectionid = 1;
}
//Query to reterive records from osdate_questions table
// sorted descending on mandatory: that is mandatory fields should be displayed first

$lang='english';

if (isset($_SESSION['lang']) && $_SESSION['lang'] != 'english') { $lang = $_SESSION['lang']; }
$questionrs = $osDB->getAll( 'select id, question, mandatory, description, guideline, maxlength, control_type, gender from ! where enabled = ? and section = ? and question <> ? and gender in (?,?) order by mandatory desc, displayorder', array( QUESTIONS_TABLE, 'Y', $sectionid, '' ,$user_rec['gender'],'A') );

$index = 0;

foreach ( $questionrs as $index=>$row ) {

	if ($_SESSION['opt_lang'] != 'english') {
	/* THis is made to adjust for multi-language */
		$lang_question = $_SESSION['profile_questions'][$row['id']]['question'];
		$lang_descr = 	$_SESSION['profile_questions'][$row['id']]['description'];
		$lang_guide = 	$_SESSION['profile_questions'][$row['id']]['guideline'];
		if ($lang_question != '') {
			$row['question'] = $lang_question;
		}
		if ($lang_descr != '') {
			$row['description'] = $lang_descr;
		}
		if ($lang_guide != '') {
			$row['guideline'] = $lang_guide;
		}
	}

	//Query to reterive record from osdate_questionoptions table
	$optionsrs = $osDB->getAll( 'Select * from ! where enabled = ? and questionid = ? order by displayorder ', array( OPTIONS_TABLE, 'Y', $row['id'] ) ) ;

	$optsrs = array();
	if ($_SESSION['opt_lang'] != 'english') {
	/* THis is made to adjust for multi-language */
		foreach($optionsrs as $kx => $opt) {
			$lang_ansopt = $_SESSION['profile_questions'][$row['id']][$opt['id']];
			if ($lang_ansopt != '') {$opt['answer'] = $lang_ansopt;
			}else{ $opt['answer'] = $lang_ansopt;}
			$optsrs[] = $opt;
		}
	} else {$optsrs = $optionsrs; }

	unset($optionsrs);

	//Place options of question at the last of array
	$row['options'] = makeOptions ( $optsrs  );

	unset($optsrs);

	//Query to reterive user preferences
	$userprefrs = $osDB->getAll( 'Select questionid, answer from ! where userid = ? and questionid = ?', array( USER_PREFERENCE_TABLE, $userid, $row['id'] ) ) ;

	$row['userpref'] = makeAnswers ( $userprefrs );

	unset($userprefrs);

	//Create questions array
	$data[ $index ] = $row;

	//frees array
}

unset($questionrs);

if (isset($_GET['errid']) && $_GET['errid'] != '') {
	$t->assign ( 'mandatory_question_error', get_lang('errormsgs',$_GET['errid']) );
}

$t->assign ( 'sectionid', $_REQUEST['sectionid'] );

$t->assign( 'frmname', 'frm' . $sectionid );

$t->assign ( 'head', $sections[ $sectionid ] );

$t->assign ( 'data', $data );

unset($data, $sections);

$t->assign('rendered_page', $t->fetch('admin/editprofilequestions.tpl'));

$t->display('admin/index.tpl');

?>