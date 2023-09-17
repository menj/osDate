{strip}
<script type="text/javascript">
/* <![CDATA[ */
{literal}
function validateForm(form)
{
	ErrorCount=0;
	ErrorMsg = new Array();
	ErrorMsg[0]="------------------------- The Following Errors Occured -------------------------" + String.fromCharCode(13);

	CheckFieldString("noblank",form.txtusername,"{lang mkey='signup_js_errors' skey='email_noblank'}");
	CheckFieldString("noblank",form.txtpassword,"{lang mkey='signup_js_errors' skey='password_noblank'}");
	CheckFieldString("email",form.txtusername,"{lang mkey='signup_js_errors' skey='email_notvalid'}");

	// concat all error messages into one string
	result="";
	if( ErrorCount > 0)
	{
		//for( c in ErrorMsg)
			//result += ErrorMsg[c];
		alert(ErrorMsg[1]);
		return false;
	}
	return true;
}
function validateForm1()
{
	ErrorCount=0;
	ErrorMsg = new Array();
	ErrorMsg[0]="------------------------- The Following Errors Occured -------------------------" + String.fromCharCode(13);

	CheckFieldString("noblank",document.getElementById('forgot_pass_email'),"{lang mkey='signup_js_errors' skey='email_noblank'}");

	// concat all error messages into one string
	result="";
	if( ErrorCount > 0)
	{
		//for( c in ErrorMsg)
			//result += ErrorMsg[c];
		alert(ErrorMsg[1]);
		return false;
	}
	return true;
}
{/literal}
/* ]]> */
</script>
<div style="vertical-align:top;" >
	{assign var="page_hdr01_text" value="{lang mkey='affiliate_login_title'}"}
	{assign var="page_title" value="{lang mkey='affiliate_login_title'}"}
	{include file="page_hdr01.tpl"}
	<div class="module_detail_inside">
		<form name="frmAfflogin" method="post" action="affmidlogin.php" onsubmit="return(validateForm(this));">
				<table border="0" cellpadding="{$config.cellpadding}" cellspacing="{$config.cellspacing}" width="100%">
				{if $error_message ne ''}
					{include file="display_error.tpl" }
				{/if}
					<tr>
						<td colspan="2"><font class="required_info">{$smarty.const.REQUIRED_INFO}</font>{lang mkey='required_info_indication'}</td>
					</tr>
					<tr>
						<td height="2" width="19%">{lang mkey='signup_email'}
							<font class="required_info">{$smarty.const.REQUIRED_INFO}</font>
						</td>
						<td height="2" width="81%">
							<input class="textinput" maxlength="100" name="txtusername" size="20"/>
						</td>
					</tr>
					<tr>
						<td>{lang mkey='signup_password'}
							<font class="required_info">{$smarty.const.REQUIRED_INFO}</font></td>
						<td> <input class="textinput" type="password" class="textinput" name="txtpassword" size="20"/>
						</td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td>
							<input type="submit" class="formbutton" value="{lang mkey='login_submit'}"/>
						</td>
					</tr>
				</table>
		</form>
				<br />
			<form name="password_forgot" action="affgetforgotpass.php" method="post" onsubmit="return(validateForm1());">
				<table border=0 cellpadding="{$config.cellpadding}" cellspacing="{$config.cellspacing}" width="100%">
					<tr><td colspan="2">{lang mkey="aff_forgot_pass"}</td></tr>
					<tr><td width="19%">{lang mkey='signup_email'}</td>
						<td width="81%"><input class="textinput" name="forgot_pass_email" id="forgot_pass_email" size="20" /></td>
					</tr>
					<tr><td>&nbsp;</td><td><input type="submit" class="formbutton" name="gen_password" value="{lang mkey='send_new_password'}" /></td>
					</tr>
				</table>
			</form>
	</div>
</div>
{/strip}
