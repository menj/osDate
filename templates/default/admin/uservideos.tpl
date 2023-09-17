{strip}
<script type="text/javascript">
/* <![CDATA[ */
function conDeleteVideo(picno,typ){ldelim}
	if( confirm("{lang mkey='admin_js_error_msgs' skey=2}") ) {ldelim}
		document.location='?userid={$userid}&del=yes&videono=' + picno ;
	{rdelim}
{rdelim}
function validate( form ){ldelim}

	imgSrc = form.txtimage.value;
	ytRef = form.ytref.value;
	if (ytRef == '' ){ldelim}
		if( imgSrc == '' ) {ldelim}
			alert("{lang mkey='errormsgs' skey=28}");
		{rdelim} else {ldelim}
			form.submit();
		{rdelim}
	{rdelim}
	else
	{ldelim}
		form.submit();
	{rdelim}
{rdelim}
/* ]]> */
</script>

<div class="module_detail_inside" style="vertical-align:top; width:100%;" >
	{assign var="page_hdr01_text" value="{lang mkey='upload_videos'} "}
	{assign var="page_title" value="{lang mkey='upload_videos'} "}
	{if $smarty.session.AdminId > 0}
		{assign var="page_hdr01_text" value=$page_hdr01_text|cat:"{lang mkey='for'}"|cat:$userdata.username}
	{/if}
	{include file="page_hdr01.tpl"}
	<div >
		<div   style=" margin-top:4px;">
			{if $error_message != ''}
				{include file="display_error.tpl" }
				<br />
			{/if}
			<div style="padding:4px;">
				{lang mkey='video_upload_help'}
				<br />
			</div>
		{section name="sec" loop=$max_picture_cnt+1 start="1" step="1"}
		<form method="post" name="loadFrm{$smarty.section.sec.index}" action="savevideo.php" enctype="multipart/form-data" >
		<input type="hidden" name="videono" value="{$data[$smarty.section.sec.index].videono}" />
		<input type="hidden" name="userid" value="{$userid}" />
			<div style="width:100%; padding-bottom: 3px;">
				{assign var="page_hdr02_text" value="{lang mkey='video'} "|cat:$smarty.section.sec.index}
				{include file="page_hdr02.tpl"}
				<div align="center" style="vertical-align:middle; line-height:20px; margin-bottom: 6px;" class="text_head2">
					{lang mkey='upload_video_caption'}
				</div>
			{if $data[$smarty.section.sec.index].filename != ''}
				<div class="line-outer" align="center">
					{lang mkey='play_video'}:&nbsp;
 					<img src="{$docroot}images/play_video.jpg" onclick="enlarge(this);" alt="video no {$data[$smarty.section.sec.index].videono}"
					{if $data[$smarty.section.sec.index].ext == 'yt'}
						longdesc="swf::http://www.youtube.com/v/{$data[$smarty.section.sec.index].ytref}&amp;fs=1&amp;rel=0::{$config.disp_video_width}::{$config.disp_video_height}"
					{elseif $data[$smarty.section.sec.index].ext == 'swf'}
	 					longdesc="swf::{$smarty.const.DOC_ROOT}{$data[$smarty.section.sec.index].fullfilename}::{$config.disp_video_width}::{$config.disp_video_height}"
 					{elseif $data[$smarty.section.sec.index].ext == 'flv'}
						longdesc="flv::{$smarty.const.DOC_ROOT}{$data[$smarty.section.sec.index].fullfilename}::{$config.disp_video_width}::{$config.disp_video_height}"
					{else}
						longdesc="dvx::{$config.siteurl}{$data[$smarty.section.sec.index].fullfilename}::{$config.disp_video_width}::{$config.disp_video_height}"
					{/if}
 					/>
				</div>
			{/if}
				<div class="line-outer" align="center" style="margin-bottom: 6px;">
					<input type="file" name="txtimage" /> &nbsp;&nbsp;
					{lang mkey='OR'}&nbsp;{lang mkey='ytref'}&nbsp;
					<input type='text' class='textinput' name='ytref' value="{$data[$smarty.section.sec.index].ytref}" size="20" maxlength="40" />
				</div>
			{if $smarty.session.security.allowalbum == '1' or $smarty.session.AdminId > 0}
			{*
				Process the album name portion and	password acceptance
			*}
				<div class="line_outer" style="width:100%; padding-left: 6px;">
					{lang mkey='album_hdr'}:&nbsp;&nbsp;
					<select name="album_id">
						<option value="0" selected>{lang mkey='public'}</option>
					{foreach from=$useralbums item=album}
						<option value="{$album.id}" {if $album.id==$data[$smarty.section.sec.index].album_id} selected {/if}>{$album.name|stripslashes}</option>
					{/foreach}
					</select>
					&nbsp;&nbsp;{lang mkey='or'}&nbsp;{lang mkey='addnew'}:&nbsp;
					<input name="album_name" size="12" maxlength="25" type="text" class="textinput" />
					&nbsp;
					{lang mkey='signup_password'}&nbsp;
					<input name="album_passwd" type="password" class="textinput" size="12"/>
				{if $data[$smarty.section.sec.index].filename ne ''}
					&nbsp;<input type="submit" name="changealbum" value="{lang mkey='change_album'}" class="formbutton"/>
				{/if}
				</div>
			{/if}
				{*  Adding comments for this video *}
				<div class="line_outer">
					<table border="0" cellspacing="0" cellpadding="0">
						<tr>
							<td width="10%">
								{lang mkey="comment"}:
							</td>
							<td width="80%" valign="top">
								<textarea name="video_descr" cols="60" rows="6">{$data[$smarty.section.sec.index].video_descr}</textarea>
							</td>
							<td valign="middle">
								<input type="submit" value="{lang mkey='change_album'}" name="update_comment" class="formbutton"/>
							</td>
						</tr>
					</table>
				</div>
				<div class="line-outer" align="center">
			{if $data[$smarty.section.sec.index].filename != ''}
					<input type="button" onclick="javascript:conDeleteVideo('{$data[$smarty.section.sec.index].videono}','pic')" value="{lang mkey='delete'}" class="formbutton" />&nbsp;&nbsp;
				{if $data[$smarty.section.sec.index].active == 'N' or $data[$smarty.section.sec.index].active == ''}
					<input type="button" onclick="javascript: document.location='?userid={$userid}&amp;videono={$data[$smarty.section.sec.index].videono}&amp;act=activate';" value="{lang mkey='status_act' skey='active'}" class="formbutton" />&nbsp;&nbsp;
				{else}
					<input type="button" onclick="javascript: document.location='?userid={$userid}&amp;videono={$data[$smarty.section.sec.index].videono}&amp;act=deactivate';" value="{lang mkey='deactivate'}" class="formbutton" />&nbsp;&nbsp;
				{/if}
			{/if}
					<input type="hidden" name="uploadtypeloadFrm{$smarty.section.sec.index}" id="uploadtypeloadFrm{$smarty.section.sec.index}" value="" />
					<input type="button" value="{lang mkey='upload'}" onclick="javascript: document.getElementById('uploadtypeloadFrm{$smarty.section.sec.index}').value='pic'; validate(this.form)" class="formbutton"/>
				</div>
			</div>
		</form>
		{/section}
		</div>
	</div>
</div>
{/strip}
