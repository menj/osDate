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

$userscnt = $config['iplocation_profcnt'];

if (isset($_SESSION['iplocation']['country_code']) && $_SESSION['iplocation']['country_code'] != '') {
	if ( $userscnt > 0 ) {
		$xid = (isset($_SESSION['UserId']) && $_SESSION['UserId'] > 0)?$_SESSION['UserId']:'0';


		$iplgender=(isset($_POST['iplgender']) && $_POST['iplgender']!='' )?$_POST['iplgender']:'';
		$bannedlist = '';

		if ($xid > 0 ){
			if (!isset($iplgender) || $iplgender=='') {
				if (!isset($_SESSION['iplocation_profiles_npgender']) ) {
					$iplgender= $osDB->getOne('select lookgender from ! where id=?', array( USER_TABLE, $xid ));
				} else {
					$iplgender = $_SESSION['iplocation_profiles_npgender'];
				}
			}
			$_SESSION['iplocation_profiles_npgender'] = $iplgender;
			/* Make a banned users list */
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

		if ($iplgender=='' || $iplgender==' ') $iplgender='A';

		$zipcodes_in = "";

		if ($_SESSION['iplocation']['zipscnt'] > 0 && $config['iplocation_radius'] > 0 ) {
			/* Zips data is ailable. process like selecting the radius search */
		   $lat = $_SESSION['iplocation']['latitude'];
		   $lng = $_SESSION['iplocation']['longitude'];

		   if ($lng!='' && $lat!='') {
			   $radius = $config['iplocation_radius'];
			   if (substr_count($radius,'K') > 0) {
				   $radiustype = 'kms';
			   } else {
					$radiustype='miles';
			   }
	   			$radius = str_replace(array('K','M'),'',$radius);

			   if ($radiustype == 'kms') {
				/* Kilometers calculation */
				   $zipcodes_in = " ( sqrt(power(69.1*(zip_latitude - $lat),2)+power(69.1*(zip_longitude-$lng)*cos(zip_latitude/57.3),2)) < " . $radius ." ) ";
			   } else {
				/* Miles  */
				   $zipcodes_in = " (  (3958* 3.1415926 * sqrt((zip_latitude - $lat) * (zip_latitude- $lat) + cos(zip_latitude / 57.29578) * cos($lat/57.29578)*(zip_longitude - $lng) * (zip_longitude - $lng))/180) < " . $radius ." ) ";
			   }

			}
		}
		$incity = '';
		if (isset($_SESSION['iplocation']['city_code'] ) && $_SESSION['iplocation']['city_code'] != '') {
			$incity = " and city = '".$_SESSION['iplocation']['city_code']."' ";
		}
		$instate = '';
		if ($_SESSION['iplocation']['state_code'] != '') {
			$instate = " and state_province = '".$_SESSION['iplocation']['state_code']."' ";
		}
		$incountry = '';
		if ($_SESSION['iplocation']['country_code'] != '') {
			$incountry = " and country = '".$_SESSION['iplocation']['country_code']."' ";
		}
		$gendersel = '';
		if ($iplgender != 'A') {
			$gendersel = " and gender = '".$iplgender."' ";
		}

		$uid = (isset($_SESSION['UserId']) && $_SESSION['UserId'] > 0)?$_SESSION['UserId']:'0';

		$sql = "SELECT *, floor((to_days(curdate())-to_days(birth_date))/365.25)  as age  FROM ! WHERE id <> ? and status in (?, ?) ! ! ! ! ! ORDER BY lastvisit DESC LIMIT 0, !";

		$iplusers = $osDB->getAll($sql, array(USER_TABLE , $uid, get_lang('status_enum','active'), 'active', $gendersel, $bannedlist, $zipcodes_in, '', '', $userscnt) );

		if (!isset($iplusers) || $iplusers === false || count($iplusers) <= 0){
		/* Radius search didn't return users. Now search in the location */
			$iplusers = $osDB->getAll($sql, array(USER_TABLE , $uid, get_lang('status_enum','active'), 'active', $gendersel, $bannedlist, $incountry, $instate, $incity, $userscnt) );
			if (!isset($iplusers) || $iplusers === false || count($iplusers) <= 0){
				/* Within city level didn't return users. Expand to state level */
				$incity='';
				$iplusers = $osDB->getAll($sql, array(USER_TABLE ,$uid, get_lang('status_enum','active'), 'active', $gendersel, $bannedlist, $incountry, $instate, $incity, $userscnt) );
				if (!isset($iplusers) || $iplusers === false || count($iplusers) <= 0){
				/* State level search also didn't return users. Expand to country level */
					$instate = '';
					$iplusers = $osDB->getAll($sql, array(USER_TABLE ,$uid, get_lang('status_enum','active'), 'active', $gendersel, $bannedlist, $incountry, $instate, $incity, $userscnt) );
					if (!isset($iplusers) || $iplusers === false || count($iplusers) <= 0) {
					/* Hmm.. Country level also failed. No users in the country..  OK. Let us take any .. */
						$incountry='';
						$iplusers = $osDB->getAll($sql, array(USER_TABLE ,$uid, get_lang('status_enum','active'), 'active', $gendersel, $bannedlist, $incountry, $instate, $incity, $userscnt) );
					}
				}
			}
		}

		$list = array();

		if (!empty($iplusers) ) {
			foreach ($iplusers as $row) {

				/* Get countryname and statename */
				$row['statename'] = getStateName( $row['country'], $row['state_province']  );
				$row['countryname'] = getCountryName($row['country'] ) ;
				$list[] = $row;
			}
		}
		$t->assign( 'iplusers', $list );

		$genders = get_lang_values('search_genders');
		$genders_list="&nbsp;&nbsp;<select name='iplgender' onchange='javascript:iplocationProfilesDisplay(this.value);'><option value='A' selected='selected' >".get_lang('signup_gender_look','A')."</option>";
		foreach($genders as $k=>$v) {
			$genders_list.="<option value='$k' ";
			if ($k==$iplgender) {$genders_list.=' selected="selected" ';}
			$genders_list.=">$v</option>";
		}
		$genders_list.="</select>";
		$t->assign('iplhdr02',$genders_list);
		unset($iplUsers, $list, $row);
		if (isset($_REQUEST['send']) ) {
			$disp=$t->fetch('iplocation_profiles_display.tpl');
			echo("|||iplocation_profiles_display|:|".$disp);
		}
	}
} else {
	return array();
}
?>