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

//Include init.php
if ( !defined( 'SMARTY_DIR' ) ) {
	include_once( 'init.php' );
}

$name = isset($_POST[ 'txtname' ] )?strip_tags(trim( $_POST[ 'txtname' ] ) ):'';

$password = isset($_POST[ 'txtpassword' ] )?strip_tags(trim( $_POST[ 'txtpassword' ] ) ):'';

$conpassword = isset($_POST[ 'txtconpassword' ] )?strip_tags(trim( $_POST[ 'txtconpassword' ] ) ):'';

$email = isset($_POST[ 'txtemail' ] )?strip_tags(trim( $_POST[ 'txtemail' ] ) ):'';

if( $name=='' || $password=='' || $email=='' || $conpassword =='' ){

	header( 'location: affindex.php?error=' . get_lang('affiliates_error',0));
	exit;

} elseif( $conpassword != $password ){

	header( 'location: affindex.php?error=' . get_lang('affiliates_error',1));
	exit;

}

$rowc = $osDB->getRow( 'SELECT count(*) as aacount from ! where email= ? ', array( AFFILIATE_TABLE, $email ) );

if ( $rowc['aacount'] > 0 ) {

	header( 'location: affindex.php?error=' . get_lang('affiliates_error',2));
	exit;

}

$status = 'approval';

if ($config['aff_default_active_status'] == 'Y') $status = 'active';

$regdate = time();

$osDB->query ( "INSERT INTO ? (  name, email, password, status, regdate ) VALUES ( ?, ?, ?, ?, ? )", array( AFFILIATE_TABLE, $name, $email, md5($password), $status, $regdate ) );

$lastid = $osDB->getOne('select id from ! where name = ? and email = ?', array(AFFILIATE_TABLE, $name, $email));

$t->assign ( 'affid', $lastid );

$t->assign('rendered_page', $t->fetch('affsignupsuccess.tpl') );

$t->display( 'index.tpl' );

exit;
?>

