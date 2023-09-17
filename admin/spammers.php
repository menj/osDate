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

//For Deletion of profiles
if ( $_GET['txtdelete'] ) {
	deleteUser($_GET['txtdelete']);
}



$spamwords='';
$rs = $osDB->getAll( 'SELECT word FROM !', array( 'osdate_spamwords' ) );
foreach ( $rs as $row ) {
	if( $spamwords != '' )
		$spamwords = $spamwords . ' OR ';
	$spamwords = $spamwords . 'm.message LIKE \'%' . $row['word'] . '%\'';
}


$sql = 'SELECT u.id, u.username, DATE_FORMAT( FROM_UNIXTIME( m.sendtime ), \'%Y%m%d\' ) send_time, m.message, count(*) copies FROM ! u INNER JOIN ! m ON u.id = m.senderid AND m.folder = \'sent_item\' AND ( ' . $spamwords . ' ) GROUP BY 1, 2, 3, 4 HAVING count(*) > 1 ORDER BY 3 DESC LIMIT 300 ';

$rs = $osDB->getAll( $sql, array( USER_TABLE, MAILBOX_TABLE ) );

$spammers = array();

foreach ( $rs as $row ) {
	$spammers[] = $row;
}

$t->assign ( 'spammers', $spammers );

unset($spammers, $rs);

$t->assign('rendered_page', $t->fetch('admin/spammers.tpl'));

$t->display( 'admin/index.tpl' );

$osDB->disconnect();


?>
