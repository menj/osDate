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
	include_once( '../init.php' );
}

include ( 'sessioninc.php' );

$glblgroup = 1;
if (isset($_REQUEST['glblgroup']) && $_REQUEST['glblgroup']!='') {
	$glblgroup = $_REQUEST['glblgroup'];
} else if (isset($_REQUEST['txtglblgroup']) && $_REQUEST['txtglblgroup']!='') {
	$glblgroup = $_REQUEST['txtglblgroup'];
}

define( 'PAGE_ID', 'global_mgt' );

if ( !checkAdminPermission( PAGE_ID ) ) {

	header( 'location: not_authorize.php' );
	exit;
}

$mships = $osDB->getAll('select roleid, name from ! ', array(MEMBERSHIP_TABLE) );

$memberships = array();

foreach ($mships as $row ) {
	$memberships[$row['roleid']] = $row['name'];
}

$t->assign('memberships', $memberships);

unset($mships, $memberships);

if ( isset($_POST['frm']) && $_POST['frm'] == 'frmEditConfig' ) {

	if  ($_POST['txtconfigvariable'] == 'SMTP_AUTH') {
		if ($_POST['txtconfigvalue'] == 'Y') {
			$_POST['txtconfigvalue']= '1';
		} else {
			$_POST['txtconfigvalue']='0';
		}
	}
	$osDB->query( 'UPDATE ! SET config_value = ?, update_time=? WHERE config_variable = ?', array( CONFIG_TABLE, trim( $_POST['txtconfigvalue'] ), time(), trim( $_POST['txtconfigvariable'] ) ) );

	if ($_POST['txtconfigvariable'] == 'skin_name' || $_POST['txtconfigvariable'] == 'site_name') {

		/* Change in template. Copy the files to the curent directory */

		/* Remove files from templates_c directory */
		if ( $handle = opendir( TEMPLATE_C_DIR ) ) {
			while ( false !== ( $file = readdir( $handle ) ) ) {
				if ( $file != '.' && $file != '..' && $file != 'index.html' && $file != 'index.htm') {
					unlink( TEMPLATE_C_DIR . $file );
				}
			}
			closedir($handle);

		}
		/* Remove cache files */
		if ( $handle = opendir( CACHE_DIR ) ) {
			while ( false !== ( $file = readdir( $handle ) ) ) {
				if ( $file != '.' && $file != '..' && $file != 'index.html' && $file != 'index.htm' && !is_dir($file) ) {
					unlink( CACHE_DIR . $file );
				}
			}
			closedir($handle);
		}
	} elseif ($_POST['txtconfigvariable'] == 'watermark_snaps' || $_POST['txtconfigvariable'] == 'watermark_image' || $_POST['txtconfigvariable'] == 'watermark_image_intensity' || $_POST['txtconfigvariable'] == 'watermark_position_h' || $_POST['txtconfigvariable'] == 'watermark_position_v' ||$_POST['txtconfigvariable'] == 'watermark_margin' || $_POST['txtconfigvariable'] == 'watermark_text_shadow' || $_POST['txtconfigvariable'] == 'watermark_text_color')
	{
		if ( $handle = opendir( USER_IMAGE_CACHE_DIR ) ) {
			while ( false !== ( $file = readdir( $handle ) ) ) {
				if ( $file != '.' && $file != '..' && $file != 'index.html' && $file != 'index.htm' ) {
					unlink( USER_IMAGE_CACHE_DIR . $file );
				}
			}
			closedir($handle);
		}
	} elseif ($_POST['txtconfigvariable'] == 'forum_installed') {

		$osDB->query( 'UPDATE ! SET config_value = ?, update_time=? WHERE config_variable = ?', array( CONFIG_TABLE, 'None', time(), 'forum_path' ) );

	}
	header( 'location: editgblsettings.php?glblgroup='.$glblgroup) ;
	exit;
}

$rs = $osDB->getAll( 'SELECT config_variable, config_value, description, groupid FROM ! WHERE config_variable not in ( ?, ?)  and groupid = ?', array( CONFIG_TABLE, 'enable_mod_rewrite','seo_username',  $glblgroup ) );

$confdata = array();

$t->assign('glblgroups', get_lang_values('glblsettings_groups'));

$t->assign('glblgroup', $glblgroup);

foreach ( $rs as $row ) {
	$row['config_value'] = htmlspecialchars( $row['config_value'] );
	$confdata[] = $row;
}

$t->assign ( 'confdata', $confdata );

unset($rs, $confdata);

$temp_dirs = array();

if ( $handle = opendir( TEMPLATE_DIR ) ) {

    while (false !== ( $file = readdir( $handle ) ) ) {

		if ( $file != '.' && $file != '..'  && $file != 'pages' && $file != 'install') {

			if ( is_dir( TEMPLATE_DIR . $file ) ) {

				$temp_dirs[$file] = $file;

			}
		}
    }

    closedir($handle);
}

asort($temp_dirs);
reset($temp_dirs);

$t->assign ( 'template_dirs', $temp_dirs );

unset($temp_dirs);

$t->assign('lang', $lang);

$t->assign('rendered_page', $t->fetch('admin/editgblsettings.tpl'));

$t->display( 'admin/index.tpl' );

$osDB->disconnect();
?>