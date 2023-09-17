var imlastMsg = 0;
var im_refuid = '';
function getUserList() {
    document.getElementById('userList').innerHTML="&nbsp;&nbsp;Loading...";
    osDatehttp.open('POST', 'im_prog.php',false);
    osDatehttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
    osDatehttp.send("a=ping");
    osDatehandleResponse();
    document.getElementById('msgArea').scrollTop = document.getElementById('msgArea').scrollHeight;
    setTimeout("getUserList()",(im_refresh_interval * 1000));
}

function sendMsg() {
	var msg1 = document.getElementById('im_msg').value;
	if (msg1.length > im_msg_length) {
		alert(im_msg_long); return false;
	}
	var msg=encodeURIComponent(msg1.replace(/&/g, "|amp|"));
	osDatehttp.open('POST',"im_prog.php",false);
	osDatehttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
	osDatehttp.send("a=sendMsg&refuid="+im_refuid+"&msg="+msg);
	osDatehandleResponse();
	cleared=false;
}


function selectedUser(uname,uid) {
	document.getElementById('im_refuid').value=uid;
	var rt = 'To: <b>';
	if (modeRewrite == 'Y') {
		rt = rt + '<a href="javascript:popUpScrollWindow2('+"'"+docRoot+uid+".htm','center',650,600)"+'">';
	} else {
		rt = rt + '<a href="javascript:popUpScrollWindow2('+"'"+docRoot+"showprofile.php?id="+uid+"','center',650,600)"+'">';

	}
	rt = rt + uname + '</b></a>';
	document.getElementById('im_refuname').innerHTML = rt;
}

function keyHandler( e ) {

   var ln = document.getElementById('im_msg').value.length;
   document.getElementById('msg_chrs_cnt').innerHTML = '<b>'+(ln + 1)+'/'+im_msg_length+'</b>';
   return e;

}