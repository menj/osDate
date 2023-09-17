<table width="100%" border="0" cellpadding="0" cellspacing="0" class="calendar_module_head">
	<tr>
		<td width="77" valign="top" class="calendar_module_head"><img src="{$image_dir}blue_window_3_bars.jpg" width="77" height="25" alt="" /></td>
		<td width="52%" align="left" class="calendar_module_head">
			<a href="#" onclick="javascript: mainLink('event.php?insert=true'); return(false);"><img src="{$image_dir}new.gif" alt="{lang mkey='add_event}" title="{lang mkey='add_event}" width="14" height="11" border="0" /></a>&nbsp;&nbsp;
			{lang mkey='calendar'}&nbsp;
			{if $allcalendars|@count > 1}
				<select name="txtcalendar" onchange="javascript: document.location.href='{$smarty.server.PHP_SELF}?calendarid='+this.value+'&amp;timestamp={$timestamp}';">
				{html_options options=$allcalendars selected=$calendarid}
				</select>
			{else}
				{$allcalendars[$calendarid]}
			{/if}
			&nbsp;&nbsp;&nbsp;
			<a href="{$smarty.server.PHP_SELF}?calendarid={$calendarid}&amp;timestamp={$timestamp}&amp;show=private"><img src="{$image_dir}private.gif" alt="{lang mkey='private_only'}" title="{lang mkey='private_only'}" width="16" height="16" border="0" /></a>&nbsp;
			<a href="{$smarty.server.PHP_SELF}?calendarid={$calendarid}&amp;timestamp={$timestamp}&amp;show=public"><img src="{$image_dir}public.gif" alt="{lang mkey='public_only'}" title="{lang mkey='public_only'}" width="16" height="16" border="0" /></a>&nbsp;
			<a href="{$smarty.server.PHP_SELF}?calendarid={$calendarid}&amp;timestamp={$timestamp}&amp;show=both"><img src="{$image_dir}privatepublic.gif" alt="{lang mkey='public_private'}" title="{lang mkey='public_private'}" width="16" height="16" border="0" /></a>&nbsp;&nbsp;&nbsp;
			{if $calendar_type =='D'}
				<img src="{$image_dir}view_d1.gif" alt="{lang mkey='view_day'}" title="{lang mkey='view_day'}" width="16" height="16" border="0" />
				{assign var="page_title" value="{lang mkey='view_day'}"}
			{else}
				<a href="{$smarty.server.PHP_SELF}?calendarid={$calendarid}&amp;timestamp={$timestamp}&amp;view=day"><img src="{$image_dir}view_d.gif" alt="{lang mkey='view_day'}" width="16" height="16" border="0" title="{lang mkey='view_day'}"/></a>
			{/if}
			&nbsp;&nbsp;&nbsp;
			{if $calendar_type =='W'}
				<img src="{$image_dir}view_w1.gif" alt="{lang mkey='view_week}" width="16" height="16" border="0" title="{lang mkey='view_week}" />
				{assign var="page_title" value="{lang mkey='view_week'}"}
			{else}
				<a href="{$smarty.server.PHP_SELF}?calendarid={$calendarid}&amp;timestamp={$timestamp}&amp;view=week"><img src="{$image_dir}view_w.gif" alt="{lang mkey='view_week'}" width="16" height="16" border="0" title="{lang mkey='view_week}" /></a>
			{/if}
			&nbsp;&nbsp;&nbsp;
			{if $calendar_type =='M'}
				<img src="{$image_dir}view_m1.gif" alt="{lang mkey='view_month'}" width="16" height="16" border="0" title="{lang mkey='view_month}" />
				{assign var="page_title" value="{lang mkey='view_month'}"}
			{else}
				<a href="{$smarty.server.PHP_SELF}?calendarid={$calendarid}&amp;timestamp={$timestamp}&amp;view=month"><img src="{$image_dir}view_m.gif" alt="{lang mkey='view_month'}" width="16" height="16" border="0" title="{lang mkey='view_month}" /></a>
			{/if}
		</td>
		<td align="right"  width="40%" class="calendar_module_head">
			<form action="{$smarty.server.PHP_SELF}?calendarid={$calendarid}" method="post" enctype="multipart/form-data">
			<input type="hidden" name="jump_to" value="true" />
			<input type="hidden" name="show" value="{$display_events}" />
			{lang mkey='jump_to'}: &nbsp;{html_select_date_translated prefix="jump_date" time=$timestamp start_year="-5" end_year="+5"}&nbsp;<input type="submit" class="formbutton" value="{lang mkey='ok'}"/>&nbsp;
			</form>
		</td>
	</tr>
	<tr>
		<td colspan="3" align="center"  class="calendar_module_head">
			<div  style="padding-bottom: 2px;" class="calendar_module_head">
				{lang mkey='now_showing'}
				{if $display_events == 'private'}
					{mylang mkey="private_only"}
				{elseif $display_events == 'public'}
					{mylang mkey="public_only"}
				{else $display_events == 'both'}
					{mylang mkey="public_private"}
				{/if}
				{lang mkey="events"}
			</div>
		</td>
	</tr>
</table>
