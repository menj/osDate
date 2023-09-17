<script type="text/javascript">
function checkme()
{ldelim}
	return confirm("{lang mkey='delcounties_msg'}");
{rdelim}
</script>
{strip}
{assign var="page_hdr01_text" value="{lang mkey='load_counties'}"}
{assign var="page_title" value="{lang mkey='load_counties'}"}
{include file="admin/admin_page_hdr01.tpl"}
<div class="module_detail_inside" style="padding-top:1px; text-align:left;">
	{if $msg != ''}
		{assign var="error_message"  value=$msg}
		{include file="display_error.tpl"}
	{/if}
	<div class="line_outer">
		<div class="line_top_bottom_pad" style="margin-bottom: 10px;">
			{lang mkey='county_ensure'}<br />
		</div>
		<div class="line_top_bottom_pad">
			<form action="" method=post>
			<table border="0">
				<tr><td width="30%">{lang mkey='country'}:</td>
					<td width="70%">
						<select name="cntry" >
						{html_options options=$lang.countries selected=$cntry}
						</select>
					</td>
				</tr>
				<tr><td width="30%">{lang mkey='countyfile'}:</td>
					<td width="70%">
						<select name="filename">
						{html_options values=$files output=$files selected=$filename}
						</select>
					</td>
				</tr>
				<tr><td width="30%">{lang mkey='loadaction'}:</td>
					<td width="70%">
						<table border="0" cellspacing="0" cellpadding="0">
							<tr>
								<td width="5" valign="middle">
									<input type=radio name="loadaction" value="DB" checked />
								</td>
								<td valign="middle">{lang mkey='loadintodb'}</td>
								<td width="6"></td>
								<td width="5" valign="middle">
								<input type=radio name="loadaction" value="SQL" />
								</td>
								<td valign="middle">{lang mkey='createsql'}
								</td>
							</tr>
						</table>
					</td>
				<tr>
					<td colspan="2">
						<input type=submit  class="formbutton" name="loadcounties" value="{lang mkey='load_counties_button'}" />&nbsp;&nbsp;
						<input type=submit  class="formbutton" name="delcounties" value="{lang mkey='delete_counties'}" onclick="javascript: return checkme();" />&nbsp;&nbsp;
					</td>
				</tr>
			</table>
			</form>
		</div>
	</div>
</div>
{/strip}