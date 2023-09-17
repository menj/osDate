{strip}
<div class="module_detail"  style="width:99.9%;vertical-align:top;display:inline; float:left;" >
	{assign var="page_hdr01_text" value="{lang mkey='results_poll_title'}"}
	{assign var="page_title" value="{lang mkey='results_poll_title'}"}
	{include file="page_hdr01.tpl"}

	<div class="line_outer">
		<div class="line_top_bottom_pad edituserlink">
			<div style="display:inline; float:left; width: 40%; margin-right: 3px; text-align:center;">
				<a href="polllist.php"  class='edituserlink'>{lang mkey='section_poll_list'}</a>
			</div>
			<div style="display:inline; float:left; text-align:center;">
				<a href="addpoll.php"  class='edituserlink'>
				{lang mkey='section_add_poll'}
				</a>
			</div>
			<div style="clear:both;"></div>
		</div>

		<div class="module_detail_inside">
			{assign var="page_hdr02_text" value="{lang mkey='poll_subtitle_results'}"}
			{include file="page_hdr02.tpl"}
			<table width="100%" border="0" cellspacing="{$config.cellspacing}" cellpadding="{$config.cellpadding}">
				<tr>
					<td colspan="2"><b>{lang mkey='poll_question'}</b>: {$question.question}</td>
				</tr>
				<tr>
					<td><br /></td>
					<td></td>
				</tr>
				<tr>
					<td><b>Answer</b></td>
					<td><b>Votes</b></td>
				</tr>
			{assign var="mcount" value="0"}
			{foreach item=item key=key from=$answer}
			{math equation="$mcount+1" assign="mcount"}
				<tr class="{cycle  values="oddrow,evenrow"}">
					<td>{$item.answeroption}</td>
					<td>{$item.votes}</td>
				</tr>
			{/foreach}
			</table>
		</div>
	</div>
</div>
<div style="clear:both;"></div>
<br />
{/strip}
