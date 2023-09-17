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


/* Step-4 of installatin process.  */

/* Check if database can be connected */
$dbhost = DB_HOST;
$dbtype = DB_TYPE;
$dbpasswd = DB_PASS;
$dbuser = DB_USER;
$prefix = DB_PREFIX;
$dbname = DB_NAME;


$dsn = $dbtype . '://' . $dbuser . ':' . $dbpasswd . '@' . $dbhost . '/' .$dbname;
$db = @DB::connect( $dsn );
$db_valid = '1';
$errorLogin == '0';
if ( DB::isError($db) ) {
	$db_valid='0';
	if ( $db->code == -24 ) {
		$t->assign( 'errorLogin', 1 );
	} else if ( $db->code == -9 ) {
		$t->assign( 'errorLogin', 1 );
	}

} else {

	if ($dbtype == 'mysql') {

		$result = $db->getAll( "show tables" );
		$tablesexist=0;
		foreach (array_values($result) as $table_exist) {
			foreach ($table_exist as $k => $tablename) {
				if (($prefix != '' && strpos($tablename,$prefix) !== false && strpos($tablename,$prefix.'_fc_') === false) || $prefix == '') {
					$tablesexist++;
					break;
				}
			}
		}

		// check if we have rights

		if ( !DB::isError( $result ) ) {

			foreach ( $result as $index => $dbarray ) {

				$name = $dbarray[0];

				if ( $name == $dbname ) {
					$db_valid = '1';
					break;
				}
			}

		}

	} else {
		// if no rights - assume user entered valid db name
		// if not - this will be found in the next lines
		$db_valid = '1';
	}

	$db->disconnect();

}

if ($docroot == '' or !isset($docroot)) {

	$callscript=$_SERVER['SCRIPT_NAME'];

	$calldir=str_replace('admin/','',substr($callscript,0,strrpos($callscript,'/')+1));

	$calldir = str_replace('chat/','',$calldir);

	/* Add last '/' for DOC_ROOT and replace // with single / */

	$calldir = $calldir.'/';

	$calldir = str_replace('//','/',$calldir);

	$docroot = $calldir;
}
$t->assign('docroot', $docroot);
$_SESSION['replacearray']['DOC_ROOT'] = $docroot;
$t->assign('dbversion',$dbversion);
$t->assign('dbname', $dbname);
$t->assign('dbuser', $dbuser);
$t->assign('dbpasswd', $dbpasswd);
$t->assign('dbhost', $dbhost);
$t->assign('prefix', $prefix);
$t->assign('db_valid', $db_valid);
$t->assign('dbtype', $dbtype);
$t->assign('config_opt',$config_opt);
$t->assign( 'errorLogin', $errorLogin );

$_SESSION['replacearray']['DB_NAME'] = $dbname;
$_SESSION['replacearray']['DB_HOST'] = $dbhost;
$_SESSION['replacearray']['DB_USER'] = $dbuser;
$_SESSION['replacearray']['DB_PASS'] = $dbpasswd;
$_SESSION['replacearray']['DB_PREFIX'] = $prefix;
$_SESSION['replacearray']['DB_TYPE'] = $dbtype;
define ('DB_TYPE',$dbtype);
define ('DB_PREFIX',$prefix);
define ('DB_NAME',$dbname);
define ('DB_HOST',$dbhost);
define ('DB_USER',$dbuser);
define ('DB_PASS',$dbpasswd);

if ($errorLogin == '1' || $db_valid != '1' || ( $config_opt=='N' && $tablesexist > 0) || ( $config_opt=='U' && $tablesexist == 0) ) {

	$t->assign('tablesexist', $tablesexist);

	$t->assign('dispstep', $dispstep);

	$t->display('install/install_step3.tpl');

	include('footer.tpl');

	exit;
}


/* OK. Now the database is accessible.
   In case of upgrade, let us proceed.
   Otherwise, let us accept other parameters.
*/

if ($config_opt != 'U') {

	/* Insert and forced installation */
	include( 'countries.php' );
	if ($admin_name == '' or !isset($admin_name)) $admin_name='admin';
	$t->assign('admin_name', $admin_name);

	$t->assign('dispstep', $dispstep+1);
	$t->assign( 'countrytypeValues', $countrytypeValues );
	$t->assign( 'countrytypeNames', $countrytypeNames );
	$t->assign( 'countryType', $countryType );
	$t->assign( 'langType', $langType );
	$t->assign( 'defaultLangValues', $defaultLangValues );
	$t->assign( 'defaultLangNames', $defaultLangNames );

	$t->display('install/install_step4.tpl');

	include('footer.tpl');

	exit;
}

if ($config_opt == 'U') {

	/* Upgrade from earlier version */
	define ('DB_PREFIX', $prefix);

	$dsn = $dbtype . '://' . $dbuser . ':' . $dbpasswd . '@' . $dbhost . '/' .$dbname;
	$db = @DB::connect( $dsn );
	$db->setFetchMode( DB_FETCHMODE_ASSOC );

	/* Upgrade option */
	$_SESSION['upgrade']='1';
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

	// do upgrade here
	$t->assign( 'upgrade', 1 );

	$t->display('install/install_step5.tpl');
	if (substr(phpversion(),0,1) == '4') {
		/* php 4 */
		$replace['ADODB_DIR'] = 'libs/adodb4/';
	} else {
		$replace['ADODB_DIR'] = 'libs/adodb/';
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
		include('footer.tpl');
		exit;
	}

	$succ = upgradeWithFile( SQL_FILE );

	/* Clear cache directory */
	$cache_deleted = DeleteFiles('./temp/cache/', '1');

	if ($succ === true) {
		echo('<tr><td><center><font size="+1"><b><br />Congratulations.<br /> Upgrade successfully completed</b></font></center></td></tr>
		<tr><td>&nbsp;</td></tr>');
		$t->assign('dispstep', $dispstep+1);
	} else {
		echo('<tr><td><font size="14px" color=red><center><br />Upgrade failed. Please check issues and then <a uhref="install.php"restart installation process</a>.</center></font></td></tr><tr><td>
		&nbsp;</td></tr>');
		exit;
	}
	$t->display('install/install_step5-1.tpl');

	include('footer.tpl');

	exit;
}
?>