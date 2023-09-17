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

$login_length_seconds = 1800; /* 30 minutes */
$password = base64_decode($_SESSION['whatIneed']);
$smf_path='../'.$config['forum_path'].'/';

include (dirname(__FILE__) .'/smf_1-1_api.php');


function forum_modifypwd() {
}
// Set the users account to active.
// Called from admin/reactivate.php
// done
function forum_reactivate($username) {

}
// Deletes a admin user user
// called from admin/manageadmin.php
// works
function forum_manageadmin($username) {
}

// Modify a users profile from the admin.
// Click Profile Management -> Click edit icon next to profile -> Change -> Submit
// done
function forum_modifyprofile() {
}
// Deactivate the user's account
// Called from cancel.php and from profile.php in Admin->Profile management
// done
function forum_cancel($username) {

}
// Change the password of the logged in user
// Called from modifympass.php
// done
function forum_modifympass( $newpass, $username) {

	// Update the password

	smf_changePassword($username, $newpass);

}
// Activate registration
// Called from completereg.php
// done
function forum_completereg($username) {


}
// Creates a session record in the phpBB database
//
function forum_adminLogin() {

	global  $config,$smf_settings,  $smf_user_info, $login_length_seconds, $password, $smf_path;

	$username = $_SESSION['UserName'];
	$result = smf_query("
		SELECT ID_MEMBER
		FROM $smf_settings[db_prefix]members
		WHERE memberName = '$username'
		LIMIT 1", __FILE__, __LINE__);
	list ($id) = mysql_fetch_row($result);
	mysql_free_result($result);
	if (!isset($id) ||empty($id) ) {

		$extra_fields = array('ID_GROUP'=>'1');

		smf_registerMember($_SESSION['UserName'], $config['admin_email'], $password, 'Admin', $extra_fields);
	}
	smf_setLoginCookie($login_length_seconds, $_SESSION['UserName']);

	smf_authenticateUser();

	header('Location: '. $smf_path . 'index.php' );

}


function forum_userLogin() {

	global  $config, $smf_user_info, $smf_settings, $login_length_seconds, $password, $smf_path;
	$username = $_SESSION['UserName'];
	$result = smf_query("
		SELECT ID_MEMBER
		FROM $smf_settings[db_prefix]members
		WHERE memberName = '$username'
		LIMIT 1", __FILE__, __LINE__);
	list ($id) = mysql_fetch_row($result);
	mysql_free_result($result);
	if (!isset($id) ||empty($id) ) {
		$extra_fields = array('ID_GROUP'=>'4');

		smf_registerMember($_SESSION['UserName'], $_SESSION['email'], $password, $_SESSION['FullName'], $extra_fields);
	}

	smf_setLoginCookie($login_length_seconds, $_SESSION['UserName']);

	smf_authenticateUser();

	header('Location: '. $smf_path . 'index.php' );

}
?>