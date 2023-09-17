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
function confirmDelete(calendarid,conmsg,form)
{
	if (confirm(conmsg)){
		document.forms['frmDelcalendar'].txtid.value=calendarid;
		document.forms['frmDelcalendar'].submit();
	}
}
function addcalendar(form)
{
	ErrorCount=0;
	ErrorMsg = new Array();
	ErrorMsg[0]="------------------------- The Following Errors Occured -------------------------" + String.fromCharCode(10)+ String.fromCharCode(13);
{/literal}
	CheckFieldString("noblank",form.txtcalendar,"{lang mkey='signup_js_errors' skey='calendarname_noblank'}");
	CheckFieldString("text",form.txtcalendar,"{lang mkey='signup_js_errors' skey='calendarname_charset'}");
{literal}
	result="";
	if( ErrorCount > 0)
	{
		for( c in ErrorMsg)
		{	//alert(c);
			result += ErrorMsg[c];
		}
		alert(result);
		return false;
	}
	document.forms['frmAddcalendar'].txtcalendar.value=form.txtcalendar.value;
	document.forms['frmAddcalendar'].txtenabled.value=form.txtenabled.value;
	document.forms['frmAddcalendar'].submit();
}
{/literal}
/* ]]> */
</script>

<form name="frmDelcalendar" action="calendar.php" method="post">
  <input type="hidden" name="txtid" value="" />
  <input type="hidden" name="delaction" value="Yes" />
  <input type="hidden" name="frm" value="frmDelcalendar" />
</form>

<form name="frmAddcalendar" action="calendar.php" method="post">
  <input type="hidden" name="txtcalendar" value="" />
  <input type="hidden" name="txtenabled" value="" />
  <input type="hidden" name="frm" value="frmAddcalendar" />
</form>
{assign var="page_hdr01_text" value="{lang mkey='calendar_title'}"}
{assign var="page_title" value="{lang mkey='calendar_title'}"}
{include file="admin/admin_page_hdr01.tpl"}

<div class="module_detail_inside  top_margin_6px" >
	{assign var="ct" value=$data|@count}
	{assign var="page_hdr02_text" value="{lang mkey='total_calendars'} "|cat:$ct}
	{include file="admin/admin_page_hdr02.tpl"}
	<div class="line_outer">
	<form name="frmGroupcalendar" action="groupcalendar.php" method="post" onsubmit="javascript: return confdel(this,'{lang mkey='admin_js_error_msgs' skey=1}');">
		<table cellspacing="{$config.cellspacing}" cellpadding="{$config.cellpadding}" width=100%>
			<tr class="column_head">
				<th><input type="checkbox" name="chkall" value="" onclick="checkAll(this.form,'txtcheck[]',this.checked)" /></th>
				<th>{lang mkey='col_head_srno'}</th>
				<th><a href="?sort={lang mkey='col_head_name' escape='url'}&amp;type={$sort_type}">{lang mkey='col_head_name'}</a></th>
				<th><a href="?sort={lang mkey='col_head_enabled' escape='url'}&amp;type={$sort_type}">{lang mkey='col_head_enabled'}</a></th>
				<th colspan="2" >{lang mkey='order'}</th>
				<th colspan="2" >{lang mkey='action'}</th>
			</tr>
			{assign var="mcount" value="0"}
		{foreach item=item key=key from=$data}
			{math equation="$mcount+1" assign="mcount"}
			<tr class="{cycle values="oddrow,evenrow"}">
				<td ><input type="checkbox" name="txtcheck[]" value="{$item.id}" /></td>
				<td>{$mcount}</td>
				<td><a href="calendarevents.php?calendarid={$item.id}">{$item.calendar|stripslashes}</a></td>
				<td>{$item.enabled}</td>
			{if $mcount != 1 }
				<td><a href="?moveup={$item.id}"><img src="images/uparrow.JPG" alt="Move Up" border="0"/></a></td>
			{else}
				<td>&nbsp;</td>
			{/if}
			{if $mcount != $data|@count}
				<td><a href="?movedown={$item.id}"><img src="images/downarrow.JPG" alt="Move Down" border="0"/></a></td>
			{else}
				<td>&nbsp;</td>
			{/if}
				<td><a href="?edit={$item.id}"><img src="images/button_edit.png" alt="Edit" border="0" /></a></td>
				<td>
				<a href="#" onclick="javascript:confirmDelete({$item.id},'{lang mkey='admin_js__delete_error_msgs' skey=26}')"><img src="images/button_drop.png" alt="Delete" border="0" /></a></td>
			</tr>
		{/foreach}
			<tr>
				<td colspan="2">&nbsp;</td>
				<td><input type="text" class="textinput"  name="txtcalendar" maxlength="255" /></td>
				<td><select name="txtenabled">
					{html_options options=$lang.enabled_values}
					</select>
				</td>
				<td colspan="5">
					<input type="button" class="formbutton" name="btnAdd" value="{lang mkey='submit'}" onclick="addcalendar(this.form);" />
				</td>
			</tr>
			<tr>
				<td colspan="9"><img src="images/arrow_ltr.png" alt="" />{lang mkey='with_selected'}&nbsp;
				<input type="submit" class="formbutton" value="{lang mkey='delete_selected'}" name="groupaction" />&nbsp;
				<input type="submit" class="formbutton" value="{lang mkey='enable_selected'}" name="groupaction" />&nbsp;
				<input type="submit" class="formbutton" value="{lang mkey='disable_selected'}" name="groupaction" />
				</td>
			</tr>
		</table>
	</form>
	</div>
</div>
{/strip}