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

/* This include functions used while managing snaps */
if (!function_exists('saveOriginalPictureFile')) {

	function saveOriginalPictureFile($file, $userid, $typ, $picno, $ext, $curr_imgfile='') {
	/*	Vijay Nair
		Using the input file or current original picture file, it will create new original file in the newly defined directory based on the userid and pic type (tn/pic). The Current_imgfile is the old loaded file (for versions earlier than 2.5).
		Parameters:
			$file = Input picture file - If blank and $curr_imgfile is given, it will assume
					$curr_imgfile as input file
			$userid =	Userid
			$typ =	Type of picture (pic - original picture, tn - thumbnail picture
			$picno	=	Picture number for this user
			$curr_imgfile = Current image file.

			After creating the new file, if $curr_imgfile is given, it will destroy this file.

		Return the newly created file name, without directory part. Used to update the usersnaps table record.

	*/
		$userimagedir=USER_IMAGE_DIR.$userid.'/';
		if (!file_exists($userimagedir)) mkdir($userimagedir,0777);
		chmod($userimagedir,0777);
		if ($file != '') {
			copy($file,$userimagedir.$typ."_".$picno.".".$ext);
		} elseif ($curr_imgfile != '') {
			copy($curr_imgfile,$userimagedir.$typ."_".$picno.".".$ext);
		}
		chmod($userimagedir.$typ."_".$picno.".".$ext, 0755);
		if ($curr_imgfile != '' && file_exists(USER_IMAGE_DIR.$curr_imgfile) ) unlink(USER_IMAGE_DIR.$curr_imgfile);
		return($typ."_".$picno.".".$ext);
	}
}

function getPictureFileType($file) {
/* 	Vijay Nair
	This function will determine the image file type and return the image type
	Parameter: file
*/
	if(substr($file, -3)=="jpg" || substr($file, -3)=="JPG" || substr($file, -4)=="JPEG" || substr($file, -4)=="jpeg"){return ('jpg');}
	elseif(substr($file, -3)=="gif" || substr($file, -3)=="GIF"){return('gif');}
	elseif(substr($file, -3)=="png" || substr($file, -3)=="PNG"){return('png');}
	elseif(substr($file, -3)=="bmp" || substr($file, -3)=="BMP"){return('bmp');}
}

function createImg($file, $ext='') {
/*	Vijay Nair
	This function will create an image from the image file given and return the image.
	Parameter: file name
*/
	if ($ext == '') $ext = getPictureFileType($file);

	switch ($ext ) {
		case 'jpg':
	 		return(imagecreatefromjpeg($file));
			break;
		case 'gif':
			return(imagecreatefromgif($file));
			break;
		case 'png':
			return(imagecreatefrompng($file));
			break;
		case 'bmp':
			return(imagecreatefromwbmp($file));
	}
}

function createResizedPicture($infile, $width=0, $height=0, $picext='') {
/*  Vijay Nair
	This function will create a resized picture and return the resized picture.
	Parameters:
		infile = Either the input filename or contentes of image
		height = desired new height
		width = desired new width
		Size adjustments are based on proportions to keep original ratio.
*/

	if (is_file($infile)) {
		$imgx = createImg($infile, $picext);
	} else {
		$imgx = $infile;
	}

	$w = imagesx( $imgx );

	$h = imagesy( $imgx );

	$wdth = ($width > 0 )?$width:$w;

	$hght = ($height > 0)?$height:$h;

	if ( $wdth < $w or $hght < $h ) {

		if( $w > $h ) {
			$ratio = $w / $h;
			$nw = $wdth;
			$nh = $nw / $ratio;

		} else {
			$ratio = $h / $w;
			$nh = $hght;
			$nw = $nh /$ratio;
		}

	} else {

		if ($wdth >= $w) $nw = $w;
		if ($hght >= $h) $nh = $h;
	}
	$img2 = imagecreatetruecolor( $nw, $nh );

	imagecopyresampled($img2, $imgx, 0, 0, 0 , 0, $nw, $nh, $w, $h );

	imagedestroy($imgx);
	return($img2);
}

function writePictureFile($img, $outfile) {
/*	Vijay Nair
	This cuntion will create picture file.
	Parameters:
		$img = Image to be written in the file
		$outfile = Output file name (Full name with directory portion)
*/

	switch (getPictureFileType($outfile) ) {
		case 'jpg':
	 		imagejpeg($img, $outfile);
			break;
		case 'gif':
			imagegif($img, $outfile);
			break;
		case 'png':
			imagepng($img, $outfile);
			break;
		case "bmp":
			imagewbmp($img, $outfile);
	}
	chmod($outfile, 0755);
	imagedestroy($img);
}

function getPicture($userid, $picid, $typ, $row){
	/*  Vijay Nair
	This will check if the picture loaded is latest and the ins_time is after the watermark updated date. If not, it will create a new watermarked picture for selected type (tn/pic/full). IF not, it will check if there is a watermarked file available and the filetime of that. IF the filetime is later than the ins_time, then it will use that file. Otherwise, it will delete current file and create a new file with watermark. IF the file is not available, it will create the new watermarked file

	All watermarked files are in the folder CACHE_DIR/userid/ directory. The water marked file will be in the name  format xxxx_nnn_wm.ext where xxxx is the type of the picture (tn/pic/full), nnn is the picture number and ext is the picture extension.

	e.g. for userid 5 and picture 1, it will be CACHE_DIR/5/tn_1_wm.jpg, pic_1_wm.jpg, full_1_wm.jpg

	*/

	global $config;
	$ext = ($typ == 'tn')?$row['tnext']:$row['picext'];
	$wmfile=USER_IMAGE_CACHE_DIR.$userid."/".$typ."_".$picid."_wm.".$ext;
	if ((file_exists($wmfile) && (filemtime($wmfile) < $config['watermark_time'] || filemtime($wmfile) < $row['ins_time'] || is_null($row['ins_time']) ) ) || !file_exists($wmfile) ) {
		/* OK. Watermark is newly modified or new picture is loaded. Create a new watermarked file for this. */
		createWatermarkedFile($row, $typ, $wmfile);
	}
	return createImg($wmfile);
}

function createWatermarkedFile($row, $typ, $wmfile) {
	/* Vijay Nair
	This will create three watermarked file for selected type
	*/
	global $osDB, $config;

	$picid=$row['picno'];
	$userid = $row['userid'];
	$userimage_cache_dir = USER_IMAGE_CACHE_DIR.$userid.'/';
	$userimage_dir = USER_IMAGE_DIR.$userid.'/';
	if (!file_exists(USER_IMAGE_CACHE_DIR)) mkdir(USER_IMAGE_CACHE_DIR,0777);
	chmod(USER_IMAGE_CACHE_DIR,0777);
	if (!file_exists($userimage_dir) ) mkdir($userimage_dir,0777);
	chmod($userimage_dir,0777);
	if (!file_exists($userimage_cache_dir) ) mkdir($userimage_cache_dir,0777);
	chmod($userimage_cache_dir,0777);
	/* First let us do the thumbnail picture */
	if ($typ == 'tn') {
		if (substr($row['tnpicture'],0,5) == 'file:') {
			/* The picture is in file system */
			$tnimgfile = ltrim(rtrim(str_replace('file:','',$row['tnpicture']) ) );
			$userimage_tnfile = $userimage_dir.'tn_'.$row['picno'].'.'.$row['tnext'];
			if (!file_exists($userimage_tnfile) && file_exists(USER_IMAGE_DIR.$tnimgfile) ) {
				/* Create the tn file to suit new system and remove old file */
				$fl = saveOriginalPictureFile(USER_IMAGE_DIR.$tnimgfile, $userid, 'tn', $picid, $row['tnext'], $tnimgfile);
				$osDB->query('update ! set tnpicture=? where id = ?',array(USER_SNAP_TABLE,'file:'.$fl,$row['id']) );
			}
			$img = createImg($userimage_tnfile );
		} else {
			$img = imagecreatefromstring(base64_decode ( $row['tnpicture']  ) );
		}
	} else {
		/* Now work on picture.  */
		if (substr($row['picture'],0,5) == 'file:') {
			/* The picture is in file system */
			$imgfile = ltrim(rtrim(str_replace('file:','',$row['picture']) ) );
			$userimage_file = $userimage_dir.'pic_'.$row['picno'].'.'.$row['picext'];
			if (!file_exists($userimage_file) && file_exists(USER_IMAGE_DIR.$imgfile) ) {
				/* Create the tn file to suit new system and remove old file */
				$fl = saveOriginalPictureFile(USER_IMAGE_DIR.$imgfile, $row['userid'], 'pic', $row['picno'], $row['picext'],  $imgfile);
				$osDB->query('update ! set picture=? where id = ?',array(USER_SNAP_TABLE,'file:'.$fl,$row['id']) );
			}
			$img = createImg($userimage_file );
		} else {
			$img = imagecreatefromstring(base64_decode ( $row['picture'] ) );
		}

		if ($typ == 'pic') {
			$img = createResizedPicture($img, $config['disp_snap_width'], $config['disp_snap_height'], $row['picext']);
		}

		/* We need two watermark files - profpie picture size and full size. */
		/* First create a new profile picture with display picture size */
	}
	/* Now apply watermark */
	$w = imagesx( $img );

	$h = imagesy( $img );

	$img2 = imagecreatetruecolor( $w, $h );

	imagecopyresampled ( $img2, $img, 0, 0, 0 , 0, $w, $h, $w, $h );
	$image_height=$h;
	$image_width=$w;

	imagedestroy($img);

	$TEXT_SHADOW= $config['watermark_text_shadow']; // 1 - yes / 0 - no
	$TEXT_COLOR =$config['watermark_text_color']; // text color
	$WATERMARK_ALIGN_H = $config['watermark_position_h']; // left / right / center
	$WATERMARK_ALIGN_V = $config['watermark_position_v']; // top / bottom / middle
	$WATERMARK_MARGIN = $config['watermark_margin']; // margin

	if ( $config['watermark_snaps'] != ''  ){

	/* Watermark the picture  */
		$WATERMARK_TEXT_FONT='1'; // font 1 / 2 / 3 / 4 / 5
		$WATERMARK_TEXT= $config['watermark_snaps']; // Text

		$color = eregi_replace("#","", $TEXT_COLOR);
		$red = hexdec(substr($color,0,2));
		$green = hexdec(substr($color,2,2));
		$blue = hexdec(substr($color,4,2));

		$text_color = imagecolorallocate ($img2, $red, $green, $blue);

		$text_height=imagefontheight($WATERMARK_TEXT_FONT);
		$text_width=strlen($WATERMARK_TEXT)*imagefontwidth($WATERMARK_TEXT_FONT);
		$wt_y=$WATERMARK_MARGIN;
		if ($WATERMARK_ALIGN_V=='top') {
			$wt_y=$WATERMARK_MARGIN;
		} elseif ($WATERMARK_ALIGN_V=='bottom') {
			$wt_y=$image_height-$text_height-$WATERMARK_MARGIN;
		} elseif ($WATERMARK_ALIGN_V=='middle') {
			$wt_y=(int)($image_height/2-$text_height/2);
		}

		$wt_x=$WATERMARK_MARGIN;
		if ($WATERMARK_ALIGN_H=='left') {
			$wt_x=$WATERMARK_MARGIN;
		} elseif ($WATERMARK_ALIGN_H=='right') {
			$wt_x=$image_width-$text_width-$WATERMARK_MARGIN;
		} elseif ($WATERMARK_ALIGN_H=='center') {
			$wt_x=(int)($image_width/2-$text_width/2);
		}

		if ($TEXT_SHADOW=='1') {
			imagestring($img2, $WATERMARK_TEXT_FONT, $wt_x+1, $wt_y+1, $WATERMARK_TEXT, 0);
		}
		imagestring($img2, $WATERMARK_TEXT_FONT, $wt_x, $wt_y, $WATERMARK_TEXT, $text_color);

	} elseif ($config['watermark_image'] != '') {
		/* Watermarking with image  */

		$wt_file= ROOT_DIR.$config['watermark_image'];

		$lst2=getimagesize($wt_file);
		$image2_width=$lst2[0];
		$image2_height=$lst2[1];
		$image2_format=$lst2[2];

		if ($image2_format==2) {
		$wt_image=imagecreatefromjpeg($wt_file);
		} elseif ($image2_format==1) {
		$wt_image=imagecreatefromgif($wt_file);
		} elseif ($image2_format==3) {
		$wt_image=imagecreatefrompng($wt_file);
		}

		if ($wt_image) {

			$wt_y=$WATERMARK_MARGIN;
			if ($WATERMARK_ALIGN_V=='top') {
				$wt_y=$WATERMARK_MARGIN;
			} elseif ($WATERMARK_ALIGN_V=='bottom') {
				$wt_y=$image_height-$image2_height-$WATERMARK_MARGIN;
			} elseif ($WATERMARK_ALIGN_V=='middle') {
				$wt_y=(int)($image_height/2-$image2_height/2);
			}

			$wt_x=$WATERMARK_MARGIN;
			if ($WATERMARK_ALIGN_H=='left') {
				$wt_x=$WATERMARK_MARGIN;
			} elseif ($WATERMARK_ALIGN_H=='right') {
				$wt_x=$image_width-$image2_width-$WATERMARK_MARGIN;
			} elseif ($WATERMARK_ALIGN_H=='center') {
				$wt_x=(int)($image_width/2-$image2_width/2);
			}

			imagecopymerge($img2, $wt_image, $wt_x, $wt_y, 0, 0, $image2_width, $image2_height, $config['watermark_image_intensity']);
			imagedestroy($wt_image);
		}

	}
	writePictureFile($img2, $wmfile);
	unset($img2);
	chmod($wmfile, 0755);
}

function sendAdminEmail () {
/* Send email to admin */
	global $osDB, $userid, $config, $t;

    $opt_lang = $_SESSION['opt_lang'];

	$_SESSION['opt_lang'] = $config['admin_lang'];

	$siteurl = HTTP_METHOD. $_SERVER['SERVER_NAME'] . DOC_ROOT;

	$body = get_lang('newpic', MAIL_FORMAT);

	$Subject = get_lang('newpic_sub');

	$From = $To = $email = $config['admin_email'];

	$username = $osDB->getOne('select username from ! where id=?', array(USER_TABLE, $userid) );

	$t->assign("userid", $userid);
	$t->assign('picno', $_POST['txtpicno']);

	$body = str_replace( '#UserName#',  $username , $body );

	$body = str_replace( '#PicNo#',  $_POST['txtpicno'] , $body );

	$body = str_replace( '#smallPic#',  $t->fetch('smallPic.tpl') , $body );

	mailSender($From, $To, $email, $Subject, $body);

	$_SESSION['opt_lang'] = $opt_lang;

	unset($opt_lang, $body, $Subject, $email, $To, $From);
}

/* These two functions are kept for older version compatibility */
function createJpeg( $img , $reduce='Y') {

	global $config;
	global $userid;
	global $ext;
	$img = imagecreatefromstring($img);
	$tnsize = $config['upload_snap_tnsize'];

	//$img = imagecreatefrompng($org);

	$w = imagesx( $img );

	$h = imagesy( $img );

	if ($reduce == 'Y' && ($w > $tnsize || $h > $tnsize)) {

		if( $w > $h ) {
			$ratio = $w / $h;
			$nw = $tnsize;
			$nh = $nw / $ratio;
		} else {
			$ratio = $h / $w;
			$nh = $tnsize;
			$nw = $nh /$ratio;
		}
	} else {

		$nh = $h;
		$nw = $w;
	}

	$img2 = imagecreatetruecolor( $nw, $nh );

	imagecopyresampled ( $img2, $img, 0, 0, 0 , 0, $nw, $nh, $w, $h );

	$fimg = 'img_' . time().$userid . '.jpg';

	$real_tpath = TEMP_DIR;

	if(	$HTTP_ENV_VARS['OS'] == 'Windows_NT'){

		$real_tpath= str_replace( "\\", "\\\\", $real_tpath);

		$file = $real_tpath . "\\" . $fimg;

	}else{

		$file = $real_tpath . "/" . $fimg;

	}

	imagejpeg( $img2, $file );

	imagedestroy($img2);

	imagedestroy($img);

	return $file;
}


function writeImageToFile($img, $userid, $picno, $file="") {
/* This routine will create an image file */
	if ($file == '') {
		$filename= time().$userid.$picno.'.jpg';
	} else {
		$filename = $file;
	}

	$img = imagecreatefromstring( $img );

	writePictureFile($img, USER_IMAGE_DIR.$userid.'/'.$filename);

	return ($filename);
}



?>