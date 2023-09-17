<center>
<table width="550" border="0" cellpadding="0" cellspacing="0" >
	<tr>
		<td class="module_detail_inside" width="100%">
			<table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr>
					<td class="module_head" width="6"></td>
					<td class="module_head" width="526">
					{$lang.request1}
					</td>
					<td width="28"><img src="{$image_dir}blue_hor2.jpg" width="28" height="23" alt="" /></td>
				</tr>
			</table>

      <input type="hidden" name="search" value="{$search}" />

			<table class="table" cellspacing="{$config.cellspacing}" cellpadding="{$config.cellpadding}" width="550" border="0">
	  		<tbody>
	  		{assign var="mcount" value="0"}
	  		{foreach item=item key=key from=$data}
	  		{math equation="$mcount+1" assign="mcount"}
		  		<tr>
	  				<td width="20%" align="center">{$item.username}</td>
	  				<td align="left">
						{if $config.enable_mod_rewrite == 'Y'}
							<a href="javascript:popUpScrollWindow2('{$docroot}{if $config.seo_username == 'Y'}{$item.username}{else}{$item.friend}.htm{/if}','top',650,600)">
						{else}
							<a href="javascript:popUpScrollWindow2('{$docroot}showprofile.php?{if $config.seo_username == 'Y'}username={$item.username}{else}id={$item.friend}{/if}','top',650,600)">
						{/if}
	  					{$lang.view_profile}</a> - <a href="?plugin={$plugin_name}&amp;remove={$item.friend}&amp;do=myrequests">{$lang.remove_request}</a></td>
	 			</tr>
	 		{/foreach}
	 		{if $data|@count == 0}
	 	 		<tr>
	  				<td style="padding-left: 6px;">{$lang.norequests}</td>
	 			</tr>
	 		{/if}
  			</tbody>
			</table>
		</td>
	</tr>
</table>
</center>