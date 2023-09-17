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
function confirmDelete(sid,conmsg)
{
	if (confirm(conmsg)) {
		document.frmDelPromo.deletepromo.value=sid;
		document.frmDelPromo.submit();
	}
}
{/literal}
/* ]]> */
</script>

<form name="frmDelPromo" action="managepromo.php" method="post">
  <input type="hidden" name="deletepromo" value="" />
  <input type="hidden" name="frm" value="frmDelPromo" />
</form>
{assign var="page_hdr01_text" value="{lang mkey='pmgmt'}"}
{assign var="page_title" value="{lang mkey='pmgmt'}"}
{include file="admin/admin_page_hdr01.tpl"}
<div class="top_margin_6px" >
	{assign var="page_hdr02_text" value="{lang mkey='tpromo'}"|cat:": "|cat:$total_recs}
	{include file="admin/admin_page_hdr02.tpl"}
	<div class="module_detail_inside">
		<div class="line_outer">
			<form action="" name="frm" method="post" onsubmit="javascript: return confdel(this,'{lang mkey='admin_js_error_msgs' skey=1}');">
				<table width="100%" cellspacing="{$config.cellspacing}" cellpadding="{$config.cellpadding}" border="0">
					<tr>
						<td colspan="3"><a href="promoins.php">{lang mkey='insert_promo'}</a></td>
						<td colspan="3" align="right">
							{lang mkey='results_per_page'}:&nbsp;
							<select name="results_per_page">
								{html_options options=$lang.search_results_per_page selected=$psize}
							</select>&nbsp;
							<input type="button" class="formbutton" value="{lang mkey='show'}" onclick="document.location='?results_per_page=' + results_per_page.value" />
						</td>
					</tr>
					<tr class="column_head" align="center">
						<th nowrap>{lang mkey='col_head_srno'}</th>
						<th nowrap><a href="?sort={lang mkey='col_head_id'}&amp;type={$sort_type}">{lang mkey='col_head_id'}</a></th>
						<th nowrap><a href="?sort=promo_code&amp;type={$sort_type}">{lang mkey='promo_code'}</a></th>
						<th nowrap><a href="?sort=promo_desc&amp;type={$sort_type}&amp;offset={$smarty.get.offset}">{lang mkey='promo_desc'}</a></th>
						<th nowrap><a href="?sort={lang mkey='col_head_enabled' escape='url'}&amp;type={$sort_type}">{lang mkey='col_head_enabled'}</a></th>
						<th colspan="2" >{lang mkey='action'}</th>
					</tr>
				{assign var="n" value="$upr"}
				{foreach item=item key=key from=$data}
					{math equation="$n+1" assign="n" }
					<tr class="{cycle values="oddrow,evenrow"}">
						<td nowrap><center>{$n}</center></td>
						<td nowrap><center>{$item.id}</center></td>
						<td nowrap>{$item.promocode}</td>
						<td nowrap>{$item.pdesc}</td>
						<td nowrap><center>{if $item.active != 1 }<a href="?active=promo&amp;promoid={$item.id}">{lang mkey='activate'}</a>
									{elseif $item.active == 1}<a href="?inactive=promo&amp;promoid={$item.id}">{lang mkey='deactivate'}</a>
								  {/if}
						</center></td>
						<td colspan="2"><center><a href="?edit={$item.id}"><img src="images/button_edit.png" border="0" alt="" /></a>&nbsp;&nbsp;<a href="?delete=promo&amp;promoid={$item.id}"><img src="images/button_drop.png" alt="Delete" border="0" /></a></center></td>
					</tr>
				{/foreach}
				</table>
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
			</form>
		</div>
	</div>
</div>
{/strip}