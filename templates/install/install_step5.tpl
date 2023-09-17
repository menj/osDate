{include file='install/install_hdr02.tpl'}
		<b><font color=green style="font-size:12px">Database connection successful.{* using following parameters.*}</font></b><br />{*<span style="margin-left:12px; ">
		Database host: {$dbhost}<br /></span><span style="margin-left:12px; ">
		Database type: {$dbtype}<br /></span><span style="margin-left:12px; ">
		Database name: {$dbname}<br /></span><span style="margin-left:12px; ">
		Database user: {$dbuser}<br /></span><span style="margin-left:12px; ">
		Database password: {$dbpasswd}<br /></span>*}
		{* <font style="font-size:12px">
		{if $config_opt != 'U'}
			<span style="margin-left:12px; ">
			<b>{$prefix}</b> will be new table prefix.
			<br /><br /></span>Following additional information will be used<br /><span style="margin-left:12px; ">
			Document root: {$docroot}<br /></span><span style="margin-left:12px; ">
			Admin. password: {$admin_password}<br /></span><span style="margin-left:12px; ">
			Default country: {$countryName}<br /></span>
			{if $langType != 'lang_english'}
				<span style="margin-left:12px; ">In addition to English language file, {$langName} language file will also be loaded.</span>
			{/if}
		{/if}
		</font> *}
	</td>
</tr>
<tr><td colspan=2></td></tr>
<tr><td colspan=2 class=subtitle>Step {$dispstep}:
{if $config_opt != 'U'}
	Database creation and system and sample data loading
{else}
	Database upgrade process
{/if}
</td></tr>
<tr><td colspan=2>
	<table width="100%" bgcolor="#EEEEEE" class=normal style="border:1px solid #000000">

