{strip}
{assign var="page_hdr01_text" value=$plang.payment_history}
{include file="page_hdr01.tpl"}

<br />
<center>
<table width="100%" border="0" cellpadding="0" cellspacing="0" >
	<tr>
		<td class="module_detail_inside" width="100%">
			{assign var="ct" value=$trans|@count}
			{assign var="page_hdr02_text" value=$plang.total_transactions_found|cat:"&nbsp;"|cat:$ct}
			{include file="page_hdr02.tpl"}
			<table class="table" cellpadding="{$config.cellpadding}" cellspacing="{$config.cellspacing}" width="550" border="0">
			<tbody>
			{ if $trans }
				<tr class="table_head">
					<th width="5%" align="center"></th >
					<th width="25%" align="center">{$plang.invoice}</th >
					<th width="25%" align="center">{$plang.date}</th >
					<th width="25%" align="center">{$plang.amount}</th>
					<th width="20%" align="center">{$plang.status}</th>
				</tr>
				{assign var="mcount" value="0"}
				{foreach item=item key=key from=$trans}
					{math equation="$mcount+1" assign="mcount"}
				<tr class="{cycle  values="oddrow,evenrow"}">
					<td>{$mcount}</td>
					<td align="center">{$item.invoice_no}</td>
					<td align="center">{$item.txn_date|date_format:$lang.DATE_FORMAT}</td>
					<td align="center">{$item.amount_paid|string_format:"%.2f"}</td>
					<td align="center">{$item.payment_status}</td>
				</tr>
				{/foreach}
			{ else }
				<tr>
					<td colspan="3">
						{assign var="error_message" value=$plang.no_transactions_found}
						{include file="display_error.tpl"}
					</td>
				</tr>
			{/if}
			</tbody>
			</table>
		</td>
	</tr>
</table>
</center>
{/strip}