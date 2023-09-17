{strip}
<div style="padding-top: 60px; padding-bottom:2px;">
	{if $login_error != ''}
		{assign var="error_message" value=$login_error}
		{include file="display_error.tpl"}
	{/if}
	<div style="width:180px;" >
		{assign var="page_hdr02_text" value="{lang mkey='admin_login_msg'}"}
		{include file="admin/admin_page_hdr02.tpl"}
		<div class="module_detail_inside" style="text-align:left; padding-top:1px;">
			<form name="frmlogin" method="post" action="midlogin.php">
				<table   cellspacing="{$config.cellspacing}" cellpadding="{$config.cellpadding}" border="0" width="100%" class="module_detail_inside">
					<tr>
						<td ><span class='text8pt'>{lang mkey='signup_username'}</span></td>
						<td><input class="textinput" maxlength="25" name="txtusername" size="8" style='font-size:9pt;width:75px' /></td>
					</tr>
					<tr>
						<td><span class='text8pt'>{lang mkey='signup_password'}</span></td>
						<td><input class="textinput" type="password" name="txtpassword" size="8" style='font-size:9pt;width:75px' /></td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td><input type="submit" value="{lang mkey='login_submit'}" class='formbutton' /></td>
					</tr>
				</table>
			</form>
		</div>
		<script type="text/javascript">
		/* <![CDATA[ */
		  document.getElementsByName ("txtusername").item (0).focus ();
		/* ]]> */
		</script>
	</div>
</div>
{/strip}