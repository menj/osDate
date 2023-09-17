<form action="?plugin={$plugin_name}" id="autogenfrm" method="post">
{literal}
	<script type="text/javascript">
	/* <![CDATA[ */

	function isnumeric(sText)

{
   var ValidChars = "0123456789";
   var IsNumber=true;
   var Char;


   for (i = 0; i < sText.length && IsNumber == true; i++)
      {
      Char = sText.charAt(i);
      if (ValidChars.indexOf(Char) == -1)
         {
         IsNumber = false;
         }
      }
   return IsNumber;

   }

		function test()
		{
			if(document.getElementById("autogenfrm").opt1.value>0) document.getElementById("autogenfrm").submit();
			else alert("{/literal}{$lang.error4}{literal}");
		}

		function addc()
		{
			var text="<br\/>";
			var string1,string2;
			var num=document.getElementById("autogenfrm").opt4.value;
			var i;
			if ((num<=0) || (!isnumeric(num))) {alert("{/literal}{$lang.error5}{literal}");document.getElementById("country").innerHTML ="";}
			else
			{
			for(i=1;i<=num;i++)
			{
				string1="opt5_"+i;
				string2=string1+"c";
				text+=i+". {/literal}{$lang.atleast} <input type='text' size=4 name='"+string1+"'> % {$lang.opt5} <select name='"+string2+"'>{foreach item=item key=key from=$country}<option value='{$key}'>{$item.name}<\\/option>{/foreach}<\\/select><br/>{literal}";
			}
			document.getElementById("country").innerHTML = text;
			}
		}

		function adda()
		{
			var text="<br />";
			var string1,string2;
			var num=document.getElementById("autogenfrm").opt6.value;
			var i;
			if ((num<=0) || (!isnumeric(num))) {alert("{/literal}{$lang.error6}{literal}");document.getElementById("country").innerHTML ="";}
			else
			{
			for(i=1;i<=num;i++)
			{
				string1="opt7_"+i+"a";
				string2="opt7_"+i+"b";
				string3="opt7_"+i+"c";
				text+=i+". {/literal}{$lang.atleast} <input type='text' size=4 name='"+string1+"'>% {$lang.opt7} <input type='text' size=4 name='"+string2+"'> {$lang.and} <input type='text' size=4 name='"+string3+"'><br />{literal}";
			}
			document.getElementById("age").innerHTML = text;
			}
		}

	/* ]]> */
	</script>
{/literal}
<table width="560" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td width="100%"  class="module_detail_inside">
			{assign var="page_hdr01_text" value=$lang.user_title}
			{include file="admin/admin_page_hdr01.tpl"}
{if $error == 1}
	{assign var="error_message" value=$lang.error1}
	{include file="display_error.tpl"}
{else}
{if $error == 2}<div style="padding-left:3px">
		{assign var="error_message" value=$nrerror|cat:" "|cat:$lang.error2}
		{include file="display_error.tpl"}
		<br/><br/> <a href="plugin.php?plugin={$plugin_name}&amp;showforms={$fid}">View these profiles.</a> <br/><br/>
		<a href="plugin.php?plugin={$plugin_name}&amp;showforms=0">{$lang.showforms}</a><br/><br/></div>
{else}
<table border="0" width="100%">
  <tr>
    <td width="100%">
    <a href="plugin.php?plugin={$plugin_name}&amp;showforms=0">{$lang.showforms}</a><br/><br/>
    {$lang.desc}<br/><br/>
    {$lang.desc2}
    </td>
  </tr>
  <tr>
    <td width="100%">
      <p align="left">&nbsp;{$lang.opt1}&nbsp;<input type="text" size="14" name="opt1" /></p>
    </td>
  </tr>
  <tr>
    <td width="100%">&nbsp;{$lang.atleast} <input type="text" size="4" name="opt2" />% {$lang.opt2}</td>
  </tr>
  <tr>
    <td width="100%">&nbsp;{$lang.atleast} <input type="text" size="4" name="opt3" />% {$lang.opt3}</td>
  </tr>
  <tr>
    <td width="100%">{$lang.opt4} <input type="text" size="4" name="opt4" /> <input class="formbutton" type="button" value="Add" onclick="addc()" /> <br/>
    <div id="country" style="padding-left:20px">
    </div>
    </td>
  </tr>
  <tr>
    <td width="100%">{$lang.opt6} <input type="text" size="4" name="opt6" /> <input class="formbutton" type="button" value="Add" onclick="adda()" /> <br/>
    <div id="age" style="padding-left:20px">
    </div>
    </td>
  </tr>
  <tr>
    <td width="100%">&nbsp;{$lang.atleast} <input type="text" size="4" name="opt8" />% {$lang.opt8}</td>
  </tr>
  <tr>
    <td width="100%">&nbsp;{$lang.atleast} <input type="text" size="4" name="opt9" />% {$lang.opt9}</td>
  </tr>
  <tr>
    <td width="100%">&nbsp;{$lang.atleast} <input type="text" size="4" name="opt10" />% {$lang.opt10}</td>
  </tr>
  <tr>
    <td width="100%">&nbsp;{$lang.atleast} <input type="text" size="4" name="opt11" />% {$lang.opt11}</td>
  </tr>
  <tr>
    <td width="100%"><input type="hidden" name="generate" value="1" /><input type="button" class="formbutton" onclick="test()" value="{$lang.generate}" /></td>
  </tr>
</table>
{/if}{/if}
	</td>
</tr>
</table>
</form>