{strip}
{assign var="page_hdr01_text" value='<a href="plugin.php?plugin='|cat:$plugin_name|cat:'" class="subhead">'|cat:$lang.questionnaire_title_management|cat:'</a> > '|cat:$lang.edit_section}
{include file="admin/admin_page_hdr01.tpl"}
<div class="module_detail_inside top_margin_6px" style="width:100%">
	{assign var="page_hdr02_text" value=$lang.edit_section}
	{include file="admin/admin_page_hdr02.tpl"}
      <form action="plugin.php?plugin={$plugin_name}&amp;do=editsection" method="post">
        <input type="hidden" name="section" value="{$data.sid}" />
      {if $error==1}
			<font color="{lang mkey='admin_error_color'}" style="margin-left:10px"><b>{$lang.error2}</b></font>
      {/if}
			<table class="table" cellspacing="{$config.cellspacing}" cellpadding="{$config.cellpadding}" width="550" border="0">
	  		<tbody>
    			<tr>
	  				<td>{lang mkey='id'}</td>
	  				<td>{$data.sid}</td>
	 			</tr>
	 			<tr>
	  				<td>{lang mkey='name'}<font color="{lang mkey='required_info_indicator_color'}">{lang mkey='required_info_indicator'}</font></td>
	  				<td><input type="text" value="{$data.title|stripslashes}" maxlength="255" size="50" name="title" /></td>
	 			</tr>
				<tr>
					<td>&nbsp;</td>
					<td>
						<input type="submit" class="formbutton" value="{lang mkey='submit'}" name='edit' />&nbsp;
						<input type="reset" class="formbutton" value="{lang mkey='reset'}" />
					</td>
				</tr>
  			</tbody>
			</table>
      </form>
</div>
{/strip}