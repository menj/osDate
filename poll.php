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

include ( 'sessioninc.php' );

$txtquestion = $_POST['txtquestion'];

$txtoptions = array();

if (count($_POST['txtoptions']) > 0) {

	foreach ($_POST['txtoptions'] as $key=>$opt) {

		if ($opt != "") {

			$txtoptions[] = $opt;

		}

	}
}

if ( $_POST['action'] == get_lang('savepoll') ) {
	/* Add the question */

	if ($txtquestion == '') {

		$t->assign('error_msg', get_lang('signup_js_errors','question_noblank'));

	} elseif ( count($txtoptions) < 2) {

		$t->assign('error_msg', get_lang('minimum_options') );

	} else {

		$osDB->query('insert into ! (question, date, enabled, suggested_by) values ( ?, ?, ?, ? )', array( POLLS_TABLE, $txtquestion, time(), '0', $_SESSION['UserId'] ) );

		$pollid = $osDB->getOne('select id from ! where question = ?', array( POLLS_TABLE, $txtquestion) );

		foreach ($txtoptions as $key => $opt) {

			$osDB->query('insert into ! (pollid, opt, enabled) values ( ?, ?, ? )', array( POLLOPTS_TABLE, $pollid, $opt, '0' ));
		}

		$t->assign('saved', 1);

		$t->assign('error_msg', get_lang('pollsuggested'));

	}
}

$t->assign('txtoptions', $txtoptions);

$t->assign('txtquestion', $txtquestion);

unset( $txtoptions);

$t->assign('rendered_page', $t->fetch('poll.tpl') );

$t->display( 'index.tpl' );

exit;
?>