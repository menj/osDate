{strip}
<div style="vertical-align:top;" >
	{assign var="page_hdr01_text" value=$listname}
	{assign var="page_title" value=$listname}
	{include file="page_hdr01.tpl"}
	<div class="module_detail_inside">
		<div style="padding:4px;">
			{assign var="page_hdr02_text" value="{lang mkey='total_profiles_found'} "|cat:$listcount}
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
				<div class="line_top_bottom_pad" align=center>
					<div style="display:inline; float:left; margin-left:6px;">
						<form method="get" action="?">
						{lang mkey='results_per_page'}&nbsp;&nbsp;
						<select name="results_per_page">
							{html_options options=$lang.search_results_per_page selected=$psize}
						</select>&nbsp;
						<input type="hidden" name="show" value="1" />
						<input type="hidden" name="act" value="{$act}" />
						<input type="submit" value="{lang mkey='show'}" class="formbutton" />
						</form>
					</div>
					<div style="float:right; margin-right: 10px; display:inline;">
						{assign var="totl" value=$list|@count}&nbsp;
						<b>Showing&nbsp;{$start+1}{lang mkey='to'}{$start+$totl} {lang mkey='of'} {$listcount}</b>
					</div>
					<div style="clear:both;"></div>
				</div>
			<form name="buddybanFrm" action="buddybanlist.php" method="post">
			<input type="hidden" name="act" value="{$act}" />
				<table width=100% cellpadding="{$config.cellpadding}" cellspacing="{$config.cellspacing}" border=0>
					<tr class="table_head">
						<th width="5%"><input type="checkbox" name="chkall" value="" onclick="checkAll(this.form,'txtcheck[]',this.checked)" /></th >
						<th width="5%">{lang mkey='col_head_srno'}</th>
						<th width="55%" colspan="2">{lang mkey='username_hdr'}</th>
						<th width="25%">{lang mkey='col_head_sendtime'} </th>
						<th width="10%">{lang mkey='action'}</th>
					</tr>
					{assign var="mcount" value="0"}
					{foreach item=item key=key from=$list}
						{math equation="$mcount+1" assign="mcount"}
					<tr class="{cycle  values="oddrow,evenrow"}">
						<td width="5%" >
							<input type="checkbox" name="txtcheck[]" value="{$item.lisid}" /></td>
						<td width="5%">{$mcount}</td>
						<td width="20%" valign="middle">
						{if $config.enable_mod_rewrite == 'Y'}
							<a href="javascript:popUpScrollWindow2('{$docroot}{if $config.seo_username == 'Y'}{$item.ref_username}{else}{$item.ref_userid}.htm{/if}','top',650,600)">
						{else}
							<a href="javascript:popUpScrollWindow2('{$docroot}showprofile.php?{if $config.seo_username == 'Y'}username={$item.ref_username}{else}id={$item.ref_userid}{/if}','top',650,600)">
						{/if}
							{$item.ref_username}</a>
						</td>
						<td width="35%" valign="top">
							<img src="getsnap.php?id={$item.ref_userid}&amp;typ=tn" alt="" />
						</td>
						<td width="25%">{$item.act_date|date_format:$lang.DATE_FORMAT}</td>
						<td width="10%"><a onclick="javascript:window.location='buddybanlist.php?id={$item.lisid}&amp;act={$act}&amp;remove=1';"><input name="rem" value="{lang mkey='Remove'}" type="button" class="formbutton" /></a>
						</td>
					</tr>
					{/foreach}
					<tr>
						<td colspan="5" align="left">
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
				{if $pages != ""}
					<div class="line_top_bottom_pad" align=center>
					{if $prev != "" }
						<a href="?page={$prev}&amp;show=1&amp;act={$act}" >&lt;-- {lang mkey='previous'}</a>&nbsp;
					{/if}
					{if $cpage != "" && $pages != "" }
					   {lang mkey='pageno'}&nbsp;{$cpage}&nbsp;{lang mkey='of'}{$pages}
					{/if}
					{if $next != "" }
						&nbsp;<a href="?page={$next}&amp;show=1&amp;act={$act}">{lang mkey='next'} --&gt;</a>
					{/if}
					</div>
				{/if}
			{/if}
			</div>
		</div>
	</div>
</div>
{/strip}
