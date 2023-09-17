{strip}
{if $config.use_profilepopups == 'Y' or $smarty.session.AdminId > 0}
{include file="admin/popheader.tpl"}
{/if}
<div style="vertical-align:top;" >
	{if $type == 'gallery'}
		{assign var="page_hdr01_text" value=$username|cat:"\'s "|cat:"{lang mkey='picture_gallery'}"}
		{assign var="page_title" value="{lang mkey='picture_gallery'}"}
		{if $userid == $smarty.session.UserId}
			{if $config.use_profilepopups == 'Y'}
				{assign var="page_hdr01_text_r" value='<a href="#" onclick="javascript:mainLink(\'userpics.php?type='|cat:$type|cat:'\'); window.close(); return false;" class="subhead">'|cat:"{lang mkey='upload_pictures'}"|cat:'</a>&nbsp;&nbsp;'}
			{else}
				{assign var="page_hdr01_text_r" value='<a href="userpics.php?type='|cat:$type|cat:'" class="subhead">'|cat:"{lang mkey='upload_pictures'}"|cat:'</a>&nbsp;&nbsp;'}
			{/if}
		{/if}
	{else}
		{assign var="page_hdr01_text" value=$username|cat:"\'s "|cat:"{lang mkey='profilepics_gallery'}"}
		{assign var="page_title" value="{lang mkey='profilepics_gallery'}"}
		{if $userid == $smarty.session.UserId}
			{if $config.use_profilepopups == 'Y'}
				{assign var="page_hdr01_text_r" value='<a href="#" onclick="javascript:mainLink(\'userpics.php?type='|cat:$type|cat:'\'); window.close(); return false;" class="subhead">'|cat:"{lang mkey='upload_profilepics'}"|cat:'</a>&nbsp;&nbsp;'}
			{else}
				{assign var="page_hdr01_text_r" value='<a href="userpics.php?type='|cat:$type|cat:'" class="subhead">'|cat:"{lang mkey='upload_profilepics'}"|cat:'</a>&nbsp;&nbsp;'}
			{/if}
		{/if}
	{/if}
	{include file="admin/admin_page_hdr01.tpl"}
	<div class="module_detail_inside" style="padding-top: 4px;">
	{if $err != '' }
		{include file="display_error.tpl"}
	{/if}
	{if $useralbums|@count > 0 }
		<form name="album01" action="userpicgallery.php" method="post" >
		<input type="hidden" name="username" value="{$username}"/>
		<input name="id" type="hidden" value="{$userid}" />
		<input type="hidden" name="type" value="{$type}" />
		<div class="line_outer" style="margin-left: 6px; margin-top: 6px; margin-bottom: 3px;">
			{lang mkey='album_hdr'}:&nbsp;&nbsp;
			<select name="album_id" >
			{foreach from=$useralbums item=album}
				<option value="{$album.id}" {if $album.id== $album_id} selected {/if}>{$album.name}</option>
			{/foreach}
			</select>
		{if $albumpasswd > 0 }
			{if $smarty.session.UserId != $userid }
				&nbsp;&nbsp;&nbsp;
				{lang mkey='signup_password'}&nbsp;
				<input name="album_passwd" type="password" class="textinput" size="15"/>
			{else}
				<input name="album_passwd" type="hidden" value='' size="15"/>
			{/if}
		{/if}
			&nbsp;&nbsp;
			<input type="submit" class="formbutton" value="{lang mkey='show'}"/>
			&nbsp;&nbsp;
		{if $smarty.session.expired != 1 and $smarty.session.active == '1' and ( $smarty.session.status == $lang.status_enum.active or $smarty.session.status == 'Active') and $smarty.session.security.uploadpicture == 1  and $smarty.session.security.uploadpicturecnt > 0 and $userid == $smarty.session.UserId}
			{if $config.use_profilepopups == 'Y'}
				<a href="#" class="panellink" onclick=="javascript:mainLink(\'userpics.php?type={$type}\'); window.close(); return false;">{lang mkey='upload_pictures'}</a>
			{else}
				<a href="userpics.php?type={$type}" class="panellink">{lang mkey='upload_pictures'}</a>
			{/if}
		{/if}
		</div>
	    </form>
	{/if}
	{if $pics|@count <= 0}
		{assign var="error_message" value="{lang mkey='errormsgs' skey=82}" }
		{include file="display_error.tpl"}
	{else}
		{assign var="cntr" value="1"}
		{assign var="galpicid" value=""}
		{if $smarty.get.galpicid != ''}
			{assign var="galpicid" value=$smarty.get.galpicid}
		{/if}
	{foreach item=pic from=$pics}
		{if $galpicid == ''}
			{assign var="galpicid" value=$pic.picno}
		{/if}
		{if $cntr==1}<div style="margin: 2px 6px 2px 6px">{/if}
			<div style="display:inline; float:left;">
				<img src="getsnap.php?id={$userid}&amp;typ=tn&amp;picid={$pic.picno}&amp;album_id={$album_id}" alt="{$pic.picno}"  onclick="enlarge(this);" longdesc="getsnap.php?id={$userid}&amp;typ=full&amp;picid={$pic.picno}&amp;album_id={$album_id}" id="pic{$pic.picno}" border="0" class="smallpic" title="{$pic.pic_descr}" />&nbsp;
			</div>
			{if $cntr == $config.album_tnpics_cnt}
				<div style="clear:both;"></div>
				</div>
				{assign var="cntr" value="1"}
			{else}
				{assign var="cntr" value=$cntr+1}
			{/if}
	{/foreach}
	{if $cntr <= $config.album_tnpics_cnt}
		<div style="clear:both;"></div>
	</div>
	{/if}
	{/if}
	</div>
</div>
{if $config.use_profilepopups == 'Y'}
	{include file="admin/popfooter.tpl"}
{/if}
{/strip}