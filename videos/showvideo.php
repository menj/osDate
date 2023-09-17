<?php
if ( !defined( 'SMARTY_DIR' ) ) {
	include_once( '../init.php' );
}

$_SESSION['videono'] = isset($_REQUEST['videono'])?$_REQUEST['videono']:'';

$_SESSION['video_userid'] = ($_REQUEST['userid']!='')?$_REQUEST['userid'] : $_SESSION['UserId'];

/*

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=koi8-r" />
<title><? echo $config['site_title']; ?></title>
</head>
<body bgcolor="#ffffff">
<!--url's used in the movie-->
<!--text used in the movie-->
<!--
Click to Start
-->
<!-- saved from url=(0013)about:internet -->
<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,0,0" width="600" height="400" id="flvplayer" align="middle">
<param name="allowScriptAccess" value="sameDomain" />
<param name="movie" value="flvplayer.swf?xml=videoparam.php" /><param name="quality" value="high" /><param name="devicefont" value="true" /><param name="bgcolor" value="#ffffff" /><embed src="flvplayer.swf?xml=videoparam.php" quality="high" devicefont="true" bgcolor="#ffffff" width="600" height="400" name="flvplayer" align="middle" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />
</object>

</body>
</html>
*/

if ((isset($_SESSION['AdminId']) && $_SESSION['AdminId'] > 0) or (isset($_REQUEST['prog']) && $_REQUEST['prog'] == 'gallery') ){
	$t->display('showvideo.tpl');
} else {
	$t->assign('rendered_page', $t->fetch('showvideo.tpl') );
	$t->display('index.tpl');
}
exit;
?>