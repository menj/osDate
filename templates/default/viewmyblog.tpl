{strip}
<script type="text/javascript" src="{$docroot}javascript/cascade.js"></script>
<div style="vertical-align:top;" >
	{assign var="page_hdr01_text" value="{lang mkey='section_blog_title'}"}
	{assign var="page_title" value="{lang mkey='section_blog_title'}"}
	{include file="page_hdr01.tpl"}
	<div class="module_detail_inside">
		{if $error_message neq ""}
			{include file="display_error.tpl"}
		{/if}
		{include file="blog_nav.tpl"}
		<div class="module_detail_inside line_outer">
			{assign var="page_hdr02_text" value="{lang mkey='view_blog'}"}
			{include file="page_hdr02.tpl"}
			<div class="line_outer">
				<b>{$blog.date_posted|date_format:$lang.DATE_FORMAT}</b>
			</div>
			<div class="line_outer">
				<b>{$blog.title|nl2br}</b>
			</div>
			<div class="line_outer" style="padding-bottom: 8px;">
				{$blog.story|nl2br}
			</div>
			<div class="line_outer">
				<b>{lang mkey='blog_comments'}: {$numcomments}</b>
			</div>
		{ if $comments }
			<div class="module_detail_inside">
			{foreach item=item key=key from=$comments}
				<div class="{cycle  values="oddrow,evenrow"}">
					<b>{$item.datetime|date_format:$lang.DATE_FORMAT}</b>
					- {$item.username}
					&nbsp;
					<a href="viewmyblog.php?id={$blog.id}&amp;deleteid={$item.id}&action=delete" onclick="return confirmLink(this, '{lang mkey='blog' skey='del01'}')"><img alt="" src="images/button_drop.png" border="0" /></a>
				</div>
				<div class="line_outer">{$item.comment}</div>
			{/foreach}
			</div>
		{/if}
		</div>
	</div>
</div>
<br />
{/strip}
