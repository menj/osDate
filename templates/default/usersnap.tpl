{strip}
<script type="text/javascript">
/* <![CDATA[ */
function conDelete(picno,typ){ldelim}

	if( confirm("{lang mkey='admin_js_error_msgs' skey=2}") )

		document.location='?del=yes&picno=' + picno + '&typ=' + typ ;
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

<div style="vertical-align:top;" >
	{if $type=='gallery'}
		{assign var="page_hdr01_text" value="{lang mkey='upload_pictures'}"}
	{else}
		{assign var="page_hdr01_text" value="{lang mkey='upload_profilepics'}"}
	{/if}
	{assign var="page_title" value=$page_hdr01_text}
	{include file="page_hdr01.tpl"}
	<div class="module_detail_inside">
		<div style=" margin-top:4px;" >
			{if $smarty.get.msg != ''}
				{include file="display_error.tpl" }
			{/if}
			<div class="line_outer">
				{$snapload_msg}<br />
			</div>
			<div class="line_outer" >
		{if $type == 'gallery'}
			{if $smarty.session.security.allowalbum == '1'}
			{*
			Process the album name portion and
			password acceptance
			*}
			<div style="width:100%; padding-bottom: 6px;">
				<form action="uploadsnaps.php" name="select_album"  method="post">
				<input type="hidden" name="type" value="{$type}" />
				{lang mkey='album_hdr'}:&nbsp;&nbsp;
				<select name="album_id" onChange="this.form.submit();">
				{foreach from=$useralbums item=album}
					<option value="{$album.id}" {if $album.id==$album_id} selected {/if}>{$album.name|stripslashes}</option>
				{/foreach}
				</select>
				&nbsp;&nbsp;{lang mkey='or'}&nbsp;{lang mkey='addnew'}:&nbsp;
				<input name="album_name" size="20" maxlength="30" type="text" class="textinput" />
				&nbsp;
				{lang mkey='signup_password'}&nbsp;
				<input name="album_passwd" type="password" class="textinput" size="12"/>
				&nbsp;<input type="submit" name="createalbum" value="{lang mkey='submit'}" class="formbutton" />
				</form>
			</div>
			{else}
				{assign var="album_id" value='999' }
			{/if}
		{/if}
		{section name="sec" loop=$max_picture_cnt+1 start="1" step="1"}
		<form method="post" name="loadFrm{$smarty.section.sec.index}" action="savesnap.php" enctype="multipart/form-data" >
			<input type="hidden" name='type' value="{$type}" />
			<input type="hidden" name='album_id' value="{$album_id}" />
			<input type="hidden" name="txtpicno" value="{$data[$smarty.section.sec.index].picno|default:$nextpic}" />
			<div style=" padding-bottom: 3px;">
				{assign var="page_hdr02_text" value="{lang mkey='picture'} "|cat:$smarty.section.sec.index}
				{include file="page_hdr02.tpl"}
				<div class="module_detail_inside" style=" padding-bottom: 3px;">
					{if $type == 'profilepics' }
					<div class="loadsnaps_column" style="text-align:left; margin-top: 4px;  padding-left: 6px; width:100%;">
						<table border="0" cellspacing="0" cellpadding="0">
							<tr>
								<td width="217" >
									{lang mkey="default_profile_pic"}&nbsp;&nbsp;
								</td>
								<td width="8" valign="middle">
									<input type="radio" name="default_pic" value="Y" {if $data[$smarty.section.sec.index].default_pic == 'Y'}checked{/if} />
								</td>
								<td width="10" valign="middle">
									{lang mkey='yes'}
								</td>
								<td width="8" valign="middle">
									<input type="radio" name="default_pic" value="N" {if $data[$smarty.section.sec.index].default_pic != 'Y'}checked{/if} />
								</td>
								<td width="10" valign="middle">
									{lang mkey='no'}&nbsp;
								</td>
							{if $data[$smarty.section.sec.index].picture ne ''}
								<td width="23" valign="middle" align="right">
									<input type=submit value="{lang mkey='submit'}" class="formbutton"  />
								</td>
							{/if}
							</tr>
						</table>
					</div>
					{/if}
					{if $data[$smarty.section.sec.index].picture != '' }
						<div class="loadsnaps_column" style="text-align:left; margin-top: 4px;  padding-left: 6px; width:100%;">
							<table border="0" cellspacing="0" cellpadding="0">
								<tr>
									<td width="10" valign="middle">
										<input type="checkbox" name="generate_tnpic" value='Y' />
									</td>
									<td width="500" align="left" valign="middle">
										{lang mkey="generate_tnpic"}
									</td>
								</tr>
							</table>
						</div>
					{/if}
					<div class="loadsnaps_column text_head2">
						{lang mkey='upload_picture_caption'}
					</div>
					<div class="loadsnaps_column text_head2">
						{lang mkey='upload_thumbnail_caption'}
					</div>
					<div style="clear:both;"></div>
					<div class="loadsnaps_column" style="text-align:center;">
						<img src="getsnap.php?picid={$data[$smarty.section.sec.index].picno|default:$nextpic}&amp;typ=pic&amp;width={$config.disp_snap_width}&amp;height={$config.disp_snap_height}" class="smallpic" alt="" /><br />
					</div>
					<div class="loadsnaps_column" style="text-align:center;">
						<img src="getsnap.php?picid={$data[$smarty.section.sec.index].picno|default:$nextpic}&amp;typ=tn" class="smallpic" alt="" /><br />
					</div>
					<div style="clear:both;"></div>
					<div class="loadsnaps_column" style="text-align:center; margin-top: 4px;">
						<input type="file" name="txtimage" />&nbsp;
					</div>
					<div class="loadsnaps_column" style="text-align:center; margin-top: 4px; ">
						<input type="file" name="tnimage" />&nbsp;
					</div>
					<div style="clear:both;"></div>
					{*  Adding comments for this picture *}
					<div class="line_outer">
						<table border="0" cellspacing="0" cellpadding="0">
							<tr>
								<td width="10%">
									{lang mkey="comment"}:
								</td>
								<td width="80%" valign="top">
									<textarea name="pic_descr" cols="60" rows="6">{$data[$smarty.section.sec.index].pic_descr }</textarea>
								</td>
								{if $data[$smarty.section.sec.index].picno > 0 }
								<td valign="middle">
									<input type="submit" value="{lang mkey='change_album'}" name="update_comment" class="formbutton"/>
								</td>
								{/if}
							</tr>
						</table>
					</div>
					<div class="loadsnaps_column" style="text-align:center; margin-top: 4px;">
						<input type="hidden" name="uploadtypeloadFrm{$smarty.section.sec.index}" id="uploadtypeloadFrm{$smarty.section.sec.index}" value="" />
					{if $data[$smarty.section.sec.index].picture ne ''}
						{if $data[$smarty.section.sec.index].picext == 'jpg'}
						<input type="button" onclick="javascript:if (this.form.generate_tnpic.checked == true) {ldelim}popUpWindow('imageEditor/index.php?picid={$data[$smarty.section.sec.index].picno}&amp;userid={$smarty.session.UserId}&amp;typ=pic&amp;generate_tnpic=Y', 'center', 615, 450){rdelim}else{ldelim}popUpWindow('imageEditor/index.php?picid={$data[$smarty.section.sec.index].picno}&amp;userid={$smarty.session.UserId}&amp;typ=pic&amp;generate_tnpic=N', 'center', 615, 450){rdelim}" value="{lang mkey='edit_pict'}" class="formbutton"/>
						&nbsp;
						{/if}
						<input type="button" onclick="javascript:conDelete('{$data[$smarty.section.sec.index].picno}','pic')" value="{lang mkey='delete'}" class="formbutton"/>&nbsp;
					{/if}
						<input type="button" value="{lang mkey='upload'}" onclick="javascript: document.getElementById('uploadtypeloadFrm{$smarty.section.sec.index}').value='pic'; validate(this.form)" class="formbutton"/>
					</div>
					<div class="loadsnaps_column" style="text-align:center; margin-top: 4px;">
					{if $data[$smarty.section.sec.index].tnpicture ne ''}
						{if $data[$smarty.section.sec.index].tnext == 'jpg'}
						<input type="button" onclick="javascript:popUpWindow('imageEditor/index.php?picid={$data[$smarty.section.sec.index].picno}&amp;userid={$smarty.session.UserId}&amp;typ=tn', 'center', 615, 450)" value="{lang mkey='edit_thmpnail'}" class="formbutton"/>
						&nbsp;
						{/if}
						<input type="button" onclick="javascript:conDelete('{$data[$smarty.section.sec.index].picno}','tn')" value="{lang mkey='delete'}" class="formbutton"/>&nbsp;
					{/if}
						<input type="button" value="{lang mkey='upload'}" onclick="javascript: document.getElementById('uploadtypeloadFrm{$smarty.section.sec.index}').value='tn'; validate(this.form)" class="formbutton"/>
					</div>
					<div style="clear:both;"></div>
				</div>
			</div>
		</form>
		{/section}
			</div>
		</div>
	</div>
</div>
{/strip}
