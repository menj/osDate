{strip}
<script type="text/javascript" src="{$DOC_ROOT}javascript/cascade_admin.js"></script>
<script type="text/javascript" src="{$DOC_ROOT}javascript/pwd_strength.js"></script>
<script type="text/javascript">
function display_couple_details(fld) {ldelim}
	if (fld.value == 'C' || fld == 'C' || fld.value == 'G' || fld == 'G') {ldelim}
		var ret = '<table border=0 cellspacing=0 cellpadding=0 width="100%"><td valign="top" colspan="2"><b>{lang mkey="couple_usernames_hlp"}<//b><//td><//tr><tr><td height="3"><//td><//tr><tr><td valign="top" width="33.5%">{lang mkey="couple_usernames"}:<font color="{lang mkey='required_info_indicator_color'}">{lang mkey='required_info_indicator'}<//font><//td><td valign="top" width="66.5%"><input class="textinput" type="text"  size="30" name="couple_usernames" value="{$smarty.session.couple_usernames}" /><//td><//tr><//table>';
	{rdelim} else {ldelim}
		var ret = '<input type="hidden" name="couple_usernames" value="" />';
	{rdelim}
	document.getElementById('couple_info').innerHTML = ret;
{rdelim}
</script>
{assign var="page_hdr01_text" value="{lang mkey='modify_profile'}"|cat:"{lang mkey='of'}"|cat:$user.username|cat:' (ID: '|cat:$user.id|cat:')'}
{assign var="page_title" value="{lang mkey='modify_profile'}"}
{include file="admin/admin_page_hdr01.tpl"}
<div class="module_detail_inside">
	<div class="line_outer">
		<table width="100%" border="0" cellpadding="3" cellspacing="1">
			{* Create menu from sections table *}
			{assign var="cn" value=1}
			{foreach key=key item=item from=$sections}
				{if $cn == 1}
					<tr>
				{/if}
				<td align="center" class='edituserlink' height="23">
					{if $key != $sectionid }
						{if $key != 0}
							<a href="editprofilequestions.php?sectionid={$key}&amp;edit={$smarty.get.edit}"  class='edituserlink'>
						{/if}
					{/if}
					{$item}
					{if $key != $sectionid && $key > 0}
						</a>
					{/if}
				</td>
				{assign var="cn" value=$cn+1}
				{if $cn == 6}
					</tr>
					{assign var="cn" value=1}
				{/if}
			{/foreach}
			{if $cn > 1 }
			</tr>
			{/if}
		</table>
		<form name="frmEditUser" id="frmEditUser" method="post" action="modifyprofile.php" >
		<input type="hidden" name="txtuserid" value="{$user.id}" />
		{if $error_message != ""}
			{include file="display_error.tpl"}
		{/if}
		<table   cellspacing="{$config.cellspacing}" cellpadding="{$config.cellpadding}" width="573" border="0">
		<tbody>
			<tr>
				<td colspan="2"><font color="{lang mkey='required_info_indicator_color'}">{lang mkey='required_info_indicator'} </font>{lang mkey='required_info_indication'}</td>
			</tr>
			<tr>
				<td colspan="2" align="center">
					{assign var="page_hdr02_text" value="{lang mkey='signup_subtitle_login'}"}
					{include file="admin/admin_page_hdr02.tpl"}
				</td>
			</tr>
			<tr>
				<td height="2" width="30%">{lang mkey='profile_username'}
					<font class="required_info">{$smarty.const.REQUIRED_INFO}</font>
				</td>
				<td height="2"  width="70%"> <input type="text" class="textinput" value="{$user.username}" name="txtusername" />
				</td>
			</tr>
			<tr>
				<td>{lang mkey='signup_password'}
				<font class="required_info">{$smarty.const.REQUIRED_INFO}</font>
				</td>
				<td> <input type="password" class="textinput" name="txtpassword"  maxlength="{$config.max_pass_len}" size="25"  value="" onkeyup="runPassword(this.value, 'txtnewpwd');" />
				&nbsp;&nbsp;{lang mkey='leave_blank_no_change'}
				</td>
			</tr>
			<tr>
				<td>{lang mkey='signup_confirm_password'}
				<font class="required_info">{$smarty.const.REQUIRED_INFO}</font></td>
				<td> <input  type="password" class="textinput" name="txtpassword2" maxlength="{$config.max_pass_len}" size="25"  value=""/>
				</td>
			</tr>
			<tr>
				<td valign="top">{lang mkey='pwd_strength'}:</td>
				<td width="67%">
					<div style="width:100%;">
						<div id="txtnewpwd_bar" class="password_bar">
						</div>
						<div id="txtnewpwd_text" class="password_text">
						</div>
					</div>
				</td>
			</tr>
			<tr>
				<td >&nbsp;</td>
				<td >&nbsp;</td>
			</tr>
			<tr>
				<td colspan="2">
					{assign var="page_hdr02_text" value="{lang mkey='signup_subtitle_profile'}"}
					{include file="admin/admin_page_hdr02.tpl"}
				</td>
			</tr>
			{if $config.accept_firstname == 'Y' or $config.accept_firstname == '1'}
			<tr>
				<td>{lang mkey='profile_firstname'}
					{if $config.firstname_mandatory == 'Y' or $config.firstname_mandatory == '1'}
						<font class="required_info">{$smarty.const.REQUIRED_INFO}</font>
					{/if}
				</td>
				<td ><input class="textinput" maxlength="50" name="txtfirstname" value='{$user.firstname|stripslashes}' /> </td>
			</tr>
			{/if}
			{if $config.accept_lastname == 'Y' or $config.accept_lastname == '1'}
			<tr>
				<td>{lang mkey='profile_lastname'}
					{if $config.lastname_mandatory == 'Y' or $config.lastname_mandatory == '1'}
						<font class="required_info">{$smarty.const.REQUIRED_INFO}</font>
					{/if}
				</td>
				<td> <input class="textinput" maxlength="50" name="txtlastname" value='{$user.lastname|stripslashes}' /> </td>
			</tr>
			{/if}
			<tr>
				<td>{lang mkey='profile_email'}
					<font class="required_info">{$smarty.const.REQUIRED_INFO}</font></td>
				<td> <input class="textinput" maxlength="255" name="txtemail" size="40" value='{$user.email}' />
				</td>
			</tr>
			<tr>
				<td>{lang mkey='profile_gender'}
					<font class="required_info">{$smarty.const.REQUIRED_INFO}</font></td>
				<td> <select class="select" style="WIDTH: 80px" name="txtgender" onchange="javascript: display_couple_details(this);">
					{html_options options=$lang.signup_gender_values selected=$user.gender}
					</select>&nbsp;
				</td>
			</tr>
			<tr >
				<td colspan="2" id="couple_info"><input type="hidden" name="couple_usernames" value="" /></td>
			</tr>
			<tr>
				<td>{lang mkey='profile_birthday'}
					<font class="required_info">{$smarty.const.REQUIRED_INFO}</font>
				</td>
				<td>
					{html_select_date_translated prefix="txtbirth" start_year=$config.start_year month_value_format="%m" time=$user.birth_date}
				</td>
			</tr>
		{if $config.accept_country == '1' or $config.accept_country == 'Y'}
			<tr >
				<td colspan="2">
					{assign var="page_hdr02_text" value="{lang mkey='signup_subtitle_address'}"}
					{include file="admin/admin_page_hdr02.tpl"}
					{if $config.accept_timezone != 'Y' and $config.accept_timezone != '1'}
						<input type="hidden" name="txttimezone" value="{$user.timezone}" />
					{/if}
				</td>
			</tr>
			{if $config.accept_timezone == 'Y' or $config.accept_timezone == '1'}
			<tr>
				<td>{lang mkey='timezone'}
					{if $config.timezone_mandatory == 'Y' or $config.timezone_mandatory == '1'}
					<font color="{lang mkey='required_info_indicator_color'}">{lang mkey='required_info_indicator'}
					{/if}
					</font>
				</td>
				<td><select class="select" style="WIDTH: 315px" name="txttimezone">
					{html_options options=$lang.tz selected=$user.timezone}
					</select>
				</td>
			</tr>
			{/if}
			<tr>
				<td>{lang mkey='profile_country'}
					{if $config.country_mandatory == 'Y'}
					<font class="required_info">{$smarty.const.REQUIRED_INFO}</font>
					{/if}
				</td>
				<td>
					<select class="select" style="WIDTH: 175px" name="txtfrom" id="txtfrom" 
					{if $config.accept_state == 'Y' or $config.accept_state == '1'}onchange="javascript:  cascadeCountry(this.value);"{elseif $config.accept_county == 'Y' or $config.accept_county == '1'}onchange="javascript:  cascadeState('AA', this.value);"{elseif $config.accept_city =='Y' or $config.accept_city =='1'}onchange="javascript:  cascadeCounty('AA',this.value,'AA');"{elseif $config.accept_zipcode =='Y' or $config.accept_zipcode == '1'} onchange="javascript:  cascadeCity('AA',this.value,'AA','AA');" {/if} ><option value="-1">{lang mkey='select_country'}</option>
					{html_options options=$lang.countries selected=$user.country}
					</select>
					<input type="hidden" name="chgcntry" id="chgcntry" value="" />
					{if $config.accept_state != 'Y' and $config.accept_state != '1'}
						<input type="hidden" name="txtstateprovince" value="{$user.state_province}" />
					{/if}
					{if $config.accept_county != 'Y' and $config.accept_county != '1'}
						<input name="txtcounty" type="hidden" value="{$user.county}" />
					{/if}
					{if $config.accept_city != 'Y' and $config.accept_city != '1'}
						<input name="txtcity" type="hidden" value="{$user.city}" />
					{/if}
					{if $config.accept_zipcode != 'Y' and $config.accept_zipcode != '1'}
						<input name="txtzip" type="hidden" value="{$user.zip}" />
					{/if}
					{if $config.accept_address_line1 != 'Y' and $config.accept_address_line2 != '1'}
						<input name="txtaddress1" type="hidden" value="{$user.address_line1|stripslashes}" />
						<input name="txtaddress2" type="hidden" value="{$user.address_line2|stripslashes}" />
					{/if}
					{if $config.accept_address_line2 != 'Y' and $config.accept_address_line2 != '1'}
						<input name="txtaddress2" type="hidden" value="{$user.address_line2|stripslashes}" />
					{/if}
				</td>
			</tr>
			{if $config.accept_state == 'Y' or $config.accept_state == '1'}
			<tr>
				<td width="172">{lang mkey='signup_state_province'}
				{if $config.state_mandatory == 'Y' }
				<font class="required_info">{$smarty.const.REQUIRED_INFO}</font>
				{/if}
				</td>
				<td width="344" id="txtstateprovince">
				{ if $lang.states|@count > 0}
				<select class="select" style="WIDTH: 175px" name="txtstateprovince" {if $config.accept_county == 'Y' or $config.accept_county == '1'} onchange="javascript:  cascadeState(this.value, this.form.txtfrom.value);"{elseif $config.accept_city =='Y' or $config.accept_city =='1'}onchange="javascript:  cascadeCounty('AA',this.form.txtfrom.value, this.value);"{elseif $config.accept_zipcode =='Y' or $config.accept_zipcode == '1'} onchange="javascript:  cascadeCity('AA', this.form.txtfrom.value, this.value, 'AA');" {/if}><option value="-1">{lang mkey='select_state'}</option>
				{html_options options=$lang.states selected=$user.state_province}
				</select>
				{ else }
				<input name="txtstateprovince" type="text" class="textinput" size="30" maxlength="100" value="{if $user.state_province != 'AA'}{$user.state_province}{/if}" />
				{ /if}
				</td>
			</tr>
			{if $config.accept_county == 'Y' or $config.accept_county == '1'}
			<tr>
				<td width="172">{lang mkey='manage_counties'}:
					{if $config.county_mandatory == 'Y'}
						<font class="required_info">{$smarty.const.REQUIRED_INFO}</font>
					{/if}
				</td>
				<td width="344" id="txtcounty" >
				{ if $lang.counties|@count > 0}
					<select class="select" style="WIDTH: 175px" name="txtcounty" {if $config.accept_city =='Y' or $config.accept_city =='1'} onchange="javascript:  cascadeCounty(this.value,this.form.txtfrom.value, this.form.txtstateprovince.value);"{elseif $config.accept_zipcode =='Y' or $config.accept_zipcode == '1'} onchange="javascript:  cascadeCity('AA', this.form.txtfrom.value, this.form.txtstateprovince.value, this.value);" {/if} ><option value="-1">{lang mkey='select_county'}</option>
						{html_options options=$lang.counties selected=$user.county}
					</select>
				{ else }
					<input name="txtcounty" type="text" class="textinput" size="30" maxlength="100" value="{if $user.county != 'AA'}{$user.county}{/if}" />
				{ /if}
				</td>
			</tr>
			{/if}
			{if $config.accept_city == 'Y' or $config.accept_city == '1'}
			<tr>
				<td>
					{lang mkey='signup_city'}
					{if $config.city_mandatory == 'Y' }
						<font class="required_info">{$smarty.const.REQUIRED_INFO}</font>
					{/if}
				</td>
				<td id="txtcity">
				{ if $lang.cities|@count > 0}
					<select class="select" style="WIDTH: 175px" name="txtcity" {if $config.accept_zipcode =='Y' or $config.accept_zipcode == '1'} {if $config.accept_county =='1' or $config.accept_county =='Y'} onchange="javascript: cascadeCity(this.value, this.form.txtfrom.value, this.form.txtstateprovince.value, this.form.txtcounty.value);"{else}onchange="javascript:  cascadeCity(this.value, this.form.txtfrom.value, this.form.txtstateprovince.value, 'AA');" {/if}{/if}  ><option value="-1">{lang mkey='select_city'}</option>
					{html_options options=$lang.cities selected=$user.city}
					</select>
				{ else }
					<input name="txtcity" type="text" class="textinput" size="30" maxlength="100" value="{if $user.city != 'AA'}{$user.city}{/if}" />
				{ /if}
				</td>
			</tr>
			{/if}
			{if $config.accept_zipcode == 'Y' or $config.accept_zipcode == '1'}
			<tr>
				<td>
					{lang mkey='signup_zip'}
					{if $config.zipcode_mandatory == 'Y' }
						<font class="required_info">{$smarty.const.REQUIRED_INFO}</font>
					{/if}
				</td>
				<td id="txtzip" >
				{ if $lang.zipcodes|@count > 0}
					<select class="select" style="WIDTH: 175px" name="txtzip">
					{html_options options=$lang.zipcodes selected=$user.zip}
					</select>
				{ else }
					<input name="txtzip" type="text" class="textinput" size="30" maxlength="100" value="{if $user.zip != 'AA'}{$user.zip}{/if}" />
				{ /if}
				</td>
			</tr>
			{/if}
			{if $config.accept_address_line1 == 'Y' or $config.accept_address_line1 == '1'}
			<tr>
				<td>{lang mkey='profile_address1'}</td>
				<td> <input class="textinput" maxlength="255" name="txtaddress1" size="40" value="{$user.address_line1|stripslashes}" />
				</td>
			</tr>
			{if $config.accept_address_line2 == 'Y' or $config.accept_address_line2 == '1'}
			<tr>
				<td height="22">{lang mkey='profile_address2'}</td>
				<td height="22"> <input class="textinput" maxlength="255" name="txtaddress2" size="40" value="{$user.address_line2|stripslashes}" />
				</td>
			</tr>
			{/if}
			{/if}
			{/if}
		{/if}
		{if $config.accept_about_me == '1' or $config.accept_about_me == 'Y' }
			<tr><td height="4"></td></tr>
			<tr>
				<td valign="top">
					<b>{lang mkey='about_me'}:</b>{if $config.about_me_mandatory == 'Y'}
					<font class="required_info">{$smarty.const.REQUIRED_INFO}</font>
					{/if}
					<br />{lang mkey='about_me_hlp'}
				</td>
				<td valign="top" >
					<textarea class="textinput" name="about_me" cols="45" rows="6">
					{$user.about_me}
					</textarea>
				</td>
			</tr>
			<tr><td height="4"></td></tr>
		{/if}

			<tr >
				<td colspan="2">
					{assign var="page_hdr02_text" value="{lang mkey='upgrade_membership'}"}
					{include file="admin/admin_page_hdr02.tpl"}
				</td>
			</tr>
			<tr>
				<td>{lang mkey='current_mship_level'}</td>
				<td><select class="select" style="WIDTH: 175px" name="txtmship">
					{html_options options=$mships selected=$user.level}
				</select> </td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td><input type="submit" class="formbutton" value='{lang mkey='submit'}' /> <input type="reset" class="formbutton" value='{lang mkey='reset'}' />
		{if $config.accept_country != 'Y' and $config.accept_country != '1'}
			<input type="hidden" name="txttimezone" value="{$user.timezone}" />
			<input type="hidden" name="txtfrom" value="{$user.country}" />
			<input type="hidden" name="txtstateprovince" value="{$user.state_province}" />
			<input name="txtcounty" type="hidden" value="{$user.county}" />
			<input name="txtcity" type="hidden" value="{$user.city}" />
			<input name="txtzip" type="hidden" value="{$user.zip}" />
			<input name="txtaddress1" type="hidden" value="{$user.address_line1|stripslashes}" />
			<input name="txtaddress2" type="hidden" value="{$user.address_line2|stripslashes}" />
		{/if}
				</td>
			</tr>
		</tbody>
		</table>
		</form>
	</div>
</div>
<script type="text/javascript">
display_couple_details("{$user.gender}");
</script>
{/strip}