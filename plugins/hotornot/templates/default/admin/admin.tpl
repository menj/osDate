{assign var="page_hdr01_text" value=$lang.user_title}
{include file="admin/admin_page_hdr01.tpl"}

<div class="module_detail_inside top_margin_6px" style="width:100%">
	{assign var="page_hdr02_text" value=$lang.select}
	{include file="admin/admin_page_hdr02.tpl"}
	<br/><span style="padding-left: 5px;">{$lang.desc6}</span><br/><span style="padding-left: 5px;">
	<a href="manageratings.php">{$lang.clickhere}</a> {$lang.desc7}</span><br/><br/>
				<table cellspacing="{$config.cellspacing}" cellpadding="{$config.cellpadding}" width="100%">
		<tbody>
		<tr>
			<td style="padding-left; 5px;">
			{if $error == 1}
				{assign var="error_message" value=$lang.error2}
				{include file="display_error.tpl"}
				<br/>
			{/if}
				<form action="plugin.php?plugin={$plugin_name}" method="post">
				<select name="rid">
					{foreach item=item key=key from=$data}
						<option value="{$item.id}" {if $item.id == $rid}selected{/if} >{$item.rating}</option>
					{/foreach}
				</select>
				<br/><br/><input type="submit" class="formbutton" value="{lang mkey="submit"}" />
				</form>
			</td>
		</tr>
		</tbody>
	</table>
	<br/>
</div>