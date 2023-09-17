{strip}
<div class="module_detail">
	<div class="module_head" style="padding-left: 6px; height:14px; padding-top:2px; padding-bottom:2px;" align="center">
		{$item.username}
	</div>
	<div style="text-align:center;margin-top:2px; " class="smallest_profiles">
		{$item.age} {mylang mkey='signup_gender_values' skey=$item.gender},<br />
		{$item.countryname}
	</div>
	<div style="text-align:center;margin-top:2px;">
		{if $linkis == "profpic"}
			{if ($smarty.session.UserId != '' && $smarty.session.security.seepictureprofile == 1) or $smarty.session.UserId == ''}
				{if $config.enable_mod_rewrite == 'Y'}
					<a href="javascript:popUpScrollWindow2('{$docroot}{if $smarty.session.AdminId > 0}{$smarty.const.ADMIN_DIR}{/if}{if $config.seo_username == 'Y'}{$item.username}{else}{$item.id}.htm{/if}','center',650,600)" class="textcolor">
				{else}
					<a href="javascript:popUpScrollWindow2('{$docroot}{if $smarty.session.AdminId > 0}{$smarty.const.ADMIN_DIR}{/if}showprofile.php?id={$item.id}','center',650,600)" class="textcolor">
				{/if}
				<img src="getsnap.php?id={$item.id}&amp;typ=tn&amp;height=100&amp;picid={$item.picno}" class="smallpic" alt="" />
			</a>
			{/if}
		{else}
		{* Birthday display. No need to display profile *}
			<a href="{$docroot}send_birthday_message.php?id={$item.id}" class="textcolor">
			<img src="getsnap.php?id={$item.id}&amp;typ=tn&amp;height=100" class="smallpic" alt="" />
			</a>
		{/if}
	</div>
</div>
{/strip}
