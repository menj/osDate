{if $config.use_profilepopups == 'Y'}
<?xml version="1.0" encoding="{lang mkey='ENCODING}'"?>
	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>{$page_title}</title>
	<script type="text/javascript">
	/* <![CDATA[ */
	{if $config.use_popups == 'N'}
		var use_popups = false;
	{else}
		var use_popups = true;
	{/if}
	{if $config.use_profilepopups == 'N'}
		var use_profilepopups = false;
	{else}
		var use_profilepopups = true;
	{/if}
	/* ]]> */
	</script>

	<link href="{$css_path}default.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="javascript/functions.js"></script>
	<script type="text/javascript" src="javascript/validate.js"></script>
	<meta http-equiv="Content-Type" content="text/html; charset={lang mkey='ENCODING'}" />
	</head>
	<body   dir="{lang mkey='DIRECTION'}" >
{/if}
{strip}
<script type="text/javascript">
/* <![CDATA[ */
document.title='{lang mkey='my_templates'}';
/* ]]> */
</script>

<script type="text/javascript">
/* <![CDATA[ */
{literal}
function confirmDelete(templateid,conmsg,form)
{
	if (confirm(conmsg)){

		document.location = "mytemplates.php?request={/literal}{$smarty.request.recipient}{literal}&action=delete&id=" + templateid;

	}
}
{/literal}
/* ]]> */
</script>
<div style="vertical-align:top;" >
	{assign var="page_hdr01_text" value="{lang mkey='my_templates'}"}
	{assign var="page_title" value="{lang mkey='my_templates'}"}
	{include file="page_hdr01.tpl"}
	<div class="module_detail_inside">

		<div class="line_outer">
		<p><b>
		{if $smarty.get.id}
			{lang mkey='edit_template'}
		{else}
			{lang mkey='add_template'}
		{/if}
		</b></p>

		<form name="frmTemplate" action="mytemplatesadd.php" method="post">
			<input type="hidden" name="recipient" value="{$smarty.request.recipient}" />
			<input type="hidden" name="id" value="{$smarty.get.id}" />

			<p>{lang mkey='subject'}:<br /><input type="text" class="textinput"  name="txtsubject" style="width:350px;" value="{$template.subject|stripslashes}" /></p>

			<p >{lang mkey='message'}: <br /><textarea name="txttemplate" style="width:350px; height:100px;">{$template.text|stripslashes }</textarea></p>

			<p >{lang mkey='template_instructions'}</p>

			<p ><input type="submit" class="formbutton" name="btnsave" value="{lang mkey='submit'}"/>&nbsp;&nbsp;<input type="button" onclick="document.location.href='mytemplates.php?recipient={$smarty.request.recipient}';" class="formbutton" name="btncancel" value="{lang mkey='cancel'}"/></p>
		</form>
		</div>
	</div>
</div>
{/strip}
{if $config.use_profilepopups == 'Y'}
	<script type="text/javascript"> /* <![CDATA[ */ window.focus(); /* ]]> */</script>
{/if}

{if $config.use_profilepopups == 'Y'}
	{closedb}
	</body>
	</html>
{/if}