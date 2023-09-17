{strip}
{literal}
<script type="text/javascript">
/* <![CDATA[ */
	function addToPrivate(username)
	{	if(!window.opener)
		{
{/literal}
			alert("{lang mkey='main_window_closed'}");
{literal}
			return;
		}
		oForms=window.opener.document.forms;
		for(i=0;i<oForms.length;i++)
		{	if(oForms[i]["txtprivate_to"])
			{ tValue=oForms[i]["txtprivate_to"].value;
			  if(tValue!="")
			    tValue+=", "+username;
			  else
			    tValue=username;
			  oForms[i]["txtprivate_to"].value=tValue;
{/literal}
			alert("{lang mkey='user_added1'}"+username+"{lang mkey='user_added2'}");
{literal}
			}
		}
	}
/* ]]> */
</script>
{/literal}
<table width="100%" border="0" cellpadding="0" cellspacing="0" >
	<tr>
		<td class="module_detail_inside" width="100%" >

			{assign var="page_hdr02_text" value=$item.username}
			{include file="page_hdr02.tpl"}
			<table border="0" width="100%">
				<tr>
					<td valign="top">
						<table border="0" width="100%">
							<tbody>
								<tr class="addrow">
									<td valign="top" ><b>{lang mkey='age'}:</b></td>
									<td>{$item.age}</td>
								</tr>
								<tr class="evenrow">
									<td valign="top" ><b>{lang mkey='sex'}</b></td>
									<td>{mylang mkey='signup_gender_values' skey=$item.gender}</td>
								</tr>
								<tr class="addrow">
									<td valign="top" ><b>{lang mkey='looking_for'}:</b></td>
									<td>{mylang mkey='signup_gender_look' skey=$item.lookgender}</td>
								</tr>
								<tr class="evenrow">
									<td valign="top" ><b>{lang mkey='location_col'}</b></td>
									<td>{if $item.city != ''}
										{$item.city},<br />
									{/if}
									{if $item.statename != ''}
										{$item.statename},<br />
									{/if}
									{if $item.countryname != ''}
										{$item.countryname}
									{/if}</td>
								</tr>
							</tbody>
						</table>
					</td>
					<td>
						<table border="0">
							<tbody>
							<tr>
								<td width="100">
								{if $config.enable_mod_rewrite == 'Y'}
									<a href="#" onclick="javascript:popUpScrollWindow('{$item.id}.htm','center',650,600)">
								{else}
									<a href="#" onclick="javascript:popUpScrollWindow('showprofile.php?id={$item.id}','center',650,600)">
								{/if}
									<img src="getsnap.php?id={$item.id}&amp;typ=tn" class="smallpic" alt="" />
									</a>
								</td>
							</tr>
							</tbody>
						</table>
					</td>

				</tr>
				<tr>
					<td colspan="2"  align="center" height="20" class="statusbar">
						{if $config.enable_mod_rewrite == 'Y'}
							<a href="#" onclick="javascript:popUpScrollWindow('{$item.id}.htm','top',650,600)">{lang mkey='view_profile'}</a>
						{else}
							<a href="#" onclick="javascript:popUpScrollWindow('showprofile.php?id={$item.id}','top',650,600)">{lang mkey='view_profile'}</a>
						{/if}
						&nbsp;<a href="#" onclick="javascript:addToPrivate('{$item.username}');">{lang mkey='add_to_private'}</a>
					</td>
				</tr>
			</table>

		</td>
	</tr>
</table>
<br />
{/strip}
