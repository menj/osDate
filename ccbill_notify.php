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
//already processed subscription_id, exit
$trnrec=$osDB->getRow('select * from ! where txn_id = ? ', array(TRANSACTIONS_TABLE, $_POST['subscription_id'] ));
if( $trnrec['id'] )
 exit;

// amount paid is less than amount expected
$trnrec=$osDB->getRow('select * from ! where invoice_no = ? ', array(TRANSACTIONS_TABLE, $_POST['invoiceid'] ));
if( $_POST['initialPrice']   < $trnrec['amount_paid']   )
  {
	$params['payment_status'] = 'Error';
	}
	else {

	// deals with both Approval and Denial URLs
	  if (  isset($_POST['subscription_id']) && strlen($_POST['subscription_id']) >  3 ) {
		  $params['payment_status'] = 'Completed';
	  } elseif (  isset($_POST['reasonForDecline'])  ) {
		  $params['payment_status'] = 'Declined';
	  } else {$params['payment_status'] = 'Error'; }
}

$params['txn_id'] = $_POST['subscription_id'];
$params['valid'] = true;
$params['pay_txn_id'] = $pay_txn_id = $_POST['invoiceid'];
$params['paid_thru'] = 'ccbill';
$params['amount'] = $_POST['initialPrice'];
$params['email'] = $_POST['email'];
$params['vars']  = serialize($_POST);

$level_name = process_payment_info($params);

$levels =$osDB->getRow('select mem.name, trn.payment_status from ! as trn, ! as mem where trn.invoice_no = ? and mem.roleid = trn.to_membership', array(TRANSACTIONS_TABLE, MEMBERSHIP_TABLE, $pay_txn_id) );

$t->assign ( 'level', $levels['name'] .' - Status: '.$levels['payment_status']);

$_SESSION['security'] = '';

hasRight('');

$t->assign('rendered_page', $t->fetch('checkout_process.tpl') );

$t->display( 'index.tpl' );

exit;


?>