{strip}
{if $config.use_profilepopups == 'Y' or $smarty.session.AdminId > 0}
{include file="popheader.tpl"}
{/if}
{* <script type="text/javascript" src="{$DOC_ROOT}javascript/enlargeit.js"></script>  *}
<div class="module_detail_inside" style="vertical-align:top;width:100%;" >
	{assign var="page_hdr01_text" value=$username|cat:"\'s "|cat:"{lang mkey='video_gallery'}"}
	{assign var="page_title" value="{lang mkey='video_galery'}"}
	{include file="page_hdr01.tpl"}
	<div >
		{if $error_message != ''}
			{include file="display_error.tpl" }
		{/if}
		<form name="album01" action="uservideogallery.php" method="post" >
			<input type="hidden" name="username" value="{$username}"/>
			<input name="userid" type="hidden" value="{$userid}"/>
			<div class="line_outer">
				{lang mkey='album_hdr'}:&nbsp;&nbsp;
				<select name="album_id" >
				<option value="" selected>{lang mkey='public'}</option>
				{if $useralbums|@count > 0 }
				{foreach from=$useralbums item=album}
				<option value="{$album.id}" {if $album.id== $album_id} selected {/if}>{$album.name}</option>
				{/foreach}
				{/if}
				</select>
				{if $smarty.session.UserId != $userid }
				&nbsp;&nbsp;&nbsp;
				{lang mkey='signup_password'}&nbsp;
				<input name="album_passwd" type="password" class="textinput" size="15"/>
				{else}
				<input name="album_passwd" type="hidden" value='' size="15"/>
				{/if}
				&nbsp;&nbsp;
				<input type="submit" class="formbutton"  value="{lang mkey='show'}"/>
				&nbsp;&nbsp;
				{if $smarty.session.expired != 1 and $smarty.session.active == '1' and ( $smarty.session.status == $lang.status_enum.active or $smarty.session.status == 'Active') and $smarty.session.security.allow_videos == 1  and $smarty.session.security.videoscnt > 0 and $userid == $smarty.session.UserId}
				<a href="#" class="panellink" onclick="javascript: {if $config.use_profilepopups == 'Y'} opener{else}window{/if}.location='uploadvideos.php?userid={$userid}'; {if $config.use_profilepopups == 'Y'}window.close();{/if}" >{lang mkey='manage_videos'}</a>
				{/if}
			</div>
		</form>
		<div class="line_outer" style="width:100%;">
		{if $pics|count <= 0}
			{assign var="error_message" value="{lang mkey='errormsgs' skey=82}" }
			{include file="display_error.tpl" }
		{else}
			{assign var="cntr" value="1"}
			{assign var="vdcnt" value=0}
			<table cellspacing="2" cellpadding="2" width="100%" border="0">
			{foreach item=pic from=$pics}
				<tr>
					<td width="60%">
						<textarea readonly cols="40" rows="5">{$pic.video_descr }</textarea>
					</td>
					<td valign="middle">
						{lang mkey='play_video'}:&nbsp;
						<img src="{$docroot}images/play_video.jpg" onclick="enlarge(this);" alt="video no {$pic.videono}"
						{if $pic.ext == 'yt'}
							longdesc="swf::http://www.youtube.com/v/{$pic.ytref}&amp;fs=1&amp;rel=0::{$config.disp_video_width}::{$config.disp_video_height}"
						{elseif $pic.ext == 'swf'}
							longdesc="swf::{$smarty.const.DOC_ROOT}{$pic.fullfilename}::{$config.disp_video_width}::{$config.disp_video_height}"
						{elseif $pic.ext == 'flv'}
							longdesc="flv::{$smarty.const.DOC_ROOT}{$pic.fullfilename}::{$config.disp_video_width}::{$config.disp_video_height}"
						{else}
							longdesc="dvx::{$config.siteurl}{$pic.fullfilename}::{$config.disp_video_width}::{$config.disp_video_height}"
						{/if}
						/>
					</td>
				</tr>
			{/foreach}
			</table>
		{/if}
		</div>
	</div>
</div>
{if $config.use_profilepopups == 'Y'}
{include file="popfooter.tpl"}
{/if}
{/strip}