{strip}
{assign var="page_hdr01_text" value="{lang mkey='confirmation'}"}
{include file="page_hdr01.tpl"}
<div class="module_detail" style="vertical-align:top; padding:6px;">
{if $test_mode == 'test'}
<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
{else}
<form action="https://secure.paypal.com/cgi-bin/webscr" method="post">
{/if}
	<input type="hidden" name="cmd" value="_xclick" />
	<input type="hidden" name="add" value="1" />
	<input type="hidden" name="rm" value="2" />
	<input type="hidden" name="business" value="{$email}" />
	<input type="hidden" name="pay_mod" value="paypal" />
  	<input type="hidden" name="return" value="http://{$smarty.server.SERVER_NAME}{$docroot}checkout_process.php?pay_txn_id={$pay_txn_id}&amp;paid_thru=paypal" />
	{* used by checkout_process.php to validate order *}
	<input type="hidden" name="item_name" value="{lang mkey='change_mship_to'} {$item_name}" />
	<input type="hidden" name="user_id" value="{$smarty.session.UserId}" />
	<input type="hidden" name="user_level" value="{$item_no}" />
	<input type="hidden" name="item_number" value="{$invoice_no}" />
	<input type="hidden" name="amount" value="{$amount}" />
	<input type="hidden" name="no_shipping" value="1" />
  	<input type="hidden" name="cancel_return" value="http://{$smarty.server.SERVER_NAME}{$docroot}checkout_process.php?payment_cancel=1&amp;pay_txn_id={$pay_txn_id}" />
  	<input type="hidden" name="notify_url" value="http://{$smarty.server.SERVER_NAME}{$docroot}checkout_process.php?pay_txn_id={$pay_txn_id}&amp;paid_thru=paypal" />
	<input type="hidden" name="no_note" value="1" />
	{if $currency == 'UKP'} {assign var="currency" value="GBP"}
	{elseif $currency == 'CD'} {assign var="currency" value='CAD'}{/if}
	<input type="hidden" name="currency_code" value="{$currency}" />
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
	</div>
</form>
{/strip}
