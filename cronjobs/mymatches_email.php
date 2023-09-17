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


include_once( dirname(__FILE__).'/../minimum_init.php' );

/* Create user id list to exclude in this selection */
$str='';


if (!isset($_SESSION['mymatches_total_count']) ) {

	$exempts = $osDB->getAll('select userid, curdate() as dt1, from_unixtime(last_act_date) as dt2 from ! where choice_name = ? and (choice_value = 0 or choice_value = "" or ( (to_days(curdate())-to_days(from_unixtime(last_act_date))) <= choice_value and choice_value > 0 ) )', array(USER_CHOICES_TABLE, 'email_match_mail_days') );

	if (count($exempts) > 0) {

		$str = ' id not in (';

		$cnt=0;

		foreach ($exempts as $exempt) {
			if ($cnt > 0) $str .= ',';
			$str .= "'".$exempt['userid']."'";
			$cnt++;
		}

		$str.=') ';

	}


	/* get last user id to update all user records so that next select will be from this id onwards */

	$last_userid = $osDB->getOne('select max(id) from ! ',array(USER_TABLE));

	/* Get all users order by lastvisit */

	/* First get the count of users */


	if ($str != '') {
		$total_count = $osDB->getOne( 'SELECT count(*) FROM ! WHERE status = ? and ! ',array( USER_TABLE,  'active', $str) );
	} else {
		$total_count = $osDB->getOne( 'SELECT count(*) FROM ! WHERE status = ? ',array( USER_TABLE,'active' ) );
	}

	$_SESSION['mymatches_total_count'] = $total_count;
}

if (!isset($_SESSION['mymatches_start_count']) ) $_SESSION['mymatches_start_count'] = 0;

/* Now get profiles */

if ($str != '') {
	$users = $osDB->getAll( 'SELECT * FROM ! WHERE status = ? and ! order by lastvisit desc limit !,!',array( USER_TABLE,  'active', $str, $_SESSION['mymatches_start_count'], $config['mail_count']) );
} else {
	$users = $osDB->getAll( 'SELECT * FROM ! WHERE status = ? order by lastvisit desc  limit !,!',array( USER_TABLE,'active', $_SESSION['mymatches_start_count'], $config['mail_count'] ) );
}

if (!isset($users) || count($users) <= 0 ) {
	exit;
}

$mail_sub = get_lang('mymatches_sub');
$mail_body = get_lang('mymatches_body',MAIL_FORMAT);

foreach ($users as $k => $user) {
	echo("Processing user: ".$user['username']."<br />");
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

	/* Now get the last userid of last email for this user */
	$prev_lastid = $osDB->getOne('select last_act_value from ! where userid = ? and choice_name = ?', array(USER_CHOICES_TABLE, $user['id'], 'email_match_mail_days') );

	if (!isset($prev_lastid) || $prev_lastid == '') $prev_lastid = 0;

	/* Now do the search to select matching records. But include the condition of id > $prev_lastid */
	$radius = $user['lookradius'];

	$radiustype = $user['radiustype'];

	$zipcodes_in = "";

	/* Check for zip code proximity search */
	if ($user['lookzip'] != '' && isset($radius) && $radius > 0) {

		$ziprow = $osDB->getRow('select * from ! where code=?  and countrycode=?',array(ZIPCODES_TABLE, $user['lookzip'], $user['lookcountry'] ) );

		$lat = $ziprow['latitude'];
		$lng = $ziprow['longitude'];

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
    $bannedusers = $osDB->getAll('select bdy.ref_userid from ! as bdy where bdy.act=? and bdy.userid = ? union select bdy1.userid as ref_userid from ! as bdy1 where bdy1.act=? and bdy1.ref_userid = ?', array(BUDDY_BAN_TABLE,  'B', $user['id'], BUDDY_BAN_TABLE,  'B', $user['id'] ) );
	$rcount = $osDB->getOne('select FOUND_ROWS()');
	if ($rcount > 0) {
		$bannedlist=' and user.id not in (';
		$bdylst = '';
		foreach ($bannedusers as $busr) {
			if ($bdylst != '') $bdylst .= ',';
			$bdylst .= "'".$busr['ref_userid']."'";
		}
		unset($bannedusers);
		$bannedlist .=$bdylst.') ';
	}

	$sqlSelect = 'SELECT user.*, floor((to_days(curdate())-to_days(birth_date))/365.25)  as age';

	$sqlFrom = ' FROM ! user, ! mem ';

	$sqlWhere = ' WHERE user.id > ?  AND mem.roleid=user.level and mem.includeinsearch=1 ';

	$sqlWhere .= $bannedlist;

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

	$sqlWhere .= ' AND user.status in (\'active\',\' '.get_lang('status_enum','active')."') " . $txtlookgender_search . $txtgender_search;

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

	$sqlWhere .= " AND birth_date BETWEEN '"
		. $yearstart. "' AND '" . $yearend ."' ";

	$sql = $sqlSelect . $sqlFrom . $sqlWhere;

	$data = $osDB->getAll ( $sql, array( USER_TABLE, MEMBERSHIP_TABLE, $prev_lastid ) );

	/* Now create html portion which displays 2 profiles side by side */
	$cnt = 0;
	$profs = '<table border=0 cellspacing=1 cellpadding=2 width="100%">';

	$matched_id = '0';

	foreach ($data as $row) {

		/* Store highest matched ID to update the choice record to use for next time email generation */
		if ($matched_id < $row['id']) $matched_id = $row['id'];

		$row['countryname'] = $osDB->getOne('select name from ! where code = ?', array( COUNTRIES_TABLE, $row['country'] ) );

		$row['statename'] = $osDB->getOne('select name from ! where code = ? and countrycode = ?', array( STATES_TABLE, $row['state_province'], $row['country'] ) );

		$row['statename'] = ($row['statename'] != '') ? $row['statename'] : $row['state_province'];

		$t->assign('item',$row);

		$prof = $t->fetch('profile_for_html_mail.tpl');

		if ($cnt == 0) {
			$profs .= '<tr>';
		}
		$profs.= '<td width="49%">'.$prof.'</td>';
		$cnt++;
		if ($cnt == 2) {
			$cnt = 0;
			$profs.="</tr>";
		}
	}
	if ($cnt == 1) $profs.='<td width="49%"></td></tr>';
	$profs.="</table>";

	if ($matched_id > 0) {
		/* There are some matches. Send email */
		/* Now we are ready with details of matched profiles. Prepare email and send */

		$From= $config['admin_email'];

		$To = $user['email'];

		$message = $mail_body;

		$message = str_replace('#FirstName#', $user['firstname'] ,$message);

		$message = str_replace('#matchedProfiles#', $profs, $message);

		/* Don't bombard mail server. Wait for some time */
		mailSender($From, $To, $user['email'], $mail_sub, $message);

		sleep(2);

	}
	/* Now that mail is sent, let us update the user choice record */

	/* Check if there is already a record for this user. If not, create a record with default days = 7 */

	$recno = $osDB->getOne('select id from ! where userid = ? and choice_name = ?', array(USER_CHOICES_TABLE, $user['id'],  'email_match_mail_days') );

	if ($recno > 0) {
		$osDB->query('update ! set last_act_date = ?, last_act_value = ? where userid = ? and choice_name = ?', array(USER_CHOICES_TABLE, time(), $matched_id, $user['id'],  'email_match_mail_days'));
	} else {
		$osDB->query('insert into ! (userid, choice_name, choice_value, last_act_date, last_act_value) values (?,?,?,?,?)', array( USER_CHOICES_TABLE, $user['id'],  'email_match_mail_days', '7', time(), $matched_id) );
	}
}

$_SESSION['mymatches_start_count'] = $_SESSION['mymatches_start_count']+$config['mail_count'];
if ($_SESSION['mymatches_start_count'] < $_SESSION['mymatches_total_count'] ) {
	header($_SERVER['PHP_SELF']);
}
?>