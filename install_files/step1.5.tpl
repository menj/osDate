<script language="javascript">
/* <![CDATA[ */
<!--
function fieldsAreValid() {
	var theForm = document.installInfo;
	
	if ( theForm.ftpHost.value == '' ) {
		alert( 'Please specify the FTP host' );
		theForm.ftpHost.focus();
		return false;
	}
	if ( theForm.ftpPath.value == '' ) {
		alert( 'Please specify the path to osDate files' );
		theForm.ftpPath.focus();
		return false;
	}
	
	if ( theForm.ftpUser.value == '' || theForm.ftpPassword.value == '' ) {
		alert( 'Please specify the FTP username and password' );
		theForm.ftpUser.focus();
		return false;
	}
	return true;
}
//-->
/* ]] */
</script>

<tr><td colspan=2></td></tr>
<tr><td colspan=2 class=subtitle>Step 1: FTP Settings</td></tr>

<tr><td colspan=2 class=normal>The osDate installer needs some information about your FTP account in order to automatically change your file permissions.<br><br>
			<!--h5-->** Please Note ** : FTP information is NOT Database information. FTP (File Transfer Protocol) is used for uploading and downloading files to and from your web server, whereas your database is used to store information raw data for database-driven scripts such as osDate.<!--/h5--></td></tr>

<tr><td colspan=2><font color="red"><?php echo @$errmsg; ?></font></td></tr>

<tr><td colspan=2>
<form action="install.php?step=1.5" method="post" align="center" name="installInfo">
<table width="100%" style="border:1px solid #000000" bgcolor="EEEEEE" class=normal>

<tr><td width="30%">FTP Host or IP Address: </td><td><input type=text size=20 name=ftpHost value="<?php echo @$_POST['ftpHost']; ?>" /></td></tr>

<tr><td width="30%">FTP User: </td><td valign="top"><input type=text size=20 name=ftpUser value="<?php echo @$_POST['ftpUser']; ?>" /></td></tr>

<tr><td width="30%">FTP Password: </td><td><input type=password size=20 name=ftpPassword value="<?php echo @$_POST['ftpPassword']; ?>" />

<tr><td>* Path to osDate files: </td><td><input type=text size=20 name=ftpPath value="<?php echo @$_POST['ftpPath']; ?>" /></td></tr>

<tr><td colspan=2>&nbsp;</td></tr>

<tr><td colspan=2><font size="2">* Path to osDate files - In order for the installer to find the files to change, you must specify path to the osDate files, relative to the FTP root.<br><br>
Different hosts have different FTP file paths. Here are some examples of possible paths (yours is likely to be different from any of these, however):<br><br>

/home/your_username/htdocs/osDate/<br>
/home/httpd/virtualhosts/www.your_domain.com/htdocs/osDate/<br>
/htdocs/osDate/<br>
/osDate/<br>
/<br></td></tr>
<tr><td>&nbsp;</td><td align=right><input type=submit name=submit value="Continue >>" onclick="javascript:return fieldsAreValid();" /></td></tr>
</table>
</form>
</td></tr>