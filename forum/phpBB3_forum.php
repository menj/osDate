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

// intialize global in global context
//
$table_prefix = false;

define('IN_PHPBB',1);

read_config();
define('FORUM_PREFIX', table_prefix()); // ex. myBB_
define('FORUM_USER_TABLE', FORUM_PREFIX.'users');
define('FORUM_USER_GROUP_TABLE', FORUM_PREFIX.'user_group');
define('FORUM_SESS_TABLE', FORUM_PREFIX.'sessions');
define('FORUM_CONFIG_TABLE', FORUM_PREFIX.'config');

define('FORUM_DOC_ROOT', doc_root() );  // ex. /myBB
define('FORUM_ADMIN_DIR', admin_dir() );  // ex. /myBB

include('forum_db.php');
include('includes/utf/utf_tools.php');

$browser = (!empty($_SERVER['HTTP_USER_AGENT'])) ? htmlspecialchars((string) $_SERVER['HTTP_USER_AGENT']) : '';

$client_ip = ( !empty($HTTP_SERVER_VARS['REMOTE_ADDR']) ) ? $HTTP_SERVER_VARS['REMOTE_ADDR'] : ( ( !empty($HTTP_ENV_VARS['REMOTE_ADDR']) ) ? $HTTP_ENV_VARS['REMOTE_ADDR'] : getenv('REMOTE_ADDR') );

$cookie_name = $db->getOne('select config_value from '.FORUM_CONFIG_TABLE." where config_name = 'cookie_name'");

// Makes sure we know were the forum is and that we have access to it's config files
//
function read_config() {

   global $phpEx, $config, $table_prefix;

   if ( check_forum_config() ) {

      include_once( config_file() );
      $url = parse_url( $config['forum_path'] );

//      $constants = root_dir() . $url['path'] . '/includes/constants.php';
//      include_once( $constants );

	  $GLOBALS['phpEx'] = 'php';
	  $GLOBALS['phpbb_root_path'] = root_dir() . $url['path'] . '/';

	  $GLOBALS['table_prefix'] = $table_prefix;
      $GLOBALS['forum_config']['dbtype']='mysql';
      $GLOBALS['forum_config']['hostname']=$dbhost;
      $GLOBALS['forum_config']['username']=$dbuser;
      $GLOBALS['forum_config']['password']=$dbpasswd;
      $GLOBALS['forum_config']['database']=$dbname;

   }
}
function table_prefix() {

   return $GLOBALS['table_prefix'];
}
function admin_dir() {

   return 'adm';
}
// Returns the path to the config file
//
function config_file() {

   global $config;


   $config_path = false;

   $root_dir = root_dir();

   $config_path = $root_dir . '/' . $config['forum_path'] . '/config.php';

   $config_path = str_replace('//','/', $config_path);

   return $config_path;
}
// In Admin, click Change Password -> Submit
// Called from admin/modifypwd.php by clicking submit on
//
// done
function forum_modifypwd($username, $newpass) {

      global $db;

   if ( check_forum_config() ) {

         $data['user_password']    = md5($newpass);

         $db->autoExecute(FORUM_USER_TABLE, $data, DB_AUTOQUERY_UPDATE, "username = '" . $username . "'");
   }
}
// Set the users account to active.
// Called from admin/reactivate.php
// done
function forum_reactivate($username) {

      global $db;

   if ( check_forum_config() ) {

         // Change to Registered
         $db->query("UPDATE ".FORUM_USER_TABLE." SET user_active = '1' WHERE username = '" . $username . "'");
   }
}
// Deletes a admin user user
// called from admin/manageadmin.php
// works
function forum_manageadmin($username) {

    global $db;

   if ( check_forum_config() ) {

      // Get the user id
      $user_id = $db->getOne("SELECT user_id FROM ".FORUM_USER_TABLE." WHERE username = '" . $username . "'");

      $group_id = $db->getOne("SELECT group_id FROM ".USER_GROUP_TABLE." WHERE user_id = '" . $user_id . "'");






      // If the user id is found, delete the user
      if ( $user_id > 0 ) {

         $db->query("DELETE FROM ".FORUM_USER_TABLE." WHERE user_id = '" . $user_id . "'");

         $db->query("DELETE FROM ".USER_GROUP_TABLE." WHERE user_id = '" . $user_id . "'");

         $db->query("DELETE FROM ".GROUPS_TABLE." WHERE group_id = '" . $group_id . "'");

		 $db->query("UPDATE ! SET poster_id = ?, post_username = ? WHERE poster_id = ?", array(POSTS_TABLE, DELETED, $username, $user_id));
      }
   }
}
// Add the a admin user's account
// Called from admin/saveadmin.php
// works
function forum_saveadmin($username, $password, $userlevel) {

    global $db, $client_ip, $cookie_name;

   if ( check_forum_config() ) {


         // Get the user id
         $user_id = $db->getOne("SELECT MAX(user_id) AS user_id FROM ".FORUM_USER_TABLE."" );


         $data['user_id']    = $user_id+1;
         $data['username']    = $username;
		 $data['username_clean'] = utf8_clean_string($username); // NEW
         $data['user_type']    = '3';
         $data['group_id']    = '5';
         $data['user_password']    = md5($password);
         $data['user_lastvisit']    = 0;
         $data['user_regdate']    = time();
         $data['user_ip']    = $client_ip;
         $data['user_posts']    = 0;
         $data['user_timezone']    = '0.00';
         $data['user_style']    = 1;
         $data['user_lang']    = 'english';
         $data['user_dateformat']    = 'D M d, Y g:i a';
         $data['user_new_privmsg']    = 0;
         $data['user_unread_privmsg']    = 0;
         $data['user_last_privmsg']    = 0;
         $data['user_allow_massemail']    = 1;
         $data['user_allow_viewemail']    = 1;
         $data['user_allow_pm']    = 1;
         $data['user_allow_viewonline']    = 1;
         $data['user_notify']    = 0;
         $data['user_notify_pm']    = 1;
         $data['user_avatar']    = '';
         $data['user_avatar_type']    = 0;
         $data['user_email']    = $config['admin_email'];
         $data['user_icq']    = '';
         $data['user_website']    = '';
         $data['user_from']    = '';
         $data['user_sig']    = '';
         $data['user_sig_bbcode_uid']    = '';
         $data['user_aim']    = '';
         $data['user_yim']    = '';
         $data['user_msnm']    = '';
         $data['user_occ']    = '';
         $data['user_interests']    = '';
         $data['user_actkey']    = '';

         $db->autoExecute(FORUM_USER_TABLE, $data);

		/* Admins. in 3 groups 2, 4 and 5 */
		$qr = "insert into ! (user_id, group_id) values (?,?)";
         $db->query($qr,array(FORUM_USER_GROUP_TABLE,$user_id+1, 2 ));
         $db->query($qr,array(FORUM_USER_GROUP_TABLE,$user_id+1, 4 ));
         $db->query($qr,array(FORUM_USER_GROUP_TABLE,$user_id+1, 5 ));

         $_SESSION['admin_forum_userid'] = $user_id+1;
   }
}
// Modify a users profile from the admin.
// Click Profile Management -> Click edit icon next to profile -> Change -> Submit
// done
function forum_modifyprofile($org_username, $username, $email) {

      global $db;

   if ( check_forum_config() ) {

         $data['username'] = $username;
         $data['user_email']    = $email;

         $db->autoExecute(FORUM_USER_TABLE, $data, DB_AUTOQUERY_UPDATE, "username = '" . $org_username . "'");
   }
}
// Deactivate the user's account
// Called from cancel.php and from profile.php in Admin->Profile management
// done
function forum_cancel($username) {

    global $db;

   if ( check_forum_config() ) {

         // Change to Registered
         $db->query("UPDATE ".FORUM_USER_TABLE." SET user_actkey = '0' WHERE username = '" . $username . "'");
   }
}
// Change the password of the logged in user
// Called from modifympass.php
// done
function forum_modifympass( $newpass, $username) {

      global $db;

   if ( check_forum_config() ) {

         $db->query("UPDATE ".FORUM_USER_TABLE." SET user_password = '".md5($newpass)."' WHERE username = '" . $username. "'");
   }
}
// Activate registration
// Called from completereg.php
// done
function forum_completereg($username) {

      global $db;

   if ( check_forum_config() ) {

         // Change to Registered
         $db->query("UPDATE ".FORUM_USER_TABLE." SET user_actkey = '1' WHERE username = '" . $username . "'");
   }
}
// Add the user account after signing up
// called from savesignup.php
// done
function forum_savesignup($username, $password, $email) {



   global $db;

   if ( check_forum_config() ) {


		// Get the user id
		$user_id = $db->getOne("SELECT MAX(user_id) AS user_id FROM ".FORUM_USER_TABLE."" );

		$data['user_id']				= $user_id +1;
//		$data['user_type']				= '3';
		$data['user_type']				= '0'; // CHANGED
		$data['group_id']				= '2';
		$data['username']				= $username;
		$data['username_clean'] = utf8_clean_string($username); // NEW
		$data['user_password']			= md5($password);
		$data['user_permissions']		= ''; // NEW
		$data['user_lastvisit']			= 0;
		$data['user_regdate']			= time();
		$data['user_posts']				= 0;
		$data['user_timezone']			= '0.00';
		$data['user_style']				= 1;
//		$data['user_lang']				= 'english';
		$data['user_lang']				= 'en';	// CHANGED
		$data['user_dateformat']		= 'D M d, Y g:i a';
		$data['user_new_privmsg']		= 0;
		$data['user_unread_privmsg']	= 0;
		$data['user_last_privmsg']		= 0;
		$data['user_allow_massemail']	= 1;
		$data['user_allow_viewemail']	= 1;
		$data['user_allow_pm']			= 1;
		$data['user_allow_viewonline']	= 1;
		$data['user_notify']			= 0;
		$data['user_notify_pm']			= 1;
		$data['user_rank']				= 0;
		$data['user_avatar']			= '';
		$data['user_avatar_type']		= 0;
		$data['user_email']				= $email;
		$data['user_icq']				= '';
		$data['user_website']			= '';
		$data['user_from']				= '';
		$data['user_sig']				= '';
		$data['user_sig_bbcode_uid']	= '';
		$data['user_aim']				= '';
		$data['user_yim']				= '';
		$data['user_msnm']				= '';
		$data['user_occ']				= '';
		$data['user_interests']			= '';
		$data['user_actkey']			= '';
		$data['user_options']= 895;
		$db->autoExecute(FORUM_USER_TABLE, $data);


         // Create group table entry.  I don't know why but the real prgram does this
         //

		// NEW
		$data01['group_id']				= '2';
		$data01['user_id']				= $user_id +1;
		$data01['group_leader']			= '0';
		$data01['user_pending']			= '0';
		$db->autoExecute(FORUM_USER_GROUP_TABLE, $data01);



		 $_SESSION['user_forum_userid'] = $user_id+1;

		// NEW
		$db->query( "UPDATE ".FORUM_CONFIG_TABLE." SET config_value ='" . $username . "' where config_name = 'newest_username'");
		$db->query( "UPDATE ".FORUM_CONFIG_TABLE." SET config_value = $user_id+1 where config_name = 'newest_user_id'");
		$db->query( "UPDATE ".FORUM_CONFIG_TABLE." SET config_value = config_value +1 where config_name = 'num_users'");
   }
}
// Creates a session record in the phpBB database
//
function forum_adminLogin() {

      global $db, $t, $config, $client_ip, $browser, $cookie_name;

//	  setcookie($cookie_name.'_sid',"",time()-3600);
 //     setcookie($cookie_name.'_u', "", time()-3600);

	if ( check_forum_config() ) {

      $sid = 0;
      srand ((double) microtime() * 1000000);

      $Puddle = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

      for($index=0; $index < 31; $index++){
         $sid .= substr($Puddle, (rand()%(strlen($Puddle))), 1);
      }
	  $sid = md5($sid);

      setcookie($cookie_name.'_sid', $sid, time()+21600, FORUM_DOC_ROOT);

      $user_ip = $client_ip;

      $sql = "SELECT user_id FROM ".FORUM_USER_TABLE." WHERE username = '". $_SESSION['UserName'] ."'";

      $user = $db->getOne($sql);

	  if (!isset($user) || $user == '') {
		/* IF this admin record is not added. Add now...    */

		forum_saveadmin($_SESSION['UserName'],base64_decode($_SESSION['whatIneed']),1);

		$user = $_SESSION['admin_forum_userid'];

	  }
      setcookie($cookie_name.'_u', $sid, time()+21600, FORUM_DOC_ROOT);

      $time = time();


		$sql = "INSERT INTO ".FORUM_SESS_TABLE." ( session_id, session_user_id, session_start, session_time, session_ip, session_autologin, session_admin, session_page, session_browser) VALUES ( '" . $sid . "', '" . $user . "', '" . $time . "', '" . $time . "', '" . $user_ip . "', '1', '1' ,'adm\/index.php','".substr($browser,0,149)."')";

      $db->query( $sql );

      $admin_path = FORUM_DOC_ROOT .'/'. FORUM_ADMIN_DIR;


	  if ($config['forum_display_in_same_window'] == 'Y') {

		if ($config['flashbb_installed']=='Y' ) {
			/* Flashbb installed. */
			define('IN_LOGIN', true);
		  $t->assign("forumURL", FORUM_DOC_ROOT.'/flashbb/');
		} else {

		  $t->assign("forumURL", $admin_path . '/index.php?sid=' . $sid);
		}
		  $t->assign("rendered_page", $t->fetch("forum_iframe.tpl") );

		  $t->display("admin/index.tpl");
	  } else {
		if ($config['flashbb_installed']=='Y' ) {
			define('IN_LOGIN', true);
			/* Flashbb installed. */
		  header('Location: '.HTTP_METHOD . $_SERVER['HTTP_HOST'] . FORUM_DOC_ROOT.'/flashbb/');
		} else {
	      header('Location: '.HTTP_METHOD . $_SERVER['HTTP_HOST'] . $admin_path . '/index.php?sid=' . $sid );
		}
	  }
   }
}


function forum_userLogin() {

	global $db, $t, $config, $client_ip, $browser, $cookie_name;

	  setcookie($cookie_name.'_sid',"",time()-3600);
      setcookie($cookie_name.'_u', "", time()-3600);

	if ( check_forum_config() ) {

		$sid = 0;
		srand ((double) microtime() * 1000000);

		$Puddle = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

		for($index=0; $index < 31; $index++){
			$sid .= substr($Puddle, (rand()%(strlen($Puddle))), 1);
		}

		$sid = md5($sid);

		$user_ip = $client_ip;

		$sql = "SELECT user_id FROM ".FORUM_USER_TABLE." WHERE username = '". $_SESSION['UserName'] ."'";

		$user = $db->getOne($sql);

      setcookie($cookie_name.'_sid', $sid, time()+21600, FORUM_DOC_ROOT);

		if (!isset($user) || $user == '') {
			/* IF this admin record is not added. Add now...    */

			forum_savesignup($_SESSION['UserName'],base64_decode($_SESSION['whatIneed']),$_SESSION['email']);

			$user = $_SESSION['user_forum_userid'];

		}
      setcookie($cookie_name.'_u', $sid, time()+21600, FORUM_DOC_ROOT);
		$time = time();

		// NEW
		$row = $db->getRow( "select user_lastvisit FROM ".FORUM_USER_TABLE." WHERE username = '". $_SESSION['UserName'] ."'");

		// CHANGED
		$sql = "INSERT INTO ".FORUM_SESS_TABLE." ( session_id, session_user_id, session_start, session_time, session_ip, session_autologin, session_admin, session_page, session_browser, session_viewonline, session_last_visit) VALUES ( '" . $sid . "', '" . $user . "', '" . $time . "', '" . $time . "', '" . $user_ip . "', '1', '0' ,'index.php','".substr($browser,0,149)."','1', '".$row['user_lastvisit']."')";

		$db->query( $sql );

		$db->query( "update ".FORUM_USER_TABLE. " set user_lastvisit = ".$time." WHERE username = '". $_SESSION['UserName'] ."'");

		if ($config['forum_display_in_same_window'] == 'Y') {
			if ($config['flashbb_installed']=='Y' ) {
				define('IN_LOGIN', true);
				$t->assign("forumURL", FORUM_DOC_ROOT.'/flashbb/');
			} else {
				$t->assign("forumURL", FORUM_DOC_ROOT . '/index.php?sid=' . $sid );
			}
			$t->assign("rendered_page", $t->fetch("forum_iframe.tpl") );

			$t->display("index.tpl");
		} else {
			if ($config['flashbb_installed']=='Y' ) {
				define('IN_LOGIN', true);
				/* Flashbb installed. */
				header('Location: '.HTTP_METHOD . $_SERVER['HTTP_HOST'] . FORUM_DOC_ROOT.'/flashbb/');
			} else {
				$home = FORUM_DOC_ROOT . '/index.php';
				header('Location: '.HTTP_METHOD . $_SERVER['HTTP_HOST'] . $home . '?sid=' . $sid  );
			}
		}
	}
}


?>