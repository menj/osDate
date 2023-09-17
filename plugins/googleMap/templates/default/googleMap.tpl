{literal}
<script src="http://maps.google.com/maps?file=api&amp;v=1&amp;key={/literal}{$keyg}{literal}" type="text/javascript"  language="javaScript"></script>
  <script type="text/javascript" language="javaScript">
    var map;
    var geocoder;
  	function addPointToMap(point,address,number,city,country,url) {
      var marker = new GMarker(point);
      map.addOverlay(marker);
      GEvent.addListener(marker, "mouseover", function() {
      marker.openInfoWindowHtml(city+"<br/>"+country+"<br/>"+number+" {/literal}{$lang.users}{literal}");
      });
      GEvent.addListener(marker, "mouseout", function() {
      map.closeInfoWindow();
      });
      GEvent.addListener(marker, "click", function() {
      location.href=url+"&city="+city+"&country="+country;
      });
    }

    function addAddressToMap(address,number,city,country,url) {
      geocoder.getLatLng(
        address,
        function(point) {
          if (point) {
            addPointToMap(point,address,number,city,country,url);
          }
        }
      );
    }

    function load() {
      if (GBrowserIsCompatible()) {

        {/literal}
        {foreach item=item key=key from=$citydata}
        address="{$item.name}";
        number="{$item.number}";
        addAddressToMap(address,number,"{$item.city}","{$item.country}","{$item.url}");
        {/foreach}
        {literal}

      }
    }

    </script>
{/literal}
<table border="0" cellpadding="0" cellspacing="0" width="100%">
	<tr>
		<td width="100%"  class="module_detail_inside">
			{assign var="page_hdr01_text" value=$lang.user_title}
			{include file="page_hdr01.tpl"}

<div style="padding-left:4px;padding-top:7px">
{$lang.desc}<br/><br/>
<form action='plugin.php?plugin={$plugin_name}' method=post>
<center>
<table width="100%" border="0" cellpadding="0" cellspacing="0" >
	<tr>
		<td  width="100%">
			<table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr>
					<td class="module_head"></td>
					<td class="module_head" height="20" style="padding-left:5px">
					{$lang.title1}
					</td>
				</tr>
			</table>


						<table cellspacing="{$config.cellspacing}" cellpadding="{$config.cellpadding}" width="100%">
				<tbody>
				<tr class="{cycle values="oddrow,evenrow"}">
					<td colspan="2" style="padding-top:5px;padding-bottom:5px"> &nbsp;{$lang.show} <select name="get2"><option value="1" {if $get2 == 1}selected{/if} >{$lang.opt5}</option><option value="2" {if $get2 == 2}selected{/if} >{$lang.opt6}</option><option value="3" {if $get2 == 3}selected{/if} >{$lang.opt7}</option></select></td>
				</tr>
				<tr class="{cycle values="oddrow,evenrow"}">
					<td align="center" width="10"><input type="radio" name="get1" value="1" {if $get1 == 1}checked{/if} /></td>
					<td>{$lang.opt1}</td>
				</tr>
				<tr class="{cycle values="oddrow,evenrow"}">
					<td align="center"><input type="radio" name="get1" value="2" {if $get1 == 2}checked{/if} /></td>
					<td>{$lang.opt2}</td>
				</tr>
				{if $data|@count != 0}
				<tr class="{cycle values="oddrow,evenrow"}">
					<td align="center"><input type="radio" name="get1" value="3" {if $get1 == 3}checked{/if} /></td>
					<td>{$lang.opt3}:
					<select name="ss">
					{foreach item=item key=key from=$data}
						<option value="{$item.id}" {if $ss == $item.id}selected{/if} >{$item.search_name}</option>
					{/foreach}
					</select></td>
				</tr>
				{/if}
				<tr class="{cycle values="oddrow,evenrow"}">
					<td align="center"><input type="radio" name="get1" value="4" {if $get1 == 4}checked{/if} /></td>
					<td>{$lang.opt4} <input type="text" name="showuser" value="{$showuser}" /></td>
				</tr>
					<tr>
					<td align="center" colspan="2"><input type="submit" value="{$lang.refresh}" class="formbutton" name="send" /></td>

				</tr>
				</tbody>
			</table>
</table>
    <div id="map" style="width: 500px; height: 400px"></div>

    <script  type="text/javascript"  language="javaScript">

		function load_map() {literal}{{/literal}

 	 	  	map = new GMap2(document.getElementById("map"));

			geocoder = new GClientGeocoder();
			load();

			map.setCenter(new GLatLng({$clat},{$clng}),{$czoom});
		{literal}}{/literal}


    </script>
</center>
<br/>
</form>
</div>
	</td>
</tr>
</table>