{strip}
<div style="vertical-align:top;" >
	{assign var="page_hdr01_text" value="{lang mkey='forgotpass_msg1'}"}
	{assign var="page_title" value="{lang mkey='forgotpass_msg1'}"}
	{include file="page_hdr01.tpl"}
	<div class="module_detail_inside">

		<div class="line_outer">
			<b>{lang mkey='site_links' skey='forgot'}</b><br /><br />
			{ if $errmsg != ''}
				{assign var="error_message" value=$errmsg}
				{include file="display_error.tpl"}
			{/if}
			{lang mkey='forgotpass_msg2'} <br/> <br />
			<form action="getforgotpass.php" method="post">
				<input type="text" class="textinput"  name="txtemail" size="30"/>&nbsp;<input type="submit" class="formbutton" value="{lang mkey='retreieve_info'}"/>
			</form>
		</div>
	</div>
</div>
{/strip}
