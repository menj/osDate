{strip}
<div  style="vertical-align:top;" align=center>
	{assign var="page_hdr01_text" value="{lang mkey='cancel_hdr'}"}
	{assign var="page_title" value="{lang mkey='cancel_hdr'}"}
	{include file="page_hdr01.tpl"}
	<div class="module_detail_inside">
		<div style="padding: 6px; ">
		{if $step eq '1'}
			{lang mkey='cancel_txt01'}<br /><br />
			<form name="cancel1" method="post" action="cancel.php">
			<input name="action" type="submit" value="{lang mkey='cancel_opt01'}" class="formbutton"/>&nbsp;
			<input name="action" type="submit" value="{lang mkey='cancel_opt02'}" class="formbutton"/>
			</form>

		{ elseif $step eq '2' }
			{lang mkey='cancel_domsg'}
		{ else }
			{lang mkey='cancel_nomsg'}
		{/if}
		</div>
	</div>
</div>
{/strip}
