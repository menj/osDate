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
	Send_osdate_mails.php
	This will send stored and pending mails through the gateway. It will send the number of emails set in configuration settings $config['mail_queuecount'] .

	Vijay Nair
*/

if ( !defined( 'SMARTY_DIR' ) ) {
	include_once( '../minimum_init.php' );
}


/* Now select the users */
if ($config['mail_queuecount'] > 0) {
	$mails = $osDB->getAll('select * from ! limit !',array(OUT_MAILS_TABLE,$config['mail_queuecount']) );
} else {
	$mails = $osDB->getAll('select * from ! ',array(OUT_MAILS_TABLE) );
}

if (count($mails) > 0) {
	echo('Starting sending mails..<br />');

 	foreach ($mails as $k=>$mail) {

		$ok = sendMail($mail);

		if ($ok != false) {
			$osDB->query('delete from ! where id = ?', array(OUT_MAILS_TABLE,$mail['id']) );
		}
		sleep (1);
	}
	echo(get_lang('mails_sent').'<br />' );
}
unset($mails);

exit;
?>