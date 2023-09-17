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

include ( 'affsessioninc.php' );

$oldpwd = trim( $_POST['txtoldpwd'] );
$newpwd = trim( $_POST['txtnewpwd'] );
$conpwd = trim( $_POST['txtconpwd'] );

if ( $newpwd == $oldpwd ) {

	header( 'location: affchangepass.php?errid=' . OLD_NEW_PASSWORD_MUST_DIFFER );

} elseif ( $newpwd == $conpwd ) {

	$id = $osDB->getOne( 'select id from ! where id = ? and password = ?', array( AFFILIATE_TABLE, $_SESSION['AffId'], md5( $oldpwd ) ) );

	if ( $id ) {

		$osDB->query( 'update ! set password = ? where id = ?', array( AFFILIATE_TABLE, md5( $newpwd ), $_SESSION['AffId'] ) );

		$t->assign( 'rendered_page', $t->fetch( 'affpwdchanged.tpl' ) );

		$t->display( 'index.tpl' );

		exit;
	} else {
		header( 'location: affchangepass.php?errid=' . WRONG_OLD_PASSWORD );//change to a constant later
	}
} else {
	header( 'location: affchangepass.php?errid=' . PASS_CONFIRMPASS );//change to a constant later
}

?>