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

if ( isset($_SESSION['txtusername']) && $_SESSION['txtusername'] != '' && !isset($_POST['txtusername']) ) {

	$_POST['txtusername'] = $_SESSION['txtusername'];
	$_POST['txtpassword'] = base64_decode( $_SESSION['txtpassword'] );
	$_POST['rememberme']  = $_SESSION['rememberme'];
}

if ( !isset( $_POST['txtusername']) || $_POST['txtusername'] == '' ) {

	$err = USERNAME_BLANK;
	header( 'location: index.php?page=login&errid=' . $err );
    exit();
} elseif( !isset($_POST['txtpassword']) || $_POST['txtpassword'] == '' ){

	$err = PASSWORD_BLANK;
	header( 'location: index.php?page=login&errid=' . $err );
	exit();

} else {

	$get_params = (isset($_REQUEST['get_params'])?$_REQUEST['get_params']:'');

	if ($get_params != '') {

		$get_params = unserialize(stripslashes($get_params));
		$gp = '';
		foreach($get_params as $k => $v) {
			if ($gp != '') {$gp .= '&';}
			$gp .= $k .'='.$v;
		}
	}

	if (substr_count($_POST['txtusername'],'@') > 0) {
		/* Email id. Check the user record with this. */
		$row = $osDB->getRow('SELECT id, username, firstname, lastname, regdate, level, status, email,  lastvisit, levelend, active, gender  FROM ! where email = ? and password = ? and status not in (?, ?, ?, ?) limit 1', array( USER_TABLE, $_POST['txtusername'], md5( trim( $_POST['txtpassword'] ) ), get_lang('status_enum','rejected'), 'rejected', get_lang('status_enum','suspended'), 'suspended' ) );
	} else {
		/* username */
		$row = $osDB->getRow('SELECT id, username, firstname, lastname, regdate, level, status, email,  lastvisit, levelend, active, gender  FROM ! where username = ? and password = ? and status not in (?, ?, ?, ?)', array( USER_TABLE, $_POST['txtusername'], md5( trim( $_POST['txtpassword'] ) ), get_lang('status_enum','rejected'), 'rejected', get_lang('status_enum','suspended'), 'suspended' ) );
	}


	if( !empty($row) && ($row) && $row['id'] > 0 ) {
		if ( $row['status'] == get_lang('status_enum','cancel') or $row['status'] == 'cancel' ) {
			unset($row);
			$err = '161';
			header( 'location: index.php?page=login&errid=' . $err );
			exit();
		}

		$opt_lang=$_SESSION['opt_lang'];

		session_destroy();

		session_start();

		$_SESSION['opt_lang'] = $opt_lang;

		$_SESSION['UserId'] = $row['id'];

		$_SESSION['FullName'] = $row['firstname'] . ' ' . $row['lastname'];

		$_SESSION['UserName'] = $row['username'];

		$_SESSION['regdate'] = $row['regdate'];

		$_SESSION['gender'] = $row['gender'];

		$_SESSION['FirstName'] = $row['firstname'];

 		if ($row['active'] == '1' && $row['status'] != 'approval') {
			$cookie['username'] = $row['username'];
			$cookie['dir'] = base64_encode($_POST['txtpassword']);

			if (isset($_POST['rememberme'])  ) {
				setcookie($config['cookie_prefix']."osdate_info['username']", $cookie['username'], strtotime("+30day"), "/" );
				setcookie($config['cookie_prefix']."osdate_info['dir']", $cookie['dir'], strtotime("+30day"), "/" );
			} else {
				setcookie($config['cookie_prefix']."osdate_info['username']", $cookie['username'], strtotime("-1day"), "/" );
				setcookie($config['cookie_prefix']."osdate_info['dir']", $cookie['dir'], strtotime("-1day"), "/" );
			}


			$_SESSION['whatIneed'] = base64_encode($_POST['txtpassword']);

			if (date('Ymd',$row['levelend']) < date('Ymd')) {

				$_SESSION['RoleId'] = $row['level'] = $config['expired_user_level'];

				$_SESSION['expired'] = 1;

			} elseif( $row['status'] == get_lang('status_enum','approval') || $row['status'] == 'approval' ){

				$_SESSION['RoleId'] = $config['default_user_level'];

			} else {

				$_SESSION['RoleId'] = $row['level'];
			}

			$_SESSION['active'] = $row['active'];

			$_SESSION['lastvisit'] = $row['lastvisit'];

			$_SESSION['status'] = $row['status'];

			$_SESSION['email'] = $row['email'];


		/* Now add the settings of this user to session */
			$recs = $osDB->getAll('select * from ! where userid = ?',  array(USER_CHOICES_TABLE, $_SESSION['UserId']));
			$user_choices = array();
			if (count($recs) > 0) {

				$t->assign('act','modify');

				foreach ($recs as $rec) {

					$user_choices[$rec['choice_name']] = $rec['choice_value'];
				}
			}
			unset($recs);
			$_SESSION['mysettings'] = $user_choices;

		/* mysettings is set */

			$osDB->query( 'DELETE FROM ! WHERE userid = ?', array( ONLINE_USERS_TABLE, $_SESSION['UserId'] ) );

			$visittime=time();

			$osDB->query( 'insert into ! ( userid, lastactivitytime, is_online) values ( ?, ?,? )', array( ONLINE_USERS_TABLE, $_SESSION['UserId'], $visittime ,'1') );

			$lastLoginIP = ( !empty($_SERVER['REMOTE_ADDR']) ) ? $_SERVER['REMOTE_ADDR'] : ( ( !empty($_ENV['REMOTE_ADDR']) ) ? $HTTP_ENV_VARS['REMOTE_ADDR'] : getenv('REMOTE_ADDR') );

			$osDB->query( "UPDATE ! SET lastvisit=?, lastLoginIP=?  WHERE id=?" ,array( USER_TABLE, $visittime, $lastLoginIP, $_SESSION['UserId'] ) );

			hasRight('');

		}

		if ( $row['active'] != '1') {
			$_SESSION['security']['seepictureprofile'] = '1';

			$err = NOT_ACTIVE;
			unset($row);
			header( 'location: index.php?errid=' . $err );
			exit();

		}
		if ( $row['status'] == get_lang('status_enum','approval') or $row['status'] == 'approval' ) {

			unset($row);
			$err = NOT_YET_APPROVED;
			header( 'location: index.php?errid=' . $err );
			exit();

		}

		if (isset($_REQUEST['returnto']) && $_REQUEST['returnto'] != '') {
			unset($row);
			header('location: '.$_REQUEST['returnto'].'?'.$gp);
			exit();
		}

		unset($row);
		header('location: index.php');
		exit();

	} else {

		$err = INVALID_USERNAME;

		setcookie("osdate_info", '', strtotime("+30day"), "/" );
		unset($row);

		if (isset($_REQUEST['returnto']) && $_REQUEST['returnto'] != '') {
			header('location: index.php?page=login&errid=' . $err.'&returnto='.$_REQUEST['returnto'].'&get_params='.(serialize($gp)));
			exit();
		} else {
			header( 'location: index.php?page=login&errid=' . $err );
			exit();
		}
	}

}
?>