<?xml version="1.0" encoding="{lang mkey='ENCODING'}"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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

	<link href="{$css_path}default.css" rel="stylesheet" type="text/css" />
	{$addtional_css}

	<script type="text/javascript" src="{$DOC_ROOT}javascript/functions.js"></script>
	<script type="text/javascript" src="{$DOC_ROOT}javascript/validate.js"></script>
	<script type="text/javascript" src="{$DOC_ROOT}javascript/enlargeit.js"></script>

	<script type="text/javascript">
	/* <![CDATA[ */
	var loadingTag = "{lang mkey='loading'}";
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
	{if $smarty.session.AdminId > 0}
		var use_profilepopups = true;
		var use_popups = true;
	{/if}
	var alphanumeric_chars = "{lang mkey='alphanumeric'}";
	var alphanum_chars = "{lang mkey='alphanum'}";
	var text_chars = "{lang mkey='text'}";
	var full_chars = "{lang mkey='full_chars'}";
	var osDatehttp = createRequestObject();
	var enl_darksteps=3;
	var enl_gifpath="{$DOC_ROOT}javascript/images/";
	/* ]]> */
	</script>
	{$addtional_javascript}

</head>
