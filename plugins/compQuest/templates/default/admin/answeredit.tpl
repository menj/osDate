{strip}
{assign var="page_hdr01_text" value='<a href="plugin.php?plugin='|cat:$plugin_name|cat:'" class="subhead">'|cat:$lang.questionnaire_title_management|cat:'</a> > <a href="plugin.php?plugin='|cat:$plugin_name|cat:'&amp;do=showquestions&amp;section='|cat:$sid|cat:'" class="subhead">'|cat:$lang.show_questions|cat:'</a> > '}
{assign var="page_hdr01_text" value=$page_hdr01_text|cat:'<a href="plugin.php?plugin='|cat:$plugin_name|cat:'&amp;do=editquestion&amp;qid='|cat:$qid|cat:'" class="subhead">'|cat:$lang.question|cat:'</a>'}
{include file="admin/admin_page_hdr01.tpl"}
<div class="module_detail_inside top_margin_6px" style="width:100%">
			{assign var="page_hdr02_text" value=$lang.edit_answer}
			{include file="admin/admin_page_hdr02.tpl"}
      {if $error ne ""}
			{assign var="error_message" value=$error}
			{include file="display_error.tpl"}
      {/if}
      <form action="plugin.php?plugin={$plugin_name}&amp;do=editanswer" method="post">
        <input type="hidden" name="qcid" value="{$data.qcid}" />
			<table class="table" cellspacing="{$config.cellspacing}" cellpadding="{$config.cellpadding}" width="550" border="0">
	  		<tbody>
    			<tr>
	  				<td>{lang mkey='id'}</td>
	  				<td>{$data.qcid}</td>
	 			</tr>
	 			<tr>
	  				<td>{$lang.answer}:<font color="{lang mkey='required_info_indicator_color'}">{lang mkey='required_info_indicator'}</font></td>
	  				<td><input type="text" value="{$data.answer|stripslashes}" maxlength="255" size="50" name="answer" /></td>
	 			</tr>
				<tr>
					<td>&nbsp;</td>
					<td>
						<input type="submit" class="formbutton" value="{$lang.save}" name='edit2' />&nbsp;
						<input type="reset" class="formbutton" value="{lang mkey='reset'}" />
					</td>
				</tr>
  			</tbody>
			</table>
      </form>
</div>
{/strip}