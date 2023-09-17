{strip}
<div  style="vertical-align:top;" >
	{assign var="page_hdr01_text" value="{lang mkey='mysettings'}"}
	{assign var="page_title" value="{lang mkey='mysettings'}"}
	{include file="page_hdr01.tpl"}
	<div class="module_detail_inside">

	{if $error != ''}
		{assign var="error_message" value=$error }
		{include file="display_error.tpl"}
	{/if}
		<form name="userchoices" action="mysettings.php" method="post" >
			<input name="act" value="{$act}" type="hidden" />
		{foreach from=$lang.user_choices key=choice_key item=user_choice_descr }
			{cycle values="oddrow,evenrow" assign="class"}
				<div class="{$class} signup_line_outer" >
					<div style="width:78%;  display:inline; float:left; vertical-align:middle;" >
						{$user_choice_descr}
					</div>
				{if $choice_key != 'email_match_mail_days'}
					<div style="display:inline; float:left;width:6px;vertical-align:middle;">
						<input type="radio" name="{$choice_key}" value="1" CHECKED />
					</div>
					<div style="display:inline; float:left;margin-left:13px;padding-top:2px;">
						{lang mkey='yes'}
					</div>
					<div style="display:inline; float:left;width:6px;vertical-align:middle; margin-left: 7px;">
						<input type="radio" name="{$choice_key}" value="0" {if $user_choices[$choice_key] == '0'} CHECKED {/if} />
					</div>
					<div style="display:inline; float:left;margin-left:13px;padding-top:2px;">
						{lang mkey='no'}
					</div>
				{else}
					<div style="display:inline; float:left;width:72px;vertical-align:middle">
						<input name="{$choice_key}" type="text" class="textinput"  size="6" maxlength="10" value="{$user_choices.email_match_mail_days|default:7}" />
					</div>
				{/if}
					<div style="clear:both;"></div>
				</div>
		{/foreach}
			<div class="signup_line_outer" align=center>
				<input type="submit" class="formbutton" value="{lang mkey='submit'}" />
			</div>
		</form>
	</div>
</div>
{/strip}
