{strip}
<script type="text/javascript">
/* <![CDATA[ */
{literal}
function checkAll(form,name,val){
	for( i=0 ; i < form.length ; i++)
		if( form.elements[i].type == 'checkbox' && form.elements[i].name == name )
			form.elements[i].checked = val;
}
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
function confirmDelete(sid,conmsg)
{
	if (confirm(conmsg)) {
		document.frmDelNews.deletenews.value=sid;
		document.frmDelNews.submit();
	}
}
{/literal}
/* ]]> */
</script>

<form name="frmDelNews" action="managenews.php" method="post">
  <input type="hidden" name="deletenews" value="" />
  <input type="hidden" name="frm" value="frmDelNews" />
</form>
{assign var="page_hdr01_text" value="{lang mkey='manage_news'}"}
{assign var="page_title" value="{lang mkey='manage_news'}"}
{include file="admin/admin_page_hdr01.tpl"}
<div class="top_margin_6px">
	{assign var="page_hdr02_text" value="{lang mkey='total_news'} "|cat:$total_recs}
	{include file="admin/admin_page_hdr02.tpl"}
	<div class="module_detail_inside">
		<div class="line_outer">
			<div class="line_top_bottom_pad" style="display:inline; float:left; text-align:left; width:50%;">
				<a href="newsins.php">{lang mkey='insert_news'}</a>
			</div>
			<div class="line_top_bottom_pad" style="display:inline; float:left; text-align:right; width:49%;">
				{lang mkey='results_per_page'}:&nbsp;
				<select name="results_per_page">
					{html_options options=$lang.search_results_per_page selected=$psize}
				</select>&nbsp;
				<input type="button" class="formbutton" value="{lang mkey='show'}" onclick="document.location='?results_per_page=' + results_per_page.value" />
				&nbsp;&nbsp;
			</div>
			<div style="clear:both;"></div>
			<form action="" name="frm" method="post" onsubmit="javascript: return confdel(this,'{lang mkey='admin_js_error_msgs' skey=1}');">
			<table width="100%" cellspacing="{$config.cellspacing}" cellpadding="{$config.cellpadding}" border="0">
				<tr class="column_head">
					<th nowrap>{lang mkey='col_head_srno'}</th>
					<th nowrap><a href="?sort={lang mkey='col_head_id'}&amp;type={$sort_type}">{lang mkey='col_head_id'}</a></th>
					<th nowrap><a href="?sort={lang mkey='col_head_sendtime'}&amp;type={$sort_type}">{lang mkey='col_head_sendtime'}</a></th>
					<th nowrap><a href="?sort={lang mkey='news_header'}&amp;type={$sort_type}&amp;offset={$smarty.get.offset}">{lang mkey='news_header'}</a></th>
					<th colspan="2" >{lang mkey='action'}</th>
				</tr>
			{assign var="n" value="$upr"}
			{foreach item=item key=key from=$data}
				{math equation="$n+1" assign="n" }
				<tr class="{cycle values="oddrow,evenrow"}">
					<td nowrap>{$n}</td>
					<td nowrap>{$item.newsid}</td>
					<td nowrap>{$item.date|date_format:$lang.DATE_FORMAT}</td>
					<td nowrap>{$item.header|stripslashes}</td>
					<td nowrap><a href="?edit={$item.newsid}"><img src="images/button_edit.png" border="0" alt="" /></a></td>
					<td><a href="#" onclick="javascript:confirmDelete({$item.newsid},'{lang mkey='admin_js__delete_error_msgs' skey=5}')"><img src="images/button_drop.png" alt="Delete" border="0" /></a></td>
				</tr>
			{/foreach}
			</table>
			</form>
			<div class="line_top_bottom_pad" align="center">
				{assign var="pageno" value=$smarty.get.offset}
				{if $pageno == ""}{assign var="pageno" value=1}{/if}
				{if $pageno != "1"}
					<a href="?offset={$pageno-1}&amp;{$querystring}">{lang mkey='previous'}</a>&nbsp;
				{/if}
				{if $total_recs > $psize}
					<a href="?offset={$pageno+1}&amp;{$querystring}">{lang mkey='next'}</a>&nbsp;
				{/if}
			</div>
		</div>
	</div>
</div>
{/strip}