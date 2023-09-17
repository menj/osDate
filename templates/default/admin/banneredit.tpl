{strip}
{assign var="page_hdr01_text" value='<a href="managebanner.php" class="subhead">'|cat:"{lang mkey='manage_banners'}"|cat:'</a>'}
{assign var="page_title" value="{lang mkey='manage_banners'}"}
{include file="admin/admin_page_hdr01.tpl"}
<div class="top_margin_6px">
	{assign var="page_hdr02_text" value="{lang mkey='edit_banners'}"}
	{include file="admin/admin_page_hdr02.tpl"}
	<div class="module_detail_inside"  style="padding-top:1px;">
		{if $smarty.get.errid > 0}

			{assign var="error_message" value="{lang mkey='banner_error_msgs' skey=$smarty.get.errid}" }
			{include file="display_error.tpl"}
		{/if}
		<div class="line_outer">
			<form name="bannerfrm" action="modifybanner.php" method="post" enctype="multipart/form-data">
				<input type="hidden" value="{$data.id}" name="txtid" />
				{if $data.size !='text'}
				<div class="line_top_bottom_pad" style="text-align:center;">
					{if $data.type == 'jpg' || $data.type == 'gif' || $data.type == 'bmp'|| $data.type == 'png' }
							<img src="{$banner_dir}{$data.name}" width="{$data.width}" height="{$data.height}" alt="" />
							<br /><a href="{$data.linkurl}" target="_blank">{$data.linkurl}</a>
					{else}
						<object classid='clsid:D27CDB6E-AE6D-11cf-96B8-444553540000' codebase='http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0'>
						<param name='movie' value="{$banner_dir}{$data.name}">
						<param name='quality' value='high'>
						<embed src="{$banner_dir}{$data.name}" quality='high' pluginspage='http://www.macromedia.com/go/getflashplayer' type='application/x-shockwave-flash'></embed></object>
						<br /><a href="http://{$data.linkurl}" target="_blank">{$data.linkurl}</a>
					{/if}
				</div>
				{/if}
				<table cellspacing="{$config.cellspacing}" cellpadding="{$config.cellpadding}" width="550">
					<tr> <td valign="top">{lang mkey='banner'}</td>
						 <td>
						{if $data.size != 'text'}
							 <input type="file" name="txtbanner" size="50" />
						{else}
							<textarea name="textbannertxt" cols="50" rows="10">{$data.bannerurl }</textarea>
						{/if}
						 </td>
					</tr>
					{if $data.size != 'text'}
					<tr> <td>{lang mkey='linkurl'}</td>
						<td><input type="text" class="textinput" name="txtlinkurl" size="35" value="{$data.linkurl}" /></td>
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
					<tr> <td>{lang mkey='tooltip'}</td>
						<td><input type="text" class="textinput"  name="txttooltip" size="35" value="{$data.tooltip}" /></td>
					</tr>
					{/if}
					<tr> <td>{lang mkey='startdate'}</td>
						<td>{html_select_date_translated prefix="txtstart"  time=$data.startdate end_year="+10" }</td>
					</tr>
					<tr> <td>{lang mkey='enddate'}</td>
						<td>{html_select_date_translated prefix="txtend"  time=$data.expdate end_year="+10"}</td>
					</tr>
					<tr><td></td><td><input type="submit" class="formbutton" value="{lang mkey='modify'}" /></td></tr>
				</table>
			</form>
		</div>
	</div>
</div>
{/strip}