<div class="module_detail top_bottom_pad">
{var page_hdr02_text=$title|cat:" > "|cat:$item.question}
{include file='page_hdr02.tpl'}
<br/>
<div style="padding-left:6px; padding-right:4px;padding-top:4px; padding-bottom:4px;">
	{$item.descr}
</div>
<table border="0" width="100%">
  <tr>
  	<td colspan="2" width="80%"></td>
     <td width="10%" align="center"><b>{$lang.true}</b></td>
	 <td width="10%" align="center"><b>{$lang.false}</b></td>
  </tr>
  {var k=0}
  {foreach item=item1 key=qcid from=$item.answers}
  {var k=$k+1}
  <tr class="{cycle values="oddrow,evenrow"}">
    <td width="2%">{$k}</td>
    <td width="78%" align="right" style="padding-right:10px">{$item1.descr}</td>
     {if $ou == 0}
     	<td width="7%" align="center">
     		<input {if $item1.answer=='1'}checked="checked" {/if} type="radio" value="1" name="q{$item.qid}_{$qcid}"  />
     	</td>
     	<td width="7%" align="center">
     		<input {if $item1.answer=='2'}checked="checked" {/if} type="radio" value="2" name="q{$item.qid}_{$qcid}"  />
     	</td>
     {else}
	     <td width="10%" align="center">
	     	{if $item1.answer=='1' && $item1.comp_answer=='1'}<b>X</b>
	     	{elseif $item1.answer =='1' && $item1.answer != $item1.comp_answer}*
	     	{elseif $item1.answer != '1' && $item1.comp_answer=='1'}x
	     	{/if}
	     </td>
	     <td width="10%" align="center">
	     	{if $item1.answer=='2' && $item1.comp_answer=='2'}<b>X</b>
	     	{elseif $item1.answer =='2' && $item1.answer != $item1.comp_answer}*
	     	{elseif $item1.answer != '2' && $item1.comp_answer=='2'}x
	     	{/if}
	     </td>
     {/if}
  </tr>
  {/foreach}
  <tr>
  	<td colspan="2" width="80%"></td>
     <td width="10%" align="center"><b>{$lang.true}</b></td>
	 <td width="10%" align="center"><b>{$lang.false}</b></td>
  </tr>
</table>
</div>
<br/><br/>