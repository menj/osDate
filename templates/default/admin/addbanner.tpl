{strip}
{assign var="page_hdr01_text" value='<a href="managebanner.php" class="subhead">'|cat:"{lang mkey='manage_banners'}"|cat:'</a>'}
{assign var="page_title" value="{lang mkey='manage_banners'}"}
{include file="admin/admin_page_hdr01.tpl"}
<div class="top_margin_6px">
	{assign var="page_hdr02_text" value="{lang mkey='add_banners'}"}
	{include file="admin/admin_page_hdr02.tpl"}
	<div class="module_detail_inside"  style="padding-top:1px;">
		<div class="line_outer" >
			{if $smarty.get.errid > 0 }
				{if $smarty.get.errid=='5'}
					{assign var="error_message" value=$error_message|cat:" ("|cat:$config.banner_width|cat:" x "|cat:$config.banner_height|cat:" px)" }
				{/if}
				{include file="display_error.tpl" }
			{/if}
			<form name="bannerfrm" action="savebanner.php" method="post" enctype="multipart/form-data">
				<table cellspacing="{$config.cellspacing}" cellpadding="{$config.cellpadding}" width="100%">
					<tr> <td valign="top">{lang mkey='banner'}<font class="required_info">{$smarty.const.REQUIRED_INFO}</font></td>
						<td>
							<input type="file" name="txtbanner" size="45" />
						</td>
					</tr>
					<tr> <td>{lang mkey='linkurl'}</td><td>http://<input type="text" class="textinput"  name="txtlinkurl" size="28" value="{$smarty.session.newBanner.txtlinkurl}" /></td></tr>
					<tr> <td>{lang mkey='link_target'}:</td>
						<td>
							<select name="link_target">
								<option value="_blank" {if $smarty.session.newBanner.link_target == '_blank' or $smarty.session.newBanner.link_target == ''}selected{/if}>_blank</option>
								<option value="_self" {if $smarty.session.newBanner.link_target == '_self'}selected{/if}>_self</option>
								<option value="_parent" {if $smarty.session.newBanner.link_target == '_parent'}selected{/if}>_parent</option>
							</select>
						</td>
					</tr>
					<tr> <td>{lang mkey='tooltip'}</td><td><input type="text" class="textinput"  name="txttooltip" size="35" value="{$smarty.session.newBanner.txttooltip}" /></td></tr>
					<tr><td colspan="2">
						<b>{lang mkey='textbannerads_hdr'}</b>
						<br />
						</td>
					</tr>
					<tr><td></td><td>
							<textarea name="textbannertxt" rows="10" cols="50">{$smarty.session.newBanner.textbannertxt }</textarea>
						</td>
					</tr>
					<tr> <td>{lang mkey='startdate'}</td><td>{html_select_date_translated prefix="txtstart" end_year="+3" time=$smarty.session.newBanner.txtstart}</td></tr>
					<tr> <td>{lang mkey='enddate'}</td><td>{html_select_date_translated prefix="txtend" end_year="+5" time=$end_date }</td></tr>
					<tr><td></td><td ><br /><input type="submit" class="formbutton" value="{lang mkey='submit'}" /></td></tr>
				</table>
			</form>
		</div>
	</div>
</div>
{/strip}
