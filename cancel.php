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

include( 'sessioninc.php' );


if ((isset($_POST['action']) && $_POST['action'] == '' ) || !isset($_POST['action']) ) {

	$t->assign('step','1');

} else {

	if (isset($_POST['action']) && $_POST['action'] == get_lang('cancel_opt01')) {
	/* Cancel membership */

		$username = $osDB->getOne('select username from ! where id = ?',array( USER_TABLE, $_SESSION['UserId'] ) ) ;

		$osDB->query('update ! set status=?, active=?, regdate = ? where id = ?', array( USER_TABLE, 'cancel', 0, time(), $_SESSION['UserId'] ) );

		if ($config['forum_installed'] != '' && $config['forum_installed'] != 'None') {
			include_once(  FORUM_DIR . 'forum_inc.php' );

		    include_once(FORUM_DIR.$config['forum_installed'] . '_forum.php');

			forum_cancel($username);
		}

		$osDB->query( 'DELETE FROM ! WHERE userid = ?', array( ONLINE_USERS_TABLE, $_SESSION['UserId'] ) );

		/* Delete from Shoutbox and Entries */
		$osDB->query( 'DELETE FROM ! WHERE from_user = ?', array( SHOUTBOX_TABLE, $_SESSION['UserId'] ) );

		session_destroy();

		session_start();

		$t->assign('step','2');

	} else {

		$t->assign('step','3');

	}

}

$t->assign('lang',$lang);

$t->assign( 'rendered_page', $t->fetch( 'cancel.tpl' ) );

$t->display('index.tpl');

?>