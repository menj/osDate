<table cellspacing="5" cellpadding="0" width="100%" border="0">
	<tr>
		<td><a href="{$docroot}{$smarty.const.ADMIN_DIR}index.php" class="panellink">{lang mkey='adminhome'}</a></td>
	</tr>
	<tr>
		<td><a href="{$docroot}{$smarty.const.ADMIN_DIR}index.php?page=credits" class="panellink">Credits</a></td>
	</tr>
	<tr>
		<td valign="bottom"><a href="{$docroot}{$smarty.const.ADMIN_DIR}logout.php" class="panellink">{lang mkey='sign_out'}</a></td>
	</tr>

{* Members *}
	<tr >
		<td height="16" width="100%" class="panellinkhdr">&nbsp;{lang mkey='membershdr'}</td>
	</tr>
{if $smarty.session.Permissions.profile_mgt == 1}
	<tr>
	  <td><a href="{$docroot}{$smarty.const.ADMIN_DIR}profile.php" class="panellink">{lang mkey='memberprofiles'}</a></td>
	</tr>
{/if}
{if $smarty.session.Permissions.profie_approval == 1}
	<tr>
		<td><a class="panellink" href="{$docroot}{$smarty.const.ADMIN_DIR}unapprovedusers.php">{lang mkey='unapproved_user'}</a></td>
	</tr>
{/if}
{if $config.snaps_require_approval == 'Y' && $smarty.session.Permissions.snaps_require_approval == 1}
	<tr>
		<td><a href="{$docroot}{$smarty.const.ADMIN_DIR}approve_snaps.php" class="panellink">{lang mkey='snaps_require_approval'}</a></td>
	</tr>
	<tr>
		<td><a href="{$docroot}{$smarty.const.ADMIN_DIR}approve_videos.php" class="panellink">{lang mkey='videos_require_approval'}</a></td>
	</tr>
{/if}
{if $smarty.session.Permissions.profile_ratings == 1}
	<tr>
		<td><a class="panellink" href="{$docroot}{$smarty.const.ADMIN_DIR}manageratings.php">{lang mkey='profile_ratings'}</a></td>
	</tr>
{/if}
{if $smarty.session.Permissions.profie_approval == 1}
	<tr>
		<td><a class="panellink" href="{$docroot}{$smarty.const.ADMIN_DIR}reactivate.php">{lang mkey='reactivate'}</a></td>
	</tr>
{/if}
{if $smarty.session.Permissions.featured_profiles_mgt == 1}
	<tr>
		<td><a href="{$docroot}{$smarty.const.ADMIN_DIR}featured_profiles.php" class="panellink">{lang mkey='featuredprofiles'}</a></td>
	</tr>
{/if}
{if $smarty.session.Permissions.send_letter == 1}
	<tr>
		<td><a href="{$docroot}{$smarty.const.ADMIN_DIR}sendletter.php" class="panellink">{lang mkey='send_letter'}</a></td>
	</tr>
{/if}
{if $smarty.session.Permissions.search == 1}
	<tr>
		<td><a href="{$docroot}{$smarty.const.ADMIN_DIR}advsearch.php?search_new=1" class="panellink">{lang mkey='membersearch'}</a></td>
	</tr>
{/if}
{if $smarty.session.Permissions.blog_mgt == 1}
	<tr>
		<td><a href="{$docroot}{$smarty.const.ADMIN_DIR}bloglist.php" class="panellink">{lang mkey='blog' skey="hdr"}</a></td>
	</tr>
	<tr>
		<td><a href="{$docroot}{$smarty.const.ADMIN_DIR}blogsearch.php" class="panellink">{lang mkey='blog_search_menu'}</a></td>
	</tr>
{/if}
{* Affiliates *}
{if $smarty.session.Permissions.affiliate_mgt == 1 or $smarty.session.Permissions.affiliate_stats == 1}
	<tr >
		<td  height="16" width="100%" class="panellinkhdr">&nbsp;{lang mkey='affiliateshdr'}</td>
	</tr>
{if $smarty.session.Permissions.affiliate_mgt == 1}
	<tr>
		<td><a href="{$docroot}{$smarty.const.ADMIN_DIR}affiliatesview.php" class="panellink">{lang mkey='affiliate_title'}</a></td>
	</tr>
{/if}
{if $smarty.session.Permissions.affiliate_stats == 1}
	<tr>
		<td><a href="{$docroot}{$smarty.const.ADMIN_DIR}affiliatestats.php" class="panellink">{lang mkey='aff_stats'}</a></td>
	</tr>
{/if}
{/if}
{* Localities *}
{if $smarty.session.Permissions.cntry_mgt == 1 && ($config.cntry_mgt == 'Y' or $config.cntry_mgt == '1')}
	<tr >
		<td  height="16" width="100%" class="panellinkhdr">&nbsp;{lang mkey='localities'}</td>
	</tr>
	<tr>
		<td><a href="{$docroot}{$smarty.const.ADMIN_DIR}managecountries.php" class="panellink">{lang mkey='manage_country_states'}</a></td>
	</tr>
	<tr>
		<td><a href="{$docroot}{$smarty.const.ADMIN_DIR}load_cities.php" class="panellink">{lang mkey='load_cities'}</a></td>
	</tr>
	<tr>
		<td><a href="{$docroot}{$smarty.const.ADMIN_DIR}load_counties.php" class="panellink">{lang mkey='load_counties'}</a></td>
	</tr>
	<tr>
		<td><a href="{$docroot}{$smarty.const.ADMIN_DIR}load_states.php" class="panellink">{lang mkey='load_states'}</a></td>
	</tr>
	<tr>
		<td><a href="{$docroot}{$smarty.const.ADMIN_DIR}load_zips.php" class="panellink">{lang mkey='load_zips'}</a></td>
	</tr>
{/if}
{* Content *}
{if $smarty.session.Permissions.global_mgt == 1 or $smarty.session.Permissions.article_mgt == 1 or $smarty.session.Permissions.news_mgt == 1 or $smarty.session.Permissions.pages_mgt == 1 or $smarty.session.Permissions.poll_mgt == 1 or $smarty.session.Permissions.story_mgt == 1 or $smarty.session.Permissions.section_mgt == 1 or $smarty.session.Permissions.banner_mgt == 1 }
	<tr >
		<td height="16" width="100%" class="panellinkhdr">&nbsp;{lang mkey='contenthdr'}</td>
	</tr>
{if $smarty.session.Permissions.global_mgt == 1}
	<tr>
		<td><a href="{$docroot}{$smarty.const.ADMIN_DIR}load_language.php" class="panellink">{lang mkey='manage_languages'}</a></td>
	</tr>
{/if}
{if $smarty.session.Permissions.article_mgt == 1}
	<tr>
		<td><a href="{$docroot}{$smarty.const.ADMIN_DIR}managearticle.php" class="panellink">{lang mkey='manage_article'}</a></td>
	</tr>
{/if}
{if $smarty.session.Permissions.news_mgt == 1}
	<tr>
		<td><a href="{$docroot}{$smarty.const.ADMIN_DIR}managenews.php" class="panellink">{lang mkey='manage_news'}</a></td>
	</tr>
{/if}
{if $smarty.session.Permissions.pages_mgt == 1}
	<tr>
		<td><a href="{$docroot}{$smarty.const.ADMIN_DIR}managepages.php" class="panellink">{lang mkey='manage_pages'}</a></td>
	</tr>
{/if}
{if $smarty.session.Permissions.poll_mgt == 1}
	<tr>
		<td><a href="{$docroot}{$smarty.const.ADMIN_DIR}managepoll.php" class="panellink">{lang mkey='manage_polls'}</a></td>
	</tr>
{/if}
{if $smarty.session.Permissions.story_mgt == 1}
	<tr>
		<td><a href="{$docroot}{$smarty.const.ADMIN_DIR}managestory.php" class="panellink">{lang mkey='manage_story'}</a></td>
	</tr>
{/if}
{if $smarty.session.Permissions.section_mgt == 1}
	<tr>
		<td><a href="{$docroot}{$smarty.const.ADMIN_DIR}section.php" class="panellink">{lang mkey='section_title'}</a></td>
	</tr>
	<tr>
		<td><a href="{$docroot}{$smarty.const.ADMIN_DIR}convert_profile_questions.php" class="panellink">{lang mkey='generate_prof_quest_file'}</a></td>
	</tr>
{/if}
{if $smarty.session.Permissions.banner_mgt == 1}
	<tr>
		<td><a href="{$docroot}{$smarty.const.ADMIN_DIR}managebanner.php" class="panellink">{lang mkey='manage_banners'}</a></td>
	</tr>
{/if}
{/if}
{* Financial *}
{if $smarty.session.Permissions.mship_mgt == 1 or $smarty.session.Permissions.payment_mgt == 1}
	<tr >
		<td height="16" width="100%" class="panellinkhdr">&nbsp;{lang mkey='financial'}</td>
	</tr>
{if $smarty.session.Permissions.mship_mgt == 1}
	<tr>
		<td><a href="{$docroot}{$smarty.const.ADMIN_DIR}membership.php" class="panellink">{lang mkey='manage_membership'}</a></td>
	</tr>
	<tr>
		<td><a href="{$docroot}{$smarty.const.ADMIN_DIR}mship_expiry_reminders.php" class="panellink">{lang mkey='expiry_ltr'}</a></td>
	</tr>
{/if}
{if $smarty.session.Permissions.payment_mgt == 1}
	<tr>
		<td><a href="{$docroot}{$smarty.const.ADMIN_DIR}paymentmod.php" class="panellink">{lang mkey='payment_modules'}</a></td>
	</tr>
	<tr>
		<td><a href="{$docroot}{$smarty.const.ADMIN_DIR}transactions.php" class="panellink">{lang mkey='trans_rep'}</a></td>
	</tr>
{/if}
{* PROMO CODE START *}
{if $smarty.session.Permissions.promo_mgt == 1}
	<tr>
		<td><a href="managepromo.php" class="panellink">{lang mkey='pmgmt'}</a></td>
	</tr>
	<tr>
		<td><a href="promoreport.php" class="panellink">{lang mkey='promorpt'}</a></td>
	</tr>
{/if}
{* PROMO CODE END *}
{/if}
{* Tools *}
{if $smarty.session.Permissions.admin_mgt == 1 or $smarty.session.Permissions.admin_permit_mgt == 1 or $smarty.session.Permissions.calendar_mgt == 1 or  $smarty.session.Permissions.change_pwd == 1 or $smarty.session.Permissions.chat_mgt == 1 or $smarty.session.Permissions.forum_mgt == 1 or $smarty.session.Permissions.import_mgt == 1  or $smarty.session.Permissions.plugin_mgt == 1  or $smarty.session.Permissions.seo_mgt == 1 or $smarty.session.Permissions.site_stats == 1 or $smarty.session.Permissions.global_mgt == 1}
	<tr >
		<td class="panellinkhdr" height="16" width="100%" >&nbsp;{lang mkey='tools'}</td>
	</tr>
{if $smarty.session.Permissions.admin_mgt == 1}
	<tr>
		<td><a href="{$docroot}{$smarty.const.ADMIN_DIR}manageadmin.php" class="panellink">{lang mkey='manage_admins'}</a></td>
	</tr>
{/if}
{if $smarty.session.Permissions.admin_permit_mgt == 1}
	<tr>
		<td><a href="{$docroot}{$smarty.const.ADMIN_DIR}adminpermissions.php" class="panellink">{lang mkey='admin_permissions'}</a></td>
	</tr>
{/if}
{if $smarty.session.Permissions.calendar_mgt == 1}
	<tr>
		<td><a href="{$docroot}{$smarty.const.ADMIN_DIR}calendar.php" class="panellink">{lang mkey='calendar_admin'}</a></td>
	</tr>
	<tr>
		<td><a href="{$docroot}{$smarty.const.ADMIN_DIR}calendarview.php" class="panellink" target="new">{lang mkey='calendar_title'}</a></td>
	</tr>
{/if}
{if $smarty.session.Permissions.change_pwd == 1}
	<tr>
		<td><a href="{$docroot}{$smarty.const.ADMIN_DIR}changepwd.php" class="panellink">{lang mkey='change_password'}</a></td>
	</tr>
{/if}
{if $smarty.session.Permissions.chat_mgt == 1}
	<tr>
		<td class="panelbox"><a href="#" class="panellink" onclick="javascript:document.frmChat.submit(); return(false);">{lang mkey='chat'}</a>
<form name='frmChat' id='frmChat' action="{$docroot}chat/flashchat_osdate.php" method='get'>
<input type="hidden" name='username' value="{$smarty.session.UserName}" />
<input type="hidden" name='whatIneed' value="{$smarty.session.whatIneed}" />
</form>
</td>
	</tr>
{/if}
{if $smarty.session.Permissions.forum_mgt == 1}
	<tr>
		<td class="panelbox"><a href="#" class="panellink" onclick="javascript:document.frmForum.submit(); return(false);">{lang mkey='manageforum'}</a>
		{if ( $config.forum_installed == 'phpBB' || $config.forum_installed == 'phpBB3'|| $config.forum_installed == 'myBB'|| $config.forum_installed == 'vBulletin' || $config.forum_installed== 'Phorum' ||$config.forum_installed == 'myBB14' ||$config.forum_installed == 'smf11') && $config.forum_path != 'None' && $config.forum_path != ''  }
			<form name='frmForum' id='frmForum' action="{$docroot}forum/login_osdate.php" method='post' {if $config.forum_display_in_same_window != 'Y'} target="new"{/if}>
			<input type="hidden" name='do' value="login" />
			<input type="hidden" name='admin' value="1" />
			<input type="hidden" name='username' value="{$smarty.session.UserName}" />
			<input type="hidden" name='password' value="{$smarty.session.whatIneed}" />
			</form>
		{else}
			<form name='frmForum' id='frmForum' action="noforums.php" method='post' >
			</form>
		{/if}
		</td>
	</tr>
{/if}
{if $smarty.session.Permissions.import_mgt == 1 }
	<tr>
		<td><a href="{$docroot}{$smarty.const.ADMIN_DIR}import.php" class="panellink">{lang mkey='import'}</a></td>
	</tr>
{/if}
 {if $smarty.session.Permissions.plugin_mgt == 1 }
	<tr>
	   <td><a href="{$docroot}{$smarty.const.ADMIN_DIR}pluginlist.php" class="panellink">{lang mkey='plugin'}</a></td>
	</tr>
 {/if}
{if $smarty.session.Permissions.seo_mgt == 1}
	<tr>
		<td><a href="{$docroot}{$smarty.const.ADMIN_DIR}seo.php" class="panellink">{lang mkey='seo'}</a></td>
	</tr>
{/if}
{if $smarty.session.Permissions.site_stats == 1}
	<tr>
		<td><a class="panellink" href="{$docroot}{$smarty.const.ADMIN_DIR}panel.php">{lang mkey='site_statistics'}</a></td>
	</tr>
{/if}
{if $smarty.session.Permissions.global_mgt == 1}
	<tr>
		<td><a href="{$docroot}{$smarty.const.ADMIN_DIR}editgblsettings.php" class="panellink">{lang mkey='gbl_settings'}</a></td>
	</tr>
{/if}
	<tr>
		<td><a href="{$docroot}{$smarty.const.ADMIN_DIR}optimize_tables.php" class="panellink">{lang mkey='taboptimize'}</a></td>
	</tr>
{/if}
{if $smarty.session.Permissions.plugin_mgt == 1 && $modosdate_amenu|@count > 0}
{* Plugins *}
	<tr >
		<td height="16" width="100%" class="panellinkhdr">&nbsp;{lang mkey='plugin'}</td>
	</tr>
		 {* The modosdate_umenu is defined when modOsDate is created in init.php*}
		 {foreach item=item key=key from=$modosdate_amenu}
		 <tr>
			<td><a class="panellink" href="{$item.href}">{$item.text}</a></td>
		 </tr>
		 {/foreach}
{/if}
</table>
