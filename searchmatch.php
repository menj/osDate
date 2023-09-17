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

$psize = getPageSize();

$t->assign ( 'psize',  $psize );

$with_photo = isset($_REQUEST['with_photo'])?$_REQUEST['with_photo']:false;

$country = isset($_REQUEST['lookcountry'])?$_REQUEST['lookcountry']:'AA';

$cpage = isset($_REQUEST['page'])?$_REQUEST['page']:'1';

$zip = isset($_REQUEST['srchzip'])?$_REQUEST['srchzip']:'';


if( $cpage == '' ) {
	$cpage = 1;
}

$lookgender_search="";

/* Bypass cross matching in search if set in global settings */
if ($config['bypass_search_lookgender'] == 'N' or $config['bypass_search_lookgender'] == '0' ) {
	$lookgender_search = " AND usr.lookgender in ('A' ";
	if ($_REQUEST['txtgender'] == 'M' || $_REQUEST['txtgender'] == 'F') {
		$lookgender_search .= ",'B'";
	}
	$lookgender_search .= ",'".$_REQUEST['txtgender']."') ";
}

$gender_search = " AND usr.gender in ( ";

if (isset($_REQUEST['txtlookgender']) && $_REQUEST['txtlookgender'] == 'A') {
	$gender_search .= "'M','F','C'";
} elseif ( isset($_REQUEST['txtlookgender']) && $_REQUEST['txtlookgender'] == 'B') {
	$gender_search .= "'M','F'";
} else {
	$gender_search .= "'".(isset($_REQUEST['txtlookgender'])?$_REQUEST['txtlookgender']:'A')."'";
}
$gender_search .= ") ";

$zipcodes_in = '';
if ($zip != '' && $country != 'AA') {
/* Zip code proximity search */	
   if ($country == 'GB') {
	   $ukzip = explode(' ',$zip);
	   $srchzip = $ukzip[0];
   } else {
	   $srchzip = $zip;
   }
	$row = $osDB->getRow('select latitude, longitude from ! where code=? and countrycode=? limit 1',array(ZIPCODES_TABLE, ltrim(rtrim($srchzip)), $country ) );
	$lat = isset($row['latitude'])?$row['latitude']:'';
	$lng = isset($row['longitude'])?$row['longitude']:'';
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
		   $zipcodes_in = " and ( sqrt(power(69.1*(usr.zip_latitude - $lat),2)+power(69.1*(usr.zip_longitude-$lng)*cos(usr.zip_latitude/57.3),2)) < " . $radius ." ) ";
	   } else {
		/* Miles  */
		   $zipcodes_in = " and (  (3958* 3.1415926 * sqrt((usr.zip_latitude - $lat) * (usr.zip_latitude- $lat) + cos(usr.zip_latitude / 57.29578) * cos($lat/57.29578)*(usr.zip_longitude - $lng) * (usr.zip_longitude - $lng))/180) < " . $radius ." ) ";
	   }
	}
}

if (!isset($_REQUEST['sort_by']) ) {
	$sort_by=$config['search_sort_by'];
} else {
	$sort_by=$_REQUEST['sort_by'];
}

if (!isset($_REQUEST['sort_order'] )) {
	$sort_order='asc';
} else {
	$sort_order=$_REQUEST['sort_order'];
}

$t->assign('sort_by', $sort_by);

$sortme = " order by ";

if ($sort_by == 'username') {

	$sortme .= 'usr.username ';

} elseif ( $sort_by == 'age' ) {

	$sortme .= ' age ';

} elseif ( $sort_by == 'level' ) {

	$sortme .= ' usr.level ';

} elseif ( $sort_by == 'logintime' ) {

	$sortme .= 'usr.lastvisit ';
	if (!isset($_REQUEST['sort_order']) || $_REQUEST['sort_order'] == '') {
		$sort_order=' desc ';
	} else {
		$sort_order=$_REQUEST['sort_order'];
	}

} elseif ( $sort_by == 'online' ) {

	$sortme .= ' onl.is_online desc, usr.username ';
}

$t->assign('sort_order', $sort_order);

$sortme .= $sort_order." ";

$bannedlist = '';
if (isset($_SESSION['UserId'])) {
	/* Make a banned users list */
	$bannedusers = $osDB->getAll('select bdy.ref_userid from ! as bdy where bdy.act=? and bdy.userid = ? union select bdy1.userid as ref_userid from ! as bdy1 where bdy1.act=? and bdy1.ref_userid = ?', array(BUDDY_BAN_TABLE,  'B', $_SESSION['UserId'], BUDDY_BAN_TABLE,  'B', $_SESSION['UserId'] ) );
	if (count($bannedusers) > 0) {
		$bannedlist=' and usr.id not in (';
		$bdylst = '';
		foreach ($bannedusers as $busr) {
			if ($bdylst != '') $bdylst .= ',';
			$bdylst .= "'".$busr['ref_userid']."'";
		}
		$bannedlist .=$bdylst.') ';
	}
	unset($bannedusers);
}
/*
$yearstart  = date("Y-m-d", mktime(0, 0, 0, date("m"),   date("d")+1,   date("Y") - $_REQUEST['txtlookageend'])-1);
$yearend  = date("Y-m-d", mktime(0, 0, 0, date("m"),   date("d"),   date("Y") - $_REQUEST['txtlookagestart']));
*/
$yearend  = $osDB->getOne('select date_sub(curdate(),interval '.(isset($_REQUEST['txtlookagestart'])?$_REQUEST['txtlookagestart']:$config['default_end_agerange']) .' year)');

$yearstart  = $osDB->getOne('select date_sub(curdate(),interval '.(isset($_REQUEST['txtlookageend'] )?($_REQUEST['txtlookageend'] + 1):($config['default_start_agerange']+1)) .' year)');

$countryselect='';

if ($country != 'AA') {
	$countryselect = " and usr.country ='".$country."' ";
}

$_SESSION['lookcountry'] = $country;

$start = ( $cpage - 1 ) * $psize;

$t->assign ( 'start', $start );

$photoqry='';
if ($with_photo == 1) {
	$photoqry = ' and usr.id = ANY (select snp.userid from '.USER_SNAP_TABLE. ' as snp where snp.userid = usr.id  ) ';
}

$sql = 'SELECT SQL_CALC_FOUND_ROWS distinct usr.*, floor((to_days(curdate())-to_days(birth_date))/365.25)  as age  FROM  '.MEMBERSHIP_TABLE.' as mem, '.USER_TABLE." as usr  WHERE  mem.roleid=usr.level and mem.includeinsearch=1 AND usr.id > 0 and lower(usr.status) in (lower('".get_lang('status_enum','active')."'),'active') AND usr.active=1 AND usr.birth_date BETWEEN '".$yearstart."'  AND '".$yearend."' ". $countryselect. $bannedlist.$gender_search. $lookgender_search.$photoqry.$zipcodes_in.$sortme ." limit ".$start.",".$psize;

$rs = $osDB->getAll( $sql);

$rcount = $osDB->getOne('select FOUND_ROWS()');

if( isset($rs) && !empty($rs) && $rcount > 0 ) {

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

}

setcookie($config['cookie_prefix']."osdate_info[search_ages]", (isset($_REQUEST['txtlookagestart'])?$_REQUEST['txtlookagestart']:$config['default_end_agerange']).':'.(isset($_REQUEST['txtlookageend'] )?($_REQUEST['txtlookageend'] + 1):($config['default_start_agerange']+1)), strtotime("+30day"), "/" );

$_SESSION['simplesearch']['txtgender'] = isset($_REQUEST['txtgender'])?$_REQUEST['txtgender']:'A';
$_SESSION['simplesearch']['txtlookgender']= isset($_REQUEST['txtlookgender'])?$_REQUEST['txtlookgender']:'A';
$_SESSION['simplesearch']['lookageend'] = (isset($_REQUEST['txtlookageend'] )?($_REQUEST['txtlookageend'] + 1):($config['default_start_agerange']+1));
$_SESSION['simplesearch']['lookagestart'] = (isset($_REQUEST['txtlookagestart'])?$_REQUEST['txtlookagestart']:$config['default_end_agerange']);
$_SESSION['simplesearch']['with_photo'] = isset($_REQUEST['with_photo'])?$_REQUEST['with_photo']:false;
$_SESSION['simplesearch']['lookcountry'] = $country;
$_SESSION['simplesearch']['srchzip'] = $zip;
$querystring = array(
			'txtgender'			=> $_SESSION['simplesearch']['txtgender'],
			'txtlookgender'		=> $_SESSION['simplesearch']['txtlookgender'],
			'txtlookagestart' 	=> $_SESSION['simplesearch']['lookagestart'],
			'txtlookageend'		=> $_SESSION['simplesearch']['lookageend'],
			'with_photo'		=> $_SESSION['simplesearch']['with_photo'],
			'lookcountry'		=> $_SESSION['simplesearch']['lookcountry'],
			'srchzip'		=> $_SESSION['simplesearch']['srchzip']
			) ;



if ( !isset($rs) || empty($rs) || $rcount <= 0 ) {

	$t->assign ( 'error', "1" );

	$t->assign('querystring', $querystring);

	$t->assign ( 'backlink', 'searchprofile.php' );

} else {

	if ( isset($_REQUEST['savesearch']) && $_REQUEST['savesearch'] == 'on' && isset( $_SESSION['UserId'] ) ) {

		$osDB->query( 'INSERT INTO ! ( userid, query) VALUES(? , ?)', array(USER_SEARCH_TABLE, $_SESSION['UserId'], $sql ) );
	}

	$data = array();
	if (isset($rs) && !empty($rs)  ) {
		foreach( $rs as $row ) {

			$row['countryname'] = getCountryName( $row['country'] );

			$row['statename'] = getStateName( $row['country'], $row['state_province']);

			$data[] = $row;
		}
	}
	hasRight('');

	$lang['sort_types'] = get_lang_values('sort_types');

	$t->assign  ( 'querystring', $querystring) ;

	$t->assign ( 'data', $data );

	unset($data, $rs, $querystring);
}
$t->assign ( 'lang', $lang );

$t->assign('simplesearch', $_SESSION['simplesearch']);

$t->assign('rendered_page', $t->fetch('showsimpsh.tpl') );

$t->display ( 'index.tpl' );

exit;

?>