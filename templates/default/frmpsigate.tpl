{strip}
<div class="module_detail_inside" >
	{assign var="page_hdr02_text" value="<input type='radio' name='payment' value='"|cat:$item.module_key|cat:"' "}
	{if $smarty.get.payment_method eq $item.module_key }
		{assign var="page_hdr02_text" value=$page_hdr02_text|cat:" checked "}
	{/if}
	{assign var="page_hdr02_text" value=$page_hdr02_text|cat:" /> "|cat:$item.name}
	{include file="page_hdr02.tpl"}
	<table width="100%" border="0" cellpadding="($config.cellpadding}" cellspacing="{$config.cellspacing}">
		<tr>
			<td width="35%">
				{lang mkey='cc_owner'}
			</td>
			<td width="65%">
				<input type="text" class="textinput"  name="psigate_cc_owner" />
			</td>
		</tr>
		<tr>
			<td>{lang mkey='cc_number'}</td>
			<td><input type="text" class="textinput"  name="psigate_cc_number" /></td>
		</tr>
		<tr>
			<td>{lang mkey='cc_exp_date'}</td>
			<td>
				{html_select_date_translated display_days=false end_year=+10 prefix="psigate_cc_expires_"}
			</td>
		</tr>
	</table>
</div>
{/strip}
