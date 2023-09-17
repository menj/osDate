{strip}
{include file="popheader.tpl"}
<!-- DAY -->
<table width="100%" border="0" cellpadding="0" cellspacing="0" >
	<tr>
		<td class="calendar_module_detail" width="100%">
			{assign var="calendar_type" value="D"}
			{include file="calendar_pagehdr.tpl"}

			<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
				<tbody>
					<tr>
						<td align="center" >
							<table width="100%">
								<tr>
									<td width="20%" align="left">
						{if $prev != "" }
							<a href="?timestamp={$prev}&amp;calendarid={$calendarid}&amp;show={$display_events}" > {lang mkey='previous_day'}</a>&nbsp;
						{/if}
									</td>
									<td width="60%" align="center"><b><font size="+1"><span style="white-space: nowrap">{$date_start_timestamp|date_format:"%d %B %Y"}</span></font></b></td>
									<td width="20%" align="right">
						{if $next != "" }
							 <a href="?timestamp={$next}&amp;calendarid={$calendarid}&amp;show={$display_events}" >{lang mkey='next_day'}</a>
						{/if}
									</td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td align="center">
								{include file="calendar_dayevents.tpl"}
								<br />
						</td>
					</tr>
				</tbody>
			</table>
		</td>
	</tr>
</table>
{include file="popfooter.tpl"}
{/strip}
