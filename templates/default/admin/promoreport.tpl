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

{assign var="page_hdr01_text" value="{lang mkey='promo_report'}"}
{assign var="page_title" value="{lang mkey='promo_report'}"}
{include file="admin/admin_page_hdr01.tpl"}
{if $data|@count <= 0}
<table width="100%" border="0" cellpadding="5" cellspacing="0" >
	<tr>
		<td class="module_detail_inside" width="100%" >
			{lang mkey="no_promo_data"}
		</td>
	</tr>
</table>
{/if}
{foreach from=$data item=promo_rec key=key }
	<div  class="module_detail_inside top_margin_6px">
		{assign var="page_hdr02_text" value=$promo_rec.promocode|cat:": "|cat:$promo_rec.pdesc|cat:" ("|cat:$promo_rec.cnt|cat:" members)"}
		{include file="admin/admin_page_hdr02.tpl"}
		<div class="line_outer">
			<table border="0" cellspacing="0" cellpadding="0" width="100%" style="padding:5px;">
			{if $promo_rec.cnt > 0}
				{assign var="lcnt" value=0}
				{foreach from=$promo_rec.userlist item=usr key=ukey}
					{if $lcnt==0}
						<tr>
					{/if}
					<td >
					{if $config.enable_mod_rewrite == 'Y'}
						<a href="javascript:popUpScrollWindow('{if $config.seo_username == 'Y'}{$usr.username}{else}{$usr.userid}.htm{/if}','top',650,600)">
					{else}
						<a href="javascript:popUpScrollWindow('showprofile.php?{if $config.seo_username == 'Y'}username={$usr.username}{else}id={$usr.userid}{/if}','top',650,600)">
					{/if}
					{$usr.username}
					</a>
					</td>
					<td >{$usr.used_date}</td>
					{assign var="lcnt" value=$lcnt+1}
					{if $lcnt == 3}
						</tr>
						{assign var="lcnt" value=0}
					{/if}
				{/foreach}
				{if $lcnt < 3 && $lcnt > 0}
					</tr>
				{/if}
			{else}
				<tr><td width="100%">{lang mkey="promo_nousers"}</td></tr>
			{/if}
			</table>
		</div>
	</div>
<br />
{/foreach}
{/strip}