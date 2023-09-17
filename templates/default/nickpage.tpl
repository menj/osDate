{if $config.use_profilepopups == 'Y'}
{include file="popheader.tpl"}
{/if}
{if $err == 28 }
	<div style="width:80%; text-align:center;" >
		<div style="text-align:center;" class="subtitle">{lang mkey='profile_details'}</div>
		<div style="text-align:center;">{lang mkey='view_profile_restricted'}</div>
	</div>
{elseif $err == 31 }
	<div style="width:80%; text-align:center;" >
		<div style="text-align:center;" class="subtitle">{lang mkey='profile_details'}</div>
		<div style="text-align:center;">{lang mkey='profile_notset'}</div>
	</div>
{elseif $errid == '999'}
	{include file="display_error.tpl"}
{else}
	{* if $config.use_profilepopups == 'Y'}
		<div  >
	{/if *}
	{assign var="page_title" value="{lang mkey='view'}"}
<div >
	{include file="nickpage_logo.tpl"}
	<div class="module_detail_inside" style="padding-left: 2px; padding-right:2px; vertical-align:top;">
		{include file="nickpage_navi.tpl"}
		{if $smarty.get.errid !=  ''}
			{include file="display_error.tpl"}
		{elseif $user.is_banned == 1 }
			{assign var="error_message" value="{lang mkey='user_banned'}" }
			{include file="display_error.tpl"}
		{/if}
		<div style="vertical-align:top; text-align:left;">
			{include file="nickpage_basic.tpl"}
{*  display all pictures in public album  *}
			{if $user.pub_pics|@count > 1}
				<br />
				{assign var="nickpage_hdr_text" value="{lang mkey='additional_pics'}" }
				{include file="nickpage_section_hdr.tpl"}
				{include file="nickpage_albumdisplay.tpl"}
			{/if}
{* small snaps display end  *}

			<br />
			{include file="nickpage_content.tpl"}

		    {if $ratings|@count > 0}


			<!-- removed old ratings section -->
			<!-- MOD START -->
			{assign var="nickpage_hdr_text" value="{lang mkey='rating'}"}
			{include file="nickpage_section_hdr.tpl"}
			<div class="module_detail_inside">
				{include file="nickpage_newrating.tpl"}

			</div>
		    {/if}

		    {if count($blogs) > 0}
	           {include file="nickpage_bloglist.tpl"}
		    {/if}
            {if $questionid > 0}
               {include file="nickpage_polllist.tpl"}
            {/if}

			<!-- MOD END -->
		</div>
	</div>
</div>
	<div class="headbg" style="height: 16pt; vertical-align:middle;width:100%; ">
		<div class="headerfooter" style="text-align:right; padding-top:2px;">
		{$profile_views}&nbsp;{lang mkey='views'}&nbsp;&nbsp;
		</div>
	</div>

	{*if $smarty.get.id != $smarty.session.UserId}
		<script type='text/javascript'>
			var thisUid = "{$smarty.get.id}";
			var thisUname = "{$user.username}";
			selectedUser(thisUname, thisUid);
		</script>
	{/if*}
	{if $config.use_profilepopups == 'Y'}
		{include file="popfooter.tpl"}
	{/if}
{/if}
