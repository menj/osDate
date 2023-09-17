{strip}
{assign var="page_hdr01_text" value="{lang mkey='payment_modules'}"}
{assign var="page_title" value="{lang mkey='payment_modules'}"}
{include file="admin/admin_page_hdr01.tpl"}
<div class="top_margin_6px">
	{assign var="page_hdr02_text" value="{lang mkey='payment_modules'}"}
	{include file="admin/admin_page_hdr02.tpl"}
	<div class="module_detail_inside" style="text-align:left;">
		<div class="line_outer">
			<table border="0" width="100%"  cellpadding="2" cellspacing="2">
				<tr class="column_head">
					<th>{lang mkey='module'}</th>
					<th>{lang mkey='action'}</th>
				</tr>
			{foreach item=item from=$data}
				<tr  class="{cycle values="oddrow,evenrow"}">
					<td width="30%" >{$item.name|stripslashes}</td>
					<td  width="70%">
					{if $item.enabled == 'Y'}
						<a href="?edit={$item.module_key}">{lang mkey='edit'}</a>&nbsp;&nbsp;
						<a href="?delete={$item.module_key}">{lang mkey='uninstall'}</a>
					{else}
						<a href="?install={$item.module_key}">{lang mkey='install'}</a>
					{/if}
					</td>
				</tr>
			{/foreach}
				<tr><td>&nbsp;</td></tr>
			</table>
		</div>
	</div>
</div>
{/strip}