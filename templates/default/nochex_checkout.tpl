{strip}
{assign var="page_hdr01_text" value="{lang mkey='confirmation'}"}
{include file="page_hdr01.tpl"}
<div class="module_detail" style="vertical-align:top; padding:6px;">
<form action="https://www.nochex.com/nochex.dll/checkout" method="post">
	<input type="hidden" name="email" value="{$email}" />
	<input type="hidden" name="amount" value="{$amount}" />
	<input type="hidden" name="ordernumber" value="{$invoice_no}" />
	{if $test_mode == 'test'}
		<input type="hidden" name="status" value="test" />
	{/if}
	<input type="hidden" name="custom" value="{$pay_txn_id}" />

	<input type="hidden" name="description" value="membership upgrade to {$item_name}" />
	<input type="hidden" name="returnurl" value="http://{$smarty.server.SERVER_NAME}{$docroot}checkout_process.php?pay_txn_id={$pay_txn_id}&amp;paid_thru=nochex&amp;rtnlink=1" />
	<input type="hidden" name="responderurl" value="http://{$smarty.server.SERVER_NAME}{$docroot}nochex_process.php?pay_txn_id={$pay_txn_id}" />
	<input type="hidden" name="cancelurl" value="http://{$smarty.server.SERVER_NAME}{$docroot}checkout_process.php?pay_txn_id={$pay_txn_id}&amp;payment_cancel=1" />
		<div class="line_outer">
			<div class="line_top_bottom_pad">
				{lang mkey='info_confirm'}
			</div>
			<div class="line_top_bottom_pad">
				{lang mkey='name'}{$smarty.session.FullName|stripslashes}
			</div>
			<div class="line_top_bottom_pad">
				{lang mkey='change_mship_to'}<b>{$item_name}</b>.
			</div>
			<div class="line_top_bottom_pad">
				{lang mkey='amount'}{$currency_is}{$amount}
			</div>
			<div class="line_top_bottom_pad">
				<input type="submit" class="formbutton" value="{lang mkey='confirm'}" />
			</div>
		</div>
</form>
</div>
{/strip}
