{strip}
<form method="get" action="completereg.php">
<div style="vertical-align:top; text-align:center;">
	{assign var="page_hdr01_text" value="{lang mkey='confirm_your_profile'}"}
	{assign var="page_title" value="{lang mkey='confirm_your_profile'}"}
	{include file="page_hdr01.tpl"}
	<div class="module_detail_inside">
		<div class="line_top_bottom_pad">
		{if $smarty.get.err != ''}
			{include file="display_error.tpl"}
		{/if}
		{if $conf == '1'}
			<div class="line_outer">
				{lang mkey='profile_auto_confirmed'}
			</div>
		{else}
			{if $smarty.get.errid == '' }
				<div class="line_outer">
					{lang mkey='confirm_letter_sent'}
				</div>
				<div class="line_outer" style="margin-top: 6px;">
					{lang mkey='or'}
				</div>
			{else}
				<div class="line_outer">
					{lang mkey='wrong_activationcode'}
				</div>

			{/if}
				<div class="line_outer"  style="margin-top: 6px;">
					{lang mkey='enter_confirm_code'}
				</div>
				<div class="line_outer"  style="margin-top: 6px;">
					<input type="text" class="textinput" name="txtconfcode" size="40"/>
					&nbsp;
					<input type="submit" class="formbutton" value="{lang mkey='confirm_your_profile'}"/>
				</div>
		{/if}
		</div>
	</div>
</div>
</form>
{/strip}
