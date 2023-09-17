{if $bdp == $smarty.session.UserId}
	{include file="happy_birthday.tpl" }
	<br />
{/if}
<table  width="100%" cellpadding="{$config.cellpadding}"  cellspacing="{$config.cellspacing}" border="0">
	<tr class="oddrow">
		<td width="50%">
			{lang mkey='current_mship_level'}
		</td>
		<td >
			{$curlevel}
		</td>
	</tr>
	<tr class="evenrow">
		<td >
			{lang mkey='expire_on'}:
		</td>
		<td >
			{$end_date}
		</td>
	</tr>
	<tr class="oddrow">
		<td >
			{lang mkey='expire_in'}:
		</td>
		<td >
			{if $bal_days >= 0}
				{$bal_days}
			{else}
				{mylang mkey='expird'}
			{/if}
		</td>
	</tr>
	<tr class="evenrow">
		<td >
			{if $profpicscnt > 0}
				<a href="javascript:popUpScrollWindow2('{$docroot}userpicgallery.php?id={$smarty.session.UserId}&amp;type=profilepics','center',650,600)">
				{lang mkey='profpics_gallery'}</a>:
			{else}
				{lang mkey='profpics_gallery'}:
			{/if}
		</td>
		<td >
			{$profpicscnt|default:0} {if $profpicscnt <= 0}
				[<a class="panellink" href="{$docroot}uploadsnaps.php?type=profilepics">{lang mkey='upload_profilepics'}</a>]{/if}
		</td>
	</tr>
	<tr class="oddrow">
		<td >
			{if $albumpicscnt > 0}
				<a href="javascript:popUpScrollWindow2('{$docroot}userpicgallery.php?id={$smarty.session.UserId}&amp;type=gallery','center',650,600)">
				{lang mkey='picturegallery'}</a>:
			{else}
				{lang mkey='picturegallery'}:
			{/if}
		</td>
		<td >
			{$albumpicscnt|default:0}
		</td>
	</tr>
	<tr class="evenrow">
		<td >
			{if $new_messages > 0}
				<a href="mailmessages.php?messages=inbox">
				{lang mkey='newmessages'}</a>
			{else}
				{lang mkey='newmessages'}
			{/if}
		</td>
		<td >
			{$new_messages}
		</td>
	</tr>
	<tr class="oddrow">
		<td >
			{if $profile_views > 0}
				<a href="listviewswinks.php?id={$smarty.session.UserId}&amp;act=V">									{lang mkey='profileviewed'}</a>
			{else}
				{lang mkey='profileviewed'}
			{/if}
		</td>
		<td >
			{$profile_views} ({lang mkey='since'} {$viewswinks_since})
		</td>
	</tr>
	<tr class="evenrow">
		<td >
			{if $winks > 0}
				<a href="listviewswinks.php?id={$smarty.session.UserId}&amp;act=W">									{lang mkey='winks_received'}</a>
			{else}
				{lang mkey='winks_received'}
			{/if}
		</td>
		<td >
			{$winks} ({lang mkey='since'} {$viewswinks_since})
		</td>
	</tr>
	<tr class="oddrow">
		<td >
			{if $online_users_count > 0}
				<a href="onlineusers.php">{lang mkey='online_users'}</a>
			{else}
				{lang mkey='online_users'}
			{/if}
		</td>
		<td >
			{$online_users_count}
		</td>
	</tr>
	<tr class="evenrow">
		<td >
			{lang mkey='prof_quest_man'}
		</td>
		<td >
			{$profquestions_must_ans_cnt|default:0} {lang mkey='of'}{$profquestions_must_cnt|default:0}
			{if $profquestions_must_ans_cnt < $profquestions_must_cnt and  $smarty.session.expired != 1 and $smarty.session.active == '1' }	[<a class="panellink" href="{$docroot}editquestions.php">{lang mkey='myprofilepreferences'}</a>]{/if}
		</td>
	</tr>
	<tr class="oddrow">
		<td >
			{lang mkey='prof_quest_nonman'}
		</td>
		<td >
			{$profquestions_nonmust_ans_cnt|default:0} {lang mkey='of'}{$profquestions_nonmust_cnt|default:0} {if $profquestions_nonmust_ans_cnt < $profquestions_nonmust_cnt and $smarty.session.expired != 1 and $smarty.session.active == '1' }	[<a class="panellink" href="{$docroot}editquestions.php">{lang mkey='myprofilepreferences'}</a>]
			{/if}
		</td>
	</tr>
</table>
{if $new_messages >= 1}
	<object data="Mail04.wav" type="audio/x-mplayer2" width="0" height="0">
	<param name="src" value="Mail04.wav">
	<param name="autoplay" value="true">
	<param name="autoStart" value="1">
	</object>
{/if}
<br />
