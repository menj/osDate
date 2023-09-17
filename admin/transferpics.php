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


/* format:  admin/transferpics.php?action=xxxx&count=nnn
   xxxx  FS2DB - File system to Db
         DB2FS - Db to File System

   nnn   Number of pictures to be processed at one time
*/

if ( !defined( 'SMARTY_DIR' ) ) {
	include_once( '../init.php' );
}

include ( 'sessioninc.php' );

$action = isset($_REQUEST['action'])?$_REQUEST['action']:'DB2FS';

$count = 9999999;

function writeImageToFile($img, $userid, $picno, $file="") {
/* This routine will create an image file */
	if ($file == '') {
		$filename= time().$userid.$picno.'.jpg';
	} else {
		$filename = $file;
	}

	$img = imagecreatefromstring( $img );
	imagejpeg($img, USER_IMAGE_DIR.$userid.'/'.$filename);

	return ($filename);
}

if (isset($_REQUEST['count']) && $_REQUEST['count'] > 0) {$count = $_REQUEST['count']; }

if ($action != 'FS2DB' && $action != 'DB2FS') {
	echo("The format for calling this program is
	<br /><br />
	/admin/transferpics.php?action=xxx&count=nn
	<br /><br />
	xxx = FS2DB - File system to DB<br />
	      DB2FS - DB to File System<br />
	nn  = Number of pictures to be processed at one time<br />
	");
	exit;}

if ($action == 'FS2DB') {
	/* File system to DB transfer */
	$sql = 'SELECT id FROM ! WHERE picture like ? or tnpicture like ?';
} else {
	$sql = 'SELECT id FROM ! WHERE picture not like ? or tnpicture not like ?';
}

$rows = $osDB->getAll( $sql.' limit 0,!', array( USER_SNAP_TABLE, 'file:%', 'file:%', $count ) );

foreach($rows as $usr) {
	$row = $osDB->getRow("select * from ! where id = ?",array(USER_SNAP_TABLE, $usr['id']));
	/* Now process each record */
	if ($action == 'FS2DB') {
		/* Filesystem to DB transfer */
		if (substr_count($row['picture'], 'file:' )>0) {
			$imgfile = ltrim(rtrim(str_replace('file:','',$row['picture'] ) ) );
			$img = base64_encode(file_get_contents(USER_IMAGE_DIR.$imgfile));
			$osDB->query('update ! set picture=? where id=?', array(USER_SNAP_TABLE, $img, $row['id']) );
		}
		if (substr_count($row['tnpicture'], 'file:' )>0) {
			$imgfile = ltrim(rtrim(str_replace('file:','',$row['tnpicture'] ) ) );
			$img = base64_encode(file_get_contents(USER_IMAGE_DIR.$imgfile));
			$osDB->query('update ! set tnpicture=? where id=?', array(USER_SNAP_TABLE, $img, $row['id']) );
		}
	} else {
		/* DB to FileSystem */
		if (substr_count($row['picture'], 'file:' )<= 0 ) {
			$img = base64_decode ( $row['picture']  );
			$file = 'pic_'.$row['picno'].'.'.$row['picext'];
			$imgfile = writeImageToFile($img, $row['userid'], '1'.$row['picno'], $file);
			$img = 'file:'.$imgfile;
			$osDB->query('update ! set picture=? where id=?', array(USER_SNAP_TABLE, $img, $row['id']) );
		}
		if (substr_count($row['tnpicture'], 'file:' )<= 0 ) {
			$img = base64_decode ( $row['tnpicture']  );
			$file = 'tn_'.$row['picno'].'.'.$row['picext'];
			$imgfile = writeImageToFile($img, $row['userid'], '1'.$row['picno'],$file);
			$img = 'file:'.$imgfile;
			$osDB->query('update ! set tnpicture=? where id=?', array(USER_SNAP_TABLE, $img, $row['id']) );
		}
	}
}

$sql = str_replace('*','count(*)',$sql);
$balcnt = $osDB->getOne($sql, array( USER_SNAP_TABLE, 'file:%', 'file:%' ) );
if ($count == 9999999) $count='';
if ($balcnt > 0) {
	header("location: transferpics.php?action=".$action."&count=".$count);
	exit;
}
if ($action == 'FS2DB') {
	echo(" Pictures are transferred to DB");
} else {
	echo(" Pictures are transferred from DB");
}
exit;
?>