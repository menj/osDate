{strip}
{assign var="page_hdr01_text" value="<a href='paymentmod.php' class='subhead'>"|cat:"{lang mkey='payment_modules'}"|cat:'</a>'}
{assign var="page_title" value="{lang mkey='payment_modules'}"}
{include file="admin/admin_page_hdr01.tpl"}
<div class="module_detail_inside" style="padding-top:6px;">
	{assign var="page_hdr02_text" value="{lang mkey='edit_payment_modules'}: "|cat:$data.module_key}
	{include file="admin/admin_page_hdr02.tpl"}
	<form action="modifypaymentmod.php" method="post">
		<input type="hidden" name="payment" value="{$data.module_key}" />
		{include file=$data.formfile}<br />
		<div class="line_outer">
			<input type="submit" class="formbutton" value="{lang mkey='submit'}" />
		</div>
	</form>
</div>
{/strip}