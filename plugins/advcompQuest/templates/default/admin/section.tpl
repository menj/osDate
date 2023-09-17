<script type="text/javascript">
/* <![CDATA[ */
{literal}

function confirmDelete(sectionid,conmsg)
{
	if (confirm(conmsg)){
		document.frmDelSection.txtid.value=sectionid;
		document.frmDelSection.submit();
	}
}

{/literal}
/* ]]> */
</script>

<form name="frmDelSection" action="plugin.php?plugin={$plugin_name}&amp;do=delsection" method="post">
  <input type="hidden" name="txtid" value="" />
  <input type="hidden" name="delaction" value="Yes" />
  <input type="hidden" name="frm" value="frmDelSection" />
</form>

{assign var="page_hdr01_text" value=$lang.questionnaire_title_management}
{include file="admin/admin_page_hdr01.tpl"}
<div class="module_detail_inside top_margin_6px" style="width:100%">
			{assign var="ct" value=$data|@count}
			{assign var="page_hdr02_text" value=$lang.total_sections|cat:'&nbsp;'|cat:$ct}
			{include file="admin/admin_page_hdr02.tpl"}

			<form action='plugin.php?plugin={$plugin_name}&amp;do=addsection&amp;add=1' method=post>
			<table cellspacing="{$config.cellspacing}" cellpadding="{$config.cellpadding}" width="100%">
				<tbody>
    			<tr class="table_head">
	  				<th width="1%">{lang mkey='col_head_srno'}</th>
	  				<th width="64%" align="center">{lang mkey='col_head_name'}</th>
	  				<th width="6%" colspan="2" >{lang mkey='order'}</th>
	  				<th width="20%">{$lang.add_question}</th>
	  				<th colspan="2"  width="9%">{lang mkey='action'}</th>
				</tr>
				{assign var="mcount" value="0"}
			{foreach item=item key=key from=$data}
				{math equation="$mcount+1" assign="mcount"}
				<tr class="{cycle values="oddrow,evenrow"}">

		  			<td>{$mcount}</td>
		  			<td><a href="plugin.php?plugin={$plugin_name}&amp;do=showquestions&amp;section={$item.sid}">{$item.title|stripslashes}</a></td>
		  		{if $mcount != 1 }
			  		<td><a href="plugin.php?plugin={$plugin_name}&amp;do=moveup&amp;section={$item.sid}"><img src="images/uparrow.JPG" alt="Move Up" border="0" /></a></td>
		  		{else}
					<td>&nbsp;</td>
		  		{/if}
		  		{if $mcount != $data|@count}
			  		<td><a href="plugin.php?plugin={$plugin_name}&amp;do=movedown&amp;section={$item.sid}"><img src="images/downarrow.JPG" alt="Move Down" border="0" /></a></td>
		  		{else}
					<td>&nbsp;</td>
		  		{/if}
		  			<td><a href="plugin.php?plugin={$plugin_name}&amp;do=addquestion&amp;section={$item.sid}">{$lang.add_question}</a></td>
		  			<td><a href="plugin.php?plugin={$plugin_name}&amp;do=editsection&amp;section={$item.sid}"><img src="images/button_edit.png" alt="Edit" border="0" /></a></td>
		  			<td><a href="#" onclick="confirmDelete({$item.sid},'{lang mkey='admin_js__delete_error_msgs' skey=1}')"><img src="images/button_drop.png" alt="Delete" border="0" /></a></td>
				</tr>
			{/foreach}
				<tr>

					<td colspan="1">&nbsp;</td>
					<td align="right"><b>{$lang.add_section}:</b> <input type="text" name="title" size=40 maxlength="255" /></td>
					<td></td>
					<td></td>
					<td colspan="5">
						<input type="submit" class="formbutton" name="btnAdd" value="{lang mkey='submit'}"/>
					</td>

				</tr>
				</tbody>
			</table>
			</form>
</div>