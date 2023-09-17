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

ob_start();
if ( !defined( 'SMARTY_DIR' ) ) {
	include_once( '../minimum_init.php' );
}
include_once(OSDATE_INC_DIR.'internal/snaps_functions.php');

if( (int)$_GET['id'] <= 0 ) {

	$userid = $_SESSION['UserId'];

} else {

	$userid = $_GET['id'];

}

$picid = isset($_GET['picid'])?$_GET['picid']:'1';

$typ = ( $_GET['typ'] != '') ? $_GET['typ'] : 'pic' ;

$gender = $osDB->getOne( 'select gender from ! where id = ?', array( USER_TABLE, $userid ) ) ;

$cond = '';
$sql = 'select * from ! where userid = ? and picno = ? '.$cond;

$row = $osDB->getRow ( $sql, array( USER_SNAP_TABLE, $userid, $picid ) );

$img = getPicture($userid, $picid, $typ, $row);

if ($typ = 'tn') { $ext = $row['tnext'];
} else {$ext = $row['picext']; }


if ( $img != '' ) {

	$img2 = $img;

	unset($img);

} else {

	if ($gender == 'M') {
		$nopic = SKIN_IMAGES_DIR.'male.jpg';
	} elseif ($gender == 'F') {
		$nopic = SKIN_IMAGES_DIR.'female.jpg';
	} elseif ($gender == 'C') {
		$nopic = SKIN_IMAGES_DIR.'couple.jpg';
	}

	$img2 = imagecreatefromjpeg($nopic);
	$ext = 'jpg';
}

 ob_end_clean();

 header("Pragma: public");
 header("Content-Type: image/".$ext);
 header("Content-Transfer-Encoding: binary");
 header("Cache-Control: must-revalidate");

 $ExpStr = "Expires: " . gmdate("D, d M Y H:i:s", time() - 30) . " GMT";

 header($ExpStr);
// header("Content-Disposition: attachment; filename=profile_".$userid."_".$typ.".jpg");

if ($ext == 'jpg') {
	imagejpeg($img2);
} elseif ($ext == 'gif') {
	imagegif($img2);
} elseif ($ext == 'png') {
	imagepng($img2);
} elseif ($ext == 'bmp') {
	imagewbmp($img2);
}

imagedestroy($img2);
?>