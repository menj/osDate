{strip}
<div  style="vertical-align:top;" >
	{assign var="page_hdr01_text" value=$data.title|stripslashes}
	{assign var="page_title" value=$data.title|stripslashes}
	{include file="page_hdr01.tpl"}
	<div class="module_detail_inside">
		<div class="line_outer">
			{$data.pagetext|stripslashes}
		</div>
	</div>
	<br/>
</div>
{/strip}
