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
	<table border="0" cellspacing="2">
		<tr>
			<td>
				<form action="plugin.php" method="get">
					<input type="hidden" name="plugin" value="{$plugin_name}" />{$lang.showuser} <input type="text" name="lookuser" value="{$lookuser}" size="10" /> <input type="submit" value="{$lang.view}" class="formbutton" />
				</form>
			</td>
			<td >&nbsp;&nbsp;	<a href="plugin.php?plugin={$plugin_name}&amp;matchusers=1">{$lang.showmatchusers}</a>
			</td>
		</tr>
	</table>
	<br/>
	{if $ok != '2'}
	{if $lookuser != ''}
	<div style="margin-top:6px; margin-bottom:6px; padding-left:6px;">
		{$lang.viewuser} <b>{$lookuser}</b>. <a href="javascript:popUpScrollWindow2('{$docroot}showprofile.php?id={$lookid}')">{$lang.clickhere2} {$lookuser}</a>
		<br/><br/>
		<b>{$lang.tothdr01|replace:'#TOTCNT#':$total_mycount|replace:'#SECCNT#':$sectcount}</b><br /><br />
		{$lang.tothdr02|replace:'#LOOKUSER#':$lookuser|replace:'#USERCNT#':$total_uanscnt}<br />
		{$lang.tothdr03|replace:'#LOOKUSER#':$lookuser|replace:'#MTCHCNT#':$total_matchcnt|replace:'#MTCHPCT#':$total_matchpct}<br />
		{$lang.tothdr04|replace:'#LOOKUSER#':$lookuser|replace:'#PFTMTCHCNT#':$total_perfect_matchcnt|replace:'#PFTMTCHPCT#':$total_perfect_matchpct}<br />
	</div>
	{/if}
	<table width="100%" border="0" cellspacing="1" cellpadding="1">
		{var cnt="0"}
		{foreach item=item key=key from=$allsections}
		{if $cnt=="0"}
			<tr>
		{/if}
			<td align="center" class="edituserlink" height="30">
				{if $section != $item.ord}<a href="plugin.php?plugin={$plugin_name}&amp;spage={$item.ord}&amp;lookuser={$lookuser}">{/if}{$item.title}{if $section != $item.ord}</a>{/if}&nbsp;
			</td>
			{assign var="cnt" value=$cnt+1 }
		{if $cnt  > "4"}
			</tr>
			{var cnt="0"}
		{/if}
		{/foreach}
		{if $cnt > 0 && $cnt < 4}
			</tr>
		{/if}
	</table>
	<br/>
	<div class="module_head" style="height:20px; text-align:center; vertical-align:middle;">
		<h3>{$title}</h3>
	</div>
	{if $lookuser != ''}
	<div style="margin-top:6px; margin-bottom:6px; padding-left:6px;">
		{$lang.secthdr01|replace:'#TOTCNT#':$sect_mycount}<br />
		{$lang.secthdr02|replace:'#LOOKUSER#':$lookuser|replace:'#USERCNT#':$sect_uanscnt}<br />
		{$lang.secthdr03|replace:'#LOOKUSER#':$lookuser|replace:'#MTCHCNT#':$sect_matchcnt|replace:'#MTCHPCT#':$sect_matchpct}<br />
		{$lang.secthdr04|replace:'#LOOKUSER#':$lookuser|replace:'#PFTMTCHCNT#':$sect_perfect_matchcnt|replace:'#PFTMTCHPCT#':$sect_perfect_matchpct}<br />
	</div>
	{/if}
	<br/>
	<table width="100%" border="0" cellspacing="1" cellpadding="1">
		{var cnt="0"}
		{foreach item=quest key=k from=$allquestions}
		{if $cnt=="0"}
			<tr>
		{/if}
			<td align="center" class="edituserlink" height="23">
				{if $question != $quest.qid}<a href="plugin.php?plugin={$plugin_name}&amp;spage={$section}&amp;lookuser={$lookuser}&amp;qid={$quest.qid}">{/if}{$quest.question}{if $question != $quest.qid}</a>{/if}&nbsp;
			</td>
			{assign var="cnt" value=$cnt+1 }
		{if $cnt  > "4"}
			</tr>
			{var cnt="0"}
		{/if}
		{/foreach}
		{if $cnt > 0 && $cnt < 4}
			</tr>
		{/if}
	</table>
	<br/>
	{if $ou == 0}
		<form action="plugin.php?plugin={$plugin_name}" method="post">
		<input type="hidden" name="section" value="{$section}" />
		<input type="hidden" name="sid" value="{$sid}" />
		<input type="hidden" name="qid" value="{$question}" />
	{/if}
	{/if}