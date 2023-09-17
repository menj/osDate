{strip}
<script type="text/javascript">
/* <![CDATA[ */
function checkMe()
{ldelim}
	if (document.bannerfrm.txtbanner.value == '' || document.bannerfrm.txtlinkurl.value == ''  ){ldelim}
		alert("{$lang.required_info}");
		return false;
	{rdelim}
	document.bannerfrm.submit();
{rdelim}
/* ]]> */
</script>
{assign var="page_hdr01_text" value='<a href="plugin.php?plugin=langBanners" class="subhead">'|cat:$lang.manage_banners|cat:'</a>'}
{include file="admin/admin_page_hdr01.tpl"}
<div class="module_detail_inside top_margin_6px" style="width:100%">
			{assign var="page_hdr02_text" value=$lang.add_banners}
			{include file="admin/admin_page_hdr02.tpl"}
		<div style="padding-left: 4px;">
      <form name="bannerfrm" action="plugin.php?plugin=langBanners&amp;action=savebanner" method="post" enctype="multipart/form-data">
			{if $error }
			    {assign var="error_message" value=$error}
			    {include file="display_error.tpl"}
			{/if}
			<table cellspacing="{$config.cellspacing}" cellpadding="{$config.cellpadding}" width="550">
			    <tr> <td>{$lang.banner}<font color="{lang mkey='required_info_indicator_color'}">{lang mkey='required_info_indicator'}</font></td><td><input type="file" name="txtbanner" size="35" /></td></tr>
			    <tr> <td>{$lang.language}<font color="{lang mkey='required_info_indicator_color'}">{lang mkey='required_info_indicator'}</font></td><td>{html_options name="language" options=$langopt  selected=$data.language}</td></tr>
			    <tr> <td>{$lang.linkurl}<font color="{lang mkey='required_info_indicator_color'}">{lang mkey='required_info_indicator'}</font></td><td>http://<input type="text" name="txtlinkurl" size="28" /></td></tr>
				<tr> <td>{lang mkey='link_target'}:</td>
					<td>
						<select name="link_target">
							<option value="_blank" {if $smarty.session.newBanner.link_target == '_blank' or $smarty.session.newBanner.link_target == ''}selected{/if}>_blank</option>
							<option value="_self" {if $smarty.session.newBanner.link_target == '_self'}selected{/if}>_self</option>
							<option value="_parent" {if $smarty.session.newBanner.link_target == '_parent'}selected{/if}>_parent</option>
						</select>
					</td>
				</tr>
			    <tr> <td>{$lang.tooltip}</td><td><input type="text" name="txttooltip" size="35" /></td></tr>
			    <tr> <td>{$lang.startdate}</td><td>{html_select_date_translated prefix="txtstart" end_year="+10" }</td></tr>
			    <tr> <td>{$lang.enddate}</td><td>{html_select_date_translated prefix="txtend" end_year="+10" }</td></tr>
				<tr><td colspan="2" align="center"><br /><input type="button" class="formbutton" value="{lang mkey='submit'}" onclick="javascript: checkMe();" /></td></tr>
			</table>
    	</form>
		</div>
</div>
{/strip}