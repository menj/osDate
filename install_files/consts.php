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

/**
 ** Constants used for installation file.
 **/

define ( 'CONFIG_FILE', 'config.inc.php');
define ( 'SQL_FILE',    'sql/tables.sql');
define ( 'SYSTEM_FILE', 'sql/system.sql' );
define ( 'SAMPLE_FILE', 'sql/sample_data.sql' );
define('OSDATE_VERSION','2.5');
define ('MAIL_FORMAT', 'html');

// defaults
$langType = 'lang_english';
$langtypeValues = array( 'lang_dutch', 'lang_french', 'lang_german','lang_greek', 'lang_portuguese', 'lang_russian',   'lang_romanian','lang_spanish', 'lang_turkish');
$langtypeNames  = array( 'Dutch', 'French' ,'German', 'Greek', 'Portuguese', 'Russian',  'Romanian','Spanish', 'Turkish');
$defaultLangNames  = array( 'Dutch', 'English', 'French' ,'German', 'Greek', 'Portuguese', 'Russian',  'Romanian','Spanish', 'Turkish');
$defaultLangValues = array( 'lang_dutch', 'lang_english', 'lang_french', 'lang_german','lang_greek', 'lang_portuguese', 'lang_russian',   'lang_romanian','lang_spanish', 'lang_turkish');
$countryType = 'US';

?>