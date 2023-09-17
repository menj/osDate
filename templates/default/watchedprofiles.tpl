{strip}
<div style="vertical-align:top;" >
	{assign var="page_hdr01_text" value="{lang mkey='watchedprofiles'}"}
	{assign var="page_title" value="{lang mkey='watchedprofiles'}"}
	{include file="page_hdr01.tpl"}

	<div class="module_detail_inside">
		<div class="line_outer">
			{assign var="ct" value=$list|@count}
			{assign var="page_hdr02_text" value="{lang mkey='total_profiles_found'} "|cat:$ct}
			{include file="page_hdr02.tpl"}
			<div class="module_detail_inside" >
			{ if $error_message != '' }
				{include file="display_error.tpl"}
			{ /if }
			{if $error == 1 }
				<div class="line_outer">
					{lang mkey='no_record_found'}
				</div>
			{else}
				{ if $list }
				<form name="buddybanFrm" action="watchedprofiles.php" method="post">
				<input type="hidden" name="act" value="{$act}" />
				<table width=100% cellpadding="{$config.cellpadding}" cellspacing="{$config.cellspacing}" border="0">
					<tr class="column_head">
						<th width="10%"><input type="checkbox" name="chkall" value="" onclick="checkAll(this.form,'txtcheck[]',this.checked)" /></th >
						<th width="10%">{lang mkey='col_head_srno'}</th>
						<th width="60%" colspan="2">{lang mkey='username_hdr'}</th>
						<th width="20%">{lang mkey='action'}</th>
					</tr>
					{assign var="mcount" value="0"}
					{foreach item=item key=key from=$list}
						{math equation="$mcount+1" assign="mcount"}
					<tr class="{cycle  values="oddrow,evenrow"}">
						<td width="10%" >
							<input type="checkbox" name="txtcheck[]" value="{$item.lisid}" /></td>
						<td width="10%">{$mcount}</td>
						<td width="25%">
						{if $config.enable_mod_rewrite == 'Y'}
							<a href="javascript:popUpScrollWindow2('{$docroot}{if $config.seo_username == 'Y'}{$item.ref_username}{else}{$item.userid}.htm{/if}','top',650,600)">
						{else}
							<a href="javascript:popUpScrollWindow2('{$docroot}showprofile.php?{if $config.seo_username == 'Y'}username={$item.ref_username}{else}id={$item.userid}{/if}','top',650,600)">
						{/if}
							{$item.ref_username}</a></td>

						<td width="35%" valign="top">
							<img src="getsnap.php?id={$item.userid}&amp;typ=tn" alt="" />
						</td>
						<td width="30%"><a onclick="javascript:window.location='watchedprofiles.php?id={$item.lisid}&amp;act={$act}&amp;remove=1';"><input name="rem" value="{lang mkey='Remove'}" type="button" class="formbutton" /></a>
						</td>
					</tr>
					{/foreach}
					<tr>
						<td colspan="4" align="left">
							<img src="images/arrow_ltr.png" alt="" />{lang mkey='with_selected'}&nbsp;
							<input type="submit" class="formbutton" value="{lang mkey='delete_selected'}" name="groupaction" />
						</td>
					</tr>
				</table>
				{ else }
					<div class="line_outer">
						{lang mkey='no_record_found'}
					</div>
				{/if}
				</form>
			{/if}
			</div>
		</div>
	</div>
</div>
{/strip}
