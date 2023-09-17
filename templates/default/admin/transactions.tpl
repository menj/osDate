{strip}
{assign var="page_hdr01_text" value="{lang mkey='transactions_report'}"}
{assign var="page_title" value="{lang mkey='transactions_report'}"}
{include file="admin/admin_page_hdr01.tpl"}
<div class="top_margin_6px" style="text-align:left;">
	{assign var="page_hdr02_text" value="{lang mkey='trans_count'}: "|cat:$total_recs}
	{include file="admin/admin_page_hdr02.tpl"}
	<div class="module_detail_inside" >
		<div class="line_outer">
		<form name="frmPytTrans" action="transactions.php" method="post" >
			<table cellspacing="{$config.cellspacing}" cellpadding="{$config.cellpadding}" width="100%">
			<tbody>
				<tr class="column_head">
					<th>{lang mkey='col_head_date'}</th>
					<th>{lang mkey='pay_no'}</th>
					<th>{lang mkey='col_head_username'}</th>
					<th>{lang mkey='membership_hdr'}</th>
					<th>{lang mkey='paid_thru'}</th>
					<th>{lang mkey='ref_no'}</th>
					<th>{lang mkey='pay_status'}</th>
				</tr>
		{if $data|@count > 0}
			{foreach item=item key=key from=$data}
				<tr class="{cycle values="oddrow,evenrow"}">
					<td width="17%%" >{$item.trans_dt}</td>
					<td width="15%">{$item.invoice_no}</td>
					<td width="10%">
						{if $config.enable_mod_rewrite == 'Y'}
							<a href="javascript:popUpScrollWindow('{if $config.seo_username == 'Y'}{$item.username}{else}{$item.user_id}.htm{/if}','top',650,600)">
						{else}
							<a href="javascript:popUpScrollWindow('showprofile.php?{if $config.seo_username == 'Y'}username={$item.username}{else}id={$item.user_id}{/if}','top',650,600)">
						{/if}
						{$item.username}
						</a>
					</td>
					<td width="16%">{$item.mship_from_name}{lang mkey='to'}{$item.mship_to_name}</td>
					<td width="10%">{$item.payment_mod}</td>
					<td width="20%">{$item.txn_id}</td>
					<td width="12%">{$item.payment_status}</td>
				</tr>
			{/foreach}
		{else}
				<tr>
					<td colspan="7" style="padding-left: 5px; ">
						{lang mkey='no_record_found'}
					</td>
				</tr>
		{/if}
			</tbody>
			</table>
		</form>
		</div>
	</div>
</div>
{/strip}