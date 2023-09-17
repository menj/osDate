{strip}
<script type="text/javascript">
/* <![CDATA[ */

function confirmDelete(profileid,conmsg)
{ldelim}
  if (confirm(conmsg)){ldelim}
    document.frmDelForm.txtdelete.value=profileid;
    document.frmDelForm.submit();
  {rdelim}
{rdelim}
/* ]]> */
</script>
{assign var="page_hdr01_text" value='<a href="plugin.php?plugin='|cat:$plugin_name|cat:'" class="subhead">'|cat:$lang.user_title|cat:'</a> - > '|cat:$lang.showforms}
{include file="admin/admin_page_hdr01.tpl"}

<form name="frmDelForm" action="plugin.php?plugin={$plugin_name}&amp;showforms=0" method="post">
  <input type="hidden" name="txtdelete" value="" />
  <input type="hidden" name="frm" value="frmDelForm" />
</form>
<center>
<table width="100%" border="0" cellpadding="0" cellspacing="0" >
	<tr>
		<td class="module_detail_inside" width="100%">
		<br/>
			{assign var="ct" value=$data|@count}
			{assign var="page_hdr02_text" value=$lang.total_forms|cat:' '|cat:$ct}
			{include file="admin/admin_page_hdr02.tpl"}
			<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
				<tr>
					<td>
						<table width="100%" cellspacing="{$config.cellspacing}" cellpadding="{$config.cellpadding}" border="0">
							<tr class="table_head">
								<th width="3%">#</th>
   		  					    <th width="40%">{$lang.form_date}</th>
   		  					    <th width="25%">{$lang.malegen}</th>
   		  					    <th width="25%">{$lang.femalegen}</th>
			  					<th>{lang mkey='action'}</th>
							</tr>
							{assign var="n" value="0"}
						{foreach item=item key=key from=$data}
							{math equation="$n+1" assign="n" }
							<tr class="{cycle values="oddrow,evenrow"}">
			  					<td >{$n}</td>
			  					<td ><a href="plugin.php?plugin={$plugin_name}&amp;showforms={$item.id}">{$item.ts|date_format:$dateformat}</a></td>
			  					<td >{$item.male}</td>
			  					<td >{$item.female}</td>
								<td align="center"><a href="#" onclick="javascript:confirmDelete({$item.id},'{$lang.error3}')"><img src="images/button_drop.png" alt="Delete" border="0" /></a></td>
							</tr>
						{/foreach}
						</table>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
</center>
{/strip}