{strip}
<div class="module_detail_inside" style="width:100%; height:250px;vertical-align:top;">

	{include file="calendar_weekday_head.tpl"}
	<table width="100%" border="0" >
		<tr>
			<td valign="top" height="200">
				<table width="100%" border="0">
					<tr><td >
					{foreach item=event key=ekey from=$item.events}
					<a href="#" onclick="javascript: mainLink('event.php?event_id={$event.id}'); return(false);" class="oddrow">{$event.event|truncate:"80"}</a><br />
					{/foreach}
					{if $item.more_events}
					<a href="#" onclick="javascript: mainLink('moreevents.php?calendarid={$calendarid}&amp;timestamp={$item.timestamp}'); return(false);" class="evenrow">{lang mkey='more_events'}</a><br />
					{/if}
					</td></tr>
				</table>
			</td>
		</tr>
		<tr><td align="right">
				<a href="#" onclick="javascript:  mainLink('event.php?insert=true&amp;timestamp={$item.timestamp}'); return(false);"><img src="{$image_dir}new.gif" alt="{lang mkey='add_event'}" width="14" height="11" border="0" /></a>
			</td>
		</tr>
	</table>

</div>
{/strip}
