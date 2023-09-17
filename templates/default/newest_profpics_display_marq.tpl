{strip}
{if $profpicsusers|@count > 0}
<div style="height:100%">
	{assign var="page_hdr01_text" value="{lang mkey='newest_profpics_hdr'}"|cat:$profpicshdr02}
	{include file="page_hdr01.tpl"}
	<div class="module_detail_inside" style="height:155px;">
	{assign var="linkis" value="profpic" }
	{if $config.newest_profpics_display=='tiny'}
		<marquee onmouseover="stop(this);" onmouseout="start(this);" behavior="scroll" direction="right" height="150" loop="infinite" scrollamount="1.5" scrolldelay="1" width="100%">
		<table border="0" cellspacing="0" cellpadding="0" >
		<tr height="150px">
		{foreach item="item" key=key from=$profpicsusers}
			<td valign="top">
				{include file="smallest_profdisp.tpl"}
			</td>
		{/foreach}
		</tr>
		</table>
		</marquee>
	{else}
		{foreach item=item key=key from=$profpicsusers}
		{if $ccount==0}
			<div>
		{/if}
			<div style="display:inline; float:left; width:49%; vertical-align:top; margin-top:2px; margin-left: 3px;">
				{include file="userresultviewsmall.tpl"}
			</div>
		{if $ccount==1}
				<div style="clear:both;"></div>
			</div>
		{/if}
			{math equation="$ccount+1" assign="ccount"}
			{math equation="$ccount%2" assign="ccount"}
		{/foreach}
		{if $ccount==1}
				<div style="clear:both;"></div>
			</div>
		{/if}

	{/if}
	</div>
</div>
<br />
{/if}
{/strip}