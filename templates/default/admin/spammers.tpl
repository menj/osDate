{strip}
<script language="JavaScript" type="text/javascript">

function confdel(form){ldelim}
	if (confirm("{lang mkey='admin_js__delete_error_msgs' skey=18}")) {ldelim}
		document.frm.delete_selected.value="{lang mkey='delete_selected'}";
		form.submit();
	{rdelim}else{ldelim}
		return false;
	{rdelim}
{rdelim}

function confirmDelete(profileid,conmsg)
{ldelim}
	if (confirm(conmsg)){ldelim}
		frmDelProfile.txtdelete.value=profileid;
		frmDelProfile.submit();
	{rdelim}
{rdelim}
</script>
{assign var="page_hdr01_text" value="{lang mkey='spammers'}"}
{assign var="page_title" value="{lang mkey='spammers'}"}
{include file="admin/admin_page_hdr01.tpl"}

<form name="frmDelProfile" action="spammers.php" method="get">
	<input type="hidden" name="txtdelete" value="">
	<input type="hidden" name="frm" value="frmDelProfile">
</form>
<BR />
<div  class="module_detail_inside">
	{assign var="page_hdr02_text" value="{lang mkey='spammers'}"}
	{include file="admin/admin_page_hdr02.tpl"}
	<div class="line_outer">
		<table class="table" cellspacing="{$config.cellspacing}" cellpadding="{$config.cellpadding}" width="100%" border=0>

		{foreach item=item from=$spammers}

			<tr align="center" class="table_head">
				<th width="30%">{lang mkey='signup_username'}&nbsp;{$item.username}</th>
				<th width="30%">{lang mkey='dat'}&nbsp;{$item.send_time}</th>
				<th width="30%">Copies:&nbsp;{$item.copies}</th>
				<th width="10%"><a href="javascript:confirmDelete({$item.id},'{lang mkey='admin_js__delete_error_msgs' skey=4}')"><img src="images/button_drop.png" alt="Delete" border="0"></a></th>
			</tr>

			<tr>
				<td colspan="4"> {$item.message} </td>
			</tr>

			<tr>
				<td colspan="4"> <hr> </td>
			</tr>

		{/foreach}
		</table>
	</div>
</div>
{/strip}
