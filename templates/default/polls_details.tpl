<form name="frmpoll" action="votehere.php" method="get">
<input name='pollid' type='hidden' value='{$poll_data.0.pollid}'/>
<div class="line_outer">
	<div class="line_top_bottom_pad">
		<span class='pollquestion'>{$poll_data.0.question|stripslashes}</span>
	</div>
	<table    width="100%" cellspacing="{$config.cellspacing}" cellpadding="{$config.cellpadding}">
	{foreach item=opt from=$poll_data.options}
		<tr>
			<td width='10%' align='center' valign='top'><input type='radio' name='rdo' value='{$opt.optionid}'/></td>
			<td width='90%'><span class='polloptions'>{$opt.opt|stripslashes}</span></td>
		</tr>
	{/foreach}
	</table>
	<div class="line_top_bottom_pad">
		<input type='button' name='btnVote' value='Vote' onclick='javascript:votesubmit("{$poll_data.0.pollid}","{$poll_data.curtime}");' class="formbutton"/>
	</div>
	<div class="line_top_bottom_pad">
		<a href='javascript:previousPolls();'>{lang mkey='view_poll_archive'}</a>
	</div>
</div>
</form>