{strip}
<script type="text/javascript" src="{$docroot}javascript/cascade.js"></script>

<script type="text/javascript" src="{$DOC_ROOT}javascript/tiny_mce/tiny_mce.js"></script>
{literal}
<script type="text/javascript">
	// Default skin
	tinyMCE.init({
		// General options
		mode : "exact",
		theme : "advanced",
		elements: "description",
		theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,formatselect,fontselect,fontsizeselect",
		theme_advanced_buttons3 :"",
		theme_advanced_buttons4 :"",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : true
	});
</script>
{/literal}
<div style="vertical-align:top;" >
{assign var="page_hdr01_text" value="{lang mkey='section_blog_title'}"}
{assign var="page_title" value="{lang mkey='section_blog_title'}"}
{include file="admin/admin_page_hdr01.tpl"}
<div class="module_detail_inside" style="padding-top:2px;">
	{if $error_message neq ""}
		{include file="display_error.tpl"}
	{/if}
		<div class="line_top_bottom_pad">
			{assign var="blog_nav_opt" value="settings"}
			{include file="blog_nav.tpl"}
		</div>
		{assign var="page_hdr02_text" value="{lang mkey='section_blog_info'}"}
		{include file="admin/admin_page_hdr02.tpl"}
		<form name="frmEditPref" method="post" action="blogsettings.php">
		<input type="hidden" name="action" value="edit_pref" />
		<div class="line_outer" style="text-align:left;">
			<div style="line_top_bottom_pad">
				<font class="required_info">{$smarty.const.REQUIRED_INFO}</font>{lang mkey='required_info_indication'}
			</div>
			<table width="100%" border="0" cellspacing="{$config.cellspacing}" cellpadding="{$config.cellpadding}">
				<tr>
					<td width="25%">{lang mkey='blog_name'}
					<font class="required_info">{$smarty.const.REQUIRED_INFO}</font></td>
					<td height="75%"> <input class="textinput" size="55" maxlength="255" name="name" value="{$row.name|stripslashes}"/> </td>
				</tr>
				<tr>
					<td colspan="2">{lang mkey='blog_description'}
					<font class="required_info">{$smarty.const.REQUIRED_INFO}</font> {* <div style="padding: 5px">{$description_spellchecker_link}</div>*}</td>
				</tr>
				<tr>
					<td colspan="2"> <textarea name="description" id="description" style="width:550px; height:200px;">{$blog_description_form }</textarea></td>
				</tr>
				<tr>
					<td>{lang mkey='blog_members_comment'}
					<font class="required_info">{$smarty.const.REQUIRED_INFO}</font></td>
					<td> {html_yes_no name="members_comment" value=$row.members_comment} </td>
				</tr>
				<tr>
					<td>{lang mkey='blog_buddies_comment'}
					<font class="required_info">{$smarty.const.REQUIRED_INFO}</font></td>
					<td> {html_yes_no name="buddies_comment" value=$row.buddies_comment} </td>
				</tr>
				<tr>
					<td>{lang mkey='blog_members_vote'}
					<font class="required_info">{$smarty.const.REQUIRED_INFO}</font></td>
					<td> {html_yes_no name="members_vote" value=$row.members_vote} </td>
				</tr>
				<tr>
					<td>{lang mkey='blog_gui_editor'}
					<font class="required_info">{$smarty.const.REQUIRED_INFO}</font></td>
					<td> {html_yes_no name="gui_editor" value=$row.gui_editor} </td>
				</tr>
				<tr>
					<td>{lang mkey='blog_max_comments'}
					<font class="required_info">{$smarty.const.REQUIRED_INFO}</font></td>
					<td><input class="textinput" name="max_comments" value="{$row.max_comments}" size="3"/> </td>
				</tr>
				<tr valign="top">
					<td>{lang mkey='blog_bad_words'}<font class="required_info">{$smarty.const.REQUIRED_INFO}</font><p> <i>{lang mkey='blog_bad_words_help'}</i>
					</td>
					<td><textarea name="bad_words" cols="20" rows="10">{$row.bad_words }</textarea></td>
				</tr>
			</table>
			<div class="line_top_bottom_pad">
				<input type="submit" class="formbutton" value='{lang mkey='submit'}'/> <input type="reset" class="formbutton" value="{lang mkey='reset'}"/>
			</div>
		</div>
		</form>
	</div>
</div>
<br />
{/strip}
