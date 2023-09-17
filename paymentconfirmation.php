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

include ( 'sessioninc.php' );

if ($_POST['payment'] == 'CcBill') $_POST['payment']='ccbill';
$row = $osDB->getRow( 'SELECT roleid, name, price, currency FROM ! WHERE roleid = ?', array( MEMBERSHIP_TABLE, $_REQUEST['membership'] ) );

$t->assign( 'item_no', $row['roleid'] );
$t->assign( 'item_name', $row['name'] );
$t->assign( 'amount', $row['price'] );
$t->assign( 'currency', $row['currency'] );

$currency = $row['currency'];

if ($row['price'] == '0') $payment = 'free';

$amount = $row['price'];

/* Now create a record in the database for this transwaction with status 'Started'  */

$invoice_no = $_SESSION['UserId']."-".time();

$_SESSION['invoice_no'] = $invoice_no;

$t->assign('invoice_no', $invoice_no);

$osDB->query('insert into ! (user_id, invoice_no, from_membership, to_membership, amount_paid, txn_date, payment_mod, payment_status ) values (?, ?, ?, ?, ?, ?, ?, ?)', array(TRANSACTIONS_TABLE, $_SESSION['UserId'], $invoice_no, $_SESSION['RoleId'], $_POST['membership'], $row['price'], date('Ymd'), $_POST['payment'], 'Started'));

$_SESSION['pay_txn_id'] = $osDB->getOne('select id from ! where invoice_no = ?',array(TRANSACTIONS_TABLE, $invoice_no));

$t->assign('pay_txn_id',$_SESSION['pay_txn_id']);

$t->assign("currency_is",get_lang('support_currency',$currency) );

if ( strtolower( $_REQUEST['payment'] ) == 'free' ) {

	if ( $row['price'] == 0 ) {

		unset($row);
		$t->assign('rendered_page', $t->fetch('free_checkout.tpl') );

		$t->display( 'index.tpl' );

		exit;

	} else {

		unset($row);
		header( 'location: payment.php?err=' . get_lang('mship_errors',4) );

		exit;
	}
} else {
	$payment = $_POST['payment'];

	if( $payment == '' ) {

		header( 'location: payment.php?err=' . get_lang('signup_js_errors','select_payment') );

		exit;
	}

	require( 'modules/payment/'.$payment.'.php');

  	$paymod =& new $payment;

	$paymod->process_button();

	unset($row);

	$t->display( 'index.tpl' );

}

?>
