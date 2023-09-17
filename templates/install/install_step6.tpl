{literal}
<script type="text/javascript">
/* <![CDATA[ */

<!--
function fieldsAreValid() {
	var theForm = document.installInfo;

	if ( theForm.mailType.value == 'smtp' && (theForm.smtpHost.value == '' || theForm.smtpPort.value == '' ) ) {
		alert( 'Please specify the SMTP host and port' );
		return false;
	}
	if ( theForm.mailType.value == 'sendmail' && theForm.smPath.value == '' ) {
		alert( 'Please specify the sendmail path' );
		return false;
	}

	if ( theForm.smtpAuth.checked && ( theForm.smtpUser.value == '' || theForm.smtpPassword.value == '' ) ) {
		alert( 'Please specify the smtp user and password' );
		return false;
	}
	return true;
}
//-->
/* ] ] */
</script>
{/literal}
<table border=0 cellspacing=0 cellpadding=0 width="100%"><tr><td width="100%">
<form action="?step=7" method="post" name="installInfo">
<input type=hidden name="config_opt" value="{$config_opt}" />
<input type=hidden name="dispstep" value="{$dispstep}" />
{include file='install/install_hdr02.tpl'}
	</td>
</tr>
<tr><td colspan=2></td></tr>
<tr><td colspan=2 class=subtitle>Step {$dispstep}:
	Mail Settings</td></tr>
<tr><td colspan=2>
	The osDate installer needs some information about your mail settings, so that form submissions can be correctly processed. If you do not know this information, then please skip this step. osDate will attempt to use the Standard PHP Mail functions by default.
</td></tr>
<tr><td colspan=2>
	<table width="100%" bgcolor="#EEEEEE" class=normal style="border:1px solid #000000">

		<tr><td width="30%">Mail format: </td><td><select name="mailFormat" >{html_options values=$formatValues output=$formatNames selected=$smarty.const.MAIL_FORMAT} </select></td></tr>

		<tr><td>Send mail by: </td><td><select name="mailType">{html_options values=$typeValues output=$typeNames selected=$smarty.const.MAIL_TYPE|default:'mail' }</select></td></tr>

		<tr><td>SMTP Host: </td><td><input type=text class="textinput" size=20 name=smtpHost value="{if $config_opt == 'U' or $config_op == 'F'}{$smarty.const.SMTP_HOST}{else}localhost{/if}" /></td></tr>

		<tr><td>SMTP Port: </td><td><input type=text class="textinput" name=smtpPort size=4 value="{if $config_opt == 'U' or $config_op == 'F'}{$smarty.const.SMTP_PORT}{else}25{/if}" /></td></tr>

		<tr><td nowrap>Use SMTP Authenication: </td><td><input type=checkbox size=20 name=smtpAuth value=1 {if $smarty.const.SMTP_AUTH eq '1'}checeked{/if} /></td></tr>

		<tr><td>SMTP User: </td><td valign="top"><input type=text class="textinput" size=20 name=smtpUser value="{if $config_opt == 'U' or $config_op == 'F'}{$smarty.const.SMTP_USER}{/if}" /></td></tr>

		<tr><td>SMTP Password: </td><td><input type=text class="textinput" size=20 name=smtpPassword value="{if $config_opt == 'U' or $config_op == 'F'}{$smarty.const.SMTP_PASS}{/if}" /></td></tr>

		<tr><td>Path to Sendmail: </td><td><input type=text class="textinput" size=20 name=smPath value="{$sendMailPath}"  /></td></tr>

		<tr><td colspan=2>You must input the path to Sendmail if you chose Sendmail above. If you do not know this value, you should contact your website administrator.<br /><br />If you choose the SMTP mail option, please note that some commercial mail services, like Yahoo, GMail, and Hotmail, usually reject SMTP mail requests from PHP scripts. You should not choose this option unless you control your own SMTP mail server. In other words, using <i>smtp.mail.yahoo.com</i> will not work.</td></tr>
	</table></td></tr>
<tr><td align=left>
	<input type=submit name=mail_bypass value="Bypass this step" />
	</td>
	<td align=right>
	<input type=submit name=mail_set value="Configure Mail Settings" onclick="javascript:return fieldsAreValid();" />
	</td>
</tr>
</table>
</form>
</td></tr>