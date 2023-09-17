{strip}
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	{if $title != '' }
		<title>{$title} {if $page_title ne ""}- {$page_title}{/if}</title>
	{elseif $config.site_title ne '' }
		<title>{$config.site_title|stripslashes} {if $page_title ne ""}- {$page_title}{/if}</title>
	{else}
		<title>{lang mkey='title'} {if $page_title ne ""}- {$page_title}{/if}</title>
	{/if}

	<link href="{$css_path}default.css" rel="stylesheet" type="text/css" />

	<meta http-equiv="Content-Type" content="text/html; charset={lang mkey='ENCODING'}" />
</head>
<body  dir="{lang mkey='DIRECTION'}">
<center>
<div style="width:802px;" >
	<table width="802" border="0" cellpadding="0" cellspacing="0" class="loginbarbg">
		<tr>
			<td height="33" width="156"><img src="{$image_dir}top_blue.jpg" alt="" /></td>
			<td height="33" width="646">
				<span class="admin_head">{lang mkey='admin_login_title'}  / <a href="{$docroot}index.php">{lang mkey='home_title'}</a></span>
			</td>
		</tr>
	</table>
	<br />
	{assign var="page_hdr01_text" value="Importing from Aedate"}
	{include file="admin/admin_page_hdr01.tpl"}
	<br />
	{include file="admin/admin_page_hdr02.tpl"}
	<br /><br />
</div>
</center>
</body>
</html>

{/strip}