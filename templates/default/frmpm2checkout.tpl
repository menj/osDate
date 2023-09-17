{strip}
<div class="module_detail_inside" >
	{assign var="page_hdr02_text" value="<input type='radio' name='payment' value='"|cat:$item.module_key|cat:"' "}
	{if $smarty.get.payment_method eq $item.module_key }
		{assign var="page_hdr02_text" value=$page_hdr02_text|cat:" checked "}
	{/if}
	{assign var="page_hdr02_text" value=$page_hdr02_text|cat:" /> "|cat:$item.name}
	{include file="page_hdr02.tpl"}
</div>
{/strip}
