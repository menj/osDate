{strip}
{assign var="page_hdr01_text" value='<a href="section.php" class="subhead">'|cat:"{lang mkey='section_title'}"|cat:'</a> >> <a href="sectionquestions.php?sectionid='|cat:$smarty.get.sectionid|cat:'" class="subhead">'|cat:"{lang mkey='questions_title'}"|cat:'</a> >> <a href="sectionquestiondetail.php?sectionid='|cat:$smarty.get.sectionid|cat:'&amp;questionid='|cat:$option.questionid|cat:'" class="subhead">'|cat:"{lang mkey='options_title'}"|cat:'</a>'}
{assign var="page_title" value="{lang mkey='section_title'} - "|cat:"{lang mkey='questions_title'} - "|cat:"{lang mkey='options_title'}"}
{include file="admin/admin_page_hdr01.tpl"}
<div class="top_margin_6px" style="text-align:left;">
	{assign var="page_hdr02_text" value="{lang mkey='question'} "|cat:$question.question}
	{include file="admin/admin_page_hdr02.tpl"}
	<br />
	{assign var="page_hdr02_text" value="{lang mkey='modify_option'}"}
	{include file="admin/admin_page_hdr02.tpl"}
	<div class="module_detail_inside">
		<div class="line_outer">
		{ if $error != ''}
			{assign var="error_message" value=$error}
			{include file="display_error.tpl"}
		{/if}
		<form name="frmOptionEdit" method="post"  action="modifyoption.php">
		<input type="hidden" name="txtsectionid" value="{$smarty.get.sectionid}" />
		<input type="hidden" name="questionid" value="{$smarty.get.questionid}" />

			<table class="table" cellspacing="{$config.cellspacing}" cellpadding="{$config.cellpadding}" border="0" >
				<tr>
					<td>{lang mkey='id'}</td>
					<td>{$option.id}<input type="hidden" name="txtid" value="{$option.id}" /></td>
				</tr>
				<tr>
					<td>{lang mkey='answer'}:<font class="required_info">{$smarty.const.REQUIRED_INFO}</font></td>
					<td><input name="txtanswer" type="text" class="textinput"  value="{$option.answer|stripslashes}" /></td>
				</tr>
				<tr>
					<td>{lang mkey='enabled'}</td>
					<td><select name="txtenabled" >
						<option value="Y" {if $option.enabled == 'Y'} selected {/if}>{lang mkey='yes'} </option>
						<option value="N" {if $option.enabled != 'Y'} selected {/if} >{lang mkey='no'}</option>
						</select>
					</td>
				</tr>
				<tr>
					<td colspan="2" align="center">
						<input name="txtsave" type="submit" class="formbutton" value="{lang mkey='submit'}" />
					</td>
				</tr>
			</table>
		</form>
		</div>
	</div>
</div>
{/strip}