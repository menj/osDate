{strip}
{include file="popheader.tpl"}
<div >
	{assign var="page_hdr01_text" value="{lang mkey='poll_result'}"}
	{assign var="page_title" value="{lang mkey='poll_result'}"}
	{include file="page_hdr01.tpl"}
	<div class="module_detail_inside" >
	<br />
	{if $err == 1 }
		{assign var="error_message" value="{lang mkey='poll_errmsg1'}" }
		{include file="display_error.tpl"}
	{/if}
		{assign var="page_hdr02_text" value=$question|stripslashes}
		{include file="page_hdr02.tpl"}
		<div class="line_outer">
			<table   width="100%" cellspacing="{$config.cellspacing}" cellpadding="{$config.cellpadding}" border="0">
			{foreach item=row from=$data}
				<tr>
					<td valign="top">{$row.opt|stripslashes}</td>
					<td valign="top">
				{if $row.numw > 0}
						<img src="{$image_dir}{$row.c}.gif" height="18" width="{$row.numw}" alt="" />&nbsp;
						{$row.numw}%</td>
				{else}
						{math equation="ceil(x)" x=$row.numw}%</td>
				 {/if}
					<td align="right" valign="top"><b>{$row.result}&nbsp;{lang mkey='votes'}</b></td>
				</tr>
			{/foreach}
				<tr>
					<td colspan="3" align="right"><b>Total:&nbsp;{$numtotal}&nbsp;{lang mkey='votes'}</b></td>
				</tr>
			</table>
			<div class="line_top_bottom_pad">
				{lang mkey='poll_msg'}
			</div>
		{if $config.use_popups == 'Y'}
			<div class="line_top_bottom_pad" align="center">
				<a href="javascript: window.close()" class="closelink">{lang mkey='close'}</a>
			</div>
        {/if}
	</div>
</div>

{include file="popfooter.tpl"}
{/strip}
