{strip}
<script type="text/javascript">
/* <![CDATA[ */
function checkMe()
{ldelim}
	if (document.bannerfrm.txtlinkurl.value == '' ){ldelim}
		alert("{$lang.required_info}");
		return false;
	{rdelim}
	return true;
{rdelim}
/* ]]> */
</script>
{assign var="page_hdr01_text" value='<a href="plugin.php?plugin=langBanners" class="subhead">'|cat:$lang.manage_banners|cat:'</a>'}
{include file="admin/admin_page_hdr01.tpl"}
<form name="bannerfrm" action="plugin.php?plugin=langBanners&amp;action=modifybanner" method="post" enctype="multipart/form-data">
<div class="module_detail_inside top_margin_6px" style="width:100%">
	{assign var="page_hdr02_text" value=$lang.edit_banners}
	{include file="admin/admin_page_hdr02.tpl"}

	<input type="hidden" value="{$data.id}" name="txtid" />
	<table cellspacing="{$config.cellspacing}" cellpadding="{$config.cellpadding}" width="550">
					<tr><td align="center" colspan="2">
		{if $data.type == 'jpg' || $data.type == 'gif' || $data.type == 'bmp'|| $data.type == 'png' }
				<img src="{$bannerdir}{$data.name}" width="{$data.width}" height="{$data.height}" alt="" />
				<br /><a href="{$data.linkurl}" target="_blank">{$data.linkurl}</a>
		{else}
			<object classid='clsid:D27CDB6E-AE6D-11cf-96B8-444553540000' codebase='http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0'>
			<param name='movie' value="{$bannerdir}{$data.name}">
			<param name='quality' value='high'>
			<embed src="{$bannerdir}{$data.name}" quality='high' pluginspage='http://www.macromedia.com/go/getflashplayer' type='application/x-shockwave-flash'></embed></object>
			<br /><a href="http://{$data.linkurl}" target="_blank">{$data.linkurl}</a>
		{/if}
			</td>
		</tr>
	</table>

	{if $error }
		{assign var="error_message" value=$error}
		{include file="display_error.tpl"}
	{/if}
	<table cellspacing="{$config.cellspacing}" cellpadding="{$config.cellpadding}" width="550">
		<tr><td height="6"></td></tr>
		<tr> <td valign="top">&nbsp;{$lang.banner}</td>
			 <td><input type="file" name="txtbanner" size="35" /></td>
		</tr>

		<tr> <td>&nbsp;{$lang.linkurl}<font color="{lang mkey='required_info_indicator_color'}">{lang mkey='required_info_indicator'}</font></td>
			<td><input type="text" name="txtlinkurl" size="35" value="{$data.linkurl}" /></td>
		</tr>
		<tr> <td>{lang mkey='link_target'}:</td>
			<td>
				<select name="link_target">
					<option value="_blank" {if $data.link_target == '_blank'}selected{/if}>_blank</option>
					<option value="_self" {if $data.link_target == '_self'}selected{/if}>_self</option>
					<option value="_parent" {if $data.link_target == '_parent'}selected{/if}>_parent</option>
				</select>
			</td>
		</tr>
		<tr> <td>&nbsp;{$lang.language}:</td>
			<td>{html_options name="language" options=$langopt  selected=$data.language}</td>
		</tr>
		<tr> <td>&nbsp;{$lang.tooltip}</td>
			<td><input type="text" name="txttooltip" size="35" value="{$data.tooltip}" /></td>
		</tr>
		<tr> <td>&nbsp;{$lang.startdate}</td>
			<td>{html_select_date_translated prefix="txtstart"  time=$data.startdate end_year="+10" }</td>
		</tr>
		<tr> <td>&nbsp;{$lang.enddate}</td>
			<td>{html_select_date_translated prefix="txtend"  time=$data.expdate end_year="+10"}</td>
		</tr>
		<tr><td colspan="2" align="center"><br/><input type="submit" class="formbutton" value="{$lang.modify}" onclick="return checkMe();"/></td></tr>
	</table>
</div>
</form>
{/strip}