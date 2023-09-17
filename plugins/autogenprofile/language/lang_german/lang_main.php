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


// Plugins german lang file changed
// OSdate v2.0alpha patchset3 german language file corrected by Christian_Thomas (admin@hostonline.de) 
// Changes from MAR.13, 2007, 19.43h

	$lang['user_title']="Automatischer Profilgenerator";
	
	$lang['desc']="Der Profilgenerator erzeugt nach dem Zufallsprinzip neue Profile, um Deine Datingseite f�r aussenstehende attraktiver erscheinen zu lassen.";
	$lang['desc2']=' Bevor Du den Profilgenerator startest, solltest Du folgende Files erg�nzen bzw. �ndern:<br/>
    PLUGIN_PATHtemp/lastnames.txt<br/>
    PLUGIN_PATHtemp/female_firstnames.txt<br/>
    PLUGIN_PATHtemp/male_firstnames.txt<br/><br/>
    Beispielprofilbilder sollten hier gespeichert werden: /temp/profile_images/<br/>
    Der Bildname muss folgenden Regeln entsprechen: {geschlecht}_{alter}_{Hautfarbe}_{Zusatz}.{extension}<br/>
    {geschlecht} -  muss "m" oder "f" lauten f�r "male" or "female"<br/>
    {alter} - muss eine Zahl zwischen 16 und 90 sein<br/>
    {Hautfarbe} - muss aus folgenden Buchstaben bestehen: "w" f�r weisse; "b" f�r schwarze (black); "a" f�r asiatisch; "o" f�r andere;<br/><br/>
    Der erste Teil des Filenamens {geschlecht}_{alter}_{ethnicity} ist zwingend, <br/>der {Zusatz} kann auch durch einen "_" nach {Hautfarbe} ersetzt werden.<br/> Beispiel: m_20_b_01.jpg and m_20_b_02.jpg wenn Du 2 20j�hrige M�nner schwarzer Hautfarbe hast.<br/>';
	$plugindir=str_replace("\\","/",PLUGIN_DIR);
	$lang['desc2']=str_replace("PLUGIN_PATH",$plugindir,$lang['desc2']);
	$lang['opt1']="Anzahl der zu generierenden Profile:";
	$lang['atleast']="Mindestens";
	$lang['opt2']="der Profiles sollen m�nnlich sein.";
	$lang['opt3']="der Profiles sollen weiblich sein.";
	$lang['opt4']="W�hle die Zahl der zu benutzenden L�nder:";
	$lang['opt5']="der Profile sollen sein in";
	$lang['opt6']="W�hle die Zahl der zu benutzenden Altersbereiche:";
	$lang['opt7']="der Profile sollen im Altersbereich sein:";
	$lang['opt8']="der Profile sollen Weisser Hautfarbe sein.";
	$lang['opt9']="der Profile sollen schwarzer Hautfarbe sein.";
	$lang['opt10']="der Profile sollen Asiaten sein.";
	$lang['opt11']="der Profile sollen Anderer Hautfarbe sein.";
	
	$lang['generate']="Erzeugen";
	$lang['and']="und";
	$lang['showforms']="Zuvor erzeugte Profile anzeigen";
	$lang['total_forms']="Insgesamt erzeugte forms:";
	$lang['total_users']="Insgesamt erzeugte Benutzer:";
	$lang['forminfo']="Statistik f�r erzeugte form:";
	$lang['form_date']="Run Datum";
	$lang['malegen']="M�nner";
	$lang['femalegen']="Frauen";
	
	$lang['username']="Benutzername";
	$lang['gender']="Geschlecht";
	$lang['fullname']="Voller Name";
	$lang['birth_date']="Geburtsdatum";
	$lang['ethnicity']="Hautfarbe";
	$lang['country']="Land";
	
	$lang['form1']="Benutzer erzeugt nach Geschlecht:";
	$lang['form2']="Benutzer erzeugt nach Hautfarbe:";
	$lang['form3']="Benutzer erzeugt nach Alter:";
	$lang['form4']="Benutzer erzeugt nach L�ndern:";
	
	$lang['etn1']="Weiss";
	$lang['etn2']="Schwarz";
	$lang['etn3']="Asiatisch";
	$lang['etn4']="Andere";	
	
	$lang['next']="n�chste Seite";
	$lang['previous']="vorherige Seite";
	
	$lang['random']="zuf�llig";
	$lang['between']="zwischen";	

	$lang['error2']="Profile wurden erfolgreich erstellt.";
	$lang['error3']="Bist Du sicher, das Du alle in dieser Instanz erzeugten Profile l�schen willst?";
	$lang['error4']="Bitte trage eine positive, ganze Zahl f�r die Anzahl der zu erzeugenden Profile ein.";
	$lang['error5']="Bitte trage eine positive, ganze Zahl f�r die Anzahl der zu verwendenden L�nder ein.";
	$lang['error6']="Bitte trage eine positive, ganze Zahl f�r die Anzahl der zu verwendenden Altersbereiche ein.";
	
?>