{strip}
{include file="popheader.tpl"}
<!-- MONTH -->
<div style="width:100%;">
	{assign var="calendar_type" value='M'}
	{include file="calendar_pagehdr.tpl"}
	<div class="module_detail_inside">
		<div class="line_outer" >
			<div style="display:inline; float:left; width:33%; text-align:left;vertical-align:middle;">
		{if $prev != "" }
				&nbsp;<a href="?timestamp={$prev}&amp;calendarid={$calendarid}" > {lang mkey='previous_month'}</a>&nbsp;
		{/if}
			</div>
			<div style="display:inline; float:left; width:33%; text-align:center;vertical-align:middle;">
				<b><font size="+1">{$cur_date.month}&nbsp;{$cur_date.year}</font></b>
			</div>
			<div style="display:inline; float:left; width:32%; text-align:right;vertical-align:middle;">
		{if $next != "" }
			 <a href="?timestamp={$next}&amp;calendarid={$calendarid}" >{lang mkey='next_month'}</a>&nbsp;&nbsp;
		{/if}
			</div>
			<div style="clear:both;"></div>
		</div>
		<table  width="100%" cellpadding="0" cellspacing="2" border="0">
			<tr align="center">
				<td height="10%" width="13%"><b>{lang mkey='datetime_day' skey='monday'}</b></td>
				<td height="10%" width="13%"><b>{lang mkey='datetime_day' skey='tuesday'}</b></td>
				<td height="10%" width="13%"><b>{lang mkey='datetime_day' skey='wednesday'}</b></td>
				<td height="10%" width="13%"><b>{lang mkey='datetime_day' skey='thursday'}</b></td>
				<td height="10%" width="13%"><b>{lang mkey='datetime_day' skey='friday'}</b></td>
				<td height="10%" width="13%"><b>{lang mkey='datetime_day' skey='saturday'}</b></td>
				<td height="10%" width="13%"><b>{lang mkey='datetime_day' skey='sunday'}</b></td>
			</tr>
		{foreach item=item key=key from=$calendar}
			{if $ccount==0}
				<tr>
			{/if}
				<td  height="85" valign="top" width="13%" style="margin:2px;">{include file="calendar_monthday.tpl"}</td>
			{if $ccount==6}
				</tr>
			{/if}
			{math equation="$ccount+1" assign="ccount"}
			{math equation="$ccount%7" assign="ccount"}
		{/foreach}
		</table>
	</div>
</div>
{include file="popfooter.tpl"}
{/strip}
