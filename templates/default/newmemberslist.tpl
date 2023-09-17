{strip}
<div style="vertical-align:top;" >
	{assign var="page_hdr01_text" value="{lang mkey='newmemberlist'}"}
	{assign var="page_title" value="{lang mkey='newmemberlist'}"}
	{include file="page_hdr01.tpl"}
	<div class="module_detail_inside">
		<div class="line_outer">
			<form action="newmemberslist.php" method="get">
				<div class="line_top_bottom_pad">
					{lang mkey='results_per_page'}:&nbsp;
					<select name="results_per_page">
						{html_options options=$lang.search_results_per_page selected=$psize}
					</select>&nbsp;
					<input type="submit" class="formbutton" value="{lang mkey='show'}"  />
				</div>
			</form>
			<table border="0" cellpadding="{$config.cellpadding}" cellspacing="{$config.cellspacing}" width="100%" class="module_detail">
				<tr class="column_head">
					<th width="20%"><a href="?orderby=username&amp;sortorder={$sortorder}">{lang mkey='username_hdr'}</a></th>
					<th width="8%"><a href="?orderby=gender&amp;sortorder={$sortorder}">{lang mkey='sex_without_colon'}</a></th>
					<th width="8%"><a href="?orderby=age&amp;sortorder={$sortorder}">{lang mkey='age'}</a></th>
					<th width="20%"><a href="?orderby=country&amp;sortorder={$sortorder}">{lang mkey='col_head_country'}</a></th>
					<th width="25%"><a href="?orderby=city&amp;sortorder={$sortorder}">{lang mkey='col_head_city'}</a></th>
					<th width="19%"><a href="?orderby=sincedate&amp;sortorder={$sortorder}">{lang mkey='member_since'}</a></th>
				</tr>
			{foreach from=$newmemberslist item=user_info}
			{cycle values="oddrow,evenrow" assign="class"}
				<tr class="{$class}">
					<td class="$class}">
					{if $config.enable_mod_rewrite == 'Y'}
						<a href="javascript:popUpScrollWindow2('{$docroot}{if $config.seo_username == 'Y'}{$user_info.username}{else}{$user_info.id}.htm{/if}','top',650,600)">
					{else}
						<a href="javascript:popUpScrollWindow2('{$docroot}showprofile.php?{if $config.seo_username == 'Y'}username={$user_info.username}{else}id={$user_info.id}{/if}','top',650,600)">
					{/if}
						{$user_info.username}</a>
					</td>
					<td class="{$class}">{mylang mkey='signup_gender_values' skey=$user_info.gender}</td>
					<td class="{$class}">{$user_info.age}</td>
					<td class="{$class}">{$lang.countries[$user_info.country]}</td>
					<td class="{$class}">{get_cityname city=$user_info.city state=$user_info.state_province country=$user_info.country county=$user_info.county}
					</td>
					<td class="{$class}">{$user_info.regdate|date_format:$lang.DATE_FORMAT}
					</td>
				</tr>
			{/foreach}
			</table>
			{if $pages > 1 }
			<div class="line_top_bottom_pad" align=center>
				{if $prev != "" }
					<a href="newmemberslist.php?page={$prev}" >&lt;-- {lang mkey='previous'}</a>&nbsp;&nbsp;
				{/if}
				{if $cpage != "" && $pages != "" }
					{lang mkey='pageno'} {$cpage} {lang mkey='of'} {$pages}
				{/if}
				{if $next != "" }
					&nbsp;&nbsp;<a href="newmemberslist.php?page={$next}">{lang mkey='next'} --&gt;</a>
				{/if}
			</div>
			{/if}
		</div>
	</div>
</div>
{/strip}
