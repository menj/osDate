{strip}
<script type="text/javascript" src="javascript/cascade.js"></script>
<script type="text/javascript">
/* <![CDATA[ */
function validate(form)
{ldelim}
	var tz=form.txttimezone.value;
	ErrorCount=0;
	ErrorMsg = new Array();
	ErrorMsg[0]="";
	CheckFieldString("noblank",form.txtemail,"{lang mkey='signup_js_errors' skey='email_noblank'}");
	CheckFieldString("email",form.txtemail,"{lang mkey='signup_js_errors' skey='email_notvalid'}");
	{ if $config.accept_firstname == 'Y' || $config.accept_firstname == '1' }
		{if $config.firstname_mandatory == "Y"}
			CheckFieldString("noblank",form.txtfirstname,"{lang mkey='signup_js_errors' skey='firstname_noblank'}");
		{/if}
		CheckFieldString("text",form.txtfirstname,"{lang mkey='signup_js_errors' skey='firstname_charset'}");
	{/if}
	{ if $config.accept_lastname == 'Y' || $config.accept_lastname == '1' }
		{if $config.lastname_mandatory == "Y"}
			CheckFieldString("noblank",form.txtlastname,"{lang mkey='signup_js_errors' skey='lastname_noblank'}");
		{/if}
		CheckFieldString("text",form.txtlastname,"{lang mkey='signup_js_errors' skey='lastname_charset'}");
	{/if}
	/*address*/
	{ if $config.accept_about_me == 'Y' || $config.accept_about_me == '1' }
		{if $config.about_me_mandatory == 'Y'}
			CheckFieldString("noblank",form.about_me,"{lang mkey='signup_js_errors' skey='about_me_noblank'}");
		{/if}
	{/if}
	{ if ($config.accept_country == 'Y' || $config.accept_country == '1') }
		{if $config.country_mandatory == 'Y'}
			CheckFieldString("noblank",form.txtfrom,"{lang mkey='signup_js_errors' skey='country_noblank'}");
		{/if}
		{ if ($config.accept_state == 'Y' || $config.accept_state == '1') && $config.state_mandatory eq 'Y' }
			CheckFieldString("noblank",form.txtstateprovince,"{lang mkey='signup_js_errors' skey='stateprovince_noblank'}");
			{ if ($config.accept_county == 'Y' || $config.accept_county == '1') }
				{if $config.county_mandatory eq 'Y' }
				CheckFieldString("noblank",form.txtcounty,"{lang mkey='signup_js_errors' skey='county_noblank'}");
				{/if}
				CheckFieldString("alphanumeric",form.txtcounty,"{lang mkey='signup_js_errors' skey='county_charset'}");
			{/if}
			{ if ($config.accept_city == 'Y' || $config.accept_city == '1') }
				{if $config.city_mandatory eq 'Y' }
				CheckFieldString("noblank",form.txtcity,"{lang mkey='signup_js_errors' skey='city_noblank'}");
				{/if}
				CheckFieldString("alphanumeric",form.txtcity,"{lang mkey='signup_js_errors' skey='city_charset'}");
			{/if}
			{ if ($config.accept_zipcode == 'Y' || $config.accept_zipcode == '1')}
				{if $config.zipcode_mandatory eq 'Y' }
				CheckFieldString("noblank",form.txtzip,"{lang mkey='signup_js_errors' skey='zip_noblank'}");
				{/if}
				CheckFieldString("alphanumeric",form.txtzip,"{lang mkey='signup_js_errors' skey='zip_charset'}");
			{/if}
		{/if}
	{/if}

	/*preferences */
	{if $config.accept_lookcountry == '1' || $config.accept_lookcountry == 'Y'}
		CheckFieldString("text",form.txtlookcity,"{lang mkey='signup_js_errors' skey='address_charset'}");
		CheckFieldString("alphanumeric",form.txtlookzip,"{lang mkey='signup_js_errors' skey='address_charset'}");
	{/if}

	result="";
	if (tz == '-25' && ($config.accept_timezone == 'Y' || $config.accept_timezone == '1') ) {ldelim}
		ErrorMsg[ErrorCount]+="{lang mkey='signup_js_errors' skey='timezone_noblank'}";
		ErrorCount++;
	{rdelim}
	if( ErrorCount > 0)
	{ldelim}
		result = "---- Following errors occured -----"+ String.fromCharCode(10)+ String.fromCharCode(13);
		for( c in ErrorMsg)
			result += ErrorMsg[c]+ String.fromCharCode(10)+ String.fromCharCode(13);
		alert(result);
		return false;
	{rdelim}
	return true;
{rdelim}
/* ]]> */
function display_couple_details(fld) {ldelim}
	if (fld.value == 'C' || fld == 'C' || fld.value == 'G' || fld == 'G') {ldelim}
		var ret = '<table border=0 cellspacing=0 cellpadding=0 width="100%"><td valign="top" colspan="2"><b>{lang mkey="couple_usernames_hlp"}<//b><//td><//tr><tr><td height="3"><//td><//tr><tr><td valign="top" width="33.5%">{lang mkey="couple_usernames"}:<font color="{lang mkey='required_info_indicator_color'}">{lang mkey='required_info_indicator'}<//font><//td><td valign="top" width="66.5%"><input  type="text" class="textinput" size="30" name="couple_usernames" value="{$smarty.session.couple_usernames}" /><//td><//tr><//table>';
	{rdelim} else {ldelim}
		var ret = '<input type="hidden" name="couple_usernames" value="" />';
	{rdelim}
	document.getElementById('couple_info').innerHTML = ret;
{rdelim}
</script>

<div style="vertical-align:top;" >
	{assign var="page_hdr01_text" value="{lang mkey='section_signup_title'}"}
	{assign var="page_title" value="{lang mkey='section_signup_title'}"}
	{include file="page_hdr01.tpl"}
	<div class="module_detail_inside">
		{if $modify_error neq ""}
			{assign var="error_message" value=$modify_error}
			{include file="display_error.tpl"}
		{elseif $smarty.session.profmodified == 'Y'}
			{assign var="error_message" value="{lang mkey='profile_modified_now'}"}
			{include file="display_error.tpl"}
		{/if}
		<form name="frmEditUser" method="post" action="modifyuser.php" onsubmit="javascript: if(this.chgcntry != '1')return validate(this);">
		<input type="hidden" name="txtuserid" value="{$user.id}"/>
		<input type="hidden" name="txtusername" value="{$user.username}"/>

{*		<div class="line_outer">
			<table width="100%" border="0" cellpadding="3" cellspacing="1" >
				<tr>
		{assign var="cn" value=1}
				{foreach key=key item=item from=$sections}
					<td align="center" class='edituserlink' height="23">
						{if $key != $sectionid && $key > 0}
							<a href="editquestions.php?sectionid={$key}" class='edituserlink'>
						{/if}
						{$item}
						{if $key != $sectionid && $key > 0}
							</a>
						{/if}
					</td>
					{assign var="cn" value=$cn+1}
					{if $cn == 6}
						</tr>
						<tr>
						{assign var="cn" value=1}
					{/if}
				{/foreach}
				</tr>
			</table>
		</div>  *}
		<div class="line_outer">
			<div style="padding-top: 10px; padding-bottom: 10px;">
				<font class="required_info">{$smarty.const.REQUIRED_INFO}</font> {lang mkey='required_info_indication'}
				<br />
			</div>
			{assign var="page_hdr02_text" value="{lang mkey='signup_subtitle_profile'}"}
			{include file="page_hdr02.tpl"}
			<div class="module_detail_inside">
				<div style="padding-left: 4px;">
				<table width="100%" border="0" cellspacing="{$config.cellspacing}" cellpadding="{$config.cellpadding}">
				{if $config.accept_firstname == 'Y' or $config.accept_firstname == '1'}
					<tr>
						<td width="33%">{lang mkey='signup_firstname'}
						{if $config.firstname_mandatory == 'Y' or $config.firstname_mandatory == '1'}
							<font class="required_info">{$smarty.const.REQUIRED_INFO}</font>
						{/if}
						</td>
						<td height="67%"> <input class="textinput" maxlength="50" name="txtfirstname" value="{$user.firstname|stripslashes}"/> </td>
					</tr>
				{/if}
				{if $config.accept_lastname == 'Y' or $config.accept_lastname == '1'}
					<tr>
						<td>{lang mkey='signup_lastname'}
						{if $config.lastname_mandatory == 'Y' or $config.lastname_mandatory == '1'}
							<font class="required_info">{$smarty.const.REQUIRED_INFO}</font>
						{/if}
						</td>
						<td> <input class="textinput" maxlength="50" name="txtlastname" value="{$user.lastname|stripslashes}"/> </td>
					</tr>
				{/if}
					<tr>
						<td>{lang mkey='signup_email'}
						<font class="required_info">{$smarty.const.REQUIRED_INFO}</font></td>
						<td> <input class="textinput" maxlength="255" name="txtemail" size="40" value='{$user.email}'/>
						</td>
					</tr>
					<tr>
						<td>{lang mkey='signup_gender'}:
						<font class="required_info">{$smarty.const.REQUIRED_INFO}</font></td>
						<td> <select class="select" style="width: 80px;" name="txtgender" onchange="javascript: display_couple_details(this);">
						{html_options options=$lang.signup_gender_values selected=$user.gender}
						</select>
						{if $config.accept_lookgender == 'Y' or $config.accept_lookgender == '1'}
						&nbsp;{lang mkey='looking_for_a'}:&nbsp;
							<select class="select" style="width: 105px" name="txtlookgender" >
							{html_options options=$lang.signup_gender_look selected=$user.lookgender}
							</select>
						{else}
							<input type="hidden" value="{$user.lookgender}" name="txtlookgender" />
						{/if}
						</td>
					</tr>
					<tr ><td colspan="2" id="couple_info">
						<input type="hidden" name="couple_usernames" value="" />
						</td>
					</tr>
					{if $config.accept_lookage == 'Y' or $config.accept_lookage == '1'}
					<tr>
						<td>{lang mkey='signup_pref_age_range'}:
						<font class="required_info">{$smarty.const.REQUIRED_INFO}</font></td>
						<td> <select class="select" style="width: 50px;" name="txtlookagestart">
						{html_options values=$lang.start_agerange output=$lang.start_agerange selected=$user.lookagestart}
						</select>{lang mkey='to'}<select class="select" style="width: 50px;" name="txtlookageend" >
						{html_options values=$lang.end_agerange output=$lang.end_agerange selected=$user.lookageend}
						</select>
						&nbsp;{lang mkey='signup_year_old'}.
						</td>
					</tr>
					{/if}
					<tr>
						<td>{lang mkey='signup_birthday'}
						<font class="required_info">{$smarty.const.REQUIRED_INFO}</font></td>
						<td>
						{html_select_date_translated prefix="txtbirth" start_year=$config.start_year  end_year=$config.end_year month_value_format="%m" time=$user.birth_date}
						</td>
					</tr>
				</table>
				</div>
			</div>
			{if $config.accept_lookage != 'Y' and $config.accept_lookage != '1'}
				<input type="hidden" name="txtlookagestart" value="{$user.lookagestart}" />
				<input type="hidden" name="txtlookageend" value="{$user.lookageend}" />
			{/if}
			{if $config.accept_country != '1' and $config.accept_country != 'Y'}
				<input type="hidden" name="txttimezone" value="{$user.timezone}" />
				<input type="hidden" name="txtfrom" value="{$user.country}" />
				<input name="txtstateprovince" type="hidden" value="{$user.state_province|stripslashes}"/>
				<input name="txtcounty" type="hidden" value="{$user.county|stripslashes}"/>
				<input name="txtcity" type="hidden" value="{$user.city|stripslashes}"/>
				<input name="txtzip" type="hidden"  value="{$user.zip|stripslashes}"/>
				<input name="txtaddress1"  type="hidden" value="{$user.address_line1|stripslashes}"/>
				<input type="hidden" name="txtaddress2" value="{$user.address_line2|stripslashes}"/>
			{/if}
			<br />
		{if $config.accept_country == '1' or $config.accept_country == 'Y'}
			{if $config.accept_timezone != '1' and $config.accept_timezone != 'Y'}
				<input type="hidden" name="txttimezone" value="{$user.timezone}" />
			{/if}
			{assign var="page_hdr02_text" value="{lang mkey='signup_subtitle_address'}"}
			{include file="page_hdr02.tpl"}
			<div class="module_detail_inside">
				<div style="padding-left: 4px;">
				<table width="100%" border="0" cellspacing="{$config.cellspacing}" cellpadding="{$config.cellpadding}">
				{if $config.accept_timezone == '1' or $config.accept_timezone == 'Y'}
					<tr>
						<td width="33%">{lang mkey='timezone'}
						{if $config.timezone_mandatory == 'Y' or $config.timezone_mandatory == '1'}
						<font color="{lang mkey='required_info_indicator_color'}">{lang mkey='required_info_indicator'}
						{/if}
						</font>
						</td>
						<td width="67%"> <select class="select" style="width: 315px" name="txttimezone" >
						{html_options options=$lang.tz selected=$user.timezone}
						</select>
						</td>
					</tr>
				{/if}
				{if $config.accept_country == '1' or $config.accept_country == 'Y'}
					<tr>
						<td width="33%">{lang mkey='signup_country'}															{if $config.country_mandatory == 'Y'}
						<font class="required_info">{$smarty.const.REQUIRED_INFO}</font>
						{/if}
						</td>
						<td width="67%">
						<select class="select" style="width: 175px;" name="txtfrom" 
						{if $config.accept_state == 'Y' or $config.accept_state == '1'}
							onchange="javascript:  cascadeCountry(this.value);"
						{elseif $config.accept_county == 'Y' or $config.accept_county == '1'}
							onchange="javascript:  cascadeState('AA',this.value);" 
						{elseif $config.accept_city == 'Y' or $config.accept_city == '1'}
							onchange="javascript:  cascadeCounty('AA',this.value,'AA');"
						{elseif $config.accept_zipcode == 'Y' or $config.accept_zipcode == '1'}
							onchange="javascript:  cascadeCity('AA', this.value, 'AA', 'AA');"
						{/if} 
						>
						<option value="">{lang mkey='select_country'}</option>
						{html_options options=$lang.countries selected=$user.country}
						</select>
						<input type="hidden" name="chgcntry" id="chgcntry" value=""/>
						{if $config.accept_state != '1' and $config.accept_state != 'Y'}
							<input name="txtstateprovince" type="hidden" value="{$user.state_province|stripslashes}"/>
						{/if}
						{if $config.accept_county != '1' and $config.accept_county != 'Y'}
							<input name="txtcounty" type="hidden" value="{$user.county|stripslashes}"/>
						{/if}
						{if $config.accept_city != '1' and $config.accept_city != 'Y'}
							<input name="txtcity" type="hidden" value="{$user.city|stripslashes}"/>
						{/if}
						{if $config.accept_zipcode != '1' and $config.accept_zipcode != 'Y'}
							<input name="txtzip" type="hidden"  value="{$user.zip|stripslashes}"/>
						{/if}
						{if $config.accept_address_line1 != '1' and $config.accept_address_line1 != 'Y'}
							<input name="txtaddress1"  type="hidden" value="{$user.address_line1|stripslashes}"/><input type="hidden" name="txtaddress2" value="{$user.address_line2|stripslashes}"/>
						{/if}
						{if $config.accept_address_line2 != '1' and $config.accept_address_line2 != 'Y'}
							<input type="hidden" name="txtaddress2" value="{$user.address_line2|stripslashes}"/>
						{/if}
						</td>
					</tr>
					{if $config.accept_state == '1' or $config.accept_state == 'Y'}
					<tr>
						<td width="172">{lang mkey='signup_state_province'}
						{if $config.state_mandatory == 'Y'}
						<font class="required_info">{$smarty.const.REQUIRED_INFO}</font>
						{/if}
						</td>
						<td width="344" id="txtstateprovince">
						{ if $lang.states|@count > 0}
							<select class="select" style="width: 175px" name="txtstateprovince" {if $config.accept_county == 'Y' or $config.accept_county == '1'}onchange="javascript:  cascadeState(this.value, this.form.txtfrom.value);" {elseif $config.accept_city == 'Y' or $config.accept_city == '1'}onchange="javascript:  cascadeCounty('AA',this.form.txtfrom.value, this.value);"{elseif $config.accept_zipcode == 'Y' or $config.accept_zipcode == '1'}onchange="javascript:  cascadeCity('AA', this.form.txtfrom.value, this.value, 'AA');"{/if}  ><option value="">{lang mkey='select_state'}</option>
							{html_options options=$lang.states selected=$user.state_province}
							</select>
						{ else }
							<input name="txtstateprovince" type="text" class="textinput" size="30" maxlength="100" value="{$user.state_province|stripslashes}"/>
						{ /if}
						</td>
					</tr>
					{/if}
					{if $config.accept_county == '1' or $config.accept_county == 'Y'}
					<tr>
						<td width="172">{lang mkey='manage_counties'}:
						{if $config.county_mandatory == 'Y'}
						<font class="required_info">{$smarty.const.REQUIRED_INFO}</font>
						{/if}
						</td>
						<td width="344" id="txtcounty">
						{ if $lang.counties|@count > 0}
							<select class="select" style="width: 175px" name="txtcounty" {if $config.accept_city == 'Y' or $config.accept_city == '1'}onchange="javascript:  cascadeCounty(this.value,this.form.txtfrom.value, this.form.txtstateprovince.value);"{elseif $config.accept_zipcode == 'Y' or $config.accept_zipcode == '1'}onchange="javascript:  cascadeCity('AA', this.form.txtfrom.value, this.form.txtstateprovince.value, this.value);"{/if} ><option value="">{lang mkey='select_county'}</option>
							{html_options options=$lang.counties selected=$user.county}
							</select>
						{ else }
							<input name="txtcounty" type="text" class="textinput" size="30" maxlength="100" value="{$user.county|stripslashes}"/>
						{ /if}
						</td>
					</tr>
					{/if}
					{if $config.accept_city == '1' or $config.accept_city == 'Y'}
					<tr>
						<td>
							{lang mkey='signup_city'}
							{if $config.city_mandatory == 'Y' }
							<font class="required_info">{$smarty.const.REQUIRED_INFO}</font>
							{/if}
						</td>
						<td id="txtcity">
						{ if $lang.cities|@count > 0}
							<select class="select" style="width: 175px" name="txtcity" {if $config.accept_zipcode == 'Y' or $config.accept_zipcode == '1'}{if $config.accept_county =='1' or $config.accept_county =='Y'}onchange="javascript:  cascadeCity(this.value, this.form.txtfrom.value, this.form.txtstateprovince.value, this.form.txtcounty.value);"{else}onchange="javascript:  cascadeCity(this.value, this.form.txtfrom.value, this.form.txtstateprovince.value, 'AA');"{/if}{/if}><option value="">{lang mkey='select_city'}</option>
							{html_options options=$lang.cities selected=$user.city}
							</select>
						{ else }
							<input name="txtcity" type="text" class="textinput" size="30" maxlength="100" value="{$user.city|stripslashes}"/>
						{ /if}
						</td>
					</tr>
					{/if}
					{if $config.accept_zipcode == '1' or $config.accept_zipcode == 'Y'}
					<tr>
						<td>
							{lang mkey='signup_zip'}
							{if $config.zipcode_mandatory == 'Y' }
							<font class="required_info">{$smarty.const.REQUIRED_INFO}</font>
							{/if}
						</td>
						<td id="txtzip">
						{ if $lang.zipcodes|@count > 0}
							<select class="select" style="width: 175px" name="txtzip">
							{html_options options=$lang.zipcodes selected=$user.zip}
							</select>
						{ else }
							<input name="txtzip" type="text" class="textinput" size="30" maxlength="100" value="{$user.zip|stripslashes}"/>
						{ /if}
						</td>
					</tr>
					{/if}
					{if $config.accept_address_line1 == '1' or $config.accept_address_line1 == 'Y'}
					<tr>
						<td>{lang mkey='signup_address1'}</td>
						<td> <input class="textinput" maxlength="255" name="txtaddress1" size="40" value="{$user.address_line1|stripslashes}"/>
						{if $config.accept_address_line1 != '1' and $config.accept_address_line1 != 'Y'}
							<input name="txtaddress2" type="hidden" value="{$user.address_line2|stripslashes}" />
						{/if}
						</td>
					</tr>
					{if $config.accept_address_line2 == '1' or $config.accept_address_line2 == 'Y'}
					<tr>
						<td height="22">{lang mkey='signup_address2'}</td>
						<td height="22"> <input class="textinput" maxlength="255" name="txtaddress2" size="40" value="{$user.address_line2|stripslashes}"/>
						</td>
					</tr>
					{/if}
					{/if}
				{/if}
				</table>
				</div>
			</div>
			<br />
		{/if}
		{if $config.accept_lookcountry != 'Y' and $config.accept_lookcountry != '1'}
			<input type="hidden" name="txtlookfrom" value="{$user.lookcountry}" />
			<input name="txtlookstateprovince" type="hidden" value="{$user.lookstate_province|stripslashes}" />
			<input name="txtlookcounty" type="hidden" value="{$user.lookcounty|stripslashes}"/>
			<input name="txtlookcity" type="hidden" value="{$user.lookcity|stripslashes}"/>
			<input name="txtlookzip" type="hidden" value="{$user.lookzip|stripslashes}"/>
		{/if}
		{if $config.accept_allow_viewonline != 'Y' and $config.accept_allow_viewonline != '1' }
			<input type="hidden" name="txtviewonline" value="{$user.allow_viewonline}" />
		{/if}
		{if $config.accept_lookcountry == '1' or $config.accept_lookcountry == 'Y' or $config.accept_allow_viewonline == '1' or $config.accept_allow_viewonline == 'Y'}
			{if ( $config.accept_lookcountry == '1' or $config.accept_lookcountry == 'Y') and ($config.accept_country == '1' or $config.accept_country == 'Y' )}
				{assign var="page_hdr02_text" value="{lang mkey='signup_subtitle_preference'}"}
				{include file="page_hdr02.tpl"}
				<div class="module_detail_inside">
				<div style="padding-left: 4px;">
				<table width="100%" border="0" cellspacing="{$config.cellspacing}" cellpadding="{$config.cellpadding}">
					<tr>
						<td colspan="2"><b>{lang mkey='signup_where_should_we_look'}</b></td>
					</tr>
					<tr>
						<td width="33%">{lang mkey='signup_country'}
						{if $config.lookcountry_mandatory == 'Y'}
							<font class="required_info">{$smarty.const.REQUIRED_INFO}</font>
						{/if}
						</td>
						<td width="67%">
							<select class="select" style="width: 175px;" name="txtlookfrom"  {if ($config.accept_state == 'Y' or $config.accept_state == '1') and ($config.accept_lookstate == 'Y' or $config.accept_lookstate == '1') } onchange="javascript: cascadeCountryL(this.value);"{elseif ($config.accept_county == 'Y' or $config.accept_county == '1') and ($config.accept_lookcounty == 'Y' or $config.accept_lookcounty == '1') } onchange="javascript: cascadeStateL('AA',this.value);"{elseif ($config.accept_city == 'Y' or $config.accept_city == '1') and ($config.accept_lookcity == 'Y' or $config.accept_lookcity == '1') } onchange="javascript: cascadeCountyL('AA', this.value, 'AA');"{elseif ($config.accept_zipcode == 'Y' or $config.accept_zipcode == '1') and ($config.accept_lookzipcode == 'Y' or $config.accept_lookzipcode == '1') } onchange="javascript: cascadeCityL('AA',this.value,'AA','AA');"{/if} >
							{html_options options=$lang.allcountries selected=$user.lookcountry}
							</select>
						{if $config.accept_state != '1' and $config.accept_state != 'Y' and $config.accept_lookstate != '1' and $config.accept_lookstate != 'Y'}
							<input name="txtlookstateprovince" type="hidden" value="{$user.lookstate_province|stripslashes}"/>
						{/if}
						{if $config.accept_county != '1' and $config.accept_county != 'Y' and $config.accept_lookcounty != '1' and $config.accept_lookcounty != 'Y'}
							<input name="txtlookcounty" type="hidden" value="{$user.lookcounty|stripslashes}"/>
						{/if}
						{if $config.accept_city != '1' and $config.accept_city != 'Y' and $config.accept_lookcity != '1' and $config.accept_lookcity != 'Y'}
							<input name="txtlookcity" type="hidden" value="{$user.lookcity|stripslashes}"/>
						{/if}
						{if $config.accept_zipcode != '1' and $config.accept_zipcode != 'Y' and $config.accept_lookzipcode != '1' and $config.accept_lookzipcode != 'Y'}
							<input name="txtlookzip" type="hidden"  value="{$user.lookzip|stripslashes}"/>
						{/if}
						</td>
					</tr>
				{if ($config.accept_state == '1' or $config.accept_state == 'Y' ) and ($config.accept_lookstate == '1' or $config.accept_lookstate == 'Y' )}
					<tr>
						<td width="172">{lang mkey='signup_state_province'}</td>
						<td width="344" id="txtlookstateprovince">
						{ if $lang.lookstates|@count > 0 }
							<select class="select" style="width: 175px" name="txtlookstateprovince" {if ($config.accept_county == 'Y' or $config.accept_county == '1') and ($config.accept_lookcounty == 'Y' or $config.accept_lookcounty == '1') } onchange="javascript: cascadeStateL(this.value,this.form.txtlookfrom.value);"{elseif ($config.accept_city == 'Y' or $config.accept_city == '1') and ($config.accept_lookcity == 'Y' or $config.accept_lookcity == '1') } onchange="javascript: cascadeCountyL('AA', this.form.txtlookfrom.value, this.value);"{elseif ($config.accept_zipcode == 'Y' or $config.accept_zipcode == '1') and ($config.accept_lookzipcode == 'Y' or $config.accept_lookzipcode == '1') } onchange="javascript: cascadeCityL('AA',this.form.txtlookfrom.value,this.value,'AA');"{/if} >
							{html_options options=$lang.lookstates selected=$user.lookstate_province}
							</select>
						{else}
							<input name="txtlookstateprovince" value="{if $user.lookstate_province != 'AA'}{$user.lookstate_province|stripslashes}{/if}" size="30" maxlength="200" class="textinput"/>
						{/if}
						</td>
					</tr>
				{/if}
				{if ($config.accept_lookcounty == '1' or $config.accept_lookcounty == 'Y') and ($config.accept_county == '1' or $config.accept_county == 'Y') }
					<tr>
						<td width="172">{lang mkey='manage_counties'}:</td>
						<td width="344" id="txtlookcounty">
						{ if $lang.lookcounties|@count > 0}
							<select class="select" style="width: 175px" name="txtlookcounty"  {if ($config.accept_city == 'Y' or $config.accept_city == '1') and ($config.accept_lookcity == 'Y' or $config.accept_lookcity == '1') } onchange="javascript: cascadeCountyL(this.value, this.form.txtlookfrom.value, this.form.txtform.txtlookstateprovince.value);"{elseif ($config.accept_zipcode == 'Y' or $config.accept_zipcode == '1') and ($config.accept_lookzipcode == 'Y' or $config.accept_lookzipcode == '1') } onchange="javascript: cascadeCityL('AA',this.form.txtlookfrom.value, this.form.txtlookstateprovince.value, this.value);"{/if} >
							{html_options options=$lang.lookcounties selected=$user.lookcounty}
							</select>
						{ else }
							<input name="txtlookcounty" type="text" class="textinput" size="30" maxlength="100" value="{if $user.lookcounty != 'AA'}{$user.lookcounty|stripslashes}{/if}"/>
						{ /if}
						</td>
					</tr>
				{/if}
				{if ($config.accept_lookcity == '1' or $config.accept_lookcity == 'Y') and ($config.accept_city == '1' or $config.accept_city == 'Y') }
					<tr>
						<td >
							{lang mkey='signup_city'}
						</td>
						<td id="txtlookcity">
					{ if $lang.lookcities|@count > 0}
						<select class="select" style="width: 175px" name="txtlookcity" {if ($config.accept_zipcode == 'Y' or $config.accept_zipcode == '1') and ($config.accept_lookzipcode == 'Y' or $config.accept_lookzipcode == '1') }
						{if ($config.accept_county == '1' or $config.accept_county =='Y') and ( $config.accept_lookcounty =='1' or $config.accept_lookcounty =='Y')  } onchange="javascript: cascadeCityL(this.value, this.form.txtlookfrom.value, this.form.txtlookstateprovince.value, this.form.txtlookcounty.value);"{else}
						onchange="javascript: cascadeCityL(this.value, this.form.txtlookfrom.value, this.form.txtlookstateprovince.value, 'AA');"{/if}{/if} >
						{html_options options=$lang.lookcities selected=$user.lookcity}
						</select>
					{ else }
						<input name="txtlookcity" type="text" class="textinput" size="30" maxlength="100" value="{if $user.lookcity != 'AA'}{$user.lookcity|stripslashes}{/if}"/>
					{ /if}
						</td>
					</tr>
				{/if}
				{if ($config.accept_lookzipcode == '1' or $config.accept_lookzipcode == 'Y') and ($config.accept_zipcode == '1' or $config.accept_zipcode == 'Y') }
					<tr>
						<td>
							{lang mkey='signup_zip'}
						</td>
						<td id="txtlookzip">
					{ if $lang.lookzipcodes|@count > 0}
						<select class="select" style="width: 175px" name="txtlookzip">
						{html_options options=$lang.lookzipcodes selected=$user.lookzip}
						</select>
					{ else }
						<input name="txtlookzip" type="text" class="textinput" size="30" maxlength="100" value="{if $user.lookzip != 'AA'}{$user.lookzip|stripslashes}{/if}"/>
					{ /if}
						</td>
					</tr>
		{* Zip code *}
					<tr>
						<td colspan="2" id="zipsavailable">
					{ if $zipsavailable > 0 }
					<table border="0" cellspacing="{$config.cellspacing}" cellpadding="{$config.cellpadding}"  width="100%">
					<tr >
						<td width="33%">
							{lang mkey='search_within'}:
						</td>
						<td width="67%" valign="top">
						<table width="100%" cellpadding="0" border="0" cellspacing="0">
						<tr>
						<td valign="middle" width="15" style="padding-left:2px;">
						<input name="lookradius" value="{$user.lookradius}" type=text class="textinput" size="5" maxlength="10" />
						</td>
						<td valign="middle" width="7">
						<input type=radio name="radiustype" value="miles" {if $radiustype == 'miles'} checked{/if} />
						</td>
						<td width="15" valign="middle">
						{lang mkey='miles'}
						</td>
						<td width="7" valign="middle"><input type=radio name="radiustype" value="kms" {if $radiustype == 'kms'} checked{/if} />
						</td>
						<td valign="middle" width="20">{lang mkey='kms'}</td>
						<td  valign="middle">&nbsp;{lang mkey='of_zip_code'}
						</td>
						</tr>
						</table>
						</td>
						</tr>
					</table>
					{ /if }
						</td>
					</tr>
		{* Zip code end *}
				{/if}
				</table>
				</div>
				</div>
			{/if}
		{/if}
		{if $config.accept_allow_viewonline == 'Y' or $config.accept_allow_viewonline == '1' }
			<div class="line_top_bottom_pad">
				<div style="padding-left: 4px;">
				<table border=0 cellspacing="{$config.cellspacing}" cellpadding="{$config.cellpadding}" width="100%">
					<tr>
						<td width="183">{lang mkey='signup_view_online'}
						{if $config.allow_viewonline_mandatory == 'Y' or $config.allow_viewonline_mandatory == '1'}
							<font class="required_info">{$smarty.const.REQUIRED_INFO}</font>
						{/if}
						</td>
						<td align="left" valign="middle">
						<table border="0" cellspacing="0" cellpadding="0">
						<tr>
						<td valign="middle" width="6"><input class="radio" type="radio" {if $user.allow_viewonline=='1'}checked {/if} value="1"  name="txtviewonline" />
						</td>
						<td width="20" valign="middle">
						{lang mkey='yes'}
						</td>
						<td valign="middle" width="6">
						<input class="radio" type="radio" value="0" {if $user.allow_viewonline=='0'}checked {/if}
						name="txtviewonline" />
						</td>
						<td width="20" valign="middle">
						{lang mkey='no'} </td>
						</tr>
						</table>
						</td>
					</tr>
				</table>
				</div>
			</div>
			<br />
		{/if}
		{if $config.accept_about_me == '1' or $config.accept_about_me == 'Y' }
			<div class="line_top_bottom_pad">
				<div style="padding-left: 4px;">
				<table border=0 cellspacing="{$config.cellspacing}" cellpadding="{$config.cellpadding}" width="100%">
					<tr>
						<td width="188" valign="top">
							<b>{lang mkey='about_me'}:</b>{if $config.about_me_mandatory == 'Y'}
							<font class="required_info">{$smarty.const.REQUIRED_INFO}</font>
							{/if}
							<br />{lang mkey='about_me_hlp'}
						</td>
						<td valign="top" >
							<textarea class="textinput" name="about_me" cols="45" rows="6">
							{$user.about_me|stripslashes }
							</textarea>
						</td>
					</tr>
				</table>
				</div>
			</div>
			<br />
		{/if}
			<div class="line_top_bottom_pad" align="center">
				<input type="submit" class="formbutton" value='{lang mkey='submit'}'/> <input type="reset" class="formbutton" value="{lang mkey='reset'}"/>
			</div>
		</div>
		</form>
	</div>
	<div style="clear:both;"></div>
</div>
<br />
<script type="text/javascript">
display_couple_details("{$user.gender}");
</script>
{/strip}
