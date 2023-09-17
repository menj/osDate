{strip}
<div style="vertical-align:top;" >
	{assign var="page_hdr01_text" value="{lang mkey='watched_events'}"}
	{assign var="page_title" value="{lang mkey='watched_events'}"}
	{include file="page_hdr01.tpl"}
	<div class="module_detail_inside">

	{if $error == 1 }
		<div class="line_outer">
			{$noevent_msg}
		</div>
	{else}
	{foreach from=$events item=item}
		<div class="line_outer">
			{include file="eventresultviewsmall.tpl"}
		</div>
	{/foreach}
	{/if}
	</div>
</div>
{/strip}
