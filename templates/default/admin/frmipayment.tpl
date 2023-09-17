{strip}
<div class="line_outer" style="padding-top: 6px;">
	<b>iPayment</b>
	<br /><br />
	<b>Account Number</b><br />
	The account number used for the iPayment service<br />
	<input type="text" class="textinput"  name="configuration[MODULE_PAYMENT_IPAYMENT_ID]" value="{$paymod_data.MODULE_PAYMENT_IPAYMENT_ID}">
	<br /><br />
	<b>User ID</b><br />
	The user ID for the iPayment service<br />
	<input type="text" class="textinput"  name="configuration[MODULE_PAYMENT_IPAYMENT_USER_ID]" value="{$paymod_data.MODULE_PAYMENT_IPAYMENT_USER_ID}" />
	<br /><br />
	<b>User Password</b><br />
	The user password for the iPayment service<br />
	<input type="text" class="textinput"  name="configuration[MODULE_PAYMENT_IPAYMENT_PASSWORD]" value="{$paymod_data.MODULE_PAYMENT_IPAYMENT_PASSWORD}" />
	<br /><br />
	<b>Transaction Currency</b><br />
	The currency to use for credit card transactions<br />
	<input type="radio" name="configuration[MODULE_PAYMENT_IPAYMENT_CURRENCY]" value="Always EUR"
			{if $paymod_data.MODULE_PAYMENT_IPAYMENT_CURRENCY == 'Always EUR'}CHECKED{/if} /> Always EUR<br />
	<input type="radio" name="configuration[MODULE_PAYMENT_IPAYMENT_CURRENCY]" value="Always USD"
			{if $paymod_data.MODULE_PAYMENT_IPAYMENT_CURRENCY == 'Always USD'}CHECKED{/if} /> Always USD<br />
	<input type="radio" name="configuration[MODULE_PAYMENT_IPAYMENT_CURRENCY]" value="Either EUR or USD, else EUR"
			{if $paymod_data.MODULE_PAYMENT_IPAYMENT_CURRENCY == "Either EUR or USD, else EUR"}CHECKED{/if} /> Either EUR or USD, else EUR<br />
	<input type="radio" name="configuration[MODULE_PAYMENT_IPAYMENT_CURRENCY]" value="Either EUR or USD, else USD"
			{if $paymod_data.MODULE_PAYMENT_IPAYMENT_CURRENCY == 'Either EUR or USD, else USD'}CHECKED{/if} /> Either EUR or USD, else USD
{if $smarty.get.saved == 'yes'}
	<script language="javascript">
		alert("{lang mkey='settings_saved'}");
	</script>
{/if}
</div>
{/strip}
