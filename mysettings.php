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

include ('sessioninc.php');

$act = isset($_REQUEST['act'])?$_REQUEST['act']:'';

/* Select the choices from language file */
$choices = get_lang_values('user_choices');
if (isset($_POST['email_match_mail_days'])) {
	$email_match_mail_days = (int)strip_tags($_POST['email_match_mail_days']);
} else {
	$email_match_mail_days=0;
}

if ($_POST) {
	if ($act == 'modify') {
		$sql = 'update ! set choice_value = ? where userid = ? and choice_name=?';

		/* Process each option to update */

		foreach ($choices as $key => $val) {
			$check = $osDB->getOne('select count(*) from ! where userid = ? and choice_name = ?',array(USER_CHOICES_TABLE, $_SESSION['UserId'], $key) );
			if ($check > 0) {
				if ($key == 'email_match_mail_days') {
					$osDB->query($sql, array( USER_CHOICES_TABLE, $email_match_mail_days, $_SESSION['UserId'], $key)  );
				} else {
					$osDB->query($sql, array( USER_CHOICES_TABLE, $_POST[$key], $_SESSION['UserId'], $key)  );
				}
			} else {
				if ($key == 'email_match_mail_days') {
					$osDB->query('insert into ! (userid, choice_name, choice_value) values (?, ?, ?)',array( USER_CHOICES_TABLE, $_SESSION['UserId'], $key, $email_match_mail_days) );
				} else {
					$osDB->query('insert into ! (userid, choice_name, choice_value) values (?, ?, ?)',array( USER_CHOICES_TABLE, $_SESSION['UserId'], $key, $_POST[$key]) );
				}
			}
		}
	} else {
		/* Add new options */
		$sql = 'insert into ! (userid, choice_name, choice_value) values (?, ?, ?)';
		/* Process each option to update */
		foreach ($choices as $key => $val) {
			if ($key == 'email_match_mail_days') {
				$osDB->query($sql,array( USER_CHOICES_TABLE, $_SESSION['UserId'], $key, $email_match_mail_days) );
			} else {
				$osDB->query($sql,array( USER_CHOICES_TABLE, $_SESSION['UserId'], $key, $_POST[$key]) );
			}
		}

	}
	unset($sql);
	$t->assign('error', get_lang('mysettings_updated'));

}

$user_choices = array();

$t->assign('act','add');

$recs = $osDB->getAll('select * from ! where userid = ?',  array(USER_CHOICES_TABLE, $_SESSION['UserId']));

if (count($recs) > 0) {

	$t->assign('act','modify');

	foreach ($recs as $rec) {

		$user_choices[$rec['choice_name']] = $rec['choice_value'];
	}

	unset($recs);
}

$_SESSION['mysettings'] = $user_choices;

$t->assign('user_choices', $user_choices);

$lang['user_choices'] = $choices;

$t->assign('lang', $lang);

unset($user_choices, $choices);

$t->assign('rendered_page', $t->fetch('mysettings.tpl') );

$t->display('index.tpl');


?>