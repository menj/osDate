<table border="0" cellpadding="0" cellspacing="0" width="100%">
	<tr>
		<td width="100%"  class="module_detail_inside">
			{assign var="page_hdr01_text" value=$lang.title}
			{include file="page_hdr01.tpl"}

			<br />
			<center>
			<table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr>
					<td class="" align="center" style="font-weight:bold">
						<a href="?plugin={$plugin_name}">{$lang.home}</a> - <a href="?plugin={$plugin_name}&amp;do=addfriend">{$lang.addfriend}</a> - <a href="?plugin={$plugin_name}&amp;do=myrequests">{$lang.request1} {if $nr1 != 0}({$nr1}){/if}</a> - <a href="?plugin={$plugin_name}&amp;do=othersrequests">{$lang.request2} {if $nr2 != 0}({$nr2}){/if}</a> - <a href="?plugin={$plugin_name}&amp;do=viewfriends">{$lang.viewfriends} {if $nr3 != 0}({$nr3}){/if}</a>
					</td>
				</tr>
			{if $error != 0}
				<tr>
					<td>
						{assign var="error_message" value=$lang.message[$error]}
						{include file="display_error.tpl"}
					</td>
				</tr>
			{/if}
			</table>
			</center>
			<br/>