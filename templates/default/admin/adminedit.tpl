{strip}
<script type="text/javascript">
/* <![CDATA[ */
function checkMe(form)
{ldelim}
  if (form.txtfullname.value == '' ){ldelim}
    alert("{lang mkey='errormsgs' skey=20}");
    return false;
  {rdelim}
  return true;
{rdelim}
/* ]]> */
</script>
{assign var="page_hdr01_text" value='<a href="manageadmin.php" class="subhead">'|cat:"{lang mkey='manage_admins'}"|cat:'</a>'}
{assign var="page_title" value="{lang mkey='manage_admins'}"}
{include file="admin/admin_page_hdr01.tpl"}
<div class="top_margin_6px">
	{assign var="page_hdr02_text" value="{lang mkey='modify_admin'}"}
	{include file="admin/admin_page_hdr02.tpl"}
	<div class="module_detail_inside"  style="padding-top:1px;">
		<div class="line_outer">
			<form action="modifyadmin.php" method="post" name="frmEdit" onsubmit="javascript: return checkMe(this);">
				<input type="hidden" name="txtid" value="{$admin.id}" />
				<table cellspacing="2" cellpadding="1" width="550" border="0">
					<tr>
						<td colspan="2">{if $error_msg ne ""}<font color="{lang mkey='admin_error_color'}">{$error_msg}</font>{/if}</td>
					</tr>
					<tr>
						<td>{lang mkey='signup_username'}</td>
						<td>{$admin.username}</td>
					</tr>
					<tr>
						<td>{lang mkey='fullname'}:<font class="required_info">{$smarty.const.REQUIRED_INFO}</font></td>
						<td><input type="text" class="textinput"  maxlength="255" size="50" name="txtfullname" value="{$admin.fullname|stripslashes}" /></td>
					</tr>
					<tr>
						<td>{lang mkey='superuser'}:</td>
						<td><select name="txtsuperuser">
							{html_options options=$lang.enabled_values selected=$admin.super_user}
							</select>
						</td>
					</tr>
					<tr>
						<td>{lang mkey='enabled'}</td>
						<td><select name="txtenabled">
							{html_options options=$lang.enabled_values selected=$admin.enabled}
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
