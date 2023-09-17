<script type="text/javascript">
/* <![CDATA[ */
function checkme()
{ldelim}
	var theForm = document.inst01;
	if ( theForm.docroot.value == ''){ldelim}
		alert('Document root is required');
		theForm.docroot.focus();
		return false;
	{rdelim}
	if ( theForm.admin_name.value == ''){ldelim}
		alert('Admin name is required');
		theForm.admin_password.focus();
		return false;
	{rdelim}
	if ( theForm.admin_password.value == ''){ldelim}
		alert('Admin password is required');
		theForm.admin_password.focus();
		return false;
	{rdelim}
	if ( theForm.confirm_password.value == ''){ldelim}
		alert('Admin confirm password is required');
		theForm.confirm_password.focus();
		return false;
	{rdelim}
	if ( theForm.admin_password.value != theForm.confirm_password.value ) {ldelim}
		alert( 'The admin passwords do not match.' );
		theForm.admin_password.focus();
		return false;
	{rdelim}
	return true;
{rdelim}
/* ]] */
</script>
{include file='install/install_hdr02.tpl'}
		<b><font color=green style="font-size:12px">Database access successful. {*using following parameters.*}</font></b>{*<br /><span style="margin-left:12px; ">
		Database Host: {$dbhost}<br /></span><span style="margin-left:12px; ">
		Database Type: {$dbtype}<br /></span><span style="margin-left:12px; ">
		Database Name: {$dbname}<br /></span><span style="margin-left:12px; ">
		Database User: {$dbuser}<br /></span><span style="margin-left:12px; ">
		Database Password: {$dbpasswd}<br /></span><span style="margin-left:12px; ">
		<b>{$prefix}</b> will be new table prefix.
		<br />
		</span> *}
	</td>
</tr>
<tr><td colspan=2></td></tr>
<tr><td colspan=2 class=subtitle>Step {$dispstep}:
osDate General Configuration</td></tr>
<tr><td>
	<form name="inst01" action="install.php?step=5" method="post" >
		<input name="config_opt" type=hidden value="{$config_opt}" />
		<input name="dbtype" type=hidden value="{$dbtype}" />
		<input name="dbversion" type=hidden value="{$dbversion}" />
		<input name="dbhost" type=hidden value="{$dbhost}" />
		<input name="dbname" type=hidden value="{$dbname}" />
		<input name="dbpasswd" type=hidden value="{$dbpasswd}" />
		<input name="dbuser" type=hidden value="{$dbuser}" />
		<input name="prefix" type=hidden value="{$prefix}" />
		<input name="dispstep" type=hidden value="{$dispstep}" />
		We require some more details for this installation.
	<table width="100%" bgcolor="#EEEEEE" class=normal style="border:1px solid #000000">
		<tr><td></td></tr>
		<tr><td width="35%">Document Root: <font color=red>*</font></td>
			<td valign="top"><input type=text class="textinput" size=20 name=docroot value="{$docroot}" /></td>
		</tr>
		<tr><td>Admin Username: <font color=red>*</font></td>
			<td valign="top"><input type=text class="textinput" size=20 name=admin_name value="{$admin_name}" /></td>
		</tr>
		<tr><td>Admin Password: <font color=red>*</font></td>
			<td valign="top"><input type=password class="textinput" size=20 name=admin_password value="" /></td>
		</tr>
		<tr><td>Confirm Password: <font color=red>*</font></td>
			<td valign="top"><input type=password class="textinput" size=20 name=confirm_password value="" /></td>
		</tr>
		<tr><td>Default Language: <font color=red>*</font></td>
			<td><select name="langType">{html_options values=$defaultLangValues output=$defaultLangNames selected=$langType}</select></td>
		</tr>
		<tr><td>Default Country: <font color=red>*</font></td>
			<td><select name="countryType">{html_options values=$countrytypeValues output=$countrytypeNames selected=$countryType|default:"US"}</select></td>
		</tr>
		<tr><td colspan=2>If you are installing osDate at <font color="#0000FF">http://www.yoursite.com/osDate/</font> then the Document Root is <font color="#0000FF">/osDate/</font>. If osDate will be used for your primary website domain, then use <font color="#0000FF">/</font> as the Document Root.
			</td>
		</tr>
	</table>
	<table width=100%>
		<tr>
		<td align=right>
			<input type=submit value="{if $config_opt != 'N'}OK.{/if} Continue>>" onclick="return checkme();"/>
			</td>
		</tr>
	</table>
	</form>
	</td>
</tr>