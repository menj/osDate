<br />
<form name="frmEditPref" method="post" action="showprofile.php">
<input type="hidden" name="action" value="vote_poll"/>
<input type="hidden" name="questionid" value="{$question.id}"/>
<input type="hidden" name="id" value="{$profileid}"/>
 
<div class="module_detail_inside" align="center">
  <table cellspacing="0" cellpadding="4" border="0" width="100%">
    <tr>
      <td class="module_head">{mylang mkey='poll_entries'}</td>
    </tr>
  </table>
   <table width="100%" border="0" cellspacing="{$config.cellspacing}" cellpadding="{$config.cellpadding}">
         <tr>
         <td colspan="2"><b>{lang mkey='poll_question'}</b>: {$question.question}</td>
         </tr>
         <tr>
         <td><br /></td>
         <td></td>
         </tr>
         <tr>
         <td><b>Answer</b></td>
         <td><b>Votes</b></td>
         </tr>
      {assign var="mcount" value="0"}
      {foreach item=item key=key from=$answer}
         {math equation="$mcount+1" assign="mcount"}
         <tr class="{cycle  values="oddrow,evenrow"}">
         <td><input type="radio" name="option" value="{$item.id}" /></td>
         <td>{$item.answeroption}</td>
         </tr>
      {/foreach}
   </table>
   <br />
   <br />
   <center>
   <input type="submit" class="formbutton" value='{lang mkey='submit'}'/> 
   </center>
</div>
</form>

<br />