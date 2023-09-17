{strip}
<script type="text/javascript">
/* <![CDATA[ */
function validate(form)
{ldelim}
	ErrorCount=0;
	ErrorMsg = new Array();
	ErrorMsg[0]="------------------------- The Following Errors Occured -------------------------" + String.fromCharCode(13);

	CheckFieldString("noblank",form.txtquestion,"{lang mkey='signup_js_errors' skey='question_noblank'}");
	CheckFieldString("noblank",form.txtmaxlength,"{lang mkey='signup_js_errors' skey='maxlength_noblank'}");

	CheckFieldString("full",form.txtquestion,"{lang mkey='signup_js_errors' skey='question_charset'}");
	CheckFieldString("full",form.txtdescription,"{lang mkey='signup_js_errors' skey='description_charset'}");
	CheckFieldString("full",form.txtguideline,"{lang mkey='signup_js_errors' skey='guideline_charset'}");
	CheckFieldString("integer",form.txtmaxlength,"{lang mkey='signup_js_errors' skey='maxlength_charset'}");
	CheckFieldString("full",form.txextsearchhead,"{lang mkey='signup_js_errors' skey='extsearchhead_charset'}");

	if (form.txtextsearch.value == 'Y' && form.txextsearchhead.value == '')
	{ldelim}
		ErrorCount ++;
		ErrorMsg[1] = "{lang mkey='admin_js__delete_error_msgs' skey='16'}";
	{rdelim}
	result="";
	if( ErrorCount > 0)
	{ldelim}
		alert(ErrorMsg[1]);
		return false;
	{rdelim}
	return true;
{rdelim}
/* ]]> */
</script>
{assign var="page_hdr01_text" value='<a href="section.php" class="subhead">'|cat:"{lang mkey='section_title'}"|cat:'</a>'}
{assign var="page_title" value="{lang mkey='section_title'}"}
{include file="admin/admin_page_hdr01.tpl"}
<div class="top_margin_6px" style="text-align:left;">
	{assign var="page_hdr02_text" value="{lang mkey='section'}  "|cat:$sectionname:stripslashes|cat:' &nbsp;>> &nbsp;'|cat:"{lang mkey='insert_question'}"}
	{include file="admin/admin_page_hdr02.tpl"}
	<div class="module_detail_inside">
		<div class="line_outer">
		{ if $error != ''}
			{assign var="error_message" value=$error}
			{include file="display_error.tpl"}
		{/if}
			<form action="insquestion.php" method="post"  onsubmit="javascript:return validate(this);">
			<input type="hidden" name="txtid" value="{$data.id}" />
				<table   cellspacing="{$config.cellspacing}" cellpadding="{$config.cellpadding}" width="100%" border="0">
				<tbody>
					<tr>
						<td width="30%">{lang mkey='question'}<font class="required_info">{$smarty.const.REQUIRED_INFO}</font></td>
						<td><input type="text" class="textinput"  maxlength="255" size="50" name="txtquestion" /></td>
					</tr>
					<tr>
						<td>{lang mkey='description'}</td>
						<td><input type="text" class="textinput"  maxlength="255" size="50" name="txtdescription" /></td>
					</tr>
					<tr>
						<td>{lang mkey='guideline'}</td>
						<td><input type="text" class="textinput"   maxlength="255" size="50" name="txtguideline" /></td>
					</tr>
					<tr>
						<td>{lang mkey='control_type'}</td>
						<td>
							<select name="txtcontroltype">
							{html_options options=$lang.display_control_type }
							</select>
						</td>
					</tr>
					<tr>
						<td>{lang mkey='maxlength'}</td>
						<td><input type="text" class="textinput"  value="0" maxlength="3" size="4" name="txtmaxlength" /></td>
					</tr>
					<tr>
						<td>{lang mkey='mandatory'}</td>
						<td>
							<select name="txtmandatory">
							{html_options options=$lang.enabled_values }
							</select>
						</td>
					</tr>
					<tr>
						<td>{lang mkey='section'}</td>
						<td>
							<select name="txtsection">
							{html_options options=$allsections selected=$smarty.get.sectionid}
							</select>
						</td>
					</tr>
					<tr>
						<td>{lang mkey='include_extsearch'}</td>
						<td>
							<select name="txtextsearch">
							{html_options options=$lang.enabled_values }
							</select>
						</td>
					</tr>
					<tr>
						<td>{lang mkey='head_extsearch'}<font class="required_info">{$smarty.const.REQUIRED_INFO}</font></td>
						<td><input type="text" class="textinput"  maxlength="255" size="50" name="txextsearchhead" /></td>
					</tr>
					<tr>
						<td>{lang mkey='sex'}</td>
						<td><select name="txtgender">
							<option value="A" {if $txtgender==''}SELECTED{/if}>{lang mkey="signup_gender_look" skey='A'}</option>
							{html_options options=$lang.signup_gender_values selected=$txtgender }
							</select>
						</td>
					</tr>
					<tr>
						<td>{lang mkey='enabled'}</td>
						<td><select name="txtenabled">
							{html_options options=$lang.enabled_values }
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