{strip}
{include file="admin/popheader.tpl"}

<script type="text/javascript">
/* <![CDATA[ */
{literal}
function confirmDelete(optid,conmsg){

	if (confirm(conmsg))
		document.location='?delete=' + optid;
}
function addEmail(form){

	ErrorCount=0;
	ErrorMsg = new Array();
	ErrorMsg[0]="-------------------------"+ String.fromCharCode(13)+ String.fromCharCode(10)+"The Following Errors Occured"+ String.fromCharCode(13)+ String.fromCharCode(10)+"-------------------------" + String.fromCharCode(13)+ String.fromCharCode(10);
{/literal}
	CheckFieldString("noblank",form.txtemail,"{lang mkey='signup_js_errors' skey='email_noblank'}");
	CheckFieldString("email",form.txtemail,"");
{literal}
	result="";
	if( ErrorCount > 0)
	{
		for( c in ErrorMsg)
			result += ErrorMsg[c];
		alert(result);
		return false;
	}
	document.frmAddEmail.txtemail.value=form.txtemail.value;
	document.frmAddEmail.submit();
}
{/literal}
/* ]]> */
</script>

<form name="frmAddEmail" action="?" method="post">
<input type="hidden" name="txtemail" value="" />
<input type="hidden" name="frm" value="frmAddEmail" />
</form>

<form name="frmAdminEmails" method="post"  action="modifyoption.php" onSubmit="javascript: return confdel('{lang mkey='admin_js_error_msgs' skey=1}');">
<input type="hidden" name="frm" value="frmAdminEmails" />
<table   cellspacing="{$config.cellspacing}" cellpadding="{$config.cellpadding}" border="0" >
	<tr class="table_head">
		<td >{lang mkey='col_head_srno'}</td>
		<td ><a href="?sort={lang mkey='col_head_email'}&amp;type={$sort_type}">{lang mkey='col_head_email'}</a></td>
		<td >{lang mkey='action'}</td>
	</tr>
			{assign var="mcount" value="0"}
			{foreach key=key item=item from=$emails}
			{math equation="$mcount+1" assign="mcount"}
	<tr class="{cycle values="oddrow,evenrow"}">
		<td>{$mcount}</td>
		<td>{$item.email}</td>
		<td><a href="#" onclick="confirmDelete({$item.id},'{lang mkey='admin_js_error_msgs' skey=2}');"><img src="images/button_drop.png" border="0" alt="" /></a></td>
	</tr>
			{/foreach}
	<tr>
		<td>&nbsp;</td>
		<td><input type="text" class="textinput"  name="txtemail" maxlength="255" size="30" /></td>
		<td colspan="2">
			<input type="button" class="formbutton" name="btnAddEmail" value="{lang mkey='submit'}" onclick="addEmail(this.form);" />
		</td>
	</tr>
	<tr>
		<td colspan="2" align="center" height="16">
			<input type="button" class="formbutton" value="{lang mkey='close_window'}" onclick="javascript: window.close();" />
		</td>
	</tr>
</table>
</form>
{include file="admin/popfooter.tpl"}
{/strip}