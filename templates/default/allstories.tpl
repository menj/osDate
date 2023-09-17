{strip}
<div style="vertical-align:top;padding-bottom: 4px;" >
	{assign var="page_hdr01_text" value="{lang mkey='success_stories'}"}
	{assign var="page_title" value="{lang mkey='success_stories'}"}
	{include file="page_hdr01.tpl"}
	<div class="module_detail_inside">
		<form action="index.php" method="get">
		<input name="page" value="stories" type=hidden />
		<div style="padding-top: 4px; padding-left:4px; pading-right:4px; " >
			{lang mkey='results_per_page'}:&nbsp;
			<select name="results_per_page">
				{html_options options=$lang.search_results_per_page selected=$psize}
			</select>&nbsp;
			<input type="submit" class="formbutton" value="{lang mkey='show'}"  />
		</div>
		</form>
		{foreach item=row from=$data}
			<div style="padding-top: 4px; padding-left:6px; padding-top:6px; padding-bottom: 4px;">
				<span class="storyhead">{$row.header|stripslashes}</span><br />
				<span class="storydate">{$row.date}</span><br />
			{if $row.sender != '' }
				<span class="storyby">{lang mkey='by'}&nbsp;
					{if $config.enable_mod_rewrite == 'Y'}
					<a href="#" onclick="javascript:popUpScrollWindow2('{$docroot}{if $config.seo_username == 'Y'}{$row.username}{else}{$row.sender}.htm{/if}', 'center',650,600)">{$row.username|stripslashes}</a>
					{else}
					<a href="#" onclick="javascript:popUpScrollWindow2('{$docroot}showprofile.php?{if $config.seo_username == 'Y'}username={$row.username}{else}id={$row.sender}{/if}', 'center',650,600)">{$row.username|stripslashes}</a>
					{/if}
				</span>
			{/if}
				<div class="storytext" style="padding-top: 2px;">{$row.text|stripslashes}&nbsp;
					{if $config.enable_mod_rewrite == 'Y'}
						<a href='story{$row.storyid}.htm'  >{lang mkey='more'}</a>
					{else}
						<a href='index.php?page=showstory&amp;storyid={$row.storyid}'  >{lang mkey='more'}</a><br />
					{/if}
				</div>
			</div>
		{/foreach}
	{if $pages neq ""}
		<div align="center" >
			{if $prev != "" }
				<a href="index.php?page=stories&amp;pageno={$prev}" >&lt;-- {lang mkey='previous'}</a>&nbsp;&nbsp;
			{/if}
			{if $cpage != "" && $pages != "" }
				{lang mkey='pageno'} {$cpage} {lang mkey='of'} {$pages}
			{/if}
			{if $next != "" }
				&nbsp;&nbsp;<a href="index.php?page=stories&amp;pageno={$next}">{lang mkey='next'} --&gt;</a>
			{/if}
		</div>
	{/if}
	</div>
</div>
{/strip}
