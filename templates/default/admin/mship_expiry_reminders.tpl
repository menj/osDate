{strip}
{assign var="page_hdr01_text" value="{lang mkey='expiry_hdr'}"}
{assign var="page_title" value="{lang mkey='expiry_hdr'}"}
{include file="admin/admin_page_hdr01.tpl"}
<div class="module_detail_inside" style="padding-top:1px; text-align:left;">
	{if $msg != ''}
		{assign var="error_message" value=$msg}
		{include file="display_error.tpl"}
	{/if}
	<div class="line_outer">
		<div style="display:inline; float:left; width:30%;">
			{lang mkey='expiry_select'}:
		</div>
		<div style="display:inline; float:left; width:69%;">
		    <form name="frmMshipLtr" action="mship_expiry_reminders.php" method="post" >
		    	<table border="0" cellspacing="0" cellpadding="0">
		    	{foreach from=$expiry_levels key=lev item=item}
					<tr>
						<td width="5" valign="middle" height="20">
							<input type="radio" name="expiryLevel" value="{$lev}-{$expiry_counts[$lev].start_time}-{$expiry_counts[$lev].end_time}" />
						</td>
						<td valign="middle">{$item} ({lang mkey="totalusers"}: {$expiry_counts[$lev].count})
						</td>
					</tr>
				{/foreach}
				</table>
				<br />
				<input type="submit"  class="formbutton" value="{lang mkey='send'}" />
		    </form>
		</div>
		<div style="clear:both;"></div>
	</div>
</div>
{/strip}