{strip}
<div class="module_detail_inside">
	{assign var="mcnt" value=0}
	{foreach from=$user.pub_pics item=pic}
		{if $mcnt == 0}
			<div style="text-align: left; padding-top: 2px; padding-bottom: 2px; padding-left: 6px; padding-right: 6px;">
		{/if}
		{assign var="mcnt" value=$mcnt+1}
		<img src="getsnap.php?id={$user.id}&amp;picid={$pic.picno}&amp;typ=tn&amp;width=45&amp;height=45" class="smallpic" style="margin:2px 1px 1px 1px;" onclick="enlarge(this);" longdesc="getsnap.php?id={$user.id}&amp;typ=full&amp;picid={$pic.picno}" id="pic{$pic.picno}" alt="" title="{$pic.pic_descr}" />
		{if $mcnt == ($config.album_tnpics_cnt * 2)}
			</div>
			{assign var="mcnt" value=0}
		{/if}
	{/foreach}
	{if $mcnt > 0}</div>{/if}
{*
	<div style="text-align:right; margin-bottom: 4px;">
		<a href="#" onclick="javascript:popUpScrollWindow2('userpicgallery.php?id={$user.id}','center',600,600);" >{lang mkey='view_all_pics'}..</a>&nbsp;&nbsp;&nbsp;&nbsp;
	</div>
*}
</div>
{/strip}