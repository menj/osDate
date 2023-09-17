{strip}
<script type="text/javascript" src="javascript/pwd_strength.js"></script>
<script type="text/javascript">
/* <![CDATA[ */
function checkMe()
{ldelim}
	if (document.frmChangePass.txtoldpwd.value == '' || document.frmChangePass.txtconpwd.value == '' || document.frmChangePass.txtnewpwd.value == '' ){ldelim}
		alert("{lang mkey='errormsgs' skey=20}");
		return false;
	{rdelim}
	if (document.frmChangePass.txtnewpwd.value != document.frmChangePass.txtconpwd.value) {ldelim}
		alert("{lang mkey='errormsgs' skey=18}");
		return false;
	{rdelim}
	if( document.frmChangePass.txtnewpwd.value.length >= {$config.min_pass_len} && document.frmChangePass.txtnewpwd.value.length <= {$config.max_pass_len}){ldelim}
		if ( document.frmChangePass.txtnewpwd.value != document.frmChangePass.txtconpwd.value ){ldelim}
			alert( "{lang mkey='signup_js_errors' skey='password_nomatch'}");
			return false;
		{rdelim}
	{rdelim}else{ldelim}
		alert( "{lang mkey='signup_js_errors' skey='password_outrange'} {lang mkey='Between'} "+"{$config.min_pass_len} - {$config.max_pass_len} {lang mkey='characters'}" );
		return false;
	{rdelim}
	return true;
{rdelim}
/* ]]> */
</script>
<div style="vertical-align:top;" >
	{assign var="page_hdr01_text" value="{lang mkey='change_password'}"}
	{assign var="page_title" value="{lang mkey='change_password'}"}
	{include file="page_hdr01.tpl"}
	<div class="module_detail_inside">
	{if $pwd_change_error != ''}
		{assign var="error_message" value=$pwd_change_error }
		{include file="display_error.tpl"}
	{/if}
		<form action="modifympass.php" name="frmChangePass" method="post">
		<div class="line_outer" style="padding-top:6px;">
			<div style="display:inline; float:left; width:21%;">
				{lang mkey='old_password'}<font class="required_info">{$smarty.const.REQUIRED_INFO}</font>
			</div>
			<div style="display:inline; float:left;">
				<input type="password" class="textinput" name="txtoldpwd" maxlength="{$config.max_pass_len}" size="{$config.max_pass_len}"/>
			</div>
			<div style="clear:both;"></div>
		</div>
		<div class="line_outer">
			<div style="display:inline; float:left; width:21%;">
				{lang mkey='new_password'}<font class="required_info">{$smarty.const.REQUIRED_INFO}</font>
			</div>
			<div style="display:inline; float:left;">
				<input type="password" class="textinput" name="txtnewpwd" maxlength="{$config.max_pass_len}" size="{$config.max_pass_len}" onkeyup="runPassword(this.value, 'txtnewpwd');" />
			</div>
			<div style="clear:both;"></div>
		</div>
		<div class="line_outer">
			<div style="display:inline; float:left; width:21%;">
				{lang mkey='confirm_password'}<font class="required_info">{$smarty.const.REQUIRED_INFO}</font>
			</div>
			<div style="display:inline; float:left;">
				<input type="password" class="textinput" name="txtconpwd" maxlength="{$config.max_pass_len}" size="{$config.max_pass_len}" />
			</div>
			<div style="clear:both;"></div>
		</div>
		<div class="line_outer">
			<div style="display:inline; float:left; width:21%;">
				{lang mkey='pwd_strength'}
			</div>
			<div style="display:inline; float:left;">
				<div >
					<div id="txtnewpwd_bar"class="password_bar">
					</div>
					<div id="txtnewpwd_text" class="password_text">
					</div>
				</div>
			</div>
			<div style="clear:both;"></div>
		</div>
		{if $config.spam_code_length > 0}
			<div class="line_outer">
				<b>{lang mkey="security_code_txt"}</b>
			</div>
			<div class="line_outer">
				<table border="0" cellspacing="0" cellpadding="0" width="100%">
					<tr>
						<td >
							{lang mkey='enter_spamcode'}:&nbsp;
						</td>
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
			</div>
		{/if}
		<div class="line_outer" style="padding-left: 21%;">
			<input type="submit" class="formbutton" value="{lang mkey='change'}" onclick="return checkMe();"/>
		</div>
		</form>
	</div>
</div>
{/strip}
