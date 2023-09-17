<mailbox>
{foreach item=item key=key from=$data}
	<message>
		{foreach item=item2 key=key2 from=$item}
			<{$key2}>{$item2}</{$key2}>
		{/foreach}
	</message>
{/foreach}
</mailbox>