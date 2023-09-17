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

$sname = isset($_POST['txtsendername'] )?trim( $_POST['txtsendername'] ):'';
$semail = isset($_POST['txtsenderemail'] )?trim( $_POST['txtsenderemail'] ):'';
$femail = isset($_POST['txtrcpntemail'] )?trim( $_POST['txtrcpntemail'] ):'';

if ( (!isset($_SESSION['spam_code']) || !isset($_POST['spam_code']) || strtolower($_SESSION['spam_code']) != strtolower($_POST['spam_code']) ) && $config['spam_code_length'] > 0 )  {
	$t->assign('msg', get_lang('errormsgs',121));
	$t->assign('txtsendername', $sname);
	$t->assign('txtsenderemail', $semail);
	$t->assign('txtrcpntemail', $femail);
	$t->assign('rendered_page', $t->fetch('tellafriend.tpl') );
	$t->display ( 'index.tpl' );
	exit;
}

$subject = str_replace('#FromName#',$sname, get_lang('invite_a_friend_sub'));

$body = get_lang('invite_a_friend', MAIL_FORMAT);

$body = str_replace( '#FromName#',  $sname , $body );

$From    = $sname . ' <'. $semail . '>';
$To = $femail;

$success = mailSender($From, $To, $femail, $subject, $body);

unset($body, $subject, $From, $To, $femail);

if( $success ) {
	$t->assign('msg', get_lang('taf_errormsgs',0) );
} else {
	$t->assign('msg', get_lang('taf_errormsgs',3).chr(10).get_lang('errormsgs','301') );
}
$t->assign('rendered_page', $t->fetch('tellafriend.tpl') );
$t->display ( 'index.tpl' );
?>