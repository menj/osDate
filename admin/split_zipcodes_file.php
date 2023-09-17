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

/* This program will split the zip codes files into small one

	usage:  admin/split_zip_codes_file.php?cntry=XX&recs=NNNN&file=filename

	Parameters
		cntry=Two Character country code
		recs=number of zip codes in one file
		file=filename

	Vijay Nair
*/
if ( !defined( 'SMARTY_DIR' ) ) {
	include_once( '../init.php' );
}

import_request_variables('pg');

if (!$recs || $recs == 0 || $recs=='') $recs=1000;

$filename = '../zipcodes/'.$file;

$dirname = '../zipcodes/'.$cntry;

if (!is_readable($filename) || $cntry == '' || !isset($cntry)) {

	echo("<b>This program should be called as follows.<br /><br />
	admin/split_zipcodes_file.php?cntry=ABCDEF&recs=NNNN&file=FILENAME<br /><br />
	where <br />
	ABCDEF is the Directory Name to be given for the country e.g. USA / Canada<br />
	recs is number of zip code records for each file (default 1000)<br />
	FILENAME is the zipcodes file name (This should be available in /zipcodes directory. e.g. uszipcodes.csv)
	<br /><br />The /zipcodes/ directory should be writeable (i.e. chmod 777). This program will create directory for the country in the /zipcodes/ (if not already present) and create files in the directory for the Country.<br /><br />");
	exit;
}
if (!is_dir($dirname) ) mkdir($dirname);

$handle = fopen($filename,'r');

$fcnt = 1;

$reccnt=0;

$zipout = createSplitFile($dirname, $cntry, $fcnt);

while (!feof($handle) ) {
	if ($reccnt == $recs) {
		/* Close the out file and reopen with new file cnt */
		fclose($zipout);
		$fcnt++;
		$zipout = createSplitFile($dirname, $cntry, $fcnt);
		$reccnt = 0;
	}
	$reccnt++;
	fwrite($zipout,fgets($handle));
}

fclose($zipout);

exit;

function createSplitFile($dirname, $cntry, $fcnt)
{
/* This function will open a file for writing in temp directory for zip split file*/
	$fname = $dirname.'/'.$cntry."_zips_".sprintf('%04s',$fcnt).".csv";
	return fopen($fname,'wb');
}


?>