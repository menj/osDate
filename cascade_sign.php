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
	if ($config['accept_state'] =='1' or $config['accept_state'] =='Y') {
		$ret .= '|||txtstateprovince|:|' .'<input name="txtstateprovince" type="text" size="30" maxlength="100" />';
	}
	if ($config['accept_county'] == 'Y' ||$config['accept_county'] == '1') { 
		$ret .=  '|||txtcounty|:|' . '<input name="txtcounty" type="text" class="textinput" size="30" maxlength="100" />';
	}
	if ($config['accept_city'] == 'Y' ||$config['accept_city'] == '1') { 
		$ret .= '|||txtcity|:|' . '<input name="txtcity" type="text" class="textinput" size="30" maxlength="100" />';
	}
	if ($config['accept_zipcode'] == 'Y' ||$config['accept_zipcode'] == '1') { 
		$ret .= '|||txtzip|:|' . '<input name="txtzip" type="text" class="textinput" size="30" maxlength="100" />';
	}
	echo utf8_encode($ret);
	$osDB->disconnect();
	exit;
}

switch (trim($_GET['a'])) {

	case 'country':
		$countrycode = isset($_GET['v'])?$_GET['v']:DEFAULT_COUNTRY;
		if ($config['accept_state'] == 'Y' or $config['accept_state'] =='1') {
			$ret .= '|||txtstateprovince|:|' . stateOptions($countrycode);
			if ($config['accept_county'] == 'Y' ||$config['accept_county'] == '1') { 
				$ret .=  '|||txtcounty|:|' . '<input name="txtcounty" type="text" class="textinput" size="30" maxlength="100" />';
			}
			if ($config['accept_city'] == 'Y' ||$config['accept_city'] == '1') { 
				$ret .= '|||txtcity|:|' . '<input name="txtcity" type="text" class="textinput" size="30" maxlength="100" />';
			}
			if ($config['accept_zipcode'] == 'Y' ||$config['accept_zipcode'] == '1') { 
				$ret .= '|||txtzip|:|' . '<input name="txtzip" type="text" class="textinput" size="30" maxlength="100" />';
			}
		} elseif ($config['accept_county'] == 'Y' || $config['accept_county'] =='1') {
			$ret .= '|||txtcounty|:|' . countyOptions($countrycode, 'AA');
			if ($config['accept_city'] == 'Y' ||$config['accept_city'] == '1') { 
				$ret .= '|||txtcity|:|' . '<input name="txtcity" type="text" class="textinput" size="30" maxlength="100" 	/>';
			}
			if ($config['accept_zipcode'] == 'Y' ||$config['accept_zipcode'] == '1') { 
				$ret .= '|||txtzip|:|' . '<input name="txtzip" type="text" class="textinput" size="30" maxlength="100" />';
			}
		} elseif ($config['accept_city'] == 'Y' ||$config['accept_city'] == '1') {
			$ret .=  '|||txtcity|:|' . cityOptions($countrycode, 'AA', 'AA');
			if ($config['accept_zipcode'] == 'Y' ||$config['accept_zipcode'] == '1') { 
				$ret .= '|||txtzip|:|' . '<input name="txtzip" type="text" class="textinput" size="30" maxlength="100" />';
			}
		} elseif ($config['accept_zipcode'] =='Y' || $config['accept_zipcode'] == '1') {
			$ret.= '|||txtzip|:|' . zipOptions($countrycode, 'AA', 'AA', 'AA');
		}
		break;

	case 'state':
		$statecode = $_GET['v'];
		$countrycode = $_GET['v1'];
		if ($config['accept_county'] == 'Y' || $config['accept_county'] =='1') {
			$ret .= '|||txtcounty|:|' . countyOptions($countrycode, $statecode);
			if ($config['accept_city'] == 'Y' || $config['accept_city'] == '1') { 
				$ret .= '|||txtcity|:|' . '<input name="txtcity" type="text" class="textinput" size="30" maxlength="100" 	/>';
			}
			if ($config['accept_zipcode'] == 'Y' ||$config['accept_zipcode'] == '1') { 
				$ret .= '|||txtzip|:|' . '<input name="txtzip" type="text" class="textinput" size="30" maxlength="100" />';
			}
		} elseif ($config['accept_city'] == 'Y' ||$config['accept_city'] == '1') {
			$ret .=  '|||txtcity|:|' . cityOptions($countrycode, $statecode, 'AA');
			if ($config['accept_zipcode'] == 'Y' ||$config['accept_zipcode'] == '1') { 
				$ret .= '|||txtzip|:|' . '<input name="txtzip" type="text" class="textinput" size="30" maxlength="100" />';
			}
		} elseif ($config['accept_zipcode'] =='Y' || $config['accept_zipcode'] == '1') {
			$ret.= '|||txtzip|:|' . zipOptions($countrycode, $statecode, 'AA', 'AA');
		}
		break;

	case 'county':
		$countycode = $_GET['v'];
		$statecode = isset($_GET['v2'])?$_GET['v2']:'AA';
		$countrycode = $_GET['v1'];
		if ($config['accept_city'] == 'Y' ||$config['accept_city'] == '1') {
			$ret .=  '|||txtcity|:|' . cityOptions($countrycode, $statecode, $countycode);
			if ($config['accept_zipcode'] == 'Y' ||$config['accept_zipcode'] == '1') { 
				$ret .= '|||txtzip|:|' . '<input name="txtzip" type="text" class="textinput" size="30" maxlength="100" />';
			}
		} elseif ($config['accept_zipcode'] =='Y' || $config['accept_zipcode'] == '1') {
			$ret.= '|||txtzip|:|' . zipOptions($countrycode, $statecode, $countycode, 'AA');
		}		
		break;

	case 'city':
		$citycode = $_GET['v'];
		$statecode = isset($_GET['v2'])?$_GET['v2']:'AA';
		$countrycode = $_GET['v1'];
		$countycode = isset($_GET['v3'])?$_GET['v3']:'AA';
		if ($config['accept_zipcode'] =='Y' || $config['accept_zipcode'] == '1') {
			$ret.= '|||txtzip|:|' . zipOptions($countrycode, $statecode, $countycode, $citycode);
		}		
		break;

	default : $ret = ''; break;
}

function stateOptions($countrycode) { 
	global $config;
	if ( ($config['accept_country'] == '1' || $config['accept_country'] == 'Y' )  && $countrycode == 'AA' )  {
		return '<input name="txtstateprovince" type="text" class="textinput" size="30" maxlength="100" />';
	}
	$data = getStates(trim($countrycode),'N');
	if (count($data) < 1 || (count($data) > 1 && $countrycode == 'AA' && ($config['accept_country'] == 'Y' || $config['accept_country'] == '1' ))) return '<input name="txtstateprovince" type="text" class="textinput" size="30" maxlength="100" />';
	if ($config['accept_county'] == 'Y' || $config['accept_county'] == '1') { 	
		$ret .= '	<select class="select" style="width: 175px" name="txtstateprovince" onchange="javascript: cascadeState(this.value,'."'".$countrycode."'".');" >';
	} elseif ($config['accept_city'] == '1' || $config['accept_city'] == 'Y')  {
		$ret .= '	<select class="select" style="width: 175px" name="txtstateprovince" onchange="javascript:  cascadeCounty(\'AA\','."'".$countrycode."'".',this.value);" >';
	} elseif ( $config['accept_zipcode'] =='1' || $config['accpet_zipcode'] =='Y') {
		$ret .= '	<select class="select" style="width: 175px" name="txtstateprovince" onchange="javascript:  cascadeCity(\'AA\','."'".$countrycode."'".',this.value,\'AA\');" >';
	}
	$ret .= '<option value="AA">'.get_lang('select_state').'</option>';

	foreach ($data as $k => $y){
		if ($k != 'AA') {
			$ret .= "<option value='$k'";
			if (isset($_SESSION['stateprovince']) && $_SESSION['stateprovince'] != '' && $k == $_SESSION['stateprovince']) {
				$ret.= " selected='selected' ";
			}
			$ret.=" >$y</option>";
		}
	}
	unset ($data);

	return $ret .= '</select>';
}

function countyOptions($countrycode, $statecode) {
	global $config;
	if (  ( ($config['accept_country'] == '1' || $config['accept_country'] == 'Y' ) && $countrycode == 'AA' ) || ( ($config['accept_state'] == '1' || $config['accept_state'] == 'Y' )  && $statecode == 'AA') ) {
		return '<input name="txtcounty" type="text" class="textinput" size="30" maxlength="100" />';
	}

	$data = getCounties(trim($countrycode),trim($statecode),'N');

	if (count($data) < 1 || (count($dta) > 1 && $statecode == 'AA' && ($config['accept_state'] == '1' || $config['accept_state'] == 'Y' )) ) return '<input name="txtcounty" type="text" class="textinput" size="30" maxlength="100" />';

	if ($config['accept_city'] == '1' || $config['accept_city'] == 'Y')  {
		$ret .= '	<select class="select" style="width: 175px" name="txtcounty" onchange="javascript:  cascadeCounty(this.value,'."'".$countrycode."'".','."'".$statecode."'".');" >';
	} elseif ( $config['accept_zipcode'] =='1' || $config['accpet_zipcode'] =='Y') {
		$ret .= '	<select class="select" style="width: 175px" name="txtcounty" onchange="javascript:  cascadeCity(\'AA\','."'".$countrycode."'".', '."'".$statecode."'".', this.value);" >';
	}

	$ret .= '<option value="AA">'.get_lang('select_county').'</option>';
	foreach ($data as $k => $y) {
		if ($k != 'AA') {
			$ret .= "<option value='$k' ";
			if (isset($_SESSION['countycode']) && $_SESSION['countycode'] != '' && $_SESSION['countycode'] == $k ) {
				$ret.= ' selected="selected" ';
			}
			$ret.=">$y</option>";
		}
	}
	unset ($data);

	return $ret .= '</select>';
}

function cityOptions($countrycode, $statecode, $countycode) {
	global $config;

	if (( ($config['accept_county'] == '1' || $config['accept_county'] == 'Y' ) && $countycode == 'AA') ||  ( ($config['accept_country'] == '1' || $config['accept_country'] == 'Y' ) && $countrycode == 'AA' ) || ( ($config['accept_state'] == '1' || $config['accept_state'] == 'Y' )  && $statecode == 'AA') ) {
		return '<input name="txtcity" type="text" class="textinput" size="30" maxlength="100" />';
	}
	
	$data = getCities(trim($countrycode),trim($statecode),trim($countycode),'N');

	if (count($data) < 1 || (count($data) > 1 && $countycode == 'AA' && ($config['accept_county'] == 'Y' || $config['accept_county'] == '1') ) ) return '<input name="txtcity" type="text" class="textinput" size="30" maxlength="100" />';

	if ($config['accept_zipcode'] =='1' || $config['accept_zipcode'] =='Y') {
		if ($countycode != 'AA') {
			$ret .= '	<select class="select" style="width: 175px" name="txtcity" onchange="javascript: cascadeCity(this.value,'."'".$countrycode."'".','."'".$statecode."'".','."'".$countycode."'".');" >';
		}else{
			$ret .= '	<select class="select" style="width: 175px" name="txtcity" onchange="javascript: cascadeCity(this.value,'."'".$countrycode."'".','."'".$statecode."'".',\'AA\');" >';
		}
	} else {
		$ret .= '	<select class="select" style="width: 175px" name="txtcity" >'; 		
	}	
	$ret .= '<option value="AA">'.get_lang('select_city').'</option>';

	foreach ($data as $k => $y) {
		if ($k != 'AA') {

			$ret .= "<option value='$k' ";
			if (isset($_SESSION['citycode']) && $_SESSION['citycode'] != '' && $_SESSION['citycode'] == $k ) {
				$ret.= ' selected="selected" ';
			}
			$ret.= " >$y</option>";
		}
	}
	unset ($data);

	return $ret .= '</select>';
}


function zipOptions($countrycode, $statecode, $countycode, $citycode) {
	global $config;
	if (( ($config['accept_county'] == '1' || $config['accept_county'] == 'Y' ) && $countycode == 'AA') ||  ( ($config['accept_country'] == '1' || $config['accept_country'] == 'Y' ) && $countrycode == 'AA' ) || ( ($config['accept_state'] == '1' || $config['accept_state'] == 'Y' ) && $statecode == 'AA') || ( ($config['accept_city'] == '1' || $config['accept_city'] == 'Y' ) && $lookcitycode == 'AA')) {	
		return '<input name="txtzip" type="text" class="textinput" size="30" maxlength="100" />';
	}
	
	$data = getZipcodes(trim($countrycode),trim($statecode),trim($countycode),trim($citycode),'N');

	if (count($data) < 1 || (count($data) > 1 && $citycode == 'AA' && ($config['accept_zipcode'] == '1' || $config['accept_zipcode'] == 'Y' ))) return '<input name="txtzip" type="text" class="textinput" size="30" maxlength="100" />';

	$ret = '	<select class="select" style="width: 175px" name="txtzip" >';

	foreach ($data as $k => $y) {
		$ret .= "<option value='$k' ";
		if (isset($_SESSION['zip']) && $_SESSION['zip'] != '' && $_SESSION['zip'] == $k ) {
			$ret.= ' selected="selected" ';
		}
		$ret.=" >$y</option>";
	}
	unset ($data);

	return $ret .= '</select>';
}

echo utf8_encode($ret);

unset($ret);

$osDB->disconnect();

?>
