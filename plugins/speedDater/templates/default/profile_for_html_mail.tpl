{strip}

<table width="270" border="0" cellpadding="0" cellspacing="0" >
	<tr>
		<td class="module_detail_inside" width="100%" >

			<table width="100%" border="0" cellpadding="0" cellspacing="0" >
				<tr>
					<td class="module_head" width="6" height="23">&nbsp;</td>
					<td class="module_head" valign="middle" width="100%" height="23">
					{$item.username}
					</td>
				</tr>
			</table>

			<table border="0" width="100%">
				<tr>
					<td valign="top">
						<table border="0" width="100%">
							<tbody>
								<tr class="evenrow">
									<td valign="top" ><b>{lang mkey='age'}:</b></td>
									<td>{$item.age}</td>
								</tr>
								<tr class="oddrow">
									<td valign="top" ><b>{lang mkey='sex'}</b></td>
									<td>{mylang mkey='signup_gender_values' skey=$item.gender}</td>
								</tr>
								{if $config.accept_lookgender == 'Y' or $config.accept_lookgender == '1'}
							{* Display only if lookgender is accepted *}
								<tr class="evenrow">
									<td valign="top" ><b>{lang mkey='looking_for'}:</b></td>
									<td>{mylang mkey='signup_gender_look' skey=$item.lookgender}</td>
								</tr>
								{/if}
								{if $config.accept_country == 'Y' or $config.accept_country == '1'}
							{* Display only if country is accepted  *}
								<tr class="oddrow">
									<td valign="top" ><b>{lang mkey='location_col'}</b></td>
									<td>{if $item.city != ''}
										{get_cityname city=$item.city state=$item.state_province country=$item.country county=$item.county},<br />
									{/if}
									{if $item.statename != ''}
										{$item.statename},<br />
									{/if}
									{if $item.countryname != ''}
										{$item.countryname}
									{/if}</td>
								</tr>
								{/if}
							</tbody>
						</table>
					</td>
					<td>
						<table border="0">
							<tbody>
							<tr>
								<td width="100" valign="middle" align="center">
								<img src="#SiteUrl#/getsnap.php?id={$item.id}&amp;typ=tn" class="smallpic" alt="" />
								</td>
							</tr>
							</tbody>
						</table>
					</td>
				</tr>
				{if $config.about_me_in_smallprofile == 'Y' && $item.about_me != ''}
				<tr>
					<td colspan="2" >
						{$item.about_me|stripslashes}
					</td>
				</tr>
				{/if}
			</table>
		</td>
	</tr>
</table>
<br />
{/strip}