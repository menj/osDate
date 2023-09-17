function cascadeCountry(value) {
      osDatehttp.open('get', 'cascade_search.php?a=country&v=' + value );
      document.getElementById('srchlookstate_province').innerHTML="&nbsp;&nbsp;"+loadingTag;
      osDatehttp.onreadystatechange = osDatehandleResponse;
      osDatehttp.send(null);
}

function cascadeState(value,v1) {
       osDatehttp.open('get', 'cascade_search.php?a=state&v=' + value  + '&v1=' + v1);
       document.getElementById('srchlookcounty').innerHTML="&nbsp;&nbsp;"+loadingTag;
       osDatehttp.onreadystatechange = osDatehandleResponse;
       osDatehttp.send(null);
}

function cascadeCounty(value,v1,v2) {
       osDatehttp.open('get', 'cascade_search.php?a=county&v=' + value
					+ '&v1=' + v1 + '&v2=' + v2);
       document.getElementById('srchlookcity').innerHTML="&nbsp;&nbsp;"+loadingTag;
       osDatehttp.onreadystatechange = osDatehandleResponse;
       osDatehttp.send(null);
}

function cascadeCity(value,v1,v2,v3) {
       osDatehttp.open('get', 'cascade_search.php?a=city&v=' + value
					+ '&v1=' + v1 + '&v2=' + v2 + '&v3=' + v3);
       document.getElementById('srchlookzip').innerHTML="&nbsp;&nbsp;"+loadingTag;
       osDatehttp.onreadystatechange = osDatehandleResponse;
       osDatehttp.send(null);
}