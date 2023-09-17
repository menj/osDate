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

$userid = $_SESSION['UserId'];

$modified['lookgender'] = $lookgender = (isset($_POST[ 'txtlookgender' ])? $_POST[ 'txtlookgender' ]:'');

$modified['lookagestart'] = $lookagestart = (isset($_POST[ 'txtlookagestart' ])? $_POST[ 'txtlookagestart' ]:'');

$modified['lookageend'] = $lookageend = (isset($_POST[ 'txtlookageend' ])? $_POST[ 'txtlookageend' ]:'');

$modified['lookcountry'] = $lookfrom = (isset($_POST[ 'txtlookfrom' ])?$_POST[ 'txtlookfrom' ]:'');

$modified['lookcounty'] = $lookcounty = (isset($_POST[ 'txtlookcounty' ])? addslashes(strip_tags($_POST[ 'txtlookcounty' ])):'');

$modified['lookcity'] = $lookcity = (isset($_POST[ 'txtlookcity' ])? addslashes(strip_tags(trim($_POST[ 'txtlookcity' ]))):'');

$modified['lookstate_province'] = $lookstateprovince = (isset($_POST[ 'txtlookstateprovince' ])? addslashes(strip_tags(trim($_POST[ 'txtlookstateprovince' ]))):'');

$modified['lookzip'] = $lookzip = (isset($_POST[ 'txtlookzip' ])? addslashes(strip_tags(trim($_POST[ 'txtlookzip' ]))):'');

$modified['lookradius'] = $lookradius = (isset($_POST['lookradius'])? addslashes(strip_tags(trim($_POST[ 'lookradius' ]))):'');

$modified['radiustype'] = $radiustype = (isset($_POST[ 'radiustype' ])? trim($_POST[ 'radiustype' ]):'');

$err =0;

if ( $lookageend < $lookagestart && ($config['accept_lookage'] == 'Y' or $config['accept_lookage'] == "1") ) {

	$err = BIGGER_STARTAGE;

} 

$_SESSION['modifiedrow'] = $modified;

if (  $err != 0 ) {

	header ( "location: editmymatches.php?errid=$err" );

	exit();

}

$osDB->query( "UPDATE ! SET
					lookgender 			= ?,
					lookagestart 		= ?,
					lookageend 			= ?,
					lookcountry 		= ?,
					lookzip				= ?,
					lookcity 			= ?,
					lookcounty 			= ?,
					lookstate_province 	= ?,
					lookradius			= ?,
					radiustype			= ?
					WHERE id=?", array( USER_TABLE, $lookgender, $lookagestart, $lookageend, $lookfrom, $lookzip, $lookcity, $lookcounty, $lookstateprovince, $lookradius, $radiustype, $userid ) );

unset($_SESSION['modifiedrow'] );

header( 'location: editmymatches.php');
?>