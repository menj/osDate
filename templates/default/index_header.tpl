<?xml version="1.0" encoding="{lang mkey='ENCODING'}"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

{if $title != '' }
	<title>{$title} {if $page_title ne ""}- {$page_title}{/if}</title>
{elseif $config.site_title ne '' }
	<title>{$config.site_title|stripslashes} {if $page_title ne ""}- {$page_title}{/if}</title>
{else}
	<title>{lang mkey='title'} {if $page_title ne ""}- {$page_title}{/if}</title>
{/if}
<meta http-equiv="Content-Type" content="text/html; charset={lang mkey='ENCODING'}" />
<meta name="keywords" content="{$config.meta_keywords} {$title} {$page_title} " />
<meta name="description" content="{$title} {$page_title} {$config.meta_description} " />

<link href="{$css_path}default.css" rel="stylesheet" type="text/css" />
{$addtional_css}
<script type="text/javascript" src="{$DOC_ROOT}javascript/functions.js"></script>
<script type="text/javascript" src="{$DOC_ROOT}javascript/validate.js"></script>
<script type="text/javascript" src="{$DOC_ROOT}javascript/enlargeit.js"></script>
{if $config.enable_shoutbox == 'Y' or $config.enable_shoutbox == '1'}
	<script type="text/javascript" src="{$DOC_ROOT}javascript/shoutbox.js"></script>
{/if}
{$addtional_javascript}

<script type="text/javascript">
/* <![CDATA[ */

var loadingTag = "{lang mkey='loading'}";
var modeRewrite = "{$config.enable_mod_rewrite}";
var docRoot = "{$smarty.const.DOC_ROOT}";
var alphanumeric_chars = "{lang mkey='alphanumeric'}";
var alphanum_chars = "{lang mkey='alphanum'}";
var text_chars = "{lang mkey='text'}";
var full_chars = "{lang mkey='full_chars'}";

{if $config.use_popups == 'N'}
var use_popups = false;
{else}
var use_popups = true;
{/if}
{if $config.use_profilepopups == 'N'}
var use_profilepopups = false;
{else}
var use_profilepopups = true;
{/if}
var ajaxImSiteName = "{$config.site_title|stripslashes}";
var enl_darksteps=3;
var enl_gifpath="{$DOC_ROOT}javascript/images/";


/* ]]> */
</script>

<script type="text/javascript">
/* <![CDATA[ */
function insufficientPrivileges(){ldelim}
	alert("{lang mkey='insufficientPrivileges'}");
	return false;
{rdelim}

function newvalidateLogin(newform)
{ldelim}
	if (newform.txtusername.value == '') {ldelim}
		alert("{lang mkey='signup_js_errors' skey='username_noblank'}");
		return false;
	{rdelim}
	if (newform.txtpassword.value == '') {ldelim}
		alert("{lang mkey='signup_js_errors' skey='password_noblank'}");
		return false;
	{rdelim}
{rdelim}
function simplesearchZip(value) {ldelim}
       osDatehttp.open('get', 'simplesearchZip.php?a=' + value );
       document.getElementById('simplesearch_zip').innerHTML="";
       osDatehttp.onreadystatechange = osDatehandleResponse;
       osDatehttp.send(null);   
{rdelim}

/* ]]> */
</script>
</head>