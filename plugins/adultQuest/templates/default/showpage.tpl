<table border="0" cellpadding="0" cellspacing="0" width="100%">
	<tr>
		<td width="100%"  class="module_detail_inside">
<table width="100%" border="0" cellpadding="0" cellspacing="0" >
	<tr>
		<td class="module_head" style="padding-top:4px;padding-bottom:4px;padding-left:4px;" ><a id="p{$pid}">{$lang.title.$pid}</a></td>
		<td class="module_head" style="padding-top:4px;padding-bottom:4px;padding-left:4px;padding-right:5px" align="right"><a href="?plugin={$plugin}&amp;showpage={$pid}">{$lang.edit}</a></td>
	</tr>
</table>
<div style="padding-left:3px;padding-top:4px">
{assign var="k" value="0"}
{foreach item=item key=key from=$ans}
{math equation="$k+1" assign="k"}
<b>{$lang[$item.page].$k}</b><br/>
<div style="padding-left:10px">{$item.answer}</div><br/>
{/foreach}
</div>
	</td>
</tr>
<tr><td height="6"></td></tr>
</table>