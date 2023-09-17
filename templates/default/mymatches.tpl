{strip}
<div style="vertical-align:top;" >
	{assign var="page_hdr01_text" value="{lang mkey='my_matches'}"}
	{assign var="page_title" value="{lang mkey='my_matches'}"}
	{include file="page_hdr01.tpl"}
	<div class="module_detail_inside">

		<div class="line_outer" style="padding-top:6px;">
			{lang mkey='your_search_preferences'}<br/><br />
			{lang mkey='i_am_a'}&nbsp;<b>{mylang mkey='signup_gender_values' skey=$user.gender}</b>&nbsp;{lang mkey='looking_for_a'}&nbsp;
			<b>{mylang mkey='signup_gender_look' skey=$user.lookgender}</b>&nbsp;{lang mkey='Between'}&nbsp;<b>{$user.lookagestart}</b>&nbsp;{lang mkey='and'}&nbsp;<b>{$user.lookageend}</b>,&nbsp;
			{if $user.lookcountry != 'AA' && $lang.countries[$user.lookcountry] != '' }
				{lang mkey='who_is_from'}&nbsp;<b>{$user.lookcountryname}</b>
			{elseif $user.lookcountry == 'AA'}
				{lang mkey='who_is_from'}&nbsp;{lang mkey='any_where'}
			{/if}
			{if $user.lookstatename != '' && $user.lookstatename != 'AA'}
				, <b>{$user.lookstatename}</b>
			{/if}
			{if $user.look_cityname != '' && $user.look_cityname != 'AA'}
				, <b>{$user.look_cityname}</b>
			{/if}
			{if $user.lookzip != '' && $user.lookzip != 'AA'}
				, <b>{$user.lookzip}</b>
			{/if}
			{if $user.lookradius != '' && $user.lookzip != 'AA'}
				&nbsp;{lang mkey='searching_within'} {$user.lookradius} {mylang mkey=$user.radiustype} {lang mkey='of'}{$user.lookzip}
			{/if}
		</div>
		<div class="line_outer" style="margin-top: 6px;">
			<center><a href="editmymatches.php">{lang mkey='click_here'}</a>&nbsp;{lang mkey='to_edit_search_preferences'}
			</center>
		</div>
	{if $error == 1 }
		<div class="line_outer" style="margin-top: 6px;">
			{lang mkey='no_record_found'}
		</div>
	{else}
		<div class="line_outer" align="center">
			{lang mkey='results_per_page'}&nbsp;&nbsp;
			<select name="results_per_page" id="results_per_page">
				{html_options options=$lang.search_results_per_page selected=$psize}
			</select>&nbsp;
			<input type="button" class="formbutton" value="{lang mkey='show'}" onclick="document.location='?{$querystring}&amp;results_per_page=' + document.getElementById('results_per_page').value"/>
		</div>
		<div class="line_outer">
			{lang mkey='total_profiles_found'}&nbsp;{$totalrecs}&nbsp;&nbsp;&nbsp;
			{assign var="totl" value=$data|@count}
			{lang mkey='showing'}&nbsp;{$start+1}{lang mkey='to'}{$start+$totl}
		</div>
		<div class="line_outer">
			{assign var="ccount" value="0"}
		{if $config.mymatches_display == 'tiny'}
			{foreach item=item key=key from=$data}
			{if $ccount==0}
				<div style="padding-bottom:4px; align:left;">
			{/if}
				<div style="width:19.1%; display:inline; float:left; {if $ccount == 0}padding-right:3px;{/if}">
					{include file="smallprofile.tpl"}
				</div>
			{assign var="ccount" value=$ccount+1}
			{if $ccount==5}
					<div style="clear:both;"></div>
				</div>
				{assign var='ccount' value=0}
			{/if}
			{/foreach}
			{if $ccount>0}
					<div style="clear:both;"></div>
				</div>
			{/if}
		{else}
			{foreach item=item key=key from=$data}
			{if $ccount==0}
				<div style="padding-bottom:4px; align:left;">
			{/if}
				<div style="width:49.5%; display:inline; float:left; {if $ccount == 0}padding-right:3px;{/if}">
					{include file="userresultviewsmall.tpl"}
				</div>
			{assign var="ccount" value=$ccount+1}
			{if $ccount==2}
					<div style="clear:both;"></div>
				</div>
				{assign var='ccount' value=0}
			{/if}
			{/foreach}
			{if $ccount==1}
					<div style="clear:both;"></div>
				</div>
			{/if}
		{/if}
		</div>
	{/if}
	{if $pages != ''}
		<div class="line_outer" align="center">
		{if $prev != "" }
			<a href="?page={$prev}&amp;{$querystring}" > {lang mkey='previous'}</a>&nbsp;
		{/if}
		{if $cpage != "" && $pages != "" }
			&nbsp;{lang mkey='page'}&nbsp;{$cpage}{lang mkey='of'}{$pages}&nbsp;
		{/if}
		{if $next != "" }
			&nbsp;<a href="?page={$next}&amp;{$querystring}" >{lang mkey='next'}</a>
		{/if}
		</div>
	{/if}
	</div>
</div>
{/strip}
