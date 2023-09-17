{strip}
<div  style="vertical-align:top;" >
{assign var="page_hdr01_text" value="{lang mkey='section_blog_title'}"}
{assign var="page_title" value="{lang mkey='section_blog_title'}"}
{include file="admin/admin_page_hdr01.tpl"}
<div class="module_detail_inside"  style="padding-top:1px;">
	{if $error_message neq ""}
		{include file="display_error.tpl" }
	{/if}
	<form name="frmEditPref" method="post" action="bloglist.php">
	<input type="hidden" name="action" value="multiple_delete" />
		<div >
			{assign var="blog_nav_opt" value="list"}
			{include file="blog_nav.tpl"}
		{ if $list }
			<div class="module_detail_inside line_top_bottom_pad">
				{assign var="page_hdr02_text" value="{lang mkey='blog_subtitle_list'}"}
				{include file="admin/admin_page_hdr02.tpl"}
				<div class="line_outer">
					<table width="100%" border="0" cellspacing="{$config.cellspacing}" cellpadding="{$config.cellpadding}">
						<tr class="column_head">
							<th width="5%"><input type="checkbox" name="chkall" value="" onclick="checkAll(this.form,'delete[]',this.checked)" /><input type="hidden" name="act" value="{$act}" /></th >
							<th width="5%">{lang mkey='blog_number'}</th>
							<th width="5%" align="center">{$sort_blog_views}</th>
							<th width="5%" align="center">{$sort_blog_ratings}</th>
							<th width="50%">{$sort_blog_title}</th>
							<th width="15%">{$sort_date_posted} </th>
							<th width="10%">{lang mkey='action'}</th>
						</tr>
						{assign var="mcount" value="0"}
						{foreach item=item key=key from=$list}
						{math equation="$mcount+1" assign="mcount"}
						<tr class="{cycle  values="oddrow,evenrow"}">
							<td >
								<input type="checkbox" name="delete[]" value="{$item.id}" /></td>
							<td>{$mcount}</td>
							<td>{$item.views}</td>
							<td align="center">{$item.votes} / {$item.num_votes}</td>
							<td>
								<a href="viewmyblog.php?id={$item.id}">{$item.short_title}</a></td>
							<td>{$item.date_posted|date_format:$lang.DATE_FORMAT}</td>
							<td>
								<a href="editblog.php?id={$item.id}"><img alt="" src="images/button_edit.png" border="0" /></a>
								&nbsp;
								<a href="bloglist.php?id={$item.id}&amp;action=delete" onclick="return confirmLink(this, '{lang mkey="blog" skey="del02"} blog entry?')"><img alt="" src="images/button_drop.png" border="0" /></a>
							</td>
						</tr>
						{/foreach}
						<tr>
							<td colspan="7" align="left">
								<img src="images/arrow_ltr.png" alt="" />{lang mkey='with_selected'}&nbsp;
								<input type="submit" class="formbutton" value="{lang mkey='delete_selected'}" name="groupaction" onclick="return confirmButton('{lang mkey="blog" skey="del02"} blog entries?')" />
							</td>
						</tr>
					</table>
				</div>
			</div>
		{ else }
			<div class="line_outer">
				{lang mkey='no_blog_found'}</td>
			</div>
		{/if}
		</div>
	</form>
	</div>
</div>
<br />
{/strip}
