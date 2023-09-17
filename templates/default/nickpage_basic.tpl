{strip}
<div align="left" style="margin-top:2px;">
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td style="padding-left: 2px; margin-right: 2px;">
				{if $smarty.session.security.seepictureprofile == 1 or ( $smarty.session.UserId != '' && $smarty.session.UserId == $user.id) or $smarty.session.AdminId != ''}
					{if $snap_cnt > 0 }
						<a href="#" onclick="javascript:popUpWindow('userpicgallery.php?id={$user.id}','center',600,600);" class="footerlink"><img src="getsnap.php?id={$user.id}&amp;typ=pic&amp;width={$config.disp_snap_width}&amp;height={$config.disp_snap_height}" class="smallpic" style="margin:10px 20px 10px 0px;" alt="" /></a>
					{else}
						<img src="getsnap.php?id={$user.id}&amp;typ=pic&amp;width={$config.disp_snap_width}&amp;height={$config.disp_snap_height}" class="smallpic" style="margin:10px 20px 10px 0px;" alt="" />
					{/if}
				{/if}
			</td>
			<td valign="top" width="100%">
				{assign var="nickpage_hdr_text" value="{lang mkey='personal_details'}" }
				{if $smarty.session.AdminId > 0}
					{assign var="nickpage_hdr_text_r" value="<a href=\"#\" onclick=\"javascript:mainLink('profile.php?edit="|cat:$user.id|cat:"');return false;\" class='module_head' ><img src='images/button_edit.png' alt='' border='0' /></a>" }
				{elseif $smarty.session.UserId != '' && $smarty.session.UserId == $user.id}
					{if $config.use_profilepopups == 'Y'}
						{assign var="nickpage_hdr_text_r" value="<a href=\"#\" onclick=\"javascript:mainLink('edituser.php');return false;\" class='module_head' ><img src='images/button_edit.png' alt='' border='0' /></a>" }
					{else}
						{assign var="nickpage_hdr_text_r" value="<a href=\"edituser.php\" class='module_head'><img src='images/button_edit.png' alt='' border='0' /></a>" }
					{/if}
				{/if}
				{include file="nickpage_section_hdr.tpl"}
				<div  class="module_detail_inside" style="padding-top:1px;">
					{include file="nickpage_basic_address.tpl"}
				</div>
			</td>
		</tr>
	</table>
</div>
{/strip}
