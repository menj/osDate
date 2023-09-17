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
	include_once( '../init.php' );
}

include ( 'sessioninc.php' );

if (isset($_POST['expiryLevel'])) {
	/* Send letter based on the option chosen */

	list($level,$start_time, $end_time) = explode('-',$_POST['expiryLevel']);

	if ($level=='0') {
		/* Expired membership emails */
		$start_time = strtotime(date('Ymd'));
		$users = $osDB->getAll('select usr.id, usr.username, usr.firstname, usr.lastname, usr.levelend, mem.name as levelname, usr.email from ! as usr, ! as mem where mem.roleid = usr.level and  (usr.levelend < ? or usr.levelend is null) and usr.status in (?,?)', array(USER_TABLE, MEMBERSHIP_TABLE, $start_time, 'active', get_lang('status_act','active')) );
		$message = get_lang('mship_expired_note', MAIL_FORMAT);
	} else {
		$users = $osDB->getAll('select usr.id, usr.username, usr.firstname, usr.lastname, usr.levelend, mem.name as levelname, usr.email from ! as usr, ! as mem where usr.level = mem.roleid and status in (?, ?) and usr.levelend between ? and ?', array(USER_TABLE, MEMBERSHIP_TABLE,  'active', get_lang('status_act','active'), $start_time, $end_time) );
		$message = get_lang('mship_expiry_note', MAIL_FORMAT);
	}
	//Send mail

	foreach ($users as $user) {
		$recipient_choice = $osDB->getOne('select choice_value from ! where userid=? and choice_name=?', array(USER_CHOICES_TABLE, $user['id'], 'email_mship_expiry') );

		if ($recipient_choice == '1' or $recipient_choice == '' or !isset($recipient_choice) ) {

			$letter = $message;

			$letter = str_replace( '#FirstName#',  $user['firstname'] , $letter );

			$letter = str_replace( '#MembershipLevel#',  $user['levelname'] , $letter );

			if (!isset($user['levelend']) or $user['levelend'] == '') {
				$letter = str_replace( '#ExpiryDate#',  strftime(get_lang('DATE_FORMAT'),strtotime("-10 day",time()))  , $letter );
			} else {
				$letter = str_replace( '#ExpiryDate#',  strftime(get_lang('DATE_FORMAT'),$user['levelend']) , $letter );

			}

			$Subject = get_lang('expiry_ltr_sub');

			$From = $config['admin_email'];

			$To = $user['firstname'].' '.$user['lastname'].'<'.$user['email'].'>';


			$success = mailSender($From, $To, $user['email'], $Subject, $letter);
			sleep (1);
		}
	}

	unset($From, $To, $Subject, $letter, $users);

	$t->assign('msg', get_lang('expiry_ltr_sent') );

}

$expiry_levels = get_lang_values('expiry_interval');

$expiry_counts = array();

$prev_end = '';
foreach ($expiry_levels as $level => $item) {
	/* Calculate the numeric value of the exact date */
	if ($level == '0') {
		$start_time=strtotime(date('Ymd'));
		$count = $osDB->getOne('select count(*) from ! where (levelend < ? or levelend is null) and status in (?,?)',array(USER_TABLE, $start_time, 'active', get_lang('status_act','active')) );
		$expiry_counts[$level]['count'] = $count;
	} else {
		$start_time=strtotime(date('Ymd')) + (($level-1) * 86400);
		$end_time = $start_time + 86399;
		if ($prev_end == '') { $prev_end = $start_time; }
		$count = $osDB->getOne('select count(*) from ! where (levelend between ? and ? ) and status in (?,?)', array(USER_TABLE, $prev_end, $end_time, 'active', get_lang('status_act','active')) );
		$expiry_counts[$level]= array(
			'start_time' => $prev_end,
			'end_time'	=>	$end_time,
			'count' =>		$count
		);
		$prev_end = $end_time;
	}
}

$t->assign('expiry_levels', $expiry_levels);

$t->assign('expiry_counts', $expiry_counts);

unset($expiry_levels, $expiry_counts);

$t->assign('rendered_page', $t->fetch('admin/mship_expiry_reminders.tpl'));

$t->display( 'admin/index.tpl' );

?>