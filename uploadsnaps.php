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

include ( 'sessioninc.php' );

$type=(isset($_REQUEST['type']) && $_REQUEST['type']!='')?$_REQUEST['type']:'profilepics';

if (isset($_REQUEST['album_id'])) {$album_id = $_REQUEST['album_id']; }

if (isset($_REQUEST['type']) &&  $_REQUEST['type'] == 'gallery') {
	if (isset($_REQUEST['createalbum']) && $_REQUEST['createalbum'] != '') {
		/* Create the album */

		if (isset($_POST['album_name']) &&  $_POST['album_name'] != '') {
			/* Add new album first and then process the image */

			$album_id = $osDB->getOne('select id from ! where name = ? and username = ?', array(USERALBUMS_TABLE, $_POST['album_name'], $_SESSION['UserName'] )  );
			if ($album_id > 0 ) {
				null;
			} else {
				$osDB->query('insert into ! (username, name, passwd) values (?, ?, ?)', array( USERALBUMS_TABLE, $_SESSION['UserName'], $_POST['album_name'], md5($_POST['album_passwd'])) );

				$album_id = $osDB->getOne('select id from ! where name = ? and username = ? ', array(USERALBUMS_TABLE, $_POST['album_name'], $_SESSION['UserName']  )  );
			}

		}
	}
	if (!isset($album_id) || (isset($album_id) && $album_id =='')  ) {
		$album_id = 999;
	}

} elseif (isset($_REQUEST['type']) &&  $_REQUEST['type'] == 'profilepics') {
	$album_id = 0;
}

Header("Cache-Control: must-revalidate");

$ExpStr = "Expires: " . gmdate("D, d M Y H:i:s", time() -30) . " GMT";

Header($ExpStr);

if( isset($_GET['del']) && $_GET['del'] == 'yes' ){

	$row = $osDB->getRow( 'SELECT album_id, id, picture, tnpicture FROM ! WHERE userid = ? AND picno = ?', array( USER_SNAP_TABLE, $_SESSION['UserId'], $_GET['picno'] ) );

	if (substr_count($row['picture'], 'file:' )>0 ) {
		$curr_imgfile = ltrim(rtrim(str_replace('file:','',$row['picture'] ) ) );
	}
	if (substr_count($row['tnpicture'],'file:' )>0 ) {
		$curr_tnimgfile = ltrim(rtrim(str_replace('file:','',$row['tnpicture'] ) ) );
	}

	if ($_GET['typ'] == 'tn' or $config['drop_tn_also'] == 'Y' ) {
		@unlink(USER_IMAGE_DIR.$_SESSION['UserId'].'/'.$curr_tnimgfile);
		$osDB->query ( 'update ! set tnpicture = ?, tnext = ? where userid = ? and picno = ?', array( USER_SNAP_TABLE, '', '', $_SESSION['UserId'], $_GET['picno'] ) );
		if (isset($curr_tnimgfile) && file_exists(USER_IMAGE_CACHE_DIR.$_SESSION['UserId'].'/'.str_replace('.','_wm.',$curr_tnimgfile)) ) {
			@unlink(USER_IMAGE_CACHE_DIR.$_SESSION['UserId'].'/'.str_replace('.','_wm.',$curr_tnimgfile));
		}
	}

	if ($_GET['typ'] == 'pic') {
		@unlink(USER_IMAGE_DIR.$_SESSION['UserId'].'/'.$curr_imgfile);
		$osDB->query ( 'update ! set picture = ?, picext = ? where userid = ? and picno = ?', array( USER_SNAP_TABLE, '', '', $_SESSION['UserId'], $_GET['picno'] ) );
		if (isset($curr_imgfile) && file_exists(USER_IMAGE_CACHE_DIR.$_SESSION['UserId'].'/'.str_replace('.','_wm.',$curr_imgfile)) ){
			@unlink(USER_IMAGE_CACHE_DIR.$_SESSION['UserId'].'/'.str_replace('.','_wm.',$curr_imgfile));
		}

	}

	$recdel = $osDB->getOne('select id from ! where userid = ? and picno = ? and picture = ? and tnpicture = ?', array( USER_SNAP_TABLE, $_SESSION['UserId'], $_GET['picno'], '','' ) ) ;

	if ($recdel > 0) {

		$osDB->query('delete from ! where userid = ? and picno = ?',array( USER_SNAP_TABLE, $_SESSION['UserId'], $_GET['picno'] ) );

	}
	if ($row['album_id'] == '0' || $row['album_id'] =='') {
		$type='profilepics';
	} else {
		$type='gallery';
	}

	unset($row);
	updateLoadedPicturesCnt($_SESSION['UserId']);

	header('location: ?&type='.$type);

	exit;
}

if( function_exists('imagejpeg' ) ) {
	$t->assign( 'editable', 1 );
} else {
	$t->assign( 'editable', 0 );
}

if ($type == 'profilepics') {
	$search = ' and (album_id is null or album_id = 0) ';
} else {
	$search = ' and album_id =  '.$album_id;
}

$rows = $osDB->getAll( 'select  picno, picture, tnpicture, album_id, default_pic, pic_descr, picext, tnext from ! where userid = ? '.$search.' order by picno', array( USER_SNAP_TABLE, $_SESSION['UserId'] ) );

$userdata = $osDB->getRow('select usr.level, usr.username,  mem.uploadpicture, mem.uploadpicturecnt, mem.allowalbum, mem.profilepicscnt from ! as usr, ! as mem where mem.roleid = usr.level and usr.id = ?', array(USER_TABLE, MEMBERSHIP_TABLE, $_SESSION['UserId']  ) );

$data = array();
$data[]=" ";
if (isset($rows) && count($rows) > 0) {
	foreach ($rows as $row) {

		$data[] = $row;
	}
}
if ($type == 'profilepics') {
	$t->assign('max_picture_cnt', (count($data) < $userdata['profilepicscnt'])? count($data) : $userdata['profilepicscnt'] );

} else {
	$t->assign('max_picture_cnt', (count($data) < $userdata['uploadpicturecnt'])? count($data) : $userdata['uploadpicturecnt'] );

	$useralbums = $osDB->getAll('select id, name from ! where username = ? and id > 0 order by name', array(USERALBUMS_TABLE, $userdata['username'] ) );

	$useralbums = array_merge($useralbums, array(array('id'=>'999','name'=>'Public')) );
	$t->assign('useralbums', $useralbums);
}

$nextpic = $osDB->getOne( 'select max(picno)+1 from ! where userid = ? ', array( USER_SNAP_TABLE, $_SESSION['UserId'] ) );

if ($nextpic <= 0) $nextpic=1;

$t->assign('nextpic',$nextpic);

$t->assign ( 'data', $data );


unset($rows, $data);
if (isset($_GET['msg']) && $_GET['msg'] != '') {
	$t->assign("error_message", get_lang('errormsgs',$_GET['msg']) );
}

$maxsize= floor($config['upload_snap_maxsize']/1000);

$t->assign('type', $type);

$t->assign('album_id', $album_id);

$t->assign('userdata',$userdata);

$t->assign('snapload_msg',str_replace('#MAXSIZE#',$maxsize, get_lang('snapload_msg')) );

unset($userdata);

$t->assign ( 'lang', $lang );

$t->assign('rendered_page',$t->fetch('usersnap.tpl'));

$t->display ( 'index.tpl' );

?>