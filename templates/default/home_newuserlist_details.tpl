{assign var="xtd" value="0"}
{foreach item=user from=$nulusers}
{if $xtd == 0 }
	{cycle values="oddrow,evenrow" assign="class"}
	<div style="clear:both; height: 16px; vertical-align: middle; text-align: left;">
{/if}
		<div class="{$class}" style="width:49.5%; display:inline; float:left; margin-left: 1px; height: 16px; ">
			<span style="padding-left: 6px;">
			{if $config.enable_mod_rewrite == 'Y'}
				<a href="javascript:popUpScrollWindow2('{$docroot}{if $config.seo_username == 'Y'}{$user.username}{else}{$user.id}.htm{/if}','top',650,600)">
			{else}
				<a href="javascript:popUpScrollWindow2('{$docroot}showprofile.php?{if $config.seo_username == 'Y'}username={$user.username}{else}id={$user.id}{/if}','top',650,600)">
			{/if}
			{$user.username}
			</a>
			</span>
		</div>
	{assign var="xtd" value=$xtd+1}
	{if $xtd == 2 }
		{assign var="xtd" value="0"}
	</div>
	{/if}
{/foreach}
{if $xtd == 1}
		<div style="clear:both;line-height:3px;"> </div>
	</div>
{/if}
<div style="text-align:left; margin-left: 6px; height:16px; padding-top:2px;">
	<a href="newmemberslist.php">{lang mkey='showfulllist'}</a>
</div>
