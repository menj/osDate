{* JS Counter *}
	<script type="text/javascript">
	var sb_error = "{lang mkey='sb_error'}";
	var shout_text_max = 250;
	var shoutbox_refresh_interval = {$config.shoutbox_refresh_interval};
	var sb_msg_blank = "{lang mkey='sb_msg_blank'}";
	var shoutbox_prog = "{$DOC_ROOT}shoutbox.php";
	{literal}
	<!--
	function CountMax()
	{
	var wert,max;
	max=shout_text_max;
	wert = max-document.frmSB.shout_text.value.length;
	if (wert < 0) {
	alert(sb_error);
	document.frmSB.shout_text.value = document.frmSB.shout_text.value.substring(0,max);
	wert = max-document.frmSB.shout_text.value.length;
	document.frmSB.rv_counter.value = wert;
	} else {
	document.frmSB.rv_counter.value = max - document.frmSB.shout_text.value.length;
	}
	}

	function SmilieInsert(Smilie)
	{
		document.frmSB.shout_text.value += Smilie+" ";
		document.frmSB.shout_text.focus();
	}
	//-->
	{/literal}
	</script>
{* ENDE JS Counter *}

<div class="line_top_bottom_pad" style="width: 99%;padding-left: 3px;">
	<form name="frmSB" action="" method="post">
		<input type="hidden" name="frmsb" value="frmSB" />
		<input type="hidden" name="username" value="{$smarty.session.UserName}" />
		<input type="hidden" name="userid" value="{$smarty.session.UserId}" />
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
			<tr><td><input name="shout_text" id="shout_text" type="text" class="textinput" onfocus="CountMax();" onkeydown="CountMax();" value="" size="25" /></td>
			</tr>
			<tr>
				<td><input name="rv_counter" type="text" class="textinput" size="2" maxlength="3" value="" readonly />
					<a href="javascript:SmilieInsert(':-)')"><img border="0" src="{$DOC_ROOT}images/smilies/lucky.gif" title="{lang mkey='gb_insert_smilie'}" alt="" /></a>
					<a href="javascript:SmilieInsert(';-)')"><img border="0" src="{$DOC_ROOT}images/smilies/wink.gif" title="{lang mkey='gb_insert_smilie'}" alt="" /></a>
					<a href="javascript:SmilieInsert('8-)')"><img border="0" src="{$DOC_ROOT}images/smilies/cool.gif" title="{lang mkey='gb_insert_smilie'}" alt="" /></a>
					<a href="javascript:SmilieInsert(':-(')"><img border="0" src="{$DOC_ROOT}images/smilies/worse.gif" title="{lang mkey='gb_insert_smilie'}" alt="" /></a>
					<a href="javascript:SmilieInsert(':-P')"><img border="0" src="{$DOC_ROOT}images/smilies/p.gif" title="{lang mkey='gb_insert_smilie'}" alt="" /></a>
					<input type="button" class="formbutton" name="Submit" value="{lang mkey='sb_send'}" onclick="javascript:sendSBMsg();" /></td>
			</tr>
		</table>
	</form>
</div>
<div id="SBmsgArea" class="line_top_bottom_pad" style="width:170px; height:65px; overflow:auto; padding-left: 3px;">
</div>
<div class="line_top_bottom_pad" style="padding-left: 3px;">
	<input type="button" value="{lang mkey='sb_show_all'}" class="formbutton" onclick="getSBMsg('all');" />
</div>
<script type="text/javascript">
	document.frmSB.rv_counter.value = shout_text_max;
	getSBMsg('0');
</script>