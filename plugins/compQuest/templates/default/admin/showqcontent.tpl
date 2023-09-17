<script type="text/javascript">
/* <![CDATA[ */
{literal}

function confirmDelete(sectionid,conmsg)
{
	if (confirm(conmsg)){
		document.frmDelSection.delete.value=sectionid;
		document.frmDelSection.submit();
	}
}

{/literal}
/* ]]> */
</script>

<form name="frmDelSection" action="plugin.php?plugin={$plugin_name}&amp;do=editquestion&amp;qid={$qid}" method="post">
  <input type="hidden" name="delete" value="" />
  <input type="hidden" name="delaction" value="Yes" />
  <input type="hidden" name="frm" value="frmDelSection" />
</form>

{assign var="page_hdr01_text" value='<a href="plugin.php?plugin='|cat:$plugin_name|cat:'" class="subhead">'|cat:$lang.questionnaire_title_management|cat:'</a> > <a href="plugin.php?plugin='|cat:$plugin_name|cat:'&amp;do=showquestions&amp;section='|cat:$sid|cat:'" class="subhead">'|cat:$lang.show_questions|cat:'</a> > '|cat:$lang.edit_question}
{include file="admin/admin_page_hdr01.tpl"}

<div class="module_detail_inside top_margin_6px" style="width:100%">
	{assign var="ct" value=$data|@count}
	{assign var="page_hdr02_text" value=$lang.total_content|cat:' '|cat:$ct}
	{include file="admin/admin_page_hdr02.tpl"}
	<form action="plugin.php?plugin={$plugin_name}&amp;do=editquestion&amp;qid={$qid}" method="post">
	<table cellspacing="{$config.cellspacing}" cellpadding="{$config.cellpadding}" width="100%">
		<tbody>
		<tr>
			<td colspan="5">
			{if $error==1}
				{assign var="error_message" value=$lang.error2}
				{include file="display_error.tpl"}
				<br/>
			{/if}
				Question<font color="{lang mkey='required_info_indicator_color'}">{lang mkey='required_info_indicator'}</font>: <textarea cols="75" rows="3" name="question">{$question}</textarea><br/>
				Type: {$lang.$type}<br/>
				{if $type=='questiontype2'}Min Options: <input type="text" size="5" name="minopt" value="{$minopt}"/><br/>{/if}
				Max Options<font color="{lang mkey='required_info_indicator_color'}">{lang mkey='required_info_indicator'}</font>: <input type="text" size="5" name="maxopt" value="{$maxopt}"/> {$lang.maxopt_two}<br/>
				{if $type=='questiontype2'}Show Options: <input type="text" size="5" name="showopt" value="{$showopt}"/><br/>{/if}
			</td>
		</tr>

		<tr>
			<td colspan="5">

			Add  <input type="text" size="5" name='add'/> answers: <input type="submit" name="addbtn" class="formbutton" value="{$lang.add}"/>

			</td>
		</tr>

		{assign var="mcount" value="0"}
		{if $answer}
		{foreach item=item key=key from=$answer}
			{math equation="$mcount+1" assign="mcount"}
			<tr>
				<td colspan="5">
				  Answer {$mcount}: 	<input type="text" name="{$item}" size="40"/>
				</td>
			</tr>
		{/foreach}
		{/if}

		<tr>
			<td colspan="5" align="center">
				<input type="submit"  class="formbutton" name="edit" value='{$lang.save}'/>
			</td>
		</tr>
		<tr class="table_head">
			<th width="1%">{lang mkey='col_head_srno'}</th>
			<th width="84%" align="center">{$lang.answer}</th>
			<th width="6%" colspan="2" >{lang mkey='order'}</th>
			<th colspan="2"  width="10%">{lang mkey='action'}</th>
		</tr>
		{assign var="mcount" value="0"}
	{foreach item=item key=key from=$data}
		{math equation="$mcount+1" assign="mcount"}
		<tr class="{cycle values="oddrow,evenrow"}">

			<td>{$mcount}</td>
			<td>{$item.answer|stripslashes}</td>
		{if $mcount != 1 }
			<td><a href="plugin.php?plugin={$plugin_name}&amp;do=moveqcup&amp;qcid={$item.qcid}"><img src="images/uparrow.JPG" alt="Move Up" border="0" /></a></td>
		{else}
			<td>&nbsp;</td>
		{/if}
		{if $mcount != $data|@count}
			<td><a href="plugin.php?plugin={$plugin_name}&amp;do=moveqcdown&amp;qcid={$item.qcid}"><img src="images/downarrow.JPG" alt="Move Down" border="0" /></a></td>
		{else}
			<td>&nbsp;</td>
		{/if}
			<td align="center"><a href="plugin.php?plugin={$plugin_name}&amp;do=editanswer&amp;qcid={$item.qcid}"><img src="images/button_edit.png" alt="Edit" border="0" /></a></td>
			<td align="center"><a href="#" onclick="confirmDelete({$item.qcid},'{lang mkey='admin_js__delete_error_msgs' skey=1}')"><img src="images/button_drop.png" alt="Delete" border="0" /></a></td>
		</tr>
	{/foreach}
	</tbody>
	</table>
	</form>
</div>