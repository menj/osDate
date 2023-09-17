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


require_once(dirname(__FILE__).'/minimum_init.php');
$ret='';
if (!isset($_GET['a']) || empty($_GET['a']) ) { 
	$ret .= '|||simplesearch_zip|:|' . '<input type="hidden" name="srchzip" value=""  />';
	$osDB->disconnect(); 
	echo utf8_encode($ret);
	unset($ret);
	exit;
}
$cntry = $_GET['a'];

$cnt = $osDB->getOne('select count(*)  from ! where countrycode = ?',array(ZIPCODES_TABLE, $_GET['a']) ) ;

if ($cnt <= 0) {
	$ret .= '|||simplesearch_zip|:|' .'<input type="hidden" name="srchzip" value=""  />';
} else {
	$ret .= '|||simplesearch_zip|:|' .'<table border="0" cellspacing="0" cellpadding="0" width="100%"><tr><td  width="42%">';
	$ret .= get_lang("near_zip");
	$ret .= '</td><td><input class="textinput" type="text" name="srchzip" value="" style="width:96px"  /></td></tr></table>';
}
echo utf8_encode($ret);

unset($ret);

$osDB->disconnect();
?>
