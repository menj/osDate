{strip}
{include file="popheader.tpl"}
<!-- DAY -->
<div class="calendar_module_detail" >

	{assign var="calendar_type" value='D'}
	{include file="calendar_pagehdr.tpl"}
	<div class="line_outer">
		<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
			<tr>
				<td width="20%" align="left">
	{if $prev != "" }
		<a href="?timestamp={$prev}&amp;calendarid={$calendarid}" > {lang mkey='previous_day'}</a>&nbsp;
	{/if}
				</td>
				<td width="60%" align="center"><b><font size="+1"><span style="white-space: nowrap">{$date_start_timestamp|date_format:"%d %B %Y"}</span></font></b></td>
				<td width="20%" align="right">
	{if $next != "" }
		 <a href="?timestamp={$next}&amp;calendarid={$calendarid}" >{lang mkey='next_day'}</a>
	{/if}
				</td>
			</tr>
		</table>
	</div>
	<div align="center">
		{include file="calendar_dayevents.tpl"}
	</div>
</div>
{include file="popfooter.tpl"}
{/strip}
