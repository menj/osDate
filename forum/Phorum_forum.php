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

// Change the users password
//
define( "PHORUM", "5.2.6a" );
$PHORUM = array();


read_config();

define('FORUM_PREFIX', table_prefix()); // ex. myBB_
define('FORUM_USER_TABLE',FORUM_PREFIX.'_users');
define('FORUM_SETTINGS_TABLE',FORUM_PREFIX.'_settings');

//define('FORUM_SESS_TABLE', FORUM_PREFIX . 'sessions');

define('FORUM_DOC_ROOT', doc_root(),'/' );  // ex. /myBB
define('FORUM_ADMIN_DIR', admin_dir() );  // ex. /myBB

include('forum_db.php');


// Makes sure we know were the forum is and that we have access to it's config files
//
function read_config() {

   global $config, $PHORUM;


   if ( check_forum_config() ) {

      include_once( config_file() );

      $url = parse_url( $config['forum_path'] );
      $constants = root_dir() . $url['path'] . '/include/constants.php';
      include_once( $constants );
	  $GLOBALS['table_prefix'] = table_prefix();
      $GLOBALS['forum_config']['dbtype']='mysql';
      $GLOBALS['forum_config']['hostname']=$GLOBALS['PHORUM']['DBCONFIG']['server'];
      $GLOBALS['forum_config']['username']=$GLOBALS['PHORUM']['DBCONFIG']['user'];
      $GLOBALS['forum_config']['password']=$GLOBALS['PHORUM']['DBCONFIG']['password'];
      $GLOBALS['forum_config']['database']=$GLOBALS['PHORUM']['DBCONFIG']['name'];

//      $tables = root_dir() . $url['path'] . '/include/db/' . $PHORUM['DBCONFIG']['type'] . '.php';
//      include_once( $tables );

   }

}
function table_prefix() {

   return $GLOBALS['PHORUM']['DBCONFIG']['table_prefix'];
}
function admin_dir() {

   return 'admin';
}
// Returns the path to the config file
//
function config_file() {

   global $config;

   $config_path = false;

   $root_dir = root_dir();

   if ( $root_dir ) {

     $url = parse_url( $config['forum_path'] );
     $path = $url['path'];

     $config_path = $root_dir . '/' . $path . '/include/db/config.php';
   }
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

        $data['password'] = md5( $newpass );

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
         $db->query("UPDATE ".FORUM_USER_TABLE." SET active = '".PHORUM_USER_ACTIVE."' WHERE username = '" . $username . "'");
   }
}
// Deletes a admin user user
// called from admin/manageadmin.php
// works
function forum_manageadmin($username) {

    global $db;

   if ( check_forum_config() ) {

         $db->query("DELETE FROM ".FORUM_USER_TABLE." WHERE username = '" . $username . "'");
   }
}
// Add the a admin user's account
// Called from admin/saveadmin.php
// works
function forum_saveadmin($username, $password, $userlevel) {

    global $db, $config;

   if ( check_forum_config() ) {

         // This is super admin level
         if ( $userlevel == 1 ) {

            $data['admin'] = 1;
         }
         // There's no moderator level so we just make them admin
         else {

            $data['admin'] = 1;
         }


         $data['username'] = $username;
         $data['password'] =  md5($password);
         $data['sessid_lt'] = $_SESSION['cookie_sessid_lt'] = md5(time());
         $data['sessid_st'] = '';
         $data['sessid_st_timeout'] = 0;
         $data['password_temp'] = substr(md5(microtime()), 0, 8);
         $data['email'] = $config['admin_email'];
         $data['email_temp'] = '';
         $data['hide_email'] = 1;
         $data['active'] = 1;
         $data['signature'] = '';
         $data['threaded_list'] = 0;
         $data['posts'] = 0;
         $data['threaded_read'] = 0;
         $data['date_added'] = time();
         $data['date_last_active'] = time();
         $data['last_active_forum'] = 0;
         $data['hide_activity'] = 0;
         $data['show_signature'] = 0;
         $data['email_notify'] = 0;
         $data['pm_email_notify'] = 1;
         $data['tz_offset'] = -99;
         $data['is_dst'] = 0;
         $data['user_language'] = '';
         $data['user_template'] = '';
         $data['moderator_data'] = '';
         $data['moderation_email'] = 1;

         $db->autoExecute(FORUM_USER_TABLE, $data);
         $user_id = $db->getOne("SELECT user_id FROM ".FORUM_USER_TABLE." WHERE username = '" . $username . "'" );

         $_SESSION['admin_forum_userid'] = $user_id;

   }
}
// Modify a users profile from the admin.
// Click Profile Management -> Click edit icon next to profile -> Change -> Submit
// done
function forum_modifyprofile($org_username, $username, $email) {

      global $db;

   if ( check_forum_config() ) {

         $data['username'] = $username;
         $data['email']    = $email;

         $db->autoExecute(FORUM_USER_TABLE, $data, DB_AUTOQUERY_UPDATE, "username = '" . $org_username . "'");
   }
}
// Deactivate the user's account
// Called from cancel.php
// done
function forum_cancel($username) {

    global $db;

   if ( check_forum_config() ) {

         // Change to Registered
         $db->query("UPDATE ".FORUM_USER_TABLE." SET active = '".PHORUM_USER_INACTIVE."' WHERE username = '" . $username . "'");
   }
}
// Change the password of the logged in user
// Called from modifympass.php
// done
function forum_modifympass( $newpass, $username) {

      global $db;

   if ( check_forum_config() ) {

         $db->query("UPDATE ".FORUM_USER_TABLE." SET password = '".md5($newpass)."' WHERE username = '" . $username . "'");
   }
}
// Activate registration
// Called from completereg.php
// done
function forum_completereg($username) {

      global $db;

   if ( check_forum_config() ) {

         // Change to Registered
         $db->query("UPDATE ".FORUM_USER_TABLE." SET active = '".PHORUM_USER_ACTIVE."' WHERE username = '" . $username . "'");
   }
}
// Add the user account after signing up
// called from savesignup.php
// done
function forum_savesignup($username, $password, $email) {

   global $db;

   if ( check_forum_config() ) {

         $data['username'] = $username;
         $data['password'] =  md5($password);
         $data['sessid_lt'] = $_SESSION['cookie_sessid_lt'] = md5(time());
         $data['sessid_st'] = '';
         $data['sessid_st_timeout'] = 0;
         $data['password_temp'] = substr(md5(microtime()), 0, 8);
         $data['email'] = $email;
         $data['email_temp'] = '';
         $data['hide_email'] = 1;
         $data['active'] = 1;
         $data['signature'] = '';
         $data['threaded_list'] = 0;
         $data['posts'] = 0;
         $data['admin'] = 0;
         $data['threaded_read'] = 0;
         $data['date_added'] = time();
         $data['date_last_active'] = time();
         $data['last_active_forum'] = 0;
         $data['hide_activity'] = 0;
         $data['show_signature'] = 0;
         $data['email_notify'] = 0;
         $data['pm_email_notify'] = 1;
         $data['tz_offset'] = -99;
         $data['is_dst'] = 0;
         $data['user_language'] = '';
         $data['user_template'] = '';
         $data['moderator_data'] = '';
         $data['moderation_email'] = 1;

         $db->autoExecute(FORUM_USER_TABLE, $data);
         $user_id = $db->getOne("SELECT user_id FROM ".FORUM_USER_TABLE." WHERE username = '" . $username . "'" );
		$_SESSION['user_forum_userid'] = $user_id;

   }
}


// Creates a session record in the mybb database
//
function forum_adminLogin() {

      global $db,$PHORUM;

    if ( check_forum_config() ) {

     $time = time();

      $sql = "SELECT user_id,sessid_lt as cookie_sessid_lt FROM ".FORUM_USER_TABLE." WHERE username = '". $_SESSION['UserName'] ."'";

      $user = $db->getRow($sql);

	if (!isset($user) || $user == '') {
		/* IF this admin record is not added. Add now...    */

		forum_saveadmin($_SESSION['UserName'],base64_decode($_SESSION['whatIneed']),1);

		$user['user_id'] = $_SESSION['admin_forum_userid'];

		$user['cookie_sessid_lt'] = $_SESSION['cookie_sessid_lt'];

	}


      $sql = "UPDATE ".FORUM_USER_TABLE." SET date_last_active = '" . $time . "' WHERE user_id = '" . $user['user_id'] . "' ";

      $db->query( $sql );


      $sql = "SELECT data FROM ".FORUM_SETTINGS_TABLE." WHERE name = 'admin_session_salt'";

      $admin_salt = $db->getOne($sql);

      setcookie('phorum_admin_session', $user['user_id'].":".md5($user['cookie_sessid_lt'].$admin_salt), 0, '/');

      $admin_path = FORUM_DOC_ROOT ;
      header('Location: '.HTTP_METHOD. $_SERVER['HTTP_HOST'] . $admin_path . '/admin.php');
   }

}

function forum_userLogin() {

      global $db;

   if ( check_forum_config() ) {

      $time = time();

      $sql = "SELECT user_id,sessid_lt as cookie_sessid_lt FROM ".FORUM_USER_TABLE." WHERE username = '". $_SESSION['UserName'] ."'";

      $user = $db->getRow($sql);

	if (!isset($user) || $user == '') {
		/* IF this admin record is not added. Add now...    */

		forum_savesignup($_SESSION['UserName'],base64_decode($_SESSION['whatIneed']),$_SESSION['email']);

		$user['user_id'] = $_SESSION['user_forum_userid'];
		$user['cookie_sessid_lt'] = $_SESSION['cookie_sessid_lt'];
	}


      $sql = "UPDATE ".FORUM_USER_TABLE." SET date_last_active = '" . $time . "' WHERE user_id = '" . $user['user_id'] . "' ";

      $db->query( $sql );

      setcookie('phorum_session_v5', $user['user_id'].":".$user['cookie_sessid_lt'], 0, '/');

         $home = FORUM_DOC_ROOT . '/index.php';;
      header('Location: '.HTTP_METHOD . $_SERVER['HTTP_HOST'] . $home );

   }
}


?>