{strip}
{assign var="page_hdr01_text" value='<a href="section.php" class="subhead">'|cat:"{lang mkey='section_title'}"|cat:'</a>'}
{assign var="page_title" value="{lang mkey='section_title'}"}
{include file="admin/admin_page_hdr01.tpl"}
<div class="top_margin_6px">
	{assign var="page_hdr02_text" value="{lang mkey='modify_sections'}" }
	{include file="admin/admin_page_hdr02.tpl"}
	<div class="module_detail_inside" style="padding-top:1px; text-align:left;">
		{if $error ne '' }
			{assign var="error_message" value=$error}
			{include file="display_error.tpl"}
		{/if}
		<div class="line_outer">
			<form action="modifygroupsection.php" method="post">
				<table class="table" cellspacing="{$config.cellspacing}" cellpadding="{$config.cellpadding}" width="100%" border="0">
					<tr class="column_head">
						<td>{lang mkey='col_head_id'}</td>
						<td>{lang mkey='col_head_name'}</td>
						<td>{lang mkey='col_head_enabled'}</td>
					</tr>
				{foreach item=item key=key from=$data}
					<input type="hidden" name="txtid[{$item.id}][0]" value="{$item.id}">
					<tr>
						<td>{$item.id}</td>
						<td><input type="text" class="textinput" value="{$item.section|stripslashes}" maxlength="255" size="50" name="txtid[{$item.id}][1]"></td>
						<td><select name="txtid[{$item.id}][2]">
							{html_options options=$lang.enabled_values selected=$item.enabled}
							</select>
						</td>
					</tr>
				{/foreach}
					<tr>
						<td>&nbsp;</td>
						<td>
							<input type="submit" class="formbutton" value="{lang mkey='submit'}">
							&nbsp;
							<input type="reset" class="formbutton" value="{lang mkey='reset'}">
						</td>
						<td>&nbsp;</td>
					</tr>
				</table>
			</form>
		</div>
	</div>
</div>
{/strip}