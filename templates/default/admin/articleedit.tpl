{strip}
<script type="text/javascript">
/* <![CDATA[ */
function checkMe()
{ldelim}
	if (document.frmArticle.txttitle.value == '' ){ldelim}
		alert("{lang mkey='errormsgs' skey=20}");
		return false;
	{rdelim}
	return true;
{rdelim}
/* ]]> */
</script>
{if $gui_editor != '0'}
<script type="text/javascript" src="{$DOC_ROOT}javascript/tiny_mce/tiny_mce.js"></script>
{literal}
<script type="text/javascript">
	// Default skin
	tinyMCE.init({
		// General options
		mode : "exact",
		theme : "advanced",
		elements: "txttext",
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
{assign var="page_hdr01_text" value='<a href="managearticle.php" class="subhead">'|cat:"{lang mkey='manage_article'}"|cat:'</a>'}
{assign var="page_title" value="{lang mkey='manage_article'}"}
{include file="admin/admin_page_hdr01.tpl"}
<div class="top_margin_6px">
	{assign var="page_hdr02_text" value="{lang mkey='modify_article'}"}
	{include file="admin/admin_page_hdr02.tpl"}
	<div class="module_detail_inside"  style="padding-top:1px;">
		{if $error_msq neq ""}
			{assign var="error_message" value=$error_msg}
			{include file="display_error.tpl" }
		{/if}
		<div class="line_outer">
			<form method="post" name="frmArticle" action="modifyarticle.php">
				<input type="hidden" name="id" value="{$article.articleid}" />
				<table border="0" cellpadding="1" cellspacing="2" >
					<tr><td>{lang mkey='article_title'}:<font class="required_info">{$smarty.const.REQUIRED_INFO}</font></td><td><input type="text" class="textinput"  name="txttitle" size="50" value="{$article.title|stripslashes}" /></td></tr>
					<tr><td>{lang mkey='dat'}</td><td>
						{html_select_date_translated prefix="txt"  time=$article.dat|date_format end_year="+5" month_value_format="%B"}
						</td>
					</tr>
					<tr><td colspan="2"><textarea name="txttext" id="txttext" style="width:550px;height:335px;">{$article.text|stripslashes }</textarea></td>
					</tr>
					<tr><td colspan="2" align="center"><input type="submit" class="formbutton" value="{lang mkey='modify'}" onclick="return checkMe();" /></td>
					</tr>
				</table>
			</form>
		</div>
	</div>
</div>
<br />
{/strip}