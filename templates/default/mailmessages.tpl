{strip}
<script type="text/javascript">
/* <![CDATA[ */
{literal}
function checkAll(form,name,val){
	for( i=0 ; i < form.length ; i++)
		if( form.elements[i].type == 'checkbox' && form.elements[i].name == name )
			form.elements[i].checked = val;
}
function confdel(form,errmsg){
	for(i=0;i < form.length;i++){
		if(form.elements[i].type=='checkbox' && form.elements[i].checked == true){
			selected = true;
			break;
		}
		else {
			selected = false;
		}
	}
	if(!selected) {
		alert(errmsg);
		return false;
	}else{
		form.submit();
		return true;
	}
}
{/literal}
/* ]]> */
</script>
<div style="vertical-align:top;" >
	{assign var="page_hdr01_text" value="{lang mkey='mail_messages'}"}
	{assign var="page_title" value="{lang mkey='mail_messages'}"}
	{include file="page_hdr01.tpl"}
	<div class="module_detail_inside">
		<div class="line_outer">
			{if $error_message != ''}
				{include file="display_error.tpl"}
			{/if}
			<div class="line_top_bottom_pad">
				<div style="display:inline; float:left; line-height: 20px; vertical-align: bottom;" id="folder_hdg">
					{if $folder != ''}
					<b><font size="2">{$foldername}</font></b>
					{/if}
				</div>
				<div style="display:inline; float:right; margin-right: 4px; text-align:right; vertical-align:bottom;">
				{if $view == '0' }
					<a href="edituser.php">{lang mkey='change_email'}</a>
				{/if}
				</div>
				<div style="clear:both;"></div>
			</div>
			<div class="line_top_bottom_pad">
				<div style="display:inline; float:left; vertical-align: bottom;" id="folder_hdgs">
					{if $folder != 'inbox' or $view=='1'}<a href="mailmessages.php?sort={$smarty.get.sort}&amp;type={$smarty.get.type}&amp;selflag={$selflag}&amp;folder=inbox">{lang mkey='inbox'}</a>{else}{lang mkey='inbox'}{/if} ({$msg_counts.inbox|default:0})
					{if $smarty.session.security.message == 1 or $config.allow_reply_by_all == 'Y' or $config.allow_reply_by_all == '1'}&nbsp;| {if $folder != 'sent'}<a href="mailmessages.php?sort={$smarty.get.sort}&amp;type={$smarty.get.type}&amp;selflag={$selflag}&amp;folder=sent">{lang mkey='sent'}</a>{else}{lang mkey='sent'}{/if} ({$msg_counts.sent|default:0})
					{/if} | {if $folder != 'trashcan'}<a href="mailmessages.php?sort={$smarty.get.sort}&amp;type={$smarty.get.type}&amp;selflag={$selflag}&amp;folder=trashcan">{lang mkey='trashcan'}</a>{else}{lang mkey='trashcan'}{/if} ({$msg_counts.trashcan|default:0})
					&nbsp;&nbsp;({lang mkey='total'} {$total_count}/{$allowed_count})
				</div>
				<div style="display:inline; float:right; margin-right: 4px; text-align:right; vertical-align:bottom;">
					{if $view == '0'}
						{if $selflag != 'F'}
						<a href="mailmessages.php?sort={$smarty.get.sort}&amp;type={$smarty.get.type}&amp;folder={$folder}&amp;selflag=F">{lang mkey='flagged'}</a>
						{else}
						{lang mkey='flagged'}
						{/if} | {if $selflag != 'U'}
						<a href="mailmessages.php?sort={$smarty.get.sort}&amp;type={$smarty.get.type}&amp;folder={$folder}&amp;selflag=U">{lang mkey='un_flagged'}</a>
						{else}{lang mkey='un_flagged'}{/if} | {if $selflag != 'A'}<a href="mailmessages.php?sort={$smarty.get.sort}&amp;type={$smarty.get.type}&amp;folder={$folder}&amp;selflag=A">{lang mkey='all'}</a>{else}{lang mkey='all'}{/if}
					{else}
						<form action="mailmessages.php" method="post">
						<input type="hidden" name="selflag" value="{$selflag}" />
						<input type="hidden" name="sort" value="{$smarty.get.sort}" />
						<input type="hidden" name="type" value="{$smarty.get.type}" />
						<input type="hidden" name="folder" value="{$folder}" />
						<input type="hidden" name="id" value="{$data.id}" />
						<input type="hidden" name="view" value="1" />						{if $folder == 'inbox' and ($smarty.session.security.message == 1 or $config.allow_reply_by_all == 1 or $config.allow_reply_by_all == 'Y') }
							<input type="button" class="formbutton" value="{lang mkey='reply'}" name="msgaction" onclick="javascript:popUpScrollWindow2('{$docroot}compose.php?recipient={$data.refuid}&amp;reply=1&amp;folder={$folder}&amp;selflag={$selflag}&amp;msgid={$data.id}','center',650,600)" />&nbsp;
							<input type="button" class="formbutton" value='{lang mkey='no_thanks'}' name="msgaction" onclick="javascript:popUpScrollWindow2('{$docroot}compose.php?recipient={$data.refuid}&amp;reply=11&amp;folder={$folder}&amp;selflag={$selflag}&amp;refuname={$data.username}','center',650,600)" />
						{/if}
						</form>
					{/if}
				</div>
				<div style="clear:both;"></div>
			</div>
		{if $view == '0' }
			<div class="line_top_bottom_pad" style="padding-top: 4px;">
				{lang mkey='unflagged_msg1'}{$allowed_days|default:30}{lang mkey='unflagged_msg2'}
			</div>
			<div class="module_head line_top_bottom_pad" style="padding-top: 4px; padding-left: 6px; line-height:20px; vertical-align: middle;">
			{if $folder == 'inbox'}
				{lang mkey='inbox'}
			{elseif $folder == 'sent'}
				{lang mkey='sent'}
			{elseif $folder=='trashcan'}
				{lang mkey='trashcan'}
			{/if}
			</div>
			<div class="module_detail_inside line_top_bottom_pad">
				<form name="frmGroupMail" action="?sort={$smarty.get.sort}&amp;type={$smarty.get.type}&amp;selflag={$selflag}&amp;folder={$folder}"
				method="post" onsubmit="javascript: return confdel(this,'{lang mkey='admin_js_error_msgs' skey=1}');">
				<input type="hidden" name="frm" value="frmGroupMail" />
				<table  border="0" cellpadding="0" cellspacing="0" width="100%">
				<tr class="column_head">
					<th width="5%"><input type="checkbox" name="chkall" value="" onclick="checkAll(this.form,'txtcheck[]',this.checked)"/></th>
					<th width="5%" style="text-align:center;"><img src="images/flag.gif" alt="" /></th>
					<th width="5%" align="left"><img src="images/unread.jpg" alt="" /></th>
					<th width="40%"><a href="?sort={lang mkey='col_head_subject'}&amp;type={$sort_type}&amp;selflag={$selflag}&amp;folder={$folder}">{lang mkey='col_head_subject'}</a></th>
					<th width="20%"><a href="?sort={lang mkey='col_head_username'}&amp;type={$sort_type}&amp;selflag={$selflag}&amp;folder={$folder}">{lang mkey='col_head_username'}</a></th>
					<th width="25%"><a href="?sort={lang mkey='col_head_sendtime'}&amp;type={$sort_type}&amp;selflag={$selflag}&amp;folder={$folder}">{lang mkey='col_head_sendtime'}</a></th>
				</tr>
			{if $data|@count == 0}
				<tr>
					<td colspan="6" style="text-align:center;">
						<span class="errors">
							{if $selflag == 'F'}
								{lang mkey='no_flagged_messages_in_box'}
							{ elseif $selflag == 'U'}
								{lang mkey='no_unflagged_messages_in_box'}
							{else}
								{lang mkey='no_messages_in_box'}
							{/if}
						</span>
					</td>
				</tr>
			{/if}
			{assign var="mcount" value="0"}
			{foreach item=item key=key from=$data}
				{math equation="$mcount+1" assign="mcount"}
				<tr {if $item.warnflag == '1'}class="im_warn"{/if}>
					<td width="5%"><input type="checkbox" name="txtcheck[]" value="{$item.id}"/></td>
					<td width="5%" style="text-align:center;">{if $item.flag==1}<img src="images/flag.gif" alt="" />{else}&nbsp;{/if}</td>
					<td width="5%" align="left">
					{if $item.flagread }
						{if $item.replied == '1'}
							<img src="images/reply.gif" alt="" />
						{else}
							<img src="images/read.jpg" alt="" />
						{/if}
					{else}
						<img src="images/unread.jpg" alt="" />
					{/if}
					</td>
					<td width="40%"><a href="mailmessages.php?sort={$smarty.get.sort}&amp;type={$smarty.get.type}&amp;selflag={$selflag}&amp;folder={$folder}&amp;id={$item.id}&amp;view=1">
					{if trim($item.subject) == '' }
						{lang mkey='no_subject'}
					{else}
						{$item.subject|stripslashes}
					{/if}</a>
					</td>
					<td  width="20%">
					{if $config.enable_mod_rewrite == 'Y'}
						<a href="javascript:popUpScrollWindow2('{$docroot}{if $config.seo_username == 'Y'}{$item.username}{else}{$item.refuid}.htm{/if}','top',650,600)">
					{else}
						<a href="javascript:popUpScrollWindow2('{$docroot}showprofile.php?{if $config.seo_username == 'Y'}username={$item.username}{else}id={$item.refuid}{/if}','top',650,600)">
					{/if}
						{$item.username}</a> ({$lang.signup_gender_values[$item.usergender]})

					</td>
					<td  width="25%">{$item.converted_time|date_format:"%d %B %Y at %I:%M %p"}</td>
				</tr>
			{/foreach}
				<tr>
					<td colspan="6">
					<img src="{$smarty.const.ADMIN_DIR}/images/arrow_ltr.png" alt=""  />{lang mkey='with_selected'}&nbsp;
					<input type="submit" class="formbutton" value="{lang mkey='delete'}" name="groupaction" />&nbsp;
					{if $folder == 'trashcan'}
					<input type="submit" class="formbutton" value="{lang mkey='undelete'}" name="groupaction" />&nbsp;
					{/if}
					<input type="submit" class="formbutton" value="{lang mkey='flag'}" name="groupaction" />&nbsp;
					<input type="submit" class="formbutton" value="{lang mkey='unflag'}" name="groupaction" />&nbsp;
					<input type="submit" class="formbutton" value="{lang mkey='read'}" name="groupaction" />&nbsp;
					<input type="submit" class="formbutton" value="{lang mkey='unread'}" name="groupaction" />
					</td>
				</tr>
				</table>
				</form>
			</div>
			{else}
			<div class="module_detail_inside">
				<table width="100%" border="0" cellpadding="0"  cellspacing="0">
				<tr>
					<td colspan="4" class="module_detail_inside">
						{if $data.subject != ''}
							{assign var="page_hdr02_text" value=$data.subject|stripslashes}
						{else}
							{assign var="page_hdr02_text" value="{lang mkey='no_subject'}"}
						{/if}
						{include file="page_hdr02.tpl"}
					</td>
				</tr>
				<tr>
					<td height="6" colspan="4"></td></tr>
				<tr>
					<td width="6">&nbsp;</td>
					<td width="76%" valign="top">
						{if $data.fldr == 'inbox'}
							{lang mkey='FROM1'}:&nbsp;
						{else}
							{lang mkey='To1'}:&nbsp;
						{/if}
						{if $config.enable_mod_rewrite == 'Y'}
							<a href="javascript:popUpScrollWindow2('{$docroot}{if $config.seo_username == 'Y'}{$data.username}{else}{$data.refuid}.htm{/if}','top',650,600)">
						{else}
							<a href="javascript:popUpScrollWindow2('{$docroot}showprofile.php?{if $config.seo_username == 'Y'}username={$data.username}{else}id={$data.refuid}{/if}','top',650,600)">
						{/if}
							{$data.username}</a><br />
						{lang mkey='col_head_date'}:&nbsp;
						{$data.converted_time|date_format:"%d %B %Y at %I:%M %p"}<br /><br />
						{$data.message|nl2br|stripslashes}
					</td>
					<td width="3%" valign="top">&nbsp;
						{if $data.flag == '1'}<img src="images/flag.gif" alt="" />
						{else}
							&nbsp;
						{/if}
					</td>
					<td width="20%" valign="top">
					{if $piccnt > 0}
					{if $config.enable_mod_rewrite == 'Y'}
						<a href="javascript:popUpScrollWindow2('{$docroot}{if $config.seo_username == 'Y'}{$data.username}{else}{$data.refuid}.htm{/if}','top',650,600)">
					{else}
						<a href="javascript:popUpScrollWindow2('{$docroot}showprofile.php?{if $config.seo_username == 'Y'}username={$data.username}{else}id={$data.refuid}{/if}','top',650,600)">
					{/if}
						<img src="getsnap.php?id={$data.refuid}&amp;typ=tn" class="smallpic" alt="" />
						</a>
					{else}
						&nbsp;
					{/if}
					</td>
				</tr>
				<tr><td height="6">&nbsp;</td></tr>
				</table>
				<div class="line_outer">
					<form action="mailmessages.php" method="post">
					<input type="hidden" name="selflag" value="{$selflag}" />
					<input type="hidden" name="sort" value="{$smarty.get.sort}" />
					<input type="hidden" name="type" value="{$smarty.get.type}" />
					<input type="hidden" name="folder" value="{$folder}" />
					<input type="hidden" name="id" value="{$data.id}" />
					<input type="hidden" name="view" value="1" />
					<table border="0" cellspacing="0" cellpadding="0" width="100%">
						<tr>
							<td width="60%" >
								<input type="submit" class="formbutton" value="{lang mkey='delete'}" name="msgaction" />&nbsp;
								<input type="submit" class="formbutton" value="{lang mkey='flag'}" name="msgaction" />&nbsp;
								<input type="submit" class="formbutton" value="{lang mkey='unflag'}" name="msgaction" />
							</td>
							<td align="right" width="40%">
								{if $folder == 'inbox' and ($smarty.session.security.message == 1 or $config.allow_reply_by_all == 1 or $config.allow_reply_by_all == 'Y') }
									<input type="button" class="formbutton" value="{lang mkey='reply'}" name="msgaction"  onclick="javascript:popUpScrollWindow2('{$docroot}compose.php?recipient={$data.refuid}&amp;reply=1&amp;folder={$folder}&amp;selflag={$selflag}&amp;msgid={$data.id}','center',650,600)" />&nbsp;
									<input type="button" class="formbutton" value='{lang mkey='no_thanks'}' name="msgaction" onclick="javascript:popUpScrollWindow2('{$docroot}compose.php?recipient={$data.refuid}&amp;reply=11&amp;folder={$folder}&amp;selflag={$selflag}&amp;refuname={$data.username}','center',650,600)" />
								{/if}
							</td>
						</tr>
					</table>
					</form>
				</div>
			</div>
			{/if}
		</div>
	</div>
</div>
{/strip}
