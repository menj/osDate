{strip}
<script type="text/javascript">
function spinAgainGender(spinGender) {ldelim}
    osDatehttp.open('get', '{$smarty.const.DOC_ROOT}plugins/luckySpinGender/libs/spinAgain.php?spinGender='+spinGender);
    osDatehttp.onreadystatechange = osDatehandleResponse;
    osDatehttp.send(null);
{rdelim}
</script>
{if $FemaleProfile != ''}
	<div class="module_detail" >
		{assign var="leftcolumn_item_hdr_text" value="{lang mkey='random_female_member'}" }
		{include file="leftcolumn_item_hdr.tpl"}
		<div id="luckySpin_F">
		{$FemaleProfile}
		</div>
	</div>
{elseif $MaleProfile != ''}
	<div  class="module_detail" >
		{assign var="leftcolumn_item_hdr_text" value="{lang mkey='random_male_member'}"}
		{include file="leftcolumn_item_hdr.tpl"}
		<div id="luckySpin_M">
		{$MaleProfile}
		</div>
	</div>
{/if}
{/strip}