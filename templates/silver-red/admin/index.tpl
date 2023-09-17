{include file='admin/index_header.tpl'}
{strip}
<body  dir="{lang mkey='DIRECTION'}">
<center>
<div style="width:800px;" align="center">
	<table width="100%" border="0" cellpadding="0" cellspacing="0" class="loginbarbg">
		<tr>
			<td height="33" width="154"><img src="{$image_dir}big_arrow.jpg" alt="" /></td>
			<td height="33" width="625">
				<span class="admin_head">{lang mkey='admin_login_title'}{if $smarty.session.AdminId > 0}&nbsp;{else} / <a href="{$docroot}index.php">{lang mkey='home_title'}</a>{/if}</span>
			</td>
		</tr>
	</table>
{if $smarty.session.AdminId == '' }
		{include file="admin/admin_login.tpl"}
{else}
	{if $config.adminmenutype == 'top'}
		<div style="margin-top: 6px; width:100%;">
			{include file="admin/dropdownpanelmenu.tpl"}
			<div style="vertical-align:top; width: 100%; padding-left: 5px; text-align:left;">
				{$rendered_page}
			</div>
		</div>
	{else}
	<div style="margin-top: 6px;width:100%;">
		<div style="display:inline; float:left; vertical-align:top; width: 190px;" align="left">
			{include file="admin/panelmenu.tpl"}
		</div>
		<div style="display:inline; float:left; vertical-align:top; width: 595px; padding-left: 5px; text-align:left;">
			{$rendered_page}
		</div>
		<div style="clear:both;"></div>
	</div>
	{/if}
{/if}
	<div align="center" style="margin-top: 12px;">
		<a href="http://www.tufat.com/osdate.php" target="_blank" class='copyright'>{$config.copyright}</a>
	</div>
</div>

</center>
{closedb}
</body>
</html>
{/strip}
