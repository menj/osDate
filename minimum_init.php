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


error_reporting( E_ERROR );

session_start();

define ('FULL_PATH', dirname(__FILE__).'/');

require_once( FULL_PATH.'temp/myconfigs/config.php' );

if(!isset($_SERVER)) $_SERVER=$GLOBALS['_SERVER'];

include_once(FULL_PATH."osdate_init.php");

require_once SMARTY_DIR . 'Smarty.class.php';
require_once FULL_PATH. 'libs/Smarty/osDate_Smarty.class.php';
// require_once PEAR_DIR . 'Mail.php';

require LIB_DIR . 'osDateDB.php';
require FULL_PATH.'includes/internal/Functions.php' ;
require_once PEAR_DIR . 'Compat.php';
PHP_Compat::loadFunction('file_get_contents');

$lang = array();

$_SESSION['browser'] = getUserBrowser();

$t =& new osDate_Smarty;


/**********************************/
// Instantiate DB Access methods
/**********************************/
if ( !isset( $osDB ) ) {

	$osDB = new osDateDB;
	if ($config['MAIL_FORMAT'] == '') {$config['MAIL_FORMAT'] = 'html';}
	if ($config['MAIL_TYPE'] == '') {$config['MAIL_TYPE'] = 'mail';}

	define('MAIL_FORMAT',strtolower($config['MAIL_FORMAT']));
	define('MAIL_TYPE',$config['MAIL_TYPE']);
	define('SMTP_HOST',$config['SMTP_HOST']);
	define('SMTP_PORT',$config['SMTP_PORT']);
	define('SMTP_USER',$config['SMTP_USER']);
	define('SMTP_PASS',$config['SMTP_PASS']);
	define('SMTP_AUTH',$config['SMTP_AUTH']);
	define('SM_PATH',$config['SM_PATH']);

}
if ( $config['MAIL_TYPE'] == 'smtp' ) {
	$params = array();// for mail sending with Pear's Mail class
	$params['host'] = $config['SMTP_HOST'];
	$params['port'] = $config['SMTP_PORT'];
	$params['auth'] = (int)$config['SMTP_AUTH'];
	$params['username'] = $config['SMTP_USER'];
	$params['password'] = $config['SMTP_PASS'];
}

if ( isset($_GET['template']) && $_GET['template'] != ''  ) {
	$skin_name = $_GET['template'];
	$_SESSION['skin_name'] = $skin_name;
	$config['skin_name'] = $skin_name;
	$_SERVER['QUERY_STRING'] = '';
}else if ( isset($_SESSION['skin_name']) && trim( $_SESSION['skin_name'] ) != '' ) {
	$skin_name = $_SESSION['skin_name'];
	$config['skin_name'] = $skin_name;
	$_SERVER['QUERY_STRING'] = '';
}else {
	$skin_name = $config['skin_name'];
}
if (!defined('TEMPLATE_C_DIR')) {
	define( 'TEMPLATE_C_DIR',  TEMP_DIR . 'templates_c/'.$skin_name.'/' );
}
if ( !is_dir( TEMPLATE_C_DIR ) ) {
	mkdir( TEMPLATE_C_DIR );
}

$config['use_popups'] = 'Y';


if (!defined('DEFAULT_COUNTRY'))  {
	define('DEFAULT_COUNTRY', $config['default_country']);
}

$skin_name = $config['skin_name'];
$lang['site_name'] = $config['site_name'];
define ('SITENAME', $config['site_name']);

if (isset($_REQUEST['lang']) && $_REQUEST['lang']!= '') {$opt_lang=$_REQUEST['lang'];}
elseif (isset($_SESSION['opt_lang']) && $_SESSION['opt_lang'] != '') {$opt_lang=str_replace("'",'',$_SESSION['opt_lang']);}
elseif (isset($_COOKIE[$config['cookie_prefix'].'opt_lang']) && $_COOKIE[$config['cookie_prefix'].'opt_lang'] != '') {$opt_lang=$_COOKIE[$config['cookie_prefix'].'opt_lang'];}
elseif (isset($_SESSION['AdminId']) && $_SESSION['AdminId'] > 0) { $opt_lang = $config['admin_lang']; }
else {$opt_lang=DEFAULT_LANG; }

// hack - fix later
if ( strlen( $opt_lang ) <= 3 ) {
	$opt_lang = DEFAULT_LANG;
}

// $langfile = LANG_DIR.$language_files[$opt_lang];
if (isset($_SERVER['HTTPS'])) {
	$HTTP = 'https://';
} else {
	$HTTP = 'http://';
}
define ('HTTP_METHOD', $HTTP);

$_SESSION['opt_lang'] = ($opt_lang=='')?'english':$opt_lang;
setcookie($config['cookie_prefix'].'opt_lang',$opt_lang,time()+60*60*24*365);

$t->template_dir = TEMPLATE_DIR . $skin_name.'/';
$t->compile_dir = TEMPLATE_C_DIR;
$t->cache_dir = CACHE_DIR;
// set the default handler and other values for caching and faster loading
$t->default_template_handler_func = 'getTplFile';
$t->caching = false;
$t->force_compile = false;
$t->register_prefilter("prefilter_getlang");
$t->compile_id=$_SESSION['opt_lang'];
$t->assign('DOC_ROOT', DOC_ROOT);

$t->assign ( 'config', $config );

define('SKIN_IMAGES_DIR', TEMPLATE_DIR.$skin_name.'/images/');

$lang['status_enum'] = get_lang_values('status_enum');

$lang['status_disp'] = get_lang_values('status_disp');

$lang['status_act'] = get_lang_values('status_act');

$lang['error_msg_color'] = 'red';

$lang['useronlinetext'] = get_lang_values('useronlinetext');

$lang['useronlinecolor'] = get_lang_values('useronlinecolor');

$lang['tz'] = get_lang_values('tz');

$lang['ENCODING'] = get_lang('ENCODING');

$lang['DIRECTION'] = get_lang('DIRECTION');

$lang['DATE_FORMAT'] = get_lang('DATE_FORMAT');

$_SESSION['datetime_month'] = get_lang('datetime_month');

$_SESSION['datetime_day'] = get_lang('datetime_day');

$t->assign( 'docroot', DOC_ROOT );
$t->assign( 'image_dir', DOC_ROOT.'templates/'.$skin_name.'/images/' );
$t->assign( 'css_path', DOC_ROOT.'templates/'.$skin_name.'/' );

$t->assign( 'lang', $lang );


?>