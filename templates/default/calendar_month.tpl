{strip}
{include file="popheader.tpl"}
<!-- MONTH -->
<div class="calendar_module_detail" style="width:100%; height:100%;">

	{assign var="calendar_type" value="M"}
	{include file="calendar_pagehdr.tpl"}

	<table width="100%" align="center" cellspacing="0" cellpadding="0" border="0">
		<tbody>
			<tr>
				<td align="center">
					<table width="100%">
						<tr>
							<td width="33%" align="left">
				{if $prev != "" }
					<a href="?timestamp={$prev}&amp;calendarid={$calendarid}&amp;show={$display_events}" > {lang mkey='previous_month'}</a>&nbsp;
				{/if}
							</td>
							<td width="33%" align="center"><b><font size="+1">{$cur_date.month}&nbsp;{$cur_date.year}</font></b></td>
							<td width="33%" align="right">
				{if $next != "" }
					 <a href="?timestamp={$next}&amp;calendarid={$calendarid}&amp;show={$display_events}" >{lang mkey='next_month'}</a>
				{/if}
							</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td>
					<table width="100%" cellpadding="0" cellspacing="2" border="0">
						<tr align="center">
							<td height="13%" align="center"><b>{lang mkey='datetime_day' skey='monday'}</b></td>
							<td height="13%" align="center"><b>{lang mkey='datetime_day' skey='tuesday'}</b></td>
							<td height="13%" align="center"><b>{lang mkey='datetime_day' skey='wednesday'}</b></td>
							<td height="13%" align="center"><b>{lang mkey='datetime_day' skey='thursday'}</b></td>
							<td height="13%" align="center"><b>{lang mkey='datetime_day' skey='friday'}</b></td>
							<td height="13%" align="center"><b>{lang mkey='datetime_day' skey='saturday'}</b></td>
							<td height="13%" align="center"><b>{lang mkey='datetime_day' skey='sunday'}</b></td>
						</tr>
					{foreach item=item key=key from=$calendar}
						{if $ccount==0}
							<tr>
						{/if}
							<td  height="85" valign="top" width="14%">{include file="calendar_monthday.tpl"}</td>
						{if $ccount==6}
							</tr>
						{/if}
						{math equation="$ccount+1" assign="ccount"}
						{math equation="$ccount%7" assign="ccount"}
					{/foreach}
					</table>
				</td>
			</tr>
		</tbody>
	</table>
</div>
{include file="popfooter.tpl"}
{/strip}
