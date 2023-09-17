{strip}

<div class="module_detail_inside" style="width:99%">
	{assign var="page_hdr02_text" value=$item.username}
	{include file="page_hdr02.tpl"}
	<div style="width:55%; margin-top: 2px; margin-bottom: 2px; display:inline; float:left; text-align:left;">
		<div class="oddrow" style="clear:both; margin-left: 6px;">
			<div style="width:50%;display:inline; float:left;"><b>{lang mkey='age'}:</b></div>
			<div  style="display:inline; float:left; ">{$item.age}</div>
		</div>
		<div class="evenrow" style="clear:both;margin-left: 6px;">
			<div style="width:50%;display:inline; float:left;"><b>{lang mkey='sex'}</b></div>
			<div style="display:inline; float:left; ">{mylang mkey='signup_gender_values' skey=$item.gender}</div>
		</div>
	{if $config.accept_lookgender == 'Y' or $config.accept_lookgender == '1'}
	{* Display only if lookgender is accepted *}
		<div class="oddrow" style="clear:both; margin-left: 6px;">
			<div style="width:50%; display:inline; float:left;"><b>{lang mkey='looking_for'}:</b></div>
			<div style=" display:inline; float:left;">{mylang mkey='signup_gender_look' skey=$item.lookgender}</div>
		</div>
	{/if}
	{if $config.accept_country == 'Y' or $config.accept_country == '1'}
	{* Display only if country is accepted  *}
		<div class="evenrow" style="clear:both; clear:both; margin-left: 6px; text-align:left;">
			<div style="width:50%; display:inline; float:left;"><b>{lang mkey='location_col'}</b></div>
			<div style="display:inline; float:left;">
			{if $item.city != ''}
				{get_cityname city=$item.city state=$item.state_province country=$item.country county=$item.county},<br />
			{/if}
			{if $item.statename != ''  and $item.statename !='-1'}
				{$item.statename},<br />
			{/if}
			{if $item.countryname != ''}
				{$item.countryname}
			{/if}
			</div>
		</div>
	{/if}
	</div>
	<div  style="width:40%; display:inline; float:left; margin-left: 1px; margin-top: 2px; margin-bottom: 2px; ">
		<div style="vertical-align:middle; text-align:center;">
			{if ($smarty.session.UserId != '' && $smarty.session.security.seepictureprofile == 1) or $smarty.session.UserId == ''}
				{if $config.enable_mod_rewrite == 'Y'}
					<a href="javascript:popUpScrollWindow2('{$docroot}{if $smarty.session.AdminId > 0}{$smarty.const.ADMIN_DIR}{/if}{if $config.seo_username == 'Y'}{$item.username}{else}{$item.id}.htm{/if}','top',650,600)">
				{else}
					<a href="javascript:popUpScrollWindow2('{$docroot}{if $smarty.session.AdminId > 0}{$smarty.const.ADMIN_DIR}{/if}showprofile.php?{if $config.seo_username == 'Y'}username={$item.username}{else}id={$item.id}{/if}','top',650,600)">
				{/if}
					<img src="getsnap.php?id={$item.id}&amp;typ=tn" class="smallpic" alt="" />
					</a>
			{/if}
		</div>
		<div style="text-align:center; ">
			{checkuser userid=$item.id checkfor='picscnt' }
		</div>
	</div>
	<div style=" clear:both; margin-left: 6px; margin-top: 2px; margin-bottom: 2px;">
	{if $config.about_me_in_smallprofile == 'Y' && $item.about_me != ''}
		{$item.about_me|stripslashes|truncate:34:" ...":true}
		<br /><br />
	{/if}
		<center>{checkuser userid=$item.id checkfor='online'}</center>
	</div>
	<div style=" line-height: 20px; text-align:center; margin-top: 2px; margin-bottom: 2px;" class="statusbar">
	{if $config.enable_mod_rewrite == 'Y'}
		<a href="javascript:popUpScrollWindow2('{$docroot}{if $smarty.session.AdminId > 0}{$smarty.const.ADMIN_DIR}{/if}{if $config.seo_username == 'Y'}{$item.username}{else}{$item.id}.htm{/if}','top',650,600)">
	{else}
		<a href="javascript:popUpScrollWindow2('{$docroot}{if $smarty.session.AdminId > 0}{$smarty.const.ADMIN_DIR}{/if}showprofile.php?{if $config.seo_username == 'Y'}username={$item.username}{else}id={$item.id}{/if}','top',650,600)">
	{/if}
		{lang mkey='view_profile'}</a>
		&nbsp;&nbsp;&nbsp;
		<a href="profile.php?edit={$item.id}">{lang mkey="edit_profile"}</a>
	</div>
</div>
<br />
{/strip}
