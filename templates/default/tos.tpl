<?xml version="1.0" encoding="{lang mkey='ENCODING'}"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
{strip}
	{if $title != '' }
		<title>{$title}</title>
	{else}
		<title>{$config.site_title}</title>
	{/if}
	<link href="{$css_path}default.css" rel="stylesheet" type="text/css" />
	<meta http-equiv="Content-Type" content="text/html; charset={lang mkey='ENCODING'}" />
</head>
<body >

<div >
	{if $title != '' }
		{assign var="page_hdr01_text"  value=$title}
	{else}
		{assign var="page_hdr01_text"  value=$config.site_title}
	{/if}
	{assign var="page_title" value=$page_hdr01_text|cat:"&nbsp;- "|cat:$terms_of_use }
	{assign var="page_hdr01_text" value=$page_hdr01_text|cat:"&nbsp;- "|cat:$terms_of_use }
	{include file="page_hdr01.tpl"}
	<div class="module_detail_inside">
		<div class="line_outer">
			<div class="tos">
				<div class="line_outer" >
				{$terms}
				</div>
			</div>
			<div class="line_top_bottom_pad" align=center>
				<a href="javascript:window.close();">Close this window</a>
			</div>
		</div>
	</div>
</div>
</body>
</html>
{/strip}
