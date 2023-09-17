function cascadeCountry(value) {
       osDatehttp.open('get', 'cascade_admin.php?a=country&v=' + value );
       document.getElementById('txtstateprovince').innerHTML="&nbsp;&nbsp;"+loadingTag;
       osDatehttp.onreadystatechange = osDatehandleResponse;
       osDatehttp.send(null);   
}

function cascadeState(value,v1) {
       osDatehttp.open('get', 'cascade_admin.php?a=state&v=' + value  + '&v1=' + v1);
       document.getElementById('txtcounty').innerHTML="&nbsp;&nbsp;"+loadingTag;
       osDatehttp.onreadystatechange = osDatehandleResponse;
       osDatehttp.send(null);
}

function cascadeCounty(value,v1,v2) {
      osDatehttp.open('get', 'cascade_admin.php?a=county&v=' + value
					+ '&v1=' + v1 + '&v2=' + v2);
      document.getElementById('txtcity').innerHTML="&nbsp;&nbsp;"+loadingTag;
      osDatehttp.onreadystatechange = osDatehandleResponse;
      osDatehttp.send(null);
}

function cascadeCity(value,v1,v2,v3) {
      osDatehttp.open('get', 'cascade_admin.php?a=city&v=' + value
					+ '&v1=' + v1 + '&v2=' + v2 + '&v3=' + v3);
      document.getElementById('txtzip').innerHTML="&nbsp;&nbsp;"+loadingTag;
      osDatehttp.onreadystatechange = osDatehandleResponse;
      osDatehttp.send(null);
}

