<?xml version="1.0" encoding="iso-8859-15"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>View Pic</title>
<link href="{$docroot}templates/{$config.skin_name}/default.css" rel="stylesheet" type="text/css" />
</head>
<body class="module_detail_inside" style="border-width:0px">
	<table border="0" cellspacing="0" cellpadding="5" width="100%">
		<tr>
			<td align="center" width="100%">
				<img src="getsnap.php?id={$userid}&amp;picid={$galpicid}&amp;typ=pic&amp;album_id={$album_id}" alt="" />
			</td>
		</tr>
	</table>
</body>
</html>