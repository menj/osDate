<script type="text/javascript">
function checkme()
{ldelim}
	{if $config_opt != 'U'}
		return true;
	{/if}
	if (document.inst01.backedup.checked != true) {ldelim}
		alert("Please confirm that your existing database has been fully backed-up before proceeding.");
		return false;
	{rdelim} else {ldelim}
		return true;
	{rdelim}
{rdelim}
</script>
{include file='install/install_hdr02.tpl'}
		{if ($errorLogin == '1' or $db_valid == false ) and $dbuser != ''}
			<b><font color=red style="font-size: 12px;">We are unable to access database using following parameters. Please check the parameters and <a href="install.php">retry</a>.</font></b>
			<br />
		{elseif $tablesexist == 0 and $config_opt != 'N'}
			<b><font color=red style="font-size: 12px;">Current osDate installation tables are not available in this database. Check database connectivity details and <a href="install.php">retry</a>.</font></b>
			<br />
		{elseif $tablesexist > 0 and $config_opt == 'N'}
			<b><font color=red style="font-size: 12px;">The osDate tables have been found in the database. To perform a fresh install, please drop all current tables from the osDate database and <a href="install.php">retry the installation</a>, or load the old config.php file to the osDate root directory and <a href="install.php">restart the installation</a>, opting for an upgrade instead of a fresh install.</font></b>
			<br />
		{elseif $db_valid == true}
			<b><font color=green style="font-size: 12px;">Database access successful using following parameters.</font></b><br />
		{/if}
	</td>
</tr>
<tr><td colspan=2></td></tr>
<tr><td colspan=2 class=subtitle>Step {$dispstep}:
	{if $config_opt == 'N'}New Database Configuration{else}Confirm Database Configuration{/if}</td></tr>
{if $config_opt == 'N'}
<tr><td colspan=2>
	The osDate installer needs some information about your database to proceed with the installation. If you do not know this information, then please contact your website host or administrator. Please note that this is probably NOT the same as your FTP login information! Required fields are indicated by <font color=red>*</font>
	</td>
</tr>
{/if}
<tr><td>
	<form name="inst01" action="install.php?step=4" method="post" >
		<input name="config_opt" type=hidden value="{$config_opt}" />
		<input name="dbtype" type=hidden value="{$dbtype}" />
		<input name="dbversion" type=hidden value="{$dbversion}" />
		<input name="dispstep" type=hidden value="{$dispstep}" />

	<table width="100%" bgcolor="#EEEEEE" class=normal style="border:1px solid #000000">
		<tr><td width="35%">Database Host: <font color=red>*</font></td>
			<td width="65%"><input type=text class="textinput" name=dbhost value="{$dbhost}" {if $config_opt != 'N'}READONLY{/if} /> {if $config_opt != 'U'}(Usually "localhost"){/if}
			</td>
		</tr>
		<tr><td width="35%">Database Type: <font color=red>*</font></td>
			<td width="65%">{if $config_opt != 'N'}
			<input type=text class="textinput" name=dbtype value="{$dbtype}"  READONLY />
			{else}<select name=dbtype>{html_options values=$typeValues output=$typeNames selected=$dbtype}</select>
			{/if}
			</td>
		</tr>
		<tr><td>Database Name: <font color=red>*</font></td>
			<td><input type=text class="textinput" name=dbname value="{$dbname}" {if $config_opt != 'N'}READONLY{/if} />
			</td>
		</tr>
		<tr><td>Database User: <font color=red>*</font></td>
			<td><input type=text class="textinput" name=dbuser value="{$dbuser}" {if $config_opt != 'N'}READONLY{/if}  />
			</td>
		</tr>
		<tr><td>Database Password: <font color=red>*</font></td>
			<td><input type=password class="textinput" name="dbpasswd" value="{$dbpasswd}" {if $config_opt != 'N'}READONLY{/if} />
			</td>
		</tr>
		<tr><td>Table Prefix: <font color=red>*</font></td>
			<td ><input type=text class="textinput" name=prefix value="{$prefix}"  {if $config_opt != 'N'}READONLY{/if} />
			</td>
		</tr>
		{if $config_opt == 'U' && $db_valid == true && $tablesexist > 0}
		<tr><td height="5"></td></tr>
		<tr><td colspan=2>
				&nbsp;&nbsp;&nbsp;
				<b>Have you performed a backup of this Database?</b><br />
				<table cellspacing=0 cellpadding=4 border=0>
					<tr>
						<td width="10" align="center" valign="top">
							<input type="checkbox" name="backedup" value="Y" />
						</td>
						<td width="100%" valign="top" >
							Yes, this database has been fully backed up, and I have directly confirmed that the integrity of the backed-data and table structures is sound. I also agree that the developers of osDate are in no way responsible for any damage that this installer may do to my database and/or server in the event of a failed installation. &nbsp;&nbsp;<br />
						</td>
					</tr>
				</table>
			</td>
		</tr>
		{/if}
	</table>
	<table width=100%>
		<tr>
		{if $dispstep == '3' or ($config_opt == 'U' && ( $db_valid != true || $tablesexist <= 0 ))}
		<td align=left><input type=button onclick="javascript:document.location.href='install.php?step=2';" value="<< Back" />
		</td>
		{/if}
		{if ($config_opt == 'U' && $db_valid == true && $tablesexist > 0) or $config_opt != 'U'}
		<td align=right>
			<input type=submit value="{if $config_opt != 'N'}OK.{/if} Continue>>" onclick="return checkme();"/>
		</td>
		{/if}
		</tr>
	</table>
	</form>
	</td>
</tr>