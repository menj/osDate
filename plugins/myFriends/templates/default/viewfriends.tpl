{if $data == 1}
{if $you == 1}
&nbsp;&nbsp;{$lang.nofriends1}
{else}
&nbsp;{$user} {$lang.nofriends2} {$user}? <br /><br /><a href="?plugin={$plugin_name}&amp;do=addfriend&amp;name={$user}">{$lang.clickhere}</a> {$lang.nofriends3}
{/if}
{else}
<table border="0" width="100%">
{foreach item=item key=key from=$data}
{assign var="mcount" value="0"}
<tr>
	{foreach item=item2 key=key2 from=$col}
<td width="{$item2}%" align="center">{if $item.$mcount.user != ""}
{if $config.enable_mod_rewrite == 'Y'}<a href="javascript:popUpScrollWindow2('{$docroot}{if $config.seo_username == 'Y'}{$item.$mcount.user}{else}{$item.$mcount.friend}.htm{/if}','top',650,600)">{else}<a href="javascript:popUpScrollWindow2('{$docroot}showprofile.php?{if $config.seo_username == 'Y'}username={$item.$mcount.user}{else}id={$item.$mcount.friend}{/if}','top',650,600)">{/if}{$item.$mcount.user}</a><br/>
{if $config.enable_mod_rewrite == 'Y'}<a href="javascript:popUpScrollWindow2('{$docroot}{if $config.seo_username == 'Y'}{$item.$mcount.user}{else}{$item.$mcount.friend}.htm{/if}','top',650,600)">{else}<a href="javascript:popUpScrollWindow2('{$docroot}showprofile.php?{if $config.seo_username == 'Y'}username={$item.$mcount.user}{else}id={$item.$mcount.friend}{/if}','top',650,600)">{/if}<img src="getsnap.php?id={$item.$mcount.pic}&amp;typ=tn" alt="" border="0" /></a><br/>{* <a href="?plugin={$plugin_name}&amp;do=viewfriends&amp;id={$item.$mcount.friend}">{$lang.viewfriends2}</a><br/>*} <a href="?plugin={$plugin_name}&amp;do=removefriend&amp;id={$item.$mcount.friend}">Remove Friend</a><br/><br/></td>{/if}
	{math equation="$mcount+1" assign="mcount"}
	{/foreach}
</tr>
{/foreach}
</table>
<br/><br/>
<center>
{if $previous != -1}<a href="?plugin={$plugin_name}&amp;do=viewfriends&amp;page={$previous}">{$lang.previous}</a>{/if}{if $previous != -1} {if $next != 0}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{/if}{/if} {if $next != 0}<a href="?plugin={$plugin_name}&amp;do=viewfriends&amp;page={$next}">{$lang.next}</a>{/if}
</center>
{/if}
<br/>