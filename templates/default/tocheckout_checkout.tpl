{strip}
{assign var="page_hdr01_text" value="{lang mkey='confirmation'}"}
{include file="page_hdr01.tpl"}

<div class="module_detail" style="vertical-align:top; padding:6px;">

	<form action="https://www.2checkout.com/cgi-bin/Abuyers/purchase.2c" method="post">
	<input type="hidden" name="x_login" value="{$loginid}"/>
	<input type="hidden" name="sid" value="{$loginid}"/>
	<input type="hidden" name="x_card_num" value="{$cc_number}"/>
	<input type="hidden" name="x_exp_date" value="{$cc_expiry_date}"/>
	<input type="hidden" name="cvv" value="{$cvv}"/>
	<input type="hidden" name="x_amount" value="{$amount}"/>
	<input type="hidden" name="x_invoice_num" value="{$invoice_num}"/>
	<input type="hidden" name="x_receipt_link_url" value="http://{$smarty.server.SERVER_NAME}{$docroot}checkout_process.php"/>
	<input type="hidden" name="return_url" value="http://{$smarty.server.SERVER_NAME}{$docroot}checkout_process.php"/>
	<input type="hidden" name="x_cust_id" value="{$smarty.session.UserId}"/>
	<input type="hidden" name="x_name" value="{$smarty.session.FullName}"/>
	<input type="hidden" name="x_test_request" value="Y"/>
	<input type="hidden" name="x_email_merchant" value="TRUE"/>
	<input type="hidden" name="product_id" value="{$item_no}"/>
	<input type="hidden" name="id_type" value="2"/>
	<input type="hidden" name="c_prod" value="{$item_no}"/>
	<input type="hidden" name="quantity" value="1"/>
	<input type="hidden" name="total" value="{$amount}"/>

	{* used by checkout_process.php to validate order *}
	<input type="hidden" name="cart_order_id" value="{$invoice_num}"/>

	<input type="hidden" name="level_name" value="{$item_name}"/>
	<input type="hidden" name="user_id" value="{$smarty.session.UserId}"/>
	<input type="hidden" name="user_level" value="{$item_no}"/>
	<div class="line_outer">
		<table border="0" cellpadding="{$config.cellpadding}" cellspacing="{$config.cellspacing}" width="100%">
			<tr><td colspan="2"><b>{$payment_method} {$cc_type}</b></td></tr>
			<tr><td>{lang mkey='cc_owner'}</td><td>{$cc_owner}</td></tr>
			<tr><td>{lang mkey='cc_number'}</td><td>{$cc_part1}XXXXXXXX{$cc_part2}</td></tr>
			<tr><td>{lang mkey='cc_exp_date'}</td><td>{$cc_expiry_month}, {$cc_expiry_year}</td></tr>
			<tr><td>{lang mkey='amount'}</td><td>{$amount}{$currency_is}</td></tr>
			<tr><td colspan="2">{lang mkey='change_mship_to'} <b>{$item_name}</b>.</td></tr>
			<tr>
				<td colspan="2"><input type="submit" class="formbutton" value="{lang mkey='confirm'}"/></td>
			</tr>
		</table>
	</div>
	</form>
</div>
{/strip}
