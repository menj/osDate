{strip}
<div style="vertical-align:top; width:100%;" >
	{assign var="page_hdr01_text" value="{lang mkey='event'} "|cat:$event.event}
	{assign var="page_title" value="{lang mkey='event'} "|cat:$event.event}
	{include file="page_hdr01.tpl"}
	<div class="module_detail_inside" style="width:100%;">
		<div class="line_outer" style="width:100%;">
		{if $error == 1 }
			{lang mkey='no_record_found'}
		{else}
			{assign var="item" value=$event}
			{include file="eventresultviewsmall.tpl"}
		{/if}
		</div>
	</div>
</div>
{/strip}
