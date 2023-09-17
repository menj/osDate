{strip}
{assign var="page_hdr01_text" value='<a href="import.php" class="subhead">'|cat:"{lang mkey='manage_import'}"|cat:'</a> > '|cat:"{lang mkey='manage_import_webdate'}"}
{assign var="page_title" value="{lang mkey='manage_import'} - "|cat:"{lang mkey='manage_import_webdate'}"}
{include file="admin/admin_page_hdr01.tpl"}
<br />
{section name=message loop=$messages}
	{$messages[message]}<br />
{/section}
<div class="top_margin_6px">
	{assign var="page_hdr02_text" value="{lang mkey='manage_import_select'}"|cat:' &nbsp;> &nbsp;<a class="subhead" style="font-weight: normal;" href="import_webdate.php?action=config">'|cat:"{lang mkey='import_config'}"|cat:'</a>'}
	{include file="admin/admin_page_hdr01.tpl"}
<div class="module_detail_inside" style="padding-top:1px; text-align:left;">
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
			{section name=field_array loop=$importing_fields}
			<tr class="evenrow">
				<td>{$importing_fields[field_array].question}</td>
				{assign var=section value=$importing_fields[field_array].section}
				<td align="right">{$imported[$section]}</td>
				<td>
					<a href="{$smarty.server.PHP_SELF}?module={$importing_fields[field_array].section}&amp;action=section">{lang mkey='import'}</a>&nbsp;&nbsp;&nbsp;
					<a href="{$smarty.server.PHP_SELF}?module={$importing_fields[field_array].section}">{lang mkey='empty'}</a>
				</td>
			</tr>
			{/section}
		</table>
	</div>
</div>
</div>
{/strip}
