{strip}
{assign var="page_hdr01_text" value='<a href="section.php" class="subhead">'|cat:"{lang mkey='section_title'}"|cat:'</a>&nbsp;>&nbsp;<a href="sectionquestions.php?sectionid='|cat:$sectionid|cat:'" class="subhead">'|cat:"{lang mkey='questions_title'}"|cat:'</a>&nbsp;>></span>&nbsp;'|cat:"{lang mkey='delete_questions'}"}
{assign var="page_title" value="{lang mkey='section_title'} - "|cat:"{lang mkey='questions_title'}"|cat:" - "|cat:"{lang mkey='delete_questions'}"}
{include file="admin/admin_page_hdr01.tpl"}
<div class="top_margin_6px">
	{assign var="page_hdr02_text" value="{lang mkey='delete_questions'}"}
	{include file="admin/admin_page_hdr02.tpl"}
	<div class="module_detail_inside" style="padding-top:1px; text-align:left;">
		{if $error != ''}
			{assign var="error_message" value=$error}
			{include file="display_error.tpl"}
		{/if}
		<div class="line_outer">
			<form action="endisquestions.php" method="post">
				<input name="sectionid" value="{$sectionid}" type="hidden" />
			<table class="table" cellspacing="{$config.cellspacing}" cellpadding="{$config.cellpadding}" width="410" border="0">
				<tr><td colspan="3">
					<font color="{lang mkey='admin_error_color'}">{lang mkey='delete_group_questions_confirm_msg'}</font></td>
				</tr>
				<tr class="column_head">
					<th>{lang mkey='col_head_id'}</th>
					<th>{lang mkey='col_head_name'}</th>
					<th>{lang mkey='col_head_enabled'}</th>
				</tr>
			{foreach item=item key=key from=$data}
				<tr>
					<td>{$item.id}
						<input type="hidden" name="txtid[{$item.id}]" value="{$item.id}" />
					</td>
					<td>{$item.question|stripslashes}</td>
					<td>{$item.enabled}</td>
				</tr>
			{/foreach}
				<tr>
					<td>&nbsp;</td>
					<td>
						<input type="submit" class="formbutton" value="{lang mkey='delete'}" />
						<input type="hidden" name='frm' value='frmGroupDelete'>
					</td>
					<td>&nbsp;</td>
				</tr>
			</table>
			</form>
		</div>
	</div>
</div>
{/strip}