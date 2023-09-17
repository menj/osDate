{strip}
<script type="text/javascript" src="javascript/cascade.js"></script>

<div style="vertical-align:top;" >
	{assign var="page_hdr01_text" value="{lang mkey='mysearchpreferences'}"}
	{assign var="page_title" value="{lang mkey='mysearchpreferences'}"}
	{include file="page_hdr01.tpl"}
	<div class="module_detail_inside">
		{if $modify_error neq ""}
			{assign var="error_message" value=$modify_error}
			{include file="display_error.tpl"}
		{/if}
		<form name="frmEditUser" method="post" action="modifymymatches.php" >
		<input type="hidden" name="txtuserid" value="{$user.id}"/>
		<input type="hidden" name="txtusername" value="{$user.username}"/>
		<div class="line_outer">
		{if $config.accept_lookcountry != 'Y' and $config.accept_lookcountry != '1'}
			<input type="hidden" name="txtlookfrom" value="{$user.lookcountry}" />
			<input name="txtlookstateprovince" type="hidden" value="{$user.lookstate_province|stripslashes}" />
			<input name="txtlookcounty" type="hidden" value="{$user.lookcounty|stripslashes}"/>
			<input name="txtlookcity" type="hidden" value="{$user.lookcity|stripslashes}"/>
			<input name="txtlookzip" type="hidden" value="{$user.lookzip|stripslashes}"/>
		{/if}
		{if $config.accept_lookgender != 'Y' and  $config.accept_lookgender != '1'}
			<input type="hidden" value="{$user.lookgender}" name="txtlookgender" />
		{/if}
		{if $config.accept_lookage != 'Y' and $config.accept_lookage != '1'}
			<input type="hidden" value="{$user.lookagestart}" name="txtlookagestart" />
			<input type="hidden" value="{$user.lookageend}" name="txtlookageend" />
		{/if}
		<table border="0" cellspacing="{$config.cellspacing}" cellpadding="{$config.cellpadding}">
		{if $config.accept_lookgender == 'Y' or $config.accept_lookgender == '1'}
			<tr>
				<td width="33%">
					{lang mkey='looking_for_a'}:
				</td>
				<td>
					<select class="select" style="width: 105px" name="txtlookgender" >
					{html_options options=$lang.signup_gender_look selected=$user.lookgender}
					</select>
				</td>
			</tr>
		{/if}
		{if $config.accept_lookage == 'Y' or $config.accept_lookage == '1'}
			<tr>
				<td width="33%">{lang mkey='signup_pref_age_range'}:</td>
				<td> <select class="select" style="width: 50px;" name="txtlookagestart">
				{html_options values=$lang.start_agerange output=$lang.start_agerange selected=$user.lookagestart}
				</select>{lang mkey='to'}<select class="select" style="width: 50px;" name="txtlookageend" >
				{html_options values=$lang.end_agerange output=$lang.end_agerange selected=$user.lookageend}
				</select>
				&nbsp;{lang mkey='signup_year_old'}.
				</td>
			</tr>
		{/if}
		{if ( $config.accept_lookcountry == '1' or $config.accept_lookcountry == 'Y') and ($config.accept_country == '1' or $config.accept_country == 'Y' )}
			<tr>
				<td colspan="2"><b>{lang mkey='signup_where_should_we_look'}</b></td>
			</tr>
			<tr>
				<td width="33%">{lang mkey='signup_country'}</td>
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
					<input name="txtlookstateprovince" value="{if $user.lookstate_province!='AA'}{$user.lookstate_province|stripslashes}{/if}" size="30" maxlength="200" class="textinput"/>
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
				<input name="txtlookcity" type="text" class="textinput" size="30" maxlength="100" value="{if $user.lookcity !='AA'}{$user.lookcity|stripslashes}{/if}"/>
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
				<input name="txtlookzip" type="text" class="textinput" size="30" maxlength="100" value="{if $user.lookzip !='AA'}{$user.lookzip|stripslashes}{/if}"/>
			{ /if}
				</td>
			</tr>
{* Zip code *}
			<tr>
				<td colspan="2" id="zipsavailable">
			{ if $zipsavailable > 0 }
			<table border="0" cellspacing="0" cellpadding="0"  width="100%">
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
					<input type=radio name="radiustype" value="miles" {if $radiustype == 'miles'} checked="checked"{/if} />
					</td>
					<td width="15" valign="middle">
					{lang mkey='miles'}
					</td>
					<td width="7" valign="middle"><input type=radio name="radiustype" value="kms" {if $radiustype == 'kms'} checked="checked"{/if} />
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
		{/if}
			<tr>
				<td colspan="2">
				<div class="line_top_bottom_pad" align="center">
					<input type="submit" class="formbutton" value='{lang mkey='submit'}'/> <input type="reset" class="formbutton" value="{lang mkey='reset'}"/>
				</div>
				</td>
			</tr>
		</table>
		</div>
		</form>
	</div>
</div>
<br />
{/strip}
