<script type="text/javascript">
/* <![CDATA[ */
{literal}
function popup(url, width, height) {
  window.open(url,"_blank","width=" + width + ",height=" + height + ",toolbar=0,location=0,directories=0,resizable=1,status=0,menubar=0,scrollbars=0");
}

function redirect(rate)
{
	var rd="";
	rd="plugin.php?plugin={/literal}{$plugin_name}{literal}&lastid={/literal}{$data.id}{literal}&rate="+rate;
	location.href=rd;
}

function redirect2(rate)
{
	location.href="plugin.php?plugin={/literal}{$plugin_name}{literal}&gender="+rate;
}

function redirect3(rate)
{
	location.href="plugin.php?plugin={/literal}{$plugin_name}{literal}&age="+rate;
}

function redirect4(rate)
{
	location.href="plugin.php?plugin={/literal}{$plugin_name}{literal}&showrate="+rate;
}
function swapColor(id, bgcolor, color) {
  if (bgcolor != '') { document.getElementById(id).style.backgroundColor = bgcolor; }
  else{document.getElementById(id).style.backgroundColor = "transparent";}
  if (color != '') { document.getElementById(id).style.color = color; }
}

{/literal}
/* ]]> */
</script>


<table border="0" cellpadding="0" cellspacing="0" width="100%">
	<tr>
		<td width="100%"  class="module_detail_inside" align="center">
			{assign var="page_hdr01_text" value=$lang.user_title}
			{include file="page_hdr01.tpl"}
			<table border="0" width="90%">
			  <tr>
			    <td width="50%" colspan="4" align="center">
    <form action="#" name="hotornot">
			      <br/>{$lang.show_me} <select name="gender" onChange="redirect2(document.hotornot.gender.value)">
      										<option value="1" {if $gender == 1}selected{/if} >{$lang.opt1}</option>
      										<option value="2" {if $gender == 2}selected{/if} >{$lang.opt2}</option>
      										<option value="3" {if $gender == 3}selected{/if} >{$lang.opt3}</option>
      								 </select>
									 <select name="age" onChange="redirect3(document.hotornot.age.value)">
      										<option value="1" {if $age == 1}selected{/if} >{$lang.opt4}</option>
      										<option value="2" {if $age == 2}selected{/if} >{$lang.opt5}</option>
      										<option value="3" {if $age == 3}selected{/if} >{$lang.opt6}</option>
      										<option value="4" {if $age == 4}selected{/if} >{$lang.opt7}</option>
      										<option value="5" {if $age == 5}selected{/if} >{$lang.opt8}</option>
      								 </select>
      								 <br/><br/>
									 <select name="showrate" onChange="redirect4(document.hotornot.showrate.value)">
      										<option value="1" {if $showrate == 1}selected{/if} >{$lang.opt9}</option>
      										<option value="2" {if $showrate == 2}selected{/if} >{$lang.opt10}</option>
      										<option value="3" {if $showrate == 3}selected{/if} >{$lang.opt11}</option>
      										<option value="4" {if $showrate == 4}selected{/if} >{$lang.opt12}</option>
      								 </select>

     </form>
	{if $error == 1}
		{assign var="error_message" value=$lang.error}
		{include file="display_error.tpl"}
	{/if}
    </td>
  </tr>
  <tr>
  {if $lastdata.rating == 0}
  <td width="25%">&nbsp;</td>
  {/if}
      {if $lastdata.rating != 0}
    <td width="50%" valign="top" style="padding-top:10px;border-color:black;border-width:thin">
	<center>
    <br/>
      <b>{$lang.desc1}</b>
      <h2><b>{$lastdata.rating}</b></h2>
      <b>{$lang.desc4} {$lastdata.totalratings} {$lang.desc5}</b><br/><br/>
      <table border="0" cellpadding="0" cellspacing="0" >
		<tr>
			<td  width="100%" class="module_detail_inside">
		      <table border="0" cellpadding="0" cellspacing="0">
				<tr>
		 		  <td class="module_head" height="20" style="padding-left:2px;padding-right:2px" align="center" nowrap>
			        <a href="javascript:popUpScrollWindow2('{$docroot}showprofile.php?id={$lastdata.id}','center',650,600)" class="module_head">
				<small>{$lang.clickhere}</small></a>
					</td>
				</tr>
				<tr >
					<td align="center">
						<table width="100%" cellpadding="0" cellspacing="0">
							<tr>
								<td align="center">
									<div {if $lastdata.about_me != ""}onmouseover="javascript: return escape('<b>Click here to meet me</b><br/><br/>{$lastdata.about_me|replace:'"':"'"}');"{/if}>
									<script type="text/javascript" language="javascript" src="plugins/hotornot/includes/wz_tooltip.js" ></script>
									<a href="showprofile.php?id={$lastdata.id}" target="_blank">
						         	<img src="getsnap.php?id={$lastdata.id}&amp;typ=tn" border="0" class="smallpic" alt="" />
							      	</a>
							      	</div>
				      			</td>
				      		</tr>
				      	</table>
					</td>
				</tr>
			  </table>
			</td>
		</tr>
	</table>

      {if $lastdata.rate != ""}<b>{$lang.desc3} {$lang.desc2[$lastdata.gender]}: {$lastdata.rate}</b><br/>{/if}
      <table>
      <tr>
      	<td><img src="plugins/{$plugin_name}/images/hourglass.png" alt="" />
      	</td>
      	<td align="center">{$lang.desc8[$lastdata.gender]} {$lang.desc9} {$lang.desc12[$lastdata.gender]} {$lang.desc10}:<br/>
      		{$lastdata.lv.time1} {$lang.ago[$lastdata.lv.time2]} {$lang.desc11}
      	</td>
      </tr>
      </table>
      <br/><br/>
      <b>{$count}</b> {$lang.desc13}<br/><b>{$count2}</b> {$lang.desc14}.
      </center>
    </td>
      {/if}
    <td width="50%" align="center" style="padding-top:5px" valign="top" >
	<center>
    {if $error != 1}<h2>{$data.username}</h2>
      <table border="0" cellpadding="0" cellspacing="0" >
	<tr>
		<td  width="100%" class="module_detail_inside" >
		<center>
      <table border="0" cellpadding="0" cellspacing="0">
		<tr>
			<td class="module_head" height="20"  style="padding-left:2px;padding-right:2px" align="center">
			<a href="javascript:popUpScrollWindow2('{$docroot}showprofile.php?id={$data.id}','center',650,600)" class="module_head">
				<small>{$lang.clickhere}</small></a><br/>
			</td>
		</tr>
		<tr >
			<td align="center">
		<table width="100%" cellpadding="0" cellspacing="0">
			<tr>
				<td align="center">
				<div id="divid" {if $data.about_me != ""}onmouseover="javascript: return escape('<b>{$lang.clickhere}</b><br/><br/>{$data.about_me}{if $data.pic_count > 1}<br/><br/><small>{$lang.view_more_photos}({$data.pic_count})</small>{/if}')"><script type="text/javascript" language="javascript" src="plugins/advhotornot/includes/wz_tooltip.js" > </script{/if} >
		<a href="showprofile.php?id={$data.id}" target="_blank">
         	<img src="getsnap.php?id={$data.id}&amp;typ=pic" border="0" class="smallpic" alt="" />
      	</a>
	     </div>

      			</td>
      		</tr>
      	</table>
			</td>
		</tr>
	  </table>
	</center>
	</td>
</tr>
</table>
</center>
    <form action="#" name="voteform">
 		<table border="0" width="100%">
			<tr>
				<td width="10%" align="center"><div id="r1" onmouseover="swapColor('r1','#204080','#ffffff');" onmouseout="swapColor('r1','','#000000');" onclick="document.voteform.c1.checked=true;redirect(1)" class="module_inside"><input type="radio" name="c1" value="1" onclick="redirect(1)" /><br/>1</div></td>
				<td width="10%" align="center"><div id="r2" onmouseover="swapColor('r2','#202F70','#ffffff');" onmouseout="swapColor('r2','','#000000');" onclick="document.voteform.c2.checked=true;redirect(2)"><input type="radio" name="c2" value="2" onclick="redirect(2)" /><br/>2</div></td>
				<td width="10%" align="center"><div id="r3" onmouseover="swapColor('r3','#3F2060','#ffffff');" onmouseout="swapColor('r3','','#000000');" onclick="document.voteform.c3.checked=true;redirect(3)"><input type="radio" name="c3" value="3" onclick="redirect(3)" /><br/>3</div></td>
				<td width="10%" align="center"><div id="r4" onmouseover="swapColor('r4','#5F2050','#ffffff');" onmouseout="swapColor('r4','','#000000');" onclick="document.voteform.c4.checked=true;redirect(4)"><input type="radio" name="c4" value="4" onclick="redirect(4)" /><br/>4</div></td>
				<td width="10%" align="center"><div id="r5" onmouseover="swapColor('r5','#7F1F4F','#ffffff');" onmouseout="swapColor('r5','','#000000');" onclick="document.voteform.c5.checked=true;redirect(5)"><input type="radio" name="c5" value="5" onclick="redirect(5)" /><br/>5</div></td>
				<td width="10%" align="center"><div id="r6" onmouseover="swapColor('r6','#90103F','#ffffff');" onmouseout="swapColor('r6','','#000000');" onclick="document.voteform.c6.checked=true;redirect(6)"><input type="radio" name="c6" value="6" onclick="redirect(6)" /><br/>6</div></td>
				<td width="10%" align="center"><div id="r7" onmouseover="swapColor('r7','#B0102F','#ffffff');" onmouseout="swapColor('r7','','#000000');" onclick="document.voteform.c7.checked=true;redirect(7)"><input type="radio" name="c7" value="7" onclick="redirect(7)" /><br/>7</div></td>
				<td width="10%" align="center"><div id="r8" onmouseover="swapColor('r8','#CF0F1F','#ffffff');" onmouseout="swapColor('r8','','#000000');" onclick="document.voteform.c8.checked=true;redirect(8)"><input type="radio" name="c8" value="8" onclick="redirect(8)" /><br/>8</div></td>
				<td width="10%" align="center"><div id="r9" onmouseover="swapColor('r9','#E0000F','#ffffff');" onmouseout="swapColor('r9','','#000000');" onclick="document.voteform.c9.checked=true;redirect(9)"><input type="radio" name="c9" value="9" onclick="redirect(9)" /><br/>9</div></td>
				<td width="10%" align="center"><div id="r10" onmouseover="swapColor('r10','#F00000','#ffffff');" onmouseout="swapColor('r10','','#000000');" onclick="document.voteform.c10.checked=true;redirect(10)"><input type="radio" name="c10" value="10" onclick="redirect(10)" />
				<br/>10</div></td>
  						</tr>
			<tr>
				<td><b>{$lang.not}</b></td>
				<td colspan="8"></td>
				<td><b>{$lang.hot}</b></td>
			</tr>
		</table>
    </form>
    {/if}
    </td>
  {if $lastdata.rating == 0}
  <td width="25%">
  </td>
  {/if}
  </tr>
</table>
</td>
</tr>
</table>