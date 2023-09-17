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

define ('FULL_PATH', dirname(__FILE__).'/');

session_start();

if (!is_readable(FULL_PATH.'temp/myconfigs/config.php') ) {
	if (is_readable('install.php')){
		header("location: install.php");
	} else {
		header("location: ../install.php");
	}
}

if (file_exists(FULL_PATH.'temp/myconfigs/config.php')) {
	require_once( FULL_PATH.'temp/myconfigs/config.php' );
} else {
	echo (FULL_PATH.'temp/myconfigs/config.php is missing..<br />');
	exit;
}

if(!isset($_SERVER)) $_SERVER=$GLOBALS['_SERVER'];

if ( !OSDATE_INSTALLED ) {
	die ( '<font face=Arial size=2>osDate is not installed, or a previous installation was not successfully completed.<br /><br />Please run <a href=install.php>install.php</a> to use osDate. You will need your database login parameters, and the ability to set the permissions on various files and folders on your server.</font>' );
}

require_once SMARTY_DIR . 'Smarty.class.php';
require_once FULL_PATH. 'libs/Smarty/osDate_Smarty.class.php';
// require_once PEAR_DIR . 'Mail.php';

require LIB_DIR . 'osDateDB.php';
require FULL_PATH.'includes/internal/Functions.php' ;
require_once PEAR_DIR . 'Compat.php';
PHP_Compat::loadFunction('file_get_contents');

$lang = array();

$BROWSER = new Browser;

$_SESSION['browser'] = $BROWSER->Name;


/************************/
// SECURITY CHECK
/************************/

if ( $_SERVER['HTTP_HOST'] != 'localhost' && ( file_exists( FULL_PATH.'install.php' ) || is_dir( FULL_PATH.'install_files' ) ) ) {

	echo '
	<br /><br /><br /><center>
	<table border=0 width=500 cellpadding=2 cellspacing=0>
		<tr>
			<td align=center>
				<font color=red face=Arial size=2><B>SECURITY ALERT<br /><br />Please remove the following from your server before continuing: install.php file, and the install_files folder. Then, click "Reload osDate" below to continue.<br /><br />

				<a href=index.php>Reload osDate</a></B></font>
			</td>
		</tr>
	</table></center>';

	exit;
}


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

if ( $config['MAIL_TYPE'] == 'smtp' ) {
	$params = array();// for mail sending with Pear's Mail class
	$params['host'] = $config['SMTP_HOST'];
	$params['port'] = $config['SMTP_PORT'];
	$params['auth'] = (int)$config['SMTP_AUTH'];
	$params['username'] = $config['SMTP_USER'];
	$params['password'] = $config['SMTP_PASS'];
}

hasRight('');

if (!isset($_SESSION['countries_with_zips'])) {
	$zipscntry = $osDB->getAll('select countrycode, count(*) as cnt from ! group by countrycode',array(ZIPCODES_TABLE) ); 
	$countries_with_zips = array();	
	if (isset($zipscntry)) {
		foreach ($zipscntry as $zrec) {
			$countries_with_zips[$zrec['countrycode']] = $zrec['cnt'];
		}
		unset($zipscntry);
	}

	$_SESSION['countries_with_zips'] = $countries_with_zips;
}

/* Select country based on IP of the visiting user */
if ( !isset($_SESSION['iplocation'])) {

    if (getenv('HTTP_X_FORWARDED_FOR')) {
        $ipaddr = getenv('HTTP_X_FORWARDED_FOR');
    } else {
        $ipaddr = getenv('REMOTE_ADDR');
    }

	$_SESSION['iplocation'] = getIPLocation($ipaddr);
	if (!isset($_SESSION['iplocation']['country_code'])) $_SESSION['iplocation']['country_code']=''; 
	if (!isset($_SESSION['iplocation']['state_name'])) $_SESSION['iplocation']['state_name']=''; 
	if (!isset($_SESSION['iplocation']['city_name'])) $_SESSION['iplocation']['city_name']=''; 
	if (!isset($_SESSION['iplocation']['state_code'])) $_SESSION['iplocation']['state_code']=''; 
	if (!isset($_SESSION['iplocation']['city_code'])) $_SESSION['iplocation']['city_code']=''; 

	if (isset($_SESSION['iplocation']) && isset($_SESSION['iplocation']['country_code']) && $_SESSION['iplocation']['country_code'] != ''  ) {
		if (isset($_SESSION['iplocation']['state_name']) && $_SESSION['iplocation']['state_name'] != '') {
			$ipstate_row = $osDB->getRow('select * from ! where countrycode = ? and lower(name) = lower(?)', array(STATES_TABLE, $_SESSION['iplocation']['country_code'], $_SESSION['iplocation']['state_name']) );

			if (isset($ipstate_row['code']) && $ipstate_row['code'] != '') {
				$_SESSION['iplocation']['state_code'] = $ipstate_row['code'];
			} else {
				$_SESSION['iplocation']['state_code'] = '';
			}
			
			if ($_SESSION['iplocation']['state_code'] != '' && isset($_SESSION['iplocation']['city_name']) && $_SESSION['iplocation']['city_name'] != '') {
				$ipcity_row = $osDB->getRow('select * from ! where countrycode = ? and statecode = ? and lower(name) = lower(?)', array(CITIES_TABLE, $_SESSION['iplocation']['country_code'], $_SESSION['iplocation']['state_code'], $_SESSION['iplocation']['city_name']) );
				if (isset($ipcity_row['code']) && $ipcity_row['code'] != '') {
					$_SESSION['iplocation']['city_code'] = $ipcity_row['code'];
				} else {
					$_SESSION['iplocation']['city_code'] = '';
				}
			}
		}

		if (isset($countries_with_zips[$_SESSION['iplocation']['country_code']]) && $countries_with_zips[$_SESSION['iplocation']['country_code']] > 0) {
			$_SESSION['iplocation']['zipscnt']=1;
		} else {
			$_SESSION['iplocation']['zipscnt']=0;
		}
	}

}

$t =& new osDate_Smarty;

/**********************************/
// STARTUP CONFIGURATION DATA
/**********************************/

$config['use_popups'] = 'Y';

if ( (isset($_SESSION['UserId']) && $_SESSION['UserId'] == '') || !isset($_SESSION['UserId']) || ($_SERVER['SCRIPT_NAME'] == DOC_ROOT.'showprofile.php' && $config['use_profilepopups'] == 'Y') ) {
	/* Cache checking enabled only for general public i.e. the user is not logged in */
	require_once FULL_PATH.'includes/internal/osdate_check_cache.php';
	/* Check for page caching now */
	/* if cached page was available, it would have closed the session there. */
}

if (!defined('DEFAULT_COUNTRY'))  {
	define('DEFAULT_COUNTRY', $config['default_country']);
}

if (!isset($_SESSION['from']) || $_SESSION['from'] == '') {
	if (isset($_SESSION['iplocation']['country_code']) && $_SESSION['iplocation']['country_code'] != '') {
		$_SESSION['from'] = $_SESSION['lookfrom'] = strtoupper($_SESSION['iplocation']['country_code']);
	} else {
		$_SESSION['from'] = $_SESSION['lookfrom'] = DEFAULT_COUNTRY;
	}
}

if (!isset($_SESSION['lookfrom']) || $_SESSION['lookfrom'] == '') {
	if (isset($_SESSION['iplocation']['country_code']) && $_SESSION['iplocation']['country_code'] != '') {
		$_SESSION['lookfrom'] = $_SESSION['simplesearch']['lookcountry']= strtoupper($_SESSION['iplocation']['country_code']);
	} else {
		$_SESSION['lookfrom'] = $_SESSION['simplesearch']['lookcountry'] = DEFAULT_COUNTRY;
	}
}

if (!isset($_SESSION['lookcountry']) || $_SESSION['lookcountry'] == '') {
	$_SESSION['lookcountry'] = $_SESSION['simplesearch']['lookcountry'] = $_SESSION['lookfrom'];
}
if (!isset($_SESSION['simplesearch']['lookcountry']) || $_SESSION['simplesearch']['lookcountry'] == '') {
	$_SESSION['simplesearch']['lookcountry'] = DEFAULT_COUNTRY;
}
if (isset( $_COOKIE[$config['cookie_prefix'].'osdate_info'] ) ) {

	$cookie = $_COOKIE[$config['cookie_prefix'].'osdate_info'];

	if (isset($cookie['search_ages']) ) {
		list($_SESSION['simplesearch']['lookagestart'], $_SESSION['simplesearch']['lookageend'])= explode(':',$cookie['search_ages']);
	}
}

$skin_name = $config['skin_name'];
$lang['site_name'] = $config['site_name'];
define ('SITENAME', $config['site_name']);

if (isset($_REQUEST['lang']) && $_REQUEST['lang']!= '') {$opt_lang=$_REQUEST['lang'];}
elseif (isset($_SESSION['opt_lang']) && $_SESSION['opt_lang'] != '') {$opt_lang=str_replace("'",'',$_SESSION['opt_lang']);}
elseif (isset($_COOKIE[$config['cookie_prefix'].'opt_lang']) && $_COOKIE[$config['cookie_prefix'].'opt_lang'] != '') {$opt_lang=$_COOKIE[$config['cookie_prefix'].'opt_lang'];}
elseif (isset($_SESSION['AdminId']) && $_SESSION['AdminId'] > 0) { $opt_lang = $config['admin_lang']; }
else {$opt_lang=get_prefered_language(); }

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

if (!isset($_SESSION['flashchat_installed']) ) {
/* Check if flashchat is installed or not. IF not installed, change the link */
	if (file_exists('./chat/chat.swf') || file_exists('./chat/chatui.swf') || file_exists('./chat/logger.swf')) {

	/* Change this to logger.swf for flashchat older versions. */

		$_SESSION['flashchat_installed'] = '1';

	} else {
		$_SESSION['flashchat_installed'] = '0';
	}
}

$_SESSION['spam_code_length'] = $config['spam_code_length'];

$_SESSION['opt_lang'] = ($opt_lang=='')?'english':$opt_lang;

setcookie($config['cookie_prefix'].'opt_lang',$opt_lang,time()+60*60*24*365);

if (isset($_SESSION['profile_questions']) ) unset($_SESSION['profile_questions']);

include('language/lang_'.$opt_lang.'/profile_questions.php');

$_SESSION['profile_questions'] = $profile_questions;

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
$config['siteurl'] = HTTP_METHOD . $_SERVER['SERVER_NAME'] . DOC_ROOT;

$t->assign('browsername',$BROWSER->Name);
$t->assign('browserversion',$BROWSER->Version);

$t->assign ( 'config', $config );

$t->assign('flashchat_installed', $_SESSION['flashchat_installed']);

define('SKIN_IMAGES_DIR', TEMPLATE_DIR.$skin_name.'/images/');

$agecounter = array();
$endyear = ($config['end_year'] < 0)?$config['end_year']*-1:$config['end_year'];
$startyear = ($config['start_year'] < 0)?$config['start_year']*-1:$config['start_year'];
for($i=$endyear; $i<=$startyear; $i++ ) {
	$agecounter[] = $i;
}
$lang['start_agerange'] = $agecounter;
$agecounter = array();
for($i=$startyear; $i>=$endyear; $i-- ) {
	$agecounter[] = $i;
}
$lang['end_agerange'] = $agecounter;
unset($agecounter);

if (!isset($_SESSION['loaded_languages'])) {
	$langs_loaded = $osDB->getAll('select distinct lang from !',array(LANGUAGE_TABLE) );

	$loaded_languages = array();

	foreach ($langs_loaded as $lng) {
		$loaded_languages[$lng['lang']] = $language_options[$lng['lang']];
	}
	unset($langs_loaded);
	$_SESSION['loaded_languages'] = $loaded_languages;

}

//require_once $langfile;

$lang['status_enum'] = get_lang_values('status_enum');

$lang['status_disp'] = get_lang_values('status_disp');

$lang['status_act'] = get_lang_values('status_act');

$lang['error_msg_color'] = 'red';

$lang['useronlinetext'] = get_lang_values('useronlinetext');

$lang['useronlinecolor'] = get_lang_values('useronlinecolor');

$lang['tz'] = get_lang_values('tz');

$t->assign('languages_options', $language_options);

$t->assign('loaded_languages', $_SESSION['loaded_languages']);

$t->assign('language_conversions', $language_conversion);

$t->assign('countries_with_zips', $_SESSION['countries_with_zips']);

$lang['ENCODING'] = get_lang('ENCODING');

$lang['DIRECTION'] = get_lang('DIRECTION');

$lang['DATE_FORMAT'] = get_lang('DATE_FORMAT');

$lang['search_results_per_page'] = get_lang_values('search_results_per_page');

$lang['enabled_values'] = get_lang_values('enabled_values');

$lang['forum_values'] = get_lang_values('forum_values');

$lang['support_currency'] = get_lang_values('support_currency');

$lang['signup_gender_values'] = get_lang_values('signup_gender_values');

$lang['signup_gender_look'] = get_lang_values('signup_gender_look');

$lang['recuring_labels'] = get_lang_values('recuring_labels');

$_SESSION['datetime_month'] = get_lang('datetime_month');

$_SESSION['datetime_day'] = get_lang('datetime_day');

/* MOD START */

$lang['mod_lowtohigh'] = get_lang_values('mod_lowtohigh');

if (strtoupper($lang['DIRECTION']) == 'RTL') {
	$t->assign('imgrtl','RTL');
}

/* MOD END */

/**********************************/
// GET CALENDARS
/**********************************/
if (( isset($_SESSION['UserId']) && $_SESSION['UserId'] != '' ) || substr_count($_SERVER['SCRIPT_NAME'],'calendar') > 0 ) {

	$temp = $osDB->getAll( 'select id, calendar from ! where enabled = ? order by displayorder asc', array( CALENDARS_TABLE, 'Y' ) );
	foreach( $temp as $index => $row ) {
		$calendars[ $row['id'] ] = $row['calendar'];
	}
	$t->assign( 'calendars', $calendars );

	// fix later....
	$temp = $osDB->getAll( 'select id, displayorder, calendar from !', array( CALENDARS_TABLE ) );
	foreach( $temp as $index => $row ) {
		$calendars[ $row['id'] ] = $row['calendar'];
	}
	$t->assign( 'allcalendars', $calendars );
	unset($temp, $calendars);
}


/**********************************/
// GET REGISTRATION SECTIONS
/**********************************/

if ((isset($_SESSION['UserId']) && $_SESSION['UserId'] != '') || (isset($_SESSION['AdminId']) && $_SESSION['AdminId'] != '' ) ) {
	if (isset($_SESSION['UserId']) && $_SESSION['UserId'] > 0 ) {
		$usr = $osDB->getRow('select id, active, status, level from ! where id = ?',array(USER_TABLE, $_SESSION['UserId'] ) ) ;
		if (isset($usr) && $usr['id'] == $_SESSION['UserId'] ) {
			$_SESSION['active'] = $usr['active'];
			$_SESSION['status'] = $usr['status'];
			$_SESSION['level'] = $usr['level'];
			hasRight('');
			unset($usr);
		}
	}

	$temp = $osDB->getAll( 'select id, section from ! where enabled = ?  order by displayorder asc', array( SECTIONS_TABLE, 'Y' ) );

	$sections = array();

	foreach( $temp as $index => $row ) {
		$qcnt = 1;
		if (isset($_SESSION['UserId']) && $_SESSION['UserId'] > 0 && !isset($_SESSION['AdminId'])) {
			$qcnt = $osDB->getOne("select count(*) from ! where section = ? and gender in (?,?)", array(QUESTIONS_TABLE,$row['id'], 'A', $_SESSION['gender']) );
		}
		if ($qcnt > 0) {
			if (isset($lang['sections']) ) {
				if (isset($lang['sections'][$row['id'] ]) && $lang['sections'][$row['id'] ] != '') {
					$sections[ $row['id'] ] = $lang['sections'][$row['id'] ];
				} else {
					$sections[ $row['id'] ] = get_lang('sections', $row['id']);
				}
			}
		}
	}

	$t->assign( 'sections', $sections );

	// fix later....
	$temp = $osDB->getAll('select id, displayorder, section from !', array( SECTIONS_TABLE ) );

	foreach( $temp as $index => $row ) {
		if (isset($lang['sections']) ) {
			if (isset($lang['sections'][$row['id'] ]) && $lang['sections'][$row['id'] ] != '') {
				$sections[ $row['id'] ] = $lang['sections'][$row['id'] ];
			} else {
				$sections[ $row['id'] ] = get_lang('sections', $row['id']);
			}

		}
		if (!isset($sections[$row['id']]) || $sections[$row['id']] == '') {
			$sections[$row['id']]=$row['section'];
		}
	}

	$t->assign( 'allsections', $sections );
	unset($temp);
}

/***********************************************/
// COUNTRIES & STATES - MOVE LATER & COLSOLIDATE
/***********************************************/

include_once(FULL_PATH.'countries_list.php');

$lang['countries'] = $countries;

$lang['allcountries'] = $allcountries;

unset($countries, $allcountries);

/**********************************/
// GET ONLINE USERS
/**********************************/
if (isset($_SESSION['UserId']) ) {
	$t->assign( 'online_users_count',$osDB->getOne('SELECT count(ou.userid) as onlineusers FROM ! ou, ! as user where ou.userid <> ifnull(?,-1) and ou.userid = user.id and user.allow_viewonline = ? and ou.lastactivitytime > ?', array( ONLINE_USERS_TABLE, USER_TABLE, $_SESSION['UserId'], '1', (time()-300) ) ) );
} else {
	$t->assign( 'online_users_count',$osDB->getOne('SELECT count(ou.userid) as onlineusers FROM ! ou, ! as user where ou.userid = user.id and user.allow_viewonline = ? and ou.lastactivitytime > ?', array( ONLINE_USERS_TABLE, USER_TABLE, '1', (time()-90) ) ) );
}

$t->assign( 'docroot', DOC_ROOT );
$t->assign( 'banner_dir', DOC_ROOT.'temp/banners/' );
// $t->assign( 'zodiac_dir', DOC_ROOT.'templates/'.$skin_name. '/zodiacsigns/' );
$t->assign( 'image_dir', DOC_ROOT.'templates/'.$skin_name.'/images/' );
$t->assign( 'css_path', DOC_ROOT.'templates/'.$skin_name.'/' );

if (!isset($_SESSION['AdminId'])) {
	include_once( 'polls.php' );
	include_once( 'stories.php' );
	include_once( 'news.php' );
	if ($config['display_list_of_events'] > 0) include_once( 'showevents.php' );

}

include_once(LIB_DIR.'blog_class.php');
$blog =& new Blog();
$t->assign( 'adminblog', $blog->getAllAdminStories('Y', $config['admin_blog_disp_cnt']));
$t->assign('userblog', $blog->getAllUserStories('Y',  $config['user_blog_disp_cnt']));


$time = time();

/**********************************/
// BANNERS
/**********************************/

$banner = array();

$index = 0;

$temp = $osDB->getAll( 'SELECT id FROM ! WHERE ( startdate <= ? AND  expdate >= ? ) AND enabled = ? and ( language is null or language = ?)', array( BANNER_TABLE, $time, $time, 'Y', $opt_lang ) );

if ( count( $temp ) > 0 ) {

	$j = 1;

	foreach( $temp as $index => $row ) {
		$banner[$j++] = $row['id'];
	}

	$my_banner = $banner[ rand( 1, --$j ) ];

	$bannerURL = $osDB->getOne( 'SELECT bannerurl FROM ! WHERE id = ?', array( BANNER_TABLE, $my_banner ) );

	$t->assign( 'banner', stripslashes( $bannerURL ) );
}

unset($temp);

/**********************************/
// UPDATE ONLINE STATUS and COLLECT USER STATS
/**********************************/

if (!isset($_SESSION['online_deleted'])) {
	$curr_session_id = session_id();

	$lastactivitytime = time() - ($config['session_timeout'] * 60);

	$temp = $osDB->getAll( 'SELECT * FROM ! where lastactivitytime < ?', array( ONLINE_USERS_TABLE, $lastactivitytime ) );

	if ( count( $temp ) > 0 ) {
		session_write_close();
		foreach( $temp as $index => $row ) {

			if ($row['session_id'] != '') {
				/* First destroy session */
				session_id($row['session_id']);
				session_start();
				session_destroy();
			}
			$osDB->query( 'DELETE FROM ! WHERE userid = ?', array( ONLINE_USERS_TABLE, $row['userid'] ) );
		}

		session_id($curr_session_id);
		session_start();
	}
	$_SESSION['online_deleted'] = '1';
	unset($temp);
}

if ( isset( $_SESSION['UserId'] ) && !isset($_SESSION['AdminId']) ) {

	if ($_SESSION['UserId'] > 0) {

		$isOnline = $osDB->getOne( 'SELECT count(*) FROM ! WHERE userid = ?', array( ONLINE_USERS_TABLE, $_SESSION['UserId'] ) );

		$curr_session_id = session_id();

		if( $isOnline == 0 ) {

			$osDB->query( 'INSERT INTO ! ( userid, lastactivitytime, session_id ) values (?, ?, ? )', array( ONLINE_USERS_TABLE, $_SESSION['UserId'], $time, $curr_session_id ) );
		}

		$t->assign('new_messages', $osDB->getOne('select count(*) from ! where owner=? and recipientid = ? and flagread = ? and folder = ?', array(MAILBOX_TABLE, $_SESSION['UserId'],$_SESSION['UserId'], '0', 'inbox') ) );
	}
}

$t->assign('opt_lang',$opt_lang);

$t->assign( 'lang', $lang );

$t->assign('simplesearch', $_SESSION['simplesearch']);

/* Now delete cache files */
deleteCache();

/***********************************/
/* Collect site statistics         */
/***********************************/

$t->assign( 'weekcnt',$osDB->getOne('select count(*) from ! where active = ? and regdate > ? and status in ( ?, ?) ', array( USER_TABLE, '1', strtotime("-7 day"), 'active', get_lang('status_enum','active') ) ) );

$row = $osDB->getRow( 'select sum(if(gender=\'M\',1,0)) as gents, sum(if(gender=\'F\',1,0)) as females, sum(if(gender=\'C\',1,0)) as couples from ! where active = ? and status in (?, ?)', array( USER_TABLE, '1', 'active', get_lang('status_enum','active')  ) );

$t->assign( 'gents', $row['gents'] );

$t->assign( 'females', $row['females'] );

$t->assign( 'couples', $row['couples'] );

unset($row);

$t->assign( 'weeksnaps', $osDB->getOne( 'select count(*) from ! where ins_time > ? ', array( USER_SNAP_TABLE, strtotime("-7 day") ) ) );

/**********************************/
// TOGGLE CHECK ONLINE STATUS
/**********************************/

if ( !isset( $_SESSION['LastExecTime'] ) || ( time() - $_SESSION['LastExecTime'] > 300 ) ) {

	$_SESSION['LastExecTime'] = time();
}

/**********************************/
// INCLUDE THE FORUM FUNCTIONS
/**********************************/

include_once( FORUM_DIR . 'forum_inc.php');


//Log code by Nathan Adams
$page = $_SERVER['REQUEST_URI'];
$IS_IN_ADMIN = strpos($page, 'admin');
if ($IS_IN_ADMIN === FALSE){
	if (strpos($page, 'allnews') > 0  || strpos($page, 'shownews') > 0) {$sql_page = 'allnews';}
	elseif (strpos($page, 'stories') > 0 || strpos($page, 'showstory') > 0) {$sql_page = 'stories';}
	else {
		$pos = strrpos($page, '/');
		$page_script = substr($page, $pos+1);

		$pos0 = strpos($page_script,'.');

		$sql_page = str_replace('.','',substr($page_script,0,$pos0+1));
	}

	if ($sql_page != 'getuser' && $sql_page != 'getinstantmsg'){
		if ($sql_page == ''){
			$sql_page = 'index';
		}
		addLog($sql_page);

/*		$check_page = $osDB->getOne ( 'SELECT page FROM ! WHERE page = ?', array ( LOG_TABLE, $sql_page ) );
		if ($check_page == $sql_page){ //ok it exists
			$query = $osDB->Query ( 'UPDATE ! SET visits = visits + 1 WHERE page = ?', array ( LOG_TABLE, $sql_page ) );
		} else {
			$osDB->Query ( "INSERT INTO ! (page, visits) VALUES (?, '1')", array ( LOG_TABLE, $sql_page ) );
		}  */
	}
}


/**********************************/
// Initialize Mod Osdate
/**********************************/

require_once MODOSDATE_DIR . 'modOsDate.php';

$mod =& new modOsDate();
// Build the mod osdate content into predefined Smarty variables

$mod->modSetContent();

function addLog($sql_page) {
	global $osDB;
	$check_page = $osDB->getOne ( 'SELECT page FROM ! WHERE page = ?', array ( LOG_TABLE, $sql_page ) );
	if ($check_page == $sql_page){ //ok it exists
		$query = $osDB->Query ( 'UPDATE ! SET visits = visits + 1 WHERE page = ?', array ( LOG_TABLE, $sql_page ) );
	} else {
		$osDB->Query ( "INSERT INTO ! (page, visits) VALUES (?, '1')", array ( LOG_TABLE, $sql_page ) );
	}
}

?>