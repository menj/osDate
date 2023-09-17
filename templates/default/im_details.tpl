<script type="text/javascript">
var cleared = false;
var im_refresh_interval = {$config.im_refresh_interval};
var im_msg_length = {$config.message_length};
var im_msg_long = "{lang mkey='im_msg_long'}";
function clearInput(obj) {ldelim}
	if ( cleared != true ) {ldelim}
		obj.value = '';
		cleared = true;
	{rdelim}
{rdelim}
</script>
<script type="text/javascript" src="{$DOC_ROOT}javascript/im.js"></script>
<div id="userList" class="module_detail" style="overflow:auto; width:98%;  height:60px; padding-left:2px;" align="left">
</div>
<div id="msgArea" class="module_detail" style="overflow:auto; width:98%;  height:100px;padding-left:2px;" align="left">
</div>
<div style="width:98%;height:66px;vertical-align:top;padding-left:2px;" class="module_detail">
	<table width="100%" border="0" cellspacing="0" cellpadding="1">
		<tr>
			<td height="6" id="im_refuname" width="80%">{lang mkey='To1'}: <b>&nbsp;</b>
			</td>
			<td height="6" id="msg_chrs_cnt" width="20%">
			</td>
		</tr>
		<tr>
			<td id="newMsg" height="44" width="80%">
				<textarea onfocus="javascript:clearInput(this);" style="height:100%;width:100%;overflow:auto;border:0;" name="im_msg" id="im_msg" onkeypress="keyHandler(event);" rows="6" cols="20">&lt;your message&gt;</textarea>
			</td>
			<td height="44" id="sendBtn" width="20%">
				<input type="hidden" name="im_refuid" id="im_refuid" />
				<input type="button" style="height:80%;" name="submit_btn" class="formbutton" value="{lang mkey='send'}" onclick="javascript: if (im_refuid=='') {ldelim}alert('{lang mkey='select_user_to_send_message'}'); return false;{rdelim} else sendMsg();"/>
			</td>
		</tr>
	</table>
</div>
<script type="text/javascript">
getUserList();
</script>