{strip}
{assign var="page_hdr01_text" value="{lang mkey='seo_head'}"}
{assign var="page_title" value="{lang mkey='seo_head'}"}
{include file="admin/admin_page_hdr01.tpl"}
<div class="top_margin_6px" style="text-align:left;">
	{assign var="page_hdr02_text" value="{lang mkey='sef_msg'}" }
	{include file="admin/admin_page_hdr02.tpl"}
	<div class="module_detail_inside" >
		<div class="line_outer">
		<form action="saveseo.php" method="post">
			<table cellspacing="0" cellpadding="0" border=0 width="100%" >
			<tbody>
				<tr>
					<td >{lang mkey='seo_enable'}</td>
				{if $enable_mod_rewrite == 'N' }
					<td width="45"><input type="radio" name="txtseo" value="Y" onclick="javascript: alert( '{lang mkey='yes_msg'}');" />{lang mkey='yes'}</td>
					<td width="45"><input type="radio" name="txtseo" value="N" checked="checked" />{lang mkey='no'}</td>
				{elseif $enable_mod_rewrite == 'Y' }
					<td width="45"><input type="radio" name="txtseo" value="Y" checked="checked" onclick="javascript: alert( '{lang mkey='yes_msg'}');" />{lang mkey='yes'}</td>
					<td width="45"><input type="radio" name="txtseo" value="N" />{lang mkey='no'}</td>
				{/if}
				</tr>
				<tr><td colspan="3">&nbsp;</td></tr>
				<tr>
					<td >{lang mkey='use_seo_username'}</td>
				{if $seo_username == 'N' }
					<td ><input type="radio" name="seo_username" value="Y" onclick="javascript: alert( '{lang mkey='yes_msg'}');" />{lang mkey='yes'}</td>
					<td><input type="radio" name="seo_username" value="N" checked="checked" />{lang mkey='no'}</td>
				{elseif $seo_username == 'Y' }
					<td><input type="radio" name="seo_username" value="Y" checked="checked" onclick="javascript: alert( '{lang mkey='yes_msg'}');" />{lang mkey='yes'}</td>
					<td><input type="radio" name="seo_username" value="N" />{lang mkey='no'}</td>
				{/if}
				</tr>
				<tr><td colspan="3">&nbsp;</td></tr>
				<tr>
					<td colspan="3">
						{assign var="page_hdr02_text" value="{lang mkey='page_tags_msg'}"|escape:html}
						{include file="admin/admin_page_hdr02.tpl"}
					</td>
				</tr>
				<tr>
					<td colspan="3">
						<table>
							<tr>
								<td>{lang mkey='title_colon'}</td>
								<td ><input type="text" class="textinput"  name="txttitle" value="{$site_title}" size="50" /></td>
								<td>{lang mkey='max_255'}</td>
							</tr>
							<tr><td colspan="3">&nbsp;</td></tr>
							<tr>
								<td valign="top">{lang mkey='description'}</td>
								<td><textarea name="txtdesc" cols="50" rows="5">{$meta_description|stripslashes}</textarea></td>
								<td>{lang mkey='max_255'}</td>
							</tr>
							<tr><td colspan="3">&nbsp;</td></tr>
							<tr>
								<td valign="top">{lang mkey='keywords'}</td>
								<td><textarea name="txtkeyword" cols="50" rows="5">{$meta_keywords|stripslashes}</textarea></td>
								<td>{lang mkey='max_255'}</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr><td align="center" colspan="3">	<br /><input type="submit" class="formbutton" value="{lang mkey='modify'}" /></td></tr>
			</tbody>
			</table>
		</form>
		</div>
	</div>
</div>
{/strip}