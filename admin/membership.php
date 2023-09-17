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

if ( !defined( 'SMARTY_DIR' ) ) {
	include_once( '../init.php' );
}

include ( 'sessioninc.php' );

define( 'PAGE_ID', 'mship_mgt' );

if ( !checkAdminPermission( PAGE_ID ) ) {

	header( 'location: not_authorize.php' );
	exit;
}

//default membership level
$mid = 1;

if ( isset($_POST['modify']) ) {

	$vchat 					= (isset($_POST['chat']) && $_POST['chat'] == 'on') ? 1 : 0;

	$vhide 					= (isset($_POST['hide']) && $_POST['hide'] == 'on') ? 1 : 0;

	$vforum 				= (isset($_POST['forum']) && $_POST['forum'] == 'on') ? 1 : 0;

	$vblog 				= (isset($_POST['blog']) && $_POST['blog'] == 'on') ? 1 : 0;

	$vpoll 				= (isset($_POST['poll']) && $_POST['poll'] == 'on') ? 1 : 0;

	$vincludeinsearch 		= (isset($_POST['includeinsearch']) && $_POST['includeinsearch'] == 'on') ? 1 : 0;

	$vmessage 				= (isset($_POST['message']) && $_POST['message'] == 'on') ? 1 : 0;

	$vuploadpicture 		= (isset($_POST['uploadpicture']) && $_POST['uploadpicture'] == 'on') ? 1 : 0;

	$vseepictureprofile 	= (isset($_POST['seepictureprofile']) && $_POST['seepictureprofile'] == 'on' )? 1 : 0;

	$vfavouritelist 	= (isset($_POST['favouritelist']) && $_POST['favouritelist'] == 'on') ? 1 : 0;

	$vsendwinks 	= (isset($_POST['sendwinks']) && $_POST['sendwinks'] == 'on') ? 1 : 0;

	$vextsearch 	= (isset($_POST['extsearch']) && $_POST['extsearch'] == 'on') ? 1 : 0;

	$vfullsignup 			= (isset($_POST['fullsignup']) && $_POST['fullsignup'] == 'on') ? 1 : 0;

	$vuploadpicturecnt = (!isset($_POST['uploadpicturecnt'] ) || $_POST['uploadpicturecnt'] == '' )? 1: $_POST['uploadpicturecnt'];

	$vallowalbum = 	(isset($_POST['allowalbum'])&&$_POST['allowalbum'] == 'on') ? 1: 0;

	$vallowim = 	(isset($_POST['allowim']) && $_POST['allowim'] == 'on') ? 1: 0;

	$vallow_comment_removal = 	(isset($_POST['allow_comment_removal']) && $_POST['allow_comment_removal'] == 'on') ? 1: 0;

	$vallow_mysettings =  (isset($_POST['allow_mysettings']) && $_POST['allow_mysettings'] == 'on') ? 1: 0;

	$vprice					= (isset($_POST['txtprice'])?$_POST['txtprice']:0);

	$vcurrency				= (isset($_POST['txtcurrency'])?$_POST['txtcurrency']:'USD');

	$vname					= isset($_POST['txtname'])?$_POST['txtname']:'';

	$activedays			= (isset($_POST['activedays'])?$_POST['activedays']:0);

	$event_mgt 			= (isset($_POST['event_mgt']) && $_POST['event_mgt'] == 'on') ? 1: 0;

	$vallow_php121 			= (isset($_POST['allow_php121']) && $_POST['allow_php121'] == 'on' )? 1: 0;

	$saveprofiles 		= (isset($_POST['saveprofiles']) && $_POST['saveprofiles'] == 'on') ? 1: 0;

	$saveprofilescnt = isset($_POST['saveprofilescnt'])?$_POST['saveprofilescnt']:0;

	$profilepicscnt = isset($_POST['profilepicscnt'])?$_POST['profilepicscnt']:0;

	if ($saveprofilescnt == '') $saveprofilescnt = 0;

	if ($profilepicscnt == '') $profilepicscnt = 0;
	$allow_videos = (isset($_POST['allow_videos'])&&$_POST['allow_videos']=='on')?1:0;

	$videoscnt = isset($_POST['videoscnt'])?$_POST['videoscnt']:0;

	$message_keep_cnt = isset($_POST['message_keep_cnt'])?$_POST['message_keep_cnt']:0;

	$message_keep_days = isset($_POST['message_keep_days'])?$_POST['message_keep_days']:0;

	$messages_per_day = isset($_POST['messages_per_day'])?$_POST['messages_per_day']:0;

	if ($messages_per_day == '') $messages_per_day = 0;

	$winks_per_day = isset($_POST['winks_per_day'])?$_POST['winks_per_day']:0;

	if ($winks_per_day == '') $winks_per_day = 0;

	if ($message_keep_cnt == '') $message_keep_cnt = 0;

	if ($message_keep_days == '') $message_keep_days = 0;

	$mid = isset($_POST['mshipid'])?$_POST['mshipid']:'';


	$sql = 'UPDATE ! ' .
	" SET	name				= '$vname',
			chat 				= '$vchat',
			forum				= '$vforum',
			blog				= '$vblog',
			poll				= '$vpoll',
			includeinsearch		= '$vincludeinsearch',
			message				= '$vmessage',
			message_keep_cnt    = '$message_keep_cnt',
			message_keep_days   = '$message_keep_days',
			messages_per_day 	= '$messages_per_day',
			uploadpicture		= '$vuploadpicture',
			uploadpicturecnt 	= '$vuploadpicturecnt',
			allowalbum 			= '$vallowalbum',
			allowim 			= '$vallowim',
			seepictureprofile	= '$vseepictureprofile',
			favouritelist		= '$vfavouritelist',
			sendwinks			= '$vsendwinks',
			winks_per_day 		= '$winks_per_day',
			extsearch			= '$vextsearch',
			fullsignup			= '$vfullsignup',
			saveprofiles		= '$saveprofiles',
			saveprofilescnt		= '$saveprofilescnt',
			allow_videos		= '$allow_videos',
			profilepicscnt		= '$profilepicscnt',
			videoscnt			= '$videoscnt',
			price				= '$vprice',
			currency			= '$vcurrency',
			activedays			= '$activedays',
			event_mgt			= '$event_mgt',
			allow_mysettings	= '$vallow_mysettings',
			allow_comment_removal = '$vallow_comment_removal',
			hide	= '$vhide',
			allow_php121	= '$vallow_php121'	
			WHERE roleid = '$mid' AND id = ?";

	$osDB->query($sql, array( MEMBERSHIP_TABLE,  $_POST['id']) );
}

if( isset($_POST['enable']) && $_POST['enable']== get_lang('enable_selected') ) {

	 $osDB->query( 'UPDATE ! SET enabled = ? WHERE id = ?', array( MEMBERSHIP_TABLE, 'Y', $_POST['id']) );

}

if( isset($_POST['disable']) && $_POST['disable'] == get_lang('disable_selected' ) ){

	 $osDB->query( 'UPDATE ! SET enabled = ? WHERE id = ?', array( MEMBERSHIP_TABLE, 'N', $_POST['id']) );

}

if( isset($_POST['delete']) && $_POST['delete']==get_lang('delete_selected') ) {

	 $osDB->query( 'DELETE FROM !  WHERE id =?', array( MEMBERSHIP_TABLE ,$_POST['id'] ) );

}


if ( isset($_POST['membership']) && $_POST['membership']!= '' ) {

	$mid = $_POST['membership'];

}

$t->assign( 'data',$osDB->getRow( 'SELECT * FROM ! WHERE roleid = ?', array(MEMBERSHIP_TABLE, $mid) ) );

$roles = array();

$rs = $osDB->getAll( 'SELECT roleid, name FROM !',array( MEMBERSHIP_TABLE ) );

foreach ( $rs as $row ) {

	$roles[$row['roleid']] = $row['name'];
}

$t->assign( 'memberships', $roles );

unset($roles, $rs);

$lang['privileges'] = get_lang_values('privileges');

$lang['activedays_array'] = get_lang_values('activedays_array');

$t->assign('lang',$lang);

$t->assign('rendered_page', $t->fetch('admin/membership.tpl'));

$t->display( 'admin/index.tpl' );

?>