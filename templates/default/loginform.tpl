<form name="frmLogin" method="post" action="midlogin.php" onsubmit="javascript: return validateLogin(this);" >
<div nowrap>
	<b>{lang mkey='members_login'}</b>&nbsp;&nbsp;
	<img src="{$image_dir}blue_box.gif" width="2" height="10" alt="" />&nbsp;&nbsp;{lang mkey='signup_username'}&nbsp;&nbsp;&nbsp;
	<input class="textinput" maxlength="25" name="txtusername" size="8" style='font-size:9pt;width:70px'/>&nbsp;&nbsp;&nbsp;{lang mkey='signup_password'}&nbsp;&nbsp;<input class="textinput" type="password"  name="txtpassword" size="8" style='font-size:9pt;width:70px'/>&nbsp;<input type="submit" value="{lang mkey='login_submit'}" class='formbutton'/>&nbsp;&nbsp;<a href='signup.php'>{lang mkey='register'}</a>
</div>
</form>
