{strip}
{if $profpicsusers|@count > 0}
<div style="height:100%">
	{var page_hdr01_text="{lang mkey='newest_profpics_hdr'}"|cat:$profpicshdr02}
	{include file="page_hdr01.tpl"}
	<div class="module_detail_inside" >
	{var linkis="profpic" }
	{if $config.newest_profpics_display=='tiny'}
		{assign var="ccount" value="0"}

		{foreach item="item" key=key from=$profpicsusers}

		{if $ccount==0}
			<div>
		{/if}
			<div style="display:inline; float:left; width:19%; vertical-align:top; margin-top:2px; margin-left: 3px;">
				{include file="smallest_profdisp.tpl"}
			</div>
		{if $ccount==4}
				<div style="clear:both;"></div>
			</div>
		{/if}
			{math equation="$ccount+1" assign="ccount"}
			{math equation="$ccount%5" assign="ccount"}
		{/foreach}
		{if $ccount>0}
				<div style="clear:both;"></div>
			</div>
		{/if}
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