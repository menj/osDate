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

$userid = (isset($_REQUEST['userid']) && $_REQUEST['userid']> 0)? $_REQUEST['userid'] : $_SESSION['UserId'];

$videono = isset($_REQUEST['videono'])?$_REQUEST['videono']:0;

if( isset($_GET['del']) && $_GET['del'] == 'yes' ){

	$row = $osDB->getRow( 'SELECT id, filename FROM ! WHERE userid = ? AND videono = ?', array( USER_VIDEOS_TABLE, $userid, $videono ) );

	@unlink(USER_VIDEO_DIR.$row['filename']);

	$osDB->query('delete from ! where userid = ? and videono = ?',array( USER_VIDEOS_TABLE, $userid, $videono  ) );

	updateLoadedVideosCnt($userid);

	unset($row);

	header('location: ?userid='.$userid);

	exit;
}

$rows = $osDB->getAll( 'select videono, filename, album_id, video_descr from ! where userid = ? order by videono', array( USER_VIDEOS_TABLE, $userid ) );

$userdata = $osDB->getRow('select usr.level, usr.username,  mem.allow_videos, mem.videoscnt, mem.allowalbum from ! as usr, ! as mem where mem.roleid = usr.level and usr.id = ?', array(USER_TABLE, MEMBERSHIP_TABLE, $userid ) );

$data = array();
$data[]="  ";
$nextpic=0;
foreach ($rows as $row) {
	if (substr_count($row['filename'],'youtube:') > 0) {
		$row['ext'] = 'yt';
		$row['ytref'] = trim(str_replace('youtube:','',$row['filename']));
	} else {
		$row['ext'] = substr($row['filename'],-3);
		$row['fullfilename'] = 'temp/uservideos/'.$row['filename'];
	}
	$data[] = $row;
	$nextpic = $row['videono'];
}
unset($rows);
$nextpic++;

$t->assign('max_picture_cnt', (count($data) < $userdata['videoscnt'])? count($data) : $userdata['videoscnt'] );

$t->assign('useralbums',$osDB->getAll('select id, name from ! where username = ? order by name', array(USERALBUMS_TABLE, $userdata['username'] ) ) );

$t->assign ( 'data', $data );

$t->assign('userdata',$userdata);

unset($data, $userdata);

$t->assign('nextvideo',$nextpic);
if (isset($_POST['album_id']) ) $t->assign('album_id', $_POST['album_id']);

if ( function_exists('passthru')) {
	/* system command is allowed */
	$t->assign('system_allowed','Y');
}

if (isset($_REQUEST['msg']) && $_REQUEST['msg'] != '') {
	$t->assign("error_message", get_lang('errormsgs',$_GET['msg']) );
}
$t->assign ( 'lang', $lang );

$t->assign('userid', $userid);

$t->assign('rendered_page',$t->fetch('uservideos.tpl'));

$t->display ( 'index.tpl' );


?>