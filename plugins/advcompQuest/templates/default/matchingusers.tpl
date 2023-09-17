<table border="0" cellpadding="0" cellspacing="0" width="100%">
	<tr>
		<td width="100%"  class="module_detail_inside">
			{assign var="page_hdr01_text" value=$lang.questionnaire_title|cat:' > '|cat:$lang.matchingresults}
			{include file="page_hdr01.tpl"}
		</td>
	</tr>
</table>
<div style="padding-left:4px; margin-top:2px; margin-bottom:6px;">
	<h3>{$lang.tothdr01|replace:'#TOTCNT#':$totanswer|replace:'#SECCNT#':$totoptins}</h3>
</div>
<table border="0" cellspacing="2" cellpadding="1" width="100%" class="module_detail_inside">
	<tr >
		<th class="module_head" align="center">{$lang.username}</th>
		<th class="module_head" align="center">{$lang.answeredoptions}</th>
		<th class="module_head" colspan="2" align="center">{$lang.matchingoptions}</th>
		<th class="module_head" colspan="2" align="center">{$lang.perfectmatches}</th>
	</tr>
	<tr>
		<th colspan="2"></th>
		<th class="module_head" align="center">{$lang.count}</th>
		<th class="module_head" align="center">{$lang.pct}</th>
		<th class="module_head" align="center">{$lang.count}</th>
		<th class="module_head" align="center">{$lang.pct}</th>
	</tr>
	{foreach from=$matchingusers key=k item=uans}
	<tr class="{cycle values="oddrow,evenrow"}">
		<td width="40%" align="center"><a href="plugin.php?plugin={$plugin_name}&amp;lookuser={$uans.username}">{$uans.username}</a></td>
		<td width="20%" align="center">{$uans.answers}</td>
		<td width="8%" align="center">{$uans.matchcnt}</td>
		<td width="12%" align="center">{$uans.matchpct|cat:'%'}</td>
		<td width="8%" align="center">{$uans.perfmatchcnt}</td>
		<td width="12%" align="center">{$uans.perfmatchpct|cat:'%'}</td>
	</tr>
	{/foreach}
</table>