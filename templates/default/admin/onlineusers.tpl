{strip}
{assign var="page_hdr01_text" value="{lang mkey='online_users'}"}
{assign var="page_title" value="{lang mkey='online_users'}"}
{include file="admin/admin_page_hdr01.tpl"}
<div class="module_detail_inside " style="text-align:left;">
	<div class="line_outer">
	{if $error == 1 }
		{lang mkey='no_record_found'}
	{else}
		<div >
			<div style="display:inline; float:left; width:50%">
				{lang mkey='total_profiles_found'}&nbsp;{$totalrecs}
			</div>
			<div style="display:inline; float:left;width:49%; vertical-align:middle " align=right>
				{lang mkey='results_per_page'}&nbsp;
				<select name="results_per_page">
					{html_options options=$lang.search_results_per_page selected=$psize}
				</select>&nbsp;
				<input type="button" value="{lang mkey='show'}" onclick="document.location='?{$querystring|escape:url}&amp;results_per_page=' + results_per_page.value" />&nbsp;&nbsp;
			</div>
			<div style="clear:both;"></div>
		</div>
		<div class="line_top_bottom_pad">
			Showing&nbsp;{$start+1}{lang mkey='to'}{assign var="totl" value=$data|@count}{$start+$totl}
		</div>
		<div class="line_top_bottom_pad">
			<table  width="100%" cellpadding="0" cellspacing="8" border="0">
				{assign var="ccount" value="0"}
				{foreach item=item key=key from=$data}
					{if $ccount==0}
						<tr>
					{/if}
						<td>{include file="userresultviewsmall.tpl"}</td>
					{if $ccount==1}
						</tr>
					{/if}
					{math equation="$ccount+1" assign="ccount"}
					{math equation="$ccount%2" assign="ccount"}
				{/foreach}
			</table>
		</div>
	{/if}
	{if $pages neq ""}
		<div class="line_top_bottom_pad" align="center">
		{if $prev != "" }
			<a href="?page={$prev}&amp;{$querystring|escape:url}" ><-- {lang mkey='previous'}<a/>&nbsp;
		{/if}
		{if $cpage != "" && $pages != "" }
			{lang mkey='pageno'}&nbsp;{$cpage}&nbsp;{lang mkey='of'}{$pages}
		{/if}
		{if $next != "" }
			&nbsp;<a href="?page={$next}&amp;{$querystring|escape:url}">{lang mkey='next'} --></a>
		{/if}
		</div>
	{/if}
	</div>
</div>
{/strip}
