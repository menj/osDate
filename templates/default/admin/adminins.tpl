{strip}
<script type="text/javascript" src="{$DOC_ROOT}javascript/pwd_strength.js"></script>
<script type="text/javascript">
/* <![CDATA[ */
function checkMe(form)
{ldelim}
	if (form.txtuname.value == '' || form.txtpassword.value == '' || form.txtfullname.value == '' || form.txtconfpassword.value == ''){ldelim}
		alert("{lang mkey='errormsgs' skey=20}");
		return false;
	{rdelim}
	if (form.txtpassword.value != form.txtconfpassword.value ){ldelim}
		alert("{lang mkey='errormsgs' skey=18}");
		return false;
	{rdelim}
	form.submit();
{rdelim}
/* ]]> */
</script>
{assign var="page_hdr01_text" value='<a href="manageadmin.php" class="subhead">'|cat:"{lang mkey='manage_admins'}"|cat:'</a>'}
{assign var="page_title" value="{lang mkey='manage_admins'}"}
{include file="admin/admin_page_hdr01.tpl"}
<div class="top_margin_6px">
	{assign var="page_hdr02_text" value="{lang mkey='add_admin'}"}
	{include file="admin/admin_page_hdr02.tpl"}
	<div class="module_detail_inside "  style="padding-top:1px;">
		{if $error_msg ne ""}
			{assign var="error_message" value=$error_msg}
			{include file="display_error.tpl" }
		{/if}
		<div class="line_outer">
			<form action="saveadmin.php" method="post" onsubmit="javascript: return checkMe(this);">
				<table cellspacing="2" cellpadding="1" width="100%" border="0">
					<tr>
						<td width="25%">{lang mkey='signup_username'}<font class="required_info">{$smarty.const.REQUIRED_INFO}</font></td>
						<td><input type="text" class="textinput"  maxlength="255" size="50" name="txtuname" value="{$smarty.session.txtuname}" /></td>
					</tr>
					<tr>
						<td>{lang mkey='signup_password'}<font class="required_info">{$smarty.const.REQUIRED_INFO}</font></td>
						<td><input type="password" class="textinput" maxlength="255" size="50" name="txtpassword" onkeyup="runPassword(this.value, 'txtpassword');" /></td>
					</tr>
					<tr>
						<td>{lang mkey='signup_confirm_password'}<font class="required_info">{$smarty.const.REQUIRED_INFO}</font></td>
						<td><input type="password" class="textinput" maxlength="255" size="50" name="txtconfpassword" /></td>
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
						<td>{lang mkey='fullname'}:<font class="required_info">{$smarty.const.REQUIRED_INFO}</font></td>
						<td><input type="text" class="textinput" maxlength="255" size="50" name="txtfullname" value="{$smarty.session.txtfullname}" /></td>
					</tr>
					<tr>
						<td>{lang mkey='superuser'}:</td>
						<td><select name="txtsuperuser">
							{html_options options=$lang.enabled_values selected='N'}
							</select>
						</td>
					</tr>
					<tr>
						<td>{lang mkey='enabled'}</td>
						<td><select name="txtenabled">
							{html_options options=$lang.enabled_values selected=$data.enabled}
							</select>
						</td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td>
							<input type="submit" class="formbutton" value="{lang mkey='submit'}" />&nbsp;
							<input type="reset" class="formbutton" value="{lang mkey='reset'}" />
						</td>
					</tr>
				</table>
			</form>
		</div>
	</div>
</div>
{/strip}