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

include( 'sessioninc.php');

$psize = getPageSize();

$t->assign ( 'psize',  $psize );

$user = $osDB->getRow( 'SELECT * FROM ! WHERE id = ?',array( USER_TABLE,  $_SESSION['UserId']) );
if (!isset($user['country']) || (isset($user['country']) && ($user['country'] == '-1' || $user['country'] == ''))) $user['country'] = 'AA';
if (!isset($user['state_province']) || (isset($user['state_province']) && ($user['state_province'] == '-1' || $user['state_province'] == ''))) $user['state_province'] = 'AA';
if (!isset($user['county']) || (isset($user['county']) && ($user['county'] == '-1' || $user['county'] == ''))) $user['county'] = 'AA';
if (!isset($user['city']) || (isset($user['city']) && ($user['city'] == '-1' || $user['city'] == ''))) $user['city'] = 'AA';
if (!isset($user['zip']) || (isset($user['zip']) && ($user['zip'] == '-1' || $user['zip'] == ''))) $user['zip'] = 'AA';
if (!isset($user['lookcountry']) || (isset($user['lookcountry']) && ($user['lookcountry'] == '-1' || $user['lookcountry'] == ''))) $user['lookcountry'] = 'AA';
if (!isset($user['lookstate_province']) || (isset($user['lookstate_province']) && ($user['lookstate_province'] == '-1' || $user['lookstate_province'] == ''))) $user['lookstate_province'] = 'AA';
if (!isset($user['lookcounty']) || (isset($user['lookcounty']) && ($user['lookcounty'] == '-1' || $user['lookcounty'] == ''))) $user['lookcounty'] = 'AA';
if (!isset($user['lookcity']) || (isset($user['lookcity']) && ($user['lookcity'] == '-1' || $user['lookcity'] == ''))) $user['lookcity'] = 'AA';
if (!isset($user['lookzip']) || (isset($user['lookzip']) && ($user['lookzip'] == '-1' || $user['lookzip'] == ''))) $user['lookzip'] = 'AA';

if (isset($user['country']) && $user['country'] != '') {
	$user['countryname'] = getCountryName( $user['country'] ) ;
}
if ($config['accept_state'] == '1' || $config['accept_state'] =='Y') {
	$user['statename'] = getStateName( $user['country'], $user['state_province'] );
}
if ($config['accept_city'] == '1' || $config['accept_city'] =='Y') {
	$user['cityname'] = getCityName($user['country'], ((isset($user['state_province']) && $user['state_province']!='')?$user['state_province']:'AA'), ((isset($user['city']) && $user['city']!= 'AA')?$user['city']:'AA'), ((isset($user['county']) && $user['county'] != '')?$user['county']:'AA'));
}
if (isset($user['lookcountry']) && $user['lookcountry'] != '' && ($config['accept_country'] == '1' || $config['accept_country'] == 'Y') && ($config['accept_lookcountry'] == '1' || $config['accept_lookcountry'] == 'Y') ) {
	$user['lookcountryname'] = getCountryName( $user['lookcountry'] ) ;
}

if (isset($user['lookstate_province']) && $user['lookstate_province'] != '' && ($config['accept_state'] == '1' || $config['accept_state'] == 'Y') && ($config['accept_lookstate'] == '1' || $config['accept_lookstate'] == 'Y') ) {
	$user['lookstatename'] = getStateName( $user['lookcountry'], $user['lookstate_province'] );
}

if (isset($user['lookcity']) && $user['lookcity'] != '' && ($config['accept_city'] == '1' || $config['accept_city'] == 'Y') && ($config['accept_lookcity'] == '1' || $config['accept_lookcity'] == 'Y') ) {
	$user['look_cityname'] = getCityName($user['lookcountry'], ((isset($user['lookstate_province']) && $user['lookstate_province']!='')?$user['lookstate_province']:'AA'), ((isset($user['lookcity']) && $user['lookcity']!= 'AA')?$user['lookcity']:'AA'), ((isset($user['lookcounty']) && $user['lookcounty'] != '')?$user['lookcounty']:'AA'));
}

$radius = isset($user['lookradius'])?$user['lookradius']:0;

$radiustype = isset($user['radiustype'])?$user['radiustype']:'miles';

$zipcodes_in = "";

/* Check for zip code proximity search */
if (isset($user['lookzip']) && $user['lookzip'] != '' && isset($radius) && $radius > 0 && $user['lookcountry'] != 'AA' ) {

   if ($user['lookcountry'] == 'GB') {
	   $ukzip = explode(' ',$user['lookzip']);
	   $srchzip = $ukzip[0];
   } else {
	   $srchzip = $user['lookzip'];
   }
	$ziprow = $osDB->getRow('select * from ! where code=?  and countrycode=? limit 1',array(ZIPCODES_TABLE, $srchzip, $user['lookcountry'] ) );

   if (isset($ziprow['latitude'])) {
	   $lat = $ziprow['latitude'];
   } else {
	   $lat='';
   }
   if (isset($ziprow['longitude'])) {
	   $lng = $ziprow['longitude'];
   } else {
		$lng='';
   }

   if ($lng!='' && $lat!='') {

	   if ($radiustype == 'kms') {
		/* Kilometers calculation */
		   $zipcodes_in = " and ( sqrt(power(69.1*(user.zip_latitude - $lat),2)+power(69.1*(user.zip_longitude-$lng)*cos(user.zip_latitude/57.3),2)) < " . $radius ." ) ";
	   } else {
		/* Miles  */
		   $zipcodes_in = " and (  (3958* 3.1415926 * sqrt((user.zip_latitude - $lat) * (user.zip_latitude- $lat) + cos(user.zip_latitude / 57.29578) * cos($lat/57.29578)*(user.zip_longitude - $lng) * (user.zip_longitude - $lng))/180) < " . $radius ." ) ";
	   }

	}
}

$bannedlist = '';
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

$sqlSelect = 'SELECT SQL_CALC_FOUND_ROWS user.*, floor((to_days(curdate())-to_days(birth_date))/365.25)  as age';

$sqlFrom = ' FROM ! user, ! mem ';

$sqlWhere = ' WHERE user.id <> '.$_SESSION['UserId'].'  AND mem.roleid=user.level and mem.includeinsearch=1 ';

$sqlWhere .= $bannedlist;

if ( ($config['bypass_search_lookgender'] == 'N' or $config['bypass_search_lookgender'] == '0' ) and ( $config['accept_lookgender'] == 'Y' or $config['accept_lookgender'] == '1') ) {

	$txtgender_search = "and (user.lookgender = 'A' or (user.lookgender = 'B' and '".$user['gender']."' in ('M','F') ) or user.lookgender = '".$user['gender']."') ";

	$sqlWhere .= $txtgender_search;
}

$txtlookgender_search = '';

if ($user['lookgender'] == 'B') {
	$txtlookgender_search = " AND user.gender in ('M','F') ";
} elseif ($user['lookgender'] != 'A') {
	$txtlookgender_search = " AND user.gender = '".$user['lookgender']."' ";
}

$sqlWhere .= ' AND user.status in (\'active\',\' '.get_lang('status_enum','active')."') " . $txtlookgender_search ;


if( $user['lookcountry'] && $user['lookcountry'] != 'AA'){

	$sqlWhere .= ' AND user.country = \'' . $user['lookcountry'] ."' ";

	if ($zipcodes_in == '') {
		if( $user['lookstate_province'] != 'AA' ) {

			$sqlWhere .= ' AND user.state_province = \'' . $user['lookstate_province'] ."' ";
		}

		if( $user['lookcounty'] != 'AA' ) {

			$sqlWhere .= ' AND user.county = \'' . $user['lookcounty'] ."' ";
		}

		if( $user['lookcity'] != 'AA' ) {

			$sqlWhere .= " AND user.city = '" . $user['lookcity'] ."' ";
		}
	}
	if( $user['lookzip'] && $user['lookzip'] != 'AA') {

		if ($zipcodes_in != '') {
			$sqlWhere .= $zipcodes_in;
		} else {
			$sqlWhere .= ' AND user.zip = \'' . $user['lookzip'] ."' ";
		}
	}
}

$yearend  = $osDB->getOne('select date_sub(curdate(),interval '.$user['lookagestart'] .' year)');

$yearstart  = $osDB->getOne('select date_sub(curdate(),interval '.($user['lookageend'] + 1) .' year)');

$sqlWhere .= " AND user.birth_date BETWEEN '"
	. $yearstart. "' AND '" . $yearend ."' ";

$sql = $sqlSelect . $sqlFrom . $sqlWhere;

$cpage = isset($_GET['page'])?$_GET['page']:'1';

$start = ( $cpage - 1 ) * $psize;

$t->assign ( 'start', $start );

$rs = $osDB->getAll( $sql." limit $start,$psize", array( USER_TABLE, MEMBERSHIP_TABLE ) );

$rcount = $osDB->getOne('select FOUND_ROWS()');

unset($sql, $sqlSelect, $sqlFrom, $sqlWhere);

if(isset($rs) && !empty($rs) && $rcount > 0 ) {

	$t->assign( 'totalrecs', $rcount );

	$pages = ceil( $rcount / $psize );

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

	$t->assign ( 'message_right', hasRight('message') );

	$t->assign ( 'view_pic_profile_right', hasRight('seepictureprofile') );

	$users = array();
	if (isset($rs) && !empty($rs) && count($rs) > 0) {
		foreach ($rs as $k => $row) {

			$row['countryname'] = getCountryName( $row['country'] ) ;

			$row['statename'] = getStateName( $row['country'], $row['state_province']);

			$row['statename'] = ($row['statename'] == 'AA') ? get_lang('any_where'): $row['statename'];

			$users[] = $row;
		}
	}

	$t->assign ( 'data', $users );

	unset($rs, $users);
} else {

	$t->assign ( 'error', "1" );
}

$t->assign( 'user', $user );

unset($user);

$t->assign ( 'backlink', 'index.php' );

$t->assign ( 'lang', $lang );

$t->assign('rendered_page', $t->fetch('mymatches.tpl') );

$t->display ( 'index.tpl' );

exit;


?>