{strip}
<div class="line_outer" style="padding-top: 6px;">
	<b>E-Gold</b>
	<br /><br />
	<b>E-Gold Account Number</b><br />
	Your E-Gold account number<br />
	<input type="text" class="textinput"  name="configuration[MODULE_PAYMENT_EGOLD_ID]" value="{$paymod_data.MODULE_PAYMENT_EGOLD_ID}" size="20" />
	<br /><br />
	<b>E-Gold Account Name</b><br />
	Your E-Gold account name to be shown in E-Gold payment form<br />
	<input type="text" class="textinput"  name="configuration[MODULE_PAYMENT_EGOLD_NAME]" value="{$paymod_data.MODULE_PAYMENT_EGOLD_NAME}" size="20" />
	<br /><br />
	<b>Metal to Receive payment</b><br />
	Metal in which you wish to receive payment in E-Gold account<br />
	<select name="configuration[MODULE_PAYMENT_EGOLD_METALID]">
		<option value='0' {if $paymod_data.MODULE_PAYMENT_EGOLD_METALID =='0'} SELECTED{/if}>Buyer\'s Option</option>
		<option value='1' {if $paymod_data.MODULE_PAYMENT_EGOLD_METALID =='1'} SELECTED{/if}>Gold</option>
		<option value='2' {if $paymod_data.MODULE_PAYMENT_EGOLD_METALID =='2'} SELECTED{/if}>Silver</option>
		<option value='3' {if $paymod_data.MODULE_PAYMENT_EGOLD_METALID =='3'} SELECTED{/if}>Platinum</option>
		<option value='4' {if $paymod_data.MODULE_PAYMENT_EGOLD_METALID =='4'} SELECTED{/if}>Palladium</option>
	</select>
{if $smarty.get.saved == 'yes'}
			<script language="javascript">
      /* <![CDATA[ */
				alert("{lang mkey='settings_saved'}");
      /* ]]> */
			</script>
{/if}
</div>
{/strip}
