{strip}
<div style="vertical-align:top;" >
	{assign var="page_hdr01_text" value="{lang mkey='online_users_txt'}"}
	{assign var="page_title" value="{lang mkey='online_users_txt'}"}
	{include file="page_hdr01.tpl"}
	<div class="module_detail_inside">
		<div class="line_outer">
		{if $error == 1 }
			{assign var="error_message" value="{lang mkey='no_record_found'}"}
			{include file="display_error.tpl"}
		{else}
			<div class="line_top_bottom_pad">
				{lang mkey='total_profiles_found'}&nbsp;{$totalrecs|default:0}
			</div>
			{if $totalrecs > 0}
				<div class="line_top_bottom_pad" align=center>
					<form method="post" action="?{$querystring}">
					{lang mkey='results_per_page'}&nbsp;&nbsp;
					<select name="results_per_page">
						{html_options options=$lang.search_results_per_page selected=$psize}
					</select>&nbsp;
					<input type="submit" value="{lang mkey='show'}" class="formbutton" />
					</form>
				</div>
				<div class="line_top_bottom_pad">
					{assign var="totl" value=$data|@count}&nbsp;
					Showing&nbsp;{$start+1}{lang mkey='to'}{$start+$totl}
				</div>
				<div class="line_top_bottom_pad">
					{assign var="ccount" value="0"}
					{foreach item="item" key=key from=$data}
					{if $ccount==0}
						<div>
					{/if}
						<div style="display:inline; float:left; width:49%; vertical-align:top; margin-top:2px; margin-left: 1px;">
							{include file="userresultviewsmall.tpl"}
						</div>
					{if $ccount==1}
							<div style="clear:both;"></div>
						</div>
					{/if}
						{math equation="$ccount+1" assign="ccount"}
						{math equation="$ccount%2" assign="ccount"}
					{/foreach}
					{if $ccount==1}
							<div style="clear:both;"></div>
						</div>
					{/if}
				</div>
			{if $pages != ""}
				<div class="line_top_bottom_pad" align=center>
				{if $prev != "" }
					<a href="?page={$prev}&amp;{$querystring}" >&lt;-- {lang mkey='previous'}</a>&nbsp;
				{/if}
				{if $cpage != "" && $pages != "" }
				   {lang mkey='pageno'}&nbsp;{$cpage}&nbsp;{lang mkey='of'}{$pages}
				{/if}
				{if $next != "" }
					&nbsp;<a href="?page={$next}&amp;{$querystring}">{lang mkey='next'} --&gt;</a>
				{/if}
				</div>
			{/if}
			{/if}
		{/if}
		</div>
	</div>
</div>
{/strip}
