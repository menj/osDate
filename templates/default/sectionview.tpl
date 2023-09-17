{strip}
<div style="vertical-align:top;" >

	{assign var="page_hdr02_text" value=$item.SectionName}
	{include file="page_hdr02.tpl"}
	<div class="module_detail_inside">
		<div class="line_outer">

			<table width="100%" cellpadding="{$config.cellpadding}" cellspacing="{$config.cellspacing}">
			{assign var="previd" value="0"}
			{foreach item=subitem from=$item.preferences}

				{if $subitem.type == "select" || $subitem.type == "radio"}
					<tr class="{cycle values="oddrow,evenrow"}">
						<td valign="top"><b>{mylang mkey='extsearchhead' skey=$subitem.extsearchhead}: </b></td>
						<td>
							{if $subitem.options != ''}
								{$subitem.options}
							{else}
								{lang mkey='tell_later'}
							{/if}
						</td>
					</tr>

				{elseif $subitem.type == "textarea"}
					<tr class="{cycle values="oddrow,evenrow"}">
						<td valign="top" ><b>{mylang mkey='extsearchhead' skey=$subitem.extsearchhead}: </b></td>
						<td>
							{if $subitem.options != ''}
								{$subitem.options|stripslashes}
							{else}
								{lang mkey='tell_later'}
							{/if}
						</td>
					</tr>

				{elseif $subitem.type == "checkbox"}

					<tr class="{cycle values="oddrow,evenrow"}">
						<td valign="top"><b>{mylang mkey='extsearchhead' skey=$subitem.extsearchhead}: </b></td>
						<td>
							{if $subitem.options != '' and $subitem.options != ', '}
								{$subitem.options}
							{else}
								{lang mkey='tell_later'}
							{/if}
						</td>
					</tr>

				{/if}

			{/foreach}
			{assign var="previd" value=$item.id}
			</table>
		</div>
	</div>
</div>
{/strip}

