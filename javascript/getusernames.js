
function getUserNames() {
	var msg1 = document.getElementById('reqdusers').value;
	var msg=encodeURIComponent(msg1.replace(/&/g, "|amp|"));
	osDatehttp.open('POST',"getusernames.php",false);
	osDatehttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
	osDatehttp.send("a=getUsers&msg="+msg);
  osDatehandleResponse();
	cleared=false;
}

function selectedUsers(){
/* This will populate the selected usernames into the field */
	var usernames=document.getElementById('txtprivate_to').value;
	var repltext= '<input type="text" class="input" value="" id="reqdusers" name="reqdusers" />'+
		       '&nbsp;<input type="button" class="formbutton" value="'+ lookup_txt +'" onclick="getUserNames();" />';
	if (usernames != '') {usernames += ','; }
	var userslist=document.getElementById('reqdusers');
	var selusers='';
	for (x=0; x < userslist.options.length; x++) {
		if (userslist.options[x].selected ) {
			if (selusers != '') { selusers += ','; } 
			selusers += userslist.options[x].value;
		}
	}
	if (selusers != ',') { 	usernames += selusers; 
		document.getElementById('txtprivate_to').value=usernames;
	}
	document.getElementById('usernameFind').innerHTML=repltext;
}
