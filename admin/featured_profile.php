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


/*
*	This program will add profile to featured profiles list
*
*/

if ( !defined( 'SMARTY_DIR' ) ) {

	include_once( '../init.php' );

}

include ( 'sessioninc.php' );

$req_action = isset($_REQUEST['req_action'])? $_REQUEST['req_action']:'';

$data = array();

if ( isset($_POST['cancelthis']) && $_POST['cancelthis'] == get_lang('cancel')) {
/* Cancel this procedure*/

	header ('location: '.$_POST['bckurl']);

	exit;
}

$t->assign('req_action', $req_action);

$data['bckurl'] = isset($_GET['bckurl']) ? $_GET['bckurl']:'';

if ( isset($_GET['userid']) && $_GET['userid'] > 0 ) {

	$row  = $osDB->getRow('select username, firstname, lastname from ! where id = ?', array( USER_TABLE, $_GET['userid'] ) );

	$data['step'] = 2;

	$data['username'] = $row['username'];

	$data['fullname'] = $row['firstname'].' '.$row['lastname'];

	$start_date = date('Y-m-d',time());

	$end_date = date('Y-m-d',strtotime("+30 day", time()));

	$data['start_date'] = $start_date;

	$data['end_date']  = $end_date;

	$t->assign('data', $data);

	unset($data, $row);

	$t->assign('rendered_page', $t->fetch('admin/featured_profile.tpl'));

	$t->display('admin/index.tpl');

	exit;

}

if (isset($_POST['startYear']) && isset($_POST['startMonth']) && isset($_POST['startDay']) ) {
	$data['start_date'] = $start_date = strtotime($_POST['startYear'].'-'.$_POST['startMonth'].'-'.$_POST['startDay']);
}
if (isset($_POST['endYear']) && isset($_POST['endMonth']) && isset($_POST['endDay']) ) {
	$data['end_date'] = $end_date = strtotime($_POST['endYear'].'-'.$_POST['endMonth'].'-'.$_POST['endDay']);
}

if ($req_action == 'add' && isset($_REQUEST['step']) && $_REQUEST['step'] == 1 ) {

	$start_date = date('Y-m-d',time());

	$end_date = date('Y-m-d',strtotime("+30 day", time()));

	$data['start_date'] = $start_date;

	$data['end_date']  = $end_date;

	$data['step'] = '2';

	$data['username'] = isset($_POST['username'])?$_POST['username']:'';

	if ($data['username'] != '') {

		$row = $osDB->getRow( 'select firstname, lastname from ! where username = ?', array( USER_TABLE, $data['username'] ) );

		if ($row) {

			$data['fullname'] = $row['firstname'].' '.$row['lastname'];

		} else {

			$data['fullname'] = get_lang('invalid_username');

		}
		unset($row);
	}

	$t->assign('data', $data);

	unset($data);

	$t->assign('rendered_page', $t->fetch('admin/featured_profile.tpl'));

	$t->display('admin/index.tpl');

	exit();

} elseif ($req_action == 'add') {
	/* Add routine */

	if ( isset($_POST['username']) && $_POST['username'] != '' ) {

		foreach ($_POST as $key => $val) {

			$data[$key] = $val;

		}

		/* Get the user id for the username */

		$usr = $osDB->getRow( 'select *, floor((to_days(curdate())-to_days(birth_date))/365.25)  as age from ! where username = ?', array( USER_TABLE, $_POST['username'] ) );

		$userid = $usr['id'];

		$data['username'] = $usr['username'];

		$data['fullname'] = $usr['firstname'].' '.$usr['lastname'];

		$email = $usr['email'];

		if ($end_date < $start_date) {

			$t->assign('error_msg', ERR_STARTDATE_BEFORE_ENDDATE);

			$t->assign('data', $data);

			unset($data, $usr);

			$t->assign('rendered_page', $t->fetch('admin/featured_profile.tpl'));

			$t->display('admin/index.tpl');

			exit;

		}

		/*
			If this username is already in featured list, it should be modified only
		*/

		$uid = $osDB->getOne( 'select id from ! where userid = ?', array( FEATURED_PROFILES_TABLE, $userid ) );

		if ($uid > 0 ) {

			$t->assign('error_msg', '111' );

			$t->assign('data', $data);

			unset($data, $usr);

			$t->assign('rendered_page', $t->fetch('admin/featured_profile.tpl'));

			$t->display('admin/index.tpl');

			exit;

		}

		$osDB->query('insert into ! (userid, start_date, end_date, must_show, req_exposures) values ( ?, ?, ?, ?, ?  )', array( FEATURED_PROFILES_TABLE, $userid, $start_date, $end_date, $_POST['must_show'], $_POST['req_exposures'] ) );

		if ($config['letter_featuredprofile'] == 'Y') {
			/* Now intimate the user about this  */

			$message = get_lang('featured_profile_added', MAIL_FORMAT);

			$Subject = str_replace('#SITENAME#', $config['site_name'], get_lang('letter_featuredprofile_sub') );

			$From = $config['admin_email'];

			$To = $email;

			$message = str_replace('#FirstName#', $usr['firstname'],$message);

			$message = str_replace('#FromDate#', strftime(DATE_FORMAT,$start_date), $message);

			$message = str_replace('#UptoDate#', strftime(DATE_FORMAT,$end_date), $message);

			$t->assign('item', $usr);

			if (MAIL_FORMAT == 'html') {

				$message = str_replace('#smallProfile#',  $t->fetch('profile_for_html_mail.tpl'), $message);

			}

			$success = mailSender($From, $To, $email, $Subject, $message);
			unset($message, $Subject, $From, $To, $email);
		}

		if ($_POST['bckurl'] != '') {

			header ('location: '.$_POST['bckurl']);

		} else {

			header ('location: featured_profiles.php');

		}
		exit;

	} else {

		$t->assign('data', $data);

		unset($data);

		$t->assign('rendered_page', $t->fetch('admin/featured_profile.tpl'));

		$t->display('admin/index.tpl');

		exit;

	}
}

if ($req_action == 'modify' ) {

/*
	Modify routine. Get the record..

*/

	if (isset($_POST['userid']) && $_POST['userid'] > 0) {

	/*
		Update the record. Only the start and end date and req_exposures to be updated.

	*/
		foreach ($_POST as $key => $val) {

			$data[$key] = $val;

		}

		if ($end_date < $start_date) {

			$t->assign('error_msg', ERR_STARTDATE_BEFORE_ENDDATE );

			$t->assign('data', $data);

			unset($data);

			$t->assign('rendered_page', $t->fetch('admin/featured_profile.tpl'));

			$t->display('admin/index.tpl');

			exit;

		}

		$osDB->query('update ! set start_date = ?, end_date = ?, req_exposures = ?, must_show = ?  where id = ?', array( FEATURED_PROFILES_TABLE, $start_date, $end_date, $_POST['req_exposures'], $_POST['must_show'], $_POST['id'] ));

		header ('location: featured_profiles.php');

		exit;

	} else {

		$row = $osDB->getRow('select id, userid, start_date, end_date, must_show, req_exposures from ! where id = ?', array( FEATURED_PROFILES_TABLE, $_GET['id'] ) );

		$usr = $osDB->getRow('select username, firstname, lastname from ! where id = ?', array( USER_TABLE, $row['userid'] ) );

		$data['username'] 		= $usr['username'];

		$data['fullname'] 		= $usr['firstname'].' '.$usr['lastname'];

		$data['id'] 			= $row['id'];

		$data['userid'] 		= $row['userid'];

		$data['start_date'] 	= $row['start_date'];

		$data['end_date'] 		= $row['end_date'];

		$data['must_show'] 		= $row['must_show'];

		$data['req_exposures'] 	= $row['req_exposures'];

		$t->assign('data', $data);

		unset($data, $row, $usr);

		$t->assign('rendered_page',  $t->fetch('admin/featured_profile.tpl'));

		$t->display('admin/index.tpl');
	}
}
?>