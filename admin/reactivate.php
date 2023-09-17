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
*	This program will manage the featured profiles list
*
*/

if ( !defined( 'SMARTY_DIR' ) ) {

	include_once( '../init.php' );

}

include ( 'sessioninc.php' );

define( 'PAGE_ID', 'profile_mgt' );

if ( !checkAdminPermission( PAGE_ID ) ) {

	header( 'location: not_authorize.php' );
	exit;
}

if (isset($_GET['id'])) {

/* Need to reactivate this userid */
	$osDB->query('update ! set active = ?, regdate = ?, status = ? where id = ?', array( USER_TABLE, '1', time(), 'active', $_GET['id'] ) );

	$usr = $osDB->getRow('select username, firstname, lastname, email, level, levelend  from ! where id = ?',array(USER_TABLE, $_GET['id'] ) );

	if ($config['forum_installed'] != 'None' && $config['forum_installed'] != '') {
	    include_once(FORUM_DIR.$config['forum_installed'] . '_forum.php');
		forum_reactivate($usr['username']);
	}

	if ($config['letter_profilereactivated'] == 'Y') {
	/* Send email to the user */

		include (PEAR_DIR.'Mail/mime.php');

		$membershiplevel = $osDB->getOne('select name from ! where roleid=?', array(MEMBERSHIP_TABLE, $usr['level']) );

		$siteurl = HTTP_METHOD . $_SERVER['SERVER_NAME'] . DOC_ROOT ;

		$Subject = get_lang('profile_reactivated_sub') ;

		$From = $config['admin_email'];

		$To = $usr['email'];

		$message = get_lang('profile_reactivated', MAIL_FORMAT);

		$message = str_replace('#FirstName#', $usr['firstname'] ,$message);

		$message = str_replace('#ValidDate#',date(get_lang('DISPLAY_DATETIME_FORMAT'), $usr['levelend']), $message);

		$message = str_replace('#MembershipLevel#', $membershiplevel,$message);

		$success = mailSender($From, $To, $usr['email'], $Subject, $message);
		unset($message, $Subject, $From, $To);
	}

	$t->assign('errmsg' ,USER_REACTIVATED);
	$t->assign("error_message", get_lang('errormsgs', USER_REACTIVATED) );

	unset($usr);

}

$sort = findSortBy('username');

$t->assign('cancel_list', $osDB->getAll('select id, username, firstname, lastname, regdate from ! where status in (?,?) order by ! ', array( USER_TABLE,  get_lang('status_act','cancel'), 'cancel', $sort ) ) );

$t->assign('lang', $lang);

$t->assign( 'sort_type',( isset($_GET['type'])?checkSortType( $_GET['type'] ):'asc' ) );

$t->assign('rendered_page', $t->fetch('admin/reactivate.tpl'));

$t->display('admin/index.tpl');

?>