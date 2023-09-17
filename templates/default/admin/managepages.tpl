{strip}
<script type="text/javascript">
/* <![CDATA[ */
function checkMe()
{ldelim}
	if (document.frmPage.txttitle.value == '' || document.frmPage.txtkey.value == '' ){ldelim}
		alert("{lang mkey='errormsgs' skey=20}");
		return false;
	{rdelim}
	return true;
{rdelim}
function confdel(form,errmsg)
{ldelim}
	if (confirm(errmsg)) {ldelim}
		document.frm1.delpage.value="{lang mkey='delete'}";
		form.submit();
	{rdelim}
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
		elements: "txtbody",
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
{assign var="page_hdr01_text" value="{lang mkey='manage_pages'}"}
{assign var="page_title" value="{lang mkey='manage_pages'}"}
{include file="admin/admin_page_hdr01.tpl"}
<div class="module_detail_inside">
	{if $error_msg ne ""}
		{assign var="error_message" value=$error_msg}
		{include file="display_error.tpl"}
	{/if}
	<div class="line_outer">
		<form method="post" action="" name="frm1">
			<table border="0">
				<tr><td width="45">
						{lang mkey='page'}
					</td>
					<td>
						<select name="txtpage" onchange="javascript: document.frm1.submit();"><option value="0" {if $curpage == '0'}selected="selected"{/if}>{lang mkey='addnew'}</option>{html_options options=$pagedata selected=$curpage}</select>
						{if $curpage != '0' && $curpage != ''}
						{* Allow deletion of page *}
							&nbsp;
							<input type="hidden" name='delpage' value='' />
							<input type="button" name="deleteme"  class="formbutton" value="{lang mkey='delete'}" onclick="javascript: return confdel(document.frm1,'{lang mkey='admin_js__delete_error_msgs' skey=27}');" />
						{/if}
					</td>
				</tr>
			</table>
		</form>
	{if $curpage == '0' or $curpage == ''}
		<form method="post" action="savepage.php" name="frmPage">
			<table border="0">
				<tr><td width="45">{lang mkey='pagetitle'}<font class="required_info">{$smarty.const.REQUIRED_INFO}</font></td>
					<td width="525"><input type="text" class="textinput"  name="txttitle" size="25" maxlength="100" value="{$pagerec.title|stripslashes}" /></td>
				</tr>
				<tr><td width="45">{lang mkey='pagekey'}<font class="required_info">{$smarty.const.REQUIRED_INFO}</font></td>
					<td width="525"><input type="text" class="textinput"  name="txtkey" size="25" value="{$pagerec.pagekey|stripslashes}" />&nbsp;{lang mkey='pagekey_help'}</td>
				</tr>
				<tr><td colspan="2">
					<textarea name="txtbody" id="txtbody" style="width:550px;height:300px;">{$pagerec.pagetext|stripslashes }</textarea></td>
				</tr>
				<tr><td colspan="2" align="center">
					<input type="submit" class="formbutton" value="{lang mkey='addpage'}" onclick="return checkMe();" />
					</td>
				</tr>
			</table>
		</form>
	{else}
		<form method="post" action="modifypage.php" name="frmPage">
			<input type="hidden" name="pageid" value="{$pagerec.id}" />
			<table border="0">
				<tr><td width="45">{lang mkey='pagetitle'}<font class="required_info">{$smarty.const.REQUIRED_INFO}</font></td>
					<td width="525"><input type="text" class="textinput"  name="txttitle" size="25" value="{$pagerec.title|stripslashes}" /></td>
				</tr>
				<tr><td width="45">{lang mkey='pagekey'}<font class="required_info">{$smarty.const.REQUIRED_INFO}</font></td>
					<td width="525"><input type="text" class="textinput"  name="txtkey" size="25" value="{$pagerec.pagekey|stripslashes}" />&nbsp;{lang mkey='pagekey_help'}</td>
				</tr>
				<tr><td colspan="2">
					<textarea name="txtbody" id="txtbody" style="width:550px;height:300px;">{$pagerec.pagetext|stripslashes }</textarea>
					</td>
				</tr>
				<tr><td colspan="2" align="center">
					<input type="submit" class="formbutton" value="{lang mkey='modpage'}" onclick="return checkMe();" /></td>
				</tr>
			</table>
		</form>
	{/if}
	</div>
</div>
{/strip}