{strip}
<div style="vertical-align:top;" >
	{assign var="page_hdr01_text" value="{lang mkey='mship_changed'}"}
	{assign var="page_title" value="{lang mkey='mship_changed'}"}
	{include file="page_hdr01.tpl"}
	<div class="module_detail_inside">
		<div class="line_outer">
			{lang mkey='success_mship_change'} <b>{$level}</b>.
			<br /><br />
			{lang mkey='logout_login'}
		</div>
	</div>
</div>
{/strip}
