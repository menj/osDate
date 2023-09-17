<table width="100%" cellpadding="{$config.cellpadding}" cellspacing="{$config.cellspacing}" border="0" >
		{assign var="cntr" value=0}
		{foreach from=$loadedfiles item=item key=key}
	{if $cntr < $loadedcnt}
	<tr>
		<td style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;	font-weight: normal;">
			{$item} <b> - {lang mkey="zip_loaded"}</b>
		</td>
	</tr>
	{/if}
		{assign var="cntr" value=$cntr+1}
		{/foreach}
{if $dispmsg != ''}
	<tr>
		<td style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;	font-weight: normal;">
			<b>{$dispmsg}</b>
		</td>
	</tr>
{/if}
</table>
