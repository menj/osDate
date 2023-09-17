<script type="text/javascript">
function checkme()
{ldelim}
	return confirm("{lang mkey='delzips_msg'}");
{rdelim}

</script>
{strip}
{assign var="page_hdr01_text" value="{lang mkey='load_zips'}"}
{assign var="page_title" value="{lang mkey='load_zips'}"}
{include file="admin/admin_page_hdr01.tpl"}
<div class="module_detail_inside" style="padding-top:1px;text-align:left;">
	{if $msg != ''}
		{assign var="error_message"  value=$msg}
		{include file="display_error.tpl"}
	{/if}
	<div class="line_outer">
		<div class="line_top_bottom_pad">
			{lang mkey='zip_ensure'}<br />
		</div>
		<div class="line_top_bottom_pad">
			<form action="" method=post>
			<table border="0">
				<tr><td width="30%">{lang mkey='country'}:</td>
					<td width="70%">
						<select name="cntry" >
						{html_options options=$lang.countries selected=$cntry}
						</select>
					</td>
				</tr>
				<tr><td width="30%">{lang mkey='zipfile'}:</td>
					<td width="70%">
						<select name="zipsdir">
						{html_options values=$files output=$files selected=$zipsdir}
						</select>
					</td>
				</tr>
				<tr>
					<td colspan=2>
						<input type=submit  class="formbutton" name="loadzip" value="{lang mkey='load_zips_button'}" />&nbsp;&nbsp;
						<input type=submit  class="formbutton" name="delzip" value="{lang mkey='delete_zips'}" onclick="javascript: return checkme();" />&nbsp;&nbsp;
					</td>
				</tr>
			{if $filestoload|@count > 0}
				<tr><td height="4"></td></tr>
				<tr><td colspan="2"><b>{lang mkey="split_file_names_hdr"} (Total of {$filestoload|@count} files from {$filesdir})</b></td></tr>
				<tr><td height="2"></td></tr>
				<tr><td colspan=2><b>This may take some time. Please wait until all files are loaded.</b></td></tr>
				<tr><td height="2" colspan="2"><hr size="1" /></td></tr>
				<tr>
					<td colspan="2" >
						<iframe src="{$DOC_ROOT}{$smarty.const.ADMIN_DIR}load_zips_split.php?cntry={$cntry}&amp;cnt=1" id="splitfileload_section" scrolling="auto" frameborder="0" width="100%" height="300"  style="text-align: center;">
						<center>Sorry, your browser doesn\'t support frames.</center>
						</iframe>
					</td>
				</tr>
			{/if}
			</table>
			</form>
		</div>
	</div>
</div>
{/strip}