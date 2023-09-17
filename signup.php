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

$states_cnt = $counties_cnt = $cities_cnt = $zipcodes_cnt = $lookstates_cnt = $lookcounties_cnt = $lookcities_cnt = $lookzipcodes_cnt = 0;

if ($config['accept_country'] == 'Y' || $config['accept_country'] == '1') {

	$_SESSION['from'] = $countrycode = isset($_SESSION['from']) ? $_SESSION['from'] : $config['default_country'];

}else{
	$_SESSION['from'] = 'AA';
}
	
if ( ($config['accept_state'] == 'Y' || $config['accept_state'] == '1') && $_SESSION['from'] != 'AA') {

	$lang['states'] = getStates($countrycode,'N');

	$states_cnt = count($lang['states']);

	if (isset($states_cnt) && $states_cnt > 0) {
		if ($states_cnt  ==  1 &&  !isset($_SESSION['stateprovince']) ) {
			foreach ($lang['states'] as $key => $val) {
				$_SESSION['stateprovince'] = $key;
			}
		} elseif (!isset($_SESSION['stateprovince']) ) {
			$_SESSION['stateprovince'] =  ($config['default_state']!='')?$config['default_state']:'AA';
		}
	} elseif (!isset($_SESSION['stateprovince'])) {
		$_SESSION['stateprovince'] = ($config['default_state']!='')?$config['default_state']:'AA';		
	}
} elseif (!isset($_SESSION['stateprovince'])) {
	$_SESSION['stateprovince'] = 'AA';		
}

if (($config['accept_county'] == '1' || $config['accept_county'] == 'Y') && ($states_cnt <= 1 || ($states_cnt > 1 && $_SESSION['stateprovince'] != 'AA') ) )   { 

	$lang['counties'] = getCounties($countrycode,$_SESSION['stateprovince'],'N');

	$counties_cnt = count($lang['counties']);
	
	if (isset($counties_cnt) && $counties_cnt > 0  ) {

		if ($counties_cnt  ==  1 &&  !isset($_SESSION['countycode']) ) {
			foreach ($lang['counties'] as $key => $val) {
				$_SESSION['countycode'] = $key;
			}
		} elseif (!isset($_SESSION['countycode'])) {
			$_SESSION['countycode'] = ($config['default_county']!='')?$config['default_county']:'AA';		
		}
	} elseif (!isset($_SESSION['countycode']) ) {
		$_SESSION['countycode'] = ($config['default_county']!='')?$config['default_county']:'AA';		
	}
} elseif (!isset($_SESSION['countycode']) ) {
	$_SESSION['countycode'] = 'AA';
}

if ( ($config['accept_city'] == '1' || $config['accept_city'] == 'Y') && ($states_cnt == 1 || ($states_cnt > 1 && $_SESSION['stateprovince'] != 'AA') ) && ($counties_cnt <= 1 || ($counties_cnt > 1 && $_SESSION['countycode'] != 'AA') ) )  { 

	$lang['cities'] = getCities($countrycode,$_SESSION['stateprovince'], $_SESSION['countycode'], 'N');

	$cities_cnt = count($lang['cities']);
	
	if (isset($cities_cnt) && $cities_cnt > 0  ) {

		if ($cities_cnt  ==  1 &&  !isset($_SESSION['citycode']) ) {
			foreach ($lang['cities'] as $key => $val) {
				$_SESSION['citycode'] = $key;
			}
		} elseif (!isset($_SESSION['citycode'])) {
			$_SESSION['citycode'] = ($config['default_city']!='')?$config['default_city']:'AA';		
		}
	} elseif (!isset($_SESSION['citycode']) ) {
		$_SESSION['citycode'] = ($config['default_city']!='')?$config['default_city']:'AA';		
	}
} elseif (!isset($_SESSION['citycode']) ) {
	$_SESSION['citycode'] = 'AA';
}

if ( ($config['accept_zipcode'] == '1' || $config['accept_zipcode'] == 'Y') && ($states_cnt == 1 || ($states_cnt > 1 && $_SESSION['stateprovince'] != 'AA') ) && ($counties_cnt <= 1 || ($counties_cnt > 1 && $_SESSION['countycode'] != 'AA') ) && ($cities_cnt <= 1 || ($cities_cnt > 1 && $_SESSION['citycode'] != 'AA' ) ) ) { 

	$lang['zipcodes'] = getZipcodes($countrycode,$_SESSION['stateprovince'], $_SESSION['countycode'], $_SESSION['citycode'], 'N');

	$zipcodes_cnt = count($lang['zipcodes']);
	
	if (isset($zipcodes_cnt) && $zipcodes_cnt > 0  ) {

		if ($zipcodes_cnt  ==  1 &&  !isset($_SESSION['zip']) ) {
			foreach ($lang['zipcodes'] as $key => $val) {
				$_SESSION['zip'] = $key;
			}
		} elseif (!isset($_SESSION['zip']) ) {
			$_SESSION['zip'] = ($config['default_zip']!='')?$config['default_zip']:'AA';		
		}
	} elseif (!isset($_SESSION['zip']) ) {
		$_SESSION['zip'] = ($config['default_zip']!='')?$config['default_zip']:'AA';		
	}
} elseif (!isset($_SESSION['zip']) ) {
	$_SESSION['zip'] = 'AA';
}

if (($config['accept_country'] == 'Y' || $config['accept_country'] == '1') && ($config['accept_lookcountry'] == 'Y' || $config['accept_lookcountry'] == '1'))  {

	$_SESSION['lookfrom'] = $lookcountrycode = isset($_SESSION['lookfrom']) ? $_SESSION['lookfrom'] : $_SESSION['from'];

} else {
	$_SESSION['lookfrom'] = 'AA';
}

if (($config['accept_state'] == 'Y' || $config['accept_state'] == '1') && ($config['accept_lookstate'] == 'Y' || $config['accept_lookstate'] == '1') && $_SESSION['lookfrom'] != 'AA' )  {

	$lang['lookstates'] = getStates($lookcountrycode,'Y');

	$lookstates_cnt = count($lang['lookstates']);

	if (isset($lookstates_cnt) && $lookstates_cnt > 0) {
		if ($lookstates_cnt  ==  1 &&  !isset($_SESSION['lookstateprovince']) ) {
			foreach ($lang['lookstates'] as $key => $val) {
				$_SESSION['lookstateprovince'] = $key;
			}
		} elseif (!isset($_SESSION['lookstateprovince']) ) {
			$_SESSION['lookstateprovince'] =  'AA';
		}
	} elseif (!isset($_SESSION['lookstateprovince'])) {
		$_SESSION['lookstateprovince'] = 'AA';		
	}
} elseif (!isset($_SESSION['lookstateprovince'])) {
	$_SESSION['lookstateprovince'] = 'AA';		
}

if (($config['accept_county'] == '1' || $config['accept_county'] == 'Y') && ($config['accept_lookcounty'] == '1' || $config['accept_lookcounty'] == 'Y') && $_SESSION['lookfrom'] != 'AA' && ($lookstates_cnt <= 1 || ($lookstates_cnt > 1 && $_SESSION['lookstateprovince'] != 'AA') ) )   { 

	$lang['lookcounties'] = getCounties($lookcountrycode, $_SESSION['lookstateprovince'],'Y');

	$lookcounties_cnt = count($lang['lookcounties']);
	
	if (isset($lookcounties_cnt) && $lookcounties_cnt > 0  ) {

		if ($lookcounties_cnt  ==  1 &&  !isset($_SESSION['lookcountycode']) ) {
			foreach ($lang['lookcounties'] as $key => $val) {
				$_SESSION['lookcountycode'] = $key;
			}
		} elseif (!isset($_SESSION['lookcountycode'])) {
			$_SESSION['lookcountycode'] = 'AA';		
		}
	} elseif (!isset($_SESSION['lookcountycode']) ) {
		$_SESSION['lookcountycode'] = 'AA';		
	}
} elseif (!isset($_SESSION['lookcountycode']) ) {
	$_SESSION['lookcountycode'] = 'AA';
}

if ( ($config['accept_city'] == '1' || $config['accept_city'] == 'Y') && ($config['accept_lookcity'] == '1' || $config['accept_lookcity'] == 'Y') && $_SESSION['lookfrom'] != 'AA' && ($lookstates_cnt == 1 || ($lookstates_cnt > 1 && $_SESSION['lookstateprovince'] != 'AA') ) && ($lookcounties_cnt <= 1 || ($lookcounties_cnt > 1 && $_SESSION['lookcountycode'] != 'AA') ) )  { 

	$lang['lookcities'] = getCities($lookcountrycode,$_SESSION['lookstateprovince'], $_SESSION['lookcountycode'], 'Y');

	$lookcities_cnt = count($lang['lookcities']);
	
	if (isset($lookcities_cnt) && $lookcities_cnt > 0  ) {

		if ($lookcities_cnt  ==  1 &&  !isset($_SESSION['lookcitycode']) ) {
			foreach ($lang['lookcities'] as $key => $val) {
				$_SESSION['lookcitycode'] = $key;
			}
		} elseif (!isset($_SESSION['lookcitycode'])) {
			$_SESSION['lookcitycode'] = 'AA';		
		}
	} elseif (!isset($_SESSION['lookcitycode']) ) {
		$_SESSION['lookcitycode'] = 'AA';		
	}
} elseif (!isset($_SESSION['lookcitycode']) ) {
	$_SESSION['lookcitycode'] = 'AA';
}

if ( ($config['accept_zipcode'] == '1' || $config['accept_zipcode'] == 'Y') && ($config['accept_lookzipcode'] == '1' || $config['accept_lookzipcode'] == 'Y') && $_SESSION['lookfrom'] != 'AA'  && ($lookstates_cnt == 1 || ($lookstates_cnt > 1 && $_SESSION['lookstateprovince'] != 'AA') ) && ($lookcounties_cnt <= 1 || ($lookcounties_cnt > 1 && $_SESSION['lookcountycode'] != 'AA') ) && ($lookcities_cnt <= 1 || ($lookcities_cnt > 1 && $_SESSION['lookcitycode'] != 'AA' ) ) ) { 

	$lang['lookzipcodes'] = getZipcodes($lookcountrycode,$_SESSION['lookstateprovince'], $_SESSION['lookcountycode'], $_SESSION['lookcitycode'], 'N');

	$lookzipcodes_cnt = count($lang['lookzipcodes']);
	
	if (isset($lookzipcodes_cnt) && $lookzipcodes_cnt > 0  ) {

		if ($lookzipcodes_cnt  ==  1 &&  !isset($_SESSION['lookzip']) ) {
			foreach ($lang['lookzipcodes'] as $key => $val) {
				$_SESSION['lookzip'] = $key;
			}
		} elseif (!isset($_SESSION['lookzip']) ) {
			$_SESSION['lookzip'] = 'AA';		
		}
	} elseif (!isset($_SESSION['lookzip']) ) {
		$_SESSION['lookzip'] = 'AA';		
	}
} elseif (!isset($_SESSION['lookzip']) ) {
	$_SESSION['lookzip'] = 'AA';
}


$lang['signup_gender_values'] = get_lang_values('signup_gender_values');

$lang['signup_gender_look'] = get_lang_values('signup_gender_look');

$lang['tz'] = get_lang_values('tz');

if (isset($lookcountrycode) && $lookcountrycode != '') {
	$t->assign('zipsavailable',$osDB->getOne('select count(*) from ! where countrycode=?', array(ZIPCODES_TABLE, $lookcountrycode) ) );
}
$_SESSION['radiustype'] = 'kms';

if (isset($lookcountrycode) && $lookcountrycode == 'US') {$_SESSION['radiustype'] = 'miles';}

$t->assign('password',(isset($_SESSION['password'])?$_SESSION['password']:'') );

$t->assign('password2',(isset($_SESSION['password2'])?$_SESSION['password2']:'') );

$_SESSION['txtlookagestart'] = (isset($_SESSION['txtlookagestart'])&& $_SESSION['txtlookagestart'] > 0)? $_SESSION['txtlookagestart']:($config['end_year']*-1);

$_SESSION['txtlookageend'] = (isset($_SESSION['txtlookageend']) && $_SESSION['txtlookageend'] > 0)? $_SESSION['txtlookageend']:($config['start_year']*-1);
if (isset($_GET['errid']) ) $t->assign ( 'signup_error',get_lang('errormsgs',$_GET['errid']) );

if (isset($_SESSION['selectedtime']) && $_SESSION['selectedtime'] != '') {

	$t->assign('selectedtime', $_SESSION['selectedtime']);
	$_SESSION['selectedtime'] = '';

} else {

	$t->assign( 'selectedtime' , date( 'Y-m-d', mktime( 0, 0, 0, date('m'), date('d'), date('Y')-25)) );
}

$t->assign("promocnt", $osDB->getOne("select count(*) from ! where active=1", array(PROMO_TABLE) ) );

$t->assign('lang', $lang);

$address = array();

$address['from'] = $_SESSION['from'];
$address['stateprovince'] = $_SESSION['stateprovince'];
$address['countycode'] = $_SESSION['countycode'];
$address['citycode'] = $_SESSION['citycode'];
$address['zip'] = $_SESSION['zip'];
$address['lookfrom'] = $_SESSION['lookfrom'];
$address['lookstateprovince'] = $_SESSION['lookstateprovince'];
$address['lookcountycode'] = $_SESSION['lookcountycode'];
$address['lookcitycode'] = $_SESSION['lookcitycode'];
$address['lookzip'] = $_SESSION['lookzip'];
$t->assign('address', $address);

if ( isset($_GET['errid']) && $_GET['errid'] != '') {
	$t->assign("error_message", get_lang('errormsgs', $_GET['errid']) );
}

$t->assign('rendered_page',$t->fetch('signup.tpl'));

$t->display( 'index.tpl' );

unset($address, $lang);

exit();

?>
