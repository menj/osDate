<table border="0" cellpadding="0" cellspacing="0" width="100%">
	<tr>
		<td width="100%"  class="module_detail_inside">
			{assign var="page_hdr01_text" value=$lang.questionnaire_title}
			{include file="page_hdr01.tpl"}
			<table><tr><td>
			{if $ok==0}
				{assign var="error_message" value=$lang.error}
				{include file="display_error.tpl"}
			{/if}
			{if $error == 3}
				{assign var="error_message" value=$lang.error3|cat:" "|cat:$smarty.get.lookuser|cat:" "|cat:$lang.error4}
				{include file="display_error.tpl"}
				{/if}
			</td></tr>
			</table>
<div style="padding-left:4px">
	{if $ok!=2}
		<br/>
		<form action="plugin.php" method="get"><input type="hidden" name="plugin" value="{$plugin_name}" />{$lang.showuser} <input type="text" name="lookuser" size="10" /> <input type="submit" value="{$lang.view}" class="formbutton" /></form>
		<br/>
		{if $ou == 1}{$lang.viewuser} <b>{$lookuser}</b>. <a href="javascript:popUpScrollWindow2('{$docroot}showprofile.php?id={$lookid}')">{$lang.clickhere2} {$lookuser}</a>
		<br/><br/>
		<center>
		<table width="99%" cellspacing="{$config.cellspacing}" cellpadding="{$config.cellpadding}" >
			<tr class="evenrow">
				<td>
					<div style="padding:4px">
						<b>
						You are a perfect match for <span class="errors">{$proc1}%</span> of the options in this section.<br/>
						You are an approximate match for <span class="errors">{$proc2}%</span> of the options in this section.<br/>
						Across all questionnaire sections you are a perfect match for <span class="errors">{$proc3}%</span> of the options.<br/>
						Across all questionnaire sections you are an approximate match for <span class="errors">{$proc4}%</span> of the options.<br/>
						</b>
					</div>
				</td>
			</tr>
		</table>
		</center>
		<br/>
		{/if}
		<table width="100%">
			<tr>
				<td valign="top">{$lang.jtp}</td>
				<td align="center">
					{foreach item=item key=key from=$pages}
						{if $section != $item.ord}<a href=plugin.php?plugin={$plugin_name}&amp;spage={$item.ord}&amp;lookuser={$lookuser}>{/if}{$item.ord}{if $section != $item.ord}</a>{/if}&nbsp;
					{/foreach}
					<br/>
					{if $prev != 0}<a href=plugin.php?plugin={$plugin_name}&amp;spage={$prev}&amp;lookuser={$lookuser}>{$lang.prev}</a>{/if}&nbsp;&nbsp;{if $next != 0}<a href=plugin.php?plugin={$plugin_name}&amp;spage={$next}&amp;lookuser={$lookuser}>{$lang.next}</a>{/if}
				</td>
			</tr>
		</table>
		<br/>
		<h3>{$title}</h3>
		<br/>
		{if $ou == 0}
			<form action="plugin.php?plugin={$plugin_name}" method="post">
			<input type="hidden" name=section value={$section} />
			<input type="hidden" name=sid value={$sid} />
		{/if}
	{/if}