{strip}
<div style="vertical-align:top;" >
	{assign var="page_hdr01_text" value="{lang mkey='members_login'}"}
	{assign var="page_title" value="{lang mkey='members_login'}"}
	{include file="page_hdr01.tpl"}
	<div class="module_detail_inside">
		{if $smarty.get.err == 200 }
			{assign var="error_message" value="{lang mkey='signup_success_message'}"|cat:"&nbsp;"|cat:"{lang mkey='confirm_success'}" }
			<div  class="line_outer" style="margin:4px; padding: 6px;">
				{$error_message}
			</div>
		{elseif $login_error != ''}
			{assign var="error_message" value=$login_error}
			{include file="display_error.tpl"}
		{/if}
		<div class="line_outer">
		<form name="frmLogin1" method="post" action="midlogin.php" onsubmit="javascript: return newvalidateLogin(this);" >
		<input type="hidden" name="returnto" value="{$smarty.get.returnto}" />
		<input type="hidden" name="get_params" value='{$smarty.get.get_params}' />

		<table   cellspacing="2"  cellpadding="0" border="0">
			<tr>
				<td><span class='text8pt'>{lang mkey='signup_username'}</span></td>
				<td><input class="textinput" maxlength="25" name="txtusername" size="15" />
				</td>
			</tr>
			<tr>
				<td><span class='text8pt'>{lang mkey='signup_password'}</span></td>
				<td><input class="textinput" type="password" name="txtpassword" size="15"/>
				</td>
			</tr>
			<tr>
				<td></td>
				<td><input type="checkbox" name="rememberme"/> {lang mkey='remember_me'}
				</td>
			</tr>
			<tr>
				<td></td>
				<td><input type="submit" value="{lang mkey='login_submit'}"  class='formbutton'/>
				</td>
			</tr>
			<tr><td>&nbsp;</td></tr>
			<tr><td></td>
				<td ><b>{lang mkey='not_a_member'}</b><br />
				<a href="signup.php">{lang mkey='register_now'}</a>
				</td>
			</tr>
			<tr><td>&nbsp;</td></tr>
			<tr><td></td>
				<td><b>{lang mkey='forgot'}</b><br />
				<a href="forgotpass.php">{lang mkey='login_reminded'}</a>
				</td>
			</tr>
			<tr><td>&nbsp;</td></tr>
			<tr><td></td>
				<td><b>{lang mkey='lost_confemail'}</b><br />
				<a href="resend_conflink.php">{lang mkey='resend_conflink_hdr'}</a>
				</td>
			</tr>
			<tr><td>&nbsp;</td></tr>
		</table>
		</form>
		</div>
	</div>
</div>
{/strip}
