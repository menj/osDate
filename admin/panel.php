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

$now = time();

//phew the hard part is over back to the easy stuff....

$memberships = $osDB->getAll('select roleid, name from ! order by roleid', array(MEMBERSHIP_TABLE) );

$membership_stats = array();

foreach ($memberships as $mem) {
	$mem['level_count'] = $osDB->getOne ( 'SELECT count(*) FROM ! WHERE level = ?', array( USER_TABLE, $mem['roleid'] ) );
	$membership_stats[] = $mem;
}

$t->assign('membership_stats', $membership_stats);

unset($memberships, $membership_stats);

$t->assign ( 'change_pwd' , $osDB->getOne( 'SELECT count(*)  FROM ! WHERE id = ? AND password = ?', array(ADMIN_TABLE, $_SESSION['AdminId'], md5('pass') ) ) );

$sql = 'SELECT count(*) FROM ! WHERE status in( ?, ?)';

$sql1 = 'SELECT count(*) FROM !';

$user_visit = 'SELECT count(*) FROM ! WHERE lastvisit >= ? ';

$logsql = 'SELECT visits FROM ! WHERE page = ?';


$t->assign ( 'active_users' , $osDB->getOne( $sql, array( USER_TABLE, 'active', get_lang('status_enum','active')  ) )+0 );

$t->assign ( 'pending_users', $osDB->getOne( $sql, array( USER_TABLE, 'approval' , get_lang('status_enum','approval') ) )+0 );

$t->assign ( 'suspend_users', $osDB->getOne( $sql, array( USER_TABLE, 'suspend' , get_lang('status_enum','suspend') ) )+0 );

$t->assign ( 'active_aff' , $osDB->getOne( $sql, array( AFFILIATE_TABLE, 'active' , get_lang('status_enum','active') ) )+0 );

$t->assign ( 'pending_aff' , $osDB->getOne( $sql, array( AFFILIATE_TABLE, 'approval' , get_lang('status_enum','approval') ) )+0 );

$t->assign ( 'nusers' , $osDB->getOne($sql1, array(USER_TABLE) )+0 );

$t->assign ( 'picture_users', $osDB->getOne( $sql1.' where pictures_cnt > 0', array( USER_TABLE) ) +0 );

$time = time();

$t->assign('time', $time);

$t->assign ( 'online_users', $osDB->getOne( $sql1, array( ONLINE_USERS_TABLE ) ) +0 );

$t->assign ( 'visit_min', $osDB->getOne ( $user_visit, array( USER_TABLE, $time - 60) )+0 );

$t->assign ( 'visit_hour', $osDB->getOne ( $user_visit, array( USER_TABLE, $time - 3600, ) )+0 );

$t->assign ( 'visit_day', $osDB->getOne ( $user_visit, array( USER_TABLE, $time - 86400) )+0 );

$t->assign ( 'visit_week', $osDB->getOne ( $user_visit, array( USER_TABLE, $time - 604800) )+0);

$t->assign ( 'visit_month', $osDB->getOne ( $user_visit, array( USER_TABLE, $time - 2592000) )+0);

$t->assign ( 'visit_year', $osDB->getOne ( $user_visit, array( USER_TABLE, $time - 31536000) )+0 );

$t->assign ( 'visit_twoyear', $osDB->getOne ( $user_visit, array( USER_TABLE, $time - 63072000) )+0 );

$t->assign ( 'visit_fiveyear', $osDB->getOne ( $user_visit, array( USER_TABLE, $time - 157680000) )+0 );

$t->assign ( 'visit_tenyear', $osDB->getOne ( $user_visit, array( USER_TABLE, $time - 315360000) )+0 );

$t->assign ( 'total_visits', $osDB->getOne( $logsql, array ( LOG_TABLE, 'index' ) )+0 );

$t->assign ( 'most_active_page', $osDB->getOne( 'SELECT page FROM ! WHERE visits > 0 ORDER BY visits DESC ', array ( LOG_TABLE ) ) );

$t->assign ( 'gender_stats', $osDB->getAll('SELECT gender, count(*) as cnt FROM ! group by gender',array(USER_TABLE) ) );

$t->assign ( 'feedback_total', $osDB->getOne( $logsql, array ( LOG_TABLE, 'feedback' ) )+0 );

$t->assign ( 'im_count', $osDB->getOne ( $sql1, array ( INSTANT_MESSAGE_TABLE ) )+0 );

$t->assign ( 'wink_count', $osDB->getOne( $sql1.' where act=?', array ( VIEWS_WINKS_TABLE ,'W') ) +0);

$t->assign ( 'mail_count', $osDB->getOne( $sql1, array ( MAILBOX_TABLE ) )+0 );

$t->assign ( 'tellafriend_use', $osDB->getOne( $logsql, array ( LOG_TABLE, 'tellafriend' ) )+0 );

$t->assign ( 'showprofile_use', $osDB->getOne( $sql1.' where act=?', array ( VIEWS_WINKS_TABLE, 'V' ) )+0 );

$t->assign ( 'onlineusers_use', $osDB->getOne( $logsql, array ( LOG_TABLE, 'onlineusers' ) )+0 );

$t->assign ( 'newmemberlist_use', $osDB->getOne( $logsql, array ( LOG_TABLE, 'newmemberslist' ) )+0 );

$t->assign ( 'banner_use', $osDB->getOne( $logsql, array ( LOG_TABLE, 'banclick' ) )+0 );

$t->assign ( 'poll_use', $osDB->getOne( $logsql, array ( LOG_TABLE, 'poll' ) )+0 );

$t->assign ( 'gallery_use', $osDB->getOne( $logsql, array ( LOG_TABLE, 'userpicgallery' ) )+0 );

$t->assign ( 'aff_use', $osDB->getOne ( $logsql, array ( LOG_TABLE, 'affiliate' ) )+0 );

$t->assign ( 'signup_use', $osDB->getOne ( $logsql, array ( LOG_TABLE, 'signup' ) )+0 );

$t->assign ( 'allnews_use', $osDB->getOne ( $logsql, array ( LOG_TABLE, 'allnews' ) )+0 );

$t->assign ( 'stories_use', $osDB->getOne ( $logsql, array ( LOG_TABLE, 'stories' ) )+0 );

$t->assign ( 'supreq_use', $osDB->getOne ( $logsql, array ( LOG_TABLE, 'supreq' ) )+0 );

$t->assign ( 'searchmatch_use', $osDB->getOne ( $logsql, array ( LOG_TABLE, 'searchmatch' ) )+0 );

$t->assign ( 'story_count', $osDB->getOne( $sql1.' where enabled=?', array ( STORIES_TABLE,'Y' ) ) +0);

$t->assign ( 'aff_count', $osDB->getOne( $sql1, array ( AFFILIATE_TABLE ) )+0 );

$t->assign ( 'affref_count', $osDB->getOne( $sql1, array ( AFFILIATE_REFERALS_TABLE ) )+0);

$t->assign ( 'news_count', $osDB->getOne( $sql1, array ( NEWS_TABLE ) )+0 );

$t->assign ( 'pages_count', $osDB->getOne( $sql1, array ( PAGES_TABLE ) )+0 );

$t->assign ( 'polls_count', $osDB->getOne( $sql1, array ( POLLS_TABLE ) )+0 );

$t->assign ( 'langauge_count', count($language_options)+0 );

$t->assign('lang',$lang);

$t->assign('rendered_page', $t->fetch('admin/panel.tpl'));

$t->display ( 'admin/index.tpl' );
?>