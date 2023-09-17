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

//For Editing Modules
if (isset( $_GET['edit']) &&  $_GET['edit']!='' ) {

	$data = $osDB->getRow( 'SELECT * from ! where module_key = ?', array( PAYMENT_MODULE_TABLE, $_GET['edit'] ) );

	if (isset($_GET['errid']) && $_GET['errid']!='') {
		$t->assign( 'error', get_lang('admin_error_msgs', $_GET['errid'] ) );
	}
	$data['formfile'] = 'admin/'.$data['formfile'];

	$t->assign( 'data', $data );

	unset($data);

	$confdata = $osDB->getAll( 'SELECT configuration_key, configuration_value from ! where module_key = ?', array( TABLE_CONFIGURATION, $_GET['edit'] ) );

	$paymod_data = array();

	foreach( $confdata as $confitem ) {

		$paymod_data[ $confitem['configuration_key'] ] = $confitem['configuration_value'];
	}

	$t->assign( 'paymod_data', $paymod_data );

	unset($confdata, $paymod_data);

	$t->assign('rendered_page', $t->fetch('admin/paymentmodedit.tpl'));

	$t->display( 'admin/index.tpl' );

	exit;
} else if ( isset($_GET['delete']) && $_GET['delete']!='' ) {
//For Deletion of sections

	$osDB->query( 'UPDATE ! SET enabled = ? WHERE module_key = ?', array( PAYMENT_MODULE_TABLE, 'N', $_GET['delete'] ) );

	$payment= $_GET['delete'];

	require( '../modules/payment/'.$payment.'.php' );

	$payment_module =& new $payment;

	$payment_module->remove();

} else if ( isset($_GET['install']) && $_GET['install']!='' ) {
//Insert new section

	$osDB->query( 'UPDATE ! SET enabled = ? WHERE module_key = ?', array( PAYMENT_MODULE_TABLE, 'Y', $_GET['install'] ) );

	$payment= $_GET['install'];

	require( '../modules/payment/'.$payment.'.php' );

	$payment_module =& new $payment;

	$payment_module->install();

}

$t->assign( 'data', $osDB->getAll( 'SELECT * from !', array( PAYMENT_MODULE_TABLE ) ) );

$t->assign('rendered_page', $t->fetch('admin/paymentmod.tpl'));

$t->display( 'admin/index.tpl' );

exit;
?>