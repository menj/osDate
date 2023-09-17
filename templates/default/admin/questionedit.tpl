{strip}
<script type="text/javascript">
/* <![CDATA[ */
function checkMe(form)
{ldelim}
	if ( form.txtquestion.value == '' ){ldelim}
		alert("{lang mkey='errormsgs' skey=20}");
		return false;
	{rdelim}
	return true;
{rdelim}
/* ]]> */
</script>
{assign var="page_hdr01_text" value='<a href="section.php" class="subhead" >'|cat:"{lang mkey='section_title'}"|cat:'</a> > <a href="sectionquestions.php?sectionid='|cat:$data.section|cat:'" class="subhead">'|cat:"{lang mkey='questions_title'}"|cat:'</a>'}
{assign var="page_title" value="{lang mkey='section_title'} - "|cat:"{lang mkey='questions_title'}"}
{include file="admin/admin_page_hdr01.tpl"}
<div style="margin-top: 6px; text-align:left;">
	{assign var="page_hdr02_text" value="{lang mkey='modify_question'}"}
	{include file="admin/admin_page_hdr02.tpl"}
	<div class="module_detail_inside">
		<div class="line_outer">
		{if $error ne ""}
			{assign var="error_message" value=$error}
			{include file="display_error.tpl"}
		{/if}
		<form action="modifyquestion.php" method="post" onsubmit="javascript: return checkMe(this);">
			<input type="hidden" name="txtid" value="{$data.id}" />
			<table   cellspacing="{$config.cellspacing}" cellpadding="{$config.cellpadding}" width="100%" border="0">
			<tbody>
				<tr>
					<td width="30%">{lang mkey='id'}</td>
					<td>{$data.id}</td>
				</tr>
				<tr>
					<td>{lang mkey='question'}<font class="required_info">{$smarty.const.REQUIRED_INFO}</font></td>
					<td><input type="text" class="textinput"  value="{$data.question|stripslashes}" maxlength="255" size="50" name="txtquestion" /></td>
				</tr>
				<tr>
					<td>{lang mkey='description'}</td>
					<td><input type="text" class="textinput"  value="{$data.description|stripslashes}" maxlength="255" size="50" name="txtdescription" /></td>
				</tr>
				<tr>
					<td>{lang mkey='guideline'}</td>
					<td><input type="text" class="textinput"  value="{$data.guideline|stripslashes}" maxlength="255" size="50" name="txtguideline" /></td>
				</tr>
				<tr>
					<td>{lang mkey='control_type'}</td>
					<td>
						<select name="txtcontroltype">
							{html_options options=$lang.display_control_type selected=$data.control_type}
						</select>
					</td>
				</tr>
				{*if $data.control_type == "textarea" *}
				<tr>
					<td>{lang mkey='maxlength'}</td>
					<td><input type="text" class="textinput"  value="{$data.maxlength}" maxlength="3" size="4" name="txtmaxlength" /></td>
				</tr>
				{*/if*}
				<tr>
					<td>{lang mkey='mandatory'}</td>
					<td>
						<select name="txtmandatory">
						{html_options options=$lang.enabled_values selected=$data.mandatory}
						</select>
					</td>
				</tr>
				<tr>
					<td>{lang mkey='section'}</td>
					<td>
						<select name="txtsection">
						{html_options options=$allsections selected=$data.section}
						</select>
					</td>
				</tr>
				<tr>
					<td>{lang mkey='include_extsearch'}</td>
					<td>
						<select name="txtextsearch">
							{html_options options=$lang.enabled_values selected=$data.extsearchable}
						</select>
					</td>
				</tr>
				<tr>
					<td>{lang mkey='head_extsearch'}</td>
					<td><input type="text" class="textinput"  value="{$data.extsearchhead|stripslashes}" maxlength="255" size="50" name="txextsearchhead" /></td>
				</tr>
				<tr>
					<td>{lang mkey='sex'}</td>
					<td><select name="txtgender">
						<option value="A" {if $data.gender=='A'}SELECTED{/if}>{lang mkey="signup_gender_look" skey='A'}</option>
						{html_options options=$lang.signup_gender_values selected=$data.gender }
						</select>
					</td>
				</tr>
				<tr>
					<td>{lang mkey='enabled'}</td>
					<td><select name="txtenabled">
						{html_options options=$lang.enabled_values selected=$data.enabled}
						</select>
					</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td>
						<input type="submit" class="formbutton" value="{lang mkey='submit'}" />&nbsp;
						<input type="reset" class="formbutton" value="{lang mkey='reset'}" />
					</td>
				</tr>
			</tbody>
			</table>
		</form>
		</div>
	</div>
</div>
{/strip}