{strip}

<script type="text/javascript">
/* <![CDATA[ */
function validate(form)
{ldelim}
	ErrorCount=0;
	ErrorMsg = new Array();

	CheckFieldString("noblank",form.txtsendername,"{lang mkey='taf_errormsgs' skey='sendername_noblank'}");
	CheckFieldString("noblank",form.txtsenderemail,"{lang mkey='taf_errormsgs' skey='senderemail_noblank'}");
	CheckFieldString("noblank",form.txtrcpntemail,"{lang mkey='taf_errormsgs' skey='recipientemail_noblank'}");
	{if $config.spam_code_length > 0}
		CheckFieldString("noblank",form.spam_code,"{lang mkey='errormsgs' skey='120'}");
	{/if}
	CheckFieldString("text",form.txtsendername,"{lang mkey='taf_errormsgs' skey='sendername_charset'}");
	CheckFieldString("email",form.txtsenderemail,"{lang mkey='taf_errormsgs' skey='senderemail_charset'}");
	CheckFieldString("email",form.txtrcpntemail,"{lang mkey='taf_errormsgs' skey='recipientemail_charset'}");

	if( ErrorCount > 0)
	{ldelim}
		alert(ErrorMsg[1]);
		return false;
	{rdelim}
	return true;
{rdelim}
/* ]]> */
</script>

<div  style="vertical-align:top;" >
	{assign var="page_hdr01_text" value="{lang mkey='taf_msg1'}"}
	{assign var="page_title" value="{lang mkey='taf_msg1'}"}
	{include file="page_hdr01.tpl"}

	<div class="module_detail_inside">
		{if $msg != ''}
			{assign var="error_message" value=$msg }
			{include file="display_error.tpl" }
		{/if}

		<div class="line_outer">
		<form name="frmCompose" action="sendinvite.php" method="post" onsubmit="javascript: return validate(this);">
			<table cellspacing="{$config.cellspacing}" cellpadding="{$config.cellpadding}" border="0" width="100%">
				<tr><td width="15%">{lang mkey='taf_yourname'}</td>
				<td ><input type="text" class="textinput" name="txtsendername" size="40" value="{$txtsendername}" /></td></tr>
				<tr><td colspan="2" height="3"></td></tr>
				<tr><td>{lang mkey='taf_youremail'}</td>
					<td><input type="text" class="textinput"  name="txtsenderemail" size="40" value="{$txtsenderemail}" /></td>
				</tr>
				<tr><td colspan="2" height="3"></td></tr>
				<tr><td>{lang mkey='taf_friendemail'}</td>
					<td><input type="text" class="textinput"  name="txtrcpntemail" size="40" value="{$txtrcpntemail}" /></td>
				</tr>
				<tr><td colspan="2" height="3"></td></tr>
			{if $config.spam_code_length > 0}
				<tr>
					<td colspan="2" ><b>{lang mkey="security_code_txt"}</b></td>
				</tr>
				<tr><td colspan="2" height="4"></td></tr>
				<tr>
					<td valign="middle" nowrap>{lang mkey='enter_spamcode'}:
					</td>
					<td valign="top" >
						<table  cellpadding="0" cellspacing="0" border="0" >
							<tr>
								<td valign="middle">
									<input type="text" class="textinput"  name="spam_code" id="spam_code" value="" />
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
				<tr><td colspan="2" height="4"></td></tr>
			{/if}
				<tr><td></td>
					<td >
						<input type="submit" class="formbutton" name="btnsend" value="{lang mkey='send_invite'}"/>
					</td>
				</tr>
			</table>
		</form>
		</div>
	</div>
</div>
{/strip}
