{strip}
{if $loaded_languages|@count > 1 }
	{include file="lang_select.tpl"}
	<br />
{/if}
{if $smarty.session.UserId != ''}
	{if $config.menutype == 'sideF' or $config.menutype == 'sideM' }
		{include file="panelmenu.tpl"}
		<br />
	{/if}
	{include file="getonlineuserlist.tpl"}
		<br />
	{if $smarty.session.active == 1 && $smarty.session.security.allowim == 1 }
		{include file="im.tpl"}
		<br />
	{/if}
{else}
	{include file="stats.tpl"}
	<br />
{/if}
{if $luckySpinGenderFemale != ''}
	{$luckySpinGenderFemale}
	<br />
{/if}
{if $luckySpinGenderMale != ''}
	{$luckySpinGenderMale}
	<br />
{/if}
{if $config.display_list_of_events > 0 && $showevents|@count > 0 }
	{include file="showevents.tpl"}
	<br />
{/if}
{if $config.enable_shoutbox == 'Y' or $config.enable_shoutbox == '1'}
	{include file="shoutbox.tpl"}
	<br />
{/if}
{if $adminblog|@count > 0 || $userblog|@count > 0}
	{include file="adminblog.tpl"}
	<br />
{/if}
{if $config.no_news > 0}
	{include file="news.tpl"}
	<br />
{/if}
{if $poll_data|@count > 0 }
	{include file="polls.tpl"}
	<br />
{/if}
{if $story_data|@count > 0 }
	{include file="stories.tpl"}
	<br />
{/if}
{$modosdate_leftcol}
{include file="banner_leftside.tpl"}
{/strip}
