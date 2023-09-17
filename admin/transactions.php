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

define( 'PAGE_ID', 'payment_mgt' );

if ( !checkAdminPermission( PAGE_ID ) ) {

	header( 'location: not_authorize.php' );
	exit;
}


$data=array();

$mships = $osDB->getAll('select roleid, activedays, name from ! order by roleid',array( MEMBERSHIP_TABLE) );

$memberships = array();

foreach ($mships as  $val) {

	$memberships[$val['roleid']] = array(
		'activedays' => $val['activedays'],
		'name'		 => $val['name']
		);
}

unset($mships);

$rs = $osDB->getAll('select trans.*, user.username, user.status as userstatus, user.levelend   from ! as trans, ! as user where user.id = trans.user_id order by txn_date desc', array( TRANSACTIONS_TABLE, USER_TABLE) );

$reccount = count($rs);

$t->assign ( 'total_recs',  $reccount );

$t->assign( 'lang', $lang );

foreach ( $rs as $row ) {

	$row['mship_from_name'] = $memberships[$row['from_membership']]['name'];

	$row['mship_to_name'] 	= $memberships[$row['to_membership']]['name'];

	$row['trans_dt'] = strftime(get_lang('DATE_FORMAT'),strtotime($row['txn_date']));

	$data[]=$row;
}

$t->assign( 'data', $data );

unset($data,$rs);

$t->assign('rendered_page', $t->fetch('admin/transactions.tpl'));

$t->display( 'admin/index.tpl' );

?>