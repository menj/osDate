<div class="module_detail_inside" style="width:99%;">
	<div class="module_head">
		<table width="100%" border="0" cellpadding="0" cellspacing="0" >
			<tr>
				<td class="module_head" width="6" height="23"></td>
				<td class="module_head" valign="middle" width="100%" height="23" >
					<div class="module_head">
					&nbsp;&nbsp;{$item.username}
					</div>
				</td>
				<td width="28" class="module_head"><img src="#SiteUrl#templates/#SkinName#/images/blue_hor2.jpg" width="28" height="23" alt="" /></td>
			</tr>
		</table>
	</div>
	<div style="width:100%; vertical-align:top;">
		<div style="width:55%; float:left; display:inline; ">
			<table border="0" width="100%">
				<tbody>
					<tr class="evenrow"><div class="evenrow">
						<td valign="top" ><b>{lang mkey='age'}:</b></td>
						<td>{$item.age}</td>
						</div>
					</tr>
					<tr class="oddrow">
						<div class="oddrow">
						<td valign="top" ><b>{lang mkey='sex'}</b></td>
						<td>{mylang mkey='signup_gender_values' skey=$item.gender}</td>
						</div>
					</tr>
					{if $config.accept_lookgender == 'Y' or $config.accept_lookgender == '1'}
				{* Display only if lookgender is accepted *}
					<tr class="evenrow">
						<div class="evenrow">
						<td valign="top" ><b>{lang mkey='looking_for'}:</b></td>
						<td>{mylang mkey='signup_gender_look' skey=$item.lookgender}</td>
						</div>
					</tr>
					{/if}
					{if $config.accept_country == 'Y' or $config.accept_country == '1'}
				{* Display only if country is accepted  *}
					<tr class="oddrow">
						<div class="oddrow">
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
						</div>
					</tr>
					{/if}
				</tbody>
			</table>
		</div>
		<div style="width:44%; float:right; display:inline;" align="center">
			<a href="#SiteUrl#showprofile.php?{if $config.seo_username == 'Y'}username={$item.username}{else}id={$item.id}{/if}">
			<img src="#SiteUrl#getsnap.php?id={$item.id}&amp;typ=tn" class="smallpic" alt="" /></a>
		</div>
		<div style="clear:both; width:100%; padding-top:2px;">
		{if $config.about_me_in_smallprofile == 'Y' && $item.about_me != ''}
			{$item.about_me|stripslashes}
		{/if}
		</div>
	</div>
</div>
<br />
