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

/*
	Send_birthday_messages.php
	This will send birthday message for every user who is celeberating birthday today, based on  system date.

	Vijay Nair
*/

if ( !defined( 'SMARTY_DIR' ) ) {
	include_once( '../minimum_init.php' );
}

$start_uid = isset($_GET['start_uid'])?$_GET['start_uid']:'0';

/* Set 20 users in one batch to avoid system load issue */
$batch = 20;

/* Now select the users */
$users = $osDB->getAll('select SQL_CALC_FOUND_ROWS usr.id, usr.username, usr.firstname, usr.lastname, usr.levelend, mem.name as levelname, usr.email from ! as usr, ! as mem where mem.roleid = usr.level and usr.status in (?,?) and month(usr.birth_date) = month(now()) and dayofmonth(usr.birth_date) = dayofmonth(now()) order by usr.id limit 0,!', array(USER_TABLE, MEMBERSHIP_TABLE, 'active', get_lang('status_act','active'), $batch) );

$rcount = $osDB->getOne('select FOUND_ROWS()');

if ($rcount > 0) {

	$message_sub = get_lang('birthday_admin_msg_sub');
	$message = get_lang('birthday_admin_msg');

	//Send mail

	foreach ($users as $user) {

		echo("Sending mail to user: ".$user['username']."<br />");flush();

		$letter = str_replace( '#FirstName#',  $user['firstname'] , $message );

		$letter = str_replace( '#LastName#',  $user['lastname'] , $letter );

		$letter = str_replace( '#USERNAME#',  $user['username'] , $letter );

		$From = $config['admin_email'];

		$To = $user['firstname'].' '.$user['lastname'].'<'.$user['email'].'>';


		/* Don't bombard mail server, wait for some time */
		$success = mailSender($From, $To, $user['email'], $message_sub, $letter);

		$start_uid = $user['id'];

		sleep(1);
	}
	unset($users, $letter, $Subject, $From, $To);
}

if ($rcount > $batch) {
	flush();
	header($_SERVER['PHP_SELF'].'?start_uid='.$start_uid);

	exit;
}
echo(get_lang('birthday_messages_sent') );

exit;
?>