<?xml version="1.0" encoding="{lang mkey='ENCODING'}"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
{if $title != '' }
<title>{$title|stripslashes} {$page_title}</title>
{else}
<title>{$config.site_title|stripslashes} {$page_title}</title>
{/if}

<script type="text/javascript">
/* <![CDATA[ */
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

var enl_darksteps=3;
var enl_gifpath="{$DOC_ROOT}javascript/images/";

/* ]]> */
</script>

<link href="{$css_path}default.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="{$DOC_ROOT}javascript/functions.js"></script>
<script type="text/javascript" src="{$DOC_ROOT}javascript/validate.js"></script>
<script type="text/javascript" src="{$DOC_ROOT}javascript/enlargeit.js"></script>

<meta http-equiv="Content-Type" content="text/html; charset={lang mkey='ENCODING'}" />

</head>
<body dir="{lang mkey='DIRECTION'}">
<center>
