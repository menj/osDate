{strip}
<div style="vertical-align:top; padding-bottom: 4px; text-align:left;" >
	{assign var="page_hdr01_text" value="{lang mkey='news'}"}
	{assign var="page_title" value="{lang mkey='news'}"}
	{include file="page_hdr01.tpl"}
	<div class="module_detail_inside">
		<form action="index.php" method="get">
		<input name="page" value="allnews" type="hidden" />
			<div style="padding: 6px; ">
				{lang mkey='results_per_page'}:&nbsp;
				<select name="results_per_page">
					{html_options options=$lang.search_results_per_page selected=$psize}
				</select>&nbsp;
				<input type="submit" class="formbutton" value="{lang mkey='show'}"  />
			</div>
		</form>

		{foreach item=row from=$data}
			<div style="padding-top: 4px; padding-left:6px; padding-top:6px; padding-bottom: 4px;">
				<span class="newshead">{$row.header|stripslashes}</span><br/>
				<span class="newsdate">{$row.date|date_format:$lang.DATE_FORMAT}</span><br/>
				<span class="newstext">{$row.text|stripslashes}</span>
				{if $config.enable_mod_rewrite == 'Y'}
					<a href='news{$row.newsid}.htm' >{lang mkey='more'}</a>
				{else}
				<a href='index.php?page=shownews&amp;newsid={$row.newsid}' >{lang mkey='more'}</a>
				{/if}
			</div>
		{/foreach}
	{if $pages neq ""}
		<div align="center"  style="padding-top:10px;" >
			{if $prev != "" }
				<a href="index.php?page=allnews&amp;pageno={$prev}" >&lt;-- {lang mkey='previous'}</a>&nbsp;&nbsp;
			{/if}
			{if $cpage != "" && $pages != "" }
				{lang mkey='pageno'} {$cpage} {lang mkey='of'} {$pages}
			{/if}
			{if $next != "" }
				&nbsp;&nbsp;<a href="index.php?page=allnews&amp;pageno={$next}">{lang mkey='next'} --&gt;</a>
			{/if}
		</div>
	{/if}
	</div>
</div>
{/strip}
