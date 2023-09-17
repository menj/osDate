{strip}
<script language="JavaScript" type="text/javascript">
/* <![CDATA[ */
{literal}

function confirmDelete(section,questionid,optid,conmsg)
{
	if (confirm(conmsg))
		document.location='?sectionid=' + section + '&questionid=' + questionid + '&delete=' + optid;
}
function confdel(errmsg){
	for(i=0;i < document.frmQuestionDetail.length;i++){
		if(document.frmQuestionDetail.elements[i].type=='checkbox' && document.frmQuestionDetail.elements[i].checked == true){
			selected = true;
			break;
		}
		else {
			selected = false;
		}
	}
	if(!selected) {
		alert(errmsg);
		return false;
	}else{
		document.frmQuestionDetail.submit();
		return true;
	}
}
function addOption(form)
{
	ErrorCount=0;
	ErrorMsg = new Array();
	ErrorMsg[0]="------------------------- The Following Errors Occured -------------------------" + String.fromCharCode(13)+ String.fromCharCode(10);
{/literal}
	CheckFieldString("noblank",document.frmQuestionDetail.txtanswer,"{lang mkey='admin_error_msgs' skey='2'}");
	CheckFieldString("full",document.frmQuestionDetail.txtanswer,"{lang mkey='admin_error' skey='10'}");
{literal}
	result="";
	if( ErrorCount > 0)
	{
		for( c in ErrorMsg)
			result += ErrorMsg[c];
		alert(result);
		return false;
	}
	document.frmAddOption.txtanswer.value=form.txtanswer.value;
	document.frmAddOption.txtenabled.value=form.txtenabled.value;
	document.frmAddOption.submit();

}
{/literal}
/* ]]> */
</script>
{assign var="page_hdr01_text" value='<a href="section.php" class="subhead">'|cat:"{lang mkey='section_title'}"|cat:'</a> > <a href="sectionquestions.php?sectionid='|cat:$smarty.get.sectionid|cat:'" class="subhead">'|cat:"{lang mkey='questions_title'}"|cat:'</a> > '|cat:"{lang mkey='options_title'}"}
{assign var="page_title" value="{lang mkey='section_title'} - "|cat:"{lang mkey='questions_title'} - "|cat:"{lang mkey='options_title'}"}
{include file="admin/admin_page_hdr01.tpl"}
<div  style="padding-top: 6px; text-align:left;">
	{assign var="page_hdr02_text" value="{lang mkey='question'} "|cat:$question.question}
	{assign var="ct" value=$options|@count}
	{assign var="page_hdr02_text_01" value="{lang mkey='total_options'} "|cat:$ct}
	{include file="admin/admin_page_hdr02.tpl"}
	<div class="module_detail_inside">
		<div class="line_outer">
			<form name="frmQuestionDetail" method="post"  action="modifyoption.php" onSubmit="javascript: return confdel('{lang mkey='admin_js_error_msgs' skey=1}');">
			<input type="hidden" name="frm" value="frmQuestionDetail" />
			<input type="hidden" name="txtsectionid" value=	"{$smarty.get.sectionid}" />
			<input type="hidden" name="txtquestionid" value="{$smarty.get.questionid}" />
			<table class="table" cellspacing="{$config.cellspacing}" cellpadding="{$config.cellpadding}" border="0" width="100%">
				{* <tr><td colspan="6">&nbsp;</td></tr> *}
				<tr class="column_head">
					<th><input type="checkbox" name="chkall" value="" onclick="checkAll(this.form,'txtcheck[]',this.checked)" /></th>
					<th>{lang mkey='col_head_srno'}</th>
					<th><a href="?sectionid={$smarty.get.sectionid}&amp;questionid={$smarty.get.questionid}&amp;sort={lang mkey='col_head_answer'}&amp;type={$sort_type}">{lang mkey='col_head_answer'}</a></th>
					<th><a href="?sectionid={$smarty.get.sectionid}&amp;questionid={$smarty.get.questionid}&amp;sort={lang mkey='col_head_enabled'}&amp;type={$sort_type}">{lang mkey='col_head_enabled'}</a></th>
					<th colspan="4" >{lang mkey='action'}</th>
				</tr>
			{if $question.control_type != 'textarea' }
				{assign var="mcount" value="0"}
			{foreach key=key item=item from=$options}
				{math equation="$mcount+1" assign="mcount"}
				<tr class="{cycle values="oddrow,evenrow"}">
					<td ><input type="checkbox" name="txtcheck[]" value="{$item.id}" /></td>
					<td>{$mcount}</td>
					<td>{$item.answer|stripslashes}</td>
					<td width="10">{$item.enabled}</td>
				{if $mcount != 1 }
					<td width="12"><a href="?moveup={$item.id}&amp;sectionid={$smarty.get.sectionid}&amp;questionid={$item.questionid}"><img src="images/uparrow.JPG" border="0" alt="" /></a></td>
				{else}
					<td width="12">&nbsp;</td>
				{/if}
				{if $mcount != $options|@count }
					<td width="12"><a href="?movedown={$item.id}&amp;sectionid={$smarty.get.sectionid}&amp;questionid={$item.questionid}"><img src="images/downarrow.JPG" border="0" alt="" /></a></td>
				{else}
					<td width="12">&nbsp;</td>
				{/if}
					<td width="12"><a href="?sectionid={$smarty.get.sectionid}&amp;edit={$item.id}&amp;questionid={$smarty.get.questionid}"><img src="images/button_edit.png" border="0"  alt="" /></a></td>
					<td width="12"><a href="#" onclick="javascript:confirmDelete({$smarty.get.sectionid},{$smarty.get.questionid},{$item.id},'{lang mkey='admin_js__delete_error_msgs' skey=3}');"><img src="images/button_drop.png" border="0"  alt=""  /></a></td>
				</tr>
			{/foreach}
			{/if}
				<tr>
					<td colspan="2">&nbsp;</td>
					<td><input type="text" class="textinput"  name="txtanswer" maxlength="255" size="35" /><font class="required_info">{$smarty.const.REQUIRED_INFO}</font></td>
					<td><select name="txtenabled">
						{html_options options=$lang.enabled_values}
						</select>
					</td>
					<td colspan="2">
						<input type="button" class="formbutton" name="btnAddOption" value="{lang mkey='submit'}" onclick="addOption(this.form);" />
					</td>
				</tr>
				<tr>
					<td colspan="7"> <img src="images/arrow_ltr.png"  alt=""  />{lang mkey='with_selected'}&nbsp;
						<input type="submit" class="formbutton" value="{lang mkey='enable_selected'}" name="groupaction"  />&nbsp;
						<input type="submit" class="formbutton" value="{lang mkey='disable_selected'}" name="groupaction"  />
					</td>
				</tr>
			</table>
			</form>
		</div>
	</div>
</div>
<form name="frmAddOption" action="sectionquestiondetail.php?sectionid={$smarty.get.sectionid}&amp;questionid={$smarty.get.questionid}" method="post">
	<input type="hidden" name="txtanswer" value="" />
	<input type="hidden" name="txtquestion" value="{$smarty.get.questionid}" />
	<input type="hidden" name="txtenabled" value="" />
	<input type="hidden" name="frm" value="frmAddOption" />
</form>
{/strip}