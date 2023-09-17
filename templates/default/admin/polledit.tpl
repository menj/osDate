{strip}
<script type="text/javascript">
/* <![CDATA[ */
function checkMe()
{ldelim}
	if (document.frmPoll.txtquestion.value == ''){ldelim}
		alert("{lang mkey='errormsgs' skey=20}");
		return false;
	{rdelim}
	document.frmPoll.submit();
{rdelim}
/* ]]> */
</script>
{assign var="page_hdr01_text" value='<a href="managepoll.php" class="subhead">'|cat:"{lang mkey='manage_polls'}"|cat:'</a>'}
{assign var="page_title" value="{lang mkey='manage_polls'}"}
{include file="admin/admin_page_hdr01.tpl"}
<div class="top_margin_6px"  style="text-align:left;">
	{assign var="page_hdr02_text" value="{lang mkey='modify_poll'}"}
	{include file="admin/admin_page_hdr02.tpl"}
	<div class="module_detail_inside" style="text-align:left;">
		{if $error ne ""}
			{assign var="error_message" value=$error}
			{include file="display_error.tpl"}
		{/if}
		<div class="line_outer">
			<form action="modifypoll.php" method="post" name="frmPoll">
				<input type="hidden" name="txtid" value="{$data.pollid}" />
				<table   cellspacing="{$config.cellspacing}" cellpadding="{$config.cellpadding}" width="100%" border="0">
				<tbody>
					<tr>
						<td width="70">{lang mkey='id'}</td>
						<td>{$data.pollid}</td>
					</tr>
					<tr>
						<td>{lang mkey='poll'}:<font class="required_info">{$smarty.const.REQUIRED_INFO}</font></td>
						<td><input type="text" class="textinput"  value="{$data.question|stripslashes}" maxlength="255" size="50" name="txtquestion" /></td>
					</tr>
					<tr>
						<td>{lang mkey='end_date'}:</td>
						<td>{html_select_date_translated prefix="txtdate"  month_value_format="%m" time=$data.date|date_format end_year="+5" } </td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td>
						<input type="button" class="formbutton" value="{lang mkey='submit'}" onclick="javascript: checkMe();" />&nbsp;
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
