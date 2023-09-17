{strip}
<div class="module_detail_inside" style="width:100%;height:250px;vertical-align:top;">
	<div class="module_head" style="height:23px;">
		<div style="display:inline; float:left; margin-right:28px; padding-top:4px;" >
			&nbsp;&nbsp;<a href="#" onclick="javascript: mainLink('moreevents.php?calendarid={$calendarid}&amp;timestamp={$item.timestamp}'); return(false);" class="module_head">{$item.date.mday}&nbsp;{mylang mkey='day_names' skey=$item.date.weekday}</a>
		</div>
		<div style="display:inline; float:right; width:28px; margin-left: -28px;"><img src="{$image_dir}blue_hor2.jpg" width="28" height="23" alt="" />
		</div>
		<div style="clear:both;"></div>
	</div>

	<div style="vertical-align:top; height:210px; padding-left: 4px; padding-right: 2px;">
	{foreach item=event key=ekey from=$item.events}
		<a href="#" onclick="javascript: mainLink('event.php?event_id={$event.id}'); return(false);" class="oddrow">{$event.event|truncate:"24"}</a><br />
	{/foreach}
	{if $item.more_events}
		<a href="#" onclick="javascript: mainLink('moreevents.php?calendarid={$calendarid}&amp;timestamp={$item.timestamp}'); return(false);" class="evenrow">{lang mkey='more_events'}</a><br />
	{/if}
	</div>
	<div align="right" style="padding-right: 4px;">
		<a href="#" onclick="javascript:  mainLink('event.php?insert=true&amp;timestamp={$item.timestamp}'); return(false);"><img src="{$image_dir}new.gif" alt="{lang mkey='add_event'}" width="14" height="11" border="0" /></a>
	</div>
</div>
{/strip}
