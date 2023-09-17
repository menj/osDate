function cascadeCountry(value) {
	if (value != '') {
	    osDatehttp.open('get', 'cascade_sign.php?a=country&v=' + value );
	    document.getElementById('txtstateprovince').innerHTML = "&nbsp;&nbsp;" + loadingTag;
	    osDatehttp.onreadystatechange = osDatehandleResponse;
	    osDatehttp.send(null);
	}
}

function cascadeState(value,v1) {
    	osDatehttp.open('get', 'cascade_sign.php?a=state&v=' + value  + '&v1=' + v1);
	document.getElementById('txtcounty').innerHTML="&nbsp;&nbsp;"+loadingTag;
    	osDatehttp.onreadystatechange = osDatehandleResponse;
    	osDatehttp.send(null);
}

function cascadeCounty(value,v1,v2) {
     osDatehttp.open('get', 'cascade_sign.php?a=county&v=' + value
					+ '&v1=' + v1 + '&v2=' + v2);
     document.getElementById('txtcity').innerHTML="&nbsp;&nbsp;"+loadingTag;
     osDatehttp.onreadystatechange = osDatehandleResponse;
     osDatehttp.send(null);
}

function cascadeCity(value,v1,v2,v3) {
      osDatehttp.open('get', 'cascade_sign.php?a=city&v=' + value
					+ '&v1=' + v1 + '&v2=' + v2 + '&v3=' + v3);
      document.getElementById('txtzip').innerHTML="&nbsp;&nbsp;"+loadingTag;
      osDatehttp.onreadystatechange = osDatehandleResponse;
      osDatehttp.send(null);
}

function cascadeCountryL(value) {
      osDatehttp.open('get', 'cascade_sign2.php?a=country&v=' + value );
      document.getElementById('txtlookstateprovince').innerHTML="&nbsp;&nbsp;"+loadingTag;
      osDatehttp.onreadystatechange = osDatehandleResponse;
      osDatehttp.send(null);
}

function cascadeStateL(value,v1) {
      osDatehttp.open('get', 'cascade_sign2.php?a=state&v=' + value  + '&v1=' + v1);
      document.getElementById('txtlookcounty').innerHTML="&nbsp;&nbsp;"+loadingTag;
      osDatehttp.onreadystatechange = osDatehandleResponse;
      osDatehttp.send(null);
}

function cascadeCountyL(value,v1,v2) {
      osDatehttp.open('get', 'cascade_sign2.php?a=county&v=' + value
					+ '&v1=' + v1 + '&v2=' + v2);
      document.getElementById('txtlookcity').innerHTML="&nbsp;&nbsp;"+loadingTag;
      osDatehttp.onreadystatechange = osDatehandleResponse;
      osDatehttp.send(null);
}

function cascadeCityL(value,v1,v2,v3) {
       osDatehttp.open('get', 'cascade_sign2.php?a=city&v=' + value
					+ '&v1=' + v1 + '&v2=' + v2 + '&v3=' + v3);
       document.getElementById('txtlookzip').innerHTML="&nbsp;&nbsp;"+loadingTag;
       osDatehttp.onreadystatechange = osDatehandleResponse;
       osDatehttp.send(null);
}
