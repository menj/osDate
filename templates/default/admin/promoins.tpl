{strip}
<script type="text/javascript">
/* <![CDATA[ */
function checkMe()
{ldelim}
	if (document.frmNews.txttitle.value == ''){ldelim}
		alert("{lang mkey='errormsgs' skey=20}");
		return false;
	{rdelim}
	return true;
{rdelim}
/* ]]> */
</script>
{literal}
{/literal}

{assign var="page_hdr01_text" value='<a href="managepromo.php" class="subhead">'|cat:"{lang mkey='pmgmt'}"|cat:"</a>"}
{assign var="page_title" value="{lang mkey='pmgmt'}"}
{include file="admin/admin_page_hdr01.tpl"}
<div class="top_margin_6px" style="text-align:left;">
	{assign var="page_hdr02_text" value="{lang mkey='insert_promo'}"}
	{include file="admin/admin_page_hdr02.tpl"}
	<div class="module_detail_inside">
		<div class="line_outer">
			<form method="post" action="savepromo.php" name="frmPromo">
			<table border="0" cellpadding="1" cellspacing="2" >
				<tr><td>{lang mkey='promo_code_ins'}</td><td ><input type="text"  class="textinput" name="txtcode" size="8" maxlength="10"/></td></tr>
				<tr><td>{lang mkey='promo_desc_ins'}</td><td ><input type="text"  class="textinput" name="txtdesc" size="16" /></td></tr>
				<tr><td>{lang mkey='promo_type'}</td>
					<td><select class="select" name="txttype" >
						<option value="adddays">{lang mkey='promo_add_days'}</option>
						<option value="upglvl">{lang mkey='membership_hdr'}</option>
						</select>
					</td>
				</tr>
				<tr><td>{lang mkey='promo_level'}</td>
					<td><select class="select" name="txtqtylevel" >
						<option value="0">{lang mkey='promo_keep_level'}</option>
						{foreach item=item key=key from=$memberships}
							<option value="{$key}" >{$item}</option>
						{/foreach}
						</select></td>
				</tr>
				<tr><td>{lang mkey='promo_numdays'}</td>
					<td ><input type="text" class="textinput"  name="txtdays" size="10" maxlength="3"/></td>
				</tr>
				<tr><td>{lang mkey='active'} / {lang mkey='inactive'}</td>
					<td ><select class="select" name="txtactive" >
						<option value="1">{lang mkey='activate'}</option>
						<option value="0">{lang mkey='deactivate'}</option>
						</select>
					</td>
				</tr>
				<tr><td colspan="2" align="center"><input type="submit" class="formbutton" value="{lang mkey='submit'}" /></td></tr>
			</table>
			</form>
		</div>
	</div>
</div>
{/strip}