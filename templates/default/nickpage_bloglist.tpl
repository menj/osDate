<br />
{assign var="nickpage_hdr_text" value="{lang mkey='blog_entries'}"|cat:"&nbsp;"|cat:$bpref.name}
{include file="nickpage_section_hdr.tpl"}
<div class="module_detail_inside" align="center">
{*	<div style="padding-top: 4px; padding-bottom: 6px; "><b>{$bpref.description}</b></div> *}
	<table cellspacing="2" cellpadding="1" border="0" width="100%">
		<tr class="addrow">
			<th width="15%">{$sort_date_posted}</th>
			<th width="75%">{$sort_blog_title}</th>
			<th width="5%" align="center">{$sort_blog_ratings}</th>
			<th width="5%" align="center">{$sort_blog_views}</th>
		</tr>
	{foreach item=item key=key from=$blogs}
		<tr class="{cycle  values="oddrow,evenrow"}">
			<td width="15%">{$item.date_posted|date_format:$lang.DATE_FORMAT}</td>
			<td width="75%"><a href="viewblog.php?id={$item.id}">{$item.short_title}</a></td>
			<td width="5%" align="center">{$item.votes} / {$item.num_votes}</td>
			<td width="5%">{$item.views}</td>
		</tr>
	{/foreach}
	</table>
</div>
<br />