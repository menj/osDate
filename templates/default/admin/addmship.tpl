{strip}
<script type="text/javascript">
/* <![CDATA[ */
function checkMe(frm) {ldelim}
	if (frm.txtname.value == '' || frm.txtprice.value == '') {ldelim}
		alert("{lang mkey='errormsgs' skey=20}");
		return false;
	{rdelim}
	return true;
{rdelim}
/* ]]> */
</script>
{assign var="page_hdr01_text" value='<a href="membership.php" class="subhead">'|cat:"{lang mkey='manage_membership'}"|cat:'</a>'}
{assign var="page_title" value="{lang mkey='manage_membership'}"}
{include file="admin/admin_page_hdr01.tpl"}
<div class="top_margin_6px">
	{assign var="page_hdr02_text" value="{lang mkey='add_membership'}"}
	{include file="admin/admin_page_hdr02.tpl"}
	<div class="module_detail_inside "  style="padding-top:1px;">
		{if $smarty.get.errid > 0 }
			{assign var="error_message" value="{lang mkey='mship_errors' skey=$smarty.get.errid}" }
			{include file="display_error.tpl" }
		{/if}
		<form name="mshipfrm" action="savemship.php" method="post" onsubmit="javascript: return checkMe(this);">
		<div class="line_outer">
			<table width="98%" border="0" cellspacing="2" cellpadding="1">
				<tr class="oddrow">
					<td width="60%" style="padding-left: 4px;">{lang mkey='name'}<font class="required_info">{$smarty.const.REQUIRED_INFO}</font></td>
					<td width="40%">
						<input type="text" class="textinput"   name="txtname" size="20" />
					</td>
				</tr>
				<tr class="evenrow">
					<td style="padding-left: 4px;">{lang mkey='price'}<font class="required_info">{$smarty.const.REQUIRED_INFO}</font></td>
					<td >
						<input type="text" class="textinput"  name="txtprice" size="4" />
					</td>
				</tr>
				<tr class="oddrow">
					<td style="padding-left: 4px;">{lang mkey='currency'}</td>
					<td >
						<select name="txtcurrency">
							{html_options options=$lang.support_currency selected=$data.currency}
						</select>
					</td>
				</tr>
				<tr><td colspan="2">
					<table width="100%" border="0" cellspacing="2" cellpadding="1">
					{foreach from=$lang.privileges key=key item=item}
						<tr  class="{cycle values="evenrow,oddrow"}">
						{if $key != 'activedays' }
							<td width="60%">{$item}</td>
							<td width="40%">{if $key=='uploadpicturecnt' or $key=='profilepicscnt' or $key=='message_keep_cnt' or $key == 'message_keep_days' or $key == 'messages_per_day' or $key == 'winks_per_day' or  $key == 'videoscnt' or $key == 'saveprofilescnt'}
							&nbsp;<input type="text" class="textinput"  size="4" name="{$key}" value="{$data[$key]}" />
							{else}
								<input type="checkbox" name="{$key}" {if $data[$key] eq '1'}checked="checked"{/if} />
							{/if}
							</td>
						{else}
							<td width="60%">{lang mkey='active_days'}</td>
							<td width="40%">&nbsp;
								<select name="activedays">{html_options options=$lang.activedays_array selected=$data.activedays}
								</select>
							</td>
						{/if}
						</tr>
					{/foreach}
					</table>
					</td>
				</tr>
				<tr><td colspan="2">&nbsp;</tr>
				<tr><td align="center">
					<input type="submit" class="formbutton" value="{lang mkey='submit'}" /></td>
					<td>&nbsp;</td>
				</tr>
			</table>
		</div>
		</form>
	</div>
</div>
{/strip}
