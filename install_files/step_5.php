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


/* Step-5 of installatin process.  */
/* Display all fields so far accepted and proceed. */
$dbhost = DB_HOST;
$dbtype = DB_TYPE;
$dbpasswd = DB_PASS;
$dbuser = DB_USER;
$prefix = DB_PREFIX;
$dbname = DB_NAME;

if ($admin_name == '' or !isset($admin_name)) $admin_name='admin';
$t->assign('admin_name', $admin_name);
$t->assign('dbversion',$dbversion);
$t->assign('dbname', $dbname);
$t->assign('dbuser', $dbuser);
$t->assign('dbpasswd', $dbpasswd);
$t->assign('dbhost', $dbhost);
$t->assign('prefix', $prefix);
$t->assign('db_valid', $db_valid);
$t->assign('dbtype', $dbtype);
$t->assign('config_opt',$config_opt);
$t->assign('docroot', $docroot);
$t->assign('admin_password', $admin_password);
$t->assign('confirm_password', $confirm_password);
$t->assign('langType', $langType);
$t->assign('dispstep', $dispstep+1);
define ('DB_TYPE',$dbtype);
define ('DB_PREFIX',$prefix);
define ('DB_NAME',$dbname);
define ('DB_HOST',$dbhost);
define ('DB_USER',$dbuser);
define ('DB_PASS',$dbpasswd);

foreach ($langtypeValues as $ltypekey => $ltype) {
	if ($ltype == $langType) {
		$t->assign('langName', $langtypeNames[$ltypekey]);
		break;
	}
}
$t->assign('countryType', $countryType);
include('countries.php');
foreach ($countrytypeValues as $cntrykey => $cntry) {
	if ($cntry == $countryType) {
		$t->assign('countryName', $countrytypeNames[$cntrykey]);
		break;
	}
}
ob_start();
$t->display('install/install_step5.tpl');
flush();
/* Now create tables and load system data */
define ('DB_PREFIX', $prefix);

$dsn = $dbtype . '://' . $dbuser . ':' . $dbpasswd . '@' . $dbhost . '/' .$dbname;
$db = @DB::connect( $dsn );
$db->setFetchMode( DB_FETCHMODE_ASSOC );
$replace = array(
	'DB_USER'	=> $dbuser,
	'DB_NAME'	=> $dbname,
	'DB_HOST'	=> $dbhost,
	'DB_PASS'	=> $dbpasswd,
	'DB_TYPE'	=> $dbtype,
	'DB_PREFIX' => $prefix,
	'DOC_ROOT' 	=> $docroot,
	'OSDATE_INSTALLED' => 1,
	'DEFAULT_LANG' => "'".str_replace('lang_','',$_REQUEST['langType'])."'",
	'DEFAULT_COUNTRY' => $countryType,
	'VERSION'	=> OSDATE_VERSION
);

if (substr(phpversion(),0,1) == '4') {
	/* php 4 */
	$replace['ADODB_DIR'] = 'libs/adodb4/';
} else {
	$replace['ADODB_DIR'] = 'libs/adodb/';
}

$_SESSION['opt_lang'] =  $replace['DEFAULT_LANG'];

if ($config_opt == 'F') {
	/* Forced new installation. First get table list and drop them */
	if ($dbtype == 'mysql') {

		$result = $db->getAll( "show tables" );
		/* THe returned array is coming with the header name also . Need to bypass that */
		foreach (array_values($result) as $table_exist) {
			foreach ($table_exist as $k => $tablename) {
				if (strpos($tablename,$prefix) !== false && strpos($tablename,$prefix.'_fc_') === false){
					$sq = 'drop table '.$tablename;
					$db->query($sq);
				}
			}
		}
	}
	echo("<tr><td>Dropping existing tables.... Done</td></tr> ");flush();

}

echo("<tr><td>Writing installation parameters to config.php file... ");flush();
ob_start();

$configData = getConfigData( $replace );

$configCreated = writeConfig( $configData );

ob_start();

if ($configCreated) {
//	copy(CONFIG_FILE, 'config.php');

	echo("Done</td></tr>");flush();
} else {
	echo('<font color=red>failed</font>..<br />Process to write updated config.php file failed. Please check and <a href="install.php">restart installation process</a></td></tr>');flush();
	include('install_files/footer.tpl');
	exit;
}


// Create tables
echo("<tr><td>Creating new tables...<br /> ");flush();
$tablesCreated = executeFromFile( SQL_FILE , 'create' );
if ($tablesCreated !== false) {
	echo("Table creation is completed </td></tr>");flush();
}else{
	echo(' <font color=red>Failed<br />Process to create tables in the database failed. It could be because of incompatible type or insufficient space. If any tables are created, drop those tables. Please check and <a href="install.php">restart installation process</a></td></tr>');flush();
	include('footer.tpl');
	exit;
}
ob_start();
echo("<tr><td>Loading system control data to database...");flush();
$systemInserted = executeFromFile( SYSTEM_FILE, 'insert' ) ;
if ($systemInserted!== false) {
	echo(" completed.</td></tr>");flush();
}else{
	echo(' <font color=red>Failed<br />Loading system control data to database failed. It could be because of incompatible type or insufficient space. If any tables are created, drop those tables. Please check and <a href="install.php">restart installation process</a></td></tr>');flush();
	include('footer.tpl');
	exit;
}

echo("<tr><td>Loading sample data to database...");flush();
$systemInserted = executeFromFile( SAMPLE_FILE, 'insert' ) ;
if ($systemInserted!== false) {
	echo(" completed.</td></tr>");flush();
}else{
	echo(' <font color=red>Failed<br />Inserting sample data into tables in the database failed. It could be because of incompatible type or insufficient space. If any tables are created, drop those tables. Please check and <a href="install.php">restart installation process</a></td></tr>');flush();
	include('footer.tpl');
	exit;
}

$textbanner =  '<script type="text/javascript">
<!--
google_ad_client = "pub-2289400010928312";
/* 468x60, created 2/2/09 */
google_ad_slot = "8118767646";
google_ad_width = 468;
google_ad_height = 60;
//-->
</script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>';

echo("<tr><td>Adding text banner...   completed.</td></tr>");flush();
$db->query( "INSERT INTO ".$prefix."_banners (`id`, `name`, `bannerurl`, `size`, `startdate`, `expdate`, `clicks`, `enabled`) VALUES (2, 'text2','".$textbanner."', 'text', unix_timestamp(),unix_timestamp()+(1725*24*3600), 0, 'Y')");

echo("<tr><td>Creating admin user and granting full permissions...   completed.</td></tr>");flush();
$db->query( "INSERT INTO ".$prefix."_admin (id, username, password, fullname, lastvisit, super_user, enabled) VALUES (1, '".$admin_name."', md5('".trim($admin_password)."'), 'Administrator', ".time().", 'Y', 'Y')" );
echo("<tr><td>Loading language files...</td></tr>");flush();
$loadlang[]='lang_english';
if ($langType != 'lang_english') $loadlang[]=$langType;
if (count($loadlang) > 0) {
/* we need to load language files. If the table is available, remove current data for the language

This has to work in initial loading as well as upgrade
*/
	foreach ($loadlang as $key => $lang) {
		$language= str_replace('lang_','',$lang);
		$db->query('delete from '.$prefix,"_languages where lang='".$language."'");

		$file = dirname(__FILE__) . '/language/'.$lang.'/lang_main.php';
		$file = str_replace( 'install_files/', '', $file );

		$lang = array();

		include $file;

		$sql = 'insert into ! (lang, mainkey, subkey, descr) values (?, ?, ?, ?)';
		foreach ($lang as $key => $val) {
			if (is_array($val)) {
				foreach ($val as $subkey => $descr) {
					$db->query($sql, array($prefix.'_languages', $language, $key, $subkey, htmlentities($descr)));
				}
			} else {
				$db->query($sql, array($prefix.'_languages', $language, $key, "", htmlentities($val)));
			}
		}
		print('<tr><td><span style="margin-left:12px;">'.ucfirst($language).' language file is loaded...</span></td></tr>');
	}
}

/* Check if luckySpinGender is installed or not. If not, add it as installed plugin. */
$plugin_rec = $db->getRow('select * from ! where name=?', array(DB_PREFIX.'_plugin', 'luckySpinGender') );
if (!isset($plugin_rec['name']) || $plugin_rec['name'] != 'luckySpinGender') {
	$db->query('insert into ! (name, active) values(?, ?)', array( DB_PREFIX.'_plugin','luckySpinGender', '1') );
}
echo("<tr><td>Installing luckySpinGender... completed.</td></tr>");flush();

echo("<tr><td>Updating section question and options display order...completed.</td></tr>");flush();
/* Now let us update the profile questions display order again. */
/* Set display order for existing options */

$OPTIONS_TABLE = $prefix.'_questionoptions';

$question_details = $db->getAll('select * from ! order by questionid, id',array($OPTIONS_TABLE));

$questionid = '';

$seq = 0;

foreach ($question_details as $k=>$option) {
	if ($questionid != $option['questionid']) {
		$questionid = $option['questionid'];
		$seq = 0;
	}
	$seq++;
	$db->query('update ! set displayorder = ? where id = ?', array( $OPTIONS_TABLE, $seq, $option['id']) );
}

/* Clear cache directory */
$cache_deleted = DeleteFiles('./temp/cache/', '1');

$domain = str_replace('www.','',$_SERVER['HTTP_HOST']);

$sq = 'update ! set config_value = ? where config_variable = ?';

$db->query($sq,array($prefix.'_glblsettings', 'admin@'.$domain, 'admin_email') );
$db->query($sq,array($prefix.'_glblsettings', 'info@'.$domain, 'feedback_email') );

$db->query( 'update ! set email=replace(email,?,?)', array($prefix.'_adminemails', 'domain.com', $domain) );

/* Now update pictures loaded counts for the sample data */
$pics = $db->getAll('select userid, count(*) as cnt from ! group by userid', array($prefix.'_usersnaps'));

foreach ($pics as $pic) {
	$db->query('update ! set pictures_cnt=? where id=?', array($prefix.'_user', $pic['cnt'], $pic['userid']));
}


echo("<tr><td>&nbsp;</td></tr>");
echo("<tr><td><b><font size=+1>Congratulations!!</font><br />osDate is now installed.</b></td></tr>");flush();


$t->display('install/install_step5-1.tpl');

include('footer.tpl');
exit;

?>