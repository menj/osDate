{if $found == 1}
	{foreach item=item from=$pref}
		<div style="padding-bottom: 6px;">
			{include file="nickpage_section.tpl"}
		</div>
	{/foreach}
{else}
	<div style="padding-top: 2px; padding-bottom: 4px; text-align:center;">
	{if $smarty.session.UserId != '' && $smarty.session.UserId == $smarty.get.id}
		{lang mkey='profile_details'}
		<div style="padding-top: 2px; padding-bottom: 4px;">
			{lang mkey='view_profile_errmsg1'}
			<a href="edituser.php" onclick="javascript:window.opener.document.location = 	'editquestions.php';window.close();">{lang mkey='view_profile_errmsg2'}</a>
		</div>
	{else}
		{lang mkey='view_profile_errmsg3'}
	{/if}
	</div>
{/if}