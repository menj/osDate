{strip}
<div style="vertical-align:top;" >
	{assign var="page_hdr01_text" value="{lang mkey='section_blog_title'}"}
	{assign var="page_title" value="{lang mkey='section_blog_title'}"}
	{include file="page_hdr01.tpl"}
	<div class="module_detail_inside">
		{if $error_message neq ""}
			{include file="display_error.tpl"}
		{/if}
		<table width="100%" border="0" cellspacing="{$config.cellspacing}" cellpadding="{$config.cellpadding}">
		{ if $list }
			<tr class="column_head">
				<th width="5%">{lang mkey='blog_number'}</th>
				<th width="5%">{$sort_blog_views}</th>
				<th width="5%" align="center">{$sort_blog_ratings}</th>
				<th width="15%" align="center">{lang mkey='username_hdr'}</th>
				<th width="50%">{$sort_blog_title}</th>
				<th width="20%">{$sort_date_posted} </th>
			</tr>
		{assign var="mcount" value="0"}
		{foreach item=item key=key from=$list}
		{math equation="$mcount+1" assign="mcount"}
			<tr class="{cycle  values="oddrow,evenrow"}">
				<td>{$mcount}</td>
				<td>{$item.views}</td>
				<td align="center">{$item.votes} / {$item.num_votes}</td>
				<td align="center">
				{if $config.enable_mod_rewrite == 'Y'}
					<a href="javascript:popUpScrollWindow2('{$docroot}{if $smarty.session.AdminId > 0}{$smarty.const.ADMIN_DIR}{/if}{if $config.seo_username == 'Y'}{$item.username}{else}{$item.userid}.htm{/if}','top',650,600)">
				{else}
					<a href="javascript:popUpScrollWindow2('{$docroot}{if $smarty.session.AdminId > 0}{$smarty.const.ADMIN_DIR}{/if}showprofile.php?id={$item.userid}','top',650,600)">
				{/if}
				{$item.username}</a></td>
				<td>
					<a href="viewblog.php?id={$item.id}">{$item.short_title}</a></td>
				<td>{$item.date_posted|date_format:$lang.DATE_FORMAT}</td>
			</tr>
		{/foreach}
		{ else }
			<tr>
				<td colspan="3">{lang mkey='no_blog_found'}</td>
			</tr>
		{/if}
		</table>
	</div>
</div>
<br />
{/strip}
