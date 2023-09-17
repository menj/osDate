{strip}
{if $bdpusers|@count > 0}
<div>
	{assign var="page_hdr01_text" value="{lang mkey='birthday_profiles'}"|cat:$bdphdr02}
	{include file="page_hdr01.tpl"}
	<div class="module_detail_inside">
		{assign var="ccount" value="0"}
		{foreach item="item" key=key from=$bdpusers}
		{if $ccount==0}
			<div>
		{/if}
			<div style="display:inline; float:left; width:19%; vertical-align:top; margin-top:2px; margin-left: 3px;">
				{include file="min_profile.tpl"}
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
	</div>
</div>
<br />
{/if}
{/strip}