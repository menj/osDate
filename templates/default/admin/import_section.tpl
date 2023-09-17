{strip}
{assign var="page_hdr01_text" value='<a href="import.php" class="subhead">'|cat:"{lang mkey='manage_import'}"|cat:'</a> > '|cat:"{lang mkey='select_section'}"}
{assign var="page_title" value="{lang mkey='manage_import'} - "|cat:"{lang mkey='select_section'}"}
{include file="admin/admin_page_hdr01.tpl"}
{if $message != ''}
	{assign var="error_message" value=$error}
	{include file="display_error.tpl"}
{/if}

<div class="top_margin_6px">
	{assign var="page_hdr02_text" value="{lang mkey='select_section'}"}
	{include file="admin/admin_page_hdr02.tpl"}
	<div class="module_detail_inside" style="padding-top:1px; text-align:left;">

		<div class="line_outer">
			<form action="{$smarty.section.PHP_SELF}" method="post">
			<input type="hidden" name="module" value="{$smarty.request.module}" />
			<input type="hidden" name="action" value="import" />
				<table class="table" cellspacing="{$config.cellspacing}" cellpadding="{$config.cellpadding}" width="100%" border="0">
				<tbody>
					<tr>
						<td>{lang mkey='section'}</td>
						<td><select name="section_id">
							{section name=section loop=$sections}
								<option value="{$sections[section].id}">{$sections[section].section}</option>
							{/section}
							</select>
						</td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td>
							<input type="submit" class="formbutton" value="{lang mkey='submit'}" />&nbsp;
							<input type="reset" class="formbutton" value="{lang mkey='reset'}" />
						</td>
					</tr>
				</tbody>
				</table>
			</form>
		</div>
	</div>
</div>
{/strip}