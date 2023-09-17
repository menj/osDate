<table border="0" cellspacing="3" cellpadding="1" width="100%">
	<tr class="signup_line_outer oddrow" >
		<td >
				<b>{lang mkey='age'}:</b>
		</td>
		<td >
			{$user.age}
		</td>
	</tr>
	<tr class="signup_line_outer evenrow" >
		<td >
			<b>{lang mkey='sex'}</b>
		</td>
		<td >
			{mylang mkey='signup_gender_values' skey=$user.gender}
			{if ($user.gender == 'C' or $user.gender =='G') && $user.cplusers|@count > 0}
			&nbsp;(
				{foreach from=$user.cplusers key=k item=usr}
					{if $k > 0}, {/if}
					{if $config.enable_mod_rewrite == 'Y'}
						<a href="javascript:popUpScrollWindow2('{$docroot}{if $config.seo_username == 'Y'}{$usr.username}{else}{$usr.uid}.htm{/if}','top',650,600)">
					{else}
						<a href="javascript:popUpScrollWindow2('{$docroot}showprofile.php?{if $config.seo_username == 'Y'}username={$usr.username}{else}id={$usr.uid}{/if}','top',650,600)">
					{/if}
					{$usr.username}
					</a>
				{/foreach}
				)
			{/if}
		</td>
	</tr>
{if $config.accept_lookgender == 'Y' or $config.lookgender == '1'}
{* Display only if the lookgender is acceptable *}
	<tr class="signup_line_outer oddrow" >
		<td >
			<b>{lang mkey='looking_for'}:</b>
		</td>
		<td >
			{mylang mkey='signup_gender_look' skey=$user.lookgender}
		</td>
	</tr>
{/if}
{if $config.accept_country == 'Y' or $config.accept_country == '1'}
{* Display only if contry is accepted *}
	<tr class="signup_line_outer evenrow" >
		<td >
			<b>{lang mkey='location_col'}</b>
		</td>
		<td >
		{if $user.city != '' && $user.city != '-1'}
			{get_cityname city=$user.city state=$user.state_province country=$user.country county=$user.county},&nbsp;
		{/if}
		{if $user.statename != '' && $user.statename != '-1'}
			{$user.statename},&nbsp;
		{/if}
		{if $user.countryname != ''}
			{$user.countryname}
		{/if}
		</td>
	</tr>
{/if}
	<tr class="signup_line_outer oddrow" >
		<td >
			<b>{lang mkey='picsloaded'}:</b>
		</td>
		<td >
			{checkuser userid=$user.id checkfor='picscnt'}
		</td>
	</tr>
	<tr class="signup_line_outer evenrow" >
		<td >
			<b>{lang mkey='albumsloaded'}:</b>
		</td>
		<td >
			{checkuser userid=$user.id checkfor='albumscnt'}
		</td>
	</tr>
	<tr class="signup_line_outer oddrow" >
		<td >
			<b>{lang mkey='videos_loaded'}:</b>
		</td>
		<td >
			{checkuser userid=$user.id checkfor='videoscnt'}
		</td>
	</tr>
{if $config.about_me_in_smallprofile == 'Y' && $user.about_me != ''}
	<tr class="signup_line_outer evenrow" >
		<td >
			<b>{lang mkey='about_me'}:</b>
		</td>
		<td >
			{$user.about_me|nl2br|stripslashes}
		</td>
	</tr>
{/if}
</table>