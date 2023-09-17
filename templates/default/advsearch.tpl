{strip}
<script type="text/javascript" src="{$docroot}javascript/cascade_search.js"></script>
<form name="{$frmname}" method="get" action="advsearch.php">
<input type="hidden" name="cursectionid" value="{$sectionid}" />
<input type="hidden" name="sectionid" value="{$sectionid}" />
<input type="hidden" name="userid" value="{$userid}" />
<input type="hidden" name="chgcntry" value="" />
<div style="vertical-align:top;" >
	{assign var="page_hdr01_text" value="{lang mkey='search_advance'}"}
	{assign var="page_title" value="{lang mkey='search_advance'}"}
	{if $smarty.session.AdminId > 0}
		{include file="admin/admin_page_hdr01.tpl"}
	{else}
		{include file="page_hdr01.tpl"}
	{/if}
	<div class="module_detail_inside" style="padding-left:4px;">
		{if $smarty.session.AdminId == ''}
		<div class="line_outer">
			<div style="vertical-align:middle; text-align:left;" class="line_top_bottom_pad">
				{if $user_searches|@count > 0 }
					&nbsp;&nbsp;
					{lang mkey='my_searches'}:&nbsp;
					<select name="search_name" >
						{foreach item=val from=$user_searches}
						<option value="{$val.search_name|stripslashes}" {if $smarty.session.search_name == '' or $smarty.session.search_name == $val.search_name} SELECTED {/if}>{$val.search_name|stripslashes}</option>
						{/foreach}
					</select>
					<input type=hidden name="get_search" />
					<input type=hidden name="del_search" />
					&nbsp;
					<input type="button" name="get_it" class="formbutton" value="{lang mkey='open_search'}" onclick="javascript: document.forms['{$frmname}'].cursectionid.value='';document.forms['{$frmname}'].get_search.value='Open Search';document.forms['{$frmname}'].submit();" />
					&nbsp;
					<input type="button" name="del_it" class="formbutton" value="{lang mkey='delete_search'}" onclick="javascript: document.forms['{$frmname}'].cursectionid.value='';document.forms['{$frmname}'].del_search.value='Delete Search';document.forms['{$frmname}'].submit();" />
				{/if}
			</div>
			<table border="0" cellspacing="0" cellpadding="0" >
				<tr>
					<td valign="middle" width="90" nowrap>
						&nbsp;&nbsp;
						{lang mkey='save_search'}:&nbsp;
					</td>
					<td valign="middle" width="6">
						<input type="radio" name="save_type" value="0" CHECKED />
					</td>
					<td valign="middle" width="75" nowrap>{lang mkey='no_save'}</td>
			{if $user_searches|@count > 0 }
					<td valign="middle" width="8">
					<input type="radio" name="save_type" value="R" />
					</td>
					<td valign="middle" width="70">{lang mkey='replace'}&nbsp;&nbsp;</td>
			{/if}
					<td valign="middle" width="8">
					<input type="radio" name="save_type" value="N"  />
					</td>
					<td valign="middle" width="70">{lang mkey='new'}&nbsp;
					{lang mkey='name'}
					</td>
					<td valign="middle"><input type=text class="textinput" size="30" maxlength="100" name="new_name"  value="{$smarty.session.search_new_name}" />
					</td>
				</tr>
			</table>
		</div>
		{/if}
		<div class="line_top_bottom_pad" style=" margin-top: 6px;">
			<table width="100%" border="0" cellpadding="3" cellspacing="1" >
				<tr >
		{* Create menu from sections table *}
		{assign var="cn" value=1}
				{foreach key=key item=item from=$sections}
					<td align="center" class='edituserlink' height="23">
						{if $key != $sectionid}
							<a href="#" onclick="javascript: document.{$frmname}.sectionid.value={$key}; document.{$frmname}.submit();" class='edituserlink'>
						{/if}
						{$item}
						{if $key != $sectionid}
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
	{if $sectionid == '0' }
	{* Signup Information and address data *}
			<table   border="0" cellspacing="{$config.cellspacing}" cellpadding="{$config.cellpadding}" width="100%">
				<tr>
					<td width="25%">{lang mkey='signup_username'} </td>
					<td width="75%%">
					<input name="srchusername" value="{$advsearch.srchusername}" type="text" class="textinput" size="30" />
					</td>
				</tr>
				<tr>
					<td >{lang mkey='signup_gender'}:
					</td>
					<td nowrap>
					<select class="select" style="width: 80px;" name="srchgender" >
					<option value=''>{lang mkey='select'}</option>
					{html_options options=$lang.signup_gender_values selected=$advsearch.srchgender}
					</select>
					</td>
				</tr>
				<tr>
					<td >
					{lang mkey='looking_for'}:
					</td>
					<td valign="middle">
						<table border="0" cellspacing="0" cellpadding="0">
						{ assign var="mc" value="0" }
						{foreach item=item key=key from=$lang.signup_gender_values}
							{ if $mc == 0 } <tr> {/if}
							<td  valign="middle">
								<table border="0" cellspacing="0" cellpadding="0">
									<tr><td width="4" valign="middle">
										<input type="checkbox" name="srchlookgender[]" value="{$key}"
										{foreach from=$advsearch.srchlookgender item=lookgender}
										{if $lookgender eq $key}
											checked="checked"
										{/if}
										{/foreach}  />
										</td>
										<td valign="middle">
										{$item|stripslashes}&nbsp;
										</td>
									</tr>
								</table>
							</td>
							{assign var="mc" value=$mc+1 }
							{if $mc == 5 }</tr>{assign var="mc" value="0"}{/if}
						{/foreach}
						{if $mc < 5 && $mc > 0} </tr>{/if}
						</table>
					</td>
				</tr>
				<tr>
					<td >{lang mkey='signup_pref_age_range'}:
					</td>
					<td  nowrap> <select class="select" style="width: 50px;" name="srchlookagestart">
					{html_options values=$lang.start_agerange output=$lang.start_agerange selected=$advsearch.srchlookagestart}
					</select>{lang mkey='to'}<select class="select" style="width: 50px;" name="srchlookageend" >
					{html_options values=$lang.end_agerange output=$lang.end_agerange selected=$advsearch.srchlookageend}
					</select>
					&nbsp;{lang mkey='signup_year_old'}
					</td>
				</tr>
				<tr>
					<td colspan="2">&nbsp;</td>
				</tr>
		{if $config.accept_country == 'Y' or $config.accept_country == '1'}
		{* Tricky, accept lookup address details only if country is acceptable *}
				<tr>
					<td colspan="2"><b>{lang mkey='signup_where_should_we_look'}</b>
					</td>
				</tr>
				<tr>
					<td >{lang mkey='signup_country'}
					</td>
					<td >
					   <select class="select" style="width: 175px;" name="srchlookcountry" {if $config.accept_state == 'Y' or $config.accept_state == '1'}onchange="javascript: cascadeCountry(this.value);"{elseif $config.accept_county =='1' or $config.accept_county =='Y'}onchange="javascript: cascadeState('AA',this.value);"{elseif $config.accept_city =='1' or $config.accept_city =='Y'}onchange="javascript: cascadeCounty('AA',this.value,'AA');"{elseif $config.accept_zipcode =='1' or $config.accept_zipcode =='Y'}onchange="javascript: cascadeCity('AA',this.value,'AA','AA');"{/if} >
							{html_options options=$lang.allcountries selected=$advsearch.srchlookcountry}
						</select>
						{if $config.accept_state != '1' && $config.accept_state != 'Y' }
							<input name="srchlookstate_province" type="hidden" value="AA" />
						{/if}
						{if $config.accept_county != '1' && $config.accept_county != 'Y'}
							<input name="srchlookcounty" type="hidden" value="AA" />
						{/if}
						{if $config.accept_city != '1' && $config.accept_city != 'Y' }
							<input name="srchlookcity" type="hidden" value="AA" />
						{/if}
						{if $config.accept_zipcode != '1' && $config.accept_zipcode != 'Y'}
							<input name="srchlookzip" type="hidden" value="AA" />
						{/if}
					</td>
				</tr>
			{if $config.accept_state == 'Y' or $config.accept_state == '1'}
			{* Even if country is acceptable, states may not be. hmmm.. Trickyier  *}

				<tr>
					<td >{lang mkey='signup_state_province'}
					</td>
					<td  id="srchlookstate_province">
				{ if $lang.lookstates|@count > 0 }
					<select class="select" style="width: 175px" name="srchlookstate_province" {if $config.accept_county == '1' or $config.accept_county == 'Y'}onchange="javascript:  cascadeState(this.value,this.form.srchlookcountry.value);"{elseif $config.accept_city == '1' or $config.accept_city == 'Y'}onchange="javascript:  cascadeCounty('AA',this.form.srchlookcountry.value, this.value);"{elseif $config.accept_zipcode == '1' or $config.accept_zipcode == 'Y'}onchange="javascript:  cascadeCity('AA',this.form.srchlookcountry.value, this.value,'AA');" {/if} >
					{html_options options=$lang.lookstates selected=$advsearch.srchlookstate_province}
					</select>
				{else}
					<input name="srchlookstate_province" class="textinput" value="{if $advsearch.srchlookstate_province!='AA'}{$advsearch.srchlookstate_province}{/if}" size="30" maxlength="200"/>
				{/if}
					</td>
				</tr>
			{/if}
			{if $config.accept_county == 'Y' or $config.accept_county == '1'}
			{* State may be acceptable, county may not be.. trickier, trickier.. *}
				<tr>
					<td >{lang mkey='manage_counties'}:
					</td>
					<td  id="srchlookcounty">
				{ if $lang.lookcounties|@count > 0}
					<select class="select" style="width: 175px" name="srchlookcounty"  {if $config.accept_city == '1' or $config.accept_city == 'Y'}onchange="javascript:  cascadeCounty(this.value, this.form.srchlookcountry.value,  this.form.srchlookstate_province.value);"{elseif $config.accept_zipcode == '1' or $config.accept_zipcode == 'Y'}onchange="javascript:  cascadeCity('AA', this.form.srchlookcountry.value, this.form.srchlookstate_province.value, this.value);" {/if}>
					{html_options options=$lang.lookcounties selected=$advsearch.srchlookcounty}
					</select>
				{ else }
					<input name="srchlookcounty" type="text" class="textinput" size="30" maxlength="100" value="{if $advsearch.srchlookcounty != 'AA'}{$advsearch.srchlookcounty}{/if}"/>
				{ /if}
					</td>
				</tr>
			{/if}
			{if $config.accept_city == 'Y' or $config.accept_city == '1' }
			{* State may be, but city may not be. Any clue... *}
				<tr>
					<td >
						{lang mkey='signup_city'}
					</td>
					<td  id="srchlookcity">
				{ if $lang.lookcities|@count > 0}
					<select class="select" style="width: 175px" name="srchlookcity" {if $config.accept_zipcode == '1' or $config.accept_zipcode == 'Y'}{if $config.accept_county =='1' or $config.accept_county =='Y'}onchange="javascript:  cascadeCity(this.value, this.form.srchlookcountry.value, this.form.srchlookstate_province.value, this.form.srchcounty.value);"{else}onchange="javascript:  cascadeCity(this.value, this.form.srchlookcountry.value, this.form.srchlookstate_province.value, 'AA');"{/if} {/if}>
					{html_options options=$lang.lookcities selected=$advsearch.srchlookcity}
					</select>
				{ else }
					<input name="srchlookcity" type="text" class="textinput" size="30" maxlength="100" value="{if $advsearch.srchlookcity!='AA'}{$advsearch.srchlookcity}{/if}"/>
				{ /if}
					</td>
				</tr>
			{/if}
			{if $config.accept_zipcode == 'Y' or $config.accept_zipcode == '1'}
			{* OK. I am out..  Not zip code, also bypass radius .. hurray... *}
				<tr>
					<td >
						{lang mkey='signup_zip'}
					</td>
					<td nowrap id="srchlookzip">
				{ if $lang.lookzipcodes|@count > 0}
					<select class="select" style="width: 100px" name="srchlookzip">
					{html_options options=$lang.lookzipcodes selected=$advsearch.srchlookzip}
					</select>
				{ else }
					<input name="srchlookzip" type="text" class="textinput" size="10" maxlength="100" value="{if $advsearch.srchlookzip!='AA'}{$advsearch.srchlookzip}{/if}" />
				{ /if}
					</td>
				</tr>
				<tr>
					<td colspan="2" align="left">

				<div id="zipsavailable" style="margin-top:6px;">  
					{if $zipsavailable > 0}
					<table width="100%"  border=0 cellspacing="0" cellpadding="0">
						<tr>
						<td width="25%">
							{lang mkey='search_within'}:
						</td>
						<td width="75%" >
						<table border="0" cellspacing="0" cellpadding="0" width="100%">
							<tr>
								<td valign="middle" width="15" style="padding-left:2px;">
									<input name="srchradius" value="{$advsearch.srchradius}" type="text" class="textinput" size="5" maxlength="10" />
								</td>
								<td valign="middle" width="6">
									<input type=radio name="radiustype" value="miles" {if $advsearch.radiustype=='miles'} CHECKED {/if} />
								</td>
								<td width="15" valign="middle">{lang mkey='miles'}
								</td>
								<td valign="middle" width="6">
									<input type=radio name="radiustype" value="kms" {if $advsearch.radiustype=='kms'} CHECKED {/if} />
								</td>
								<td width="20" valign="middle">{lang mkey='kms'}
								</td>
								<td valign="middle">
									{lang mkey='of_zip_code'}
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
			{/if}
		{/if}
			</table>
			<table   border="0" cellspacing="{$config.cellspacing}" cellpadding="{$config.cellpadding}" width="100%">
				<tr>
					<td valign="middle" width="25%">{lang mkey='search_with_photo'}:</td>
					<td valign="middle" width="75%">
					<input type="checkbox" name="with_photo" value="1" {if $advsearch.with_photo == '1'}checked="checked"{/if} />
					</td>
				</tr>
				<tr>
					<td valign="middle">{lang mkey='search_with_video'}:</td>
					<td valign="middle">
					<input type="checkbox" name="with_video" value="1" {if $advsearch.with_video == '1'}checked="checked"{/if} />
					</td>
				</tr>
				<tr>
					<td valign="middle">{lang mkey='who_is_online'}:</td>
					<td valign="middle">
					<input type="checkbox" name="who_is_online" value="1" {if $advsearch.who_is_online == '1'}checked="checked"{/if} />
					</td>
				</tr>
			</table>
	{else}
	{*Outer Loop to traverse outer dimension data array*}
			<table   border="0" cellspacing="{$config.cellspacing}" cellpadding="{$config.cellpadding}" width="100%">
	{foreach item=questionrow from=$data}
	{* added to solve the deselection of items from saved search *}
		{if $questionrow.id != 5 and $questionrow.id != 27}
			{if $advsearch.question[$questionrow.id]|@count > 0}
			<input type="hidden" name="selected_questions[]" value="{$questionrow.id}" />
			{/if}
			{if $questionrow.control_type != "textarea"}
				<tr>
					<td width="33%" valign="top">
						<b>{$questionrow.question}</b>
					</td>
					<td width="67%" valign="top" >
						<table   border="0" cellspacing="{$config.cellspacing}" cellpadding="{$config.cellpadding}" width="100%">
						{assign var="mcount" value="0"}
						{foreach key=rkey item=curropt from=$questionrow.options}
							{if $mcount == 0 }
							<tr>
							{/if}
							{if $questionrow.options|@count < 6}
							{* Only one option per row *}
							{math equation="$mcount+1" assign="mcount"}
							{/if}
							{math equation="$mcount+1" assign="mcount"}
								<td width="50%">
									<table border="0" cellspacing="0" cellpadding="0" width="100%">
									<tr><td width="5%" valign="top">
									<input name=
									"question[{$questionrow.id}][]" type="checkbox" value="{$rkey}"
									{foreach from=$advsearch.question[$questionrow.id] item=sel}
										{if $sel== $rkey}
										 CHECKED
										{/if}
									{/foreach}
									/>
									</td>
									<td  width="95%" valign="middle" align="left" >
										{$curropt|stripslashes}
									</td>
									</tr>
									</table>
								</td>
							{if $mcount == 2 }
							{assign var="mcount" value="0"}
							</tr>
							{/if}
						{/foreach}
						{if $mcount == 1}
							</tr>
						{/if}
						</table>
					</td>
				</tr>
			{/if}
		{else}
		{* Height and weight question *}
				<tr>
					<td width="33%" valign="top">
						<b>{$questionrow.question}</b>
					</td>
					<td width="67%" valign="top" nowrap>
						{lang mkey='between1'}&nbsp;
						<select name="question[{$questionrow.id}][]" >
						<option value='' selected>{lang mkey='select_from_list'}</option>
						{html_options options=$questionrow.options selected=$advsearch.question[$questionrow.id][0]}
						</select>&nbsp; {lang mkey='and'}&nbsp;
						<select name="question[{$questionrow.id}][]" >
						<option value='' selected>{lang mkey='select_from_list'}
						</option>
						{html_options options=$questionrow.endoptions selected=$advsearch.question[$questionrow.id][1]}
						</select>
					</td>
				</tr>
		{/if}
	{/foreach}
			</table>
	{/if}
			<table width="100%">
				<tr>
					<td width="20%">&nbsp;</td>
					<td width="80%">
						<input name="advsearch" type="submit" class="formbutton" value="{lang mkey='search'}" />  <input type="button" class="formbutton" value="{lang mkey='continue'}" onclick="javascript: document.{$frmname}.sectionid.value= {$nextsectionid}; document.{$frmname}.submit();" /> <input type="reset" class="formbutton" value="{lang mkey='reset'}" />
					</td>
				</tr>
			</table>
		</div>
	</div>
</div>
</form>
<br />
{/strip}
