{strip}
{if $gui_editor != '0'}
<script type="text/javascript" src="{$DOC_ROOT}javascript/tiny_mce/tiny_mce.js"></script>
{literal}
<script type="text/javascript">
	// Default skin
	tinyMCE.init({
		// General options
		mode : "exact",
		theme : "advanced",
		elements: "title",
		theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,formatselect,fontselect,fontsizeselect",
		theme_advanced_buttons3 :"",
		theme_advanced_buttons4 :"",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : true
	});
	tinyMCE.init({
		// General options
		mode : "exact",
		theme : "advanced",
		elements: "story",
		theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,formatselect,fontselect,fontsizeselect",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : true
	});

</script>
{/literal}
{/if}

<div  style="vertical-align:top; padding-bottom: 6px;" >
	{assign var="page_hdr01_text" value="{lang mkey='section_blog_title'}"}
	{assign var="page_title" value="{lang mkey='section_blog_title'}"}
	{include file="page_hdr01.tpl"}
	<div class="module_detail_inside">
		{if $error_message neq ""}
			{include file="display_error.tpl"}
		{/if}
		<form name="frmEditPref" method="post" action="editblog.php">
		<input type="hidden" name="action" value="edit_blog"/>
		<input type="hidden" name="id" value="{$blog_id}"/>
			{assign var="blog_nav_opt" value="add"}
			{include file="blog_nav.tpl"}
			<div class="line_outer">
				<font class="required_info">{$smarty.const.REQUIRED_INFO}</font>{lang mkey='required_info_indication'}
			</div>
			<div class="module_detail_inside line_outer" style="width:550px">
				{assign var="page_hdr01_text" value="{lang mkey='blog_subtitle_edit'}"}
				{include file="page_hdr01.tpl"}
				<div class="line_outer">
					{lang mkey='blog_posted_date'}<font class="required_info">{$smarty.const.REQUIRED_INFO}</font>
				</div>
				<div class="line_outer">
					<input id="date_posted" type="hidden" name="date_posted" value="{$date_posted}" />
					<div id="calendar1_container">
						{literal}
							<script type="text/javascript">new Epoch('cal1','flat',document.getElementById('calendar1_container'),false);
							</script>
						{/literal}
					</div>
				</div>
				<div class="line_outer">
					{lang mkey='blog_title'}
					<font class="required_info">{$smarty.const.REQUIRED_INFO}</font> &nbsp;&nbsp;
				</div>
				<div class="line_outer">
					<textarea name="title" id="title" style="width:535px; height: 120px;">{$data.title|stripslashes }</textarea>
				</div>
				<div class="line_outer">
					{lang mkey='blog_story'}<font class="required_info">{$smarty.const.REQUIRED_INFO}</font>&nbsp;&nbsp;
				</div>
				<div class="line_outer">
					<textarea name="story" id="story" style="width:535px; height: 120px;">{$data.story|stripslashes }</textarea>
				</div>
			</div>
		<center>
		<input type="submit" class="formbutton" value='{lang mkey='submit'}'/> <input type="reset" class="formbutton" value="{lang mkey='reset'}"/>
		</center>
		</form>
	</div>
</div>
<br />
{/strip}
