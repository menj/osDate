{strip}
<table  class="module_head" width="100%" border="0" cellpadding="0" cellspacing="0">
   <tr>
		<td width="100%" valign="top">
			{assign var="page_hdr01_text" value="&nbsp;Picture Gallery for "|cat:$username}
			{include file="page_hdr01.tpl"}
      </td>
   </tr>
   <tr>
      <td colspan="2" class="module_detail" align="center" width="100%">
      <table width="100%" cellpadding="0" cellspacing="0">
      {if $err != ''}
         <tr><td colspan="2" >
            {assign var="error_message" value=$err}
			{include file="display_error.tpl"}
            </td>
         </tr>
      {/if}
      <tr><td colspan="2">
    <form name="album01" action="plugin.php?plugin=scrollingGallery" method="post" >
      <input type="hidden" name="username" value="{$username}"/>
      <input name="id" type="hidden" value="{$userid}"/>
         <table cellpadding="0" cellspacing="0" width="100%">
            <tr><td>&nbsp;</td></tr>
            <tr>
               <td width="6">&nbsp;</td>
               <td >{lang mkey='album_hdr'}:&nbsp;&nbsp;
                  <select name="album_id" >
                  <option value="999" selected>{lang mkey='general'}</option>
                  {foreach from=$useralbums item=album}
                  <option value="{$album.id}" {if $album.id== $album_id} selected {/if}>{$album.name}</option>
                  {/foreach}
                  </select>
                  {if $smarty.session.UserId != $userid }
                     &nbsp;&nbsp;&nbsp;
                     {lang mkey='signup_password'}&nbsp;
                     <input name="album_passwd" type="password" size="15"/>
                  {else}
                     <input name="album_passwd" type="hidden" value='' size="15"/>
                  {/if}
                  &nbsp;&nbsp;
                  <input type="submit" class="formbutton" value="{lang mkey='show'}"/>
                  &nbsp;&nbsp;
                  {if $smarty.session.expired != 1 and $smarty.session.active == '1' and ( $smarty.session.status == $lang.status_enum.active or $smarty.session.status == 'Active') and $smarty.session.security.uploadpicture == 1  and $smarty.session.security.uploadpicturecnt > 0 and $userid == $smarty.session.UserId}
                  <a href="uploadsnaps.php?type=gallery" class="panellink"  >{lang mkey='upload_pictures'}</a>
                  {/if}
               </td>
            </tr>
            <tr><td>&nbsp;</td></tr>
         </table>
    </form>
         </td>
      </tr>
      {if ! $pics}
         <tr><td colspan="2">&nbsp;</td></tr>
         <tr><td colspan="2" >
            <span class="errors">&nbsp;{mylang mkey='errormsgs' skey=82}<br />&nbsp;</span>
            </td>
         </tr>
      {else}
         <tr><td align="center">

<div id="motioncontainer" style="position:relative;width:585px;height:120px;overflow:hidden;">
<div id="motiongallery" style="position:absolute;left:0;top:0;white-space:">
<span style="white-space: nowrap;" id="trueContainer">
		{assign var="cntr" value="1"}
		{foreach item=pic from=$pics}
			<a href="plugin.php?plugin={$plugin_name}&amp;framepic=1&amp;id={$userid}&amp;picid={$pic.picno}&amp;typ=pic&amp;album_id={$album_id}" target="MemberFullPic"><img src="getsnap.php?id={$userid}&amp;typ=tn&amp;picid={$pic.picno}&amp;album_id={$album_id}" alt="{$username}'s picture # {$pic.picno}" border="0" class="smallpic" /></a>&nbsp;
		{/foreach}
</span>
</div>
</div>
</td></tr>
         <tr><td><hr size="2" /></td></tr>
         <tr>
            <td align="center" valign="top" >
            <center>
            <iframe src="plugin.php?plugin={$plugin_name}&amp;framepic=1&amp;id={$userid}&amp;picid={$galpicid}&amp;typ=pic&amp;album_id={$album_id}" name="MemberFullPic" align="center" scrolling="auto" frameborder="0" width="585" height="600">
            <center>Sorry, your browser doesn\'t support iframes.</center>
            </iframe>
            </center>
            </td>
         </tr>
      {/if}
      </table>
      </td>
   </tr>
</table>
{/strip}