{strip}
<div class="module_detail" >
	<form action="authorizenet_process.php" method="post">
		<input type="hidden" name="x_login" value="{$loginid}" />
		<input type="hidden" name="x_amount" value="{$amount}" />
		<input type="hidden" name="x_invoice_num" value="{$invoice_no}" />
		<input type="hidden" name="x_card_num" value="{$cc_number}" />
		<input type="hidden" name="x_exp_date" value="{$cc_expiry_date}" />
		<input type="hidden" name="x_card_code" value="{$paypal_cvvnumber}" />

		<INPUT TYPE=HIDDEN NAME="x_version" VALUE="3.0" />
		<input type="hidden" name="x_trans_key" value ="{$trans_key}"v />
		<input type="hidden" name="x_trans_mode" value ="{$trans_mode}" />

		<input type="hidden" name="x_description" value="membership upgrade/renewal of {$config.site_name}" />
		<input type="hidden" name="x_method" value="{$trans_method}" />
		<input type="hidden" name="pay_txn_id" value="{$pay_txn_id}" />
		<input type="hidden" name="x_customer_ip" value="{$smarty.server.REMOTE_ADDR}" />
		{if $trans_mode == 'test'}
			<input type="hidden" name="x_test_request" value="TRUE" />
		{/if}
		{assign var="page_hdr01_text" value="{lang mkey='confirmation'}"}
		{include file="page_hdr01.tpl"}
		<table border="0" cellpadding="{$config.cellpadding}" cellspacing="{$config.cellspacing}" width="100%">
			<tr>
				<td>
					<table width="80%">
						<tr><td colspan="2"><b>{$payment_method} {$cc_type}</b></td></tr>
						<tr><td>{lang mkey='cc_owner'}</td><td>{$cc_owner}</td></tr>
						<tr><td>{lang mkey='cc_number'}</td><td>{$cc_part1}XXXXXXXX{$cc_part2}</td></tr>
						<tr><td>{lang mkey='cc_exp_date'}</td><td>{$cc_expiry_month}/{$cc_expiry_year}</td></tr>
						<tr><td>{lang mkey='cc_cvv_number'}</td><td>{$paypal_cvvnumber}/{$cc_expiry_year}</td></tr>
						<tr><td>{lang mkey='amount'}</td><td>{lang mkey='support_currency' skey="$currency"}{$amount}</td></tr>
						<tr><td colspan="2">{lang mkey='change_mship_to'} <b>{$item_name}</b>.</td></tr>
					</table>
				</td>
			</tr>
			<tr>
				<td><input type="submit" class="formbutton" value="{lang mkey='confirm'}" /></td>
			</tr>
		</table>
	</form>
</div>
{/strip}
