{strip}
<div style="vertical-align:top;" >

{if $error_msg != ''}
	{assign var="page_hdr01_text" value="{lang mkey='payment_fail'}"}
	{assign var="page_title" value="{lang mkey='payment_fail'}"}
	{include file="page_hdr01.tpl"}
	<div class="module_detail_inside">
		<div class="line_outer">
			{lang mkey='payment_failed'}
		</div>
	</div>
{else}
	{assign var="page_hdr01_text" value="{lang mkey='mship_changed'}"}
	{assign var="page_title" value="{lang mkey='mship_changed'}"}
	{include file="page_hdr01.tpl"}
	<div class="module_detail_inside">
		<div class="line_outer">
			{lang mkey='success_mship_change'} <b>{$level}</b>.<br /><br />{lang mkey='loginagain'}
		</div>
	</div>
{/if}
</div>
{/strip}
