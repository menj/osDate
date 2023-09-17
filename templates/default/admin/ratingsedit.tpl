{strip}
<script type="text/javascript">
/* <![CDATA[ */
function checkMe(form)
{ldelim}
	if (form.txtrating.value == '' ){ldelim}
		alert("{lang mkey='errormsgs' skey=20}");
		return false;
	{rdelim}
	if (form.txtdescription.value == '' ){ldelim}
		alert("{lang mkey='errormsgs' skey=20}");
		return false;
	{rdelim}
	return true;
{rdelim}
/* ]]> */
</script>
{assign var="page_hdr01_text" value='<a href="manageratings.php" class="subhead">'|cat:"{lang mkey='profile_ratings'}"|cat:'</a>'}
{assign var="page_title" value="{lang mkey='profile_ratings'}"}
{include file="admin/admin_page_hdr01.tpl"}
<div style="padding-top:6px; text-align:left;">
	{assign var="page_hdr02_text" value="{lang mkey='modify_rating'}"}
	{include file="admin/admin_page_hdr02.tpl"}
	<div class="module_detail_inside">

		{if $error neq ""}
			{assign var="error_message" value=$error}
			{include file="display_error.tpl"}
		{/if}
		<div class="line_outer">
			<form action="modifyrating.php" method="post" onsubmit="javascript: return checkMe(this);">
			<input type="hidden" name="txtid" value="{$data.id}" />
				<table   cellspacing="{$config.cellspacing}" cellpadding="{$config.cellpadding}" width="550" border="0">
				<tbody>
					<tr>
						<td>{lang mkey='id'}</td>
						<td>{$data.id}</td>
					</tr>
					<tr>
						<td>{lang mkey='name'}<font class="required_info">{$smarty.const.REQUIRED_INFO}</font></td>
						<td><input type="text" class="textinput"  value="{$data.rating|stripslashes}" maxlength="255" size="50" name="txtrating" /></td>
					</tr>
					<tr>
						<td>{lang mkey='description'}<font class="required_info">{$smarty.const.REQUIRED_INFO}</font></td>
						<td><input type="text" class="textinput"  value="{$data.description|stripslashes}" maxlength="255" size="50" name="txtdescription" /></td>
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
				</tbody>
				</table>
		  </form>
		</div>
	</div>
</div>
{/strip}
