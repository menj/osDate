<buddybanhotlist>
{foreach item=item key=key from=$data}
	<item>
		{foreach item=item2 key=key2 from=$item}
			<{$key2}>{$item2}</{$key2}>
		{/foreach}
	</item>
{/foreach}
</buddybanhotlist>