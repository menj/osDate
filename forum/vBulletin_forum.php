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

read_config();

define('FORUM_PREFIX', table_prefix()); // ex. myBB_
define('FORUM_USER_TABLE', FORUM_PREFIX . 'user');
define('FORUM_SESS_TABLE', FORUM_PREFIX . 'session');
define('FORUM_CPSESS_TABLE', FORUM_PREFIX . 'cpsession');
define('FORUM_USERFIELDS_TABLE', FORUM_PREFIX . 'userfield');
define('FORUM_USERTEXTFIELDS_TABLE', FORUM_PREFIX . 'usertextfield');
define('FORUM_DATASTORE_TABLE', FORUM_PREFIX . 'datastore');

define('FORUM_DOC_ROOT', doc_root() );  // ex. /myBB
define('FORUM_ADMIN_DIR', admin_dir() );  // ex. /myBB

 include_once(str_replace('config.php','functions.php',config_file()));
// Makes sure we know were the forum is and that we have access to it's config files
//

include('forum_db.php');

function read_config() {

   if ( check_forum_config() ) {

      include_once( config_file() );

      $GLOBALS['forum_config'] = $config;
   }

  $GLOBALS['table_prefix'] = table_prefix();
  $GLOBALS['forum_config']['dbtype']='mysql';
  $GLOBALS['forum_config']['hostname']=$config['MasterServer']['servername'];
  $GLOBALS['forum_config']['username']=$config['MasterServer']['username'];
  $GLOBALS['forum_config']['password']=$config['MasterServer']['password'];
  $GLOBALS['forum_config']['database']=$config['Database']['dbname'];


}
function table_prefix() {

   return $GLOBALS['forum_config']['Database']['tableprefix'];
}
function admin_dir() {

   return 'admincp';
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

     $config_path = $root_dir . '/' . $path . '/includes/config.php';
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

         $salt = fetch_user_salt();
         $md5pw = md5($newpass);
         $storepw = md5($md5pw . $salt);

         $data['password'] = $storepw;
         $data['salt']     = $salt;

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
         $db->query("UPDATE ".FORUM_USER_TABLE." SET usergroupid = '3' WHERE username = '" . $username . "'");
   }
}
// Deletes a admin user user
// called from admin/manageadmin.php
// works
function forum_manageadmin($username) {

    global $db;

   if ( check_forum_config() ) {

      // Get the user id
      $user_id = $db->getOne("SELECT userid FROM ".FORUM_USER_TABLE." WHERE username = '" . $username . "'");

      // If the user id is found, delete the user
      if ( $user_id > 0 ) {

         $db->query("DELETE FROM ".FORUM_USER_TABLE." WHERE userid = '" . $user_id . "'");

         $db->query("DELETE FROM ".FORUM_USERFIELDS_TABLE." WHERE userid = '" . $user_id . "'");
      }
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

            $data['usergroupid'] = 6;
         }
         // This is a regular admin/moderator
         else {

            $data['usergroupid'] = 7;
         }

         $salt = fetch_user_salt();
         $md5pw = md5($password);
         $storepw = md5($md5pw . $salt);

         $data['membergroupids'] = '';
         $data['displaygroupid'] = 0;
         $data['username'] = $username;
         $data['password'] = $storepw;
         $data['passworddate'] = date("Y-m-d");
         $data['email'] = $config['admin_email'];
         $data['styleid'] = 0;
         $data['parentemail'] = '';
         $data['homepage'] = '';
         $data['icq'] = '';
         $data['aim'] = '';
         $data['yahoo'] = '';
         $data['msn'] = '';
         $data['skype'] = '';
         $data['showvbcode'] = 1;
         $data['showbirthday'] = 0;
         $data['usertitle'] = 'Administrator';
         $data['customtitle'] = 0;
         $data['joindate'] = time();
         $data['daysprune'] = 0;
         $data['lastvisit'] = time();
         $data['lastactivity'] = time();
         $data['lastpost'] = 0;
         $data['posts'] = 0;
         $data['reputation'] = 10;
         $data['reputationlevelid'] = 5;
         $data['timezoneoffset'] = '0';
         $data['pmpopup'] = 0;
         $data['avatarid'] = 0;
         $data['avatarrevision'] = 0;
         $data['profilepicrevision'] = 0;
         $data['options'] = 3159;
         $data['birthday'] = '';
         $data['birthday_search'] = '0000-00-00';
         $data['maxposts'] = -1;
         $data['startofweek'] = -1;
         $data['ipaddress'] = ip_addresss();
         $data['referrerid'] = 0;
         $data['languageid'] = 1;
         $data['emailstamp'] = 0;
         $data['threadedmode'] = 0;
         $data['autosubscribe'] = -1;
         $data['pmtotal'] = 0;
         $data['pmunread'] = 0;
         $data['salt'] = $salt;

         $db->autoExecute(FORUM_USER_TABLE, $data);

         $user_id = $db->getOne("SELECT userid FROM ".FORUM_USER_TABLE." WHERE username = '" . $username . "'" );

         $udata['userid'] = $user_id;

         $db->autoExecute(FORUM_USERFIELDS_TABLE, $udata);
         $db->autoExecute(FORUM_USERTEXTFIELDS_TABLE, $udata);
		 $members = $db->getRow('SELECT COUNT(*) AS users FROM ' . FORUM_USER_TABLE);

		 $values = array(
	        'numbermembers' => $members['users'],
	        'activemembers' => '0',
	        'newusername'   => $username,
	        'newuserid'     => $user_id
	     );

		 $db->query("UPDATE " .FORUM_DATASTORE_TABLE." SET unserialize = 1, data = '" .serialize($values). "' WHERE title = 'userstats'");

		 $_SESSION['forum_user_password'] = $storepw;
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
         $db->query("UPDATE ".FORUM_USER_TABLE." SET usergroupid = '1' WHERE username = '" . $username . "'");
   }
}
// Change the password of the logged in user
// Called from modifympass.php
// done
function forum_modifympass( $newpass, $username) {

      global $db;

   if ( check_forum_config() ) {

         $salt = fetch_user_salt();
         $md5pw = md5($newpass);
         $storepw = md5($md5pw . $salt);


         $db->query("UPDATE ".FORUM_USER_TABLE." SET password = '".$storepw."', salt='".$salt."' WHERE username = '" . $username . "'");
   }
}
// Activate registration
// Called from completereg.php
// done
function forum_completereg($username) {

      global $db;

   if ( check_forum_config() ) {

         // Change to Registered
         $db->query("UPDATE ".FORUM_USER_TABLE." SET usergroupid = '3' WHERE username = '" . $username . "'");
   }
}
// Add the user account after signing up
// called from savesignup.php
// done
function forum_savesignup($username, $password, $email) {

   global $db;

   if ( check_forum_config() ) {

         $salt = fetch_user_salt();
         $md5pw = md5($password);
         $storepw = md5($md5pw . $salt);


         $data['usergroupid'] = 3;  //Confirmed
         $data['membergroupids'] = '';
         $data['displaygroupid'] = 0;
         $data['username'] = $username;
         $data['password'] = $storepw;
         $data['passworddate'] = date("Y-m-d");
         $data['email'] = $email;
         $data['styleid'] = 0;
         $data['parentemail'] = '';
         $data['homepage'] = '';
         $data['icq'] = '';
         $data['aim'] = '';
         $data['yahoo'] = '';
         $data['msn'] = '';
         $data['skype'] = '';
         $data['showvbcode'] = 1;
         $data['showbirthday'] = 0;
         $data['usertitle'] = 'Junior Member';
         $data['customtitle'] = 0;
         $data['joindate'] = time();
         $data['daysprune'] = 0;
         $data['lastvisit'] = time();
         $data['lastactivity'] = time();
         $data['lastpost'] = 0;
         $data['posts'] = 0;
         $data['reputation'] = 10;
         $data['reputationlevelid'] = 5;
         $data['timezoneoffset'] = '0';
         $data['pmpopup'] = 0;
         $data['avatarid'] = 0;
         $data['avatarrevision'] = 0;
         $data['profilepicrevision'] = 0;
         $data['options'] = 3159;
         $data['birthday'] = '';
         $data['birthday_search'] = '0000-00-00';
         $data['maxposts'] = -1;
         $data['startofweek'] = -1;
         $data['ipaddress'] = ip_addresss();
         $data['referrerid'] = 0;
         $data['languageid'] = 1;
         $data['emailstamp'] = 0;
         $data['threadedmode'] = 0;
         $data['autosubscribe'] = -1;
         $data['pmtotal'] = 0;
         $data['pmunread'] = 0;
         $data['salt'] = $salt;

         $db->autoExecute(FORUM_USER_TABLE, $data);

         $user_id = $db->getOne("SELECT userid FROM ".FORUM_USER_TABLE." WHERE username = '" . $username . "'" );


         $udata['userid'] = $user_id;

         $db->autoExecute(FORUM_USERFIELDS_TABLE, $udata);
         $db->autoExecute(FORUM_USERTEXTFIELDS_TABLE, $udata);
		 $members = $db->getRow('SELECT COUNT(*) AS users FROM ' . FORUM_USER_TABLE);

		 $values = array(
	        'numbermembers' => $members['users'],
	        'activemembers' => '0',
	        'newusername'   => $username,
	        'newuserid'     => $user_id
	     );

		 $db->query("UPDATE " .FORUM_DATASTORE_TABLE." SET unserialize = 1, data = '" .serialize($values). "' WHERE title = 'userstats'");

		$_SESSION['user_forum_userid'] = $user_id;

		$_SESSION['forum_user_password'] = $storepw;
   }
}
// Creates a session record in the mybb database
//
function forum_adminLogin() {

      global $db;

   if ( check_forum_config() ) {

      $sid = 0;
      srand ((double) microtime() * 1000000);

      $Puddle = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

      for($index=0; $index < 30; $index++){
      $sid .= substr($Puddle, (rand()%(strlen($Puddle))), 1);
      }

      $sid = rand(1,9).$sid;

      setcookie('bbsessionhash', $sid, 0, '/');


      $client_ip = ( !empty($HTTP_SERVER_VARS['REMOTE_ADDR']) ) ? $HTTP_SERVER_VARS['REMOTE_ADDR'] : ( ( !empty($HTTP_ENV_VARS['REMOTE_ADDR']) ) ? $HTTP_ENV_VARS['REMOTE_ADDR'] : getenv('REMOTE_ADDR') );
      $user_ip = $client_ip;

         $alt_ip = fetch_alt_ip();

	$idhash = md5($_SERVER['HTTP_USER_AGENT'] . $alt_ip);

         $sql = "SELECT userid,password FROM ".FORUM_USER_TABLE." WHERE username = '". $_SESSION['UserName'] ."'";

         $user = $db->getRow($sql);

	if (!isset($user) || $user == '') {
		/* IF this admin record is not added. Add now...    */

		forum_saveadmin($_SESSION['UserName'],base64_decode($_SESSION['whatIneed']),1);

		$user['userid'] = $_SESSION['admin_forum_userid'];

		$user['password'] = $_SESSION['forum_user_password'];
	}


         $time = time();

         $user_agent = $_SERVER['HTTP_USER_AGENT'];

         $sql = "INSERT INTO ".FORUM_SESS_TABLE." ( sessionhash, userid, host, idhash, lastactivity, location, useragent, loggedin ) VALUES ( '" . $sid . "', '" . $user['userid'] . "', '" . $user_ip . "', '" . $idhash . "', '" . $time . "', '/vBulletin/', '" . $user_agent . "', '2' )";

         $db->query( $sql );

         $sql = "UPDATE ".FORUM_USER_TABLE." SET lastactivity = '" . $time . "' WHERE userid = '" . $user['userid'] . "' ";

         $db->query( $sql );

	$session_hash = md5($time . $_SERVER['PHP_SELF'] . $sid . $user_ip . rand(1, 1000000));

         $sql = "INSERT INTO ".FORUM_CPSESS_TABLE." ( userid, hash, dateline ) VALUES ( '" . $user['userid'] . "', '" . $session_hash . "', '" . $time . "' )";

         $db->query( $sql );

       setcookie('bbcpsession', $session_hash, 0, '/');
      setcookie('bbpassword', md5($user['password'].COOKIE_SALT), 0, '/');
      setcookie('bbuserid', $user['userid'], 0, '/');
      setcookie('bblastvisit', $time, 0, '/');
      setcookie('bblastactivity', $time, 0, '/');
	define('SESSION_IDHASH', $idhash);

      $admin_path = FORUM_DOC_ROOT .'/'. FORUM_ADMIN_DIR;
      header('Location: '.HTTP_METHOD . $_SERVER['HTTP_HOST'] . $admin_path . '/index.php');
   }
}

function forum_userLogin() {

      global $db;

   if ( check_forum_config() ) {

      $sid = 0;
      srand ((double) microtime() * 1000000);

      $Puddle = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

      for($index=0; $index < 30; $index++){
      $sid .= substr($Puddle, (rand()%(strlen($Puddle))), 1);
      }

      $sid = rand(1,9).$sid;

      setcookie('bbsessionhash', $sid, 0, '/');


      $client_ip = ( !empty($HTTP_SERVER_VARS['REMOTE_ADDR']) ) ? $HTTP_SERVER_VARS['REMOTE_ADDR'] : ( ( !empty($HTTP_ENV_VARS['REMOTE_ADDR']) ) ? $HTTP_ENV_VARS['REMOTE_ADDR'] : getenv('REMOTE_ADDR') );
      $user_ip = $client_ip;

         $alt_ip = fetch_alt_ip();

	$idhash = md5($_SERVER['HTTP_USER_AGENT'] . $alt_ip);

         $sql = "SELECT userid, password FROM ".FORUM_USER_TABLE." WHERE username = '". $_SESSION['UserName'] ."'";

         $user = $db->getRow($sql);

	if (!isset($user) || $user == '') {
		/* IF this admin record is not added. Add now...    */

		forum_savesignup($_SESSION['UserName'],base64_decode($_SESSION['whatIneed']),$_SESSION['email']);

		$user['userid'] = $_SESSION['user_forum_userid'];

		$user['password'] = $_SESSION['forum_user_password'];

	}

         $time = time();

         $user_agent = $_SERVER['HTTP_USER_AGENT'];

         $sql = "INSERT INTO ".FORUM_SESS_TABLE." ( sessionhash, userid, host, idhash, lastactivity, location, useragent, loggedin ) VALUES ( '" . $sid . "', '" . $user['userid'] . "', '" . $user_ip . "', '" . $idhash . "', '" . $time . "', '/vBulletin/', '" . $user_agent . "', '2' )";

         $db->query( $sql );

         $sql = "UPDATE ".FORUM_USER_TABLE." SET lastactivity = '" . $time . "' WHERE userid = '" . $user['userid'] . "' ";

         $db->query( $sql );

	     setcookie('bbpassword', md5($user['password'].COOKIE_SALT), 0, '/');
      	 setcookie('bbuserid', $user['userid'], 0, '/');
      	 setcookie('bblastvisit', $time, 0, '/');
      	 setcookie('bblastactivity', $time, 0, '/');
		 define('SESSION_IDHASH', $idhash);


         $home = FORUM_DOC_ROOT . '/index.php';;
      header('Location: '.HTTP_METHOD . $_SERVER['HTTP_HOST'] . $home );

   }
}

// Additional functions
//

function fetch_alt_ip()
{
         if (isset($_SERVER['HTTP_CLIENT_IP']))
         {
               $alt_ip = $_SERVER['HTTP_CLIENT_IP'];
         }
         else if (isset($_SERVER['HTTP_X_FORWARDED_FOR']) AND preg_match_all('#\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}#s', $_SERVER['HTTP_X_FORWARDED_FOR'], $matches))
         {
               // make sure we dont pick up an internal IP defined by RFC1918
               foreach ($matches[0] AS $ip)
               {
                        if (!preg_match("#^(10|172\.16|192\.168)\.#", $ip))
                        {
                                 $alt_ip = $ip;
                                 break;
                        }
               }
         }
         else if (isset($_SERVER['HTTP_FROM']))
         {
               $alt_ip = $_SERVER['HTTP_FROM'];
         }
         else
         {
               $alt_ip = $_SERVER['REMOTE_ADDR'];
         }

         return $alt_ip;
}
function fetch_user_salt($length = 3)
{
   $salt = '';
   for ($i = 0; $i < $length; $i++)
   {
      $salt .= chr(rand(32, 126));
   }
   return $salt;
}
function ip_addresss() {

      return ( !empty($HTTP_SERVER_VARS['REMOTE_ADDR']) ) ? $HTTP_SERVER_VARS['REMOTE_ADDR'] : ( ( !empty($HTTP_ENV_VARS['REMOTE_ADDR']) ) ? $HTTP_ENV_VARS['REMOTE_ADDR'] : getenv('REMOTE_ADDR') );
}
?>