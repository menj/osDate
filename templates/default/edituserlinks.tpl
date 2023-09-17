{strip}

<table width="100%" border="1" cellpadding="3" cellspacing="1" >
	<tr>
		<td align="center" height="26">
			<a href="edituser.php" class='edituserlink'>{lang mkey='section_signup_title'}</a>
		</td>
	{foreach key=key item=item from=$sections}
		<td align="center" height="26">
		{if $key !=$smarty.get.sectionid}
			<a href="editquestions.php?sectionid={$key}" class='edituserlink'>
		{/if}
			<span class='edituserlink'>{$item}</span>
		{if $key !=$smarty.get.sectionid}
			</a>
		{/if}
		</td>
	{/foreach}
	</tr>
</table>
{/strip}
