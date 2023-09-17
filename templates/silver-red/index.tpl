{include file="index_header.tpl"}
<body  dir="{lang mkey='DIRECTION'}" {if $google_map eq 'Y'}onload="load_map()"{/if}>
<center>
<!-- Header portion  -->
<div class="main_outer_table" style="width:779px;" >
	<table width="100%" border="0" cellpadding="0" cellspacing="0" class="headbg">
		<tr>
			<td width="3">&nbsp;</td>
			<td width="276" valign="bottom">
				&nbsp;<a href="index.php" class="main_title">{$config.site_name|stripslashes}</a>
			</td>
			<td width="255" valign="top" align="center">
				<table width="255" border="0" cellpadding="0" cellspacing="0">
					<tr>
						<td>
							<img src="{$image_dir}b_02.jpg" width="86" height="41" alt="" /></td>
						<td>
							<img src="{$image_dir}b_03.jpg" width="79" height="41" alt="" /></td>
						<td>
							<img src="{$image_dir}b_04.jpg" width="90" height="41" alt="" /></td>
					</tr>
					<tr>
						<td>
							<img src="{$image_dir}b_13.jpg" width="86" height="42" alt="" /></td>
						<td>
							<img src="{$image_dir}b_14.jpg" width="79" height="42" alt="" /></td>
						<td>
							<img src="{$image_dir}b_15.jpg" width="90" height="42" alt="" /></td>
					</tr>
					<tr>
						<td>
							<img src="{$image_dir}b_16.jpg" width="86" height="41" alt="" /></td>
						<td>
							<img src="{$image_dir}b_17.jpg" width="79" height="41" alt="" /></td>
						<td>
							<img src="{$image_dir}b_18.jpg" width="90" height="41" alt="" /></td>
					</tr>
				</table>

			</td>
			<td width="30" valign="top">&nbsp;</td>
			<td width="200" valign="top">
				<table width="200" border="0" cellpadding="0" cellspacing="0">
					<tr>
						<td>
							<img src="{$image_dir}box_06.jpg" width="12" height="17" alt="" /></td>
						<td>
							<img src="{$image_dir}box_07.jpg" width="176" height="17" alt="" /></td>
						<td>
							<img src="{$image_dir}box_08.jpg" width="12" height="17" alt="" /></td>
					</tr>
					<tr>
						<td>
							<img src="{$image_dir}box_10.jpg" width="12" height="117" alt="" /></td>
						<td align="center" class="headbgbox">
							{include file="searchprofile.tpl"}
						</td>
						<td>
							<img src="{$image_dir}box_12.jpg" width="12" height="117" alt="" /></td>
					</tr>
					<tr>
						<td>
							<img src="{$image_dir}box_19.jpg" width="12" height="15" alt="" /></td>
						<td>
							<img src="{$image_dir}box_20.jpg" width="176" height="15" alt="" /></td>
						<td>
							<img src="{$image_dir}box_21.jpg" width="12" height="15" alt="" /></td>
					</tr>
				</table>

			</td>
		</tr>
	</table>
	<table width="100%" border="0" cellpadding="0" cellspacing="0" class="loginbarbg">
{*				<tr>
			<td colspan="4">
			<img src="{$image_dir}menuline2.jpg" width="779" height="6" alt="" />
			</td>
		</tr>   *}
		<tr>
			<td height="35" width="154"><img src="{$image_dir}big_arrow.jpg" alt="" /></td>
			<td height="33" width="575">
				{if $smarty.session.UserId == ''}
	  <form name="frmLogin" method="post" action="midlogin.php" onsubmit="javascript: return newvalidateLogin(this);" >
					<table width="100%" cellpadding="0" cellspacing="0" border="0">
						<tr>
							<td>
								<b>{lang mkey='members_login'}</b>&nbsp;
								<img src="{$image_dir}blue_box.gif" width="2" height="10" alt="" />&nbsp;
								{lang mkey='signup_username'}&nbsp;
								<input class="textinput" maxlength="25" name="txtusername" size="8" style='font-size:9pt;width:70px' />&nbsp;&nbsp;
								{lang mkey='signup_password'}&nbsp;
								<input class="textinput" type="password"  name="txtpassword" size="8" style='font-size:9pt;width:70px' />&nbsp;
								<input type="submit" value="{lang mkey='login_submit'}" class='formbutton' />&nbsp;
								<a href='signup.php'>{lang mkey='register'}</a>
							</td>
						</tr>
					</table>
	  </form>
				{else}
					<strong>{lang mkey='welcome'},&nbsp;{$smarty.session.FullName|stripslashes} &nbsp;({$smarty.session.UserName})</strong>
				{/if}
			</td>
			<td height="33" width="40" align="right" valign="middle">
			{if $smarty.session.security.extsearch == 1  and $smarty.session.expired != '1' and ( $smarty.session.status == $lang.status_enum.active or $smarty.session.status == 'Active') }
				<a href="advsearch.php"><img src="{$image_dir}search_icon.gif" border="0" width="18" height="18" alt="" /></a>&nbsp;
			{/if}
				<a href="index.php"><img src="{$image_dir}homepage_icon.gif" border="0" width="18" height="18" alt="" /></a>
			</td>
			<td height="33" width="10"></td>
		</tr>
		{if $config.menutype == 'top' && $smarty.session.UserId != ''}
		<tr>
			<td colspan=3>
				{include file="dropdownpanelmenu.tpl"}
			</td>
		</tr>
		{/if}
	</table>

	<div style="margin-top: 2px; vertical-align:top;">
		<div style="width: 178px; vertical-align:top;float:left;" align="left">
		<!-- Leftside Menu   -->
			{include file="leftcolumn.tpl"}
		</div>
		<div style="width:596px; vertical-align:top; float:left; padding-left: 5px;" align="left">
			 {$rendered_page}
			<br />
			{$modosdate_main}
			<br />
        </div>
		<div style="clear:both;"></div>
	</div>
	<div style="clear:both;"></div>
<!--  Footer   -->
	{include file="banner_mainpage.tpl"}
	<br /><br />
	{include file="footer.tpl"}
</div>
</center>
<script type="text/javascript">
	updateOnlineTime();
{if $smarty.session.UserId <= 0}
	updateOnlineCount();
{/if}
</script>
{closedb}
</body>
</html>
