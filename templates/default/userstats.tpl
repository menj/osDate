{strip}
{if $showhead != ''}
	{assign var="page_hdr02_text" value=$showhead }
{else}
	{assign var="page_hdr02_text" value="{lang mkey='user_stats'}"}
{/if}
{include file="page_hdr02.tpl"}
<div class="module_detail_inside">
	{if $show != ''  }
		<div class="line_outer">
			<div style="padding-top:2px; vertical-align:middle;">
				<div style="display:inline; float:left; width:50%;">
					{lang mkey='total_profiles_found'}&nbsp;{$totalrecs}
				</div>
				<div style="display:inline; float:right; text-align:right; margin-right: 10px;">
					<form action="userstats.php?show={$show}" method="post">
					{lang mkey='results_per_page'}&nbsp;
					<select name="results_per_page">
						{html_options options=$lang.search_results_per_page selected=$psize}
					</select>
					&nbsp;<input type="submit" name="page_limit" class="formbutton" value="{lang mkey='show'}" />
					</form>
				</div>
				<div style="clear:both;"></div>
			</div>
			<div style="margin-top: 4px;">
			{assign var="ccount" value="0"}
			{foreach item="item" key=key from=$data}
			{if $ccount==0}
				<div>
			{/if}
				<div style="display:inline; float:left; width:49%; vertical-align:top; margin-top:2px; margin-left: 1px;">
					{include file="userresultviewsmall.tpl"}
				</div>
			{if $ccount==1}
					<div style="clear:both;"></div>
				</div>
			{/if}
				{math equation="$ccount+1" assign="ccount"}
				{math equation="$ccount%2" assign="ccount"}
			{/foreach}
			{if $ccount==1}
					<div style="clear:both;"></div>
				</div>
			{/if}
			<div style="clear:both;"></div>
			</div>
		</div>
		{if $pages neq ""}
			<div class="line_outer" align="center">
			{if $prev != "" }
				<a href="userstats.php?show={$show}&amp;page={$prev}
				" >&lt;-- {lang mkey='previous'}</a>&nbsp;&nbsp;
			{/if}
			{if $cpage != "" && $pages != "" }
				{lang mkey='pageno'} {$cpage} {lang mkey='of'} {$pages}
			{/if}
			{if $next != "" }
				&nbsp;&nbsp;<a href="userstats.php?show={$show}&amp;page={$next}">{lang mkey='next'} --&gt;</a>
			{/if}
			</div>
		{/if}

	{else}

		<table align="center" width="100%" cellspacing="5" cellpadding="1" border="0">
			<tr><td><strong>{lang mkey='your_user_stats'}</strong></td></tr>
			<tr><td><br /></td></tr>
			{if $number_matches}
				<tr class="evenrow"><td><a href="userstats.php?show=match">{lang mkey='users_match_your_search'}:</a></td><td>{$number_matches}</td></tr>
			{else}
				<tr class="evenrow"><td>{lang mkey='users_match_your_search'}:</td><td>{$number_matches}</td></tr>
			{/if}
			{if $config.accept_country == 'Y' or $config.accept_country =='1'}
			{if $same_country}
				<tr class="oddrow"><td><a href="userstats.php?show=samecountry">{lang mkey='in_your_country'}:</a></td><td>{$same_country}</td></tr>
			{else}
				<tr class="oddrow"><td>{lang mkey='in_your_country'}:</td><td>{$same_country}</td></tr>
			{/if}
			{/if}
			{if $config.accept_state == 'Y' or $config.accept_state =='1'}
			{if $same_state}
				<tr class="evenrow"><td><a href="userstats.php?show=samestate">{lang mkey='in_your_state'}:</a></td><td>{$same_state}</td></tr>
			{else}
				<tr class="evenrow"><td>{lang mkey='in_your_state'}:</td><td>{$same_state}</td></tr>
			{/if}
			{/if}
			{if $config.accept_county == 'Y' or $config.accept_county =='1'}
			{if $same_county}
				<tr class="oddrow"><td><a href="userstats.php?show=samecounty">{lang mkey='in_your_county'}:</a></td><td>{$same_county}</td></tr>
			{else}
				<tr class="oddrow"><td>{lang mkey='in_your_county'}:</td><td>{$same_county}</td></tr>
			{/if}
			{/if}
			{if $config.accept_city == 'Y' or $config.accept_city =='1'}
			{if $same_city}
				<tr class="evenrow"><td><a href="userstats.php?show=samecity">{lang mkey='in_your_city'}:</a></td><td>{$same_city}</td></tr>
			{else}
				<tr class="evenrow"><td>{lang mkey='in_your_city'}:</td><td>{$same_city}</td></tr>
			{/if}
			{/if}
			{if $config.accept_zipcode == 'Y' or $config.accept_zipcode =='1'}
			{if $same_zip}
				<tr class="oddrow"><td><a href="userstats.php?show=samezip">{lang mkey='in_your_zip'}:</a></td><td>{$same_zip}</td></tr>
			{else}
				<tr class="oddrow"><td>{lang mkey='in_your_zip'}:</td><td>{$same_zip}</td></tr>
			{/if}
			{/if}
			{if $same_sex}
				<tr class="evenrow"><td><a href="userstats.php?show=samegender">{lang mkey='in_same_gender'}:</a></td><td>{$same_sex}</td></tr>
			{else}
				<tr class="evenrow"><td>{lang mkey='in_same_gender'}:</td><td>{$same_sex}</td></tr>
			{/if}
			{if $same_age}
				<tr class="oddrow"><td><a href="userstats.php?show=sameage">{lang mkey='in_same_age'}:</a></td><td>{$same_age}</td></tr>
			{else}
				<tr class="oddrow"><td>{lang mkey='in_same_age'}:</td><td>{$same_age}</td></tr>
			{/if}
			<tr><td><br /></td></tr>
			<tr><td><strong>{lang mkey='other_user_stats'}</strong></td></tr>
			<tr><td><br /></td></tr>
			{if $same_lookagestart}
				<tr class="oddrow"><td><a href="userstats.php?show=lookagestart">{lang mkey='above_lookagestart'}:</a></td><td>{$same_lookagestart}</td></tr>
			{else}
				<tr class="oddrow"><td>{lang mkey='above_lookagestart'}:</td><td>{$same_lookagestart}</td></tr>
			{/if}
			{if $same_lookageend}
				<tr class="evenrow"><td><a href="userstats.php?show=lookageend">{lang mkey='below_lookageend'}:</a></td><td>{$same_lookageend}</td></tr>
			{else}
				<tr class="evenrow"><td>{lang mkey='below_lookageend'}:</td><td>{$same_lookageend}</td></tr>
			{/if}
			{if $same_lookgender}
				<tr class="oddrow"><td><a href="userstats.php?show=lookgender">{lang mkey='your_lookgender'}:</a></td><td>{$same_lookgender}</td></tr>
			{else}
				<tr class="oddrow"><td>{lang mkey='your_lookgender'}:</td><td>{$same_lookgender}</td></tr>
			{/if}
			{if ($config.accept_country == 'Y' or $config.accept_country =='1') && ($config.accept_lookcountry == 'Y' or $config.accept_lookcountry =='1')}
			{if $same_lookcountry}
				<tr class="evenrow"><td><a href="userstats.php?show=lookcountry">{lang mkey='in_look_country'}:</a></td><td>{$same_lookcountry}</td></tr>
			{else}
				<tr class="evenrow"><td>{lang mkey='in_look_country'}:</td><td>{$same_lookcountry}</td></tr>
			{/if}
			{/if}
			{if ($config.accept_state == 'Y' or $config.accept_state =='1') && ($config.accept_lookstate == 'Y' or $config.accept_lookstate =='1')}
			{if $same_lookstate}
				<tr class="oddrow"><td><a href="userstats.php?show=lookstate">{lang mkey='in_look_state'}:</a></td><td>{$same_lookstate}</td></tr>
			{else}
				<tr class="oddrow"><td>{lang mkey='in_look_state'}:</td><td>{$same_lookstate}</td></tr>
			{/if}
			{/if}
			{if ($config.accept_county == 'Y' or $config.accept_county =='1') && ($config.accept_lookcounty == 'Y' or $config.accept_lookcounty =='1')}
			{if $same_lookcounty}
				<tr class="evenrow"><td><a href="userstats.php?show=lookcounty">{lang mkey='in_look_county'}:</a></td><td>{$same_lookcounty}</td></tr>
			{else}
				<tr class="evenrow"><td>{lang mkey='in_look_county'}:</td><td>{$same_lookcounty}</td></tr>
			{/if}
			{/if}
			{if ($config.accept_city == 'Y' or $config.accept_city =='1') && ($config.accept_lookcity == 'Y' or $config.accept_lookcity =='1')}
			{if $same_lookcity}
				<tr class="oddrow"><td><a href="userstats.php?show=lookcity">{lang mkey='in_look_city'}:</a></td><td>{$same_lookcity}</td></tr>
			{else}
				<tr class="oddrow"><td>{lang mkey='in_look_city'}:</td><td>{$same_lookcity}</td></tr>
			{/if}
			{/if}
			{if ($config.accept_zipcode == 'Y' or $config.accept_zipcode =='1') && ($config.accept_lookzipcode == 'Y' or $config.accept_lookzipcode =='1')}
			{if $same_lookzip}
				<tr class="evenrow"><td><a href="userstats.php?show=lookzip">{lang mkey='in_look_zip'}:</a></td><td>{$same_lookzip}</td></tr>
			{else}
				<tr class="evenrow"><td>{lang mkey='in_look_zip'}:</td><td>{$same_lookzip}</td></tr>
			{/if}
			{/if}
			{if $same_timezone}
				<tr class="oddrow"><td><a href="userstats.php?show=looktimezone">{lang mkey='in_same_timezone'}:</a></td><td>{$same_timezone}</td></tr>
			{else}
				<tr class="oddrow"><td>{lang mkey='in_same_timezone'}:</td><td>{$same_timezone}</td></tr>
			{/if}
		</table>
	{/if}
</div>
{/strip}