{$item.question}.
<br/>
<table border="0" width="100%">
{if $colspan>0}
  <tr>
     <td width="2%" colspan="3" align="right"><b>{$lang.not_at_all}</b></td>
	 <td width="7%" align="center" colspan="{$colspan}"><b>{$lang.somewhat}</b></td>
	 <td width="7%" align="left"><b>{$lang.very}</b></td>
  </tr>
{/if}
  <tr>
    <td width="2%"></td>
    <td width="{$lenans}%"></td>
    {if $item.maxopt==2}
    	<td width="{$lenopt}%" align="center">F</td>
    	<td width="{$lenopt}%" align="center">T</td>
    {else}
     {foreach item=item key=key from=$nr}
	<td width="{$lenopt}%" align="center">{$item}</td>
	 {/foreach}
	{/if}
  </tr>
  
  {assign var="k" value="0"}
  {foreach item=item key=key from=$ans}
  {math equation="$k+1" assign="k"}
  <tr class="{cycle values="oddrow,evenrow"}">	 	
    <td width="2%">{$k}</td>
    <td width="{$lenans}%" align="right" style="padding-right:10px">{$item.answer}</td>
     {foreach item=item2 key=key2 from=$nr}
     {if $ou == 0}<td width="{$lenopt}%" align="center"><input type=radio value="{$item2}" name="q{$item.qid}_{$item.qcid}" {if $item2 == $item.check}checked{/if} /></td>
     {else}
     <td width="{$lenopt}%" align="center">{if $item2==$item.check}{if $item2==$item.check2}<b>X</b>{else}X{/if}{else}{if $item2==$item.check2}*{/if}{/if}</td>     
     {/if}
     {/foreach}
  </tr>
  {/foreach}
{if $colspan>0}
  <tr>
     <td width="2%" colspan="3" align="right"><b>{$lang.not_at_all}</b></td>
	 <td width="7%" align="center" colspan="{$colspan}"><b>{$lang.somewhat}</b></td>
	 <td width="7%" align="left"><b>{$lang.very}</b></td>
  </tr>
{/if}
</table>
<br/><br/>