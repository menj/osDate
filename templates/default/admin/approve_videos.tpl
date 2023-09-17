{strip}
{assign var="page_hdr01_text" value="{lang mkey='videos_require_approval'}"}
{assign var="page_title" value="{lang mkey='videos_require_approval'}"}
{include file="admin/admin_page_hdr01.tpl"}
{if $errid ne ''}
	{include file="display_error.tpl" }
{/if}
<div style="margin-top: 6px;">
	{assign var="ct" value=$user_pics|@count}
	{assign var="page_hdr02_text" value="{lang mkey='total_profiles_found'} "|cat:$ct}
	{include file="admin/admin_page_hdr02.tpl"}
	<div class="module_detail_inside"  style="padding-top:1px;">
		<div class="line_outer">
			<form name="approvepics" action="approve_videos.php" method=post>
				<input type="hidden" name="id" value="" />
			<table cellspacing="{$config.cellspacing}" cellpadding="{$config.cellpadding}" width="100%" border="0">
				<tr class="column_head">
				  <th width="3%">{lang mkey='col_head_srno'}</th>
				  <th width="45%">{lang mkey='userdetails'}</th>
				  <th width="40%" align="center">{lang mkey='video'}</th>
				  <th width="7"%>{lang mkey='action'}</th>
				</tr>
				{if $user_videos|@count <= 0 }
				<tr>
					<td colspan="4">&nbsp;{lang mkey='no_record_found'}</td>
				</tr>
				{else}
				{assign var="mcount" value="0"}
					{foreach item=item key=key from=$user_videos}
					{math equation="$mcount+1" assign="mcount"}
					<tr class="{cycle values="oddrow,evenrow"}">
					  <td>{$mcount}</td>
					  <td align="left" valign="middle">
					  <table width="100%" cellpadding="{$config.cellpadding}" cellspacing="{$config.cellspacing}" border="0">
						<tr>
							<td width="30%">{lang mkey='username'}</td>
							<td align="left" width="70%">{if $config.enable_mod_rewrite == 'Y'}
								<a href="javascript:popUpScrollWindow('{if $config.seo_username == 'Y'}{$item.username}{else}{$item.userid}.htm{/if}','top',650,600)">
							{else}
								<a href="javascript:popUpScrollWindow('showprofile.php?{if $config.seo_username == 'Y'}username={$item.username}{else}id={$item.userid}{/if}','top',650,600)">
							{/if}
								{$item.username}</a></td>
						</tr>
						<tr>
							<td>{lang mkey='name'}</td>
							<td align="left" >{$item.fullname|stripslashes}</td>
						</tr>
					</table>
					</td>
					<td align="center">
						<img src="{$docroot}images/play_video.jpg" onclick="enlarge(this);" alt="video no {$item.videono}"
						{if $item.ext == 'yt'}
							longdesc="swf::http://www.youtube.com/v/{$item.ytref}&amp;fs=1&amp;rel=0::{$config.disp_video_width}::{$config.disp_video_height}"
						{elseif $item.ext == 'swf'}
							longdesc="swf::{$smarty.const.DOC_ROOT}{$item.fullfilename}::{$config.disp_video_width}::{$config.disp_video_height}"
						{elseif $item.ext == 'flv'}
							longdesc="flv::{$smarty.const.DOC_ROOT}{$item.fullfilename}::{$config.disp_video_width}::{$config.disp_video_height}"
						{else}
							longdesc="dvx::{$config.siteurl}{$item.fullfilename}::{$config.disp_video_width}::{$config.disp_video_height}"
						{/if}
						/>
					</td>
					<td >
						<input type="submit" name="action" class="formbutton" value="{lang mkey='Approve'}" onclick="javascript:document.approvepics.id.value={$item.id}; return true; " /><br />
						<input type="submit" name="action" class="formbutton" value="{lang mkey='reject'}" onclick="javascript:document.approvepics.id.value={$item.id}; return true; " />
					</td>
				</tr>
					{/foreach}
				{/if}
			</table>
			</form>
		</div>
	</div>
</div>
{/strip}