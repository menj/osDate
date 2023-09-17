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

require_once(dirname(__FILE__).'/minimum_init.php');
$ret='';

if (!isset($_GET['a']) || empty($_GET['a']) || !isset($_GET['v']) || empty($_GET['v'])) { 
	if ( ($config['accept_state'] =='1' or $config['accept_state'] =='Y') &&  ($config['accept_lookstate'] == 'Y' ||$config['accept_lookstate'] == '1') ) {
		$ret .= '|||txtlookstateprovince|:|' .'<input name="txtlookstateprovince" type="text" size="30" maxlength="100" />';
	}
	if (($config['accept_county'] == 'Y' ||$config['accept_county'] == '1') &&  ($config['accept_lookcounty'] == 'Y' ||$config['accept_lookcounty'] == '1') ) { 
		$ret .=  '|||txtlookcounty|:|' . '<input name="txtlookcounty" type="text" class="textinput" size="30" maxlength="100" />';
	}
	if (($config['accept_city'] == 'Y' ||$config['accept_city'] == '1') &&  ($config['accept_lookcity'] == 'Y' ||$config['accept_lookcity'] == '1') ) { 
		$ret .= '|||txtlookcity|:|' . '<input name="txtlookcity" type="text" class="textinput" size="30" maxlength="100" />';
	}
	if (($config['accept_zipcode'] == 'Y' ||$config['accept_zipcode'] == '1') && ($config['accept_lookzipcode'] == 'Y' ||$config['accept_lookzipcode'] == '1'))  { 
		$ret .= '|||txtlookzip|:|' . '<input name="txtlookzip" type="text" class="textinput" size="30" maxlength="100" />';
	}
	echo utf8_encode($ret);
	$osDB->disconnect();
	exit;
}

if (trim($_GET['a']) == 'country') {
	$cntry = $_GET['v'];
} else {
	$cntry = $_GET['v1'];
}
if ($cntry == 'US') $_SESSION['radiustype'] = 'miles';


$zipsAvailable = zipsAvailable($cntry);
$zipsDisp =	'<table border=0 cellspacing="'.$config['cellspacing'].'" cellpadding="'.$config['cellpadding'].'"  width="100%"><tr >'.
	'<td width="33%" valign="middle">'.get_lang('search_within').':</td><td valign="top" width="67%"><table width="100%" cellpadding=0 border=0 cellspacing=0><tr>
	<td valign="middle" width="15">'.
	'<input name="lookradius" value="'.$_SESSION['lookradius'].'" type=text class="textinput" size="5" maxlength="10" /></td>'.
	'<td valign="middle" width="6">'.
	'<input type=radio name="radiustype" value="miles"';
$zipsDisp .= ($_SESSION['radiustype'] == 'miles')? 'checked':'';
$zipsDisp .= '/></td><td width="15" valign="middle">'.get_lang('miles').
	'</td><td width="6" valign="middle"><input type=radio name="radiustype" value="kms"';
$zipsDisp .= ($_SESSION['radiustype'] == 'kms')?' checked ':'';
$zipsDisp .='/></td><td valign="middle" width="20">'.get_lang('kms').'</td><td  valign="middle">&nbsp;'.get_lang('of_zip_code').'</td></tr></table></td></tr></table>';

switch (trim($_GET['a'])) {
	case 'country':
		$countrycode = isset($_GET['v'])?$_GET['v']:DEFAULT_COUNTRY;
		if (($config['accept_state'] == 'Y' or $config['accept_state'] =='1') && ($config['accept_lookstate'] == 'Y' or $config['accept_lookstate'] =='1')) {
			$ret .= '|||txtlookstateprovince|:|' . stateOptions($countrycode);
			if (($config['accept_county'] == 'Y' ||$config['accept_county'] == '1') && ($config['accept_lookcounty'] == 'Y' ||$config['accept_lookcounty'] == '1')) { 
				$ret .=  '|||txtlookcounty|:|' . '<input name="txtlookcounty" type="text" class="textinput" size="30" maxlength="100" />';
			}
			if (($config['accept_city'] == 'Y' ||$config['accept_city'] == '1') && ($config['accept_lookcity'] == 'Y' ||$config['accept_lookcity'] == '1')) { 
				$ret .= '|||txtlookcity|:|' . '<input name="txtlookcity" type="text" class="textinput" size="30" maxlength="100" />';
			}
			if (($config['accept_zipcode'] == 'Y' ||$config['accept_zipcode'] == '1')&& ($config['accept_lookzipcode'] == 'Y' ||$config['accept_lookzipcode'] == '1')) { 
				$ret .= '|||txtlookzip|:|' . '<input name="txtlookzip" type="text" class="textinput" size="30" maxlength="100" />';
			}
		} elseif (($config['accept_county'] == 'Y' or $config['accept_county'] =='1') && ($config['accept_lookcounty'] == 'Y' or $config['accept_lookcounty'] =='1')) {
			$ret .= '|||txtlookcounty|:|' . countyOptions($countrycode, 'AA');
			if (($config['accept_city'] == 'Y' ||$config['accept_city'] == '1')&& ($config['accept_lookcity'] == 'Y' ||$config['accept_lookcity'] == '1')) { 
				$ret .= '|||txtlookcity|:|' . '<input name="txtlookcity" type="text" class="textinput" size="30" maxlength="100" 	/>';
			}
			if (($config['accept_zipcode'] == 'Y' ||$config['accept_zipcode'] == '1') && ($config['accept_lookzipcode'] == 'Y' ||$config['accept_lookzipcode'] == '1') ){ 
				$ret .= '|||txtlookzip|:|' . '<input name="txtlookzip" type="text" class="textinput" size="30" maxlength="100" />';
			}
		} elseif (($config['accept_city'] == 'Y' ||$config['accept_city'] == '1')&&($config['accept_lookcity'] == 'Y' ||$config['accept_lookcity'] == '1')) {
			$ret .=  '|||txtlookcity|:|' . cityOptions($countrycode, 'AA', 'AA');
			if (($config['accept_zipcode'] == 'Y' ||$config['accept_zipcode'] == '1')&&($config['accept_lookzipcode'] == 'Y' ||$config['accept_lookzipcode'] == '1')) { 
				$ret .= '|||txtlookzip|:|' . '<input name="txtlookzip" type="text" class="textinput" size="30" maxlength="100" />';
			}
		} elseif (($config['accept_zipcode'] =='Y' || $config['accept_zipcode'] == '1')&&($config['accept_lookzipcode'] =='Y' || $config['accept_lookzipcode'] == '1')) {
			$ret.= '|||txtlookzip|:|' . zipOptions($countrycode, 'AA', 'AA', 'AA');
		}
		break;

	case 'state':
		$statecode = $_GET['v'];
		$countrycode = $_GET['v1'];
		if (($config['accept_county'] == 'Y' or $config['accept_county'] =='1') && ($config['accept_lookcounty'] == 'Y' or $config['accept_lookcounty'] =='1')) {
			$ret .= '|||txtlookcounty|:|' . countyOptions($countrycode, $statecode);
			if (($config['accept_city'] == 'Y' ||$config['accept_city'] == '1')&& ($config['accept_lookcity'] == 'Y' ||$config['accept_lookcity'] == '1')) { 
				$ret .= '|||txtlookcity|:|' . '<input name="txtlookcity" type="text" class="textinput" size="30" maxlength="100" 	/>';
			}
			if (($config['accept_zipcode'] == 'Y' ||$config['accept_zipcode'] == '1') && ($config['accept_lookzipcode'] == 'Y' ||$config['accept_lookzipcode'] == '1') ){ 
				$ret .= '|||txtlookzip|:|' . '<input name="txtlookzip" type="text" class="textinput" size="30" maxlength="100" />';
			}
		} elseif (($config['accept_city'] == 'Y' ||$config['accept_city'] == '1')&&($config['accept_lookcity'] == 'Y' ||$config['accept_lookcity'] == '1')) {
			$ret .=  '|||txtlookcity|:|' . cityOptions($countrycode, $statecode, 'AA');
			if (($config['accept_zipcode'] == 'Y' ||$config['accept_zipcode'] == '1')&&($config['accept_lookzipcode'] == 'Y' ||$config['accept_lookzipcode'] == '1')) { 
				$ret .= '|||txtlookzip|:|' . '<input name="txtlookzip" type="text" class="textinput" size="30" maxlength="100" />';
			}
		} elseif (($config['accept_zipcode'] =='Y' || $config['accept_zipcode'] == '1')&&($config['accept_lookzipcode'] =='Y' || $config['accept_lookzipcode'] == '1')) {
			$ret.= '|||txtlookzip|:|' . zipOptions($countrycode, $statecode, 'AA', 'AA');
		}
		break;

	case 'county':
		$countycode = $_GET['v'];
		$statecode = isset($_GET['v2'])?$_GET['v2']:'AA';
		$countrycode = $_GET['v1'];
		if (($config['accept_city'] == 'Y' ||$config['accept_city'] == '1')&&($config['accept_lookcity'] == 'Y' ||$config['accept_lookcity'] == '1')) {
			$ret .=  '|||txtlookcity|:|' . cityOptions($countrycode, $statecode, $countycode);
			if (($config['accept_zipcode'] == 'Y' ||$config['accept_zipcode'] == '1')&&($config['accept_lookzipcode'] == 'Y' ||$config['accept_lookzipcode'] == '1')) { 
				$ret .= '|||txtlookzip|:|' . '<input name="txtlookzip" type="text" class="textinput" size="30" maxlength="100" />';
			}
		} elseif (($config['accept_zipcode'] =='Y' || $config['accept_zipcode'] == '1')&&($config['accept_lookzipcode'] =='Y' || $config['accept_lookzipcode'] == '1')) {
			$ret.= '|||txtlookzip|:|' . zipOptions($countrycode, $statecode, $countycode, 'AA');
		}
		break;

	case 'city':
		$citycode = $_GET['v'];
		$statecode = isset($_GET['v2'])?$_GET['v2']:'AA';
		$countrycode = $_GET['v1'];
		$countycode = isset($_GET['v3'])?$_GET['v3']:'AA';
		if (($config['accept_zipcode'] =='Y' || $config['accept_zipcode'] == '1') && ($config['accept_lookzipcode'] =='Y' || $config['accept_lookzipcode'] == '1')) {
			$ret.= '|||txtlookzip|:|' . zipOptions($countrycode, $statecode, $countycode, $citycode);
		}		

		if ($zipsAvailable == 1) {
			$ret.= '|||zipsavailable|:|' .$zipsDisp;
		}else {
			$ret.= '|||zipsavailable|:|' .' ';
		}
		break;

	default : $ret = ''; break;
}

function stateOptions($countrycode) {
	global $config;
	if ( ($config['accept_country'] == '1' || $config['accept_country'] == 'Y' ) && ($config['accept_lookcountry'] == '1' || $config['accept_lookcountry'] == 'Y' ) && $countrycode == 'AA' )  {
		return '<input name="txtlookstateprovince" type="text" class="textinput" size="30" maxlength="100" />';
	}
	$data = getStates(trim($countrycode),'N');
	
	if (count($data) < 1 || (count($data) > 1 && $countrycode == 'AA' && ($config['accept_lookfrom'] == 'Y' or $config['accept_lookfrom'] == '1' ) && ($config['accept_from'] == 'Y' or $config['accept_from'] == '1' ) ) ) 
		return '<input name="txtlookstateprovince" type="text" class="textinput" size="30" maxlength="100" />';
	
	if (($config['accept_county'] == 'Y' || $config['accept_county'] == '1') && ($config['accept_lookcounty'] == 'Y' || $config['accept_lookcounty'] == '1'))  { 	
		$ret .= '	<select class="select" style="width: 175px" name="txtlookstateprovince" onchange="javascript: cascadeStateL(this.value,\''.$countrycode.'\');" >';
	} elseif (($config['accept_city'] == '1' || $config['accept_city'] == 'Y')&& ($config['accept_lookcity'] == '1' || $config['accept_lookcity'] == 'Y'))  {
		$ret .= '	<select class="select" style="width: 175px" name="txtlookstateprovince" onchange="javascript:  cascadeCountyL(\'AA\',\''.$countrycode.'\',this.value);" >';
	} elseif (( $config['accept_zipcode'] =='1' || $config['accpet_zipcode'] =='Y') && ( $config['accept_lookzipcode'] =='1' || $config['accpet_lookzipcode'] =='Y') ){
		$ret .= '	<select class="select" style="width: 175px" name="txtlookstateprovince" onchange="javascript:  cascadeCityL(\'AA\',\''.$countrycode.'\',this.value,\'AA\');" >';
	}
	$ret .= '<option value="AA">'.get_lang('select_state').'</option>';

	foreach ($data as $k => $y){
		if ($k != 'AA') {
			$ret .= "<option value='$k'>$y</option>";
		}
	}
	unset ($data);

	return $ret .= '</select>';
}

function countyOptions($countrycode, $statecode) {

	global $config;
	if (  ( ($config['accept_country'] == '1' || $config['accept_country'] == 'Y' ) && ($config['accept_lookcountry'] == '1' || $config['accept_lookcountry'] == 'Y' ) && $countrycode == 'AA' ) || ( ($config['accept_state'] == '1' || $config['accept_state'] == 'Y' ) && ($config['accept_lookstate'] == '1' || $config['accept_lookstate'] == 'Y' ) && $statecode == 'AA') ) {
		return '<input name="txtlookcounty" type="text" class="textinput" size="30" maxlength="100" />';
	}

	$data = getCounties(trim($countrycode),trim($statecode),'N');

	if (count($data) < 1 || (count($data) > 1 && $statecode == 'AA' && ($config['accept_state'] == '1' or $config['accept_state'] == 'Y' ) && ($config['accept_lookstate'] == '1' or $config['accept_lookstate'] == 'Y' ) )) return '<input name="txtlookcounty" type="text" class="textinput" size="30" maxlength="100" />';

	if (($config['accept_city'] == '1' || $config['accept_city'] == 'Y')&& ($config['accept_lookcity'] == '1' || $config['accept_lookcity'] == 'Y'))  {
		$ret .= '	<select class="select" style="width: 175px" name="txtlookcounty" onchange="javascript:  cascadeCountyL(this.value,\''.$countrycode.'\','."'".$statecode."'".');" >';
	} elseif (( $config['accept_zipcode'] =='1' || $config['accpet_zipcode'] =='Y') && ( $config['accept_lookzipcode'] =='1' || $config['accpet_lookzipcode'] =='Y') ){
		$ret .= '	<select class="select" style="width: 175px" name="txtlookcounty" onchange="javascript:  cascadeCityL(\'AA\',\''.$countrycode.'\','."'".$statecode."'".', this.value);" >';
	}
	$ret .= '<option value="AA">'.get_lang('select_county').'</option>';
	foreach ($data as $k => $y) {
		if ($k != 'AA') {
			$ret .= "<option value='$k'>$y</option>";
		}
	}
	unset ($data);

	return $ret .= '</select>';
}

function cityOptions($countrycode, $statecode, $countycode) {
	global $config;
	if (( ($config['accept_county'] == '1' || $config['accept_county'] == 'Y' ) && ($config['accept_lookcounty'] == '1' || $config['accept_lookcounty'] == 'Y' ) && $countycode == 'AA') ||  ( ($config['accept_country'] == '1' || $config['accept_country'] == 'Y' ) && ($config['accept_lookcountry'] == '1' || $config['accept_lookcountry'] == 'Y' ) && $countrycode == 'AA' ) || ( ($config['accept_state'] == '1' || $config['accept_state'] == 'Y' ) && ($config['accept_lookstate'] == '1' || $config['accept_lookstate'] == 'Y' ) && $statecode == 'AA') ) {
		return '<input name="txtlookcity" type="text" class="textinput" size="30" maxlength="100" />';
	}

	$data = getCities(trim($countrycode),trim($statecode),trim($countycode),'N');

	if (count($data) < 1 || (count($data) > 1 && $countycode == 'AA'  && ($config['accept_county'] == '1' or $config['accept_county'] == 'Y' ) && ($config['accept_lookcounty'] == '1' or $config['accept_lookcounty'] == 'Y' ) )) return '<input name="txtlookcity" type="text" class="textinput" size="30" maxlength="100" />';

	if (($config['accept_zipcode'] =='1' || $config['accept_zipcode'] =='Y') && ($config['accept_lookzipcode'] =='1' || $config['accept_lookzipcode'] =='Y')) {

		if (($config['accept_county'] == 'Y' or $config['accept_county'] == '1') && ($config['accept_lookcounty'] == 'Y' or $config['accept_lookcounty'] == '1')) {
			$ret .= '	<select class="select" style="width: 175px" name="txtlookcity" onchange="javascript: cascadeCityL(this.value,\''.$countrycode.'\','."'".$statecode."'".',\''.$countycode.'\');" >';
		}else{
			$ret .= '	<select class="select" style="width: 175px" name="txtlookcity" onchange="javascript: cascadeCityL(this.value,\''.$countrycode.'\','."'".$statecode."'".',\'AA\');" >';
		}
	} else {
		$ret .= '	<select class="select" style="width: 175px" name="txtlookcity" >'; 		
	}	
	$ret .= '<option value="AA">'.get_lang('select_city').'</option>';

	foreach ($data as $k => $y) {
		if ($k != 'AA') {

			$ret .= "<option value='$k'>$y</option>";
		}
	}
	unset ($data);

	return $ret .= '</select>';
}


function zipOptions($countrycode, $statecode, $countycode, $citycode) {
	global $config;
	
	if (( ($config['accept_county'] == '1' || $config['accept_county'] == 'Y' ) && ($config['accept_lookcounty'] == '1' || $config['accept_lookcounty'] == 'Y' ) && $countycode == 'AA') ||  ( ($config['accept_country'] == '1' || $config['accept_country'] == 'Y' ) && ($config['accept_lookcountry'] == '1' || $config['accept_lookcountry'] == 'Y' ) && $countrycode == 'AA' ) || ( ($config['accept_state'] == '1' || $config['accept_state'] == 'Y' ) && ($config['accept_lookstate'] == '1' || $config['accept_lookstate'] == 'Y' ) && $statecode == 'AA') || ( ($config['accept_city'] == '1' || $config['accept_city'] == 'Y' ) && ($config['accept_lookcity'] == '1' || $config['accept_lookcity'] == 'Y' ) && $lookcitycode == 'AA')) {	
		return '<input name="txtlookzip" type="text" class="textinput" size="30" maxlength="100" />';
	}
echo("here<br />");
	$data = getZipcodes($countrycode,$statecode,$countycode,$citycode,'N');
print_r($data);

	if (count($data) < 1 || (count($data) > 1 && $citycode == 'AA' && ($config['accept_city'] == '1' or $config['accept_city'] == 'Y' ) && ($config['accept_lookcity'] == '1' or $config['accept_lookcity'] == 'Y' ))) return '<input name="txtlookzip" type="text" class="textinput" size="30" maxlength="100" />';

	$ret = '	<select class="select" style="width: 175px" name="txtlookzip" >';
	$ret .= '<option value="AA">'.get_lang('all_zips').'</option>';
	foreach ($data as $k => $y) {
		if ($k != 'AA') $ret .= "<option value='$k'>$y</option>";
	}
	unset ($data);

	return $ret .= '</select>';
}
echo utf8_encode($ret);

unset($ret);

$osDB->disconnect();


?>
