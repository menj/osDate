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

include( 'sessioninc.php' );
//copied from mymatches
//why recode it when it's allready there?

$sqlSelect = 'SELECT *, floor((to_days(curdate())-to_days(birth_date))/365.25)  as age';

$user = $osDB->getRow( $sqlSelect.' FROM ! WHERE id = ?',array( USER_TABLE,  $_SESSION['UserId']) );

$sqlFrom = ' FROM ! user ';

$sqlWhere = ' WHERE id > 0  ';

$txtgender_search = " AND user.lookgender in  ( 'A', ";

if ($user['gender'] == 'M' or $user['gender'] == 'F') {
	$txtgender_search .= "'B',";
}

$txtgender_search .= "'".$user['gender']."' )";


$txtlookgender_search = '';

if ($user['lookgender'] == 'B') {
	$txtlookender_search = " AND user.gender in ('M','F') ";
} elseif ($user['lookgender'] != 'A') {
	$txtlookgender_search = " AND user.gender = '".$user['lookgender']."' ";
}

$sqlWhere .= ' AND status in (?,?)' . $txtlookgender_search . $txtgender_search;

if (!isset($user['country']) || $user['country'] == '' )$user['country'] = 'AA';
if (!isset($user['state_province']) || $user['state_province'] == '') $user['state_province'] = 'AA';
if (!isset($user['county']) || $user['county'] == '') $user['county'] = 'AA';
if (!isset($user['city']) || $user['city'] == '') $user['city'] = 'AA';
if (!isset($user['zip']) || $user['zip'] == '') $user['zip'] = 'AA';
if (!isset($user['lookcountry']) || $user['lookcountry'] == '') $user['lookcountry'] = 'AA';
if (!isset($user['lookstate_province']) || $user['lookstate_province'] == '') $user['lookstate_province'] = 'AA';
if (!isset($user['lookcounty']) || $user['lookcounty'] == '') $user['lookcounty'] = 'AA';
if (!isset($user['lookcity']) || $user['lookcity'] == '') $user['lookcity'] = 'AA';
if (!isset($user['lookzip']) || $user['lookzip'] == '') $user['lookzip'] = 'AA';

if( $user['lookcountry'] ){

	if( $user['lookcountry'] != 'AA' ) {

		$sqlWhere .= ' AND country = \'' . $user['lookcountry'] ."' ";
	}

	if( $user['lookstate_province'] != 'AA' ) {

		$sqlWhere .= ' AND state_province = \'' . $user['lookstate_province'] ."' ";
	}

	if( $user['lookcounty'] != 'AA' ) {
		$sqlWhere .= ' AND county = \'' . $user['lookcounty'] ."' ";
	}

	if( $user['lookcity'] != 'AA' ) {

		$sqlWhere .= ' AND city = \'' . $user['lookcity'] ."' ";
	}

	if( $user['lookzip'] != 'AA' ) {

		$sqlWhere .= ' AND zip = \'' . $user['lookzip'] ."' ";
	}

}

$sqlWhere .= ' AND floor(period_diff(extract(year_month from NOW()),extract(year_month from birth_date))/12) BETWEEN '
	. $user['lookagestart'] . ' AND ' . $user['lookageend'] ;

$active_lang = get_lang('status_enum','active');

$CountSelect = 'select count(*) as cnt ';

if ($user['country'] != 'AA') {
	$same_countrysql = ' FROM ! WHERE country = ? and id <> ? AND status in (?,?)' ;
	$t->assign ( 'same_country', $osDB->getOne( $CountSelect.$same_countrysql, array ( USER_TABLE, $user['country'], $user['id'],'active',$active_lang  ) ) );
	if ($user['state_province'] != 'AA') {
		$same_statesql = ' FROM ! WHERE country = ? and state_province = ? and id <> ? AND status in (?,?)' ;
		$t->assign ('same_state',  $osDB->getOne( $CountSelect.$same_statesql , array( USER_TABLE, $user['country'], $user['state_province'], $user['id'],'active',$active_lang ) ) );
	}

	if ($user['county'] != 'AA') {
		$same_countysql = ' FROM ! WHERE country = ? and (ifnull(state_province,\'AA\') = ? or state_province = "") and county = ? and id <> ? AND status in (?,?)' ;
		$t->assign ( 'same_county',$osDB->getOne( $CountSelect.$same_countysql , array( USER_TABLE, $user['country'], $user['state_province'], $user['county'], $user['id'],'active',$active_lang ) ) );
	}

	if ($user['city'] != 'AA') {
		$same_citysql = ' FROM ! WHERE country = ? and (ifnull(state_province,\'AA\') = ? or state_province = "") and (ifnull(county,\'AA\') = ? or county = "") and city = ? and id <> ? AND status in (?,?)' ;
		$t->assign ( 'same_city', $osDB->getOne( $CountSelect.$same_citysql, array ( USER_TABLE, $user['country'], $user['state_province'], $user['county'], $user['city'], $user['id'] ,'active',$active_lang ) ) );
	}

	if ($user['zip'] != 'AA' ) {
		$same_zipcodesql = ' FROM ! WHERE country = ? and zip = ? and id <> ? AND status in (?,?)' ;
		$t->assign ( 'same_zip', $osDB->getOne( $CountSelect.$same_zipcodesql, array ( USER_TABLE, $user['country'],  $user['zip'], $user['id'] ,'active',$active_lang ) ) );
	}
}

$same_gendersql = ' FROM ! WHERE gender = ? and username <> ? AND status in (?,?)' ;
$t->assign ( 'same_sex', $osDB->getOne( $CountSelect.$same_gendersql, array ( USER_TABLE, $user['gender'], $user['username'] ,'active',$active_lang ) ) );

$same_agesql = ' FROM ! WHERE username <> ? and floor(period_diff(extract(year_month from NOW()),extract(year_month from birth_date))/12) = ? AND status in (?,?)' ;
$t->assign ( 'same_age',  $osDB->getOne( $CountSelect.$same_agesql, array ( USER_TABLE, $user['username'], $user['age'] ,'active',$active_lang) ) );

$same_lookagestartsql = ' FROM ! WHERE username <> ? and floor(period_diff(extract(year_month from NOW()),extract(year_month from birth_date))/12) >= ? AND status in (?,?)' ;
$t->assign ( 'same_lookagestart', $osDB->getOne( $CountSelect.$same_lookagestartsql, array ( USER_TABLE, $user['username'], $user['lookagestart'] ,'active',$active_lang ) ) );

$same_lookageendsql = ' FROM ! WHERE username <> ? and floor(period_diff(extract(year_month from NOW()),extract(year_month from birth_date))/12) <= ? AND status in (?,?)' ;
$t->assign ( 'same_lookageend',  $osDB->getOne( $CountSelect.$same_lookageendsql, array ( USER_TABLE, $user['username'], $user['lookageend'] ,'active',$active_lang ) ) );

//$same_lookgendersql = 'SELECT count(*) FROM ! WHERE lookgender = ?';
$same_lookgendersql = ' FROM ! WHERE username <> ? AND status in (?,?)' ;
if ($user['lookgender'] == 'B') {
	$same_lookgendersql .= " and gender in ('M','F') ";
} elseif ($user['lookgender'] == 'A') {
} else {
	$same_lookgendersql .= " and gender = '".$user['lookgender']."'";
}
$t->assign ( 'same_lookgender', $osDB->getOne( $CountSelect.$same_lookgendersql, array ( USER_TABLE, $user['username'] ,'active',$active_lang ) ) );

//$same_lookcountrysql = 'SELECT count(*) FROM ! WHERE lookcountry = ?';
if ($user['country'] != 'AA' && $user['lookcountry'] != 'AA') {
	$same_lookcountrysql = ' FROM ! WHERE country = ? and id <> ? AND status in (?,?)' ;
	$t->assign ( 'same_lookcountry',$osDB->getOne( $CountSelect.$same_lookcountrysql, array ( USER_TABLE, $user['lookcountry'], $user['id'] ,'active',$active_lang ) ) );

	if ($user['state_province'] != 'AA' && $user['lookstate_province'] != 'AA') {
		$same_lookstatesql = ' FROM ! WHERE country = ? and state_province = ? and id <> ? AND status in (?,?)' ;
		$t->assign ( 'same_lookstate',  $osDB->getOne( $CountSelect.$same_lookstatesql, array ( USER_TABLE, $user['lookcountry'], $user['lookstate_province'], $user['id'] ,'active',$active_lang ) ) );
	}

	if ($user['county'] != 'AA' && $user['lookcounty'] != 'AA') {
		$same_lookcountysql = ' FROM ! WHERE country = ? and (ifnull(state_province,\'AA\') = ? or state_province = "") and county = ? and id <> ? AND status in (?,?)' ;
		$t->assign ( 'same_lookcounty', $osDB->getOne( $CountSelect.$same_lookcountysql, array ( USER_TABLE, $user['lookcountry'], $user['lookstate_province'], $user['lookcounty'], $user['id'] ,'active',$active_lang ) ) );	
	}
	if ($user['city'] != 'AA' && $user['lookcity'] != 'AA') {
		$same_lookcitysql = ' FROM ! WHERE country = ? and (ifnull(state_province,\'AA\') = ? or state_province = "") and (ifnull(county,\'AA\') = ? or county = "") and  city = ? and id <> ? AND status in (?,?)' ;
		$t->assign ( 'same_lookcity', $osDB->getOne( $CountSelect.$same_lookcitysql, array ( USER_TABLE, $user['lookcountry'], $user['lookstate_province'], $user['lookcounty'], $user['lookcity'], $user['id'] ,'active',$active_lang ) ) );
	}

	if ($user['zip'] != 'AA' && $user['lookzip'] != 'AA') {
		$same_lookzipsql = ' FROM ! WHERE country = ?  and zip = ? and id <> ? AND status in (?,?)' ;
		$t->assign ( 'same_lookzip', $osDB->getOne( $CountSelect.$same_lookzipsql, array ( USER_TABLE, $user['lookcountry'], $user['lookzip'], $user['id'],'active',$active_lang  ) ) );
	}
}

$same_looktimezonesql = ' FROM ! WHERE timezone = ? and username <> ? AND status in (?,?)' ;
$t->assign ( 'same_timezone',$osDB->getOne( $CountSelect.$same_looktimezonesql, array ( USER_TABLE, $user['timezone'], $user['username'] ,'active',$active_lang ) ) );

$t->assign ( 'number_matches',$osDB->getOne( 'select count(*) '.$sqlFrom . $sqlWhere, array( USER_TABLE, 'active', $active_lang ) ) );

$users = array();

if (isset($_GET['show'])){

	switch ($_GET['show']){
	case 'match':
		$data = $osDB->getAll ( $sqlSelect.$sqlFrom.$sqlWhere, array( USER_TABLE, 'active', $active_lang ) );
		$t->assign('showhead',get_lang('users_match_your_search'));
		break;
	case 'samecountry':
		$data = $osDB->getAll ( $sqlSelect.$same_countrysql , array( USER_TABLE, $user['country'], $user['id'] ,'active',$active_lang) );
		$t->assign('showhead',get_lang('in_your_country'));

		break;
	case 'samestate':
		$data = $osDB->getAll ( $sqlSelect.$same_statesql , array( USER_TABLE, $user['country'], $user['state_province'], $user['id'],'active',$active_lang ) );
		$t->assign('showhead',get_lang('in_your_state'));

		break;
	case 'samecounty':
		$data = $osDB->getAll ( $sqlSelect.$same_countysql , array( USER_TABLE, $user['country'], $user['state_province'], $user['county'], $user['id'] ,'active',$active_lang) );
		$t->assign('showhead',get_lang('in_your_county'));

		break;
	case 'samecity':
		$data = $osDB->getAll ( $sqlSelect.$same_citysql , array( USER_TABLE, $user['country'], $user['state_province'], $user['county'], $user['city'], $user['id'] ,'active',$active_lang) );
		$t->assign('showhead',get_lang('in_your_city'));
		break;
	case 'samezip':
		$data = $osDB->getAll ( $sqlSelect.$same_zipcodesql , array( USER_TABLE, $user['country'],  $user['zip'], $user['id'] ,'active',$active_lang) );
		$t->assign('showhead',get_lang('in_your_zip'));

		break;
	case 'samegender':
		$data = $osDB->getAll ( $sqlSelect.$same_gendersql , array( USER_TABLE, $user['gender'], $user['username'] ,'active',$active_lang) );
		$t->assign('showhead',get_lang('in_same_gender'));

		break;
	case 'sameage':
		$data = $osDB->getAll ( $sqlSelect.$same_agesql , array( USER_TABLE, $user['username'], $user['age'],'active',$active_lang ) );
		$t->assign('showhead',get_lang('in_same_age'));

		break;
	case 'lookagestart':
		$data = $osDB->getAll ( $sqlSelect.$same_lookagestartsql , array( USER_TABLE, $user['username'], $user['lookagestart'],'active',$active_lang ) );
		$t->assign('showhead',get_lang('above_lookagestart'));

		break;
	case 'lookageend':
		$data = $osDB->getAll ( $sqlSelect.$same_lookageendsql , array( USER_TABLE, $user['username'], $user['lookagestart'],'active',$active_lang ) );
		$t->assign('showhead',get_lang('below_lookageend'));

		break;
	case 'lookgender':
		$data = $osDB->getAll ( $sqlSelect.$same_lookgendersql , array( USER_TABLE, $user['username'] ,'active',$active_lang) );
		$t->assign('showhead',get_lang('your_lookgender'));

		break;
	case 'lookcountry':
		$data = $osDB->getAll ( $sqlSelect.$same_lookcountrysql , array( USER_TABLE, $user['lookcountry'], $user['id'] ,'active',$active_lang) );
		$t->assign('showhead',get_lang('in_look_country'));

		break;
	case 'lookstate':
		$data = $osDB->getAll ( $sqlSelect.$same_lookstatesql , array( USER_TABLE, $user['lookcountry'], $user['lookstate_province'], $user['id'] ,'active',$active_lang) );
		$t->assign('showhead',get_lang('in_look_state'));

		break;
	case 'lookcounty':
		$data = $osDB->getAll ( $sqlSelect.$same_lookcountysql , array( USER_TABLE, $user['lookcountry'], $user['lookstate_province'], $user['lookcounty'], $user['id'] ,'active',$active_lang) );
		$t->assign('showhead',get_lang('in_look_county'));

		break;
	case 'lookcity':
		$data = $osDB->getAll ( $sqlSelect.$same_lookcitysql , array( USER_TABLE, $user['lookcountry'], $user['lookstate_province'], $user['lookcounty'], $user['lookcity'], $user['id'] ,'active',$active_lang) );
		$t->assign('showhead',get_lang('in_look_city'));

		break;
	case 'lookzip':
		$data = $osDB->getAll ( $sqlSelect.$same_lookzipsql , array( USER_TABLE, $user['lookcountry'], $user['lookzip'], $user['id'] ,'active',$active_lang) );
		$t->assign('showhead',get_lang('in_look_zip'));

		break;
	case 'looktimezone':
		$data = $osDB->getAll ( $sqlSelect.$same_looktimezonesql , array( USER_TABLE, $user['timezone'], $user['username'] ,'active',$active_lang) );
		$t->assign('showhead',get_lang('in_same_timezone'));

		break;
	default:
		break;
	}

	$cpage = isset($_REQUEST['page'])?$_REQUEST['page']:'1';

	if( $cpage == '' ) $cpage = 1;

	$psize = getPageSize();

	$rcount = count($data);

	if ($rcount > 0) {

		$pages = ceil( $rcount / $psize );

		$start = ( $cpage - 1 ) * $psize;

		$t->assign ( 'start', $start );

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
			$data = array_slice($data, $start, $psize);
		}

		foreach ($data as $row) {

			$row['countryname'] = getCountryName( $row['country'] );

			$row['statename'] = getStateName($row['country'], $row['state_province']);

			$users[] = $row;
		}

		unset($data);
	}

	$t->assign('psize', $psize);

	$t->assign ( 'show', $_GET['show'] );

	$t->assign('totalrecs', $rcount);

	$t->assign ( 'data', $users );


	unset($users);

}
unset($user);
$t->assign('lang', $lang);

$t->assign('rendered_page', $t->fetch('userstats.tpl') );

$t->display( 'index.tpl' );

exit;

?>