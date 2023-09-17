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
	{assign var="page_hdr02_text" value="{lang mkey='modify_promo'}"}
	{include file="admin/admin_page_hdr02.tpl"}
	<div class="module_detail_inside">
		<div class="line_outer">
		<form method="post" action="savepromo_edited.php" name="frmPromo">
			<table border="0" cellpadding="1" cellspacing="2" >
				<tr><td>{lang mkey='promo_code'}</td><td ><input type="text" class="textinput" name="promocode" size="8" maxlength="10" value="{$promos.promocode}" /></td></tr>
				<tr><td>{lang mkey='promo_desc_ins'}</td><td ><input type="text" class="textinput" name="pdesc" size="16" value="{$promos.pdesc}" /></td></tr>
				<tr><td>{lang mkey='promo_type'}</td>
					<td><select class="select" name="promotype" >
						<option value="adddays" {if $promos.promotype == 'adddays'}SELECTED{/if}>{lang mkey='promo_add_days'}</option>
						<option value="upglvl" {if $promos.promotype == 'upglvl'}SELECTED{/if}>{lang mkey='membership_hdr'}</option>
						</select>
					</td>
				</tr>
				<tr><td>{lang mkey='promo_level'}</td>
					<td><select class="select" name="memberlevel" >
						<option value="0" {if $promos.memberlevel==''}SELECTED{/if}>{lang mkey='promo_keep_level'}</option>
						{foreach item=item key=key from=$memberships}
							<option value="{$key}" {if $promos.memberlevel==$key}SELECTED{/if} >{$item}</option>
						{/foreach}
						</select>
					</td>
				</tr>
				<tr><td>{lang mkey='promo_numdays'}</td>
					<td ><input type="text" class="textinput"  name="increasedays" size="10" maxlength="3" value="{$promos.increasedays}" /></td>
				</tr>
				<tr><td>{lang mkey='active'} / {lang mkey='inactive'}</td>
					<td><select class="select" name="active" >
						<option value="1" {if $promos.active == '1'}SELECTED{/if}>{lang mkey='activate'}</option>
						<option value="0" {if $promos.active != '1'}SELECTED{/if}>{lang mkey='deactivate'}</option>
						</select>
					</td>
				</tr>
				<tr><td colspan="2" align="center"><input type="submit" class="formbutton" value="{lang mkey='submit'}" />
					<input type="hidden" name="id" value="{$promos.id}" />
					</td></tr>
			</table>
		</form>
		</div>
	</div>
</div>
{/strip}