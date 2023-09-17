{strip}
<script type="text/javascript" src="{$DOC_ROOT}javascript/cascade_search.js"></script>
<form name="{$frmname}" method="get" action="blogsearch.php">
<input type="hidden" name="userid" value="{$userid}" />
<div style="vertical-align:top;" >
	{assign var="page_hdr01_text" value="{lang mkey='blog_search_menu'}"}
	{assign var="page_title" value="{lang mkey='blog_search_menu'}"}
	{include file="page_hdr01.tpl"}
	<div class="module_detail_inside">

		<div >
			<div class="line_leftside" style="width:15%; display:inline; float:left;">
				{lang mkey='blog_search_username'}:
			</div>
			<div  class="line_rightside"  style="display:inline; float:left; "><input name="srchusername" value="{$smarty.session.advsearch.srchusername}" type="text" class="textinput"  size="30" />
			</div>
			<div style="clear:both;"></div>
		</div>
		<div class="line_outer" >
			{lang mkey="username_part_msg"}
		</div>
		<div >
			<div  class="line_leftside" style="width:15%; display:inline; float:left;">
				{lang mkey='blog_search_title'}:
			</div>
			<div  class="line_rightside"  style="display:inline; float:left;" ><input name="srchblogtitle" value="{$smarty.session.advsearch.srchblogtitle}" type="text"  class="textinput" size="30" />
			</div>
			<div style="clear:both;"></div>
		</div>
		<div>
			<div  class="line_leftside" style="width:15%; display:inline; float:left;">
				{lang mkey='blog_search_body'}:
			</div>
			<div  class="line_rightside"  style="display:inline; float:left; "><input name="srchblogbody" value="{$smarty.session.advsearch.srchblogbody}" type="text" class="textinput"  size="30" />
			</div>
			<div style="clear:both;"></div>
		</div>
		<div>
			<div  class="line_leftside" style="width:15%; display:inline; float:left;">
				{lang mkey='blog_search_date'}:
			</div>
			<div  class="line_rightside"  style="display:inline; float:left;">
				{html_select_date_translated prefix="start_date"  start_year="-10" month_value_format="%m" time=$starttime}
				&nbsp;{lang mkey='to'}&nbsp;
				{html_select_date_translated prefix="end_date" start_year="-5" month_value_format="%m" time=$endtime}
			</div>
			<div style="clear:both;"></div>
		</div>
		<div >
			<div  class="line_leftside" style="width:15%; display:inline; float:left;">		</div>
			<div  class="line_rightside"  style="display:inline; float:left;">
				<input name="advsearch" type="submit" class="formbutton" value="{lang mkey='search'}" />&nbsp;<input type="reset" class="formbutton" value="{lang mkey='reset'}" />
			</div>
			<div style="clear:both;"></div>
		</div>
	</div>
</div>
</form>
<br />
{/strip}
