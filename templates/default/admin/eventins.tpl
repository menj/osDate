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
<script type="text/javascript" src="{$DOC_ROOT}javascript/getusernames.js" ></script>
{assign var="page_hdr01_text" value='<a href="calendar.php" class="subhead">'|cat:"{lang mkey='calendar_title'}"|cat:'</a>'}
{assign var="page_title" value="{lang mkey='calendar_title'}"}
{include file="admin/admin_page_hdr01.tpl"}
<div class="top_margin_6px" >
	{assign var="page_hdr02_text" value="{lang mkey='calendar_title'}: "|cat:$calendarname:stripslashes|cat:"&nbsp;&nbsp;>>&nbsp;&nbsp;"|cat:"{lang mkey='insert_event'}"}
	{include file="admin/admin_page_hdr02.tpl"}
	<div class="module_detail_inside" style="padding-top:1px; text-align:left;">
		{ if $error != ''}
			{assign var="error_message" value=$error}
			{include file="display_error.tpl" }
		{/if}
		<div class="line_outer">
			<form action="insevent.php" method="post" onsubmit="javascript:return validate(this);">
			<input type="hidden" name="txtuserid" value="{$smarty.session.UserId}" />
				<table   cellspacing="{$config.cellspacing}" cellpadding="{$config.cellpadding}" width="100%" border="0">
					<tr><td>{lang mkey='date_from'}</td>
						<td>
							{html_select_date_translated prefix="txtdatefrom"  end_year="+5" time=$timestamp} {html_select_time prefix="txtdatefrom" display_seconds=false minute_interval=30}
						</td>
					</tr>
					<tr><td>{lang mkey='date_to'}</td>
						<td>{html_select_date_translated prefix="txtdateto"  end_year="+5" time=$timestamp} {html_select_time prefix="txtdateto" display_seconds=false minute_interval=30}
						</td>
					</tr>
					<tr>
						<td>{lang mkey='event'}<font class="required_info">{$smarty.const.REQUIRED_INFO}</font></td>
						<td><input type="text" class="textinput"  maxlength="255" size="50" name="txtevent" /></td>
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
						<td>{lang mkey='enabled'}</td>
						<td><select name="txtenabled">
							{html_options options=$lang.enabled_values }
							</select>
						</td>
					</tr>
					<tr>
						<td>{lang mkey='timezone'}</td>
						<td><select class="select" style="WIDTH: 315px" name="txttimezone">
							{html_options options=$lang.tz selected=$smarty.session.timezone}
							</select>
						</td>
					</tr>
					<tr>
						<td>{lang mkey='recurring'}</td>
						<td valign="middle">{lang mkey='recur_every'}&nbsp;<input type="text"  class="textinput" name="txtrecuroption" size="5" maxlength="5" /> {html_radios name="txtrecurring" options=$lang.recuring_labels separator="&nbsp;" selected=0}</td>
					</tr>
					<tr>
						<td valign="top">{lang mkey='private_to'}</td>
						<td valign="top">
							<table border="0" cellspacing="0" cellpadding="0">
								<tr>
									<td valign="top">
										<input type="text"  class="textinput" size="50" id="txtprivate_to" name="txtprivate_to" />&nbsp;&nbsp;
									</td>
									<td id="usernameFind" valign="top">
										<input type="text" class="textinput"  value="" name="reqdusers" id="reqdusers" />&nbsp;
										<input type="button" class="formbutton" value="{lang mkey='lookup'}" onclick="getUserNames();" />
									</td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td>
							<input type="submit" class="formbutton" value="{lang mkey='submit'}" />&nbsp;
							<input type="reset" class="formbutton" value="{lang mkey='reset'}" />
						</td>
					</tr>
				</table>
			</form>
		</div>
	</div>
</div>
{/strip}