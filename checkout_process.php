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

if (!isset($pay_txn_id) || $pay_txn_id == '') {$pay_txn_id = $_REQUEST['pay_txn_id']; }

if (isset($_REQUEST['rtnlink']) ) { $rtnlink = $_REQUEST['rtnlink']; }

if (isset($_REQUEST['payment_cancel']) && $_REQUEST['payment_cancel'] == '1') {
	/* Payment processing cancelled by user.  */

	$osDB->query('update ! set payment_status=? where id = ?', array(TRANSACTIONS_TABLE,'Cancelled', $pay_txn_id) );

	$t->assign('error_msg', '1');

	$t->assign('rendered_page', $t->fetch('checkout_process.tpl') );

	$t->display( 'index.tpl' );

	exit;

}

if (!isset($paid_thru) || $paid_thru == '') {$paid_thru = $_REQUEST['paid_thru']; }

$valid = false;

switch ($paid_thru) {
	case 'pm2checkout':
		// 2CHECKOUT.COM
		$pay_txn_id = $_REQUEST['cart_order_id'];
		$txn_id			= $_REQUEST['order_number'];
		$email			= 'Credit Card';

		// check to see if payment is pending
		if ( $_REQUEST['credit_card_processed'] == 'Y' ) {
			$payment_status = 'Completed';
		} else {
			$payment_status = 'Declined';
		}
		$total = 0;
		$valid = true;
		break;

	case 'paypal':

		if (isset($_REQUEST['payment_status']) ) {
			$payment_status = $_REQUEST['payment_status'];
		} elseif (isset($_REQUEST['st'])) {
			$payment_status = $_REQUEST['st'];
		}
		$pay_txn_id = $_REQUEST['pay_txn_id'];
		$email = isset($_REQUEST['payer_email'])?$_REQUEST['payer_email']:'N A';
		if (isset($_REQUEST['txn_id'])) {
			$txn_id = $_REQUEST['txn_id'];
		} elseif (isset($_REQUEST['tx'])) {
			$txn_id = $_REQUEST['tx'];
		}
		$total = isset($_REQUEST['payment_gross'])?$_REQUEST['payment_gross']:(isset($_REQUEST['amt'])?$_REQUEST['amt']:0);
		$valid = true;
		$vars = addslashes(serialize($_REQUEST));
		break;

	case 'egold':

		$pay_txn_id = $_REQUEST['pay_txn_id'];
		$txn_id			= $_POST['PAYMENT_BATCH_NUM'];
		$total			= $_POST['PAYMENT_AMOUNT'];
		$email 			= $_POST['PAYER_ACCOUNT'];
		$payment_status = 'Completed';
		$valid = true; // e-gold payment are always instant, never pending
		break;

	case 'free':

		$pay_txn_id = $_REQUEST['pay_txn_id'];
		$txn_id			= $pay_txn_id;
		$total			= 0;
		$email			= $_SESSION['email'];
		$payment_status = 'Completed';
		$valid = true;

}

if ($paid_thru == 'pm2checkout' or $paid_thru == 'egold' or $paid_thru == 'paypal' or $paid_thru == 'free') {

	$vars = addslashes( serialize( $_POST ) );

	$params = array();

	$params['pay_txn_id'] = $pay_txn_id;
	$params['paid_thru'] = $paid_thru;
	$params['txn_id'] = $txn_id;
	$params['amount'] = $total;
	$params['payment_status'] = $payment_status;
	$params['valid'] = $valid;
	$params['email'] = $email;
	$params['vars'] = $vars;

	$level_name = process_payment_info($params);
}

$levels = $osDB->getRow('select mem.name, trn.payment_status from ! as trn, ! as mem where trn.id = ? and mem.roleid = trn.to_membership', array(TRANSACTIONS_TABLE, MEMBERSHIP_TABLE, $pay_txn_id) );

$t->assign ( 'level', $levels['name'] .' - Status: '.$levels['payment_status']);

$_SESSION['security'] = '';

$t->assign('paid_thru', $_REQUEST['paid_thru']);

hasRight('');

unset($levels);

$t->assign('rendered_page', $t->fetch('checkout_process.tpl') );

$t->display( 'index.tpl' );

exit;
?>