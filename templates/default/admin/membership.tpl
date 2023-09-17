{strip}
<script type="text/javascript">
/* <![CDATA[ */
function checkMe()
{ldelim}
	if (document.frm2.txtname.value == '' || document.frm2.txtprice.value == '' ){ldelim}
		alert("{lang mkey='errormsgs' skey=20}");
		return false;
	{rdelim}
	document.frm2.modify.value="{lang mkey='modify'}";
	document.frm2.submit();
{rdelim}
/* ]]> */
</script>

{assign var="page_hdr01_text" value="{lang mkey='manage_membership'}"}
{assign var="page_title" value="{lang mkey='manage_membership'}"}
{include file="admin/admin_page_hdr01.tpl"}
<div style="padding-top: 6px;">
	{assign var="page_hdr02_text" value="{lang mkey='membership_types'}"}
	{include file="admin/admin_page_hdr02.tpl"}
	<div class="module_detail_inside" style="padding-top:1px; text-align:left;">
		<div class="line_outer">
			<form name="frm" action="membership.php" method="post">
				<table border="0" width="100%"  cellpadding="1" cellspacing="2">
				{foreach item=item key=key from=$memberships}
				{if $data.roleid == $key}
					<tr><td valign="middle" width="6"><input type="radio" name="membership" value="{$key}" onclick="javascript: document.frm.submit();" checked="checked" />
						</td>
						<td valign="middle" width="100%">{$item}</td></tr>
				{else}
					<tr><td width="6" valign="middle"><input type="radio" name="membership" value="{$key}" onclick="javascript: document.frm.submit();" />
						</td>
						<td valign="middle" width="100%">{$item}</td></tr>
				{/if}
				{/foreach}
					<tr><td></td></tr>
					<tr><td colspan="2"><a href="addmship.php">{lang mkey='add_membership'}</a></td>
					</tr>
				</table>
			</form>
				{assign var="page_hdr01_text" value="{lang mkey='privileges_msg'} {lang mkey='for'} "|cat:$memberships[$data.roleid]}
				{include file="admin/admin_page_hdr01.tpl"}
				<div class="module_detail_inside">
				<form name="frm2" method="post" action="membership.php">
					<input type="hidden" value="{$data.roleid}" name="mshipid" />
					<input type="hidden" value="{$data.id}" name="id" />
					<table width="100%" border="0" cellpadding="1" cellspacing="2" >
					<tbody>
						<tr class="oddrow">
							<td width="60%">{lang mkey='name'}<font class="required_info">{$smarty.const.REQUIRED_INFO}</font></td>
							<td width="40%">&nbsp;<input type="text" class="textinput" value="{$data.name}" name="txtname" size="10" />
							</td>
						</tr>
						<tr  class="evenrow">
							<td width="60%">{lang mkey='price'}<font class="required_info">{$smarty.const.REQUIRED_INFO}</font>
							</td>
							<td width="40%">&nbsp;<input type="text" class="textinput" value="{$data.price}" name="txtprice" size="10" />
							</td>
						</tr>
						<tr  class="oddrow">
							<td width="60%">{lang mkey='currency'}</td>
							<td width="40%">&nbsp;<select name="txtcurrency">{html_options options=$lang.support_currency selected=$data.currency}</select></td>
						</tr>
					{foreach from=$lang.privileges key=key item=item}
						<tr  class="{cycle values="evenrow,oddrow"}">
					{if $key != 'activedays' }
							<td width="60%">{$item}</td>
							<td width="40%">{if $key=='uploadpicturecnt' or $key == 'message_keep_cnt' or $key == 'message_keep_days' or $key == 'saveprofilescnt' or $key == 'messages_per_day' or $key == 'winks_per_day' or $key == 'videoscnt' or $key == 'profilepicscnt'}
							&nbsp;<input type="text" class="textinput" size="4" name="{$key}" value="{$data[$key]}" />
							{else}
							<input type="checkbox" name="{$key}" {if $data[$key] eq '1'}checked="checked"{/if} />
							{/if}
							</td>
					{else}
							<td width="60%">{lang mkey='active_days'}</td>
							<td width="40%">&nbsp;<select name="activedays">{html_options options=$lang.activedays_array selected=$data.activedays}</select></td>
					{/if}
						</tr>
					{/foreach}
	{*					<tr><td>&nbsp;</td></tr>  *}
						<tr>
							<td align="center" colspan="2">
								<br />
								<input name="modify" type="hidden" value="" />
								<input type="button" class="formbutton" value="{lang mkey='modify'}" onclick="javascript:checkMe();" />&nbsp;
							{if $data.roleid != 3}
								<input type="submit" class="formbutton" value="{lang mkey='delete_selected'}" name="delete" />&nbsp;
								{if $data.enabled == 'N'}
								<input type="submit"  class="formbutton" value="{lang mkey='enable_selected'}" name="enable" />
								{elseif $data.enabled == 'Y'}
								<input type="submit" class="formbutton" value="{lang mkey='disable_selected'}" name="disable" />
								{/if}
							{/if}
							</td>
						</tr>
					</tbody>
					</table>
				</form>
			</div>
		</div>
	</div>
</div>
{/strip}