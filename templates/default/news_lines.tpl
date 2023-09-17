<div style="padding-top:2px; padding-left: 6px; padding-bottom:2px; padding-right:4px;">
	{foreach item=row from=$news_data}
		<span class="newshead">{$row.header|stripslashes}</span><br/>
		<span class="newsdate">{$row.date}</span><br/><br />
		<span class="newstext">{$row.text|stripslashes}</span>
		{if $config.enable_mod_rewrite == 'Y'}
			<a href='news{$row.newsid}.htm' >{lang mkey='more'}</a>
		{else}
		<a href='index.php?page=shownews&amp;newsid={$row.newsid}' >{lang mkey='more'}</a>
		{/if}
		<br/><br />
	{/foreach}
	<center>
	{if $config.enable_mod_rewrite == 'Y'}
		<a href='allnews.html' >{lang mkey='all_news'}</a>
	{else}
		<a href='index.php?page=allnews'>{lang mkey='all_news'}</a>
	{/if}
	</center>
</div>
