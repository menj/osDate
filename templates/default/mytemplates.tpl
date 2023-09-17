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
		document.location = "mytemplates.php?recipient={/literal}{$smarty.request.recipient}{literal}&action=delete&id=" + templateid;
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
		<p >{lang mkey='template_intro'}</p>

		<form name="frmTemplate" action="" method="post" onsubmit="javascript: return checkMe(this);">

			<input type="hidden" name="frm" value="frmTemplate" />

		{foreach item=item from=$templates}
			<div class="line_top_bottom_pad">
				<div style="width:40px; display:inline; float:left;">
					<a href="mytemplatesadd.php?id={$item.id}&amp;recipient={$smarty.request.recipient}"><img style="margin-right:3px;" src="images/button_edit.png" alt="Edit" border="0" /></a>&nbsp;
					<a href="#" onclick="javascript:confirmDelete({$item.id},'{lang mkey='delete_template_confirm_msg'}')"><img style="margin-right:3px;" src="images/button_drop.png" alt="Delete" border="0" /></a>
				</div>
				<div style="display:inline; float:left;">
					{if $item.subject ne ''}
						{$item.subject|nl2br|stripslashes}
					{else}
						{$item.text|nl2br|stripslashes}
					{/if}
				</div>
				<div style="clear:both;"></div>
			</div>
		{foreachelse}
			<div class="line_top_bottom_pad">
				{lang mkey='no_msg_templates'}
			</div>
		{/foreach}
			<div class="line_top_bottom_pad">
			<input onclick="document.location='mytemplatesadd.php?recipient={$smarty.request.recipient}';" type="button" class="formbutton" name="btnsend" value="{lang mkey='add_template'}"/>&nbsp;&nbsp;
			<input onclick="document.location.href='compose.php?recipient={$smarty.request.recipient}';" type="button" class="formbutton" name="btnsend" value="{lang mkey='return_message'}"/>
			</div>
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