{strip}
<script type="text/javascript" src="javascript/pwd_strength.js"></script>
<script type="text/javascript">
var act = "{$act}";
/* <![CDATA[ */
function validate(form)
{ldelim}
	ErrorCount=0;
	ErrorMsg = new Array();
	ErrorMsg[0]="------------------------- The Following Errors Occured -------------------------" + String.fromCharCode(13);

	CheckFieldString("noblank",form.txtname,"{lang mkey='signup_js_errors' skey='name_noblank'}");
	CheckFieldString("text",form.txtname,"{lang mkey='signup_js_errors' skey='name_charset'}");

	CheckFieldString("noblank",form.txtemail,"{lang mkey='signup_js_errors' skey='email_noblank'}");
	CheckFieldString("email",form.txtemail,"{lang mkey='signup_js_errors' skey='email_notvalid'}");
	if (act == 'added') {ldelim}
		CheckFieldString("noblank",form.txtpassword,"{lang mkey='signup_js_errors' skey='password_noblank'}");
		CheckFieldString("noblank",form.txtconpassword,"{lang mkey='signup_js_errors' skey='password_noblank'}");
	{rdelim}
	if (form.txtpassword.value != '') {ldelim}
		CheckFieldString("alphanum",form.txtpassword,"{lang mkey='signup_js_errors' skey='password_charset'}");
		CheckFieldString("alphanum",form.txtpassword,"");
		if( form.txtpassword.value.length >= {$config.min_pass_len} && form.txtpassword.value.length <= {$config.max_pass_len}){ldelim}
			if ( form.txtpassword.value != form.txtconpassword.value ){ldelim}
				ErrorCount++;
					ErrorMsg[ErrorCount] = "{lang mkey='signup_js_errors' skey='password_nomatch'}"  + String.fromCharCode(13);
			{rdelim}
		{rdelim}else{ldelim}
			ErrorCount++;
			ErrorMsg[ErrorCount] = "{lang mkey='signup_js_errors' skey='password_outrange'}"  + String.fromCharCode(13);
		{rdelim}
	{rdelim}
	if(form.txtname.value.length >= {$config.min_username_len} ){ldelim}
		if ( !isNaN(form.txtname.value.charAt(0)) ){ldelim}
			ErrorCount++;
			ErrorMsg[ErrorCount] = "{lang mkey='signup_js_errors' skey='username_start_alpha'}"  + String.fromCharCode(13);
		{rdelim}
	{rdelim}else{ldelim}
		ErrorCount++;
		ErrorMsg[ErrorCount] = "{lang mkey='signup_js_errors' skey='username_outrange'}"  + String.fromCharCode(13);
	{rdelim}

	/* concat all error messages into one string */
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
{assign var="page_hdr01_text" value='<a href="'|cat:$docroot|cat:$smarty.const.ADMIN_DIR|cat:'affiliatesview.php" class="subhead">'|cat:"{lang mkey='affiliate_title'}"|cat:'</a> > '}
{assign var="page_title" value="{lang mkey='affiliate_title'}"}
{if $act == 'added'}
	{assign var="page_hdr01_text" value=$page_hdr01_text|cat:"{lang mkey='add_affiliate'}"}
{elseif $act == 'modified'}
	{assign var="page_hdr01_text" value=$page_hdr01_text|cat:"{lang mkey='mod_affiliate'}"}
{/if}
{include file="admin/admin_page_hdr01.tpl"}
	<div class="module_detail_inside" style="padding-top:1px;">
	{if $error ne ""}
		{assign var="error_message" value=$error}
		{include file="display_error.tpl" }
	{/if}
		<div class="line_outer">
			<form name="frmAffSignup" method="post" action="" onsubmit="javascript:return validate(this);">
				<input type="hidden" name="frm" value="frmAffSignup" />
				<input type="hidden" name="affid" value="{$affid}" />
				<input type="hidden" name="act" value="{$act}" />
				<table border="0" cellpadding="{$config.cellpadding}" cellspacing="{$config.cellspacing}" width="100%">
					<tr>
						<td width="25%" >{lang mkey='name'}</td>
						<td width="75%"><input type="text" class="textinput"  name="txtname" maxlength="{$config.max_username_len}" size="20" value="{$name}" />&nbsp;&nbsp;&nbsp;({$config.min_username_len}{lang mkey='to'}{$config.max_username_len}&nbsp;{lang mkey='characters'})</td>
					</tr>
					<tr>
						<td >{lang mkey='email'}</td>
						<td><input type="text" class="textinput"  name="txtemail" maxlength="255" size="20" value="{$email}" />&nbsp;&nbsp;&nbsp;({lang mkey='must_be_valid'})</td>
					</tr>
					<tr>
						<td >{lang mkey='signup_password'}</td>
						<td><input type="password" class="textinput" name="txtpassword" maxlength="{$config.max_pass_len}" size="20" value="{$password}" onkeyup="runPassword(this.value, 'txtpassword');"/>&nbsp;&nbsp;&nbsp;({$config.min_pass_len}{lang mkey='to'}{$config.max_pass_len}&nbsp;{lang mkey='characters'})</td>
					</tr>
					<tr>
						<td >{lang mkey='confirm_password'}</td>
						<td><input type="password" class="textinput" name="txtconpassword" maxlength="{$config.max_pass_len}" size="20" /></td>
					</tr>
					<tr>
						<td valign="top">{lang mkey='pwd_strength'}:</td>
						<td width="75%">
							<div style="width:100%;">
								<div id="txtpassword_bar"class="password_bar">
								</div>
								<div id="txtpassword_text" class="password_text">
								</div>
							</div>
						</td>
					</tr>
					<tr>
						<td align="right">
							<input type="submit" class="formbutton" value="{lang mkey='submit'}" />
						</td>
					</tr>
				</table>
			</form>
		</div>
	</div>
</div>
{/strip}