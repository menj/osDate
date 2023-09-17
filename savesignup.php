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

if (!isset($_SERVER['HTTP_REFERER']) || strstr( $_SERVER['HTTP_REFERER'], $_SERVER['HTTP_HOST']) === false)
{
die("Hacker attempt. Aborted");
}

if ( !defined( 'SMARTY_DIR' ) ) {
	include_once( 'init.php' );
}


/* PROMO CODE START */

$_SESSION['promocode'] = $pcode = isset($_POST[ 'promocode' ])?$_POST[ 'promocode' ]:'';

/* PROMO CODE END */

$_SESSION['firstname'] = $firstname = isset($_POST[ 'txtfirstname' ])?addslashes(stripEmails(strip_tags(trim($_POST[ 'txtfirstname' ])))):'';

$_SESSION['lastname'] = $lastname = isset($_POST[ 'txtlastname' ])? addslashes(stripEmails(strip_tags(trim($_POST[ 'txtlastname' ])))):'';

$_SESSION['username'] = $username = isset($_POST[ 'txtusername' ])?addslashes(stripEmails(strip_tags(trim($_POST[ 'txtusername' ])))):'';

$_SESSION['about_me'] = $about_me = isset($_POST[ 'about_me' ])?addslashes(stripEmails(strip_tags(trim($_POST[ 'about_me' ])))):'';

$password = isset($_POST[ 'txtpassword' ])?strip_tags(trim($_POST[ 'txtpassword' ])):'';

$password2 = isset($_POST[ 'txtpassword2' ])?strip_tags(trim($_POST[ 'txtpassword2' ])):'';

$_SESSION['password'] = $password;

$_SESSION['password2'] = $password2;

$_SESSION['email'] = $email = isset($_POST[ 'txtemail' ])?strip_tags(trim($_POST[ 'txtemail' ])):'';

$_SESSION['gender'] = $gender = isset($_POST[ 'txtgender' ])?trim($_POST[ 'txtgender' ]):'';

$birthmonth = isset($_POST[ 'txtbirthMonth' ])?trim($_POST[ 'txtbirthMonth' ]):'';

$birthday = isset($_POST[ 'txtbirthDay' ])?trim($_POST[ 'txtbirthDay' ]):'';

$birthyear = isset($_POST[ 'txtbirthYear' ])?trim($_POST[ 'txtbirthYear' ]):'';

$birthdate = $birthyear.'-'.$birthmonth.'-'.$birthday;

$_SESSION['selectedtime'] = @strtotime($birthdate);

$_SESSION['timezone'] = $timezone = isset($_POST[ 'txttimezone' ])?trim($_POST[ 'txttimezone' ]):'';

if (!($timezone) or $timezone == '') $_SESSION['timezone'] = $timezone = 0;

$_SESSION['lookgender'] = $lookgender = isset($_POST[ 'txtlookgender' ])?trim($_POST[ 'txtlookgender' ]):'';

// note: this is named txtlook.. to avoid conflict with the lookagestart and lookageend from init.php

$_SESSION['txtlookagestart'] = $lookagestart = (isset($_POST[ 'txtlookagestart' ]) && trim($_POST[ 'txtlookagestart' ])!='')?trim($_POST[ 'txtlookagestart' ]):0;
$_SESSION['txtlookageend'] = $lookageend = (isset($_POST[ 'txtlookageend' ]) && trim($_POST[ 'txtlookageend' ])!='')?trim($_POST[ 'txtlookageend' ]):0;

$_SESSION['from'] = $from = isset($_POST[ 'txtfrom' ])?trim($_POST[ 'txtfrom' ]):DEFAULT_COUNTRY;

$_SESSION['address1'] = $address1 = isset($_POST['txtaddress1' ])?addslashes(stripEmails(strip_tags(trim($_POST['txtaddress1' ])))):'';

$_SESSION['address2'] = $address2 = isset($_POST['txtaddress2' ])?addslashes(stripEmails(strip_tags(trim($_POST['txtaddress2' ])))):'';

$_SESSION['stateprovince'] = $stateprovince = (!isset($_POST[ 'txtstateprovince' ])||trim($_POST[ 'txtstateprovince' ])=='-1')?'AA':trim(addslashes(strip_tags($_POST[ 'txtstateprovince' ])));

$_SESSION['countycode'] = $county = (!isset($_POST['txtcounty']) ||trim($_POST[ 'txtcounty' ])=='-1')?'AA':trim(addslashes(strip_tags($_POST[ 'txtcounty' ])));

$_SESSION['citycode'] = $city = (!isset($_POST['txtcity']) || trim($_POST[ 'txtcity' ])=='-1')?'AA':trim(addslashes(strip_tags($_POST[ 'txtcity' ])));

$_SESSION['zip'] = $zip = (isset($_POST['txtzip']))?trim(addslashes(strip_tags($_POST[ 'txtzip' ]))):'';


$_SESSION['lookfrom'] = $lookfrom = isset($_POST[ 'txtlookfrom' ])?trim($_POST[ 'txtlookfrom' ]):'';

$_SESSION['lookstateprovince'] = $lookstateprovince = (!isset($_POST[ 'txtlookstateprovince' ]) ||trim($_POST[ 'txtlookstateprovince' ])=='-1')?'AA':trim(addslashes(strip_tags($_POST[ 'txtlookstateprovince' ])));

$_SESSION['lookcountycode'] = $lookcounty = (!isset($_POST[ 'txtlookcounty' ])||trim($_POST[ 'txtlookcounty' ])=='-1')?'AA':trim(strip_tags($_POST[ 'txtlookcounty' ]));

$_SESSION['lookcitycode'] = $lookcity = (!isset($_POST[ 'txtlookcity' ])||trim($_POST[ 'txtlookcity' ])=='-1')?'AA':trim(addslashes(strip_tags($_POST[ 'txtlookcity' ])));

$_SESSION['lookzip'] = $lookzip = (isset($_POST[ 'txtlookzip' ]))?trim(addslashes(strip_tags($_POST[ 'txtlookzip' ]))):'';

$_SESSION['lookradius'] = $lookradius = isset($_POST[ 'lookradius' ]) ? trim(addslashes(strip_tags($_POST[ 'lookradius' ]))):'';


$_SESSION['radiustype'] = $radiustype = isset($_POST[ 'radiustype' ]) ? trim($_POST[ 'radiustype' ]):'';

$_SESSION['viewonline'] = $viewonline = isset($_POST[ 'txtviewonline' ]) ? trim($_POST[ 'txtviewonline' ]):'';

$_SESSION['accept_tos'] = $accept_tos = isset($_POST[ 'accept_tos' ]) ? trim($_POST[ 'accept_tos' ]):'';

$_SESSION['couple_usernames'] = $couple_usernames = (isset($_POST['couple_usernames']))?addslashes(strip_tags(trim($_POST[ 'couple_usernames' ]))):'';


if ($viewonline == '' or !($viewonline)) $_SESSION['viewonline'] = $viewonline = 1;

//Check for duplicate user
$err =0;

if (substr_count($_SESSION['username'],' ') > 0 || strlen(trim($_SESSION['username'])) < $config['min_username_len'] || strlen(trim($_SESSION['username'])) > $config['max_username_len'] ) {
	$err = INVALID_USERNAME;
}

if (substr_count($password,' ') > 0 || strlen(trim($password)) < $config['min_pass_len'] || strlen(trim($password)) > $config['max_pass_len']) {
	$err = INVALID_PASSWORD;
}

if ( !preg_match('/^[a-zA-Z0-9\-_]+$/', $_SESSION['username']) ) {
	$err = INVALID_USERNAME;
}

if ($password != $password2 or substr_count($password,' ') > 0) {
	$err = INVALID_PASSWORD;
}

if ( $config['spam_code_length'] > 0 && (!isset($_SESSION['spam_code']) || !isset($_POST['spam_code']) || strtolower($_POST['spam_code']) != strtolower($_SESSION['spam_code'])  || $_SESSION['spam_code'] == NULL ) )  {

	$err = INVALID_SPAMCODE;

}

if ($err == '0') {
	$rowc = $osDB->getRow( 'SELECT count(*) as aacount from ! where username = ?', array( USER_TABLE, $username ) );
	if ( $rowc['aacount'] > 0) {
		$err = USERNAME_EXISTS;
	}
}

if ($err == '0') {
	$rowd = $osDB->getRow( 'SELECT count(*) as aacount from ! where username = ?', array( ADMIN_TABLE, $username )  );
	if ( $rowd['aacount'] > 0) {
		$err = USERNAME_EXISTS;
	}
}

if ($err == '0') {
	$rowe = $osDB->getRow( "SELECT count(*) as aacount from ! where email = ?", array( USER_TABLE, $email ) );
	if ( $rowe['aacount'] > 0 ) {
		$err = EMAIL_EXISTS;
	}
}

if ($err == '0') {
	if ( ! checkdate( $birthmonth, $birthday, $birthyear ) ) {

		$err = INVALID_BIRTHDATE;

	} elseif ( isset($config['accept_firstname']) && ($config['accept_firstname'] == 'Y' or $config['accept_firstname'] =='1' )) {
		if (isset($config['firstname_mandatory']) && $config['firstname_mandatory'] == 'Y' && $firstname == '' ) {

			$err = FIRSTNAME_REQUIRED;
		}
		if (strlen( $firstname ) > 50 ) {

			$err = FIRSTNAME_LENGTH;
		}
		if ( strpos( $firstname, '@' ) > 0 ) {

			$err = FIRSTNAME_REQUIRED;
		}

	} elseif ( isset($config['accept_lastname']) && ($config['accept_lastname'] == 'Y' or $config['accept_lastname'] =='1' ) ) {
		if (isset($config['lastname_mandatory']) && $config['lastname_mandatory'] == 'Y' && $lastname == '' ) {

			$err = LASTNAME_REQUIRED;
		}
		if (strlen( $lastname ) > 50 ) {

			$err = LASTNAME_LENGTH;
		}
		if ( strpos( $lastname, '@' ) > 0 ) {

			$err = LASTNAME_REQUIRED;
		}

	} elseif ( $email == '' ) {

		$err = EMAIL_REQUIRED;

	} elseif ( strlen( $email ) > 255 ) {

		$err = EMAIL_LENGTH;

	} elseif ( preg_replace( "/[A-Z0-9._%-]+@[A-Z0-9._%-]+\.[A-Z]{2,6}/i", "", $email ) != "" ) {

		$err = EMAIL_REQUIRED;

	} elseif ((isset($config['accept_about_me']) && ($config['accept_about_me'] == 'Y' or $config['accept_about_me'] =='1')) &&  (isset($config['about_me_mandatory']) && $config['about_me_mandatory'] == 'Y') && $about_me == '') {

		$err = ABOUT_ME_MANDATORY;

	} elseif (isset($config['accept_country']) && ($config['accept_country'] == 'Y' or $config['accept_country'] == '1' ) ) {

		if (isset($config['accept_state']) && ($config['accept_state'] == 'Y' or $config['accept_state'] == "1" ) ) {

			if ( isset($config['state_mandatory']) && $config['state_mandatory'] == 'Y' && $stateprovince == '' ) {

				$err = STATEPROVINCE_NEEDED;

			} elseif ( (isset($config['county_mandatory']) && $config['county_mandatory'] == 'Y') && (isset($config['accept_county']) && ($config['accept_county'] == 'Y' or $config['accept_county'] == "1") ) && $county == ''  ) {

				$err = COUNTY_REQUIRED;

			} elseif (isset($config['accept_city']) && ($config['accept_city'] == 'Y' or $config['accept_city'] == "1" ) ) {

				if (isset($config['city_mandatory']) && $config['city_mandatory'] == 'Y' && $city == ''  ) {

					$err = CITY_REQUIRED;

				} elseif ( strlen( $city ) > 255 ) {

					$err = CITY_LENGTH;
				}

			} elseif (isset($config['zipcode_mandatory']) && $config['zipcode_mandatory'] == 'Y' && (isset($config['accept_zipcode']) && ($config['accept_zipcode'] == 'Y' or $config['accept_zipcode'] == "1" ) ) &&  $zip == '') {

				$err = ZIP_REQUIRED;
			}
		}

	} elseif ( isset($config['accept_lookage']) && ($config['accept_lookage'] == 'Y' or $config['accept_lookage'] == "1") && $lookageend < $lookagestart  ) {

		$err = BIGGER_STARTAGE;

	} elseif ( isset($config['timezone_mandatory']) && $config['timezone_mandatory'] == 'Y' && (isset($config['accept_timezone']) &&  ($config['accept_timezone'] == 'Y' or $config['accept_timezone'] == "1" ) ) && $timezone == '-25') {

		$err = INVALID_TIMEZONE;

	}
}

if ($err == '0' && $gender == 'C' ) {
	if (trim($couple_usernames) == '' or substr_count($couple_usernames,',') <= 0 or !isset($couple_usernames) ) {
		$err = COUPLE_USERNAMES_MISSING;
	} else {
		$userok = 0;
		$usrs = 0;
		foreach(explode(',',$couple_usernames) as $k => $uname) {
			if (trim($uname) != '') {
				$user = $osDB->getOne('select username from ! where username = ?', array(USER_TABLE, trim($uname)) );
				$usrs++;
				if ($user != trim($uname)) {$userok++;}
			}
		}
		if ($userok > 0 ) {$err = 129; }
		if ($usrs < 2) {$err = COUPLE_USERNAMES_MISSING;}
	}
}

if ($err == '0' && $pcode != '') {
	/* Promo code entered. Check if this is available */
	$promocnt = $osDB->getOne('select count(*) from ! where promocode = ? and active > 0 ',array(PROMO_TABLE,$pcode) );

	if($promocnt <= 0) {
		/* No such promo code */
		$err = 141;
	}
}

if ($err == '0' && $config['accept_profpic_signup'] == 'Y' && $config['accept_profpic_signup_must'] == 'Y' && !is_uploaded_file( $_FILES['txtimage']['tmp_name'] ) ) {
	$err = 143;
}


if (  $err > 0 ) {

	header ( "location: signup.php?errid=$err" );
	exit();
}

@ini_set('memory_limit','20M');

$regIP = ( !empty($_SERVER['REMOTE_ADDR']) ) ? $_SERVER['REMOTE_ADDR'] : ( ( !empty($_ENV['REMOTE_ADDR']) ) ? $HTTP_ENV_VARS['REMOTE_ADDR'] : getenv('REMOTE_ADDR') );

$active =  0;

$lastvisit = $regdate = time();

$level = (isset($config['default_user_level']) && $config['default_user_level'] !='')? $config['default_user_level']:4;

$activedays = $osDB->getOne('select activedays from '.MEMBERSHIP_TABLE." where roleid = '$level'" );

$levelend = time();

$status = 'approval';


//$levelend = strtotime("+$activedays day",time());
if ($config['default_active_status'] == 'Y') {

	$levelend = strtotime("+$activedays day",time());

	// $status = get_lang('status_enum','active');
	$status = 'active';
}
if ($config['bypass_regconfirm'] == 'Y') {

	$active=1;

	$actkey = 'Confirmed';

	$status = 'active';

	$levelend = strtotime("+$activedays day",time());

	if ($pcode != '') {

		/* $promo_rec is already available as it is selected earlier */
		if ($promo_rec['memberlevel'] > 0) {

			$activedays = $osDB->getOne('select activedays from ! where roleid = ?', array( MEMBERSHIP_TABLE, $promo_rec['memberlevel'] ) );

			$levelend = strtotime("+$activedays day",time());

			// $status = get_lang('status_enum','active');
			$level = $promo_rec['memberlevel'];
		}

		if ($promo_rec['increasedays'] > 0) {

			$adddays = $promo_rec['increasedays'];

			$levelend = strtotime("+$adddays day",$levelend);
		}

	}

	$conf="1";

} else {

	$status='approval';

	$actkey = md5( $email . time() );

	$conf="0";

}

$rank = 1;

/* now get the latitude and longitude for zip and lookzip */
if ($from == 'GB') {
   $ukzip = explode(' ',$zip);
   $zipcd = $ukzip[0];
} else {
	$zipcd = $zip;
}

$ziprec = $osDB->getRow('select latitude, longitude from '.ZIPCODES_TABLE." where countrycode = '$from' and code = '$zipcd' limit 1");

if (!$ziprec) {
	$ziprec['longitude']='';
	$ziprec['latitude']='';
}

// $status =  get_lang('status_enum','approval') ;
if( isset($_FILES['txtimage']) && is_uploaded_file( $_FILES['txtimage']['tmp_name'] ) && exif_imagetype($_FILES['txtimage']['tmp_name'])!= ''  ) {
	include_once (OSDATE_INC_DIR."internal/snaps_functions.php");
//	$userid = $lastid;
	$err = 0;
	if($config['snaps_require_approval'] == 'Y') {
		$act = 'N';
	} else {
		$act = 'Y';
	}
	$curr_imgfile = $curr_tnimgfile = '';
	$allwdsize = $config['upload_snap_maxsize'];
	$time = time();
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
    if ( $ext_ok <= '0' or $picext == 'bmp') {
        header( 'location: signup.php?errid=57'  );
        exit;
    }
    clearstatcache();
    $fstats= stat($img_file);
    $picsize = $fstats[7];
    /* Get current picture size and allowed size. If pic size is more than the allowed size, flag error.. */
    if ($picsize > $allwdsize) {
        header( 'location: signup.php?errid=56'  );
        exit;
    }
}
$osDB->query ( "INSERT INTO !
				(
				active,
				username,
				password,
				lastvisit,
				regdate,
				level,
				timezone,
				allow_viewonline,
				rank,
				email,
				country,
				actkey,
				firstname,
				lastname,
				gender,
				lookgender,
				lookagestart,
				lookageend,
				lookcountry,
				address_line1,
				address_line2,
				state_province,
				county,
				city,
				zip,
				lookstate_province,
				lookcounty,
				lookcity,
				lookzip,
				lookradius,
				radiustype,
				birth_date,
				status,
				about_me,
				couple_usernames,
				zip_latitude,
				zip_longitude,
				levelend,
				regIP)
		 VALUES (  ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)", array( USER_TABLE, $active, $username, md5( $password ), $lastvisit, $regdate, $level, $timezone, $viewonline, $rank, $email, $from, $actkey, $firstname, $lastname, $gender, $lookgender, $lookagestart, $lookageend, $lookfrom, $address1, $address2, $stateprovince, $county, $city, $zip, $lookstateprovince, $lookcounty, $lookcity, $lookzip, $lookradius, $radiustype, $birthdate, $status,  $about_me, $couple_usernames,  $ziprec['latitude'], $ziprec['longitude'], $levelend, $regIP ) );

$lastid = $osDB->getOne('select id from ! where username = ?', array(USER_TABLE, $username));

/* Photo Upload START */
if( isset($_FILES['txtimage'])&& is_uploaded_file( $_FILES['txtimage']['tmp_name'] ) && exif_imagetype($_FILES['txtimage']['tmp_name'])!= ''  ) {

	$userid = $lastid;

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

	$_POST['txtpicno'] = 1;

	include_once (OSDATE_INC_DIR."internal/snaps_functions.php");

	$userimagedir = USER_IMAGE_DIR.$userid.'/';
	if (!file_exists($userimagedir)) {
		mkdir($userimagedir, 0777);
		chmod($userimagedir, 0777);
	}
	$userimagedir.='/';


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

	if ($config['images_in_db'] == 'N') {

		$imgfile = saveOriginalPictureFile($img_file, $userid, 'pic', $_POST['txtpicno'], $picext );

		$newimg = 'file:'.$imgfile;

		sleep(2);

	} else {

		$newimg = base64_encode(file_get_contents($img_file));
	}

	$pic_descr = isset($_POST['pic_descr'])?$_POST['pic_descr']:' ';

	$osDB->query( 'insert into ! (  userid, picno, picture, ins_time, active, picext, tnpicture, tnext, album_id, default_pic, pic_descr ) values (  ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ? )', array( USER_SNAP_TABLE, $userid, $_POST['txtpicno'], $newimg, time(), $act, $picext, $tnimg, $tnext, '0', 'Y', $pic_descr ) );

	updateLoadedPicturesCnt($userid);

	unset( $newimg, $tnimg);

	if ($config['newpic_admin_info'] == 'Y') {
		sendAdminEmail();
	}

	unlink($img_file);
}
/* Photo Upload END */

/* PROMO CODE START */

if (isset($promo_rec['promocode']) &&  $promo_rec['promocode'] != '' && $promo_rec['promocode'] != NULL ) {
	$osDB->query ( "INSERT INTO ! (userid, promocode, used_date) VALUES ( ?, ?, ?)", array( PROMO_USED_TABLE, $lastid, $promo_rec['promocode'], date('Y-m-d') ) );
}

/* PROMO CODE END */

//Store the id in session
$_SESSION['TempUserId'] = $lastid;

//update referals
if ( isset($_SESSION['ReferalId']) ) {

	$osDB->query( "INSERT INTO ! (  affid, userid ) VALUES (  ?, ? )", array( AFFILIATE_REFERALS_TABLE, $_SESSION['ReferalId'], $lastid ));

}

/* Create dummy activation key */
if (isset($config['bypass_regconfigm']) && $config['bypass_regconfigm'] == 'Y') {
	$actkey = md5( $email . time() );
}

$Subject = get_lang('profile_confirmation_email_sub');

$From = $config['admin_email'];

$To = $firstname.' '.$lastname.'<'.$email.'>';

$body = get_lang('profile_confirmation_email', MAIL_FORMAT);

$body = str_replace( '#FirstName#',  $firstname , $body );

$body = str_replace( '#ConfCode#',  $actkey , $body );

$body = str_replace('#Welcome#', get_lang('welcome'), $body);

$body = str_replace( '#ConfirmationLink#',  HTTP_METHOD . $_SERVER['SERVER_NAME'] . DOC_ROOT . 'completereg.php?confcode' , $body );

$body = str_replace( '#StrID#',  $username , $body );

$body = str_replace( '#Email#',  $email , $body );

$body = str_replace( '#Password#',  $password , $body );

$body = str_replace( '#Upgrade#',  get_lang('upgrade_membership') , $body );

$sendok = mailSender($From, $To, $email, $Subject, $body);
if ($config['newuser_admin_info'] == 'Y') {
	/* Now send email to admin about this new user signup */
    $opt_lang = isset($_SESSION['opt_lang'])?$_SESSION['opt_lang']: DEFAULT_LANG;

	$_SESSION['opt_lang'] = $config['admin_lang'];

	$body = get_lang('newuser', MAIL_FORMAT);

	$body = str_replace( '#UserName#',  $username , $body );

	$Subject = get_lang('newuser_sub'). ' - ' . $config['site_name'];

	$From = $config['admin_email'];

	$To = $config['admin_email'];

	$email = $config['admin_email'];

	$sendok=mailSender($From, $To, $email, $Subject, $body);

	$_SESSION['opt_lang'] = $opt_lang;

	unset($opt_lang);
}
unset($From, $To, $email, $Subject, $body);
if (!$sendok ) {
	header( 'location: confirmreg.php?conf='.$conf.'&err=301' );
} else {
	header( 'location: confirmreg.php?conf='.$conf );
}
?>
