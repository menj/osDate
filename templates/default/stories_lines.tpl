<div style="padding-top:2px; padding-left: 6px; padding-bottom:2px; padding-right:2px;">
	{foreach item=row from=$story_data}
		<span class="storyhead">{$row.header|stripslashes}</span><br/>
		<span class="storydate">{$row.date}</span><br/>
		<span class="storyby">{lang mkey='by'}{if $config.enable_mod_rewrite == 'Y'}
				<a href="javascript:popUpScrollWindow2('{$docroot}{if $config.seo_username == 'Y'}{$row.username}{else}{$row.sender}.htm{/if}','top',650,600)">
			{else}
				<a href="javascript:popUpScrollWindow2('{$docroot}showprofile.php?{if $config.seo_username == 'Y'}username={$row.username}{else}id={$row.sender}{/if}','top',650,600)">
			{/if}{$row.username}</a>
		</span><br /><br />
		<div class="storytext">{$row.text|stripslashes}</div>
			{if $config.enable_mod_rewrite == 'Y'}
				<a href='story{$row.storyid}.htm'>{lang mkey='more'}</a>
			{else}
				<a href='index.php?page=showstory&amp;storyid={$row.storyid}'>{lang mkey='more'}</a>
			{/if}
		<br/><br />
	{/foreach}
	<center>
		{if $config.enable_mod_rewrite == 'Y'}
			<a href='stories.html'>{lang mkey='all_stories'}</a>
		{else}
			<a href='index.php?page=stories'>{lang mkey='all_stories'}</a>
		{/if}
	</center>
</div>
