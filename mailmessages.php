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

$rm_days = ($_SESSION['security']['message_keep_days'] > 0)? $_SESSION['security']['message_keep_days']+1 : $config['message_days_old']+1;

$allowed_count = ($_SESSION['security']['message_keep_cnt'] > 0)? $_SESSION['security']['message_keep_cnt'] : $config['message_count'];

$removetime = time() - ($rm_days * 24*60*60);

$warntime = $removetime + ($config['message_warn_days'] * (24*60*60));

$osDB->query('delete from ! where sendtime < ? and owner = ? and flag <> ? and flagread = ?', array(MAILBOX_TABLE, $removetime, $_SESSION['UserId'], '1','1') );

$selflag = (isset($_REQUEST['selflag'])&&$_REQUEST['selflag'] != '') ? $_REQUEST['selflag'] : 'A';

$folder =  (isset($_REQUEST['folder'])) ? $_REQUEST['folder'] : 'inbox';

if (isset($_REQUEST['msgaction']) && $_REQUEST['msgaction'] != '') {

	$msgaction = $_REQUEST['msgaction'];

	switch ($msgaction) {

		case get_lang('delete'):

			$osDB->query( 'update ! set flagdelete = ?, folder=? where id = ? and owner=?', array( MAILBOX_TABLE, 1, 'trashcan', $_REQUEST['id'], $_SESSION['UserId'] ) );

			$_REQUEST['view'] = 0;

			$grpmsg='msg_deleted';

			break;

		case get_lang('flag'):

			$osDB->query( 'update ! set flag = ? where id = ? and owner=?', array( MAILBOX_TABLE, 1, $_REQUEST['id'] , $_SESSION['UserId'])  );

			$grpmsg='msg_flagged';

			break;

		case get_lang('unflag'):

			$osDB->query( 'update ! set flag = ? where id = ? and owner = ?', array( MAILBOX_TABLE, 0, $_REQUEST['id'], $_SESSION['UserId'] ) );

			$grpmsg='msg_unflagged';

			break;
	}
}

if(isset( $_REQUEST['frm']) && $_REQUEST['frm'] == 'frmGroupMail' ) {

	$arr = $_REQUEST['txtcheck'];

	$grpmsg = '';

	if( is_array( $_REQUEST['txtcheck'] ) AND count( $_REQUEST['txtcheck'] ) > 0 ) {

		switch ($_REQUEST['groupaction']) {
			case get_lang('delete'):

				foreach( $arr as $id) {

					if ($folder == 'trashcan') {
						/* remove this message from system */
						$osDB->query('delete from ! where id = ? and owner=?', array( MAILBOX_TABLE, $id, $_SESSION['UserId'] ) );

					} else {
						/* Mark as deleted and move to trashcan folder */

						$osDB->query( 'update ! set flagdelete = ?, folder=? where id = ? and owner=?', array( MAILBOX_TABLE, 1, 'trashcan', $id, $_SESSION['UserId'] ) );
					}
				}

				$grpmsg='sel_msgs_deleted';
				unset($arr);
				break;

			case get_lang('undelete'):

				foreach( $arr as $id ) {

					$msg = $osDB->getRow('select owner, senderid, recipientid from ! where id = ? and owner=?', array(MAILBOX_TABLE, $id, $_SESSION['UserId']) );

					if ($msg['senderid'] == $msg['owner']) {

						$fldr = 'sent';

					} else {

						$fldr = 'inbox';

					}

					$osDB->query( 'update ! set flagdelete = ?, folder = ? where id = ? and owner=?', array( MAILBOX_TABLE, 0, $fldr, $id, $_SESSION['UserId'] ) );
				}

				unset($arr);
				$grpmsg='sel_msgs_undeleted';
				break;

			case get_lang('read'):

				foreach( $arr as $id ) {

					$osDB->query( 'update ! set flagread = ? where id = ? and owner=?', array( MAILBOX_TABLE, 1, $id, $_SESSION['UserId'] ) );
				}

				unset($arr);
				$grpmsg='sel_msgs_read';
				break;

			case get_lang('unread'):

				foreach( $arr as $id ) {

					$osDB->query( 'update ! set flagread = ? where id = ? and owner=?', array( MAILBOX_TABLE, 0, $id, $_SESSION['UserId'] ) );
				}

				unset($arr);
				$grpmsg='sel_msgs_unread';
				break;

			case get_lang('flag'):

				foreach( $arr as $id ) {

					$osDB->query( 'update ! set flag = ? where id = ? and owner=? ', array( MAILBOX_TABLE, 1, $id, $_SESSION['UserId'] ) );
				}

				unset($arr);
				$grpmsg='sel_msgs_flagged';
				break;

			case get_lang('unflag'):

				foreach( $arr as $id ) {

					$osDB->query( 'update ! set flag = ? where id = ? and owner=? ', array( MAILBOX_TABLE, 0, $id, $_SESSION['UserId'] ) );
				}

				unset($arr);
				$grpmsg='sel_msgs_unflagged';

		}
	}

}

$msgcounts = $osDB->getAll('select folder, count(id) as cnt from ! where owner = ? group by folder', array(MAILBOX_TABLE, $_SESSION['UserId']) );

$msg_counts = array();

$total_count = 0;
foreach ($msgcounts as $msg) {
	$total_count += $msg['cnt'];
	$msg_counts[$msg['folder']] = $msg['cnt'];
}
$t->assign('msg_counts', $msg_counts);
unset($msgcounts, $msg_counts);
$t->assign('total_count', $total_count);
$t->assign('allowed_count', $allowed_count);
$t->assign('allowed_days', $rm_days - 1);

$my_timezone = $osDB->getOne('select timezone from ! where id = ?', array( USER_TABLE, $_SESSION['UserId']) );

if (isset($_REQUEST['replied']) && $_REQUEST['replied'] == '1') {

	$grpmsg='replied';

}
if (isset($_REQUEST['view']) and $_REQUEST['view'] == 1 and $_REQUEST['id'] != '' ) {

	/* View one message */
	$t->assign('view', '1');

	/* Get the message */

	$data = $osDB->getRow('select * from ! where id = ? and owner=?', array( MAILBOX_TABLE, $_REQUEST['id'], $_SESSION['UserId'] ) );

	/* Identify the userid for from/to addressing
		and set the fldr accordingly
	*/

	if ($folder == 'inbox' or ( $data['recipientid'] == $data['owner'] and $data['folder'] == 'trashcan')) {
		$data['refuid'] = $usrid = $data['senderid'];
		$data['fldr'] = 'inbox';

	} elseif ( $folder == 'sent' or ( $data['senderid'] == $data['owner'] and $data['folder'] == 'trashcan')) {

		$data['refuid'] = $usrid = $data['recipientid'];
		$data['fldr'] = 'sent';

	}

	/* Get the user record for username and timezone */

	$usrrec = $osDB->getRow('select username, firstname, email, gender from ! where id = ?', array(USER_TABLE, $usrid));

	$t->assign('piccnt', $osDB->getOne('select count(*) from ! where userid = ? and (album_id is null or album_id = ?)', array(USER_SNAP_TABLE, $usrid,0) ) );

	/* Now update read flag */
	$data['converted_time'] = round($data['sendtime'] - ($config['server_timezone'] * 3600) + ($my_timezone * 3600) );

	$data['username'] = $usrrec['username'];

	$data['usergender'] = $usrrec['gender'];


	/* Now mark the message as READ */

	$osDB->query('update ! set flagread = ? where id = ? and owner=?', array(MAILBOX_TABLE, 1, $_REQUEST['id'], $_SESSION['UserId']) );

	/* Now update the sent box of the sender also for the read flag. */
	$osDB->query('update ! set flagread=? where owner=? and recipientid = ? and subject = ? and message = ? and folder = ?', array(MAILBOX_TABLE,1, $data['senderid'],$data['recipientid'], $data['subject'], $data['message'], 'sent') ) ;

	$recipient_choice = $osDB->getOne('select choice_value from ! where userid=? and choice_name=?', array(USER_CHOICES_TABLE, $usrid, 'email_message_read') );

	if (!isset($recipient_choice) or $recipient_choice == '1' or $recipient_choice == ''  ) {

		if ($data['notifysender'] == '1' && $data['flagread'] != '1') {
			/* Intimate the sender about message read status */

			$msg = get_lang('message_read', MAIL_FORMAT);

			$msg = str_replace('#FirstName#',$usrrec['firstname'],$msg);

			$msg = str_replace('#RecipientName#',$_SESSION['UserName'],$msg);

			$From = $config['admin_email'];

			$To = $usrrec['email'];

			$Subject = str_replace('#RecipientName#',$_SESSION['UserName'],get_lang('message_read_sub')) ;

			if (MAIL_FORMAT == 'html') {


				$t->assign('item', $osDB->getRow('SELECT *, floor((to_days(curdate())-to_days(birth_date))/365.25)  as age	FROM ! WHERE id = ?', array( USER_TABLE, $_SESSION['UserId'] ) ));

				$msg = str_replace('#smallProfile#',  $t->fetch('profile_for_html_mail.tpl'), $msg);

			}

			$success = mailSender($From, $To, $To, $Subject, $msg);
			unset($msg, $Subject, $From, $To);
		}
	}

} else {

	$t->assign('view','0');

	$sql = 'select msg.*, usr.username, usr.timezone, usr.gender, if(msg.senderid=msg.owner, msg.recipientid, msg.senderid) as refuid from ! as msg, ! as usr where msg.owner = ? and msg.folder = ? and usr.id = if(msg.senderid=msg.owner, msg.recipientid, msg.senderid) ';

	/* Flagged or unflagged or all messages */
	if ($selflag == 'F') {

		$sql .= ' and flag = 1 ';

	} elseif ($selflag == 'U') {

		$sql .= ' and flag <> 1 ';
	}

//	$sql .= ' order by '.findSortBy( 'username' );

	if (!isset($_REQUEST['type']) ) $_REQUEST['type'] = 'asc';
	if (!isset($_REQUEST['sort']) ) $_REQUEST['sort'] = 'sendtime';

	$sql .= ' order by sendtime desc' ;

	$msgs = $osDB->getAll( $sql, array( MAILBOX_TABLE, USER_TABLE, $_SESSION['UserId'], $folder ) );
	/* Now collect userid and other details */
	$data = array();
	if (count($msgs) > 0) {
		foreach ($msgs as $msg) {
			$msg['converted_time'] = round($msg['sendtime'] - ($config['server_timezone'] * 3600) + ($my_timezone * 3600) );

			/* calculate the message deletin time. Allow 1 day more for hours and seconds issues */

			if ($msg['sendtime'] < $warntime and $msg['sendtime'] >  $removetime) $msg['warnflag'] = '1';
			$msg['message'] = nl2br($msg['message']);

			$msg['usergender'] = $msg['gender'];

			$data[]=$msg;
		}
	}
	unset($msgs);
}

if (isset($grpmsg) && $grpmsg != '') {
	$t->assign('grpmsg',$grpmsg);
	$t->assign("error_message", get_lang($grpmsg));
}
if (isset($_GET['type'])) {
	$t->assign( 'sort_type', checkSortType( $_GET['type'] ) );
} else {
	$t->assign( 'sort_type', 'asc' );
}

$t->assign('selflag', $selflag);
$t->assign('folder', $folder);
$t->assign('foldername', get_lang($folder));
$t->assign( 'lang', $lang );
$t->assign( 'data', $data );
unset($data);
$t->assign('rendered_page', $t->fetch('mailmessages.tpl') );

$t->display ( 'index.tpl' );

?>