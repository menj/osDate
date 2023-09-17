{strip}
{assign var="page_hdr01_text" value="{lang mkey='welcome'} "|cat:$smarty.session.AdminName}
{assign var="page_title" value="{lang mkey='welcome'} "}
{include file="admin/admin_page_hdr01.tpl"}
<div class="module_detail_inside top_margin_6px" style="text-align:left;">
	{if isset($change_pwd) && $change_pwd == 1 }
		<div class="line_outer">
			<font size="3"><b>{lang mkey='please_be_sure'}&nbsp;<a href="changepwd.php">{lang mkey='change_your_admin_pwd'}</a></b></font>
		</div>
	{/if}
	{assign var="page_hdr02_text" value="{lang mkey='site_statistics'}"}
	{include file="admin/admin_page_hdr02.tpl"}
	<div class="line_outer">
		<table align="center" width="100%" cellspacing="5" cellpadding="1" border="0">
			<tr class="oddrow"><td><a href="unapprovedusers.php">{lang mkey='pending_profiles'}</a></td><td>{$pending_users}</td></tr>
			<tr class="evenrow"><td><a href="profile.php">{lang mkey='active_profiles'}</a></td><td>{$active_users}</td></tr>
			<tr class="oddrow"><td><a href="onlineusers.php">{lang mkey='online_profiles'}</a></td><td>{$online_users_count}</td></tr>
			<tr class="evenrow"><td><a href="affiliatesview.php">{lang mkey='pending_aff'}</a></td><td>{$pending_aff}</td></tr>
			<tr class="oddrow"><td><a href="affiliatesview.php">{lang mkey='active_aff'}</a></td><td>{$active_aff}</td></tr>
		</table>
	</div>
</div>
{/strip}