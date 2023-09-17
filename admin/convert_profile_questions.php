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

/*
	This program will convert current questions and answers in the format defined
	in the profile_questions.php file in the language directory for language specific
	conversions.

*/
if ( !defined( 'SMARTY_DIR' ) ){
	include_once( '../init.php' );
}

include ( 'sessioninc.php' );

$file = TEMP_DIR . 'profile_questions.php';
$fp = @fopen($file,'wb');
fwrite($fp,'<?php'.chr(13).chr(10));

$sections = $osDB->getAll('select id, section from !',array(SECTIONS_TABLE));
foreach ($sections as $x=> $section) {
	fwrite($fp, "\$lang['sections']['".$section['id']."'] = '".addslashes($section['section'])."';\n\r");
}

unset($sections);

$questions = $osDB->getAll('select id, question, description, guideline, control_type, extsearchhead from ! ', array(QUESTIONS_TABLE));
foreach ($questions as $x => $rec) {
	fwrite($fp, "\$profile_questions['".$rec['id']."']['question'] = '".addslashes($rec['question'])."';\n\r");
	fwrite($fp, "\$profile_questions['".$rec['id']."']['description'] = '".addslashes($rec['description'])."';\n\r");
	fwrite($fp, "\$profile_questions['".$rec['id']."']['guideline'] = '".addslashes($rec['guideline'])."';\n\r");
	fwrite($fp, "\$profile_questions['".$rec['id']."']['extsearchhead'] = '".addslashes($rec['extsearchhead'])."';\n\r");
	if ($rec['control_type'] != 'textarea') {
		$options = $osDB->getAll('select id, answer from ! where questionid = ? order by questionid, id', array(OPTIONS_TABLE, $rec['id']) );
		foreach ($options as $x => $ans) {
			fwrite($fp, "\$profile_questions['".$rec['id']."']['".$ans['id']."'] = '".addslashes($ans['answer'])."';\n\r");
		}
		unset($options);
	}
}
fwrite($fp,'?>');
fclose($fp);

unset($questions);

$t->assign('file',$file);

$t->assign('rendered_page', $t->fetch('admin/generate_prof_quest_file.tpl'));

$t->display( 'admin/index.tpl' );

?>