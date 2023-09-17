{foreach item=item key=key from=$adminblog}
	<div class="line_outer">
		<a href="viewblog.php?id={$item.id}">{$item.short_title|stripslashes|strip_tags}</a><br />
		{$item.date_posted|date_format:$lang.DATE_FORMAT}
	</div>
{/foreach}
{if $userblog|@count > 0}
{foreach item=item key=key from=$userblog}
	<div class="line_outer">
		<a href="viewblog.php?id={$item.id}">{$item.short_title|stripslashes|strip_tags}</a><br />
		{$item.date_posted|date_format:$lang.DATE_FORMAT}
	</div>
{/foreach}
{/if}
