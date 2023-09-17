{include file="index_header.tpl"}
{strip}
<body dir="{lang mkey='DIRECTION'}" {if $google_map eq 'Y'}onload="load_map()"{/if}>
<center>
<!-- Header portion  -->
{if $browsername == 'msie' && browserversion < 7 }
	<div class="main_outer_table" style="width:810px;" >
{else}
	<div class="main_outer_table" style="width:779px;" >
{/if}
	<table width="100%" border="0" cellpadding="0" cellspacing="0" class="headbg">
		<tr>
		{ if $config.site_logo != ''}
			<td colspan="2" width="544" valign="bottom">
				<img src="{$config.site_logo}" alt="" />
			</td>
		{else}
			<td width="244" valign="bottom" >
			  &nbsp;<a href="index.php" class="main_title">{$config.site_name|stripslashes}</a>
			</td>
			<td width="300" valign="bottom" align="center">

				<table width="191" border="0" cellpadding="0" cellspacing="0" >
					<tr>
						<td width="64" height="52">
							<img src="{$image_dir}pic_09.jpg" {*width="64" height="52"*} alt="" /></td>
						<td width="63" height="52">
							<img src="{$image_dir}pic_10.jpg" {*width="63" height="52"*} alt="" /></td>
						<td width="64" height="52">
							<img src="{$image_dir}pic_11.jpg" {*width="64" height="52"*} alt="" /></td>
					</tr>
					<tr>
						<td height="52" width="64">
							<img src="{$image_dir}pic_13.jpg" {*width="64" height="52"*} alt="" /></td>
						<td height="52" width="63">
							<img src="{$image_dir}pic_14.jpg" {*width="63" height="52"*} alt="" /></td>
						<td height="52" width="64">
						  <img src="{$image_dir}pic_15.jpg" {*width="64" height="52"*} alt="" /></td>
					</tr>
					<tr>
						<td height="52" width="64">
							<img src="{$image_dir}pic_16.jpg" {*width="64" height="52"*} alt="" /></td>
						<td height="52" width="63">
							<img src="{$image_dir}pic_17.jpg" {*width="63" height="52"*} alt="" /></td>
						<td height="52" width="64">
						  <img src="{$image_dir}pic_18.jpg" {*width="64" height="52"*} alt="" /></td>
					</tr>
				</table>
			</td>
		{/if}
			<td width="235" valign="bottom">
				<table width="235" border="0" cellpadding="0" cellspacing="0" >
					<tr>
						<td height="21" width="17">
							<img src="{$image_dir}box_02.jpg" {*width="17" height="21"*} alt="" /></td>
						<td height="21" width="202">
							<img src="{$image_dir}box_03.jpg" {*width="202" height="21"*} alt="" /></td>
						<td height="21" width="16">
						  <img src="{$image_dir}box_04.jpg" {*width="16" height="21"*} alt="" /></td>
					</tr>
					<tr>
						<td style="background-image: url({$image_dir}box_05.jpg); background-repeat:repeat-y;"></td>
						<td align="center" class="headbgbox">
							{include file="searchprofile.tpl"}
						</td>
						<td style="background-image: url({$image_dir}box_07.jpg);background-repeat:repeat-y;"></td>
					</tr>
					<tr>
						<td height="28" width="17">
							<img src="{$image_dir}box_19.jpg" {*width="17" height="28"*} alt="" /></td>
						<td height="28" width="202">
							<img src="{$image_dir}box_20.jpg" {*width="202" height="28"*} alt="" /></td>
						<td height="28" width="16">
						  <img src="{$image_dir}box_21.jpg" {*width="16" height="28"*} alt="" /></td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
	<table width="100%" border="0" cellpadding="0" cellspacing="0"  class="loginbarbg">
		<tr>
			<td height="33" width="154"><img src="{$image_dir}top_blue.jpg" alt="" /></td>
			<td height="33" width="575" class="hdr_login_text">
				{if $smarty.session.UserId == ''}
				<form name="frmLogin" method="post" action="midlogin.php" onsubmit="javascript: return newvalidateLogin(this);" >
					<b>{lang mkey='members_login'}</b>&nbsp;
					<img src="{$image_dir}blue_box.gif"  alt="" />&nbsp;
					{lang mkey='signup_username'}&nbsp;
					<input class="textinput" maxlength="25" name="txtusername" size="8" style='font-size:9pt;width:70px' />&nbsp;&nbsp;
					{lang mkey='signup_password'}&nbsp;
					<input class="textinput" type="password"  name="txtpassword" size="8" style='font-size:9pt;width:70px' />&nbsp;
					<input type="submit" value="{lang mkey='login_submit'}" class='formbutton' />&nbsp;
					<a href='signup.php'>{lang mkey='register'}</a>
				</form>
				{else}
					<strong>{lang mkey='welcome'},&nbsp;{$smarty.session.FullName|stripslashes} &nbsp;({$smarty.session.UserName})</strong>
				{/if}
			</td>
			<td height="33" width="40" align="right" valign="middle">{if $smarty.session.security.extsearch == 1  and $smarty.session.expired != '1' and ( $smarty.session.status == $lang.status_enum.active or $smarty.session.status == 'Active') }
			<a href="advsearch.php?search_new=1"><img src="{$image_dir}search_icon.gif" border="0" width="18" height="18" alt="" /></a>&nbsp;
			{/if}
			  <a href="index.php"><img src="{$image_dir}homepage_icon.gif" border="0" width="18" height="18" alt="" /></a>
			</td>
			<td height="33" width="10"></td>
		</tr>
		{if $config.menutype == 'top' && $smarty.session.UserId != ''}
		<tr>
			<td colspan="3">
				{include file="dropdownpanelmenu.tpl"}
			</td>
		</tr>
		{/if}
	</table>
	<div style="margin-top: 2px; width:100%;">
		<div style="width: 179px; vertical-align:top;display:inline; float:left;" align="left">
		<!-- Leftside Menu   -->
			{include file="leftcolumn.tpl"}
		</div>
<!-- Rendered page -->
		<div style="width:594px; vertical-align:top; display:inline; float:left; padding-left:5px;" align="left">
			{$rendered_page}
			<br />
			{$modosdate_main}
			<br />
        </div>
		<br /><br />
		{include file="banner_mainpage.tpl"}
		<br />
		<div style="clear:both;"></div>
	</div>
<!--  Footer   -->
	<div style="clear:both; text-align:center; width:100%;">
		{include file="footer.tpl"}
	</div>
</div>
</center>
<script type="text/javascript">
	updateOnlineTime();
{if $smarty.session.UserId <= 0}
	updateOnlineCount();
{/if}
</script>
</body>
</html>
{closedb}
{/strip}