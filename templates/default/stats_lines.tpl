<table border="0" cellspacing="2" cellpadding="1" width="100%" >
	<tr >
		<td width="85%">
			{lang mkey='weekcnt'}
		</td>
		<td align="right">
			{$weekcnt}
		</td>
	</tr>
	<tr >
		<td>
			{lang mkey='totalgents'}
		</td>
		<td align="right">
			{$gents}
		</td>
	</tr>
	<tr >
		<td >
			{lang mkey='totalfemales'}
		</td>
		<td align="right">
			{$females}
		</td>
	</tr>
{if $couples > 0}
	<tr >
		<td >
			{lang mkey='totalcouples'}
		</td>
		<td align="right">
			{$couples}
		</td>
	</tr>
{/if}
	<tr >
		<td >
			{lang mkey='weeksnaps'}
		</td>
		<td align="right">
			{$weeksnaps}
		</td>
	</tr>
	<tr >
		<td >
			{lang mkey='online_users'}
		</td>
		<td align="right">
			{$online_users_count}
		</td>
	</tr>
</table>
