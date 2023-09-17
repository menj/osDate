{strip}
<div style="vertical-align:top; text-align:left;" >
	{assign var="page_hdr01_text" value="{lang mkey='news'}"}
	{assign var="page_title" value="{lang mkey='news'}"}
	{assign var="page_hdr01_text_r" value="<a href='index.php?page=allnews' class='module_head'>"|cat:"{lang mkey='back'}"|cat:"</a>"}
	{include file="page_hdr01.tpl"}
	<div class="module_detail_inside">
		<div class="line_outer">
		{foreach item=row from=$data}
			<div class="line_top_bottom_pad">
				<span class="newshead">{$row.header|stripslashes}</span><br/>
				<span class="newsdate">{$row.date|date_format:$lang.DATE_FORMAT}</span><br/><br/>
				<span class="newstext">{$row.text|stripslashes}</span><br/>
			</div>
		{/foreach}
		</div>
	</div>
</div>
{/strip}
