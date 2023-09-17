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
$error='';
if (isset($_POST['act']) && $_POST['act'] == 'send') {

	$email=isset($_POST['txtemail'])?strip_tags($_POST['txtemail']):'';

	if ($email == '') {

		$error = get_lang('errormsgs','19');

	} else {

		$row = $osDB->getRow( 'SELECT id, username, firstname, lastname, actkey, status, active FROM ! WHERE email = ? ', array( USER_TABLE, $email ) );

		if (isset($row) && isset($row['id']) && $row['id'] > 0) {
			if ($row['status'] == 'active' && $row['active'] == '1') {

				$error = get_lang('resend_conflink_err1');

				} else {
				/* resend the confirmation link email */

				/* Generate new password */
				$chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890abcdefghijklmnopqrstuvwxyz';

				$pwd = '';

				for( $i = 0; $i < 8; $i++ ) {

					$rand = rand( 0, strlen( $chars ) );
					$pwd .= $chars{$rand};
				}

				$osDB->query('update ! set password=? where id=?', array(USER_TABLE, md5($pwd), $row['id']) );

				$Subject = get_lang('profile_confirmation_email_sub');

				$From = $config['admin_email'];

				$To = $row['firstname'].' '.$row['lastname'].'<'.$email.'>';

				$body = get_lang('profile_confirmation_email', MAIL_FORMAT);

				$body = str_replace( '#FirstName#',  $row['firstname'] , $body );

				$body = str_replace( '#ConfCode#',  $row['actkey'] , $body );

				$body = str_replace('#Welcome#', get_lang('welcome'), $body);

				$body = str_replace( '#ConfirmationLink#',  HTTP_METHOD . $_SERVER['SERVER_NAME'] . DOC_ROOT . 'completereg.php?confcode' , $body );

				$body = str_replace( '#StrID#',  $row['username'] , $body );

				$body = str_replace( '#Email#',  $email , $body );

				$body = str_replace( '#Password#',  $pwd , $body );

				$body = str_replace( '#Upgrade#',  get_lang('upgrade_membership') , $body );

				mailSender($From, $To, $email, $Subject, $body);

				$error = get_lang('resend_conflink_msg');

				unset($body, $Subject, $email, $To, $From);

			}
		} else {

			$error = get_lang('letter_errormsgs','5');
		}
	}
}

$t->assign('error',$error);

$t->assign('lang',$lang);

$t->assign('rendered_page', $t->fetch('resend_conflink.tpl') );

$t->display( 'index.tpl' );
?>