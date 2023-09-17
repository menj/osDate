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

$returnto = 'compose.php';

include ( 'sessioninc.php' );

if ($_SESSION['UserId'] <= 0) {
header('location: index.php?page=login');
exit;
}

$reply = '';
if (isset($_SERVER["QUERY_STRING"]) ) {
	$reply = preg_match("/reply/", $_SERVER["QUERY_STRING"]);
}

if ($reply == '0' and isset($_SESSION['security']['message']) && $_SESSION['security']['message'] !== '1') {
	header('location: index.php?page=login');
	exit;
}

if ((isset($_SERVER["QUERY_STRING"]) && $_SERVER["QUERY_STRING"] == '') || !isset($_SERVER["QUERY_STRING"])) {
	header('location: index.php?page=login');
	exit;
}

if( isset( $_POST['frm'] ) ) {
	if ($config['spam_code_length'] > 0 && (!isset($_SESSION['spam_code']) || strtolower($_SESSION['spam_code']) != strtolower($_POST['spam_code']) ) )  {

		$t->assign('errormsg', get_lang('errormsgs',121));

	} else {
		if ( $_POST['frm'] == 'frmTemplate' ) {
			// templated message
			// fetch the template message
			$msgdata = $osDB->getRow('SELECT subject, text FROM ! WHERE id = ?', array(USERTEMPLATE_TABLE, $_POST['templateid']) );
			$_POST['txtmessage'] = $msgdata['text'];
			$_POST['txtsubject'] = $msgdata['subject'];

			// make appropriate substitutions

			$row = $osDB->getRow( 'select username, firstname, email, country, state_province, county, city, floor((to_days(curdate())-to_days(birth_date))/365.25)  as age from ! where id = ?', array( USER_TABLE, $_POST['txtrecipient'] ) );

			// current template variables:
			// [username], [firstname], [city], [state], [country], [age]
			// you can add more template variables by simply adding to this array

			$row['statename'] = getStateName( $row['country'], $row['state_province'] );

			$row['countryname'] = getCountryName($row['country'] ) ;

			$row['city'] = getCityName($row['country'], $row['state_province'], $row['city'], $row['county']);

			$sub = array(
				'[username]' 	=> $row['username'],
				'[firstname]' 	=> $row['firstname'],
				'[city]'		=> $row['city'],
				'[state]'		=> $row['statename'],
				'[country]'		=> $row['countryname'],
				'[age]'			=> $row['age'],
			);

			foreach( $sub as $key => $val ) {
				$_POST['txtmessage'] = str_replace( $key, $val, $_POST['txtmessage'] );
				$_POST['txtsubject'] = str_replace( $key, $val, $_POST['txtsubject'] );
			}
		}

		$_POST['txtmessage'] = strip_tags($_POST['txtmessage']);

	// this is frm = frmCompose
		$msgs_for_today = 0;

		/* Check the count of messages sent for today... */
		$msgs_for_today = $osDB->getOne('select act_cnt from ! where userid = ? and act_type = ? and act_date = ?',array(USER_ACTIONS, $_SESSION['UserId'], 'M'
		, date('Ymd')));

		if (!$msgs_for_today) $msgs_for_today = 0;

		$allowed_count = ($_SESSION['security']['message_keep_cnt'] > 0)? $_SESSION['security']['message_keep_cnt'] : $config['message_count'];

		$total_msgs_count = $osDB->getOne('select count(*) from ! where owner = ?', array(MAILBOX_TABLE, $_SESSION['UserId']));

		if (!isset($_SESSION['security']['messages_per_day'])) $_SESSION['security']['messages_per_day'] = 0;

		if ($msgs_for_today > $_SESSION['security']['messages_per_day'] && !isset($_REQUEST['reply'])) {

			$t->assign('errormsg',  get_lang('errormsgs',122));

		} elseif ($allowed_count <= $total_msgs_count) {

			$t->assign('errormsg', get_lang('errormsgs', 131));

		} else {

			if ( isset( $_SESSION['UserId'] ) && $_SESSION['UserId'] != '' ) {

				// check if profile should be included //

				if ($_POST["chkinclude"] == "1") {

					// get information //

					$dataSections = $osDB->getAll( 'SELECT * FROM ! WHERE enabled = ? ORDER BY displayorder', array( SECTIONS_TABLE, 'Y'  ) );

					$found = false;

					foreach( $dataSections as $section ){

						$prefs = array();

						$rsPref = $osDB->getAll( 'SELECT DISTINCT q.id, q.question, q.extsearchhead, q.control_type as type FROM ! pref INNER JOIN ! q ON pref.questionid = q.id WHERE pref.userid = ? AND q.section = ? ORDER BY q.id ', array( USER_PREFERENCE_TABLE, QUESTIONS_TABLE, $_SESSION["UserId"], $section['id'] ) );

						foreach( $rsPref as $row ){

							if ($row['type'] != 'textarea') {

								$rsOptions = $osDB->getAll( 'SELECT pref.answer as answer, opt.answer as anstxt from ! pref left join ! opt on pref.questionid = opt.questionid and opt.id = pref.answer where pref.userid = ? and opt.questionid = ? order by opt.questionid, opt.displayorder', array( USER_PREFERENCE_TABLE, OPTIONS_TABLE, $_SESSION["UserId"], $row['id'] ) );

							} else {

								$rsOptions = $osDB->getAll( 'select pref.answer as answer, pref.answer as anstxt from ! pref where pref.userid = ? and pref.questionid = ?', array( USER_PREFERENCE_TABLE, $_SESSION["UserId"], $row['id'] ) );
							}

							$opts = array();

							foreach( $rsOptions as $key=>$opt ){
								$opts[] = $opt['anstxt'];
							}
							unset($rsOptions);
							if (count($opts)>0) {
								$optsPhr = implode( ', ', $opts);
							} else {
								$optsPhr = "";
							}

							$row['options'] = $optsPhr;

							$prefs[] = $row;

							$found = true;
						}
						unset($rsPref);

						if( count($prefs) > 0 ){

							$pref[] = array( 'SectionName' => $section['section'], 'preferences' => $prefs );
						}
					}
					unset($dataSections, $prefs);
					// add to message //

					if ( isset($pref) && is_array( $pref ) ) {
						foreach ($pref as $item) {

							$_POST['txtmessage'] .= "<br />" . "<br />" . stripslashes( $item['SectionName'] ) . "<br />";
							$_POST['txtmessage'] .= "-----------------";

							foreach ($item['preferences'] as $item2) {

								if (strlen($item2['options']) > 0) {

									$_POST['txtmessage'] .= "<br />" . "<br />" . stripslashes( $item2['extsearchhead'] ). "<br />";
									$_POST['txtmessage'] .= "- " . stripslashes( $item2['options'] );
								}
							}
						}
					}

				}

				$time001 = time();
				$osDB->query( 'INSERT INTO ! (owner, senderid, recipientid, subject, message, sendtime, folder, notifysender) values(?, ?, ?, ?, ?, ?, ?, ?)', array( MAILBOX_TABLE, $_POST['txtrecipient'], $_SESSION['UserId'], $_POST['txtrecipient'], stripEmails(strip_tags($_POST['txtsubject'])), stripEmails($_POST['txtmessage']), $time001, 'inbox', ($_POST["chknotify"] - 0) ) );

				/* MOD END */

				$osDB->query( 'INSERT INTO ! (owner, senderid, recipientid, subject, message, sendtime, folder) values(?, ?, ?, ?, ?, ?, ?)', array( MAILBOX_TABLE, $_SESSION['UserId'], $_SESSION['UserId'], $_POST['txtrecipient'], stripEmails(strip_tags($_POST['txtsubject'])), stripEmails($_POST['txtmessage']), $time001, 'sent' ) );

				$recipient_choice = $osDB->getOne('select choice_value from ! where userid=? and choice_name=?', array(USER_CHOICES_TABLE, $_POST['txtrecipient'], 'email_message_received') );

				if ($recipient_choice == '1' or $recipient_choice == '' or !isset($recipient_choice) ) {

					if ($config['letter_messagereceived'] == 'Y' && ($config['nomail_for_onlineuser'] == 'Y' or ($config['nomail_for_onlineuser'] == 'Y' && !getOnlineStats($_POST['txtrecipient']) )) ) {

					/* Send email about the received message to the receiver */

						$row = $osDB->getRow( 'select *, floor((to_days(curdate())-to_days(birth_date))/365.25)  as age from ! where id = ?', array( USER_TABLE, $_POST['txtrecipient'] ) );

						$sendername = $osDB->getOne('select username from ! where id = ?', array(USER_TABLE, $_SESSION['UserId']) );

						$Subject = get_lang('message_received_sub');

						$From= $config['admin_email'];

						$To = $row['email'];

						$t->assign('item', $osDB->getRow('select *, floor((to_days(curdate())-to_days(birth_date))/365.25)  as age from ! where id = ?', array( USER_TABLE, $_SESSION['UserId']) ) );

						$message = get_lang('message_received', MAIL_FORMAT);

						$message = str_replace('#From#', get_lang('FROM1'), $message);

						$message = str_replace('#TO#', get_lang('To1'), $message);

						$message = str_replace('#FirstName#', $row['firstname'] ,$message);

						$message = str_replace('#SenderName#', $sendername, $message);

						$message = str_replace('#UserName#', $row['username'], $message);

						$message = str_replace('#Date#', get_lang('col_head_date'), $message);

						$message = str_replace('#MESSAGE_DATE#', date(get_lang('DISPLAY_DATETIME_FORMAT'),time()), $message);

						$message = str_replace('#Subject#', get_lang('col_head_subject'), $message);

						$message = str_replace('#MSG_SUBJECT#', stripEmails(strip_tags($_POST['txtsubject'])), $message);

						if (MAIL_FORMAT == 'html') {

							$message = str_replace('#smallProfile#',  $t->fetch('profile_for_html_mail.tpl'), $message);

						}

						mailSender($From, $To, $row['email'], $Subject, $message);
						unset($message, $Subject);
					}
				}

				if ($msgs_for_today > 0) {
					$osDB->query('update ! set act_cnt=act_cnt+1 where userid=? and act_type=? and act_date = ?', array(USER_ACTIONS,$_SESSION['UserId'], 'M', date('Ymd')));
				} else {
					$osDB->query('insert into ! (userid, act_type, act_date, act_cnt) values 	(?,?,?,?)', array(USER_ACTIONS, $_SESSION['UserId'], 'M', date('Ymd'), 1));
				}
				if (isset($_REQUEST['reply']) && $_REQUEST['reply'] == '2') {

					/* update replied flag */

					$osDB->query('update ! set replied=? where id=?', array(MAILBOX_TABLE, 1, $_REQUEST['msgid']) );


					header("location:mailmessages.php?folder=".$_REQUEST['folder']."&selflag=".$_REQUEST['selflag']."&sort=".$_REQUEST['sort']."&type=".$_REQUEST['type']."&replied=1");			
					exit;
				}

			}

			$t->assign( 'msg_sent', true );
		}
	}
}

$recipient = (isset($_REQUEST['txtrecipient'])?$_REQUEST['txtrecipient']:(isset($_REQUEST['recipient'])?$_REQUEST['recipient']:'-1') ) ;

$t->assign( 'templates',$osDB->getAll( 'SELECT id, text FROM ! WHERE userid = ?', array( USERTEMPLATE_TABLE, $_SESSION['UserId'] ) ) );

$t->assign( 'user',$osDB->getRow( 'SELECT username, firstname, lastname FROM ! WHERE id = ?', array( USER_TABLE, $recipient) ) );

$isBanned = $osDB->getOne('select count(*) from ! where act=? and ( (userid = ? and ref_userid = ?) or (userid=? and ref_userid = ?) )', array(BUDDY_BAN_TABLE, 'B', $_SESSION['UserId'], $recipient, $recipient, $_SESSION['UserId'] ) );  

if ($isBanned == 0) {
	if (isset($_REQUEST['reply']) && $_REQUEST['reply'] == '1') {
		/* Reply for a message */
		if ($_SESSION['security']['message']=='1' || $config['allow_reply_by_all'] == 'Y' || $config['allow_reply_by_all'] == '1' ) {
			$msg = $osDB->getRow('select * from ! where id = ?', array(MAILBOX_TABLE, $_REQUEST['msgid'] ) );

			if (substr($msg['subject'],0,3) != 'Re:') {
				$msg['subject'] = 'Re: '.$msg['subject'];
			}

			if (strpos($msg['message'],'-- Original Message ---') >= 0 ) {
				$msg['message'] = str_replace('-- Original Message ---','-----------------',$msg['message']);
			}

			$msg['message'] = chr(13).chr(13).chr(13).'-- Original Message ---'.chr(13).str_replace('<br>',chr(13),$msg['message']).chr(13).'-- End Original Message ---'.chr(13);


			$t->assign('msg', $msg);
		}
	} elseif (isset($_REQUEST['reply'])&& $_REQUEST['reply'] == '11') {
		/* Reply  "No Thanks" */

		$msg['subject'] = get_lang('no_thanks_subject');

		$message =  get_lang('no_thanks_message', MAIL_FORMAT);

		$message = str_replace('#site_name#', $config['site_name'], $message);

		if (!isset($_REQUEST['refuname'])) {
			$_REQUEST['refuname'] = $osDB->getOne('select username from ! where id = ?',array(USER_TABLE, $recipient));
		}
		
		$message = str_replace('#recipient_username#', $_REQUEST['refuname'], $message);

		$message = str_replace('#sender_username#', $_SESSION['UserName'], $message);

		$msg['message'] = str_replace('<br>',chr(10),$message);
		unset($message);
		$t->assign('msg', $msg);
		$_REQUEST['level'] = '1';

	}
	unset($msg);
} else {

	$t->assign('errormsg',  get_lang('in_ban_list'));
}
$t->assign('lang',$lang);

if ( isset($config['use_profilepopups']) && $config['use_profilepopups'] == 'Y' ) {

	$t->display('compose.tpl');
} else {
	$t->assign('rendered_page', $t->fetch('compose.tpl') );

	$t->display ( 'index.tpl' );
}
?>