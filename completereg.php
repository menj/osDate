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

if ( isset( $_GET['txtconfcode'] ) && $_GET['txtconfcode'] ) {
	$confcode = $_GET['txtconfcode'];
} else {
	$confcode = (isset($_GET['confcode'])?$_GET['confcode']:'');
}


$row = $osDB->getRow( 'SELECT id, username, firstname, lastname, level FROM ! WHERE  actkey = ?', array( USER_TABLE, $confcode ) );

if ( isset($row['id']) && $row['id'] > 0 ) {

	$activedays = $osDB->getOne('select activedays from ! where roleid = ?', array( MEMBERSHIP_TABLE, $row['level'] ) );

	$level = $row['level'];

	$levelend = time();

	if ($config['default_active_status'] == 'Y') {

		$levelend = strtotime("+$activedays day",time());
		$status = 'active';

	} else {

		$status = 'approval';

	}

/* Promo Start */

	/* First get the promotion code for this user */

	$promocode = $osDB->getOne('select promocode from ! where userid = ?', array( PROMO_USED_TABLE, $row['id'] ) );

	if ($promocode != '') {

		/* Now get promotions record */
		$promo_rec = $osDB->getRow('select * from ! where promocode = ?',array(PROMO_TABLE,$promocode) );

		/*
			adddays and upglvl are two promo types
			if adddays, then use the increasedays to add number of days to new level and/or 	existing
			level and calculate levelend.
			if upglvl, then change membership level and recalculate levelend.
		*/
		if ($row['level'] != $promo_rec['memberlevel'] && $promo_rec['memberlevel'] > 0 ) {
				/* Ok. Same level. Just add days. */

			$activedays = $osDB->getOne('select activedays from ! where roleid = ?', array( MEMBERSHIP_TABLE, $promo_rec['memberlevel'] ) );

			$levelend = strtotime("+$activedays day",time());

			// $status = get_lang('status_enum','active');
			$level = $promo_rec['memberlevel'];

		}

		if ($promo_rec['increasedays'] > 0) {

			$adddays = $promo_rec['increasedays'];

			$levelend = strtotime("+$adddays day",$levelend);
		}

	}

/* PROMO END */

	$osDB->query( 'UPDATE ! SET active=?, status = ? , levelend = ? , actkey=? , level=?, lastvisit=?  WHERE id = ?', array( USER_TABLE, '1', $status, $levelend, 'Confirmed', $level, time(), $row['id'] ) );

	$osDB->query( 'DELETE FROM ! WHERE userid = ?', array( ONLINE_USERS_TABLE, $row['id'] ) );

	$osDB->query( 'INSERT INTO ! ( userid, lastactivitytime , session_id ) VALUES ( ?, ?, ?)', array( ONLINE_USERS_TABLE, $row['id'], time(), session_id() ) );

	session_destroy();

	header('location: index.php?page=login&err='.REGN_COMPLETED);

} else {

	header( 'location: confirmreg.php?errid='.INVALID_ACTIVATION_CODE );

}

exit;
?>