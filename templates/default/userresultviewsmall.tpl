{strip}
<div class="module_detail_inside" >
	{assign var="page_hdr02_text" value=$item.username}
	{include file="page_hdr02.tpl"}
	<div>
	<div style="width:59%; margin-top: 2px; padding-bottom: 2px; display:inline; float:left; text-align:left; ">
		{include file="userresultviewsmall_address.tpl"}
	</div>
	<div  style="width:40%; display:inline; float:left; margin-left: 1px; margin-top: 2px; padding-bottom: 2px;  ">
		<div style="vertical-align:middle; text-align:center;">
			{if ($smarty.session.UserId != '' && $smarty.session.security.seepictureprofile == 1) or $smarty.session.UserId == ''}
				{if $config.enable_mod_rewrite == 'Y'}
					<a href="javascript:popUpScrollWindow2('{$docroot}{if $smarty.session.AdminId > 0}{$smarty.const.ADMIN_DIR}{/if}{if $config.seo_username == 'Y'}{$item.username}{else}{$item.id}.htm{/if}','top',650,600)">
				{else}
					<a href="javascript:popUpScrollWindow2('{$docroot}{if $smarty.session.AdminId > 0}{$smarty.const.ADMIN_DIR}{/if}showprofile.php?id={$item.id}','top',650,600)">
				{/if}
					<img src="getsnap.php?id={$item.id}&amp;typ=tn" class="smallpic" alt="" />
					</a>
			{/if}
		</div>
		<div style="text-align:center; ">
			{checkuser userid=$item.id checkfor='picscnt' }
		</div>
	</div>
	</div>
	<div style="clear:both; margin-left: 6px; margin-top: 2px; padding-bottom: 2px;">
	{if $config.about_me_in_smallprofile == 'Y' && $item.about_me != ''}
		{$item.about_me|stripslashes|truncate:34:" ...":true}
		<br /><br />
	{/if}
		<center>{checkuser userid=$item.id checkfor='online'}</center>
	</div>
	<div style="height: 20px; text-align:center; margin-top: 2px;" class="statusbar">
	{if $config.enable_mod_rewrite == 'Y'}
		<a href="javascript:popUpScrollWindow2('{$docroot}{if $smarty.session.AdminId > 0}{$smarty.const.ADMIN_DIR}{/if}{if $config.seo_username == 'Y'}{$item.username}{else}{$item.id}.htm{/if}','top',650,600)">
	{else}
		<a href="javascript:popUpScrollWindow2('{$docroot}{if $smarty.session.AdminId > 0}{$smarty.const.ADMIN_DIR}{/if}showprofile.php?id={$item.id}','top',650,600)">
	{/if}
		{lang mkey='view_profile'}</a>
	{if $smarty.session.security.message == 1 && $item.id != $smarty.session.UserId && $smarty.session.UserId != '' }
		&nbsp;&nbsp;{checkuser username=$item.username checkfor='send_message' userid=$item.id }
	{/if}
	{if $smarty.session.UserId == '' && $smarty.session.AdminId > 0 }
		&nbsp;&nbsp;<a href="{$docroot}{$smarty.const.ADMIN_DIR}profile.php?edit={$item.id}">{lang mkey='edit_profile'}</a>
	{/if}
	</div>
</div>
<br />
{/strip}
