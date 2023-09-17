{strip}
<script type="text/javascript">
function spinAgain(spinGender) {ldelim}
    osDatehttp.open('get', '{$smarty.const.DOC_ROOT}plugins/luckySpin/libs/spinAgain.php?spinGender='+spinGender);
    osDatehttp.onreadystatechange = osDatehandleResponse;
    osDatehttp.send(null);
{rdelim}
</script>
<table width="100%" border="0" cellpadding="0" cellspacing="0" >
   <tr>
      <td width="100%" >

			{assign var="leftcolumn_item_hdr_text" value=$lang.lucky_spin}
			{include file="leftcolumn_item_hdr.tpl"}
		</td>
	</tr>
	<tr>
		<td width="100%" class="leftside_detail" >

         <table border="0" width="100%" >
            <tr>
               <td align="center" height="20" width="100%">
               		{$lucky.age}, {if $lucky.cityname != ''}{$lucky.cityname},{/if} {if $lucky.statename != ''}{$lucky.statename},{/if} {$lucky.countryname}
               </td>
            </tr>
            <tr>
               <td ><div align="center">
					{if $config.enable_mod_rewrite == 'Y'}
						<a href="javascript:popUpScrollWindow2('{$docroot}{if $config.seo_username == 'Y'}{$lucky.username}{else}{$lucky.id}.htm{/if}','top',650,600)">
					{else}
						<a href="javascript:popUpScrollWindow2('{$docroot}showprofile.php?id={$lucky.id}','top',650,600)">
					{/if}
                    <img src="getsnap.php?id={$lucky.id}&amp;typ=tn" class="smallpic" alt="" />
                    </a>
					</div>
               </td>
            </tr>
            <tr>
               <td align="center" height="20">
					{if $config.enable_mod_rewrite == 'Y'}
						<a href="javascript:popUpScrollWindow2('{$docroot}{if $config.seo_username == 'Y'}{$lucky.username}{else}{$lucky.id}.htm{/if}','top',650,600)">
					{else}
						<a href="javascript:popUpScrollWindow2('{$docroot}showprofile.php?id={$lucky.id}','top',650,600)">
					{/if}
					{$lang.view_profile}</a>&nbsp;&nbsp;&nbsp;&nbsp;
					<b><a href="javascript:spinAgain('');">{$lang.spin_again}</a></b>
               </td>
              </tr>
         </table>

      </td>
   </tr>
</table>
<br />
{/strip}