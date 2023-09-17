{strip}
<div class="module_detail_inside" style="width:100%;" >
	<div class="module_head" style="line-height: 23px; vertical-align: middle; text-align:right;">
		<img src="{$image_dir}blue_hor2.jpg" width="28" height="23" alt="" />
	</div>
	<div class="module_detail_inside" >
		<div class="column_head" style="width:15%; display:inline; float:left;">{lang mkey='time_nocol'}</div>
		<div class="column_head" style="display:inline; float:left; margin-left: 2px; width:84.5%;">{lang mkey='col_head_event'}</div>
		<div style="clear:both"></div>
	</div>
{foreach item=event key=ekey from=$item.events}
{cycle values="oddrow,evenrow" assign="class"}
	<div class="{$class} line_outer">
		<div style="display:inline; float:left; width:15%; text-align:center;">
			{$event.datetime_from|date_format:"%H:%M"}
		</div>
		<div style="display:inline; float:left; margin-left:2px; text-align:left;">
			<a href="#" onclick="javascript: mainLink('event.php?event_id={$event.id}'); return(false);">{$event.event|truncate:"90"}</a>
		</div>
		<div style="clear:both;"></div>
	</div>
{/foreach}
	<div style="clear:both;"></div>
{if $item.more_events}
	<div class="line_outer" style="margin-right: 40%;">
		<a href="#" onclick="javascript: mainLink('moreevents.php?calendarid={$calendarid}&amp;timestamp={$item.timestamp}'); return(false);">{lang mkey='more_events'}</a>
	</div>
{/if}
</div>
{/strip}
