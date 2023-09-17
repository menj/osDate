{strip}
{assign var="page_hdr01_text" value="{lang mkey='aff_stats'}"}
{assign var="page_title" value="{lang mkey='aff_stats'}"}
{include file="admin/admin_page_hdr01.tpl"}
<div class="top_margin_6px">
	{assign var="ct" value=$data|@count}
	{assign var="page_hdr02_text" value="{lang mkey='total_affiliates'}"|cat:": "|cat:$ct}
	{include file="admin/admin_page_hdr02.tpl"}
	<div class="module_detail_inside" style="padding-top:1px;">
		<div class="line_outer" style="text-align:right; padding-right:4px;">
			<form action="">
				{lang mkey='results_per_page'}:&nbsp;
				<select name="results_per_page">
					{html_options options=$lang.search_results_per_page selected=$psize}
				</select>&nbsp;
				<input type="button" class="formbutton" value="{lang mkey='show'}" onclick="document.location='?results_per_page=' + results_per_page.value" />
			</form>
		</div>
		<div class="line_outer">
			<table cellspacing="{$config.cellspacing}" cellpadding="{$config.cellpadding}" border="0" width="100%">
				<tr class="column_head">
					<th>{lang mkey='col_head_srno'}</th>
					<th nowrap><a href="?sortby={lang mkey='col_head_name'}&amp;sortorder={$sortorder}&amp;offset={$smarty.get.offset}">{lang mkey='col_head_name'}</a></th>
					<th nowrap align="center"><a href="?sortby=refcnt&amp;sortorder={$sortorder}&amp;offset={$smarty.get.offset}">{lang mkey='total_referrals'}</a></th>
					<th nowrap align="center"><a href="?sortby=usercnt&amp;sortorder={$sortorder}&amp;offset={$smarty.get.offset}">{lang mkey='regis_referals'}</a></th>
				</tr>
				{assign var="n" value="$upr"}
			{if $data|@count > 0 }
			{foreach item=item key=key from=$data}
				{math equation="$n+1" assign="n"}
				<tr class="{cycle values="oddrow,evenrow"}">
					<td>{$n}</td>
					<td nowrap >{$item.name}</td>
					<td nowrap align="center">{$item.refcnt|default:0}</td>
					<td nowrap align="center">{$item.usercnt|default:0}</td>
				</tr>
			{/foreach}
				<tr>
					<td align="center" colspan="6">
					{assign var="pageno" value=$smarty.get.offset}
					{if $pageno == ""}{assign var="pageno" value=1}{/if}

					{if $pageno != "1"}
						<a href="?offset={$pageno-1}">{lang mkey='previous'}</a>&nbsp;
					{else}
					{/if}

					{if $data|@count >= $config.page_size}
						<a href="?offset={$pageno+1}">{lang mkey='next'}</a>&nbsp;
					{else}
					{/if}
					</td>
				</tr>
			{else}
				<tr>
					<td colspan="6">
						{lang mkey='no_record_found'}
					</td>
				</tr>
			{/if}
			</table>
		</div>
	</div>
</div>
{/strip}