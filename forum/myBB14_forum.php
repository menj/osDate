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
**********************************************/
// Change the users password
//
read_config();


define('FORUM_PREFIX', table_prefix()); // ex. myBB_
define('FORUM_USER_TABLE', FORUM_PREFIX . 'users');
define('FORUM_SESS_TABLE', FORUM_PREFIX . 'sessions');
define('FORUM_USERFIELDS_TABLE', FORUM_PREFIX . 'userfields');

define('FORUM_DOC_ROOT', doc_root() );  // ex. /myBB
define('FORUM_ADMIN_DIR', admin_dir() );  // ex. /myBB

include('forum_db.php');

// Makes sure we know were the forum is and that we have access to it's config files
//
function read_config() {

   if ( check_forum_config() ) {

      include_once( config_file() );
      $GLOBALS['forum_config']['dbtype']='mysql';
	  $GLOBALS['forum_config']['table_prefix'] = $config['database']['table_prefix'];
	  $GLOBALS['forum_config']['hostname'] = $config['database']['hostname'];
	  $GLOBALS['forum_config']['username'] = $config['database']['username'];
	  $GLOBALS['forum_config']['password'] = $config['database']['password'];
	  $GLOBALS['forum_config']['database'] = $config['database']['database'];
	  $GLOBALS['forum_config']['admin_dir'] = $config['admin_dir'];
	  $GLOBALS['table_prefix'] = table_prefix();

   }
}
function table_prefix() {

   return $GLOBALS['forum_config']['table_prefix'];
}
function admin_dir() {

   return '/'.$GLOBALS['forum_config']['admin_dir'];
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
     if (!defined('MYBB_ROOT')) {
		 define ('MYBB_ROOT', $root_dir.$path.'/');
	 }
     $config_path = $root_dir . $path . '/inc/config.php';
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

         $md5pwd = md5( $newpass );

         $salt = random_str(8);
         $md5pwd= md5(md5($salt).$md5pwd);

         $data['password'] = $md5pwd;
         $data['salt']     = $salt;
         $data['loginkey'] = random_str(50);

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
         $db->query("UPDATE ".FORUM_USER_TABLE." SET usergroup = '2' WHERE username = '" . $username . "'");
   }
}
// Deletes a admin user user
// called from admin/manageadmin.php
// works
function forum_manageadmin($username) {

    global $db;

   if ( check_forum_config() ) {

      // Get the user id
      $user_id = $db->getOne("SELECT uid FROM ".FORUM_USER_TABLE." WHERE username = '" . $username . "'");

      // If the user id is found, delete the user
      if ( $user_id > 0 ) {

         $db->query("DELETE FROM ".FORUM_USER_TABLE." WHERE uid = '" . $user_id . "'");

         $db->query("DELETE FROM ".FORUM_USERFIELDS_TABLE." WHERE ufid = '" . $user_id . "'");
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

            $data['usergroup'] = 4;
         }
         // This is a regular admin/moderator
         else {

            $data['usergroup'] = 3;
         }

         $md5pwd = md5( $password );
         $salt = random_str(8);
         $md5pwd= md5(md5($salt).$md5pwd);

         $data['username'] = $username;
         $data['password'] = $md5pwd;
         $data['salt']     = $salt;
         $data['loginkey'] = $_SESSION['loginkey'] = random_str(50);
         $data['email']    = $config['admin_email'];
         $data['postnum'] = 0;
         $data['avatar'] = '';
         $data['avatartype'] = 0;
         $data['additionalgroups'] = '';
         $data['displaygroup'] = 0;
         $data['usertitle'] = '';
         $data['regdate'] = time();
         $data['lastactive'] = time();
         $data['lastvisit'] = 0;
         $data['lastpost'] = 0;
         $data['website'] = '';
         $data['icq'] = 0;
         $data['aim'] = '';
         $data['yahoo'] = '';
         $data['msn'] = '';
         $data['birthday'] = '';
         $data['signature'] = '';
         $data['allownotices'] = 'yes';
         $data['hideemail'] = 'no';
         $data['invisible'] = 'no';
         $data['receivepms'] = 'yes';
         $data['pmnotify'] = 'no';
         $data['remember'] = 'yes';
         $data['threadmode'] = '';
         $data['showsigs'] = 'yes';
         $data['showavatars'] = 'yes';
         $data['showquickreply'] = 'yes';
         $data['ppp'] = 0;
         $data['tpp'] = 0;
         $data['daysprune'] = 0;
         $data['dateformat'] = '';
         $data['timeformat'] = '';
         $data['timezone'] = '';
         $data['dst'] = '';
         $data['buddylist'] = '';
         $data['ignorelist'] = '';
         $data['style'] = 0;
         $data['away'] = '';
         $data['awaydate'] = 0;
         $data['returndate'] = '';
         $data['awayreason'] = '';
         $data['pmfolders'] = '';
         $data['notepad'] = '';
         $data['referrer'] = 0;
         $data['reputation'] = 0;
         $data['regip'] = '';
         $data['lastip'] = '';
         $data['language'] = '';
         $data['timeonline'] = 0;
         $data['showcodebuttons'] = 1;
         $data['usergroup'] = '4';

         $db->autoExecute(FORUM_USER_TABLE, $data);

         $user_id = $db->getOne("SELECT uid FROM ".FORUM_USER_TABLE." WHERE username = '" . $username . "'" );

         $db->query("DELETE FROM ".FORUM_USERFIELDS_TABLE." WHERE ufid = '" . $user_id . "'");

         $db->query("INSERT INTO ".FORUM_USERFIELDS_TABLE." (ufid, fid1, fid2, fid3) VALUES ('" . $user_id . "','','','')");

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
         $db->query("UPDATE ".FORUM_USER_TABLE." SET usergroup = '5' WHERE username = '" . $username . "'");
   }
}
// Change the password of the logged in user
// Called from modifympass.php
// done
function forum_modifympass( $newpass, $username) {

      global $db;

   if ( check_forum_config() ) {

         $md5pwd = md5( $newpass );
         $salt = random_str(8);
         $md5pwd= md5(md5($salt).$md5pwd);

         $db->query("UPDATE ".FORUM_USER_TABLE." SET password = '".$md5pwd."', salt='".$salt."', loginkey='".random_str(50)."' WHERE username = '" . $username . "'");

   }
}
// Activate registration
// Called from completereg.php
// done
function forum_completereg($username) {

      global $db;

   if ( check_forum_config() ) {

         // Change to Registered
         $db->query("UPDATE ".FORUM_USER_TABLE." SET usergroup = '2' WHERE username = '" . $username . "'");
   }
}
// Add the user account after signing up
// called from savesignup.php
// done
function forum_savesignup($username, $password, $email) {

   global $db;

   if ( check_forum_config() ) {

         $md5pwd = md5( $password );
         $salt = random_str(8);
         $md5pwd= md5(md5($salt).$md5pwd);

         $data['username'] = $username;
         $data['password'] = $md5pwd;
         $data['salt']     = $salt;
         $data['loginkey'] = random_str(50);
         $data['email']    = $email;
         $data['postnum'] = 0;
         $data['avatar'] = '';
         $data['avatartype'] = 0;
         $data['usergroup'] = 2;
         $data['additionalgroups'] = '';
         $data['displaygroup'] = 0;
         $data['usertitle'] = '';
         $data['regdate'] = time();
         $data['lastactive'] = time();
         $data['lastvisit'] = 0;
         $data['lastpost'] = 0;
         $data['website'] = '';
         $data['icq'] = 0;
         $data['aim'] = '';
         $data['yahoo'] ='';
         $data['msn'] = '';
         $data['birthday'] = '';
         $data['signature'] = '';
         $data['allownotices'] = 'yes';
         $data['hideemail'] = 'no';
         $data['invisible'] = 'no';
         $data['receivepms'] = 'yes';
         $data['pmnotify'] = 'no';
         $data['remember'] = 'yes';
         $data['threadmode'] = '';
         $data['showsigs'] = 'yes';
         $data['showavatars'] = 'yes';
         $data['showquickreply'] = 'yes';
         $data['ppp'] = 0;
         $data['tpp'] = 0;
         $data['daysprune'] = 0;
         $data['dateformat'] = '';
         $data['timeformat'] = '';
         $data['timezone'] = '';
         $data['dst'] = '';
         $data['buddylist'] = '';
         $data['ignorelist'] = '';
         $data['style'] = 0;
         $data['away'] = '';
         $data['awaydate'] = 0;
         $data['returndate'] = '';
         $data['awayreason'] = '';
         $data['pmfolders'] = '';
         $data['notepad'] = '';
         $data['referrer'] = 0;
         $data['reputation'] = 0;
         $data['regip'] = '';
         $data['lastip'] = '';
         $data['language'] = '';
         $data['timeonline'] = 0;
         $data['showcodebuttons'] = 1;

         $db->autoExecute(FORUM_USER_TABLE, $data);

         $user_id = $db->getOne("SELECT uid FROM ".FORUM_USER_TABLE." WHERE username = '" . $username . "'" );

         $db->query("DELETE FROM ".FORUM_USERFIELDS_TABLE." WHERE ufid = '" . $user_id . "'");

         $db->query("INSERT INTO ".FORUM_USERFIELDS_TABLE." (ufid, fid1, fid2, fid3 ) VALUES ('" . $user_id . "','','','')");

		$_SESSION['user_forum_userid'] = $user_id;

		$_SESSION['loginkey'] = $data['loginkey'];


   }
}
// Creates a session record in the mybb database
//
function forum_adminLogin() {
      global $db, $t;

   if ( check_forum_config() ) {

         $client_ip = ( !empty($HTTP_SERVER_VARS['REMOTE_ADDR']) ) ? $HTTP_SERVER_VARS['REMOTE_ADDR'] : ( ( !empty($HTTP_ENV_VARS['REMOTE_ADDR']) ) ? $HTTP_ENV_VARS['REMOTE_ADDR'] : getenv('REMOTE_ADDR') );
         $user_ip = $client_ip;

         $sql = "SELECT uid,loginkey, username FROM ".FORUM_USER_TABLE." WHERE username = '". $_SESSION['UserName'] ."'";
         $user = $db->getRow($sql);

		if (!isset($user) || $user['username'] != $_SESSION['UserName']) {
			/* IF this admin record is not added. Add now...    */

			forum_saveadmin($_SESSION['UserName'],base64_decode($_SESSION['whatIneed']),1);

			$user['uid'] = $_SESSION['admin_forum_userid'];

			$user['loginkey'] = $_SESSION['loginkey'];

		}

         $admin_path = FORUM_DOC_ROOT . FORUM_ADMIN_DIR;
		$sid = md5(uniqid(microtime()));

		// Create a new admin session for this user
		$admin_session = array(
			"sid" => $sid,
			"uid" => $user['uid'],
			"loginkey" => $user['loginkey'],
			"ip" => escape_string(get_ip()),
			"dateline" => time(),
			"lastactive" => time()
		);
		$db->query('insert into ! (sid, uid, loginkey, ip, dateline, lastactive) values (?,?,?,?,?,?)', array(table_prefix()."adminsessions", $sid, $user['uid'], $user['loginkey'], escape_string(get_ip()), time(), time()));

         setcookie('mybbadmin', $user['uid']."_".$user['loginkey'], 0, $admin_path);

		header('Location: '. HTTP_METHOD . $_SERVER['HTTP_HOST'] . $admin_path . '/index.php?adminsid='.$sid);
   }
}
// need to test more
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


         //print $sid."<br><br>";

         setcookie('sid', $sid, 0, '/');

         $client_ip = ( !empty($HTTP_SERVER_VARS['REMOTE_ADDR']) ) ? $HTTP_SERVER_VARS['REMOTE_ADDR'] : ( ( !empty($HTTP_ENV_VARS['REMOTE_ADDR']) ) ? $HTTP_ENV_VARS['REMOTE_ADDR'] : getenv('REMOTE_ADDR') );
         $user_ip = $client_ip;

            $sql = "SELECT uid,loginkey FROM ".FORUM_USER_TABLE." WHERE username = '". $_SESSION['UserName'] ."'";

            $user = $db->getRow($sql);

	if (!isset($user) || $user == '') {
		/* IF this admin record is not added. Add now...    */

		forum_savesignup($_SESSION['UserName'],base64_decode($_SESSION['whatIneed']),$_SESSION['email']);

	$user['uid'] = $_SESSION['user_forum_userid'];
	$user['loginkey'] = $_SESSION['loginkey'];

	}


            $time = time();

            $user_agent = $_SERVER['HTTP_USER_AGENT'];

            $sql = "INSERT INTO ".FORUM_SESS_TABLE." ( sid, uid, time, ip, location, useragent) VALUES ( '" . $sid . "', '" . $user['uid'] . "', '" . $time . "', '" . $user_ip . "', '/myBB/index.php', '" . $user_agent . "' )";

            $db->query( $sql );

            $sql = "UPDATE ".FORUM_USER_TABLE." SET lastactive = '" . $time . "' WHERE uid = '" . $user['uid'] . "' ";

            $db->query( $sql );

            $sql = "UPDATE ".FORUM_USER_TABLE." SET lastvisit = '" . $time . "' WHERE uid = '" . $user['uid'] . "' ";

            $db->query( $sql );

         $home = FORUM_DOC_ROOT . '/index.php';;
         setcookie('mybbuser', $user['uid']."_".$user['loginkey'], 0, "/");
         setcookie('mybb[lastvisit]', $time, 0, '/');
         setcookie('mybb[lastactive]', $time, 0, '/');

         //print "<a href='$home'>$home</a>";
         header('Location: '.HTTP_METHOD . $_SERVER['HTTP_HOST'] . $home );
   }
}


// Additional functions
//
function random_str($length="8")
{
   $set = array("a","A","b","B","c","C","d","D","e","E","f","F","g","G","h","H","i","I","j","J","k","K","l","L","m","M","n","N","o","O","p","P","q","Q","r","R","s","S","t","T","u","U","v","V","w","W","x","X","y","Y","z","Z","1","2","3","4","5","6","7","8","9");
   $str;
   for($i=1;$i<=$length;$i++)
   {
      $ch = rand(0, count($set)-1);
      $str .= $set[$ch];
   }
   return $str;
}



?>