{strip}
<script type="text/javascript">
/* <![CDATA[ */
function checkMe(form)
{ldelim}
	if (form.code.value == '' || form.name.value == ''){ldelim}
		alert("{lang mkey='errormsgs' skey=20}");
		return false;
	{rdelim}
	return true;
{rdelim}

function confirmDelete(id)
{ldelim}
	var conmsg = "{lang mkey='admin_js__delete_error_msgs' skey=12}";
	if (confirm(conmsg)){ldelim}
		document.location='managecountries.php?action=delete&id='+id;
	{rdelim}
{rdelim}

function confirmDeleteSel()
{ldelim}
    frm = document.forms['frmCntry'];
	var conmsg = "{lang mkey='admin_js__delete_error_msgs' skey=14}";
	for(i=0;i < frm.length;i++){ldelim}
    if(frm.elements[i].type=='checkbox' && frm.elements[i].checked == true){ldelim}
      selected = true;
      break;
    {rdelim}else{ldelim}
      selected = false;
	 {rdelim}
	{rdelim}
  	if(!selected) {ldelim}
    alert("{lang mkey='admin_js_error_msgs' skey=1}");
    return false;
  {rdelim}else{ldelim}
	if (confirm(conmsg)){ldelim}
		document.frmCntry.groupaction.value = "{lang mkey='delete_selected'}";
		document.forms['frmCntry'].submit();
	{rdelim}
  {rdelim}
{rdelim}
/* ]]> */
</script>
{if $todo != ''}
	{assign var="page_hdr01_text" value='<a href="managecountries.php" class="subhead">'|cat:"{lang mkey='manage_countries'}"|cat:'</a> > '}
	{if $todo == 'add'}
		{assign var="page_hdr01_text" value=$page_hdr01_text|cat:"{lang mkey='insert_country'}"}
	{else}
		{assign var="page_hdr01_text" value=$page_hdr01_text|cat:"{lang mkey='modify_country'}"}
	{/if}
{else}
	{assign var="page_hdr01_text" value="{lang mkey='manage_countries'}"}
{/if}
{assign var="page_title" value="{lang mkey='manage_countries'} - "|cat:"{lang mkey='modify_country'}"}
{include file="admin/admin_page_hdr01.tpl"}

<div class="top_margin_6px"  style="text-align:left;">
	{if $todo == 'add'}
		{assign var="page_hdr02_text" value="{lang mkey='insert_country'}"}
	{elseif $todo == 'edit'}
		{assign var="page_hdr02_text" value="{lang mkey='modify_country'}"}
	{else}
		{assign var="page_hdr02_text" value="{lang mkey='countries_count'}: "|cat:$total_recs}
	{/if}
	{include file="admin/admin_page_hdr02.tpl"}
	<div class="module_detail_inside">

		{ if $errmsg != ''}
			{include file="display_error.tpl"}
		{ /if }
		<div class="line_outer">
		{if $todo != ''}
		   <form name="cntry" method="post" action="managecountries.php" onsubmit="javascript: return checkMe(this);">
				<table width="100%" cellspacing="{$config.cellspacing}" cellpadding="{$config.cellpadding}" border="0">
					<tr>
						<td align="left" width="150">
							{lang mkey='country_code'}:<font class="required_info">{$smarty.const.REQUIRED_INFO}</font>
						</td>
						<td >
							<input type="text" class="textinput" name="code" {if $todo == 'edit' or $errmsg != ''}value="{$data.code|stripslashes}"{else}value=''{/if} />
						</td>
					</tr>
					<tr>
						<td width="150">
							{lang mkey='country_name'}:<font class="required_info">{$smarty.const.REQUIRED_INFO}</font>
						</td>
						<td >
							<input type="text"  class="textinput" name="name" {if $todo == 'edit' or $errmsg != ''}value="{$data.name|stripslashes}"{else}value=''{/if} />
						</td>
					</tr>
					<tr>
						<td align="center">
							<input name="id" type="hidden" value="{$data.id}" />
							<input type="submit" class="formbutton" name="submit" {if $todo == 'edit'}value="{lang mkey='modify_country'}"{else}value="{lang mkey='insert_country'}" {/if} />
							<input type="hidden" name="action" {if $todo == 'edit'}value='edited'{else}value='added' {/if} />
						</td>
					</tr>
				</table>
			</form>
		{ else }
			<div class="line_top_bottom_pad" >
				<div style="display:inline; float:left;width:50%">
					<a href="managecountries.php?action=add">&nbsp;{lang mkey='insert_country'}</a>
				</div>
				<div style="display:inline; float:left;width:48%;text-align:right;" >
					<form action="" method="get" name="frmPageOpt">
					{lang mkey='results_per_page'}&nbsp;
					<select name="results_per_page" id="results_per_page">
					{html_options options=$lang.search_results_per_page selected=$page_size}
					</select>&nbsp;
					<input type="submit" class="formbutton" value="{lang mkey='show'}" />
					</form>
				</div>
				<div style="clear:both;"></div>
			</div>
			<form action="managecountries.php" method='post' name="frmCntry" >
				<table width="100%" cellspacing="{$config.cellspacing}" cellpadding="{$config.cellpadding}" border="0">
					<tr class="column_head">
						<th><input type="checkbox" name="chkall" value="" onclick="checkAll(this.form,'txtcheck[]',this.checked)" /></th>
						<th nowrap>{lang mkey='col_head_srno'}</th>
						<th nowrap><a href="?sort={lang mkey='country_code' escape='url'}&amp;type={$sort_type}">{lang mkey='country_code'}</a></th>
						<th nowrap><a href="?sort={lang mkey='country_name' escape='url'}&amp;type={$sort_type}">{lang mkey='country_name'}</a></th>
						<th >{lang mkey='action'}</th>
					</tr>
					{assign var="n" value="$upr"}
				{foreach item=item key=key from=$countrieslist}
					{math equation="$n+1" assign="n" }
					<tr class="{cycle values="oddrow,evenrow"}">
						<td><input type="checkbox" name="txtcheck[]" value="{$item.id}" /></td>
						<td nowrap>{$n}</td>
						<td nowrap>{$item.code|stripslashes}</td>
						<td nowrap width="50%"><a href="managestates.php?countrycode={$item.code}">{$item.name|stripslashes}</a></td>
						<td nowrap><a href="managecountries.php?action=edit&amp;id={$item.id}"><img src="images/button_edit.png" alt='Edit' border="0" /></a>
						&nbsp;&nbsp;&nbsp;
						<a href="javascript:confirmDelete({$item.id});"><img src="images/button_drop.png" alt="Delete" border="0" /></a></td>
					</tr>
				{/foreach}
					<tr>
						<td colspan="4">
							<img src="images/arrow_ltr.png" alt="" />{lang mkey='with_selected'}&nbsp;
							<input type="button" class="formbutton" value="{lang mkey='delete_selected'}" name="checkdel" onclick="javascript:confirmDeleteSel();" />
							<input type="hidden" name="groupaction" value="" />
						 </td>
					</tr>
				</table>
			</form>
			<div class="line_top_bottom_pad" align="center">
				{assign var="pageno" value=$smarty.get.offset}
				{if $pageno == ""}{assign var="pageno" value=1}{/if}
				{if $pageno != "1"}
					<a href="managecountries.php?offset={$pageno-1}">{lang mkey='previous'}</a>&nbsp;
				{else}
					{lang mkey='previous'}&nbsp;
				{/if}
				{if $total_recs > $config.page_size}
					<a href="managecountries.php?offset={$pageno+1}">{lang mkey='next'}</a>&nbsp;
				{else}
					{lang mkey='next'}&nbsp;
				{/if}
			</div>
			<br />
			<div class="module_detail_inside">
				{assign var="page_hdr02_text" value="{lang mkey='filter_records'}"}
				{include file="admin/admin_page_hdr02.tpl"}
				<div class="line_top_bottom_pad" align="center">
					<form name="srchMe" method="post" action="">
						{lang mkey='country_code'}:&nbsp;
						<input name="countrycode" value="{$countrycode}" type="text" class="textinput" size="4" maxlength="4" />&nbsp;
						{lang mkey='or'}&nbsp;
						{lang mkey='country_name'}:&nbsp;
						<input type="text" class="textinput"  name="countryname" value="{$countryname}" size="30" maxlength="100" />
						&nbsp;
						<input type="submit" class="formbutton" name="searchme" value="{lang mkey='show'}" />
					</form>
				</div>
			</div>
		{/if}
		</div>
	</div>
</div>
{/strip}