{strip}
{assign var="leftcolumn_item_hdr_text" value="{lang mkey='admin_panel'}"}
{include file="leftcolumn_item_hdr.tpl"}
<div class="module_detail_inside">
	{if $config.adminmenutype == 'sideM'}
		<div style="margin-left:4px;">
			{include file="admin/sidedropdownpanelmenu.tpl" }
		</div>
	{elseif $config.adminmenutype == 'sideF'}
		{include file="admin/panelmenu_options.tpl" }
	{/if}
</div>
{/strip}