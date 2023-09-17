{strip}
<div style="width:100%;">
{foreach key=key item=item from=$sections}
	<div style="display:inline; float:left; padding-left: 2px; padding-right: 2px;">
		[
	{if $key != $smarty.get.sectionid}
		<a href="questions.php?sectionid={$key}">
	{/if}
		{$item}
	{if $key != $smarty.get.sectionid}
		</a>
	{/if}
		]
	<div>
{/foreach}
	<div style="display:inline; float:left; padding-left: 2px; padding-right: 2px;">
		[ <a href="index.php?page=login">{lang mkey='member_login'}</a> ]
	</div>
	<div style="clear:both;'"></div>
</div>
{/strip}
