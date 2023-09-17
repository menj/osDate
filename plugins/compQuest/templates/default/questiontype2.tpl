{$item.question}.
<br/><br/>
{if $ou == 0}
<table border="0" width="100%">
{foreach item=item3 key=key from=$answer}
<tr>
	{foreach item=item2 key=key2 from=$item3}
		<td width="{$lenans}%" nowrap>
			{if $item2.answer}
			<input type="checkbox" style="vertical-align:-50%" name="q{$item.qid}_{$item2.qcid}"{if $item2.check==1}checked{/if} />{$item2.answer}
			{/if}
		</td>
	{/foreach}
</tr>
{/foreach}
</table>
{else}
You said: {foreach item=item2 key=key2 from=$answer}{if $item2.check2 == 1}{if $item2.check == 1}<b>{$item2.answer}</b>{else}{$item2.answer}{/if}{if $s2 != $item2.answer};{/if} {/if}{/foreach}{if $s2 == ""}(no response){/if}<br/>
{$lookuser} said: {foreach item=item2 key=key2 from=$answer}{if $item2.check == 1}{if $item2.check2 == 1}<b>{$item2.answer}</b>{else}{$item2.answer}{/if}{if $s1 != $item2.answer};{/if} {/if}{/foreach}{if $s1 == ""}(no response){/if}
{/if}
<br/><br/>