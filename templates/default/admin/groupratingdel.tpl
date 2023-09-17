{strip}
{assign var="page_hdr01_text" value='<a href="manageratings.php" class="subhead">'|cat:"{lang mkey='profile_ratings'}"|cat:'</a>'}
{assign var="page_title" value="{lang mkey='profile_ratings'}"}
{include file="admin/admin_page_hdr01.tpl"}
<div class="top_margin_6px">
	{assign var="page_hdr02_text" value="{lang mkey='delete_ratings'}"}
	{include file="admin/admin_page_hdr02.tpl"}
	<div class="module_detail_inside" style="padding-top:1px; text-align:left;">
		{if $error != ''}
			{assign var="error_message" value=$error}
			{include file="display_error.tpl" }
		{/if}
		<div class="line_outer">
			<form action="deletegrouprating.php" method="post">
			<table class="table" cellspacing="{$config.cellspacing}" cellpadding="{$config.cellpadding}" width="100%" border="0">
				<tr><td colspan="3">
					{assign var="error_message" value="{lang mkey='delete_rating_group_confirm_msg'}"}
					{include file="display_error.tpl" }
				</tr>
				<tr class="column_head">
					<th>{lang mkey='col_head_id'}</th>
					<th>{lang mkey='col_head_name'}</th>
					<th>{lang mkey='col_head_enabled'}</th>
				</tr>
			{foreach item=item key=key from=$data}
				<tr>
					<td>{$item.id}
						<input type="hidden" name="txtid[{$item.id}]" value="{$item.id}" />
					</td>
					<td>{$item.rating}</td>
					<td>{$item.enabled}</td>
				</tr>
			{/foreach}
				<tr>
					<td>&nbsp;</td>
					<td>
						<input name="action" type="submit" class="formbutton" value="{lang mkey='delete'}" />
						&nbsp;
						<input name="action" type="submit" class="formbutton" value="{lang mkey='cancel'}"  />
					</td>
					<td>&nbsp;</td>
				</tr>
			</table>
			</form>
		</div>
	</div>
</div>
{/strip}