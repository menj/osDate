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


$req ='';

foreach ($_POST as $key => $value) {
	$value = urlencode(stripslashes($value));
	if ($req != '') $req.='&';
	$req .= "$key=$value";
}

$params = array();

// assign posted variables to local variables

$params['pay_txn_id'] = $_REQUEST['pay_txn_id'];
$params['email'] = $_POST['from_email'];
$params['txn_id'] = $_POST['transaction_id'];
$params['amount'] = $_POST['amount'];

$url = 'https://www.nochex.com/nochex.dll/apc/apc';
$ch = curl_init ();
curl_setopt ($ch, CURLOPT_URL, $url);
curl_setopt ($ch, CURLOPT_POST, true);
curl_setopt ($ch, CURLOPT_POSTFIELDSIZE, 0);
curl_setopt ($ch, CURLOPT_POSTFIELDS, trim($req));
curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt ($ch, CURLOPT_TIMEOUT, 60);
curl_setopt ($ch, CURLOPT_SSLVERSION, 3);
curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, 0);

curl_setopt($ch, CURLOPT_HEADER, 0); // set to 0 to eliminate header info from response
$resp = curl_exec($ch); //execute post and get results
curl_close ($ch);

if (trim($resp) == 'AUTHORISED') { $payment_status = 'Completed';
} else {$payment_status = 'Declined'; }

$vars = addslashes( serialize( $_POST ) );

$params['vars'] = $vars;
$params['valid'] = true;
$params['payment_status'] = $payment_status;
$params['paid_thru'] = 'nochex';

$x = process_payment_info($params);

exit;
?>