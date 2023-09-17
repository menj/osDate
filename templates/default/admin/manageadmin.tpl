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
		document.frmDelAdmin.deleteadmin.value=sid;
		document.frmDelAdmin.submit();
	}
}
{/literal}
/* ]]> */
</script>

<form name="frmDelAdmin" action="manageadmin.php" method="post">
  <input type="hidden" name="deleteadmin" value="" />
  <input type="hidden" name="frm" value="frmDelAdmin" />
</form>
{assign var="page_hdr01_text" value="{lang mkey='manage_admins'}"}
{assign var="page_title" value="{lang mkey='manage_admins'}"}
{include file="admin/admin_page_hdr01.tpl"}

<div class="top_margin_6px">
	{assign var="page_hdr02_text" value="{lang mkey='total_admins'}: "|cat:$total_recs}
	{include file="admin/admin_page_hdr02.tpl"}
	<div class="module_detail_inside" style="padding-top:1px;">
		<div class="line_outer">
		<form action="" name="frm" method="post" onsubmit="javascript: return confdel(this,'{lang mkey='admin_js_error_msgs' skey=1}');">
			<table width="100%" cellspacing="{$config.cellspacing}" cellpadding="{$config.cellpadding}" border="0">
				<tr><td colspan="3"><a href="adminins.php">{lang mkey='add_admin'}</a></td>
					<td colspan="5" align="right">
					{lang mkey='results_per_page'}:&nbsp;
					<select name="results_per_page">
						{html_options options=$lang.search_results_per_page selected=$psize}
					</select>&nbsp;
					<input type="button" class="formbutton" value="{lang mkey='show'}" onclick="document.location='?results_per_page=' + results_per_page.value" />
					</td>
				</tr>
				<tr class="column_head">
					<th nowrap width="5%">
					{lang mkey='col_head_srno'}
					</th>
					<th nowrap width="5%">
						<a href="?sort={lang mkey='col_head_id'}&amp;type={$sort_type}">{lang mkey='col_head_id'}</a>
					</th>
					<th nowrap width="20%">
						<a href="?sort={lang mkey='col_head_username' }&amp;type={$sort_type}">{lang mkey='col_head_username'}</a>
					</th>
					<th nowrap width="30%">
						<a href="?sort=adminname&amp;type={$sort_type}">{lang mkey='admin_col_head_fullname'}</a>
					</th>
					<th nowrap width="10%">
						<a href="?sort=superuser&amp;type={$sort_type}">{lang mkey='superuser'}</a>
					</th>
					<th nowrap width="10%">
						<a href="?sort={lang mkey='col_head_enabled' }&amp;type={$sort_type}">{lang mkey='col_head_enabled'}</a>
					</th>
					<th colspan="2" width="10%" >
						{lang mkey='action'}
					</th>
				</tr>
				{assign var="n" value="$upr"}
			{foreach item=item key=key from=$data}
				{math equation="$n+1" assign="n" }
				<tr class="{cycle values="oddrow,evenrow"}">
					<td nowrap>{$n}</td>
					<td nowrap>{$item.id}</td>
					<td nowrap>{$item.username}</td>
					<td nowrap>{$item.fullname|stripslashes}</td>
					<td nowrap>{$item.super_user}</td>
					<td nowrap>{$item.enabled}</td>
					<td nowrap align="center"><a href="?edit={$item.id}"><img src="images/button_edit.png" border="0" alt="" /></a>
					</td>
				{if $total_recs > 1 }
					<td nowrap align="center"><a href="#" onclick="confirmDelete({$item.id},'{lang mkey='admin_js__delete_error_msgs' skey=11}')"><img src="images/button_drop.png" alt="Delete" border="0" /></a>
					</td>
				{else}
					<td nowrap align="center"> -- </td>
				{/if}
				</tr>
			{/foreach}
			</table>
		</form>
		<div class="line_top_bottom_pad">
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