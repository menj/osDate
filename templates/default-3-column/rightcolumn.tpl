{strip}
{if $loaded_languages|@count > 1 }
	{include file="lang_select.tpl"}
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
{include file="banner_rightside.tpl"}
{/strip}
