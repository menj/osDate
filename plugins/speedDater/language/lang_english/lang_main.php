<?php
/***********************************************
osDate Open-Source Dating and Matchmaking Script

(c) 2009 TUFaT.com

osDate was created by Darren Gates and Vijay Nair,
and can be downloaded freely from www.TUFaT.com.
It is distributed under the LGPL license.

osDate is free for commercial and non-commercial 
uses. You may modify, re-sell, and re-distribute
osDate. Links back to TUFaT.com are appreciated.

This program is distributed in the hope that it
will be useful, but without any warranty, and 
without even the implied warranty of merchantability
or fitness for a particular purpose. While strong 
efforts have been taken to ensure the reliability,
security, and stability of osDate, all software 
carries risk. Your use of osDate means that you 
understand and accept the risks of using osDate.

For osDate documentation, change log, community
forum, latest updates, and project details,
please go to www.TUFaT.com  The osDate project is
supported through the sale of skins and add-ons,
which are entirely optional but help with the
development and design effort.
***********************************************/


	$lang['user_title']="Speed Dating";
	$lang['desc1']="Quickly contact many potential matches with a single email or wink. Use any of your saved searches, or the currently-loaded seach results. Then specify the method of contact, and click Submit. There is a limit of 100 winks or messages per hour with this feature.";
	$lang['title1']="I'd like to contact these matches:";
	$lang['title2']="Method of contact:";
	
	$lang['opt1']="All matches from 'My Matches'";
	$lang['opt2']="All users returned by my most recent profile search";
	$lang['opt3']="All users returned by this saved search";
	$lang['opt4']="Just send a wink";
	$lang['opt5']="Use this saved e-mail template:";
	$lang['opt6']="Send this message:";
	$lang['opt7']="Use overlap control (recommended). With this option, users who you've messaged or winked at within the past";
	$lang['opt71']="days will be skipped.";
	
	$lang['error'][1]="No data found.";
	$lang['error'][2]="Your contact limit has been exceeded for the current time period. You may send a maximum of ";
	$lang['error'][22]=" messages or winks at the present time.";
	$lang['error'][3]="There are no recipients for this wink. Please choose a different group to contact from the choices below.";
	$lang['error'][31]="There are no recipients for this message. Please choose a different group to contact from the choices below.";
	$lang['error'][4]="Your winks have been sent!";
	$lang['error'][5]="Your messages have been sent!";
	
	$lang['search_name']="Search name: ";
	$lang['subject']="Subject:";
	$lang['body']="Body:";
	
$lang['wink_received']['TEXT'] = "Dear #FirstName#,

You have received a wink from #siteName# user '#SenderName#'.

Please visit <a href=\"#link#\">#siteName#</a> to send '#SenderName#' a message, or to reciprocate the wink.

Good Luck!
#AdminName#
SITENAME";

$lang['wink_received']['HTML'] = '<table border=0 cellpadding="0" cellspacing="0" width="570"><tr><td width="77" height="25px"><img src="#SiteUrl#templates/#SkinName#/images/blue_window_3_bars.jpg" alt="" width="77" height="25px" /></td><td width="493" class="module_head" >&nbsp;&nbsp;#SenderName# just winked at you! </td></tr><tr><td width="570" class="evenrow" colspan="2" style="padding: 5px;"><table border="0" cellspacing="2" cellpadding="2"><tr><td height="6"></td></tr><tr><td width="50%" valign="top">#smallProfile#</td><td width="50%" valign="top">Out of many members, #SenderName# picked you for a wink! You can keep the flirting going by winking back, or by sending an e-mail.<br><br><a href="#SiteUrl#compose.php?recipient=#UserId#">E-mail #SenderName# now</a><br><br><a href="#SiteUrl#sendwinks.php?ref_id=#UserId#&amp;rtnurl=showprofile.php">Return the wink</a><br><br>
<b>Not Interested?</b><br>Give #SenderName# the courtsey of knowing that you\'re not interested by sending a "No, thanks" message<br><br><a href="#SiteUrl#compose.php?recipient=#UserId#&amp;reply=11">Say "No, thanks"</a><br><br></td></tr></table></td></tr><tr><td height="6" colspan="2" class="evenrow"></td></tr></table> ';

?>