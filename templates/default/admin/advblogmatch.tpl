{strip}
{assign var="page_hdr01_text" value="{lang mkey='search_results'}"}
{assign var="page_title" value="{lang mkey='search_results'}"}
{include file="admin/admin_page_hdr01.tpl"}
<div class="module_detail_inside" style="padding-top:6px;">
	{if $error == 1 }
		<div class="line_top_bottom_pad">
			{lang mkey='no_search_results'} <a href="advsearch.php?sectionid=0&amp;search_mod=1">{lang mkey="modify_curr_search"} {lang mkey="perform_search"}</a><br /><a href="advsearch.php?search_new=1">{lang mkey="start_new_search"} {lang mkey="use_empty_form"}</a><br />
		</div>
	{else}
		<div class="line_outer">
			<div class="line_top_bottom_pad">
				{lang mkey='total_blogs_found'}&nbsp;{$totalrecs}
			</div>
		{ if $blogdata }
			<table border="0" width="100%">
				<tr class="column_head">
				   <th width="15%">{$sort_date_posted} </th>
				   <th width="5%">{$sort_creator}</th>
				   <th width="60%">{$sort_blog_title}</th>
				   <th width="5%" align="center">{$sort_blog_views}</th>
				   <th width="5%" align="center">{$sort_blog_ratings}</th>
				   <th width="10%">{lang mkey='action'}</th>
				</tr>
				{assign var="ccount" value="0"}
				{foreach item=item key=key from=$blogdata}
				<tr class="{cycle  values="oddrow,evenrow"}">
				   <td>{$item.date_posted|date_format:$lang.DATE_FORMAT}</td>
				   <td>{$item.username}</td>
				   <td>
					  <a href="viewblog.php?id={$item.id}">{$item.short_title}</a></td>
				   <td>{$item.views}</td>
				   <td align="center">{$item.votes} / {$item.num_votes}</td>
				   <td>
					  <a href="editblog.php?id={$item.id}"><img alt="" src="images/button_edit.png" border="0" /></a>
					  &nbsp;
					  <a href="advsearch.php?id={$item.id}&action=delete_blog" onclick="return confirmLink(this, '{lang mkey="blog" skey="del02"} blog entry?')"><img alt="" src="images/button_drop.png" border="0" /></a>
				   </td>
				</tr>
				{/foreach}
			</table>
		{/if}
		</div>
	{/if}
	{if $pages neq ""}
		<div class="line_top_bottom_pad" align=center>
		{if $prev != "" }
			<a href="advsearch.php?advsearch-1&amp;page={$prev}
			 " >&lt;-- {lang mkey='previous'}</a>&nbsp;&nbsp;
		{/if}
		{if $cpage != "" && $pages != "" }
			 {lang mkey='pageno'} {$cpage} {lang mkey='of'} {$pages}
		 {/if}
		{if $next != "" }
			 &nbsp;&nbsp;<a href="advsearch.php?advsearch=1&amp;page={$next}">{lang mkey='next'} --&gt;</a>
		{/if}
		</div>
	{/if}
</div>
{/strip}