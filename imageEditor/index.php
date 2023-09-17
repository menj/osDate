<?php

if ($_REQUEST['picid'] > 0 && $_REQUEST['userid'] > 0 ) {

	include_once("../minimum_init.php");

	include (OSDATE_INC_DIR."internal/snaps_functions.php");

	$css_path = DOC_ROOT.'templates/'.$skin_name.'/';


	$_SESSION['picedit']['userid'] =$userid =  $_REQUEST['userid'];
	$_SESSION['picedit']['picid'] = $picid = $_REQUEST['picid'];
	if (isset($_REQUEST['generate_tnpic']) && $_REQUEST['generate_tnpic'] =='Y') {
		$_SESSION['picedit']['generate_tnpic'] = $generate_tnpic = 'Y';
	} else {
		$_SESSION['picedit']['generate_tnpic'] = $generate_tnpic = 'N';
	}

	$_SESSION['picedit']['typ'] = $typ = isset($_REQUEST['typ'])?$_REQUEST['typ']:'pic';
	$_SESSION['picedit']['type'] = $type = isset($_REQUEST['type']) ? $_REQUEST['type']:'';

	$originalDirectory = USER_IMAGE_EDITS_DIR.'original/'.$userid.'/';
	$activeDirectory = USER_IMAGE_DIR.$userid.'/';
	$editDirectory = USER_IMAGE_EDITS_DIR.$userid.'/';
	if (!file_exists($activeDirectory)) {
		mkdir($activeDirectory);
		chmod($activeDirectory,'0777');
	}
	if (!file_exists($editDirectory)) {
		mkdir($editDirectory);
		chmod($editDirectory,'0777');
	}
	if (!file_exists($originalDirectory)) {
		mkdir($originalDirectory);
		chmod($originalDirectory,'0777');
	}

	$sql = 'select * from '.USER_SNAP_TABLE.' where userid='.$userid.' and picno='.$picid;

	$image = $osDB->getRow($sql);

	if (substr($image['picture'],0,5) != 'file:') {
	/* Image in DB. Create file in user_images_dir */

		if ($typ == 'pic') {
			$newimg = base64_decode($image['picture']);
			$ext = $image['picext'];
		} else {
			$newimg = base64_decode($image['tnpicture']);
			$ext = $image['tnext'];
		}

		$filename = $typ."_".$picid.".".$ext;

		$imageName = writeImageToFile($newimg, $userid, '1'.$picid, $filename );

	} else {

		if ($typ == 'pic' ) {
			$imageName = trim(str_replace('file:','',$image['picture']));
		} else {
			$imageName = trim(str_replace('file:','',$image['tnpicture']));
		}
	}
	copy($activeDirectory.$imageName, $editDirectory.$imageName);
	copy($activeDirectory.$imageName, $originalDirectory.$imageName);
	$image2edit = $imageName;	
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>osDate Image Editor</title>

	<style type="text/css">@import "ImageEditor.css";</style>

	<link href="<? echo($css_path);?>default.css" rel="stylesheet" type="text/css" />

	<script type="text/javascript" src="PageInfo.js"></script>
	<script type="text/javascript" src="ImageEditor.js"></script>
	<script type="text/javascript">
	//<![CDATA[
/*		if (window.opener){
			window.moveTo(0, 0);
			window.resizeTo(screen.width, screen.height - 28);
			window.focus();
		}
*/
		window.onload = function(){
			ImageEditor.init("<? echo($image2edit) ?>");
		};
	//]]>
	</script>
</head>
<body>
	<div id="ImageEditorContainer">
		<div id="ImageEditorToolbar">
			<button class="formbutton" onclick="ImageEditor.save()">Save As Active</button><button  class="formbutton" onclick="ImageEditor.viewActive()">View Active</button><button  class="formbutton" onclick="ImageEditor.viewOriginal()">View Original</button>
			<span class="spacer"> || </span>w:<input id="ImageEditorTxtWidth" type="text" size="3" maxlength="4" />&nbsp;h:<input id="ImageEditorTxtHeight" type="text" size="3" maxlength="4" /><input id="ImageEditorChkConstrain" type="checkbox" checked="checked" />Constrain&nbsp;<button  class="formbutton" onclick="ImageEditor.resize();">Resize</button>
			<span class="spacer"> || </span>
			<button  class="formbutton" onclick="ImageEditor.crop()">Crop</button>
			<span class="spacer"> || </span>
			<button  class="formbutton" onclick="ImageEditor.rotate(90)">90&deg;CCW</button><button onclick="ImageEditor.rotate(270)" class="formbutton" >90&deg;CW</button>
			<span class="spacer"> || </span>
			<span id="ImageEditorCropSize"></span>
		</div>
		<div id="ImageEditorImage">&nbsp;</div>
	</div>

</body>
</html>