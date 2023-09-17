<table border="0" cellspacing="2" cellpadding="1" width="100%" >
	<tr class="line_top_bottom_pad">
		<td valign="top" width="45%"><b>{lang mkey='age'}:</b></td>
		<td valign="top" width="55%">{$item.age}</td>
	</tr>
	<tr class="line_top_bottom_pad">
		<td valign="top"><b>{lang mkey='sex'}</b></td>
		<td valign="top">{mylang mkey='signup_gender_values' skey=$item.gender}</td>
	</tr>
	{if $config.accept_lookgender == 'Y' or $config.accept_lookgender == '1'}
	{* Display only if lookgender is accepted *}
	<tr class="line_top_bottom_pad">
		<td valign="top"><b>{lang mkey='looking_for'}:</b></td>
		<td valign="top">{mylang mkey='signup_gender_look' skey=$item.lookgender}</td>
	</tr>
	{/if}
	{if $config.accept_country == 'Y' or $config.accept_country == '1'}
	{* Display only if country is accepted  *}
	<tr class="line_top_bottom_pad">
		<td valign="top"><b>{lang mkey='location_col'}</b></td>
		<td valign="top">
			{if $item.city != ''}
				{get_cityname city=$item.city state=$item.state_province country=$item.country county=$item.county}, <br />
			{/if}
			{if $item.statename != '' and $item.statename !='-1'}
				{$item.statename}, <br />
			{/if}
			{if $item.countryname != ''}
				{$item.countryname}
			{/if}
		</td>
	</tr>
	{/if}
</table>