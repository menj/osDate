<script type="text/javascript">
function confirmDelete()
{ldelim}
	var theForm = document.inst01;
	if (theForm.config_opt[1].checked) {ldelim}
		var conmsg="Are you sure? All data in these tables will be lost forever.";
		if (confirm(conmsg)){ldelim}
			return true;
		{rdelim}
		return false;
	{rdelim} else {ldelim}
		return true;
	{rdelim}
{rdelim}
</script>
<table align="center" cellpadding="2" cellspacing="7" class="normal" width="70%" >
<tr><td colspan="2" nowrap class='title'>osDate {$smarty.const.OSDATE_VERSION} Installer</td></tr>
<tr><td colspan=2></td></tr>
<tr><td colspan=2 class=subtitle>Step {$dispstep}: Choose Install Type</td></tr>
<tr><td>
	<form name="inst01" action="install.php?step=3" method="post" >
	<input type=hidden name='dispstep' value="{$dispstep}" />
	<table width="100%" bgcolor="#EEEEEE" class=normal style="border:1px solid #000000">
		<tr><td>
			{if $configAvailable == 'Y'}
				The installer has detected a config.php file, which may suggest that a previous installation of osDate <b>(osDate version {if $smarty.const.VERSION != ''}{$smarty.const.VERSION|default:'Unknown'}{else}earlier to 1.1.0{/if})</b> is already present on this server. Please specify how the installer should continue:
				<br /><br />
			{/if}
			<input type=radio name="config_opt" value="N" {if $configAvailable != 'Y'}CHECKED{/if}  />Perform a fresh installation of osDate version {$smarty.const.OSDATE_VERSION}. The installer will not drop any current tables, but if you already have osDate tables present in your database, these should be manually removed before continuing. Or, you may specify a new table prefix in the next install step.
			{if $configAvailable == 'Y'}
				<br /> <br/>
				<input type=radio name="config_opt" value="F" />Perform a fresh installation of osDate version {$smarty.const.OSDATE_VERSION}, but drop all existing database tables. This action will completely clear your database of existing tables that have a table prefix that matches the table prefix in your config.php file. This process is irreversible.
				<br /><br />
				<font color=red>WE RECOMMEND...</font><br />
				<input type=radio name="config_opt" value="U" {if $configAvailable == 'Y'}CHECKED{/if} />Upgrade osDate to current version {$smarty.const.OSDATE_VERSION}. The installer will attempt to modify your existing table fields and indices so that they can be used with new version. This process is irreversible. The installer will not drop any tables or remove any data. The installer will create any tables that it cannot find, thus defaulting to a fresh installation in the event that your existing osDate tables have been removed.
			{/if}
			<br /><br />
		</td></tr>
	</table>
	<table width="100%">
	<tr>
	<td align=right>
		<input type=submit value='Continue>>' onclick="return confirmDelete();"/>
	</td></tr>
	</table>
	</form>
	</td>
	</tr>