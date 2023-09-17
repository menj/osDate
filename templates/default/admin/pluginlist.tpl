<script type="text/javascript">
/* <![CDATA[ */
{literal}
function confdelChk(form,errmsg){
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
		return true;
	}
}
{/literal}
/* ]]> */
</script>

{strip}
{assign var="page_hdr01_text" value="{lang mkey='section_plugin_title'}"}
{assign var="page_title" value="{lang mkey='section_plugin_title'}"}
{include file="admin/admin_page_hdr01.tpl"}
{if $error_message neq ""}
	{include file="display_error.tpl"}
{/if}
<div style="padding-top: 3px; padding-bottom: 6px; padding-left: 8px; text-align:left;">
	{lang mkey='plugins_hlp'}
</div>
{assign var="page_hdr02_text" value="{lang mkey='plugin_subtitle_list'}"}
{include file="admin/admin_page_hdr02.tpl"}
<div class="module_detail_inside" style="text-align:left;">
	<div class="line_outer">
		<form name="frmEditPref" method="post" action="pluginlist.php" onSubmit="javascript:if ( confdelChk(document.forms['frmEditPref'],'{lang mkey='admin_js_error_msgs' skey=1}') ) {ldelim} return confirmButton('{lang mkey='blog' skey='del04'} plugins?'); {rdelim}else{ldelim} return false;{rdelim};">
			<input type="hidden" name="action" value="multiple_delete"/>
			<table width="100%" border="0" cellspacing="{$config.cellspacing}" cellpadding="{$config.cellpadding}">

			{ if $list }
				<tr class="column_head">
					<th width="5%"><input type="checkbox" name="chkall" value="" onclick="checkAll(this.form,'delete[]',this.checked)" /><input type="hidden" name="act" value="{$item.name}" /></th >
					<th width="5%">{lang mkey='plugin_number'}</th>
					<th width="50%" align="center">{lang mkey='plugin_name'}</th>
					<th width="8%" align="center">{lang mkey='plugin_active'}</th>
					<th width="24%" align="center">{lang mkey='plugin_installed'}</th>
					<th width="8%" align="center">{lang mkey='action'}</th>
				</tr>
				{assign var="mcount" value="0"}
				{foreach item=item key=key from=$list}
				{math equation="$mcount+1" assign="mcount"}
				<tr class="{cycle  values="oddrow,evenrow"}">
					<td width="5%">
						<input type="checkbox" name="delete[]" value="{$item.name}" /></td>
					<td width="5%">{$mcount}</td>
					<td width="50%">{$item.display_name}</td>
					<td align="center" width="8%">{$item.active}</td>
					<td align="center" width="24%">
						{$item.installed}
						{if $item.installed eq "N" }
							&nbsp; (<a href="pluginlist.php?name={$item.name}&amp;action=install">{lang mkey='plugin_install'}</a>)
						{/if}
					</td>
					<td align="center" width="8%">
					{if $item.installed eq "Y" }
						<a href="editplugin.php?name={$item.name}"><img alt="" src="images/button_edit.png" border="0" /></a>
						&nbsp;&nbsp;
						<a href="pluginlist.php?name={$item.name}&amp;action=delete" onclick="return confirmLink(this, '{lang mkey='blog' skey='del03'} plugin?')"><img alt="" src="images/button_drop.png" border="0" /></a>
					{/if}
					</td>
				</tr>
				{/foreach}
				<tr>
					<td colspan="5" align="left">
						<img src="images/arrow_ltr.png" alt="" />{lang mkey='with_selected'}&nbsp;
						<input type="submit" class="formbutton" value="{lang mkey='delete_selected'}" name="groupaction"  />
					</td>
				</tr>
			{ else }
				<tr>
					<td colspan="5">{lang mkey='no_plugin_found'}</td>
				</tr>
			{/if}
			</table>
		</form>
	</div>
</div>
{/strip}
