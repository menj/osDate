{strip}
<script type="text/javascript">
/* <![CDATA[ */
function validate(form)
{ldelim}
	ErrorCount=0;
	ErrorMsg = new Array();
	ErrorMsg[0]="------------------------- The Following Errors Occured -------------------------" + String.fromCharCode(13);

	if ( form.payment_method == undefined ) {ldelim}
		return true;
	{rdelim}

	if ( form.payment_method[0].checked == true )
	{ldelim}
		if (form.membership.checked == 'free') {ldelim}
			ErrorMsg[1] =  "{lang mkey='mship_errors' skey=4}";
			ErrorCount++;
		{rdelim}
	{rdelim}
	elseif ( form.payment_method[1].checked == true )
	{ldelim}
		CheckFieldString("noblank",form.authorizenet_ccowner,"{lang mkey='signup_js_errors' skey='ccowner_noblank'}");
		CheckFieldString("noblank",form.authorizenet_ccnumber,"{lang mkey='signup_js_errors' skey='ccnumber_noblank'}");
	{rdelim}
	elseif ( form.payment_method[2].checked == true )
	{ldelim}
	{rdelim}
	elseif ( form.payment_method[3].checked == true )
	{ldelim}
	{rdelim}
	else
	{ldelim}
		alert( "{lang mkey='signup_js_errors' skey='select_payment'}" );
		return false;
	{rdelim}

	result="";
	if( ErrorCount > 0)
	{ldelim}
		alert(ErrorMsg[1]);
		return false;
	{rdelim}
	return true;
{rdelim}
/* ]]> */
</script>

<div style="vertical-align:top;" >
	{assign var="page_hdr01_text" value="{lang mkey='membership_status'}"}
	{assign var="page_title" value="{lang mkey='membership_status'}"}
	{include file="page_hdr01.tpl"}
	<div class="module_detail_inside">
		<form action="paymentconfirmation.php" method="post" onsubmit="javascript: return validate(this);">
		<div class="line_outer">
			<b>{if $memberships[$smarty.session.RoleId] == ''}{lang mkey='cannot_determine_membership'}{else}{lang mkey='you_currently'}{$memberships[$smarty.session.RoleId]}&nbsp;{lang mkey='member'}{/if}.</b>
			<div class="line_top_bottom_pad" style="padding-top:6px;">
				{lang mkey='choose_membership'}
				<br />
				<table border="0" cellspacing="0" cellpadding="2">
					<tr>
					{foreach item=item key=key from=$memberships}
						<td valign="middle" width="5"><input type="radio" name="membership" value="{$key}" checked="checked"/>
						</td>
						<td valign="middle">{$item}</td>
					{/foreach}
					</tr>
				</table>
			</div>
			{if $smarty.get.right == 1}
			<div class="line_top_bottom_pad">
				{include file="permitmsg.tpl"}
				<br />
			</div>
			{/if}
		{if $smarty.get.err != ''}
			{assign var="error_message" value=$smarty.get.err}
			{include file="display_error.tpl"}
		{/if}
			<div class="line_top_bottom_pad" align="center">
				{include file="mshipcompare.tpl"}
			</div>
			<div class="line_top_bottom_pad" align="center">
				<br />&nbsp;&nbsp;{lang mkey='payment_msg1'}
			</div>
			<div class="line_top_bottom_pad" align="center">
				{include file="freefrm.tpl"}<br />
			</div>
		{foreach item=item from=$data}
			<div class="line_top_bottom_pad" align="center">
				{include file=$item.formfile}<br />
			</div>
		{/foreach}
			<div class="line_top_bottom_pad">
				<input class="formbutton" type="submit" value="{lang mkey='continue'} --&gt;"/>
			</div>
		</div>
		</form>
	</div>
</div>
{/strip}

