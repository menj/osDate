{strip}
<table border="0" cellspacing="0" cellpadding="0" width="100%">
	<tr>
		<td valign="top" width="100%">
			{assign var="page_hdr01_text" value="{lang mkey='special_offer'}"}
			{include file="page_hdr01.tpl"}
		</td>
	</tr>
	<tr>
		<td class="module_detail_inside"  width="100%" >
			<div style="width:175px; height:177px; text-align:left; display:inline; float:left; margin-top:10px;">
				<img src="{$image_dir}offerimg.jpg"  height="177" width="175" alt="" />
			</div>
			<div style="text-align:left; vertical-align:top; display:inline; float:left; height:177px;  margin-top:10px; width:428px;" >
				<div style="height:144px; padding-left: 6px; ">
					<span class="offer_head">{lang mkey='welcome_to_site'}</span><br /><br />
					{lang mkey='offer_text'}
					<br /><br />
					<table border="0" cellspacing="0" cellpadding="0"><tr>
						<td width="20" align="left">
							<img src="{$image_dir}member_icon.jpg" width="19" height="18" border="0" alt="" />
						</td>
						<td  width="100%" align="left" valign="middle" >
							&nbsp;<div id="onlinecount"  style="display:inline;"><a href="onlineusers.php">{lang mkey='online_users'}&nbsp;{$online_users_count}</a></div>
						</td>
					</tr></table>
				</div>
				<div style="height:33px; text-align:center;width:100%" class="module_head">
					<div style="padding-top: 6px;">
						<span class="text_head1">{lang mkey='dont_stay_alone'}</span>&nbsp;
						<a href="signup.php"><span class="text_head1" >{lang mkey='join_now_for_free'}</span></a>
					</div>
				</div>
			</div>
		</td>
	</tr>
</table>
<br />
{/strip}