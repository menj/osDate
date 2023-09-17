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

<div style="vertical-align:top;" >
	{assign var="page_hdr01_text" value="{lang mkey='section_blog_title'}"}
	{assign var="page_title" value="{lang mkey='section_blog_title'}"}
	{include file="page_hdr01.tpl"}
	<div class="module_detail_inside">
	{if $error_message neq ""}
		{include file="display_error.tpl"}
	{/if}

	<form name="frmEditPref" method="post" action="addblog.php">
	<input type="hidden" name="action" value="add_blog"/>
	<div style="width:98%; padding-left: 6px;" >
		<div style="clear:both; margin-top: 6px; margin-bottom: 6px;">
			{assign var="blog_nav_opt" value="new"}
			{include file="blog_nav.tpl"}
			<font class="required_info">{$smarty.const.REQUIRED_INFO}</font>{lang mkey='required_info_indication'}
		</div>
		<div  style="width:100%;" >
			{assign var="page_hdr02_text" value="{lang mkey='blog_subtitle_add'}"}
			{include file="page_hdr02.tpl"}
			<br />
			{lang mkey='blog_posted_date'}<font class="required_info">{$smarty.const.REQUIRED_INFO}</font><br />
			<input id="date_posted" type="hidden" name="date_posted" value="{$date_posted}" />
			<div id="calendar1_container">
			{literal}
				<script type="text/javascript">new Epoch('cal1','flat',document.getElementById('calendar1_container'),false);
			</script>
			{/literal}
			</div>
			{$blog_calendar_form}<br /><br />
			{lang mkey='blog_title'}<font class="required_info">{$smarty.const.REQUIRED_INFO}</font>
			<br />
			<textarea name="title" id="title" style="width:550px; height:120px;" >{$data.title|stripslashes }</textarea>
			<br /><br />
			<div>
				<div style="width: 15%; float: left;">
					{lang mkey='blog_story'}<font class="required_info">{$smarty.const.REQUIRED_INFO}</font>
				</div>
				<div style="display:inline; float:left; padding-left: 10px; ">
					<div style="display:inline; float:left; vertical-align: middle;">
						{lang mkey="blog_save_template"}
						&nbsp;&nbsp;
					</div>
					<div style="display:inline; float:left;">
						<input type="checkbox" name="save_template" value="1" />
						&nbsp;&nbsp;
					</div>
					{if $loadtemp }
					<div style="display:inline; float:left;"
							<input type=submit name="load_template" value="{lang mkey='blog_load_template'}" />&nbsp;&nbsp;
					</div>
					{/if}
					<div style="clear:both;"></div>
				</div>
				<div style="clear:both;"></div>
			</div>
			<textarea name="story" id="story" style="width:550px; height:120px;" >{$data.story|stripslashes }</textarea>
			<br /><br />
			<center>
				<input type="submit" class="formbutton" value='{lang mkey='submit'}'/> <input type="reset" class="formbutton" value="{lang mkey='reset'}"/>
			</center>
		</div>
	</div>
	</form>
	</div>
</div>
<br />
{/strip}
