{strip}
{assign var="page_hdr01_text" value='<a href="import.php" class="subhead">'|cat:"{lang mkey='manage_import'}"|cat:'</a> > '|cat:"{lang mkey='manage_import_aedating'}"}
{assign var="page_title" value="{lang mkey='manage_import'} - "|cat:"{lang mkey='manage_import_aedating'}"}
{include file="admin/admin_page_hdr01.tpl"}
{if $message != ''}
	{assign var="error_message" value=$error}
	{include file="display_error.tpl"}
{/if}

<div class="module_detail_inside top_margin_6px">
	{assign var="page_hdr02_text" value="{lang mkey='import_db_configuration'}"}
	{include file="admin/admin_page_hdr02.tpl"}
	<div class="line_outer">
		<form action="{$smarty.section.PHP_SELF}" method="post">
        <input type="hidden" name="db_config" value="true" />
			<table   cellspacing="{$config.cellspacing}" cellpadding="0" width="550" border="0">
	 			<tr>
	  				<td width="135">{lang mkey='db_name'}</td>
	  				<td><input type="text" class="textinput"  name="db_name" value="{$db.db_name}" /></td>
	 			</tr>
	 			<tr>
	  				<td>{lang mkey='db_host'}</td>
	  				<td><input type="text" class="textinput"  name="db_host" value="{$db.db_host}" /></td>
	 			</tr>
	 			<tr>
	  				<td>{lang mkey='db_user'}</td>
	  				<td><input type="text" class="textinput"  name="db_user" value="{$db.db_user}" /></td>
	 			</tr>
	 			<tr>
	  				<td>{lang mkey='db_pass'}</td>
	  				<td><input type="password" class="textinput" name="db_pass" value="{$db.db_pass}" /></td>
	 			</tr>
	 			<tr>
	  				<td>{lang mkey='db_prefix'}</td>
	  				<td><input type="text" class="textinput"  name="db_prefix" value="{$db.db_prefix}" /></td>
	 			</tr>
	 			<tr>
	  				<td>{lang mkey='photos_url'}</td>
	  				<td><input type="text" class="textinput" name="photos_url" value="{$db.photos_url}" size="50"/></td>
	 			</tr>
	 			<tr>
	  				<td>{lang mkey='ftp_username'}</td>
	  				<td><input type="text" class="textinput"  name="ftp_username" value="{$db.ftp_username}"/></td>
	 			</tr>
	 			<tr>
	  				<td>{lang mkey='ftp_password'}</td>
	  				<td><input type="password" class="textinput" name="ftp_password" value="{$db.ftp_password}"/></td>
	 			</tr>
	 			<tr>
	  				<td>{lang mkey='ftp_hostname'}</td>
	  				<td><input type="text" class="textinput"  name="ftp_hostname" value="{$db.ftp_hostname}" /></td>
	 			</tr>
	 			<tr>
	  				<td>{lang mkey='ftp_path'}</td>
	  				<td><input type="text" class="textinput"  name="ftp_path" value="{$db.ftp_path}" size="50" /></td>
	 			</tr>
	 			<tr>
	  				<td></td>
	  				<td><i>{lang mkey='ftp_path_help'}</i></td>
	 			</tr>
	 			<tr>
	  				<td></td>
	  				<td>&nbsp;</td>
	 			</tr>
				<tr>
					<td>&nbsp;</td>
					<td>
						<input type="submit" class="formbutton" value="{lang mkey='submit'}" />&nbsp;
						<input type="reset" class="formbutton" value="{lang mkey='reset'}" />
					</td>
				</tr>
			</table>
      </form>
	</div>
</div>
{/strip}