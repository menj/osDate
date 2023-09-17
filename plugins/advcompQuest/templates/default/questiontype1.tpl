<div class="module_detail top_bottom_pad">
{var page_hdr02_text=$title|cat:" > "|cat:$item.question}
{include file='page_hdr02.tpl'}
<br/>
<div style="padding-left:6px; padding-right:4px;padding-top:4px; padding-bottom:4px;">
	{$item.descr}
</div>

<table border="0" width="100%">
  <tr>
  	<td colspan="2" width="51%"></td>
     <td width="14%" colspan="2" align="center"><b>{$lang.not_at_all}</b></td>
	 <td width="21%" align="center" colspan="{$colspan}"><b>{$lang.somewhat}</b></td>
	 <td width="14%" align="center" colspan="2"><b>{$lang.very}</b></td>
  </tr>
  <tr>
    <td colspan="2"></td>
     {foreach from=$opts key=k item=itemx}
		<td width="7%" align="center">{$itemx}</td>
	 {/foreach}
  </tr>
  {var k=0}
  {foreach item=item1 key=qcid from=$item.answers}
  {var k=$k+1}
  <tr class="{cycle values="oddrow,evenrow"}">
    <td width="2%">{$k}</td>
    <td width="49%" align="right" style="padding-right:10px">{$item1.descr}</td>
     {foreach item=item2 key=key2 from=$opts}
     {if $ou == 0}
     	<td width="7%" align="center">
     		<input {if $item2 == $item1.answer}checked="checked" {/if} type="radio" value="{$item2}" name="q{$item.qid}_{$qcid}"  />
     	</td>
     {else}
	     <td width="7%" align="center">
	     	{if $item2==$item1.answer && $item2==$item1.comp_answer}<b>X</b>
	     	{elseif $item2==$item1.answer && $item2!=$item1.comp_answer}*
	     	{elseif $item2==$item1.comp_answer}x
	     	{/if}
	     </td>
     {/if}
     {/foreach}
  </tr>
  {/foreach}
{if $colspan>0}
  <tr>
  	<td colspan="2"></td>
     <td width="7%" colspan="2" align="center"><b>{$lang.not_at_all}</b></td>
	 <td width="7%" align="center" colspan="{$colspan}"><b>{$lang.somewhat}</b></td>
	 <td width="7%" align="center" colspan="2"><b>{$lang.very}</b></td>
  </tr>
{/if}
</table>
</div>
<br/>
<br />
