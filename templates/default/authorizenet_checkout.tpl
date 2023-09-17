{strip}
<div class="module_detail" style="width:99.9%;vertical-align:top; padding:6px;">
	<form action="{$gateway_url}" method="post">
	<input type="hidden" name="x_login" value="{$loginid}" />
	<input type="hidden" name="x_amount" value="{$amount}" />
	<input type="hidden" name="x_invoice_num" value="{$invoice_no}" />
	<INPUT TYPE=HIDDEN NAME="x_version" VALUE="3.0" />
	<input type="hidden" name="x_fp_sequence" value="{$sequence}" />
	<input type="hidden" name="x_fp_timestamp" value="{$tstamp}" />
	<input type="hidden" name="x_fp_hash" value="{$fp}" />
	<input type="hidden" name="x_relay_response" value="True" />
	<input type="hidden" name="x_show_form" value="PAYMENT_FORM" />

	<input type="hidden" name="x_relay_url" value='http://{$smarty.server.SERVER_NAME}{$docroot}authorizenet_prog.php' />

{*			<input type="hidden" name="x_receipt_link_method" value="POST" />
	<input type="hidden" name="x_receipt_link_url" value="http://{$smarty.server.SERVER_NAME}{$docroot}authorizenet_prog.php" />
*}
	<input type="hidden" name="x_description" value="membership upgrade/renewal of {$config.site_name}" />
	<input type="hidden" name="x_method" value="{$trans_method}" />
	<input type="hidden" name="pay_txn_id" value="{$pay_txn_id}" />
	<input type="hidden" name="x_customer_ip" value="{$smarty.server.REMOTE_ADDR}" />
	<input type="hidden" name="x_test_request" value="TRUE" />
	{assign var="page_hdr01_text" value="{lang mkey='confirmation'}"}
	{include file="page_hdr01.tpl"}
	<table border="0" cellpadding="{$config.cellpadding}" cellspacing="{$config.cellspacing}" width="100%">
		<tr><td colspan="2"><b>{$payment_method} {$cc_type}</b></td></tr>
		<tr><td>{lang mkey='cc_owner'}</td><td>{$cc_owner}</td></tr>
		<tr><td>{lang mkey='cc_number'}</td><td>{$cc_part1}XXXXXXXX{$cc_part2}</td></tr>
		<tr><td>{lang mkey='cc_exp_date'}</td><td>{$cc_expiry_month}/{$cc_expiry_year}</td></tr>
		<tr><td>{lang mkey='amount'}</td><td>{$currency_is}{$amount}</td></tr>
		<tr><td colspan="2">{lang mkey='change_mship_to'} <b>{$item_name}</b>.</td></tr>
		<tr>
			<td><input type="submit" class="formbutton" value="{lang mkey='confirm'}" /></td>
		</tr>
	</table>
	</form>
</div>
{/strip}
