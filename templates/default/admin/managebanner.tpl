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
{assign var="page_hdr01_text" value="{lang mkey='manage_banners'}"}
{assign var="page_title" value="{lang mkey='manage_banners'}"}
{include file="admin/admin_page_hdr01.tpl"}
<div class="top_margin_6px" style="text-align:left;">
	{assign var="ct" value=$data|@count}
	{assign var="page_hdr02_text" value="{lang mkey='total_banner'} "|cat:$ct}
	{include file="admin/admin_page_hdr02.tpl"}
	<div class="module_detail_inside">
		<div class="line_outer">
			<div class="line_top_bottom_pad" >
				<a href="addbanner.php">&nbsp;{lang mkey='add_banners'}</a>
			</div>
			<form name="frmGroupBanner" action="managebanner.php" method="post" >
				<input type="hidden" name="txtid" />
				<table cellspacing="{$config.cellspacing}" cellpadding="{$config.cellpadding}" width="100%">
					<tr class="column_head">
						<th><input type="checkbox" name="chkall" value="" onclick="checkAll(this.form,'txtcheck[]',this.checked)" /></th>
						<th align="center"><a href="?sortby=srno&amp;sort={$sortorder}">{lang mkey='col_head_srno'}</a></th>
						<th align="center"><a href="?sortby=size&amp;sort={$sortorder}">{lang mkey='size_px'}</a></th>
						<th align="center"><a href="?sortby=link_target&amp;sort={$sortorder}">{lang mkey='link_target'}</a></th>
						<th align="center"><a href="?sortby=clicks&amp;sort={$sortorder}">{lang mkey='clicks'}</a></th>
						<th align="center"><a href="?sortby=enabled&amp;sort={$sortorder}">{lang mkey='col_head_enabled'}</a></th>
						<th colspan="2" align="center">{lang mkey='action'}</th>
					</tr>
					{assign var="mcount" value="0"}
				{foreach item=item key=key from=$data}
					{math equation="$mcount+1" assign="mcount"}
					<tr class="oddrow">
						<td ><input type="checkbox" name="txtcheck[]" value="{$item.id}" /></td>
						<td align="center">{$mcount}</td>
						<td align="center">{$item.size}</td>
						<td align="center">{$item.link_target}</td>
						<td align="center">{$item.clicks}</td>
						<td align="center">{$item.enabled}</td>
						<td colspan="2" align="center"><a href="?edit={$item.id}"><img src="images/button_edit.png" alt="Edit" border="0" /></a>&nbsp;
						<a href="#" onclick="javascript:confirmDelete({$item.id},'{lang mkey='admin_js__delete_error_msgs' skey=10}', document.frmGroupBanner)"><img src="images/button_drop.png" alt="Delete" border="0" /></a></td>
					</tr>
					<tr class="evenrow">
						<td colspan="7" align="center">
							{if $item.size == 'text'}
								{$item.bannerurl}
							{else}
								{if $item.type == 'jpg' || $item.type == 'gif' || $item.type == 'bmp'|| $item.type == 'png' }
									<img src="{$banner_dir}{$item.name}" width="{$item.width}" height="{$item.height}" alt="" />
									<br /><a href="{$item.linkurl}" target="_blank">{$item.linkurl}</a>
								{else}
								  <object {if $smarty.session.browser neq "MOZILLA"}classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"{/if} data="{$banner_dir}{$item.name}">
									<param name='movie' value="{$banner_dir}{$item.name}">
									<param name='quality' value='high'>
								  </object>
									<br /><a href="{$item.linkurl}">{$item.linkurl}</a>
								{/if}
							{/if}
						</td>
					</tr>
				{/foreach}
					<tr>
						<td align="left" colspan="7">
							<img src="images/arrow_ltr.png" alt="" />{lang mkey='with_selected'}&nbsp;
							<input type="submit" class="formbutton" value="{lang mkey='enable_selected'}" name="enable" />&nbsp;
							<input type="submit" class="formbutton" value="{lang mkey='disable_selected'}" name="disable" />
						</td>
					</tr>
				</table>
			</form>
		</div>
	</div>
</div>
{/strip}