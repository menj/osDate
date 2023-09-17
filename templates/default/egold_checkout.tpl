{strip}
{assign var="page_hdr01_text" value="{lang mkey='confirmation'}"}
{include file="page_hdr01.tpl"}
<div class="module_detail" style="vertical-align:top; padding:6px;">

<form action="https://www.e-gold.com/sci_asp/payments.asp" method="post">
	<input type="hidden" name="payee_account" value="{$egold_account}" />
	<input type="hidden" name="payee_name" value="{$egold_name}" />
	<input type="hidden" name="payment_units" value="{$currencycode}" />
	<input type="hidden" name="payment_amount" value="{$amount}" />
	<input type="hidden" name="payment_metal_id" value="{$egold_metalid}" />
	<input type="hidden" name="payment_id" value="{$invoice_no}" />
  	<input type="hidden" name="payment_url" value="http://{$smarty.server.SERVER_NAME}{$docroot}checkout_process.php?pay_txn_id={$pay_txn_id}&amp;paid_thru=egold" />
  	<input type="hidden" name="nopayment_url" value="http://{$smarty.server.SERVER_NAME}{$docroot}checkout_process.php?payment_cancel=1&amp;pay_txn_id={$pay_txn_id}" />
	<input type="hidden" name="baggage_fields" value="" />
	{* used by checkout_process.php to validate order *}

		<table border="0" cellpadding="{$config.cellpadding}" cellspacing="{$config.cellspacing}" width="100%">

			<tr><td>{lang mkey='info_confirm'}</td></tr>
			<tr><td>{lang mkey='name'}{$smarty.session.FullName|stripslashes}
			</td></tr>
			<tr><td>{lang mkey='change_mship_to'}<b>{$item_name}</b>.</td></tr>
			<tr><td>{lang mkey='amount'}{$currency_is}{$amount}</td></tr>
			<tr><td><input type="submit" class="formbutton" value="{lang mkey='confirm'}" /></td></tr>
		</table>
</form>
</div>
{/strip}
