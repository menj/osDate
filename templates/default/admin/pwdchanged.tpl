{strip}
{assign var="page_hdr01_text" value="{lang mkey='change_password'}"}
{assign var="page_title" value="{lang mkey='change_password'}"}
{include file="admin/admin_page_hdr01.tpl"}
<div class="module_detail_inside" style="padding-top:6px;">
	{assign var="page_hdr02_text" value="{lang mkey='change_password'}"}
	{include file="admin/admin_page_hdr02.tpl"}
	<div class="line_outer" style="padding:5px;">
		{assign var="error_message" value="{lang mkey='password_changed_successfully'}" }
		{include file="display_error.tpl"}
		<br /><br />
		{lang mkey='logout_login'}</td>
	</div>
</div>
{/strip}