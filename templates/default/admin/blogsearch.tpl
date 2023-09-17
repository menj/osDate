{strip}
{if $smarty.session.AdminId == ''}
	<script type="text/javascript" src="javascript/cascade_search.js"></script>
{else}
	<script type="text/javascript" src="../javascript/cascade_search.js"></script>
{/if}
<div style="vertical-align:top;" >
	{assign var="page_hdr01_text" value="{lang mkey='blog_search_menu'}"}
	{assign var="page_title" value="{lang mkey='blog_search_menu'}"}
	{include file="admin/admin_page_hdr01.tpl"}
	<div class="module_detail_inside"  style="padding-top:1px;">
	<form name="{$frmname}" method="get" action="blogsearch.php">
	<input type="hidden" name="userid" value="{$userid}" />
		<div class="line_outer">
			<table   border="0" cellspacing="{$config.cellspacing}" cellpadding="{$config.cellpadding}">
				<tr>
					<td width="12%">{lang mkey='blog_search_username'}: </td>
					<td width="88%">
						<input name="srchusername" value="{$smarty.session.advsearch.srchusername}" type="text" class="textinput"  size="30" />
					</td>
				</tr>
				<tr><td colspan="2">{lang mkey="username_part_msg"}</td></tr>
				<tr><td height="3"></td></tr>
				<tr>
					<td >{lang mkey='blog_search_title'}: </td>
					<td  nowrap>
						<input name="srchblogtitle" value="{$smarty.session.advsearch.srchblogtitle}" type="text" class="textinput"  size="30" />
					</td>
				</tr>
				<tr>
					<td >{lang mkey='blog_search_body'}: </td>
					<td >
						<input name="srchblogbody" value="{$smarty.session.advsearch.srchblogbody}" type="text" class="textinput"  size="30" />
					</td>
				</tr>
				<tr valign="top">
					<td >{lang mkey='blog_search_date'}:</td>
					<td  nowrap>
						{html_select_date_translated prefix="start_date"  start_year="-10" month_value_format="%m" time=$starttime}
						&nbsp;{lang mkey='to'}&nbsp;
						{html_select_date_translated prefix="end_date" start_year="-5" month_value_format="%m" time=$endtime}
					</td>
				</tr>
			</table>
			<div class="line_top_bottom_pad">
				<input name="advsearch" type="submit" class="formbutton" value="{lang mkey='search'}" />&nbsp;<input type="reset" class="formbutton" value="{lang mkey='reset'}" />
			</div>
		</div>
	</form>
	</div>
</div>
<br />
{/strip}
