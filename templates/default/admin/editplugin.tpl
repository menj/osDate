{strip}
{assign var="page_hdr01_text" value="{lang mkey='section_plugin_title'}"}
{assign var="page_title" value="{lang mkey='section_plugin_title'}"}
{include file="admin/admin_page_hdr01.tpl"}
{if $error_message neq ""}
	{include file="display_error.tpl" }
{/if}
<div  style="padding-top:6px;">
	{assign var="page_hdr02_text" value="<a href=\"pluginlist.php\" >"|cat:"{lang mkey='section_plugin_list'}</a> >> "}
	{assign var="page_hdr02_text" value=$page_hdr02_text|cat:"{lang mkey='plugin_subtitle_edit'}: "|cat:$data.display_name}
	{include file="admin/admin_page_hdr02.tpl"}
	<div class="module_detail_inside" style="padding-top:1px; text-align:left;">
		<div class="line_outer">
			<div style="padding-top:1px; padding-bottom:2px;"
				<font class="required_info">{$smarty.const.REQUIRED_INFO}</font> {lang mkey='required_info_indication'}<br />
			</div>
			<form name="frmEditPref" method="post" action="editplugin.php">
				<input type="hidden" name="action" value="edit_plugin"/>
				<input type="hidden" name="name" value="{$data.name}"/>
				<table width="100%" border="0" cellspacing="{$config.cellspacing}" cellpadding="0">
					<tr class="evenrow">
						<td width="30%">{lang mkey='plugin_active'}
							<font class="required_info">{$smarty.const.REQUIRED_INFO}</font></td>
						<td width="60%">
							{html_yes_no name="active" value=$data.active}
						</td>
					</tr>
				{assign var="class" value="oddrow"}
				{foreach item=item key=key from=$access}
					<tr class="{$class}">
						<td class="left_padding_2px">{$item.name} {lang mkey='plugin_access'}
							<font class="required_info">{$smarty.const.REQUIRED_INFO}</font></td>
						<td class="left_padding_2px">
							{html_yes_no name=$item.radioname value=$item.access selected=$item.access}
						</td>
					</tr>
				{if $class=='oddrow'}
					{assign var="class" value="evenrow"}
				{else}
					{assign var="class" value="oddrow"}
				{/if}
				{/foreach}
				{foreach item=item key=key from=$pluginconfig}
					<tr  class="{$class}">
						<td class="left_padding_2px">{$item.display}
							<font class="required_info">{$smarty.const.REQUIRED_INFO}</font>
						</td>
						<td class="left_padding_2px">
							<input type=text class="textinput" name="config_{$item.name}" value="{$item.value}" size="40"/>
						{if $item.name == 'Google API Key'}
							&nbsp;&nbsp;
							<a href="http://www.google.com/apis/maps/" target="new">Get New Key</a>
						{/if}
						</td>
					</tr>
				{if $class=='oddrow'}
					{assign var="class" value="evenrow"}
				{else}
					{assign var="class" value="oddrow"}
				{/if}
				{/foreach}
				</table>
				<div class="line_top_bottom_pad" align="center">
					<input type="submit" class="formbutton" value='{lang mkey='submit'}'/> <input type="reset" class="formbutton" value="{lang mkey='reset'}"/>
				</div>
				{if $data.name == 'advhotornot' or $data.name == 'adultQuest' or $data.name == 'autogenprofile'  or $data.name == 'langBanners' or $data.name == 'compQuest'  or $data.name == 'hotornot' or $data.name == 'advcompQuest'}
				<div class="line_top_bottom_pad" align="center">
					<a href="plugin.php?plugin={$data.name}">{lang mkey='advpluginsettings'}</a>
				</div>
				{/if}
			</form>
		</div>
	</div>
</div>
<br />
{/strip}
