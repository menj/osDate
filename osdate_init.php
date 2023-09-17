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

$callscript=$_SERVER['SCRIPT_NAME'];

$calldir=str_replace(ADMIN_DIR,'',substr($callscript,0,strrpos($callscript,'/')+1));

$calldir = str_replace('chat/','',$calldir);
$calldir = str_replace('imageEditor/','',$calldir);

if (strpos($calldir, 'plugins') !== false ) {

	$calldir = substr($calldir, 0, 	strpos($calldir, 'plugins'));
}
/* Add last '/' for DOC_ROOT and replace // with single / */

$calldir = $calldir.'/';

$calldir = str_replace('//','/',$calldir);

$_SESSION['DOC_ROOT'] = $calldir;

define('DOC_ROOT', $_SESSION['DOC_ROOT']);

define( 'VERSION', '2.5.4' );


?>