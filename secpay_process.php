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

foreach ($_POST as $key => $value) {
	$value = urlencode(stripslashes($value));
	$req .= "&$key=$value";
}

$pay_txn_id = $_REQUEST['pay_txn_id'];

$amount = $_REQUEST['amount'];

$invoice_no = $_SESSION['trans_id'];

$code = $_REQUEST['code'];

$resp_code	= $_REQUEST['resp_code'];

$auth_code = $_REQUEST['auth_code'];

$txn_rec = $osDB->getRow("Select * from ! WHERE id =?", array(TRANSACTIONS_TABLE, $pay_txn_id) );

if ( $txn_rec['id'] == $pay_txn_id ){
	$txn_exist = true;
} else{
	$txn_exist = false;
}


// process payment
if ( $auth_code!='' && $txn_exist ) {

	$mem = $osDB->getRow('SELECT roleid, activedays FROM ! WHERE name =?', array(MEMBERSHIP_TABLE, $txn_rec['to_membership'] ) );

	$new_level = $mem['roleid'];
	$activedays = $mem['activedays'];

	$usr = $osDB->getRow("SELECT level, levelend FROM ! WHERE id =?",array(USER_TABLE, $txn_rec['user_id'] ) );

	$curlevel = $usr['level'];
	$levelend = $usr['levelend'];
	if ($curlevel != $new_level) {$levelend = time();}


	$status = ($code == 'A')?'Authorized':'Not Authorized';

	if ($amount < $txn_rec['amount_paid']) {

		$status .= ' - Part Payment';

	} elseif ($amount > $txn_rec['amount_paid']) {

		$status .= ' - Excess Payment';
	}

	/* UPdate transaction record */

	$osDB->query('update ! set txn_id = ?,  payment_status = ?, payment_vars = ? where id = ?', array(TRANSACTIONS_TABLE, $auth_code, trim($status), $req,$pay_txn_id ) );

	if ($code == 'A') {
		// new expiration date for this member is set below

		$levelend = strtotime( "+$activedays day", $levelend );

		$osDB->query('UPDATE ! SET level = ?, levelend = ? WHERE id = ?', array(USER_TABLE, $new_level, $levelend, $txn_rec['user_id']) );

		$t->assign('level',$item_name.' - Status: '.$payment_status);

	} else {

		$t->assign('error_msg',1);
	}
	unset($usr, $mem);
	$t->assign('rendered_page', $t->fetch( 'checkout_process.tpl' ) );

	$t->display( 'index.tpl' );


}


?>