{strip}
{assign var="page_hdr01_text" value="<a href=\"load_language.php\">{lang mkey='manage_languages'}"|cat:"</a> > "|cat:"{lang mkey='viewedit_lang'}"|cat:"{lang mkey='for'}"|cat:$language_options[$langname]}
{assign var="page_title" value="{lang mkey='manage_languages'} > "|cat:"{lang mkey='viewedit_lang'}"|cat:"{lang mkey='for'}"|cat:$language_options[$langname]}
{include file="admin/admin_page_hdr01.tpl"}
<div style="text-align:left; width:100%;">
	<div class="module_detail_inside" style="padding-left:6px;">
		<div style="padding-top:3px; margin-bottom:3px;">
			{if $langnotloaded_descr != ''}
				{assign var="error_message" value=$langnotloaded_descr}
				{include file="display_error.tpl"}
			{/if}
			<div style="display:inline; float:left; vertical-align:top;">
			<form method="post" action="">
				<input type="hidden" name="langname" value="{$langname}" />
				{lang mkey="mainkey"}:
				<input name="srch" size="30" maxlength="120" />
				&nbsp;
				<input class="formbutton" type="submit" name="vieweditlang" value="{lang mkey='search'}" />
			</form>
			</div>
			<div style="display:inline; float:right; vertical-align:top; padding-right:5px;" >
				<form action="" method="get">
				<input type="hidden" name="vieweditlang" value="listing" />
				<input name="langname" value="{$langname}" type="hidden" />
				{lang mkey='results_per_page'}&nbsp;
				<select name="results_per_page">
					{html_options options=$lang.search_results_per_page selected=$psize}
				</select>&nbsp;
				<input type="submit" class="formbutton" value="{lang mkey='show'}" />
				&nbsp;&nbsp;
				</form>
			</div>
			<div style="clear:both;"></div>
		</div>
		<table cellspacing="0" cellpadding="0" width="95%">
			<tr class="column_head">
				<th align="left" style="padding-left:6px;">{lang mkey='mainkey'}</th>
				<th align="left">{lang mkey='subkey'}</th>
				<th align="left" style="padding-right:4px;">{lang mkey='action'}</th>
			</tr>
			<tr class="column_head">
				<th  colspan="3" style="padding-left: 6px;">{lang mkey='description'}</th>
			</tr>
		{assign var="rowcnt" value=1}
		{foreach item=item key=key from=$langdefs}
			{if $cls == 'oddrow'}
				{assign var="cls" value="evenrow"}
			{else}
				{assign var="cls" value="oddrow"}
			{/if}
			<tr class="{$cls}" id="row_{$rowcnt}">
				<td width="50%">{$item.mainkey}</td>
				<td width="45%"  >{$item.subkey}</td>
				<td  width="5%" >
				<a href="?vieweditlang=delete&amp;langname={$langname}&amp;mainkey={$item.mainkey|urlencode}&amp;subkey={$item.subkey|urlencode}"><img src="images/button_drop.png" alt="Edit" border="0" /></a>
				</td>
			</tr>
			<tr class="{$cls}">
				<td colspan="2" style="margin-top:2px; margin-bottom:3px;" >
					<textarea cols="70" id="descr_{$rowcnt}" >{$item.descr|stripslashes|escape:"UTF8"}</textarea>
				</td>
				<td >
					<form id="frm_{$rowcnt}" method="post" action="" onSubmit="document.forms['frm_{$rowcnt}'].descr.value=document.getElementById('descr_{$rowcnt}').value; this.form.submit();">
						<input name="vieweditlang" value="{lang mkey='save'}" type="hidden" />
						<input name="mainkey" value="{$item.mainkey}" type="hidden" />
						<input name="subkey" value="{$item.subkey}" type="hidden" />
						<input name="descr" value="" type="hidden" />
						<input name="langname" value="{$langname}" type="hidden" />
						<input type="submit" class="formbutton" value="{lang mkey='save'}" />
						<input type="hidden" name="page" value="{$cpage}" />
					</form>
				</td>
			</tr>
			<tr><td style="height:5px;"></td></tr>
			{assign var="rowcnt" value=$rowcnt+1}
		{/foreach}
		</table>
		{if $pages neq ""}
			<div class="line_top_bottom_pad" style="padding-top:5px; text-align:center;">
			{if $prev != "" }
				<a href="?page={$prev}&amp;langname={$langname}{if $srch != ''}&amp;srch={$srch}&amp;vieweditlang={lang mkey='search'}{else}&amp;vieweditlang=listing{/if}" ><-- {lang mkey='previous'}<a/>&nbsp;
			{/if}
			{if $cpage != "" && $pages != "" }
				{lang mkey='pageno'}{$cpage}{lang mkey='of'}{$pages}
			{/if}
			{if $next != "" }
				&nbsp;<a href="?page={$next}&amp;langname={$langname}{if $srch != ''}&amp;srch={$srch}&amp;vieweditlang={lang mkey='search'}{else}&amp;vieweditlang=listing{/if}">{lang mkey='next'} --></a>
			{/if}
			</div>
		{/if}
	</div>
</div>
<script type="text/javascript">
function saveDescr(descrcnt,mainkey, subkey){ldelim}
	var frm = getElementById('save_descr');
	frm.mainkey.value=mainkey;
	frm.subkey.value=subkey;
	frm.descr.value=document.getElementById('descr_'+descrcnt).value;
alert("here");
	frm.submit();
{rdelim}
</script>
<form name="save_descr" action="" method="post">
	<input name="vieweditlang" value="{$lang mkey='save'}" type="hidden" />
	<input name="mainkey" value="" type="hidden" />
	<input name="subkey" value="" type="hidden" />
	<input name="descr" value="" type="hidden" />
	<input name="langname" value="{$langname}" type="hidden" />
</form>
{/strip}