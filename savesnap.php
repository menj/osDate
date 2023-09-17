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

@ini_set('memory_limit','20M');

include ( 'sessioninc.php' );


$userid = $_SESSION['UserId'];

$curr_imgfile = $curr_tnimgfile = '';

if (isset($_POST['txtpicno']) && $_POST['txtpicno'] > 0) {
	$row = $osDB->getRow( 'SELECT id, picture, tnpicture, picext, tnext FROM ! WHERE userid = ? AND picno = ?', array( USER_SNAP_TABLE, $userid, $_POST['txtpicno'] ) );
	if ($row) {
		if (substr_count($row['picture'], 'file:' )>0 ) {
			$curr_imgfile = ltrim(rtrim(str_replace('file:','',$row['picture'] ) ) );
		}
		if (substr_count($row['tnpicture'],'file:' )>0 ) {
			$curr_tnimgfile = ltrim(rtrim(str_replace('file:','',$row['tnpicture'] ) ) );
		}
	}
} else {
	$row='';
}

$userinfo = $osDB->getRow('select * from ! where id = ?', array( USER_TABLE, $userid) );

$err = 0;

if ($config['snaps_require_approval'] == 'Y') {

	$act = 'N';

} else {

	$act = 'Y';

}

$allwdsize = $config['upload_snap_maxsize'];

$album_id = $_REQUEST['album_id'];

$type = $_REQUEST['type'];


$time = time();
if (isset($_POST['update_comment']) && $_POST['update_comment'] != '' && $_POST['txtpicno'] != '' && isset($_POST['pic_descr']) &&  $_POST['pic_descr'] != '') {

	$pic_descr = isset($_POST['pic_descr'])?$_POST['pic_descr']:' ';

	$osDB->query('update ! set pic_descr=? where id=? ', array(USER_SNAP_TABLE, $pic_descr, $row['id']) );

	header( 'location: uploadsnaps.php?msg=144&type='.$type.'&album_id='.$album_id );
	exit;

} elseif( is_uploaded_file( $_FILES['txtimage']['tmp_name'] ) && exif_imagetype($_FILES['txtimage']['tmp_name']) != '' ) {

	$default_pic = (isset($_REQUEST['default_pic']) && $_REQUEST['default_pic']=='Y')?'Y':'N';

	$img_file = $_FILES['txtimage']['tmp_name'];

	$ext = explode( '/', $_FILES['txtimage']['type'] );

	$picext = strtolower($ext[1]);

	if( $picext == 'pjpeg' || $picext == 'jpeg'){

		$picext = 'jpg';
	}

	if( $picext == 'x-png' ) {
		$picext= 'png';
	}
	//echo "$picext<br>";

	$ext_ok = '0';

	foreach (explode(',',$config['upload_snap_ext']) as $ex) {


		if ( $ex == $picext ) $ext_ok++;

	}

	/* bmp is removed as valid source time being */
	if ( $ext_ok <= '0' ) {

		header( 'location: uploadsnaps.php?msg=' .WRONG_TYPE .'&type='.$type.'&album_id='.$album_id  );
		exit;

	}

	clearstatcache();

	$fstats= stat($img_file);

	$picsize = $fstats[7];

	/* Get current picture size and allowed size. If pic size is more than the allowed size, flag error.. */


	$imginfo = getimagesize($img_file);

	if ( ($picsize > $allwdsize ) || ($imginfo[0] > 1600 || $imginfo[1] > 1200) ) {

		header( 'location: uploadsnaps.php?msg='.BIG_PIC_SIZE.'&type='.$type.'&album_id='.$album_id  );
		exit;

	}

	

	
	include_once (OSDATE_INC_DIR."internal/snaps_functions.php");

	if ($_POST['txtpicno'] == '' or !isset($_POST['txtpicno']) ) {
		$_POST['txtpicno'] = $osDB->getOne('select max(picno)+1 from ! where userid = ?',array(USER_SNAP_TABLE,$userid) )+1;
	}

	$userimagedir = USER_IMAGE_DIR.$userid.'/';
	if (!file_exists($userimagedir)) {
		mkdir($userimagedir, 0777);
		chmod($userimagedir, 0777);
	}
	$userimagedir.='/';


	if ((isset($_REQUEST['generate_tnpic']) && $_REQUEST['generate_tnpic'] == 'Y') || !isset($_REQUEST['generate_tnpic']) || $row=='' ) {

		$tnimg = createResizedPicture($img_file, $config['upload_snap_tnsize'], $config['upload_snap_tnsize'] , $picext);

		$tnext = $picext;

		$outfile = 'tn_'.$_POST['txtpicno'].'.'.$tnext;
		if ($config['images_in_db'] == 'N') {

			writePictureFile($tnimg, $userimagedir.$outfile);

			$tnimg = 'file:'.$outfile;

		} else {

			writePictureFile($tnimg, $userimagedir.$outfile);

			$tnimg = base64_encode(file_get_contents($userimagedir.$outfile));

			unlink($userimagedir.$outfile);

		}
	}

	if ($config['images_in_db'] == 'N') {

		$imgfile = saveOriginalPictureFile($img_file, $userid, 'pic', $_POST['txtpicno'], $picext, $curr_imgfile );

		$newimg = 'file:'.$imgfile;

		sleep(2);

	} else {

		$newimg = base64_encode(file_get_contents($img_file));
	}

	$pic_descr = isset($_POST['pic_descr'])?$_POST['pic_descr']:' ';

	if ( $row ) {

		if ((isset($_REQUEST['generate_tnpic']) && $_REQUEST['generate_tnpic'] == 'Y') || !isset($_REQUEST['generate_tnpic']) ) {
			$osDB->query('update ! set picture = ?, ins_time = ?, active=?, picext=?, tnpicture = ?, tnext = ?, album_id = ? , default_pic = ?, pic_descr=?  where userid = ? and picno = ? and id = ?', array( USER_SNAP_TABLE, $newimg, $time, $act,	$picext, $tnimg, $tnext, $album_id, $default_pic, $pic_descr, $userid, $_POST['txtpicno'], $row['id'] ) );
		} else {
			$osDB->query('update ! set picture = ?, ins_time = ?, active=?, picext=?,  album_id = ? , default_pic = ?, pic_descr=?  where userid = ? and picno = ? and id = ?', array( USER_SNAP_TABLE, $newimg, $time, $act,	$picext, $album_id, $default_pic, $pic_descr, $userid, $_POST['txtpicno'], $row['id'] ) );
		}
	} else {
		$osDB->query( 'insert into ! (  userid, picno, picture, ins_time, active, picext, tnpicture, tnext, album_id, default_pic, pic_descr ) values (  ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ? )', array( USER_SNAP_TABLE, $userid, $_POST['txtpicno'], $newimg, $time, $act, $picext, $tnimg, $tnext, $album_id, $default_pic, $pic_descr ) );

	}

	updateLoadedPicturesCnt($userid);

	unset( $newimg, $tnimg);

	if ($config['newpic_admin_info'] == 'Y') {
		sendAdminEmail();
	}

	unlink($img_file);
	
	Header("Cache-Control: must-revalidate");

	$ExpStr = "Expires: " . gmdate("D, d M Y H:i:s", time() -30) . " GMT";
	Header($ExpStr);

	header( 'location: uploadsnaps.php?msg='.PICTURE_LOADED.'&type='.$type.'&album_id='.$album_id );
	exit;

} elseif ( is_uploaded_file( $_FILES['tnimage']['tmp_name'] ) && exif_imagetype($_FILES['tnimage']['tmp_name'])!='' ) {

	$default_pic = (isset($_REQUEST['default_pic']) && $_REQUEST['default_pic']=='Y')?'Y':'N';
	$tnimg_file = $_FILES['tnimage']['tmp_name'];

	$ext = explode( '/', $_FILES['tnimage']['type'] );

	$tnext = strtolower($ext[1]);

	$tnsize = $config['upload_snap_tnsize'];

	if( $tnext == 'pjpeg' || $tnext == 'jpeg'){

		$tnext = 'jpg';

	}

	if( $tnext == 'x-png' ) {
		$tnext= 'png';
	}

	$ext_ok = 0;

	foreach (explode(',',$config['upload_snap_ext']) as $ex) {

		if ( $ex == $tnext ) $ext_ok++;

	}

	if ( $ext_ok <= 0 ) {

		header( 'location: uploadsnaps.php?msg=' .WRONG_TYPE .'&type='.$type.'&album_id='.$album_id  );
		exit;

	}

	clearstatcache();

	$fstats= stat($tnimg_file);

	$picsize = $fstats[7];

	if ($picsize > $allwdsize) {

		header( 'location: uploadsnaps.php?msg='.BIG_PIC_SIZE.'&type='.$type.'&album_id='.$album_id  );
		exit;

	}

	list($tnwidth, $tnheight, $tntype, $tnattr) = getimagesize($tnimg_file);

	/* Get current picture size and allowed size. If pic size is more than the allowed size, flag error.. */

	if ($tnwidth > $tnsize or $tnheight > $tnsize) {

			header( 'location: uploadsnaps.php?msg='.BIGTHUMBNAIL.'&type='.$type.'&album_id='.$album_id  );
			exit;
	}

	include_once (OSDATE_INC_DIR."internal/snaps_functions.php");

	if ($config['images_in_db'] == 'N') {

		$tnimgfile = saveOriginalPictureFile($tnimg_file, $userid, 'tn', $_POST['txtpicno'], $tnext,$curr_tnimgfile );

		$tnimg = 'file:'.$tnimgfile;

	} else {

		$tnimg = base64_encode(createImg($tnimg_file));
	}

	unlink($tnimg_file);

	$pic_descr = isset($_POST['pic_descr'])?$_POST['pic_descr']:' ';

	if ($row) {

		$osDB->query( 'update ! set tnpicture = ?, ins_time = ?, active=?, tnext=?, album_id = ?, pic_descr = ? where id = ?', array( USER_SNAP_TABLE, $tnimg, $time, $act, 	$tnext, $album_id, $pic_descr, $row['id'] ) );

	} else {

		$osDB->query( 'insert into ! (  userid, picno, tnpicture, ins_time, active, tnext, album_id, pic_descr ) values (  ?, ?, ?, ?, ?, ?, ?, ? )', array( USER_SNAP_TABLE,  $userid, $_POST['txtpicno'], $tnimg, $time, $act, $tnext, $album_id, $pic_descr ) );

	}

	updateLoadedPicturesCnt($userid);

	unset($tnimg);

	if ($config['newpic_admin_info'] == 'Y') {
		sendAdminEmail();
	}

	Header("Cache-Control: must-revalidate");

	$ExpStr = "Expires: " . gmdate("D, d M Y H:i:s", time() -30) . " GMT";
	Header($ExpStr);

	header( 'location: uploadsnaps.php?msg='.PICTURE_LOADED .'&type='.$type.'&album_id='.$album_id );
	exit;

} else {
	$default_pic = (isset($_REQUEST['default_pic']) && $_REQUEST['default_pic']=='Y')?'Y':'N';
	if ($type=='profilepics' && $default_pic == 'Y') {
		/* Make all other profile pics as non default */
		$osDB->query('update ! set default_pic = ? where userid=? and picno <> ? and ( album_id is null or  album_id = ?)', array(USER_SNAP_TABLE, 'N', $userid, $_POST['txtpicno'], '0') );
		$osDB->query('update ! set default_pic = ? where userid=? and picno = ? and ( album_id is null or album_id = ?)', array(USER_SNAP_TABLE, (isset($default_pic)?$default_pic:'N'), $userid, $_POST['txtpicno'], '0') );

		header( 'location: uploadsnaps.php?msg='.PROFILE_PIC_CHNGD .'&type='.$type.'&album_id='.$album_id );
		exit;
	}
}

header( 'location: uploadsnaps.php?msg='.FAILED_UPLOAD .'&type='.$type.'&album_id='.$album_id );
exit;

?>