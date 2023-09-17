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
	include_once( '../init.php' );
}

include ( 'sessioninc.php' );


if (isset($_REQUEST['act']) && $_REQUEST['act'] != '' ) {

	$error = '';

	$act = $_REQUEST['act'];

	if ($act == 'added' || $act == 'modified') {

		$name = strip_tags(trim( $_POST[ 'txtname' ] ) );

		$password = strip_tags(trim( $_POST[ 'txtpassword' ] ) );

		$email = strip_tags(trim( $_POST[ 'txtemail' ] ) );

		$conpassword = strip_tags(trim( $_POST[ 'txtconpassword' ] ) );

		if( $name=='' ||  $email == '' || ($act == 'added' && ( $conpassword == '' || $password == '' )) || ($password != '' && $conpassword == '')){

			$error= get_lang('affiliates_error',0);

		} elseif( $password != '' && $conpassword != $password ){

			$error = get_lang('affiliates_error',1);
		}
		if ($error != '') {

			$t->assign('error',$error);

			$t->assign('name',$name);

			$t->assign('email',$email);

			$t->assign('password',$password);

			$t->assign('affid',$affid);

			$t->assign('lang',$lang);

			$t->assign("act", $act);

			$t->assign('rendered_page', $t->fetch('admin/affiliate.tpl') );

			$t->display( 'admin/index.tpl' );

			exit;
		}

	}

	switch($act) {

		case 'added':

			$rowc = $osDB->getOne( 'SELECT count(*)  from ! where email= ? ', array( AFFILIATE_TABLE, $email ) );

			if ($rowc > 0) {

				$error = get_lang('affiliates_error','25');

				$act = 'added';

			} else {

				$osDB->query ( "INSERT INTO ! (  name, email, password, status, regdate ) VALUES ( ?, ?, ?, ?, ? )", array( AFFILIATE_TABLE, $name, $email, md5($password), 'approval', time() ) );

				$affid = $osDB->getOne('select id from ! where name = ? and email = ?',array( AFFILIATE_TABLE, $name, $email)) ;

				$message = get_lang('aff_added', MAIL_FORMAT);

				$Subject = get_lang('aff_added_sub');

				$From= $config['admin_email'];

				$message = str_replace("#Name#", $name, $message);

				$message = str_replace("#Affid#", $affid, $message);

				$message = str_replace("#Password#", $password, $message);

				mailSender($From, $email, $email, $Subject, $message);

				unset($message, $Subject, $email, $From);

				$error = get_lang('affiliate_registration_success');

				$act = '';

			}

			break;
		case 'add':

			$act='added';

			break;

		case 'modify':

			$affid = $_REQUEST['affid'];

			$affrec = $osDB->getRow('select * from ! where id = ?', array(AFFILIATE_TABLE, $affid));

			$name = $affrec['name'];

			$email = $affrec['email'];

			$password = '';

			$act = 'modified';
			unset($affrec);

			break;

		case 'modified':

			$affid = $_REQUEST['affid'];

			$affrec = $osDB->getRow('select * from ! where id = ?', array(AFFILIATE_TABLE, $affid));

			$sql = 'update ! set name = ?, email = ? ';

			if ($password != '') {
				$sql .= ", password = md5('".$password."')";
			}

			$sql .= 'where id = ?';

			$osDB->query($sql,array(AFFILIATE_TABLE, $name, $email, $affid) );

			$error = get_lang('aff_modified');
			unset($affrec);
			break;
	}

} else { $act = 'added'; }


$t->assign('error',$error);

$t->assign('name',$name);

$t->assign('email',$email);

$t->assign('password',$password);

$t->assign('affid',$affid);

$t->assign('lang',$lang);

$t->assign("act", $act);

$t->assign('rendered_page', $t->fetch('admin/affiliate.tpl') );

$t->display( 'admin/index.tpl' );

exit;
?>

