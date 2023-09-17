{strip}
{if $gui_editor != '0'}
<script type="text/javascript" src="{$DOC_ROOT}javascript/tiny_mce/tiny_mce.js"></script>
{literal}
<script type="text/javascript">
	// Default skin
	tinyMCE.init({
		// General options
		mode : "exact",
		theme : "advanced",
		elements: "txtmessage",
		theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,formatselect,fontselect,fontsizeselect",
		theme_advanced_buttons3 :"",
		theme_advanced_buttons4 :"",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : true
	});
</script>
{/literal}
{/if}
<script type="text/javascript">
/* <![CDATA[ */
function ltrvalidate( form )
{ldelim}
	errcnt=0;
	EMsg = '';

	if (form.txtsubject.value == '') {ldelim}
		errcnt++;
		EMsg += "{lang mkey='signup_js_errors' skey='subject_noblank'}"+String.fromCharCode(10);
	{rdelim}
	if (form.txtsendname.value == '') {ldelim}
		errcnt++;
		EMsg += "{lang mkey='signup_js_errors' skey='sendname_noblank'}"+String.fromCharCode(10);
	{rdelim}
	if (form.txtfrom.value == '') {ldelim}
		errcnt++;
		EMsg += "{lang mkey='signup_js_errors' skey='email_noblank'}"+String.fromCharCode(10);
	{rdelim}
	if (form.txtmessage == '') {ldelim}
		errcnt++;
		EMsg += "{lang mkey='signup_js_errors' skey='comments_noblank'}"+String.fromCharCode(10);
	{rdelim}
	if( form.txtsave.checked == true && form.txtname.value == ''){ldelim}
		errcnt++;
		EMsg += "{lang mkey='signup_js_errors' skey='lettertitle_noblank'}"+String.fromCharCode(10);
	{rdelim}
	/* concat all error messages into one string */
	if( errcnt > 0)	{ldelim}
		alert(EMsg);
		return false;
	{rdelim}
	form.submit();
{rdelim}
{literal}
function delLetter(letter){
	document.frmDelete.letterid.value = letter;
	document.frmDelete.submit();
}
{/literal}
/* ]]> */
</script>
<form name="frmDelete" method="post" action="">
	<input type="hidden" name="frm" value="frmDelete" />
	<input type="hidden" name="letterid" />
</form>

{assign var="page_hdr01_text" value="{lang mkey='send_letter'}"}
{assign var="page_title" value="{lang mkey='send_letter'}"}
{include file="admin/admin_page_hdr01.tpl"}
<div style=" margin-top: 6px; text-align:left;">
	{if $smarty.get.err != '' }
		{assign var="error_message" value="{lang mkey='errormsgs' skye=$smarty.get.err}" }
		{include file="display_error.tpl"}
	{/if}
	{if $images != ''}
		<div class="line_outer">
			{include file="admin/imagebrowser.tpl"}
		</div>
	{/if}
	{assign var="page_hdr02_text" value="{lang mkey='letter_options'}"}
	{include file="admin/admin_page_hdr02.tpl"}
	<div class="module_detail_inside">
		<div class="line_outer">
		{if $sent_list != ''}
			{$sent_list}
		{else}
			<form name="frmsend" method="post" action=""  enctype="multipart/form-data">
			<input type="hidden" name="frm" value="frmSend" />
				<table cellspacing="2" cellpadding="1" border="0" align="center">
					<tr>
						<td width="89">{lang mkey='select_letter'}</td>
						<td width="484">
							<select name="txttitle" onchange="document.location='sendletter.php?txttitle=' + this.options[this.selectedIndex].value">
							<option value="0">{lang mkey='letter_title'}</option>
							{foreach item=item from=$letters}
								<option value="{$item.id}" {if $smarty.get.txttitle == $item.id} selected="selected" {/if}>{$item.title}</option>
							{/foreach}
							</select>
						</td>
					</tr>
					<tr>
						<td width="89">{lang mkey='from_name'}<font class="required_info">{$smarty.const.REQUIRED_INFO}</font></td>
						<td width="484"><input type="text" class="textinput" name="txtsendname" /></td>
					</tr>
					<tr>
						<td width="89">
							{lang mkey='from_email'}
						</td>
						<td width="484">
							<select name="txtfrom">
							{html_options options=$adminemails}
							</select>&nbsp;
							<input type="button"  class="formbutton" name="xbutton" value=" ... " onclick="popUpScrollWindow('adminemail.php','center',300,200);" />
						</td>
					</tr>
					<tr>
						<td width="89" valign="top">{lang mkey='To1'}:</td>
						<td >
							<table cellspacing="2" cellpadding="1" border="0">
								<tr>
									<td width="484" >
										<table border="0" cellspacing="0" cellpadding="0">
										<tr><td valign="middle">
											<input type="radio" name="userrange" value="all" checked="checked" /></td>
											<td valign="middle">{lang mkey='all'}</td>
										</tr>
										</table>
									</td>
								</tr>
								<tr>
									<td>
										<table cellspacing="0" cellpadding="0">
											<tr>
												<td valign="middle">
												<input type="radio" name="userrange" value="level" />
												</td>
												<td valign="middle">{lang mkey='membership_hdr'}&nbsp;</td>
												<td valign="middle"><select name="txtlevel">
													{html_options options=$memberships}
													</select>
												</td>
											</tr>
										</table>
									</td>
								</tr>
								<tr>
									<td width="484" >
										<table border="0" cellspacing="0" cellpadding="0">
											<tr>
												<td valign="middle">
												<input type="radio" name="userrange" value="selected" />
												</td>
												<td valign="middle">{lang mkey='selected_users'}&nbsp;({lang mkey='separate_users_by_coma'})</td>
											</tr>
										</table>
									</td>
								</tr>
								<tr>
									<td>
										<table cellspacing="0" cellpadding="0">
											<tr>
												<td valign="top"></td>
												<td><textarea name="txtselected" cols="60" rows="6" id="txtselected"></textarea></td>
											</tr>
										</table>
									</td>
								</tr>
								<tr>
									<td colspan="0" >&nbsp;</td>
								</tr>
								<tr>
									<td colspan="0" >
										<table cellspacing="0" cellpadding="0">
											<tr>
												<td ><input type="checkbox" name="txtfilteruser[]" value="age" /></td>
												<td >{lang mkey='age'}&nbsp;</td>
												<td>
													{lang mkey='from'}&nbsp;
													<select class="select" style="width: 50px" name="txtagestart">
													{html_options values=$lang.start_agerange output=$lang.start_agerange selected='18' }
													</select>{lang mkey='to'}<select class="select" style="width: 50px" name="txtageend" >
													{html_options values=$lang.end_agerange output=$lang.end_agerange selected='90'}
													</select>
												</td>
											</tr>
										</table>
									</td>
								</tr>
								<tr>
									<td colspan="0" >
										<table cellspacing="0" cellpadding="0">
											<tr>
												<td valign="top">
												<table border="0" cellspacing="0" cellpadding="0">
												<tr><td valign="middle">
												<input type="checkbox" name="txtfilteruser[]" value="gender" /></td>
												<td valign="middle">{lang mkey='sex_without_colon'}</td>
												</tr>
												</table>
												</td>
												<td valign="top">
													<table border="0" cellspacing="0" cellpadding="0">
												{foreach item=item key=key from=$lang.signup_gender_look}
													<tr>
													  <td valign="middle">
														<input type="checkbox" name="txtgender[]" value="{$key}"  />
														</td>
														<td valign="middle">{$item}</td>
													</tr>
												{/foreach}
													</table>
												</td>
											</tr>
										</table>
									</td>
								</tr>
								<tr>
									<td  >
										<table id="tbl" cellspacing="2" cellpadding="0" border="0">
											<tr>
												<td valign="middle"><input type="checkbox" name="txtfilteruser[]" value="location" />
												</td>
												<td valign="middle">{lang mkey='select_country'}&nbsp;
												</td>
												<td valign="middle">
												<select class="select" style="width: 175px" name="txtcountry" >
												{html_options options=$lang.countries selected=$config.default_country}
												</select>
												</td>
											</tr>
											<tr>
												<td valign="middle" style="padding-top: 4px;"><input type="checkbox" name="txtfilteruser[]" value="userid" />
												</td>
												<td valign="middle">{lang mkey='start_user_id'}&nbsp;
												</td>
												<td valign="middle">
												<input type="text" class="textinput" name="txtuserid" size="20" />
												</td>
											</tr>
										</table>
									</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
				{assign var="page_hdr02_text" value="{lang mkey='compose'}"}
				{include file="admin/admin_page_hdr02.tpl"}
				<table cellspacing="2" cellpadding="1" border="0" align="center">
					<tr>
						<td width="89">&nbsp;{lang mkey='attached_files'}</td>
						<td width="484">
							<input type="file" name="files_to_attach"/>
						</td>
					</tr>
					<tr>
						<td width="89">
							&nbsp;{lang mkey='email_subject'}<font class="required_info">{$smarty.const.REQUIRED_INFO}</font>
						</td>
						<td width="484">
							<input type="text" class="textinput" name="txtsubject" value="{$message.subject}" size="54" />
						</td>
					</tr>
					<tr>
						<td colspan="2" style="padding-left: 6px;">
							Constants:<br/>							#Link#, #SiteTitle#, #SiteName#, #NickName#, #RealName#, #Sex#, #Email#, #UserId#, #Domain#
	{* 	#UserPicture#, #UserAge#, #UserDOB#  *}
						</td>
					</tr>
					<tr>
						<td colspan="2" style="padding-left: 6px;">
							<textarea name="txtmessage" id="txtmessage" style="width:550px;height:300px;" rows="6" cols="50">{$message.bodytext }</textarea>
						</td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td>
							<table border="0" cellspacing="0" cellpadding="0">
								<tr>
									<td>
										<input type="checkbox" name="txtsave" value="yes"
										onclick="this.form.txtname.disabled = !this.checked" />
									</td>
									<td valign="middle">
										{lang mkey='save_as'}&nbsp;
									</td>
									<td>
										<input type="text" class="textinput" name="txtname" size="60"  />
									</td>
								</tr>
							</table>
						</td>
					</tr>
					<tr><td></td></tr>
					<tr>
						<td colspan="2" align="center">
							<input type="button" class="formbutton" name="txtsubmit" value="{lang mkey='send_to'}" onclick="javascript: ltrvalidate(document.frmsend);" />
							{if $smarty.get.txttitle != 0}
							&nbsp;<input type="button" class="formbutton" name="txtdelete" value="{lang mkey='delete'}"
							onclick="if(confirm('{lang mkey='admin_js_error_msgs' skey=2}')) delLetter({$smarty.get.txttitle})" />
							{/if}
							<br /><br />
						</td>
					</tr>
				</table>
		  </form>
		{/if}
		</div>
	</div>
</div>
{/strip}