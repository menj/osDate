{strip}
<br />
<div >
	{assign var="page_hdr02_text" value="{lang mkey='rate_profile'}"}
	{include file="page_hdr02.tpl"}
	<div class="module_detail_inside">
		<div class="line_outer">
			<form method="post" action="rateuser.php">
				<input type="hidden" value="{$smarty.get.id}" name="profileid"/>
				<input type="hidden" value="{$smarty.session.UserId}" name="userid"/>
			<table width="100%" border="0" cellspacing="{$config.cellspacing}" cellpadding="{$config.cellpadding}">
				<tr>
					<td><b>{lang mkey='worst'}</b></td>
					<td>&nbsp;</td>
				{foreach item=item from=$rate_values}
					{if $item == 0}
					<td><input type="radio" name="txtrate" value="{$item}" checked="checked"/><b>{$item}</b></td>
					{else}
					<td><input type="radio" name="txtrate" value="{$item}"/><b>{$item}</b></td>
					{/if}
				{/foreach}
					<td>&nbsp;</td>
					<td><b>{lang mkey='excellent'}</b></td>
				</tr>
				<tr>
					<td align="center"><input type="submit" class="formbutton" value="{lang mkey='submitrating'}"/></td>
				</tr>
			</table>
			</form>
			<br />
		</div>
	</div>
</div>
{/strip}
