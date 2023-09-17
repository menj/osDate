{strip}
{assign var="page_hdr01_text" value="{lang mkey='featured_profiles_hdr'}"}
{assign var="page_title" value="{lang mkey='featured_profiles_hdr'}"}
{include file="admin/admin_page_hdr01.tpl"}
<div class="top_margin_6px">
{ if $req_action eq 'modify' }
	{assign var="page_hdr02_text" value="{lang mkey='mod_featured'}"}
{ else }
	{assign var="page_hdr02_text" value="{lang mkey='add_featured'}"}
{/if}
	{include file="admin/admin_page_hdr02.tpl"}
	<div class="module_detail_inside" style="padding-top:1px; text-align:left;">
	{if $error_msg ne ''}
		{assign var="error_message" value="{lang mkey='errormsgs' skey=$error_msg}" }
		{include file="display_error.tpl"}
	{/if}
		<div class="line_outer">
			<form name="add_featured" action="featured_profile.php" method="post" onsubmit="javascript: return datefromtovalid( this.elements['startYear'], this.elements['startMonth'], this.elements['startDay'], this.elements['endYear'], this.elements['endMonth'], this.elements['endDay'], '{lang mkey='errormsgs' skey=51}' );">
			<input type="hidden" name="userid" value="{$data.userid}" />
			<input type="hidden" name="id" value="{$data.id}" />
			<input type="hidden" name="step" value="{$data.step}" />
			<input type="hidden" name="req_action" value="{$req_action}" />
			<input type="hidden" name="bckurl" value="{$data.bckurl}" />
				<table width="100%" cellspacing="{$config.cellspacing}" cellpadding="{$config.cellpadding}" border="0">
					<tr>
						<td width="25%">{lang mkey='profile_username'}</td>
						<td width="75%"><input type="text" class="textinput"  name="username" value="{$data.username}" onchange="javascript:this.form.elements['step'].value=1; this.form.submit();" />
						{if $data.fullname ne ""}
							&nbsp;({$data.fullname|stripslashes})
						{/if}
						</td>
					</tr>
					<tr>
						<td>{lang mkey='startdate'}</td>
						<td>
							{html_select_date_translated prefix="start"  month_value_format="%m" time=$data.start_date|date_format end_year="+5" }
						</td>
					</tr>
					<tr>
						<td>{lang mkey='enddate'}</td>
						<td id="enddate_col">
							{html_select_date_translated prefix="end"  month_value_format="%m" time=	$data.end_date|date_format end_year="+5"}
						</td>
					</tr>
					<tr>
						<td>{lang mkey='must_show'}: </td>
						<td>
							<input name="must_show" type="radio" value='1' {if $data.must_show eq '1'}	checked="checked"{/if} />Yes&nbsp;&nbsp;
							<input name="must_show" type="radio" value='0' {if $data.must_show ne '1'}checked="checked"{/if} />No
						</td>
					</tr>
					<tr><td colspan="2">{lang mkey='featured_profiles_msg01'}</td></tr>
					<tr><td height="3"></td></tr>
					<tr>
						<td>{lang mkey='reqd_exposures'}:</td>
						<td>
							<input type="text" class="textinput"  name="req_exposures" value="{ if $data.req_exposures > 0}{$data.req_exposures}{else}999999999{/if}" />
						</td>
					</tr>
					<tr><td colspan="2">{lang mkey='featured_profiles_msg02'}</td></tr>
					<tr><td height="3"></td></tr>
					<tr>
						<td>&nbsp;</td>
						<td>
							<input type="submit" class="formbutton" value="{lang mkey='submit'}" />&nbsp;
							<input type="reset" class="formbutton" value="{lang mkey='reset'}" />&nbsp;
							<input type="submit" name="cancelthis"  class="formbutton" value="{lang mkey='cancel'}" />
						</td>
					</tr>
				</table>
			</form>
		</div>
	</div>
</div>
{/strip}