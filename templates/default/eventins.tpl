{strip}
<script type="text/javascript">
/* <![CDATA[ */
var lookup_txt = "{lang mkey='lookup'}";
function validate(form)
{ldelim}
	if ( form.txtevent.value == '' ){ldelim}
		alert("{lang mkey='errormsgs' skey=20}");
		return false;
	{rdelim}
	return true;
{rdelim}
/* ]]> */
</script>
<script type="text/javascript" src="javascript/getusernames.js" ></script>
<div  style="vertical-align:top;" >
{assign var="page_hdr01_text" value="{lang mkey='calendar_title'}"}
{assign var="page_title" value="{lang mkey='calendar_title'}"}
{include file="page_hdr01.tpl"}
<br />
{assign var="page_hdr02_text" value="{lang mkey='calendar_title'} "|cat:$calendarname:stripslashes|cat:"&nbsp;&nbsp;>>&nbsp;&nbsp;"|cat:"{lang mkey='insert_event'}"}
{include file="page_hdr02.tpl"}
<div class="module_detail_inside">
	{ if $error != ''}
		{assign var="error_message" value=$error}
		{include file="display_error.tpl"}
	{/if}
	<div class="line_top_bottom_pad">
	<form action="insevent.php" method="post" name="eventform" id="eventform" onsubmit="javascript:return validate(this);">
		<input type="hidden" name="txtuserid" value="{$smarty.session.UserId}"/>
		<table   cellspacing="{$config.cellspacing}" cellpadding="{$config.cellpadding}" width="550" border="0" >
			<tr><td>{lang mkey='date_from'}</td><td>
				  	{html_select_date_translated prefix="txtdatefrom"  end_year="+5" time=$timestamp} {html_select_time prefix="txtdatefrom" display_seconds=false minute_interval=30}
				</td>
			</tr>
			<tr><td>{lang mkey='date_to'}</td><td>
			  	{html_select_date_translated prefix="txtdateto"  end_year="+5" time=$timestamp} {html_select_time prefix="txtdateto" display_seconds=false minute_interval=30}
				</td>
			</tr>
 			<tr>
	  			<td>{lang mkey='event'}<font class="required_info">{$smarty.const.REQUIRED_INFO}</font></td>
	  			<td><input type="text" class="textinput" maxlength="255" size="50" name="txtevent"/></td>
 			</tr>
 			<tr>
	  			<td>{lang mkey='description'}</td>
	  			<td><textarea cols="60" rows="5" name="txtdescription"></textarea></td>
 			</tr>
 			<tr>
	  			<td>{lang mkey='calendar'}</td>
	  			<td>
	  				<select name="txtcalendar">
					{html_options options=$allcalendars selected=$smarty.get.calendarid}
					</select>
	  			</td>
 			</tr>
		    <tr>
		      	<td>{lang mkey='timezone'}</td>
           		<td ><select class="select"  name="txttimezone" style="width: 315px">
					{html_options options=$lang.tz selected=$user.timezone}
		        	</select>
		        </td>
		    </tr>
 			<tr>
	  			<td>{lang mkey='recurring'}</td>
	  			<td valign="middle">{lang mkey='recur_every'}&nbsp;<input type="text" class="textinput" name="txtrecuroption" size="5" maxlength="5"/> {html_radios name="txtrecurring" options=$lang.recuring_labels separator="&nbsp;" selected=0}</td>
 			</tr>
 			<tr>
	  			<td valign="top">{lang mkey='private_to'}</td>
	  			<td valign="top">
	  				<table border="0" cellspacing="0" cellpadding="0">
						<tr>
							<td valign="top">
					  			<input type="text" class="textinput"  size="50" id="txtprivate_to" name="txtprivate_to" />&nbsp;&nbsp;
					  		</td>
						  	<td id="usernameFind" valign="top">
						  		<input type="text" class="textinput" value="" name="reqdusers" id="reqdusers" />&nbsp;
									<input type="button" class="formbutton" value="{lang mkey='lookup'}" onclick="getUserNames();" />
							</td>
						</tr>
					</table>
				</td>
 			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>
					<input type="submit" class="formbutton" value="{lang mkey='submit'}"/>&nbsp;
					<input type="reset" class="formbutton" value="{lang mkey='reset'}"/>
				</td>
			</tr>
		</table>
	</form>
	</div>
</div>
</div>
{/strip}