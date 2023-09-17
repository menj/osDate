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
	include_once( 'init.php' );
}

include('sessioninc.php');

$type='profilepics';

if (isset($_REQUEST['type']) && $_REQUEST['type'] == 'gallery') {
	$type=$_REQUEST['type'];
}

$userid = isset($_REQUEST['id'])?$_REQUEST['id']:(isset($_SESSION['UserId'])?$_SESSION['UserId']:'');

$username = $osDB->getOne('select username from ! where id = ?',array( USER_TABLE, $userid) );

if ($type == 'profilepics') {
	$search=' and (album_id is null or album_id = 0)';
} else {
	$search=' and  album_id > 0 ';

	$useralbums = $osDB->getAll('select id, name, passwd from ! where username = ? ', array(USERALBUMS_TABLE, $username) );

	if (count($useralbums) > 0) {

		foreach ($useralbums as $k => $row) {
			if ($row['passwd'] != '') {
				$useralbums[$k]['password']='';
			}
		}

		$useralbums = array_merge(array(array('id'=>'999','name'=>'Public')), $useralbums);

	}
}

$t->assign('type',$type);

$album_passwd = isset($_REQUEST['album_passwd'])?$_REQUEST['album_passwd']:'';

if ($type == 'gallery') {
	$album_id = isset($_REQUEST['album_id'])?$_REQUEST['album_id']:'999';
}

if (isset($album_id) && $album_id != '') {

	/* First check if the user opted to allow membrs in the buddy list to view */

	$buddy_view = $osDB->getOne('select choice_value from ! where userid=? and choice_name=?', array(USER_CHOICES_TABLE, $userid, 'allow_buddy_view_album') );

	$hotlist_view = $osDB->getOne('select choice_value from ! where userid=? and choice_name=?', array(USER_CHOICES_TABLE, $userid, 'allow_hotlist_view_album') );

	$in_buddy_list = $in_hot_list = 0;

	if (!isset($buddy_view) || $buddy_view == '1' || $buddy_view == ''  ) {

		$in_buddy_list = $osDB->getOne('select count(*) from ! where userid = ? and ref_userid = ? and act = ?', array(BUDDY_BAN_TABLE, $userid, $_SESSION['UserId'], 'F') );

	}

	if (!isset($hotlist_view) || $hotlist_view == '1' || $hotlist_view == '' ) {

		$in_hot_list = $osDB->getOne('select count(*) from ! where userid = ? and ref_userid = ? and act = ?', array(BUDDY_BAN_TABLE, $userid, $_SESSION['UserId'], 'H') );

	}

	$albumpasswd=0;
	if (count($useralbums) > 1) {
	/*  There are private albums too..  */
		$albums = array();
		foreach ($useralbums as $row) {			
			if ($row['id'] == '999') {
				$albums[] = $row;
			} elseif ( (isset($buddy_view) && $buddy_view == '1' && $in_buddy_list > 0 ) ||  (isset($hotlist_view) && $hotlist_view == '1' && $in_hot_list > 0 ) || $userid == $_SESSION['UserId'] ) {
				if ($row['passwd'] != '') $albumpasswd++;
				$albums[] = $row;
			}
		}
		
		$t->assign('useralbums', $albums);
		unset($useralbums, $albums);
	} else {
		$t->assign('useralbums', $useralbums);
		unset($useralbums);
	}
	$t->assign('albumpasswd', $albumpasswd);
}

if ($type == 'gallery') {
	$t->assign('pics',$osDB->getAll('select picno, pic_descr from ! where userid = ? and album_id =?',array( USER_SNAP_TABLE, $userid, $album_id) ));
} else {
	$t->assign('pics',$osDB->getAll('select picno, pic_descr from ! where userid = ? '.$search,array( USER_SNAP_TABLE, $userid)) );
}

$t->assign('username',$username);

$t->assign('userid',$userid);

if (isset($err) ) {
	$t->assign('error_message', get_lang('errormsgs',$err));

	$t->assign('err',$err);
}
if (isset($album_id)) $t->assign('album_id', $album_id);

$t->assign('lang',$lang);

if ( $config['use_profilepopups'] == 'Y' ) {

	$t->display( 'userpicgallery.tpl' );

} else {

	$t->assign( 'rendered_page', $t->fetch( 'userpicgallery.tpl' ) );

	$t->display ( 'index.tpl' );
}


?>