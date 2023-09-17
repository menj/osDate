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

if (!isset($cnt)) $cnt = 1;

/* Loads zip codes from files which are split in step 1 */
if (isset( $cntry) &&  $cntry != '' ) {

	$filename = $_SESSION['cntry_'.$cntry]['files'][$cnt - 1];
	$fname=$_SESSION['cntry_'.$cntry]['filesdir'].$filename;

	$handle = fopen($fname,'r');
	if ($cntry == 'GB') {
	/* UK Zip Codes, Format is
		ZIPCODE, Latitude, Longitude, State, County, City
	*/
		while (!feof($handle) ) {
			$zipdata = explode(",",fgets($handle));
			if ($zipdata[0] != '' && trim($zipdata[1]) != '' && trim($zipdata[2]) != ''){
				$osDB->query('insert into ! (code, countrycode, latitude, longitude, statecode, countycode, citycode) values (?,?,?,?,?,?,?)', array(ZIPCODES_TABLE, $zipdata[0], $cntry, trim($zipdata[1]), trim($zipdata[2]),(isset($zipdata[3])? trim($zipdata[3]):''), (isset($zipdata[4])? trim($zipdata[4]):''), (isset($zipdata[5])? trim($zipdata[5]):'') ) );
			}

		}
	} elseif ($cntry == 'US') {
	/* US zip codes , Format is
		ZIPCODE, Latitude, Longitude, State, County, City
	*/
		while(!feof($handle) ) {
			$zipdata = explode(",",fgets($handle));
			if (count($zipdata) > 6) {
				if (isset($zipdata[0]) &&  $zipdata[0] != '' && isset($zipdata[1]) && trim($zipdata[1]) != '' && isset($zipdata[2]) && trim($zipdata[2]) != '') {
					$osDB->query('insert into ! (code, countrycode, statecode, latitude, longitude, countycode, citycode) values (lpad(?,5,"0"),?,?,?,?,?,? )', array(ZIPCODES_TABLE, $zipdata[0], $cntry, (isset($zipdata[3])?$zipdata[3]:''),trim($zipdata[1]), trim($zipdata[2]), (isset($zipdata[6])? trim($zipdata[6]):''), (isset($zipdata[7])?trim($zipdata[7]):'') ) );
				}
			} else {
				if (isset($zipdata[0]) &&  $zipdata[0] != '' && isset($zipdata[1]) && trim($zipdata[1]) != '' && isset($zipdata[2]) && trim($zipdata[2]) != '') {
					$osDB->query('insert into ! (code, countrycode, statecode, latitude, longitude, countycode, citycode) values (lpad(?,5,"0"),?,?,?,?,?,? )', array(ZIPCODES_TABLE, $zipdata[0], $cntry, (isset($zipdata[3])? $zipdata[3]:'') ,trim($zipdata[1]), trim($zipdata[2]), (isset($zipdata[4])? trim($zipdata[4]):'') , (isset($zipdata[5])? trim($zipdata[5]):'') ) );
				}
			}
		}
	} elseif ($cntry == 'CA') {
	/* Canada Zip Codes */

		while(!feof($handle) ) {
			$zipdata = explode(",",fgets($handle));
			if (isset($zipdata[0]) &&  $zipdata[0] != '' && isset($zipdata[1]) && trim($zipdata[1]) != '' && isset($zipdata[2]) && trim($zipdata[2]) != '') {
				$osDB->query('insert into ! (code, countrycode, statecode, latitude, longitude) values (?,?,?,?,?)', array(ZIPCODES_TABLE, $zipdata[0], $cntry, $zipdata[3], trim($zipdata[1]), trim($zipdata[2]) ) );
			}
		}
	} else {
	/* Contente of the file should be
		COUNTRYCODE, ZIPCODE, STATECODE, LATITUDE, LONGITUDE  */

		while (!feof($handle) ) {
			$zipdata = explode(",",str_replace('\n\r','',fgets($handle)));
			if (isset($zipdata[0]) &&  $zipdata[0] != '' && isset($zipdata[1]) && trim($zipdata[1]) != '' && isset($zipdata[2]) && trim($zipdata[2]) != '') {
				$osDB->query('insert into ! (countrycode, code, latitude, longitude, statecode) values (?,?,?,?, ?)', array(ZIPCODES_TABLE, $cntry, $zipdata[0], $zipdata[1], trim($zipdata[2]), (isset($zipdata[3])? trim($zipdata[3]):'') ) );
			}
		}
	}
	fclose($handle);
}

$cnt++;

$t->assign('cnt', $cnt);
$t->assign('cntry', $cntry);
$t->assign('loadedfiles',$_SESSION['cntry_'.$cntry]['files']);
$t->assign('lang',$lang);
$t->assign('config', $config);

$t->assign('loadedcnt', $cnt - 1);

if ($cnt > count($_SESSION['cntry_'.$cntry]['files']) ) {
	unset ($_SESSION['cntry_'.$cntry]);
	$cntryname = $lang['countries'][$cntry];
	$msg = "<br />".str_replace('#COUNTRY#',$cntryname,get_lang('zip_load_over'));
	$t->assign('dispmsg',$msg);
}

$t->display('admin/load_zips_split.tpl');

if (isset($_SESSION['cntry_'.$cntry]['files']) && $cnt <= count($_SESSION['cntry_'.$cntry]['files']) ) {

	echo('<meta http-equiv=refresh content=0;url='.DOC_ROOT.ADMIN_DIR.'load_zips_split.php?cntry='.$cntry.'&amp;cnt='.$cnt.'>');
	flush();
}
?>