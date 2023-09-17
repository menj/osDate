{strip}
<script type="text/javascript">
/* <![CDATA[ */
function conDelete(picno,typ){ldelim}

	if( confirm("{lang mkey='admin_js_error_msgs' skey=2}") )

		document.location='?userid={$userid}&del=yes&picno=' + picno + '&typ=' + typ ;
{rdelim}
function validate( form ){ldelim}
	imgSrc = form.txtimage.value;
	tnSrc = form.tnimage.value;
	if( imgSrc == '' && tnSrc == '') {ldelim}
		alert("{lang mkey='errormsgs' skey=28}");
	{rdelim} else {ldelim}
		imgExt =imgSrc.substr( imgSrc.lastIndexOf('.')+1 );
		tnExt = tnSrc.substr( imgSrc.lastIndexOf('.')+1 );

		exts = ' {$config.upload_snap_ext}';

		if ( ( imgExt != '' && exts.indexOf(imgExt) == -1) && ( tnExt != '' &&  exts.indexOf(tnExt) == -1) ) {ldelim}
			alert("{lang mkey='errormsgs' skey=29}");
		{rdelim}
		else {ldelim}
			form.submit();
		{rdelim}
	{rdelim}
{rdelim}
/* ]]> */
</script>

{assign var="page_hdr01_text" value="{lang mkey='upload_pictures'} "|cat:"{lang mkey="for"} "|cat:$userdata.username}
{assign var="page_title" value="{lang mkey='upload_pictures'} "}
{include file="admin/admin_page_hdr01.tpl"}
<div class="module_detail_inside" style="padding-top:4px; text-align:left;">
	{if $smarty.get.msg ne ""}
		{include file="display_error.tpl"}
	{/if}
	<div class="line_outer">
		{$snapload_msg}<br /><br />
		{section name="sec" loop=$max_picture_cnt+1 start="1" step="1"}
		<form method="post" name="loadFrm{$smarty.section.sec.index}" action="saveuserpics.php" enctype="multipart/form-data" >
		<input type="hidden" name="userid" value="{$userid}" />
		<input type="hidden" name="txtpicno" value="{$data[$smarty.section.sec.index].picno|default:$nextpic}"/>
			{assign var="page_hdr02_text" value="{lang mkey='picture'} "|cat:" "|cat:$smarty.section.sec.index}
			{include file="admin/admin_page_hdr02.tpl"}
			<div class="module_detail_inside" style="margin-bottom:2px;">
			<div class="line_top_bottom_pad" >
			<table   cellspacing="0" cellpadding="0" width="100%" border="0">
				<tr><td align="center" width="50%" valign="middle" height="20">
					<span class="text_head2">{lang mkey='upload_picture_caption'}</span>
					</td>
					<td align="center" width="50%" valign="middle" height="20" >
					<span class="text_head2">{lang mkey='upload_thumbnail_caption'}</span>
					</td>
				</tr>
				<tr>
					<td align="center" width="50%">
					<img src="getsnap.php?picid={$data[$smarty.section.sec.index].picno}&amp;typ=pic&amp;width={$config.disp_snap_width}&amp;height={$config.disp_snap_height}&amp;id={$userid}" class="smallpic" alt="" /><br />
					</td>
					<td align="center" width="50%">
					<img src="getsnap.php?picid={$data[$smarty.section.sec.index].picno}&amp;typ=tn&amp;id={$userid}" class="smallpic" alt="" /><br />
					</td>
				</tr>
				<tr><td colspan="2">&nbsp;</td></tr>
				<tr>
					<td align="center" width="50%" valign="bottom" >
					<input type="file" name="txtimage"/>&nbsp;
					</td>
					<td align="center" width="50%" valign="bottom" >												<input type="file" name="tnimage"/>&nbsp;
					</td>
				</tr>
				<tr><td colspan="2">&nbsp;</td></tr>
			{if $smarty.session.AdminId > '0'}
				{*
				Process the album name portion and
				password acceptance
				*}
				<tr><td colspan="2">
					<table cellpadding="0" cellspacing="0" width="100%">
						<tr>
							<td width="6">&nbsp;</td>
							<td >{lang mkey='album_hdr'}:&nbsp;&nbsp;
								<select name="album_id">
								{foreach from=$useralbums item=album}
									<option value="{$album.id}" {if $album.id== $data[$smarty.section.sec.index].album_id} selected {/if}>{$album.name|stripslashes}
									</option>
								{/foreach}
								</select>
								&nbsp;&nbsp;{lang mkey='or'}&nbsp;{lang mkey='addnew'}:&nbsp;
								<input name="album_name" size="12" maxlength="25" type="text"  class="textinput"/>
								&nbsp;
								{lang mkey='signup_password'}&nbsp;
								<input name="album_passwd" type="password" class="textinput" size="12"/>
								{if $data[$smarty.section.sec.index].picture ne ''}												&nbsp;<input type="submit" name="changealbum" value="{lang mkey='change_album'}" class="formbutton"/>
								{/if}
							</td>
						</tr>
					</table>
					</td>
				</tr>
			{/if}
				<tr>
					<td colspan="2">
					{*  Adding comments for this picture *}
					<div class="line_outer">
						<table border="0" cellspacing="0" cellpadding="0">
							<tr>
								<td width="10%">
									{lang mkey="comment"}:
								</td>
								<td width="80%" valign="top">
									<textarea name="pic_descr" cols="60" rows="6">{$data[$smarty.section.sec.index].pic_descr}</textarea>
								</td>
								<td valign="middle">
									<input type="submit" value="{lang mkey='change_album'}" name="update_comment" class="formbutton"/>
								</td>
							</tr>
						</table>
					</div>
					</td>
				</tr>
				<tr><td colspan="2">&nbsp;</td></tr>
				<tr>
					<td align="center" width="50%">
					<input type="hidden" name="uploadtypeloadFrm{$smarty.section.sec.index}" id="uploadtypeloadFrm{$smarty.section.sec.index}" value="" />
					{if $data[$smarty.section.sec.index].picture ne ''}
					{if $data[$smarty.section.sec.index].picext == 'jpg'}
					<input type="button" onclick="javascript:popUpWindow('{$smarty.const.DOC_ROOT}imageEditor/index.php?picid={$data[$smarty.section.sec.index].picno}&amp;userid={$userid}&amp;typ=pic', 'center', 615, 450)" value="{lang mkey='edit_pict'}" class="formbutton"/>&nbsp;
					{/if}
					<input type="button" onclick="javascript:conDelete('{$data[$smarty.section.sec.index].picno}','pic')" value="{lang mkey='delete'}" class="formbutton"/>&nbsp;
					{/if}
					<input type="button" value="{lang mkey='upload'}" onclick="javascript: document.getElementById('uploadtypeloadFrm{$smarty.section.sec.index}').value='pic'; validate(this.form)" class="formbutton"/>
					</td>
					<td align="center" width="50%">
					{if $data[$smarty.section.sec.index].tnpicture ne ''}
					{if $data[$smarty.section.sec.index].tnext == 'jpg'}
					<input type="button" onclick="javascript:popUpWindow('{$smarty.const.DOC_ROOT}imageEditor/index.php?picid={$data[$smarty.section.sec.index].picno}&amp;userid={$userid}&amp;typ=tn', 'center', 615, 450)" value="{lang mkey='edit_thmpnail'}" class="formbutton"/>&nbsp;
					{/if}
					<input type="button" onclick="javascript:conDelete('{$data[$smarty.section.sec.index].picno}','tn')" value="{lang mkey='delete'}" class="formbutton"/>&nbsp;
					{/if}
					<input type="button" value="{lang mkey='upload'}" onclick="javascript: document.getElementById('uploadtypeloadFrm{$smarty.section.sec.index}').value='tn'; validate(this.form)" class="formbutton"/>
					</td>
				</tr>
			</table>
			</div>
		</div>
		</form>
		{/section}
	</div>
</div>
{/strip}
