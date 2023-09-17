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

class _authorizenet {


	var $DEBUGGING					= 1;				# Display additional information to track down problems
	var $TESTING					= 1;				# Set the testing flag so that transactions are not live
	var $ERROR_RETRIES				= 2;				# Number of transactions to post if soft errors occur

	var $auth_net_url				= "";
	var $method=false;

	#  Uncomment the line ABOVE for test accounts or BELOW for live merchant accounts
	#  $auth_net_url				= "https://secure.authorize.net/gateway/transact.dll";
	function _authorizenet($method,$debug){

		$this->method=$method;

		$this->auth_net_url=($debug==true)?"https://certification.authorize.net/gateway/transact.dll":"https://secure.authorize.net/gateway/transact.dll";

	}

	function post($login, $key, $amount, $cardno, $expiry)
	{
		if($this->method==true)
		{
			return $this->postAIM($login,$key,$amount,$cardno,$expiry);
		}
	}

	function postAIM($login, $key, $amount, $cardno, $expiry){

		if($this->method==false)
		{
			return;
		}

		$authnet_values				= array
		(
			"x_login"				=> $login,
			"x_version"				=> "3.0",
			"x_delim_char"			=> "|",
			"x_delim_data"			=> "TRUE",
			"x_url"					=> "FALSE",
			"x_type"				=> "AUTH_CAPTURE",
			"x_method"				=> "CC",
		 	"x_tran_key"			=> $key,
		 	"x_relay_response"		=> "FALSE",
			"x_card_num"			=> $cardno,
			"x_exp_date"			=> $expiry,
			"x_description"			=> "Membership upgrade charges",
			"x_amount"				=> $amount
		);

		$fields = "";
		foreach( $authnet_values as $key => $value ) $fields .= "$key=" . urlencode( $value ) . "&";


		// Post the transaction (see the code for specific information)
		$ch = curl_init($this->auth_net_url);

		###  Uncomment the line ABOVE for test accounts or BELOW for live merchant accounts
		### $ch = curl_init("https://secure.authorize.net/gateway/transact.dll");
		curl_setopt($ch, CURLOPT_HEADER, 0); // set to 0 to eliminate header info from response
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); // Returns response data instead of TRUE(1)
		curl_setopt($ch, CURLOPT_POSTFIELDS, rtrim( $fields, "& " )); // use HTTP POST to send form data
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); // uncomment this line if you get no gateway response. ###
		$resp = curl_exec($ch); //execute post and get results
		curl_close ($ch);
		return $resp;
	}
}

$trans_mode=false;
if(isset($_POST['x_trans_mode']))
{
	$trans_mode=strtolower($_POST['x_trans_mode'])=='test'?true:false;
}
else {
	$trans_mode=false;
}

$auto=new _authorizenet(true,$trans_mode);

$resp=$auto->post($_POST['x_login'],$_POST['x_trans_key'],$_POST['x_amount'],$_POST['x_card_num'],$_POST['x_exp_date']);

$params = array();

$response = explode('|',$resp);

$response_code=$response[0];

if ($response_code == '1') {
	$params['payment_status'] = 'Completed';
} elseif ($response_code == '2') {
	$params['payment_status'] = 'Declined';
} else {$params['payment_status'] = 'Error'; }

$params['txn_id'] = $response[6].' - '.$response[4];
$params['valid'] = true;
$params['pay_txn_id'] = $pay_txn_id = $_POST['pay_txn_id'];
$params['paid_thru'] = 'authorizenet';
$params['amount'] = $respose[9];
$params['vars'] = $resp;
$params['email'] = 'Credit Card';

$level_name = process_payment_info($params);
unset($params);
header('location: checkout_process.php?paid_thru=authorizenet&pay_txn_id='.$pay_txn_id);

?>