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
include_once( '../init.php');

define('FORUM_PREFIX', ''); // ex. myBB_
define('FORUM_USER_TABLE', '');
define('FORUM_SESS_TABLE', '');
define('FORUM_USERFIELDS_TABLE', '');

define('FORUM_DOC_ROOT', '' );  // ex. /myBB
define('FORUM_ADMIN_DIR', '' );  // ex. /myBB


// Makes sure we know were the forum is and that we have access to it's config files
//
function read_config() {}

function table_prefix() {}

function admin_dir() {}

// Returns the path to the config file
//
function config_file() {}

// In Admin, click Change Password -> Submit
// Called from admin/modifypwd.php by clicking submit on
//
// done
function forum_modifypwd($username, $newpass) {}


// Set the users account to active.
// Called from admin/reactivate.php
// done
function forum_reactivate($username) {}



// Deletes a admin user user
// called from admin/manageadmin.php
// works
function forum_manageadmin($username) {}


// Add the a admin user's account
// Called from admin/saveadmin.php
// works
function forum_saveadmin($username, $password, $userlevel) {}


// Modify a users profile from the admin.
// Click Profile Management -> Click edit icon next to profile -> Change -> Submit
// done
function forum_modifyprofile($org_username, $username, $email) {}


// Deactivate the user's account
// Called from cancel.php
// done
function forum_cancel($username) {}


// Change the password of the logged in user
// Called from modifympass.php
// done
function forum_modifympass( $newpass) {}


// Activate registration
// Called from completereg.php
// done
function forum_completereg($username) {


}
// Add the user account after signing up
// called from savesignup.php
// done
function forum_savesignup($username, $password, $email) {}


function forum_adminLogin() {

	global $t;

	$t->assign('rendered_page',$t->fetch('noForum.tpl'));

	$t->display('admin/index.tpl');

}
function forum_userLogin() {
	global $t;

	$t->assign('rendered_page',$t->fetch('noForum.tpl'));

	$t->display('index.tpl');

}


if (isset($_SESSION['AdminId']) && $_SESSION['AdminId'] > 0) {
	forum_adminLogin();
}else  {
	forum_userLogin();
}
?>