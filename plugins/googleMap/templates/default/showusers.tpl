<table border="0" cellpadding="0" cellspacing="0" width="100%">
	<tr>
		<td width="100%"  class="module_detail_inside">
			{assign var="page_hdr01_text" value=$lang.user_title}
			{include file="page_hdr01.tpl"}

<div style="padding-left:4px;padding-top:7px">
<center>
<table width="100%" border="0" cellpadding="0" cellspacing="0" >
	<tr>
		<td class="" width="100%">
			{assign var="page_hdr02_text" value=$lang.desc2|cat:'&nbsp;'|cat:$city}
			{include file="page_hdr02.tpl"}
      <input type="hidden" name="search" value="{$search}" />

			<table class="table" cellspacing="{$config.cellspacing}" cellpadding="{$config.cellpadding}" width="550" border="0">
	  		<tbody>
	  		{assign var="mcount" value="0"}
	  		{foreach item=item key=key from=$data}
	  		{math equation="$mcount+1" assign="mcount"}
		  		<tr>
	  				<td width="25%" align="left"><a href="showprofile.php?id={$item.0.id}" target="_blank">{$item.0.username}</a></td>
	  				<td width="25%" align="left"><a href="showprofile.php?id={$item.1.id}" target="_blank">{$item.1.username}</a></td>
	  				<td width="25%" align="left"><a href="showprofile.php?id={$item.2.id}" target="_blank">{$item.2.username}</a></td>
	  				<td width="25%" align="left"><a href="showprofile.php?id={$item.3.id}" target="_blank">{$item.3.username}</a></td>
	 			</tr>
	 		{/foreach}
  			</tbody>
			</table>
		</td>
	</tr>
</table>
</center>
</div>
	</td>
</tr>
</table>