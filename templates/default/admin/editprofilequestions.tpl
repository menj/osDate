{strip}
{assign var="page_hdr01_text" value="{lang mkey='modify_profile'}"|cat:"{lang mkey='of'}"|cat:$username|cat:'&nbsp;(ID:&nbsp;'|cat:$smarty.get.edit|cat:')'}
{assign var="page_title" value="{lang mkey='modify_profile'}"}
{include file="admin/admin_page_hdr01.tpl"}
<div class="module_detail_inside" style="padding-top:6px;">
	{if $mandatory_question_error != ''}
		{assign var="error_message" value="{$mandatory_question_error}" }
		{include file="display_error.tpl" }
	{/if}
	{include file="admin/editprofilelinks.tpl"}
	<div style="margin-top:6px">
		{assign var="page_hdr02_text" value=$head|stripslashes}
		{include file="admin/admin_page_hdr02.tpl"}
	</div>
	<div class="line_outer">
		<form name="{$frmname}" method="post" action="modifyprofilequestion.php">
			<input type="hidden" name="sectionid" value="{$sectionid}" />
			<input type="hidden" name="edit" value="{$smarty.get.edit}" />
			<input type="hidden" id="reqsectionid" name="reqsectionid" value="" />
			{*Outer Loop to traverse outer dimension data array*}
			{foreach item=questionrow from=$data}
				{if $questionrow.question != '' }
					{if $questionrow.control_type == "select"}
						<div class="line_top_bottom_pad" style="vertical-align:top;">
							<div style="width:48%; display:inline; float:left; margin-right: 5px;">
								<b>{$questionrow.question}</b>
								{if $questionrow.mandatory == 'Y'}
								<font class="required_info">{$smarty.const.REQUIRED_INFO}</font>
								{/if}
								<br/>
								{if $questionrow.description != NULL}
									{$questionrow.description|stripslashes}
								{/if}
							</div>
							<div style="display:inline; float:left; margin-right: 5px; width:50%;">
								<input type="hidden" name="selected_questions[]" value="{$questionrow.id}" />
								<select name="{$questionrow.id}{$questionrow.mandatory}" class="select" style="width: 100px">
								<option value="0">{lang mkey='tell_later'}</option>
								{html_options options=$questionrow.options selected=$questionrow.userpref}
								</select>
							</div>
							<div style="clear:both;"></div>
						</div>
					{elseif $questionrow.control_type == "radio"}
						<div class="line_top_bottom_pad" style="vertical-align:top;">
							<div style="width:48%; display:inline; float:left; margin-right: 5px;">
								<b>{$questionrow.question}</b>
								{if $questionrow.mandatory == 'Y'}
									<font color="{lang mkey='required_info_indicator_color'}">{lang mkey='required_info_indicator'}</font>
								{/if}
								<br/>
								{if $questionrow.description != NULL}
									{$questionrow.description|stripslashes}
								{/if}
							</div>
							<div style="display:inline; float:left; margin-right: 5px; width:50%;">
								<input type="hidden" name="selected_questions[]" value="{$questionrow.id}" />
								{foreach name="iterator" key=key item=curropt from=$questionrow.options}
									<table border="0"  cellspacing="0" cellpadding="0">
										<tr>
											<td width="8" valign="bottom">
											{if $key == $questionrow.userpref[0]}
												<input name="{$questionrow.id}{$questionrow.mandatory}" type="radio" value="{$key}" checked="checked" />
											{else}
												<input name="{$questionrow.id}{$questionrow.mandatory}" type="radio" value="{$key}" />
											{/if}
											</td>
											<td valign="middle">
												{$curropt|stripslashes}
											</td>
										</tr>
									</table>
								{/foreach}
							</div>
							<div style="clear:both;"></div>
						</div>
					{elseif $questionrow.control_type == "checkbox"}
						<div class="line_top_bottom_pad" style="vertical-align:top;">
							<div style="width:48%; display:inline; float:left; margin-right: 5px;">
								<b>{$questionrow.question|stripslashes}</b>
								{if $questionrow.mandatory == 'Y'}
								<font class="required_info">{$smarty.const.REQUIRED_INFO}</font>
								{/if}
								<br/>
								{if $questionrow.description != NULL}
								{$questionrow.description|stripslashes}
								{/if}
							</div>
							<div style="display:inline; float:left; margin-right: 5px; width:50%;">
								{if $questionrow.userpref|@count > 0}
								<input type="hidden" name="selected_questions[]" value="{$questionrow.id}" />
								{/if}
								{foreach name="iterator" key=key item=curropt from=$questionrow.options}
									<table border="0"  cellspacing="0" cellpadding="0">
										<tr>
											<td width="8" valign="middle">
												<input type="checkbox" name="{$questionrow.id}{$questionrow.mandatory}[]"  value="{$key}" 																	{foreach from=$questionrow.userpref key=ky item=itm}
												{if $key == $itm}
													checked="checked"
												{/if}
												{/foreach}
												/>
											</td>
											<td valign="middle">
												{$curropt|stripslashes}
											</td>
										</tr>
									</table>
								{/foreach}
							</div>
							<div style="clear:both;"></div>
						</div>
					{elseif $questionrow.control_type == "textarea"}
						<div class="line_top_bottom_pad" style="vertical-align:top;">
							<div style="width:48%; display:inline; float:left; margin-right: 5px;">
								<b>{$questionrow.question}</b>
								{if $questionrow.mandatory == 'Y'}
								<font class="required_info">{$smarty.const.REQUIRED_INFO}</font>
								{/if}
								<br/>
								{if $questionrow.description != NULL}
								{$questionrow.description|nl2br|stripslashes}
								{/if}
							</div>
							<div style="display:inline; float:left; margin-right: 5px; width:50%;">
							{if count_chars($questionrow.userpref[0]) > 0}
								<input type="hidden" name="selected_questions[]" value="{$questionrow.id}" />
							{/if}
								<textarea name="{$questionrow.id}{$questionrow.mandatory}" rows="7" cols="39" >{$questionrow.userpref[0]|nl2br|stripslashes }</textarea>
							</div>
							<div style="clear:both;"></div>
						</div>
					{/if}
				{/if}
			{/foreach}
			<div class="line_top_bottom_pad" align=center>
				<input type="submit" value="Save" class="formbutton" />&nbsp;
				<input type="reset" value="Reset" class="formbutton" />
			</div>
		</form>
	</div>
</div>
{/strip}