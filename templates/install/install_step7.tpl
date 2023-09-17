{include file='install/install_hdr02.tpl'}
	</td>
</tr>
<tr><td colspan=2></td></tr>
<tr><td colspan=2 class=subtitle>Step {$dispstep}:
	{if $config_opt !='U'}Installation of {else}Upgrade to {/if} osDate {$smarty.const.OSDATE_VERSION} - Final Step</td></tr>
<tr><td colspan=2>
	<table width="100%" bgcolor="#EEEEEE" class=normal style="border:1px solid #000000">
		<tr><td style="text-align:center;"><font size="+1"><b>Congratulations</b></font></td></tr>
		<tr><td>&nbsp;</td></tr>
		<tr><td><b>osDate is now {if $config_opt !='U'}installed{else}upgraded{/if}.</b></td></tr>
		<tr><td>&nbsp;</td></tr>
		{ if $configCreated != '1' && $mail_set != ''}
			<tr><td><font color=red>There was a problem updating the config.php file. Please update your mail settings in config.php file manually.</font><br /><br /></td></tr>
		{/if}
		<tr><td>
		Before using osDate, please be sure to delete the installation files: install.php, and the files in the /install_files/ folder.

		<br /><br />

		You may also wish to adjust the permissions of the following files and folders as given below:

		<br />

		<ul>
		<li>/temp         <b>(755)</b>
		<li>/temp/myconfigs    <b>(755)</b>
		<li>/temp/myconfigs/config.php	<b>(744)</b>
		<li>/temp/templates_c  <b>(755)</b>
		<li>/temp/cache        <b>(755)</b>
		<li>/temp/emailimages  <b>(755)</b>
		<li>/temp/banners      <b>(755)</b>
		<li>/temp/userimages   <b>(755)</b>
		<li>/temp/uservideos   <b>(755)</b>
		</ul>
		<b>Please note that you may have to give 777 permissions on some servers</b>
		<br />
		</td></tr>
		<tr><td><br />You can use Forum Integration Module to integrate a forum with osDate.</td></tr>
		</table>
	<tr>
		<td align=right>
		<input type=submit name=submit value="Finish" onclick="javascript:document.location.href='index.php'" />
		</td>
	</tr>
