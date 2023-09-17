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

define( 'PAGE_ID', 'event_mgt' );
if ( !checkAdminPermission( PAGE_ID ) ) {
	header( 'location: not_authorize.php' );
	exit;
}

if ($_POST['action'] == get_lang('Approve')) {
/* approve */

	$osDB->query( 'update ! set enabled = ? where id = ?', array( EVENTS_TABLE, 'Y', $_POST['id'] ) );

	$errid = EVENT_APPROVED;

} elseif ($_POST['action'] == get_lang('reject')) {
/* Remove and remove */
	$osDB->query( 'delete from ! where id = ?',array( EVENTS_TABLE, $_POST['id'] ) );
	$errid = EVENT_REJECTED;
}

$items = $osDB->getAll( 'select * from ! where enabled = ? and private_to = "" and userid <> 0 order by datetime_from', array( EVENTS_TABLE, 'N' ) );
$events = array();
foreach ( $items as $row ) {
	$sql = 'select username, firstname, lastname from ! where id = ?';
	$user = $osDB->getRow( $sql, array( USER_TABLE, $row['userid'] ) );
	$row['username'] = $user['username'];
	$row['fullname'] = $user['firstname'] . ' '. $user['lastname'];
	$events[] = $row;
}

//print_r($events);
$t->assign('events', $events);

unset($events, $items, $row, $user);

$t->assign('errid',$errid);
$t->assign('rendered_page', $t->fetch('admin/approve_events.tpl'));
$t->display('admin/index.tpl');
?>