{strip}
<script type="text/javascript">
/* <![CDATA[ */
function checkfornull(frm)
{ldelim}
	var val = frm.elements['txtquestion'].value;
	if (val == "")
	{ldelim}
		alert("{lang mkey='signup_js_errors' skey='question_noblank'}");
		return false;
	{rdelim}
	return true;
{rdelim}
/* ]]> */
</script>
<div class="module_detail"  style="width:99.9%;vertical-align:top;display:inline; float:left;" >
	{assign var="page_hdr01_text" value="{lang mkey='suggest_poll'}"}
	{assign var="page_title" value="{lang mkey='suggest_poll'}"}
	{include file="page_hdr01.tpl"}
	{if $error_msg != ''}
		{assign var="error_message" value=$error_msg }
		{include file="display_error.tpl" }
	{/if}
	<form name="question" action="poll.php" method="post" onsubmit="javascript: return checkfornull(this);">
			<table   cellspacing="{$config.cellspacing}"  cellpadding="{$config.cellpadding}">
				<tr>
					<td width="10%">
						{lang mkey='col_head_question'}:
					</td>
					<td width="90%">
						<input type="text" class="textinput"  name="txtquestion" value="{$txtquestion|stripslashes}" size="60" maxlength="250" {if $step eq 2}readonly="readonly"{/if}/>
					</td>
				</tr>
				<tr>
					<td colspan="2"></td>
				</tr>
				<tr>
					<td colspan="2" width="100%">
					{assign var="page_hdr01_text" value="{lang mkey='poll_options'}"}
					{include file="page_hdr01.tpl"}

						<table   cellspacing="{$config.cellspacing}"  cellpadding="{$config.cellpadding}">
							<tr>
								<td colspan="2">&nbsp;</td>
							</tr>
							<tr class="table_head">
								<th width="5%">{lang mkey='col_head_srno'}</th>
								<th width="95%">{lang mkey='option'}</th>
							</tr>
							{if $txtoptions|@count > 0}
							{assign var="mcount" value="0"}
							{assign var="classtype" value="oddrow"}
							{foreach name=pollopts key=idx from=$txtoptions item=opt}
							{math equation="$mcount+1" assign="mcount"}
								<tr class="classtype">
									<td width="5%">{$mcount}</td>
									<td width="95%"><input name="txtoptions[]" value="{$opt|stripslashes}" {if $saved eq 1}readonly{/if} size="80"/></td>
								</tr>
								{if $classtype eq "oddrow"}
								{assign var="classtype" value="evenrow"}
								{else}
								{assign var="classtype" value="oddrow"}
								{/if}
							{/foreach}
							{else}
								{math equation="$mcount+1" assign="mcount"}
								<tr class="classtype">
									<td width="5%">{$mcount}</td>
									<td width="95%"><input name="txtoptions[]" value="" size="80"/></td>
								</tr>
							{/if}
							{if $classtype eq "oddrow"}
							{assign var="classtype" value="evenrow"}
							{else}
							{assign var="classtype" value="oddrow"}
							{/if}
							{math equation="$mcount+1" assign="mcount"}
						{if $saved ne 1}
							<tr class="classtype">
								<td>{$mcount}</td>
								<td><input name="txtoptions[]" value="" size="80"/></td>
							</tr>
						{/if}
						</table>
					</td>
				</tr>
				{if $saved ne 1}
				<tr>
					<td colspan="2" align="center">
						<input name="action" value="{lang mkey='moreoptions'}" type="submit" class="formbutton"/>&nbsp;
						<input name="action" value="{lang mkey='savepoll'}" type="submit" class="formbutton"/>
					</td>
				</tr>
				{/if}
			</table>
        </form>
</div>
<div style="clear:both;"></div>
{/strip}
