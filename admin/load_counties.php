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

if (isset($_REQUEST) && is_array($_REQUEST) ) {
	foreach ($_REQUEST as $k => $v) {
		${$k} = $v;
	}
}

/* Loads county codes */

if ( isset($cntry) && $cntry != '' ) {
	if (isset($filename) && $filename != '' && isset($_REQUEST['loadcounties']) && $_REQUEST['loadcounties'] != '') {
		$msg = '';
		@set_time_limit(1200);
		/* Contents of the file should be COUNTYCODE, COUNTYNAME, STATECODE  */

		$file = "../counties/".$filename;
		if (file_exists($file)) {
			if (isset($loadaction) && $loadaction == 'DB') {
				$osDB->query('delete from ! where countrycode = ?', array(COUNTIES_TABLE, $cntry) );
			} elseif (isset($loadaction) && $loadaction == 'SQL') {
				$sqlfile = TEMP_DIR.str_replace('.csv','.sql',$filename);
				$outfile = fopen($sqlfile,'wb');
			}
			$handle=fopen($file,'r');
			while (!feof($handle) ) {
				$data = explode(",",str_replace('\n\r','',fgets($handle)));
				$data[2] =isset($data[2])? trim($data[2]):'';
				if (trim($data[0]) != '' && trim($data[1]) != '' ) {
					if (isset($loadaction) && $loadaction == 'DB') {
						$osDB->query('insert into ! (countrycode, code, name, statecode) values (?,?,?,?)', array(COUNTIES_TABLE, $cntry, trim($data[0]), trim($data[1]), $data[2] ) );
					} elseif (isset($loadaction) && $loadaction == 'SQL') {
						$writeme = "insert into ".COUNTIES_TABLE."(countrycode, code, name, statecode) values ('".$cntry."','".addslashes(trim($data[0]))."','".addslashes(trim($data[1]))."','".addslashes(trim($data[2]))."');\n";
						fwrite($outfile,$writeme);
					}
				}
			}
			fclose($handle);
			if (isset($loadaction) && $loadaction == 'SQL'){
				fclose($outfile);
				$msg .= $lang['countries'][$cntry].' '.get_lang('counties_sql_created').': '.$sqlfile."<br />";
			} else {
				$msg.=$lang['countries'][$cntry].' '.get_lang('counties_loaded').$filename.'<br />';
			}
			/* Analyze the table to adjust index values */
			$osDB->query('optimize table '.COUNTIES_TABLE);
		} else {
			$msg= get_lang('file_not_found');
		}
	} elseif (isset($_REQUEST['delcounties']) && $_REQUEST['delcounties'] != '') {
		/* Delete Counties for the country */

		$osDB->query('delete from ! where countrycode = ?', array(COUNTIES_TABLE, $cntry) );

		/* We should remove the state definition from counties, cities and zips tables also for this country */

		$osDB->query('update ! set countycode=? where countrycode=?', array(CITIES_TABLE, '',$cntry));
		$osDB->query('update ! set countycode=? where countrycode=?', array(ZIPCODES_TABLE, '',$cntry));

		$msg = str_replace('#COUNTRY#', $lang['countries'][$cntry], get_lang('delcounties_succ'));

		/* Analyze the table to adjust index values */
		$osDB->query('optimize table '.COUNTIES_TABLE);
		$osDB->query('optimize table '.CITIES_TABLE);
		$osDB->query('optimize table '.ZIPCODES_TABLE);
	}
}

$t->assign('filename',(isset($filename)?$filename:''));

$t->assign('loadaction', (isset($loadaction)?$loadaction:''));

$t->assign('sqlfile', (isset($sqlfile)?$sqlfile:''));

$t->assign('cntry', (isset($cntry)?$cntry:''));

$t->assign('msg',(isset($msg)?$msg:''));

$t->assign('lang',$lang);


/* Get list of zip code files from the directory */
$files = array();
$dir = opendir("../counties");
while($file = readdir($dir)) {
	if ($file != '.' && $file != '..' && stristr( $file, '.csv' ) )
		$files[] = $file;
}

$t->assign('files', $files);

unset($dir, $files);

$t->assign('rendered_page', $t->fetch('admin/load_counties.tpl'));

$t->display('admin/index.tpl');


?>