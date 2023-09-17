{strip}
<script type="text/javascript">
/* <![CDATA[ */
{literal}
function confdel(form,errmsg){
  for(i=0;i < form.length;i++){
    if(form.elements[i].type=='checkbox' && form.elements[i].checked == true){
      selected = true;
      break;
    }else
      selected = false;
  }
  if(!selected) {
    alert(errmsg);
    return false;
  }else{
    form.submit();
    return true;
  }
}

{/literal}

/* ]]> */
</script>
{assign var="page_hdr01_text" value="{lang mkey='affiliate_title'}"}
{assign var="page_title" value="{lang mkey='affiliate_title'}"}
{include file="admin/admin_page_hdr01.tpl"}
<div class="top_margin_6px">
	{assign var="ct" value=$data|@count}
	{assign var="page_hdr02_text" value="{lang mkey='total_affiliates'}: "|cat:$ct}
	{include file="admin/admin_page_hdr02.tpl"}
	<div class="module_detail_inside"  style="padding-top:1px;">
		<div class="line_outer">
		<div class="line_top_bottom_pad" style="text-align:right; margin-right: 4px;">
			{lang mkey='results_per_page'}:&nbsp;
			<select name="results_per_page">
				{html_options options=$lang.search_results_per_page selected=$psize}
			</select>&nbsp;
			<input type="button" class="formbutton" value="{lang mkey='show'}" onclick="document.location='?results_per_page=' + results_per_page.value" />
		</div>
		<div class="line_top_bottom_pad">
			<form name="frmGroupSelection" method="post" action="affiliatesview.php" onsubmit="javascript: return confdel(this,'{lang mkey='admin_js_error_msgs' skey=1}');">
			<table cellspacing="{$config.cellspacing}" cellpadding="{$config.cellpadding}" border="0" width="100%">
				<tr class="column_head">
					<th><input type="checkbox" name="chkbox" onclick="checkAll(this.form,'txtchk[]',this.checked)" /></th>
					<th>{lang mkey='col_head_srno'}</th>
					<th nowrap><a href="?sortby=name&amp;sortorder={$sortorder}&amp;offset={$smarty.get.offset}">{lang mkey='col_head_name'}</a></th>
					<th nowrap><a href="?sortby=email&amp;sortorder={$sortorder}&amp;offset={$smarty.get.offset}">{lang mkey='col_head_email'}</a></th>
					<th nowrap><a href="?sortby=register&amp;sortorder={$sortorder}&amp;offset={$smarty.get.offset}">{lang mkey='col_head_register_at'}</a></th>
					<th nowrap><a href="?sortby=status&amp;sortorder={$sortorder}&amp;offset={$smarty.get.offset}">{lang mkey='col_head_status'}</a></th>
					<th nowrap>{lang mkey='action'}</th>
				</tr>
				{assign var="n" value="$upr"}
			{if $data|@count > 0}
			{foreach item=item key=key from=$data}
				{math equation="$n+1" assign="n"}
				<tr class="{cycle values="oddrow,evenrow"}">
					<td><input type="checkbox" name="txtchk[]" value="{$item.id}" /></td>
					<td>{$n}</td>
					<td nowrap >{$item.name}</td>
					<td nowrap >{$item.email}</td>
					<td nowrap >{$item.regdate|date_format:$lang.DATE_FORMAT}</td>
					<td nowrap >{mylang mkey='status_disp' skey=$item.status}</td>
					<td nowrap><a href="affiliate.php?act=modify&amp;affid={$item.id}"><img src="images/button_edit.png" border="0" alt="" /></a></td>
				</tr>
			{/foreach}
				<tr>
					<td align="center" colspan="6">
					{assign var="pageno" value=$smarty.get.offset}
					{if $pageno == ""}{assign var="pageno" value=1}{/if}
					{if $pageno != "1"}
						<a href="?offset={$pageno-1}">{lang mkey='previous'}</a>&nbsp;
					{else}
						{lang mkey='previous'}&nbsp;
					{/if}
					{if $data|@count >= $psize}
						<a href="?offset={$pageno+1}">{lang mkey='next'}</a>&nbsp;
					{else}
						{lang mkey='next'}
					{/if}
					</td>
				</tr>
				<tr>
					<td colspan="6">
						<img src="images/arrow_ltr.png" alt="" />{lang mkey='with_selected'}&nbsp;
						{foreach key=key item=item1 from=$lang.status_act}
							<input type="submit" class="formbutton" value="{$item1}" name="groupaction" />&nbsp;
						{/foreach}
					</td>
				</tr>
			{else}
				<tr>
					<td colspan="6">
						{lang mkey='no_record_found'}
					</td>
				</tr>
			{/if}
				<tr><td colspan="6"></td></tr>
			</table>
			</form>
		</div>
		</div>
	</div>
</div>
{/strip}