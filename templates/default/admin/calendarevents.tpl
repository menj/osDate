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
function confirmDelete(eventid,calendarid,conmsg)
{
	if (confirm(conmsg)){
		document.frmDelEvent.txtid.value=eventid;
		document.frmDelEvent.txtcalendarid.value=calendarid;
		document.frmDelEvent.submit();
	}
}
{/literal}
/* ]]> */
</script>

<form name="frmDelEvent" action="calendarevents.php" method="post">
  <input type="hidden" name="txtid" value="{$data.id}" />
  <input type="hidden" name="txtcalendarid" value="{$data.calendar}" />
  <input type="hidden" name="frm" value="frmDelEvent" />
</form>
{assign var="page_hdr01_text" value='<a href="calendar.php" class="subhead">'|cat:"{lang mkey='calendar_title'}"|cat:'</a>&nbsp;>&nbsp;'|cat:"{lang mkey='events_title'}"}
{assign var="page_title" value="{lang mkey='calendar_title'}"|cat:'&nbsp;-&nbsp;'|cat:"{lang mkey='events_title'}"}
{include file="admin/admin_page_hdr01.tpl"}

<div class="top_margin_6px">
	{assign var="page_hdr02_text" value="{lang mkey='calendar'} "|cat:$calendarname|stripslashes}
	{assign var="ct" value=$data|@count}
	{assign var="page_hdr02_text_01" value="{lang mkey='total_events'}: "|cat:$ct}
	{include file="admin/admin_page_hdr02.tpl"}
	<div class="module_detail_inside" style="padding-top:1px; text-align:left;">
		{if $lang.errormsgs[err] ne ""}
			{assign var="error_message" value="{lang mkey='errormsgs' skey=$err}" }
			{include file="display_error.tpl" }
		{/if}
		<div class="line_outer">
			<div class="line_top_bottom_pad">
				<a href="?calendarid={$calendarid}&amp;insert=event">{lang mkey='insert_event'}</a>
			</div>
			<form name="frmEndisEvent" action="endisevents.php" method="post" onsubmit="javascript: return confdel(this,'{lang mkey='admin_js_error_msgs' skey=1}');">
			{if $data|@count > 0 }
			<table   cellspacing="{$config.cellspacing}" cellpadding="{$config.cellpadding}" width="100%" border="0">
				<tr class="column_head">
					<th><input type="checkbox" name="chkall" value="" onclick="checkAll(this.form,'txtcheck[]',this.checked)" /></th>
					<th>{lang mkey='col_head_datefrom'}</th>
					<th>{lang mkey='col_head_dateto'}</th>
					<th>{lang mkey='col_head_event'}</th>
					<th>{lang mkey='col_head_enabled'}</th>
					<th colspan="2" >{lang mkey='action'}</th>
				</tr>
				{assign var="mcount" value="0"}
				{foreach item=item key=key from=$data}
				{math equation="$mcount+1" assign="mcount"}
				<tr class="{cycle values="oddrow,evenrow"}">
					<td ><input type="checkbox" name="txtcheck[]" value="{$item.id}" /></td>
					<td>{$item.datetime_from|date_format:"%d/%m/%Y %I:%M %p"}</td>
					<td>{$item.datetime_to|date_format:"%d/%m/%Y %I:%M %p"}</td>
					<td>{$item.event|stripslashes}</td>
					<td>{$item.enabled}</td>
					<td><a href="?calendarid={$calendarid}&amp;edit={$item.id}"><img src="images/button_edit.png" border="0" alt="" /></a></td>
					<td><a href="#" onclick="javascript:confirmDelete('{$item.id}','{$calendarid}','{lang mkey='admin_js__delete_error_msgs' skey=25}')"><img src="images/button_drop.png" border="0" alt="" /></a></td>
				</tr>
				{/foreach}
				<tr>
					<td colspan="7">
						<img src="images/arrow_ltr.png" alt="" />{lang mkey='with_selected'}&nbsp;
						<input type="submit" class="formbutton" value="{lang mkey='enable_selected'}" name="groupaction" />&nbsp;
						<input type="submit" class="formbutton" value="{lang mkey='disable_selected'}" name="groupaction" />
					</td>
				</tr>
			</table>
			{else}
				<div class="line_top_bottom_pad">
					{lang mkey='no_record_found'}
				</div>
			{/if}
			<input type="hidden" name="calendarid" value="{$calendarid}" />
			</form>
		</div>
	</div>
</div>
{/strip}