/* Create the htprequest opbect and process the readystate contents */
function createRequestObject()
{
   if (window.ActiveXObject) {
      try { 
         return new ActiveXObject('MSXML2.XMLHTTP');
      } catch (e) {
         try {
            return new ActiveXObject('Microsoft.XMLHTTP');
         } catch (e) {
            alert('Error creating XMLHttpRequest with ActiveXObject()');
            return false;
         }
      }
   }

   if (window.XMLHttpRequest) {
      try {
         return new XMLHttpRequest();
      } catch (e) {
         alert('Error creating XMLHttpRequest with XMLHttpRequest()');
         return false;
      }
   }

   alert('Your browser does not support AJAX.');
   return false;
}

var osDatehttp = createRequestObject();

function osDatehandleResponse()
{
   if (osDatehttp.readyState == 4) {
      if (osDatehttp.status == 200) {
         var response = osDatehttp.responseText;      
        if (response != 'undefined' && response != '') {
            if (response.indexOf('|||') != -1) {
               var update = response.split('|||');
               for (var i = 1; i<update.length; i++) {
                  var up2 = update[i].split('|:|');
                  if (up2[0] != 'undefined' && up2[0] != '' 
                  && document.getElementById(up2[0])) {
                     document.getElementById(up2[0]).innerHTML = up2[1];
                  }
               }
            }
         }
      }
   }
}


function updateOnlineTime() {
    osDatehttp.open('GET', 'updateonlinetime.php');
    osDatehttp.send(null);
    setTimeout("updateOnlineTime()",60000);
}

function updateOnlineCount() {
    osDatehttp.open('get', 'updateonlinecount.php');
    osDatehttp.onreadystatechange = osDatehandleResponse;
    osDatehttp.send(null);
    setTimeout("updateOnlineCount()",60000);
}

function featuredProfilesDisplay(gndr) {
    osDatehttp.open('POST', 'featured_profiles_display.php',false);
    osDatehttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
    osDatehttp.send("gender="+gndr+'&send=1');
    osDatehandleResponse();
}

function newestProfilesDisplay(npgndr) {
    osDatehttp.open('POST', 'newest_profiles_display.php',false);
    osDatehttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
    osDatehttp.send("npgender="+npgndr+'&send=1');
    osDatehandleResponse();
}

function recentActiveProfilesDisplay(apgndr) {
    osDatehttp.open('POST', 'recent_active_profiles_display.php',false);
    osDatehttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
    osDatehttp.send("apgender="+apgndr+'&send=1');
    osDatehandleResponse();
}


function newUserListDisplay(nulgndr) {
    osDatehttp.open('POST', 'newuserlist_display.php',false);
    osDatehttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
    osDatehttp.send("nulgender="+nulgndr+'&send=1');
    osDatehandleResponse();
}
function randomProfilesDisplay(rpgndr) {
    osDatehttp.open('POST', 'random_profiles_display.php',false);
    osDatehttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
    osDatehttp.send("rpgender="+rpgndr+'&send=1');
    osDatehandleResponse();
}
function iplocationProfilesDisplay(iplgndr) {
    osDatehttp.open('POST', 'iplocation_profiles_display.php',false);
    osDatehttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
    osDatehttp.send("iplgender="+iplgndr+'&send=1');
    osDatehandleResponse();
}

function birthdayProfilesDisplay(bdpgndr) {
    osDatehttp.open('POST', 'birthday_profiles_display.php',false);
    osDatehttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
    osDatehttp.send("bdpgender="+bdpgndr+'&send=1');
    osDatehandleResponse();
}
function profpicsDisplay(profpicgndr) {
    osDatehttp.open('POST', 'newest_profpics_display.php',false);
    osDatehttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
    osDatehttp.send("profpicgender="+profpicgndr+'&send=1');
    osDatehandleResponse();
}

if ( use_popups == undefined ) {
	var use_popups = true;
}

function isValidEmail( fieldValue ) {
	if ( /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,7})+$/.test(fieldValue) )
		return true;

	return false;
}


function isValidURL(url) {

	if ( url == null )
		return false;

/* space extr */
	var reg='^ *';
/* protocol */
	reg = reg+'(?:([Hh][Tt][Tt][Pp](?:[Ss]?))(?:\:\\/\\/))?';
/* usrpwd */
	reg = reg+'(?:(\\w+\\:\\w+)(?:\\@))?';
/* domain */
	reg = reg+'([0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}|localhost|([Ww][Ww][Ww].|[a-zA-Z0-9].)[a-zA-Z0-9\\-\\.]+\\.[a-zA-Z]{2,6})';
/* port */
	reg = reg+'(\\:\\d+)?';
/* path */
	reg = reg+'((?:\\/.*)*\\/?)?';
/* filename */
	reg = reg+'(.*?\\.(\\w{2,4}))?';
/* qrystr */
	reg = reg+'(\\?(?:[^\\#\\?]+)*)?';
/* bkmrk */
	reg = reg+'(\\#.*)?';
/* space extr */
	reg = reg+' *$';

	return url.match(reg);
}

/* returns true if checkStr contains only characters specified in checkOK
   probably can be replaced with a more efficient regular expression  */

function isValidString( checkStr, checkOK ) {

	if ( !checkOK )
		var checkOK = '';

	var allValid = true;

	for (i = 0;  i < checkStr.length;  i++) {
		ch = checkStr.charAt(i);

		for (j = 0;  j < checkOK.length;  j++)
			if (ch == checkOK.charAt(j))
				break;

		if (j == checkOK.length) {
			allValid = false;
			break;
		}
	}

	return allValid;
}

var alphabeticChars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
var numericChars = "0123456789";

function isNumeric ( fieldValue ) {
	if ( /[0-9]/.test ( fieldValue ) )
		return true;
	return false;
}

function isNumeric( val, addChars ) {
	return isValidString( val, numericChars + addChars );
}

function isAlphabetic( val ) {
	if ( /[A-Za-z]/.test ( val ) )
		return true;
	return false;
}

function isAlphabetic( val, addChars ) {
	return isValidString( val, alphabeticChars + addChars );
}

function isAlphaNumeric( val ) {
	if ( /\w/.test ( val ) )
		return true;
	return false;
}

function isAlphaNumeric( val, addChars ) {
	return isValidString( val, alphabeticChars + numericChars + addChars );
}

function DispDispHide ( disp1, disp2, hide )
{
    if (hide) hide.style.display = 'none';
    if (disp1) disp1.style.display = 'inline';
    if (disp2) disp2.style.display = 'inline';
}

function DispHideHide ( disp, hide1, hide2 )
{
    if (hide1) hide1.style.display = 'none';
    if (hide2) hide2.style.display = 'none';
    if (disp) disp.style.display = 'inline';
}

function showHide( paramA, paramB)
{
	if (paramA.value == 'US')
		paramB.rows['row_usstates'].style.display ='inline';
	else
		paramB.rows['row_usstates'].style.display = 'none';

	if (paramA.value == 'CA')
		paramB.rows['row_castates'].style.display ='inline';
	else
		paramB.rows['row_castates'].style.display = 'none';

	if (paramA.value == 'AU')
		paramB.rows['row_austates'].style.display ='inline';
	else
		paramB.rows['row_austates'].style.display = 'none';

	if (paramA.value == 'GB')
		paramB.rows['row_gbstates'].style.display ='inline';
	else
		paramB.rows['row_gbstates'].style.display = 'none';

}

function showHide( paramA)
{
	if (paramA == 'US' ) {
		document.getElementById('row_usstates').style.display ='inline';
	} else {
		document.getElementById('row_usstates').style.display = 'none';
	}
	if (paramA == 'CA') {
		document.getElementById('row_castates').style.display ='inline';
	} else {
		document.getElementById('row_castates').style.display = 'none';
	}
	if (paramA == 'AU') {
		document.getElementById('row_austates').style.display ='inline';
	} else {
		document.getElementById('row_austates').style.display = 'none';
	}
	if (paramA == 'GB') {
		document.getElementById('row_gbstates').style.display ='inline';
	} else {
		document.getElementById('row_gbstates').style.display = 'none';
	}
}

function showHidePref( paramA, paramB)
{
	if (paramA.value == 'US') {
		paramB.rows['row_lookusstates'].style.display ='inline';
	} else {
		paramB.rows['row_lookusstates'].style.display = 'none';
	}
	if (paramA.value == 'CA') {
		paramB.rows['row_lookcastates'].style.display ='inline';
	} else {
		paramB.rows['row_lookcastates'].style.display = 'none';
	}
	if (paramA.value == 'AU') {
		paramB.rows['row_lookaustates'].style.display ='inline';
	} else {
		paramB.rows['row_lookaustates'].style.display = 'none';
	}
	if (paramA.value == 'GB') {
		paramB.rows['row_lookgbstates'].style.display ='inline';
	} else {
		paramB.rows['row_lookgbstates'].style.display = 'none';
	}
}

function showHidePref( paramA)
{
	if (paramA == 'US' ) {
		document.getElementById('row_lookusstates').style.display ='inline';
	} else {
		document.getElementById('row_lookusstates').style.display = 'none';
	}
	if (paramA == 'CA') {
		document.getElementById('row_lookcastates').style.display ='inline';
	} else {
		document.getElementById('row_lookcastates').style.display = 'none';
	}
	if (paramA == 'AU') {
		document.getElementById('row_lookaustates').style.display ='inline';
	} else {
		document.getElementById('row_lookaustates').style.display = 'none';
	}
	if (paramA == 'GB') {
		document.getElementById('row_lookgbstates').style.display ='inline';
	} else {
		document.getElementById('row_lookgbstates').style.display = 'none';
	}
}

function openWin(id)
{
	if ( use_popups == false ) {
		window.location.href = 'viewresult.php?pollid=' + id;
		return;
	}

	var width=550;
	var height=378;
	var left = (screen.width/2) - width/2;
	var top = (screen.height/2) - height/2;

	openpopup=window.open('viewresult.php?pollid=' + id ,'','width='+width+',height='+height+',left='+left+',top='+top+',resizable=yes,scrollbars=yes,status=no');
	openpopup.opener.name='abc';
}

function previousPolls(){

	if ( use_popups == false ) {
		window.location.href = 'previouspolls.php';
		return;
	}

	var width=600;
	var height=378;
	var left = (screen.width/2) - width/2;
	var top = (screen.height/2) - height/2;

	openpopup=window.open('previouspolls.php' ,'popupwin','width='+width+',height='+height+',left='+left+',top='+top+',resizable=yes,scrollbars=yes,status=no');
	openpopup.opener.name="abc";
}


function launchTellFriend ()
{
	if ( use_popups == false ) {
		window.location.href = 'tellafriend.php';
		return;
	}

	var left = (screen.width/2) - 400/2;
	var top = (screen.height/2) - 400/2;
	var win = "width=300,height=250,left=" + left + ",top=" + top + ",copyhistory=no,directories=no,menubar=no,location=no,resizable=yes,scrollbars=no";
	window.open("tellafriend.php",'tellfriend',win);
}

function launchTellFriendProfile ( sID )
{
	if ( use_popups == false ) {
		window.location.href = 'tellafriend.php?ID=' + sID;
		return;
	}

	var left = (screen.width/2) - 280/2;
	var top = (screen.height/2) - 280/2;
	var win = "width=280,height=300,left=" + left + ",top=" + top + ",copyhistory=no,directories=no,menubar=no,location=no,resizable=yes,scrollbars=yes";
	window.open("tellfriend.php?ID=" + sID,'tellfriendprofile',win);
}

var popUpWin=0;


function popUpWindowMessage(URLStr, align, width, height, msgid)
{

	width = 450;
	height = 450;

	if ( use_popups == false ) {
		window.location.href = URLStr;
		return;
	}

/*	if(popUpWin){

		if(!popUpWin.closed) popUpWin.close();
	}

*/
	if( align == 'center' ){

		var left = (screen.width/2) - width/2;
		var top = (screen.height/2) - height/2;
	} else {

		var left = 0;
		var top = 0;
	}

	popUpWin = open(URLStr, 'popUpWin'+msgid, 'toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=yes,copyhistory=yes,width='+width+',height='+height+',left='+left+', top='+top+',screenX='+left+',screenY='+top+'');

}


function showIM(msgid){
	popUpWindow('showinstantmsg.php?id=' + msgid,'center',320,260,msgid);
}

function popUpWindow(URLStr, align, width, height, msgid)
{
	if ( use_popups == false ) {
		window.location.href = URLStr;
		return;
	}

	if( align == 'center' ){

		var left = (screen.width/2) - width/2;
		var top = (screen.height/2) - height/2;
	} else {

		var left = 0;
		var top = 0;
	}

	popUpWin = open(URLStr, 'popUpWin'+msgid, 'toolbar=no, status=no,menubar=no,scrollbar=no,resizable=yes,copyhistory=yes,width='+width+',height='+height+',left='+left+', top='+top+',screenX='+left+',screenY='+top+'');
	popUpWin.opener.name="abc1"; 
}


function popUpScrollWindow(URLStr, align, width, heightParam)
{
	if ( use_popups == false  ) {
		window.location.href = URLStr;
		return;
	}

	height = screen.height - 150;
	height = Math.min( height, heightParam );

	if( align == 'center' ){

		var left = (screen.width/2) - width/2;
		var top = (screen.height/2) - height/2;
	}else if( align == 'top' ){

		var left = (screen.width/2) - width/2;
		var top = 0;
	}else{

		var left = 0;
		var top = 0;
	}

	popUpWin = open(URLStr, 'popUpWin', 'toolbar=no,status=no,menubar=no,scrollbars=yes,resizable=yes,copyhistory=yes,width='+width+',height='+height+',left='+left+', top='+top+',screenX='+left+',screenY='+top+'');
}

function popUpScrollWindow2 (URLStr, align, width, heightParam)
{
	if ( use_profilepopups == false ) {
		window.location.href = URLStr;
		return;
	}

	height = screen.height - 150;
	height = Math.min( height, heightParam );

/*	if(popUpWin){

		if(!popUpWin.closed) { popUpWin.close(); }
	}
*/
	if( align == 'center' ){

		var left = (screen.width/2) - width/2;
		var top = (screen.height/2) - height/2;
	}else if( align == 'top' ){

		var left = (screen.width/2) - width/2;
		var top = 0;
	}else{

		var left = 0;
		var top = 0;
	}

	popUpWin = open(URLStr, 'popUpWin', 'toolbar=no,status=no,menubar=no,scrollbars=yes,resizable=yes,copyhistory=yes,width='+width+',height='+height+',left='+left+', top='+top+',screenX='+left+',screenY='+top+'');
	popUpWin.opener.name="rest11";
}

var prevRow = null;

function toggleRow(rwId, num){

	if( prevRow != null ) {
		prevRow.style.display ='none';
	}
	prevRow = obj = document.getElementById(rwId);
	obj.style.display ='inline';

	for( i=0; i<document.getElementById('tblSelect').length ; i++ ){

		if( i == num ) {
			document.getElementById('tblSelect')[i].className = "s_table_blue";
		} else {
			document.getElementById('tblSelect')[i].className = "s_table_white";
		}
	}
}


function votesubmit(id,curtime)
{
	var width=600;
	var height=378;
	var left = (screen.width/2) - width/2;
	var top = (screen.height/2) - height/2;

	nop = document.frmpoll.rdo.length;
	var i, rdo;
	rdo = '0';
	for (i=0 ; i<nop ; i++)
	{
		if (document.frmpoll.rdo[i].checked)
		{
			rdo = document.frmpoll.rdo[i].value;
		}
	}
	if ( use_popups == false ) {
		if ( rdo == "" ) {
			window.location.href = 'viewresult.php?t=' + curtime + '&pollid=' + id;
		}
		else {
			window.location.href = 'votehere.php?t=' + curtime + '&rdo=' + rdo + '&pollid=' + id;
		}
		return;
	}

	if (rdo=="")
	{
		openpopup=window.open('viewresult.php?t=' + curtime + '&pollid=' + id ,'','width='+width+',height='+height+',left='+left+',top='+top+',resizable=yes,scrollbars=yes,status=no');
		openpopup.opener.name='abc';
	} else {
		openpopup=window.open('votehere.php?t=' + curtime + '&rdo=' + rdo + '&pollid=' + id ,'','width='+width+',height='+height+',left='+left+',top='+top+',resizable=yes,scrollbars=yes,status=no');
		openpopup.opener.name='abc';
	}
}

function selectRdo(form,rdo){

	for( i=0 ; i < form.length ; i++ ) {
		if( form.elements[i].type=='radio' && form.elements[i].name=='searchby'
			&& form.elements[i].value == rdo ) {
			form.elements[i].checked=true;
		}
	}
}

function checkAll(form,name,val){
	for( i=0 ; i < form.length ; i++) {
		if( form.elements[i].type == 'checkbox' && form.elements[i].name == name ) {
			form.elements[i].checked = val;
		}
	}
}

function datefromtovalid(sy,sm,sd,ey,em,ed,msg)
{
	month=new Array("JAN", "FEB", "MAR", "APR", "MAY", "JUN", "JUL", "AUG", "SEP", "OCT", "NOV", "DEC")
	var syear=sy[sy.selectedIndex].value;
	var smonth=sm[sm.selectedIndex].value;
	var sdays=sd[sd.selectedIndex].value;
	var eyear=ey[ey.selectedIndex].value;
	var emonth=em[em.selectedIndex].value;
	var edays=ed[ed.selectedIndex].value;
	for (var count=0;count<12;count++)
	{
		if ((smonth== month[count]))
		{
			smonth=count;
		}
		if ((emonth== month[count]))
		{
			emonth=count;
		}
	}
	from_date=new Date(syear,smonth,sdays);
	to_date=new Date(eyear,emonth,edays);
	if (from_date > to_date)
	{
	 	alert(msg);
	 	return false;
	}
	return true;
}

function DateCheck(syr, smt, sdt, msg)
{
   hdt=sdt[sdt.selectedIndex].value;
   hmt=smt[smt.selectedIndex].value;
   hyr=syr[syr.selectedIndex].value;

   hms_maxval=31;
   if ((hmt=="APR") || (hmt=="JUN") || (hmt=="SEP") || (hmt=="NOV")){hms_maxval=30;}
   if ((hmt=="FEB") && (hyr%4)==0){hms_maxval=29;}
   if ((hmt=="FEB") && (hyr%4)!=0){hms_maxval=28;}
   if (parseInt(hdt)>hms_maxval)
   {
      alert(msg);
      return false;
   }
   return true;
}



function validateLogin(form)
{
	ErrorMsg = new Array();
	ErrorMsg[0]="------------------------- The Following Errors Occured -------------------------" + String.fromCharCode(13);

	CheckFieldString("noblank",form.txtusername,"{$lang.signup_js_errors.username_email_noblank}");
	CheckFieldString("noblank",form.txtpassword,"{$lang.signup_js_errors.password_noblank}");

	CheckFieldString("alphanum",form.txtusername,"{$lang.signup_js_errors.username_charset}");
	CheckFieldString("alphanum",form.txtpassword,"{$lang.signup_js_errors.password_charset}");

	/* concat all error messages into one string */
	result="";
	if( ErrorCount > 0)
	{
		alert(ErrorMsg[1]);
		return false;
	}
	return true;
}

// After clicking a link to delete something, pops up a window asking the user to confirm
// If the user clicks ok, it tacks delete=Y to the url.  If the user clicks cancel, 
// it returns false which leaves the user on the page. 
// 
// Ex.  <a href="bloglist.php?id=2&action=delete" onclick="return confirmLink(this, 'Blog Entry')">Delete</a>
// 
function confirmLink(theLink, theMessage) {

      var is_confirmed = confirm(theMessage);
      if (is_confirmed) {
         theLink.href += '&delete=Y';
      }
      
      return is_confirmed;
 }
// After clicking a submit button, pops up a window asking the user to confirm 
// If the user clicks ok, it proceeds.  If the user clicks cancel, it cancels submitting
// the form
// 
// ex.  <input type="submit" class="formbutton" value="Delete" name="delete" onclick="return confirmButton('Blog Entries')" />
// 
function confirmButton(theMessage) {

      var is_confirmed = confirm(theMessage);

      return is_confirmed;
}

// The next two functions comprise the text counting for a text box.  
// 
 function countCheck(countLimit) {
   if(document.frmCmt.comment.value.length > countLimit) {
     alert('Too many characters in the comment box!');
     document.frmCmt.comment.focus();
     return false; }
   else
     return true; }
 function countText(countLimit) {
   var old = document.frmCmt.counter.value;
   document.frmCmt.counter.value=document.frmCmt.comment.value.length;
   if(document.frmCmt.counter.value > countLimit && old <= countLimit) {
     alert('Too many characters in the comment box!');
     if(document.styleSheets) {
       document.frmCmt.counter.style.fontWeight = 'bold';
       document.frmCmt.counter.style.color = '#ff0000'; } }
   else if(document.frmCmt.counter.value <= countLimit && old > countLimit
	   && document.styleSheets ) {
       document.frmCmt.counter.style.fontWeight = 'normal';
       document.frmCmt.counter.style.color = '#000000'; } 
   }
 
function openInParentWindow(url)
{	window.opener.document.location.href=url;
	window.opener.focus();
}


/* To validate the type of input values in the form fields */
function CheckFieldString(type, formField, strMsg) {

	var checkOK;
	var checkStr = formField.value;
  	var allValid = true;
	var flagDot  = false;
	var namestr, domainstr;
	
	if (type == 'noblank')
	{
		if (checkStr == "")
  		{
  			ErrorCount++;
	   	 	ErrorMsg[ErrorCount] = strMsg  ;
  		}
	} else 	{
		if (type == 'integer')	{
  			checkOK = "0123456789";
  		} else if (type == 'decimal'){	
  			checkOK = "0123456789.";
		} else if (type == 'text') {
/*			checkOK = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz "; */
			checkOK = text_chars;
		} else if (type == 'alphanumeric') {
/*			checkOK = "0123456789.+-_#,/ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz ()_"; */
			checkOK = alphanumeric_chars;
		} else if (type == 'full') {
/*			checkOK = "0123456789.,[]{}=+-_#,/ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz ()_:;'\\*^%$@<>?'\"\'"; */
			checkOK = full_chars;
		} else if (type == 'alphanum') {
/*			checkOK = "0123456789_ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz "; */
			checkOK = alphanum_chars;
		} else if (type == 'email'){
			checkOK = "0123456789_-@.ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
				if ( /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,7})+$/.test(checkStr) ){
				}else{
					ErrorCount++;
					ErrorMsg[ErrorCount] = strMsg ;
				}
		} else if (type == 'phone') {
			checkOK = "0123456789-+";
		} else if (type == 'URL') {
			checkOK = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789.:/\\";
		} else if (type == 'path') {
			checkOK = "0123456789.+-_#,/ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz () \\ ";
		} else {
			ErrorCount++;
			ErrorMsg[ErrorCount] = "Check Validation one of the mentioned validation type is wrong" ;
			return 1;
		}
		
		/* code for email validation */
		/* if ((type == 'email') && (checkStr != "")) {	
			
			namestr = checkStr.substring(0, checkStr.indexOf("@"));  // everything before the '@'
			domainstr = checkStr.substring(checkStr.indexOf("@")+1, checkStr.length); // everything after the '@'

			// Rules: namestr cannot be empty, or that would indicate no characters before the '@',
			// domainstr must contain a period that is not the first character (i.e. right after
			// the '@').  The last character must be an alpha.
   			if ((namestr.length == 0) || (domainstr.indexOf(".") <= 0) || (domainstr.indexOf("@") != -1)) {
   				ErrorCount++;
				ErrorMsg[ErrorCount] = "Enter a valid Email Address." ;
   			} 
		} */		

  		for (i = 0;  i < checkStr.length;  i++)
  		{
    		ch = checkStr.charAt(i);
			for (j = 0;  j < checkOK.length;  j++) {
	      		if (ch == checkOK.charAt(j)) {
					break; }
				if (j == checkOK.length-1 ){
					
					allValid = false;
					break;
				}
			}
		
			if (type == 'decimal') /* for decimal type */
			{
				for (t = 0;  t < checkStr.length;  t++){	
				
					dot = checkStr.charAt(t)
					if (dot =='.' && flagDot == false) {
						flagDot=true;
					} else if (dot =='.' && flagDot == true){
					
						ErrorCount++;
						ErrorMsg[ErrorCount] = strMsg ;
						break;
					}
				}
			}
				
			if (!allValid){
			
				ErrorCount++;
				ErrorMsg[ErrorCount] = strMsg ;
				break;
			}
     	}
  	}
}

// captcha reload

function reloadCaptcha() {
	now = new Date();
	var capObj = document.getElementById('spam_code_img');
	if (capObj) {
		capObj.src = capObj.src + (capObj.src.indexOf('?') > -1 ? '&' : '?') + Math.ceil(Math.random()*(now.getTime()));
	}
}

var disappeardelay=250  //menu disappear speed onMouseout (in miliseconds)
var enableanchorlink=0 //Enable or disable the anchor link when clicked on? (1=e, 0=d)
var hidemenu_onclick=1 //hide menu when user clicks within menu? (1=yes, 0=no)

/////No further editting needed

var ie5=document.all
var ns6=document.getElementById&&!document.all

function getposOffset(what, offsettype){
var totaloffset=(offsettype=="left")? what.offsetLeft : what.offsetTop;
var parentEl=what.offsetParent;
while (parentEl!=null){
totaloffset=(offsettype=="left")? totaloffset+parentEl.offsetLeft : totaloffset+parentEl.offsetTop;
parentEl=parentEl.offsetParent;
}
return totaloffset;
}

function showhide(obj, e, visible, hidden){
if (ie5||ns6)
dropmenuobj.style.left=dropmenuobj.style.top=-500
if (e.type=="click" && obj.visibility==hidden || e.type=="mouseover")
obj.visibility=visible
else if (e.type=="click")
obj.visibility=hidden
}

function iecompattest(){
return (document.compatMode && document.compatMode!="BackCompat")? document.documentElement : document.body
}

function clearbrowseredge(obj, whichedge){
var edgeoffset=0
if (whichedge=="rightedge"){
var windowedge=ie5 && !window.opera? iecompattest().scrollLeft+iecompattest().clientWidth-15 : window.pageXOffset+window.innerWidth-15
dropmenuobj.contentmeasure=dropmenuobj.offsetWidth
if (windowedge-dropmenuobj.x < dropmenuobj.contentmeasure)
edgeoffset=dropmenuobj.contentmeasure-obj.offsetWidth
}
else{
var topedge=ie5 && !window.opera? iecompattest().scrollTop : window.pageYOffset
var windowedge=ie5 && !window.opera? iecompattest().scrollTop+iecompattest().clientHeight-15 : window.pageYOffset+window.innerHeight-18
dropmenuobj.contentmeasure=dropmenuobj.offsetHeight
if (windowedge-dropmenuobj.y < dropmenuobj.contentmeasure){ //move up?
edgeoffset=dropmenuobj.contentmeasure+obj.offsetHeight
if ((dropmenuobj.y-topedge)<dropmenuobj.contentmeasure) //up no good either?
edgeoffset=dropmenuobj.y+obj.offsetHeight-topedge
}
}
return edgeoffset
}

function dropdownmenu(obj, e, dropmenuID){
if (window.event) event.cancelBubble=true
else if (e.stopPropagation) e.stopPropagation()
if (typeof dropmenuobj!="undefined") //hide previous menu
dropmenuobj.style.visibility="hidden"
clearhidemenu()
if (ie5||ns6){
obj.onmouseout=delayhidemenu
dropmenuobj=document.getElementById(dropmenuID)
if (hidemenu_onclick) dropmenuobj.onclick=function(){dropmenuobj.style.visibility='hidden'}
dropmenuobj.onmouseover=clearhidemenu
dropmenuobj.onmouseout=ie5? function(){ dynamichide(event)} : function(event){ dynamichide(event)}
showhide(dropmenuobj.style, e, "visible", "hidden")
dropmenuobj.x=getposOffset(obj, "left")
dropmenuobj.y=getposOffset(obj, "top")
dropmenuobj.style.left=dropmenuobj.x-clearbrowseredge(obj, "rightedge")+"px"
dropmenuobj.style.top=dropmenuobj.y-clearbrowseredge(obj, "bottomedge")+obj.offsetHeight+"px"
}
return clickreturnvalue()
}

function clickreturnvalue(){
if ((ie5||ns6) && !enableanchorlink) return false
else return true
}

function contains_ns6(a, b) {
while (b.parentNode)
if ((b = b.parentNode) == a)
return true;
return false;
}

function dynamichide(e){
if (ie5&&!dropmenuobj.contains(e.toElement))
delayhidemenu()
else if (ns6&&e.currentTarget!= e.relatedTarget&& !contains_ns6(e.currentTarget, e.relatedTarget))
delayhidemenu()
}

function delayhidemenu(){
delayhide=setTimeout("dropmenuobj.style.visibility='hidden'",disappeardelay)
}

function clearhidemenu(){
if (typeof delayhide!="undefined")
clearTimeout(delayhide)
}

function mainLink(url){	
	window.opener.document.location.href=url;
	window.opener.focus();
}
