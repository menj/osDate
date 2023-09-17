{strip}
{assign var="page_hdr01_text" value='<a href="plugin.php?plugin='|cat:$plugin_name|cat:'" class="subhead">'|cat:$lang.user_title|cat:'</a> - > <a href=plugin.php?plugin='|cat:$plugin_name|cat:'&amp;showforms=0 class="subhead">'|cat:$lang.showforms|cat:'</a>'}
{include file="admin/admin_page_hdr01.tpl"}

<center>
<table width="100%" border="0" cellpadding="0" cellspacing="0" >
	<tr>
		<td class="module_detail_inside" width="100%">
		<br/>
			{assign var="page_hdr02_text" value=$lang.forminfo}
			{include file="admin/admin_page_hdr02.tpl"}
			<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
				<tr>
					<td>
						<table width="100%" cellspacing="{$config.cellspacing}" cellpadding="{$config.cellpadding}" border="0">
							<tr class="table_head">
								<th width="100%" colspan="2" align="left">{$lang.form1}</th>
							</tr>
							<tr class="{cycle values="oddrow,evenrow"}">
			  					<td width="30%">Males:</td>
			  					<td >{$form.gender.male}</td>
							</tr>
							<tr class="{cycle values="oddrow,evenrow"}">
			  					<td width="30%" >Females:</td>
			  					<td >{$form.gender.female}</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
			<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
				<tr>
					<td>
						<table width="100%" cellspacing="{$config.cellspacing}" cellpadding="{$config.cellpadding}" border="0">
							<tr class="table_head">
								<th width="100%" colspan="2" align="left">{$lang.form2}</th>
							</tr>
							{if $form.ethnicity.0.number > 0}
							<tr class="{cycle values="oddrow,evenrow"}">
			  					<td width="30%">{$lang.etn1}:</td>
			  					<td >{$form.ethnicity.0.number}</td>
							</tr>
							{/if}
							{if $form.ethnicity.1.number > 0}
							<tr class="{cycle values="oddrow,evenrow"}">
			  					<td width="30%" >{$lang.etn2}:</td>
			  					<td >{$form.ethnicity.1.number}</td>
							</tr>
							{/if}
							{if $form.ethnicity.2.number > 0}
							<tr class="{cycle values="oddrow,evenrow"}">
			  					<td width="30%">{$lang.etn3}:</td>
			  					<td >{$form.ethnicity.2.number}</td>
							</tr>
							{/if}
							{if $form.ethnicity.3.number > 0}
							<tr class="{cycle values="oddrow,evenrow"}">
			  					<td width="30%" >{$lang.etn4}:</td>
			  					<td >{$form.ethnicity.3.number}</td>
							</tr>
							{/if}
							{if $form.ethnicity.4.number > 0}
							<tr class="{cycle values="oddrow,evenrow"}">
			  					<td width="30%" >{$lang.random}:</td>
			  					<td >{$form.ethnicity.4.number}</td>
							</tr>
							{/if}
						</table>
					</td>
				</tr>
			</table>
			<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
				<tr>
					<td>
						<table width="100%" cellspacing="{$config.cellspacing}" cellpadding="{$config.cellpadding}" border="0">
							<tr class="table_head">
								<th width="100%" colspan="2" align="left">{$lang.form3}</th>
							</tr>
							{foreach item=item key=key from=$form.age}
							{if $item.min > 0}
							<tr class="{cycle values="oddrow,evenrow"}">
			  					<td width="30%">{$lang.between} {$item.min} {$lang.and} {$item.max}:</td>
			  					<td >{$item.number}</td>
							</tr>
							{/if}
							{/foreach}
						</table>
					</td>
				</tr>
			</table>
			<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
				<tr>
					<td>
						<table width="100%" cellspacing="{$config.cellspacing}" cellpadding="{$config.cellpadding}" border="0">
							<tr class="table_head">
								<th width="100%" colspan="2" align="left">{$lang.form4}</th>
							</tr>
							{foreach item=item key=key from=$form.country}
							{cycle values="oddrow,evenrow" assign="class"}
							<tr class="{$class}">
			  					<td width="30%"  class="{$class}">{if $item.country == ''}{$lang.random}{else}{$item.country}{/if}:</td>
			  					<td  class="{$class}">{$item.number}</td>
							</tr>
							{/foreach}
						</table>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
<br/>
<table width="100%" border="0" cellpadding="0" cellspacing="0" >
	<tr>
		<td class="module_detail_inside" width="100%">
			{assign var="page_hdr02_text" value=$lang.total_users|cat:' '|cat:$total}
			{include file="admin/admin_page_hdr02.tpl"}
			<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
				<tr>
					<td>
						<table width="100%" cellspacing="{$config.cellspacing}" cellpadding="{$config.cellpadding}" border="0">
							<tr class="table_head">
								<th>#</th>
   		  					    <th>{$lang.username}</th>
   		  					    <th>{$lang.fullname}</th>
   		  					    <th>{$lang.gender}</th>
   		  					    <th>{$lang.country}</th>
   		  					    <th>{$lang.birth_date}</th>
			  					<th>{lang mkey='action'}</th>
							</tr>
							{assign var="n" value=$start}
						{foreach item=item key=key from=$data}
							{math equation="$n+1" assign="n" }
							<tr class="{cycle values="oddrow,evenrow"}">
			  					<td >{$n}</td>
			  					<td ><a href="javascript:popUpScrollWindow('showprofile.php?{if $config.seo_username == 'Y'}username={$item.username}{else}id={$item.id}{/if}','top',650,600)">{$item.username}</a></td>
			  					<td >{$item.fullname}</td>
			  					<td align="center">{$item.gender}</td>
			  					<td >{$item.country}</td>
			  					<td >{$item.birth_date|date_format:$dateformat}</td>
								<td align="center"><a href="profile.php?edit={$item.id}"><img src="images/button_edit.png" border="0" alt="" /></a></td>
							</tr>
						{/foreach}
						</table>
					</td>
				</tr>
			</table>
			<br/>
			<center>{if $yprev == 1}<a href="{$previous}">{$lang.previous}</a>{/if} {if $ynext == 1}{if $yprev == 1}-{/if}{/if} {if $ynext == 1}<a href="{$next}">{$lang.next}</a>{/if}</center>
			<br/>
		</td>
	</tr>
</table>
</center>
{/strip}