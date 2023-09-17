<!-- Event Start -->
<table border="0" cellpadding="0" cellspacing="3"  width="100%">
	<tr >
		<td valign="top"  width="100%" colspan="2">
		<table width="100%" >
			<tr>
				<td width="13%" nowrap><b>{lang mkey='start_date'}:</b>
				</td>
				<td width="37%">{$item.datetime_from|date_format:$lang.DATE_FORMAT}</td>
				<td width="13%"><b>{lang mkey='end_date'}:</b></td>
				<td width="37%" nowrap>{$item.datetime_to|date_format:$lang.DATE_FORMAT}</td>
			</tr>
			<tr>
				<td nowrap><b>{lang mkey='start_time'}:</b></td>
				<td nowrap>{$item.datetime_from|date_format:"%I:%M %p"}</td>
				<td nowrap><b>{lang mkey='end_time'}:</b></td>
				<td nowrap>{$item.datetime_to|date_format:"%I:%M %p"}</td>
			</tr>
		</table><br />
		</td>
	</tr>
	<tr >
		<td width="13%" style="padding-left: 2px;">
			<b>{lang mkey='recurring'}</b>
		</td>
		<td style="padding-left:4px;">
		{if $item.recurring  != 0}
			{lang mkey='yes'},&nbsp;
			{lang mkey='recur_every'}&nbsp;{$item.recuroption}&nbsp;{mylang mkey='recuring_labels' skey=$item.recurring}
		{else}
			{lang mkey='no'}
		{/if}
		</td>
	</tr>
	<tr>
		<td  style="padding-left: 2px;"><b>{lang mkey='view_type'}:</b></td>
		<td style="padding-left:4px;">{if $item.private_to != ""}{lang mkey='private_event'}{else}{lang mkey='public_event'}{/if}
		</td>
	</tr>
	<tr >
		<td  style="padding-left: 2px;"><b>{lang mkey='calendar'}</b></td>
		<td style="padding-left:4px;">
			{$item.calendar_name}
		</td>
	</tr>
	<tr >
		<td  style="padding-left: 2px;"><b>{lang mkey='posted_by'}:</b></td><td style="padding-left:4px;">
			{if $item.usertype != 'admin'}
				{if $config.enable_mod_rewrite == 'Y'}
					<a href="javascript:popUpScrollWindow2('{$docroot}{if $config.seo_username == 'Y'}{$item.username}{else}{$item.userid}.htm{/if}','top',650,600)">
				{else}
					<a href="javascript:popUpScrollWindow2('{$docroot}showprofile.php?{if $config.seo_username == 'Y'}username={$item.username}{else}id={$item.userid}{/if}','top',650,600)">
				{/if}
				{$item.username}</a>
			{else}
				{$item.username}
			{/if}
			</td>
	</tr>
	<tr >
		<td valign="top" colspan="2"  style="padding-left: 2px;"><br /><b>{lang mkey='event_description'}:</b></td>
	</tr>
	<tr >
		<td valign="top" colspan="2"  style="padding-left: 2px;">
		{if $item.description != ''}
			{$item.description|nl2br}
		{else}
			{lang mkey='no_event_description'}
		{/if}
		</td>
	</tr>
	<tr >
		<td align='right' colspan="2">
		{if $item.watched}
			<a href="watchevents.php?delete={$item.id}"><img src="{$image_dir}unwatch.gif" border="0" alt="" /></a>
		{else}
			<a href="watchevents.php?add={$item.id}"><img src="{$image_dir}watch.gif" border="0" alt="" /></a>
		{/if}
		{if $item.userid == $smarty.session.UserId}
			<a href="event.php?edit={$item.id}"><img src="{$image_dir}button_edit.png" border="0" alt="Edit" /></a>
			<a href="event.php?delete={$item.id}" onclick="javascript:return(confirm('{lang mkey='admin_js__delete_error_msgs skey='25'}'))"><img src="{$image_dir}button_drop.png" alt="{lang mkey='delete'}" border="0" /></a>
		{/if}
		</td>
	</tr>
</table>
<!-- Event Ends -->
