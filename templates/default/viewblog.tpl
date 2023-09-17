{strip}
<div style="vertical-align:top;" >
	{if $config.enable_mod_rewrite == 'Y'}
		{assign var="lnk" value='<a href="javascript:popUpScrollWindow2(\''|cat:$docroot|cat:$blog.username|cat:'\',\'top\',650,600)">'}
	{else}
		{assign var="lnk" value='<a href="javascript:popUpScrollWindow2(\''|cat:$docroot|cat:'showprofile.php?username='|cat:$blog.username|cat:'\',\'top\',650,600)">'}
	{/if}
	{assign var="page_hdr01_text" value=$lnk|cat:$blog.username|cat:"\'s</a> "|cat:"{lang mkey='section_blog_title'}"}
	{assign var="page_title" value="{lang mkey='section_blog_title'}"}
	{include file="page_hdr01.tpl"}
	<div class="module_detail_inside">
		<div class="line_outer">
			<div class="line_top_bottom_pad">
				<b>{$blog.title|nl2br}</b><br />
				{$blog.date_posted|date_format:$lang.DATE_FORMAT}
			</div>
			<div class="line_top_bottom_pad">
				{$blog.story|nl2br}
			</div>
			<div class="line_top_bottom_pad">
				<b>{lang mkey='blog_views_hdr'}: {$blog.views}
				&nbsp;  &nbsp; {lang mkey='blog_rating_list_hdr'}:  {$blog.votes} &nbsp;({lang mkey='blog_rating_hdr'} {$blog.num_votes} {lang mkey='blog_votes1'}) </b>
			</div>
			{if $user_voted == 0 or $user_voted == ''}
				<div class="line_top_bottom_pad">
					  <form method="post" action="viewblog.php" style="display:inline;">
					  <input type="hidden" value="{$blog.id}" name="id"/>
					  <input type="hidden" value="add_vote" name="action"/>
					  {if $smarty.session.UserId > 0 && $smarty.session.UserId != $blog.userid }
					  <b>{lang mkey='blog_add_vote'}:
					  &nbsp;</b>
							  <select name="vote">
									  {foreach item=item from=$vote_values}
									  {if $item == 0}
									  <option value="{$item}" selected="selected">{$item}</option>
									  {elseif $item == -5}
									  <option value="{$item}">{$item}&nbsp;({lang mkey='worst'})</option>
									  {elseif $item == 5}
									  <option value="{$item}">{$item}&nbsp;({lang mkey='excellent'})</option>
									  {else}
									  <option value="{$item}">{$item}</option>
									  {/if}
									  {/foreach}
							  </select>&nbsp;&nbsp;
							  <input type="submit" class="formbutton" value="{lang mkey='blog_submit_vote'}"/>
						{/if}
					 </form>
				</div>
			{/if}
		{if $allowcomments == 'Y' && ($user_commented == 0 or $user_commented == '') }
			{if $error_message neq ""}
				{include file="display_error.tpl"}
			{/if}
			<div class="line_top_bottom_pad">
				 <b>{lang mkey='add_comment'}:</b>
			</div>
			<div class="line_top_bottom_pad">
				<form name="frmCmt" method="post" action="viewblog.php"  onsubmit="return countCheck({$config.max_comment_length});">
				<input type="hidden" name="action" value="add_comment"/>
				<input type="hidden" name="id" value="{$blog.id}"/>
				<textarea rows="5" cols="70" name="comment" onkeyup="countText({$config.max_comment_length});">{$comment }</textarea>
				<br />
				{lang mkey='characters_typed'}: <input type="text"  class="textinput" size="3" name="counter" value="" readonly onfocus="this.form.comment.focus()" /> ({lang mkey='limit'}: {$config.max_comment_length})
				<center>
				<input type="submit" class="formbutton" value='{lang mkey='submit'}'/> <input type="reset" class="formbutton" value="{lang mkey='reset'}"/>
				</center>
				<script type="text/javascript"> countText({$config.max_comment_length}); </script>
				</form>
			</div>
		{/if}

		</div>
		<br />
		{ if $comments }
		<div class="module_detail">
			<div class="line_outer">
				<div class="line_top_bottom_pad">
					 <b>{lang mkey='blog_comments'}:&nbsp;{$numcomments}</b>
				</div>
			{foreach item=item key=key from=$comments}
				<div class="line_top_bottom_pad">
					<b>{mylang mkey="posted_by"} {$item.username}{mylang mkey='on'}{$item.datetime|date_format:$lang.DATE_FORMAT}</b>
				</div>
				<div class="line_top_bottom_pad">
					{$item.comment|nl2br}
				</div>
				<div style="margin-top: 6px;"></div>
			{/foreach}
			</div>
		</div>
		{/if}
	</div>
</div>
{/strip}
