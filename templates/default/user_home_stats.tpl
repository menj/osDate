{strip}
<div style="vertical-align:top;">
	{if $smarty.get.errid == '26'  }
		{assign var="error_message" value="{lang mkey='errormsgs' skey='26'}" }
		{include file="display_error.tpl" }
	{elseif $smarty.session.expired == '1'}
		{assign var="error_message" value="{lang mkey='expired'}" }
		{include file="display_error.tpl" }
	{/if}
	{assign var="page_hdr01_text" value="{lang mkey='sincelastlogin_hdr'}"}
	{include file="page_hdr01.tpl"}
	{include file="user_home_stats_lines.tpl"}
</div>
{if $new_messages >= 1}
	<object data="Mail04.wav" type="audio/x-mplayer2" width="0" height="0">
	<param name="src" value="Mail04.wav">
	<param name="autoplay" value="true">
	<param name="autoStart" value="1">
	</object>
{/if}
<br />
{/strip}