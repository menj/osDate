{strip}
<script type="text/javascript">
/* <![CDATA[ */
function checkMe()
{ldelim}
	if (document.frmNews.txttitle.value == ''){ldelim}
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
{assign var="page_hdr01_text" value='<a href="managenews.php" class="subhead">'|cat:"{lang mkey='manage_news'}"|cat:'</a>'}
{assign var="page_title" value="{lang mkey='manage_news'}"}
{include file="admin/admin_page_hdr01.tpl"}
<div class="top_margin_6px" style="text-align:left;">
	{assign var="page_hdr02_text" value="{lang mkey='insert_news'}"}
	{include file="admin/admin_page_hdr02.tpl"}
	<div class="module_detail_inside">
		{if $error_msg != ''}
			{assign var="display_error" value=$error_msg}
			{include file="display_error.tpl"}
		{/if}
		<div class="line_outer">
			<form method="post" action="savenews.php" name="frmNews">
				<table border="0" cellpadding="1" cellspacing="2" >
					<tr><td>{lang mkey='news_header'}:<font color="{lang mkey='required_info_indicator_color'}">{lang mkey='required_info_indicator'}</font></td>
						<td><input type="text" class="textinput"  name="txttitle" size="50" value="{$smarty.session.txttitle}" /></td>
					</tr>
					<tr><td>{lang mkey='dat'}</td>
						<td>
							{html_select_date_translated prefix="txt" end_year="+5" month_value_format="%B" time=$smarty.session.txtdate}
						</td>
					</tr>
					<tr><td colspan="2"><textarea name="txttext" id="txttext" style="width:550px;height:300px;">{$smarty.session.txttext 
					}</textarea></td></tr>
					<tr><td colspan="2" align="center"><input type="submit" class="formbutton" value="{lang mkey='submit'}" onclick="return checkMe();" /></td></tr>
				</table>
			</form>
		</div>
	</div>
</div>
<script type="text/javascript">
/* <![CDATA[ */
	enableWYSIWYG('txttext');
/* ]]> */
</script>
{/strip}