{strip}
{assign var="page_hdr01_text" value="{lang mkey='manage_admin_permissions'}"}
{include file="admin/admin_page_hdr01.tpl"}
{assign var="page_title" value="{lang mkey='manage_admin_permissions'}"}
<div style="padding-top:6px;">
	{assign var="page_hdr02_text" value="{lang mkey='admin_users'}"}
	{include file="admin/admin_page_hdr02.tpl"}
	<div class="module_detail_inside"  style="padding-top:1px;">
		<div class="line_outer">
	{if $admins|@count == 0}
			{lang mkey='no_admin_user_msg1'}<br />
			<div class="line_top_bottom_pad">
				{lang mkey='no_admin_user_msg2'}&nbsp;<a href="adminins.php">{lang mkey='click_here'}</a>.
			</div>
	{else}
		<form name="frm" action="adminpermissions.php" method="post">
			<table border="0" width="100%"  cellpadding="1" cellspacing="2">
		{foreach item=item key=key from=$admins}
			{if $data.adminid == $key}
				<tr><td width="5"><input type="radio" name="adminid" value="{$key}" onclick="javascript: document.frm.submit();" checked="checked" />
				</td>
				<td valign="middle">{$item}</td></tr>
			{else}
				<tr><td width="5"><input type="radio" name="adminid" value="{$key}" onclick="javascript: document.frm.submit();" />
				</td>
				<td valign="middle">{$item}</td></tr>
			{/if}
		{/foreach}
			</table>
		</form>
	{/if}
		</div>
	{if $admins|@count > 0}
		<center>
		<div class="top_margin_6px" style="width:100%; text-align:left;">
			{assign var="page_hdr02_text" value="{lang mkey='permissions'}"|cat:"{lang mkey='for'}"|cat:$admin_name }
			{include file="admin/admin_page_hdr02.tpl"}
			<div class="line_outer" >
				<form name="frm2" method="post" action="adminpermissions.php">
					<input type="hidden" value="{$data.adminid}" name="adminid" />
					<input type="hidden" value="{$data.id}" name="id" />
					<table width="530" border="0" cellpadding="1" cellspacing="2" >
					{foreach item=item key=key from=$rights}
						{if $key != id && $key != adminid}
							<tr class="{cycle values="oddrow,evenrow"}">
								<td>{$item}</td>
							{if $data[$key] == 1}
								<td><input type="checkbox" name="{$key}" checked="checked" /></td>
							{else}
								<td><input type="checkbox" name="{$key}" /></td>
							{/if}
							</tr>
						{/if}
					{/foreach}
						<tr>
							<td align="center" colspan="2">
								<input type="submit" class="formbutton" name="modify" value="{lang mkey='modify'}" />
							</td>
						</tr>
					</table>
				</form>
			</div>
		</div>
		</center>
	{/if}
	</div>
</div>
{/strip}