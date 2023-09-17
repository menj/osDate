{strip}
<script type="text/javascript">
/* <![CDATA[ */
function selChk(form){ldelim}
	for(i=0;i < form.length;i++){ldelim}
		if(form.elements[i].type=='checkbox' && form.elements[i].checked == true){ldelim}
			selected = true;
			break;
		{rdelim}
		else {ldelim}
			selected = false;
		{rdelim}
	{rdelim}
	if(!selected) {ldelim}
		alert("{lang mkey='admin_js_error_msgs' skey=1}");
		return false;
	{rdelim}else{ldelim}
		return true;
	{rdelim}
{rdelim}

function confdel(form){ldelim}
	for(i=0;i < form.length;i++){ldelim}
		if(form.elements[i].type=='checkbox' && form.elements[i].checked == true){ldelim}
			selected = true;
			break;
		{rdelim} else {ldelim}
			selected = false;
		{rdelim}
	{rdelim}
	if(!selected) {ldelim}
		alert("{lang mkey='admin_js_error_msgs' skey=1}");
		return false;
	{rdelim} else {ldelim}
	  if (confirm("{lang mkey='admin_js__delete_error_msgs' skey=18}")) {ldelim}
		    document.frm.delete_selected.value="{lang mkey='delete_selected'}";
		    form.submit();
		  {rdelim}else{ldelim}
		    return false;
		  {rdelim}
    {rdelim}
{rdelim}

function confirmDelete(profileid,conmsg)
{ldelim}
  if (confirm(conmsg)){ldelim}
    document.frmDelProfile.txtdelete.value=profileid;
    document.frmDelProfile.submit();
  {rdelim}
{rdelim}
/* ]]> */
</script>
{assign var="page_title" value="{lang mkey='profile_title'}"}
{include file="admin/admin_page_hdr01.tpl"}

<div class="module_detail_inside" style="text-align:left;">
	<form  action="profile.php" method="get">
	<table width="100%" border="0" cellspacing="{$config.cellspacing}" cellpadding="{$config.cellpadding}">
		<tr>
		 	<td nowrap valign="middle"><img src="images/featured.gif" border="0" alt="" />&nbsp;{lang mkey='makefeatured'}</td>
			<td align="right">{lang mkey='results_per_page'}:&nbsp;
				<select name="results_per_page">
					{html_options options=$lang.search_results_per_page selected=$psize}
				</select>&nbsp;
				<input type="button" class="formbutton" value="{lang mkey='show'}" onclick="document.location='?{$querystring|escape:"url"}&amp;results_per_page=' + results_per_page.value" />
			</td>
		</tr>
	</table>
	</form>
	{assign var="page_hdr02_text" value="{lang mkey='total_profiles'}: "|cat:$reccount}
	{include file="admin/admin_page_hdr02.tpl"}
	<div >
		<div class="line_outer">
		{if $error_message != '' }
			{include file="display_error.tpl"}
		{/if}
		<form action="" name="frm" method="post" onSubmit="javacscript: return selChk(this);">
			<table width="100%" cellspacing="{$config.cellspacing}" cellpadding="{$config.cellpadding}" border="0">
				<tr class="column_head">
					<th><input type="checkbox" name="chkall" value="" onclick="checkAll(this.form,'txtchk[]',this.checked)" /></th>
					<th nowrap><a href="?sort={"{lang mkey='col_head_username'}"|urlencode}&amp;type={$sort_type}">{lang mkey='col_head_username'}</a></th>
					<th nowrap> <a href="?sort={"{lang mkey='col_head_fullname'}"|urlencode}&amp;type={$sort_type}&amp;offset={$smarty.get.offset}"> {lang mkey='col_head_fullname'}</a></th>
					<th nowrap><a href="?sort={lang mkey='col_head_gender'}&amp;type={$sort_type}&amp;offset={$smarty.get.offset}">{lang mkey='col_head_gender_short'}</a></th>
					<th nowrap><a href="?sort=level&amp;type={$sort_type}&amp;offset={$smarty.get.offset}">{lang mkey='level_hdr'}</a></th>
					<th nowrap><a href="?sort={lang mkey='col_head_status'}&amp;type={$sort_type}&amp;offset={$smarty.get.offset}">{lang mkey='col_head_status'}</a></th>
					<th nowrap><a href="?sort=expire_date&amp;type={$sort_type}&amp;offset={$smarty.get.offset}">{lang mkey='expire_on_hdr'}</a></th>
					<th nowrap># <a href="?sort=picscnt&amp;type={$sort_type}&amp;offset={$smarty.get.offset}">{lang mkey='pics'}</a> / <a href="?sort=vdscnt&amp;type={$sort_type}&amp;offset={$smarty.get.offset}">{lang mkey='vds'}</a></th>
					<th colspan="3" >{lang mkey='action'}</th>
				</tr>
				{assign var="n" value="$upr"}
			{foreach item=item key=key from=$data}
				{math equation="$n+1" assign="n" }
				<tr class="{cycle values="oddrow,evenrow"}">
					<td ><input type="checkbox" name="txtchk[]" value="{$item.id}" /></td>
					<td nowrap>
					{if $config.enable_mod_rewrite == 'Y'}
						<a href="javascript:popUpScrollWindow('{if $config.seo_username == 'Y'}{$item.username}{else}{$item.id}.htm{/if}','top',650,600)">
					{else}
						<a href="javascript:popUpScrollWindow('showprofile.php?{if $config.seo_username == 'Y'}username={$item.username}{else}id={$item.id}{/if}','top',650,600)">
					{/if}
					{$item.username}</a>
					{if $item.featured}
					<img src="images/featured.gif" border="0" alt="" />
					{/if}
					</td>
					<td nowrap>{$item.firstname|stripslashes}&nbsp;{$item.lastname|stripslashes}</td>
					<td nowrap align="center">{$item.gender}</td>
					<td align="center">{$mships[$item.level]}</td>
					<td >{mylang mkey='status_disp' skey=$item.status}
						{if $item.actkey != 'Confirmed'}
							&nbsp;<img src="{$docroot}images/unread.jpg" border="0" alt="" />
						{/if}
					</td>
					<td >
					{if $item.levelend < $nowdate}
						{mylang mkey='expird'}
					{else}
						{$item.levelend|date_format:$lang.DATE_FORMAT}
					{/if}
					</td>
					<td align="center">
						{if $item.picscnt > 0}
						<a href="showpics.php?userid={$item.id}">{$item.picscnt|default:0}</a>
						{else}
						<a href="userpics.php?userid={$item.id}">{$item.picscnt|default:0}</a>
						{/if}
						&nbsp;/&nbsp;
						<a href="uploadvideos.php?userid={$item.id}">{$item.videoscnt|default:0}</a>
					</td>
					<td nowrap><a href="?edit={$item.id}"><img src="images/button_edit.png" border="0" alt="" /></a></td>
					<td nowrap>{if !$item.featured}
						<a href="featured_profile.php?req_action=add&amp;userid={$item.id}&amp;bckurl=profile.php"><img src="images/featured.gif" border="0" alt="" /></a>
						{else}
							&nbsp;
						{/if}
					</td>
					<td nowrap><a href="#" onclick="javascript:confirmDelete({$item.id},'{lang mkey='admin_js__delete_error_msgs' skey=4}')"><img src="images/button_drop.png" alt="Delete" border="0" /></a></td>
				</tr>
			{/foreach}
			</table>
			<div class="line_top_bottom_pad" align="center">
			{if $total_pages|@count > 1}
				<b>
				{assign var="pageno" value=$smarty.get.offset}
				{if $pageno == ""}{assign var="pageno" value=1}{/if}
				{if $pageno != "1"}
					<a href="?offset=1&amp;{$querystring}">{lang mkey='first'}</a>&nbsp;|&nbsp;
					<a href="?offset={$pageno-1}&amp;{$querystring}">{lang mkey='previous'}</a>&nbsp;|&nbsp;
				{/if}
				{if $total_pages|@count <= 5}
				{foreach item=pagenos from=$total_pages}
					{if $pageno != $pagenos}
						<a href="?offset={$pagenos}&amp;{$querystring}">{$pagenos}</a>&nbsp;
					{else}
						[{$pagenos}]&nbsp;
					{/if}
				{/foreach}
				{else}
				{foreach item=pagenos from=$pages_show}
					{if $pageno != $pagenos}
						<a href="?offset={$pagenos}&amp;{$querystring}">{$pagenos}</a>&nbsp;
					{else}
						[{$pagenos}]&nbsp;
					{/if}
				{/foreach}
				{/if}
				{if $pageno !=  $total_pages|@count}
					&nbsp;|&nbsp;<a href="?offset={$pageno+1}&amp;{$querystring}">{lang mkey='next'}</a>&nbsp;|&nbsp;
					<a href="?offset={$total_pages|@count}&amp;{$querystring}">{lang mkey='last'}</a>
				{/if}
				</b>
			{/if}
			</div>
			<div class="line_top_bottom_pad" style="padding-left: 6px;">
				<table border="0" cellpadding="0" cellspacing="0">
					<tr>
						<td nowrap><img src="images/arrow_ltr.png" alt="" />{lang mkey='with_selected'}&nbsp;
						</td>
						<td nowrap valign="bottom">
						{foreach key=key item=item1 from=$lang.status_act}
							<input type="submit" class="formbutton" value="{$item1}" name="groupaction" />&nbsp;
						{/foreach}
						<input type="button" class="formbutton" value="{lang mkey='delete_selected'}" name="del01" onclick="javascript: confdel(form);" />&nbsp;
						<input type="hidden" name="delete_selected" value="" />
						</td>
					</tr>
					<tr><td height="2"></td></tr>
					<tr>
						<td></td>
						<td>
						<input type="submit" class="formbutton" value="{lang mkey='changeto'}" name="groupaction" />&nbsp;
						<select name="txtmlevel">
							{html_options options=$mships}
						</select>
						</td>
					</tr>
				</table>
			</div>
		</form>
			<div class="line_outer">
				<img src="{$docroot}images/unread.jpg" border="0" alt="" /> {lang mkey='profile_not_confirmed_yet'}
			</div>
		</div>
		<div >
			{assign var="page_hdr02_text" value="{lang mkey='filter_records'}"}
			{include file="admin/admin_page_hdr02.tpl"}
			<div class="line_outer">
				<form action="profile.php" method="post" >
				<input type="hidden" name="filter" value="1" />
					<table width="100%" border="0" cellspacing="2" cellpadding="1" align="center">
						<tr>
							<td>
							{if $smarty.post.txtsrchat == '' }
								{lang mkey='search'}:&nbsp;<select name="txtsrchat">{html_options options=$filter_options selected="username"}</select>
							{else}
								{lang mkey='search'}:&nbsp;<select name="txtsrchat">{html_options options=$filter_options selected=$smarty.post.txtsrchat}</select>
							{/if}
								&nbsp;{lang mkey='criteria'}:&nbsp;<input type="text" class="textinput" name="txtsearch" size="30" value="{$smarty.post.txtsearch}" />&nbsp;
								<input type="submit" class="formbutton" value="{lang mkey='search'}" />
							</td>
						</tr>
					</table>
				</form>
			</div>
		</div>
	</div>
</div>
<form name="frmDelProfile" action="profile.php" method="get">
	<input type="hidden" name="txtdelete" value="" />
	<input type="hidden" name="frm" value="frmDelProfile" />
</form>
{/strip}