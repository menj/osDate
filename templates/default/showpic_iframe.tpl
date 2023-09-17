<?xml version="1.0" encoding="iso-8859-15"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>View Pic</title>
<link href="{$DOC_ROOT}templates/{$config.skin_name}/default.css" rel="stylesheet" type="text/css" />
</head>
<body  class="picgallery" style="border-width:0px" >
	<table border="0" cellspacing="0" cellpadding="0" width="100%" >
		<tr>
			<td width="100%" height="100%" >
				<center>
				<img src="getsnap.php?id={$userid}&amp;picid={$galpicid}&amp;typ=pic&amp;album_id={$album_id}" alt="" />
				</center>
			</td>
		</tr>
	</table>
</body>
</html>