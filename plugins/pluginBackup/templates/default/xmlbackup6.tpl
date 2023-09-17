<blog_preference>
{foreach item=item key=key from=$data}
	<{$key}>{$item}</{$key}>
{/foreach}
</blog_preference>
<blog_story>
{foreach item=item key=key from=$data2}
	<story>
		{foreach item=item2 key=key2 from=$item}
			<{$key2}>{$item2}</{$key2}>
		{/foreach}
	</story>
{/foreach}
</blog_story>