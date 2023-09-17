{strip}
<script type="text/javascript">
/* <![CDATA[ */
function getglblsettings(group,val) {ldelim}
    osDatehttp.open('get', 'getglblsettings.php?edit=' + val);
    osDatehttp.onreadystatechange = osDatehandleResponse;
    osDatehttp.send(null);
{rdelim}

function validate(group,fld,typ){ldelim}
	if (typ == 1) {ldelim}
		val = document.getElementById('txtconfigval_'+fld).value;
	    osDatehttp.open('POST', 'getglblsettings.php',false);
	    osDatehttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
	    osDatehttp.send('edited=' + fld+'&val='+val);
	    osDatehandleResponse();
	{rdelim} else if (typ == 2) {ldelim}
	    osDatehttp.open('POST', 'getglblsettings.php',false);
	    osDatehttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
	    osDatehttp.send("");
	    osDatehandleResponse();
	{rdelim}
{rdelim}
/* ]]> */
</script>
<script type="text/javascript" src="{$DOC_ROOT}javascript/picker.js"></script>

{assign var="page_hdr01_text" value="{lang mkey='globalconfigurations'}"}
{assign var="page_title" value="{lang mkey='globalconfigurations'}"}
{include file="admin/admin_page_hdr01.tpl"}
<div class="module_detail_inside" style="padding-top:1px; text-align:left;">
	<div class="line_outer">
		<form method="post" action="" name="frm1">
			<table border="0">
				<tr>
					<td>{lang mkey='glblgroups'}: </td>
					<td ><select name="glblgroup" onchange="javascript: document.frm1.submit();">{html_options options=$glblgroups selected=$glblgroup}</select>
					</td>
				</tr>
			</table>
		</form>
	</div>
	{if $errormsg != ''}
		{assign var="error_message" value=$errormsg}
		{include file="display_error.tpl"}
	{/if}
	<div >
		{assign var="page_hdr02_text" value="{lang mkey='globalconfigurations'} > "|cat:$glblgroups[$glblgroup]}
		{include file="admin/admin_page_hdr02.tpl"}
		<div class="line_outer">
			<form name="frm001" action="">
			<table   cellspacing="{$config.cellspacing}" cellpadding="{$config.cellpadding}"  border="0">
				<tr align="center" class="column_head">
					<th width="60%">{lang mkey='descrip'}</th>
					<th width="35%">{lang mkey='col_head_value'}</th>
					<th width="5%">{lang mkey='edit'}</th>
				</tr>
			{foreach item=item from=$confdata}
				<tr class="{cycle values="oddrow,evenrow"}" >
					<td id="row_{$item.config_variable}_col1" >{$item.description|stripslashes}</td>
					<td id="row_{$item.config_variable}_col2">{if $item.config_variable == 'default_user_level' or $item.config_variable == 'expired_user_level'}
							{$memberships[$item.config_value]|stripslashes}
						{elseif $item.config_variable == 'SMTP_PASS'}
							***********
						{else}
							{$item.config_value|stripslashes}
						{/if}
					</td>
					<td id="row_{$item.config_variable}_col3" nowrap>
						{* Mozilla doesnot implement showModalDialog *}
						<a href="#row_{$item.config_variable}_col2" onclick="getglblsettings('{$glblgroup}', '{$item.config_variable}');">
						<img src="images/button_edit.png" border="0" alt="" />
						</a>
					</td>
				</tr>
			{/foreach}
			</table>
			</form>
		</div>
	</div>
</div>
<br />
{/strip}