{strip}
<div style="vertical-align:top;" >
	{assign var="page_hdr01_text" value="{lang mkey='section_blog_title'}"}
	{assign var="page_title" value="{lang mkey='section_blog_title'}"}
	{include file="page_hdr01.tpl"}
	<div class="module_detail_inside">
		{if $error_message neq ""}
			{include file="display_error.tpl"}
		{/if}

		<form name="frmEditPref" method="post" action="addblog.php">
			<input type="hidden" name="action" value="add_blog"/>
			{include file="addblog_hdr02.tpl"}
		</form>
	</div>
</div>
<br />
{/strip}
