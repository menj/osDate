{strip}
{if $type == 'gallery'}
	{assign var="page_hdr01_text" value=$username|cat:"\'s "|cat:"{lang mkey='picture_gallery'}"}
	{assign var="page_title" value="{lang mkey='picture_gallery'}"}
	{assign var="page_hdr01_text_r" value='<a href="userpics.php?userid='|cat:$userid|cat:'&amp;type='|cat:$type|cat:'" class="subhead">'|cat:"{lang mkey='upload_pictures'}"|cat:'</a>&nbsp;&nbsp;'}
{else}
	{assign var="page_hdr01_text" value=$username|cat:"\'s "|cat:"{lang mkey='profilepics_gallery'}"}
	{assign var="page_title" value="{lang mkey='profilepics_gallery'}"}
	{assign var="page_hdr01_text_r" value='<a href="userpics.php?userid='|cat:$userid|cat:'&amp;type='|cat:$type|cat:'" class="subhead">'|cat:"{lang mkey='upload_profilepics'}"|cat:'</a>&nbsp;&nbsp;'}
{/if}
<div class="module_detail_inside" style="text-align:left;">
{include file="admin/admin_page_hdr01.tpl"}
{if $error != ''}
	{assign var="error_message" value=$error}
	{include file="display_error.tpl"}
{/if}
	<form name="album01" action="" method="post" >
	<input type="hidden" name="userid" value="{$userid}"/>
		<div class="line_outer" style="margin-left: 6px; margin-bottom: 3px;">
		{lang mkey='album_hdr'}:&nbsp;&nbsp;
		<select name="album_id" >
		{foreach from=$albums key=id item=name}
			<option value="{$id}" {if $id== $album_id} selected {/if}>{$name}</option>
		{/foreach}
		</select>&nbsp;
		<input type="submit" value="{lang mkey='show'}" class="formbutton" />
		</div>
	</form>
	<div class="line_outer">
		{assign var="cntr" value="1"}
		<table cellspacing="4" cellpadding="4" border="0">
			{foreach item=pic from=$user_pics}
			{if $cntr==1}
			<tr>
			{/if}
			<td>
			<table cellspacing="1" cellpadding="1" border="0">
				<tr>
					<td height="100">
						<img src="getsnap.php?id={$userid}&amp;typ=tn&amp;picid={$pic.picno}&amp;album_id={$album_id}" alt="{$pic.picno}"  onclick="enlarge(this);" longdesc="getsnap.php?id={$userid}&amp;typ=pic&amp;picid={$pic.picno}&amp;album_id={$album_id}" id="pic{$pic.picno}" border="0" class="smallpic" />
					</td>
				</tr>
			</table>
			</td>
			{assign var="cntr" value=$cntr+1}
			{if $cntr > $config.album_tnpics_cnt}
				</tr>
				{assign var="cntr" value="1"}
			{/if}
		{/foreach}
			{if $cntr == $config.album_tnpics_cnt}
				</tr>
			{/if}
		</table>
	</div>
</div>
{/strip}