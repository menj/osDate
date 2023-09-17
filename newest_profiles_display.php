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
$last_users = $config['no_last_new_users'];

$list_newmembers_since_days = $config['list_newmembers_since_days'];

if ($list_newmembers_since_days == '') $list_newmembers_since_days=0;

$list_newmembers_since = strtotime("-$list_newmembers_since_days day",time());

if ( $last_users > 0 ) {
	$xid = (isset($_SESSION['UserId']) && $_SESSION['UserId'] > 0)?$_SESSION['UserId']:'0';


	$npgender=(isset($_POST['npgender']) && $_POST['npgender']!='' )?$_POST['npgender']:'';

	if ($xid > 0 ){
		if (!isset($npgender) || $npgender=='') {
			if (!isset($_SESSION['newest_profiles_npgender']) ) {
				$npgender= $osDB->getOne('select lookgender from ! where id=?', array( USER_TABLE, $xid ));
			} else {
				$npgender = $_SESSION['newest_profiles_npgender'];
			}
		}
		$_SESSION['newest_profiles_npgender'] = $npgender;
	}

	if ($npgender=='' || $npgender==' ') $npgender='A';

	/* Make a banned users list */
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

	if ($npgender == 'A') {
		$newUsers = $osDB->getAll( "SELECT *, floor((to_days(curdate())-to_days(birth_date))/365.25)  as age  FROM ! WHERE id <> ? and status in (?, ?)  and regdate >= ? ! ORDER BY regdate DESC LIMIT 0, $last_users", array( USER_TABLE , $uid, get_lang('status_enum','active'), 'active', $list_newmembers_since, $bannedlist) );
	} else {
		$newUsers = $osDB->getAll( "SELECT *, floor((to_days(curdate())-to_days(birth_date))/365.25)  as age  FROM ! WHERE id <> ? and status in (?, ?)  and regdate >= ? and gender = ? ! ORDER BY regdate DESC LIMIT 0, $last_users", array( USER_TABLE , $uid, get_lang('status_enum','active'), 'active', $list_newmembers_since, $npgender, $bannedlist) );
	}

	$list = array();

	if (!empty($newUsers) && count($newUsers) > 0 ) {
		foreach ($newUsers as $row) {
			if (isset($row['country']) && $row['country'] != '') {
				/* Get countryname and statename */
				$row['statename'] = getStateName( $row['country'], $row['state_province']  );
				$row['countryname'] = getCountryName($row['country'] ) ;
				$list[] = $row;
			}
		}
	}
	$t->assign( 'npusers', $list );

	$genders = get_lang_values('search_genders');
	$genders_list="&nbsp;&nbsp;<select name='npgender' onchange='javascript:newestProfilesDisplay(this.value);'><option value='A' selected='selected' >".get_lang('signup_gender_look','A')."</option>";
	foreach($genders as $k=>$v) {
		$genders_list.="<option value='$k' ";
		if ($k==$npgender) {$genders_list.=' selected="selected" ';}
		$genders_list.=">$v</option>";
	}
	$genders_list.="</select>";
	$t->assign('nphdr02',$genders_list);
	unset($newUsers, $list, $row);
	if (isset($_REQUEST['send']) ) {
		$disp=$t->fetch('newest_profiles_display.tpl');
		echo("|||newest_profiles_display|:|".$disp);
	}
}

?>