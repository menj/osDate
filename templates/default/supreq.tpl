{strip}
<script type="text/javascript">
/* <![CDATA[ */
function validate(form)
{ldelim}
	ErrorCount=0;
	ErrorMsg = new Array();
	ErrorMsg[0] = "" + String.fromCharCode(13);

	CheckFieldString("noblank",form.txtname,"{lang mkey='signup_js_errors' skey='name_noblank'}");
	CheckFieldString("noblank",form.txtemail,"{lang mkey='signup_js_errors' skey='email_noblank'}");
	CheckFieldString("noblank",form.txtcomments,"{lang mkey='signup_js_errors' skey='comments_noblank'}");
	{if $config.spam_code_length > 0}
		CheckFieldString("noblank",form.spam_code,"{lang mkey='errormsgs' skey='120'}");
	{/if}
	CheckFieldString("text",form.txtname,"{lang mkey='signup_js_errors' skey='name_charset'}");
	CheckFieldString("email",form.txtemail,"{lang mkey='signup_js_errors' skey='email_notvalid'}");

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

<div  style="vertical-align:top;" >
	{assign var="page_hdr01_text" value="{lang mkey='supreq'}"}
	{assign var="page_title" value="{lang mkey='supreq'}"}
	{include file="page_hdr01.tpl"}
	<div class="module_detail_inside">
	{if $success}
		{assign var="error_message" value="{lang mkey='supreq_thanks'}" }
		{include file="display_error.tpl"}
	{else}
		{if $msg != '' }
			{assign var="error_message" value=$msg }
			{include file="display_error.tpl"}
		{/if}
		<form name="frmSupreq" action="" method="post" onsubmit="javascript: return validate(this);">
		<input type="hidden" name="cmd" value="posted" />
		<table border="0" cellpadding="{$config.cellpadding}" cellspacing="{$config.cellspacing}">
			<tr>
				<td width="120">{lang mkey='subject_colon'}</td>
				<td ><input type="text" class="textinput"  name="txttitle" value="{$txttitle|stripslashes}" size="30" maxlength="30"/></td>
			</tr>
			<tr>
				<td > {lang mkey='name'}
					<font color="{lang mkey='required_info_indicator_color'}">
					{lang mkey='required_info_indicator'}</font>
				</td>
				<td ><input type="text" class="textinput"  name="txtname" value="{$txtname|stripslashes}" size="30" maxlength="30" {if $smarty.session.UserId > 0} READONLY {/if}/></td>
			</tr>
			<tr>
				<td >{lang mkey='email'}
					<font class="required_info">{$smarty.const.REQUIRED_INFO}</font>
				</td>
				<td ><input type="text" class="textinput"  name="txtemail" value="{$txtemail}" size="30" maxlength="150"  {if $smarty.session.UserId > 0} READONLY {/if}/>
				</td>
			</tr>
			<tr>
				<td >{lang mkey='country_colon'}
					<font class="required_info">{$smarty.const.REQUIRED_INFO}</font>
				</td>
				<td >
					<select name="txtcountry" id="txtcountry">
					{html_options options=$lang.countries selected=$smarty.session.from}
					</select></td>
			</tr>
			<tr>
				<td valign="top">{lang mkey='supreq'}:
				<font class="required_info">{$smarty.const.REQUIRED_INFO}</font>
				</td>
				<td ><textarea rows="10" cols="55" name="txtcomments">{$txtcomments|stripslashes}</textarea></td>
			</tr>
			<tr><td colspan="2" height="6"></td></tr>
			<tr>
				<td colspan="2"><b>{lang mkey="security_code_txt"}</b></td>
			</tr>
			<tr><td colspan="2" height="6"></td></tr>
			{if $config.spam_code_length > 0}
			<tr>
				<td >
					{lang mkey='enter_spamcode'}:&nbsp;
				</td>
				<td valign="middle" style="padding-left: 5px;" nowrap>
					<table border="0" cellspacing="0" cellpadding="0">
						<tr>
							<td valign="middle">
								<input type="text" class="textinput"  name="spam_code" id="spam_code" value="" />&nbsp;
							</td>
							<td valign="middle" nowrap>
								<img src="captcha/SecurityImage.php"  alt="Security Code" id="spam_code_img" name="spam_code_img" />
								&nbsp;&nbsp;
								<a href="javascript:reloadCaptcha();" ><img src="captcha/images/arrow_refresh.png" alt="Refresh Code" border="0" /></a>
							</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr><td colspan="2" height="6"></td></tr>
			{/if}
			<tr>
				<td></td>
				<td><input name="submit" class="formbutton" type="submit" value="{lang mkey='submit'}"/>&nbsp;
				<input name="reset" type="reset" value="{lang mkey='reset'}" class="formbutton"/> </td>
			</tr>
		</table>
		</form>
	{/if}
	</div>
</div>
{/strip}
