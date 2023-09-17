{strip}
<script type="text/javascript" src="{$DOC_ROOT}javascript/pwd_strength.js"></script>
<script type="text/javascript">
/* <![CDATA[ */
function checkMe(form)
{ldelim}
	if (form.txtoldpwd.value == '' || form.txtconpwd.value == '' || form.txtnewpwd.value == '' ){ldelim}
		alert("{lang mkey='errormsgs' skey=20}");
		return false;
	{rdelim}
	if (form.txtnewpwd.value != form.txtconpwd.value) {ldelim}
		alert("{lang mkey='errormsgs' skey=18}");
		return false;
	{rdelim}
	return true;
{rdelim}
/* ]]> */
</script>
{assign var="page_hdr01_text" value="{lang mkey='change_password'}"}
{assign var="page_title" value="{lang mkey='change_password'}"}
{include file="admin/admin_page_hdr01.tpl"}
<div class="top_margin_6px">
	{assign var="page_hdr02_text" value="{lang mkey='change_password'}"}
	{include file="admin/admin_page_hdr02.tpl"}
	<div class="module_detail_inside" style="padding-top:1px; text-align:left;">
		{if $pwd_change_error ne ""}
			{assign var="error_message" value=$pwd_change_error}
			{include file="display_error.tpl"}
		{/if}
		<div class="line_outer">
		<form action="modifypwd.php" method="post" name="frmAdmin" onsubmit="javascript: return checkMe(this);">
			<input type="hidden" name="txtid" value="{$smarty.session.AdminId}" />
			<table width="100%" border="0"  cellspacing="{$config.cellspacing}" cellpadding="{$config.cellpadding}"  align="center">
				<tr>
					<td width="25%">{lang mkey='old_password'}<font class="required_info">{$smarty.const.REQUIRED_INFO}</font></td>
					<td><input type="password" class="textinput" maxlength="32" size="32" name="txtoldpwd" /></td>
				</tr>
				<tr>
					<td>{lang mkey='new_password'}<font class="required_info">{$smarty.const.REQUIRED_INFO}</font></td>
					<td><input type="password" class="textinput" maxlength="32" size="32" name="txtnewpwd" onkeyup="runPassword(this.value, 'txtnewpwd');" /></td>
				</tr>
				<tr>
					<td>{lang mkey='confirm_password'}<font class="required_info">{$smarty.const.REQUIRED_INFO}</font></td>
					<td><input type="password" class="textinput" maxlength="32" size="32" name="txtconpwd" /></td>
				</tr>
				<tr>
					<td valign="top">{lang mkey='pwd_strength'}:</td>
					<td width="67%">
						<div style="width:100%;">
							<div id="txtnewpwd_bar" class="password_bar">
							</div>
							<div id="txtnewpwd_text" class="password_text">
							</div>
						</div>
					</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td>
						<input type="submit" class="formbutton" value="{lang mkey='modify'}" />
					</td>
				</tr>
			</table>
		</form>
		</div>
	</div>
</div>
{/strip}