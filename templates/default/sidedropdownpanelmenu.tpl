<!-- dropdown panel menu -->
<div class="dropdowncontainer">
<div >
<a href="#" onclick="return clickreturnvalue()" onmouseover="dropdownmenu(this, event, 'home')" class="dropmenulink">{lang mkey='site_links' skey='home'}</a>
<div id="home" class="anylinkcss">{* Home *}

		<a href="{$docroot}index.php">{lang mkey='site_links' skey='home'}</a>
		<a href="{$docroot}logout.php">{lang mkey='sign_out'}</a>
</div>
</div>

<div >
<a href="#" onclick="return clickreturnvalue()" onmouseover="dropdownmenu(this, event, 'myprofile')" class="dropmenulink">My Profile</a>
<div id="myprofile" class="anylinkcss">
{* My Profile *}
		<a
		{if $config.enable_mod_rewrite == 'Y'}
			href="javascript:popUpScrollWindow2('{if $config.seo_username == 'Y'}{$smarty.session.UserName}{else}{$smarty.session.UserId}.htm{/if}','top',650,screen.height)">
		{else}
			href="javascript:popUpScrollWindow2('{$docroot}showprofile.php?{if $config.seo_username == 'Y'}username={$smarty.session.UserName}{else}id={$smarty.session.UserId}{/if}','top',650,screen.height)">
		{/if}
		{lang mkey='view_profile'}</a>

{if $smarty.session.expired != 1 and $smarty.session.active == '1' }

		<a href="{$docroot}edituser.php">{lang mkey='edit_profile'}</a>
		<a href="{$docroot}editquestions.php">{lang mkey='myprofilepreferences'}</a>
		<a href="{$docroot}editmymatches.php">{lang mkey='mysearchpreferences'}</a>

{/if}
{if $smarty.session.expired != 1 and $smarty.session.active == '1' and $smarty.session.security.allow_mysettings == 1 }

			<a href="{$docroot}mysettings.php">{lang mkey='mysettings'}</a>

{elseif $config.display_all_menu_items == 'Y' or $config.display_all_menu_items == '1'}

			<a href="{$docroot}mysettings.php">{lang mkey='mysettings'}</a>

{/if}
{if $smarty.session.expired != 1 and $smarty.session.active == '1' and ( $smarty.session.status == $lang.status_enum.active or $smarty.session.status == 'active') }

			<a href="javascript:popUpScrollWindow2('{$docroot}userpicgallery.php?id={$smarty.session.UserId}&amp;type=profilepics','center',650,600)">{lang mkey='profilepics'}</a>

			<a href="{$docroot}uploadsnaps.php?type=profilepics">{lang mkey='upload_profilepics'}</a>

{if $smarty.session.security.uploadpicture == 1  and $smarty.session.security.uploadpicturecnt > 0}

			<a href="javascript:popUpScrollWindow2('{$docroot}userpicgallery.php?id={$smarty.session.UserId}&amp;type=gallery','center',650,600)">{lang mkey='picturegallery'}</a>

	<a href="{$docroot}uploadsnaps.php?type=gallery">{lang mkey='upload_pictures'}</a>
	{/if}
{elseif $config.display_all_menu_items == 'Y' or $config.display_all_menu_items == '1'}

		 	<a href="#" onclick="javascript:insufficientPrivileges();">{lang mkey='profilepics'}</a>

		 	<a href="#" onclick="javascript:insufficientPrivileges();">{lang mkey='upload_profilepics'}</a>

		 	<a href="#" onclick="javascript:insufficientPrivileges();">{lang mkey='picturegallery'}</a>

		 	<a href="#" onclick="javascript:insufficientPrivileges();">{lang mkey='upload_pictures'}</a>

{/if}
{if $smarty.session.expired != 1 and $smarty.session.active == '1' and ( $smarty.session.status == $lang.status_enum.active or $smarty.session.status == 'active') and $smarty.session.security.allow_videos == 1  and $smarty.session.security.videoscnt > 0}

			<a href="{$docroot}uploadvideos.php">{lang mkey='videogallery'}</a>

{elseif $config.display_all_menu_items == 'Y' or $config.display_all_menu_items == '1'}

		 	<a href="#" onclick="javascript:insufficientPrivileges();">{lang mkey='videogallery'}</a>

{/if}
{if ($smarty.session.security.blog == 1 or $smarty.session.security.blog == 'Y')  and $smarty.session.expired != '1' and $smarty.session.active == '1' and ( $smarty.session.status == $lang.status_enum.active or $smarty.session.status == 'active') }

			<a  href="{$docroot}bloglist.php">{lang mkey='myblog'}</a>

{elseif $config.display_all_menu_items == 'Y' or $config.display_all_menu_items == '1'}


			<a href="#" onclick="javascript:insufficientPrivileges();">{lang mkey='myblog'}
	{/if}</div>
</div>

<div >
<a href="#" onclick="return clickreturnvalue()" onmouseover="dropdownmenu(this, event, 'searches')" class="dropmenulink">Searches</a>
<div id="searches" class="anylinkcss">{* Searches *}
{if $smarty.session.expired != '1' and $smarty.session.active == '1' and ( $smarty.session.status == $lang.status_enum.active or $smarty.session.status == 'active') }

<a href="{$docroot}mymatches.php">{lang mkey='my_matches'}</a>

	{if $smarty.session.security.extsearch == 1  }
<a href="{$docroot}advsearch.php?search_new=1">{lang mkey='profilesearch'}</a>

	{elseif $config.display_all_menu_items == 'Y' or $config.display_all_menu_items == '1'}

<a href="#" onclick="javascript:insufficientPrivileges();">{lang mkey='profilesearch'}</a>
	{/if}
	{if ($smarty.session.security.blog == 1 or $smarty.session.security.blog == 'Y') }

<a href="{$docroot}bloglist_all.php">{lang mkey='blog_stories'}</a>
<a href="{$docroot}blogsearch.php">{lang mkey='blog_search_menu'}</a>

	{elseif $config.display_all_menu_items == 'Y' or $config.display_all_menu_items == '1'}
<a href="#" onclick="javascript:insufficientPrivileges();">{lang mkey='blog_stories'}</a>
<a href="#" onclick="javascript:insufficientPrivileges();">{lang mkey='blog_search_menu'}</a>

	{/if}
{elseif $config.display_all_menu_items == 'Y' or $config.display_all_menu_items == '1'}

		{lang mkey='search'}
<a href="#" onclick="javascript:insufficientPrivileges();">{lang mkey='my_matches'}</a>
<a href="#" onclick="javascript:insufficientPrivileges();">{lang mkey='profilesearch'}</a>
<a href="#" onclick="javascript:insufficientPrivileges();">{lang mkey='blog_stories'}</a>
<a href="#" onclick="javascript:insufficientPrivileges();">{lang mkey='blog_search_menu'}</a>
{/if}
</div>
</div>


<div ><a href="#" onclick="return clickreturnvalue()" onmouseover="dropdownmenu(this, event, 'mylists')" class="dropmenulink">My Lists</a>
<div id="mylists" class="anylinkcss">{* My Lists *}

{if $smarty.session.security.favouritelist == 1 and $smarty.session.expired != '1' and $smarty.session.active == '1' and ( $smarty.session.status == $lang.status_enum.active or $smarty.session.status == 'active') }

<a href="{$docroot}buddybanlist.php?act=B&amp;show=1">{lang mkey='bans'}</a>
<a href="{$docroot}buddybanlist.php?act=F&amp;show=1">{lang mkey='mybuddies'}</a>
<a href="{$docroot}buddybanlist.php?act=H&amp;show=1">{lang mkey='hotprofiles'}</a>

	{if $smarty.session.security.saveprofiles == 1}
<a href="{$docroot}watchedprofiles.php?act=W">{lang mkey='watchedprofiles'}</a>

	{elseif $config.display_all_menu_items == 'Y' or $config.display_all_menu_items == '1'}

<a href="#" onclick=	"javascript:insufficientPrivileges();">{lang mkey='watchedprofiles'}</a>

	{/if}
{elseif $config.display_all_menu_items == 'Y' or $config.display_all_menu_items == '1'}
<a href="#" onclick="javascript:insufficientPrivileges();">{lang mkey='bans'}</a>

<a href="#" onclick="javascript:insufficientPrivileges();">{lang mkey='mybuddies'}</a>

<a href="#" onclick="javascript:insufficientPrivileges();">{lang mkey='hotprofiles'}</a>

<a href="#" onclick=	"javascript:insufficientPrivileges();">{lang mkey='watchedprofiles'}</a>

{/if}
<a  href="{$docroot}listviewswinks.php?act=V">{lang mkey='views'}</a>

{if $smarty.session.security.sendwinks == 1}
<a href="{$docroot}listviewswinks.php?act=W">{lang mkey='winks'}</a>

{elseif $config.display_all_menu_items == 'Y' or $config.display_all_menu_items == '1'}

<a href="#" onclick="javascript:insufficientPrivileges();">{lang mkey='winks'}</a>

{/if}</div></div>


<div ><a href="#" onclick="return clickreturnvalue()" onmouseover="dropdownmenu(this, event, 'tools')" class="dropmenulink">Tools</a>
<div id="tools" class="anylinkcss">{* Tools *}

{if $config.display_all_menu_items == 'Y' or $config.display_all_menu_items == '1' or ( $config.enable_php121 == 'Y' && $smarty.session.security.allow_php121 == 1) or ($smarty.session.security.event_mgt == 1 and $smarty.session.expired != '1' and $smarty.session.active == '1' and ( $smarty.session.status == $lang.status_enum.active or $smarty.session.status == 'active') and $allcalendars|@count > 0 ) or ($smarty.session.expired != '1' and $smarty.session.active == '1') or ($smarty.session.security.chat == 1  and $smarty.session.expired != '1' and $smarty.session.active == '1' and ( $smarty.session.status == $lang.status_enum.active or $smarty.session.status == 'active')) or ($smarty.session.expired != '1' and $smarty.session.active == '1' and ( $smarty.session.status == $lang.status_enum.active or $smarty.session.status == 'active'))  }

{/if}
{* php121 messenger, This is just a testing one  *}
{if $config.enable_php121 == 'Y' && $smarty.session.security.allow_php121 == 1}
<a href="{$docroot}php121/php121im.php" target="new">php121 Messenger</a>

{elseif $config.display_all_menu_items == 'Y' or $config.display_all_menu_items == '1'}

<a href="#" onclick="javascript:insufficientPrivileges();">php121 Messenger</a>

{/if}
{if $smarty.session.security.event_mgt == 1 and $smarty.session.expired != '1' and $smarty.session.active == '1' and ( $smarty.session.status == $lang.status_enum.active or $smarty.session.status == 'active') and $allcalendars|@count > 0 }

			{if $config.use_popups == 'Y'}
				<a href="javascript:popUpScrollWindow('{$docroot}calendar.php','center',950,600)">{lang mkey='calendar_title'}</a>
			{else}
				<a target="_blank" href="{$docroot}calendar.php">{lang mkey='calendar_title'}</a>
			{/if}

{elseif $config.display_all_menu_items == 'Y' or $config.display_all_menu_items == '1'}

		 <a href="#" onclick="javascript:insufficientPrivileges();">{lang mkey='calendar_title'}</a>

{/if}
{if $smarty.session.security.event_mgt == 1 and $smarty.session.expired != '1' and $smarty.session.active == '1' and ( $smarty.session.status == $lang.status_enum.active or $smarty.session.status == 'active') and $allcalendars|@count > 0 }
	<a href="{$docroot}watchevents.php">{lang mkey='watched_events'}</a>

{elseif $config.display_all_menu_items == 'Y' or $config.display_all_menu_items == '1'}

<a href="#" onclick="javascript:insufficientPrivileges();">{lang mkey='watched_events'}</a>

{/if}
{if $smarty.session.expired != '1' and $smarty.session.active == '1' and ( $smarty.session.status == $lang.status_enum.active or $smarty.session.status == 'active') }
	<a href="{$docroot}user_comments.php">{lang mkey='user_comments'}</a>

{elseif $config.display_all_menu_items == 'Y' or $config.display_all_menu_items == '1'}

<a href="#" onclick="javascript:insufficientPrivileges();">{lang mkey='user_comments'}</a>

{/if}
{if  $smarty.session.expired != '1' and $smarty.session.active == '1' }
	<a href="{$docroot}changempass.php">{lang mkey='change_password'}</a>
{/if}
{if $smarty.session.security.chat == 1  and $smarty.session.expired != '1' and $smarty.session.active == '1'  and ( $smarty.session.status == $lang.status_enum.active or $smarty.session.status == 'active') }

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
<a href="#" onclick="javascript:document.frmChat.submit(); return(false);">{lang mkey='chat'}</a>

{elseif $config.display_all_menu_items == 'Y' or $config.display_all_menu_items == '1'}

<a href="#" onclick="javascript:insufficientPrivileges();">{lang mkey='chat'}</a>

{/if}
{if $smarty.session.security.forum == 1  and $smarty.session.expired != '1' and $smarty.session.active == '1' and ( $smarty.session.status == $lang.status_enum.active or $smarty.session.status == 'active') }

		<form name='frmForum' id='frmForum' action="{$docroot}forum/login_osdate.php" method='post' {if $config.forum_display_in_same_window != 'Y'} target="new"{/if}>
			<input type="hidden" name='login' value="Log in" />
			<input type="hidden" name='username' value="{$smarty.session.UserName}" />
			<input type="hidden" name='whatIneed' value="{$smarty.session.whatIneed}" />
		</form>
		<a href="#" onclick="javascript:document.frmForum.submit(); return(false);" >{lang mkey='forum'}</a>

{elseif $config.display_all_menu_items == 'Y' or $config.display_all_menu_items == '1'}

		 <a href="#" onclick="javascript:insufficientPrivileges();">{lang mkey='forum'}</a>

{/if}
{if  $smarty.session.expired != '1' and $smarty.session.active == '1' and ( $smarty.session.status == $lang.status_enum.active or $smarty.session.status == 'active') }
<a href="{$docroot}mailmessages.php?messages=inbox" >{lang mkey='mail_messages'}&nbsp;[&nbsp;{$new_messages|default:0}&nbsp;{lang mkey='unread'}&nbsp;]</a>

{/if}
</div>
</div>


<div ><a href="#" onclick="return clickreturnvalue()" onmouseover="dropdownmenu(this, event, 'mymembership')" class="dropmenulink">My Membership</a>
<div id="mymembership" class="anylinkcss">{* My Membership *}

{ if $smarty.session.status == $lang.status_enum.active or $smarty.session.status == 'active' }
<a href="payment.php">{lang mkey='upgrade_membership'}</a>

{/if}
<a href="{$docroot}userstats.php">{lang mkey='user_stats'}</a>

<a href="{$docroot}cancel.php">{lang mkey='cancel_hdr'}</a>

</div>
</div>

{if $modosdate_umenu|@count > 0 && $smarty.session.active == '1'}
<div ><a href="#" onclick="return clickreturnvalue()" onmouseover="dropdownmenu(this, event, 'plugins')" class="dropmenulink">	{lang mkey='plugin'}</a>
<div id="plugins" class="anylinkcss">{* plugins *}
{* The modosdate_umenu is defined when modOsDate is created in init.php *}
{foreach item=item key=key from=$modosdate_umenu}

<a  href="{$item.href}">{$item.text}</a>

{/foreach}
</div>
</div>
{/if}

</div>
<div style="clear:both;"></div>
<!-- /dropdown menu -->