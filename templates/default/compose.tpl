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

<!-- MOD START -->

<script type="text/javascript">
/* <![CDATA[ */
function checkMe(form)
{ldelim}

var radio_choice = false;

for (counter = 0; counter < form.templateid.length; counter++)
{ldelim}

	if (form.templateid[counter].checked)
	{ldelim}
		radio_choice = true;
	{rdelim}

{rdelim}

if ( form.templateid.checked == true ) {ldelim}
	radio_choice = true;
{rdelim}

if ( radio_choice == false )
{ldelim}
	alert("{lang mkey='template_select'}");
	return false;
{rdelim}

return true;

{rdelim}

function updateExtras()
{ldelim}

	if (document.frmExtras.chknotify.checked == true)
	{ldelim}

		document.frmCompose.chknotify.value = 1;
		document.frmTemplate.chknotify.value = 1;

	{rdelim} else {ldelim}

		document.frmCompose.chknotify.value = 0;
		document.frmTemplate.chknotify.value = 0;

	{rdelim}

	if (document.frmExtras.chkinclude.checked == true)
	{ldelim}

		document.frmCompose.chkinclude.value = 1;
		document.frmTemplate.chkinclude.value = 1;

	{rdelim} else {ldelim}

		document.frmCompose.chkinclude.value = 0;
		document.frmTemplate.chkinclude.value = 0;

	{rdelim}

{rdelim}

function validate(form)
{ldelim}
	ErrorCount=0;
	ErrorMsg = new Array();
	ErrorMsg[0] = "" + String.fromCharCode(13);

	CheckFieldString("noblank",form.txtsubject,"{lang mkey='signup_js_errors' skey='subject_noblank'}");
	CheckFieldString("noblank",form.txtmessage,"{lang mkey='signup_js_errors' skey='comments_noblank'}");
	{if $config.spam_code_length > 0}
		CheckFieldString("noblank",form.spam_code,"{lang mkey='errormsgs' skey='120'}");
	{/if}
	result="";
	if( ErrorCount > 0)
	{ldelim}
		alert(ErrorMsg[1]);
		return false;
	{rdelim}
	return true;
{rdelim}

/* ]]> */
</script>

<div style="vertical-align:top;" >
	{assign var="page_hdr01_text" value="{lang mkey='writing_message'} "|cat:$user.username}
	{assign var="page_title" value=$page_hdr01_text}
	{include file="page_hdr01.tpl"}
	<div class="module_detail_inside">
	{if $msg_sent == '1'}
		{assign var="error_message" value="{lang mkey='msg_sent'}" }
		{include file="display_error.tpl"}
	{else}
		<div class="line_outer">
			<form name="frmExtras" action="" >
			<table width="80%"   cellpadding="{$config.cellpadding}" cellspacing="{$config.cellspacing}" border="0">

				{if $errormsg != ''}
				<tr><td width="70%"><font color="#FF0000">{$errormsg}</font></td>
					<td width="30%">&nbsp;</td></tr>
				{/if}
				<tr>
					<td width="70%" valign="top" >
						<table   cellpadding="{$config.cellpadding}" cellspacing="{$config.cellspacing}" border="0">
							<tr>
								<td valign="middle" width="6"><input type="checkbox" name="chknotify" onclick="updateExtras();" value="1" />
								</td>
								<td valign="middle">{lang mkey='notify_me'}
								</td>
							</tr>
							<tr>
								<td valign="middle"><input type="checkbox" name="chkinclude" onclick="updateExtras();" value="1" />
								</td>
								<td valign="middle">{lang mkey='include_profile'}</td>
							</tr>
						</table>
					</td>
					<td width="30%" valign="top" height="110">
						<img src="getsnap.php?id={$smarty.request.recipient}&amp;typ=tn" class="smallpic" style="margin:10px 20px 10px 0px;" alt="" />
					</td>
				</tr>
			</table>
			</form>

			<p ><b>{lang mkey='custom_message'}</b></p>

			<!-- MOD END -->

			<form name="frmCompose" action="" method="post" onsubmit="javascript: return validate(this);">
			<input type="hidden" name="frm" value="frmCompose"/>

			<!-- MOD START -->

			<input type="hidden" name="chknotify" value="0"/>
			<input type="hidden" name="chkinclude" value="0"/>

			<!-- MOD END -->

			<table   cellpadding="{$config.cellpadding}" cellspacing="{$config.cellspacing}" border="0">

				<tr>
					<td >{lang mkey='subject'}</td>
					<td><input type="text" class="textinput" name="txtsubject" size="70" value="{if $smarty.request.reply == '1' or $smarty.request.reply == '11'}{$msg.subject|stripslashes}{elseif $errormsg != ''}{$smarty.request.txtsubject}{/if}" />
						<input type="hidden" name="txtrecipient" value="{$smarty.request.recipient}"/>
						{if $smarty.request.reply == '1' or $smarty.request.reply == '11'}
							<input type="hidden" name="reply" value="2" />
							<input type="hidden" name="sort" value="{$smarty.request.sort}" />
							<input type="hidden" name="type" value="{$smarty.request.type}" />
							<input type="hidden" name="folder" value="{$smarty.request.folder}" />
							<input type="hidden" name="selflag" value="{$smarty.request.selflag}" />
							<input type="hidden" name="msgid" value="{$smarty.request.msgid}" />

						{/if}
					</td>
				</tr>
				<tr>
					<td valign="top" >{lang mkey='message'}</td>
					<td><textarea name="txtmessage" rows="6" cols="50">{if $smarty.request.reply == '1' or $smarty.request.reply == '11'}{$msg.message|stripslashes }{elseif $errormsg != ''}{$smarty.request.txtmessage }{/if}</textarea></td>
				</tr>
				{if $config.spam_code_length > 0}
				<tr>
					<td colspan="2 "valign="middle">
						<table width="100%" cellspacing="0" cellpadding="0" border="0">
							<tr><td colspan="3" height="4" ></td></tr>
							<tr>
								<td colspan="3" style="padding-right: 4px;"><b>{lang mkey="security_code_txt"}</b></td>
							</tr>
							<tr>
								<td >
									{lang mkey='enter_spamcode'}:&nbsp;
								</td>
								<td valign="middle">
									<input type="text" class="textinput" name="spam_code" id="spam_code" value="" />
								</td>
								<td valign="middle" style="padding-left: 5px;" nowrap>
									<img src="captcha/SecurityImage.php"  alt="Security Code" id="spam_code_img" name="spam_code_img" />
									&nbsp;&nbsp;
									<a href="javascript:reloadCaptcha();" ><img src="captcha/images/arrow_refresh.png" alt="Refresh Code" border="0" /></a>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				{/if}
				<tr>
					<td colspan="2" ><input type="submit" class="formbutton" name="btnsend" value="{lang mkey='send'}"/>
					</td>
				</tr>
			</table>
			</form>

			<!-- MOD START -->

			<p ><b>{lang mkey='message_templates'}</b></p>

			<form name="frmTemplate" action="" method="post" onsubmit="javascript: return checkMe(this);">

				<input type="hidden" name="frm" value="frmTemplate"/>
				<input type="hidden" name="txtrecipient" value="{$smarty.request.recipient}"/>

				<input type="hidden" name="chknotify" value="0"/>
				<input type="hidden" name="chkinclude" value="0"/>
				<input type="hidden" name="spam_code" value="" />

			<table width="100%"   cellpadding="{$config.cellpadding}" cellspacing="{$config.cellspacing}" border="0">

				{foreach item=item from=$templates}
					<tr>
						<td width="25" valign="top" ><input type="radio" name="templateid" value="{$item.id}" /></td>
						<td>{$item.text|nl2br|stripslashes}</td>
					</tr>
				{foreachelse}
					<tr><td colspan="2" >{lang mkey='no_msg_templates'}</td></tr>
				{/foreach}

			</table>

			{if $templates|@count}
			<p ><input type="button" class="formbutton" name="btnsend" value="{lang mkey='send'}" onclick="javascript:document.frmTemplate.spam_code.value=document.frmCompose.spam_code.value; document.frmTemplate.submit();" /></p>
			{/if}

			</form>

			<p ><input type="button" onclick="document.location.href='mytemplates.php?recipient={$smarty.request.recipient}'" class="formbutton" name="btnmyremplates" value="{lang mkey='my_templates'}"/></p>
		</div>
	{/if}
	</div>
</div>
{/strip}

<!-- MOD END -->
{if $config.use_profilepopups == 'Y'}
	<script type="text/javascript"> /* <![CDATA[ */ window.focus(); /* ]]> */</script>
{/if}

{if $config.use_profilepopups == 'Y'}
	{closedb}
	</body>
	</html>
{/if}