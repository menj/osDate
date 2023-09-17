{strip}
<table width="100%" border="0" cellpadding="0" cellspacing="0" >
	<tr>
		<td class="module_detail_inside" width="100%" height="85" valign="top">

			<table width="100%" border="0" cellpadding="0" cellspacing="0" >
				<tr>
					<td class="module_head" width="6"></td>
					<td width="100%" class="module_head">
						&nbsp;&nbsp;<a href="#" onclick="javascript: mainLink('moreevents.php?calendarid={$calendarid}&amp;timestamp={$item.timestamp}'); return(false);"><font color="#FFFFFF">{$item.date.mday}</font></a><br />
					</td>
					<td width="22"><img src="{$image_dir}blue_hor2.jpg" width="22"  height="23" alt="" /></td>
				</tr>
			</table>
			<table width="100%" border="0" {if $item.date.mon == $cur_date.mon}bgcolor="#FFFFFF"{else}bgcolor="#cccccc"{/if}>
				<tr>
					<td valign="top" height="50">
					{foreach item=event key=ekey from=$item.events}
						<a href="#" onclick="javascript: mainLink('event.php?calendarid={$calendarid}&amp;event_id={$event.id}'); return(false);" class="oddrow">{$event.event|truncate:"16"}</a><br />
					{/foreach}
					{if $item.more_events}
						<a href="#" onclick="javascript: mainLink('moreevents.php?calendarid={$calendarid}&amp;timestamp={$item.timestamp}'); return(false);" class="evenrow">{lang mkey='more_events'}</a><br />
					{/if}
					</td>
				</tr>
				<tr>
					<td height="10" align="right">
						<a href="#" onclick="javascript: mainLink('event.php?calendarid={$calendarid}&amp;insert=true&amp;timestamp={$item.timestamp}'); return(false);"><img src="{$image_dir}new.gif" alt="{lang mkey='add_event'}" width="14" height="9" border="0" /></a>
					</td>
				</tr>
			</table>

		</td>
	</tr>
</table>
{/strip}
