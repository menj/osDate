<?php

	$lang['user_title']="Hot or Not";
	$lang['show_me']="Laat zien";

	$lang['opt1']="Mannen en vrouwen";
	$lang['opt2']="Alleen vrouwen";
	$lang['opt3']="Alleen mannen";
	$lang['opt4']="Alle leeftijden";
	$lang['opt5']="ages 18-25";
	$lang['opt6']="ages 26-32";
	$lang['opt7']="ages 33-40";
	$lang['opt8']="over 40";
	$lang['opt9']="Met alle waardering";
	$lang['opt10']="Met de waardering tussen 1 en 5";
	$lang['opt11']="Met de waardering tussen 5 en 8";
	$lang['opt12']="Met de waardering tussen 8 en 10";

	$lang['desc1']="Wat anderen gedachten...";
	$lang['desc2']['M']="hem";
	$lang['desc2']['F']="haar";
	$lang['desc3']="Jouw waardering";
	$lang['desc4']="Gebaseerd op";
	$lang['desc5']="Stemmen";
	$lang['desc6']="U kunt specificeren welk waardering systeem als basis voor Hot zou moeten dienen of NOT plugin.";
	$lang['desc7']="om nieuw waarderings ysteem toe te voegen.";
	$lang['desc8']['M']="Hij";
	$lang['desc8']['F']="Zij";
	$lang['desc9']="Gecontroleerd";
	$lang['desc10']="score";
	$lang['desc11']="Verleden";
	$lang['desc12']['M']="hem";
	$lang['desc12']['F']="haar";
	$lang['desc13']="stemmen geteld en";
	$lang['desc14']="foto\'s'opgeladen";

	$lang['error']="Er zijn geen profielen meer over om te waarderen! Probeer later nog eens, wanneer meer gebruikers zijn aangemeld, om met je waardering waardering verder te gaan";
	$lang['error2']="Profiel waardering systeem is met succes veranderd.";

	$lang['clickhere'] ="Klik hier om me te ontmoeten";

	$lang['not']="NOT";
	$lang['hot']="HOT";

	$lang['ago']['seconds']="seconden";
	$lang['ago']['minutes']="minuten";
	$lang['ago']['hours']="Uren";
	$lang['ago']['days']="Dagen";
	$lang['ago']['months']="Maanden";
	$lang['ago']['years']="Jaren";

	$lang['submenu1']="Waardeer members";
	$lang['submenu2']="Ontmoet members";
	$lang['submenu3']="Beste van";

	$lang['sharephoto']="Delen";

	$lang['select']="Selecteer waardering system:";

	$lang['Subject1']="Foto gemeld zoals ongepast";
	$lang['Subject2']="Foto gemeld zoals gebroken";

	$lang['flag'][1]="Ongepast";
	$lang['flag'][2]="Gebroken";
	$lang['flag'][3]="Beste van";
	$lang['flag'][4]="Wat dit is";

	$lang['sharelink']="Profiel link";

	$lang['descflag1']="Markeer foto als";
	$lang['descflag2']="Het eerder bekeken foto is gemarkeerd als ongepast.";
	$lang['descflag3']="Het eerder bekeken foto is gemarkeerd zoals gebroken.";
	$lang['descflag4']="Het foto is gemarkeerd zoals beste van.";


	$lang['message1']['text']=' Beste #AdminName#,

	<a href="#SiteUrl#showprofile.php?id=#SenderId#">#SenderName#</a> het volgende foto ongepast, bij het bekijken van de foto met Hot ore NOT plugin als gemarkeerd.
	Link van de foto: #SiteUrl#admin/userpics.php?userid=#ImageId# (U moet als admin worden ingelogd)
    <a href="#SiteUrl#admin/userpics.php?userid=#ImageId#">Login jouw adminpaneel</a> om dit foto te verwijderen. Dit beeld werd onlangs gepost <a href="#SiteUrl#showprofile.php?id=#ImageId#">#ImageUser#</a>


    Dank u wel,
    osDate Daemon';
$lang['message1']['html'] =
'<table border=0 cellpadding="0" cellspacing="0" width="570"><tr><td width="77" height="25"><img src="#SiteUrl#templates/#SkinName#/images/blue_window_3_bars.jpg" alt="" width="77" height="25" /></td><td width="493" class="module_head" >&nbsp;&nbsp;'.$lang["Subject1"].' </td></tr>
<tr><td width="570" class="evenrow" colspan="2" style="padding: 5px;"><table border="0" cellspacing="2" cellpadding="0"><tr><td height="2"></td></tr><tr><td width="100%" valign="top">&nbsp;Dear
          #AdminName#,
          <p>&nbsp;<a href="#SiteUrl#showprofile.php?id=#SenderId#">#SenderName#</a> het volgende foto is ongepast, bij het bekijken van beelden met HOT ore NOT plugin als gemarkeerd.</p>
          <p><a href="#SiteUrl#admin/userpics.php?userid=#ImageId#"><img src="#SiteUrl#getsnap.php?id=#ImageId#&typ=tn" border="0" alt=""></a></p>
          <p>&nbsp;<a href="#SiteUrl#admin/userpics.php?userid=#ImageId#">Login jouw adminpaneel</a> om dit foto te verwijderen. Dit foto werd onlangs gepost <a href="#SiteUrl#showprofile.php?id=#ImageId#">#ImageUser#</a><br/><br/>&nbsp;thanks,<br/>
          &nbsp;osDate Daemon<br/>
          </p>
        </td></tr></table></td></tr><tr><td height="6" colspan="2" class="evenrow"></td></tr></table>';

	$lang['message2']['text']=' Dear #AdminName#,

	<a href="#SiteUrl#showprofile.php?id=#SenderId#">#SenderName#</a> de volgende foto zoals gebroken, bij het bekijken van foto met HOT ore NOT plugin is gemarkeerd.
	Link to image: #SiteUrl#admin/userpics.php?userid=#ImageId# (U moet als admin worden ingelogd)
    <a href="#SiteUrl#admin/userpics.php?userid=#ImageId#">Login jouw adminpaneel</a> om dit foto te verwijderen. Dit foto werd onlangs gepost <a href="#SiteUrl#showprofile.php?id=#ImageId#">#ImageUser#</a>


    Dank u wel,
    osDate Daemon';
$lang['message2']['html'] =
'<table border=0 cellpadding="0" cellspacing="0" width="570"><tr><td width="77" height="25"><img src="#SiteUrl#templates/#SkinName#/images/blue_window_3_bars.jpg" alt="" width="77" height="25" /></td><td width="493" class="module_head" >&nbsp;&nbsp;'.$lang["Subject2"].' </td></tr>
<tr><td width="570" class="evenrow" colspan="2" style="padding: 5px;"><table border="0" cellspacing="2" cellpadding="0"><tr><td height="2"></td></tr><tr><td width="100%" valign="top">&nbsp;Dear
          #AdminName#,
          <p>&nbsp;<a href="#SiteUrl#showprofile.php?id=#SenderId#">#SenderName#</a> de volgende foto zoals gebroken, terwijl het bekijken van beelden met HOT ore NOT plugin is gemarkeerd.</p>
          <p><a href="#SiteUrl#admin/userpics.php?userid=#ImageId#"><img src="#SiteUrl#getsnap.php?id=#ImageId#&typ=tn" border="0" alt=""></a></p>
          <p>&nbsp;<a href="#SiteUrl#admin/userpics.php?userid=#ImageId#">Login jouw adminpaneel</a> om deze foto te verwijderen. Deze foto werd onlangs gepost <a href="#SiteUrl#showprofile.php?id=#ImageId#">#ImageUser#</a><br/><br/>&nbsp;Dank u wel,<br/>
          &nbsp;osDate Daemon<br/>
          </p>
        </td></tr></table></td></tr><tr><td height="6" colspan="2" class="evenrow"></td></tr></table>';

$lang['whatisthis1']="Markeer dit als het foto copyrighted of is ongepast is. De ongepaste beelden omvatten, maar zijn niet beperkt tot, aanvallende foto's, seksueel suggestieve foto's, underage foto's, valse of veranderde foto\'s, of beroemdheidsfoto's.";
$lang['whatisthis2']="om deze foto te verwijderen. Deze foto werd onlangs gepost.";
$lang['whatisthis3']="Deze optie markeert de foto zoals beste van";
$lang['closewindow']="Sluit dit scherm";
$lang['sharephoto2']="<b>Deel deze foto!</b>";
$lang['sharephoto3']="deel deze hottie";
$lang['optional'] = "Niet verplicht";
$lang['note'] = "Opmerking";
$lang['emailto']="Email #pronoum# naar";
$lang['checkout']="Check #pronoum# Uit!";

$lang['Subject3']="#SenderName# Ik wil deze foto delen met jouw!";
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
          			<a href=\"#SiteUrl#admin/userpics.php?userid=#ImageId#\"><img src=\"#SiteUrl#getsnap.php?id=#ImageId#&typ=tn\" border=\"0\" alt=\"\"></a>
          		</td>
          		<td valign=\"middle\">
					<a href=\"#SiteUrl#showprofile.php?id=#ImageId#\">Klik hier om de profiel te bekijken</a>
		  		</td>
		  	</tr>
		  </table>
</td>
</tr>
</table>";
$lang['message3']['text']="#SenderName# zegt:
\"#note#\"

De link van de foto is: #SiteUrl#showprofile.php?id=#ImageId#
";
$lang['sharephotosent']="De foto is verzonden!";
$lang['clickhereshare']="Klik hier om de foto naar meerdere emails";
$lang['send']="Verzenden!";

$lang['view_more_photos']="Laat meer foto\'s te zien";
?>