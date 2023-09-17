{strip}
<form name="frmQuickSearch" method="get" action="searchmatch.php">
<table   cellspacing="0" cellpadding="0" border="0" width="100%">
	<tr>
		<td width="42%">{lang mkey='signup_gender'} </td>
		<td>

		{if $simplesearch.txtgender}
			{assign var=gender2 value=$simplesearch.txtgender}
		{else}
			{assign var=gender2 value="M"}
		{/if}

			<select class="searchselect" name="txtgender" style='width: 100px; '>
			{html_options options=$lang.signup_gender_values selected=$simplesearch.txtgender}
        	</select>
		</td>
	</tr>
	<tr>
		<td>{lang mkey='seeking'} </td>
		<td>

		{if $simplesearch.txtlookgender}
			{assign var=gender2 value=$simplesearch.txtlookgender}
		{else}
			{assign var=gender2 value="F"}
		{/if}

	        <select class="searchselect" name="txtlookgender" style='width: 100px'>
			{html_options options=$lang.signup_gender_look selected=$gender2}
	        </select>
		</td>
    </tr>
    <tr>
		<td>{lang mkey='who_is_from'} </td>
		<td>
			<select class="searchselect" name="txtlookagestart">
	  		{html_options values=$lang.start_agerange output=$lang.start_agerange selected=$simplesearch.lookagestart}
        	</select>{lang mkey='to'}<select class="searchselect" name="txtlookageend">
		  	{html_options values=$lang.end_agerange output=$lang.end_agerange selected=$simplesearch.lookageend}
        	</select>
       </td>
    </tr>
    <tr>
		<td>{lang mkey='country'}: </td>
		<td>
			<select class="searchselect" name="lookcountry" style='width: 100px' onChange="simplesearchZip(this.value);">
	  		{html_options options=$lang.allcountries selected=$simplesearch.lookcountry }
        	</select>
       </td>
    </tr>
    <tr>
		<td colspan="2" id="simplesearch_zip" >
		{if $countries_with_zips[$simplesearch.lookcountry] > 0 }
 			<table border="0" cellspacing="0" cellpadding="0" width="100%">
 				<tr>
					<td  width="42%">{lang mkey='near_zip'}: </td>
					<td>
						<input class="textinput" type="text" name="srchzip" value="{$simplesearch.srchzip}" style="width:96px" />
				   </td>
				</tr>
  			</table>
		{else}
			<input type="hidden" name="srchzip" value="{$simplesearch.srchzip}"  />
  		{/if}
		</td>
	</tr>
	<tr>
    	<td colspan="2">{lang mkey='with_photo'}&nbsp;&nbsp;
    		<input type="checkbox" name="with_photo" value="1" {if $simplesearch.with_photo == '1'}checked="checked"{/if} />
    		&nbsp;&nbsp;
    		<input type="submit" value="{lang mkey='search'}" class="formbutton" />
    	</td>
    </tr>
	{*
    <tr>
		<td style="text-align:right;" colspan="2">
      		<input type="submit" value="{lang mkey='search'}" class="formbutton" /></td>
    </tr>
	*}
</table>
</form>
{/strip}
