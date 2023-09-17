{strip}
<div clas="line_outer" style="padding-top: 6px;">
	<b>SECPay</b>
	<br /><br />
	<b>Merchant ID</b><br />
	Merchant ID to use for the SECPay service<br />
	<input type="text" class="textinput"  name="configuration[MODULE_PAYMENT_SECPAY_MERCHANT_ID]" value="{$paymod_data.MODULE_PAYMENT_SECPAY_MERCHANT_ID}" />
	<br /><br />
	<b>Transaction Currency</b><br />
	The currency to use for credit card transactions<br />
	<input type="radio" name="configuration[MODULE_PAYMENT_SECPAY_CURRENCY]" value="Any Currency"
					{if $paymod_data.MODULE_PAYMENT_SECPAY_CURRENCY == 'Any Currency'}checked="checked"{/if} /> Any Currency<br />
	<input type="radio" name="configuration[MODULE_PAYMENT_SECPAY_CURRENCY]" value="Default Currency"
					{if $paymod_data.MODULE_PAYMENT_SECPAY_CURRENCY == 'Default Currency'}checked="checked"{/if} /> Default Currency
	<br /><br />
	<b>Transaction Mode</b><br />
	Transaction mode to use for the SECPay service<br />
	<input type="radio" name="configuration[MODULE_PAYMENT_SECPAY_TEST_STATUS]" value="Always Successful"
					{if $paymod_data.MODULE_PAYMENT_SECPAY_TEST_STATUS == 'Always Successful'}checked="checked"{/if} /> Always Successful<br />
	<input type="radio" name="configuration[MODULE_PAYMENT_SECPAY_TEST_STATUS]" value="Always Fail"
					{if $paymod_data.MODULE_PAYMENT_SECPAY_TEST_STATUS == 'Always Fail'}checked="checked"{/if} /> Always Fail<br />
	<input type="radio" name="configuration[MODULE_PAYMENT_SECPAY_TEST_STATUS]" value="Production"
					{if $paymod_data.MODULE_PAYMENT_SECPAY_TEST_STATUS == 'Production'}checked="checked"{/if} /> Production
	<br /><br />
	<b>Remote Password</b><br />
	Remote password allocated to use for the SECPay service<br />
	<input type="password" class="textinput" name="configuration[MODULE_PAYMENT_SECPAY_REMOTE_PASSWORD]" value="{$paymod_data.MODULE_PAYMENT_SECPAY_REMOTE_PASSWORD}" />
	<br /><br />
	<b>Digest Key</b><br />
	Digest Key allocated to use for the SECPay service<br />
	<input type="text" class="textinput"  name="configuration[MODULE_PAYMENT_SECPAY_DIGESTKEY]" value="{$paymod_data.MODULE_PAYMENT_SECPAY_DIGESTKEY}" />
{if $smarty.get.saved == 'yes'}
		<script language="javascript">
  /* <![CDATA[ */
			alert("{lang mkey='settings_saved'}");
  /* ]]> */
		</script>
{/if}
</div>
{/strip}
