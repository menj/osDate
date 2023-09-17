<div class="module_detail top_bottom_pad">
{var page_hdr02_text=$title|cat:" > "|cat:$item.question}
{include file='page_hdr02.tpl'}
<br/>
<div style="padding-left:6px; padding-right:4px;padding-top:4px; padding-bottom:4px;">
	{$item.descr}
</div>
<table border="0" width="100%">
{var col="0" }
{foreach item=item1 key=qcid from=$item.answers}
{if $col == "0"}
	<tr class="{cycle values="oddrow,evenrow"}">
{/if}
		<td width="{$colwidth}"  nowrap="nowrap">
			<table border="0" width="100%">
				<tr>
					<td width="8%" valign="middle">
					{if $ou=="0"}
						<input type="checkbox" style="vertical-align:-50%" name="q{$item.qid}_{$qcid}" {if $item1.answer=="1"}checked="checked"{/if} />
					{else}
				     	{if $item1.answer=='1' && $item1.comp_answer=='1'}<b>X</b>
				     	{elseif $item1.answer=='1' && $item1.comp_answer!='1'}*
				     	{elseif $item1.comp_answer=='1'}x
				     	{/if}
				     {/if}
					</td>
					<td width="92%" valign="middle">
						{$item1.descr}
					</td>
				</tr>
			</table>
		</td>
	{assign var="col" value=$col+1}
	{if $col == $showopt}
		{var col="0"}
		</tr>
	{/if}
{/foreach}
{if $col > 0 && $col < $showopt}</tr>{/if}
</table>
</div>
<br/><br/>