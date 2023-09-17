{strip}
<script type="text/javascript" src="{$docroot}javascript/cascade.js"></script>
{* $nogui_spellchecker_js *}
{if $gui_editor != '0'}
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
{/if}

<div style="vertical-align:top;" >
	{assign var="page_hdr01_text" value="{lang mkey='section_blog_title'}"}
	{assign var="page_title" value="{lang mkey='section_blog_title'}"}
	{include file="page_hdr01.tpl"}
	<div class="module_detail_inside">
		{if $error_message != ""}
			{include file="display_error.tpl"}
		{/if}
		<form name="frmEditPref" method="post" action="blogsettings.php">
		<input type="hidden" name="action" value="edit_pref"/>
			<div >
				<div style="margin-top: 4px; margin-left:6px; margin-right:6px; line-height: 20px; vertical-align:middle; ">
					{assign var="blog_nav_opt" value="settings"}
					{include file="blog_nav.tpl"}
					<font class="required_info">{$smarty.const.REQUIRED_INFO}</font>{lang mkey='required_info_indication'}
					<div class="module_detail_inside" style=" padding-bottom:2px;">
						{assign var="page_hdr02_text" value="{lang mkey='section_blog_info'}"}
						{include file="page_hdr02.tpl"}
						<div class="line_outer" >
							<div style="width:25%; display:inline; float:left;">
								{lang mkey='blog_name'}
								<font class="required_info">{$smarty.const.REQUIRED_INFO}</font>
							</div>
							<div style="display:inline; float:left;">
								<input class="textinput" size="55" maxlength="255" name="name" value="{$row.name|stripslashes}"/>
							</div>
							<div style="clear:both;"></div>
						</div>
						<div class="line_outer" >
							{lang mkey='blog_description'}
							<font class="required_info">{$smarty.const.REQUIRED_INFO}</font>
						</div>
						<div class="line_outer" >
							<textarea name="description" id="description" style="width:360px; height:250px;" >{$row.description|stripslashes }</textarea>
						</div>
						<div class="line_outer" >
							<div style="width:25%; display:inline; float:left;">
								{lang mkey='blog_members_comment'}
								<font class="required_info">{$smarty.const.REQUIRED_INFO}</font>
							</div>
							<div style="display:inline; float:left;">
								{html_yes_no name="members_comment" value=$row.members_comment}
							</div>
							<div style="clear:both;"></div>
						</div>
						<div class="line_outer" >
							<div style="width:25%; display:inline; float:left;">
								{lang mkey='blog_buddies_comment'}
								<font class="required_info">{$smarty.const.REQUIRED_INFO}</font>
							</div>
							<div style="display:inline; float:left;">
								{html_yes_no name="buddies_comment" value=$row.buddies_comment}
							</div>
							<div style="clear:both;"></div>
						</div>
						<div class="line_outer" >
							<div style="width:25%; display:inline; float:left;">
								{lang mkey='blog_members_vote'}
								<font class="required_info">{$smarty.const.REQUIRED_INFO}</font>
							</div>
							<div style="display:inline; float:left;">
								{html_yes_no name="members_vote" value=$row.members_vote}
							</div>
							<div style="clear:both;"></div>
						</div>
						<div class="line_outer" >
							<div style="width:25%; display:inline; float:left;">
								{lang mkey='blog_gui_editor'}
								<font class="required_info">{$smarty.const.REQUIRED_INFO}</font>
							</div>
							<div style="display:inline; float:left;">
								{html_yes_no name="gui_editor" value=$row.gui_editor}
							</div>
							<div style="clear:both;"></div>
						</div>
						<div class="line_outer" >
							<div style="width:25%; display:inline; float:left;">
								{lang mkey='blog_max_comments'}
								<font class="required_info">{$smarty.const.REQUIRED_INFO}</font>
							</div>
							<div style="display:inline; float:left;">
								<input class="textinput" name="max_comments" value="{$row.max_comments}" size="3"/>
							</div>
							<div style="clear:both;"></div>
						</div>
						<div class="line_outer" >
							<div style="width:25%; display:inline; float:left; vertical-alitn:top;">
								{lang mkey='blog_bad_words'}<font class="required_info">{$smarty.const.REQUIRED_INFO}</font><p> <i>{lang mkey='blog_bad_words_help'}</i>
							</div>
							<div style="display:inline; float:left;">
								<textarea name="bad_words" cols="20" rows="10">{$row.bad_words }</textarea>
							</div>
							<div style="clear:both;"></div>
						</div>
						<center>
						<input type="submit" class="formbutton" value='{lang mkey='submit'}'/> <input type="reset" class="formbutton" value="{lang mkey='reset'}"/>
						</center>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>
<br />
{/strip}
