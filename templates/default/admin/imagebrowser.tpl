{strip}
<script type="text/javascript">
/* <![CDATA[ */
{literal}
function confdel(img){
	if(img !=''){
		var cf = confirm('Are you sure to delete this Image?');
		if(cf){
			document.frmupload.delimg.value = img;
			document.frmupload.submit();
		}
	}
	else{
		alert("{lang mkey='select_image_first'}");
	}
}
function showimage(img){
	if(img !=''){
		window.open('../emailimages/'+img);
	}
	else{
		alert("{lang mkey='select_image_first'}");
	}
}
{/literal}
/* ]]> */
</script>

<form name="frmupload" action="" method="post" enctype="multipart/form-data">
  <input type="hidden" name="delimg" value="" />
  <input type="hidden" name="cmd" value="imgposted" />
  <input type="hidden" name="page" value="" />
<div >
	{assign var="page_hdr02_text" value="{lang mkey='image_browser'}" }
	{include file="admin/admin_page_hdr02.tpl"}
	<div class="module_detail_inside" style="padding-top:1px; text-align:left;">
		<div class="line_outer">
			<table border="0" width="100%">
				<tr>
					<td>
						<select name="imgfiles" size="5" style="width:370px" onchange="javascript:txtfileurl.value='{$base_url}emailimages/'+imgfiles.value; document.getElementById('files_to_attach').value +=imgfiles.value+',';">
							{html_options values=$images output=$images}
						</select>
					</td>
				</tr>
				<tr>
					<td>
					<input type="file" name="picfile" size="28" />&nbsp;
					<input type="submit" class="formbutton" value="{lang mkey='upload_image'}" />
					</td>
				</tr>
				<tr>
					<td align="center">
					<input type="button" class="formbutton" value="{lang mkey='show_image'}" onclick="javascript:showimage(imgfiles.value);" />&nbsp;
					<input type="button" class="formbutton" value="{lang mkey='delete_image'}" onclick="javascript:confdel(imgfiles.value);" />
					</td>
				</tr>
				<tr>
					<td>
						<input type="text" class="textinput" size="60" name="txtfileurl" value="" />
					</td>
				</tr>
			</table>
		</div>
	</div>
</div>
</form>

{/strip}