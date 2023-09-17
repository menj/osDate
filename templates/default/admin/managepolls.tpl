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
function confirmDelete(sectionid,conmsg,form)
{
/*  frmDelPoll = document.getElementsByName ("frmDelPoll").namedItem ("frmDelPoll"); */
	if (confirm(conmsg)){
		document.frmDelPoll.txtid.value=sectionid;
		document.frmDelPoll.submit();
	}
}
function addPoll(form)
{
	ErrorCount=0;
	ErrorMsg = new Array();
	ErrorMsg[0]="------------------------- The Following Errors Occured -------------------------\n" + String.fromCharCode(13)+ String.fromCharCode(10);
{/literal}
	CheckFieldString("noblank",form.txtpoll,"{lang mkey='poll_error' skey='txtpoll_noblank'}");
{literal}
	result="";
	if( ErrorCount > 0)
	{
		for( c in ErrorMsg)
			result += ErrorMsg[c];
		alert(result);
		return false;
	}
/*  frmAddPoll = document.getElementsByName ("frmAddPoll").namedItem ("frmAddPoll");  */
	document.frmAddPoll.txtpoll.value=form.txtpoll.value;
	document.frmAddPoll.submit();
}
{/literal}
/* ]]> */
</script>

<form name="frmDelPoll" action="managepoll.php" method="post">
  <input type="hidden" name="txtid" value="" />
  <input type="hidden" name="delaction" value="Yes" />
  <input type="hidden" name="frm" value="frmDelPoll" />
</form>
<form name="frmAddPoll" action="managepoll.php" method="post">
  <input type="hidden" name="txtpoll" value="" />
  <input type="hidden" name="frm" value="frmAddPoll" />
</form>
{assign var="page_hdr01_text" value="{lang mkey='manage_polls'}"}
{assign var="page_title" value="{lang mkey='manage_polls'}"}
{include file="admin/admin_page_hdr01.tpl"}
<div  style="margin-top: 6px;">
	{assign var="ct" value=$data|@count}
	{assign var="page_hdr02_text" value="{lang mkey='total_polls'}: "|cat:$ct}
	{include file="admin/admin_page_hdr02.tpl"}
	<div class="module_detail_inside">
		<div class="line_outer">
			<form name="frmGroupPoll" action="managepoll.php" method="post" onsubmit="javascript: return confdel(this,'{lang mkey='admin_js_error_msgs' skey=1}');">
				<table cellspacing="{$config.cellspacing}" cellpadding="{$config.cellpadding}" width="100%">
					<tr class="column_head">
						<th><input type="checkbox" name="chkall" value="" onclick="checkAll(this.form,'txtcheck[]',this.checked)" /></th>
						<th>{lang mkey='col_head_srno'}</th>
						<th><a href="?sort={lang mkey='poll'}&amp;type={$sort_type}">{lang mkey='poll'}</a></th>
						<th><a href="?sort=end_date&amp;type={$sort_type}">{lang mkey='end_date'}</a></th>
						<th><a href="?sort={lang mkey='poll_active'}&amp;type={$sort_type}">{lang mkey='active'}</a></th>
						<th colspan="2" >{lang mkey='action'}</th>
					</tr>
					{assign var="mcount" value="0"}
				{foreach item=item key=key from=$data}
					{math equation="$mcount+1" assign="mcount"}
					<tr class="{cycle values="oddrow,evenrow"}">
						<td align="center"><input type="checkbox" name="txtcheck[]" value="{$item.pollid}" /></td>
						<td>{$mcount}</td>
						<td><a href="polloptions.php?pollid={$item.pollid}">{$item.question|stripslashes}</a>{if $item.suggested_by > 0}&nbsp;({lang mkey='suggested_by'} &nbsp;{$item.suggested_by_username}){/if}</td>
						<td nowrap>{$item.date|date_format:$lang.DATE_FORMAT}</td>
						<td nowrap>
						{if $item.active == 0  }
							<a href="?active=poll&amp;pollid={$item.pollid}">{lang mkey='activate'}</a>
						{elseif $item.active == 1}
							<a href="?deactivate=poll&amp;pollid={$item.pollid}">{lang mkey='deactivate'}</a>
						{/if}
						</td>
						<td><a href="?edit={$item.pollid}"><img src="images/button_edit.png" alt="Edit" border="0" /></a></td>
						<td><a href="#" onclick="confirmDelete({$item.pollid},'{lang mkey='admin_js__delete_error_msgs' skey=8}')"><img src="images/button_drop.png" alt="Delete" border="0" /></a></td>
					</tr>
				{/foreach}
					<tr>
						<td colspan="2">&nbsp;</td>
						<td><input type="text" class="textinput"  name="txtpoll" maxlength="255" size="52" /></td>
						<td colspan="6">
							<input type="button" class="formbutton" name="btnAdd" value="{lang mkey='submit'}" onclick="addPoll(this.form);" />
						</td>
					</tr>
					<tr>
						<td colspan="9"><img src="images/arrow_ltr.png" alt="" />{lang mkey='with_selected'}&nbsp;
							<input type="submit" class="formbutton" value="{lang mkey='activate'}" name="groupaction" />&nbsp;&nbsp;
							<input type="submit" class="formbutton" value="{lang mkey='deactivate'}" name="groupaction" />&nbsp;&nbsp;
							<input type="submit" class="formbutton" value="{lang mkey='delete_selected'}" name="groupaction" />
						</td>
					</tr>
				</table>
			</form>
		</div>
	</div>
</div>
{/strip}