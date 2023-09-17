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
      <form name="frmEditPref" method="post" action="addpoll.php">
      <input type="hidden" name="action" value="add_poll"/>
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
                           {lang mkey='section_add_poll'}
                        </td>
                     </tr>
                  </table>
                  <br />
                  <font class="required_info">{$smarty.const.REQUIRED_INFO}</font>{lang mkey='required_info_indication'}
                  <br />
                  <br />
                  <table width="550" border="0" cellpadding="0" cellspacing="0" >
                     <tr>
                        <td class="module_detail_inside" width="100%">
						{assign var="page_hdr02_text" value="{lang mkey='poll_subtitle_add'}"}
						{include file="page_hdr02.tpl"}
							<table width="100%" border="0" cellspacing="{$config.cellspacing}" cellpadding="{$config.cellpadding}">
							   <tr>
								  <td width="25%">{lang mkey='poll_question'}
								  <font class="required_info">{$smarty.const.REQUIRED_INFO}</font></td>
								  <td><input type="text" class="textinput" name="question" value="{$question}" size="60" />
								  </td>
							   </tr>
							   <tr>
								  <td><br /></td>
								  <td></td>
							   </tr>
							   <tr>
								  <td>{lang mkey='poll_options'}
								  <font class="required_info">{$smarty.const.REQUIRED_INFO}</font></td>
								   <td><input type="text" class="textinput" name="option[0]" value="{$option.0}" size="60" /></td>
							   </tr>
							   <tr>
								  <td><font color="{lang mkey='required_info_indicator_color'}"><i>{lang mkey='poll_minimum_two'}</i></font></td>
								  <td><input type="text" class="textinput" name="option[1]" value="{$option.1}" size="60" /></td>
							   </tr>
							   <tr>
								  <td></td>
								  <td><input type="text" class="textinput" name="option[2]" value="{$option.2}" size="60" /></td>
							   </tr>
							   <tr>
								  <td></td>
								  <td><input type="text" class="textinput" name="option[3]" value="{$option.3}" size="60" /></td>
							   </tr>
								<tr>
								  <td></td>
								  <td><input type="text" class="textinput"  name="option[4]" value="{$option.4}" size="60" /></td>
							   </tr>
								<tr>
								  <td></td>
								  <td><input type="text" class="textinput"  name="option[5]" value="{$option.5}" size="60" /></td>
							   </tr>
								<tr>
								  <td></td>
								  <td><input type="text" class="textinput"  name="option[6]" value="{$option.6}" size="60" /></td>
							   </tr>
								<tr>
								  <td></td>
								  <td><input type="text" class="textinput"  name="option[7]" value="{$option.7}" size="60" /></td>
							   </tr>
								<tr>
								  <td></td>
								  <td><input type="text" class="textinput" name="option[8]" value="{$option.8}" size="60" /></td>
							   </tr>
								<tr>
								  <td></td>
								  <td><input type="text" class="textinput"  name="option[9]" value="{$option.9}" size="60" /></td>
							   </tr>
								<tr>
								  <td></td>
								  <td><input type="text" class="textinput" name="option[10]" value="{$option.10}" size="60" /></td>
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
