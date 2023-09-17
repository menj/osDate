<table cellspacing="{$config.cellspacing}" cellpadding="{$config.cellpadding}"  width="100%">

    <tr>

		<td width="50%">
			<b>ccBill Account Number</b>
		</td>
		<td>
			<input type="text" class="textinput"  name="configuration[MODULE_PAYMENT_CCBILL_CLIENT_ACCOUNT_NUMBER]" value="{$paymod_data.MODULE_PAYMENT_CCBILL_CLIENT_ACCOUNT_NUMBER}" size="20" />

		</td>
	</tr>
	<tr>
		<td>
			<b>ccBill Sub Account Number</b>
		</td>
		<td>
			<input type="text" class="textinput"  name="configuration[MODULE_PAYMENT_CCBILL_CLIENT_SUB_NUMBER]" value="{$paymod_data.MODULE_PAYMENT_CCBILL_CLIENT_SUB_NUMBER}" size="10" />
		</td>
	</tr>
	<tr>
		<td>
			<b>ccBill form to use (from ccBill webadmin) </b>

		</td>
		<td>
			<input type="text" class="textinput" name="configuration[MODULE_PAYMENT_CCBILL_FORM_NAME]" value="{$paymod_data.MODULE_PAYMENT_CCBILL_FORM_NAME}" size="10" />
		</td>
	</tr>
	<tr>
		<td>
			<b>ccBill subscription type (set in ccbill webadmin) </b>

		</td>
		<td>
			<input type="text" class="textinput"  name="configuration[MODULE_PAYMENT_CCBILL_SUBSCRIPTION_TYPES]" value="{$paymod_data.MODULE_PAYMENT_CCBILL_SUBSCRIPTION_TYPES}" size="10" />
		</td>
	</tr>

</table>

{if $smarty.get.saved == 'yes'}

{strip}

			<script language="javascript">

      /* <![CDATA[ */

				alert("{lang mkey='settings_saved'}.");

      /* ]]> */

			</script>

{/strip}

{/if}

