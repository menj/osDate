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

$oldpwd = trim( $_POST['txtoldpwd'] );
$newpwd = trim( $_POST['txtnewpwd'] );
$conpwd = trim( $_POST['txtconpwd'] );

if ( $newpwd == $conpwd ) {

	if ( !isset($_SESSION['spam_code']) || (strtolower($_POST['spam_code']) != strtolower($_SESSION['spam_code'])  ) && $config['spam_code_length'] > 0 ) {

		header( "location: changempass.php?errid=121" );

		exit;
	}

	$exists = $osDB->getOne( 'SELECT id FROM ! WHERE id = ? AND password = ?', array( USER_TABLE, $_SESSION['UserId'], md5( $oldpwd ) ) );

	if ( $exists ) {

		$osDB->query( 'update ! set password = ? where id = ?', array( USER_TABLE, md5( $newpwd ), $_SESSION['UserId'] ) );

		if ($config['forum_installed'] != '' && $config['forum_installed'] != 'None') {

		    include_once(FORUM_DIR.$config['forum_installed'] . '_forum.php');

			forum_modifympass($conpwd);

		}

		$t->assign('rendered_page', $t->fetch('pwdchanged.tpl') );

		$t->display( 'index.tpl' );

		exit;

	} else {

		header( "location: changempass.php?errid=".WRONG_OLD_PASSWORD );

	}

} else {

	header( "location: changempass.php?errid=".PASS_CONFIRMPASS );

}

?>