<div class="headbg" >
	{if $config.use_profilepopups == 'Y'}
	<div style="text-align:center;  vertical-align: middle;">
		<a href="/" class="main_title">{lang mkey='site_name'}</a>
	</div>
	{/if}
	<div  style="height: 23px; vertical-align:middle;" class="headerfooter">
		<div class="headerfooter" style="display:inline; float:left;text-align:left; width:49.5%; padding-left:6px;padding-top: 4px; height:19px; ">
			{$title}
		</div>
		<div class="headerfooter" style="text-align:right; display:inline; float:left; width:48%;padding-top: 4px;  height:19px;" >
			{lang mkey='lastlogged'}&nbsp;{if $user.lastvisit >0}{$user.lastvisit|date_format:$lang.DATE_FORMAT}{else}{mylang mkey='unknown'}{/if}&nbsp;
		</div>
		<div style="clear:both;"></div>
	</div>
</div>