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
	var conmsg = "{lang mkey='admin_js__delete_error_msgs' skey=19}";
	if (confirm(conmsg)){ldelim}
		document.location='managecities.php?countrycode={$countrycode}&statecode={$statecode}&countycode={$countycode}&action=delete&id='+id;
	{rdelim}
{rdelim}

function confirmDeleteSel(frm)
{ldelim}
	var conmsg = "{lang mkey='admin_js__delete_error_msgs' skey=20}";
    frm = document.forms['frmStates'];
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
		document.frmStates.groupaction.value = "{lang mkey='delete_selected'}";
		document.frmStates.submit();
	{rdelim}
	{rdelim}
{rdelim}
/* ]]> */
</script>
{assign var="page_hdr01_text" value='<a href="managecountries.php" class="subhead">'|cat:"{lang mkey='manage_countries'}"|cat:'</a>&nbsp;>&nbsp;<a href="managestates.php?countrycode='|cat:$countrycode|cat:'"   class="subhead">'|cat:"{lang mkey='manage_states'}"|cat:'</a>&nbsp;>&nbsp;<a href="managecounties.php?countrycode='|cat:$countrycode|cat:'&amp;statecode='|cat:$statecode|cat:'" class="subhead">'|cat:"{lang mkey='manage_counties'}"|cat:'</a>&nbsp; > &nbsp;'}
{if $todo != ''}
	{assign var="page_hdr01_text" value=$page_hdr01_text|cat:'<a href="managecities.php?countrycode='|cat:$countrycode|cat:'&amp;statecode='|cat:$statecode|cat:'&amp;countycode='|cat:$countycode|cat:'" class="subhead">'|cat:"{lang mkey='manage_cities'}"|cat:'</a>'}
{else}
	{assign var="page_hdr01_text" value=$page_hdr01_text|cat:"{lang mkey='manage_cities'}"}
{/if}
{assign var="page_title" value="{lang mkey='manage_countries'} - "|cat:"{lang mkey='manage_states'} - "|cat:"{lang mkey='manage_counties'} - "|cat:"{lang mkey='manage_cities'}"}


{include file="admin/admin_page_hdr01.tpl"}
<div style="margin-top: 6px;" style="text-align:left;">
	{assign var="page_hdr02_text" value=$countryname|cat:'&nbsp; > &nbsp;'|cat:$statename|cat:' > '|cat:$countyname|cat:' > '}

	{if $todo == 'add'}
		{assign var="page_hdr02_text" value=$page_hdr02_text|cat:"{lang mkey='insert_city'}"}
	{elseif $todo == 'edit'}
		{assign var="page_hdr02_text" value=$page_hdr02_text|cat:"
		{lang mkey='modify_city'}"}
	{else}
		{assign var="page_hdr02_text" value=$page_hdr02_text|cat:"{lang mkey='cities_count'}: "|cat:$total_recs}
	{/if}

	{include file="admin/admin_page_hdr02.tpl"}
	<div class="module_detail_inside">
		{ if $errmsg != ''}
			{assign var="error_message" value=$error_message}
			{include file="display_error.tpl"}
		{ /if }
		<div class="line_outer">
		{if $todo != ''}
			<form name="cities" method="post" action="managecities.php" onsubmit="javascript: return checkMe(this);">
				<table width="100%" cellspacing="{$config.cellspacing}" cellpadding="{$config.cellpadding}" border="0">
					<tr>
						<td width="6">&nbsp;</td>
						<td align="left" width="150">
							{lang mkey='city_code'}:<font class="required_info">{$smarty.const.REQUIRED_INFO}</font>
						</td>
						<td >
							<input type="text" class="textinput"  name="code" value="{$data.code|stripslashes}" />
						</td>
					</tr>
					<tr>
						<td width="6">&nbsp;</td>
						<td width="150">
							{lang mkey='city_name'}:<font class="required_info">{$smarty.const.REQUIRED_INFO}</font>
						</td>
						<td >
							<input type="text" class="textinput"  name="name" value="{$data.name|stripslashes}" />
						</td>
					</tr>
					<tr>
						<td width="6">&nbsp;</td>
						<td align="center">
							<input name="id" type="hidden" value="{$data.id}" />
							<input name="countrycode" type="hidden" value="{$countrycode}" />
							<input name="statecode" type="hidden" value="{$statecode}" />
							<input name="countycode" type="hidden" value="{$countycode}" />
							<input type="hidden" name="action" {if $todo == 'edit'}value='edited'{else}value='added' {/if} />
							<input type="submit" class="formbutton" name="submit" {if $todo == 'edit'}value="{lang mkey='modify_city'}"{else}value="{lang mkey='insert_city'}"{/if} />
						</td>
					</tr>
				</table>
			</form>
		{ else }
			<div class="line_top_bottom_pad">
				<div style="display:inline; float:left;">
					<a href="managecities.php?countrycode={$countrycode}&amp;statecode={$statecode}&amp;countycode={$countycode}&amp;action=add">&nbsp;{lang mkey='insert_city'}</a>
				</div>
				<div style="display:inline; float:right;">
					<form action="" method="get" name="frmPageList">
						{lang mkey='results_per_page'}&nbsp;
						<select name="results_per_page" id="results_per_page">
						{html_options options=$lang.search_results_per_page selected=$page_size}
						</select>&nbsp;
						<input type="hidden" name="countrycode" value="{$countrycode}" />
						<input type="hidden" name="countycode" value="{$countycode}" />
						<input type="hidden" name="statecode" value="{$statecode}" />
						<input type="submit" class="formbutton" value="{lang mkey='show'}" />
					</form>
					&nbsp;&nbsp;
				</div>
				<div style="clear:both;"></div>
			</div>
			<form action="managecities.php" method='post' name="frmStates">
			<input type="hidden" name="countrycode" value="{$countrycode}" />
			<input type="hidden" name="statecode" value="{$statecode}" />
			<input type="hidden" name="countycode" value="{$countycode}" />
			<table width="100%" cellspacing="{$config.cellspacing}" cellpadding="{$config.cellpadding}" border="0">
				<tr class="column_head">
					<th><input type="checkbox" name="chkall" value="" onclick="checkAll(this.form,'txtcheck[]',this.checked)" /></th>
					<th nowrap>{lang mkey='col_head_srno'}</th>
					<th nowrap><a href="?sort={lang mkey='city_code' escape='url'}&amp;type={$sort_type}&amp;countrycode={$countrycode}&amp;statecode={$statecode}&amp;countycode={$countycode}">{lang mkey='city_code'}</a></th>
					<th nowrap><a href="?sort={lang mkey='city_name' escape='url'}&amp;type={$sort_type}&amp;countrycode={$countrycode}&amp;statecode={$statecode}&amp;countycode={$countycode}">{lang mkey='city_name'}</a></th>
					<th colspan="2" >{lang mkey='action'}</th>
				</tr>
			{assign var="n" value="$upr"}
			{foreach item=item key=key from=$citieslist}
			{math equation="$n+1" assign="n" }
				<tr class="{cycle values="oddrow,evenrow"}">
					<td ><input type="checkbox" name="txtcheck[]" value="{$item.id}" /></td>
					<td nowrap>{$n}</td>
					<td nowrap>{$item.code|stripslashes}</td>
					<td nowrap><a href="managezips.php?countrycode={$countrycode}&amp;statecode={$statecode}&amp;countycode={$countycode}&amp;citycode={$item.code}">{$item.name|stripslashes}</a></td>
					<td nowrap colspan="2" ><a href="managecities.php?countrycode={$countrycode}&amp;statecode={$statecode}&amp;countycode={$countycode}&amp;action=edit&amp;id={$item.id}"><img src="images/button_edit.png" alt='Edit' border="0" /></a>
					&nbsp;&nbsp;&nbsp;
					<a href="#" onclick="confirmDelete({$item.id});"><img src="images/button_drop.png" alt="Delete" border="0" /></a></td>
				</tr>
			{/foreach}
				<tr>
					<td colspan="5">
						<img src="images/arrow_ltr.png" alt="" />{lang mkey='with_selected'}&nbsp;
						<input type="button" class="formbutton" value="{lang mkey='delete_selected'}" name="checkDel" onclick="javascript: confirmDeleteSel();" />
						<input name="groupaction" type="hidden" value="" />
					 </td>
				</tr>
			</table>
			</form>
			<div class="line_top_bottom_pad" align=center>
				{assign var="pageno" value=$smarty.get.offset}
				{if $pageno == ""}{assign var="pageno" value=1}{/if}
				{if $pageno != "1"}
					<a href="managecities.php?countrycode={$countrycode}&amp;statecode={$statecode}&amp;countycode={$countycode}&amp;offset={$pageno-1}">{lang mkey='previous'}</a>&nbsp;
				{else}
					{lang mkey='previous'}&nbsp;
				{/if}
				{if $total_recs > $page_size}
					<a href="managecities.php?countrycode={$countrycode}&amp;statecode={$statecode}&amp;countycode={$countycode}&amp;offset={$pageno+1}">{lang mkey='next'}</a>&nbsp;
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
						<input type="hidden" name="countrycode" value="{$countrycode}" />
						<input type="hidden" name="statecode" value="{$statecode}" />
						<input type="hidden" name="countycode" value="{$countycode}" />
						{lang mkey='city_code'}:&nbsp;
						<input name="citycode" value="{$citycode}" type="text" class="textinput"  size="10" maxlength="10" />&nbsp;
						{lang mkey='or'}&nbsp;
						{lang mkey='name_col'}:&nbsp;
						<input type="text" class="textinput"  name="cityname" value="{$cityname}" size="30" maxlength="100" />
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