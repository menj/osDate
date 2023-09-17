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
include( 'sessioninc.php' );

$userid = $_SESSION['UserId'];

$modified['username'] = $username = addslashes(stripEmails(strip_tags($_POST['txtusername'] )));

$modified['firstname'] = $firstname = (isset($_POST[ 'txtfirstname' ])? addslashes(stripEmails(strip_tags(trim($_POST[ 'txtfirstname' ])))):'');

$modified['lastname'] = $lastname = (isset($_POST[ 'txtlastname' ])? addslashes(stripEmails(strip_tags(trim($_POST[ 'txtlastname' ])))):'');

$modified['about_me'] = $about_me = (isset($_POST[ 'about_me' ])? addslashes(stripEmails(strip_tags(trim($_POST[ 'about_me' ])))):'');

$modified['email'] = $email = (isset($_POST[ 'txtemail']) ? addslashes(strip_tags(trim($_POST[ 'txtemail' ]))):'');

$modified['gender'] = $gender = $_POST[ 'txtgender' ];

$modified['couple_usernames'] = $couple_usernames = (isset($_POST[ 'couple_usernames' ])? addslashes(strip_tags(trim($_POST[ 'couple_usernames' ]))):'');

$modified['birthmonth'] = $birthmonth = (isset($_POST[ 'txtbirthMonth' ])? $_POST[ 'txtbirthMonth' ]:'');

$modified['birthday'] = $birthday = (isset($_POST[ 'txtbirthDay' ]) ? $_POST[ 'txtbirthDay' ]:'');

$modified['birthyear'] = $birthyear = (isset($_POST[ 'txtbirthYear' ])? $_POST[ 'txtbirthYear' ]:'');

$modified['birth_date'] = strtotime($birthyear.'-'.$birthmonth.'-'.$birthday);

$modified['country'] = $from = (isset($_POST[ 'txtfrom' ])? strip_tags($_POST[ 'txtfrom' ]):'');

$modified['county'] = $county = (isset($_POST[ 'txtcounty' ])? strip_tags($_POST[ 'txtcounty' ]):'');

$modified['zip'] = $zip = (isset($_POST[ 'txtzip' ])? strip_tags(trim($_POST[ 'txtzip' ])):'');

$modified['timezone'] = $timezone = (isset($_POST['txttimezone'])? $_POST['txttimezone']:'');

$modified['lookgender'] = $lookgender = (isset($_POST[ 'txtlookgender' ])? $_POST[ 'txtlookgender' ]:'');

$modified['lookagestart'] = $lookagestart = (isset($_POST[ 'txtlookagestart' ])? $_POST[ 'txtlookagestart' ]:'');

$modified['lookageend'] = $lookageend = (isset($_POST[ 'txtlookageend' ])? $_POST[ 'txtlookageend' ]:'');

$modified['city'] = $city = (isset($_POST[ 'txtcity' ])? trim($_POST[ 'txtcity' ]):'');

$modified['state_province'] = $stateprovince = (isset($_POST[ 'txtstateprovince' ])? addslashes(strip_tags(trim($_POST[ 'txtstateprovince' ]))):'');

$modified['address1'] = $address1 = (isset($_POST['txtaddress1' ])? addslashes(stripEmails(strip_tags(trim($_POST['txtaddress1' ])))):'');

$modified['address2'] = $address2 = (isset($_POST['txtaddress2' ])? addslashes(stripEmails(strip_tags(trim($_POST['txtaddress2' ])))):'');

$modified['lookcountry'] = $lookfrom = (isset($_POST[ 'txtlookfrom' ])?$_POST[ 'txtlookfrom' ]:'');

$modified['lookcounty'] = $lookcounty = (isset($_POST[ 'txtlookcounty' ])? addslashes(strip_tags($_POST[ 'txtlookcounty' ])):'');

$modified['lookcity'] = $lookcity = (isset($_POST[ 'txtlookcity' ])? addslashes(strip_tags(trim($_POST[ 'txtlookcity' ]))):'');

$modified['lookstate_province'] = $lookstateprovince = (isset($_POST[ 'txtlookstateprovince' ])? addslashes(strip_tags(trim($_POST[ 'txtlookstateprovince' ]))):'');

$modified['lookzip'] = $lookzip = (isset($_POST[ 'txtlookzip' ])? addslashes(strip_tags(trim($_POST[ 'txtlookzip' ]))):'');

$modified['allow_viewonline'] = $viewonline = (isset($_POST[ 'txtviewonline' ]) ? $_POST[ 'txtviewonline' ]:'');

$modified['lookradius'] = $lookradius = (isset($_POST['lookradius'])? addslashes(strip_tags(trim($_POST[ 'lookradius' ]))):'');

$modified['radiustype'] = $radiustype = (isset($_POST[ 'radiustype' ])? trim($_POST[ 'radiustype' ]):'');

$err =0;

if ( $config['accept_firstname'] == 'Y' or $config['accept_firstname'] =='1' ) {
	if ($config['firstname_mandatory'] == 'Y' && $firstname == '' ) {

		$err = FIRSTNAME_REQUIRED;
	}
	if (strlen( $firstname ) > 50 ) {

		$err = FIRSTNAME_LENGTH;
	}
	if ( strpos( $firstname, '@' ) > 0 ) {

		$err = FIRSTNAME_REQUIRED;
	}

} elseif ( $config['accept_lastname'] == 'Y' or $config['accept_lastname'] =='1' ) {
	if ($config['lastname_mandatory'] == 'Y' && $lastname == '' ) {

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

} elseif ( ! checkdate( $birthmonth, $birthday, $birthyear ) ) {

	$err = INVALID_BIRTHDATE;

} elseif (($config['accept_about_me'] == 'Y' or $config['accept_about_me'] =='1') &&  $config['about_me_mandatory'] == 'Y' && $about_me == '') {

	$err = ABOUT_ME_MANDATORY;

} elseif ($config['accept_country'] == 'Y' or $config['accept_country'] == '1') {

	if ($config['accept_state'] == 'Y' or $config['accept_state'] == "1") {

		if ( $stateprovince == '' && $config['state_mandatory'] == 'Y' ) {

			$err = STATEPROVINCE_NEEDED;

		} elseif ( $county == ''  && $config['county_mandatory'] == 'Y' && ($config['accept_county'] == 'Y' or $config['accept_county'] == "1")) {

			$err = COUNTY_REQUIRED;

		} elseif ($config['accept_city'] == 'Y' or $config['accept_city'] == "1") {

			if ($city == ''  && $config['city_mandatory'] == 'Y') {

				$err = CITY_REQUIRED;

			} elseif ( strlen( $city ) > 255 ) {

				$err = CITY_LENGTH;
			}

		} elseif ( $zip == ''  && $config['zipcode_mandatory'] == 'Y' && ($config['accept_zipcode'] == 'Y' or $config['accept_zipcode'] == "1")) {

			$err = ZIP_REQUIRED;
		}
	}

} elseif ( $lookageend < $lookagestart && ($config['accept_lookage'] == 'Y' or $config['accept_lookage'] == "1") ) {

	$err = BIGGER_STARTAGE;

} elseif ($timezone == '-25' && $config['timezone_mandatory'] == 'Y' && ($config['accept_timezone'] == 'Y' or $config['accept_timezone'] == "1" ) ) {

	$err = INVALID_TIMEZONE;

} elseif (checkDuplicateEmail($email, $userid) > 0) {
	$err = EMAIL_EXISTS;
}


if ($gender == 'C' ) {
	if (trim($couple_usernames) == '' or substr_count($couple_usernames,',') <= 0 or !isset($couple_usernames) ) {
		$err = COUPLE_USERNAMES_MISSING;
	} else {
		$userok = 0;
		$usrs=0;
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


$_SESSION['modifiedrow'] = $modified;

if (  $err != 0 ) {

	header ( "location: edituser.php?errid=$err" );

	exit();

}

$currec = $osDB->getRow('select * from ! where id = ?',array(USER_TABLE, $userid) );
$active = $currec['active'];
$status=$currec['status'];
$actkey = $currec['actkey'];
$modifiedcnt = 0;
if ($config['update_profile_inactive'] == 'Y') {
	/* if profile is modified, make it for approval  - get current user data */
	/* Now check if any field is modified  */
	$modify_fields=array('firstname','lastname','email','about_me','gender','birth_date','country','zip','city','state_province','county','address1','address2','lookcountry','lookcounty','lookstate_province','lookcity','lookzip','couple_usernames');

	foreach ($modify_fields as $k) {
		if ( $k == 'address1' && isset($modified[$k]) && (!isset($currec['address_line1']) || $modified[$k] != $currec['address_line1'] ) ) {
			$modifiedcnt++;
		} elseif ($k == 'address2' && isset($modified[$k]) && (!isset($currec['address_line2']) || $modified[$k] != $currec['address_line2'] ) ) {
			$modifiedcnt++;
		} elseif ($k != 'address1' && $k != 'address2' && isset($modified[$k]) && (!isset($currec[$k]) || $modified[$k] != $currec[$k] ) ) {
			$modifiedcnt++;
		}
	}

	if ($email != $currec['email'] && $config['bypass_regconfirm'] != 'Y') {
		/* Email is changed. Must reconfirm the profile */
		$actkey = md5( $email . time() );
		$active = '0';
	}

	if ($modifiedcnt > 0) {
		$status = 'approval';
	}
	
}

unset($modified);

/* now get the latitude and longitude for zip and lookzip */
if ($from == 'GB') {
   $ukzip = explode(' ',$zip);
   $zipcd = $ukzip[0];
} else {
	$zipcd = $zip;
}

$ziprec = $osDB->getRow('select latitude, longitude from ! where countrycode = ? and code = ? limit 1', array(ZIPCODES_TABLE, $from, $zipcd) );


//	$birthdate = strtotime ( $birthday . ' ' . $birthmonth . ' ' . $birthyear );
$birthdate = $birthyear . '-' . $birthmonth . '-' . $birthday;

$osDB->query( "UPDATE ! SET
					allow_viewonline 	= ?,
					email 				= ?,
					country 			= ?,
					firstname 			= ?,
					lastname 			= ?,
					gender 				= ?,
					lookgender 			= ?,
					lookagestart 		= ?,
					lookageend 			= ?,
					lookcountry 		= ?,
					address_line1 		= ?,
					address_line2 		= ?,
					state_province 		= ?,
					county 				= ?,
					city 				= ?,
					zip 				= ?,
					timezone 			= ?,
					lookzip				= ?,
					lookcity 			= ?,
					lookcounty 			= ?,
					lookstate_province 	= ?,
					lookradius			= ?,
					about_me			= ?,
					radiustype			= ?,
					couple_usernames	= ?,
					zip_latitude		= ?,
					zip_longitude		= ?,
					active				= ?,
					status				= ?,
					actkey				= ?,
					birth_date = ?
					WHERE id=?", array( USER_TABLE, $viewonline, $email, $from, $firstname, $lastname,  $gender, $lookgender, $lookagestart, $lookageend, $lookfrom, $address1, $address2, $stateprovince, $county, $city, $zip, $timezone, $lookzip, $lookcity, $lookcounty, $lookstateprovince, $lookradius, $about_me, $radiustype, $couple_usernames, (isset($ziprec['latitude'])?$ziprec['latitude']:''),(isset($ziprec['longitude'])?$ziprec['longitude']:''), $active, $status, $actkey, $birthdate, $userid ) );

unset($_SESSION['modifiedrow'] );

$_SESSION['FullName'] = $firstname . ' ' . $lastname;

if ($email != $currec['email'] ) {
	/* Email is changed. Must reconfirm the profile. Send email to user */

	$Subject = get_lang('profile_modify_email_sub');

	$From = $config['admin_email'];

	$To = $firstname.' '.$lastname.'<'.$email.'>';

	if ($config['bypass_regconfirm'] != 'Y') {
		$body = get_lang('profile_modify_email_noconfirm', MAIL_FORMAT);
	} else {
		$body = get_lang('profile_modify_email_confirm', MAIL_FORMAT);

		$body = str_replace( '#ConfCode#',  $actkey , $body );

		$body = str_replace( '#ConfirmationLink#',  HTTP_METHOD . $_SERVER['SERVER_NAME'] . DOC_ROOT . 'completemod.php?confcode' , $body );
	}
	
	$body = str_replace( '#FirstName#',  $firstname , $body );
	
	$body = str_replace( '#Email#',  $email , $body );

	$sendok = mailSender($From, $To, $email, $Subject, $body);
}

if ($config['update_profile_inactive'] == 'Y' && $modifiedcnt > 0 ) {
	/* Inform the admin about user profile changes */
    $opt_lang = $_SESSION['opt_lang'];

	$_SESSION['opt_lang'] = $config['admin_lang'];

	$body = get_lang('modifieduser', MAIL_FORMAT);

	$body = str_replace( '#UserName#',  $username , $body );

	$Subject = get_lang('modifieduser_sub'). ' - ' . $config['site_name'];

	$From = $config['admin_email'];

	$To = $config['admin_email'];

	$email = $config['admin_email'];

	$sendok=mailSender($From, $To, $email, $Subject, $body);

	$_SESSION['opt_lang'] = $opt_lang;

	$_SESSION['profmodified'] = 'Y';

	unset($opt_lang);
}

unset($firstname, $lastname);

/* 
$nextsectionid = $osDB->getOne('select id from ! where enabled = ? order by displayorder asc',array(SECTIONS_TABLE, 'Y') );

*/

header( 'location: edituser.php?');
?>