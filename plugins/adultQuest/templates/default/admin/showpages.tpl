{assign var="page_hdr01_text" value=$lang.aq_title}
{include file="admin/admin_page_hdr01.tpl"}
<div class="module_detail_inside top_margin_6px" style="width:100%">
	{assign var="ct" value=$data|@count}
	{assign var="page_hdr02_text" value=$lang.total_pages|cat:'&nbsp;'|cat:$ct}
	{include file="admin/admin_page_hdr02.tpl"}
	<table cellspacing="{$config.cellspacing}" cellpadding="{$config.cellpadding}" width="100%">
	<tbody>
		<tr class="table_head">
			<th width="1%">{lang mkey='col_head_srno'}</th>
			<th width="93%" align="center">{lang mkey='col_head_name'}</th>
			<th width="6%" colspan="2" >{lang mkey='order'}</th>
		</tr>
		{assign var="mcount" value="0"}
	{foreach item=item key=key from=$data}
		{math equation="$mcount+1" assign="mcount"}
		<tr class="{cycle values="oddrow,evenrow"}">

			<td>{$mcount}</td>
			<td>{$lang.title[$item.pid]|stripslashes}</td>
		{if $mcount != 1 }
			<td align="center"><a href="plugin.php?plugin={$plugin}&amp;do=moveup&amp;page={$item.pid}"><img src="images/uparrow.JPG" alt="Move Up" border="0" /></a></td>
		{else}
			<td>&nbsp;</td>
		{/if}
		{if $mcount != $data|@count}
			<td align="center"><a href="plugin.php?plugin={$plugin}&amp;do=movedown&amp;page={$item.pid}"><img src="images/downarrow.JPG" alt="Move Down" border="0" /></a></td>
		{else}
			<td>&nbsp;</td>
		{/if}
		</tr>
	{/foreach}
		<tr><td colspan="5"><b>Note:</b> Questions and answers in the Adult Questionnaire are not editable in the admin interface. They may be changed in the language file that comes with this plugin.</td></tr>
	</tbody>
	</table>
</div>