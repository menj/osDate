{strip}
<div class="line_outer" style="padding-top: 6px;">
		<b>Authorize.Net</b>
		<br /><br />
		<b>Login Username</b><br />
		The login username used for the Authorize.net service<br />
		<input type="text" class="textinput"  name="configuration[MODULE_PAYMENT_AUTHORIZENET_LOGIN]" value="{$paymod_data.MODULE_PAYMENT_AUTHORIZENET_LOGIN}" />
		<br /><br />
		<b>Transaction Key</b><br />
		Transaction Key used for encrypting TP data<br />
		<input type="text" class="textinput"  name="configuration[MODULE_PAYMENT_AUTHORIZENET_TXNKEY]" value="{$paymod_data.MODULE_PAYMENT_AUTHORIZENET_TXNKEY}" />
		<br /><br />
		<b>Transaction Mode</b><br />
		Transaction mode used for processing orders<br />
		<input type="radio" name="configuration[MODULE_PAYMENT_AUTHORIZENET_TESTMODE]" value="Test"
								{if $paymod_data.MODULE_PAYMENT_AUTHORIZENET_TESTMODE== 'Test'}checked{/if} /> Test<br />
		<input type="radio" name="configuration[MODULE_PAYMENT_AUTHORIZENET_TESTMODE]" value="Production"
								{if $paymod_data.MODULE_PAYMENT_AUTHORIZENET_TESTMODE == 'Production'}checked{/if} /> Production
{if $smarty.get.saved == 'yes'}
			<script type="text/javascript">
      /* <![CDATA[ */
				alert("{lang mkey='settings_saved'}");
      /* ]]> */
			</script>
{/if}
</div>
{/strip}
