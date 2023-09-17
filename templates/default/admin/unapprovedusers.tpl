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

function confirmDelete(profileid,conmsg)
{ldelim}
  if (confirm(conmsg)){ldelim}
    document.frmDelProfile.txtdelete.value=profileid;
    document.frmDelProfile.submit();
  {rdelim}
{rdelim}
/* ]]> */
</script>
{assign var="page_hdr01_text" value="{lang mkey='unapproved_user'}"}
{assign var="page_title" value="{lang mkey='unapproved_user'}"}
{include file="admin/admin_page_hdr01.tpl"}
<div style="margin-top: 6px; text-align:left;">
	{assign var="ct" value=$data|@count}
	<div class="module_detail_inside">
	{assign var="page_hdr02_text" value="{lang mkey='total_profiles_found'} "|cat:$ct}
	{include file="admin/admin_page_hdr02.tpl"}
		{if $errid != '' || $error_message != ''}
			{include file="display_error.tpl"}
		{/if}
		<div class="line_outer">
			<form name="frmGroupSection" action="unapprovedusers.php" method="post" onsubmit="javascript: return confdel(this,'{lang mkey='admin_js_error_msgs' skey=1}');">
			<table   cellspacing="{$config.cellspacing}" cellpadding="{$config.cellpadding}" width="100%" border="0">
			<tbody>
				<tr class="column_head">
					<th>{lang mkey='col_head_srno'}</th>
					<th><input type="checkbox" name="chkall" value="" onclick="checkAll(this.form,'txtchk[]',this.checked)" /></th>
					<th><a href="?sort={lang mkey='col_head_username' escape='url'}&amp;type={$sort_type}">{lang mkey='col_head_username'}</a></th>
					<th><a href="?sort={lang mkey='col_head_firstname' escape=url'}&amp;type={$sort_type}">{lang mkey='col_head_name'}</a></th>
					<th><a href="?sort={lang mkey='col_head_register_at' escape='url'}&amp;type={$sort_type}">{lang mkey='col_head_register_at'}</a></th>
					<th><a href="?sort={lang mkey='col_head_gender' escape='url'}&amp;type={$sort_type}">{lang mkey='col_head_gender'}</a></th>
					<th><a href="?sort={lang mkey='col_head_email' escape='url'}&amp;type={$sort_type}">{lang mkey='col_head_email'}</a></th>
					<th>{lang mkey='action'}</th>
				</tr>
			{if $error == 1}
				<tr>
					<td colspan="8">{lang mkey='no_record_found'}</td>
				</tr>
			{else}
				{assign var="mcount" value="0"}
			{foreach item=item key=key from=$data}
				{math equation="$mcount+1" assign="mcount"}
				<tr class="{cycle values="oddrow,evenrow"}">
					<td>{$mcount}</td>
					<td><input type="checkbox" name="txtchk[]" value="{$item.id}" /></td>
					<td>
					{if $config.enable_mod_rewrite == 'Y'}
						<a href="javascript:popUpScrollWindow('{if $config.seo_username == 'Y'}{$item.username}{else}{$item.id}.htm{/if}','top',650,600)">
					{else}
						<a href="javascript:popUpScrollWindow('showprofile.php?{if $config.seo_username == 'Y'}username={$item.username}{else}id={$item.id}{/if}','top',650,600)">
					{/if}
					{$item.username}</a>
					</td>
					<td>{$item.firstname|stripslashes}&nbsp;{$item.lastname|stripslashes}</td>
					<td>{$item.regdate|date_format:$lang.DATE_FORMAT}</td>
					<td>{mylang mkey='signup_gender_values' skey=$item.gender}</td>
					<td><a href="mailto:{$item.email}">{$item.email}</a></td>
					<td ><a href="javascript:popUpScrollWindow('showprofile.php?{if $config.seo_username=='Y'}username={$item.username}{else}id={$item.id}{/if}','top',650,600)">{lang mkey='review'}</a>&nbsp;
					<a href="profile.php?edit={$item.id}"><img src="images/button_edit.png" border="0" alt="" /></a>&nbsp;
					<a href="#" onclick="javascript:confirmDelete({$item.id},'{lang mkey='admin_js__delete_error_msgs' skey=4}')"><img src="images/button_drop.png" alt="Delete" border="0" /></a>
					</td>
				</tr>
			{/foreach}
			{/if}
				<tr>
					<td>&nbsp;</td>
					<td colspan="7"><img src="images/arrow_ltr.png" alt="" />{lang mkey='with_selected'}&nbsp;
					{foreach key=key item=item1 from=$lang.status_act}
					{if $item.status != $key and $item1 != 'Pending' and $item1 != 'Cancel' }
						<input type="submit" class="formbutton" value="{$item1}" name="groupaction" />&nbsp;
					{/if}
					{/foreach}
					</td>
				</tr>
			</tbody>
			</table>
			</form>
		</div>
	</div>
</div>
<form name="frmDelProfile" action="profile.php" method="get">
	<input type="hidden" name="returnto" value="unapprovedusers.php" />
	<input type="hidden" name="txtdelete" value="" />
	<input type="hidden" name="frm" value="frmDelProfile" />
</form>

{/strip}
