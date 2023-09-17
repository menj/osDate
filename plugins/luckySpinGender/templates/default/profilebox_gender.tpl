{strip}
 <table border="0" width="100%" >
	<tr>
	   <td align="center" height="20" width="100%">
			{$luckygender.age}, {if $luckygender.cityname != ''}{$luckygender.cityname},{/if} {if $luckygender.statename != ''}{$luckygender.statename},{/if} {$luckygender.countryname}
	   </td>
	</tr>
	<tr>
	   <td ><div align="center">
			{if $config.enable_mod_rewrite == 'Y'}
				<a href="javascript:popUpScrollWindow2('{$docroot}{if $config.seo_username == 'Y'}{$luckygender.username}{else}{$luckygender.id}.htm{/if}','top',650,600)">
			{else}
				<a href="javascript:popUpScrollWindow2('{$docroot}showprofile.php?id={$luckygender.id}','top',650,600)">
			{/if}
			<img src="getsnap.php?id={$luckygender.id}&amp;typ=tn" class="smallpic" alt="" />
			</a>
			</div>
	   </td>
	</tr>
	<tr>
	   <td align="center" height="20">
			{if $config.enable_mod_rewrite == 'Y'}
				<a href="javascript:popUpScrollWindow2('{$docroot}{if $config.seo_username == 'Y'}{$luckygender.username}{else}{$luckygender.id}.htm{/if}','top',650,600)">
			{else}
				<a href="javascript:popUpScrollWindow2('{$docroot}showprofile.php?id={$luckygender.id}','top',650,600)">
			{/if}
			{$lang.view_profile}</a>&nbsp;&nbsp;&nbsp;&nbsp;
			<b><a href="javascript:spinAgainGender('{$spinGender}');">{$lang.spin_again}</a></b>
	   </td>
	  </tr>
 </table>

{/strip}