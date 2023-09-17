<?php
	$lang['user_title']="Auto Profielen Generator";

	$lang['desc']="Deze profielgenerator kan uw nieuwe het dating website snel actief maken. De gebruikersprofielen worden steekproef willekeurig aangemaakt, maar om de resultaten te verfijnen, kunt je hieronder getoonde beperkingen specificeren.";
	$lang['desc2']='Om de auto Genarator uit te breiden met profiel namen, dan kan je in de directory zoals hieronder staat vermeld de files de namen toevoegen.:<br/><br/>
    PLUGIN_PATHtemp/lastnames.txt<br/>
    PLUGIN_PATHtemp/female_firstnames.txt<br/>
    PLUGIN_PATHtemp/male_firstnames.txt<br/><br/>
    Om de auto Genarator voorbeeld profiel foto\'s uit te breiden, kan je in deze directory de foto\'s worden geplaatst:<br/><br/>/temp/profile_images/<br/><br/>
    De foto namen moeten de volgende formaatregels gebruiken:<br/><br/> {geslacht}_{leeftijd}_{ras}_{uitbreiding}.{uitbreiding}<br/>
    {geslacht} -  moet met "m" of "f" corresponderen met "man" or "vrouw"<br/><br/>
    {leeftijd} - moet een geheel aantal tussen 16 en 90 zijn<br/>
    {ras} - moet 1 hiervan zijn: "w" voor wit; "b" voor zwart; "a" voor asian; "o" voor andere;<br/><br/>
    Dit eerste deel van het files - de naam wordt vereist: {geslacht}_{leeftijd}_{ras}. De extra tekst kan met extra worden toegevoegd "_" spatie daarna {het behoren tot een bepaald ras}. Als voorbeeld m_20_b_01.jpg en m_20_b_02.jpg als je twee 20-yr old zwarte vrouwen.<br/>';
	$plugindir=str_replace("\\","/",PLUGIN_DIR);
	$lang['desc2']=str_replace("PLUGIN_PATH",$plugindir,$lang['desc2']);
	$lang['opt1']="Aantal te produceren profielen:";
	$lang['atleast']="Minstens";
	$lang['opt2']="van profielen mannen zouden moeten zijn.";
	$lang['opt3']="van profielen vrouwen zouden moeten zijn.";
	$lang['opt4']="Kies hoeveelheid landen:";
	$lang['opt5']="of profielen zou moeten in";
	$lang['opt6']="Kies het aantal leeftijdsgroepen:";
	$lang['opt7']="van profielen binnen leeftijden zou moeten zijn";
	$lang['opt8']="van de profielen moeten tot het witte ras behoren.";
	$lang['opt9']="van de profielen moeten tot het zwarte ras behoren.";
	$lang['opt10']="van de profielen moeten tot het asian behoren.";
	$lang['opt11']="van de profielen moeten een andere ras.";

	$lang['generate']="Aanmaken";
	$lang['and']="en";
	$lang['showforms']="De geproduceerde gegevens tonen";
	$lang['total_forms']="Totaal geproduceerde formulieren:";
	$lang['total_users']="Totaal geproduceerde members:";
	$lang['forminfo']="Statistieken voor deze geproduceerde formulieren:";
	$lang['form_date']="Run Date";
	$lang['malegen']="Mannen";
	$lang['femalegen']="vrouwen";

	$lang['username']="Gebruikersnaam";
	$lang['gender']="Geslacht";
	$lang['fullname']="Volledige Naam";
	$lang['birth_date']="Verjaardag";
	$lang['ethnicity']="Ras";
	$lang['country']="Land";

	$lang['form1']="Gebruikers aangemaakt op geslacht:";
	$lang['form2']="Gebruikers aangemaakt op ras:";
	$lang['form3']="Gebruikers aangemaakt op leeftijd:";
	$lang['form4']="Gebruikers aangemaakt op landen:";

	$lang['etn1']="Wit";
	$lang['etn2']="Zwart";
	$lang['etn3']="Asian";
	$lang['etn4']="Anders";

	$lang['next']="Volgende pagina";
	$lang['previous']="Vorige pagina";

	$lang['random']="Willekeurig";
	$lang['between']="Tussen";


	$lang['error2']="de profielen zijn met succes gecreerd.";
	$lang['error3']="Bent zeker u u wilt alle profielen verwijderen die in deze instantie werden geproduceerd?";
	$lang['error4']="Gelieve te specificeren een positieve waarde voor het aantal profielen.";
	$lang['error5']="Gelieve te specificeren een positieve waarde voor het aantal landen.";
	$lang['error6']="Gelieve te specificeren een positieve waarde voor de leeftijd.";
?>