{strip}
{assign var="page_hdr01_text" value="{lang mkey='cancel_list'}"}
{assign var="page_title" value="{lang mkey='cancel_list'}"}
{include file="admin/admin_page_hdr01.tpl"}
<div style=" margin-top: 6px; text-align:left;">
	{assign var="ct" value=$cancel_list|@count}
	{assign var="page_hdr02_text" value="{lang mkey='total_profiles_found'} "|cat:$ct}
	{include file="admin/admin_page_hdr02.tpl"}
	<div class="module_detail_inside">
		<div class="line_outer">
			{if $cancel_list|@count <= 0 }
				{lang mkey='no_record_found'}
			{/if}
			{if $errmsg != '' }
				{include file="display_error.tpl"}
			{/if}
			{if $cancel_list|@count > 0 }
			<table   cellspacing="{$config.cellspacing}"
			cellpadding="{$config.cellpadding}" width="100%" border="0">
			  <tbody>
					<tr class="column_head">
					  <th width="2%">{lang mkey='col_head_srno'}</th>
					  <th width="10%"><a href="?sort={lang mkey='col_head_username' escape='url'}&amp;type={$sort_type}">{lang mkey='col_head_username'}</a></th>
					  <th width="15%"><a href="?sort={lang mkey='col_head_firstname' escape='url'}&amp;type={$sort_type}">{lang mkey='col_head_name'}</a></th>
					  <th width="20%">{lang mkey='cancel_date'}</th>
					  <th width="7%">{lang mkey='action'}</th>
					</tr>
					{assign var="mcount" value="0"}
					{foreach item=item key=key from=$cancel_list}
						{math equation="$mcount+1" assign="mcount"}
					<tr class="{cycle values="oddrow,evenrow"}">
					  <td>{$mcount}</td>
					  <td>{if $config.enable_mod_rewrite == 'Y'}
							<a href="javascript:popUpScrollWindow('{if $config.seo_username == 'Y'}{$item.username}{else}{$item.id}.htm{/if}','top',650,600)">
							{else}
							<a href="javascript:popUpScrollWindow('showprofile.php?{if $config.seo_username == 'Y'}username={$item.username}{else}id={$item.id}{/if}','top',650,600)">
							{/if}
							{$item.username}</a>
					  </td>
					  <td>{$item.firstname|stripslashes}&nbsp;{$item.lastname|stripslashes}</td>
					  <td nowrap>{$item.regdate|date_format:$lang.DATE_FORMAT}</td>
					  <td>&nbsp;&nbsp;
						<input type="button" class="formbutton" value="{lang mkey='reactivate'}" onclick="javascript:window.location='reactivate.php?id={$item.id}';">
					  </td>
					</tr>
					{/foreach}
			  </tbody>
			</table>
			{/if}
		</div>
	</div>
</div>
{/strip}