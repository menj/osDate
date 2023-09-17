{if $config.use_profilepopups == 'Y' or $smarty.session.AdminId != ''}
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
{else}
	<center>
	{if $config.use_profilepopups == 'Y' or $smarty.session.AdminId != ''}
	<div class="nickwidth" align=center >
	{/if}
		{include file="nickpage_logo.tpl"}
		{* include file="nickpage_navi.tpl" *}
	<div class="module_detail_inside" style="padding-left: 2px; padding-right:2px;">
		{if $smarty.get.errid !=  ''}
			{include file="display_error.tpl"}
		{/if}
		<div  style="vertical-align:top; ">
			{include file="nickpage_basic.tpl"}
	{*  display all pictures in public album  *}
			{if $user.pub_pics|@count > 1}
				<br />
				{assign var="nickpage_hdr_text" value="{lang mkey='additional_pics'}" }
				{include file="nickpage_section_hdr.tpl"}
				<div class="module_detail_inside">
					{assign var="mcnt" value=0}
					{foreach from=$user.pub_pics item=pic}
						{if $mcnt == 0}
							<div style="text-align: left; padding-top: 2px; padding-bottom: 2px; padding-left: 6px; padding-right: 6px;">
						{/if}
						{assign var="mcnt" value=$mcnt+1}
						<a href="#" onclick="javascript:popUpScrollWindow2('userpicgallery.php?id={$user.id}&amp;galpicid={$pic.picno}','center',600,600);">
						<img src="getsnap.php?id={$user.id}&amp;picid={$pic.picno}&amp;typ=tn&amp;width=45&amp;height=45" class="smallpic" style="margin:2px 1px 1px 1px;" alt="" />
						</a>
						{if $mcnt == ($config.album_tnpics_cnt * 2)}
							</div>
							{assign var="mcnt" value=0}
						{/if}
					{/foreach}
					{if $mcnt > 0}</div>{/if}
					<div style="text-align:right; margin-bottom: 4px;">
						<a href="#" onclick="javascript:popUpScrollWindow2('userpicgallery.php?id={$user.id}','center',600,600);" >{lang mkey='view_all_pics'}..</a>&nbsp;&nbsp;&nbsp;&nbsp;
					</div>
				</div>
			{/if}
		{* small snaps display end  *}
			<br />
			{include file="nickpage_content.tpl"}

			{if count($ratings) > 0}

				{assign var="nickpage_hdr_text" value="{lang mkey='rating'}"}
				{include file="nickpage_section_hdr.tpl"}
				<!-- removed old ratings section -->
				<!-- MOD START -->
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

			<div class="headbg">
				<div class="headerfooter" style="text-align:right; vertical-align:middle; width:100%; line-height: 20px;">
				{$profile_views}&nbsp;{lang mkey='views'}&nbsp;&nbsp;
				</div>
			</div>
		</div>
		</div>
	</div>
	</center>
	{if $config.use_profilepopups == 'Y' or $smarty.session.AdminId != ''}
		<script type="text/javascript"> /* <![CDATA[ */ window.focus(); /* ]]> */</script>
	{/if}

	{if $config.use_profilepopups == 'Y' or $smarty.session.AdminId != ''}
		{closedb}
		</body>
		</html>
	{/if}
{/if}
