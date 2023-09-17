{strip}
<script type="text/javascript">
/* <![CDATA[ */
{literal}

function confdel(form,errmsg){
  for(i=0;i < form.length;i++){
    if(form.elements[i].type=='checkbox' && form.elements[i].checked == true){
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
    form.submit();
    return true;
  }
}
function confirmDelete(questionid,sectionid,conmsg)
{

  if (confirm(conmsg)){
    document.frmDelQuestion.txtid.value=questionid;
    document.frmDelQuestion.txtsectionid.value=sectionid;
    document.frmDelQuestion.submit();
  }
}
{/literal}

/* ]]> */
</script>
<form name="frmDelQuestion" action="sectionquestions.php" method="post">
  <input type="hidden" name="txtid" value="{$data.id}" />
  <input type="hidden" name="txtsectionid" value="{$data.section}" />
  <input type="hidden" name="frm" value="frmDelQuestion" />
</form>
{assign var="page_hdr01_text" value='<a href="section.php" class="subhead" >'|cat:"{lang mkey='section_title'}"|cat:'</a> > '|cat:"{lang mkey='questions_title'}"}
{assign var="page_title" value="{lang mkey='section_title'} - "|cat:"{lang mkey='questions_title'}"}
{include file="admin/admin_page_hdr01.tpl"}
<div style="margin-top: 6px;text-align:left;" >
	{assign var="page_hdr02_text" value="{lang mkey='section'} "|cat:$sectionname:stripslashes}
	{assign var="ct" value=$data|@count}
	{assign var="page_hdr02_text" value="{lang mkey='total_questions'} "|cat:$ct}
	{include file="admin/admin_page_hdr02.tpl"}
	<div class="module_detail_inside">
		<div class="line_outer">
			<form name="frmEndisQuestion" action="endisquestions.php" method="post" onsubmit="javascript: return confdel(this,'{lang mkey='admin_js_error_msgs' skey=1}');">
				<table cellspacing="{$config.cellspacing}" cellpadding="{$config.cellpadding}" width="100%" border="0">
				<tbody>
					<tr align="center"><td colspan="8" >{if $lang.errormsgs[err] ne ""}<span class='errormsg'>{mylang mkey='errormsgs' skey=$err}</span>{/if}</td></tr>
				{if $data|@count > 0 }
					<tr class="table_head">
						<th><input type="checkbox" name="chkall" value="" onclick="checkAll(this.form,'txtcheck[]',this.checked)" /></th>
						<th>{lang mkey='col_head_srno'}</th>
						<th><a href="?sort={lang mkey='col_head_question' escape='url'}&amp;type={$sort_type}&amp;sectionid={$sectionid}">{lang mkey='col_head_question'}</a></th>
						<th><a href="?sort={lang mkey='col_head_enabled' escape='url'}&amp;type={$sort_type}&amp;sectionid={$sectionid}">{lang mkey='col_head_enabled'}</a></th>
						<th>{"{lang mkey='mandatory'}"|replace:':':''}</th>
						<th><a href="?sort=gender&amp;type={$sort_type}&amp;sectionid={$sectionid}">{lang mkey='sex_without_colon'}</a></th>
						<th colspan="2" >{lang mkey='order'}</th>
						<th colspan="2" >{lang mkey='action'}</th>
					</tr>
					{assign var="mcount" value="0"}
				{foreach item=item key=key from=$data}
					{math equation="$mcount+1" assign="mcount"}
					<tr class="{cycle values="oddrow,evenrow"}">
						<td ><input type="checkbox" name="txtcheck[]" value="{$item.id}" /></td>
						<td>{$mcount}</td>
					{if $item.control_type != 'textarea'}
						<td><a href='sectionquestiondetail.php?sectionid={$sectionid}&amp;questionid={$item.id}'>{$item.question|stripslashes}</a></td>
					{else}
						<td>{$item.question|stripslashes}</td>
					{/if}
						<td width="20">{$item.enabled}</td>
						<td width="20">{$item.mandatory}</td>
						<td >{$lang.signup_gender_look[$item.gender]}</td>
					{if $mcount != 1 }
						<td><a href="?moveup={$item.id}&amp;sectionid={$sectionid}"><img src="images/uparrow.JPG" border="0" alt="" /></a></td>
					{else}
						<td>&nbsp;</td>
					{/if}
					{if $mcount != $data|@count}
						<td><a href="?movedown={$item.id}&amp;sectionid={$sectionid}"><img src="images/downarrow.JPG" border="0" alt="" /></a></td>
					{else}
						<td>&nbsp;</td>
					{/if}
						<td><a href="?edit={$item.id}"><img src="images/button_edit.png" border="0" alt="" /></a></td>
						<td><a href="#" onclick="confirmDelete('{$item.id}','{$sectionid}','{lang mkey='admin_js__delete_error_msgs' skey=2}')"><img src="images/button_drop.png" border="0" alt="" /></a></td>
					</tr>
				{/foreach}
					<tr>
						<td colspan="8"><img src="images/arrow_ltr.png" alt="" />{lang mkey='with_selected'}&nbsp;
						<input type="submit" class="formbutton" value="{lang mkey='delete_selected'}" name="groupaction" />&nbsp;
						<input type="submit" class="formbutton" value="{lang mkey='enable_selected'}" name="groupaction" />&nbsp;
						<input type="submit" class="formbutton" value="{lang mkey='disable_selected'}" name="groupaction" />
						</td>
					</tr>
				{else}
					<tr>
						<td>
							{lang mkey='no_record_found'}
						</td>
					</tr>
				{/if}

				</tbody>
				</table>
				<input type="hidden" name="sectionid" value="{$sectionid}" />
			</form>
		</div>
	</div>
</div>
{/strip}