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

$show=isset($_GET['show'])?$_GET['show']:0;

$userid = $_SESSION['UserId'];

$ref_userid = isset($_GET['ref_id'])?$_GET['ref_id']:'';

$psize = getPageSize();

$t->assign ( 'psize',  $psize );

$cpage = isset($_GET['page'])?$_GET['page']:1;

$start = ( $cpage - 1 ) * $psize;


if (isset($_POST['groupaction']) && $_POST['groupaction'] == get_lang('delete_selected') ) {

	$checked = $_POST['txtcheck'];

	$act = $_POST['act'];

	if (count($checked) > 0) {
		foreach ($checked as $val) {

			$osDB->query('DELETE from ! where id = ?', array( BUDDY_BAN_TABLE, $val ) );
		}

		$t->assign('error_message', get_lang('errormsgs',REMOVEDFROMLIST) );
	}
	$show = 1;
}

if (isset($_GET['remove']) && $_GET['remove'] == '1') {
	/* Remove from the list */

	$osDB->query('DELETE from ! where id = ? ', array( BUDDY_BAN_TABLE, $_GET['id'] ) );

	$t->assign('error_message', get_lang('errormsgs',REMOVEDFROMLIST) );

	$show = 1;
}

if ($show != "1" ) {

	/* first get both the username and ref_username i.e.  login names */

	$user = $osDB->getAll('SELECT *, floor((to_days(curdate())-to_days(birth_date))/365.25)  as age	FROM ! WHERE id in ( ?, ?) AND status <> ? AND status <> ?', array( USER_TABLE, $_SESSION['UserId'], $_GET['ref_id'], get_lang('status_enum','suspended'), 'suspend' ) );

	foreach ($user as $key => $usr) {

		if ($usr['id'] != $_GET['ref_id'] ) {

			$item = $usr;

			$username = $usr['username'];

			$userid = $usr['id'];

		} else {

			$ref_username = $usr['username'];

			$ref_userid = $usr['id'];

			$ref_userfirstname = $usr['firstname'];

			$ref_userfullname = $usr['firstname']. ' '.$usr['lastname'];

			$ref_useremail = $usr['email'];
		}
	}

	$errid = '';

	if ($_GET['act'] == 'buddy') {
		$list='F';
		$errid = ADDEDTOBUDDYLIST;
		$listname = get_lang('buddylisthdr');
		$choice_value='email_buddy_list';
	} elseif ( $_GET['act'] == 'hot' ) {
		$list='H';
		$errid = ADDEDTOHOTLIST;
		$listname = get_lang('hotlisthdr');
		$choice_value='email_hot_list';
	} else {
		$list='B';
		$errid = ADDEDTOBANLIST;
		$listname = get_lang('banlisthdr');
		$choice_value='email_ban_list';
	}

	$sql = 'select id from ! where userid = ? and ref_userid = ? and act = ?';

	/* Check if this user is in banned list of the other user */
	if ($list == 'F' or $list == 'H') {
		$r1 = $osDB->getOne($sql, array(BUDDY_BAN_TABLE,$ref_userid, $userid, 'B') );

		if (isset($r1) and $r1 != '') {
			/* In the ban list. Just return back giving error. */
			header("location: ".$_GET['rtnurl']."?id=".$_GET['ref_id']."&errid=105");
			exit;
		}
	}

	/* Check if the ref_userid is already in the list or not.. */
	$r=$osDB->getOne($sql, array( BUDDY_BAN_TABLE, $userid, $ref_userid, $list ) );
	if ($r > 0) {
	/* Already in the list, just ignore */
	} else {

		$osDB->query('insert into ! ( userid, act, ref_userid, act_date ) values ( ?, ?, ?, ? )', array( BUDDY_BAN_TABLE, $userid, $list, $ref_userid, time() ) );

		$recipient_choice = $osDB->getOne('select choice_value from ! where userid=? and choice_name=?', array(USER_CHOICES_TABLE, $ref_userid, $choice_value) );

		if ($recipient_choice == '1' or $recipient_choice == '' or !isset($recipient_choice) ) {

			if (( $list == 'F' and $config['letter_buddylist'] == 'Y') or ( $list == 'B' and $config['letter_banlist'] == 'Y') or ( $list == 'H' and $config['letter_hotlist'] == 'Y') ) {
			/* Send message to the user who is being added */

				$message = get_lang('added_list',MAIL_FORMAT);

				$Subject = str_replace('#SenderName#',$username,str_replace('#ListName#',$listname,get_lang('added_list_sub')));

				$From = $config['admin_email'];

				$To = $ref_useremail;

				$message = str_replace('#FirstName#', $ref_userfirstname ,$message);

				$message = str_replace('#SenderName#', $username, $message);

				$message = str_replace('#ListName#', $listname, $message);

				if (MAIL_FORMAT == 'html') {

					$t->assign('item', $item);

					$message = str_replace('#smallProfile#',  $t->fetch('profile_for_html_mail.tpl'), $message);

				}

				mailSender($From, $To, $ref_useremail, $Subject, $message);
				unset($message, $Subject);
			}
		}
		/* Now delete if this username is in the opposite list.
			i.e. if we are adding buddy, then we should remove from
			ban list, if available. Otherwise, vice versa  */

		if ($list == 'F' or $list == 'B') {

			if ($list == 'F') { $list = 'B'; }
			elseif ($list == 'B') { $list = 'F'; }

			$xr=$osDB->getOne('select id from ! where userid = ? and ref_userid = ? and act = ?', array( BUDDY_BAN_TABLE, $userid, $ref_userid, $list ) );

			if ($xr > 0) {
				/* Remove from the list */

				$osDB->query('delete from ! where id = ?', array( BUDDY_BAN_TABLE, $xr ) );
			}
		}

	}

	header("location: ".$_GET['rtnurl']."?id=".$_GET['ref_id']."&errid=".$errid);
	exit;

} else {
	/* Show the list  */

	if (!isset($_GET['act'])) $_GET['act']='B';

	if ( $_GET['act'] == 'F') {
		$listname = get_lang('buddylisthdr');
	} elseif ($_GET['act'] == 'H' ) {
		$listname = get_lang('hotlisthdr');
	} else {
		$listname = get_lang('banlisthdr');
	}

	$list = $osDB->getAll('select SQL_CALC_FOUND_ROWS lis.ref_userid, lis.act_date, usr.username as ref_username, lis.id as lisid from ! as lis, ! as usr where lis.userid = ? and lis.act = ? and lis.ref_userid = usr.id order by usr.username limit !,!', array( BUDDY_BAN_TABLE, USER_TABLE, $_SESSION['UserId'], $_REQUEST['act'], $start, $psize) );

	$totalcnt = $osDB->getOne('select FOUND_ROWS()');
	$pages = ceil($totalcnt / $psize);

	$t->assign("listcount", $totalcnt);

	$t->assign('list', $list);
	
	$t->assign('start', $start);

	if( $pages > 1 ) {

		if ( $cpage > 1 ) {

			$prev = $cpage - 1;

			$t->assign( 'prev', $prev );

		}
		$t->assign ( 'cpage', $cpage );

		$t->assign ( 'pages', $pages );

		if ( $cpage < $pages ) {

			$next = $cpage + 1;

			$t->assign ( 'next', $next );
		}
	}

	unset($list);
	
	$t->assign("listname", $listname);

	$t->assign('act', $_REQUEST['act'] );

	$t->assign('lang', $lang);

	$t->assign('rendered_page', $t->fetch('buddybanlist.tpl') );

	$t->display('index.tpl');

}
?>