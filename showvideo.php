<?php
if ( !defined( 'SMARTY_DIR' ) ) {
	include_once( 'init.php' );
}

$videono = isset($_REQUEST['videono'])?$_REQUEST['videono']:'1';

$video_userid = ($_REQUEST['userid']!='')?$_REQUEST['userid'] : (isset($_SESSION['UserId'])?$_SESSION['UserId']:'-1');

$rec = $osDB->getRow('select * from ! where userid = ? and videono = ?', array(USER_VIDEOS_TABLE,$video_userid, $videono ) );

if (isset($rec) && $rec['filename'] != '') {
	$t->assign('ext', substr($rec['filename'],-3) );
	$rec['filename'] = DOC_ROOT.'temp/uservideos/'.$rec['filename'];
	$t->assign('rec',$rec);
	$t->assign('videoheight',400);
	$t->assign('videowidth',600);

	$t->display('showvideo.tpl');

} else {
	echo('Video file missing');
}
exit();
?>