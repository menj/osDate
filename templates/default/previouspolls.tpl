{strip}
{include file="popheader.tpl"}
<center>
<div class="module_detail_inside" style="height:350px;">
	{assign var="page_hdr01_text" value="{lang mkey='view_poll_archive'}"}
	{assign var="page_title" value="{lang mkey='view_poll_archive'}"}
	{include file="page_hdr01.tpl"}

	<div class="line_outer">
	{foreach item=row from=$data}
		<div class="line_top_bottom_pad">
			<a href="javascript:openWin({$row.pollid})">{$row.question}</a>
		</div>
	{foreachelse}
		<div class="line_top_bottom_pad">
			{lang mkey='no_previous_polls'}
		</div>
	{/foreach}

	{if $config.use_popups == 'Y'}
		<div class="line_top_bottom_pad">
		<center><a href="javascript:window.close();" class="closelink">{lang mkey='close'}</a></center>
		</div>
	{/if}
	</div>
</div>
</center>
{include file="popfooter.tpl"}
{/strip}
