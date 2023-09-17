{strip}
<div style="vertical-align:top;" >
	{assign var="page_hdr01_text" value=$listname|cat:"&nbsp;"|cat:"{lang mkey="since"} "|cat:$viewswinks_since}
	{assign var="page_title" value=$listname}
	{include file="page_hdr01.tpl"}

	<div class="module_detail_inside" style="padding:4px;">
		{assign var="ct" value=$list|@count}
		{assign var="page_hdr02_text" value="{lang mkey='total_profiles_found'} "|cat:$ct}
		{include file="page_hdr02.tpl"}
		<div class="module_detail_inside">
	{if $error_message != ''}
		{include file="display_error.tpl"}
	{/if}
	{if $list|@count eq 0 }
		<div class="line_outer">
			{lang mkey='no_record_found'}
		</div>
	{else}
		<div class="line_top_bottom_pad" align=center>
			<div style="display:inline; float:left; margin-left:6px;">
				<form method="get" action="?">
				{lang mkey='results_per_page'}&nbsp;&nbsp;
				<select name="results_per_page">
					{html_options options=$lang.search_results_per_page selected=$psize}
				</select>&nbsp;
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
		<form name="listviewwinksFrm" action="listviewswinks.php" method="post">
		<input type="hidden" name="id" value="" />
		<input type="hidden" name="remove" value="" />
		<input type="hidden" name="act" value="{$act}" />
		<table border="0" width="100%" cellspacing="{$config.cellspacing}" cellpadding="{$config.cellpadding}">
		<tr class="table_head">
			<th align="center"><input type="checkbox" name="chkall" value="" onclick="checkAll(this.form,'txtcheck[]',this.checked)"/></th >
			<th >{lang mkey='col_head_srno'}</th>
			<th >{lang mkey='username_hdr'}</th>
			<th >{lang mkey='col_head_sendtime'}</th>
			<th >{lang mkey='action'}</th>
		</tr>
		{assign var="mcount" value="0"}
		{foreach item=item key=key from=$list}
			{math equation="$mcount+1" assign="mcount"}
			<tr class="{cycle  values="oddrow,evenrow"}">
				<td width="5%" align="center">
					<input type="checkbox" name="txtcheck[]" value="{$item.id}"/></td>
				<td width="5%">{$mcount}</td>
				<td width="50%">
				{if $config.enable_mod_rewrite == 'Y'}
					<a href="javascript:popUpScrollWindow2('{$docroot}{if $config.seo_username == 'Y'}{$item.username}{else}{$item.ref_userid}.htm{/if}','top',650,600)">
				{else}
					<a href="javascript:popUpScrollWindow2('{$docroot}showprofile.php?{if $config.seo_username == 'Y'}username={$item.username}{else}id={$item.ref_userid}{/if}','top',650,600)">
				{/if}
					{$item.username}</a> ({$lang.signup_gender_values[$item.gender]})
				</td>
				<td width="30%">{$item.act_time|date_format:$lang.DATE_FORMAT}</td>
				<td width="10%">
				<input name="rem" value="{lang mkey='Remove'}" type="button" class="formbutton" onclick="document.forms['listviewwinksFrm'].id.value={$item.id};document.forms['listviewwinksFrm'].remove.value='1';document.forms['listviewwinksFrm'].submit(); " />
				</td>
			</tr>
		{/foreach}
		<tr>
			<td colspan="4" align="left">
				<img src="images/arrow_ltr.png" alt="" />{lang mkey='with_selected'}&nbsp;
				<input type="submit" class="formbutton" value="{lang mkey='delete_selected'}" name="groupaction"/>
			</td>
		</tr>
		</table>
		</form>
		{if $pages != ""}
			<div class="line_top_bottom_pad" align=center>
			{if $prev != "" }
				<a href="?page={$prev}&amp;act={$act}" >&lt;-- {lang mkey='previous'}</a>&nbsp;
			{/if}
			{if $cpage != "" && $pages != "" }
			   {lang mkey='pageno'}&nbsp;{$cpage}&nbsp;{lang mkey='of'}{$pages}
			{/if}
			{if $next != "" }
				&nbsp;<a href="?page={$next}&amp;act={$act}">{lang mkey='next'} --&gt;</a>
			{/if}
			</div>
		{/if}

	{/if}
		</div>
	</div>
</div>
{/strip}
