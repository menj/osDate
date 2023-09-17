{strip}
<div  style="vertical-align:top;" >
	{assign var="page_hdr01_text" value="{lang mkey='aff_panel'}"}
	{assign var="page_title" value="{lang mkey='aff_panel'}"}
	{include file="page_hdr01.tpl"}
	<div class="module_detail_inside" style="width:80%; text-align:center;">
		{assign var="page_hdr02_text" value="{lang mkey='welcome'} "|cat:$smarty.session.AffName}
		{include file="page_hdr02.tpl"}

		<table width="100%" border="0" cellpadding="{$config.cellpadding}" cellspacing="{$config.cellspacing}">
			<tr><td colspan="2">
				<a href="affchangepass.php">{lang mkey='change_password'}</a>&nbsp;&nbsp;<a href="afflogout.php">{lang mkey='sign_out'}</a>
				<br />
				<br />
				</td></tr>
			<tr>
				<td>{lang mkey='total_amt'}:</td>
				<td><b>${$profcounter*$config.aff_referral_price}</b></td>
			</tr>
			<tr><td colspan="2"></td></tr>
			<tr>
				<td>{lang mkey='banner_link'}:</td>
				<td>http://{$smarty.server.SERVER_NAME}{$docroot}index.php?affid={$smarty.session.AffId}</td>
			</tr>
			<tr><td colspan="2"></td></tr>
			<tr>
				<td>{lang mkey='referals'}:</td>
				<td>{$refcounter}</td>
			</tr>
			<tr><td colspan="2"></td></tr>
			<tr>
				<td>
					{if $profcounter > 0 }
						{lang mkey='profiles'}:
					{else}
						{lang mkey='profiles'}:
					{/if}
				</td>
				<td>{$profcounter}</td>
			</tr>
		</table>
		<br />
	</div>
</div>
{/strip}
