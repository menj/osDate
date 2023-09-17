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

include ( 'sessioninc.php' );

$sectionid = $_GET[ 'sectionid' ];

// Query to reterive records from osdate_questions table, sorted descending on mandatory: that is, mandatory fields should be displayed first

$temp = $osDB->getAll("select id, question, mandatory, description, guideline, maxlength, control_type from ? where enabled = ? and section = ? order by mandatory desc, displayorder", array( QUESTIONS_TABLE, 'Y', $sectionid ) );

$index = 0;

foreach( $temp as $index => $row ) {

	$options = $osDB->getAll( 'select * from ! where enabled = ? and questionid = ? order by displayorder', array( OPTIONS_TABLE, 'Y', $row[id] ) ) ;

	//Place options of question at the last of array
	$row['options'] = makeOptions ( $options );
	unset($options);
	//Create questions array
	$data []= $row;
}

unset($temp);

//Assign template variables to Smarty
$t->assign ( 'mandatory_question_error', get_lang('errormsgs',$_GET['errid']) );

$t->assign ( 'sectionid', $_GET['sectionid'] );

$t->assign("frmname", "frm" . $sectionid );

$t->assign ( 'head', $sections[ $sectionid ] );

$t->assign ( 'data', $data );

unset($data, $sections);

$t->assign('rendered_page', $t->fetch('questions.tpl') );

//Display template
$t->display('index.tpl');


?>