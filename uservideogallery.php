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

$userid = isset($_REQUEST['userid'])?$_REQUEST['userid']:'';

$username = $osDB->getOne('select username from ! where id = ?',array( USER_TABLE, $userid) );

$useralbums = $osDB->getAll('select id, name from ! where username = ?', array(USERALBUMS_TABLE, $username) ) ;

if (!array($useralbums) || count($useralbums) <= 0 ) $useralbums = array();

$t->assign('useralbums', $useralbums);

$album_passwd = isset($_REQUEST['album_passwd'])?$_REQUEST['album_passwd']:'';

$album_id = isset($_REQUEST['album_id'])?$_REQUEST['album_id']:'';

if ($album_id != '' && (!isset($_SESSION['AdminId']) || (isset($_SESSION['AdminId']) && $_SESSION['AdminId'] == '' ) ) ) {

	$pwd = $osDB->getOne('select passwd from ! where username = ? and  id = ?', array(USERALBUMS_TABLE, $username, $album_id) );

	if ($pwd != md5($album_passwd) && (isset($_SESSION['UserId']) && $userid != $_SESSION['UserId']) ) {

		$err = INVALID_PASSWORD;

		$album_id = '';
	}
}

if ($album_id != '') {
	$pics= $osDB->getAll('select * from ! where userid = ? and album_id =? and active = ?',array( USER_VIDEOS_TABLE, $userid, $album_id, 'Y') ) ;
} else {
	$pics=$osDB->getAll('select * from ! where userid = ? and (album_id is NUll or album_id = ?) and active = ?',array( USER_VIDEOS_TABLE, $userid, 0, 'Y') );
}

if (!array($pics) || count($pics) <= 0) $pics = array();
$data = array();
foreach ($pics as $row) {
	if (substr_count($row['filename'],'youtube:') > 0) {
		$row['ext'] = 'yt';
		$row['ytref'] = trim(str_replace('youtube:','',$row['filename']));
	} else {
		$row['ext'] = substr($row['filename'],-3);
		$row['fullfilename'] = 'temp/uservideos/'.$row['filename'];
	}
	$data[] = $row;
}

$t->assign('pics',$data);

$t->assign('username',$username);

$t->assign('userid',$userid);

if (isset($err) && $err > 0) {
	$t->assign('error_message', get_lang('errormsgs',$err));
}
$t->assign('album_id', $album_id);

unset($data, $pics);

if ( $config['use_profilepopups'] == 'Y' ) {

	$t->display( 'uservideogallery.tpl' );

}
else {

	$t->assign( 'rendered_page', $t->fetch( 'uservideogallery.tpl' ) );

	$t->display ( 'index.tpl' );
}


?>