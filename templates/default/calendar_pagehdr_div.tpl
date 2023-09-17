<div class="module_head" style="height:25px; vertical-align:middle; ">
	<div style=" display:inline; float:left;vertical-align:top; width:77px;"><img src="{$image_dir}blue_window_3_bars.jpg"  height="25" alt="" />
	</div>
	<div class="module_head" style="width:55%; display:inline; float:left; text-align:left;margin-top:2px;">
		<a href="#" onclick="javascript: mainLink('event.php?insert=true'); return(false);"><img src="{$image_dir}new.gif" alt="{lang mkey='add_event}" title="{lang mkey='add_event}" width="16" height="16" border="0" /></a>&nbsp;&nbsp;
		{if $allcalendars|@count > 1}
			{lang mkey='calendar'}&nbsp;
			<select name="txtcalendar" onchange="javascript: document.location.href='{$smarty.server.PHP_SELF}?calendarid='+this.value+'&amp;timestamp={$timestamp}';">
			{html_options options=$allcalendars selected=$calendarid}
			</select>&nbsp;&nbsp;&nbsp;
		{/if}
		<a href="{$smarty.server.PHP_SELF}?calendarid={$calendarid}&amp;timestamp={$timestamp}&amp;show=private"><img src="{$image_dir}private.gif" alt="{lang mkey='private_only'}" title="{lang mkey='private_only'}" width="16" height="16" border="0" /></a>&nbsp;
		<a href="{$smarty.server.PHP_SELF}?calendarid={$calendarid}&amp;timestamp={$timestamp}&amp;show=public"><img src="{$image_dir}public.gif" alt="{lang mkey='public_only'}" title="{lang mkey='public_only'}" width="16" height="16" border="0" /></a>&nbsp;
		<a href="{$smarty.server.PHP_SELF}?calendarid={$calendarid}&amp;timestamp={$timestamp}&amp;show=both"><img src="{$image_dir}privatepublic.gif" alt="{lang mkey='public_private'}" title="{lang mkey='public_private'}" width="16" height="16" border="0" /></a>&nbsp;&nbsp;&nbsp;
		{if $calendar_type =='D'}
			<img src="{$image_dir}view_d1.gif" alt="{lang mkey='view_day'}" width="16" height="16" border="0" />
		{else}
			<a href="{$smarty.server.PHP_SELF}?calendarid={$calendarid}&amp;timestamp={$timestamp}&amp;view=day"><img src="{$image_dir}view_d.gif" alt="{lang mkey='view_day'}" width="16" height="16" border="0" /></a>
		{/if}
		&nbsp;&nbsp;&nbsp;
		{if $calendar_type =='W'}
			<img src="{$image_dir}view_w1.gif" alt="{lang mkey='view_week}" width="16" height="16" border="0" />
		{else}
			<a href="{$smarty.server.PHP_SELF}?calendarid={$calendarid}&amp;timestamp={$timestamp}&amp;view=week"><img src="{$image_dir}view_w.gif" alt="{lang mkey='view_week'}" width="16" height="16" border="0" /></a>
		{/if}
		&nbsp;&nbsp;&nbsp;
		{if $calendar_type =='M'}
			<img src="{$image_dir}view_m1.gif" alt="{lang mkey='view_month'}" width="16" height="16" border="0" />
		{else}
			<a href="{$smarty.server.PHP_SELF}?calendarid={$calendarid}&amp;timestamp={$timestamp}&amp;view=month"><img src="{$image_dir}view_m.gif" alt="{lang mkey='view_month'}" width="16" height="16" border="0" /></a>
		{/if}
		&nbsp;&nbsp;&nbsp;
	</div>
	<div class="module_head" style="display:inline; float:right; text-align:right; margin-right:2px; width:35%; margin-top:2px;">
		<form action="{$smarty.server.PHP_SELF}?calendarid={$calendarid}" method="post" enctype="multipart/form-data">
			<input type="hidden" name="jump_to" value="true"/>
			{lang mkey='jump_to'}: &nbsp;{html_select_date_translated prefix="jump_date" time=$timestamp start_year="-5" end_year="+5"}&nbsp;<input type="submit" class="formbutton" value="{lang mkey='ok'}"/>
		</form>
	</div>
	<div style="clear:both;"></div>
</div>
<div style="clear:both;"></div>