{strip}
{assign var="page_hdr02_text" value="<input type='radio' name='payment_method' value='"|cat:$item.id|cat:"' "}
{if $smarty.get.payment_method eq $item.id }
	{assign var="page_hdr02_text" value=$page_hdr02_text|cat:" checked "}
{/if}
{assign var="page_hdr02_text" value=$page_hdr02_text|cat:" /> "|cat:$item.name}
{include file="page_hdr02.tpl"}
<div class="module_detail_inside">

	{if $data.show_form}
			<table width="100%" border="0" cellpadding="{$config.cellpadding}"  cellspacing="{$config.cellspacing}">
				<tr><td width="35%">{lang mkey='cc_owner'}</td><td width="65%"><input type="text"  class="textinput" name="paypal_ccowner"/></td></tr>
				<tr><td>{lang mkey='cc_number'}</td><td><input type="text" class="textinput"  name="paypal_ccnumber"/></td></tr>
				<tr><td>{lang mkey='cc_exp_date'}</td>
					<td>
						{html_select_date_translated display_days=false end_year=+10 prefix="paypal_exp_"}
					</td>
				</tr>
				<tr><td>{lang mkey='cc_cvv_number'}</td><td><input type="text" class="textinput"  name="paypal_cvvnumber" size="4" maxlength="3"/>&nbsp;{lang mkey='cvv_help'}</td></tr>
			</table>
		{/if}
</div>
{/strip}
