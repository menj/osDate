{strip}

<form action='https://bill.ccbill.com/jpost/signup.cgi' method=POST>

	<table width="100%" border="0" cellpadding="0" cellspacing="0" >

		<tr>

			<td class="module_detail" width="100%">

				{assign var="page_hdr01_text" value="{lang mkey='confirmation'}"}
				{assign var="page_title" value="{lang mkey='confirmation'}"}

				{include file="page_hdr01.tpl"}

				<table border="0" cellpadding="{$config.cellpadding}" cellspacing="{$config.cellspacing}" width="100%">



					<tr><td>{lang mkey='info_confirm'}</td></tr>

					<tr><td>{lang mkey='name'}{$smarty.session.FullName|stripslashes}

						</td></tr>

					<tr><td>{lang mkey='change_mship_to'}<b>{$item_name}</b>.</td></tr>

					<tr><td>{lang mkey='amount'}{mylang mkey='support_currency' skey=$currency}{$amount}</td></tr>

					<tr><td>
							<div align="center"><b><font color="#BBAAGG" size="4" face="Verdana, Arial, Helvetica, sans-serif">CREDIT CARD</font></b><br>

								<input type="hidden" name="clientAccnum" value='{$accNum}' />

								<input type="hidden" name="clientSubacc" value='{$subaccNum}' />

								<input type="hidden" name="formName" value='{$formName}' />

								<input type="hidden" name="language" value='English'  />

								<input type="hidden" name="currencyCode" value='840'  />

								<input type="hidden" name="allowedTypes"  value='{$allowedTypes}:840' />

								<input type="hidden" name="subscriptionTypeId" value='{$subType}:840' />

								<input type="hidden" name="invoiceid" value='{$invoice_no}'  />

								<input type="hidden" name="username" value='{$smarty.session.UserName}' />

								<input type="hidden" name="password" value='pass{$smarty.session.UserName}' />

								<input type="hidden" name="confirm_password" value='pass{$smarty.session.UserName}' />

								<input type="hidden" name="customer_fname" value='{$smarty.session.FirstName}' />

								<input type="hidden" name="customer_lname" value='{$smarty.session.FirstName|replace:$smarty.session.FirstName:""}' />

								<input type="hidden" name="paid_thru" value='ccbill' />

								<input type="submit" name="submit" value="Pay Now" />

							</div>

						</td>

					</tr>

				</table>

			</td>

		</tr>
	</table>

</form>

{/strip}

