{strip}
<div class="module_detail_inside">
	<div class="module_head" style="height:22px;">
		<div style="width:24px; float:left; padding-left:6px;">
			<input type='radio' name='payment' value='free' {if $smarty.get.payment eq 'free' or $data|@count eq '0'} checked {/if} />
		</div>
		<div style="float:left; display:inline; padding-top:3px;">
			{lang mkey='no_payment'}
		</div>
		<div style="clear:both;"></div>
	</div>
</div>
{/strip}
