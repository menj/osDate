<div style="margin-top: 4px; margin-left:6px; margin-right:6px; line-height: 20px; vertical-align:middle; ">
	<div align="center" class='edituserlink' style=" padding-bottom: 3px; margin-right:4px; display:inline; float:left;width:33%; ">
	{if $blog_nav_opt == 'list'}
		{lang mkey='section_blog_list'}
	{else}
		<a href="bloglist.php" >{lang mkey='section_blog_list'}</a>
	{/if}
	</div>
	<div align="center" class='edituserlink' style=" padding-bottom: 3px; margin-right:4px; display:inline; float:left;width:33%;">
	{if $blog_nav_opt == 'new'}
		{lang mkey='section_add_blog'}
	{else}
		<a href="addblog.php">{lang mkey='section_add_blog'}</a>
	{/if}
	</div>
	<div align="center" class='edituserlink' style=" padding-bottom: 3px;  display:inline; float:left;width:32.5%;">
	{if $blog_nav_opt == 'settings'}
		{lang mkey='section_blog_info'}
	{else}
		<a href="blogsettings.php" >{lang mkey='section_blog_info'}</a>
	{/if}
	</div>
	<div style="clear:both;"></div>
</div>
