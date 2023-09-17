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


// Main include for forums
$forum_config = array();

function encode_ip($dotquad_ip) {

	$ip_sep = explode('.', $dotquad_ip);
	return sprintf('%02x%02x%02x%02x', $ip_sep[0], $ip_sep[1], $ip_sep[2], $ip_sep[3]);
}

// Returns the path to the root directory for the selected board
//
function root_dir() {

    global $config;

    $root_dir = false;
    // Extract the parts of the url
    //
	$root_dir = ROOT_DIR;
    $root_dir = str_replace('//','/', $root_dir);

    return $root_dir;
}

function doc_root() {

    global $config;


	$doc_root = str_replace('forum/','',DOC_ROOT).'/'.$config['forum_path'];
    $doc_root = str_replace('//','/', $doc_root);
   return $doc_root;
}

function check_forum_config() {

    global $db, $config, $t;

    $result = true;

    // Check for forum path and find it if it doesn't exist
    //
    if ( ! isset($config['forum_path'])   ) {
      $t->assign('errormsg', "Error: forum home page url is not set");
      $result = false;
    }
    elseif ( ! config_file() || ! is_file( config_file() ) ) {

      $t->assign('errormsg', "Error: Can't find forum configuration.  Forum Home Page URL setting is not correct.");
      $result = false;
    }
    return $result;
}


?>