{strip}
<table width="100%" border="0" cellpadding="0" cellspacing="0" >
   <tr>
      <td class="module_detail" width="100%">
			{assign var="page_hdr01_text" value="{lang mkey='section_poll_title'}"}
			{assign var="page_title" value="{lang mkey='section_poll_title'}"}
			{include file="page_hdr01.tpl"}
      {if $error_message neq ""}
      <font color="{lang mkey='error_msg_color'}">{$error_message}</font>
      {/if}
      <form name="frmEditPref" method="post" action="editpoll.php">
      <input type="hidden" name="action" value="edit_poll"/>
      <input type="hidden" name="id" value="{$questionid}"/>
         <table width="100%" border="0" cellpadding="{$config.cellspacing}"  cellspacing="{$config.cellpadding}">
            <tr>
               <td width="100%" height="25">
                  <table width="100%" border="0" cellpadding="3" cellspacing="1" >
                     <tr>
                        <td align="center" class='edituserlink'>
                           <a href="polllist.php"  class='edituserlink'>
                           <span>{lang mkey='section_poll_list'}</span>
                           </a>
                        </td>
                        <td align="center" class='edituserlink'>
                           <a href="addpoll.php"  class='edituserlink'>
                           <span>{lang mkey='section_add_poll'}</span>
                          </a>
                        </td>
                     </tr>
                  </table>
                  <br />
                  <font class="required_info">{$smarty.const.REQUIRED_INFO}</font>{lang mkey='required_info_indication'}
                  <br />
                  <br />
                  <table width="100%" border="0" cellpadding="0" cellspacing="0" >
                     <tr>
                        <td class="module_detail_inside" width="100%">
						{assign var="page_hdr01_text" value="{lang mkey='poll_subtitle_edit'}"}
						{include file="page_hdr01.tpl"}

                           <table width="100%" border="0" cellspacing="{$config.cellspacing}" cellpadding="{$config.cellpadding}">
                              <tr>
                                 <td width="100%">
                                    <table width="100%" border="0" cellspacing="{$config.cellspacing}" cellpadding="{$config.cellpadding}">
                                       <tr>
                                          <td width="25%">{lang mkey='poll_active'}
                                          <font class="required_info">{$smarty.const.REQUIRED_INFO}</font></td>
                                          <td>{html_yes_no name="active" value=$question.active}
                                          </td>
                                       </tr>
                                       <tr>
                                          <td width="25%">{lang mkey='poll_question'}
                                          <font class="required_info">{$smarty.const.REQUIRED_INFO}</font></td>
                                          <td><input type="text" class="textinput" name="question" value="{$question.question}" size="60" />
                                          </td>
                                       </tr>
                                       <tr>
                                          <td><br /></td>
                                          <td></td>
                                       </tr>
                                      {assign var="mcount" value="0"}
                                      {foreach item=item key=key from=$option}
                                        {math equation="$mcount+1" assign="mcount"}
                                       <tr>
                                          <td>
                                            {if $mcount == 1 }
                                              {lang mkey='poll_options'}
                                              <font class="required_info">{$smarty.const.REQUIRED_INFO}</font>
                                            {/if}
                                           </td>
                                           <td><input type="text" class="textinput"  name="option[{$item.id}]" value="{$item.answeroption}" size="60" /></td>
                                       </tr>
                                      {/foreach}
                                   </table>
                                 </td>
                              </tr>
                           </table>
                        </td>
                     </tr>
                  </table>
                  <br />
                  <center>
                  <input type="submit" class="formbutton" value='{lang mkey='submit'}'/> <input type="reset" class="formbutton" value="{lang mkey='reset'}"/>
                  </center>
               </td>
            </tr>
         </table>
      </form>
      </td>
   </tr>
</table>
<br />
{/strip}
