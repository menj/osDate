{strip}
<center>
<table width="100%" border="0" cellpadding="0" cellspacing="0" >
	<tr>
		<td class="module_detail_inside" width="100%" >

			<table width="100%" border="0" bgcolor="#FFFFFF">
			<tr><td valign="top" >
			<table width="100%" border="0" bgcolor="#FFFFFF">
				<tr class="table_head">
					<!--th>{lang mkey='col_head_datefrom'}</th>
					<th>{lang mkey='col_head_dateto'}</th-->
					<th width="15%">{lang mkey='col_head_date'}</th>
					<th width="85%">{lang mkey='col_head_event'}</th>
				</tr>

			{foreach item=event key=ekey from=$item.events}
			{cycle values="oddrow,evenrow" assign="class"}
			<tr class="{$class}">
					<!--td width="120" align="right">
						{if $item.date.year==$event.dt_from.year and $item.date.mon==$event.dt_from.mon and $item.date.mday==$event.dt_from.mday}
							{$event.datetime_from|date_format:"%H:%M"}
						{else}
							{$event.datetime_from|date_format:"%d/%m/%Y %H:%M"}
						{/if}
					</td>
					<td width="120" align="right">
						{if $item.date.year==$event.dt_to.year and $item.date.mon==$event.dt_to.mon and $item.date.mday==$event.dt_to.mday}
							{$event.datetime_to|date_format:"%H:%M"}
						{else}
							{$event.datetime_to|date_format:"%d/%m/%Y %H:%M"}
						{/if}
					</td-->
					<td width="15%" class="{$class}" align="right">
						{$event.datetime_from|date_format:"%H:%M"}
					</td>
					<td width="85%" class="{$class}"><a href="#" onclick="javascript: mainLink('event.php?event_id={$event.id}'); return(false);">{$event.event|truncate:"90"}</a></td>
				</tr>
			{/foreach}
			{if $item.more_events}
				<tr>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td><a href="#" onclick="javascript: mainLink('moreevents.php?calendarid={$calendarid}&amp;timestamp={$item.timestamp}'); return(false);">{lang mkey='more_events'}</a></td>
				</tr>
			{/if}
			</table>
			</td></tr></table>
		</td>
	</tr>
</table>
</center>
{/strip}
