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

$dbhost = DB_HOST;
$dbtype = DB_TYPE;
$dbpasswd = DB_PASS;
$dbuser = DB_USER;
$prefix = DB_PREFIX;
$dbname = DB_NAME;

if ($config_opt == 'U' or $config_opt == 'F') {
	/* Let us get the database connectivity details using the config.php file */
//	include_once('config.php');
	$errorcode='';
	/* Check if database can be connected */


	$dsn = $dbtype . '://' . $dbuser . ':' . $dbpasswd . '@' . $dbhost . '/';
	$db = @DB::connect( $dsn );
	if ( DB::isError($db) ) {
		$errorcode = 1;
		$t->assign( 'errorLogin', 1 );

	} else {

		if ($dbtype == 'mysql') {

			$result = $db->getAll( "show databases" );

			// check if we have rights

			if ( !DB::isError( $result ) ) {

				foreach ( $result as $index => $dbarray ) {

					$name = $dbarray[0];

					if ( $name == $dbname ) {
						$db_valid = true;
						break;
					}
				}
			} else {
				$errorcode = 1;
				$t->assign( 'errorLogin', 1 );
			}
		} else {
			// if no rights - assume user entered valid db name
			// if not - this will be found in the next lines
			$db_valid = true;
		}

		$db->disconnect();

	}
	if ($errorcode == '') {
		/* Now see if tables are available */
		$dsn = $dbtype . '://' . $dbuser . ':' . $dbpasswd . '@' . $dbhost . '/' .$dbname;

		$db = @DB::connect( $dsn );

		if ( DB::isError($db) ) {
			$errorcode = 1;
			$t->assign( 'errorLogin', 1 );
		} else if ($dbtype == 'mysql') {

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

		}

		$db->disconnect();
	}

} else {

	$dbhost='localhost';
	$prefix = 'osdate';
}

$t->assign('tablesexist', $tablesexist);
$t->assign('dbversion',$dbversion);
$t->assign('dbname', $dbname);
$t->assign('dbuser', $dbuser);
$t->assign('dbpasswd', $dbpasswd);
$t->assign('dbhost', $dbhost);
$t->assign('prefix', $prefix);
$t->assign('db_valid', $db_valid);
$t->assign('dbtype', $dbtype);

$t->assign('dispstep', $dispstep+1);
$t->assign('config_opt',$config_opt);

if ($errorcode != '') {
	$t->display('install/install_step2.tpl');
} else {
	$t->display('install/install_step3.tpl');
}
include('footer.tpl');
exit;
?>
