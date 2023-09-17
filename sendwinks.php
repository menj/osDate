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

$returnto = 'sendwinks.php';

include('sessioninc.php');

$winks_for_today = 0;

/* Check the count of messages sent for today... */
$winks_for_today = $osDB->getOne('select act_cnt from ! where userid = ? and act_type = ? and act_date = ?',array(USER_ACTIONS, $_SESSION['UserId'], 'W', date('Ymd')));

if ($winks_for_today >= $_SESSION['security']['winks_per_day'] ) {

	header("location: ".$_GET['rtnurl']."?id=".$_GET['ref_id'].'&errid=123');

	exit;

}

if ($winks_for_today> 0) {
	$osDB->query('update ! set act_cnt=act_cnt+1 where userid=? and act_type=? and act_date = ?', array(USER_ACTIONS,$_SESSION['UserId'], 'W', date('Ymd')));
} else {
	$osDB->query('insert into ! (userid, act_type, act_date, act_cnt) values (?,?,?,?)', array(USER_ACTIONS, $_SESSION['UserId'], 'W', date('Ymd'), 1));
}

$osDB->query('insert into ! (userid, ref_userid, act, act_time) values (?, ?, ?, ?)', array( VIEWS_WINKS_TABLE, $_GET['ref_id'], $_SESSION['UserId'], 'W', time() ) );

$recipient_choice = $osDB->getOne('select choice_value from ! where userid=? and choice_name=?', array(USER_CHOICES_TABLE, $_GET['ref_id'], 'email_wink_received') );

if ($recipient_choice == '1' or $recipient_choice == '' or !isset($recipient_choice) ) {

	if ($config['letter_winkreceived'] == 'Y'  ) {
		/* Now intimate the user about this  */

		$usr = $osDB->getRow('select *, floor((to_days(curdate())-to_days(birth_date))/365.25)  as age from ! where id = ?', array(USER_TABLE, $_GET['ref_id']) );

		$t->assign('item', $osDB->getRow('select *, floor((to_days(curdate())-to_days(birth_date))/365.25)  as age from ! where id = ?', array(USER_TABLE, $_SESSION['UserId']) ) );

		$message = get_lang('wink_received', MAIL_FORMAT);

		$Subject = str_replace('#ReceiverName#', $usr['username'],str_replace('#SenderName#',$_SESSION['UserName'], get_lang('letter_winkreceived_sub') ) );

		$From = $config['admin_email'];

		$To = $usr['email'];

		$message = str_replace('#FirstName#', $usr['firstname'], $message);

		$message = str_replace('#ReceiverName#', $usr['username'], $message);

		$message = str_replace('#SenderName#', $_SESSION['UserName'], $message);

		$message = str_replace('#UserId#', $_SESSION['UserId'], $message);

		if (MAIL_FORMAT == 'html') {
			$message = str_replace('#smallProfile#', $t->fetch('profile_for_html_mail.tpl'), $message);

		}

		mailSender($From, $To, $To, $Subject, $message);
		unset($usr, $message, $Subject, $To, $From);
	}
}
header("location: ".$_GET['rtnurl']."?id=".$_GET['ref_id'].'&errid='.WINKISSENT);
exit;

?>