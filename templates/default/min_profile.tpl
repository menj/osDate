{strip}
<div class="module_detail">
	<div class="module_head" style="padding-left: 6px;" align="center">
		{$item.username}
	</div>
	<div style="text-align:center;margin-top:2px;">
		({$item.age} {mylang mkey='signup_gender_values' skey=$item.gender}, {$item.countryname})
	</div>
	<div style="text-align:center;margin-top:2px;">
		{if  $smarty.session.UserId != '' }
			<a href="{$docroot}send_birthday_message.php?id={$item.id}" class="textcolor">
			<img src="getsnap.php?id={$item.id}&amp;typ=tn&amp;height=100" class="smallpic" alt="" />
			</a>
		{/if}
	</div>
	<div class="line_top_bottom_pad"  align="center">
		{checkuser userid=$item.id checkfor='online'}
	</div>
</div>
{/strip}
