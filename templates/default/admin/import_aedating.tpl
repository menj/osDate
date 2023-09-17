{strip}
{assign var="page_hdr01_text" value='<a href="import.php" class="subhead">'|cat:"{lang mkey='manage_import'}"|cat:'</a> > '|cat:"{lang mkey='manage_import_aedating'}"}
{assign var="page_title" value="{lang mkey='manage_import'} "|cat:"{lang mkey='manage_import_aedating'}"}
{include file="admin/admin_page_hdr01.tpl"}
<BR />
{section name=message loop=$messages}
	{$messages[message]}<br>
{/section}
<BR />
<CENTER>
<div class="module_detail top_margin_6px">
	{assign var="page_hdr02_text" value="{lang mkey='manage_import_select'}"|cat:' &nbsp;&nbsp;<a class="subhead"  href="import_aedating.php?action=config">'|cat:"{lang mkey='import_config'}"|cat:' </a>'}
	{include file="admin/admin_page_hdr02.tpl"}
	<div class="line_outer">
		<table align="center" width="100%" cellspacing="5" cellpadding="1" border="0">

			<tr class="table_head">
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
{/strip}