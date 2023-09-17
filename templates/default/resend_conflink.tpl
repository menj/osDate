{strip}
<div style="vertical-align:top;" >
	{assign var="page_hdr01_text" value="{lang mkey='resend_conflink_hdr'}"}
	{assign var="page_title" value="{lang mkey='resend_conflink_hdr'}"}
	{include file="page_hdr01.tpl"}
	<div class="module_detail_inside">
		<div class="line_outer">
			<div class="line_top_bottom_pad">
				{lang mkey='resend_conflink_hdr1'}<br /><br />
			</div>
		{ if $error != ''}
			{assign var="error_message" value=$error }
			{include file="display_error.tpl" }
		{/if}
			<div class="line_top_bottom_pad">
				<form action="resend_conflink.php" method="post">
					<input type="hidden" name="act" value='send' />
					<input type="text" class="textinput"  name="txtemail" size="30"/>&nbsp;<input type="submit" class="formbutton" value="{lang mkey='resend_conflink_hdr'}"/>
				</form>
			</div>
		</div>
	</div>
</div>
{/strip}
