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
	include_once( '../minimum_init.php' );
}

include ( 'sessioninc.php' );

$file = TEMP_DIR . $_REQUEST['lang'].'_lang_main.php';
$fp = @fopen($file,'wb');
fwrite($fp,'<?php'.chr(13).chr(10));

$eng_defs = $osDB->getAll('select * from ! where lang = \'english\' order by mainkey, subkey ',array(LANGUAGE_TABLE));

$lang = array();

/* Add english definitions to the language array */
foreach ($eng_defs as $row) {
	$lang[$row['mainkey']][$row['subkey']] = html_entity_decode(addslashes($row['descr']));
}
if ($_REQUEST['lang'] != '') {
	$lang_defs = $osDB->getAll('select * from ! where lang = ? order by mainkey, subkey ',array(LANGUAGE_TABLE, $_REQUEST['lang']));
}
/* Now add language specific definitions to the English array by replacing the values already
	defined */
foreach ($lang_defs as $row) {
	$lang[$row['mainkey']][$row['subkey']] = html_entity_decode(addslashes($row['descr']));
}

/* Now we have $lang array which contain english definitions and language specific definitions combined.
	This will give a good idea for which language specific definitions are not given  */

foreach ($lang as $key => $val) {
	if (count($val) > 1 ) {
		fwrite($fp,"\$lang['".$key."'] = array(".chr(13).chr(10));
		foreach($val as $k => $v) {
			fwrite($fp,"'".$k."' => '".$v."',".chr(13).chr(10));
		}
		fwrite($fp,"        );".chr(13).chr(10));
	} else {
		foreach($val as $k=>$v) {
			fwrite($fp,"\$lang['".$key."'] = '".$v."';".chr(13).chr(10));
		}
	}
}
fwrite($fp,'?>');
fclose($fp);

unset($lang, $eng_defs, $lang_defs);

echo("The language specific definitions are written in ".$file."<br /><p>Please modify this and copy as  lang_main.php to appropriate language specific directory and reload to DB");

?>