{strip}
<div class="line_outer" style="padding-top: 6px;">
	<b>NOCHEX</b>
<br /><br />
	<b>E-Mail Address</b><br />
	The e-mail address to use for the NOCHEX service<br />
	<input type="text" class="textinput"  name="configuration[MODULE_PAYMENT_NOCHEX_ID]" value="{$paymod_data.MODULE_PAYMENT_NOCHEX_ID}" size="40" />
<br /><br />
	<b>Test or Live Mode</b><br />
	You are using this in test or live mode?<br />
	<input type="radio" name="configuration[MODULE_PAYMENT_NOCHEX_TESTMODE]" value="test" {if $paymod_data.MODULE_PAYMENT_NOCHEX_TESTMODE == 'test'}checked{/if}  />Test&nbsp;&nbsp;
	<input type="radio" name="configuration[MODULE_PAYMENT_NOCHEX_TESTMODE]" value="live" {if $paymod_data.MODULE_PAYMENT_NOCHEX_TESTMODE == 'live'}checked{/if}  />Live
{if $smarty.get.saved == 'yes'}
	<script language="javascript">
/* <![CDATA[ */
		alert("{lang mkey='settings_saved'}");
/* ]]> */
	</script>
{/if}
</div>
{/strip}
