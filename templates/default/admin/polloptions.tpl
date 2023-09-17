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
function confirmDelete(optid,pid,conmsg)
{
/*  frmDelOption = document.getElementsByName ("frmDelOption").namedItem ("frmDelOption"); */
  if (confirm(conmsg)){
    document.frmDelOption.txtoptionid.value=optid;
    document.frmDelOption.txtpollid.value=pid;
    document.frmDelOption.submit();
  }
}

function addOption(form)
{
  ErrorCount=0;
  ErrorMsg = new Array();
  ErrorMsg[0]="------------------------- The Following Errors Occured -------------------------\n" + String.fromCharCode(13)+ String.fromCharCode(10);
{/literal}
  CheckFieldString("noblank",form.txtpolloption,"{lang mkey='poll_error' skey='txtpollopt_noblank'}");
{literal}
  result="";
  if( ErrorCount > 0)
  {
    for( c in ErrorMsg)
      result += ErrorMsg[c];
    alert(result);
    return false;
  }
/*  frmAddOption = document.getElementsByName ("frmAddOption").namedItem ("frmAddOption"); */

  document.frmAddOption.txtpollid.value=form.txtpollid.value;
  document.frmAddOption.txtoptionid.value=form.txtoptionid.value;
  document.frmAddOption.txtpolloption.value=form.txtpolloption.value;
  document.frmAddOption.txtenabled.value=form.txtenabled.value;
  document.frmAddOption.submit();
}

function addNewOption(form)
{
  if( form.txtpolloption.value == "" ) {
{/literal}
    alert( "{lang mkey='poll_error' skey='txtpollopt_noblank'}" )
{literal}
  return false;
  }
return true;
}

{/literal}
/* ]]> */
</script>
{assign var="page_hdr01_text" value='<a href="managepoll.php" class="subhead">'|cat:"{lang mkey='manage_polls'}"|cat:'</a> > '|cat:"{lang mkey='modify_options'}"}
{assign var="page_title" value="{lang mkey='manage_polls'} - "|cat:"{lang mkey='modify_options'}"}
{assign var="page_hdr01_text_r" value='<a href="managepoll.php" class="subhead">'|cat:"{lang mkey='back'}"|cat:'</a>'}
{include file="admin/admin_page_hdr01.tpl"}
  <form name="frmDelOption" action="polloptions.php" method="post">
    <input type="hidden" name="txtpollid" value="" />
    <input type="hidden" name="txtoptionid" value="" />
    <input type="hidden" name="delaction" value="Yes" />
    <input type="hidden" name="frm" value="frmDelOption" />
  </form>

  <form name="frmAddOption" action="addpolloption.php" method="post">
    <input type="hidden" name="txtpollid" value="" />
    <input type="hidden" name="txtoptionid" value="" />
    <input type="hidden" name="txtpolloption" value="" />
    <input type="hidden" name="txtenabled" value="" />
    <input type="hidden" name="frm" value="frmAddOption" />
  </form>

<div style="padding-top:6px;">
	{assign var="page_hdr02_text" value="{lang mkey='poll'} "|cat:$poll_question:stripslashes}
	{assign var="ct" value=$data|@count}
	{assign var="page_hdr02_text_01" value="{lang mkey='total_options'} "|cat:$ct}
	{include file="admin/admin_page_hdr02.tpl"}
	<div class="module_detail_inside">
		<div class="line_outer">
			{if $smarty.get.msg}
				{assign var="error_message" value=$smarty.get.msg}
				{include file="display_error.tpl"}
			{/if}
		{if $data|@count > 0 }
			<form name="frmOptions" action="polloptions.php" method="post" onsubmit="javascript: return confdel(this,'{lang mkey='admin_js_error_msgs' skey=1}');">
			<table   cellspacing="{$config.cellspacing}" cellpadding="{$config.cellpadding}" width="550" border="0">
			  <tbody>
				<tr class="column_head">
					<th><input type="checkbox" name="chkall" value="" onclick="checkAll(this.form,'txtcheck[]',this.checked)" /></th>
					<th>{lang mkey='col_head_srno'}</th>
					<th><a href="?sort={lang mkey='option'}&amp;type={$sort_type}&amp;pollid={$pollid}">{lang mkey='option'}</a></th>
					<th style="text-align:center"><a href="?sort={lang mkey='votes'}&amp;type={$sort_type}&amp;pollid={$pollid}">{lang mkey='votes'}</a></th>
					<th><a href="?sort={lang mkey='col_head_enabled'}&amp;type={$sort_type}&amp;pollid={$pollid}">{lang mkey='col_head_enabled'}</a></th>
					<th colspan="2" >{lang mkey='action'}</th>
				</tr>
				{assign var="mcount" value="0"}
			{foreach item=item key=key from=$data}
				{math equation="$mcount+1" assign="mcount"}
				<tr class="{cycle values="oddrow,evenrow"}">
					<td ><input type="checkbox" name="txtcheck[]" value="{$item.optionid}" /></td>
					<td>{$mcount}</td>
					<td>{$item.opt|stripslashes}</td>
					<td style="text-align:center">{$item.result} </td>
					<td style="text-align:center">{if $item.enabled == 'Y'} {lang mkey='yes'} {else} {lang mkey='no'} {/if}</td>
					<td><a href="?edit={$item.optionid}"><img src="images/button_edit.png" border="0" alt="" /></a></td>
					<td><a href="#" onclick="confirmDelete('{$item.optionid}','{$item.pollid}','{lang mkey='admin_js__delete_error_msgs' skey=9}')"><img src="images/button_drop.png" border="0" alt="" /></a></td>
				</tr>
			{/foreach}
				<tr>
					<td colspan="2">&nbsp;</td>
					<td colspan="2"><input type="hidden" name="txtpollid" value="{$item.pollid}" />
		  <input type="hidden" name="txtoptionid" value="{$item.optionid}" />
		  <input type="text" class="textinput"  name="txtpolloption" maxlength="255" size="63" /></td>
					<td style="text-align:center"><select name="txtenabled">
						{html_options options=$lang.enabled_values}
						</select>
					</td>
					<td colspan="2">
						<input type="button" class="formbutton" name="btnAdd" value="{lang mkey='submit'}" onclick="addOption(this.form);" />
					</td>
				</tr>
	{*					<tr><td colspan="7">&nbsp;</td></tr>  *}
				<tr>
					<td colspan="7"><img src="images/arrow_ltr.png" alt="" />{lang mkey='with_selected'}&nbsp;
						<input type="submit" class="formbutton" value="{lang mkey='delete_selected'}" name="groupaction" />&nbsp;
						<input type="submit" class="formbutton" value="{lang mkey='enable_selected'}" name="groupaction" />&nbsp;
						<input type="submit" class="formbutton" value="{lang mkey='disable_selected'}" name="groupaction" />
					</td>
				</tr>
			</tbody>
			</table>
			  </form>
		{else}
			<div class="line_top_bottom_pad">
				 {lang mkey='no_record_found'}&nbsp;{lang mkey='add_option_now'}
			</div>
			<form method="post" action="addpolloption.php" name="frmNewOpt">
				<table cellspacing="2" cellpadding="1">
					<input type="hidden" name="txtpollid" value="{$pollid}" />
					<tr>
						<td>{lang mkey='option'}:<font class="required_info">{$smarty.const.REQUIRED_INFO}</font></td>
						<td><input type="text" class="textinput"  name="txtpolloption" maxlength="255" size="53" /></td>
					</tr>
					<tr>
						<td>{lang mkey='col_head_enabled'}:</td>
						<td ><select name="txtenabled">
							{html_options options=$lang.enabled_values}
							</select>
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<input type="submit" class="formbutton" name="btnAdd" value="{lang mkey='submit'}" onclick=" return addNewOption(this.form);" />
						</td>
					</tr>
				</table>
			</form>
		{/if}
		</div>
	</div>
</div>
{/strip}
