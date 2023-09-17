<table border="0" cellpadding="0" cellspacing="0" width="100%">
	<tr>
		<td width="100%"  class="module_detail_inside">
			{assign var="page_hdr01_text" value=$lang.backup}
			{include file="page_hdr01.tpl"}

<div style="padding-left:4px;padding-top:4px">
{if $error == 1}
	{assign var="error_message" value=$lang.error2}
	{include file="display_error.tpl"}
	<br/><a href="?plugin={$plugin_name}">{$lang.return}</a>
{/if}
{if $error == 0}
	{assign var="error_message" value=$lang.succes2}
	{include file="display_error.tpl"}
	<br/><a href="?plugin={$plugin_name}">{$lang.return}</a>{/if}
</div>
</table>