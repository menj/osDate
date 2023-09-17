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

/* THis program will populate the newest profile display portion. */
if ( !defined( 'SMARTY_DIR' ) ) {

	include_once(dirname(__FILE__).'/minimum_init.php');
}
$active_users = $config['show_recent_active_profiles'];

if ( $active_users > 0 ) {
	$xid = (isset($_SESSION['UserId']) && $_SESSION['UserId'] > 0)?$_SESSION['UserId']:'0';

	$apgender=( isset($_POST['apgender']) && $_POST['apgender']!='' )?$_POST['apgender']:'';


	if ($xid > 0 ){
		if (!isset($apgender) || $apgender == '') {
			if (!isset($_SESSION['active_profiles_gender']) ) {
				$apgender= $osDB->getOne('select lookgender from ! where id=?', array( USER_TABLE, $xid ));
			} else {
				$apgender = $_SESSION['active_profiles_gender'];
			}
		}
		$_SESSION['active_profiles_gender'] = $apgender;
	}

	if ($apgender=='' || $apgender==' ') $apgender='A';

	$bannedlist = '';
	if (isset($_SESSION['UserId']) && $_SESSION['UserId'] > 0) {
		$bannedusers = $osDB->getAll('select bdy.ref_userid from ! as bdy where bdy.act=? and bdy.userid = ? union select bdy1.userid as ref_userid from ! as bdy1 where bdy1.act=? and bdy1.ref_userid = ?', array(BUDDY_BAN_TABLE,  'B', $_SESSION['UserId'], BUDDY_BAN_TABLE,  'B', $_SESSION['UserId'] ) );
		if (count($bannedusers) > 0) {
			$bannedlist=' and id not in (';
			$bdylst = '';
			foreach ($bannedusers as $busr) {
				if ($bdylst != '') $bdylst .= ',';
				$bdylst .= "'".$busr['ref_userid']."'";
			}
			$bannedlist .=$bdylst.') ';
		}
		unset($bannedusers);
	}
	$uid = (isset($_SESSION['UserId']) && $_SESSION['UserId'] > 0)?$_SESSION['UserId']:'0';

	if ($apgender == 'A') {
		$activeUsers = $osDB->getAll( "SELECT *, floor((to_days(curdate())-to_days(birth_date))/365.25)  as age  FROM ! WHERE id <> ? and status in (?, ?)  ! ORDER BY lastvisit DESC LIMIT 0, !", array( USER_TABLE , $uid, get_lang('status_enum','active'), 'active', $bannedlist, $active_users) );
	} else {
		$activeUsers = $osDB->getAll( "SELECT *, floor((to_days(curdate())-to_days(birth_date))/365.25)  as age  FROM ! WHERE id <> ? and status in (?, ?)  and gender = ? ! ORDER BY lastvisit DESC LIMIT 0, !", array( USER_TABLE , $uid, get_lang('status_enum','active'), 'active', $apgender, $bannedlist, $active_users) );
	}

	$list = array();

	if (!empty($activeUsers) && count($activeUsers) > 0) {
		foreach ($activeUsers as $row) {

			/* Get countryname and statename */
			$row['statename'] = getStateName( $row['country'], $row['state_province']  );
			$row['countryname'] = getCountryName($row['country'] ) ;
			$list[] = $row;
		}
	}
	$t->assign( 'activeusers', $list );

	$genders = get_lang_values('search_genders');
	$genders_list="&nbsp;&nbsp;<select name='apgender' onchange='javascript:recentActiveProfilesDisplay(this.value);'><option selected='selected'  value='A' >".get_lang('signup_gender_look','A')."</option>";
	foreach($genders as $k=>$v) {
		$genders_list.="<option ";
		if ($k==$apgender) {$genders_list.=" selected='selected' ";}
		$genders_list.=" value='$k'>$v</option>";
	}
	$genders_list.="</select>";
	$t->assign('aphdr02',$genders_list);
	unset($activeUsers, $list, $row);
	if (isset($_REQUEST['send']) ) {
		$disp=$t->fetch('recent_active_profiles_display.tpl');
		echo("|||recent_active_profiles_display|:|".$disp);
	}
}
?>