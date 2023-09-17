{strip}
<div class="leftside_detail" style="vertical-align:top;" align="left">
	{assign var="leftcolumn_item_hdr_text" value="{lang mkey='member_panel'}"}
	{include file="leftcolumn_item_hdr.tpl"}
	{if $config.menutype == 'sideM'}
		<div style="margin-left:4px;">
			{include file="sidedropdownpanelmenu.tpl" }
		</div>
	{elseif $config.menutype == 'sideF'}
		{include file="panelmenu_options.tpl" }
	{/if}
</div>
{/strip}
