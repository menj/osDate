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

/* This is the main Page Caching mechanism of osdate.
 * Vijay Nair
 *
 * This caches following pags only and only if the user is not logged in.
 *
 * index.php
 *   index page for a visitor
 *   individual article and news item and stories display as part.
 *   terms of service page display
 *   faq page display
 *   privacy poliry
 *   services page
 *	 stories
 *	 allnews
 *   articles
 *   show one story
 *   show one news item
 *   show one article
 *   All saved pages
 *   login page
 *
 * showprofile.php
 *   profile of a member if popup is enabled as a full page
 *   profile of a member if popup is not enabled which works as part.
 *
 *
 * The expiry time of cache is limited by the value page_cache_expiry in Global
 *     settings. Default is 30 minutes.
 */
 function checkCache($query)
 {
 	global $config;
	/* Get hash file name for the query */
	$cached_file_name = generateCacheFilename($query);
	/* Now see if there is a hash for current query is svailable */
	$cached_data = getCachedData($cached_file_name);

	if (!$cached_data) { return false; }
	$cached_time = $cached_data['cached_time'];

	/* Convert the config['time_cache_expiry'] into seconds */
	$tm = time() - $config['page_cache_expiry']*60;

//	$tm = time() - (30*60);

	if ($cached_time < $tm) {
		removeCacheFile($cached_file_name);
		return false;
	}
	/* Cache is valid. return data */
	return $cached_data['saved_data'];
 }
 // }}}

// {{{ saveCache()
/*
 *	This function will update the cached_tables file with latest update time.
 *  This will write the file with updated time
 *  @param the SQL Query, result of query
 *
 *	@access internal
 *  @return none
 */
function saveCache($query, $result) {
	$cache_file = generateCacheFilename($query);
	$save_array = serialize(array(
		'cached_time' => get_micro_time(),
		'saved_data' => $result)
		);

	$fp = @fopen(CACHE_DIR.$cache_file,'wb');
	@flock($fp,LOCK_EX);
	@fwrite($fp,$save_array);
	@flock($fp,LOCK_UN);
	@fclose($fp);
}

// }}}

/* This function generates the file name for the cached item */
function generateCacheFilename($input)
{
	return 'pages_cache_'.md5($input).".dat";
}

/* Get microtime as table update time and cache time */
function get_micro_time()
{
/*		list($usec, $sec) = explode(" ", microtime());
	return (float)($usec + $sec);
	*/
	return time();
}

/* This function gets the cache file for a given cached_file_name  and returns
	data, and time of cache
*/
function getCachedData($cached_file_name){
	$cached_data = array();
	if (file_exists(CACHE_DIR.$cached_file_name)) {
		$cached_data = unserialize(file_get_contents(CACHE_DIR.$cached_file_name));
	}
	return $cached_data;
}

/* This function will remove the cacehd file from CACHE_DIR */
function removeCacheFile($cache_file_name) {

	unlink(CACHE_DIR.$cache_file_name);
}

?>