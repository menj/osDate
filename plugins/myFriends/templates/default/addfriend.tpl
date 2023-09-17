<script type="text/javascript">
/* <![CDATA[ */
{literal}
function check()
{
	var ok=1;
	var i;
	var str;
	var nr=document.addfriend.nr.value;
	for(i=1;i<=nr;i++)
	{
		str="f"+i;
		if(document.getElementById(str).checked) ok=0;
	}
	if(ok) {alert("{/literal}{$lang.message.6}{literal}");return false;}
	else
	{
		document.addfriend.add.value=1;
		document.addfriend.submit();
	}
}

function check2()
{
	var ok=1;
	if(document.addfriend.username.value!="") ok=0;
	if(ok) {alert("{/literal}{$lang.message.5}{literal}");return false;}
	else
	{
		document.addfriend.add.value=1;
		document.addfriend.submit();
	}
}


function checkall()
{
	var i,str;
	var nr=document.addfriend.nr.value;
	for(i=1;i<=nr;i++)
	{
		str="f"+i;
		document.getElementById(str).checked=true;
	}
}

function uncheckall()
{
	var i,str;
	var nr=document.addfriend.nr.value;
	for(i=1;i<=nr;i++)
	{
		str="f"+i;
		document.getElementById(str).checked=false;
	}
}


{/literal}
/* ]]> */
</script>

<center>
<table width="550" border="0" cellpadding="0" cellspacing="0" >
	<tr>
		<td class="module_detail_inside" width="100%">
			<table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr>
					<td class="module_head" width="6"></td>
					<td class="module_head" width="526">
					<a href="?plugin={$plugin_name}&amp;do=addfriend" class="subhead">{$lang.addfriend}</a> - <a href="?plugin={$plugin_name}&amp;do=addfriend&amp;search=1" class="subhead">{$lang.lastsearch}</a>
					</td>
					<td width="28"><img src="{$image_dir}blue_hor2.jpg" width="28" height="23" alt="" /></td>
				</tr>
			</table>
      <form action="?plugin={$plugin_name}&amp;do=addfriend&amp;search={$search}" name="addfriend" method="post">
      <input type="hidden" name="search" value="{$search}" />
      {if $error == 1}
			{assign var="error_message" value=$lang.error}
			{include file="display_error.tpl"}
      {/if}
      {if $error == 2}
			{assign var="error_message" value=$lang.error2}
			{include file="display_error.tpl"}
      {/if}
			<table class="table" cellspacing="{$config.cellspacing}" cellpadding="{$config.cellpadding}" width="550" border="0">
	  		<tbody>
	  	{if $search == 1}
	  		{if $data == 0}
				<tr><td width="100%" style="padding: 5px;">
	  		{$lang.show1} <a href="advsearch.php?search_new=1">{$lang.show2}</a>
					</td>
				</tr>
	  		{else}
	  			{assign var="mcount" value="0"}
	  			{foreach item=item key=key from=$data}
	  			{math equation="$mcount+1" assign="mcount"}
			  		<tr class="{cycle values="oddrow,evenrow"}">
	  					<td width="20%"><input type="checkbox" name="f{$mcount}" id="f{$mcount}" value="{$item.id}" />{$item.username}</td>
	  					<td align="left"><a href="javascript:popUpScrollWindow2('{$docroot}showprofile.php?id={$item.id}')">View profile</a></td>
	 				</tr>
	 			{/foreach}
			  		<tr>
	  					<td colspan="2"><a href="#" onclick="checkall()">{$lang.checkall}</a> | <a href="#" onclick="uncheckall()">{$lang.uncheckall}</a></td>
	 				</tr>
	 		{/if}

	  	{else}
	 			<tr>
	  				<td>{$lang.username}<font color="{lang mkey='required_info_indicator_color'}">{lang mkey='required_info_indicator'}</font></td>
	  				<td><input type="text" value="{$name}" maxlength="255" size="50" name="username" /></td>
	 			</tr>
	 	{/if}
	 		  	{if $search == 1}
	  		{if $data != 0}
				<tr>
					<td>&nbsp;</td>
					<td>
						<input type="hidden" name="nr" value="{$mcount}" />
						<input type="hidden" name="add" value="0" />
						<input type="button" class="formbutton" value="{lang mkey='submit'}" onclick="check()" />&nbsp;
						<input type="reset" class="formbutton" value="{lang mkey='reset'}" />
					</td>
				</tr>
				{/if}
			{else}
				<tr>
					<td>&nbsp;</td>
					<td>
						<input type="hidden" name="add" value="0" />
						<input type="button" class="formbutton" value="{lang mkey='submit'}" onclick="check2()" />&nbsp;
						<input type="reset" class="formbutton" value="{lang mkey='reset'}" />
					</td>
				</tr>
			{/if}
  			</tbody>
			</table>
      </form>
		</td>
	</tr>
</table>
</center>