{strip}
<div style="vertical-align:top;width:100%;" >
	{assign var="page_hdr01_text" value="{lang mkey='search_results'}"}
	{assign var="page_title" value="{lang mkey='search_results'}"}
	{include file="page_hdr01.tpl"}
	<div class="module_detail_inside">
	{if $error == 1 }
		<div class="line_outer">
			{lang mkey='no_search_results'}
			<a href="advsearch.php?sectionid=0&amp;search_mod=1">{lang mkey="modify_curr_search"} {lang mkey="perform_search"}</a><br /><a href="advsearch.php?search_new=1">{lang mkey="start_new_search"} {lang mkey="use_empty_form"}</a>
		</div>
	{else}
		<div class="line_outer">
			{lang mkey='total_profiles_found'}&nbsp;{$totalrecs}
		</div>
		<div class="line_outer">
			<form action="advsearch.php" method="get">
				<div style="display:inline; float:left; text-align:left; width:60%;">
					{lang mkey='sort_by'}&nbsp;
					<select name="sort_by">
						<option value="username" {if $sort_by eq 'username'} selected="selected" {/if}>{lang mkey='username_without_colon'}</option>
						<option value="age" {if $sort_by eq 'age'}selected{/if}> {lang mkey='age'} </option>
						<option value="logintime" {if $sort_by eq 'logintime'}selected{/if}>{lang mkey='logintime'}</option>
						<option value="online" {if $sort_by eq 'online'}selected{/if}>{lang mkey='online'}</option>
						<option value="level" {if $sort_by eq 'level'}selected{/if}>{lang mkey='membership_hdr'}</option>
					</select>&nbsp;
					<select name="sort_order">
						{html_options options=$lang.sort_types selected=$sort_order}
					</select>&nbsp;&nbsp;&nbsp;
				</div>
				<div style="display:inline; float:left; text-align:right; padding-right: 4px;width:38%;">
					{lang mkey='results_per_page'}&nbsp;
					<select name="results_per_page">
						{html_options options=$lang.search_results_per_page selected=$psize}
					</select>
					&nbsp;<input type="submit"  class="formbutton" name='advsearch' value="{lang mkey='show'}" />
				</div>
				<div style="clear:both;"></div>
			</form>
		</div>
		<div class="line_outer">
			{assign var="totl" value=$data|@count}
			{lang mkey='showing'}&nbsp;{$start+1}{lang mkey='to'}{$start+$totl}
		</div>
		<div class="line_outer" style="width:100%">
			{assign var="ccount" value="0"}
		{if $config.advmatch_display == 'tiny'}
			{foreach item="item" key=key from=$data}
			{if $item.id > 0}
			{if $ccount==0}
				<div style="width:100%;">
			{/if}
				<div style="display:inline; float:left; width:19%; vertical-align:top; margin-top:2px; margin-left: 1px;">
					{include file="smallprofile.tpl"}
				</div>
			{if $ccount==4}
					<div style="clear:both;"></div>
				</div>
			{/if}
				{math equation="$ccount+1" assign="ccount"}
				{math equation="$ccount%5" assign="ccount"}
			{/if}
			{/foreach}
			{if $ccount>0}
					<div style="clear:both;"></div>
				</div>
			{/if}

		{else}
			{foreach item="item" key=key from=$data}
			{if $item.id > 0}
			{if $ccount==0}
				<div>
			{/if}
				<div style="display:inline; float:left; width:48.6%; vertical-align:top; margin-top:2px; margin-left: 1px;">
					{include file="userresultviewsmall.tpl"}
				</div>
			{if $ccount==1}
					<div style="clear:both;"></div>
				</div>
			{/if}
				{math equation="$ccount+1" assign="ccount"}
				{math equation="$ccount%2" assign="ccount"}
			{/if}
			{/foreach}
			{if $ccount>0}
					<div style="clear:both;"></div>
				</div>
			{/if}
		{/if}
		</div>
	{/if}
	{if $pages neq ""}
		<div class="line_outer" align="center">
		{if $prev != "" }
			<a href="advsearch.php?advsearch=1&amp;page={$prev}&amp;sort_by={$sort_by|trim}&amp;sort_order={$sort_order|trim}" >&lt;-- {lang mkey='previous'}</a>&nbsp;&nbsp;
		{/if}
		{if $cpage != "" && $pages != "" }
			{lang mkey='pageno'} {$cpage} {lang mkey='of'} {$pages}
		{/if}
		{if $next != "" }
			&nbsp;&nbsp;<a href="advsearch.php?advsearch=1&amp;page={$next}&amp;sort_by={$sort_by|trim}&amp;sort_order={$sort_order|trim}">{lang mkey='next'} --&gt;</a>
		{/if}
		</div>
	{/if}
	</div>
</div>
{/strip}