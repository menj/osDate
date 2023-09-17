<?php
/*
processImage.php
Copyright (C) 2004-2006 Peter Frueh (http://www.ajaxprogrammer.com/)

This library is free software; you can redistribute it and/or
modify it under the terms of the GNU Lesser General Public
License as published by the Free Software Foundation; either
version 2.1 of the License, or (at your option) any later version.

This library is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
Lesser General Public License for more details.

You should have received a copy of the GNU Lesser General Public
License along with this library; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301  USA
*/

/*
	This is adapted to osDate by Vijay Nair
*/

// required params: imageName

if ( !defined( 'SMARTY_DIR' ) ) {

	include_once( '../minimum_init.php' );

}

include (OSDATE_INC_DIR."internal/snaps_functions.php");

$originalDirectory = USER_IMAGE_EDITS_DIR.'original/'.$_SESSION['picedit']['userid'].'/';
$activeDirectory = USER_IMAGE_DIR.$_SESSION['picedit']['userid'].'/';
$editDirectory = USER_IMAGE_EDITS_DIR.$_SESSION['picedit']['userid'].'/';
$wmDirectory = USER_IMAGE_CACHE_DIR.$_SESSION['picedit']['userid'].'/';

$imageName = $_REQUEST['imageName'];

$action = $_REQUEST["action"];


if(empty($imageName) ||
	!file_exists($originalDirectory.$imageName) ||
	!file_exists($activeDirectory.$imageName) ||
	!file_exists($editDirectory.$imageName)) { echo "{imageFound:false}"; exit; }

switch($action){

	case "viewOriginal":
		copy($originalDirectory.$imageName, $editDirectory.$imageName);
		break;

	case "viewActive":
		copy($activeDirectory.$imageName, $editDirectory.$imageName);
		break;

	case "save":
		copy($editDirectory.$imageName, $originalDirectory.$imageName);
		copy($editDirectory.$imageName, $activeDirectory.$imageName);
		/* Now let us update DB and tnpicture details */

		$row = $osDB->getRow( 'SELECT id, picture, tnpicture FROM ! WHERE userid = ? AND picno = ?', array( USER_SNAP_TABLE, $_SESSION['picedit']['userid'], $_SESSION['picedit']['picid'] ) );

		$imageindb=1;
		if (substr_count($row['picture'], 'file:' )>0 ) {
			$curr_imgfile = ltrim(rtrim(str_replace('file:','',$row['picture'] ) ) );
			$imageindb='0';
		}
		if (substr_count($row['tnpicture'],'file:' )>0 ) {
			$curr_tnimgfile = ltrim(rtrim(str_replace('file:','',$row['tnpicture'] ) ) );
			$imageindb='0';
		}

		$picid = $_SESSION['picedit']['picid'];

		$userid = $_SESSION['picedit']['userid'];
		$picext = $tnext = 'jpg';
		$tnoutfile = 'tn_'.$picid.'.'.$tnext;
		$picoutfile = 'pic_'.$picid.'.'.$picext;
		if (($_SESSION['picedit']['generate_tnpic']=='Y' && $_SESSION['picedit']['typ'] == 'pic') || $_SESSION['picedit']['typ']=='tn') {
			$tnimg = createResizedPicture($editDirectory.$imageName, $config['upload_snap_tnsize'], $config['upload_snap_tnsize'] , $tnext);
			writePictureFile($tnimg, $activeDirectory.$tnoutfile);
			$tnimg = 'file:'.$tnoutfile;
			if (file_exists($wmDirectory.str_replace('.','_wm.',$tnoutfile)) ){
				@unlink($wmDirectory.str_replace('.','_wm.',$tnoutfile));
			}
			sleep(2);
		}
		if (file_exists($wmDirectory.str_replace('.','_wm.',$picoutfile))) {
			@unlink($wmDirectory.str_replace('.','_wm.',$picoutfile));
		}

		if ($config['images_in_db'] == 'Y') {
			if ($_SESSION['picedit']['typ']=='pic') {
				$outfile = 'pic_'.$picid.'.'.$picext;
				$newimg = base64_encode(file_get_contents($activeDirectory.$outfile));
				sleep(2);
			}
			if (( $_SESSION['picedit']['generate_tnpic']=='Y' && $_SESSION['picedit']['typ']=='pic' )  ||$_SESSION['picedit']['typ']=='tn') {
				$outfile = 'tn_'.$picid.'.'.$tnext;
				$tnimg = base64_encode(file_get_contents($activeDirectory.$outfile));
				@unlink($activeDirectory.$outfile);
				sleep(2);
			}
		}

		if ($_SESSION['picedit']['typ']=='pic') {
			if ($_SESSION['picedit']['generate_tnpic']=='Y') {
				$osDB->query('update ! set picture = ?,  picext=?, tnpicture = ?, tnext = ?, ins_time=? where userid = ? and picno = ? ', array( USER_SNAP_TABLE, $newimg, $picext, $tnimg, $tnext, time(),  $_SESSION['picedit']['userid'], $_SESSION['picedit']['picid'] ) );
			} else {
				$osDB->query('update ! set picture = ?,  picext=?, ins_time=? where userid = ? and picno = ? ', array( USER_SNAP_TABLE, $newimg, $picext,  time(),  $_SESSION['picedit']['userid'], $_SESSION['picedit']['picid'] ) );
			}
		} else {
			$osDB->query('update ! set  tnpicture = ?, tnext = ?, ins_time=? where userid = ? and picno = ? ', array( USER_SNAP_TABLE,  $tnimg, $tnext, time(),  $_SESSION['picedit']['userid'], $_SESSION['picedit']['picid'] ) );
		}
		
		/* Remove temporary image files */
		unlink($originalDirectory.$imageName);
		unlink($editDirectory.$imageName);
		if ($imageindb == '1') {
			unlink($activeDirectory.$imageName);
		}
		break;
	case "resize": // additional required params: w, h
		$out_w = $_REQUEST["w"];
		$out_h = $_REQUEST["h"];
		if (!is_numeric($out_w) || $out_w < 1 || $out_w > 2000 || !is_numeric($out_h) || $out_h < 1 || $out_h > 2000) { exit; }
		list($in_w, $in_h) = getimagesize($editDirectory.$imageName);
		$in = imagecreatefromjpeg($editDirectory.$imageName);
		$out = imagecreatetruecolor($out_w, $out_h);
		imagecopyresampled($out, $in, 0, 0, 0, 0, $out_w, $out_h, $in_w, $in_h);
		imagejpeg($out, $editDirectory.$imageName, 100);
		imagedestroy($in);
		imagedestroy($out);
		break;

	case "rotate": // additional required params: degrees (90, 180 or 270)
		$degrees = $_REQUEST["degrees"];
		if (($degrees != 90 && $degrees != 180 && $degrees != 270)) { exit; }
		$in = imagecreatefromjpeg($editDirectory.$imageName);
		if ($degrees == 180){
			$out = imagerotate($in, $degrees, 180);
		}else{ // 90 or 270
			$x = imagesx($in);
			$y = imagesy ($in);
			$max = max($x, $y);

			$square = imagecreatetruecolor($max, $max);
			imagecopy($square, $in, 0, 0, 0, 0, $x, $y);
			$square = imageRotate($square, $degrees, 0);

			$out = imagecreatetruecolor($y, $x);
			if ($degrees == 90) {
				imagecopy($out, $square, 0, 0, 0, $max - $x, $y, $x);
			} elseif ($degrees == 270) {
				imagecopy($out, $square, 0, 0, $max - $y, 0, $y, $x);
			}
			imagedestroy($square);
		}
		imagejpeg($out, $editDirectory.$imageName, 100);
		imagedestroy($in);
		imagedestroy($out);
		break;

	case "crop": // additional required params: x, y, w, h
		$x = $_REQUEST["x"];
		$y = $_REQUEST["y"];
		$w = $_REQUEST["w"];
		$h = $_REQUEST["h"];
		if (!is_numeric($x) || !is_numeric($y) || !is_numeric($w) || !is_numeric($h)) { exit; }
		$in = imagecreatefromjpeg($editDirectory.$imageName);
		$out = imagecreatetruecolor($w, $h);
		imagecopyresampled($out, $in, 0, 0, $x, $y, $w, $h, $w, $h);
		imagejpeg($out, $editDirectory.$imageName, 100);
		imagedestroy($in);
		imagedestroy($out);
		break;

}


list($w, $h) = getimagesize($editDirectory.$imageName);

header("Content-Type: text/plain");

echo '{imageFound:true,imageName:"'.$imageName.'",w:'.$w.',h:'.$h.'}';

?>