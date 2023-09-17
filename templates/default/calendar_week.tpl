{strip}
{include file="popheader.tpl"}
<!-- WEEK -->
<div class="calendar_module_detail" style=" height:100%; vertical-align:top;">

	{assign var="calendar_type" value="W"}
	{include file="calendar_pagehdr.tpl"}

	<table width="100%" align="center" cellspacing="0" cellpadding="0" border="0">
		<tbody>
			<tr>
				<td align="center" >
					<table width="100%">
						<tr>
							<td width="20%" align="left">
				{if $prev != "" }
					<a href="?timestamp={$prev}&amp;calendarid={$calendarid}&amp;show={$display_events}">&lt;&lt;
					{lang mkey='previous_week'}
					</a>&nbsp;
				{/if}
							</td>
							<td width="60%" align="center"><b><font size="+1"><span style="white-space: nowrap">{$date_start_timestamp|date_format:"%d %B %Y"}&nbsp;-&nbsp;{$date_end_timestamp|date_format:"%d %B %Y"}</span></font></b></td>
							<td width="20%" align="right">
				{if $next != "" }
					 <a href="?timestamp={$next}&amp;calendarid={$calendarid}&amp;show={$display_events}" >{lang mkey='next_week'}>></a>
				{/if}
							</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td valign="top">
					<table  width="100%" cellpadding="0" cellspacing="2" border="0">
					{foreach item=item key=key from=$calendar}
						{if $ccount==0}
							<tr>
						{/if}
						{if $ccount>0 and $ccount<6}
							<td valign="top" height="250" width="20%">{include file="calendar_weekday.tpl"}</td>
						{/if}
						{if $ccount==6}
							</tr>
						{/if}
						{math equation="$ccount+1" assign="ccount"}
						{math equation="$ccount%7" assign="ccount"}
					{/foreach}
					</table>
				</td>
			</tr>
			<tr>
				<td>
					<table  width="100%" cellpadding="0" cellspacing="2" border="0">
					{foreach item=item key=key from=$calendar}
						{if $ccount==0}
							<tr>
						{/if}
						{if $ccount==0 or $ccount==6}
							<td valign="top" height="250" width="50%">{include file="calendar_weekend.tpl"}</td>
						{/if}
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
