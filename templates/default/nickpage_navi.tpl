{strip}
{if isset($smarty.session.UserId) && $smarty.session.UserId != '' && $smarty.session.UserId != $user.id  }
	<div class="profile_links" align="center" style="padding-left:6px; padding-right: 2px; margin-top:3px; margin-bottom:3px;">
		{$blog_link}
		{if $smarty.session.security.seepictureprofile == 1 or ( $smarty.session.UserId != '' && $smarty.session.UserId == $user.id) }
			<a href="#" onclick="javascript:popUpScrollWindow2('userpicgallery.php?id={$user.id}','center',600,600);" class="footerlink">{lang mkey='pic_gallery'}</a>&nbsp;
			{assign var=found value=true}
		{elseif $config.display_all_menu_items == 'Y' or $config.display_all_menu_items == '1'}
			<a href="#" onclick="javascript:insufficientPrivileges();" class="footerlink">{lang mkey='pic_gallery'}</a>&nbsp;
		{/if}
		{if $smarty.session.security.message == 1 }
			{if $user.id != $smarty.session.UserId  && $user.is_banned != '1'}
				{if $found}|{/if}&nbsp;<a href="compose.php?recipient={$user.id}" class="footerlink">{lang mkey='send_mail'}</a>&nbsp;
				{assign var=found value=true}
			{/if}
		{elseif $config.display_all_menu_items == 'Y' or $config.display_all_menu_items == '1' }
			|&nbsp;<a href="#" onclick="javascript:insufficientPrivileges();" class="footerlink">{lang mkey='send_mail'}</a>&nbsp;
			{assign var=found value=true}
		{/if}
		{if $smarty.session.security.sendwinks == 1}
			{if $user.is_banned != '1'}
				{if $found}|{/if}&nbsp;<a href="#" onclick="javascript:window.location='sendwinks.php?ref_id={$user.id}&amp;rtnurl=showprofile.php';" class="footerlink">{lang mkey='send_wink'}</a>&nbsp;
				{assign var=found value=true}
			{/if}
		{elseif $config.display_all_menu_items == 'Y' or $config.display_all_menu_items == '1'}
			|&nbsp;<a href="#" onclick="javascript:insufficientPrivileges();" class="footerlink">{lang mkey='send_wink'}</a>&nbsp;
			{assign var=found value=true}
		{/if}
		{if $smarty.session.security.favouritelist == 1 }
			{if $found}|{/if}&nbsp;
			<a href="#" onclick="javascript:window.location='buddybanlist.php?act=buddy&amp;ref_id={$user.id}&amp;rtnurl=showprofile.php';" class="footerlink">{lang mkey='addtobuddylist'}</a>
			{if $user.is_banned!= 1}
				&nbsp;|&nbsp;<a href="#" onclick="javascript:window.location='buddybanlist.php?act=ban&amp;ref_id={$user.id}&amp;rtnurl=showprofile.php';" class="footerlink">{lang mkey='addtobanlist'}</a>
			{/if}
			&nbsp;|&nbsp;<a href="#" onclick="javascript:window.location='buddybanlist.php?act=hot&amp;ref_id={$user.id}&amp;rtnurl=showprofile.php';" class="footerlink">{lang mkey='addtohotlist'}</a>&nbsp;
			{assign var=found value=true}
		{elseif $config.display_all_menu_items == 'Y' or $config.display_all_menu_items == '1'}
			|&nbsp;<a href="#" onclick="javascript:insufficientPrivileges();" class="footerlink">{lang mkey='addtobuddylist'}</a>
			&nbsp;|&nbsp;<a href="#" onclick="javascript:insufficientPrivileges();" class="footerlink">{lang mkey='addtobanlist'}</a>
			&nbsp;|&nbsp;<a href="#" onclick="javascript:insufficientPrivileges();" class="footerlink">{lang mkey='addtohotlist'}</a>&nbsp;
			{assign var=found value=true}
		{/if}
		{if $smarty.session.security.saveprofiles == 1 and $in_savedprofiles <= 0 }
			&nbsp;{if $found}|{/if}&nbsp;
			<a href="#" onclick="javascript:window.location='watchedprofiles.php?act=save&amp;ref_id={$user.id}&amp;rtnurl=showprofile.php';" class="footerlink">{lang mkey='watchedprofiles_1'}</a>
		{elseif $config.display_all_menu_items == 'Y' or $config.display_all_menu_items == '1'}
			|&nbsp;<a href="#" onclick="javascript:insufficientPrivileges();" class="footerlink">{lang mkey='watchedprofiles_1'}</a>
		{/if}
	</div>
{/if}
{/strip}