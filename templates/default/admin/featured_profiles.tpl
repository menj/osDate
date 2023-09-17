{strip}
<script type="text/javascript">
function confirmDelete(conmsg)
{ldelim}
  if (confirm(conmsg)){ldelim}
    return true;
  {rdelim}
{rdelim}
</script>
{assign var="page_hdr01_text" value="{lang mkey='featured_profiles_hdr'}"}
{assign var="page_title" value="{lang mkey='featured_profiles_hdr'}"}
{include file="admin/admin_page_hdr01.tpl"}
<div class="top_margin_6px" style="width:100%;">
	{assign var="ct" value=$featured|@count}
	{assign var="page_hdr02_text" value="{lang mkey='total_profiles_found'} "|cat:$ct}
	{include file="admin/admin_page_hdr02.tpl"}
	<div class="module_detail_inside" style="padding-top:1px; text-align:left;">
		<div class="line_outer">
			<table cellspacing="{$config.cellspacing}" cellpadding="{$config.cellpadding}" width="100%" border="0">
				<tr class="column_head">
					<th width="2%">{lang mkey='col_head_srno'}</th>
					<th width="10%"><a href="featured_profiles.php?sort={lang mkey='col_head_username'}&amp;type={$sort_type}">{lang mkey='col_head_username'}</a></th>
					<th width="15%"><a href="featured_profiles.php?sort=first_name&amp;type={$sort_type}">{lang mkey='col_head_name'}</a></th>
					<th width="3%"><a href="featured_profiles.php?sort={lang mkey='level_hdr' }&amp;type={$sort_type}">{lang mkey='level_hdr'}</a></th>
					<th width="20%" nowrap><a href="featured_profiles.php?sort=start_date&amp;type={$sort_type}">{lang mkey='start_date'}</a></th>
					<th width="20%"><a href="featured_profiles.php?sort=end_date&amp;type={$sort_type}">{lang mkey='end_date'}</a></th>
					<th width="3%">{lang mkey='must_show'}</th>
					<th width="10%">{lang mkey='reqd_exposures'}</th>
					<th width="10%">{lang mkey='total_exposures'}</th>
					<th width="7%">{lang mkey='action'}</th>
				</tr>
			{if $error == 1 }
				<tr>
					<td colspan="10">&nbsp;&nbsp;{lang mkey='no_record_found'}</td>
				</tr>
			{else}
				{if $errmsg != ''}
				<tr>
					<td colspan="10">
						{assign var="error_message" value=$errmsg}
						{include file="display_error.tpl"}
					</td>
				</tr>
				{/if}
				{assign var="mcount" value="0"}
				{foreach item=item key=key from=$featured}
				{math equation="$mcount+1" assign="mcount"}
				<tr class="{cycle values="oddrow,evenrow"}">
					<td width="2%">{$mcount}</td>
					<td width="10%">
						{if $config.enable_mod_rewrite == 'Y'}
						<a href="javascript:popUpScrollWindow('{if $config.seo_username == 'Y'}{$item.username}{else}{$item.userid}.htm{/if}','top',650,600)">
						{else}
						<a href="javascript:popUpScrollWindow('showprofile.php?{if $config.seo_username == 'Y'}username={$item.username}{else}id={$item.userid}{/if}','top',650,600)">
						{/if}
						{$item.username}</a></td>
					<td width="15%">{$item.firstname|stripslashes}&nbsp;{$item.lastname|stripslashes}</td>
					<td width="3%">{$item.level}</td>
					<td width="20%">{$item.start_date|date_format:$lang.DATE_FORMAT}</td>
					<td width="20%">{$item.end_date|date_format:$lang.DATE_FORMAT}</td>
					<td width="3%">{if $item.must_show eq '1'}
									Yes
									{else}
									No
									{/if}
					</td>
					<td width="10%">{$item.req_exposures}</td>
					<td width="10%">{$item.exposures}</td>
					<td width="7%">
						<a href="featured_profile.php?req_action=modify&amp;id={$item.id}&amp;bckurl=featured_profiles.php"><img src="images/button_edit.png" border="0" alt="" /></a>
						&nbsp;&nbsp;
						<a href="#" onclick="javascript:if (confirmDelete('{lang mkey='feat_prof_del_msg'}')) window.location.href='?id={$item.id}&amp;act=delete&amp;type={$sort_type}';"><img src="images/button_drop.png" alt="Delete" border="0" /></a>
					</td>
				</tr>
				{/foreach}
			{/if}
				<tr>
					<td colspan="10" align="center">
						<form action="featured_profile.php?req_action=add&amp;step=1" method=post>
							<input type="submit" class="formbutton" value="{lang mkey='add_featured'}" name="add"  />
						</form>
					</td>
				</tr>
			</table>
		</div>
	</div>
</div>
{/strip}