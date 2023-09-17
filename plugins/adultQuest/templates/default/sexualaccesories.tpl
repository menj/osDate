<table border="0" cellpadding="0" cellspacing="0" width="100%">
	<tr>
		<td width="100%"  class="module_detail_inside">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td class="module_head" style="padding-left: 6px;"  height="18" >{$lang.title.4}</td>
	</tr>
</table>
<div style="padding-left:2px">
<form action="?plugin={$plugin}&amp;showpage={$pid}" method="post">
<table border="0" width="100%">
  <tr>
    <td width="100%" colspan="2"><h3>1. {$lang.q4.1}</h3>
</td>
  </tr>
  <tr>
<td width="3%"><input type="hidden" name="q1" value="checkbox" /></td>
<td width="97%">
</td>
</tr>
<tr>
<td width="3%"><input type="checkbox" name="q1_1" style="vertical-align:-50%" value="{$lang.q4.r1_1}" {foreach item=item key=key from=$data.1}{if $item.answer == $lang.q4.r1_1}checked{/if}{/foreach} /></td>
<td width="97%">{$lang.q4.r1_1}
</td>
</tr>
<tr>
<td width="3%"><input type="checkbox" name="q1_2" style="vertical-align:-50%" value="{$lang.q4.r1_2}" {foreach item=item key=key from=$data.1}{if $item.answer == $lang.q4.r1_2}checked{/if}{/foreach} /></td>
<td width="97%">{$lang.q4.r1_2}
</td>
</tr>
<tr>
<td width="3%"><input type="checkbox" name="q1_3" style="vertical-align:-50%" value="{$lang.q4.r1_3}" {foreach item=item key=key from=$data.1}{if $item.answer == $lang.q4.r1_3}checked{/if}{/foreach} /></td>
<td width="97%">{$lang.q4.r1_3}
</td>
</tr>
<tr>
<td width="3%"><input type="checkbox" name="q1_4" style="vertical-align:-50%" value="{$lang.q4.r1_4}" {foreach item=item key=key from=$data.1}{if $item.answer == $lang.q4.r1_4}checked{/if}{/foreach} /></td>
<td width="97%">{$lang.q4.r1_4}
</td>
</tr>
<tr>
<td width="3%"><input type="checkbox" name="q1_5" style="vertical-align:-50%" value="{$lang.q4.r1_5}" {foreach item=item key=key from=$data.1}{if $item.answer == $lang.q4.r1_5}checked{/if}{/foreach} /></td>
<td width="97%">{$lang.q4.r1_5}
</td>
</tr>
<tr>
<td width="3%"><input type="checkbox" name="q1_6" style="vertical-align:-50%" value="{$lang.q4.r1_6}" {foreach item=item key=key from=$data.1}{if $item.answer == $lang.q4.r1_6}checked{/if}{/foreach} /></td>
<td width="97%">{$lang.q4.r1_6}
</td>
</tr>
<tr>
<td width="3%"><input type="checkbox" name="q1_7" style="vertical-align:-50%" value="{$lang.q4.r1_7}" {foreach item=item key=key from=$data.1}{if $item.answer == $lang.q4.r1_7}checked{/if}{/foreach} /></td>
<td width="97%">{$lang.q4.r1_7}
</td>
</tr>
<tr>
<td width="3%"><input type="checkbox" name="q1_8" style="vertical-align:-50%" value="{$lang.q4.r1_8}" {foreach item=item key=key from=$data.1}{if $item.answer == $lang.q4.r1_8}checked{/if}{/foreach} /></td>
<td width="97%">{$lang.q4.r1_8}
</td>
</tr>
<tr>
<td width="3%"><input type="checkbox" name="q1_9" style="vertical-align:-50%" value="{$lang.q4.r1_9}" {foreach item=item key=key from=$data.1}{if $item.answer == $lang.q4.r1_9}checked{/if}{/foreach} /></td>
<td width="97%">{$lang.q4.r1_9}
</td>
</tr>
<tr>
<td width="3%"><input type="checkbox" name="q1_10" style="vertical-align:-50%" value="{$lang.q4.r1_10}" {foreach item=item key=key from=$data.1}{if $item.answer == $lang.q4.r1_10}checked{/if}{/foreach} /></td>
<td width="97%">{$lang.q4.r1_10}
</td>
</tr>
<tr>
<td width="3%"><input type="checkbox" name="q1_11" style="vertical-align:-50%" value="{$lang.q4.r1_11}" {foreach item=item key=key from=$data.1}{if $item.answer == $lang.q4.r1_11}checked{/if}{/foreach} /></td>
<td width="97%">{$lang.q4.r1_11}</td>
</tr>
</table>

<h3>2. {$lang.q4.2}</h3>
<textarea name="q2" rows="10" cols="50">{$data.2.1.answer }</textarea>

<h3>3. {$lang.q4.3}</h3>
<textarea name="q3" rows="10" cols="50">{$data.3.1.answer }</textarea>

<table border="0" width="100%">
  <tr>
    <td width="100%" colspan="2"><h3>4. {$lang.q4.4}</h3>
</td>
  </tr>
  <tr>
<td width="3%"><input type="hidden" name="q4" value="checkbox" /></td>
<td width="97%">
</td>
</tr>
<tr>
<td width="3%"><input type="checkbox" name="q4_1" style="vertical-align:-50%" value="{$lang.q4.r4_1}" {foreach item=item key=key from=$data.4}{if $item.answer == $lang.q4.r4_1}checked{/if}{/foreach} /></td>
<td width="97%">{$lang.q4.r4_1}
</td>
</tr>
<tr>
<td width="3%"><input type="checkbox" name="q4_2" style="vertical-align:-50%" value="{$lang.q4.r4_2}" {foreach item=item key=key from=$data.4}{if $item.answer == $lang.q4.r4_2}checked{/if}{/foreach} /></td>
<td width="97%">{$lang.q4.r4_2}
</td>
</tr>
<tr>
<td width="3%"><input type="checkbox" name="q4_3" style="vertical-align:-50%" value="{$lang.q4.r4_3}" {foreach item=item key=key from=$data.4}{if $item.answer == $lang.q4.r4_3}checked{/if}{/foreach} /></td>
<td width="97%">{$lang.q4.r4_3}
</td>
</tr>
<tr>
<td width="3%"><input type="checkbox" name="q4_4" style="vertical-align:-50%" value="{$lang.q4.r4_4}" {foreach item=item key=key from=$data.4}{if $item.answer == $lang.q4.r4_4}checked{/if}{/foreach} /></td>
<td width="97%">{$lang.q4.r4_4}
</td>
</tr>
<tr>
<td width="3%"><input type="checkbox" name="q4_5" style="vertical-align:-50%" value="{$lang.q4.r4_5}" {foreach item=item key=key from=$data.4}{if $item.answer == $lang.q4.r4_5}checked{/if}{/foreach} /></td>
<td width="97%">{$lang.q4.r4_5}
</td>
</tr>
<tr>
<td width="3%"><input type="checkbox" name="q4_6" style="vertical-align:-50%" value="{$lang.q4.r4_6}" {foreach item=item key=key from=$data.4}{if $item.answer == $lang.q4.r4_6}checked{/if}{/foreach} /></td>
<td width="97%">{$lang.q4.r4_6}
</td>
</tr>
<tr>
<td width="3%"><input type="checkbox" name="q4_7" style="vertical-align:-50%" value="{$lang.q4.r4_7}" {foreach item=item key=key from=$data.4}{if $item.answer == $lang.q4.r4_7}checked{/if}{/foreach} /></td>
<td width="97%">{$lang.q4.r4_7}
</td>
</tr>
<tr>
<td width="3%"><input type="checkbox" name="q4_8" style="vertical-align:-50%" value="{$lang.q4.r4_8}" {foreach item=item key=key from=$data.4}{if $item.answer == $lang.q4.r4_8}checked{/if}{/foreach} /></td>
<td width="97%">{$lang.q4.r4_8}
</td>
</tr>
<tr>
<td width="3%"><input type="checkbox" name="q4_9" style="vertical-align:-50%" value="{$lang.q4.r4_9}" {foreach item=item key=key from=$data.4}{if $item.answer == $lang.q4.r4_9}checked{/if}{/foreach} /></td>
<td width="97%">{$lang.q4.r4_9}
</td>
</tr>
<tr>
<td width="3%"><input type="checkbox" name="q4_10" style="vertical-align:-50%" value="{$lang.q4.r4_10}" {foreach item=item key=key from=$data.4}{if $item.answer == $lang.q4.r4_10}checked{/if}{/foreach} /></td>
<td width="97%">{$lang.q4.r4_10}
</td>
</tr>
<tr>
<td width="3%"><input type="checkbox" name="q4_11" style="vertical-align:-50%" value="{$lang.q4.r4_11}" {foreach item=item key=key from=$data.4}{if $item.answer == $lang.q4.r4_11}checked{/if}{/foreach} /></td>
<td width="97%">{$lang.q4.r4_11}
</td>
</tr>
<tr>
<td width="3%"><input type="checkbox" name="q4_12" style="vertical-align:-50%" value="{$lang.q4.r4_12}" {foreach item=item key=key from=$data.4}{if $item.answer == $lang.q4.r4_12}checked{/if}{/foreach} /></td>
<td width="97%">{$lang.q4.r4_12}
</td>
</tr>
<tr>
<td width="3%"><input type="checkbox" name="q4_13" style="vertical-align:-50%" value="{$lang.q4.r4_13}" {foreach item=item key=key from=$data.4}{if $item.answer == $lang.q4.r4_13}checked{/if}{/foreach} /></td>
<td width="97%">{$lang.q4.r4_13}
</td>
</tr>
<tr>
<td width="3%"><input type="checkbox" name="q4_14" style="vertical-align:-50%" value="{$lang.q4.r4_14}" {foreach item=item key=key from=$data.4}{if $item.answer == $lang.q4.r4_14}checked{/if}{/foreach} /></td>
<td width="97%">{$lang.q4.r4_14}
</td>
</tr>
<tr>
<td width="3%"><input type="checkbox" name="q4_15" style="vertical-align:-50%" value="{$lang.q4.r4_15}" {foreach item=item key=key from=$data.4}{if $item.answer == $lang.q4.r4_15}checked{/if}{/foreach} /></td>
<td width="97%">{$lang.q4.r4_15}
</td>
</tr>
<tr>
<td width="3%"><input type="checkbox" name="q4_16" style="vertical-align:-50%" value="{$lang.q4.r4_16}" {foreach item=item key=key from=$data.4}{if $item.answer == $lang.q4.r4_16}checked{/if}{/foreach} /></td>
<td width="97%">{$lang.q4.r4_16}</td>
</tr>
</table>

<table border="0" width="100%">
  <tr>
    <td width="100%" colspan="2"><h3>5. {$lang.q4.5}</h3>
</td>
  </tr>
  <tr>
<td width="3%"><input type="hidden" name="q5" value="checkbox" /></td>
<td width="97%">
</td>
</tr>
<tr>
<td width="3%"><input type="checkbox" name="q5_1" style="vertical-align:-50%" value="{$lang.q4.r5_1}" {foreach item=item key=key from=$data.5}{if $item.answer == $lang.q4.r5_1}checked{/if}{/foreach} /></td>
<td width="97%">{$lang.q4.r5_1}
</td>
</tr>
<tr>
<td width="3%"><input type="checkbox" name="q5_2" style="vertical-align:-50%" value="{$lang.q4.r5_2}" {foreach item=item key=key from=$data.5}{if $item.answer == $lang.q4.r5_2}checked{/if}{/foreach} /></td>
<td width="97%">{$lang.q4.r5_2}
</td>
</tr>
<tr>
<td width="3%"><input type="checkbox" name="q5_3" style="vertical-align:-50%" value="{$lang.q4.r5_3}" {foreach item=item key=key from=$data.5}{if $item.answer == $lang.q4.r5_3}checked{/if}{/foreach} /></td>
<td width="97%">{$lang.q4.r5_3}
</td>
</tr>
<tr>
<td width="3%"><input type="checkbox" name="q5_4" style="vertical-align:-50%" value="{$lang.q4.r5_4}" {foreach item=item key=key from=$data.5}{if $item.answer == $lang.q4.r5_4}checked{/if}{/foreach} /></td>
<td width="97%">{$lang.q4.r5_4}
</td>
</tr>
<tr>
<td width="3%"><input type="checkbox" name="q5_5" style="vertical-align:-50%" value="{$lang.q4.r5_5}" {foreach item=item key=key from=$data.5}{if $item.answer == $lang.q4.r5_5}checked{/if}{/foreach} /></td>
<td width="97%">{$lang.q4.r5_5}
</td>
</tr>
<tr>
<td width="3%"><input type="checkbox" name="q5_6" style="vertical-align:-50%" value="{$lang.q4.r5_6}" {foreach item=item key=key from=$data.5}{if $item.answer == $lang.q4.r5_6}checked{/if}{/foreach} /></td>
<td width="97%">{$lang.q4.r5_6}
</td>
</tr>
<tr>
<td width="3%"><input type="checkbox" name="q5_7" style="vertical-align:-50%" value="{$lang.q4.r5_7}" {foreach item=item key=key from=$data.5}{if $item.answer == $lang.q4.r5_7}checked{/if}{/foreach} /></td>
<td width="97%">{$lang.q4.r5_7}
</td>
</tr>
<tr>
<td width="3%"><input type="checkbox" name="q5_8" style="vertical-align:-50%" value="{$lang.q4.r5_8}" {foreach item=item key=key from=$data.5}{if $item.answer == $lang.q4.r5_8}checked{/if}{/foreach} /></td>
<td width="97%">{$lang.q4.r5_8}
</td>
</tr>
<tr>
<td width="3%"><input type="checkbox" name="q5_9" style="vertical-align:-50%" value="{$lang.q4.r5_9}" {foreach item=item key=key from=$data.5}{if $item.answer == $lang.q4.r5_9}checked{/if}{/foreach} /></td>
<td width="97%">{$lang.q4.r5_9}
</td>
</tr>
<tr>
<td width="3%"><input type="checkbox" name="q5_10" style="vertical-align:-50%" value="{$lang.q4.r5_10}" {foreach item=item key=key from=$data.5}{if $item.answer == $lang.q4.r5_10}checked{/if}{/foreach} /></td>
<td width="97%">{$lang.q4.r5_10}
</td>
</tr>
<tr>
<td width="3%"><input type="checkbox" name="q5_11" style="vertical-align:-50%" value="{$lang.q4.r5_11}" {foreach item=item key=key from=$data.5}{if $item.answer == $lang.q4.r5_11}checked{/if}{/foreach} /></td>
<td width="97%">{$lang.q4.r5_11}
</td>
</tr>
<tr>
<td width="3%"><input type="checkbox" name="q5_12" style="vertical-align:-50%" value="{$lang.q4.r5_12}" {foreach item=item key=key from=$data.5}{if $item.answer == $lang.q4.r5_12}checked{/if}{/foreach} /></td>
<td width="97%">{$lang.q4.r5_12}
</td>
</tr>
<tr>
<td width="3%"><input type="checkbox" name="q5_13" style="vertical-align:-50%" value="{$lang.q4.r5_13}" {foreach item=item key=key from=$data.5}{if $item.answer == $lang.q4.r5_13}checked{/if}{/foreach} /></td>
<td width="97%">{$lang.q4.r5_13}
</td>
</tr>
<tr>
<td width="3%"><input type="checkbox" name="q5_14" style="vertical-align:-50%" value="{$lang.q4.r5_14}" {foreach item=item key=key from=$data.5}{if $item.answer == $lang.q4.r5_14}checked{/if}{/foreach} /></td>
<td width="97%">{$lang.q4.r5_14}
</td>
</tr>
<tr>
<td width="3%"><input type="checkbox" name="q5_15" style="vertical-align:-50%" value="{$lang.q4.r5_15}" {foreach item=item key=key from=$data.5}{if $item.answer == $lang.q4.r5_15}checked{/if}{/foreach} /></td>
<td width="97%">{$lang.q4.r5_15}
</td>
</tr>
<tr>
<td width="3%"><input type="checkbox" name="q5_16" style="vertical-align:-50%" value="{$lang.q4.r5_16}" {foreach item=item key=key from=$data.5}{if $item.answer == $lang.q4.r5_16}checked{/if}{/foreach} /></td>
<td width="97%">{$lang.q4.r5_16}
</td>
</tr>
<tr>
<td width="3%"><input type="checkbox" name="q5_17" style="vertical-align:-50%" value="{$lang.q4.r5_17}" {foreach item=item key=key from=$data.5}{if $item.answer == $lang.q4.r5_17}checked{/if}{/foreach} /></td>
<td width="97%">{$lang.q4.r5_17}
</td>
</tr>
<tr>
<td width="3%"><input type="checkbox" name="q5_18" style="vertical-align:-50%" value="{$lang.q4.r5_18}" {foreach item=item key=key from=$data.5}{if $item.answer == $lang.q4.r5_18}checked{/if}{/foreach} /></td>
<td width="97%">{$lang.q4.r5_18}
</td>
</tr>
<tr>
<td width="3%"><input type="checkbox" name="q5_19" style="vertical-align:-50%" value="{$lang.q4.r5_19}" {foreach item=item key=key from=$data.5}{if $item.answer == $lang.q4.r5_19}checked{/if}{/foreach} /></td>
<td width="97%">{$lang.q4.r5_19}
</td>
</tr>
<tr>
<td width="3%"><input type="checkbox" name="q5_20" style="vertical-align:-50%" value="{$lang.q4.r5_20}" {foreach item=item key=key from=$data.5}{if $item.answer == $lang.q4.r5_20}checked{/if}{/foreach} /></td>
<td width="97%">{$lang.q4.r5_20}
</td>
</tr>
<tr>
<td width="3%"><input type="checkbox" name="q5_21" style="vertical-align:-50%" value="{$lang.q4.r5_21}" {foreach item=item key=key from=$data.5}{if $item.answer == $lang.q4.r5_21}checked{/if}{/foreach} /></td>
<td width="97%">{$lang.q4.r5_21}
</td>
</tr>
<tr>
<td width="3%"><input type="checkbox" name="q5_22" style="vertical-align:-50%" value="{$lang.q4.r5_22}" {foreach item=item key=key from=$data.5}{if $item.answer == $lang.q4.r5_22}checked{/if}{/foreach} /></td>
<td width="97%">{$lang.q4.r5_22}
</td>
</tr>
<tr>
<td width="3%"><input type="checkbox" name="q5_23" style="vertical-align:-50%" value="{$lang.q4.r5_23}" {foreach item=item key=key from=$data.5}{if $item.answer == $lang.q4.r5_23}checked{/if}{/foreach} /></td>
<td width="97%">{$lang.q4.r5_23}</td>
</tr>
</table>

<table border="0" width="100%">
  <tr>
    <td width="100%" colspan="2"><h3>6. {$lang.q4.6}</h3>
</td>
  </tr>
  <tr>
<td width="3%"><input type="hidden" name="q6" value="checkbox" /></td>
<td width="97%">
</td>
</tr>
<tr>
<td width="3%"><input type="checkbox" name="q6_1" style="vertical-align:-50%" value="{$lang.q4.r6_1}" {foreach item=item key=key from=$data.6}{if $item.answer == $lang.q4.r6_1}checked{/if}{/foreach} /></td>
<td width="97%">{$lang.q4.r6_1}
</td>
</tr>
<tr>
<td width="3%"><input type="checkbox" name="q6_2" style="vertical-align:-50%" value="{$lang.q4.r6_2}" {foreach item=item key=key from=$data.6}{if $item.answer == $lang.q4.r6_2}checked{/if}{/foreach} /></td>
<td width="97%">{$lang.q4.r6_2}
</td>
</tr>
<tr>
<td width="3%"><input type="checkbox" name="q6_3" style="vertical-align:-50%" value="{$lang.q4.r6_3}" {foreach item=item key=key from=$data.6}{if $item.answer == $lang.q4.r6_3}checked{/if}{/foreach} /></td>
<td width="97%">{$lang.q4.r6_3}
</td>
</tr>
<tr>
<td width="3%"><input type="checkbox" name="q6_4" style="vertical-align:-50%" value="{$lang.q4.r6_4}" {foreach item=item key=key from=$data.6}{if $item.answer == $lang.q4.r6_4}checked{/if}{/foreach} /></td>
<td width="97%">{$lang.q4.r6_4}
</td>
</tr>
<tr>
<td width="3%"><input type="checkbox" name="q6_5" style="vertical-align:-50%" value="{$lang.q4.r6_5}" {foreach item=item key=key from=$data.6}{if $item.answer == $lang.q4.r6_5}checked{/if}{/foreach} /></td>
<td width="97%">{$lang.q4.r6_5}
</td>
</tr>
<tr>
<td width="3%"><input type="checkbox" name="q6_6" style="vertical-align:-50%" value="{$lang.q4.r6_6}" {foreach item=item key=key from=$data.6}{if $item.answer == $lang.q4.r6_6}checked{/if}{/foreach} /></td>
<td width="97%">{$lang.q4.r6_6}
</td>
</tr>
<tr>
<td width="3%"><input type="checkbox" name="q6_7" style="vertical-align:-50%" value="{$lang.q4.r6_7}" {foreach item=item key=key from=$data.6}{if $item.answer == $lang.q4.r6_7}checked{/if}{/foreach} /></td>
<td width="97%">{$lang.q4.r6_7}
</td>
</tr>
<tr>
<td width="3%"><input type="checkbox" name="q6_8" style="vertical-align:-50%" value="{$lang.q4.r6_8}" {foreach item=item key=key from=$data.6}{if $item.answer == $lang.q4.r6_8}checked{/if}{/foreach} /></td>
<td width="97%">{$lang.q4.r6_8}
</td>
</tr>
<tr>
<td width="3%"><input type="checkbox" name="q6_9" style="vertical-align:-50%" value="{$lang.q4.r6_9}" {foreach item=item key=key from=$data.6}{if $item.answer == $lang.q4.r6_9}checked{/if}{/foreach} /></td>
<td width="97%">{$lang.q4.r6_9}
</td>
</tr>
<tr>
<td width="3%"><input type="checkbox" name="q6_10" style="vertical-align:-50%" value="{$lang.q4.r6_10}" {foreach item=item key=key from=$data.6}{if $item.answer == $lang.q4.r6_10}checked{/if}{/foreach} /></td>
<td width="97%">{$lang.q4.r6_10}
</td>
</tr>
<tr>
<td width="3%"><input type="checkbox" name="q6_11" style="vertical-align:-50%" value="{$lang.q4.r6_11}" {foreach item=item key=key from=$data.6}{if $item.answer == $lang.q4.r6_11}checked{/if}{/foreach} /></td>
<td width="97%">{$lang.q4.r6_11}
</td>
</tr>
<tr>
<td width="3%"><input type="checkbox" name="q6_12" style="vertical-align:-50%" value="{$lang.q4.r6_12}" {foreach item=item key=key from=$data.6}{if $item.answer == $lang.q4.r6_12}checked{/if}{/foreach} /></td>
<td width="97%">{$lang.q4.r6_12}
</td>
</tr>
<tr>
<td width="3%"><input type="checkbox" name="q6_13" style="vertical-align:-50%" value="{$lang.q4.r6_13}" {foreach item=item key=key from=$data.6}{if $item.answer == $lang.q4.r6_13}checked{/if}{/foreach} /></td>
<td width="97%">{$lang.q4.r6_13}
</td>
</tr>
<tr>
<td width="3%"><input type="checkbox" name="q6_14" style="vertical-align:-50%" value="{$lang.q4.r6_14}" {foreach item=item key=key from=$data.6}{if $item.answer == $lang.q4.r6_14}checked{/if}{/foreach} /></td>
<td width="97%">{$lang.q4.r6_14}
</td>
</tr>
<tr>
<td width="3%"><input type="checkbox" name="q6_15" style="vertical-align:-50%" value="{$lang.q4.r6_15}" {foreach item=item key=key from=$data.6}{if $item.answer == $lang.q4.r6_15}checked{/if}{/foreach} /></td>
<td width="97%">{$lang.q4.r6_15}
</td>
</tr>
<tr>
<td width="3%"><input type="checkbox" name="q6_16" style="vertical-align:-50%" value="{$lang.q4.r6_16}" {foreach item=item key=key from=$data.6}{if $item.answer == $lang.q4.r6_16}checked{/if}{/foreach} /></td>
<td width="97%">{$lang.q4.r6_16}
</td>
</tr>
<tr>
<td width="3%"><input type="checkbox" name="q6_17" style="vertical-align:-50%" value="{$lang.q4.r6_17}" {foreach item=item key=key from=$data.6}{if $item.answer == $lang.q4.r6_17}checked{/if}{/foreach} /></td>
<td width="97%">{$lang.q4.r6_17}
</td>
</tr>
<tr>
<td width="3%"><input type="checkbox" name="q6_18" style="vertical-align:-50%" value="{$lang.q4.r6_18}" {foreach item=item key=key from=$data.6}{if $item.answer == $lang.q4.r6_18}checked{/if}{/foreach} /></td>
<td width="97%">{$lang.q4.r6_18}
</td>
</tr>
<tr>
<td width="3%"><input type="checkbox" name="q6_19" style="vertical-align:-50%" value="{$lang.q4.r6_19}" {foreach item=item key=key from=$data.6}{if $item.answer == $lang.q4.r6_19}checked{/if}{/foreach} /></td>
<td width="97%">{$lang.q4.r6_19}
</td>
</tr>
<tr>
<td width="3%"><input type="checkbox" name="q6_20" style="vertical-align:-50%" value="{$lang.q4.r6_20}" {foreach item=item key=key from=$data.6}{if $item.answer == $lang.q4.r6_20}checked{/if}{/foreach} /></td>
<td width="97%">{$lang.q4.r6_20}
</td>
</tr>
<tr>
<td width="3%"><input type="checkbox" name="q6_21" style="vertical-align:-50%" value="{$lang.q4.r6_21}" {foreach item=item key=key from=$data.6}{if $item.answer == $lang.q4.r6_21}checked{/if}{/foreach} /></td>
<td width="97%">{$lang.q4.r6_21}
</td>
</tr>
<tr>
<td width="3%"><input type="checkbox" name="q6_22" style="vertical-align:-50%" value="{$lang.q4.r6_22}" {foreach item=item key=key from=$data.6}{if $item.answer == $lang.q4.r6_22}checked{/if}{/foreach} /></td>
<td width="97%">{$lang.q4.r6_22}
</td>
</tr>
<tr>
<td width="3%"><input type="checkbox" name="q6_23" style="vertical-align:-50%" value="{$lang.q4.r6_23}" {foreach item=item key=key from=$data.6}{if $item.answer == $lang.q4.r6_23}checked{/if}{/foreach} /></td>
<td width="97%">{$lang.q4.r6_23}
</td>
</tr>
</table>

<h3>7. {$lang.q4.7}</h3>
<textarea name="q7" rows="10" cols="50">{$data.7.1.answer }</textarea>

<table border="0" width="100%">
  <tr>
    <td width="100%" colspan="2"><h3>8. {$lang.q4.8}</h3>
</td>
  </tr>
  <tr>
<td width="3%"><input type="hidden" name="q8" value="checkbox" /></td>
<td width="97%">
</td>
</tr>
<tr>
<td width="3%"><input type="checkbox" name="q8_1" style="vertical-align:-50%" value="{$lang.q4.r8_1}" {foreach item=item key=key from=$data.8}{if $item.answer == $lang.q4.r8_1}checked{/if}{/foreach} /></td>
<td width="97%">{$lang.q4.r8_1}
</td>
</tr>
<tr>
<td width="3%"><input type="checkbox" name="q8_2" style="vertical-align:-50%" value="{$lang.q4.r8_2}" {foreach item=item key=key from=$data.8}{if $item.answer == $lang.q4.r8_2}checked{/if}{/foreach} /></td>
<td width="97%">{$lang.q4.r8_2}
</td>
</tr>
<tr>
<td width="3%"><input type="checkbox" name="q8_3" style="vertical-align:-50%" value="{$lang.q4.r8_3}" {foreach item=item key=key from=$data.8}{if $item.answer == $lang.q4.r8_3}checked{/if}{/foreach} /></td>
<td width="97%">{$lang.q4.r8_3}
</td>
</tr>
<tr>
<td width="3%"><input type="checkbox" name="q8_4" style="vertical-align:-50%" value="{$lang.q4.r8_4}" {foreach item=item key=key from=$data.8}{if $item.answer == $lang.q4.r8_4}checked{/if}{/foreach} /></td>
<td width="97%">{$lang.q4.r8_4}
</td>
</tr>
<tr>
<td width="3%"><input type="checkbox" name="q8_5" style="vertical-align:-50%" value="{$lang.q4.r8_5}" {foreach item=item key=key from=$data.8}{if $item.answer == $lang.q4.r8_5}checked{/if}{/foreach} /></td>
<td width="97%">{$lang.q4.r8_5}
</td>
</tr>
<tr>
<td width="3%"><input type="checkbox" name="q8_6" style="vertical-align:-50%" value="{$lang.q4.r8_6}" {foreach item=item key=key from=$data.8}{if $item.answer == $lang.q4.r8_6}checked{/if}{/foreach} /></td>
<td width="97%">{$lang.q4.r8_6}
</td>
</tr>
<tr>
<td width="3%"><input type="checkbox" name="q8_7" style="vertical-align:-50%" value="{$lang.q4.r8_7}" {foreach item=item key=key from=$data.8}{if $item.answer == $lang.q4.r8_7}checked{/if}{/foreach} /></td>
<td width="97%">{$lang.q4.r8_7}
</td>
</tr>
<tr>
<td width="3%"><input type="checkbox" name="q8_8" style="vertical-align:-50%" value="{$lang.q4.r8_8}" {foreach item=item key=key from=$data.8}{if $item.answer == $lang.q4.r8_8}checked{/if}{/foreach} /></td>
<td width="97%">{$lang.q4.r8_8}
</td>
</tr>
<tr>
<td width="3%"><input type="checkbox" name="q8_9" style="vertical-align:-50%" value="{$lang.q4.r8_9}" {foreach item=item key=key from=$data.8}{if $item.answer == $lang.q4.r8_9}checked{/if}{/foreach} /></td>
<td width="97%">{$lang.q4.r8_9}
</td>
</tr>
<tr>
<td width="3%"><input type="checkbox" name="q8_10" style="vertical-align:-50%" value="{$lang.q4.r8_10}" {foreach item=item key=key from=$data.8}{if $item.answer == $lang.q4.r8_10}checked{/if}{/foreach} /></td>
<td width="97%">{$lang.q4.r8_10}
</td>
</tr>
<tr>
<td width="3%"><input type="checkbox" name="q8_11" style="vertical-align:-50%" value="{$lang.q4.r8_11}" {foreach item=item key=key from=$data.8}{if $item.answer == $lang.q4.r8_11}checked{/if}{/foreach} /></td>
<td width="97%">{$lang.q4.r8_11}
</td>
</tr>
<tr>
<td width="3%"><input type="checkbox" name="q8_12" style="vertical-align:-50%" value="{$lang.q4.r8_12}" {foreach item=item key=key from=$data.8}{if $item.answer == $lang.q4.r8_12}checked{/if}{/foreach} /></td>
<td width="97%">{$lang.q4.r8_12}
</td>
</tr>
<tr>
<td width="3%"><input type="checkbox" name="q8_13" style="vertical-align:-50%" value="{$lang.q4.r8_13}" {foreach item=item key=key from=$data.8}{if $item.answer == $lang.q4.r8_13}checked{/if}{/foreach} /></td>
<td width="97%">{$lang.q4.r8_13}
</td>
</tr>
<tr>
<td width="3%"><input type="checkbox" name="q8_14" style="vertical-align:-50%" value="{$lang.q4.r8_14}" {foreach item=item key=key from=$data.8}{if $item.answer == $lang.q4.r8_14}checked{/if}{/foreach} /></td>
<td width="97%">{$lang.q4.r8_14}</td>
</tr>
</table>

<table border="0" width="100%">
  <tr>
    <td width="100%" colspan="2"><h3>9. {$lang.q4.9}</h3>
</td>
  </tr>
  <tr>
<td width="3%"><input type="radio" name="q9" value="{$lang.q4.r9_1}" {if $lang.q4.r9_1 == $data.9.1.answer}checked{/if} /></td>
<td width="97%"> {$lang.q4.r9_1}
</td>
</tr>
<tr>
<td width="3%"><input type="radio" name="q9" value="{$lang.q4.r9_2}" {if $lang.q4.r9_2 == $data.9.1.answer}checked{/if} /></td>
<td width="97%"> {$lang.q4.r9_2}
</td>
</tr>
<tr>
<td width="3%"><input type="radio" name="q9" value="{$lang.q4.r9_3}" {if $lang.q4.r9_3 == $data.9.1.answer}checked{/if} /></td>
<td width="97%"> {$lang.q4.r9_3}
</td>
</tr>
<tr>
<td width="3%"><input type="radio" name="q9" value="{$lang.q4.r9_4}" {if $lang.q4.r9_4 == $data.9.1.answer}checked{/if} /></td>
<td width="97%"> {$lang.q4.r9_4}
</td>
</tr>
<tr>
<td width="3%"><input type="radio" name="q9" value="{$lang.q4.r9_5}" {if $lang.q4.r9_5 == $data.9.1.answer}checked{/if} /></td>
<td width="97%"> {$lang.q4.r9_5}
</td>
</tr>
<tr>
<td width="3%"><input type="radio" name="q9" value="{$lang.q4.r9_6}" {if $lang.q4.r9_6 == $data.9.1.answer}checked{/if} /></td>
<td width="97%"> {$lang.q4.r9_6}
</td>
</tr>
<tr>
<td width="3%"><input type="radio" name="q9" value="{$lang.q4.r9_7}" {if $lang.q4.r9_7 == $data.9.1.answer}checked{/if} /></td>
<td width="97%"> {$lang.q4.r9_7}
</td>
</tr>
<tr>
<td width="3%"><input type="radio" name="q9" value="{$lang.q4.r9_8}" {if $lang.q4.r9_8 == $data.9.1.answer}checked{/if} /></td>
<td width="97%"> {$lang.q4.r9_8}
</td>
</tr>
<tr>
<td width="3%"><input type="radio" name="q9" value="{$lang.q4.r9_9}" {if $lang.q4.r9_9 == $data.9.1.answer}checked{/if} /></td>
<td width="97%"> {$lang.q4.r9_9}</td>
</tr>
</table>
<br/>
<input type="submit" value="{$lang.save}" class="formbutton" name="edit"/>
</form>
</div>
	</td>
</tr>
</table>