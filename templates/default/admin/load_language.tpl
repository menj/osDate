{strip}
{assign var="page_hdr01_text" value="{lang mkey='manage_languages'}"}
{assign var="page_title" value="{lang mkey='manage_languages'}"}
{include file="admin/admin_page_hdr01.tpl"}
<div class="module_detail_inside" style="padding-top:1px; text-align:left;">
	{if $msg != ''}
		{assign var="error_message"  value=$msg|cat:' '|cat:$msg_file}
	{/if}
	{if $error_message != ''}
		{include file="display_error.tpl"}
	{/if}
	<div class="line_outer">
		<div class="line_top_bottom_pad">
			{lang mkey='lang_ensure'}<br />
		</div>
		<div class="line_top_bottom_pad" style="margin-top:4px;">
			<form action="" method=post>
			{lang mkey='lang_to_load'}:&nbsp;
			<select name="langname">
			{html_options options=$language_options selected=$langname}
			</select>
			<br /><br />
			<input type=submit  class="formbutton" name="loadlang" value="{lang mkey='load_lang'}" />&nbsp;
			<input type=submit  class="formbutton" name="vieweditlang" value="{lang mkey='viewedit_lang'}" />&nbsp;
			<input type=submit  class="formbutton" name="genlangfile" value="{lang mkey='gen_lang_file'}" />&nbsp;
			<input type=submit  class="formbutton" name="deletelang" value="{lang mkey='delete_lang'}" />&nbsp;
			</form>
		</div>
	</div>
</div>
{/strip}