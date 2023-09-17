{strip}
<script language="JavaScript" type="text/javascript">
/* <![CDATA[ */
function checkMe(frm)
{ldelim}
	if (frm.txtoption.value == ''){ldelim}
		alert("{lang mkey='errormsgs' skey=20}");
		return false;
	{rdelim}
	return true;
{rdelim}
/* ]]> */
</script>
{assign var="page_hdr01_text" value='<a href="managepoll.php" class="subhead">'|cat:"{lang mkey='manage_polls'}"|cat:'</a> > <a href="polloptions.php?pollid='|cat:$data.pollid|cat:'" class="subhead">'|cat:"{lang mkey='poll_options'}"|cat:'</a>'}
{assign var="page_title" value="{lang mkey='manage_polls'} - "|cat:"{lang mkey='poll_options'}"}
{include file="admin/admin_page_hdr01.tpl"}
<div style="padding-top:6px; text-align:left;">
	{assign var="page_hdr02_text" value="{lang mkey='modify_option'}"}
	{include file="admin/admin_page_hdr02.tpl"}
	<div class="module_detail_inside">
		<div class="line_outer">
		  <form name="frmOptionEdit" method="post"  action="modifypolloption.php" onsubmit="javascript: return checkMe(this);">
			<input type="hidden" name="txtpollid" value="{$data.pollid}" />
			<input type="hidden" name="txtoptionid" value="{$data.optionid}" />
				<table   cellspacing="{$config.cellspacing}" cellpadding="{$config.cellpadding}" border="0" >
					<tr>
						<td colspan="2">{if $error ne ""}<font color="{lang mkey='admin_error_color'}">{$error}</font>{/if}</td>
					</tr>
					<tr>
						<td>{lang mkey='option'}:<font class="required_info">{$smarty.const.REQUIRED_INFO}</font></td>
						<td><input name="txtoption" type="text" class="textinput"  value="{$data.opt|stripslashes}" /></td>
					</tr>
					<tr>
						<td>{lang mkey='votes'}:</td>
						<td><input name="txtanswer" type="text" class="textinput"  value="{$data.result|stripslashes}" /></td>
					</tr>
					<tr>
						<td>{lang mkey='enabled'}</td>
						<td><select name="txtenabled" >
							<option value='Y' {if $data.enabled == 'y'} selected="selected" {/if}>{lang mkey='yes'} </option>
							<option value='N' {if $data.enabled != 'Y'} selected="selected" {/if}>{lang mkey='no'}</option>
							</select>
						</td>
					</tr>
					<tr>
						<td colspan="2" align="center"><input name="txtsave" type="submit" class="formbutton" value="{lang mkey='submit'}" />&nbsp;
						<input name="txtreset" type="reset" class="formbutton" value="{lang mkey='reset'}" />
						</td>
					</tr>
				</table>
		  </form>
		</div>
	</div>
</div>
{/strip}