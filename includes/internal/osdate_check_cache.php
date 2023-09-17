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


/* This is the program which checks for cache and takes necessary action.
 *  Vijay Nair
 *
 * This works only for the index.php
 *
 */

/* Now we are ready to process */

include_once(FULL_PATH.'includes/internal/osdate_cache.php');

if ( $_SERVER['SCRIPT_NAME'] == DOC_ROOT.'index.php' ) {
	if ($_SERVER['QUERY_STRING'] == '') {
	/* This is the initial index page */
		$cached_data = checkCache('page_' . $_SERVER['REQUEST_URI'] );
		if (!$cached_data) return true;
		echo($cached_data);
		exit;
	} elseif  ( $_SERVER['QUERY_STRING']!= '' ) {
		$qrystr = $_SERVER['QUERY_STRING'];
		if (substr_count($qrystr,'page=') > 0) {
			$cached_data = checkCache('page_' . $_SERVER['REQUEST_URI'] );
			if (!$cached_data) return true;
			echo($cached_data);
			exit;
		}
	}

} elseif ($_SERVER['SCRIPT_NAME'] == DOC_ROOT.'showprofile.php' ) {
	/* showprofile */
	$cached_data = checkCache('page_' . $_SERVER['REQUEST_URI']);
	if (!$cached_data) return true;
	echo($cached_data);
	exit;
}
?>