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

include_once( '../init.php');
/**
 * Fetch the IP address of the current user.
 *
 * @return string The IP address.
 */

if ( $config['forum_installed'] == ''  || ( $config['forum_installed'] != 'phpBB' && $config['forum_installed'] != 'phpBB3' && $config['forum_installed'] != 'myBB' && $config['forum_installed'] != 'vBulletin' && $config['forum_installed'] != 'Phorum' && $config['forum_installed'] != 'myBB14' && $config['forum_installed'] != 'smf11' ) || ($config['forum_installed'] != '' && $config['forum_path'] == '') ) {
    include_once('None_forum.php');

}

if (!function_exists('get_ip') ){
	function get_ip()
	{
		if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
		{
			if(preg_match_all("#[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}#s", $_SERVER['HTTP_X_FORWARDED_FOR'], $addresses))
			{
				foreach($addresses[0] as $key => $val)
				{
					if(!preg_match("#^(10|172\.16|192\.168)\.#", $val))
					{
						$ip = $val;
						break;
					}
				}
			}
		}
		if(!isset($ip))
		{
			if(isset($_SERVER['HTTP_CLIENT_IP']))
			{
				$ip = $_SERVER['HTTP_CLIENT_IP'];
			}
			else
			{
				$ip = $_SERVER['REMOTE_ADDR'];
			}
		}
		return $ip;
	}
}
/**
 * Escape a string according to the MySQL escape format.
 *
 * @param string The string to be escaped.
 * @return string The escaped string.
 */
function escape_string($string)
{
	if(function_exists("mysql_real_escape_string"))
	{
		$string = mysql_real_escape_string($string);
	}
	else
	{
		$string = addslashes($string);
	}
	return $string;
}

if (isset($_SESSION['AdminId']) && $_SESSION['AdminId'] > 0) {
	include (FORUM_DIR.'adminLogin.php');
}else  {
	include (FORUM_DIR.'userLogin.php');
}

?>