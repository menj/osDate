{strip}
<script type="text/javascript">
/* <![CDATA[ */
{literal}

function dis()
{
	if(document.addqform.type.value==1)
	{
		document.addqform.minopt.disabled=true;
		document.addqform.showopt.disabled=true;
	}
		if(document.addqform.type.value==2)
	{
		document.addqform.minopt.disabled=false;
		document.addqform.showopt.disabled=false;
	}
}

{/literal}
/* ]]> */
</script>
{assign var="page_hdr01_text" value='<a href="plugin.php?plugin='|cat:$plugin_name|cat:'" class="subhead">'|cat:$lang.questionnaire_title_management|cat:'</a>'}
{include file="admin/admin_page_hdr01.tpl"}
<div class="module_detail_inside top_margin_6px" style="width:100%">
	{var page_hdr02_text='<a href="plugin.php?plugin='|cat:$plugin_name|cat:'&amp;do=showquestions&amp;section='|cat:$data.sid|cat:'" class="subhead">'|cat:$lang.show_questions|cat:'</a>  '}
	{include file="admin/admin_page_hdr02.tpl"}
	<br />
			{assign var="page_hdr02_text" value=$lang.add_question}
			{include file="admin/admin_page_hdr02.tpl"}
      {if $error==1}
      		{assign var="error_message" value=$lang.error2}
      		{include file="display_error.tpl"}
      	{/if}
      <form action="plugin.php?plugin={$plugin_name}&amp;do=addquestion&amp;add=1" name="addqform" method="post" >
        <input type="hidden" name="section" value="{$data.sid}" />
			<table class="table" cellspacing="{$config.cellspacing}" cellpadding="{$config.cellpadding}" width="550" border="0">
	  		<tbody>
    			<tr>
	  				<td>{$lang.section}</td>
	  				<td>{$data.title}</td>
	 			</tr>
	 			<tr>
	  				<td>{$lang.question}<font color="{lang mkey='required_info_indicator_color'}">{lang mkey='required_info_indicator'}</font></td>
	  				<td><textarea name="question" cols="60" rows="3">{$data2.question }</textarea></td>
	 			</tr>
	 			<tr>
	  				<td>{$lang.descr}<font color="{lang mkey='required_info_indicator_color'}">{lang mkey='required_info_indicator'}</font></td>
	  				<td><textarea name="descr" cols="60" rows="3">{$data2.descr }</textarea></td>
	 			</tr>
    			<tr>
	  				<td>{$lang.type}</td>
	  				<td><select name="type" onchange="dis()"><option value='1'>{$lang.questiontype1}</option><option value='2'>{$lang.questiontype2}</option></select></td>
	 			</tr>
	 			<tr>
	  				<td>{$lang.minopt}</td>
	  				<td><input type="text" size="4" name="minopt" {if $data2.type==2}value="{$data2.minopt}"{/if} disabled /></td>
	 			</tr>
    			<tr>
	  				<td>{$lang.maxopt}<font color="{lang mkey='required_info_indicator_color'}">{lang mkey='required_info_indicator'}</font></td>
	  				<td><input type="text" size="4" name="maxopt" value="{$data2.maxopt}" />{$lang.maxopt_two}</td>
	 			</tr>
    			<tr>
	  				<td>{$lang.showopt}</td>
	  				<td><input type="text" size="4" name="showopt" {if $data2.type==2}value="{$data2.showopt}"{/if} disabled /></td>
	 			</tr>
				<tr>
					<td>&nbsp;</td>
					<td>
						<input type="submit" class="formbutton" value="{$lang.add}" name='edit' />&nbsp;
						<input type="reset" class="formbutton" value="{lang mkey='reset'}" />
					</td>
				</tr>
  			</tbody>
			</table>
      </form>
</div>
{/strip}