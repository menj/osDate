{strip}
{assign var="page_hdr01_text" value="{lang mkey='ip2country_map'}"}
{assign var="page_title" value="{lang mkey='ip2country_map'}"}
{include file="admin/admin_page_hdr01.tpl"}
<div class="top_margin_6px">
	{assign var="page_hdr02_text" value="{lang mkey='ip2country_map'} {lang mkey='loading'}"}
	{include file="admin/admin_page_hdr02.tpl"}
	<div class="module_detail_inside" style="padding-top:1px; text-align:left;">
		{lang mkey='loading'} {lang mkey="from"} {$startcnt}
	</div>
</div>
{/strip}