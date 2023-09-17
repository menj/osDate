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


	$lang['user_title']="Advanced Hot or Not";
	$lang['show_me']="Show me";

	$lang['opt1']="men and women";
	$lang['opt2']="women only";
	$lang['opt3']="men only";
	$lang['opt4']="of any age";
	$lang['opt5']="ages 18-25";
	$lang['opt6']="ages 26-32";
	$lang['opt7']="ages 33-40";
	$lang['opt8']="over 40";
	$lang['opt9']="with any rating";
	$lang['opt10']="with ratings between 1 and 5";
	$lang['opt11']="with ratings between 5 and 8";
	$lang['opt12']="with ratings between 8 and 10";

	$lang['desc1']="What others thought...";
	$lang['desc2']['M']="him";
	$lang['desc2']['F']="her";
	$lang['desc3']="You rated";
	$lang['desc4']="based on";
	$lang['desc5']="votes";
	$lang['desc6']="You may specify which rating system should serve as the basis for the Hot or Not plugin.";
	$lang['desc7']="to add new rating system.";
	$lang['desc8']['M']="He";
	$lang['desc8']['F']="She";
	$lang['desc9']="checked";
	$lang['desc10']="score";
	$lang['desc11']="ago";
	$lang['desc12']['M']="his";
	$lang['desc12']['F']="her";
	$lang['desc13']="votes counted and";
	$lang['desc14']="photos submitted";

	$lang['error']="There are no more profiles left to rate! Try visiting later, when more users have signed up, to continue rating.";
	$lang['error2']="Profile rating system changed succesfully.";

	$lang['clickhere'] ="View Profile ";

	$lang['not']="NOT";
	$lang['hot']="HOT";

	$lang['ago']['seconds']="seconds";
	$lang['ago']['minutes']="minutes";
	$lang['ago']['hours']="hours";
	$lang['ago']['days']="days";
	$lang['ago']['months']="months";
	$lang['ago']['years']="years";

	$lang['submenu1']="Rate People";
	$lang['submenu2']="Meet People";
	$lang['submenu3']="Best of";

	$lang['sharephoto']="Share";

	$lang['select']="Select rating system:";

	$lang['Subject1']="Picture reported as inappropriate";
	$lang['Subject2']="Picture reported as broken";

	$lang['flag'][1]="Inappropriate";
	$lang['flag'][2]="Broken";
	$lang['flag'][3]="Best of";
	$lang['flag'][4]="What's this";

	$lang['sharelink']="Profile link";

	$lang['descflag1']="Flag image as";
	$lang['descflag2']="The previously viewed image has been flagged as inappropriate.";
	$lang['descflag3']="The previously viewed image has been flagged as broken.";
	$lang['descflag4']="The image has been flagged as best of.";


	$lang['message1']['text']=' Dear #AdminName#,

	<a href="#SiteUrl#showprofile.php?id=#SenderId#">#SenderName#</a> has flagged the following image as inappropriate, while viewing images with the Hot or Not plugin.
	Link to image: #SiteUrl##ADMIN_DIR#userpics.php?userid=#ImageId# (You must be logged in as admin)
    <a href="#SiteUrl##ADMIN_DIR#userpics.php?userid=#ImageId#">Login to the admin panel</a> to remove this picture. This image wasposted by <a href="#SiteUrl#showprofile.php?id=#ImageId#">#ImageUser#</a>


    thanks,
    osDate Daemon';
$lang['message1']['html'] =
'<table border=0 cellpadding="0" cellspacing="0" width="570"><tr><td width="77" height="25"><img src="#SiteUrl#templates/#SkinName#/images/blue_window_3_bars.jpg" alt="" width="77" height="25" /></td><td width="493" class="module_head" >&nbsp;&nbsp;'.$lang["Subject1"].' </td></tr>
<tr><td width="570" class="evenrow" colspan="2" style="padding: 5px;"><table border="0" cellspacing="2" cellpadding="0"><tr><td height="2"></td></tr><tr><td width="100%" valign="top">&nbsp;Dear
          #AdminName#,
          <p>&nbsp;<a href="#SiteUrl#showprofile.php?id=#SenderId#">#SenderName#</a> has flagged the following image as inappropriate, while
          viewing images with the Hot or Not plugin.</p>
          <p><a href="#SiteUrl##ADMIN_DIR#userpics.php?userid=#ImageId#"><img src="#SiteUrl#getsnap.php?id=#ImageId#&typ=tn" border="0" alt=""></a></p>
          <p>&nbsp;<a href="#SiteUrl##ADMIN_DIR#userpics.php?userid=#ImageId#">Login to the admin panel</a> to remove this picture. This image was
          posted by <a href="#SiteUrl#showprofile.php?id=#ImageId#">#ImageUser#</a><br/><br/>&nbsp;thanks,<br/>
          &nbsp;osDate Daemon<br/>
          </p>
        </td></tr></table></td></tr><tr><td height="6" colspan="2" class="evenrow"></td></tr></table>';

	$lang['message2']['text']=' Dear #AdminName#,

	<a href="#SiteUrl#showprofile.php?id=#SenderId#">#SenderName#</a> has flagged the following image as broken, while viewing images with the Hot or Not plugin.
	Link to image: #SiteUrl##ADMIN_DIR#userpics.php?userid=#ImageId# (You must be logged in as admin)
    <a href="#SiteUrl##ADMIN_DIR#userpics.php?userid=#ImageId#">Login to the admin panel</a> to remove this picture. This image wasposted by <a href="#SiteUrl#showprofile.php?id=#ImageId#">#ImageUser#</a>


    thanks,
    osDate Daemon';
$lang['message2']['html'] =
'<table border=0 cellpadding="0" cellspacing="0" width="570"><tr><td width="77" height="25"><img src="#SiteUrl#templates/#SkinName#/images/blue_window_3_bars.jpg" alt="" width="77" height="25" /></td><td width="493" class="module_head" >&nbsp;&nbsp;'.$lang["Subject2"].' </td></tr>
<tr><td width="570" class="evenrow" colspan="2" style="padding: 5px;"><table border="0" cellspacing="2" cellpadding="0"><tr><td height="2"></td></tr><tr><td width="100%" valign="top">&nbsp;Dear
          #AdminName#,
          <p>&nbsp;<a href="#SiteUrl#showprofile.php?id=#SenderId#">#SenderName#</a> has flagged the following image as broken, while
          viewing images with the Hot or Not plugin.</p>
          <p><a href="#SiteUrl##ADMIN_DIR#userpics.php?userid=#ImageId#"><img src="#SiteUrl#getsnap.php?id=#ImageId#&typ=tn" border="0" alt=""></a></p>
          <p>&nbsp;<a href="#SiteUrl##ADMIN_DIR#userpics.php?userid=#ImageId#">Login to the admin panel</a> to remove this picture. This image was
          posted by <a href="#SiteUrl#showprofile.php?id=#ImageId#">#ImageUser#</a><br/><br/>&nbsp;thanks,<br/>
          &nbsp;osDate Daemon<br/>
          </p>
        </td></tr></table></td></tr><tr><td height="6" colspan="2" class="evenrow"></td></tr></table>';

$lang['whatisthis1']="Flag this if the picture is copyrighted or inappropriate.  Inappropriate pictures include, but are not limited to, offensive photos, sexually suggestive photos, underage photos, fake or altered photos, or celebrity photos.";
$lang['whatisthis2']="Flag this if the picture is not loading, broken, or taking longer than 15 seconds to load.";
$lang['whatisthis3']="This option flags the picture as best of";
$lang['closewindow']="Close window";
$lang['sharephoto2']="<b>Share this picture!</b>";
$lang['sharephoto3']="Share this hottie";
$lang['optional'] = "optional";
$lang['note'] = "Note";
$lang['emailto']="Email #pronoum# to";
$lang['checkout']="Check #pronoum# out!";

$lang['Subject3']="#SenderName# wants to share a picture with you!";
$lang['message3']['html']="<table border=0 cellpadding=\"0\" cellspacing=\"0\" width=\"570\">
<tr>
<td width=\"77\" height=\"25\">
	<img src=\"#SiteUrl#templates/#SkinName#/images/blue_window_3_bars.jpg\" alt=\"\" width=\"77\" height=\"25\" />
</td>
<td width=\"493\" class=\"module_head\" >
	&nbsp;&nbsp;".$lang["Subject3"]."
</td>
</tr>
<tr>
<td class=\"evenrow\" colspan=\"2\" style=\"padding: 5px;\"><a href=\"#SiteUrl#showprofile.php?id=#SenderId#\">#SenderName#</a>
          says:<br>
          &quot;#note#&quot;
          <br/><br/>
          <table>
          	<tr>
          		<td>
          			<a href=\"#SiteUrl##ADMIN_DIR#userpics.php?userid=#ImageId#\"><img src=\"#SiteUrl#getsnap.php?id=#ImageId#&typ=tn\" border=\"0\" alt=\"\"></a>
          		</td>
          		<td valign=\"middle\">
					<a href=\"#SiteUrl#showprofile.php?id=#ImageId#\">Click here to view profile</a>
		  		</td>
		  	</tr>
		  </table>
</td>
</tr>
</table>";
$lang['message3']['text']="#SenderName# says:
\"#note#\"

The link to photo is: #SiteUrl#showprofile.php?id=#ImageId#
";
$lang['sharephotosent']="The photo has been sent!";
$lang['clickhereshare']="Click here to send this photo to more emails";
$lang['send']="Send!";

$lang['view_more_photos']="view more photos";
?>