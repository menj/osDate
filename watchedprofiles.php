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

include('sessioninc.php');

if (isset($_REQUEST['groupaction']) && $_REQUEST['groupaction'] == get_lang('delete_selected') ) {

	$checked = $_POST['txtcheck'];

	if (count($checked) > 0) {
		foreach ($checked as $val) {

			$osDB->query('DELETE from ! where id = ?', array( USER_WATCHED_PROFILES, $val ) );
		}
		unset($checked);
		$t->assign('error_message', get_lang('errormsgs',REMOVEDFROMLIST) );
	}
}

if (isset($_GET['remove']) && $_GET['remove'] == '1') {
	/* Remove from the list */

	$osDB->query('DELETE from ! where id = ? ', array( USER_WATCHED_PROFILES, $_GET['id'] ) );

	$t->assign('error_message', get_lang('errormsgs',REMOVEDFROMLIST) );

}

$t->assign('lang',$lang);

if (isset($_GET['act']) && $_GET['act'] == 'save' ) {

	/* first get the total number of saved profiles and see if the count exhaused */

	$cnt = $osDB->getOne('select count(*) from ! where userid = ?', array(USER_WATCHED_PROFILES, $_SESSION['UserId']) );

	if ($_GET['ref_id'] != '' && $cnt < $_SESSION['security']['saveprofilescnt']) {

		$alrdy = $osDB->getOne('select count(*) from ! where userid = ? and ref_userid = ?', array(USER_WATCHED_PROFILES, $_SESSION['UserId'],$_GET['ref_id'] ) );
		if ($alrdy <= 0) {

			$osDB->query('insert into ! (userid, ref_userid) values (?, ?)', array(USER_WATCHED_PROFILES, $_SESSION['UserId'], $_GET['ref_id']) );

			$errid=202;
		} else {
			$errid = 203;
		}

	} else {

		$errid=201;
	}

	header("location: ".$_GET['rtnurl']."?id=".$_GET['ref_id']."&errid=".$errid);
	exit;

}

/* Show the watched profiles list */

$t->assign('list', $osDB->getAll('select lis.ref_userid, usr.id as userid, lis.id as lisid, usr.username as ref_username from ! as lis, ! as usr where lis.userid = ? and lis.ref_userid = usr.id order by usr.username ', array( USER_WATCHED_PROFILES, USER_TABLE, $_SESSION['UserId'] ) ) );

$t->assign('rendered_page', $t->fetch('watchedprofiles.tpl') );

$t->display('index.tpl');


?>