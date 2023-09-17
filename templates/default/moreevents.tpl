{strip}
<div style="vertical-align:top;" >
	{assign var="dt" value=$date|date_format:'%d/%m/%Y'}
	{assign var="page_hdr01_text" value="{lang mkey='daily_events_list'} "|cat:$dt}
	{assign var="page_title" value="{lang mkey='daily_events_list'}"}
	{include file="page_hdr01.tpl"}
	<div class="module_detail_inside">

		<div class="line_outer">
		{if $error == 1 }
			{assign var="error_message" value="{lang mkey='no_event_for_the_day'}" }
			{include file="display_error.tpl"}
		{else}
			{foreach from=$events item=item}
				<div class="line_top_bottom_pad">
					{include file="eventresultviewsmall.tpl"}
				</div>
			{/foreach}
		{/if}
		</div>
	</div>
</div>
{/strip}
