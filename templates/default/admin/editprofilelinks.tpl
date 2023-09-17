{strip}
<table width="100%" border="0" cellpadding="3" cellspacing="1" >
	<tr>
{*		<td align="center" class='edituserlink' height="32">
			<a href="profile.php?edit={$smarty.get.edit}">{lang mkey='section_signup_title' |replace:' ':'<br />'}</a>
		</td>
	{foreach key=key item=item from=$sections}
		<td align="center" class='edituserlink' height="32">
			{if $key !=$smarty.get.sectionid}
				<a href="editprofilequestions.php?sectionid={$key}&amp;edit={$smarty.get.edit}"  class='edituserlink'>
			{/if}
			<span>{$item|replace:' ':'<br />'}</span>
			{if $key !=$smarty.get.sectionid}
				</a>
			{/if}
		</td>
	{/foreach}
*}
		{* Create menu from sections table *}
		{assign var="cn" value=1}
		{foreach key=key item=item from=$sections}
			<td align="center" class='edituserlink' height="23">
				{if $key != $sectionid}
					{if $key == 0}
						<a href="profile.php?edit={$smarty.get.edit}" class='edituserlink'>
					{else}
						<a href="editprofilequestions.php?sectionid={$key}&amp;edit={$smarty.get.edit}"  class='edituserlink'>
					{/if}
				{/if}
				{$item}
				{if $key != $sectionid}
					</a>
				{/if}
			</td>
			{assign var="cn" value=$cn+1}
			{if $cn == 6}
				</tr>
				<tr>
				{assign var="cn" value=1}
			{/if}
		{/foreach}
	</tr>
</table>

{/strip}