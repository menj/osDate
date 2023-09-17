<table border="0" cellpadding="0" cellspacing="0" width="100%">
	<tr>
		<td width="100%"  class="module_detail_inside">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td  style="padding-left: 6px;" class="module_head" height="18">{$lang.title.3}</td>
	</tr>
</table>
<div style="padding-left:2px">
<form action="?plugin={$plugin}&amp;showpage={$pid}" method="post">
<h3>1. {$lang.q3.1}</h3>
<textarea name="q1" rows="10" cols="50">{$data.1.1.answer }</textarea>

<table border="0" width="100%">
  <tr>
    <td width="100%" colspan="2"><h3>2. {$lang.q3.2}</h3>
</td>
  </tr>
  <tr>
<td width="3%"><input type="hidden" name="q2" value="checkbox" /></td>
<td width="97%">
</td>
</tr>
<tr>
<td width="3%"><input type="checkbox" name="q2_1" style="vertical-align:-50%" value="{$lang.q3.r2_1}" {foreach item=item key=key from=$data.2}{if $item.answer == $lang.q3.r2_1}checked{/if}{/foreach} /></td>
<td width="97%">{$lang.q3.r2_1}
</td>
</tr>
<tr>
<td width="3%"><input type="checkbox" name="q2_2" style="vertical-align:-50%" value="{$lang.q3.r2_2}" {foreach item=item key=key from=$data.2}{if $item.answer == $lang.q3.r2_2}checked{/if}{/foreach} /></td>
<td width="97%">{$lang.q3.r2_2}
</td>
</tr>
<tr>
<td width="3%"><input type="checkbox" name="q2_3" style="vertical-align:-50%" value="{$lang.q3.r2_3}" {foreach item=item key=key from=$data.2}{if $item.answer == $lang.q3.r2_3}checked{/if}{/foreach} /></td>
<td width="97%">{$lang.q3.r2_3}
</td>
</tr>
<tr>
<td width="3%"><input type="checkbox" name="q2_4" style="vertical-align:-50%" value="{$lang.q3.r2_4}" {foreach item=item key=key from=$data.2}{if $item.answer == $lang.q3.r2_4}checked{/if}{/foreach} /></td>
<td width="97%">{$lang.q3.r2_4}
</td>
</tr>
<tr>
<td width="3%"><input type="checkbox" name="q2_5" style="vertical-align:-50%" value="{$lang.q3.r2_5}" {foreach item=item key=key from=$data.2}{if $item.answer == $lang.q3.r2_5}checked{/if}{/foreach} /></td>
<td width="97%">{$lang.q3.r2_5}
</td>
</tr>
<tr>
<td width="3%"><input type="checkbox" name="q2_6" style="vertical-align:-50%" value="{$lang.q3.r2_6}" {foreach item=item key=key from=$data.2}{if $item.answer == $lang.q3.r2_6}checked{/if}{/foreach} /></td>
<td width="97%">{$lang.q3.r2_6}
</td>
</tr>
<tr>
<td width="3%"><input type="checkbox" name="q2_7" style="vertical-align:-50%" value="{$lang.q3.r2_7}" {foreach item=item key=key from=$data.2}{if $item.answer == $lang.q3.r2_7}checked{/if}{/foreach} /></td>
<td width="97%">{$lang.q3.r2_7}
</td>
</tr>
<tr>
<td width="3%"><input type="checkbox" name="q2_8" style="vertical-align:-50%" value="{$lang.q3.r2_8}" {foreach item=item key=key from=$data.2}{if $item.answer == $lang.q3.r2_8}checked{/if}{/foreach} /></td>
<td width="97%">{$lang.q3.r2_8}
</td>
</tr>
<tr>
<td width="3%"><input type="checkbox" name="q2_9" style="vertical-align:-50%" value="{$lang.q3.r2_9}" {foreach item=item key=key from=$data.2}{if $item.answer == $lang.q3.r2_9}checked{/if}{/foreach} /></td>
<td width="97%">{$lang.q3.r2_9}
</td>
</tr>
<tr>
<td width="3%"><input type="checkbox" name="q2_10" style="vertical-align:-50%" value="{$lang.q3.r2_10}" {foreach item=item key=key from=$data.2}{if $item.answer == $lang.q3.r2_10}checked{/if}{/foreach} /></td>
<td width="97%">{$lang.q3.r2_10}
</td>
</tr>
<tr>
<td width="3%"><input type="checkbox" name="q2_11" style="vertical-align:-50%" value="{$lang.q3.r2_11}" {foreach item=item key=key from=$data.2}{if $item.answer == $lang.q3.r2_11}checked{/if}{/foreach} /></td>
<td width="97%">{$lang.q3.r2_11}
</td>
</tr>
<tr>
<td width="3%"><input type="checkbox" name="q2_12" style="vertical-align:-50%" value="{$lang.q3.r2_12}" {foreach item=item key=key from=$data.2}{if $item.answer == $lang.q3.r2_12}checked{/if}{/foreach} /></td>
<td width="97%">{$lang.q3.r2_12}
</td>
</tr>
<tr>
<td width="3%"><input type="checkbox" name="q2_13" style="vertical-align:-50%" value="{$lang.q3.r2_13}" {foreach item=item key=key from=$data.2}{if $item.answer == $lang.q3.r2_13}checked{/if}{/foreach} /></td>
<td width="97%">{$lang.q3.r2_13}
</td>
</tr>
<tr>
<td width="3%"><input type="checkbox" name="q2_14" style="vertical-align:-50%" value="{$lang.q3.r2_14}" {foreach item=item key=key from=$data.2}{if $item.answer == $lang.q3.r2_14}checked{/if}{/foreach} /></td>
<td width="97%">{$lang.q3.r2_14}</td>
</tr>
</table>

<table border="0" width="100%">
  <tr>
    <td width="100%" colspan="2"><h3>3. {$lang.q3.3}</h3>
</td>
  </tr>
  <tr>
<td width="3%"><input type="hidden" name="q3" value="checkbox" /></td>
<td width="97%">
</td>
</tr>
<tr>
<td width="3%"><input type="checkbox" name="q3_1" style="vertical-align:-50%" value="{$lang.q3.r3_1}" {foreach item=item key=key from=$data.3}{if $item.answer == $lang.q3.r3_1}checked{/if}{/foreach} /></td>
<td width="97%">{$lang.q3.r3_1}
</td>
</tr>
<tr>
<td width="3%"><input type="checkbox" name="q3_2" style="vertical-align:-50%" value="{$lang.q3.r3_2}" {foreach item=item key=key from=$data.3}{if $item.answer == $lang.q3.r3_2}checked{/if}{/foreach} /></td>
<td width="97%">{$lang.q3.r3_2}
</td>
</tr>
<tr>
<td width="3%"><input type="checkbox" name="q3_3" style="vertical-align:-50%" value="{$lang.q3.r3_3}" {foreach item=item key=key from=$data.3}{if $item.answer == $lang.q3.r3_3}checked{/if}{/foreach} /></td>
<td width="97%">{$lang.q3.r3_3}
</td>
</tr>
<tr>
<td width="3%"><input type="checkbox" name="q3_4" style="vertical-align:-50%" value="{$lang.q3.r3_4}" {foreach item=item key=key from=$data.3}{if $item.answer == $lang.q3.r3_4}checked{/if}{/foreach} /></td>
<td width="97%">{$lang.q3.r3_4}
</td>
</tr>
<tr>
<td width="3%"><input type="checkbox" name="q3_5" style="vertical-align:-50%" value="{$lang.q3.r3_5}" {foreach item=item key=key from=$data.3}{if $item.answer == $lang.q3.r3_5}checked{/if}{/foreach} /></td>
<td width="97%">{$lang.q3.r3_5}
</td>
</tr>
<tr>
<td width="3%"><input type="checkbox" name="q3_6" style="vertical-align:-50%" value="{$lang.q3.r3_6}" {foreach item=item key=key from=$data.3}{if $item.answer == $lang.q3.r3_6}checked{/if}{/foreach} /></td>
<td width="97%">{$lang.q3.r3_6}
</td>
</tr>
<tr>
<td width="3%"><input type="checkbox" name="q3_7" style="vertical-align:-50%" value="{$lang.q3.r3_7}" {foreach item=item key=key from=$data.3}{if $item.answer == $lang.q3.r3_7}checked{/if}{/foreach} /></td>
<td width="97%">{$lang.q3.r3_7}
</td>
</tr>
<tr>
<td width="3%"><input type="checkbox" name="q3_8" style="vertical-align:-50%" value="{$lang.q3.r3_8}" {foreach item=item key=key from=$data.3}{if $item.answer == $lang.q3.r3_8}checked{/if}{/foreach} /></td>
<td width="97%">{$lang.q3.r3_8}
</td>
</tr>
<tr>
<td width="3%"><input type="checkbox" name="q3_9" style="vertical-align:-50%" value="{$lang.q3.r3_9}" {foreach item=item key=key from=$data.3}{if $item.answer == $lang.q3.r3_9}checked{/if}{/foreach} /></td>
<td width="97%">{$lang.q3.r3_9}
</td>
</tr>
<tr>
<td width="3%"><input type="checkbox" name="q3_10" style="vertical-align:-50%" value="{$lang.q3.r3_10}" {foreach item=item key=key from=$data.3}{if $item.answer == $lang.q3.r3_10}checked{/if}{/foreach} /></td>
<td width="97%">{$lang.q3.r3_10}
</td>
</tr>
<tr>
<td width="3%"><input type="checkbox" name="q3_11" style="vertical-align:-50%" value="{$lang.q3.r3_11}" {foreach item=item key=key from=$data.3}{if $item.answer == $lang.q3.r3_11}checked{/if}{/foreach} /></td>
<td width="97%">{$lang.q3.r3_11}
</td>
</tr>
<tr>
<td width="3%"><input type="checkbox" name="q3_12" style="vertical-align:-50%" value="{$lang.q3.r3_12}" {foreach item=item key=key from=$data.3}{if $item.answer == $lang.q3.r3_12}checked{/if}{/foreach} /></td>
<td width="97%">{$lang.q3.r3_12}
</td>
</tr>
<tr>
<td width="3%"><input type="checkbox" name="q3_13" style="vertical-align:-50%" value="{$lang.q3.r3_13}" {foreach item=item key=key from=$data.3}{if $item.answer == $lang.q3.r3_13}checked{/if}{/foreach} /></td>
<td width="97%">{$lang.q3.r3_13}
</td>
</tr>
<tr>
<td width="3%"><input type="checkbox" name="q3_14" style="vertical-align:-50%" value="{$lang.q3.r3_14}" {foreach item=item key=key from=$data.3}{if $item.answer == $lang.q3.r3_14}checked{/if}{/foreach} /></td>
<td width="97%">{$lang.q3.r3_14}
</td>
</tr>
<tr>
<td width="3%"><input type="checkbox" name="q3_15" style="vertical-align:-50%" value="{$lang.q3.r3_15}" {foreach item=item key=key from=$data.3}{if $item.answer == $lang.q3.r3_15}checked{/if}{/foreach} /></td>
<td width="97%">{$lang.q3.r3_15}
</td>
</tr>
<tr>
<td width="3%"><input type="checkbox" name="q3_16" style="vertical-align:-50%" value="{$lang.q3.r3_16}" {foreach item=item key=key from=$data.3}{if $item.answer == $lang.q3.r3_16}checked{/if}{/foreach} /></td>
<td width="97%">{$lang.q3.r3_16}
</td>
</tr>
<tr>
<td width="3%"><input type="checkbox" name="q3_17" style="vertical-align:-50%" value="{$lang.q3.r3_17}" {foreach item=item key=key from=$data.3}{if $item.answer == $lang.q3.r3_17}checked{/if}{/foreach} /></td>
<td width="97%">{$lang.q3.r3_17}
</td>
</tr>
<tr>
<td width="3%"><input type="checkbox" name="q3_18" style="vertical-align:-50%" value="{$lang.q3.r3_18}" {foreach item=item key=key from=$data.3}{if $item.answer == $lang.q3.r3_18}checked{/if}{/foreach} /></td>
<td width="97%">{$lang.q3.r3_18}
</td>
</tr>
<tr>
<td width="3%"><input type="checkbox" name="q3_19" style="vertical-align:-50%" value="{$lang.q3.r3_19}" {foreach item=item key=key from=$data.3}{if $item.answer == $lang.q3.r3_19}checked{/if}{/foreach} /></td>
<td width="97%">{$lang.q3.r3_19}</td>
</tr>
</table>

<h3>4. {$lang.q3.4}</h3>
<textarea name="q4" rows="10" cols="50">{$data.4.1.answer }</textarea>

<h3>5. {$lang.q3.5}</h3>
<textarea name="q5" rows="10" cols="50">{$data.5.1.answer }</textarea>

<h3>6. {$lang.q3.6}</h3>
<textarea name="q6" rows="10" cols="50">{$data.6.1.answer }</textarea>

<h3>7. {$lang.q3.7}</h3>
<textarea name="q7" rows="10" cols="50">{$data.7.1.answer }</textarea>

<h3>8. {$lang.q3.8}</h3>
<textarea name="q8" rows="10" cols="50">{$data.8.1.answer }</textarea>

<h3>9. {$lang.q3.9}</h3>
<textarea name="q9" rows="10" cols="50">{$data.9.1.answer }</textarea>
<br/>
<input type="submit" class="formbutton" value="{$lang.save}" name="edit"/>
</form>
</div>
	</td>
</tr>
</table>