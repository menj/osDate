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

define( 'PAGE_ID', 'seo_mgt' );

if ( !checkAdminPermission( PAGE_ID ) ) {

	header( 'location: not_authorize.php' );
	exit;
}


$t->assign ( 'lang', $lang );

$sql = 'SELECT config_value FROM ! WHERE config_variable = ?';

$t->assign( 'site_title', $osDB->getOne( $sql, array( CONFIG_TABLE, 'site_title' ) ) );

$t->assign( 'meta_description', $osDB->getOne( $sql, array( CONFIG_TABLE, 'meta_description' ) ) );

$t->assign( 'meta_keywords', $osDB->getOne( $sql, array( CONFIG_TABLE, 'meta_keywords' ) ) );

$t->assign( 'enable_mod_rewrite', $osDB->getOne( $sql, array( CONFIG_TABLE, 'enable_mod_rewrite' ) ) );

$t->assign( 'seo_username', $osDB->getOne( $sql, array( CONFIG_TABLE, 'seo_username' ) ) );

$t->assign('rendered_page', $t->fetch('admin/seo.tpl'));

$t->display ( 'admin/index.tpl' );

?>