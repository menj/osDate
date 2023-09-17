{strip}
{assign var="page_hdr01_text" value="{lang mkey='welcome'} "|cat:$smarty.session.AdminName}
{assign var="page_title" value="{lang mkey='welcome'} "}
{include file="admin/admin_page_hdr01.tpl"}
<center>
{if $change_pwd == 1 }
<div style="margin-top:10px; margin-bottom:10px; text-align:center; vertical-align:middle; height:16pt;">
	<font size="2"><b>{lang mkey='please_be_sure'}&nbsp;<a href="changepwd.php">{lang mkey='change_your_admin_pwd'}</a></b></font>
</div>
{/if}

<div class="top_margin_6px" style="width:85%;text-align:center;">
	{assign var="page_hdr02_text" value="{lang mkey='site_statistics'}"}
	{include file="admin/admin_page_hdr02.tpl"}
	<div class="module_detail_inside">

	<table align="center" width="100%" cellspacing="5" cellpadding="1" border="0">
		<tr><td><strong>{lang mkey='mainstats'}:</strong></td></tr>
		<tr class="oddrow">
			<td >{if $pending_users eq '0'}
					{lang mkey='pending_profiles'}
				{else}
					<a href="unapprovedusers.php">{lang mkey='pending_profiles'}</a>
				{/if}
			</td>
			<td>{$pending_users}</td>
		</tr>
		<tr class="evenrow">
			<td >
				{if $active_users eq '0'}
					{lang mkey='active_profiles'}
				{else}
					<a href="profile.php?status=active">{lang mkey='active_profiles'}</a>
				{/if}
			</td>
			<td>{$active_users}</td>
		</tr>
		<tr class="oddrow">
			<td>
				{if $online_users eq '0'}
					{lang mkey='online_profiles'}
				{else}
					<a href="onlineusers.php">{lang mkey='online_profiles'}</a>
				{/if}
			</td>
			<td>{$online_users|default:0}</td>
		</tr>
		<tr class="evenrow">
			<td>
				{if $pending_aff eq '0'}
					{lang mkey='pending_aff'}
				{else}
					<a href="affiliatesview.php">{lang mkey='pending_aff'}</a>
				{/if}
			</td>
			<td>{$pending_aff}</td>
		</tr>
		<tr class="oddrow">
			<td>
				{if $active_aff eq '0'}
					{lang mkey='active_aff'}
				{else}
					<a href="affiliatesview.php">{lang mkey='active_aff'}</a>
				{/if}
			</td>
			<td>{$active_aff}</td>
		</tr>
		<tr class="evenrow"><td>{lang mkey='osdate_version'}</td><td>{$smarty.const.VERSION}</td></tr>
		<tr><td>&nbsp;</td></tr>
		<tr><td><strong>{lang mkey='signonstats'}:</strong></td></tr>
		<tr class="evenrow">
			<td>{if $visit_min > 0}
				<a href="profile.php?time={$time}&amp;statfor=usersinpastminute">
					{lang mkey='usersinpastminute'}
				</a>
				{else}
					{lang mkey='usersinpastminute'}
				{/if}:</td>
			<td>{$visit_min}</td>
		</tr>
		<tr class="oddrow">
			<td>{if $visit_hour > 0}
					<a href="profile.php?time={$time}&amp;statfor=usersinpasthour">
						{lang mkey='usersinpasthour'}
					</a>
				{else}
					{lang mkey='usersinpasthour'}
				{/if}:</td>
			<td>{$visit_hour}</td>
		</tr>
		<tr class="evenrow">
			<td>{if $visit_day > 0}
					<a href="profile.php?time={$time}&amp;statfor=usersinpastday">
						{lang mkey='usersinpastday'}
					</a>
				{else}
					{lang mkey='usersinpastday'}
				{/if}:</td>
			<td>{$visit_day}</td>
		</tr>
		<tr class="oddrow">
			<td>{if $visit_week > 0}
					<a href="profile.php?time={$time}&amp;statfor=usersinpastweek">
						{lang mkey='usersinpastweek'}
					</a>
				{else}
					{lang mkey='usersinpastweek'}
				{/if}:</td>
			<td>{$visit_week}</td></tr>
		<tr class="evenrow">
			<td>{if $visit_month > 0}
					<a href="profile.php?time={$time}&amp;statfor=usersinpastmonth">
						{lang mkey='usersinpastmonth'}
					</a>
				{else}
					{lang mkey='usersinpastmonth'}
				{/if}:</td>
			<td>{$visit_month}</td>
		</tr>
		<tr class="oddrow">
			<td>{if $visit_year > 0}
					<a href="profile.php?time={$time}&amp;statfor=usersinpastyear">
						{lang mkey='usersinpastyear'}
					</a>
				{else}
					{lang mkey='usersinpastyear'}
				{/if}:</td>
			<td>{$visit_year}</td>
		</tr>
		<tr class="evenrow">
			<td>{if $visit_twoyear > 0}
					<a href="profile.php?time={$time}&amp;statfor=usersinpast2years">
						{lang mkey='usersinpast2years'}
					</a>
				{else}
					{lang mkey='usersinpast2years'}
				{/if}:</td>
			<td>{$visit_twoyear}</td>
		</tr>
		<tr class="oddrow">
			<td>{if $visit_fiveyear > 0}
					<a href="profile.php?time={$time}&amp;statfor=usersinpast5years">
						{lang mkey='usersinpast5years'}
					</a>
				{else}
					{lang mkey='usersinpast5years'}
				{/if}:</td>
			<td>{$visit_fiveyear}</td>
		</tr>
		<tr class="evenrow">
			<td>{if $visit_tenyear > 0}
					<a href="profile.php?time={$time}&amp;statfor=usersinpast10years">
						{lang mkey='usersinpast10years'}
					</a>
				{else}
					{lang mkey='usersinpast10years'}
				{/if}:</td>
				<td>{$visit_tenyear}</td>
		</tr>
		<tr><td>&nbsp;</td></tr>
		<tr><td><strong>{lang mkey='userstats'}:</strong></td></tr>
		<tr class="evenrow">
			<td>
				{if $nusers > 0}
					<a href="profile.php?time={$time}&amp;statfor=allusers">
						{lang mkey='totalusers'}
					</a>
				{else}
					{lang mkey='totalusers'}
				{/if}
			:</td>
			<td>{$nusers}</td>
		</tr>
		<tr class="oddrow">
			<td>
				{if $active_users > 0}
					<a href="profile.php?time={$time}&amp;statfor=activeusers">
						{lang mkey='totalactiveusers'}
					</a>
				{else}
					{lang mkey='totalactiveusers'}
				{/if}
			:</td>
			<td>{$active_users}</td>
		</tr>
		<tr class="evenrow">
			<td>
				{if $pending_users > 0}
					<a href="profile.php?time={$time}&amp;statfor=pendingusers">
						{lang mkey='totalpendingusers'}
					</a>
				{else}
					{lang mkey='totalpendingusers'}
				{/if}
			:</td>
			<td>{$pending_users}</td>
		</tr>
		<tr class="oddrow">
			<td>
				{if $suspend_users > 0}
					<a href="profile.php?time={$time}&amp;statfor=suspendedusers">
						{lang mkey='totalsuspendedusers'}
					</a>
				{else}
					{lang mkey='totalsuspendedusers'}
				{/if}
			:</td>
			<td>{$suspend_users}</td>
		</tr>
		<tr class="evenrow">
			<td>
				{if $picture_users > 0}
					<a href="profile.php?time={$time}&amp;statfor=pictureusers">
						{lang mkey='totalpictureusers'}
					</a>
				{else}
					{lang mkey='totalpictureusers'}
				{/if}
			:</td>
			<td>{$picture_users}</td>
		</tr>
		<tr class="oddrow">
			<td>
				{if $online_users > 0}
					<a href="profile.php?time={$time}&amp;statfor=onlineusers">
						{lang mkey='totalonlineusers'}
					</a>
				{else}
					{lang mkey='totalonlineusers'}
				{/if}
			:</td>
			<td>{$online_users}</td>
		</tr>

	{foreach from=$membership_stats item=mem}
		<tr class="{cycle values="evenrow,oddrow"}">
			<td>
				{if $mem.level_count > 0}
					<a href="profile.php?time={$time}&amp;statfor=membershiplevel&amp;level={$mem.roleid}">
					{$mem.name} {lang mkey='members'}
					</a>
				{else}
					{$mem.name} {lang mkey='members'}
				{/if}
				:</td>
			<td>{$mem.level_count}</td>
		</tr>
	{/foreach}
	{foreach from=$gender_stats item=mem }
		<tr class="{cycle values="evenrow,oddrow"}">
			<td>
				{if $mem.cnt > 0}
				<a href="profile.php?time={$time}&amp;statfor=gender&amp;gender={$mem.gender}">
				{mylang mkey='stats_gender_values' skey=$mem.gender}
				</a>
				{else}
				{mylang mkey='stats_gender_values' skey=$mem.gender}
				{/if}
				:</td>
			<td>{$mem.cnt}</td>
		</tr>
	{/foreach}
		<tr><td>&nbsp;</td></tr>
		<tr><td><strong>{lang mkey='visitorstats'}:</strong></td></tr>
		<tr class="evenrow"><td>{lang mkey='visitorstosite'}:</td><td>{$total_visits}</td></tr>
		<tr class="oddrow"><td>{lang mkey='mostactivepage'}:</td><td>{$most_active_page}.php</td></tr>
		<tr><td>&nbsp;</td></tr>
		<tr><td><strong>{lang mkey='sitestats'}:</strong></td></tr>
		<tr class="evenrow"><td>{lang mkey='timesfeedback'}:</td><td>{$feedback_total}</td></tr>
		<tr class="oddrow"><td>{lang mkey='timessupreq'}:</td><td>{$supreq_use}</td></tr>
		<tr class="evenrow"><td>{lang mkey='timesim'}:</td><td>{$im_count}</td></tr>
		<tr class="oddrow"><td>{lang mkey='timeswink'}:</td><td>{$wink_count}</td></tr>
		<tr class="evenrow"><td>{lang mkey='timesmessage'}:</td><td>{$mail_count}</td></tr>
		<tr class="oddrow"><td>{lang mkey='timesinvitefriend'}:</td><td>{$tellafriend_use}</td></tr>
		<tr class="evenrow"><td>{lang mkey='timeshowprofile'}:</td><td>{$showprofile_use}</tr>
		<tr class="oddrow"><td>{lang mkey='timesonlineusers'}</td><td>{$onlineusers_use}</tr>
		<tr class="evenrow"><td>{lang mkey='timesnewmember'}:</td><td>{$newmemberlist_use}</td></tr>
		<tr class="oddrow"><td>{lang mkey='timesbanner'}:</td><td>{$banner_use}</tr>
		<tr class="evenrow"><td>{lang mkey='timespoll'}:</td><td>{$poll_use}</td></tr>
		<tr class="oddrow"><td>{lang mkey='timesgallery'}:</td><td>{$gallery_use}</td></tr>
		<tr class="evenrow"><td>{lang mkey='timesaffiliates'}:</td><td>{$aff_use}</td></tr>
		<tr class="oddrow"><td>{lang mkey='timessignup'}:</td><td>{$signup_use}</td></tr>
		<tr class="evenrow"><td>{lang mkey='timesnews'}:</td><td>{$allnews_use}</td></tr>
		<tr class="oddrow"><td>{lang mkey='timesstories'}:</td><td>{$stories_use}</td></tr>
		<tr class="evenrow"><td>{lang mkey='timessearchmatch'}:</td><td>{$searchmatch_use}</td></tr>
		<tr class="oddrow"><td>{lang mkey='no_affiliates'}:</td><td>{$aff_count}</td></tr>
		<tr class="evenrow"><td>{lang mkey='no_affiliate_refs'}:</td><td>{$affref_count}</td></tr>
		<tr class="oddrow"><td>{lang mkey='no_pages_refs'}:</td><td>{$pages_count}</td></tr>
		<tr class="evenrow"><td>{lang mkey='no_news'}:</td><td>{$news_count}</td></tr>
		<tr class="oddrow"><td>{lang mkey='no_stories'}:</td><td>{$story_count}</td></tr>
		<tr class="evenrow"><td>{lang mkey='no_polls'}:</td><td>{$polls_count}</td></tr>
		<tr class="oddrow"><td>{lang mkey='no_langs'}:</td><td>{$langauge_count}</td></tr>
		<tr><td>&nbsp;</td></tr>
	</table>
	</div>
</div>
</center>
{/strip}