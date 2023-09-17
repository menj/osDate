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


/* Common functions used in osDate */

/**
 * retrieves the user's browser type
 */
function getUserBrowser()
{
    global $HTTP_USER_AGENT, $_SERVER;
    if (!empty($_SERVER['HTTP_USER_AGENT'])) {
        $HTTP_USER_AGENT = $_SERVER['HTTP_USER_AGENT'];
    }
    elseif (getenv("HTTP_USER_AGENT")) {
        $HTTP_USER_AGENT = getenv("HTTP_USER_AGENT");
    }
    elseif (empty($HTTP_USER_AGENT)) {
        $HTTP_USER_AGENT = "";
    }

    if (preg_match('/MSIE ([0-9].[0-9]{1,2})/', $HTTP_USER_AGENT, $regs)) {
        $browser['agent'] = 'MSIE';
        $browser['version'] = $regs[1];
    }
    elseif (preg_match('/Mozilla\/([0-9].[0-9]{1,2})/', $HTTP_USER_AGENT, $regs)) {
        $browser['agent'] = 'MOZILLA';
        $browser['version'] = $regs[1];
    }
    elseif (preg_match('/Opera(\/| )([0-9].[0-9]{1,2})/', $HTTP_USER_AGENT, $regs)) {
        $browser['agent'] = 'OPERA';
        $browser['version'] = $regs[2];
    }
    else {
        $browser['agent'] = 'OTHER';
        $browser['version'] = 0;
    }

    return $browser['agent'];
}

// possibly eliminate?
function getNewWindowHref( $href, $width, $height ) {
    $uw = $width + 10;
    $uh = $height + 20;
    return "javascript:launchCentered( '$href', $uw, $uh, 'resizable=no,scrollbars=no' );";
}

/**
 * Determines if GD library is installed
 */
function gdInstalled() {
    return function_exists( 'gd_info' );
}

function getSetting( $name, $default=NULL ) {
    global $osDB, $site, $moduleKey;

    $value = $osDB->getOne( 'select value from '.MODULESETTINGS_TABLE." where name='$name' and site_key='$site' and module_key='$moduleKey'" );

    return isset( $value ) ? $value : $default;
}

function cut( $value, $len ) {
    return ( strlen($value) > $len ) ? substr( $value, 0, $len - 1) .'...' : $value;
}


/**
* This will remove HTML tags, javascript sections
* and white space. It will also convert some
* common HTML entities to their text equivalent.
* $conent should contain an HTML document.
* From PHP Manual.
*/
function stripHTMLTags( $content ) {

    $search = array ("'<script[^>]*?>.*?</script>'si",  // Strip out javascript
                     "'<\s*br\s*(\/)?>'i",              // Replace brs to spaces
                     "'<[\/\!]*?[^<>]*?>'si",           // Strip out html tags
                     "'([\r\n])[\s]+'",                 // Strip out white space
                     "'&(quot|#34);'i",                 // Replace html entities
                     "'&(amp|#38);'i",
                     "'&(lt|#60);'i",
                     "'&(gt|#62);'i",
                     "'&(nbsp|#160);'i",
                     "'&(iexcl|#161);'i",
                     "'&(cent|#162);'i",
                     "'&(pound|#163);'i",
                     "'&(copy|#169);'i",
                     "'&#(\d+);'");

    $replace = array ("",
                      " ",
                      "",
                      "\\1",
                      "\"",
                      "&",
                      "<",
                      ">",
                      " ",
                      chr(161),
                      chr(162),
                      chr(163),
                      chr(169),
                      "chr(\\1)");

    $content = preg_replace ($search, $replace, $content);

    return $content;
}

function getStates ($countrycode='US', $all='Y', $order='name') {

	global $osDB;

	$states = array();

	$recs = $osDB->getAll("select code, name  from ! where countrycode = '$countrycode' order by !", array( STATES_TABLE, $order ) );

	if (count($recs) <= 0) return $states;

	foreach ($recs as $rec) {
		if ($rec['code'] != 'AA') {
			$states[$rec['code']] = $rec['name'];
		}
	}

	$recs = array();

	if ($all == 'Y') {
		$states['AA'] = (isset($states['AA']) && $states['AA']!='')?$states['AA']:'All States';
	}
	foreach ($states as $key => $val) {
			$recs[$key] = $val;
	}
	unset($states);
	return $recs;
}

function getCounties ($countrycode='US', $statecode = 'AA', $all='Y', $order='name') {

	global $osDB;

	$counties = array();

	if ($statecode == 'AA' || $statecode == '-1') {
		$sql = 'select code, name from ! where countrycode = ?  order by !';
		$recs = $osDB->getAll($sql, array( COUNTIES_TABLE, $countrycode,  $order ) );
	} else {
		$sql = 'select code, name from ! where countrycode = ? and statecode = ? order by !';
		$recs = $osDB->getAll($sql, array( COUNTIES_TABLE, $countrycode, $statecode, $order ) );
	}

	if (count($recs) <= 0) return $counties;

	foreach ($recs as $rec) {
		if ($rec['code'] != 'AA') {
			$counties[$rec['code']] = $rec['name'];
		}
	}

	$recs = $counties;

	$counties=array();
	if ($all == 'Y') {

		$counties['AA'] = (isset($recs['AA']) && $recs['AA']!='')?$recs['AA']:'All Counties/Districts';

	}
	foreach ($recs as $key => $val) {
		$counties[$key] = $val;
	}

	unset($recs);
	return $counties;

}

function getCities ($countrycode='US', $statecode = 'AA', $countycode = 'AA', $all='Y', $order='name') {

	$cities = array();

	global $osDB;

	$statesel = ($statecode == 'AA' || $statecode == '-1')?'':" and statecode ='".$statecode."' ";
	$countysel = ($countycode == 'AA' || $countycode == '-1')?'':" and countycode= '".$countycode."' ";

	$sql = 'select code, name from ! where countrycode = ? ! ! order by !';
	
	$recs = $osDB->getAll($sql, array( CITIES_TABLE, $countrycode, $statesel, $countysel, $order ) );
	if (count($recs) <= 0) return $cities;

	foreach ($recs as $rec) {
		if ($rec['code'] != 'AA') {
			$cities[$rec['code']] = $rec['name'];
		}
	}

	$recs = $cities;

	$cities=array();
	if ($all == 'Y') {

		$cities['AA'] = (isset($recs['AA']) && $recs['AA']!='')?$recs['AA']:'All Cities/Towns';

	}
	foreach ($recs as $key => $val) {
		$cities[$key] = $val;
	}
	unset($recs);
	return $cities;

}

function getCityName($countrycode = 'US', $statecode, $citycode, $countycode = null) {
	global $osDB;
	if ($countycode != '') {
		$cityname = $osDB->getOne("select name from ".CITIES_TABLE." where countrycode = '$countrycode'  and statecode = '$statecode'  and code = '$citycode' and countycode = '$countycode' ");
	} else {
		$cityname = $osDB->getOne("select name from ".CITIES_TABLE." where countrycode = '$countrycode'  and statecode = '$statecode'  and code = '$citycode' and ifnull(countycode,'AA') = 'AA' ");
	}

	if (!isset($cityname) || $cityname == '' ) $cityname = $citycode;
	return $cityname;
}

function getZipcodes ($countrycode='US', $statecode = 'AA', $countycode = 'AA', $citycode = 'AA', $all='Y', $order='code') {

	$zipcodes = array();
	global $osDB;

	$statesel = ($statecode == 'AA' || $statecode =='-1')?'':" and statecode ='$statecode' ";
	$countysel = ($countycode == 'AA' || $countycode =='-1')?'':" and countycode= '$countycode' ";
	$citysel = ($citycode == 'AA' || $citycode == '-1')?'':" and citycode= '$citycode' ";
	$sql = "select code, code as cd1 from ".ZIPCODES_TABLE." where countrycode = '$countrycode'  $statesel  $countysel $citysel order by ".$order;

	$recs = $osDB->getAll($sql, array( ZIPCODES_TABLE, $countrycode, $statesel, $countysel, $citysel) );

	if (count($recs) <= 0)	return $zipcodes;

	foreach ($recs as $rec) {
		if ($rec['code'] != 'AA') {

			$zipcodes[$rec['code']] = $rec['cd1'];
		}
	}

	$recs = $zipcodes;

	$zipcodes=array();
	if ($all == 'Y') {

		$zipcodes['AA'] = (isset($recs['AA']) && $recs['AA']!='')?$recs['AA']:'All Zip/Pin Codes';

	}
	foreach ($recs as $key => $val) {
		$zipcodes[$key] = $val;
	}
	unset($recs);
	return $zipcodes;

}

function zipsAvailable($cntry_code) {
	/* Function to check if zip code data is available for this country */

	global $osDB;

	$ret = $osDB->getOne('select count(*) from '.ZIPCODES_TABLE." where countrycode = '$cntry_code' ");

	if (isset($ret) && $ret > 0) return $ret;

	return 0;

}

function mailSender($hdr_from, $hdr_to, $email, $subject, $body, $attachment='') {
/*
This is a wrapper function for sending emails
	$hdr_from  - THe from address to be kept in the header
	$hdr_to    - The to name and address to be kept in the Header
	$email     - Email address to which the mail to be sent
	$subject   - Subject of the email
	$body      - The body of the email
	$attachment - Mail Attachment
*/

/* 	With effect from osDate 2.5, this function is used to save the outgoing mail into Table.
	The cronjob sendmails.php will send mails based on the parameter set in Global Configuration
	This is to enable staggered mail sending suitable for some mail servers.

*/
	/* Construct the header portion */

	/* clear html injects Begin */

	$hdr_from = stripslashes(clearPost($hdr_from));
	$hdr_to = stripslashes(clearPost($hdr_to));
	$email = clearPost($email);
	$subject = clearPost($subject);
	$body = clearPost($body);

	/* Html inject removed */

	$siteurl = HTTP_METHOD . $_SERVER['SERVER_NAME'] . DOC_ROOT;

	global $bannerURL, $config, $t, $osDB;


	if (strtolower(MAIL_FORMAT) == 'html') {

		$body = str_replace('#email_hdr_left#', $t->fetch('email_hdr_left.tpl'), $body);

		$t->assign('message',$body);

		$body = $t->fetch('html_emails.tpl');
	}

	$body = str_replace('#AdminName#', $config['admin_name'], $body);

	$siteurl = str_replace('cronjobs/','',HTTP_METHOD . $_SERVER['SERVER_NAME'] . DOC_ROOT) ;

	$body = str_replace('#link#', $siteurl,$body);

	$body = str_replace('#SiteUrl#', $siteurl,$body);

	$body = str_replace('#SkinName#', $config['skin_name'],$body);

	$body = str_replace('#siteName#', $config['site_name'], $body);

	$body = str_replace('#SiteName#', $config['site_name'], $body);

	$body = str_replace('#AdminEmail#', $config['admin_email'], $body);

	if (MAIL_FORMAT == 'text') {

/*		$body = str_replace('<br>',$crlf,$body);
		$body = str_replace('<br />',$crlf,$body);
		$body = str_replace('<br/>',$crlf,$body);
*/
		// replace site link with full URL

		$body = str_replace('#SiteUrlLogin#', $siteurl.'login.php',str_replace("#AdminEmail#",$config['admin_email'],get_lang('mail','hdr_text'))).$body;

		// remove any final tags
		$body = strip_tags( $body );

//		$mail->setTextBody($body);

	} else {

		$body = str_replace("#SiteUrlLogin#",$siteurl.'login.php',str_replace("MAIL_HDR",str_replace("#AdminEmail#",$config['admin_email'],get_lang('mail','hdr_html')),$body));

		/* Add banner advertisement if set in configuration settings */
		if (($config['banner_in_emails'] == 'Y' || $config['banner_in_emails'] == '1') && $bannerURL != '') {
			$body = $body.'<font style="font-size: 9px;"><br>Advertisement</font><br>'.str_replace('banclick.php',$siteurl.'banclick.php',stripslashes($bannerURL));
		}

		$parserfile = OSDATE_INC_DIR.'internal/css_parser.php';
		require_once($parserfile);

		$cssparser =  new cssParser();
		//$css is css stylesheet string
		//$cssparser->ParseStr($css);
		$cssfile = ROOT_DIR.'templates/'.$config['skin_name'].'/email.css';

		$cssparser->parseFile($cssfile);

		$htmlholder = new htmlHolder($body);

		$htmlholder->replaceCSS($cssparser->codestr_holder);

		$body = $htmlholder->out();

		$body = str_replace('#SiteUrl#', $siteurl,$body);

		$body = str_replace('#SkinName#', $config['skin_name'],$body);

//		$mail->setHTMLBody($body);

	}

	$row = array();
	$row['hdr_from'] = addslashes($hdr_from);
	$row['hdr_to'] = addslashes($hdr_to);
	$row['email'] = addslashes($email);
	$row['mail_subject'] = addslashes($subject);
	$row['message'] = addslashes($body);
	if (is_array($attachment) ) $attach_files = implode(',',$attachment);
	else $attach_files = $attachment;
	$row['attachment'] = $attach_files;

	if (($config['mail_queue'] != 'Y' && $config['mail_queue'] != '1') || (($config['mail_queue'] == 'Y' || $config['mail_queue'] == '1')  && $config['mail_queuecount'] <= '0') ) {
		return sendMail($row);
	}
	/* store the email data in internal table */
	$osDB->query('insert into ! (hdr_from, hdr_to, email, mail_subject, message, attachment) values (?, ?, ?, ?, ?, ?)', array(OUT_MAILS_TABLE, $row['hdr_from'],$row['hdr_to'], $row['email'], $row['mail_subject'], $row['message'], $row['attachment']) );
	return true;
}

function sendMail($row) {
/*
	This function will send outgoing mail using the mail gateway set up.
	Also, this will stagger sending of emails based on the parameter set for this purpose.

*/
	if (substr(phpversion(),0,1) == '4') {
		/* php 4 */
		require_once LIB_DIR . 'sendMimeMail_php4.php';
	} else {
		require_once LIB_DIR . 'sendMimeMail.php';
	}
	global $config, $osDB;

	$mail = new sendMimeMail();

	$mail->setFrom(stripslashes($row['hdr_from']));

	$mail->setSubject(stripslashes($row['mail_subject']));

    $mail->setPriority('medium');

	/* modify the encoding in mine with what is given for chosen language */
	$mail->build_params['html_encoding'] = new QPrintEncoding();
	$mail->build_params['text_encoding'] = new SevenBitEncoding();
	$mail->build_params['html_charset']  = get_lang('mail_html_charset');
	$mail->build_params['text_charset']  = get_lang('mail_text_charset');
	$mail->build_params['head_charset']  = get_lang('mail_head_charset');
	$mail->build_params['text_wrap']     = 998;
	if (MAIL_FORMAT == 'text') {
		$mail->setTextBody(stripslashes($row['message']));
	} else {
		$mail->setHTMLBody(stripslashes($row['message']));
	}
	if (!is_array($row['attachment']) ) {
		if (substr_count($row['attachment'],',') > 0) {
			$attach_files = explode(',',$row['attachment']);
		} else {
			$attach_files[0]=$row['attachment'];
		}
	} else {
		$attach_files = $row['attachment'];
	}

	if (count($attach_files) > 0) {
		foreach ($attach_files as $_k => $_v) {
			if ($_v != '') {
				if( file_exists("../emailimages/".$_v) ) {
					$mail->addAttachment("../emailimages/".$_v);
				}
				elseif( file_exists($_v) ) {
					$_filename = is_string($_k) ? $_k : '';
					$mail->addAttachment($_v, 'application/octet-stream', $_filename);
				}
			}
		}
	}
	if ($config['MAIL_TYPE'] == 'smtp') {
		$host = ($config['SMTP_HOST']!='SMTP_HOST')?$config['SMTP_HOST']:'localhost';
		$port = ($config['SMTP_PORT']!='SMTP_PORT')?$config['SMTP_PORT']:'25';
		$auth = ($config['SMTP_AUTH']=='1') ? true : false ;
		$user = ($config['SMTP_USER']!='SMTP_USER')?$config['SMTP_USER']:'';
		$pass = ($config['SMTP_PASS'])?$config['SMTP_PASS']:'';
		$helo = null;
	    $mail->setSMTPParams($host, $port, $helo, $auth, $user, $pass);
	}


	if ( trim( $config['MAIL_TYPE'] ) == '' ) {
		$mail_type = 'mail';
	}
	else {
		$mail_type = ($config['MAIL_TYPE']!='MAIL_TYPE')?$config['MAIL_TYPE']:'smtp';
	}

	$result = $mail->send(array( stripslashes($row['email'])), $mail_type ) ;

	if ($result=== false) {
		return false;
	} else {
		return true;
	}

}
function process_payment_info($params) {

	global $osDB;

	// get the user information for this transaction

	$trnrec=$osDB->getRow('select * from ! where id = ? ', array(TRANSACTIONS_TABLE, $params['pay_txn_id'] ));

	$user_id = $trnrec['user_id'];

	$user_level		= $trnrec['to_membership'];

	$levelvars = $osDB->getRow( 'select activedays, name from ! where roleid = ?', array( MEMBERSHIP_TABLE, $user_level ) );

	$activedays		= $levelvars['activedays'];
	$level_name		= $levelvars['name'];

	if ( $params['valid'] && $trnrec['payment_status'] != 'Completed') {

		$osDB->query( 'update ! set payment_email = ?, amount_paid = ?, txn_id = ?, txn_date = ?, payment_vars = ?, payment_status=? where id = ?', array( TRANSACTIONS_TABLE, $params['email'], $params['amount'], $params['txn_id'], date('Y-m-d'), $params['vars'], $params['payment_status'], $params['pay_txn_id'] ) );

		// determine when this user's membership was to expire, then extend it by $activedays days

		if (trim($params['payment_status']) == 'Completed') {
			$curlevel = $osDB->getRow( 'select levelend, level from ! where id = ?', array( USER_TABLE, $user_id ) );

			$levelend = $curlevel['levelend'];

			if ( $levelend < time() ) {
				$levelend = time();
			}

			// new expiration date for this member

			if ($curlevel['level'] != $user_level) {

				$levelend = strtotime( "+$activedays day", time() );

			} else {

				$levelend = strtotime( "+$activedays day", $levelend );

			}

			$osDB->query( 'UPDATE ! SET level = ?, levelend = ? WHERE id = ?', array( USER_TABLE, $user_level, $levelend, $user_id ) );
		}
	}

	return $level_name;
}

function getTplFile ($resource_type, $resource_name, &$template_source, &$template_timestamp, &$smarty_obj)
{
	global $skin_name;
	if ( !is_readable ( $resource_name )) {
		// create the template file, return contents.
		$new_resource = str_replace('/templates/'.$skin_name.'/','/templates/default/',$smarty_obj->template_dir).$resource_name;
		$template_timestamp = filemtime($new_resource);
		$template_source = file_get_contents($new_resource);
		return true;
	}

}


## clear html injects Begin ##
function clearPost($post_val) // remove email headder injects
{
	$injection_strings = array(
	"'apparently-to' i",
	"'bcc:' i",
	"'cc:' i",
	"'to:' i",
	"'boundary=' i",
	"'charset:' i",
	"'content-disposition' i",
	"'content-type' i",
	"'content-transfer-encoding' i",
	"'errors-to' i",
	"'in-reply-to' i",
	"'message-id' i",
	"'mime-version' i",
	"'multipart/mixed' i",
	"'multipart/alternative' i",
	"'multipart/related' i",
	"'reply-to:' i",
	"'x-mailer' i",
	"'x-sender' i",
	"'x-uidl' i"
	);

	$replace_strings = array(
	"apparently_to",
	"bcc_:",
	"cc_:",
	"to_:",
	"boundary_=",
	"charset_:",
	"content_disposition",
	"content_type",
	"content_transfer_encoding",
	"errors_to",
	"in_reply_to",
	"message_id",
	"mime_version",
	"multipart_mixed",
	"multipart_alternative",
	"multipart_related",
	"reply_to:",
	"x_mailer",
	"x_sender",
	"x_uidl"
	);


	$post_val = preg_replace($injection_strings, $replace_strings, $post_val);


	return $post_val;
} //function clearPost


function DeleteCacheFiles($fromdir, $tm, $recursed = 1 ) {
	if ($fromdir == "" or !is_dir($fromdir)) {
		echo ('Invalid directory');
		return false;
	}

	$filelist = array();
	$dir = opendir($fromdir);

	while($file = readdir($dir)) {
		if($file == "." || $file == ".." || $file == 'readme.txt' || $file == 'index.html' || $file == 'index.htm' || $file == 'lasttime.dat' ) {
			continue;
		} elseif (is_dir($fromdir."/".$file)) {
			if ($recursed == 1) {
				$temp = DeleteCacheFiles($fromdir."/".$file, $recursed);
			}
		} elseif (file_exists($fromdir."/".$file) && filemtime($fromdir."/".$file) < $tm) {
			unlink($fromdir."/".$file);
		}
	}

	closedir($dir);

	return true;
}


function deleteCache() {
	global $config;
	/* This function will delete cache files.. */
	$tm = time() - $config['time_cache_expiry']*60;
	$lasttime = 0;
	if (is_readable(CACHE_DIR.'lasttime.dat')) {
		$lt = file(CACHE_DIR.'lasttime.dat');
		$lasttime = trim($lt[0]);
	}
	if ($lasttime < $tm) {
		DeleteCacheFiles(CACHE_DIR,$tm);
		$fp = @fopen(CACHE_DIR.'lasttime.dat','wb');
		if ($fp) {
			fwrite($fp, time());
			fclose($fp);
		}
	}
}

function updateLoadedPicturesCnt($userid) {
	global $osDB;
	/* This function will update teh User Table for the loaded picture count */
	$picscnt = $osDB->getOne('select count(*) from ! where userid = ?',array(USER_SNAP_TABLE, $userid));
	$osDB->query('update ! set pictures_cnt = ? where id = ?',array(USER_TABLE, $picscnt, $userid));
}

function updateLoadedVideosCnt($userid) {
	global $osDB;
	/* This function will update teh User Table for the loaded picture count */
	$vdscnt = $osDB->getOne('select count(*) from ! where userid = ?',array(USER_VIDEOS_TABLE, $userid));

	$osDB->query('update ! set videos_cnt = ? where id = ?',array(USER_TABLE, $vdscnt, $userid));
}

function stripEmails( $instring )
{
/* Thanks to premiumMatch for providing this function code */

	$replacementString = " = email Address Removed = ";

	// normal email format
	$instring = preg_replace( "/[A-Z0-9._%-]+@[A-Z0-9._%-]+\.[A-Z]{2,6}/i", $replacementString, $instring );

	// "at dot" format
	$instring = preg_replace( "/[A-Z0-9._%-]+ at [A-Z0-9._%-]+ dot [A-Z]{2,6}/i", $replacementString, $instring );

	return $instring;
}

function deleteUser($userId) {
	/* Delete profile routine */
	global $osDB, $config;

	$rec = $osDB->getRow('select username from ! where id = ?', array( USER_TABLE, $userId) );

	$username = $rec['username'];

	$osDB->query('delete from ! where userid = ? or ref_userid = ?', array(BUDDY_BAN_TABLE, $userId, $userId) );

	$osDB->query('delete from ! where userid=?', array(FEATURED_PROFILES_TABLE, $userId ) );

	$osDB->query('delete from ! where senderid = ? or recipientid = ?', array(INSTANT_MESSAGE_TABLE, $userId, $userId) );

	$osDB->query('delete from ! where senderid = ? or recipientid = ?', array(MAILBOX_TABLE, $userId, $userId) );

	$osDB->query('delete from ! where userid=?', array(ONLINE_USERS_TABLE, $userId ) );

	$osDB->query('delete from ! where userid = ? or profileid = ?', array(USER_RATING_TABLE, $userId, $userId ) );

	$osDB->query('delete from ! where userid=?', array(USER_SEARCH_TABLE, $userId ) );

	$osDB->query('delete from ! where userid=?', array(USER_PREFERENCE_TABLE, $userId ) );

	$osDB->query('delete from ! where owner = ? or friend = ?', array(DB_PREFIX.'_myFriends_friends', $userId, $userId) );

	/* Now delete all picture files */
	$pic_recs = $osDB->getAll('select * from ! where userid=?',array(USER_SNAP_TABLE,$userId) );

	if (count($pic_recs) > 0) {
		foreach ($pic_recs as $row) {
			if (substr_count($row['picture'], 'file:' )>0 ) {
				$imgfile = ltrim(rtrim(str_replace('file:','',$row['picture'] ) ) );
				@unlink(USER_IMAGE_DIR.$imgfile);
			}
			if (substr_count($row['tnpicture'],'file:' )>0 ) {
				$imgfile = ltrim(rtrim(str_replace('file:','',$row['tnpicture'] ) ) );
				@unlink(USER_IMAGE_DIR.$imgfile);
			}
		}
	}
	$osDB->query('delete from ! where userid=?', array(USER_SNAP_TABLE, $userId ) );

	$osDB->query('delete from ! where userid=?', array(USER_VIDEOS_TABLE, $userId ) );

	$osDB->query('delete from ! where username = ? ', array(USERALBUMS_TABLE, $username) );

	$osDB->query('delete from ! where userid = ? or ref_userid = ?', array(VIEWS_WINKS_TABLE, $userId, $userId) );

	$osDB->query('delete from ! where id = ?', array(USER_TABLE, $userId ) );

	/* Now delete the blog entried */
	/* first delete blog comments */
	$osDB->query('delete from ! where userid = ? or blogid exists (select id from ! where userid = ?)',array(BLOG_COMMENTS_TABLE, $userId, BLOG_PREFERENCES_TABLE, $userId) );

	/* Reverse all votes by this user and remove all voting records */
	$votes = $osDB->getAll('select id, storyid from ! where userid = ?',array(BLOG_VOTE_TABLE, $userId) );
	if (isset($votes) && count($votes) > 0) {
		foreach($votes as $voterec) {
			$osDB->query('update ! set views=views-1 where id=?', array(BLOG_STORY_TABLE,$voterec['storyid']) );
			$osDB->query('delete from ! where id=?', array(BLOG_VOTE_TABLE, $voterec['id']) );
		}
	}

	/* Now remove all blog stories */
	$osDB->query('delete from ! where userid=?', array(BLOG_STORY_TABLE, $userId) );


	/* Delete Blog preferences */
	$osDB->query('delete from ! where userid = ?', array(BLOG_PREFERENCES_TABLE, $userId));

}

/* Following functions are added as part of cleaning up code */

function getPageSize () {

	if ( isset( $_REQUEST['results_per_page'] ) && $_REQUEST['results_per_page'] ) {

		$psize = $_REQUEST['results_per_page'];

		$GLOBALS['config']['search_results_per_page'] = $_REQUEST['results_per_page'] ;

		$_SESSION['ResultsPerPage'] = $_REQUEST['results_per_page'];

	} elseif( isset($_SESSION['ResultsPerPage']) && $_SESSION['ResultsPerPage'] != '' ) {

		$psize = $_SESSION['ResultsPerPage'];

		$GLOBALS['config']['search_results_per_page'] = $_SESSION['ResultsPerPage'] ;

	} else {

		$psize = $GLOBALS['config']['page_size'];

		$_SESSION['ResultsPerPage'] = $GLOBALS['config']['page_size'];

	}

	return $psize;
}

function getMembershipsInfo(){
	global $osDB;
	$rs = $osDB->getAll( 'SELECT * FROM ! WHERE enabled=?', array( MEMBERSHIP_TABLE, 'Y' ) );

	$mships = array();

	foreach ( $rs as $row ) {

		$mships[$row['roleid']] = $row['name'];

	}

	return $mships;
}

function querystring( $arr ) {

	$str = '';

	foreach( $arr as $item ) {

		if( !is_array( $_GET[$item]) ){
			$str .= $item . '=' . urlencode($_GET[$item]) . '&';
		} elseif (is_array( $_GET[$item]) ) {
			foreach( $_GET[$item] as $subitem) {
				$str .= $item . urlencode('[]') . '=' . urlencode($subitem) . '&';
			}
		} elseif( !is_array( $_POST[$item]) ){
			$str .= $item . '=' . urlencode($_POST[$item]) . '&';
		} elseif (is_array( $_POST[$item]) ) {
			foreach( $_POST[$item] as $subitem) {
				$str .= $item . urlencode('[]') . '=' . urlencode($subitem) . '&';
			}
		}
	}

	return $str;
}


function checkOnlineStats( $userid  ) {
	global $osDB;

	if ( $osDB->getOne( 'SELECT count(*) as num FROM ! WHERE userid = ?', array( ONLINE_USERS_TABLE, $userid ) ) ) {
		return 'online';
	}
	else {
		return 'offline';
	}
}


function getLastId() {
	global $osDB;
	return $osDB->getOne( 'select LAST_INSERT_ID()' );
}

function hasRight($field){
	global $osDB, $config;

	if( !isset($_SESSION['security'])  ||(isset($_SESSION['security']) && $_SESSION['security'] == '' ) ){
		if (!isset($_SESSION['UserId']) || $_SESSION['UserId'] == '') {

			$row = $osDB->getRow( 'SELECT * FROM ! where name = ?', array( MEMBERSHIP_TABLE, 'Visitor' ) );

		} elseif( isset($_SESSION['UserId']) && $_SESSION['UserId'] != ''  ){

			// fix later
			if (isset($_SESSION['RoleId']) ) {
				$row = $osDB->getRow( 'SELECT * FROM ! where roleid = ?', array( MEMBERSHIP_TABLE, $_SESSION['RoleId'] ) );
			}
		} else {

			$row = $osDB->getRow( 'SELECT * FROM ! WHERE  roleid = ?', array( MEMBERSHIP_TABLE, $config['default_user_level'] ) );

		}

		if(isset( $row ) ) {
			$_SESSION['security'] = $row;
		}
	}

	if (isset($_SESSION['security'])&& is_array($_SESSION['security']) ) {
		if ($field != '') {
			return (int)$_SESSION['security'][$field];
		} else {
			return 0;
		}
	} else {
		return 0;
	}
}

function checkAdminPermission( $str ) {
	$permit = isset($_SESSION['Permissions'])?$_SESSION['Permissions']:'';
	return $permit[$str] ? 1 : 0;
}

/* Ascertain the sort type */

function checkSortType( $sort_type ) {
	$n_sort_type = '';

	if ( $sort_type == '' ) {

		$n_sort_type = 'asc';

	} elseif ( $sort_type == 'asc' ) {

		$n_sort_type = 'desc' ;

	} elseif( $sort_type == 'desc' ) {

		$n_sort_type = 'asc' ;

	}
	return $n_sort_type;
}

function get_lang ($mainkey, $subkey='') {
	global $osDB, $config;
	if ($subkey != '') {
	   $y = $osDB->getOne('select descr from ! where lang=? and mainkey= ? and subkey=?', array(LANGUAGE_TABLE, $_SESSION['opt_lang'], $mainkey, $subkey));
	} else {
	   $y = $osDB->getOne('select descr from ! where lang=? and mainkey= ? ', array(LANGUAGE_TABLE, $_SESSION['opt_lang'], $mainkey));
	}
	if (!$y) {
		if ($subkey != '') {
		   $y = $osDB->getOne('select descr from ! where lang=? and mainkey= ? and subkey=?', array(LANGUAGE_TABLE, 'english', $mainkey, $subkey));
		} else {
		   $y = $osDB->getOne('select descr from ! where lang=? and mainkey= ? ', array(LANGUAGE_TABLE, 'english', $mainkey));
		}
	}

	return html_entity_decode(replace_lang_values($y));
}

function prefilter_getlang($source, &$smarty_obj) {
	if (!function_exists('get_my_lang')) {
		function get_my_lang($m){
			$keys=explode(' ',$m[1]);
			list($x,$mkey) = explode('=',$keys[0]);
			$skey='';
			if (isset($keys['1']) ){
				list($x1, $skey) = explode('=',$keys[1]);
			}
			$mkey=str_replace("'","",$mkey);
			$mkey=str_replace('"','',$mkey);
			$skey=str_replace("'","",$skey);
			$skey=str_replace('"','',$skey);
			return stripslashes(get_lang($mkey,$skey));
		}
	}

	return preg_replace_callback('/{lang (.+?)}/s', 'get_my_lang', $source);
}

function get_lang_values ($mainkey) {
	global $osDB;
    $y = $osDB->getAll('select subkey, descr from ! where lang=? and mainkey= ? order by id', array(LANGUAGE_TABLE, 'english', $mainkey));
	$x=array();
	foreach ($y as $ky => $vl) {
		$x[$vl['subkey']] = html_entity_decode(replace_lang_values($vl['descr']));
	}
	$y = $osDB->getAll('select subkey, descr from ! where lang=? and mainkey= ? order by id', array(LANGUAGE_TABLE, $_SESSION['opt_lang'], $mainkey));
	foreach ($y as $ky => $vl) {
		$x[$vl['subkey']] = html_entity_decode(replace_lang_values($vl['descr']));
	}
	return $x;
}

function replace_lang_values($y) {
	global $config;
	$y = str_replace('SITENAME', $config['site_name'], $y);
	$y = str_replace('DATE_FORMAT',DATE_FORMAT,$y);
	$y = str_replace('DATE_TIME_FORMAT',DATE_TIME_FORMAT,$y);
	$y = str_replace('DISPLAY_DATE_FORMAT',DISPLAY_DATE_FORMAT,$y);
	$y = str_replace('#TNSIZE#', $config['upload_snap_tnsize'], $y);
	$y = str_replace('#upload_snap_maxsize#', $config['upload_snap_maxsize']/1000, $y);
	$y = str_replace('#ADMIN_DIR#', ADMIN_DIR, $y);
	return $y;
}

function makeOptions ( $options ) {

	$result = array();

	foreach( $options as $index => $row ) {

		$result[ $row['id'] ] = $row['answer'];
	}
	return $result;
}

function makeAnswers ( $options ) {

	$result = array();

	foreach( $options as $index => $row ) {

		$result []= $row['answer'];
	}
	return $result;
}

function findSortBy ( $def = 'id' ) {

	global $lang, $_REQUEST;

	if( !isset($_REQUEST['sort']) || $_REQUEST['sort'] == '' ) {

		return( $def. ' '. 'asc');

	} elseif (isset($_REQUEST['sort']) ) {

		if( $_REQUEST['sort'] == get_lang('col_head_id') ) {

			$sort_by = $def;

		} else if( $_REQUEST['sort'] == get_lang('col_head_username') ) {

			$sort_by = 'username';

		} else if( $_REQUEST['sort'] == get_lang('col_head_name') ) {

			$sort_by = 'name';

		} else if( $_REQUEST['sort'] == get_lang('col_head_firstname') ) {

			$sort_by = 'firstname';

		} else if( $_REQUEST['sort'] == get_lang('col_head_register_at') ) {

			$sort_by = 'regdate';

		} 	else if ( $_REQUEST['sort'] == get_lang('col_head_gender') || $_REQUEST['sort']=='gender' ) {

			$sort_by = 'gender';

		} else if ( $_REQUEST['sort'] == get_lang('col_head_email') ) {

			$sort_by = 'email';

		} elseif ( $_REQUEST['sort'] == get_lang('col_head_subject') ) {

			$sort_by = 'subject';

		} elseif ( $_REQUEST['sort'] == get_lang('col_head_sendtime') || $_REQUEST['sort'] == 'sendtime' ) {

			$sort_by = ' sendtime ';

		} elseif ( $_REQUEST['sort'] == 'picscnt' ) {

			return( 'pictures_cnt '.checkSortType ( $_REQUEST['type'] ) .', firstname '.checkSortType ( $_REQUEST['type'] ) . ', lastname '.checkSortType ( $_REQUEST['type'] ) );


		} elseif ( $_REQUEST['sort'] == 'vdscnt' ) {

			return( 'videos_cnt '.checkSortType ( $_REQUEST['type'] ) .', firstname '.checkSortType ( $_REQUEST['type'] ) . ', lastname '.checkSortType ( $_REQUEST['type'] ) );

		}else if( $_REQUEST['sort'] == get_lang('total_referrals') ) {

			$sort_by = 'totalref';

		}else if ( $_REQUEST['sort'] == get_lang('regis_referals') ) {

			$sort_by = 'regref';

		} else if ( $_REQUEST['sort'] == get_lang('col_head_status') ) {

			$sort_by = 'status';

		} else if ( $_REQUEST['sort'] == get_lang('level_hdr') ) {

			$sort_by = 'level';

		} else if ( $_REQUEST['sort'] == get_lang('date_from') or $_REQUEST['sort'] == get_lang('start_date') or $_REQUEST['sort'] == 'start_date') {

			$sort_by = 'start_date';

		} else if ( $_REQUEST['sort'] == get_lang('date_upto') or $_REQUEST['sort'] == get_lang('end_date') or $_REQUEST['sort'] == 'end_date') {

			$sort_by = 'end_date';
		} else if ( $_REQUEST['sort'] == 'adminname' ) {

			$sort_by = 'fullname ';

		} else if( $_REQUEST['sort'] == get_lang('col_head_fullname') or $_REQUEST['sort'] == 'first_name') {

			return( 'firstname '.checkSortType ( $_REQUEST['type'] ) . ', lastname '.checkSortType ( $_REQUEST['type'] ) );

		} else if( $_REQUEST['sort'] == get_lang('superuser') or $_REQUEST['sort'] == 'superuser') {

			$sort_by = 'super_user';

		} else if( $_REQUEST['sort'] == get_lang('col_head_enabled') ) {

			$sort_by = 'enabled';

		}  else if( $_REQUEST['sort'] == get_lang('article_title') ) {

			$sort_by = 'title';

		} else if( $_REQUEST['sort'] == get_lang('news_header') ) {

			$sort_by = 'header';

		} else if( $_REQUEST['sort'] == get_lang('poll') ) {

			$sort_by = 'question';

		} else if( $_REQUEST['sort'] == get_lang('active') ) {

			$sort_by = 'active';

		} else if( $_REQUEST['sort'] == get_lang('news_header') ) {

			$sort_by = 'header';

		} else if( $_REQUEST['sort'] == get_lang('story_sender') ) {

			$sort_by = 'sender';

		} else if( $_REQUEST['sort'] == get_lang('option') ) {

			$sort_by = 'opt';

		} else if( $_REQUEST['sort'] == get_lang('votes') ) {

			$sort_by = 'result';

		} else if( $_REQUEST['sort'] == 'expire_date' ) {

			$sort_by = 'levelend';

		} else if( $_REQUEST['sort'] == get_lang('col_head_answer') ) {

			$sort_by = 'answer';

		} else if( $_REQUEST['sort'] == get_lang('col_head_question') ) {

			$sort_by = 'question';

		} else if( $_REQUEST['sort'] == 'level' ) {

			$sort_by = 'level';

		} else if ( $_REQUEST['sort'] == get_lang('state_code') || $_REQUEST['sort'] == get_lang('country_code')  || $_REQUEST['sort'] == get_lang('county_code')|| $_REQUEST['sort'] == get_lang('city_code') || $_REQUEST['sort'] == get_lang('zip_code')  ) {

			$sort_by = 'code';

		} else if ( $_REQUEST['sort'] == get_lang('state_name') || $_REQUEST['sort'] == get_lang('country_name') || $_REQUEST['sort'] == get_lang('county_name') || $_REQUEST['sort'] == get_lang('city_name') ) {

			$sort_by = 'name';

		}
	}
	return ($sort_by . ' ' . checkSortType ( $_REQUEST['type'] ));
}

function make_datetime_from_smarty($prefix)
{	global $_REQUEST;
	$date=$_REQUEST[$prefix."Year"]."-".$_REQUEST[$prefix."Month"]."-".$_REQUEST[$prefix."Day"];
	$time=$_REQUEST[$prefix."Hour"];
	if(isset($_REQUEST[$prefix."Minute"])) $time.=":".$_REQUEST[$prefix."Minute"];
	if(isset($_REQUEST[$prefix."Second"])) $time.=":".$_REQUEST[$prefix."Second"];
	return($date." ".$time);
}

function send_watched_mails($eventid)
{	global $config;
	global $osDB;
	global $lang;
	global $t;
	global $params;

	$users=$osDB->getAll("select u.* ".
		 "from ! as u inner join ! as we on u.id=we.userid ".
		 "where we.eventid=? ",array(USER_TABLE,WATCHES_TABLE,$eventid));

	if($users)
	foreach($users as $key=>$user)
	{	$recipients = $user["email"];

		$event=$osDB->getRow("select id, userid, event, description, ".
			   "       date_add(datetime_from, interval ! hour) as datetime_from, ".
			   "       date_add(datetime_to, interval ! hour) as datetime_to, ".
			   "       calendarid, timezone, private_to ".
			   "from ! ".
			   "where id=? ",array($user["timezone"], $user["timezone"], EVENTS_TABLE,$eventid));

		$From    = $config['admin_email'];
		$To     = $user["email"];
		$Subject = get_lang('event_notification');

		$t->assign("user",$user);
		$t->assign("event",$event);
		$body = $t->fetch('eventnotificationmail.tpl');

		mailSender($From, $To, $user['email'], $Subject, $body);

	}
}

function getdate_safe($timestamp)
{	$date=array();
	$date["seconds"]=date("s",$timestamp);
	$date["minutes"]=date("i",$timestamp);
	$date["hours"]=date("H",$timestamp);
	$date["mday"]=date("j",$timestamp);
	$date["wday"]=date("w",$timestamp);
	$date["mon"]=date("m",$timestamp);
	$date["year"]=date("Y",$timestamp);
	$date["yday"]=date("z",$timestamp);
	$date["weekday"]=date("D",$timestamp);
	$date["month"]=date("F",$timestamp);
	return($date);
}

function getOnlineStats($userid) {
	global $osDB;
	$onl = $osDB->getOne('SELECT count(*) FROM ! WHERE userid = ?', array(ONLINE_USERS_TABLE, $userid));
	if ($onl > 0) {return true;}
	return false;
}

function getCountryName($countryCode) {
	global $osDB;
	$countryname = $osDB->getOne('select name from ! where code = ?', array(COUNTRIES_TABLE, $countryCode ) );
	return $countryname;
}

function getStateName($countryCode, $stateCode) {
	if (!isset($countryCode) || empty($countryCode) || $countryCode == '') return '';
	global $osDB;
	$statename = $osDB->getOne("select name from ! where code = '$stateCode' and countrycode = '$countryCode'", array(STATES_TABLE) );
	$statename = ($statename != '') ? $statename : $stateCode;
	return $statename;
}

function getCountyName($countryCode, $stateCode, $countyCode) {
	global $osDB;
	$countyname = $osDB->getOne("select name from ".COUNTIES_TABLE." where code = '".$countyCode."'  and countrycode = '".$countryCode."' and statecode = '".$stateCode."'");
	$countyname = ($countyname != '') ? $countyname : $countyCode;
	return $countyname;
}

function get_prefered_language ($http_accept_language="auto"){

	global $osDB, $language_conversion;

	$loaded_langs = $osDB->getAll('select distinct lang from ! order by lang', array(LANGUAGE_TABLE) );

	if (count($loaded_langs) > 1):
		$available_languages=array();
		$available_languages[] = 'en';
		foreach ($loaded_langs as $ka => $langna):
			if ($langna['lang'] != 'english' && array_key_exists($langna['lang'], $language_conversion) ):
				$available_languages[]=$language_conversion[$langna['lang']];
			endif;
		endforeach;
	/*
	  determine which language out of an available set the user prefers most

	  $available_languages        array with language-tag-strings (must be lowercase) that are available
	  $http_accept_language    a HTTP_ACCEPT_LANGUAGE string (read from $_SERVER['HTTP_ACCEPT_LANGUAGE'] if left out)
	*/
		// if $http_accept_language was left out, read it from the HTTP-Header
		if ($http_accept_language == "auto") $http_accept_language = $_SERVER['HTTP_ACCEPT_LANGUAGE'];

		// standard  for HTTP_ACCEPT_LANGUAGE is defined under
		// http://www.w3.org/Protocols/rfc2616/rfc2616-sec14.html#sec14.4
		// pattern to find is therefore something like this:
		//    1#( language-range [ ";" "q" "=" qvalue ] )
		// where:
		//    language-range  = ( ( 1*8ALPHA *( "-" 1*8ALPHA ) ) | "*" )
		//    qvalue         = ( "0" [ "." 0*3DIGIT ] )
		//            | ( "1" [ "." 0*3("0") ] )
		preg_match_all("/([[:alpha:]]{1,8})(-([[:alpha:]|-]{1,8}))?" .
					   "(\s*;\s*q\s*=\s*(1\.0{0,3}|0\.\d{0,3}))?\s*(,|$)/i",
					   $http_accept_language, $hits, PREG_SET_ORDER);

		// default language (in case of no hits) is the first in the array

		$bestlang = $available_languages[0];

		$bestqval = 0;

		foreach ($hits as $arr):
			// read data from the array of this hit
			$langprefix = strtolower ($arr[1]);
			if (!empty($arr[3])):
				$langrange = strtolower ($arr[3]);
				$language = $langprefix . "-" . $langrange;
			else:
				$language = $langprefix;
			endif;
			$qvalue = 1.0;
			if (!empty($arr[5])) $qvalue = floatval($arr[5]);

			// find q-maximal language
			if (in_array($language,$available_languages) && ($qvalue > $bestqval)):
				$bestlang = $language;
				$bestqval = $qvalue;
			// if no direct hit, try the prefix only but decrease q-value by 10% (as http_negotiate_language does)
			elseif (in_array($langprefix,$available_languages) && (($qvalue*0.9) > $bestqval)):
				$bestlang = $langprefix;
				$bestqval = $qvalue*0.9;
			endif;
		endforeach;
	else:
		if (isset($loaded_langs[0]) && $loaded_langs[0] != ''):
			$bestlang = $loaded_langs[0];
		else:
			$bestlang='english';
		endif;
	endif;
	$lang = 'english';
	if (isset($language_conversion) && is_array($language_conversion) ):
		foreach ($language_conversion as $k => $v):
			if (is_array($bestlang)) { 
				$blang = $bestlang['lang'];
			} else {
				$blang = $bestlang;
			}
			if ($v ==  substr($blang,0,2)):
				$lang = $k;
				break;
			endif;
		endforeach;
	endif;
    return $lang;
}

function getIPLocation($ipaddr) {
	/* This function will return the location details of the IP address.
		This function uses the data supplied by www.maxmind.com.
		This product includes GeoLite data created by MaxMind, available from
		http://maxmind.com/

		Kindly download the GeoIP.dat and GeoLiteCity.dat from the site.

		Adapted to suit osDate by Vijay Nair

	*/
	include(GEOIPDATA_DIR."geoipcity.inc");
	include(GEOIPDATA_DIR."geoipregionvars.php");
	global $osDB;

	// uncomment for Shared Memory support
//	geoip_load_shared_mem(GEOIPDATA_DIR."GeoLiteCity.dat");
	$gi = geoip_open(GEOIPDATA_DIR."GeoLiteCity.dat",GEOIP_STANDARD);

	$record = GeoIP_record_by_addr($gi,$ipaddr);

	if (isset($record) ) {
		$iprecord=array();
		$iprecord['country_code'] = isset($record->country_code)?$record->country_code:'';
		$iprecord['country_name'] = isset($record->country_name)?$record->country_name:'';
		$iprecord['state_name'] = isset($GEOIP_REGION_NAME[$record->country_code][$record->region])?$GEOIP_REGION_NAME[$record->country_code][$record->region]:'';
		$iprecord['city_name'] = isset($record->city)?$record->city:'';
		$iprecord['latitude'] = isset($record->latitude)?$record->latitude:'';
		$iprecord['longitude'] = isset($record->longitude)?$record->longitude:'';

		geoip_close($gi);
		$countryname = getCountryName($iprecord['country_code']);
		if (!isset($countryname) || $countryname == '') {
			$countrycode = $osDB->getOne('select code from ! where upper(name) = upper(?)', array(COUNTRIES_TABLE, $iprecord['country_name']) );
			$iprecord['country_code'] = $countrycode;
		}
		return ($iprecord);
	} else { return false; }
}

function checkDuplicateEmail($email, $userid) {
	global $osDB;
	return ($osDB->getOne('select count(*) from ! where email = ? and id <> ?', array(USER_TABLE, $email, $userid) ) );
}

class Browser
{
    var $props    = array("Version" => "0.0.0",
                                "Name" => "unknown",
                                "Agent" => "unknown") ;
	var $Agent;
	var $Name;
	var $Version;	
     function __Construct()
    {
        $browsers = array("firefox", "msie", "opera", "chrome", "safari",
                            "mozilla", "seamonkey",    "konqueror", "netscape",
                            "gecko", "navigator", "mosaic", "lynx", "amaya",
                            "omniweb", "avant", "camino", "flock", "aol");

        $this->props['Agent'] = $this->Agent = strtolower($_SERVER['HTTP_USER_AGENT']);
        foreach($browsers as $browser)
        {
            if (preg_match("#($browser)[/ ]?([0-9.]*)#", $this->props['Agent'], $match))
            {
                $this->props['Name'] = $this->Name = $match[1] ;
                $this->props['Version'] = $this->Version = $match[2] ;
                break ;
            }
        }
    }

    function __Get($name)
    {
        if (!array_key_exists($name, $this->props))
        {
            die ("No such property or function $name") ;
        }
        return $this->props[$name] ;
    }

    function __Set($name, $val)
    {
        if (!array_key_exists($name, $this->props))
        {
            SimpleError("No such property or function.", "Failed to set $name", $this->props) ;
            die ;
        }
        $this->props[$name] = $val ;
    }
} 

if ( ! function_exists( 'exif_imagetype' ) ) {
    function exif_imagetype ( $filename ) {
        if ( ( list($width, $height, $type, $attr) = getimagesize( $filename ) ) !== false ) {
            return true;
        }
	    return false;
    }
}
?>