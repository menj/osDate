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

include('sessioninc.php');

if (isset($_POST['groupaction']) && $_POST['groupaction'] == get_lang('delete_selected') ) {

	if (isset($_POST['txtcheck']) ) {
		foreach ($_POST['txtcheck'] as $val) {

			$osDB->query('update ! set comment = ? , reply=? where id = ? ', array( USER_RATING_TABLE, '',  '', $val ) );

		}
	}
	$t->assign('error_message',get_lang('errormsgs','145') );

}

if (isset($_REQUEST['id']) && $_REQUEST['id'] != '' && isset($_REQUEST['remove']) && $_REQUEST['remove'] == '1' ) {

	$osDB->query('update ! set comment=?, reply=?  where id = ?', array( USER_RATING_TABLE, '', '', $_REQUEST['id'] ) );

	$t->assign('error_message',get_lang('errormsgs','146' ) );
}

$list = $osDB->getAll('select id, userid, comment, reply, ratingid, comment_date from ! where profileid = ? and comment <> ? order by ratingid, comment_date desc',array(USER_RATING_TABLE, $_SESSION['UserId'] ,'') );

$data=array();

foreach ($list as $k=>$rec){

	$rec['username'] = $osDB->getOne('select username from ! where id = ?', array(USER_TABLE,$rec['userid']) );
	$rec['rating'] = $osDB->getOne('select rating from ! where id=?', array(RATINGS_TABLE,$rec['ratingid']) );

	$data[] = $rec;

}
$t->assign('commentslist', $data);

unset($list, $data);

$t->assign('lang', $lang);

$t->assign('rendered_page', $t->fetch('user_comments.tpl') );

$t->display('index.tpl');


?>