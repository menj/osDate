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

$email = isset($_POST['forgot_pass_email'])?trim( $_POST['forgot_pass_email'] ):'';

if ( $email == '' ) {
	header( 'location: afflogin.php?errormsg='.urlencode(get_lang('letter_errormsgs','1')) );
	exit;

}

$row = $osDB->getRow( 'SELECT name, email, password FROM ! WHERE email = ? ' ,array( AFFILIATE_TABLE, $email ));

if ( $row ) {

	//Generate Password
	$chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890abcdefghijklmnopqrstuvwxyz';

	$pwd = '';

	for( $i=0; $i<8; $i++ ) {

		$rand = rand(0,strlen($chars));

		$pwd .= $chars{$rand};
	}

	$osDB->query( 'UPDATE ! SET password = ? WHERE email = ?', array(AFFILIATE_TABLE, md5( $pwd ), $email ));

	$subject = get_lang('aff_newpwd_sub');

	$body = get_lang('aff_newpwd',MAIL_FORMAT);

	$name = $row['name'];

	$body = str_replace( '#Name#', $name , $body );

	$body = str_replace( '#Password#', $pwd, $body );

	mailSender($config['admin_email'], $email, $email, $subject, $body);
	unset($row, $body);
	header( 'location: afflogin.php?errormsg='.urlencode(get_lang('letter_errormsgs',ALL_OK)) );

	exit;

} else {

	header( 'location: afflogin.php?errormsg='.urlencode(get_lang('letter_errormsgs',NOT_REGISTERED )) );
	exit;

}
?>