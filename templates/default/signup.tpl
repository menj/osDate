{strip}
<script type="text/javascript" src="javascript/cascade.js"></script>
<script type="text/javascript" src="javascript/pwd_strength.js"></script>

<script type="text/javascript">
/* <![CDATA[ */

function validateme(form)
{ldelim}
	var tz=form.txttimezone.value;
	var tos_ok = form.accept_tos.checked;

	ErrorCount=0;
	ErrorMsg = new Array();
	/* log details */
	{if $config.spam_code_length > 0}
		CheckFieldString("noblank",form.spam_code,"{lang mkey='errormsgs' skey='120'}");
	{/if}
	CheckFieldString("noblank",form.txtusername,"{lang mkey='signup_js_errors' skey='username_noblank'}");
	CheckFieldString("noblank",form.txtpassword,"{lang mkey='signup_js_errors' skey='password_noblank'}");

	/*log details*/
	CheckFieldString("alphanum",form.txtusername,"{lang mkey='signup_js_errors' skey='username_charset'}");
	CheckFieldString("full",form.txtpassword,"{lang mkey='signup_js_errors' skey='password_charset'}");

	CheckFieldString("noblank",form.txtpassword2,"{lang mkey='signup_js_errors' skey='con_password_noblank'}");
	/*profile*/
	CheckFieldString("noblank",form.txtemail,"{lang mkey='signup_js_errors' skey='email_noblank'}");
	CheckFieldString("email",form.txtemail,"{lang mkey='signup_js_errors' skey='email_notvalid'}");
	{ if $config.accept_profpic_signup == 'Y' && $config.accept_profpic_signup_must == 'Y' }
		CheckFieldString("noblank",form.txtimage,"{lang mkey='signup_js_errors' skey='profpic_noblank'}");
	{/if}

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
	{ if $config.accept_about_me == 'Y' || $config.accept_about_me == '1' }
		{if $config.about_me_mandatory == "Y"}
			CheckFieldString("noblank",form.about_me,"{lang mkey='signup_js_errors' skey='about_me_noblank'}");
		{/if}
	{/if}

	{ if $config.accept_country == 'Y' || $config.accept_country == '1' }
		{if $config.country_mandatory }
			CheckFieldString("noblank",form.txtfrom,"{lang mkey='signup_js_errors' skey='country_noblank'}");
		{/if}
		{ if ($config.accept_state == 'Y' || $config.accept_state == '1') && $config.state_mandatory eq 'Y' }
			CheckFieldString("noblank",form.txtstateprovince,"{lang mkey='signup_js_errors' skey='stateprovince_noblank'}");
		{/if}
		{ if ($config.accept_county == 'Y' || $config.accept_county == '1') }
			{if $config.county_mandatory eq 'Y' }
			CheckFieldString("noblank",form.txtcounty,"{lang mkey='signup_js_errors' skey='county_noblank'}");
			{/if}
		{/if}
		{ if ($config.accept_city == 'Y' || $config.accept_city == '1') }
			{if $config.city_mandatory eq 'Y' }
			CheckFieldString("noblank",form.txtcity,"{lang mkey='signup_js_errors' skey='city_noblank'}");
			{/if}
		{/if}
		{ if ($config.accept_zipcode == 'Y' || $config.accept_zipcode == '1')}
			{if $config.zipcode_mandatory eq 'Y' }
			CheckFieldString("noblank",form.txtzip,"{lang mkey='signup_js_errors' skey='zip_noblank'}");
			{/if}
		{/if}
	{/if}

	if(form.txtusername.value.length >= {$config.min_username_len} && form.txtusername.value.length <= {$config.max_username_len}){ldelim}
		if ( !isNaN(form.txtusername.value.charAt(0)) ){ldelim}
			ErrorCount++;
			ErrorMsg[ErrorCount] = "{lang mkey='signup_js_errors' skey='username_start_alpha'}" ;
		{rdelim}
	{rdelim}else{ldelim}
		ErrorCount++;
		ErrorMsg[ErrorCount] = "{lang mkey='signup_js_errors' skey='username_outrange'}" ;
	{rdelim}

	if( form.txtpassword.value.length >= {$config.min_pass_len} && form.txtpassword.value.length <= {$config.max_pass_len}){ldelim}
		if ( form.txtpassword.value != form.txtpassword2.value ){ldelim}
			ErrorCount++;
				ErrorMsg[ErrorCount] = "{lang mkey='signup_js_errors' skey='password_nomatch'}"  ;
		{rdelim}
	{rdelim}else{ldelim}
		ErrorCount++;
		ErrorMsg[ErrorCount] = "{lang mkey='signup_js_errors' skey='password_outrange'} {lang mkey='Between'} "+"{$config.min_pass_len} - {$config.max_pass_len} {lang mkey='characters'}" ;
	{rdelim}
	{if $config.accept_timezone == 'Y' || $config.accept_timezone == '1'}
	if (tz == '-25' ) {ldelim}
		ErrorCount++;
		ErrorMsg[ErrorCount]="{lang mkey='signup_js_errors' skey='timezone_noblank'}";
	{rdelim}
	{/if}
	if (tos_ok != true) {ldelim}
		ErrorCount++;
		ErrorMsg[ErrorCount]="{lang mkey='tos_must'}";
	{rdelim}

	/* concat all error messages into one string */
	result="";
	if( ErrorCount > 0)
	{ldelim}
		result = "---- Following errors occured -----"+ String.fromCharCode(13)+ String.fromCharCode(10);
		for( c in ErrorMsg)
			result += ErrorMsg[c]+ String.fromCharCode(13)+ String.fromCharCode(10)+ String.fromCharCode(10);
		alert(result);
		return false;
	{rdelim}
	return true;
{rdelim}
/* ]]> */
function display_couple_details(fld) {ldelim}
	if (fld.value == 'C' || fld == 'C' || fld.value == 'G' || fld == 'G') {ldelim}
		var ret = '<table border=0 cellspacing=0 cellpadding=0 width="100%"><td valign="top" colspan="2"><b>{lang mkey="couple_usernames_hlp"}<//b><//td><//tr><tr><td height="3"><//td><//tr><tr><td valign="top" width="33.5%">{lang mkey="couple_usernames"}:<font color="{lang mkey='required_info_indicator_color'}">{lang mkey='required_info_indicator'}<//font><//td><td valign="top" width="66.5%"><input type="text" class="textinput" size="30" name="couple_usernames" value="{$smarty.session.couple_usernames}" /><//td><//tr><//table>';
	{rdelim} else {ldelim}
		var ret = '<input type="hidden" name="couple_usernames" value="" />';
	{rdelim}
	document.getElementById('couple_info').innerHTML = ret;
{rdelim}
</script>

{assign var="page_hdr01_text" value="{lang mkey='signup'}"}
{assign var="page_title" value="{lang mkey='signup'}"}
{include file="page_hdr01.tpl"}
<div class="module_detail_inside"  style="vertical-align:top; padding-left:6px;" >
	<div class="line_outer" style="padding-left: 2px;">
	{if $smarty.get.errid != ''}
		{include file="display_error.tpl"}
	{/if}
	<form name="frmSignup" id="frmSignup" method="post"  enctype="multipart/form-data" action="savesignup.php" onsubmit="javascript: return validateme(this);">
		<div style="padding-top: 10px; padding-bottom: 10px;">
			<font class="required_info">{$smarty.const.REQUIRED_INFO}</font> {lang mkey='required_info_indication'}
			<br />
		</div>
		<div >
			{assign var="page_hdr02_text" value="{lang mkey='signup_subtitle_login'}"}
			{include file="page_hdr02.tpl"}
			<div class="module_detail_inside" style="padding-left: 4px;">
			<table width="100%" border="0" cellspacing="{$config.cellspacing}" cellpadding="{$config.cellpadding}">
				<tr>
					<td height="2" width="33%">{lang mkey='signup_username'}
					<font class="required_info">{$smarty.const.REQUIRED_INFO}</font></td>
					<td height="2" width="67%"> <input class="textinput" maxlength="{$config.max_username_len}" name="txtusername" size="25" value="{$smarty.session.username}" />&nbsp;
					({$config.min_username_len}{lang mkey='to'}{$config.max_username_len}&nbsp;{lang mkey='characters'})
					</td>
				</tr>
				<tr>
					<td>{lang mkey='signup_password'}
					<font class="required_info">{$smarty.const.REQUIRED_INFO}</font></td>
					<td> <input  type="password" class="textinput" name="txtpassword"  maxlength="{$config.max_pass_len}" size="25" value="{$password}"  onkeyup="runPassword(this.value, 'txtpassword');"/>&nbsp;({$config.min_pass_len}{lang mkey='to'}{$config.max_pass_len}&nbsp;{lang mkey='characters'})
					</td>
				</tr>
				<tr>
					<td>{lang mkey='signup_confirm_password'}
					<font class="required_info">{$smarty.const.REQUIRED_INFO}</font></td>
					<td> <input class="textinput" type="password"  name="txtpassword2" maxlength="{$config.max_pass_len}" size="25" value="{$password2}" />
					</td>
				</tr>
				<tr>
					<td valign="top">{lang mkey='pwd_strength'}:</td>
					<td width="67%">
						<div style="width:100%;">
							<div id="txtpassword_bar"class="password_bar">
							</div>
							<div id="txtpassword_text" class="password_text">
							</div>
						</div>
					</td>
				</tr>

			</table>
			</div>
		</div>
		<br />
		<div >
			{assign var="page_hdr02_text" value="{lang mkey='signup_subtitle_profile'}"}
			{include file="page_hdr02.tpl"}
			<div class="module_detail_inside" style="padding-left: 4px;">
			<table width="100%" border="0" cellspacing="{$config.cellspacing}" cellpadding="{$config.cellpadding}">
			{if $config.accept_firstname == 'Y' or $config.accept_firstname == '1'}
				<tr>
					<td width="33%">{lang mkey='signup_firstname'}
					{if $config.firstname_mandatory == 'Y' or $config.firstname_mandatory == '1'}
						<font class="required_info">{$smarty.const.REQUIRED_INFO}</font>
					{/if}
					</td>
					<td width="67%"><input class="textinput" maxlength="50" name="txtfirstname" value="{$smarty.session.firstname}" /></td>
				</tr>
			{/if}
			{if $config.accept_lastname == 'Y' or $config.accept_lastname == '1'}
				<tr>
					<td>{lang mkey='signup_lastname'}
					{if $config.lastname_mandatory == 'Y' or $config.lastname_mandatory == '1'}
						<font class="required_info">{$smarty.const.REQUIRED_INFO}</font>
					{/if}
					</td>
					<td> <input class="textinput" maxlength="50" name="txtlastname" value="{$smarty.session.lastname}" /> </td>
				</tr>
			{/if}
				<tr>
					<td>{lang mkey='signup_email'}
					<font class="required_info">{$smarty.const.REQUIRED_INFO}</font></td>
					<td> <input class="textinput" maxlength="255" name="txtemail" size="40" value="{$smarty.session.email}" />
					</td>
				</tr>
				<tr>
					<td>{lang mkey='signup_gender'}:
					<font class="required_info">{$smarty.const.REQUIRED_INFO}</font>
					</td>
					<td> <select class="select" style="width: 80px;" name="txtgender" onchange="javascript: display_couple_details(this);">
					{html_options options=$lang.signup_gender_values selected=$smarty.session.gender}
					</select>&nbsp;
					{if $config.accept_lookgender == 'Y' or $config.accept_lookgender == '1'}
						{lang mkey='looking_for_a'}&nbsp;
						<select class="select" style="width: 100px;" name="txtlookgender">
						{if $smarty.session.lookgender == ''}
						{html_options options=$lang.signup_gender_look selected='F'}
						{else}
						{html_options options=$lang.signup_gender_look selected=$smarty.session.lookgender }
						{/if}
						</select>
					{else}
						<input type="hidden" value="A" name="txtlookgender" />
					{/if}
					</td>
				</tr>
				<tr >
					<td colspan="2" id="couple_info"><input name="couple_usernames" type=hidden value="" />
					</td>
				</tr>
				{if $config.accept_lookage == 'Y' or $config.accept_lookage == '1'}
				<tr>
					<td>{lang mkey='signup_pref_age_range'}:
					<font class="required_info">{$smarty.const.REQUIRED_INFO}</font></td>
					<td> <select class="select" style="width: 50px" name="txtlookagestart">
					{html_options values=$lang.start_agerange output=$lang.start_agerange selected=$smarty.session.txtlookagestart}
					</select>{lang mkey='to'}<select class="select" style="width: 50px" name="txtlookageend">
					{html_options values=$lang.end_agerange output=$lang.end_agerange selected=$smarty.session.txtlookageend}
					</select>&nbsp;
					{lang mkey='signup_year_old'}. </td>
				</tr>
				{/if}
				<tr>
					<td>{lang mkey='signup_birthday'}
					<font class="required_info">{$smarty.const.REQUIRED_INFO}</font></td>
					<td>
					{html_select_date_translated prefix="txtbirth" start_year=$config.start_year end_year=$config.end_year month_value_format="%m" time=$selectedtime}
					</td>
				</tr>
			</table>
			</div>
		</div>
		{if $config.accept_lookage != 'Y' and $config.accept_lookage != '1'}
			<input type="hidden" name="txtlookagestart" value="{$smarty.session.txtlookagestart}" />
			<input type="hidden" name="txtlookageend" value="{$smarty.session.txtlookageend}" />
		{/if}
		{if $config.accept_country != '1' and $config.accept_country != 'Y'}
			<input type="hidden" name="txttimezone" value="{$smarty.session.timezone}" />
		{/if}
		<br />
		{if $config.accept_country == '1' or $config.accept_country == 'Y'}
			{if $config.accept_timezone != '1' and $config.accept_timezone != 'Y'}
				<input type="hidden" name="txttimezone" value="{$smarty.session.timezone}" />
			{/if}
		<div >
			{assign var="page_hdr02_text" value="{lang mkey='signup_subtitle_address'}"}
			{include file="page_hdr02.tpl"}
			<div class="module_detail_inside" style="padding-left: 4px;">
			<table width="100%" border="0" cellspacing="{$config.cellspacing}" cellpadding="{$config.cellpadding}" id="tbl2">
			{if $config.accept_timezone == '1' or $config.accept_timezone == 'Y'}
				<tr>
					<td>
						{lang mkey='timezone'}
						{if $config.timezone_mandatory == 'Y' or $config.timezone_mandatory == '1'}
							<font class="required_info">{$smarty.const.REQUIRED_INFO}</font>
						{/if}
					</td>
					<td>

						<select class="select" style="width: 315px;" name="txttimezone">
						{html_options options=$lang.tz selected=$smarty.session.timezone}
						</select>
					</td>
				</tr>
			{/if}
			{if $config.accept_country != 'Y' and $config.accept_country != '1'}
				<input name="txtfrom" type="hidden" value="AA" />
				<input name="txtstateprovince" type="hidden" value="AA" />
				<input name="txtcounty" type="hidden" value="AA" />
				<input name="txtcity" type="hidden" value="AA" />
				<input name="txtzip" type="hidden" value="AA" />
			{else }
				<tr>
					<td width="33%">{lang mkey='signup_country'}
					{if $config.country_mandatory == 'Y'}
					<font class="required_info">{$smarty.const.REQUIRED_INFO}</font>
					{/if}
					 </td>
						<td width="67%"><select class="select" style="width: 175px;" name="txtfrom" id="txtfrom"  {if $config.accept_state == 'Y' or $config.accept_state == '1'}onchange="javascript:  cascadeCountry(this.value);"{elseif $config.accept_county == 'Y' or $config.accept_county == '1'}onchange="javascript:  cascadeState('AA', this.value);"{elseif $config.accept_city =='Y' or $config.accept_city =='1'}onchange="javascript:  cascadeCounty('AA',this.value,'AA');"{elseif $config.accept_zipcode =='Y' or $config.accept_zipcode == '1'} onchange="javascript:  cascadeCity('AA',this.value,'AA','AA');" {/if} >{if $config.country_mandatory != 'Y'}<option value="">{lang mkey='select_country'}</option>{/if}
						{html_options options=$lang.countries selected=$address.from}
						</select>
						{if $config.accept_state != '1' && $config.accept_state != 'Y'}
							<input name="txtstateprovince" type="hidden" value="AA" />
						{/if}
						{if $config.accept_county != '1' && $config.accept_county != 'Y'}
							<input name="txtcounty" type="hidden" value="AA" />
						{/if}
						{if $config.accept_city != '1' && $config.accept_city != 'Y'}
							<input name="txtcity" type="hidden" value="AA" />
						{/if}
						{if $config.accept_zipcode != '1' && $config.accept_zipcode != 'Y'}
							<input name="txtzip" type="hidden" value="AA" />
						{/if}
					</td>
				</tr>
					{if $config.accept_state == '1' or $config.accept_state == 'Y'}
				<tr>
					<td width="172">
					{lang mkey='signup_state_province'}{if $config.state_mandatory == 'Y'}
					<font class="required_info">{$smarty.const.REQUIRED_INFO}</font>
						{/if}
					</td>
					<td width="344" id="txtstateprovince">
						{ if $lang.states|@count > 0}
					<select class="select" style="width: 175px" name="txtstateprovince" {if $config.accept_county == 'Y' or $config.accept_county == '1'}onchange="javascript:  cascadeState(this.value, this.form.txtfrom.value);"{elseif $config.accept_city =='Y' or $config.accept_city =='1'}onchange="javascript:  cascadeCounty('AA',this.form.txtfrom.value, this.value);"{elseif $config.accept_zipcode =='Y' or $config.accept_zipcode == '1'} onchange="javascript:  cascadeCity('AA', this.form.txtfrom.value, this.value, 'AA');" {/if}><option value="">{lang mkey='select_state'}</option>
					{html_options options=$lang.states selected=$address.stateprovince}
					</select>
						{ else }
					<input name="txtstateprovince" type="text" class="textinput" size="30" maxlength="100" value="{if $address.stateprovince != 'AA'}{$address.stateprovince}{/if}" />
						{ /if}
					</td>
				</tr>
					{/if}
					{if $config.accept_county == '1' or $config.accept_county == 'Y'}
				<tr>
					<td width="172">{lang mkey='manage_counties'}:{if $config.county_mandatory == 'Y'}
					<font class="required_info">{$smarty.const.REQUIRED_INFO}</font>
							{/if}
					</td>
					<td width="344" id="txtcounty">
							{ if $lang.counties|@count > 0}
					<select class="select" style="width: 175px" name="txtcounty" {if $config.accept_city =='Y' or $config.accept_city =='1'}onchange="javascript:  cascadeCounty(this.value,this.form.txtfrom.value, this.form.txtstateprovince.value);"{elseif $config.accept_zipcode =='Y' or $config.accept_zipcode == '1'} onchange="javascript:  cascadeCity('AA', this.form.txtfrom.value, this.form.txtstateprovince.value, this.value);" {/if} >
					{html_options options=$lang.counties selected=$address.countycode}
					</select>
							{ else }
					<input name="txtcounty" type="text" class="textinput" size="30" maxlength="100" value="{if $address.countycode != 'AA'}{$address.countycode}{/if}" />
						{ /if}
					</td>
				</tr>
						{/if}
						{if $config.accept_city == '1' or $config.accept_city == 'Y'}
				<tr>
					<td>
						{lang mkey='signup_city'}{if $config.city_mandatory == 'Y'}
					<font class="required_info">{$smarty.const.REQUIRED_INFO}</font>
								{/if}
					</td>
					<td id="txtcity">
							{ if $lang.cities|@count > 0}
					<select class="select" style="width: 175px" name="txtcity"  {if $config.accept_zipcode =='Y' or $config.accept_zipcode == '1'} {if $config.accept_county =='1' or $config.accept_county =='Y'} onchange="javascript: cascadeCity(this.value, this.form.txtfrom.value, this.form.txtstateprovince.value, this.form.txtcounty.value);"{else}onchange="javascript:  cascadeCity(this.value, this.form.txtfrom.value, this.form.txtstateprovince.value, 'AA');" {/if}{/if} >
					{html_options options=$lang.cities selected=$address.citycode}
					</select>
							{ else }
					<input name="txtcity" type="text" class="textinput" size="30" maxlength="100" value="{if $address.citycode != 'AA'}{$address.citycode}{/if}" />
							{ /if}
					</td>
				</tr>
						{/if}
						{if $config.accept_zipcode == '1' or $config.accept_zipcode == 'Y'}
				<tr>
					<td>
						{lang mkey='signup_zip'}{if $config.zipcode_mandatory == 'Y'}
					<font class="required_info">{$smarty.const.REQUIRED_INFO}</font>
								{/if}
					</td>
					<td id="txtzip">
							{ if $lang.zipcodes|@count > 0}
					<select class="select" style="width: 175px" name="txtzip">
					{html_options options=$lang.zipcodes selected=$address.zip}
					</select>
							{ else }
					<input name="txtzip" type="text" class="textinput" size="30" maxlength="100" value="{if $address.zip!='AA'}{$address.zip}{/if}" />
							{ /if}
					</td>
				</tr>
						{/if}
						{if $config.accept_address_line1 == '1' or $config.accept_address_line1 == 'Y'}
				<tr>
					<td>
						{lang mkey='signup_address1'}
					</td>
					<td>
						<input class="textinput" maxlength="255" name="txtaddress1" size="40" value="{$smarty.session.address1}" />
					</td>
				</tr>
							{if $config.accept_address_line2 == '1' or $config.accept_address_line2 == 'Y'}
				<tr>
					<td height="22">
						{lang mkey='signup_address2'}
					</td>
					<td height="22">
						<input class="textinput" maxlength="255" name="txtaddress2" size="40" value="{$smarty.session.address2}" />
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
		{if $config.accept_lookcountry == '1' or $config.accept_lookcountry == 'Y' or $config.accept_allow_viewonline == '1' or $config.accept_allow_viewonline == 'Y'}
			{if ($config.accept_lookcountry == 'Y' or $config.accept_lookcountry == '1') and ($config.accept_country == 'Y' or $config.accept_country == '1')}
			{assign var="page_hdr02_text" value="{lang mkey='signup_subtitle_preference'}"}
			{include file="page_hdr02.tpl"}
			<div class="module_detail_inside" style="padding-left: 4px;">
			<table width="100%" border="0" cellspacing="{$config.cellspacing}" cellpadding="{$config.cellpadding}" id="tbl">
				<tr>
					<td colspan="2"><b>{lang mkey='signup_where_should_we_look'}</b></td>
				</tr>
				<tr>
					<td width="33%">
						{lang mkey='signup_country'}
						{if $config.lookcountry_mandatory == 'Y'}
						<font class="required_info">{$smarty.const.REQUIRED_INFO}</font>
						{/if}
					</td>
					<td width="67%">
						<select class="select" style="width: 175px;" name="txtlookfrom"  id="txtlookfrom" {if ($config.accept_state == 'Y' or $config.accept_state == '1') and ($config.accept_lookstate == 'Y' or $config.accept_lookstate == '1') } onChange="cascadeCountryL(this.value);"{elseif  ($config.accept_county == 'Y' or $config.accept_county == '1') and ($config.accept_lookcounty == 'Y' or $config.accept_lookcounty == '1')} onChange="cascadeStateL('AA', this.value);"{elseif  ($config.accept_city == 'Y' or $config.accept_city == '1') and ($config.accept_lookcity == 'Y' or $config.accept_lookcity == '1')} onChange="cascadeCountyL('AA', this.value, 'AA');"{elseif  ($config.accept_zipcode == 'Y' or $config.accept_zipcode == '1') and ($config.accept_lookzipcode == 'Y' or $config.accept_lookzipcode == '1')} onChange="cascadeCityL('AA', this.value,'AA','AA');"{/if}>
						{html_options options=$lang.allcountries selected=$smarty.session.lookfrom}
						</select>
						{if $config.accept_state != '1' && $config.accept_state != 'Y' && $config.accept_lookstate != 'Y' or $config.accept_lookstate != '1'}
							<input name="txtlookstateprovince" type="hidden" value="AA" />
						{/if}
						{if $config.accept_county != '1' && $config.accept_county != 'Y' && $config.accept_lookcounty != 'Y' or $config.accept_lookcounty != '1'}
							<input name="txtlookcounty" type="hidden" value="AA" />
						{/if}
						{if $config.accept_city != '1' && $config.accept_city != 'Y' && $config.accept_lookcity != 'Y' or $config.accept_lookcity != '1'}
							<input name="txtlookcity" type="hidden" value="AA" />
						{/if}
						{if $config.accept_zipcode != '1' && $config.accept_zipcode != 'Y' && $config.accept_lookzipcode != '1' && $config.lookaccept_zipcode != 'Y'}
							<input name="txtlookzip" type="hidden" value="AA" />
						{/if}
					</td>
				</tr>
				{if ($config.accept_lookstate == 'Y' or $config.accept_lookstate == '1') and ($config.accept_state == '1' or $config.accept_state == 'Y' ) }
				<tr>
					<td width="33%">{lang mkey='signup_state_province'}</td>
					<td width="67%" id="txtlookstateprovince">
					{ if $lang.lookstates|@count > 0 }
					<select class="select" style="width: 175px" name="txtlookstateprovince" {if ($config.accept_county == '1' or $config.accept_county == 'Y') and ($config.accept_lookcounty == '1' or $config.accept_lookcounty == 'Y')}onchange="javascript: cascadeStateL(this.value,this.form.txtlookfrom.value);" {elseif  ($config.accept_city == 'Y' or $config.accept_city == '1') and ($config.accept_lookcity == 'Y' or $config.accept_lookcity == '1')} onChange="cascadeCountyL('AA', this.form.txtlookfrom.value, this.value);"{elseif  ($config.accept_zipcode == 'Y' or $config.accept_zipcode == '1') and ($config.accept_lookzipcode == 'Y' or $config.accept_lookzipcode == '1')} onChange="cascadeCityL('AA', this.form.txtlookfrom.value,this.value,'AA');"{/if} >
					{html_options options=$lang.lookstates selected=$address.lookstateprovince}
					</select>
					{else}
					<input type="text" class="textinput" name="txtlookstateprovince" value="{if $address.lookstateprovince!='AA'}{$address.lookstateprovince}{/if}" size="30" maxlength="200" />
					{/if}
					</td>
				</tr>
				{/if}
				{if ($config.accept_lookcounty == 'Y' or $config.accept_lookcounty == '1') and ($config.accept_county == '1' or $config.accept_county == 'Y') }
				<tr>
					<td width="33%">{lang mkey='manage_counties'}:
					</td>
					<td  width="67%" id="txtlookcounty">
						{ if $lang.lookcounties|@count > 0}
					<select class="select" style="width: 175px" name="txtlookcounty" {if  ($config.accept_city == 'Y' or $config.accept_city == '1') and ($config.accept_lookcity == 'Y' or $config.accept_lookcity == '1')} onChange="cascadeCountyL(this.value, this.form.txtlookfrom.value, this.form.txtlookstateprovince.value);"{elseif  ($config.accept_zipcode == 'Y' or $config.accept_zipcode == '1') and ($config.accept_lookzipcode == 'Y' or $config.accept_lookzipcode == '1')} onChange="cascadeCityL('AA', this.form.txtlookfrom.value, this.form.txtlookstateprovince.value, this.value);"{/if}   >
					{html_options options=$lang.lookcounties selected=$address.lookcountycode}
					</select>
						{ else }
					<input name="txtlookcounty" type="text" class="textinput" size="30" maxlength="100" value="{if $address.lookcountycode !='AA'}{$address.lookcountycode}{/if}" />
						{ /if}
					</td>
				</tr>
				{/if}
				{if ($config.accept_lookcity == '1' or $config.accept_lookcity == 'Y') and ($config.accept_city == '1' or $config.accept_city == 'Y' ) }
				<tr>
					<td  width="33%">
						{lang mkey='signup_city'}
					</td>
					<td  width="67%" id="txtlookcity">
						{ if $lang.lookcities|@count > 0}
					<select class="select" style="width: 175px" name="txtlookcity" {if  ($config.accept_zipcode == 'Y' or $config.accept_zipcode == '1') and ($config.accept_lookzipcode == 'Y' or $config.accept_lookzipcode == '1')}{if  ($config.accept_county == 'Y' or $config.accept_county == '1') and ($config.accept_lookcounty == 'Y' or $config.accept_lookcounty == '1')} onChange="cascadeCityL(this.value, this.form.txtlookfrom.value, this.form.txtlookstateprovince.value, this.form.txtlookcounty.value);"{else} onChange="cascadeCityL(this.value, this.form.txtlookfrom.value, this.form.txtlookstateprovince.value, 'AA');"{/if}{/if} >
					{html_options options=$lang.lookcities selected=$address.lookcitycode}
					</select>
						{ else }
					<input name="txtlookcity" type="text" class="textinput" size="30" maxlength="100" value="{if $address.lookcitycode!='AA'}{$address.lookcitycode}{/if}" />
						{ /if}
					</td>
				</tr>
				{/if}
				{if ($config.accept_lookzipcode == '1' or $config.accept_lookzipcode == 'Y') and ($config.accept_zipcode == '1' or $config.accept_zipcode == 'Y') }
				<tr>
					<td  width="33%">
						{lang mkey='signup_zip'}
					</td>
					<td  width="67%" id="txtlookzip">
						{ if $lang.lookzipcodes|@count > 0}
					<select class="select" style="width: 175px" name="txtlookzip">
					{html_options options=$lang.lookzipcodes selected=$address.lookzip}
					</select>
						{ else }
					<input name="txtlookzip" type="text" class="textinput" size="15" maxlength="100" value="{if $address.lookzip!='AA'}{$address.lookzip}{/if}" />
						{ /if}
					</td>
				</tr>
					{/if}
				<tr>
					<td colspan="2">
				<div id="zipsavailable">
					{ if $zipsavailable > 0 }
				<table border="0" cellspacing="{$config.cellspacing}" cellpadding="{$config.cellpadding}"  width="100%">
				<tr >
					<td width="33%">
						{lang mkey='search_within'}:
					</td>
					<td width="67%" valign="top">
					<table width="100%" cellpadding=0 border=0 cellspacing=0><tr>
					<td valign="middle" width="15">
					<input name="lookradius" value="{$smarty.session.lookradius}" type="text" class="textinput" size="5" maxlength="10" />
					</td>
					<td valign="middle" width="7">
					<input type=radio name="radiustype" value="miles" {if $smarty.session.radiustype == 'miles'} checked{/if} />
					</td>
					<td width="15" valign="middle">
					{lang mkey='miles'}
					</td>
					<td width="7" valign="middle"><input type=radio name="radiustype" value="kms" {if $smarty.session.radiustype == 'kms'} checked{/if} />
					</td>
					<td valign="middle" width="20">{lang mkey='kms'}</td>
					<td  valign="middle">&nbsp;{lang mkey='of_zip_code'}
					</td>
					</tr>
					</table>
					</td>
					</tr>
				</table>
				{/if}
				</div>
				</td>
			</tr>
			</table>
			</div>
			{/if}
		{/if}
		{if $config.accept_allow_viewonline == 'Y' or $config.accept_allow_viewonline == '1' }
		<table border="0" cellspacing="{$config.cellspacing}" cellpadding="{$config.cellpadding}" width="100%">
			<tr>
				<td width="33%">{lang mkey='signup_view_online'}
				{if $config.allow_viewonline_mandatory == 'Y' or $config.allow_viewonline_mandatory == '1'}
					<font class="required_info">{$smarty.const.REQUIRED_INFO}</font>
				{/if}
				</td>
				<td align="left"><input class="radio" type="radio" {if $config.default_allow_viewonline=='Y' or $config.default_allow_viewonline=='1'}checked{/if} value="1"  name="txtviewonline" />
				{lang mkey='yes'}&nbsp;
				<input class="radio" type="radio" value="0" {if $config.default_allow_viewonline=='N' or $config.default_allow_viewonline=='0'}checked{/if}
				name="txtviewonline" />
				{lang mkey='no'} </td>
			</tr>
		</table>
		{/if}
		{if $config.accept_about_me == '1' or $config.accept_about_me == 'Y' }
		<table width="100%" border="0" cellpadding="0" cellspacing="0" >
			<tr><td height="4"></td></tr>
			<tr>
				<td width="195" valign="top" style="padding-right:3px;">
					<b>{lang mkey='about_me'}:</b>{if $config.about_me_mandatory == 'Y'}
					<font class="required_info">{$smarty.const.REQUIRED_INFO}</font>
					{/if}
					<br />{lang mkey='about_me_hlp'}
				</td>
				<td valign="top" >
					<textarea class="textinput" name="about_me" cols="45" rows="6">
					{$smarty.session.about_me|stripslashes }
					</textarea>
				</td>
			</tr>
		</table>
		{/if}
		{if $config.accept_profpic_signup == 'Y'}
		<table width="100%" border="0" cellpadding="0" cellspacing="0" >
			<tr><td height="4"></td></tr>
			<tr>
				<td width="195" valign="top" style="padding-right:3px;">
					{lang mkey='signup_picture'}:{if $config.accept_profpic_signup_must == 'Y'}
					<font class="required_info">{$smarty.const.REQUIRED_INFO}</font>
					{/if}
				</td>
				<td valign="top" >
					<input type="file" name="txtimage" />
				</td>
			</tr>
			<tr><td height="2"></td></tr>
		</table>
		{/if}
		{if $promocnt > 0}
{* PROMO CODE START *}
		<div >
			{assign var="page_hdr02_text" value="{lang mkey='Promotions'}"}
			{include file="page_hdr02.tpl"}
			<div class="module_detail_inside" style="padding-left: 4px;">
			<table width="100%" border="0" cellspacing="{$config.cellspacing}" cellpadding="{$config.cellpadding}" >
				<tr align="center">
					<td colspan="2" width="100%" ><b>{lang mkey='have_promo'}</b></td>
				</tr>
				<tr>
					<td  valign="middle" colspan="2">
						{lang mkey='enter_promo'}: &nbsp;
						<input name="promocode" type="text" class="textinput" size="10" maxlength="10" value="{$smarty.session.promocode}" />
					</td>
				</tr>
			</table>
			</div>
		</div>
{* PROMO CODE END *}
		{/if}
		<table border="0" cellspacing="0" cellpadding="0" width="100%">
			<tr>
				<td width="8" valign="middle">
					<input type="checkbox" name="accept_tos" value='1' {if $smarty.session.accept_tos == '1'}CHECKED{/if} />
				</td>
				<td valign="middle">
					{lang mkey='accept_tos'}
				</td>
			</tr>
		</table>
		{if $config.spam_code_length > 0}
			<table width="100%" border="0" cellpadding="0" cellspacing="0" >
				<tr><td height="4"></td></tr>
				<tr>
					<td valign="bottom" height="40">
						<table width="100%" cellspacing="0" cellpadding="0" border="0">
							<tr><td colspan="3" height="4"></td></tr>
							<tr>
								<td colspan="3" ><br /><b>{lang mkey="security_code_txt"}</b><br /><br /></td>
							</tr>
							<tr>
								<td width="195">
									{lang mkey='enter_spamcode'}:&nbsp;
								</td>
								<td valign="middle" width="15">
									<input type="text" class="textinput" name="spam_code" id="spam_code" value="" />
								</td>
								<td valign="middle" style="padding-left: 5px;" nowrap  >
									<img src="captcha/SecurityImage.php"  alt="Security Code" id="spam_code_img" name="spam_code_img" />
									&nbsp;&nbsp;
									<a href="javascript:reloadCaptcha();" ><img src="captcha/images/arrow_refresh.png" alt="Refresh Code" border="0" /></a>
								</td>
							</tr>
						</table>
					</td>
				</tr>
			 </table>
		{/if}
		 <br />
		<center>
		{if $config.accept_allow_viewonline != '1' or $config.accept_allow_viewonline != 'Y'}
			<input type="hidden" name="txtviewonline" value="{if $config.default_allow_viewonline=='Y' or $config.default_allow_viewonline=='1'}1{else}0{/if}" />
		{/if}
		<input type="submit" class="formbutton" value="{lang mkey='submit'}" />&nbsp;<input type="reset" class="formbutton" value="{lang mkey='reset'}" />
		</center>
    </form>
	</div>
</div>
<div style="clear:both;"></div>
<script type="text/javascript">
display_couple_details("{$smarty.session.gender}");
</script>
{/strip}
