{include file="index_header.tpl"}
<body dir="{lang mkey='DIRECTION'}" {if $google_map eq 'Y'}onload="load_map()"{/if}>
<center>
<!-- Header portion  -->
<div class="main_outer_table" style="width:1024px;" >
	<div class="headbg">
		{ if $config.site_logo != ''}
			<div style="width:786px; vertical-align:bottom; float:left;">
				<img src="{$config.site_logo}" alt="" />
			</div>
		{else}
			<div style="width:344px;vertical-align:bottom; float:left; height:100%" >
			  &nbsp;<a href="index.php" class="main_title">{$config.site_name|stripslashes}</a>
			</div>
			<div  style="width:442px; text-align:center; float:left; height:100%;">
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
			</div>
		{/if}
			<div style="width:235px;vertical-align:bottom; float:left; height:100%;" class="headbgbox">
				<table width="100%" border="0" cellpadding="0" cellspacing="0" >
					<tr>
						<td  width="17" class="headbgbox" valign="top" >
							<img src="{$image_dir}box_02.jpg" width="17" height="23" alt="" /></td>
						<td width="202" class="headbgbox" valign="top">
						  <img src="{$image_dir}box_03.jpg" width="202" height="23" alt="" /></td>
						<td width="16" class="headbgbox" valign="top">
						  <img src="{$image_dir}box_04.jpg" width="16" height="23" alt="" /></td>
					</tr>
					<tr >
						<td style="background-image: url({$image_dir}box_05.jpg); background-repeat:repeat-y;" height="100%"></td>
						<td align="center" class="headbgbox" valign="top" height="100%" >
							{include file="searchprofile.tpl"}
						</td>
						<td style="background-image: url({$image_dir}box_07.jpg); background-repeat: repeat-y;" height="100%"></td>
					</tr>
					<tr>
						<td height="28" width="17" valign="top">
							<img src="{$image_dir}box_19.jpg" width="17" height="28" alt="" /></td>
						<td height="28" width="202" valign="top">
						  <img src="{$image_dir}box_20.jpg" width="202" height="28" alt="" /></td>
						<td height="28" width="16" valign="top">
						  <img src="{$image_dir}box_21.jpg" width="16" height="28" alt="" /></td>
					</tr>
				</table>
			</div>
		<div style="clear:both;"></div>
	</div>
	<div style="clear:both;"  class="loginbarbg">
			<div style="height:33px; width:154px;float:left;"><img src="{$image_dir}top_blue.jpg" alt="" /></div>
			<div style="height:33px;width:805px; float:left;">
				{if $smarty.session.UserId == ''}
				<form name="frmLogin" method="post" action="midlogin.php" onsubmit="javascript: return newvalidateLogin(this);" >
					<table width="100%" cellpadding="{$config.cellpadding}" cellspacing="{$config.cellspacing}" border="0">
						<tr>
							<td  height="10" style="padding-top:5px;">
								<b>{lang mkey='members_login'}</b>&nbsp;
								<img src="{$image_dir}blue_box.gif"  alt="" />&nbsp;
								{lang mkey='signup_username'}&nbsp;
								<input class="textinput" maxlength="25" name="txtusername" size="8" style='font-size:9pt;width:70px' />&nbsp;&nbsp;
								{lang mkey='signup_password'}&nbsp;
								<input class="textinput" type="password" name="txtpassword" size="8" style='font-size:9pt;width:70px' />&nbsp;
								<input type="submit" value="{lang mkey='login_submit'}" class='formbutton' />&nbsp;
								<a href='signup.php'>{lang mkey='register'}</a>
							</td>
						</tr>
					</table>
				</form>
				{else}
					<div style="padding-top:6px; padding-left:10px; text-align:left;">
						<strong>{lang mkey='welcome'},&nbsp;{$smarty.session.FullName|stripslashes} &nbsp;({$smarty.session.UserName})</strong>
					</div>
				{/if}
			</div>
			<div style="height:28px;width:40px; text-align:right; vertical-align:bottom; float:right; margin-right:10px; padding-top:5px;">{if $smarty.session.security.extsearch == 1  and $smarty.session.expired != '1' and ( $smarty.session.status == $lang.status_enum.active or $smarty.session.status == 'Active') }
			<a href="advsearch.php?search_new=1"><img src="{$image_dir}search_icon.gif" border="0" width="18" height="18" alt="" /></a>&nbsp;
			{/if}
			  <a href="index.php"><img src="{$image_dir}homepage_icon.gif" border="0" width="18" height="18" alt="" /></a>
			</div>
			<div style="clear:both;"></div>
		{if $config.menutype == 'top' && $smarty.session.UserId != ''}
		<div style="width:100%; ">
			{include file="dropdownpanelmenu.tpl"}
		</div>
		{/if}
	</div>
	<div style="margin-top: 2px;">
		<div style="width: 200px; vertical-align:top;display:inline; float:left;" align="left">
		<!-- Leftside Menu   -->
			{include file="leftcolumn.tpl"}
		</div>
<!-- Rendered page -->
		<div style="width:608px; vertical-align:top; display:inline; float:left; padding-left: 4px;" align="left">
			{$rendered_page}
			<br />
			{$modosdate_main}
			<br />
        </div>
		<div style="width: 200px; vertical-align:top;display:inline; float:left; padding-left:4px;" align="left">
			{include file="rightcolumn.tpl"}
		</div>
		<div style="clear:both;"></div>
		<br /><br />
		{include file="banner_mainpage.tpl"}
		<br />
	</div>
<!--  Footer   -->
	<div style="clear:both; text-align:center;">
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
