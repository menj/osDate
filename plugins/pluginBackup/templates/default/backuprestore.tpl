<script type="text/javascript">
/* <![CDATA[ */
{literal}

function checkall()
{
	document.backupform.b1.checked=true;
	document.backupform.b2.checked=true;
	document.backupform.b3.checked=true;
	document.backupform.b4.checked=true;
	document.backupform.b5.checked=true;
	document.backupform.b6.checked=true;
}

function uncheckall()
{
	document.backupform.b1.checked=false;
	document.backupform.b2.checked=false;
	document.backupform.b3.checked=false;
	document.backupform.b4.checked=false;
	document.backupform.b5.checked=false;
	document.backupform.b6.checked=false;
}

function check()
{
	var ok=1;
	if(document.backupform.b1.checked==true) ok=0;
	if(document.backupform.b2.checked==true) ok=0;
	if(document.backupform.b3.checked==true) ok=0;
	if(document.backupform.b4.checked==true) ok=0;
	if(document.backupform.b5.checked==true) ok=0;
	if(document.backupform.b6.checked==true) ok=0;
	if(ok) {alert("{/literal}{$lang.error3}{literal}");return false;}
	else
	{
		document.backupform.backup.value=1;
		document.backupform.submit();
	}
}

{/literal}
function checkRestoreFile() {ldelim}
	if (document.file_restore_section.userfile.value == '') {ldelim}
		alert("{$lang.restore_file_missing}");
		return false;
	{rdelim}
	document.file_restore_section.submit();
	return true;
{rdelim}
/* ]]> */
</script>
<table border="0" cellpadding="0" cellspacing="0" width="100%">
	<tr>
		<td width="100%"  class="module_detail_inside">
			{assign var="page_hdr01_text" value=$lang.backup}
			{include file="page_hdr01.tpl"}

<table width="100%" border="0" cellpadding="0" cellspacing="0" >
	<tr>
		<td width="100%">

			<form action='?plugin={$plugin_name}' name="backupform" method="post">
						<table cellspacing="{$config.cellspacing}" cellpadding="{$config.cellpadding}" width="550">
				<tbody>

				<tr>
					<td colspan="2">{$lang.note} {$lang.note2}</td>
				</tr>

				<tr class="{cycle values="oddrow,evenrow"}">
		  			<td width="1%"><input type="checkbox" name="b1" /></td>
		  			<td>{$lang.option1}</td>
				</tr>
				<tr class="{cycle values="oddrow,evenrow"}">
		  			<td><input type="checkbox" name="b2" /></td>
		  			<td>{$lang.option2}</td>
				</tr>
				<tr class="{cycle values="oddrow,evenrow"}">
		  			<td><input type="checkbox" name="b3" /></td>
		  			<td>{$lang.option3}</td>
				</tr>
				<tr class="{cycle values="oddrow,evenrow"}">
		  			<td><input type="checkbox" name="b4" /></td>
		  			<td>{$lang.option4}</td>
				</tr>
				<tr class="{cycle values="oddrow,evenrow"}">
		  			<td><input type="checkbox" name="b5" /></td>
		  			<td>{$lang.option5}</td>
				</tr>
				<tr class="{cycle values="oddrow,evenrow"}">
		  			<td><input type="checkbox" name="b6" /></td>
		  			<td>{$lang.option6}</td>
				</tr>
				<tr>
					<td colspan="2"><a href="#" onclick="checkall()">{$lang.checkall}</a> | <a href="#" onclick="uncheckall()">{$lang.uncheckall}</a></td>
				</tr>
				<tr>
					<td colspan="2"><input type="hidden" name="backup" value="0" /><input type="button" value="{$lang.submit}" class="formbutton"  onclick="check()" /></td>
				</tr>
				</tbody>
			</table>
		  </form>
</table>
</table>
<br />
<table border="0" cellpadding="0" cellspacing="0" width="100%">
	<tr>
		<td width="100%"  class="module_detail_inside">
			{assign var="page_hdr01_text" value=$lang.restore}
			{include file="page_hdr01.tpl"}
<div style="padding-left:4px;padding-top:2px">
{$lang.note3}<br/>
<br/>
<form enctype="multipart/form-data" action="?plugin={$plugin_name}" method="post" name="file_restore_section" >

    Perform restoration using this file:<br /><br/> <input name="userfile" type="file" size="50" /><br/><br/>

    <input type="button" class="formbutton" value="{$lang.submit2}" name="restore" onClick="checkRestoreFile();" /><br/>

</form>
</div>
	</td>
</tr>
</table>