<!-- dropdown panel menu -->
<div class="dropdowncontainer">
<div >
	<a href="#" onclick="return clickreturnvalue()" onmouseover="dropdownmenu(this, event, 'home')" class="dropmenulink">{lang mkey='site_links' skey='home'}</a>
	<div id="home" class="anylinkcss">
		<a href="{$docroot}{$smarty.const.ADMIN_DIR}index.php">{lang mkey='adminhome'}</a>
		<a href="{$docroot}{$smarty.const.ADMIN_DIR}index.php?page=credits">Credits</a>
		<a href="{$docroot}{$smarty.const.ADMIN_DIR}logout.php">{lang mkey='sign_out'}</a>
	</div>
</div>

<div >
	<a href="#" onclick="return clickreturnvalue()" onmouseover="dropdownmenu(this, event, 'membershdr')" class="dropmenulink">{lang mkey='membershdr'}</a>
	<div id="membershdr" class="anylinkcss">
		{if $smarty.session.Permissions.profile_mgt == 1}
			<a href="{$docroot}{$smarty.const.ADMIN_DIR}profile.php" class="panellink">{lang mkey='memberprofiles'}</a>
		{/if}
		{if $smarty.session.Permissions.profie_approval == 1}
			<a class="panellink" href="{$docroot}{$smarty.const.ADMIN_DIR}unapprovedusers.php">{lang mkey='unapproved_user'}</a>
		{/if}
		{if $config.snaps_require_approval == 'Y' && $smarty.session.Permissions.snaps_require_approval == 1}
			<a href="{$docroot}{$smarty.const.ADMIN_DIR}approve_snaps.php" class="panellink">{lang mkey='snaps_require_approval'}</a>
			<a href="{$docroot}{$smarty.const.ADMIN_DIR}approve_videos.php" class="panellink">{lang mkey='videos_require_approval'}</a>
		{/if}
		{if $smarty.session.Permissions.profile_ratings == 1}
			<a class="panellink" href="{$docroot}{$smarty.const.ADMIN_DIR}manageratings.php">{lang mkey='profile_ratings'}</a>
		{/if}
		{if $smarty.session.Permissions.profie_approval == 1}
			<a class="panellink" href="{$docroot}{$smarty.const.ADMIN_DIR}reactivate.php">{lang mkey='reactivate'}</a>
		{/if}
		{if $smarty.session.Permissions.featured_profiles_mgt == 1}
			<a href="{$docroot}{$smarty.const.ADMIN_DIR}featured_profiles.php" class="panellink">{lang mkey='featuredprofiles'}</a>
		{/if}
		{if $smarty.session.Permissions.send_letter == 1}
			<a href="{$docroot}{$smarty.const.ADMIN_DIR}sendletter.php" class="panellink">{lang mkey='send_letter'}</a>
		{/if}
		{if $smarty.session.Permissions.search == 1}
			<a href="{$docroot}{$smarty.const.ADMIN_DIR}advsearch.php?search_new=1" class="panellink">{lang mkey='membersearch'}</a>
		{/if}
		{if $smarty.session.Permissions.blog_mgt == 1}
			<a href="{$docroot}{$smarty.const.ADMIN_DIR}bloglist.php" class="panellink">{lang mkey='blog' skey="hdr"}</a>
			<a href="{$docroot}{$smarty.const.ADMIN_DIR}blogsearch.php" class="panellink">{lang mkey='blog_search_menu'}</a>
		{/if}

	</div>
</div>
<div >	<a href="#" onclick="return clickreturnvalue()" onmouseover="dropdownmenu(this, event, 'localities')" class="dropmenulink">{lang mkey='localities'}</a>
	<div id="localities" class="anylinkcss">
		{if $smarty.session.Permissions.cntry_mgt == 1 && ($config.cntry_mgt == 'Y' or $config.cntry_mgt == '1')}
			<a href="{$docroot}{$smarty.const.ADMIN_DIR}managecountries.php" class="panellink">{lang mkey='manage_country_states'}</a>
			<a href="{$docroot}{$smarty.const.ADMIN_DIR}load_cities.php" class="panellink">{lang mkey='load_cities'}</a>
			<a href="{$docroot}{$smarty.const.ADMIN_DIR}load_counties.php" class="panellink">{lang mkey='load_counties'}</a>
			<a href="{$docroot}{$smarty.const.ADMIN_DIR}load_states.php" class="panellink">{lang mkey='load_states'}</a>
			<a href="{$docroot}{$smarty.const.ADMIN_DIR}load_zips.php" class="panellink">{lang mkey='load_zips'}</a>
		{/if}
	</div>
</div>
<div >	
	<a href="#" onclick="return clickreturnvalue()" onmouseover="dropdownmenu(this, event, 'contenthdr')" class="dropmenulink">{lang mkey='contenthdr'}</a>
	<div id="contenthdr" class="anylinkcss">
		{if $smarty.session.Permissions.global_mgt == 1}
			<a href="{$docroot}{$smarty.const.ADMIN_DIR}load_language.php" class="panellink">{lang mkey='manage_languages'}</a>
		{/if}
		{if $smarty.session.Permissions.article_mgt == 1}
			<a href="{$docroot}{$smarty.const.ADMIN_DIR}managearticle.php" class="panellink">{lang mkey='manage_article'}</a>
		{/if}
		{if $smarty.session.Permissions.news_mgt == 1}
			<a href="{$docroot}{$smarty.const.ADMIN_DIR}managenews.php" class="panellink">{lang mkey='manage_news'}</a>
		{/if}
		{if $smarty.session.Permissions.pages_mgt == 1}
			<a href="{$docroot}{$smarty.const.ADMIN_DIR}managepages.php" class="panellink">{lang mkey='manage_pages'}</a>
		{/if}
		{if $smarty.session.Permissions.poll_mgt == 1}
			<a href="{$docroot}{$smarty.const.ADMIN_DIR}managepoll.php" class="panellink">{lang mkey='manage_polls'}</a>
		{/if}
		{if $smarty.session.Permissions.story_mgt == 1}
			<a href="{$docroot}{$smarty.const.ADMIN_DIR}managestory.php" class="panellink">{lang mkey='manage_story'}</a>
		{/if}
		{if $smarty.session.Permissions.section_mgt == 1}
			<a href="{$docroot}{$smarty.const.ADMIN_DIR}section.php" class="panellink">{lang mkey='section_title'}</a>
			<a href="{$docroot}{$smarty.const.ADMIN_DIR}convert_profile_questions.php" class="panellink">{lang mkey='generate_prof_quest_file'}</a>
		{/if}
		{if $smarty.session.Permissions.banner_mgt == 1}
			<a href="{$docroot}{$smarty.const.ADMIN_DIR}managebanner.php" class="panellink">{lang mkey='manage_banners'}</a>
		{/if}
	</div>
</div>


<div >	
	<a href="#" onclick="return clickreturnvalue()" onmouseover="dropdownmenu(this, event, 'financial')" class="dropmenulink">{lang mkey='financial'}</a>
	<div id="financial" class="anylinkcss">
	{if $smarty.session.Permissions.mship_mgt == 1 or $smarty.session.Permissions.payment_mgt == 1}
		{if $smarty.session.Permissions.mship_mgt == 1}
			<a href="{$docroot}{$smarty.const.ADMIN_DIR}membership.php" class="panellink">{lang mkey='manage_membership'}</a>
			<a href="{$docroot}{$smarty.const.ADMIN_DIR}mship_expiry_reminders.php" class="panellink">{lang mkey='expiry_ltr'}</a>
		{/if}
		{if $smarty.session.Permissions.payment_mgt == 1}
			<a href="{$docroot}{$smarty.const.ADMIN_DIR}paymentmod.php" class="panellink">{lang mkey='payment_modules'}</a>
			<a href="{$docroot}{$smarty.const.ADMIN_DIR}transactions.php" class="panellink">{lang mkey='trans_rep'}</a>
		{/if}
		{* PROMO CODE START *}
		{if $smarty.session.Permissions.promo_mgt == 1}
			<a href="managepromo.php" class="panellink">{lang mkey='pmgmt'}</a>
			<a href="promoreport.php" class="panellink">{lang mkey='promorpt'}</a>
		{/if}
	{* PROMO CODE END *}
	{/if}
	</div>
</div>
<div >
	<a href="#" onclick="return clickreturnvalue()" onmouseover="dropdownmenu(this, event, 'tools')" class="dropmenulink">{lang mkey='tools' }</a>
	<div id="tools" class="anylinkcss">
		{if $smarty.session.Permissions.admin_mgt == 1}
			<a href="{$docroot}{$smarty.const.ADMIN_DIR}manageadmin.php" class="panellink">{lang mkey='manage_admins'}</a>
		{/if}
		{if $smarty.session.Permissions.admin_permit_mgt == 1}
			<a href="{$docroot}{$smarty.const.ADMIN_DIR}adminpermissions.php" class="panellink">{lang mkey='admin_permissions'}</a>
		{/if}
		{if $smarty.session.Permissions.calendar_mgt == 1}
			<a href="{$docroot}{$smarty.const.ADMIN_DIR}calendar.php" class="panellink">{lang mkey='calendar_admin'}</a>
			<a href="{$docroot}{$smarty.const.ADMIN_DIR}calendarview.php" class="panellink" target="new">{lang mkey='calendar_title'}</a>
		{/if}
		{if $smarty.session.Permissions.change_pwd == 1}
			<a href="{$docroot}{$smarty.const.ADMIN_DIR}changepwd.php" class="panellink">{lang mkey='change_password'}</a>
		{/if}
		{if $smarty.session.Permissions.chat_mgt == 1}
			<a href="#" class="panellink" onclick="javascript:document.frmChat.submit(); return(false);">{lang mkey='chat'}</a>
			<form name='frmChat' id='frmChat' action="{$docroot}chat/flashchat_osdate.php" method='get'>
				<input type="hidden" name='username' value="{$smarty.session.UserName}" />
				<input type="hidden" name='whatIneed' value="{$smarty.session.whatIneed}" />
			</form>
		{/if}
		{if $smarty.session.Permissions.forum_mgt == 1}
			<a href="#" class="panellink" onclick="javascript:document.frmForum.submit(); return(false);">{lang mkey='manageforum'}</a>
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
		{/if}
		{if $smarty.session.Permissions.import_mgt == 1 }
			<a href="{$docroot}{$smarty.const.ADMIN_DIR}import.php" class="panellink">{lang mkey='import'}</a>
		{/if}
		 {if $smarty.session.Permissions.plugin_mgt == 1 }
			<a href="{$docroot}{$smarty.const.ADMIN_DIR}pluginlist.php" class="panellink">{lang mkey='plugin'}</a>
		 {/if}
		{if $smarty.session.Permissions.seo_mgt == 1}
			<a href="{$docroot}{$smarty.const.ADMIN_DIR}seo.php" class="panellink">{lang mkey='seo'}</a>
		{/if}
		{if $smarty.session.Permissions.site_stats == 1}
			<a class="panellink" href="{$docroot}{$smarty.const.ADMIN_DIR}panel.php">{lang mkey='site_statistics'}</a>
		{/if}
		{if $smarty.session.Permissions.global_mgt == 1}
			<a href="{$docroot}{$smarty.const.ADMIN_DIR}editgblsettings.php" class="panellink">{lang mkey='gbl_settings'}</a>
		{/if}
		<a href="{$docroot}{$smarty.const.ADMIN_DIR}optimize_tables.php" class="panellink">{lang mkey='taboptimize'}</a>
	</div>
</div>
{if $smarty.session.Permissions.affiliate_mgt == 1 or $smarty.session.Permissions.affiliate_stats == 1}
<div >
	<a href="#" onclick="return clickreturnvalue()" onmouseover="dropdownmenu(this, event, 'affiliates')" class="dropmenulink">{lang mkey='affiliateshdr' }</a>
	<div id="affiliates" class="anylinkcss">
		{if $smarty.session.Permissions.affiliate_mgt == 1}
		<a href="{$docroot}{$smarty.const.ADMIN_DIR}affiliatesview.php" class="panellink">{lang mkey='affiliate_title'}</a>
		{/if}
		{if $smarty.session.Permissions.affiliate_stats == 1}
		<a href="{$docroot}{$smarty.const.ADMIN_DIR}affiliatestats.php" class="panellink">{lang mkey='aff_stats'}</a>
		{/if}
	</div>
</div>
{/if}
{if $smarty.session.Permissions.plugin_mgt == 1 && $modosdate_amenu|@count > 0}
<div >
	<a href="#" onclick="return clickreturnvalue()" onmouseover="dropdownmenu(this, event, 'plugins')" class="dropmenulink">	{lang mkey='plugin'}</a>
	<div id="plugins" class="anylinkcss">
		{foreach item=item key=key from=$modosdate_amenu}
			<a  href="{$item.href}">{$item.text}</a>
		{/foreach}
	</div>
</div>
{/if}

</div>
<div style="clear:both;"></div>
