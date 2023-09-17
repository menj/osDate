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



$pay_txn_id = $_SESSION['invoice_no'];

session_unregister('invoice_no');


if (isset($_REQUEST['payment_cancel']) && $_REQUEST['payment_cancel'] == 1) {
	/* Payment processing cancelled by user.  */

	$sql = 'update ! set payment_status=? where invoice_no = ?';

	$osDB->query($sql, array(TRANSACTIONS_TABLE,'Cancelled', $pay_txn_id) );

	$t->assign('error_msg', '1');

	$t->assign('rendered_page', $t->fetch('checkout_process.tpl') );

	$t->display( 'index.tpl' );

	exit;



}


$trnrec=$osDB->getRow('select * from ! where invoice_no = ? ', array(TRANSACTIONS_TABLE, $pay_txn_id ));


if( $trnrec['payment_status'] == 'Completed'  ) {


$levels =$osDB->getRow('select mem.name, trn.payment_status from ! as trn, ! as mem where trn.invoice_no = ? and mem.roleid = trn.to_membership', array(TRANSACTIONS_TABLE, MEMBERSHIP_TABLE, $pay_txn_id) );

$t->assign ( 'level', $levels['name'] .' <br /><br /> Payment Status: '.$levels['payment_status']);

$_SESSION['security'] = '';

hasRight('');

$t->assign('rendered_page', $t->fetch('checkout_process.tpl') );

$t->display( 'index.tpl' );

exit;


}

else  {


  if($trnrec['payment_status'] == 'Declined' )

	  $message = "Your Payment was declined by CCBill";

	else if ($trnrec['payment_status'] == 'Error' )

	 { $message = "Payment Received. But the has been an error.<br/>Please contact site admin "; }

	else

	  { $message = "Your Payment has not been processed by CCBill"; }

	$t->assign('message', "<b><p>\n<font color=red>".$message."</font></p><br /></b>");

	$t->assign('error_msg', '1');

	$t->assign('rendered_page', $t->fetch('checkout_process.tpl') );

	$t->display( 'index.tpl' );

	exit;




}
?>