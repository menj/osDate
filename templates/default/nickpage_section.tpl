{strip}
{assign var="nickpage_hdr_text" value=$item.SectionName }
{if $smarty.session.AdminId > 0}
	{assign var="nickpage_hdr_text_r" value="<a href=\"#\" onclick=\"javascript:mainLink('editprofilequestions.php?edit="|cat:$user.id|cat:"&amp;sectionid="|cat:$item.SectionId|cat:"');return false;\" class='module_head' ><img src='images/button_edit.png' alt='' border='0' /></a>" }

{elseif $smarty.session.UserId != '' && $smarty.session.UserId == $user.id}
	{if $config.use_profilepopups == 'Y'}
		{assign var="nickpage_hdr_text_r" value="<a href=\"#\" onclick=\"javascript:mainLink('editquestions.php?sectionid="|cat:$item.SectionId|cat:"');return false;\" class='module_head' ><img src='images/button_edit.png' border='0' alt=''  /></a>" }
	{else}
		{assign var="nickpage_hdr_text_r" value="<a href=\"editquestions.php?sectionid="|cat:$item.SectionId|cat:"\" class='module_head'><img src='images/button_edit.png' border='0' alt=''  /></a>" }
	{/if}
{/if}

{include file="nickpage_section_hdr.tpl"}
<div class="module_detail_inside">
	<table cellspacing="{$config.cellspacing}" cellpadding="{$config.cellpadding}" border="0" width="100%">
	{assign var="previd" value="0"}
	{foreach item=subitem from=$item.preferences}

		{if $subitem.type == "select" || $subitem.type == "radio"}
			<tr class="{cycle values="oddrow,evenrow"}">
				<td valign="top" width="196" style="padding-left: 4px;"><b>{$subitem.extsearchhead}: </b></td>
				<td>
					{if $subitem.options != ''}
						{$subitem.options|stripslashes }
					{else}
						{lang mkey='tell_later'}
					{/if}
				</td>
			</tr>

		{elseif $subitem.type == "textarea"}
			<tr class="{cycle values="oddrow,evenrow"}">
				<td valign="top" width="196"  style="padding-left: 4px;"><b>{$subitem.extsearchhead}: </b></td>
				<td>
					{if $subitem.options != ''}
 						 {$subitem.options|stripslashes|nl2br }
					{else}
						{lang mkey='tell_later'}
					{/if}
				</td>
			</tr>

		{elseif $subitem.type == "checkbox"}

			<tr class="{cycle values="oddrow,evenrow"}">
				<td valign="top" width="196"  style="padding-left: 4px;"><b>{$subitem.extsearchhead}: </b></td>
				<td>
					{* fix this later in showprofile.php *}
					{if $subitem.options != '' and $subitem.options != ', '}
						{$subitem.options|stripslashes }
					{else}
						{lang mkey='tell_later'}
					{/if}
				</td>
			</tr>

		{/if}

	{/foreach}
	{assign var="previd" value=$item.id}
	</table>
</div>
{/strip}

