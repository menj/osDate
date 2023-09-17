{strip}
<div >
	{assign var="page_hdr01_text" value="{lang mkey='featured_profiles'}"|cat:$fphdr02}
	{include file="page_hdr01.tpl"}
	<div class="module_detail_inside" >

	{if $featured_profiles|@count > 0}
			{assign var="ccount" value="0"}
		{if $config.featuredprofiles_display == 'tiny'}
			{foreach item="item" key=key from=$featured_profiles}
			{if $ccount==0}
				<div>
			{/if}
				<div style="display:inline; float:left; width:19%; vertical-align:top; margin-top:2px; margin-left: 3px;">
					{include file="smallprofile.tpl"}
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
			{foreach item="item" key=key from=$featured_profiles}
			{if $ccount==0}
				<div>
			{/if}
				<div style="display:inline; float:left; width:49.4%; vertical-align:top; margin-top:2px; margin-left: 3px;">
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
	{else}
		<div style="padding:2px 5px;">
			{mylang mkey='no_record_found'}
		</div>
	{/if}
	</div>
</div>
<br />
{/strip}