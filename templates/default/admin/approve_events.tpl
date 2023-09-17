{strip}
{assign var="page_hdr01_text" value="{lang mkey='events_require_approval'}"}
{assign var="page_title" value="{lang mkey='events_require_approval'}"}
{include file="admin/admin_page_hdr01.tpl"}
<div class="top_margin_6px">
	{assign var="ct" value=$events|@count}
	{assign var="page_hdr02_text" value="{lang mkey='total_events_found'} "|cat:$ct}
	{include file="admin/admin_page_hdr02.tpl"}
	<div class="module_detail_inside"  style="padding-top:1px;">
		{ if $errid ne ''}
			{assign var="error_message" value="{lang mkey='errormsgs' skey=$errid}" }
			{include file="display_error.tpl" }
		{ /if }
		<table class="table" cellspacing="{$config.cellspacing}" cellpadding="{$config.cellpadding}" width="100%" border="0">
			<tr class="column_head">
				<th>{lang mkey='col_head_event'}</th>
				<th>{lang mkey='action'}</th>
			</tr>
			{if $events|@count <= 0 }
			<tr>
				<td colspan="5">&nbsp;{lang mkey='no_record_found'}</td>
			</tr>
			{else}
				{foreach item=item key=key from=$events}
				<tr class="{cycle values="oddrow,evenrow"}">
				<td>
					<table>
						<tr>
							<td>{lang mkey='col_head_username'}:</td>
							<td>{$item.username}</td>
						</tr>
						<tr>
							<td>{lang mkey='col_head_fullname'}:</td>
							<td>{$item.fullname}</td>
						</tr>
						<tr>
							<td>{lang mkey='col_head_calendar'}:</td>
							<td>{$calendars[$item.calendarid]}</td>
						</tr>
						<tr>
							<td>{lang mkey='col_head_datefrom'}:</td>
							<td>{$item.datetime_from|date_format:"%d/%m/%Y %H:%M"}</td>
						</tr>
						<tr>
							<td>{lang mkey='col_head_dateto'}:</td>
							<td>{$item.datetime_to|date_format:"%d/%m/%Y %H:%M"}</td>
						</tr>
						<tr>
							<td>{lang mkey='col_head_event'}:</td>
							<td>{$item.event|stripslashes}</td>
						</tr>
						<tr>
							<td>{lang mkey='col_head_description'}:</td>
							<td>{$item.description|nl2br}</td>
						</tr>
					</table>
				</td>
				<td >
					<form name=frm{$item.userid}_{$item.picno} action="" method="post">
						<input type="hidden" name="id" value="{$item.id}" />
						<input type="submit" name="action" class="formbutton" value="{lang mkey='Approve'}" /><br />
						<input type="submit" name="action" class="formbutton" value="{lang mkey='reject'}" />
					</form>
				</td>
			</tr>
			{/foreach}
			{/if}
		</table>
	</div>
</div>
{/strip}