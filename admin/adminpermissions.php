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

define( 'PAGE_ID', 'admin_permit_mgt' );

if ( !checkAdminPermission( PAGE_ID ) ) {

	header( 'location: not_authorize.php' );
	exit;
}

$mid = 0;

if (isset( $_POST['modify'] ) ) {

	$site_stats 		= (isset($_POST['site_stats']) && $_POST['site_stats'] == 'on') ? 1 : 0;
	$profie_approval	= (isset($_POST['profie_approval']) && $_POST['profie_approval'] == 'on') ? 1 : 0;
	$profile_mgt 		= (isset($_POST['profile_mgt']) && $_POST['profile_mgt'] == 'on' )? 1 : 0;
	$section_mgt 		= (isset($_POST['section_mgt']) && $_POST['section_mgt'] == 'on') ? 1 : 0;
	$affiliate_mgt 		= (isset($_POST['affiliate_mgt'] ) && $_POST['affiliate_mgt'] == 'on') ? 1 : 0;
	$affiliate_stats 	= (isset($_POST['affiliate_stats']) && $_POST['affiliate_stats'] == 'on') ? 1 : 0;
	$news_mgt 			= (isset($_POST['news_mgt']) && $_POST['news_mgt'] == 'on') ? 1 : 0;
	$article_mgt 		= (isset($_POST['article_mgt'] ) && $_POST['article_mgt'] == 'on') ? 1 : 0;
	$story_mgt			= (isset($_POST['story_mgt'] ) && $_POST['story_mgt']== 'on') ? 1 : 0;
	$poll_mgt		 	= (isset($_POST['poll_mgt']) && $_POST['poll_mgt'] == 'on') ? 1 : 0;
	$search 			= (isset($_POST['search']) && $_POST['search'] == 'on') ? 1 : 0;
	$ext_search			= (isset($_POST['ext_search']) && $_POST['ext_search'] == 'on') ? 1 : 0;
	$send_letter 		= (isset($_POST['send_letter'] ) && $_POST['send_letter'] == 'on') ? 1 : 0;
	$pages_mgt 			= (isset($_POST['pages_mgt']) && $_POST['pages_mgt'] == 'on') ? 1 : 0;
	$chat 				= (isset($_POST['chat']) && $_POST['chat'] == 'on') ? 1 : 0;
	$chat_mgt 			= (isset($_POST['chat_mgt']) && $_POST['chat_mgt'] == 'on') ? 1 : 0;
	$forum_mgt 			= (isset($_POST['forum_mgt']) && $_POST['forum_mgt'] == 'on') ? 1 : 0;
	$blog_mgt 			= (isset($_POST['blog_mgt']) && $_POST['blog_mgt'] == 'on' )? 1 : 0;
	$mship_mgt 			= (isset($_POST['mship_mgt']) && $_POST['mship_mgt'] == 'on') ? 1 : 0;
	$payment_mgt 		= (isset($_POST['payment_mgt']) && $_POST['payment_mgt'] == 'on') ? 1 : 0;
	$banner_mgt 		= (isset($_POST['banner_mgt']) && $_POST['banner_mgt'] == 'on') ? 1 : 0;
	$seo_mgt			= (isset($_POST['seo_mgt'] ) && $_POST['seo_mgt']== 'on') ? 1 : 0;
	$admin_mgt 			= (isset($_POST['admin_mgt'] ) && $_POST['admin_mgt']== 'on') ? 1 : 0;
	$admin_permit_mgt	= (isset($_POST['admin_permit_mgt']) && $_POST['admin_permit_mgt'] == 'on') ? 1 : 0;
	$global_mgt 		= (isset($_POST['global_mgt']) && $_POST['global_mgt'] == 'on' )? 1 : 0;
	$change_pwd 		= (isset($_POST['change_pwd']) && $_POST['change_pwd'] == 'on') ? 1 : 0;
	$cntry_mgt 			= (isset($_POST['cntry_mgt']) && $_POST['cntry_mgt'] == 'on' )? 1 : 0;
	$snaps_require_approval = (isset($_POST['snaps_require_approval']) && $_POST['snaps_require_approval'] == 'on' )? 1 : 0;
	$featured_profiles_mgt = (isset($_POST['featured_profiles_mgt']) && $_POST['featured_profiles_mgt'] == 'on') ? 1 : 0;
	$calendar_mgt 			= (isset($_POST['calendar_mgt'] ) && $_POST['calendar_mgt']== 'on' )? 1 : 0;
	$event_mgt 				= (isset($_POST['event_mgt']) && $_POST['event_mgt'] == 'on') ? 1 : 0;
	$import_mgt 				= (isset($_POST['import_mgt']) && $_POST['import_mgt'] == 'on') ? 1 : 0;
    $plugin_mgt             = (isset($_POST['plugin_mgt'] ) && $_POST['plugin_mgt'] == 'on') ? 1 : 0;
	$promo_mgt 				= (isset($_POST['promo_mgt']) && $_POST['promo_mgt'] == 'on') ? 1 : 0;
	/* MOD START */

	$profile_ratings = (isset($_POST['profile_ratings'])&&$_POST['profile_ratings'] == 'on' )? 1 : 0;

	$mid = isset($_POST['adminid'])?$_POST['adminid']:'';

	$osDB->query(  "UPDATE ! set
		site_stats 			= $site_stats,
		profie_approval	 	= $profie_approval,
		profile_mgt 		= $profile_mgt,
		section_mgt 		= $section_mgt,
		affiliate_mgt 		= $affiliate_mgt,
		affiliate_stats 	= $affiliate_stats,
		news_mgt 			= $news_mgt,
		article_mgt 		= $article_mgt,
		story_mgt			= $story_mgt,
		poll_mgt		 	= $poll_mgt,
		search 				= $search,
		ext_search			= $ext_search,
		send_letter 		= $send_letter,
		pages_mgt 			= $pages_mgt,
		chat 				= $chat,
		chat_mgt 			= $chat_mgt,
		forum_mgt 			= $forum_mgt,
		blog_mgt 			= $blog_mgt,
		mship_mgt 			= $mship_mgt,
		payment_mgt 		= $payment_mgt,
		banner_mgt 			= $banner_mgt,
		seo_mgt				= $seo_mgt,
		admin_mgt 			= $admin_mgt,
		admin_permit_mgt	= $admin_permit_mgt,
		global_mgt 			= $global_mgt,
		change_pwd 			= $change_pwd,
		cntry_mgt 			= $cntry_mgt,
		snaps_require_approval = $snaps_require_approval,
		featured_profiles_mgt = $featured_profiles_mgt,
		calendar_mgt 		= $calendar_mgt,
		event_mgt 		= $event_mgt,
		profile_ratings = $profile_ratings,
		import_mgt 		= $import_mgt,
      plugin_mgt     = $plugin_mgt,
      promo_mgt     = $promo_mgt
	WHERE adminid = ? AND id = ?", array( ADMIN_RIGHTS_TABLE, $_POST['adminid'], $_POST['id'] ) );
}

if ( isset($_POST['adminid']) && $_POST['adminid']!='' ) {

	$mid = $_POST['adminid'];

} else {
	$mid = $osDB->getOne( 'SELECT id FROM !  ORDER BY id ', array( ADMIN_TABLE) );
}

$t->assign( 'data',$osDB->getRow( 'SELECT * FROM ! WHERE adminid = ?', array( ADMIN_RIGHTS_TABLE, $mid ) ) );

$data = array();

$temp = $osDB->getAll( 'select id, username from !  order by id', array( ADMIN_TABLE ) );

foreach( $temp as $index => $row ) {
	$data[ $row['id'] ] = $row['username'];
}

$t->assign('rights',get_lang_values('admin_rights'));

$t->assign( 'admins', $data );

$t->assign("admin_name", $data[$mid]);

unset($data, $temp);

$t->assign('rendered_page', $t->fetch('admin/adminpermissions.tpl'));

$t->display( 'admin/index.tpl' );
?>