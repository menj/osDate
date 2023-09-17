{strip}
<script type="text/javascript">
/* <![CDATA[ */
function validate(form)
{ldelim}
	ErrorCount=0;
	ErrorMsg = new Array();
	ErrorMsg[0]="------------------------- The Following Errors Occured -------------------------" + String.fromCharCode(13);

	CheckFieldString("noblank",form.txtoldpwd,"{lang mkey='signup_js_errors' skey='old_password_noblank'}");
	CheckFieldString("noblank",form.txtnewpwd,"{lang mkey='signup_js_errors' skey='new_password_noblank'}");
	CheckFieldString("noblank",form.txtconpwd,"{lang mkey='signup_js_errors' skey='con_password_noblank'}");


	/* concat all error messages into one string */
	result="";
	if( ErrorCount > 0)
	{ldelim}
		alert(ErrorMsg[1]);
		return false;
	{rdelim}
	return true;
{rdelim}
/* ]]> */
</script>
<script type="text/javascript" src="javascript/pwd_strength.js"></script>

<center>

<div style="vertical-align:top;" >
	{assign var="page_title" value="{lang mkey='affiliate_head_msg'}"}
	{assign var="page_hdr01_text" value="<a href='affpanel.php'>"|cat:"{lang mkey='affiliates'}"|cat:' '|cat:"{lang mkey='site_links' skey='home'}</a>"|cat:' > '|cat:"{lang mkey='change_password'}"}
	{include file="page_hdr01.tpl"}
	<div class="module_detail_inside">
		<form action="affmodifypass.php" name="frmChangePass" method="post" onsubmit="javascript: return validate( this );">
		{if $pwd_change_error}
			{assign var="error_message" value=$pwd_change_error}
			{include file="display_error.tpl"}
		{/if}
		<table   cellpadding="{$config.cellpadding}" cellspacing="{$config.cellspacing}" width=100%>
			<tr>
			  <td>{lang mkey='old_password'}</td>
			  <td><input type="password" class="textinput" name="txtoldpwd" maxlength="20" size="15" /></td>
			</tr>
			<tr>
			  <td>{lang mkey='new_password'}</td>
			  <td><input type="password" class="textinput" name="txtnewpwd" maxlength="20" size="15" onkeyup="runPassword(this.value, 'txtnewpwd');" /></td>
			</tr>
			<tr>
			  <td>{lang mkey='confirm_password'}</td>
			  <td><input type="password" class="textinput" name="txtconpwd" maxlength="20" size="15" /></td>
			</tr>
			<tr >
				<td >
					{lang mkey='pwd_strength'}
				</td>
				<td >
					<div >
						<div id="txtnewpwd_bar"class="password_bar">
						</div>
						<div id="txtnewpwd_text" class="password_text">
						</div>
					</div>
				</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
			   <td><input type="submit" class="formbutton" value="{lang mkey='change'}" /></td>
			</tr>
		</table>
		</form>
	</div>
</div>
</center>
{/strip}
