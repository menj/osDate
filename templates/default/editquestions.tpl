{strip}
<form name="{$frmname}" method="post" action="modifyquestion.php">
<input type="hidden" name="sectionid" value="{$sectionid}" />
<input type="hidden" id="reqsectionid" name='reqsectionid' value="" />
<div style="vertical-align:top;" >
	{assign var="page_hdr01_text" value=$head}
	{assign var="page_title" value=$head}
	{include file="page_hdr01.tpl"}
	<div class="module_detail_inside">
	{if $mandatory_question_error != ''}
		{assign var="error_message" value=$mandatory_question_error}
		{include file="display_error.tpl"}	
	{/if}
	<div class="line_outer">
		<table width="100%" border="0" cellpadding="3" cellspacing="1" >
			<tr >
	{* Create menu from sections table *}
	{assign var="cn" value=1}
			{foreach key=key item=item from=$sections}
				<td align="center" class='edituserlink' height="23">
					{if $key != $sectionid}
						<a href="#" onclick="document.getElementById('reqsectionid').value={$key}; document.forms['{$frmname}'].submit();"  class='edituserlink'>
					{/if}
					{$item}
					{if $key != $sectionid}
						</a>
					{/if}
				</td>
				{assign var="cn" value=$cn+1}
				{if $cn == 6 && $sections|@count > 5 }
					</tr>
					<tr>
					{assign var="cn" value=1}
				{/if}
			{/foreach}
			</tr>
		</table>
	</div>
	<div class="line_outer">
{*Outer Loop to traverse outer dimension data array*}
{foreach item=questionrow from=$data}
	{if $questionrow.control_type == "select"}
		<table   border="0" cellspacing="{$config.cellspacing}" cellpadding="{$config.cellpadding}">
			<tr>
				 <td width="200" valign="top">
						<b>{$questionrow.question|stripslashes}</b>
					{if $questionrow.mandatory == 'Y'}
						<font class="required_info">{$smarty.const.REQUIRED_INFO}</font>
					{/if}
						<br/>
					{if $questionrow.description != NULL}
						{$questionrow.description|stripslashes}
					{/if}
				</td>
				<td width="290" valign="top">
					<input type="hidden" name="selected_questions[]" value="{$questionrow.id}" />
					<select name="{$questionrow.id}{$questionrow.mandatory}">
						{if $questionrow.mandatory != 'Y'}																<option value="0">{lang mkey='tell_later'}</option>
						{/if}
						{html_options options=$questionrow.options selected=$questionrow.userpref}
					</select>
				</td>
			</tr>
		</table>
	{elseif $questionrow.control_type == "radio"}
		<table   border="0" cellspacing="{$config.cellspacing}" cellpadding="{$config.cellpadding}">
			<tr>
				<td width="200" valign="top">
					<b>{$questionrow.question|stripslashes}</b>
				{if $questionrow.mandatory == 'Y'}
					<font class="required_info">{$smarty.const.REQUIRED_INFO}</font>
				{/if}
					<br/>
				{if $questionrow.description != NULL}
					{$questionrow.description|stripslashes}
				{/if}
				</td>
				<td width="290" valign="top">
					<input type="hidden" name="selected_questions[]" value="{$questionrow.id}" />
					{foreach name="iterator"  key=key  item=curropt from=$questionrow.options}
						<table cellspacing="0" cellpadding="0" border="0" width="100%">
							<tr>
								<td width="8" valign="top" align="left">
								{if $key == $questionrow.userpref[0]}
									<input type="radio" name="{$questionrow.id}{$questionrow.mandatory}"  value="{$key}" checked />
								{else}
									<input  type="radio" name="{$questionrow.id}{$questionrow.mandatory}" value="{$key}" />
								{/if}
								</td>
								<td width="100%" valign="middle">
								{$curropt|stripslashes}
								</td>
							</tr>
						</table>
					{/foreach}
				</td>
			</tr>
		</table>
	{elseif $questionrow.control_type == "checkbox"}
		<table   border="0" cellspacing="{$config.cellspacing}" cellpadding="{$config.cellpadding}">
			<tr>
				<td width="200" valign="top">
					<b>{$questionrow.question|stripslashes}</b>
					{if $questionrow.mandatory == 'Y'}
						<font class="required_info">{$smarty.const.REQUIRED_INFO}</font>
					{/if}
					<br/>
					{if $questionrow.description != NULL}
						{$questionrow.description|stripslashes}
					{/if}
				</td>
				<td width="290" valign="top">
				{if $questionrow.userpref|@count > 0}
					<input type="hidden" name="selected_questions[]" value="{$questionrow.id}" />
				{/if}
				{foreach name="iterator1"  key=key  item=curropt from=$questionrow.options}
					<table cellspacing="0" cellpadding="0" border="0" width="100%">
						<tr>
							<td width="8" valign="middle">
								<input type="checkbox" name="{$questionrow.id}{$questionrow.mandatory}[]"  value="{$key}" 																	{foreach from=$questionrow.userpref key=ky item=itm}
								{if $key == $itm}
									checked=true
								{/if}
								{/foreach}
								  />
							</td>
							<td width="100%" valign="middle">
								{$curropt|stripslashes}
							</td>
						</tr>
					</table>
				{/foreach}
				</td>
			</tr>
		</table>
	{elseif $questionrow.control_type == "textarea"}
		<table   width="440" border="0" cellspacing="{$config.cellspacing}" cellpadding="{$config.cellpadding}">
			<tr>
				<td  align="left" valign="top">
					<b>{$questionrow.question|stripslashes}</b>
					{if $questionrow.mandatory == 'Y'}
					<font class="required_info">{$smarty.const.REQUIRED_INFO}</font>
					{/if}
					<br/>
					{if $questionrow.description != NULL}
						{$questionrow.description|nl2br|stripslashes}
					{/if}
				</td>
			</tr>
			<tr>
				<td>
				{if count_chars($questionrow.userpref[0]) > 0}
					<input type="hidden" name="selected_questions[]" value="{$questionrow.id}" />
				{/if}
					<textarea name="{$questionrow.id}{$questionrow.mandatory}" rows="7" cols="50" >{$questionrow.userpref[0]|stripslashes }</textarea>
				</td>
			</tr>
		</table>
	{/if}
			<br />
{/foreach}
		<div class="line_outer" align="center">
			<input type="submit" class="formbutton" value="{lang mkey='submit'}" /> <input type="reset" class="formbutton" value="{lang mkey='reset'}" />
		</div>
		<br />
	</div>
	</div>
</div>
</form>
<br />

{/strip}
