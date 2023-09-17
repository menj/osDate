{strip}
{assign var="page_hdr01_text" value='<a href="import.php" class="subhead">'|cat:"{lang mkey='manage_import'}"|cat:'</a> > '|cat:"{lang mkey='manage_import_datingpro'}"}
{assign var="page_title" value="{lang mkey='manage_import'} - "|cat:"{lang mkey='manage_import_datingpro'}"}
{include file="admin/admin_page_hdr01.tpl"}
<br />
{section name=message loop=$messages}
	{$messages[message]}<br>
{/section}
<div class="module_detail_inside top_margin_6px">
	{assign var="page_hdr02_text" value="{lang mkey='manage_import_select'}"|cat:'&nbsp;&nbsp;<a class="subhead" style="font-weight: normal;" href="import_datingpro.php?action=config">'|cat:"{lang mkey='import_config'}"|cat:'</a>'}
	{include file="admin/admin_page_hdr02.tpl"}
	<div class="line_outer">
		<table align="center" width="100%" cellspacing="5" cellpadding="1" border="0">
			<tr class="column_head">
				<th>{lang mkey='module'}</th>
				<th>{lang mkey='imported'}</th>
				<th>{lang mkey='action'}</th>
			</tr>
			<tr class="oddrow">
				<td>Users</td>
				<td align="right">{$imported.users}</td>
				<td>
					<a href="{$smarty.server.PHP_SELF}?module=users&amp;action=import">{lang mkey='import'}</a>&nbsp;&nbsp;&nbsp;
					<a href="{$smarty.server.PHP_SELF}?module=users">{lang mkey='empty'}</a>
				</td>
			</tr>
		</table>
	</div>
</div>
{/strip}