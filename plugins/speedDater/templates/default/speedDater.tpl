<table border="0" cellpadding="0" cellspacing="0" width="100%">
	<tr>
		<td width="100%"  class="module_detail_inside">
{assign var="page_hdr01_text" value=$lang.user_title}
{include file="page_hdr01.tpl"}

<div style="padding-left:4px;padding-top:5px">
{if $error != 0}
	{assign var="error_message" value=$lang.error.$error}
	{if $error == 2}
		{assign var="error_message" value=$error_message|cat:" "|cat:$left|cat:" "|cat:$lang.error.22}
	{/if}
	{include file="display_error.tpl"}
	<br/>
{/if}
{$lang.desc1}<br/><br/>
<form action='plugin.php?plugin={$plugin_name}' method="post">
<center>
<table width="100%" border="0" cellpadding="0" cellspacing="0" >
	<tr>
		<td  width="100%">
			{assign var="page_hdr02_text" value=$lang.title1}
			{include file="page_hdr02.tpl"}


						<table cellspacing="{$config.cellspacing}" cellpadding="{$config.cellpadding}" width="100%">
				<tbody>
				<tr class="{cycle values="oddrow,evenrow"}">
					<td align="center" width="10"><input type="radio" name="get1" value="1" {if $get1 == 1}checked{/if} /></td>
					<td>{$lang.opt1}</td>
				</tr>
				<tr class="{cycle values="oddrow,evenrow"}">
					<td align="center"><input type="radio" name="get1" value="2" {if $get1 == 2}checked{/if} /></td>
					<td>{$lang.opt2}</td>
				</tr>
				{if $data|@count != 0}
					<tr class="{cycle values="oddrow,evenrow"}">
					<td align="center"><input type="radio" name="get1" value="3" {if $get1 == 3}checked{/if} /></td>
					<td>{$lang.opt3}:
					<select name="ss">
					{foreach item=item key=key from=$data}
						<option value="{$item.id}" {if $ss == $item.id}selected{/if} >{$item.search_name}</option>
					{/foreach}
					</select></td>
					</tr>
				{/if}
				</tbody>
			</table>
</table>
<br/><br/>
<table width="100%" border="0" cellpadding="0" cellspacing="0" >
	<tr>
		<td  width="100%">
			{assign var="page_hdr02_text" value=$lang.title2}
			{include file="page_hdr02.tpl"}



						<table cellspacing="{$config.cellspacing}" cellpadding="{$config.cellpadding}" width="100%">
				<tbody>
				{if $sendwinks == 1}<tr class="{cycle values="oddrow,evenrow"}">
					<td align="center" width="10"><input type="radio" name="get2" value="1" {if $get2 == 1}checked{/if} /></td>
					<td>{$lang.opt4}</td>
				</tr>
				{/if}
				{if $sendmessage == 1}{if $data2|@count != 0}<tr class="{cycle values="oddrow,evenrow"}">
					<td align="center"><input type="radio" name="get2" value="2" {if $get2 == 2}checked{/if} /></td>
					<td>{$lang.opt5}
					<select name="st">
					{foreach item=item key=key from=$data2}
						<option value="{$item.id}" {if $st == $item.id}selected{/if} >{$item.subject}</option>
					{/foreach}
					</select>
					</td>
				</tr>
				{/if}
				<tr class="{cycle values="oddrow,evenrow"}">
					<td align="center" valign="top"><input type="radio" name="get2" value="3" {if $get2 == 3}checked{/if} /></td>
					<td><div style="padding-top:3px">{$lang.opt6}<br/><br/>
					{$lang.subject} <br/><input type="text" name="subject" value="{$subject}" size=50 /><br/><br/>
					{$lang.body} <br/><textarea name="body" rows="5" cols="50">{$body }</textarea></div>
					</td>
				</tr>
				{/if}
				<tr class="{cycle values="oddrow,evenrow"}">
					<td align="center"><input type="checkbox" name="overlap" value="1" {if $overlap == 1}checked{/if} /></td>
					<td>{$lang.opt7} <input type="text" size=3 name="overlaptime" value="{$overlaptime}" /> {$lang.opt71}
					</td>
				</tr>
				<tr class="{cycle values="oddrow,evenrow"}">
					<td colspan="2" align="center"><input type="submit" value="{lang mkey='submit'}" class="formbutton" name="send" /></td>
				</tr>
				</tbody>
			</table>
</table>
</center>
</form>
</div>
	</td>
</tr>
</table>
