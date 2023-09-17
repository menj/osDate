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

/*
	This is new aedating import process

	Vijay Nair

	This will delete all users from osDate user table. Ensure you have taken backup before proceeding

	Do following steps first:

	a) Modify aedating_imp_conf.php file with correct values for

		aedate DB Details
		aedate snaps folder
		aedate profiles table name (with any prefix if used)
		osDate membership level relationship with aedate membership levels

	b) After taking backup of following tables in osDate, empty these tables
		osdate_user
		osdate_user_snaps
		osdate_buddy_ban_list

	c) Delete all image files from /userimages folder of osDate.

*/

define( 'IMPORT_MODULE', "aedating" );

define( 'PAGE_ID', 'admin_mgt' );

include_once( '../init.php' );

include ( 'sessioninc.php' );

include ("aedating_imp_conf.php");

include (INC_DIR."internal/snaps_functions.php");

$dsn2 = 'mysql://' . $aedate_DB_USER . ':' . $aedate_DB_PASS . '@' . $aedate_DB_HOST . '/' . $aedate_DB_NAME;

require_once PEAR_DIR . 'DB.php';

$DB_options = array('persistent' => TRUE );
$DB = @DB::connect( $dsn2, $DB_options );
if (PEAR::isError($DB)) {
	die($DB->getMessage());
}
$DB->setFetchMode( DB_FETCHMODE_ASSOC );

$step = ($_GET['step']>0)?$_GET['step']:0;

$t->assign('page_hdr02_text', $imp_hdr[$step]);

switch ($step){

	case '1':
		/* Now work on User table */

		/* Now select countries from osDate DB and keep in array */
		$allCountries = $osDB->getAll('select name, code from ! order by name',array(COUNTRIES_TABLE) );
		$countries_list = array();
		foreach ($allCountries as $rec) {
			$countries_list[strtolower($rec['name'])] = $rec['code'];
		}

		/* Now select user data from aedating table and process. However use batching of 100 users at one time */

		$ord = ' order by id ';

		$sql = 'select ID, NickName, password, RealName, RealName2, LastReg,  Country, DescriptionMe, sex, DateOfBirth, Email, Status, LookingFor, LookingAge, picture, Pic_0_addon, Pic_1_addon, Pic_2_addon, Pic_3_addon, Pic_4_addon, Pic_5_addon, Pic_6_addon, Pic_7_addon, Pic_8_addon, Pic_9_addon, Zip, mem_level, mem_level_days, Featured  from ! ';

		if ($_SESSION['aedate_last_user_id'] != '') {
			$sql .= ' where id > '.$_SESSION['aedate_last_user_id'];
		}

		$sql .= $ord.' limit 25';

		$aedate_users = $DB->getAll($sql,array($profiles_table));
		if (count($aedate_users) > 0) {
			foreach ($aedate_users as $aed_user) {
				/* Get osDate country code */
				$countrycode = $countries_list[strtolower($aedate_countries[$aed_user['Country']])];
				if ($countrycode=='') {
					$countrycode='US'; /* Default US */
				}

				/* Now convert the loogage range to lookagestart and lookageend fields */
				list($lookagestart, $lookageend) = explode('-',$aed_user['LookingAge']);
				if ($lookagestart == '') $lookagestart='18';
				if ($lookageend == '') $lookageend='90';

				/* Convert LastReg date into number format of osDate */
				$regdate = strtotime($aed_user['LastReg']);

				/* Compute level_end using mem_level_days */
				$mem_level_days = $aed_user['mem_level_days'];
				$level_end = time()+($mem_level_days*60*60*24);

				/* Compute active flag  */
				$active = ($aed_user['Status']=='Active')?'1':'0';
				if ($active == '1') {
					$confirmed = 'Confirmed';
				} else {
					$confirmed = 'Pend';
				}

				/* Now create insert sql for osDate user table */
				$inssql = 'insert into ! (id, username, password, firstname, lastname,  level, active, email, country, actkey, gender, lookgender, lookagestart, lookageend, zip, birth_date, about_me, status, levelend, regdate) values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)';

				$result=$osDB->query($inssql, array(USER_TABLE, $aed_user['ID'], $aed_user['NickName'], md5($aed_user['password']), $aed_user['RealName'], $aed_user['RealName2'], $memlevel[$aed_user['mem_level']], $active, $aed_user['Email'], $countrycode, $confirmed, $genders[$aed_user['sex']], $lookgenders[$aed_user['LookingFor']], $lookagestart, $lookageend, $aed_user['Zip'], $aed_user['DateOfBirth'], $aed_user['DescriptionMe'], $status[$aed_user['Status']], $level_end, $regdate) );

				$_SESSION['aedate_last_user_id'] = $aed_user['ID'];

				/* OK. now process the pictures loaded. */
				$pics = 0;

				if ($aed_user['Pic_0_addon'] != '') {
					$snap_file = $aed_user['ID']."_0_".$aed_user['Pic_0_addon'].'.jpg';
					imgCreate($snap_file,'1');
				}
				if ($aed_user['Pic_1_addon'] != '') {
					$snap_file = $aed_user['ID']."_1_".$aed_user['Pic_1_addon'].'.jpg';
					imgCreate($snap_file,'2');
				}
				if ($aed_user['Pic_2_addon'] != '') {
					$snap_file = $aed_user['ID']."_2_".$aed_user['Pic_2_addon'].'.jpg';
					imgCreate($snap_file,'3');
				}
				if ($aed_user['Pic_3_addon'] != '') {
					$snap_file = $aed_user['ID']."_3_".$aed_user['Pic_3_addon'].'.jpg';
					imgCreate($snap_file,'4');
				}
				if ($aed_user['Pic_4_addon'] != '') {
					$snap_file = $aed_user['ID']."_4_".$aed_user['Pic_4_addon'].'.jpg';
					imgCreate($snap_file,'5');
				}
				if ($aed_user['Pic_5_addon'] != '') {
					$snap_file = $aed_user['ID']."_5_".$aed_user['Pic_5_addon'].'.jpg';
					imgCreate($snap_file,'6');
				}
				if ($aed_user['Pic_6_addon'] != '') {
					$snap_file = $aed_user['ID']."_6_".$aed_user['Pic_6_addon'].'.jpg';
					imgCreate($snap_file,'7');
				}
				if ($aed_user['Pic_7_addon'] != '') {
					$snap_file = $aed_user['ID']."_7_".$aed_user['Pic_7_addon'].'.jpg';
					imgCreate($snap_file,'8');
				}
				if ($aed_user['Pic_8_addon'] != '') {
					$snap_file = $aed_user['ID']."_8_".$aed_user['Pic_8_addon'].'.jpg';
					imgCreate($snap_file,'9');
				}
				if ($aed_user['Pic_9_addon'] != '') {
					$snap_file = $aed_user['ID']."_9_".$aed_user['Pic_9_addon'].'.jpg';
					imgCreate($snap_file,'10');
				}

				/* Update user record with number of pictures transferred */
				if ($pics > 0) {
					$osDB->query('update ! set pictures_cnt=? where id=?',array(USER_TABLE, $pics,$aed_user['ID']) );
				}

				if ($aed_user['Featured'] > 0) {
				/* Add this user to Featured Profiles list in osDate with 90 days validity */
					$osDB->query('insert into ! (userid, start_date, end_date, must_show, req_exposures) values (?, ?, ?, ?, ?)', array(FEATURED_PROFILES_TABLE, $aed_user['ID'], time(), time()+(90*60*60*24), 'N', '10000') );
				}

				echo("osDate user record created for aedate user id <b>".$aed_user['ID']."</b><br />");
				flush();
				sleep(1);
			}

			echo('<meta http-equiv=refresh content=0;url='.DOC_ROOT.'admin/aedating_imp.php?step='.$step.'>');
			flush();
			exit();
		} else {
			$step=2;
			parent.header('location: aedating_imp.php?step=2');
			exit();
		}
		break;

	case '2':
	/* Transfer Block list */
		$start=0;
		if ($_SESSION['blocklist_start'] > 0) {$start = $_SESSION['blocklist_start']; }
		$blockList = $DB->getAll('select ID, Profile from ! limit !, 3', array($blocklist_table,$start) );
		$recs=count($blockList);
		if ($recs > 0) {
			echo("Transferring Block list - $recs records <br />");
			$_SESSION['blocklist_start'] = $start + $recs;
			$act_date = strtotime(date('Y-m-d'));
			foreach($blockList as $rec) {
				$ref_username = getUserName($rec['Profile']);
				if ($ref_username != '') {
					$osDB->query('insert into ! (username, ref_username, act, act_date) values (?, ?, ?, ?)', array(BUDDY_BAN_TABLE, getUserName($rec['ID']), $ref_username, 'B', $act_date) );
				}
			}
			sleep(1);
			echo('<meta http-equiv=refresh content=0;url='.DOC_ROOT.'admin/aedating_imp.php?step='.$step.'>');
			flush();
			exit();
		} else {
			$step=3;
			parent.header('location: aedating_imp.php?step=3');
			exit();
		}
		break;
	case '3':
	/* Transfer Friends list */
		$start=0;
		if ($_SESSION['friendlist_start'] > 0) {$start = $_SESSION['friendlist_start']; }
		$friendList = $DB->getAll('select ID, Profile from ! limit !, 2', array($friendlist_table,$start) );

		$recs=count($friendList);
		if ($recs > 0) {
			echo("Transferring Friends list - $recs records <br />");
			$_SESSION['friendlist_start'] = $start + $recs;
			$act_date = strtotime(date('Y-m-d'));
			foreach($friendList as $rec) {
				$ref_username = getUserName($rec['Profile']);
				if ($ref_username != '') {
					$osDB->query('insert into ! (username, ref_username, act, act_date) values (?, ?, ?, ?)', array(BUDDY_BAN_TABLE, getUserName($rec['ID']), $ref_username, 'F', $act_date) );
				}
			}
			sleep(1);
			echo('<meta http-equiv=refresh content=0;url='.DOC_ROOT.'admin/aedating_imp.php?step='.$step.'>');
			flush();
			exit();
		} else {
			$step=4;
			parent.header('location: aedating_imp.php?step=4');
			exit();
		}
		break;

	case '4':
	/* Transfer Hot list */
		$start=0;
		if ($_SESSION['hotlist_start'] > 0) {$start = $_SESSION['hotlist_start']; }
		$hotList = $DB->getAll('select ID, Profile from ! limit !, 2', array($hotlist_table,$start) );

		$recs=count($hotList);
		if ($recs > 0) {
			echo("Transferring Hot list - $recs records <br />");
			$_SESSION['hotlist_start'] = $start + $recs;
			$act_date = strtotime(date('Y-m-d'));
			foreach($hotList as $rec) {
				$ref_username = getUserName($rec['Profile']);
				if ($ref_username != '') {
					$osDB->query('insert into ! (username, ref_username, act, act_date) values (?, ?, ?, ?)', array(BUDDY_BAN_TABLE, getUserName($rec['ID']), $ref_username, 'H', $act_date) );
				}
			}
			sleep(1);
			if ($recs == 2) {
				echo('<meta http-equiv=refresh content=0;url='.DOC_ROOT.'admin/aedating_imp.php?step='.$step.'>');
				flush();
				exit();
			} else {
				$step=5;
				parent.header('location: aedating_imp.php?step=5');
				exit();
			}
		} else {
			$step=5;
			parent.header('location: aedating_imp.php?step=5');
			exit();
		}
		break;

	default:
		$step=1;
		$t->assign('step',$step);
}

$t->assign('page_hdr02_text', $imp_hdr[$step]);

$t->display('admin/aedate_imp.tpl');


function imgCreate($snap_file, $m) {
	global $osDB, $pics, $aed_user, $aedate_USER_PICS_DIR;
	$snap_file = FULL_PATH.$aedate_USER_PICS_DIR.'/'.$snap_file;
	if (file_exists($snap_file) ) {

		$img =createImg('jpg',$snap_file);

		/* Now create main jpg and tn images */
		$jpgfile = createJpeg($img, 'N');
		$newimg = file_get_contents($jpgfile);
		$img =createImg('jpg',$snap_file);
		$tnfile = createJpeg($img, 'Y');
		$tnimg = file_get_contents($tnfile);

		/* Create Image and TN img files in USER_IMAGES folder of osDate */
		$tnimgfile = writeImageToFile($tnimg, $aed_user['ID'], '2'.$m);
		$tnimg = 'file:'.$tnimgfile;
		$imgfile = writeImageToFile($newimg, $aed_user['ID'], '1'.$m);
		$newimg = 'file:'.$imgfile;

		/* Now add this picture recrod in osDate USER_SNAPS table */
		$osDB->query( 'insert into ! (  userid, picno, picture, ins_time, active, picext, tnpicture, tnext, album_id, default_pic ) values (  ?, ?, ?, ?, ?, ?, ?, ?, ?, ? )', array( USER_SNAP_TABLE, $aed_user['ID'], $m, $newimg, time(), 'Y', 'jpg', $tnimg, 'jpg', '0', 'N' ) );

		/* Compute number of pictures loaded */
		$pics++;
	}
}

function getUserName($id) {
	global $osDB;
	$username = $osDB->getOne('select username from ! where id=?', array(USER_TABLE,$id));
	return $username;
}
?>