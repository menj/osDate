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

/* This will remove all cached files which is older than the time limit
	given in config['page_cache_limit']

	Vijay Nair
*/

include_once('../init.php');

$tm = time() - $config['time_cache_expiry']*60;

DeleteFiles('../temp/cache/', $tm);

echo("Old cache files deleted.. <br />");

function DeleteFiles($fromdir, $tm, $recursed = 1 ) {
	if ($fromdir == "" or !is_dir($fromdir)) {
		echo ('Invalid directory');
		return false;
	}

	$filelist = array();
	$dir = opendir($fromdir);

	while($file = readdir($dir)) {
		if($file == "." || $file == ".." || $file == 'readme.txt' || $file == 'index.html' || $file == 'index.htm') {
			continue;
		} elseif (is_dir($fromdir."/".$file)) {
			if ($recursed == 1) {
				$temp = DeleteFiles($fromdir."/".$file, $recursed);
			}
		} elseif (file_exists($fromdir."/".$file) && filemtime($fromdir."/".$file) < $tm) {
			unlink($fromdir."/".$file);
		}
	}

	closedir($dir);

	return true;
}
?>