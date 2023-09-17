{strip}
{assign var="page_hdr01_text" value="{lang mkey='confirmation'}"}
{include file="page_hdr01.tpl"}
<div class="module_detail" style="vertical-align:top; padding:6px;">

<form name="secpay_checkout" action="https://www.secpay.com/java-bin/ValCard" method="post">
	<input type="hidden" name="merchant" value="{$merchant}" />
	<input type="hidden" name="test_status" value="{$test_status}" />
	<input type="hidden" name="trans_id" value="{$invoice_no}" />
	<input type="hidden" name="amount" value="{$amount}" />
	<input type="hidden" name="currency" value="{$currency}" />
	<input type="hidden" name="cb_post" value="true" />
	<input type="hidden" name="callback" value="http://{$smarty.server.SERVER_NAME}{$docroot}secpay_process.php?pay_txn_id={$pay_txn_id}" />
	<input type="hidden" name="md_flds" value="merchant:trans_id:amount" />
	<input type="hidden" name="bill_name" value="{$smarty.session.FullName}" />
	<input type="hidden" name="backcallback" value="http://{$smarty.server.SERVER_NAME}{$docroot}secpay_process.php?pay_txn_id={$pay_txn_id}&amp;payment_cancel=1" />
	{* used by checkout_process.php to validate order *}
	<input type="hidden" name="item_number" value="{$invoice_num}" />

	<input type="hidden" name="level_name" value="{$item_name}" />
	<input type="hidden" name="user_id" value="{$smarty.session.UserId}" />
	<input type="hidden" name="user_level" value="{$item_no}" />
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
