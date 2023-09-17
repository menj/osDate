<?php

	$lang['user_title']="Speed Dating";
	$lang['desc1']="Contacteer snel vele potentiële gelijken met één enkele e-mail of knipoog. Gebruik om het even welk van uw bewaarde onderzoeken, of de momenteel-geladen seach resultaten. Dan specificeer de methode van contact, en de klik legt voor. Er is een grens van 100 knipoogt of berichten per uur met deze eigenschap.";
	$lang['title1']="Ik wil graag contact deze matches:";
	$lang['title2']="Methode van contact:";
	
	$lang['opt1']="Alle gelijken van ' Mijn Gelijken'";
	$lang['opt2']="Alle gebruikers die door mijn meest recente profiel zijn teruggekeerd zoeken";
	$lang['opt3']="Alle gebruikers bij deze opgeslagen zoekoptie";
	$lang['opt4']="Verzend alleen een wink";
	$lang['opt5']="Gebruik dit bewaarde e-mail Template:";
	$lang['opt6']="Verzend dit bericht:";
	$lang['opt7']="Overlappingscontrole (Geadviseerde). Met deze optie, de gebruikers die u hebt messaged of knipoogden bij binnen het verleden";
	$lang['opt71']="de dagen zullen worden overgeslagen.";
	
	$lang['error'][1]="Geen gevonden gegevens.";
	$lang['error'][2]="Uw contact grens is overschreden voor de huidige tijdspanne. U kunt een maximum van verzenden";
	$lang['error'][22]="de berichten of knipoogt op dit ogenblik.";
	$lang['error'][3]="Er zijn geen ontvangers want dit knipoogt. Gelieve te kiezen een verschillende groep van de hieronder keuzen te contacteren.";
	$lang['error'][31]="Er zijn geen ontvangers voor dit bericht. Gelieve te kiezen een verschillende groep van de hieronder keuzen te contacteren.";
	$lang['error'][4]="Uw knipogen zijn verzonden!";
	$lang['error'][5]="Uw berichten zijn verzonden!";
	
	$lang['search_name']="Zoek naam: ";
	$lang['subject']="Onderwerp:";
	$lang['body']="Body:";
	
$lang['wink_received']['TEXT'] = "Beste #FirstName#,

U hebt knipoog van ontvangen #siteName# user '#SenderName#'.

Bezoek <a href=\"#link#\">#siteName#</a> om een bericht terug te zenden naar '#SenderName#'.

Veel geluk!
#AdminName#
SITENAME";

$lang['wink_received']['HTML'] = '<table border=0 cellpadding="0" cellspacing="0" width="570"><tr><td width="77" height="25px"><img src="#SiteUrl#templates/#SkinName#/images/blue_window_3_bars.jpg" alt="" width="77" height="25px" /></td><td width="493" class="module_head" >&nbsp;&nbsp;#SenderName# just winked at you! </td></tr><tr><td width="570" class="evenrow" colspan="2" style="padding: 5px;"><table border="0" cellspacing="2" cellpadding="2"><tr><td height="6"></td></tr><tr><td width="50%" valign="top">#smallProfile#</td><td width="50%" valign="top">Out of many members, #SenderName# picked you for a wink! You can keep the flirting going by winking back, or by sending an e-mail.<br><br><a href="#SiteUrl#compose.php?recipient=#UserId#">E-mail #SenderName# now</a><br><br><a href="#SiteUrl#sendwinks.php?ref_id=#UserId#&amp;rtnurl=showprofile.php">Return the wink</a><br><br>
<b>Not Interested?</b><br>Give #SenderName# the courtsey of knowing that you\'re not interested by sending a "No, thanks" message<br><br><a href="#SiteUrl#compose.php?recipient=#UserId#&amp;reply=11">Say "No, thanks"</a><br><br></td></tr></table></td></tr><tr><td height="6" colspan="2" class="evenrow"></td></tr></table> ';

?>