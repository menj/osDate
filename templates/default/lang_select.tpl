{strip}
<div class="leftside_detail">
	{assign var="leftcolumn_item_hdr_text" value="{lang mkey='language_opt'}"}
	{include file="leftcolumn_item_hdr.tpl"}
	<form name="langopt" action="index.php" method="post">
		<div class="line_outer" style="padding-top: 4px;">
			{html_options name="lang" options=$loaded_languages selected=$opt_lang}
			<div class="line_top_bottom_pad">
				<input type="submit" class="formbutton" value="{lang mkey='change_language'}" />
			</div>
		</div>
	</form>
</div>
{/strip}



