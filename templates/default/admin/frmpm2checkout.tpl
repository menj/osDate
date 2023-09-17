{strip}
<div class="line_outer" style="padding-top: 6px;">
	<b>2CheckOut.com</b>
<br /><br />
	<b>Login/Merchant ID</b><br />
	Login/Merchant ID used for the 2CheckOut service<br />
	<input type="text" class="textinput"  name="configuration[MODULE_PAYMENT_2CHECKOUT_LOGIN]" value="{$paymod_data.MODULE_PAYMENT_2CHECKOUT_LOGIN}" />
<br /><br />
	<b>Transaction Mode</b><br />
	Transaction mode used for the 2Checkout service<br />
	<input type="radio" name="configuration[MODULE_PAYMENT_2CHECKOUT_TESTMODE]" value="Test"
			{if $paymod_data.MODULE_PAYMENT_2CHECKOUT_TESTMODE == 'Test'}checked="checked"{/if} /> Test<br />
	<input type="radio" name="configuration[MODULE_PAYMENT_2CHECKOUT_TESTMODE]" value="Production"
			{if $paymod_data.MODULE_PAYMENT_2CHECKOUT_TESTMODE == 'Production'}checked="checked"{/if} /> Production
<br /><br />
	<b>Merchant Notifications</b><br />
	Should 2CheckOut e-mail a receipt to the store owner?<br />
	<input type="radio" name="configuration[MODULE_PAYMENT_2CHECKOUT_EMAIL_MERCHANT]" value="True"
			{if $paymod_data.MODULE_PAYMENT_2CHECKOUT_EMAIL_MERCHANT == 'True'}checked="checked"{/if} /> True<br />
	<input type="radio" name="configuration[MODULE_PAYMENT_2CHECKOUT_EMAIL_MERCHANT]" value="False"
			{if $paymod_data.MODULE_PAYMENT_2CHECKOUT_EMAIL_MERCHANT == 'False'}checked="checked"{/if} /> False
{if $smarty.get.saved == 'yes'}
			<script language="javascript">
      /* <![CDATA[ */
				alert("{lang mkey='settings_saved'}");
      /* ]]> */
			</script>
{/if}
</div>
{/strip}
