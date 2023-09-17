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

$userid = isset($_REQUEST['userid'])?$_REQUEST['userid']:$_SESSION['UserId'] ;

$videono = isset($_REQUEST['videono'])?$_REQUEST['videono']:'';

if ($videono == '' or $videono < 1 or !isset($videono) or $videono == null) $videono= $osDB->getOne('select max(videono)+1 from ! where userid = ?',array(USER_VIDEOS_TABLE,$userid) );

if ($videono == '') $videono = 1;

if ($_SESSION['UserId'] == $userid) {

	$userinfo['username'] =$_SESSION['UserName'];

} else {

	$userinfo = $osDB->getRow('select username from ! where id = ?', array( USER_TABLE, $userid) );

}

$err = 0;

if ($config['snaps_require_approval'] == 'Y') {

	$act = 'N';

} else {

	$act = 'Y';

}

$curr_file =  '';

if (isset($_POST['album_name']) && $_POST['album_name'] != '') {

/* Add new album first and then process the image */

	$album_id = $osDB->getOne('select id from ! where name = ? and username = ?', array(USERALBUMS_TABLE, $_POST['album_name'], $userinfo['username'] )  );

	if ($album_id > 0 ) {
		null;
	} else {
		$osDB->query('insert into ! (username, name, passwd) values (?, ?, ?)', array( USERALBUMS_TABLE, $userinfo['username'], $_POST['album_name'], md5($_POST['album_passwd'])) );

		$album_id = $osDB->getOne('select id from ! where name = ? and username = ?', array(USERALBUMS_TABLE, $_POST['album_name'],  $userinfo['username'] )  );
	}

} else {

	$album_id = isset($_POST['album_id'])?$_POST['album_id']:'0';

}
$video_descr='';
if (isset($_REQUEST['video_descr']) && $_REQUEST['video_descr'] != '') {
	$video_descr = strip_tags(htmlentities(stripEmails($_REQUEST['video_descr']) ) );
}

if (isset($_POST['changealbum']) ) {
/* Change album name  */

	$osDB->query("update ! set album_id = ? where userid = ? and videono = ?", array(USER_VIDEOS_TABLE, $album_id, $userid, $videono) );

	header( 'location: uploadvideos.php?userid='.$userid.'&msg='.ALBUM_CHANGED );
	exit();
} elseif (isset($_POST['update_comment']) ) {
	$osDB->query("update ! set video_descr = ?, album_id = ? where userid = ? and videono = ?", array(USER_VIDEOS_TABLE, $video_descr, $album_id, $userid, $videono) );
	header( 'location: uploadvideos.php?userid='.$userid.'&msg=147' );
	exit();
}

if (isset($_POST['ytref']) && $_POST['ytref'] != '') {
	/* This is youtube reference */
	$video_filename = 'youtube:'.stripslashes(strip_tags($_POST['ytref']));
	$rtn=true;

} elseif( isset($_FILES['txtimage']) && is_uploaded_file( $_FILES['txtimage']['tmp_name'] ) ) {

	$img_file = $_FILES['txtimage']['tmp_name'];
	$fname = $_FILES['txtimage']['name'];

	clearstatcache();

	$video_filename = $userinfo['username'].'_V'.$videono.'_'.$fname;

	/* Now write the video into file 
	$orgimg = file_get_contents($img_file);
	$fout = @fopen(USER_VIDEO_DIR.$video_filename,'wb');
	fwrite($fout, $orgimg);
	fclose($fout);
	*/
	copy($_FILES['txtimage']['tmp_name'], USER_VIDEO_DIR.$video_filename);
	unlink($_FILES['txtimage']['tmp_name']);
	$rtn = true;
}
if (isset($rtn) && ($rtn==true || $rtn != '')   )  {
	/* Now add this into the table */
	$osDB->query('insert into ! (userid, videono, filename, album_id, active, video_descr) values (?,?,?,?,?,?)', array(USER_VIDEOS_TABLE, $userid, $videono, $video_filename, $album_id, $act, $video_descr) );

	updateLoadedVideosCnt($userid);

	if ($config['newvideo_admin_info'] == 'Y') {
		sendAdminEmail();
	}

	unset($userinfo);

	Header("Cache-Control: must-revalidate");

	$ExpStr = "Expires: " . gmdate("D, d M Y H:i:s", time() -30) . " GMT";
	Header($ExpStr);

	header( 'location: uploadvideos.php?msg='.VIDEO_LOADED.'&userid='.$userid );

	exit;
} else {

	unset($userinfo);

	Header("Cache-Control: must-revalidate");

	$ExpStr = "Expires: " . gmdate("D, d M Y H:i:s", time() -30) . " GMT";
	Header($ExpStr);

	header( 'location: uploadvideos.php?msg=130&userid='.$userid );

	exit;

}


function sendAdminEmail () {
/* Send email to admin */
	global $osDB, $userid, $config, $userinfo, $videono;

    $opt_lang = $_SESSION['opt_lang'];

	$_SESSION['opt_lang'] = $config['admin_lang'];

	$body = get_lang('newvideo', MAIL_FORMAT);

	$Subject = get_lang('newvideo_sub'). ' - ' . $config['site_name'];

	$From = $To = $email = $config['admin_email'];

	$body = str_replace( '#SiteName#',  SITENAME , $body );

	$body = str_replace( '#AdminName#',  $config['admin_name'] , $body );

	$body = str_replace( '#UserName#',  $userinfo['username'] , $body );

	$body = str_replace( '#PicNo#',  $videono , $body );

	mailSender($From, $To, $email, $Subject, $body);

	$_SESSION['opt_lang'] = $opt_lang;

	unset($opt_lang);

}

?>