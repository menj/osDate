{strip}

<div class="module_detail"  style="width:99.9%;vertical-align:top;display:inline; float:left;" >
	{assign var="page_hdr01_text" value="{lang mkey='section_poll_title'}"}
	{assign var="page_title" value="{lang mkey='section_poll_title'}"}
	{include file="page_hdr01.tpl"}

	<div class="line_outer">
		{if $error_message neq ""}
			{include file="display_error.tpl"}
      	{/if}
		<div class="line_top_bottom_pad edituserlink">
			<div style="display:inline; float:left; width: 40%; margin-right: 3px; text-align:center;">
				{lang mkey='section_poll_list'}
			</div>
			<div style="display:inline; float:left; text-align:center;">
				<a href="addpoll.php"  class='edituserlink'>
				<span>{lang mkey='section_add_poll'}</span>
				</a>
			</div>
			<div style="clear:both;"></div>
		</div>
      <form name="frmEditPref" method="post" action="polllist.php">
      <input type="hidden" name="action" value="multiple_delete"/>
		<div class="module_detail_inside">
			{assign var="page_hdr02_text" value="{lang mkey='poll_subtitle_list'}"}
			{include file="page_hdr02.tpl"}
		   { if $list }
				<table width="100%" border="0" cellspacing="{$config.cellspacing}" cellpadding="{$config.cellpadding}">

					  <tr class="table_head">
						 <th width="5%"><input type="checkbox" name="chkall" value="" onclick="checkAll(this.form,'delete[]',this.checked)" /><input type="hidden" name="act" value="{$act}" /></th >
						 <th width="5%">{lang mkey='poll_number'}</th>
						 <th width="5%">{lang mkey='poll_active_hdr'}</th>
						 <th width="55%">{lang mkey='poll_question_hdr'}</th>
						 <th width="15%">{lang mkey='poll_responses_hdr'} </th>
						 <th width="10%">{lang mkey='action'}</th>
					  </tr>
					  {assign var="mcount" value="0"}
					  {foreach item=item key=key from=$list}
						 {math equation="$mcount+1" assign="mcount"}
					  <tr class="{cycle  values="oddrow,evenrow"}">
						 <td>
							<input type="checkbox" name="delete[]" value="{$item.id}" /></td>
						 <td>{$mcount}</td>
						 <td>{$item.active_yn}</td>
						 <td>
							<a href="pollresults.php?id={$item.id}">{$item.short_question}</a></td>
						 <td>{$item.responses}</td>
						 <td>
						 <a href="editpoll.php?id={$item.id}"><img alt="" src="images/button_edit.png" border="0" /></a>
						 &nbsp;
						 <a href="polllist.php?id={$item.id}&amp;action=delete" onclick="return confirmLink(this, '{lang mkey='blog' skey='del02'} poll entry?')"><img alt="" src="images/button_drop.png" border="0" /></a>
						 </td>
					  </tr>
					  {/foreach}
					  <tr>
						 <td colspan="4" align="left">
							<img src="images/arrow_ltr.png" alt="" />{lang mkey='with_selected'}&nbsp;
							<input type="submit" class="formbutton" value="{lang mkey='delete_selected'}" name="groupaction" onclick="return confirmButton('{lang mkey='blog' skey='del02'} poll entries?')" />
						 </td>
					  </tr>
				</table>
			   { else }
				<div class="line_top_bottom_pad">
					{lang mkey='no_poll_found'}
				</div>
			   {/if}
		  <br />
		</div>
      </form>
	</div>
</div>
<div style="clear:both;"></div>
<br />
{/strip}
