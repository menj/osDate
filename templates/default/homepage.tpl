{strip}
<div align="center">
	{if $smarty.session.UserId == ''}
		{include file='special_offer.tpl'}
	{elseif $smarty.session.UserId > 0 }
		{* Show the statistics since last login  *}
		{include file='user_home_stats.tpl'}
		<br />
		{if count($bdpusers) > 0}
			{include file='birthday_profiles.tpl'}
		{/if}
	{/if}
	{ if $config.iplocation_profcnt > 0 && count($iplusers) > 0 }
		{* This is for showing the IP Location based Profiles  *}
		{include file='iplocation_profiles.tpl'}
	{ /if }

	{ if $config.newest_profpics_dispcnt > 0 && count($profpicsusers) > 0 }
		{* This is for showing the Featured Profiles  *}
		{include file='newest_profpics.tpl'}
	{ /if }
	{ if $config.show_random_profiles > 0 }
		{* This is for showing the Featured Profiles  *}
		{include file='random_profiles.tpl'}
	{ /if }
	{ if $config.show_featured_profiles > 0 && count($featured_profiles) > 0}
		{* This is for showing the Featured Profiles  *}
		{include file='home_featured_profiles.tpl'}
	{ /if }
	{if $config.list_newmembers > 0 && $nulusers }
	{* Now show the latest members names *}
		{include file='home_newuserlist.tpl'}
	{/if}
	{if $config.no_last_new_users > 0 && count($npusers) > 0 }
	{* Now show newest profiles       *}
		{include file='home_membersincelastlogin.tpl'}
	{/if}
	{if $config.show_recent_active_profiles > 0 }
	{* Now show recently active profiles       *}
		{include file='recent_active_profiles.tpl'}
	{/if}

	<br /><br />
</div>
{/strip}
