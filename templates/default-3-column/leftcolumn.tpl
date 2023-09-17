{strip}
{if $smarty.session.UserId != ''}
	{if $config.menutype == 'sideF' or $config.menutype == 'sideM' }
		{include file="panelmenu.tpl"}
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
{if $smarty.session.UserId != ''}
	{include file="getonlineuserlist.tpl"}
	<br />
	{if $smarty.session.active == 1 && $smarty.session.security.allowim == 1 }
		{include file="im.tpl"}
		<br />
	{/if}
{/if}
{if $config.enable_shoutbox == 'Y' or $config.enable_shoutbox == '1'}
	{include file="shoutbox.tpl"}
	<br />
{/if}
{if $adminblog|@count > 0 }
	{include file="adminblog.tpl"}
	<br />
{/if}
{$modosdate_leftcol}
{include file="banner_leftside.tpl"}
{/strip}
