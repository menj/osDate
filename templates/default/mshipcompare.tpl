{strip}
<div class="module_detail"  style="width:99.9%;vertical-align:top;display:inline; float:left;" >
	{assign var="page_hdr02_text" value="{lang mkey='permitmsg_3'}"}
	{include file="page_hdr02.tpl"}

	<table id="div_hide_mcomp"  width="100%" border="0" cellspacing="{$config.cellspacing}"  cellpadding="{$config.cellpadding}" align="center">
		<tr class="column_head">
			<th align="center">{lang mkey='privileges_msg'}</th>
		{foreach item=item key=key from=$memberships}
			<th align="center">{$item}</th>
		{/foreach}
		</tr>
		{foreach from=$m_row key=key item=row}
			{if $key ne 'price' and $key ne 'currency' and $key != 'hide' }
		<tr class="{cycle  values="oddrow,evenrow"}">
			<td>
				{mylang mkey='privileges' skey=$key}
			</td>
			{foreach item=item from=$row key=key1}
			<td align="center">
				{if $key != 'hide'}
				{if  $key == 'uploadpicturecnt' or $key =='message_keep_cnt' or $key =='message_keep_days' or $key=='messages_per_day' or $key=='winks_per_day' or $key == 'saveprofilescnt' or $key == 'videoscnt' or $key == 'profilepicscnt' }
					{$item|default:0}
				{elseif $key == 'activedays'}
					{mylang mkey='activedays_array' skey=$item}
				{elseif $item == 1} {*<img src="{$image_dir}tick.jpg" border="0" alt="" />*}<b>x</b>{* <img src="{$image_dir}cross.jpg" border="0" alt="" />*}
				{/if}
				{/if}
			</td>
			{/foreach}
		</tr>
			{/if}
		{/foreach}
		<tr><td colspan="4">&nbsp;</td></tr>
		<tr class="column_head">
			<th align="right">{lang mkey='price'}&nbsp;</th>
		{section name=item loop=$m_row.price}
			<th>
				{mylang mkey="support_currency" skey=$m_row.currency[item]}
				{$m_row.price[item]}
			</th>
		{/section}
		</tr>
	</table>
</div>
<div style="clear:both;"></div>
{/strip}
