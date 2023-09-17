{strip}
{assign var="page_hdr01_text" value="{lang mkey='snaps_require_approval'}"}
{assign var="page_title" value="{lang mkey='snaps_require_approval'}"}
{include file="admin/admin_page_hdr01.tpl"}
{if $errid ne ''}
	{include file="display_error.tpl" }
{/if}
<div style="margin-top: 6px;">
	{assign var="ct" value=$user_pics|@count}
	{assign var="page_hdr02_text" value="{lang mkey='total_profiles_found'} "|cat:$ct}
	{include file="admin/admin_page_hdr02.tpl"}
	<div class="module_detail_inside"  style="padding-top:1px;">
		<div class="line_outer">
			<form name="approvepics" action="approve_snaps.php" method=post>
				<input type="hidden" name="id" value="" />
			<table cellspacing="{$config.cellspacing}" cellpadding="{$config.cellpadding}" width="100%" border="0">
				<tr class="column_head">
				  <th width="3%">{lang mkey='col_head_srno'}</th>
				  <th width="6%" align="center" valign="middle"><input type="checkbox" name="chkall" value="" onclick="checkAll(this.form,'txtchk[]',this.checked)" /></th>
				  <th width="40%">{lang mkey='userdetails'}</th>
				  <th width="25%">{lang mkey='pict'}</th>
				  <th width="25%">{lang mkey='tnail'}</th>
				  <th width="7"%>{lang mkey='action'}</th>
				</tr>
				{if $user_pics|@count <= 0 }
				<tr>
					<td colspan="5">&nbsp;{lang mkey='no_record_found'}</td>
				</tr>
				{else}
				{assign var="mcount" value="0"}
					{foreach item=item key=key from=$user_pics}
					{math equation="$mcount+1" assign="mcount"}
					<tr class="{cycle values="oddrow,evenrow"}">
					  <td>{$mcount}</td>
					  <td align="center" valign="middle"><input type="checkbox" name="txtchk[]" value="{$item.id}" /></td>
					  <td align="left" valign="middle">
					  <table width="100%" cellpadding="{$config.cellpadding}" cellspacing="{$config.cellspacing}" border="0">
						<tr>
							<td width="30%">{lang mkey='username'}</td>
							<td align="left" width="70%">{if $config.enable_mod_rewrite == 'Y'}
								<a href="javascript:popUpScrollWindow('{if $config.seo_username == 'Y'}{$item.username}{else}{$item.userid}.htm{/if}','top',650,600)">
							{else}
								<a href="javascript:popUpScrollWindow('showprofile.php?{if $config.seo_username == 'Y'}username={$item.username}{else}id={$item.userid}{/if}','top',650,600)">
							{/if}
								{$item.username}</a></td>
						</tr>
						<tr>
							<td>{lang mkey='name'}</td>
							<td align="left" >{$item.fullname|stripslashes}</td>
						</tr>
						<tr>
							<td >{lang mkey='picture'}:</td>
							<td align="left" >{$item.picno}</td>
						</tr>
						{if $item.album_name != ''}
						<tr>
							<td >{lang mkey='album_hdr'}:</td>
							<td align="left" >{$item.album_name}</td>
						</tr>
						{/if}
					</table>
					</td>
					<td>
						<img src="getsnap.php?id={$item.userid}&amp;picid={$item.picno}&amp;typ=pic&amp;width=100&amp;height=100" alt=""/>
					</td>
					<td >
						<img src="getsnap.php?id={$item.userid}&amp;picid={$item.picno}&amp;typ=tn"  alt=""/>
					</td>
					<td >
						<input type="submit" name="action" class="formbutton" value="{lang mkey='Approve'}" onclick="javascript:document.approvepics.id.value={$item.id}; return true; " /><br />
						<input type="submit" name="action" class="formbutton" value="{lang mkey='reject'}" onclick="javascript:document.approvepics.id.value={$item.id}; return true; " />
					</td>
				</tr>
					{/foreach}
				{/if}
				<tr>
					<td>&nbsp;</td>
					<td colspan="5">
						<div class="line_top_bottom_pad" style="padding-left: 6px;">
							<table border="0" cellpadding="0" cellspacing="0">
								<tr>
									<td nowrap><img src="images/arrow_ltr.png" alt="" />{lang mkey='with_selected'}&nbsp;
									</td>
									<td nowrap valign="bottom" align="left">
										<input type="submit" class="formbutton" value="{lang mkey='Approve'}" name="groupaction" />&nbsp;&nbsp;
										<input type="submit" class="formbutton" value="{lang mkey='reject'}" name="groupaction" />
									</td>
								</tr>
							</table>
						</div>
					</td>
				</tr>
			</table>
			</form>
		</div>
	</div>
</div>
{/strip}