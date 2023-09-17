{strip}
<div style="vertical-align:top;" >
	{assign var="page_hdr01_text" value="{lang mkey='success_stories'}"}
	{assign var="page_title" value="{lang mkey='success_stories'}"}
	{assign var="page_hdr01_text_r" value="<a href='index.php?page=stories' class='module_head'>"|cat:"{lang mkey='back'}"|cat:"</a>"}
	{include file="page_hdr01.tpl"}
	<div class="module_detail_inside">
		<div class="line_outer">
		{foreach item=row from=$data}
			<div class="line_top_bottom_pad">
				<span class="storyhead">{$row.header|stripslashes}</span><br/>
				<span class="storydate">{$row.date}</span><br/>
			{if $row.sender != ''}
				<span class="storyby">{lang mkey='by'}&nbsp;
				{if $config.enable_mod_rewrite == 'Y'}
					<a href="javascript:popUpScrollWindow2('{$docroot}{if $config.seo_username == 'Y'}{$row.username}{else}{$row.sender}.htm{/if}','top',650,600)">{$row.username}</a>
				{else}
					<a href="javascript:popUpScrollWindow2('{$docroot}showprofile.php?{if $config.seo_username == 'Y'}username={$row.username}{else}id={$row.sender}{/if}','top',650,600)">{$row.username}</a>
				{/if}
				</span>
			{/if}
			<br /><br />
			<span class="storytext">{$row.text|stripslashes}</span><br/>
			</div>
		{/foreach}
		</div>
	</div>
</div>
{/strip}
