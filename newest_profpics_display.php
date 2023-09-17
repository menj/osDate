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

/* THis program will populate the newest loaded profile pictures display. */
if ( !defined( 'SMARTY_DIR' ) ) {

	include_once(dirname(__FILE__).'/minimum_init.php');
}
$xid = (isset($_SESSION['UserId']) && $_SESSION['UserId'] > 0)?$_SESSION['UserId']:'0';


$profpicgender=(isset($_POST['profpicgender']) && $_POST['profpicgender']!='' )?$_POST['profpicgender']:'';

if ($xid > 0 ){
	if (!isset($profpicgender) || $profpicgender=='') {
		if (!isset($_SESSION['profpic_gender']) ) {
			$profpicgender= $osDB->getOne('select lookgender from ! where id=?', array( USER_TABLE, $xid ));
		} else {
			$profpicgender = $_SESSION['profpic_gender'];
		}
	}
	$_SESSION['profpic_gender'] = $profpicgender;
}

if ($profpicgender=='' || $profpicgender==' ') $profpicgender='A';

/* Make a banned users list */
$bannedlist = '';
if (isset($_SESSION['UserId']) && $_SESSION['UserId'] > 0) {
	$bannedusers = $osDB->getAll('select bdy.ref_userid from ! as bdy where bdy.act=? and bdy.userid = ? union select bdy1.userid as ref_userid from ! as bdy1 where bdy1.act=? and bdy1.ref_userid = ?', array(BUDDY_BAN_TABLE,  'B', $_SESSION['UserId'], BUDDY_BAN_TABLE,  'B', $_SESSION['UserId'] ) );
	if (count($bannedusers) > 0) {
		$bannedlist=' and user.id not in (';
		$bdylst = '';
		foreach ($bannedusers as $busr) {
			if ($bdylst != '') $bdylst .= ',';
			$bdylst .= "'".$busr['ref_userid']."'";
		}
		$bannedlist .=$bdylst.') ';
	}
	unset($bannedusers);
}


if ($profpicgender == 'A') {
	$profpicUsers = $osDB->getAll( "SELECT distinct user.username, user.id, user.gender,  floor((to_days(curdate())-to_days(user.birth_date))/365.25)  as age, user.country, user.state_province, pic.picno  FROM ! as pic, ! as user WHERE user.id = pic.userid and user.status in (?, ?)  and (pic.album_id = 0 or pic.album_id = null)and pic.active = ? and user.id <> ? ! ORDER BY pic.ins_time desc, user.username asc limit !", array( USER_SNAP_TABLE, USER_TABLE , get_lang('status_enum','active'), 'active', 'Y', $xid, $bannedlist, $config['newest_profpics_dispcnt'] ) );
} else {
	$profpicUsers = $osDB->getAll( "SELECT distinct user.username, user.id, user.gender,  floor((to_days(curdate())-to_days(user.birth_date))/365.25)  as age, user.country, user.state_province, pic.picno  FROM ! as pic, ! as user WHERE user.id = pic.userid and user.status in (?, ?) and user.gender = ? and (pic.album_id = 0 or pic.album_id = null) and pic.active = ? and user.id <> ? ! ORDER BY pic.ins_time desc, user.username asc limit !", array( USER_SNAP_TABLE, USER_TABLE , get_lang('status_enum','active'), 'active',  $profpicgender, 'Y', $xid, $bannedlist,  $config['newest_profpics_dispcnt'] ) );
}

$list = array();

if (is_array($profpicUsers) && count($profpicUsers) > 0) {
	foreach ($profpicUsers as $row) {

		/* Get countryname and statename */
		if (isset($row['country']) ) {
			$row['countryname'] = getCountryName($row['country'] ) ;
			if (isset($row['state_province'])) {
				$row['statename'] = getStateName( $row['country'], $row['state_province']  );
			}
		}
		$list[] = $row;
	}

	$t->assign( 'profpicsusers', $list );

	$genders = get_lang_values('search_genders');
	$genders_list="&nbsp;&nbsp;<select name='profpicgender' onchange='javascript:profpicsDisplay(this.value);'><option value='A' selected='selected' >".get_lang('signup_gender_look','A')."</option>";
	foreach($genders as $k=>$v) {
		$genders_list.="<option value='$k' ";
		if ($k==$profpicgender) {$genders_list.=' selected="selected" ';}
		$genders_list.=">$v</option>";
	}
	$genders_list.="</select>";
	$t->assign('profpicshdr02',$genders_list);
	unset($profpicUsers, $list, $row);
	if (isset($_REQUEST['send']) ) {
		$disp=$t->fetch('newest_profpics_display.tpl');
		echo("|||newest_profpics|:|".$disp);
	}
}
?>