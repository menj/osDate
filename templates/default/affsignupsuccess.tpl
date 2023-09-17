{strip}
<div style="vertical-align:top;" >
	{assign var="page_title" value="{lang mkey='affiliates'}"}
	{assign var="page_hdr01_text" value="{lang mkey='affiliate_registration_success'}"}
	{include file="page_hdr01.tpl"}
	<div class="module_detail_inside">
		<div class="line_outer">
			{lang mkey='affiliate_success_msg1'}&nbsp;{$affid}
		</div>
		<div class="line_outer">
			{lang mkey='affiliate_success_msg2'}<a href="afflogin.php">{lang mkey='login_now'}</a>
		</div>
	</div>
</div>
{/strip}
