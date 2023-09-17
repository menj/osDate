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

$returnto = 'payment.php';

include ( 'sessioninc.php' );

$t->assign( 'data',$osDB->getAll( 'SELECT * from ! WHERE enabled = ?', array( PAYMENT_MODULE_TABLE, 'Y' ) ) );
/*
$privileges = array(
	'chat',
	'forum',
	'blog',
	'includeinsearch',
	'message',
	'message_keep_cnt',
	'message_keep_days',
	'uploadpicture',
	'uploadpicturecnt',
	'allowim',
	'allowalbum',
	'seepictureprofile',
	'favouritelist',
	'sendwinks',
	'extsearch',
	'event_mgt',
	'activedays',
	'saveprofiles',
	'saveprofilescnt',
	'allow_mysettings',
	'allow_php121',
	'allow_videos',
	'videoscnt',
	'price',
	'currency'
);
*/
$privileges = array_keys(get_lang_values('privileges'));
$privileges[]='price';
$privileges[]='currency';

$j = 0;

$temp = $osDB->getAll( 'select id, roleid, name from ! where enabled = ? and id <> ? and ifnull(hide,0)<>1  order by price', array( MEMBERSHIP_TABLE, 'Y', 3 ) );

$m_row = array();

$m_name = array();

foreach( $temp as $index => $rowtmp ) {

	$temp2 = $osDB->getAll( 'select * from ! where id = ?', array( MEMBERSHIP_TABLE, $rowtmp['id'] ) );

	$m_name[$rowtmp['roleid']] = $rowtmp['name'];

	foreach( $temp2 as $index2 => $row ) {

		foreach( $privileges as $item ) {

			$m_row[$item][$j] = $row[$item];
		}

		$j++;
	}
	unset($temp2);
}

unset($temp);

$t->assign('lang', $lang);

$t->assign( 'm_row' , $m_row );

$t->assign( 'memberships' , $m_name );

$t->assign('privileges',$privileges);

unset($privileges, $m_row, $m_name);

$t->assign('rendered_page', $t->fetch('payment.tpl') );

$t->display( 'index.tpl' );

exit;

?>
