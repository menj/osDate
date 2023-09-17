{strip}
<div class="leftside_detail" style="vertical-align:top;">
	{assign var="leftcolumn_item_hdr_text" value="{lang mkey='events_for_today'}"}
	{include file="leftcolumn_item_hdr.tpl"}
	{foreach item=event key=ekey from=$showevents}
		{cycle values="oddrow,evenrow" assign="class"}
		<div class="{$class}" style="padding:4px;">
			<a href="event.php?event_id={$event.id}')">{$event.event|truncate:"90"}</a>
		</div>
	{/foreach}
</div>
{/strip}
