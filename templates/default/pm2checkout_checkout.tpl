{strip}
{assign var="page_hdr01_text" value="{lang mkey='confirmation'}"}
{include file="page_hdr01.tpl"}
<div class="module_detail" style="width:99.9%;vertical-align:top; padding:6px;">
<form action="https://www.2checkout.com/2co/buyer/purchase" method="post">
<input type="hidden" name="total" value="{$amount}" />
<input type="hidden" name="sid" value="{$loginid}" />
<input type="hidden" name="cart_order_id" value="{$pay_txn_id}" />
{if $payment_mode == 'Test'}
	<input type="hidden" name="demo" value="Y" />
{/if}
<input type="hidden" name="payment_method" value="CC" />
<input type="hidden" name="return_url" value="http://{$smarty.server.SERVER_NAME}{$docroot}checkout_process.php" />
<input type="hidden" name="paid_thru" value="pm2checkout" />
<input type="hidden" name="merchant_order_id" value="{$invoice_no}" />
<input type="hidden" name="id_type" value="1" />
<input type="hidden" name="c_prod" value="mship_{$item_no}" />
<input type="hidden" name="c_name" value="mship_{$item_name}" />
<input type="hidden" name="c_description" value="Membership Upgrade or Renewal - {$item_name}" />
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
