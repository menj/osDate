{strip}
<script type="text/javascript">
/* <![CDATA[ */
{literal}
function confdel(form,errmsg){
	for(i=0;i < form.length;i++){
		if(form.elements[i].type=='checkbox' && form.elements[i].checked == true){
			selected = true;
			break;
		}
		else {
			selected = false;
		}
	}
	if(!selected) {
		alert(errmsg);
		return false;
	}else{
		form.submit();
		return true;
	}
}
function confirmDelete(sectionid,conmsg,form)
{
	if (confirm(conmsg)){
		form.txtid.value=sectionid;
		form.submit();
	}
}
{/literal}
/* ]]> */
</script>
{assign var="page_hdr01_text" value=$lang.manage_banners}
{include file="admin/admin_page_hdr01.tpl"}
<center>
<div class="module_detail_inside top_margin_6px" style="width:100%">
			{assign var="ct" value=$data|@count}
			{assign var="page_hdr02_text" value=$lang.total_banner|cat:'&nbsp;'|cat:$ct}
			{include file="admin/admin_page_hdr02.tpl"}
      <form name="frmGroupBanner" action="plugin.php?plugin=langBanners&amp;action=managebanner" method="post" onsubmit="javascript: return confdel(this,'{lang mkey='admin_js_error_msgs' skey=1}');">
        <input type="hidden" name="txtid" />
			<table cellspacing="{$config.cellspacing}" cellpadding="{$config.cellpadding}" width="100%">
				<tr>
					<td colspan="7"><span class='modulehead'><a href="plugin.php?plugin=langBanners&amp;action=addbanner">{$lang.add_banners}</a></span></td>
				</tr>
			    <tr class="table_head">
					<th><input type="checkbox" name="chkall" value="" onclick="checkAll(this.form,'txtcheck[]',this.checked)" /></th>
					<th align="center">{$lang.col_head_srno}</th>
					<th align="center">{$lang.language}</th>
					<th align="center">{$lang.size_px}</th>
					<th align="center">{lang mkey='link_target'}</th>
					<th align="center">{$lang.clicks}</th>
					<th align="center">{$lang.col_head_enabled}</th>
					<th colspan="2" align="center">{$lang.action}</th>
				</tr>
				{assign var="mcount" value="0"}
			{foreach item=item key=key from=$data}
				{math equation="$mcount+1" assign="mcount"}
				<tr class="oddrow">
					<td ><input type="checkbox" name="txtcheck[]" value="{$item.id}" /></td>
					<td align="center">{$mcount}</td>
					<td align="center">{$item.language|ucfirst}</td>
					<td align="center">{$item.size}</td>
					<td align="center">{$item.link_target}</td>
					<td align="center">{$item.clicks}</td>
					<td align="center">{$item.enabled}</td>
					<td colspan="2" align="center"><a href="plugin.php?plugin=langBanners&amp;action=managebanner&amp;edit={$item.id}"><img src="images/button_edit.png" alt="Edit" border="0" /></a>&nbsp;
            <a href="#" onclick="javascript:confirmDelete({$item.id},'{$lang.are_you_sure}', document.frmGroupBanner)"><img src="images/button_drop.png" alt="Delete" border="0" /></a></td>
				</tr>
				<tr class="evenrow">
					<td colspan="7" align="center">
						<table cellspacing="{$config.cellspacing}" cellpadding="{$config.cellpadding}" width="100%">
							<tr>
								<td  align="center">
									<center>
									{if $item.type == 'jpg' || $item.type == 'gif' || $item.type == 'bmp'|| $item.type == 'png' }
										<img src="{$bannerdir}{$item.name}" width="{$item.width}" height="{$item.height}" alt="" />
										<br /><a href="{$item.linkurl}" target="_blank">{$item.linkurl}</a>
									{else}
                  <object {if $smarty.session.browser neq "MOZILLA"}classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"{/if} data="{$bannerdir}{$item.name}">
										<param name='movie' value="{$bannerdir}{$item.name}">
										<param name='quality' value='high'>
                  </object>
										<br /><a href="http://{$item.linkurl}" target="_blank">{$item.linkurl}</a>
									{/if}
									</center>
								</td>
							</tr>
						</table>
					</td>
				</tr>
			{/foreach}
				<tr>
		 			<td align="left" colspan="7">
		 				<img src="images/arrow_ltr.png" alt="" />{$lang.with_selected}&nbsp;
		 				<input type="submit" class="formbutton" value="{$lang.enable_selected}" name="enable" />&nbsp;
		 				<input type="submit" class="formbutton" value="{$lang.disable_selected}" name="disable" />
		 			</td>
				</tr>
			</table>
    </form>
</div>
<br />
{/strip}