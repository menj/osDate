{strip}
<div class="line_outer" style="padding-top: 6px;">
	<b>E-Mail Address</b><br />
	The e-mail address to use for the PayPal service<br />
	<input type="text" class="textinput"  name="configuration[MODULE_PAYMENT_PAYPAL_ID]" value="{$paymod_data.MODULE_PAYMENT_PAYPAL_ID}" size="40" />
<br /><br />
	<b>Payment Mode</b><br />
	The Payment Mode (test/live)<br />
	<input type="radio" name="configuration[MODULE_PAYMENT_PAYPAL_TESTMODE]" value="test" {if $paymod_data.MODULE_PAYMENT_PAYPAL_TESTMODE=='test' or $paymod_data.MODULE_PAYMENT_PAYPAL_TESTMODE=='Test'}checked{/if}  />Test&nbsp;&nbsp;
	<input type="radio" name="configuration[MODULE_PAYMENT_PAYPAL_TESTMODE]" value="live" {if $paymod_data.MODULE_PAYMENT_PAYPAL_TESTMODE=='live' or $paymod_data.MODULE_PAYMENT_PAYPAL_TESTMODE=='Live'}checked{/if}  />Live
{if $smarty.get.saved == 'yes'}
	<script language="javascript">
/* <![CDATA[ */
		alert("{lang mkey='settings_saved'}.");
/* ]]> */
	</script>
{/if}
</div>
{/strip}
