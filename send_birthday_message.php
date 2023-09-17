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

include_once('sessioninc.php');

$cmd = isset($_POST['cmd'])?$_POST['cmd']:'';

if ( $cmd == 'posted' ){

	$txtcomments = strip_tags(trim($_POST['txtcomments']));

	$t->assign('txtcomments', $txtcomments);
	$uid = $_POST['id'];

	if ( (strtolower($_SESSION['spam_code']) != strtolower($_POST['spam_code']) || !isset($_SESSION['spam_code']) ) && $config['spam_code_length'] > 0)  {
		$t->assign('msg', get_lang('errormsgs','121') );
	} else {

		$subj = get_lang('birthday_msg_sub');

		/* Check the count of messages sent for today... */
		$msgs_for_today = $osDB->getOne('select act_cnt from ! where userid = ? and act_type = ? and act_date = ?',array(USER_ACTIONS, $_SESSION['UserId'], 'M'
		, date('Ymd')));

		if (!$msgs_for_today) $msgs_for_today = 0;

		$allowed_count = ($_SESSION['security']['message_keep_cnt'] > 0)? $_SESSION['security']['message_keep_cnt'] : $config['message_count'];

		$total_msgs_count = $osDB->getOne('select count(*) from ! where owner = ?', array(MAILBOX_TABLE, $_SESSION['UserId']));

		if (!isset($_SESSION['security']['messages_per_day'])) $_SESSION['security']['messages_per_day'] = 0;

		if ($msgs_for_today > $_SESSION['security']['messages_per_day'] ) {

			$t->assign('msg',  get_lang('errormsgs',122));

		} elseif ($allowed_count <= $total_msgs_count) {

			$t->assign('msg', get_lang('errormsgs', 131));

		} else {
			/* Replace #USERNAME# and #FROMNAME# in the message text */
			$txtcomments = str_replace('#USERNAME#',$_POST['uname'],$txtcomments);
			$txtcomments = str_replace('#FROMNAME#', '<a href="showprofile.php?id='.$_SESSION['UserId'].'">'.$_SESSION['UserName'].'</a>', $txtcomments);

			/* Add message to the recipient's inbox and sender's sent box */

			$time001 = time();
			$osDB->query( 'INSERT INTO ! (owner, senderid, recipientid, subject, message, sendtime, folder, notifysender) values(?, ?, ?, ?, ?, ?, ?, ?)', array( MAILBOX_TABLE, $_POST['id'], $_SESSION['UserId'], $_POST['id'], $subj, stripEmails($txtcomments), $time001, 'inbox', '0' ) );
			$osDB->query( 'INSERT INTO ! (owner, senderid, recipientid, subject, message, sendtime, folder) values(?, ?, ?, ?, ?, ?, ?)', array( MAILBOX_TABLE, $_SESSION['UserId'], $_SESSION['UserId'], $_POST['id'], $subj, stripEmails($txtcomments), $time001, 'sent' ) );

			if ($msgs_for_today > 0) {
				$osDB->query('update ! set act_cnt=act_cnt+1 where userid=? and act_type=? and act_date = ?', array(USER_ACTIONS,$_SESSION['UserId'], 'M', date('Ymd')));
			} else {
				$osDB->query('insert into ! (userid, act_type, act_date, act_cnt) values (?,?,?,?)', array(USER_ACTIONS, $_SESSION['UserId'], 'M', date('Ymd'), 1));
			}

			$recipient_choice = $osDB->getOne('select choice_value from ! where userid=? and choice_name=?', array(USER_CHOICES_TABLE, $_POST['id'], 'email_message_received') );

			if ($recipient_choice == '1' or $recipient_choice == '' or !isset($recipient_choice) ) {

				if ($config['letter_messagereceived'] == 'Y' && ($config['nomail_for_onlineuser'] == 'Y' or ($config['nomail_for_onlineuser'] == 'Y' && !getOnlineStats($_POST['txtrecipient']) )) ) {

				/* Send email about the received message to the receiver */

					$row = $osDB->getRow( 'select * from ! where id = ?', array( USER_TABLE, $_POST['id'] ) );

					$Subject = get_lang('message_received_sub');

					$From= $config['admin_email'];

					$To = $row['email'];

					$t->assign('item', $osDB->getRow('select *, floor((to_days(curdate())-to_days(birth_date))/365.25)  as age from ! where id = ?', array( USER_TABLE, $_SESSION['UserId']) ) );

					$message = get_lang('message_received', MAIL_FORMAT);

					$message = str_replace('#From#', get_lang('FROM1'), $message);

					$message = str_replace('#TO#', get_lang('To1'), $message);

					$message = str_replace('#FirstName#', $row['firstname'] ,$message);

					$message = str_replace('#SenderName#', $_SESSION['UserName'], $message);

					$message = str_replace('#UserName#', $row['username'], $message);

					$message = str_replace('#Date#', get_lang('col_head_date'), $message);

					$message = str_replace('#MESSAGE_DATE#', date(get_lang('DISPLAY_DATETIME_FORMAT'),time()), $message);

					$message = str_replace('#Subject#', get_lang('col_head_subject'), $message);

					$message = str_replace('#MSG_SUBJECT#', $subj, $message);

					if (MAIL_FORMAT == 'html') {

						$message = str_replace('#smallProfile#',  $t->fetch('profile_for_html_mail.tpl'), $message);

					}

					mailSender($From, $To, $row['email'], $Subject, $message);
					unset($message, $Subject);
				}
			}
			$t->assign('success', '1');
		}
	}
} elseif (isset($_REQUEST['id']) && $_REQUEST['id'] > 0) {
	$uid = $_REQUEST['id'];
	$t->assign('txtcomments',get_lang('birthday_msg_text') );
}

$t->assign('uname', $osDB->getOne('select username from ! where id=?',array(USER_TABLE,$uid) ) );

$t->assign('uid',$uid);

$t->assign('lang',$lang);

$t->assign('rendered_page', $t->fetch('send_birthday_message.tpl') );

$t->display( 'index.tpl' );
exit;
?>