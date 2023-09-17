<script type="text/javascript">
/* <![CDATA[ */
{literal}

function confirmDelete(sectionid,conmsg)
{
/*  frmDelSection = document.getElementsByName ("frmDelSection").namedItem ("frmDelSection"); */
	if (confirm(conmsg)){
		document.frmDelSection.txtid.value=sectionid;
		document.frmDelSection.submit();
	}
}

{/literal}
/* ]]> */
</script>

<form name="frmDelSection" action="plugin.php?plugin={$plugin_name}&amp;do=delquestion" method="post">
  <input type="hidden" name="txtid" value="" />
  <input type="hidden" name="delaction" value="Yes" />
  <input type="hidden" name="frm" value="frmDelSection" />
</form>
{assign var="page_hdr01_text" value='<a href="plugin.php?plugin='|cat:$plugin_name|cat:'" class="subhead">'|cat:$lang.questionnaire_title_management|cat:'</a> > '|cat:$lang.show_questions}
{include file="admin/admin_page_hdr01.tpl"}
<div class="module_detail_inside top_margin_6px" style="width:100%">
	{assign var="ct" value=$data|@count}
	{assign var="page_hdr02_text" value=$lang.total_questions|cat:' '|cat:$ct}
	{include file="admin/admin_page_hdr02.tpl"}
	<table cellspacing="{$config.cellspacing}" cellpadding="{$config.cellpadding}" width="100%">
	<tbody>
		<tr class="table_head">
			<th width="1%">{lang mkey='col_head_srno'}</th>
			<th width="84%" align="center">{$lang.question}</th>
			<th width="6%" colspan="2" >{lang mkey='order'}</th>
			<th colspan="2"  width="10%" align="center">{lang mkey='action'}</th>
		</tr>
		{assign var="mcount" value="0"}
	{foreach item=item key=key from=$data}
		{math equation="$mcount+1" assign="mcount"}
		<tr class="{cycle values="oddrow,evenrow"}">

			<td>{$mcount}</td>
			<td>{$item.question|stripslashes}</td>
		{if $mcount != 1 }
			<td><a href="plugin.php?plugin={$plugin_name}&amp;do=movequp&amp;qid={$item.qid}"><img src="images/uparrow.JPG" alt="Move Up" border="0" /></a></td>
		{else}
			<td>&nbsp;</td>
		{/if}
		{if $mcount != $data|@count}
			<td><a href="plugin.php?plugin={$plugin_name}&amp;do=moveqdown&amp;qid={$item.qid}"><img src="images/downarrow.JPG" alt="Move Down" border="0" /></a></td>
		{else}
			<td>&nbsp;</td>
		{/if}
			<td align="center"><a href="plugin.php?plugin={$plugin_name}&amp;do=editquestion&amp;qid={$item.qid}"><img src="images/button_edit.png" alt="Edit" border="0" /></a></td>
			<td align="center"><a href="#" onclick="confirmDelete({$item.qid},'{lang mkey='admin_js__delete_error_msgs' skey=1}')"><img src="images/button_drop.png" alt="Delete" border="0" /></a></td>
		</tr>
	{/foreach}

		<tr>
			<td colspan="5" align="center">
			<a href="plugin.php?plugin={$plugin_name}&amp;do=addquestion&amp;section={$sid}">{$lang.add_question}</a>
			</td>
		</tr>
	</tbody>
	</table>
</div>