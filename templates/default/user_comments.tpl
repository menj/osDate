{strip}
<div style="vertical-align:top;" >
	{assign var="page_hdr01_text" value="{lang mkey='user_comments'}"}
	{assign var="page_title" value="{lang mkey='user_comments'}"}
	{include file="page_hdr01.tpl"}

	<div class="module_detail_inside" style="padding:4px;">
		{assign var="ct" value=$commentslist|@count}
		{assign var="page_hdr02_text" value="{lang mkey='no_of_comments'}"|cat:": "|cat:$ct}
		{include file="page_hdr02.tpl"}
		<div class="module_detail_inside">
	{if $error_message != ''}
		{include file="display_error.tpl"}
	{/if}
	{if $commentslist|@count eq 0 }
		<div class="line_outer">
			{lang mkey='no_record_found'}
		</div>
	{else}
		<form name="commentsFrm" action="user_comments.php" method="post">
		<input type="hidden" name="id" value="" />
		<input type="hidden" name="remove" value="" />
		<table border="0" width="100%" cellspacing="{$config.cellspacing}" cellpadding="{$config.cellpadding}">
		<tr class="table_head">
			{if $smarty.session.security.allow_commnet_removal == 1}
			<th align=center><input type="checkbox" name="chkall" value="" onclick="checkAll(this.form,'txtcheck[]',this.checked)"/></th >
			{/if}
			<th >{lang mkey='username_hdr'}</th>
			<th >{lang mkey='comments'}</th>
			<th >{lang mkey='reply'}</th>
			{if $smarty.session.security.allow_commnet_removal == 1}
			<th >{lang mkey='action'}</th>
			{/if}
		</tr>
		{assign var="mcount" value="0"}
		{foreach item=item key=key from=$commentslist}
			{math equation="$mcount+1" assign="mcount"}
			<tr class="{cycle  values="oddrow,evenrow"}">
				{if $smarty.session.security.allow_commnet_removal == 1}
				<td width="3%" align="center">
					<input type="checkbox" name="txtcheck[]" value="{$item.id}"/></td>
				{/if}
				<td width="25%">
				{if $config.enable_mod_rewrite == 'Y'}
					<a href="javascript:popUpScrollWindow2('{$docroot}{if $config.seo_username == 'Y'}{$item.username}{else}{$item.userid}.htm{/if}','top',650,600)">
				{else}
					<a href="javascript:popUpScrollWindow2('{$docroot}showprofile.php?{if $config.seo_username == 'Y'}username={$item.username}{else}id={$item.userid}{/if}','top',650,600)">
				{/if}
					{$item.username}
					<br /><img src="getsnap.php?id={$item.userid}&amp;typ=tn" alt="{$item.username}" />
					</a>
				</td>
				<td width="35%"><textarea rows="5" cols="20" scroll="auto" readonly>{$item.comment }</textarea></td>
				<td width="32%"><textarea rows="5" cols="20" scroll="auto" readonly>{$item.reply }</textarea></td>
				{if $smarty.session.security.allow_commnet_removal == 1}
				<td width="5%">
				<input name="rem" value="{lang mkey='Remove'}" type="button" class="formbutton" onclick="document.forms['commentsFrm'].id.value={$item.id};document.forms['commentsFrm'].remove.value='1';document.forms['commentsFrm'].submit(); " />
				</td>
				{/if}
			</tr>
		{/foreach}
		{if $smarty.session.security.allow_commnet_removal == 1}
		<tr>
			<td colspan="4" align="left">
				<img src="images/arrow_ltr.png" alt="" />{lang mkey='with_selected'}&nbsp;
				<input type="submit" class="formbutton" value="{lang mkey='delete_selected'}" name="groupaction"/>
			</td>
		</tr>
		{/if}
		</table>
		</form>
	{/if}
		</div>
	</div>
</div>
{/strip}
