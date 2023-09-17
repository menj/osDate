var dispmsgs = '';

function getSBMsg(allmsgs) {
	if (allmsgs != dispmsgs && dispmsgs != 'all') {dispmsgs = allmsgs;}
	osDatehttp.open('POST',shoutbox_prog,false);
	osDatehttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
	osDatehttp.send("a=ping&cnt="+dispmsgs);
  osDatehandleResponse();
	cleared=false;
	setTimeout("getSBMsg(dispmsgs)",(shoutbox_refresh_interval* 60 * 1000));
}

function sendSBMsg() {
	var msg1 = document.getElementById('shout_text').value;
	
	if (msg1.length > shout_text_max) {
		alert(sb_error); return false;
	}
	if (msg1.length <= 0) {
		alert(sb_msg_blank); return false;
	}
	document.getElementById('shout_text').value='';
	var msg=encodeURIComponent(msg1.replace(/&/g, "|amp|"));
	osDatehttp.open('POST',shoutbox_prog,false);
	osDatehttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
	osDatehttp.send("a=sendSBMsg&msg="+msg);
  osDatehandleResponse();
	cleared=false;
}
