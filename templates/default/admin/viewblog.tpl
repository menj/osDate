{strip}
<script type="text/javascript" src="{$docroot}javascript/cascade.js"></script>
<script type="text/javascript" src="{$docroot}javascript/functions.js"></script>

{assign var="page_hdr01_text" value="{lang mkey='section_blog_title'}"}
{assign var="page_title" value="{lang mkey='section_blog_title'}"}
{include file="admin/admin_page_hdr01.tpl"}
{if $error_message neq ""}
	{include file="display_error.tpl"}
{/if}
<div style="padding-top:6px; text-align:left;">
	{include file="blog_nav.tpl"}
	<div class="line_top_bottom_pad">
		{assign var="page_hdr02_text" value="{lang mkey='view_blog'}"}
		{include file="admin/admin_page_hdr02.tpl"}
		<div class="module_detail_inside">
			<div class="line_outer">
				<table width="100%" border="0" cellpadding="{$config.cellpadding}" cellspacing="{$config.cellspacing}" >
					<tr>
						<td width="100%" valign="top" >
							<b>{$blog.title|nl2br}</b>
						</td>
					</tr>
					<tr>
						<td >
							{$blog.date_posted|date_format:$lang.DATE_FORMAT}
						</td>
					</tr>
					<tr><td height="5"></td></tr>
					<tr>
						<td style="padding-bottom: 12px; ">{$blog.story|nl2br}</td>
					</tr>
				{if $allowcomments == 'Y' }
					<tr>
						<td>
							<b>&nbsp;{lang mkey='add_comment'}:</b>
						</td>
					</tr>
					<tr>
						<td style="padding-left: 6px;">
							<form name="frmCmt" method="post" action="viewmyblog.php"  onsubmit="return countCheck({$config.max_comment_length});">
							<input type="hidden" name="action" value="add_comment"/>
							<input type="hidden" name="id" value="{$blog.id}"/>
							<textarea rows="5" cols="70" name="comment" onkeyup="countText({$config.max_comment_length});">{$comment}
							</textarea>
							<br />&nbsp;
							Characters typed: <input type="text" class="textinput"  size="3" name="counter" value="" readonly onfocus="this.form.comment.focus()" /> (limit: {$config.max_comment_length})
							<center>
							<input type="submit" class="formbutton" value='{lang mkey='submit'}'/> <input type="reset" class="formbutton" value="{lang mkey='reset'}"/>
							</center>
							<script type="text/javascript"> countText({$config.max_comment_length}); </script>
							</form>
						</td>
					</tr>
				{/if}
				{ if $comments }
					<tr>
						<td style="padding-top: 3px;">
							<b>&nbsp;{lang mkey='blog_comments'}: {$numcomments}</b>
						</td>
					</tr>
				{foreach item=item key=key from=$comments}
					<tr class="{cycle  values="oddrow,evenrow"}">
						<td width="100%">
							<b>{$item.datetime|date_format:$lang.DATE_FORMAT}</b> - {$item.username}&nbsp;
							<a href="viewmyblog.php?id={$blog.id}&amp;deleteid={$item.id}&amp;action=delete" onclick="return confirmLink(this, '{lang mkey='blog' skey='del01'}')"><img alt="" src="images/button_drop.png" border="0" /></a>
							<br />
							{$item.comment|nl2br}
						</td>
					</tr>
					<tr><td height="6"></td></tr>
				{/foreach}
				{/if}
				</table>
			</div>
		</div>
	</div>
</div>
{/strip}
