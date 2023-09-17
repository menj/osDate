{strip}
<div class="line_outer" style="padding-top: 6px;">
	<b>Credit Card</b>
	<br /><br />
	<b>Split Credit Card E-Mail Address</b><br />
	If an e-mail address is entered, the middle digits of the credit card number
	will be sent to the e-mail address (the outside digits are stored in the database
	with the middle digits censored)<br />
	<input type="text" class="textinput" name="configuration[MODULE_PAYMENT_CC_EMAIL]" value="{$paymod_data.MODULE_PAYMENT_CC_EMAIL}" size="40" />
{if $smarty.get.saved == 'yes'}
	<script language="javascript">
		alert("{lang mkey='settings_saved'}");
	</script>
{/if}
</div>
{/strip}
