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
/* THis shuld be called as
	/cronjobs/speeddater_email.php?number=x
	x = the number of mail to be sent at each cron job run
	x is by default 100
*/

$installed = $osDB->getOne('select name from ! where name=? and active=?',array(PLUGIN_TABLE, 'speedDater','1') );
if (isset($installed) && $installed == 'speedDater') {

	$table=DB_PREFIX."_speedDater_speeddater";
	$number=$_GET['number'];
	if(!$number) $number=100;

	$data = $osDB->getAll("SELECT * FROM ! WHERE sent=? ORDER BY id ASC LIMIT 0,!",array($table,0,$number));
	foreach ($data as $item)
	{
		$file=TEMP_DIR."speeddater/sd_{$item['ts']}_{$item['owner']}_{$item['friend']}.txt";
		$handle=fopen($file,"r");
		$content=fread($handle,filesize($file));
		fclose($handle);
		$mail=unserialize($content);
		unlink($file);

		$From= $mail['from'];

		$To = $mail['to'];

		$message = $mail['message'];

		$message = str_replace('#FirstName#', $user['firstname'] ,$message);

		$message = str_replace('#matchedProfiles#', $profs, $message);

		mailSender($From, $To, $To, $mail['subject'], $message);

		/* Don't bombard the mailer program */
		sleep(2);
		$osDB->query("UPDATE ! SET sent=? WHERE id=?",array($table,1,$item['id']));

	}
	unset($data, $message, $From, $To);
}
exit;
?>