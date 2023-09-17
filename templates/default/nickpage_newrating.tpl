{strip}
<script type="text/javascript">
/* <![CDATA[ */

function confirmDelete(commentid,ratingid,conmsg)
{ldelim}
	if (confirm(conmsg))
	{ldelim}

		document.location = 'showprofile.php?id={$profileid}&ratingid=' + ratingid + '&commentid=' + commentid + '&action=removecomment';

	{rdelim}
{rdelim}

/* ]]> */
</script>

<div align="left" style="margin-left: 4px;">
{if $total_ratingscnt > 0}
<p>{lang mkey='rate_carefully'}</p>
{else}
<br />
{/if}

{foreach item=item from=$ratings}

<p style="margin:0px; padding-bottom:4px;"><b>{$item.rating}</b></p>
<p style="margin:0px; padding-bottom:4px;">{$item.description}</p>

<div >
	{if $item.ratingvalue == 0}

		<p><b>{lang mkey='no_rating'}</b></p>

	{elseif $item.ratingvalue > 0}

		<div class="module_detail" style="width: 250px;">

			<div class="headbg" style="width:{$item.ratingvalue}0%; line-height: 8px;" >
				&nbsp;
			</div>
		</div>
		<table width="250" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td style="width:10%; font-size:10px; text-align:right; ">1</td>
				<td style="width:10%; font-size:10px; text-align:right; ">2</td>
				<td style="width:10%; font-size:10px; text-align:right; ">3</td>
				<td style="width:10%; font-size:10px; text-align:right; ">4</td>
				<td style="width:10%; font-size:10px; text-align:right; ">5</td>
				<td style="width:10%; font-size:10px; text-align:right; ">6</td>
				<td style="width:10%; font-size:10px; text-align:right; ">7</td>
				<td style="width:10%; font-size:10px; text-align:right; ">8</td>
				<td style="width:10%; font-size:10px; text-align:right; ">9</td>
				<td style="width:10%; font-size:10px; text-align:right; ">10</td>
			</tr>
		</table>
	{/if}
		{if $item.has_rated == 0 and $smarty.session.AdminId == '' and $profileid != $smarty.session.UserId and $smarty.session.UserId > 0}

			<form method="post" action="showprofile.php?id={$profileid}&amp;ratingid={$item.id}&amp;action=rate">
				<div style="padding:5px;">
					<select name="txtrating" style="width:120px;">
					{foreach item=option from=$ratingoptions}
					<option value="{$option.value}">{$option.name}</option>
					{/foreach}
					</select>
					&nbsp;&nbsp;
					<input name="submit" type="submit" class="formbutton" value="{lang mkey='submitrating'}"/>
				</div>
			</form>

		{/if}
		{if $item.ratingcount > 0 and $smarty.session.UserId > 0 }
			<div style="width:100%; text-align:right; padding-right:10px;" >
				{$item.ratingcount} {if $item.ratingcount == 1}{lang mkey='rating'}{else}{lang mkey='ratings'}{/if} | {$item.commentcount} {if $item.commentcount == 1}{lang mkey='comment'}{else}{lang mkey='comments'}{/if}
			</div>
		{/if}
		{foreach item=comment from=$item.comments}
			<div class="headerbg" style="width:98%; margin:4px;">
				<div class="main_outer_table" >
					{if $config.enable_mod_rewrite == 'Y'}
						<a href="javascript:popUpScrollWindow2('{$docroot}{if $config.seo_username == 'Y'}{$comment.username}{else}{$comment.userid}.htm{/if}','top',650,600)">
					{else}
						<a href="javascript:popUpScrollWindow2('{$docroot}showprofile.php?{if $config.seo_username == 'Y'}username={$comment.username}{else}id={$comment.userid}{/if}','top',650,600)">
					{/if}
					{$comment.username}</a>:&nbsp;
					{$comment.comment|nl2br|stripslashes}
				</div>

				{if $comment.reply == '' and $smarty.session.UserId == $profileid and $config.mod_rating_allow_rep == 'Y'}

					<p style="margin-bottom:5px;"><b>{lang mkey='your_reply'}</b></p>
					<p style="margin-top:5px;">{lang mkey='comment_note'}</p>

					<form name="addcomment" method="post" action="showprofile.php?id={$profileid}&amp;ratingid={$item.id}&amp;commentid={$comment.id}&action=reply">
					<div style="width:316px;" >
						<textarea name="txtcomment" cols="50" rows="5"></textarea>
					</div>
					<input style="margin-top:5px;" type="submit" class="formbutton" name="btnAdd" value="{lang mkey='submit'}" />
					</form>

				{/if}
				{if $comment.reply != ''}

					<div class="main_outer_table" style="padding: 4px;">
					{* to-do later: javascript character counter while user is typing *}
						<b>{$user.username}:</b> {$comment.reply|nl2br|stripslashes}

						{if $smarty.session.UserId == $profileid}

							<a href="#" onclick="javascript:confirmDelete({$comment.id},{$item.id},'{lang mkey='delete_comment_confirm_msg'}')"><img style="margin-left:3px;" src="images/button_drop.png" alt="Delete" border="0" /></a>
						{/if}
					</div>
				{/if}
			</div>
		{/foreach}
		{if $item.has_rated > 0 and $item.has_commented == 0 and $config.mod_rating_allow_com == 'Y' and $item.commentcount < $config.mod_rating_max_com and $smarty.session.AdminId == '' and $smarty.session.UserId != $profileid and $smarty.session.UserId > 0 }

			<p style="margin-bottom:5px;"><b>{lang mkey='your_comment'}</b></p>
			<p style="margin-top:5px;">{lang mkey='comment_note'}</p>
			<form name="addcomment" method="post" action="showprofile.php?id={$profileid}&amp;ratingid={$item.id}&amp;action=comment">
				<div style="width:316px;">
					<textarea name="txtcomment" cols="50" rows="5"></textarea>
				</div>
				<input style="margin-top:5px;" type="submit" class="formbutton" name="btnAdd" value="{lang mkey='submit'}" />
			</form>

		{/if}
	</div>
	<div style="height:10px;">&nbsp;</div>
{/foreach}
<br />
</div>
{/strip}