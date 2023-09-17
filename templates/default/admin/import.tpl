{strip}
{assign var="page_hdr01_text" value="{lang mkey='manage_import'}"}
{assign var="page_title" value="{lang mkey='manage_import'}"}
{include file="admin/admin_page_hdr01.tpl"}
<div class="module_detail_inside top_margin_6px">
	{assign var="page_hdr02_text" value="{lang mkey='manage_import_section'}"}
	{include file="admin/admin_page_hdr02.tpl"}
	<div >
		<div class="line_top_bottom_pad oddrow" style="padding-left: 6px;">
			<a href="import_datingpro.php">DatingPro</a>
		</div>
		<div class="line_top_bottom_pad oddrow" style="padding-left: 6px;">
			<a href="import_aedating.php">aeDating</a>
		</div>
		<div class="line_top_bottom_pad oddrow" style="padding-left: 6px;">
			<a href="import_webdate.php">Webdate</a>
		</div>
	</div>
</div>
{/strip}