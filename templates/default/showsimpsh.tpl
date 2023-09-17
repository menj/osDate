{strip}
<div  style="vertical-align:top;" >
	{assign var="page_hdr01_text" value="{lang mkey='search_results'}"}
	{assign var="page_title" value="{lang mkey='search_results'}"}
	{include file="page_hdr01.tpl"}

	<div class="module_detail_inside ">
		<div class="line_outer">
		{if $error == 1 }
			<div class="line_top_bottom_pad">
				{lang mkey='no_record_found'}
			</div>
		{else}
			<div class="line_top_bottom_pad " style="padding-left:6px;">
				<div class="line_top_bottom_pad" >
					{lang mkey='total_profiles_found'}&nbsp;{$totalrecs}
				</div>
				<form action="" method="post">
				<div class="line_top_bottom_pad">
					<div style="width:50%; text-align:left; display:inline; float:left;">
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
						</select>
					</div>
					<div style="width:48%; text-align:right; display:inline; float:left; padding-right:4px;">
						{lang mkey='results_per_page'}&nbsp;
						<select name="results_per_page">
							{html_options options=$lang.search_results_per_page selected=$psize}
						</select>
						&nbsp;<input type="submit" class="formbutton" value="{lang mkey='show'}" />
						{foreach from=$querystring key=key item=item}
							<input type="hidden" name="{$key}" value="{$item}" />
						{/foreach}
					</div>
					<div style="clear:both;"></div>
				</div>
				</form>
				<div class="line_top_bottom_pad" >
					{lang mkey='showing'}&nbsp;{$start+1}{lang mkey='to'}{assign var="totl" value=$data|@count}{$start+$totl}
				</div>
			</div>
			<div class="line_top_bottom_pad">
				{assign var="ccount" value="0"}
			{if $config.searchmatch_display == 'tiny'}
				{foreach item="item" key=key from=$data}
				{if $item.id > 0}
				{if $ccount==0}
					<div>
				{/if}
					<div style="display:inline; float:left; width:19.2%; vertical-align:top; margin-top:2px; margin-left: 2px;">
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
					<div style="display:inline; float:left; width:49.5%; vertical-align:top; margin-top:2px; margin-left: 2px;">
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
				{if $ccount==1}
						<div style="clear:both;"></div>
					</div>
				{/if}
			{/if}
			</div>
		{if $pages neq ""}
			<div class="line_top_bottom_pad" align="center">
			{if $prev != "" }
				<a href="?page={$prev}&amp;sort_by={$sort_by}&amp;sort_order={$sort_order}
				{foreach from=$querystring key=key item=val}
					&amp;{$key}={$val}
				{/foreach}
				" >&lt;-- {lang mkey='previous'}</a>&nbsp;&nbsp;
			{/if}
			{if $cpage != "" && $pages != "" }
				{lang mkey='pageno'} {$cpage} {lang mkey='of'} {$pages}
			{/if}
			{if $next != "" }
				&nbsp;&nbsp;<a href="?page={$next}&amp;sort_by={$sort_by}&amp;sort_order={$sort_order}{foreach from=$querystring key=key item=val}
				&amp;{$key}={$val}
				{/foreach}
				">{lang mkey='next'} --&gt;</a>
			{/if}
			</div>
		{/if}
		{/if}
		</div>
	</div>
</div>
{/strip}