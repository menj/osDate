<table width="100%" cellspacing="0" cellpadding="0" border="0">
	<tr>
		<td class="panelbox_div" >
			<a class="panellink" href="{$docroot}index.php">{lang mkey='site_links' skey='home'}</a>
		</td>
	</tr>
	<tr>
		<td class="panelbox_div" >
			<a class="panellink" href="{$docroot}logout.php">{lang mkey='sign_out'}</a>
		</td>
	</tr>
{* My Profile *}
	<tr>
		<td class="panellinkhdr_div" >
			{lang mkey='myprofile'}
		</td>
	</tr>
	<tr>
		<td class="panelbox_div" >
		<a class="panellink"
		{if $config.enable_mod_rewrite == 'Y'}
			href="javascript:popUpScrollWindow2('{if $config.seo_username == 'Y'}{$smarty.session.UserName}{else}{$smarty.session.UserId}.htm{/if}','top',650,screen.height)">
		{else}
			href="javascript:popUpScrollWindow2('{$docroot}showprofile.php?{if $config.seo_username == 'Y'}username={$smarty.session.UserName}{else}id={$smarty.session.UserId}{/if}','top',650,screen.height)">
		{/if}
		{lang mkey='view_profile'}</a>
		</td>
	</tr>
{if $smarty.session.expired != 1 and $smarty.session.active == '1' }
	<tr>
		<td class="panelbox_div">
			<a class="panellink" href="{$docroot}edituser.php">{lang mkey='edit_profile'}</a>
		</td>
	</tr>
	<tr>
		<td class="panelbox_div">
			<a class="panellink" href="{$docroot}editquestions.php">{lang mkey='myprofilepreferences'}</a>
		</td>
	</tr>
	<tr>
		<td class="panelbox_div">
			<a class="panellink" href="{$docroot}editmymatches.php">{lang mkey='mysearchpreferences'}</a>
		</td>
	</tr>
{/if}
{if $smarty.session.expired != 1 and $smarty.session.active == '1' and $smarty.session.security.allow_mysettings == 1 }
	<tr>
		<td class="panelbox_div">
			<a class="panellink" href="{$docroot}mysettings.php">{lang mkey='mysettings'}</a>
		</td>
	</tr>
{elseif $config.display_all_menu_items == 'Y' or $config.display_all_menu_items == '1'}
	<tr>
		<td class="panelbox_div">
			<a class="panellink" href="#" onclick="javascript:insufficientPrivileges();">{lang mkey='mysettings'}</a>
		</td>
	</tr>
{/if}
{if $smarty.session.expired != 1 and $smarty.session.active == '1' and ( $smarty.session.status == $lang.status_enum.active or $smarty.session.status == 'active') }

	<tr>
		<td class="panelbox_div">
			<a class="panellink" href="javascript:popUpScrollWindow2('{$docroot}userpicgallery.php?id={$smarty.session.UserId}&amp;type=profilepics','center',650,600)">{lang mkey='profilepics'}</a>
		</td>
	</tr>
	<tr>
		<td class="panelbox_div">
			<a class="panellink" href="{$docroot}uploadsnaps.php?type=profilepics">{lang mkey='upload_profilepics'}</a>
		</td>
	</tr>
	{if $smarty.session.security.uploadpicture == 1  and $smarty.session.security.uploadpicturecnt > 0}
	<tr>
		<td class="panelbox_div">
			<a class="panellink" href="javascript:popUpScrollWindow2('{$docroot}userpicgallery.php?id={$smarty.session.UserId}&amp;type=gallery','center',650,600)">{lang mkey='picturegallery'}</a>
		</td>
	</tr>
	<tr>
		<td class="panelbox_div">
			<a class="panellink" href="{$docroot}uploadsnaps.php?type=gallery">{lang mkey='upload_pictures'}</a>
		</td>
	</tr>
	{/if}
{elseif $config.display_all_menu_items == 'Y' or $config.display_all_menu_items == '1'}
	<tr>
		<td class="panelbox_div">
		 	<a class="panellink" href="#" onclick="javascript:insufficientPrivileges();">{lang mkey='profilepics'}</a>
		</td>
	</tr>
	<tr>
		<td class="panelbox_div">
		 	<a class="panellink" href="#" onclick="javascript:insufficientPrivileges();">{lang mkey='upload_profilepics'}</a>
		</td>
	</tr>
	<tr>
		<td class="panelbox_div">
		 	<a class="panellink" href="#" onclick="javascript:insufficientPrivileges();">{lang mkey='picturegallery'}</a>
		</td>
	</tr>
	<tr>
		<td class="panelbox_div">
		 	<a class="panellink" href="#" onclick="javascript:insufficientPrivileges();">{lang mkey='upload_pictures'}</a>
		</td>
	</tr>
{/if}
{if $smarty.session.expired != 1 and $smarty.session.active == '1' and ( $smarty.session.status == $lang.status_enum.active or $smarty.session.status == 'active') and $smarty.session.security.allow_videos == 1  and $smarty.session.security.videoscnt > 0}
	<tr>
		<td class="panelbox_div">
			<a class="panellink" href="{$docroot}uploadvideos.php">{lang mkey='videogallery'}</a>
		</td>
	</tr>
{elseif $config.display_all_menu_items == 'Y' or $config.display_all_menu_items == '1'}
	<tr>
		<td class="panelbox_hdr">
		 	<a class="panellink" href="#" onclick="javascript:insufficientPrivileges();">{lang mkey='videogallery'}</a>
		</td>
	</tr>
{/if}
{if ($smarty.session.security.blog == 1 or $smarty.session.security.blog == 'Y')  and $smarty.session.expired != '1' and $smarty.session.active == '1' and ( $smarty.session.status == $lang.status_enum.active or $smarty.session.status == 'active') }
	<tr>
		<td class="panelbox_div">
			<a class="panellink" href="{$docroot}bloglist.php">{lang mkey='myblog'}</a>
		</td>
	</tr>
{elseif $config.display_all_menu_items == 'Y' or $config.display_all_menu_items == '1'}
	<tr>
		<td class="panelbox_div">
			<a class="panellink" href="#" onclick="javascript:insufficientPrivileges();">{lang mkey='myblog'}</a>
		</td>
	</tr>
{/if}

{* Searches *}
{if $smarty.session.expired != '1' and $smarty.session.active == '1' and ( $smarty.session.status == $lang.status_enum.active or $smarty.session.status == 'active') }
	<tr>
		<td class="panellinkhdr_div" >
			{lang mkey='search'}
		</td>
	</tr>
	<tr>
		<td class="panelbox_div">
			<a class="panellink" href="{$docroot}mymatches.php">{lang mkey='my_matches'}</a>
		</td>
	</tr>
	{if $smarty.session.security.extsearch == 1  }
	<tr>
		<td class="panelbox_div">
			<a class="panellink" href="{$docroot}advsearch.php?search_new=1">{lang mkey='profilesearch'}</a>
		</td>
	</tr>
	{elseif $config.display_all_menu_items == 'Y' or $config.display_all_menu_items == '1'}
	<tr>
		<td class="panelbox_div">
		 <a class="panellink" href="#" onclick="javascript:insufficientPrivileges();">{lang mkey='profilesearch'}</a>
		</td>
	</tr>
	{/if}
	{if ($smarty.session.security.blog == 1 or $smarty.session.security.blog == 'Y') }
	<tr>
		<td class="panelbox_div">
			<a class="panellink" href="{$docroot}blogsearch.php">{lang mkey='blog_search_menu'}</a>
		</td>
	</tr>
	<tr>
		<td class="panelbox_div">
			<a class="panellink" href="{$docroot}bloglist_all.php">{lang mkey='blog_stories'}</a>
		</td>
	</tr>
	{elseif $config.display_all_menu_items == 'Y' or $config.display_all_menu_items == '1'}
	<tr>
		<td class="panelbox_div">
			<a class="panellink" href="#" onclick="javascript:insufficientPrivileges();">{lang mkey='blog_search_menu'}</a>
		</td>
	</tr>
	{/if}
{elseif $config.display_all_menu_items == 'Y' or $config.display_all_menu_items == '1'}
	<tr>
		<td class="panellinkhdr_div" >
		{lang mkey='search'}
		</td>
	</tr>
	<tr>
		<td class="panelbox_div">
		 <a class="panellink" href="#" onclick="javascript:insufficientPrivileges();">{lang mkey='my_matches'}</a>
		</td>
	</tr>
	<tr>
		<td class="panelbox_div">
		 <a class="panellink" href="#" onclick="javascript:insufficientPrivileges();">{lang mkey='profilesearch'}</a>
		</td>
	</tr>
	<tr>
		<td class="panelbox_div">
			<a class="panellink" href="#" onclick="javascript:insufficientPrivileges();">{lang mkey='blog_search_menu'}</a>
		</td>
	</tr>
{/if}

{* My Lists *}
	<tr>
		<td class="panellinkhdr_div" >
			{lang mkey='mylists'}
		</td>
	</tr>
{if $smarty.session.security.favouritelist == 1 and $smarty.session.expired != '1' and $smarty.session.active == '1' and ( $smarty.session.status == $lang.status_enum.active or $smarty.session.status == 'active') }
	<tr>
		<td class="panelbox_div">
			<a class="panellink" href="{$docroot}buddybanlist.php?act=B&amp;show=1">{lang mkey='bans'}</a>
		</td>
	</tr>
	<tr>
		<td class="panelbox_div">
			<a class="panellink" href="{$docroot}buddybanlist.php?act=F&amp;show=1">{lang mkey='mybuddies'}</a>
		</td>
	</tr>
	<tr>
		<td class="panelbox_div">
			<a class="panellink" href="{$docroot}buddybanlist.php?act=H&amp;show=1">{lang mkey='hotprofiles'}</a>
		</td>
	</tr>
	{if $smarty.session.security.saveprofiles == 1}
	<tr>
		<td class="panelbox_div">
			<a class="panellink" href="{$docroot}watchedprofiles.php?act=W">{lang mkey='watchedprofiles'}</a>
		</td>
	</tr>
	{elseif $config.display_all_menu_items == 'Y' or $config.display_all_menu_items == '1'}
	<tr>
		<td class="panelbox_div">
		 <a class="panellink" href="#" onclick=	"javascript:insufficientPrivileges();">{lang mkey='watchedprofiles'}</a>
		</td>
	</tr>
	{/if}
{elseif $config.display_all_menu_items == 'Y' or $config.display_all_menu_items == '1'}
	<tr>
		<td class="panelbox_div">
			<a class="panellink" href="#" onclick="javascript:insufficientPrivileges();">{lang mkey='bans'}</a>
		</td>
	</tr>
	<tr>
		<td class="panelbox_div">
			<a class="panellink" href="#" onclick="javascript:insufficientPrivileges();">{lang mkey='mybuddies'}</a>
		</td>
	</tr>
	<tr>
		<td class="panelbox_div">
		<a class="panellink" href="#" onclick="javascript:insufficientPrivileges();">{lang mkey='hotprofiles'}</a>
		</td>
	</tr>
	<tr>
		<td class="panelbox_div">
		 <a class="panellink" href="#" onclick=	"javascript:insufficientPrivileges();">{lang mkey='watchedprofiles'}</a>
		</td>
	</tr>
{/if}
	<tr>
		<td class="panelbox_div">
			<a class="panellink" href="{$docroot}listviewswinks.php?act=V">{lang mkey='views'}</a>
		</td>
	</tr>
{if $smarty.session.security.sendwinks == 1}
	<tr>
		<td class="panelbox_div">
			<a class="panellink" href="{$docroot}listviewswinks.php?act=W">{lang mkey='winks'}</a>
		</td>
	</tr>
{elseif $config.display_all_menu_items == 'Y' or $config.display_all_menu_items == '1'}
	<tr>
		<td class="panelbox_div">
			 <a class="panellink" href="#" onclick="javascript:insufficientPrivileges();">{lang mkey='winks'}</a>
		</td>
	</tr>
{/if}

{* Tools *}
{if $config.display_all_menu_items == 'Y' or $config.display_all_menu_items == '1' or  ($smarty.session.security.event_mgt == 1 and $smarty.session.expired != '1' and $smarty.session.active == '1' and ( $smarty.session.status == $lang.status_enum.active or $smarty.session.status == 'active') and $allcalendars|@count > 0 ) or ($smarty.session.expired != '1' and $smarty.session.active == '1') or ($smarty.session.security.chat == 1  and $smarty.session.expired != '1' and $smarty.session.active == '1' and ( $smarty.session.status == $lang.status_enum.active or $smarty.session.status == 'active')) or ($smarty.session.expired != '1' and $smarty.session.active == '1' and ( $smarty.session.status == $lang.status_enum.active or $smarty.session.status == 'active'))  }
	<tr>
		<td class="panellinkhdr_div" >
			{lang mkey='tools'}
		</td>
	</tr>
{/if}
{if $smarty.session.security.event_mgt == 1 and $smarty.session.expired != '1' and $smarty.session.active == '1' and ( $smarty.session.status == $lang.status_enum.active or $smarty.session.status == 'active') and $allcalendars|@count > 0 }
	<tr>
		<td class="panelbox_div">
			{if $config.use_popups == 'Y'}
				<a class="panellink" href="javascript:popUpScrollWindow('{$docroot}calendar.php','center',950,600)">{lang mkey='calendar_title'}</a>
			{else}
				<a class="panellink" target="_blank" href="{$docroot}calendar.php">{lang mkey='calendar_title'}</a>
			{/if}
		</td>
	</tr>
{elseif $config.display_all_menu_items == 'Y' or $config.display_all_menu_items == '1'}
	<tr>
		<td class="panelbox_div">
			 <a class="panellink" href="#" onclick="javascript:insufficientPrivileges();">{lang mkey='calendar_title'}</a>
		</td>
	</tr>
{/if}
{if $smarty.session.security.event_mgt == 1 and $smarty.session.expired != '1' and $smarty.session.active == '1' and ( $smarty.session.status == $lang.status_enum.active or $smarty.session.status == 'active') and $allcalendars|@count > 0 }
	<tr>
		<td class="panelbox_div">
			<a class="panellink" href="{$docroot}watchevents.php">{lang mkey='watched_events'}</a>
		</td>
	</tr>
{elseif $config.display_all_menu_items == 'Y' or $config.display_all_menu_items == '1'}
	<tr>
		<td class="panelbox_div">
			 <a class="panellink" href="#" onclick="javascript:insufficientPrivileges();">{lang mkey='watched_events'}</a>
		</td>
	</tr>
{/if}
{if $smarty.session.expired != '1' and $smarty.session.active == '1' and ( $smarty.session.status == $lang.status_enum.active or $smarty.session.status == 'active')  }
	<tr>
		<td class="panelbox_div">
			<a class="panellink" href="{$docroot}user_comments.php">{lang mkey='user_comments'}</a>
		</td>
	</tr>
{elseif $config.display_all_menu_items == 'Y' or $config.display_all_menu_items == '1'}
	<tr>
		<td class="panelbox_div">
			 <a class="panellink" href="#" onclick="javascript:insufficientPrivileges();">{lang mkey='user_comments'}</a>
		</td>
	</tr>
{/if}
{if  $smarty.session.expired != '1' and $smarty.session.active == '1' }
	<tr>
		<td class="panelbox_div">
			<a class="panellink" href="{$docroot}changempass.php">{lang mkey='change_password'}</a>
		</td>
	</tr>
{/if}
{if $smarty.session.security.chat == 1  and $smarty.session.expired != '1' and $smarty.session.active == '1' and ( $smarty.session.status == $lang.status_enum.active or $smarty.session.status == 'active') }
	<tr>
		<td class="panelbox_div">
		{* if flashchat is installed, then open new window *}
			{if $flashchat_installed == '1'}
				<form name='frmChat' id='frmChat' action="{$docroot}chat/flashchat_osdate.php" method='get' target="new">
					<input type="hidden" name='username' value="{$smarty.session.UserName}" />
					<input type="hidden" name='whatIneed' value="{$smarty.session.whatIneed}" />
				</form>
			{else}
				<form name='frmChat' id='frmChat' action="{$docroot}flashchat.php" method="post">
					<input type="hidden" name='username' value="{$smarty.session.UserName}" />
					<input type="hidden" name='whatIneed' value="{$smarty.session.whatIneed}" />
				</form>
			{/if}
			<a class="panellink" href="#" onclick="javascript:document.frmChat.submit(); return(false);">{lang mkey='chat'}</a>
		</td>
	</tr>
{elseif $config.display_all_menu_items == 'Y' or $config.display_all_menu_items == '1'}
	<tr>
		<td class="panelbox_div">
			 <a class="panellink" href="#" onclick="javascript:insufficientPrivileges();">{lang mkey='chat'}</a>
		</td>
	</tr>
{/if}
{if $smarty.session.security.forum == 1  and $smarty.session.expired != '1' and $smarty.session.active == '1' and ( $smarty.session.status == $lang.status_enum.active or $smarty.session.status == 'active') }
	<tr>
		<td class="panelbox_div">
			{if ( $config.forum_installed == 'phpBB' || $config.forum_installed == 'phpBB3'|| $config.forum_installed == 'myBB'|| $config.forum_installed == 'vBulletin' || $config.forum_installed== 'Phorum' ||$config.forum_installed == 'myBB14' ||$config.forum_installed == 'smf11') && $config.forum_path != 'None' && $config.forum_path != ''   }
				<form name='frmForum' id='frmForum' action="{$docroot}forum/login_osdate.php"  method='post' {if $config.forum_display_in_same_window != 'Y'} target="new"{/if} >
				<input type="hidden" name='login' value="Log in" />
				<input type="hidden" name='username' value="{$smarty.session.UserName}" />
				<input type="hidden" name='whatIneed' value="{$smarty.session.whatIneed}" />
				</form>
			{else}
				<form name='frmForum' id='frmForum' action="{$docroot}noforums.php"  method='post' >
				</form>
			{/if}
				<a href="#" class="panellink" onclick="javascript:document.frmForum.submit(); return(false);" >{lang mkey='forum'}</a>
		</td>
	</tr>
{elseif $config.display_all_menu_items == 'Y' or $config.display_all_menu_items == '1'}
	<tr>
		<td class="panelbox_div">
			 <a class="panellink" href="#" onclick="javascript:insufficientPrivileges();">{lang mkey='forum'}</a>
		</td>
	</tr>
{/if}
{if  $smarty.session.expired != '1' and $smarty.session.active == '1' and ( $smarty.session.status == $lang.status_enum.active or $smarty.session.status == 'active') }
	<tr>
		<td class="panelbox_div">
			<a class="panellink" href="{$docroot}mailmessages.php?messages=inbox" >{lang mkey='mail_messages'}&nbsp;[&nbsp;{$new_messages|default:0}&nbsp;{lang mkey='unread'}&nbsp;] </a>
		</td>
	</tr>
{/if}

{* My Membership *}
	<tr>
		<td class="panellinkhdr_div" >
			{lang mkey='membership'}
		</td>
	</tr>
{ if $smarty.session.status == $lang.status_enum.active or $smarty.session.status == 'active' }
	<tr>
		<td class="panelbox_div">
			<a class="panellink" href="payment.php">{lang mkey='upgrade_membership'}</a>
		</td>
	</tr>
{/if}
	<tr>
		<td class="panelbox_div">
			<a class="panellink" href="{$docroot}userstats.php">{lang mkey='user_stats'}</a>
		</td>
	</tr>
	<tr>
		<td class="panelbox_div">
			<a class="panellink" href="{$docroot}cancel.php">{lang mkey='cancel_hdr'}</a>
		</td>
	</tr>
	{if $modosdate_umenu|@count > 0 && $smarty.session.status == 'active'}
{* Plugins *}
	<tr>
		<td class="panellinkhdr_div" >
			{lang mkey='plugin'}
		</td>
	</tr>
{* The modosdate_umenu is defined when modOsDate is created in init.php *}
{foreach item=item key=key from=$modosdate_umenu}
	<tr>
		<td class="panelbox_div">
			<a class="panellink" href="{$item.href}">{$item.text}</a>
		</td>
	</tr>
{/foreach}
{/if}
</table>