<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>{$lang.sharephoto3}</title>
<link href="{$css_path}default.css" rel="stylesheet" type="text/css" />
</head>
<body>
<center>
<form method=post action="pluginraw.php?plugin={$plugin_name}&amp;sharephoto=1&amp;imageid={$imageid}">
<table class="module_detail_inside" cellspacing=0 cellpadding=4><tr valign=top><td ><table cellspacing=0 cellpadding=2><tr><td align=center><img alt="" src="getsnap.php?id={$imageid}&amp;typ=tn" border="0" /></td></tr><tr><td></br></br></td></tr><tr><td align=center>&nbsp;<p>&nbsp;</p>
            <p>{if $sent != 1}<a href=# onclick="javascript:window.close()"><font size=2>{$lang.closewindow}</font></a>{/if}</p>
          </td></tr></table></td><td >
          <table cellspacing=0 cellpadding=2>
{if $sent == 1}
<center>
<br/><br/>
	{assign var="error_message" value=$lang.sharephotosent}
	{include file="display_error.tpl"}
<br/><br/>
<a href="pluginraw.php?plugin={$plugin_name}&amp;sharephoto=1&amp;imageid={$imageid}">{$lang.clickhereshare}</a>
<br/><br/>
<a href=# onclick="javascript:window.close()"><font size=2>{$lang.closewindow}</font></a>
</center>
{else}
<tr ><td colspan="2" align=center>{$lang.sharephoto2}</td></tr><tr><td align=center>
<tr><td><div>{$lang.emailto|replace:"#pronoum#":$lang.desc2[$gender]}</div></td><td align="right"><input type=text name="recipient1" size=30 maxlength=50 /></td><td ></td></tr>
<tr><td><div>{$lang.optional}</div></td><td align="right"><input type=text name="recipient2" size=30 maxlength=50 /></td><td ></td></tr>
<tr><td><div>{$lang.optional}</div></td><td align="right"><input type=text name="recipient3" size=30 maxlength=50 /></td><td ></td></tr>
<tr><td><div>{$lang.optional}</div></td><td align="right"><input type=text name="recipient4" size=30 maxlength=50 /></td><td ></td></tr>
<tr><td><div>{$lang.optional}</div></td><td align="right"><input type=text name="recipient5" size=30 maxlength=50 /></td><td ></td></tr>
<tr><td><div>{$lang.note}</div></td><td class="col1"><textarea name="note" rows=3 cols=25>{$lang.checkout|replace:"#pronoum#":$lang.desc2[$gender] }</textarea></td><td ></td></tr>
<tr><td></td><td><input type=submit class="formbutton" name="send" value="{$lang.send}" /></td><td ></td></tr>
</table>{/if}</td></tr>
</table>
</form>
</center>
</body>
</html>