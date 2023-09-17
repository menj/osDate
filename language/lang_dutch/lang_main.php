<?php
$lang['ENCODING'] = 'utf-8';
$lang['about_me'] = 'Over mezelf';
$lang['about_me_hlp'] = 'Geef een korte omschrijving van jezelf, voor geGe&iuml;nteresseerden, en om meer reacties te krijgen.';
$lang['above_lookagestart'] = 'Member(s) ouder dan mijn begin limiet';
$lang['accept_tos'] = 'Ik heb de <a href="javascript:popUpScrollWindow(\'tos.php\',\'center\',650,600);">Gebruiksvoorwaarden</a> gelezen en geaccepteerd';
$lang['access_denied'] = 'Toegang Geweigerd';
$lang['action'] = 'Actie';
$lang['activate'] = 'Activeren';
$lang['active'] = 'Actief';
$lang['activedays_array'] = array(
'1' => '1',
'180' => '180',
'30' => '30',
'365' => '365',
'7' => '7',
'90' => '90',
'999' => '999',
        );

//
// Dit gedeelte is voor de taal optie
//
$lang['lang_ensure'] = 'Maak hier uw keuze dat als u help nodig hebt';
$lang['lang_ensureto'] = 'Uitleg taal bestand opladen:';
$lang['lang_ensurevt'] = 'Uitleg Verwijder taal bestand:';
$lang['lang_ensurebd'] = 'Uitleg Toon/bewerk definities knop:';
$lang['lang_ensurepb'] = 'Uitleg Produceer bestand:';

$lang['language_opt'] = 'Taal optie';
$lang['lang_deleted'] = 'Taal definities voor #LANGUAGE# zijn verwijderd';
$lang['lang_to_load'] = 'Te laden taal';
$lang['delete_lang'] = 'Verwijder taal uit DB';
$lang['gen_lang_file'] = 'Produceer bestand';
$lang['viewedit_lang'] = 'Toon/bewerk Definities';
$lang['lang_not_loaded_descr'] = 'De #SEL_LANG# de taal definities worden niet nog geladen. U kunt een dossier van standaard taal definities van Engelse definities cre�ren en veranderingen in waarden in het dossier aanbrengen en het laden gebruikend de optie \ \ " De Taal \ \ " van de lading;. Andere optie moet veranderingen voor elke hieronder gegeven definities aanbrengen en elke veranderingen en definitief terugkeren in het Manage de optiescherm van Talen en het gebruiken van \ \ " opslaan; Produceer file \ \ " de optie, leidt tot off-line taal file voor toekomstig gebruik.';
$lang['language_opt_faq'] = 'FAQ';
//
// Dit gedeelte is voor de taal optie faq
//
$lang['lang_definities'] = '<p><b>Uitleg Toon/bewerk definities knop:</b></p><ul><li>Kies eerst uw taal die u wilt bewerken.</li><br /><li>Druk daarna op de knop Toon/bewerk definities</li><br /><li>Zie of zoek en of bewerk de gewenste omschrijving.</li><br /><li>Na bewerken per gewenste omschrijving op de knop opslaan drukken.</li><br /><li>LET OP: na bewerken of herstellen van alle taal omschrijving, zult u daarna op de knop produceer bestand moeten drukken. Dit zorgt ervoor dat NIET alleen het dat het in de database is veranderd, maar ook dat u nu een aangepaste taal bestand zult creeren.</li></ul>';
$lang['lang_verwijder'] = '<p><b>Verwijder taal bestand:</b></p><ul><br /><li>Om een bepaalde taal bestand uit de database te verwijderen, selecteer u eerst de gewenste taal die u wilt verwijderen.</li><br /><li>Druk daarna op de knop verwijder taal bestand.</li></ul><p><b>LET OP: VERWIJDER NOOIT DE EGELSE TAAL BESTAND.</b></p>';
$lang['lang_bestand'] = '<p><b>Produceer bestand:</b></p><ul><li>Zoals in de eerdere stap is uitgelegd, zult u nu ook een nieuwe taal bestand moeten maken van de des gewenste taal.</li><br /><li>Na het corrigeren van de gewenste taal, druk u op de knop Produceer bestand, zorg er wel voor dat de folder op de server een chmod 777 heeft gekregen. Indien dit niet is gebeurd, zal er ook geen nieuwe taal bestand worden aangemaakt.</li><br /><li>Na het aanmaken van een nieuwe taal bestand, gaat u naar de ftp server folder /temp/lang_dutch/ in die folder staat dan ook de nieuwste taal bestand die u zo juist heeft gecreerd. Koppieer dit bestand naar de folder /language/lang_dutch/. Daarna kunt u terug gaan naar uw admin (CP) om eventueel de nieuwe taal bestand opnieuw op te laden in de database.</li></ul> ';
$lang['lang_opladen'] = '<b>Het opladen van diverse taal bestanden:</b><ul><br /><li>selecteer eerst vanuit de drop down menu de taal die u wilt opladen naar de database</li><br /><li>Druk daarna op de knop Talen opladen. </li><br /><li>Na enige tijd zal u een melding krijgen dat de taal aangemaakt is in de database.</li><br /><li>Het opladen van de taal is dan voldaan, en u kunt eventueel dan ook een andere taal opladen</li></ul>';

$lang['offer_text'] = 'Zie waarom SITENAME de snelst groeiende relatiewebsite is op het web. Maak je SITENAME profiel aan om de spannende reis naar het vinden van je match te beginnen.';

$lang['active_aff'] = 'Actieve Partners';
$lang['active_days'] = 'Hoeveel dagen geldig?';
$lang['active_profiles'] = 'Actieve Profielen';
$lang['added_list'] = array(
'html' => '<table border=0 cellpadding="0" cellspacing="0" width="570"><tr><td height="25" width="100%"><div class="module_head"><table border=0 cellspacing=0 cellpadding=0 width="100%"><tr><td width="77" height="25px" class="module_head">
<div class="module_head">#email_hdr_left#</div></td><td width="493" class="module_head" ><div class="module_head">&nbsp;&nbsp;Je bent toegevoegd aan de lijst #ListName# van #SenderName#!</div></td></tr></table></div></td></tr><tr><td width="100%" class="evenrow" colspan="2" >
<div class="evenrow"><table border="0" cellspacing="0" cellpadding="5"><tr><td height="2"></td></tr><tr><td width="50%" valign="top" class="evenrow">Beste #FirstName#,<br><br>Het lid <b>#SenderName#</b> heeft je toegevoegd aan zijn/haar lijst <b>#ListName#</b>.<br><br>Om het profiel van deze gebruiker te bekijken, ga naar <a href=\\"#link#\\">SITENAME</a>.<br><br>Succes!<br>#AdminName# <br>SITENAME<br></td><td valign="top">#smallProfile#</td>
</tr></table></div></td></tr><tr><td height="6" colspan="2" class="evenrow"></td></tr></table> ',
'text' => 'Beste #FirstName#,

Het lid #SenderName# heeft je toegevoegd aan zijn/haar lijst #ListName#.

Om het profiel van deze gebruiker te bekijken, ga naar <a href="#link#">SITENAME</a>.

Succes!
#AdminName#
SITENAME',
        );
$lang['added_list_sub'] = 'SITENAME Bericht: Je bent toegevoegd aan de lijst #ListName# van #SenderName#!';
$lang['additional_pics'] = 'Extra foto\'s';
$lang['addnew'] = 'Nieuwe Toevoegen';
$lang['addpage'] = 'Pagina Toevoegen';
$lang['addquestion'] = 'Vraag Toevoegen';
$lang['addtobanlist'] = 'Toevoegen aan Geblokkeerde lijst';
$lang['addtobuddylist'] = 'Toevoegen aan Vrienden lijst';
$lang['addtohotlist'] = 'Toevoegen aan Hot List';
$lang['add_admin'] = 'Bebeheerder Toevoegen';
$lang['add_affiliate'] = 'Een partner toevoegen';
$lang['add_banners'] = 'Banner Toevoegen';
$lang['add_comment'] = 'Jouw commentaar';
$lang['add_event'] = 'Gebeurtenis Toevoegen';
$lang['add_featured'] = 'Voeg Profiel toe aan Perfecte Lijst';
$lang['add_member(s)hip'] = 'Lidmaatschap type Toevoegen';
$lang['add_options'] = 'Keuzes Toevoegen';
$lang['add_option_now'] = 'Keuze Nu Toevoegen.';
$lang['add_plugin_summary'] = 'Documentatie over het maken van Plugin komt met je osDate installatie mee.';
$lang['add_polls'] = 'Poll Toevoegen';
$lang['add_template'] = 'Voorbeeld Toevoegen';
$lang['add_to_private'] = 'Toevoegen aan Priv&eacute; lijst';
$lang['adminhome'] = 'Hoofd Home';
$lang['adminltr'] = array(
'html' => '<table border=0 cellpadding="0" cellspacing="0" width="570"><tr><td height="25" width="100%"><div class="module_head"><table border=0 cellspacing=0 cellpadding=0 width="100%"><tr><td width="77" height="25" class="module_head"><div class="module_head">#email_hdr_left#</div></td><td width="493" class="module_head" ><div class="module_head">&nbsp;&nbsp;#Subject#</div></td></tr></table></div></td></tr>
<tr><td width="100%" class="evenrow" colspan="2"><div class="evenrow" ><table border="0" cellspacing="0" cellpadding="5"><tr><td height="2"></td></tr><tr><td width="100%" valign="top" class="evenrow">#LetterContent#</td></tr></table></div></td></tr><tr><td height="6" colspan="2" class="evenrow"></td></tr></table> ',
'text' => '#LetterContent#',
        );

$lang['display_control_type'] = array(
	'checkbox' => 'Controle box',
	'radio' => 'Optie knop',
	'select' => 'Drop down lijst',
	'textarea' => 'Input Tekst'
	);


$lang['admin_blog'] = 'Site Blog';
$lang['admin_col_head_fullname'] = 'Volledige naam';
$lang['admin_error'] = array(
'0' => '',
'1' => 'Member naam Bebeheerder mag niet leeg zijn.',
'10' => 'Gelieve alleen tekst waarden in de onderdeel naam te gebruiken.',
'2' => 'Wachtwoord Bebeheerder mag niet leeg zijn.',
'3' => 'Volledige Naam Bebeheerder mag niet leeg zijn.',
'4' => 'Oud Wachtwoord mag niet leeg zijn.',
'5' => 'Nieuw Wachtwoord mag niet leeg zijn.',
'6' => 'Bevestig Wachtwoord mag niet leeg zijn.',
'7' => 'Nieuw Wachtwoord en Bevestig Wachtwoord moeten overeenkomen.',
'8' => 'Het ingevoerde Oude Wachtwoord is incorrect. Probeer het a.u.b. opnieuw.',
'9' => 'De ingevoerde Member naam is al in gebruik. Kies a.u.b. een andere.',
        );
$lang['admin_error_color'] = 'Red';
$lang['admin_error_msgs'] = array(
'1' => 'Onderdeel is een vereist veld.',
'2' => 'Gelieve alle vereiste velden in te voeren.',
'3' => 'Sectie is ingeschakeld',
'4' => 'Sectie is uitgeschakeld',
'5' => 'Kalander is ingeschakeld',
'6' => 'Kalander is uitgeschakeld',
'0' => '',
        );
$lang['admin_js_error_msgs'] = array(
'0' => '',
'1' => 'Selecteer a.u.b. eerste een selectie vakje.',
'2' => 'Weet je zeker dat je door wil gaan met verwijderen?',
'3' => 'Weet je zeker dat je deze banner wil verwijderen?',
        );
$lang['admin_js__delete_error_msgs'] = array(
'0' => '',
'1' => 'Weet je zeker dat je dit onderdeel wil verwijderen? Deze actie kan niet ongedaan worden gemaakt.',
'10' => 'Weet je zeker dat je deze banner wil verwijderen? Deze actie kan niet ongedaan worden gemaakt.',
'11' => 'Weet je zeker dat je deze bebeheerder wil verwijderen? Deze actie kan niet ongedaan worden gemaakt.',
'12' => 'Weet je zeker dat je dit land wil verwijderen?',
'13' => 'Weet je zeker dat je deze provincie/staat wil verwijderen?',
'14' => 'Weet je zeker dat je deze landen wil verwijderen?',
'15' => 'Weet je zeker dat je deze provincies/staten wil verwijderen?',
'16' => 'Uitgebreid zoeken header moet opgegeven worden bij integreren in uitgebreid zoeken.',
'17' => 'Gebruikersnamen moeten worden Ingevoerd als Member(s) naam bereikt is selecteerd.',
'18' => 'Weet je zeker dat je deze profielen wil verwijderen? Deze actie kan niet ongedaan worden gemaakt.',
'19' => 'Weet je zeker dat je deze regio wil verwijderen?',
'2' => 'Weet je zeker dat je deze vraag uit dit onderdeel wil verwijderen? Deze actie kan niet ongedaan worden gemaakt.',
'20' => 'Weet je zeker dat je deze regio\'s wil verwijderen?',
'21' => 'Weet je zeker dat je deze plaats wil verwijderen?',
'22' => 'Weet je zeker dat je deze plaatsen wil verwijderen?',
'23' => 'Weet je zeker dat je deze postcode wil verwijderen?',
'24' => 'Weet je zeker dat je deze postcodes wil verwijderen?',
'25' => 'Weet je zeker dat je deze gebeurtenis wil verwijderen? Deze actie kan niet ongedaan worden gemaakt.',
'26' => 'Weet je zeker dat je deze Kalander wil verwijderen? Deze actie kan niet ongedaan worden gemaakt.',
'27' => 'Weet je zeker dat je deze pagina wil verwijderen? Deze actie kan niet ongedaan worden gemaakt.',
'3' => 'Weet je zeker dat je dit antwoord wil verwijderen? Deze actie kan niet ongedaan worden gemaakt.',
'4' => 'Weet je zeker dat je dit profiel wil verwijderen? Deze actie kan niet ongedaan worden gemaakt.',
'5' => 'Weet je zeker dat je dit nieuwsitem wil verwijderen? Deze actie kan niet ongedaan worden gemaakt.',
'6' => 'Weet je zeker dat je dit Verhaal wil verwijderen? Deze actie kan niet ongedaan worden gemaakt.',
'7' => 'Weet je zeker dat je dit artikel wil verwijderen? Deze actie kan niet ongedaan worden gemaakt.',
'8' => 'Weet je zeker dat je deze Poll   wil verwijderen? Deze actie kan niet ongedaan worden gemaakt.',
'9' => 'Weet je zeker dat je deze Poll  -keuze wil verwijderen? Deze actie kan niet ongedaan worden gemaakt.',
        );
$lang['admin_login_msg'] = 'Bebeheerder login';
$lang['admin_login_title'] = 'SITENAME Beheer menu';
$lang['admin_panel'] = 'Beheer menu';
$lang['admin_permissions'] = 'Admin rechten';
$lang['admin_rights'] = array(
'admin_mgt' => 'Admin menu',
'admin_permit_mgt' => 'Admin Rechten',
'affiliate_mgt' => 'Partner menu',
'affiliate_stats' => 'Partner statistieken',
'article_mgt' => 'Artikel menu',
'banner_mgt' => 'Banner menu',
'blog_mgt' => 'Blog menu',
'calendar_mgt' => 'Kalanders',
'change_pwd' => 'Wachtwoord Wijzigen',
'chat' => 'Chat',
'chat_mgt' => 'Chat menu',
'cntry_mgt' => 'menu Land/provincies/Plaatsen',
'event_mgt' => 'Evenementen Goedkeuren',
'ext_search' => 'Uitgebreid Zoeken',
'featured_profiles_mgt' => 'Perfecte Profielen',
'forum_mgt' => 'Forum menu',
'global_mgt' => 'Globale Site Instellingen',
'import_mgt' => 'Importeren',
'mship_mgt' => 'Lidmaatschap menu',
'news_mgt' => 'Nieuws aanmaken',
'pages_mgt' => 'Pagina menu',
'payment_mgt' => 'Betaal modules',
'plugin_mgt' => 'Plugin menu',
'poll_mgt' => 'Poll aanmaken',
'profie_approval' => 'Wachtende Profielen',
'profile_mgt' => 'Profiel menu',
'profile_ratings' => 'Profiel beoordelingen',
'promo_mgt' => 'Promotie menu',
'search' => 'Zoeken',
'section_mgt' => 'Onderdeel menu',
'send_letter' => 'Brief Versturen',
'seo_mgt' => 'SEO Instellingen',
'site_stats' => 'Site Statistieken',
'snaps_require_approval' => 'Foto\'s Goedkeuren',
'story_mgt' => 'Verhalen menu',
        );
$lang['admin_title_msg'] = 'SITENAME Beheer menu';
$lang['admin_users'] = 'Admin Member(s)';
$lang['admin_welcome'] = 'Welkom <br /> bij het <br />SITENAME<br /> Beheer menu';
$lang['advPluginettings'] = 'Geavanceerde Opties Configuratie';
$lang['affiliates'] = 'Partner';
$lang['affiliateshdr'] = 'Partners';
$lang['affiliates_error'] = array(
'18' => 'Wachtwoorden komen niet overeen',
'20' => 'Alle velden zijn vereist.',
'21' => 'Alle velden zijn vereist.',
'25' => 'Het door jou opgegeven e-mailadres is al geregistreerd door een partner. Gebruik a.u.b. een ander e-mailadres.',
        );
$lang['affiliate_head_msg'] = 'Word partner';
$lang['affiliate_head_msg2'] = 'We hebben speciale aanbiedingen voor webmasters die bezoekers naar onze site verwijzen.<br/>';
$lang['affiliate_login_title'] = 'Partner login';
$lang['affiliate_registration_success'] = 'Partnerregistratie Succesvol';
$lang['affiliate_success_msg1'] = 'Je partner account ID is:';
$lang['affiliate_success_msg2'] = 'Je kunt nu met je partner account inloggen. ';
$lang['affiliate_title'] = 'Partner menu';
$lang['aff_added'] = array(
'html' => '<table border=0 cellpadding="0" cellspacing="0" width="570"><tr><td height="25" width="100%"><div class="module_head"><table border=0 cellspacing=0 cellpadding=0 width="100%"><tr><td width="77" height="25" class="module_head"><div class="module_head">#email_hdr_left#</div></td><td width="493" class="module_head" ><div class="module_head">&nbsp;&nbsp;Je bent toegevoegd als partner! </div></td></tr></table></div></td></tr>
<tr><td width="100%" class="evenrow" colspan="2"><div class="evenrow" ><table border="0" cellspacing="0" cellpadding="5"><tr><td height="2"></td></tr><tr><td width="100%" valign="top" class="evenrow">Beste #Name#,<br><br>We zijn blij je mee te mogen delen dat je nu een partner bent van SITENAME.<br><br><b>Je ID: #Affid#</b><br><b>Je wachtwoord: #Password#</b><br><br>Bezoek <a href=\\"#SiteUrl#\\"><b>SITENAME</b></a> en login in de partnerafdeling om je wachtwoord zo gauw mogelijk te wijzigen.<br><br>Succes!<br>#AdminName# <br>SITENAME<br></td>
</tr></table></div>
</td></tr><tr><td height="6" colspan="2" class="evenrow"></td></tr></table> ',
'text' => 'Beste #Name#,

We zijn blij je mee te mogen delen dat je nu een partner bent van SITENAME.

Je ID: #Affid#
Je wachtwoord: #Password#

Bezoek <a href="#SiteUrl#"><b>SITENAME</b></a> en login in de partnerafdeling om je wachtwoord zo gauw mogelijk te wijzigen.

Succes!
#AdminName#
SITENAME',
        );
$lang['aff_added_sub'] = 'SITENAME Bericht: Je bent toegevoegd als partner!';
$lang['aff_email_body'] = 'Bedankt voor het maken van een partner account voor SITENAME. Bezoek deze URL om de partnerregistratie te voltooien:<br><br>#ConfirmationLink#';
$lang['aff_email_subject'] = 'Bevestig Je partner account';
$lang['aff_forgot_pass'] = 'Wachtwoord vergeten? Geef je e-mailadres hier op om een nieuwe toegestuurd te krijgen:';
$lang['aff_modified'] = 'Partner informatie is Gewijzigdd';
$lang['aff_newpwd'] = array(
'html' => '<table border=0 cellpadding="0" cellspacing="0" width="570"><tr><td height="25" width="100%"><div class="module_head"><table border=0 cellspacing=0 cellpadding=0 width="100%"><tr><td width="77" height="25" class="module_head"><div class="module_head">#email_hdr_left#</div></td>
<td width="493" class="module_head" ><div class="module_head">&nbsp;&nbsp;Je partner account! </div></td></tr></table></div></td></tr><tr><td width="100%" class="evenrow" colspan="2"><div class="evenrow"><table border="0" cellspacing="0" cellpadding="5"><tr><td height="2"></td></tr><tr><td width="100%" valign="top" class="evenrow">Dear #Name#,<br><br>Er is een nieuw wachtwoord gemaakt voor je partner account op SITENAME, zoals verzocht.<br>
<br><b>Je wachtwoord: #Password#</b><br><br>Bezoek <a href=\\"#SiteUrl#\\"><b>SITENAME</b></a> en login op de partnerafdeling om je wachtwoord zo gauw mogelijk te wijzigen.<br><br>Succes!<br>#AdminName# <br>SITENAME<br></td></tr></table></div>
</td></tr><tr><td height="6" colspan="2" class="evenrow"></td></tr></table> ',
'text' => 'Beste #Name#,

Er is een nieuw wachtwoord gemaakt voor je partner account op SITENAME, zoals verzocht.

Je nieuwe wachtwoord: #Password#

Bezoek <a href="#SiteUrl#"><b>SITENAME</b></a> en login op de partnerafdeling om je wachtwoord zo gauw mogelijk te wijzigen.

Succes!
#AdminName#
SITENAME',
        );
$lang['aff_newpwd_sub'] = 'SITENAME Bericht: Je partner account!';
$lang['aff_panel'] = 'Partner menu';
$lang['aff_stats'] = 'Partner statistieken';
$lang['age'] = 'Leeftijd';
$lang['album'] = '#ALBUMSCNT# Album';
$lang['albums'] = '#ALBUMSCNT# Albums';
$lang['albumsloaded'] = 'Albums opgeladen';
$lang['album_hdr'] = 'Album';
$lang['all'] = 'Alle';
$lang['all_news'] = 'Al het Nieuws';
$lang['all_states'] = 'Alle provincies';
$lang['all_stories'] = 'Alle Verhalen';
$lang['all_zips'] = 'Alle post codes';
$lang['alphanum'] = '0123456789_ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
$lang['alphanumeric'] = '0123456789.+-_#,/ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz ()_';
$lang['already_affiliate'] = 'Ben je al partner?';
$lang['amount'] = 'Aantal: ';
$lang['and'] = 'en';
$lang['AND'] = 'EN';
$lang['answer'] = 'Antwoord';
$lang['any_where'] = 'Waar dan ook';
$lang['Approve'] = 'Goedkeuren';
$lang['articles'] = 'Artikels';
$lang['article_error'] = array(
'1' => 'Artikel titel is een vereist veld.',
'2' => 'Artikel tekst is een vereist veld.',
'3' => 'Artikel datum is een vereist veld.',
        );
$lang['article_title'] = 'Titel';
$lang['attached_files'] = 'Bijgevoegde Bestanden';
$lang['back'] = 'Vorige';
$lang['back_to_messages'] = 'Terug naar Berichten';
$lang['banlisthdr'] = 'Geblokkeerden lijst';
$lang['banner'] = 'Banner:';
$lang['banner_error_msgs'] = array(
'0' => '',
'1' => 'Banner mag niet leeg blijven.',
'2' => 'Link URL mag niet leeg blijven.',
'3' => 'Tool tip mag niet leeg blijven.',
'4' => 'Alleen .jpg banners zijn toegestaan.',
'5' => 'Grootte van de banner overschrijdt toegestane limiet.',
        );
$lang['banner_link'] = 'Banner/link';
$lang['banner_linkurl'] = 'Banner / Link URL';
$lang['banner_sizes'] = array(
'100X500' => '100 x 500',
'120X120' => '120 x 120',
'468X60' => '468 x 60',
        );
$lang['banner_sizes_name'] = array(
'0' => 'horizontale',
'1' => 'verticaal',
'2' => 'vierkant',
        );
$lang['bans'] = 'Verbannen';
$lang['below_lookageend'] = 'Member(s) jonger dan mijn eind limiet';
$lang['best1'] = '(beste)';
$lang['Between'] = 'tussen';
$lang['between1'] = 'Tussen';
$lang['bigger_pic_size'] = 'Foto grootte is meer dan de toegestane grote van 8000000 KB.';
$lang['birthday_admin_msg'] = 'Hallo #FirstName# #LastName# (#USERNAME#),

Wens u een zeer Gelukkige Verjaardag

Admin
SITENAME';
$lang['birthday_admin_msg_sub'] = 'Gelukkige Verjaardag!!';
$lang['birthday_messages_sent'] = 'De wensen van de verjaardag is verzonden';
$lang['birthday_msg_sub'] = 'Verjaardag wensen';
$lang['birthday_msg_text'] = 'Hallo #USERNAME#,

Wens u een zeer Gelukkige Verjaardag!!

#FROMNAME#';
$lang['birthday_profiles'] = 'Member(s) die Verjaardag vandaag vieren';
$lang['blog'] = array(
'del01' => 'Weet je zeker dat je dit commentaar wil verwijderen?',
'del02' => 'Weet je zeker dat je deze selectie wil verwijderen: ',
'del03' => 'Weet je zeker dat je dit wil herinstalleren: ',
'del04' => 'Wilt u werkelijk selecteerd des-installeren ',
'deleted' => 'Het selecteerde blog Verhaal wordt verwijderd.',
'hdr' => 'Blog',
        );
$lang['blogs'] = 'Blogs';
$lang['blogsearch'] = 'Zoek in Blogs';
$lang['blog_add_vote'] = 'Stem nu';
$lang['blog_bad_words'] = 'Verkeerde woorden';
$lang['blog_bad_words_help'] = '(een woord per regel)';
$lang['blog_buddies_comment'] = 'Commentaar vrienden';
$lang['blog_comments'] = 'Commentaar';
$lang['blog_creator'] = 'Auteur';
$lang['blog_date_posted_hdr'] = 'Datum';
$lang['blog_default_bad_words'] = 'xxx|levitra';
$lang['blog_description'] = 'Blog omschrijving';
$lang['blog_entries'] = 'Blog:';
$lang['blog_errors'] = array(
'comment_bad_word' => 'Je commentaar bevat het geblokkeerde woord %s',
'date_posted_noblank' => 'Een post datum moet worden opgegeven.',
'description_noblank' => 'Blog omschrijving moet worden opgegeven. ',
'max_stories_warning' => 'Je hebt het maximum aantal verhalen bereikt. Er kunnen geen meer worden toegevoegd.',
'name_noblank' => 'Blog Naam moet worden opgegeven.',
'nosetup' => 'Beginwaarden Blog Instellingen moeten worden opgegeven.',
'story_noblank' => 'Blog inhoud moet worden opgegeven.',
'title_noblank' => 'Er moet een titel worden opgegeven.',
        );
$lang['blog_gui_editor'] = 'WYSIWYG Editor';
$lang['blog_load_template'] = 'Laad Voorbeeld';
$lang['blog_max_comments'] = 'Maximum commentaar';
$lang['blog_member(s)_comment'] = 'Commentaar Member(s)';
$lang['blog_member(s)_vote'] = 'Stemmen Member(s)';
$lang['blog_name'] = 'Blog naam';
$lang['blog_number'] = 'Nummer';
$lang['blog_posted_date'] = 'Post Datum';
$lang['blog_rating_hdr'] = 'gebaseerd op';
$lang['blog_rating_list_hdr'] = 'Beoordeling';
$lang['blog_save_template'] = 'Opslaan als Voorbeeld';
$lang['blog_search_body'] = 'Tekst';
$lang['blog_search_date'] = 'Datum';
$lang['blog_search_menu'] = 'Blog Zoeken';
$lang['blog_search_results'] = 'Blog zoekresultaten';
$lang['blog_search_title'] = 'Titel';
$lang['blog_search_username'] = 'Member naam';
$lang['blog_stories'] = 'Blog verhalen';
$lang['blog_story'] = 'Inhoud';
$lang['blog_submit_vote'] = 'Stemmen';
$lang['blog_subtitle_add'] = 'Maak een Blog post';
$lang['blog_subtitle_edit'] = 'Blog Bewerken';
$lang['blog_subtitle_list'] = 'Blog lijst';
$lang['blog_title'] = 'Titel';
$lang['blog_title_hdr'] = 'Titel';
$lang['blog_views_hdr'] = 'Keer Bekeken';
$lang['blog_votes1'] = 'Stemmen';
$lang['blog_votes_hdr'] = 'Stemmen';
$lang['body'] = 'Tekst:';
$lang['buddylisthdr'] = 'Vrienden lijst';
$lang['business'] = 'Bedrijf:';
$lang['by'] = 'Door';
$lang['calendar'] = 'Kalander:';
$lang['calendar_admin'] = 'Kalander menu';
$lang['calendar_field'] = 'Kalander:';
$lang['calendar_title'] = 'Kalander';
$lang['calendat_filter_dates_range'] = 'selecteerde Datums';
$lang['calendat_filter_last_month'] = 'Vorige Maand';
$lang['calendat_filter_last_week'] = 'Vorige Week';
$lang['calendat_filter_last_year'] = 'Vorig Jaar';
$lang['calendat_filter_yesterday'] = 'Gisteren';
$lang['cancel'] = 'Annuleren';
$lang['cancel_date'] = 'Datum Deactiveert';
$lang['cancel_domsg'] = 'Hartelijk bedankt voor het gebruiken van SITENAME. <br><br>We vinden het jammer dat je niet langer lid bent, maar je blijft altijd welkom, en we hopen dat we je van dienst zijn geweest.';
$lang['cancel_hdr'] = 'Lidmaatschap Opzeggen';
$lang['cancel_list'] = 'Lijst Gedeactiveerd Member(s)';
$lang['cancel_nomsg'] = 'Bedankt voor het gebruiken van SITENAME.<br><br>We waarderen je voortdurende lidmaatschap, en hopen dat je onze diensten bruikbaar vindt.';
$lang['cancel_opt01'] = 'Ja, ik weet het zeker';
$lang['cancel_opt02'] = 'Nee. ik wil nu niet opzeggen';
$lang['cancel_txt01'] = 'Je hebt ervoor gekozen je <b>SITENAME</b> lidmaatschap op te zeggen.<br /><br />Weet je zeker dat je dit wil doen? ';
$lang['cannot_determine_member(s)hip'] = 'Je lidmaatschap niveau kon niet worden bepaald';
$lang['cc_cvv_number'] = 'Creditcard Controleer nummer:';
$lang['cc_exp_date'] = 'Creditcard vervaldatum:';
$lang['cc_invalid_date'] = 'Creditcard vervaldatum is ongeldig. Probeer het a.u.b. opnieuw met een geldige creditcard.';
$lang['cc_invalid_number'] = 'Creditcardnummer is ongeldig. Probeer het a.u.b. opnieuw met een geldige creditcard.';
$lang['cc_number'] = 'Creditcardnummer:';
$lang['cc_owner'] = 'Creditcard-eigenaar:';
$lang['cc_type'] = 'Creditcard-type:';
$lang['cc_unknown'] = 'Creditcard bedrijf is onbekend. Probeer het a.u.b. opnieuw met een geldige creditcard.';
$lang['change'] = 'Wijzigen';
$lang['changeto'] = 'Veranderen Naar';
$lang['change_album'] = 'Opslaan';
$lang['change_email'] = 'Wijzig E-mail';
$lang['change_language'] = 'Wijzig Taal';
$lang['change_mship_to'] = 'Verander lidmaatschap niveau naar ';
$lang['change_password'] = 'Wijzig Wachtwoord';
$lang['change_selected'] = 'Bewerken';
$lang['change_your_admin_pwd'] = 'je je bebeheerders wachtwoord  wijzigt.';
$lang['characters'] = 'Tekens';
$lang['characters_typed'] = 'Tekens getypt';
$lang['chars_remaining'] = 'Tekens over';
$lang['chat'] = 'Chat';
$lang['checkout_cancel'] = 'Zoals verzocht is de betaling geannuleerd.';
$lang['choose_member(s)hip'] = 'Kies een lidmaatschap niveau:';
$lang['cities_count'] = ' Aantal plaatsen';
$lang['cities_loaded'] = 'Woonplaats codes geladen uit ';
$lang['cities_sql_created'] = 'Woonplaats codes SQL bestand gemaakt ';
$lang['city'] = 'Woonplaats';
$lang['cityfile'] = 'Woonplaats bestand';
$lang['city_code'] = 'Plaat code';
$lang['city_ensure'] = 'Gelieve eerst Woonplaats codes bestand te verplaatsen naar /steden. <br /><br />Het bestand moet CITYCODE, CITYNAME, COUNTYCODE en STATECODE bevatten, gescheiden door Komma.(zelfde volgorde, geen header)<br /><br /> Om Woonplaats codes voor een land te verwijderen, selecteer het land en klik op "Verwijder Woonplaats codes"';
$lang['city_name'] = 'Plaatsnaam';
$lang['clicks'] = 'Klik\'s';
$lang['click_here'] = 'Klik Hier';
$lang['close'] = 'Sluiten';
$lang['close_window'] = 'Venster Sluiten';
$lang['cntry_mgt'] = 'Beheer Landen/provincies/Plaatsen';
$lang['col_head_answer'] = 'Antwoord';
$lang['col_head_calendar'] = 'Kalander';
$lang['col_head_city'] = 'Stad';
$lang['col_head_counter'] = 'Teller';
$lang['col_head_country'] = 'Land';
$lang['col_head_date'] = 'Datum';
$lang['col_head_datefrom'] = 'Datum Van';
$lang['col_head_dateto'] = 'Datum Naar';
$lang['col_head_description'] = 'Omschrijving';
$lang['col_head_email'] = 'E-mail';
$lang['col_head_enabled'] = 'Ingeschakeld';
$lang['col_head_event'] = 'Gebeurtenis';
$lang['col_head_firstname'] = 'Voornaam';
$lang['col_head_fullname'] = 'Volledige Naam';
$lang['col_head_gender'] = 'Geslacht';
$lang['col_head_gender_short'] = 'Gs';
$lang['col_head_id'] = 'ID';
$lang['col_head_lastname'] = 'Achternaam';
$lang['col_head_name'] = 'Naam';
$lang['col_head_question'] = 'Vraag';
$lang['col_head_register_at'] = 'Geregistreerd op';
$lang['col_head_sendtime'] = 'Datum';
$lang['col_head_srno'] = '#';
$lang['col_head_status'] = 'Status';
$lang['col_head_subject'] = 'Onderwerp';
$lang['col_head_username'] = 'Gebruiker';
$lang['col_head_value'] = 'Waarde';
$lang['col_head_variable'] = 'Variabele';
$lang['col_head_zip'] = 'Postcode';
$lang['comment'] = 'Commentaar';
$lang['comments'] = 'Commentaar';
$lang['comments_colon'] = 'Commentaar:';
$lang['comment_note'] = 'Commentaar langer dat 255 tekens wordt ingekort';
$lang['comment_received'] = array(
'html' => '<table border=0 cellpadding="0" cellspacing="0" width="570"><tr><td height="25" width="100%"><div class="module_head"><table border=0 cellspacing=0 cellpadding=0 width="100%"><tr><td width="77" height="25" class="module_head"><div class="module_head">#email_hdr_left#</div></td><td width="493" class="module_head" ><div class="module_head">&nbsp;&nbsp;Je hebt commentaar gekregen van een gebruiker! </div></td></tr></table></div></td></tr>
<tr><td width="100%" class="evenrow" colspan="2"><div class="evenrow" ><table border="0" cellspacing="0" cellpadding="5"><tr><td height="2"></td></tr><tr><td width="100%" valign="top" class="evenrow">Beste #FirstName#,<br><br>Je hebt commentaar gekregen van SITENAME gebruiker <b>#SenderName#</b>.<br><br>Bezoek <a href=\\"#link#\\"><b>SITENAME</b></a> om het commentaar van <b>#SenderName#</b> te bekijken.<br>
<br>Succes!<br>#AdminName# <br>SITENAME<br></td></tr></table></div></td></tr><tr><td height="6" colspan="2" class="evenrow"></td></tr></table> ',
'text' => 'Beste #FirstName#,

Je hebt commentaar gekregen van SITENAME gebruiker \'<b>#SenderName#</b>\'.

Bezoek <a href="#link#"><b>SITENAME</b></a> in het commentaar van \'<b>#SenderName#</b>\' te bekijken.

Succes!
#AdminName#
SITENAME',
        );
$lang['comment_received_sub'] = 'SITENAME Bericht: Een gebruiker heeft commentaar in je blog gezet';
$lang['compose'] = 'Opstellen';
$lang['configurations'] = 'Configuraties';
$lang['confirm'] = 'Bevestigen';
$lang['confirmation'] = 'Bevestiging';
$lang['confirm_letter_sent'] = 'Er is een bevestiging mail gestuurd naar het bij de registratie opgegeven e-mailadres. Lees deze e-mail om de registratie te voltooien.';
$lang['confirm_password'] = 'Wachtwoord Bevestigen:';
$lang['confirm_success'] = 'Log hieronder in om van de voordelen van lidmaatschap gebruik te maken.';
$lang['confirm_your_profile'] = 'Bevestig Je Registratie';
$lang['conf_pend'] = 'Conf Pend';
$lang['contenthdr'] = 'Inhoud';
$lang['continue'] = 'Uitgebreid zoeken';
$lang['Controle_type'] = 'Controle Weergave:';
$lang['counties_count'] = 'Aantal Regio\'s';
$lang['counties_loaded'] = 'Codes van de Provincie/District worden geladen van ';
$lang['counties_sql_created'] = 'Regiocodes SQL bestand gemaakt ';
$lang['countries01'] = 'Landen';
$lang['countries_count'] = 'Aantal Landen';
$lang['country'] = 'Land';
$lang['country_code'] = 'Landcode';
$lang['country_colon'] = 'Land:';
$lang['country_name'] = 'Land naam';
$lang['countyfile'] = 'Regiocodes bestand';
$lang['county_code'] = 'Regiocode';
$lang['county_ensure'] = 'Gelieve eerst regiocodes bestand te verplaatsen naar /provincies. <br /><br />Het bestand moet COUNTYCODE, COUNTYNAME en STATECODE bevatten, gescheiden door Komma.(zelfde volgorde, geen header)<br /><br /> Om regiocodes voor een land te verwijderen, selecteer het land en klik op "Verwijder Regiocodes"';
$lang['county_name'] = 'Regio naam';
$lang['couple_usernames'] = 'Koppel / Groep Member(s) namen';
$lang['couple_usernames_hlp'] = 'Een koppel of groep bestaat uit twee of meer individuen. Voer hieronder de Member namen van Member(s) van dit koppel/deze groep in. Bijvoorbeeld: user_1,user_2,user_3. Deze Member(s) moeten al individuele profielen hebben.';
$lang['createsql'] = 'Maak SQL Script';
$lang['criteria'] = 'Criteria';
$lang['currency'] = 'Valuta: ';
$lang['current_location'] = 'Uw huidige plaats';
$lang['current_mship_level'] = 'Huidig Lidmaatschap niveau:';
$lang['custom_message'] = 'Aangepast Bericht';
$lang['cvv_help'] = '(achterop de creditcard te vinden)';
$lang['daily_events_list'] = 'Lijst gebeurtenissen op ';
$lang['dat'] = 'Datum:';
$lang['datetime_day'] = array(
'friday' => 'Vrijdag',
'monday' => 'Maandag',
'saturday' => 'Zaterdag',
'sunday' => 'Zondag',
'thursday' => 'Donderdag',
'tuesday' => 'Dinsdag',
'wednesday' => 'Woensdag',
        );
$lang['datetime_dayval'] = array(
'Fri' => 'Vr',
'Mon' => 'Ma',
'Sat' => 'Za',
'Sun' => 'Zo',
'Thu' => 'Do',
'Tue' => 'Di',
'Wed' => 'Wo',
        );
$lang['datetime_month'] = array(
'1' => 'Januari',
'10' => 'Oktober',
'11' => 'November',
'12' => 'December',
'2' => 'Februari',
'3' => 'Maart',
'4' => 'April',
'5' => 'Mei',
'6' => 'Juni',
'7' => 'Juli',
'8' => 'Augustus',
'9' => 'September',
        );

$lang['date_from'] = 'Datum Van:';
$lang['DATE_FORMAT'] = '%b %d, %Y';
$lang['DATE_TIME_FORMAT'] = '%b %d, %Y %I:%M:%S %P'; 
$lang['DISPLAY_DATE_FORMAT'] = 'M d, Y';
$lang['DISPLAY_DATETIME_FORMAT'] = 'D M-d-Y H:i:s';
$lang['date_to'] = 'Datum Naar:';
$lang['date_upto'] = 'Datum Tot';
$lang['day_names'] = array(
'Fri' => 'Vrijdag',
'Mon' => 'Maandag',
'Sat' => 'Zaterdag',
'Sun' => 'Zondag',
'Thu' => 'Donderdag',
'Tue' => 'Dinsdag',
'Wed' => 'Woensdag',
        );
$lang['DB_ERROR'] = 'Je aanvraag kon niet verwerkt worden vanwege een probleem met de database.<br />Probeer het opnieuw.';
$lang['db_host'] = 'DB Host:';
$lang['db_name'] = 'DB Naam:';
$lang['db_pass'] = 'DB Wachtwoord:';
$lang['db_prefix'] = 'Tabel prefix:';
$lang['db_user'] = 'DB Gebruiker:';
$lang['deactivate'] = 'Deactiveren';
$lang['default_profile_pic'] = 'Gebruik dit als standaard profiel foto';
$lang['default_tz'] = '0.00';
$lang['delcities_msg'] = 'Alle Woonplaats codes voor dit land worden verwijderd';
$lang['delcities_succ'] = 'Woonplaats codes voor #COUNTRY# zijn verwijderd';
$lang['delcounties_msg'] = 'Alle provincie/district codes voor dit land zullen worden Verwijderd';
$lang['delcounties_succ'] = 'Regiocodes voor #COUNTRY# zijn verwijderd';
$lang['delete'] = 'Verwijderen';
$lang['delete_calendar'] = 'Kalander Verwijderen';
$lang['delete_calendars'] = 'Kalanders Verwijderen';
$lang['delete_calendar_group_confirm_msg'] = 'Weet je zeker dat je deze Kalanders wil verwijderen? Deze actie kan niet ongedaan worden gemaakt.';
$lang['delete_cities'] = 'Verwijder Woonplaats codes';
$lang['delete_comment_confirm_msg'] = 'Weet je zeker dat je dit commentaar wil verwijderen? Dit kan niet ongedaan worden gemaakt.';
$lang['delete_confirm_msg'] = 'Weet je zeker dat je dit onderdeel wil verwijderen?';
$lang['delete_counties'] = 'Verwijder Regiocodes';
$lang['delete_group_confirm_msg'] = 'Weet je zeker dat je deze onderdelen wil verwijderen? Dit kan niet ongedaan gemaakt worden.';
$lang['delete_group_questions_confirm_msg'] = 'Weet je zeker dat je deze vragen wil verwijderen? Dit kan niet ongedaan gemaakt worden.';
$lang['delete_image'] = 'Plaatje Verwijderen';

$lang['delete_profile'] = 'Verwijder Profiel';
$lang['delete_question'] = 'Vraag Verwijderen';
$lang['delete_questions'] = 'Verwijder vragen';
$lang['delete_ratings'] = 'Verwijder Beoordelingen';
$lang['delete_rating_confirm_msg'] = 'Weet je zeker dat je deze beoordeling wil verwijderen? Dit kan niet ongedaan worden gemaakt.';
$lang['delete_rating_group_confirm_msg'] = 'Weet je zeker dat je deze beoordelingen wil verwijderen? Dit kan niet ongedaan worden gemaakt.';
$lang['delete_search'] = 'Verwijder deze Zoektocht';
$lang['delete_section'] = 'Onderdeel verwijderen';
$lang['delete_sections'] = 'Onderdelen verwijderen';
$lang['delete_selected'] = 'Verwijderen';
$lang['delete_states'] = 'Verwijder Provincie-/Staat codes';
$lang['delete_template_confirm_msg'] = 'Weet je zeker dat je dit voorbeeld wil verwijderen? Dit kan niet ongedaan worden gemaakt.';
$lang['delete_zips'] = 'Verwijder postcodes';
$lang['delstates_msg'] = 'Alle provincie/Staat codes voor dit land worden verwijderd';
$lang['delstates_succ'] = 'Provincie-/Staat codes voor #COUNTRY# zijn verwijderd';
$lang['delzips_msg'] = 'Alle postcodes voor dit land worden verwijderd';
$lang['delzips_succ'] = 'Postcodes voor #COUNTRY# zijn verwijderd';
$lang['descrip'] = 'Omschrijving';
$lang['description'] = 'Omschrijving:';
$lang['ENCODING'] = 'iso-8859-15';
$lang['LEFT'] = 'left';
$lang['RIGHT'] = 'right';
$lang['DIRECTION'] = 'ltr';
$lang['disable_selected'] = 'Uitschakelen';
$lang['display_Controle_type'] = array(
'checkbox' => 'Selectie vakje gebruiker naam bereikt',
'radio' => 'Optie knop',
'select' => 'Item lijst',
'textarea' => 'Tekstvak',
        );

$lang['dont_stay_alone'] = 'Blijf niet Alleen,';
$lang['down'] = 'Naar Beneden';
$lang['edit'] = 'Bewerken';
$lang['edit_banners'] = 'Banner Wijzigen';
$lang['edit_payment_modules'] = 'Wijzig Betaling module';
$lang['edit_pict'] = 'Wijzig Hoofd foto';
$lang['edit_profile'] = 'Mijn Profiel Aanpassen';
$lang['edit_template'] = 'Voorbeeld Bewerken';
$lang['edit_thmpnail'] = 'Wijzig Thumbnail';
$lang['email'] = 'E-mail:';
$lang['email_feedback_subject'] = 'SITENAME Bericht: Feedback van gebruiker ';
$lang['email_subject'] = 'Onderwerp:';
$lang['email_supreq_subject'] = 'SITENAME Bericht: Verzoek ondersteuning van gebruiker ';
$lang['empty'] = 'Leeg';
$lang['enabled'] = 'Ingeschakeld:';
$lang['enabled_values'] = array(
'N' => 'Nee',
'Y' => 'Ja',
        );
$lang['enable_selected'] = 'Inschakelen';
$lang['ENCODING'] = 'iso-8859-1';
$lang['enddate'] = 'Einddatum:';
$lang['end_date'] = 'Eind Datum';
$lang['end_time'] = 'Eind Tijd';
$lang['enter_city'] = 'Woonplaats:';
$lang['enter_confirm_code'] = 'Voer de bevestiging code hieronder in om de registratie te voltooien.';
$lang['enter_promo'] = 'Voer uw promotie code in';
$lang['enter_spamcode'] = 'Veiligheid code';
$lang['enter_username'] = 'Member naam:';
$lang['enter_zip'] = 'Postcode:';
$lang['entrycode_chars'] = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
$lang['errormsgs'] = array(
'0' => 'Adres regel 1 is een vereist veld.',
'1' => 'Member naam is een vereist veld.',
'10' => 'Maximum lengte van Member naam is 25 tekens.',
'100' => 'Regio is een vereist veld',
'101' => 'Ongeldig Wachtwoord',
'102' => 'De gebeurtenis is goedgekeurd.',
'103' => 'De gebeurtenis is afgekeurd.',
'104' => 'De opgegeven login kon niet worden gevonden. Controleer je invoer en probeer het opnieuw, of gebruik de optie hieronder voor een herinnering.',
'105' => 'Gebruiker staat in Geblokkeerden lijst',
'106' => 'Ongeldige karakters op het gebied van de gebruiker benaming',
'11' => 'Maximum lengte van voornaam is 50 tekens.',
'111' => 'Dit lid is reeds in de Perfecte Member(s)lijst',
'12' => 'Maximum lengte van achternaam is 50 tekens.',
'120' => 'Veiligheid code moet worden ingevoerd',
'121' => 'Ongeldige Veiligheid code ',
'122' => 'Je hebt vandaag het maximum aantal toegestane berichten verstuurd. Probeer het morgen nog eens.',
'123' => 'Je hebt vandaag het maximum aantal toegestane knipogen verstuurd. Probeer het morgen nog eens.',
'124' => 'Het video bestand is geladen',
'125' => 'Het video bestand kon niet worden Opgeladen vanwege een verkeerd bestandsformaat.',
'126' => 'Je moet de informatie over jezelf invullen.',
'128' => 'Member namen van Member(s) die koppels vormen moeten worden opgegeven.',
'129' => 'Member namen moeten al beschikbaar zijn.',
'13' => 'Maximum lengte van e-mailadres is 255 tekens.',
'130' => 'video bestand kan niet worden geconverteerd. Gelieve video\'s in .flv formaat te gebruiken.',
'131' => 'Je hebt het maximum aantal berichten voor je lidmaatschap niveau overschreden',
'132' => 'De selecteerde video wordt goedgekeurd',
'133' => 'selecteerde video is verworpen',
'14' => 'Maximum lengte van woonplaats is 100 tekens.',
'141' => 'Geen dergelijke beschikbare promotie code',
'142' => 'Het standaard profiel foto is veranderd',
'143' => 'Foto van het profiel moet worden geladen.',
'144' => 'Commentaar van foto is Gewijzigdd',
'145' => 'selecteerde commentaren worden verwijderd',
'146' => 'selecteerde commentaar is verwijderd',
'147' => 'Video commentaar is Gewijzigdd',
'15' => 'Maximum lengte van adres regel 1 is 255 tekens.',
'16' => 'Member naam moet beginnen met een letter.',
'161' => 'Uw lidmaatschap wordt geannuleerd. Neem contact op met de Bebeheerder van de site om uw lidmaatschap te reactiveren.',
'17' => 'Wachtwoord moet beginnen met een letter.',
'171' => 'Uw lidmaatschap is nog niet goedgekeurd door de Bebeheerder van het Systeem. Gelieve te wachten op goedkeuring alvorens deze lidmaatschap te gebruiken.',
'18' => 'Wachtwoord en Bevestig Wachtwoord moeten overeenkomen.',
'19' => 'Voer a.u.b. een geldig e-mailadres in.',
'2' => 'Wachtwoord is een vereist veld.',
'20' => 'Vereist informatie moet ingevoerd worden.',
'200' => 'Uw profiel is bevestigd.',
'201' => 'Het limit op het aantal profielen in de Bekeken Profielen lijst is bereikt',
'202' => 'Dit profiel is toegevoegd aan je Bekeken Profielen lijst',
'203' => 'Dit profiel staat al in je Bekeken Profielen lijst',
'204' => 'Uw profiel wijzigingenDe account is opnieuw geactiveerd is voltooid.',
'21' => 'De ingevoerde login gegevens staan geen toegang toe. Controleer deze informatie en probeer het opnieuw.',
'22' => 'Member naam bestaat al, gelieve een andere te kiezen.',
'23' => 'Het ingevoerde oude wachtwoord is incorrect. Controleer je oude wachtwoord en probeer het opnieuw.',
'25' => 'E-mail is al geregistreerd.',
'26' => 'Je profiel is nog niet geactiveerd. <a href=\'completereg.php\'>Activeer je account</a> door de bevestiging code op te geven of de link te gebruiken die in de naar het geregistreerde e-mail adres is verstuurd.',
'27' => 'Kon bericht niet vinden.',
'28' => 'Gelieve eerst een bestand te selecteren.',
'29' => 'Bestandsformaat wordt niet ondersteund, gelieve een ander te kiezen.',
'3' => 'Bevestig Wachtwoord is een vereist veld.',
'30' => 'Vraag staat al bovenaan.',
'301' => 'Ongeldige Tijdzone',
'302' => 'Het album is geupdate',
'303' => 'Ongeldige Tijdzone',
'31' => 'Vraag staat al onderaan.',
'32' => 'Bedankt voor je commentaar. Je feedback wordt zo gauw mogelijk verwerkt.',
'33' => 'De postcode komt niet overeen met de opgegeven provincie/staat.',
'34' => 'Postcode is ongeldig',
'35' => 'Je profiel is nog niet goedgekeurd.<br /> Gelieve te wachten op goedkeuring, of contact op te nemen met een bebeheerder',
'36' => 'Je account is geschorst. Gelieve contact op te nemen met een bebeheerder voor verdere details.',
'37' => 'Je inzending is geweigerd. Gelieve contact op te nemen met een bebeheerder voor verdere details.',
'38' => 'Je hebt een ongeldige geboortedatum opgegeven. Controleer deze en probeer het opnieuw.',
'39' => 'Oud en nieuw wachtwoord mogen niet hetzelfde zijn.',
'4' => 'Voornaam is een vereist veld.',
'40' => 'Vanaf leeftijd moet hoger of gelijk zijn aan Tot leeftijd.',
'5' => 'Achternaam is een vereist veld.',
'51' => 'Begindatum moet voor einddatum staan.',
'52' => 'Dit lid staat al op de lijst.',
'53' => 'Ongeldige datum.',
'54' => 'Ongeldige Member naam of wachtwoord.',
'55' => 'Je moet ingelogd zijn om een bericht te versturen.',
'56' => 'Foto grootte is meer dan de toegestane grote van 8000000 KB.',
'57' => 'Alleen JPG, GIF en PNG bestanden zijn toegestaan.',
'58' => 'Foto kon niet worden Opgeladen.',
'59' => 'Dit profiel is toegevoegd aan de lijst.',
'6' => 'E-mailadres is een vereist veld.',
'60' => 'Voorbeeld dimensies overschrijden de maximum grootte (100 X 100)',
'61' => 'Ongeldige activatiecode',
'62' => 'De Member naam is van de lijst verwijderd',
'63' => 'Deze Member is aan je Vrienden lijst toegevoegd',
'64' => 'Deze Member is aan je Geblokkeerden lijst toegevoegd',
'65' => 'Deze Member is aan je Hot List toegevoegd',
'66' => 'Je knipoog is naar deze gebruiker verstuurd',
'67' => 'Foto\'s zijn Opgeladen.',
'68' => 'De foto is goedgekeurd',
'69' => 'De foto is afgekeurd',
'7' => 'Woonplaats is een vereist veld.',
'70' => 'Het aantal bezoeken is verwijderd',
'71' => 'Het aantal knipogen is verwijderd',
'72' => 'De account is opnieuw geactiveerd',
'73' => 'Het land is toegevoegd',
'74' => 'Het land is verwijderd',
'75' => 'De landcode of -naam is al in gebruik',
'76' => 'Het land is Gewijzigdd',
'77' => 'De provincie/staat is toegevoegd',
'78' => 'De provincie/staat is verwijderd',
'79' => 'Provincie-/Staat code of naam is al in gebruik',
'80' => 'De provincie/staat is Gewijzigdd',
'81' => 'Provincie-/staat naam moet opgegeven worden',
'82' => 'Dit lid heeft geen foto\'s Opgeladen. ',
'83' => 'Het profiel is verwijderd',
'84' => 'De selecteerde profielen zijn verwijderd.',
'85' => 'selecteerd(e) profiel(en) geactiveerd.',
'86' => 'selecteerd(e) profiel(en) geweigerd.',
'87' => 'selecteerd(e) profiel(en) geschorst.',
'88' => 'De regio is toegevoegd',
'89' => 'De regio is verwijderd',
'90' => 'De regiocode of -naam is al in gebruik',
'91' => 'De regio is Gewijzigdd',
'92' => 'De woonplaats is toegevoegd',
'93' => 'De woonplaats is verwijderd',
'94' => 'WoonPlaat code of -naam is al in gebruik',
'95' => 'De woonplaats is Gewijzigdd',
'96' => 'De postcode is toegevoegd',
'97' => 'De postcode is verwijderd',
'98' => 'Postcode is al in gebruik',
'99' => 'De postcode is Gewijzigdd',
        );
$lang['error_msg_color'] = 'Red';
$lang['event'] = 'Gebeurtenis:';
$lang['events'] = 'Gebeurtenissen';
$lang['events_for_today'] = 'Gebeurtenissen voor Vandaag';
$lang['events_require_approval'] = 'Evenementen Goedkeuren';
$lang['events_title'] = 'Evenementen menu';
$lang['event_description'] = 'Omschrijving Gebeurtenis';
$lang['event_notification'] = 'Gebeurtenis melding';
$lang['event_title'] = 'Gebeurtenis';
$lang['excellent'] = 'Uitmuntend';
$lang['expird'] = 'Verlopen';
$lang['expired'] = 'Je lidmaatschap is afgelopen. <a href="payment.php" class="errors">Vernieuw je lidmaatschap</a> om gebruik te kunnen blijven maken van SITENAME';
$lang['expire_in'] = 'Dagen tot aflopen lidmaatschap';
$lang['expire_on'] = 'Lidmaatschap loopt af op';
$lang['expire_on_hdr'] = 'Verloopt op';
$lang['expiry_hdr'] = 'Herinneringsbrief Afloop Lidmaatschap';
$lang['expiry_interval'] = array(
'0' => 'Afgelopen',
'1' => '24 Uur',
'15' => '15 Dagen',
'3' => '3 Dagen',
'30' => '30 Dagen',
'7' => '7 Dagen',
        );
$lang['expiry_ltr'] = 'Afloop mail Lidmaatschap';
$lang['expiry_ltr_sent'] = 'Herinneringsbrief Afloop Lidmaatschap verzonden';
$lang['expiry_ltr_sub'] = 'SITENAME Bericht: Herinnering afloop lidmaatschap';
$lang['expiry_select'] = 'Selecteer Afloop periode';
$lang['extended_search'] = 'Uitgebreid Zoeken';
$lang['extsearchhead'] = array(
'Best feature' => 'Beste eigenschap',
'Body art' => 'Lichaam versieringen',
'Body Type' => 'Lichaamsbouw',
'Common interests' => 'Belangrijkste interesses',
'Current annual income' => 'Huidig jaarlijks inkomen',
'Daily diet' => 'Dagelijks dieet',
'Drinking' => 'Drinken',
'Education' => 'Opleiding',
'Employment status' => 'Werk status',
'Ethnicity' => 'Etnische achtergrond',
'Exercise' => 'Lichaamsoefeningen',
'Eye color' => 'Kleur ogen',
'Favorite things' => 'Favoriete dingen',
'Hair color' => 'Kleur haar',
'Height' => 'Lengte',
'Hobbies' => 'Hobby\'s',
'Hot spots' => 'Hot spots',
'Job schedule' => 'Werktijden',
'Kids' => 'Kinderen',
'Languages' => 'Talen',
'Last reading' => 'Laatst gelezen',
'Living situation' => 'Leefsituatie',
'Marital Status' => 'Huwelijks staat',
'Referred by' => 'Verwezen door',
'Religion' => 'Religie',
'Sense of humor' => 'Gevoel voor humor',
'Smoking' => 'Roken',
'Sports' => 'Sporten',
'Want children' => 'Wil kinderen',
'Weight' => 'Gewicht',
'Zodiac Sign' => 'Sterrenbeeld',
        );
$lang['featuredprofiles'] = 'Perfecte Profielen';
$lang['featured_member(s)'] = 'Perfecte Member(s)';
$lang['featured_profiles'] = 'Perfecte Profielen';
$lang['featured_profiles_hdr'] = 'Profielen van Perfecte Member(s)';
$lang['featured_profiles_msg01'] = 'Moet Weergeven: \'Ja\' zorgt ervoor dat indien mogelijk, dit profiel wordt selecteerd voor weergave in de Perfecte Profielen lijst. \'Nee\' vermindert de kans om selecteerd te worden. ';
$lang['featured_profiles_msg02'] = 'Benodigde Weergaven: Dit is het aantal vereiste blootstelling dat vereist is voor dit profiel uit de Perfecte Profielen lijst gehaald wordt, als het aantal is bereikt voor de einddatum.';
$lang['featured_profile_added'] = array(
'html' => '<table border=0 cellpadding="0" cellspacing="0" width="570"><tr><td height="25" width="100%"><div class="module_head"><table border=0 cellspacing=0 cellpadding=0 width="100%"><tr>
<td width="77" height="25" ><div class="module_head">#email_hdr_left#</div>
</td><td width="493" ><div class="module_head">&nbsp;&nbsp;Je profiel wordt binnenkort Perfecte </div></td></tr></table></div></td></tr><tr><td width="100%" class="evenrow" colspan="2" >
<div class="evenrow"><table border="0" cellspacing="0" cellpadding="5"><tr><td width="100%" valign="top" class="evenrow">Beste #FirstName#,<br><br>
We zijn blij je mee te mogen delen dat je profiel in de Perfecte Profielen lijst wordt opgenomen <a href=\\"#link#\\">SITENAME</a>.<br><br>Je profiel blijft Perfecte van <b>#FromDate#</b> tot <b>#UptoDate#</b>.<br>
<br>Dit zal ervoor zorgen dat de zichtbaarheid van je profiel wordt verbeterd, en vaker wordt bekeken door potenti&euml;le matches.<br><br>Good Luck!<br>#AdminName# <br>SITENAME<br></td></tr></table></div></td></tr><tr><td height="6" colspan="2" class="evenrow"></td></tr></table> ',
'text' => 'Beste #FirstName#,

We zijn erg blij met het opnemen van je profiel in de Perfecte Profielen Lijst op <a href="#link#">#siteName#</a>.

Je profiel blijft Perfecte van #FromDate# tot #UptoDate#.

Dit zal de zichtbaarheid van je profiel verbeteren en zou kunnen resulteren in meer bezoeken van toekomstige matches.

Succes!
#AdminName#
SITENAME',
        );
$lang['feat_prof_deleted'] = 'selecteerde profiel is van de Perfecte profielen lijst verwijderd.';
$lang['feat_prof_del_msg'] = 'Weet je zeker dat je dit profiel van de Perfecte profielen lijst wil verwijderen?';
$lang['feedback'] = 'Feedback';
$lang['feedback_email_to_admin'] = array(
'html' => '<table border=0 cellpadding="0" cellspacing="0" width="570"><tr><td height="25" width="100%"><div class="module_head"><table border=0 cellspacing=0 cellpadding=0 width="100%"><tr><td width="77" height="25"><div class="module_head">
#email_hdr_left#</div></td><td width="493"><div class="module_head">&nbsp;&nbsp;Feedback van gebruiker <div></td></tr></table></div></td></tr><tr><td width="100%" class="evenrow" colspan="2" ><div class="evenrow" >
<table border="0" cellspacing="0" cellpadding="5"><tr><td height="2"></td></tr>
<tr><td width="100%" valign="top" class="evenrow">Beste site beheerder,<br><br>Je hebt net feedback ontvangen van een bezoeker van je website. De details zijn als volgt:<br><br><table cellspacing="4" cellpadding="2" border="0" width="100%"><tr><td width="20%"> Titel:</td><td width="80%">#txttitle# </td></tr><tr><td>Naam:</td> <td>#txtname#</td></tr>
<tr><td>E-mail:</td><td>#txtemail#</td></tr><tr><td>Land:</td><td>#txtcountry#</td></tr><tr><td>Opmerkingen:</td><td>#txtcomments#</td></tr></table><br>Bedankt,<br>#siteName# Daemon<br><br></td></tr></table></div></td></tr></table> ',
'text' => 'Beste site beheerder,

Je hebt net feedback ontvangen van een bezoeker van je website. De details zijn als volgt:

Titel: #txttitle#
Naam: #txtname#
E-mail: #txtemail#
Land: #txtcountry#
Opmerkingen: #txtcomments#

Bedankt,
#siteName# Daemon',
        );
$lang['feedback_thanks'] = 'Bedankt voor je feedback. Je bericht is verstuurd naar een bebeheerder.';
$lang['Female'] = 'Vrouw';
$lang['file_not_found'] = 'Opgegeven bestand is niet gevonden in het systeem';
$lang['filter_options'] = array(
'city' => 'Woonplaats',
'email' => 'E-mail',
'gender' => 'Geslacht',
'id' => 'Id',
'status' => 'Status',
'username' => 'Member naam',
'zip' => 'Postcode',
        );
$lang['filter_records'] = 'Filter Items';
$lang['finance_calc'] = 'Financieel calculator';
$lang['financial'] = 'Financieel';
$lang['find'] = 'Zoeken';
$lang['find_your_match'] = 'Vind je Match';
$lang['first'] = 'Eerste';
$lang['flag'] = 'Markeren';
$lang['flagged'] = 'Gemarkeerd';
$lang['flash_chat_admin_msg'] = 'FlashChat 4.1.0 en hoger bevatten een integratie klasse voor osDate. Schaf deze a.u.b. aan op <a href="www.wi-t.nl" target="_blank">www.wi-t.nl</a> en kopieer de bestanden naar deze map. Voer daarna het FlashChat installatiebestand uit, en geef osDate aan als CMS on in te integreren.';
$lang['flash_chat_msg'] = 'FlashChat 4.1.0 en hoger bevatten een integratie klasse voor osDate. Schaf deze a.u.b. aan op <a href="www.wi-t.nl" target="_blank">www.wi-t.nl</a> en kopieer de bestanden naar deze map. 	Voer daarna het FlashChat installatiebestand uit, en geef osDate aan als CMS om in te integreren.';
$lang['for'] = 'Voor';
$lang['forgot'] = 'Login vergeten?';
$lang['forgotpass'] = 'Wachtwoord Vergeten';
$lang['forgotpass_msg1'] = 'Login Onthouden';
$lang['forgotpass_msg2'] = 'Geef a.u.b. het e-mailadres op dat is gebruikt voor het aanmaken van je profiel om je Member naam en een nieuw wachtwoord toegestuurd te krijgen. Om veiligheidsredenen, gelieve het wachtwoord gelijk na ontvangst te wijzigen.';
$lang['forgotpass_msg4'] = 'Ben je je login vergeten? Je Member naam, met een nieuw wachtwoord, kunnen verzonden worden naar je e-mailadres. Gebruik hiervoor het voor registratie gebruikte e-mailadres.';
$lang['forgot_password'] = array(
'html' => '<table border=0 cellpadding="0" cellspacing="0" width="570"><tr><td height="25" width="100%"><div class="module_head"><table border=0 cellspacing=0 cellpadding=0 width="100%"><tr><td width="77" height="25" class="module_head"><div class="module_head">#email_hdr_left#</div></td>
<td width="493" class="module_head" ><div class="module_head">&nbsp;&nbsp;Je wachtwoord herstel aanvraag</div></td></tr></table></div></td></tr><tr><td width="100%" class="evenrow" colspan="2" ><div class="evenrow" ><table border="0" cellspacing="0" cellpadding="5"><tr><td height="2"></td></tr><tr><td width="100%" valign="top" class="evenrow">Beste #Name#,<br>
<br>Dit bericht is een antwoord op je verzoek om je wachtwoord opnieuw in te stellen.<br><br>Je Member(s)-ID: <b>#ID#</b><br>Je nieuwe wachtwoord: <b>#Password#</b><br><br>Om in te loggen, ga naar: <a href=\\"#LoginLink#\\">SITENAME</a>.<br><br>Bedankt voor het gebruiken van onze diensten!<br><br>#AdminName#<br>SITENAME<br></td></tr> </table></div></td></tr><tr><td height="6" colspan="2" class="evenrow"></td></tr></table> ',
'text' => 'Beste #Name#,

Dit bericht is een antwoord op je verzoek om je wachtwoord opnieuw in te stellen.

Je Member(s)-ID: #ID#
Je nieuwe wachtwoord:  #Password#

Om in te loggen, ga naar: #LoginLink#.

Bedankt voor het gebruiken van onze diensten!

#AdminName#
SITENAME',
        );
$lang['forgot_password_sub'] = 'SITENAME Bericht: Je wachtwoord herstel aanvraag';
$lang['forum'] = 'Forum';
$lang['forum_values'] = array(
'myBB' => 'myBB',
'myBB14' => 'myBB 1.4',
'None' => 'Geen',
'Phorum' => 'Phorum',
'phpBB' => 'phpBB',
'phpBB3' => 'phpBB3',
'smf11' => 'SMF 1.1',
'vBulletin' => 'vBulletin',
        );
$lang['from'] = ' van ';
$lang['FROM1'] = 'Van';
$lang['from_email'] = 'Van E-mail:';
$lang['from_name'] = 'Van Naam:';
$lang['ftp_hostname'] = 'FTP Hostnaam:';
$lang['ftp_password'] = 'FTP Wachtwoord:';
$lang['ftp_path'] = 'FTP aeDating Pad:';
$lang['ftp_path_help'] = 'Pad naar de aeDating directory wanneer via FTP ingelogd.  Bijv. public_html/aeDating';
$lang['ftp_username'] = 'FTP Member naam:';
$lang['fullname'] = 'Volledige Naam';
$lang['fullname_hdr'] = 'Volledige Naam';
$lang['full_chars'] = '0123456789.+-_#,/ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz() _$+=;:?\'';
$lang['gbl_settings'] = 'Globale Site Instellingen';
$lang['general'] = 'Algemeen';
$lang['generate_prof_quest_file'] = 'Bestand Profiel aanmaken';
$lang['generate_tnpic'] = 'Produceer thumbnail wanneer het Belangrijkste foto wordt veranderd.';

$lang['glblgroups'] = 'Globale Instellingen Groep';
$lang['profile_ratings'] = 'Profiel Waardering';
$lang['glblsettings_groups'] = array(
'1' => 'Site Informatie',
'2' => 'Gebruikers menu',
'3' => 'Kalander menu',
'4' => 'Mail Instellingen',
'5' => 'Profiel Afbeeldingen en Thumbnails',
'50' => 'Profiel waardering',
'6' => 'Pagina- en Tabellayout',
        );
$lang['globalconfigurations'] = 'Globale Configuraties';
$lang['guideline'] = 'Richtlijn:';
$lang['happy_birthday_msg'] = 'Gelukkige Verjaardag aan u!!';
$lang['have_promo'] = 'Hebt u een promotie code?';
$lang['head_extsearch'] = 'Uitgebreid Zoeken Header:';
$lang['hide'] = 'Verbergen';
$lang['homepage'] = 'Startpagina';
$lang['home_title'] = 'SITENAME Home';
$lang['hotlisthdr'] = 'Hot List';
$lang['hotprofiles'] = 'Hot Profielen';
$lang['id'] = 'ID:';
$lang['image_browser'] = 'Foto browser';
$lang['import'] = 'Importeren';
$lang['imported'] = 'Ge&iuml;mporteerd';
$lang['import_config'] = 'Config';
$lang['import_db_configuration'] = 'Bron database configureren';
$lang['im_from'] = 'Van:';
$lang['im_message'] = 'Bericht:';
$lang['im_msg_long'] = 'IM bericht is meer dan toegestane grootte ';
$lang['im_reply'] = 'Beantwoorden';
$lang['inactive'] = 'Inactief';
$lang['inbox'] = 'Inbox';
$lang['include_extsearch'] = 'Opnemen in Uitgebreid Zoeken:';
$lang['include_profile'] = 'Voeg mijn profiel bij dit bericht.';
$lang['info_confirm'] = 'Is de volgende informatie correct?';
$lang['insert_article'] = 'Artikel Toevoegen';
$lang['insert_city'] = 'Nieuwe Plaats Toevoegen';
$lang['insert_country'] = 'Nieuw Land Toevoegen';
$lang['insert_county'] = 'Nieuw Regio Toevoegen';
$lang['insert_event'] = 'Gebeurtenis Toevoegen';
$lang['insert_msg'] = 'Nieuwe toevoegen ';
$lang['insert_news'] = 'Nieuws Toevoegen';
$lang['insert_promo'] = 'Voeg promotie toe';
$lang['insert_question'] = 'Nieuwe Vraag Toevoegen';
$lang['insert_section'] = 'Nieuw onderdeel toevoegen';
$lang['insert_state'] = 'Nieuwe Provincie/Staat Toevoegen';
$lang['insert_story'] = 'Verhaal Toevoegen';
$lang['insert_zip'] = 'Nieuwe Postcode Toevoegen';
$lang['install'] = 'Installeren';
$lang['instant_message'] = 'Berichten optie';
$lang['instant_messenger'] = 'Direct berichten';
$lang['insufficientPrivileges'] = 'Je hebt niet de benodigde rechten voor deze optie. Gelieve je lidmaatschap te upgraden.';
$lang['invalid_username'] = 'Ongeldige Member naam';
$lang['invite_a_friend'] = array(
'html' => '<table border=0 cellpadding="0" cellspacing="0" width="570"><tr><td height="27" class="module_head" width="100%"><div class="module_head"><table border=0 cellspacing=0 cellpadding=0 width="100%"><tr><td width="77" valign="top" ><div class="module_head" >#email_hdr_left#</div>
</td>
<td width="493" ><div class="module_head" >&nbsp;&nbsp;Uitnodiging van #FromName#!</div></td></tr></table></div></td></tr><tr><td width="100%" colspan="2" ><div class="evenrow"><table border="0" cellspacing="0" cellpadding="5" width="100%"><tr><td height="1"></td></tr><tr><td width="100%" valign="top" class="evenrow">Hoi,<br><br>Ik heb een coole dating site gevonden tijdens het surfen op het web: <a href=\\"#SiteUrl#\\"><b>SITENAME</b></a><br>Ik dacht dat je wel geinteresseerd zou zijn.<br>
<br>Bezoek <a href=\\"#SiteUrl#\\">SITENAME</a>.<br><br>Succes!<br>#FromName# <br><br></td></tr></table></div>
</td></tr><tr><td height="6" class="evenrow" colspan="2" ></td></tr></table>',
'text' => 'Hoi,

Ik heb een coole dating site gevonden tijdens het surfen: #SiteUrl#.

Ik dacht dat je dit wel interessant zou vinden.

Bezoek #SiteUrl#.

#FromName#',
        );
$lang['invite_a_friend_sub'] = 'SITENAME Bericht: Uitnodiging van #FromName#! ';
$lang['in_ban_list'] = 'Member(s) staat in Geblokkeerden lijst';
$lang['in_buddy_list'] = 'Member(s) staat in Vrienden lijst';
$lang['in_hot_list'] = 'Member(s) staat in Hot List';
$lang['in_look_city'] = 'Member(s)s in de door jou gezochte plaats';
$lang['in_look_country'] = 'Member(s)s in het door jou gezochte land';
$lang['in_look_county'] = 'Member(s)s in de door jou gezochte regio';
$lang['in_look_state'] = 'Member(s)s in de door jou gezochte provincie/staat';
$lang['in_look_zip'] = 'Member(s)s met de dor jou gezochte postcode';
$lang['in_same_age'] = 'member(s) in uw leeftijd';
$lang['in_same_gender'] = 'Member(s)s met jouw geslacht';
$lang['in_same_timezone'] = 'Member(s)s in jouw tijdzone';
$lang['in_your_city'] = 'Member(s)s in jouw woonplaats';
$lang['in_your_country'] = 'Member(s)s in jouw land';
$lang['in_your_county'] = 'Member(s)s in jouw land';
$lang['in_your_state'] = 'Member(s)s in jouw provincie/staat';
$lang['in_your_zip'] = 'Member(s)s met jouw postcode';
$lang['i_am_a'] = 'Ik ben een';
$lang['join_now_for_free'] = 'Word Nu Gratis Lid!';
$lang['jump_to'] = 'Ga Naar';
$lang['keywords'] = 'Sleutelwoorden:';
$lang['kms'] = ' kilometers ';
$lang['langdefadd'] = 'Voeg taal definitie toe';
$lang['langdefdeleted'] = 'selecteerde taal definitie wordt verwijderd';
$lang['langfile_generated'] = '#LANGUAGE# Bestand is geproduceerd.';
$lang['langfile_loaded'] = 'Taal definities voor #LANGUAGE# zijn geladen uit ';
$lang['langkeyexist'] = 'De opgeven key en sub key code is al aanwezig.';
$lang['langmodify'] = 'Wijzig taal definitie';
$lang['langnotloaded'] = '#language# taal wordt niet geladen. Laad het taal file online uit te geven.';

$lang['last'] = 'Laatste';
$lang['lastlogged'] = 'Laatst ingelogd: ';
$lang['latitude'] = 'Breedtegraad';
$lang['leave_blank_no_change'] = '(laat leeg voor geen verandering)';
$lang['LEFT'] = 'links';
$lang['letter_errormsgs'] = array(
'0' => 'Je wachtwoord is naar je ge-e-mailed. Controleer a.u.b. je e-mailaccount.',
'1' => 'Gelieve het voor registratie gebruikte e-mailadres in te voeren.',
'2' => 'Wachtwoord Vergeten template niet gevonden. Gelieve contact op te nemen met een bebeheerder.',
'4' => 'Er is een probleem met het verzenden van de e-mail. Gelieve contact op te nemen met een bebeheerder.',
'5' => 'Je bent geen geregistreerd lid van SITENAME. Gelieve het voor registratie gebruikte e-mailadres in te voeren.',
        );
$lang['letter_featuredprofile_sub'] = 'SITENAME Bericht: Je profiel wordt binnenkort Perfecte';
$lang['letter_not_avail'] = 'Voorbeeld brief niet beschikbaar';
$lang['letter_not_sent'] = 'Er was een probleem met het versturen van de e-mail. Neem a.u.b. contact op met een bebeheerder.';
$lang['letter_options'] = 'Brief opties';
$lang['letter_title'] = 'Nieuwe Brief';
$lang['letter_winkreceived_sub'] = 'SITENAME Bericht: #ReceiverName#, #SenderName# heeft naar je geknipoogd! ';
$lang['level_hdr'] = 'Niveau';
$lang['limit'] = 'limiet';
$lang['linkurl'] = 'Link URL:';
$lang['link_target'] = 'Link Target';
$lang['listofviews'] = 'Lijst met Member(s) die je profiel hebben bekeken';
$lang['listofwinks'] = 'Lijst met Member(s) van wie je knipogen hebt ontvangen';
$lang['loadaction'] = 'Selecteer benodigde actie';
$lang['loadedpicscnt'] = '#PICSCNT# foto(\'s)';
$lang['loadedpicscnt1'] = '#PICSCNT# foto';
$lang['loadedvdocnt'] = '#PICSCNT# video(\'s)';
$lang['loadedvdocnt1'] = '#PICSCNT# video';
$lang['loading'] = 'Laden..';
$lang['loadintodb'] = 'Laden in DB';
$lang['load_cities'] = 'Woonplaatsen opladen';
$lang['load_cities_button'] = 'Proces steden file';
$lang['load_counties'] = 'Regio bestanden opladen';
$lang['load_counties_button'] = 'Proces provincies file';
$lang['load_lang'] = 'Talen opladen';
$lang['load_states'] = 'Provincies/Staten opladen';
$lang['load_states_button'] = 'Proces staten file';
$lang['load_zips'] = 'Postcodes opladen';
$lang['load_zips_button'] = 'Opladen postcodes';
$lang['localities'] = 'Plaatsen';
$lang['location_col'] = 'Locatie:';
$lang['location_no_col'] = 'Locatie';
$lang['loginagain'] = 'Gelieve uit en in te loggen om je nieuwe lidmaatschap status te gebruiken';
$lang['logintime'] = 'Login tijd';
$lang['login_now'] = 'Hier Inloggen';
$lang['login_reminded'] = 'Word herinnerd aan je Member naam en wachtwoord.';
$lang['login_settings'] = 'Login Instellingen';
$lang['login_submit'] = 'Inloggen';
$lang['login_title'] = 'Login pagina Member(s)';
$lang['logout_login'] = 'Gelieve uit- en weer in te loggen om je nieuwe wachtwoord te testen..';
$lang['longitude'] = 'Lengtegraad';
$lang['looking_for'] = 'Opzoek naar';
$lang['looking_for_a'] = 'op zoek naar een';
$lang['lookup'] = 'Zoek';
$lang['lost_confemail'] = 'bevestiging mail verloren?';
$lang['mail'] = array(
'hdr_html' => '<table border=0 cellspacing=0 cellpadding=5 width="570"><tr><td ><font style="color:red; font-size: 9px;">Om het ontvangen van dit type e-mails te stoppen, <a href="#SiteUrlLogin#">login</a> en de e-mailinstellingen op het Gebruikers menu te wijzigen.<br>Om deze e-mails zeker te ontvangen, gelieve <a href="mailto:#AdminEmail#">#AdminEmail#</a> toe te voegen aan je e-mail adresboek.</font></td></tr><tr><td height="6"></td></tr></table>',
'hdr_text' => '<font style="color:red; font-size: 9px;">Om het ontvangen van dit type e-mails te stoppen, <a href="#SiteUrlLogin#">login</a> om de instellingen aan te passen op het Gebruikers menu.<br>Om deze e-mails zeker te ontvangen, gelieve <a href="mailto:#AdminEmail#">#AdminEmail#</a> toe te voegen aan je e-mail adresboek.</font><br><br>',
        );
$lang['mails_sent'] = 'E-mail verzonden';
$lang['mail_head_charset'] = 'utf-8';
$lang['mail_html_charset'] = 'utf-8';
$lang['mail_html_encoding'] = '8bit';

$lang['mail_messages'] = 'Berichten';
$lang['mail_sent_for_user'] = 'Mail verzonden voor gebruiker Id ';
$lang['mail_text_charset'] = 'utf-8';
$lang['mail_text_encoding'] = '8bit';
$lang['mainkey'] = 'Main Key';
$lang['mainstats'] = 'Algemene statistieken:';
$lang['main_menu'] = 'Hoofdmenu';
$lang['main_window_closed'] = 'Sorry, je hebt het hoofd venster gesloten.';
$lang['makefeatured'] = 'Klik hier om dit profiel aan de Perfecte profielen lijst toe te voegen';
$lang['Male'] = 'Man';
$lang['managechat'] = 'Chat';
$lang['manageforum'] = 'Forum admin';
$lang['manage_admins'] = 'Admin opties';
$lang['manage_admin_permissions'] = 'Admin rechten menu';
$lang['manage_article'] = 'Artikel aanmaken';
$lang['manage_banners'] = 'Reclame menu';
$lang['manage_cities'] = 'Plaatsen';
$lang['manage_counties'] = 'Regio';
$lang['manage_countries'] = 'Talen opties';
$lang['manage_country_states'] = 'Land/Plaatsen opties';
$lang['manage_import'] = 'Importeren';
$lang['manage_import_aedating'] = 'Importeren vanuit aeDating';
$lang['manage_import_datingpro'] = 'Importeren vanuit DatingPro';
$lang['manage_import_section'] = 'Selecteer Importeer module';
$lang['manage_import_select'] = 'Selecteer wat te importeren';
$lang['manage_import_webdate'] = 'Importeren uit Webdate';
$lang['manage_languages'] = 'Talen opladen';
$lang['manage_member(s)hip'] = 'Lidmaatschap menu';
$lang['manage_news'] = 'Nieuws aanmaken';
$lang['manage_pages'] = 'Pagina footer opties';
$lang['manage_polls'] = 'Poll aanmaken';
$lang['manage_states'] = 'Opladen provincies/Staten';
$lang['manage_story'] = 'Verhalen aanmaken';
$lang['manage_videos'] = 'Beheer Video\'s';
$lang['manage_zips'] = 'Postcode bestanden opladen';
$lang['mandatory'] = 'Verplicht:';
$lang['mark'] = 'Markeren';
$lang['matches_found'] = 'De volgende profielen komen overeen met jou criteria.';
$lang['maxlength'] = 'Maximum Lengte:';
$lang['maxsize'] = 'Maximum toegestane grootte (KB)';
$lang['max_255'] = 'Maximaal 255 tekens';
$lang['max_allowed'] = 'Maximaal toegestaan';
$lang['member'] = 'lid';
$lang['memberpanel'] = 'Pagina van lid';
$lang['memberprofiles'] = 'Member profielen';
$lang['member(s)'] = 'Member';
$lang['member(s)earch'] = 'member(s) Zoeken';
$lang['member(s)hdr'] = 'member(s)';
$lang['member(s)hip'] = 'Mijn Lidmaatschap';
$lang['member(s)hip_hdr'] = 'Lidmaatschap niveau';
$lang['member(s)hip_packages'] = 'Lidmaatschap pakketten';
$lang['member(s)hip_packages_compare'] = 'Vergelijking Lidmaatschap pakketten';
$lang['member(s)hip_status'] = 'Status Lidmaatschap';
$lang['member(s)hip_types'] = 'Lidmaatschap types';
$lang['member(s)_around'] = 'member(s) dichtbij ';
$lang['member(s)_login'] = 'Member(s) Login';
$lang['member_login'] = 'Member login';
$lang['member_panel'] = 'member(s) opties';
$lang['member_since'] = 'Lid Sinds';
$lang['message'] = 'Bericht';
$lang['message_read'] = array(
'html' => '<table border=0 cellpadding="0" cellspacing="0" width="570"><tr><td height="25" width="100%"><div class="module_head"><table border=0 cellspacing=0 cellpadding=0 width="100%"><tr><td width="77" height="25">
<div class="module_head">#email_hdr_left#</div></td><td width="493" ><div class="module_head">&nbsp;&nbsp;Je bericht naar #RecipientName# is gelezen! </div></td></tr></table></div></td></tr>
<tr><td width="100%" class="evenrow" colspan="2" >
<div class="evenrow" ><table border="0" cellspacing="0" cellpadding="5"><tr><td height="2"></td></tr><tr><td width="50%" valign="top" class="evenrow">Beste #FirstName#,<br><br>Het bericht dat je gestuurd hebt naar <b>#RecipientName#</b> is gelezen.<br><br>Om het profiel van deze gebruiker te bekijken, ga naar <a href=\\"#link#\\">SITENAME</a>.<br><br>Succes!<br>#AdminName# <br>SITENAME<br></td>
<td valign="top">#smallProfile#</td></tr></table>
</div></td></tr><tr><td height="6" colspan="2" class="evenrow"></td></tr></table> ',
'text' => 'Beste #FirstName#,

Het bericht wat je hebt verstuurd naar \'#RecipientName#\' is gelezen.

Succes!
#AdminName#
SITENAME',
        );
$lang['message_read_sub'] = 'SITENAME Bericht: Je bericht naar #RecipientName# is gelezen!';
$lang['message_received'] = array(
'html' => '<table border=0 cellpadding="0" cellspacing="0" width="570"><tr><td height="25" width="100%"><div class="module_head"><table border=0 cellspacing=0 cellpadding=0 width="100%"><tr><td width="77" height="25"><div class="module_head">
#email_hdr_left#</div></td><td width="493" ><div class="module_head">&nbsp;&nbsp;Een nieuw bericht van #SenderName#! </div></td></tr></table></div></td></tr><tr><td width="570" class="evenrow" colspan="2" ><div class="evenrow" ><table border="0" cellspacing="2" cellpadding="5"><tr><td height="2"></td></tr><tr><td width="50%" valign="top" class="evenrow">
<table width="100%" border=0 cellspacing=0 cellpadding=0><tr><td width="25%" ><div class="newshead">#From#:</div></td><td width="75%">#SenderName#</td></tr><tr><td><div class="newshead">#TO#:</div></td><td>#UserName#</td></tr><tr><td  >
<div class="newshead">#Date#:</div></td><td>#MESSAGE_DATE# </td></tr><tr><td ><div class="newshead">#Subject#:</div></td><td>#MSG_SUBJECT#</td></tr><tr><td colspan="2" height="6">
</td></tr><tr><td colspan=2>Beste #FirstName#,<br><br>Je hebt een nieuw bericht ontvangen van #SenderName#.<br><br>Bezoek <a href=\\"#link#\\">SITENAME</a> om dit bericht te beantwoorden. <br><br>Succes!<br>#AdminName#<br>SITENAME<br></td></tr></table>
</td><td width="50%" valign="top" class="oddrow"><div class="oddrow">#smallProfile#</div></td></tr></table></div></td></tr><tr><td height="6" colspan="2" class="evenrow"></td></tr></table> ',
'text' => 'Beste #FirstName#,

Je hebt een bericht ontvangen van SITENAME gebruiker \'#SenderName#\'.

Bezoek <a href="#link#">SITENAME</a> om dit bericht te beantwoorden.

Succes!
#AdminName#
SITENAME',
        );
$lang['message_received_sub'] = 'SITENAME Bericht: Nieuw bericht ontvangen';
$lang['message_templates'] = 'Bericht voorbeelden';
$lang['miles'] = ' mijlen ';
$lang['minimum_options'] = 'Minimaal twee keuzes nodig';
$lang['modifieduser'] = array(
'html' => '<table border=0 cellpadding="0" cellspacing="0" width="570"><tr><td height="25" width="100%"><div class="module_head"><table border=0 cellspacing=0 cellpadding=0 width="100%"><tr><td width="77" height="25" class="module_head"><div class="module_head">#email_hdr_left#</div></td><td width="493" class="module_head" ><div class="module_head">A user modified the profile!</div></td></tr></table></div></td></tr><tr><td width="100%" class="evenrow" colspan="2" ><div class="evenrow"><table border="0" cellspacing="0" cellpadding="5"><tr><td width="100%" valign="top" class="evenrow"><br />Beste Site administrator,<br><br>Following user modified the profile.<br><br>Username: <a href="#SiteUrl##ADMIN_DIR#showprofile.php?username=#UserName#">#UserName#</a><br><br>#AdminName# <br>#siteName#<br></td></tr></table></div></td></tr><tr><td height="6" colspan="2" class="evenrow"></td></tr></table> ',
'text' => 'Beste Site administrator,

De gebruiker heeft het profiel Gewijzigdd.
beruikers naam: #UserName#

#AdminName#
#siteName#',
        );
$lang['modifieduser_sub'] = 'Gebruiker heeft profiel Gewijzigdd';
$lang['modify'] = 'Wijzigingen Opslaan';
$lang['modify_admin'] = 'Bebeheerder Wijzigen';
$lang['modify_article'] = 'Artikel Wijzigen';
$lang['modify_calendar'] = 'Kalander Wijzigen';
$lang['modify_calendars'] = 'Kalanders Wijzigen';
$lang['modify_city'] = 'Plaats Wijzigen';
$lang['modify_country'] = 'Land Wijzigen';
$lang['modify_county'] = 'Wijzig Regio';
$lang['modify_curr_search'] = 'Huidige zoek criteria wijzigen';
$lang['modify_event'] = 'Gebeurtenis Wijzigen';
$lang['modify_news'] = 'Nieuws Wijzigen';
$lang['modify_option'] = 'Optie Aanpassen';
$lang['modify_options'] = 'Keuzes Wijzigen';
$lang['modify_poll'] = 'Poll   Wijzigen';
$lang['modify_profile'] = 'Profiel Aanpassen';
$lang['modify_promo'] = 'Bewerk promotie';
$lang['modify_question'] = 'Vraag Aanpassen';
$lang['modify_rating'] = 'Beoordeling wijzigen';
$lang['modify_ratings'] = 'Beoordelingen wijzigen';
$lang['modify_section'] = 'Onderdeel aanpassen';
$lang['modify_sections'] = 'Onderdelen aanpassen';
$lang['modify_state'] = 'Provincie/Staat Wijzigen';
$lang['modify_story'] = 'Verhaal Wijzigen';
$lang['modify_zip'] = 'Postcode Wijzigen';
$lang['modpage'] = 'Pagina Wijzigen';
$lang['module'] = 'Module';
$lang['mod_affiliate'] = 'Een partner wijzigen';
$lang['mod_featured'] = 'Profiel in Perfecte Lijst Wijzigen';
$lang['mod_lowtohigh'] = array(
'High to Low' => 'Hoog naar Laag',
'Low to High' => 'Laag naar Hoog',
        );
$lang['more'] = 'meer';
$lang['moreoptions'] = 'Meer keuzes';
$lang['more_events'] = 'meer gebeurtenissen >>';
$lang['mostactivepage'] = 'Meest actieve pagina';
$lang['msg_deleted'] = 'Bericht is verwijderd';
$lang['msg_flagged'] = 'Bericht is gemarkeerd';
$lang['msg_sent'] = 'Je bericht is verstuurd';
$lang['msg_unflagged'] = 'Bericht is niet gemarkeerd';
$lang['mship_changed'] = 'Lidmaatschap niveau Gewijzigdd';
$lang['mship_changed_successfull'] = 'Je lidmaatschap niveau is Gewijzigd naar Gratis.';
$lang['mship_errors'] = array(
'1' => 'Naam is een vereist veld.',
'2' => 'Prijs is een vereist veld.',
'3' => 'Valuta is een vereist veld.',
'4' => 'Geen Betaling is alleen beschikbaar bij het veranderen van het lidmaatschap niveau naar Gratis.',
        );
$lang['mship_expired_note'] = array(
'html' => '<table border=0 cellpadding="0" cellspacing="0" width="570"><tr><td height="25" width="100%"><div class="module_head"><table border=0 cellspacing=0 cellpadding=0 width="100%"><tr><td width="77" height="25" class="module_head"><div class="module_head">#email_hdr_left#</div></td>
<td width="493" class="module_head" ><div class="module_head">&nbsp;&nbsp;Je lidmaatschap is afgelopen! </div></td></tr></table></div></td></tr><tr><td width="100%" class="evenrow" colspan="2" ><div class="evenrow" ><table border="0" cellspacing="0" cellpadding="5"><tr><td height="2"></td></tr><tr><td width="100%" valign="top" class="evenrow">Beste #FirstName#,<br>
<br>Bedankt voor het gebruiken van SITENAME!<br><br>Dit bericht is er om je te herinneren aan dat je lidmaatschap niveau <b>#member(s)hipLevel#</b> op <a href="\\"#link#\\"><b>SITENAME</b></a> is afgelopen op <b>#ExpiryDate#</b>.<br><br>Gelieve <a href=\\"#link#\\">in te loggen op SITENAME</a> om je lidmaatschap te vernieuwen en gebruik te kunnen blijven maken van onze diensten.<br><br>Succes!<br>#AdminName# <br>SITENAME<br></td></tr></table></div></td></tr><tr><td height="6" colspan="2" class="evenrow"></td></tr></table> ',
'text' => 'Beste #FirstName#,

Bedankt voor het gebruiken van SITENAME!

Dit bericht is er om je te herinneren aan dat je lidmaatschap niveau #member(s)hipLevel# op SITENAME is afgelopen op #ExpiryDate#.

Gelieve <a href="#link#">in te loggen op SITENAME</a> om je lidmaatschap te vernieuwen en gebruik te kunnen blijven maken van onze diensten.

Succes!
#AdminName#
SITENAME',
        );
$lang['mship_expiry_note'] = array(
'html' => '<table border=0 cellpadding="0" cellspacing="0" width="570"><tr><td height="25" width="100%"><div class="module_head"><table border=0 cellspacing=0 cellpadding=0 width="100%"><tr><td width="77" height="25" class="module_head">
<div class="module_head">#email_hdr_left#</div></td><td width="493" class="module_head" ><div class="module_head">&nbsp;&nbsp;Je lidmaatschap loopt binnekort af! </div></td></tr></table></div></td></tr>
<tr><td width="100%" class="evenrow" colspan="2" ><div class="evenrow" ><table border="0" cellspacing="0" cellpadding="5"><tr><td height="2"></td></tr><tr><td width="100%" valign="top" class="evenrow">Beste #FirstName#,<br><br>Bedankt voor het gebruiken van SITENAME!<br><br>Dit bericht is er om je te herinneren aan het aflopen van je lidmaatschap niveau <b>#member(s)hipLevel#</b> op <a href="\\"#link#\\"><b>SITENAME</b></a>, op <b>#ExpiryDate#</b>.<br><br>Gelieve <a href=\\"#link#\\">in te loggen op SITENAME</a> om je lidmaatschap te vernieuwen en gebruik te kunnen blijven maken van onze diensten.<br>
<br>Succes!<br>#AdminName# <br>SITENAME<br></td></tr></table></div></td></tr><tr><td height="6" colspan="2" class="evenrow"></td></tr></table> ',
'text' => 'Beste #FirstName#,

Bedankt voor het gebruiken van SITENAME!

Dit bericht is er om je te herinneren aan het aflopen van je lidmaatschap niveau #member(s)hipLevel# op SITENAME, op #ExpiryDate#.

Gelieve <a href="#link#">in te loggen op SITENAME</a> en je lidmaatschap te vernieuwen om gebruik te kunnen blijven maken van onze diensten.

Succes!
#AdminName#
SITENAME',
        );
$lang['must_be_valid'] = 'Moet geldig zijn';
$lang['must_show'] = 'Moet Weergeven';
$lang['myblog'] = 'Mijn Blog';
$lang['mybuddies'] = 'Mijn Vrienden';
$lang['mylists'] = 'Mijn Lijsten';
$lang['mymatches_body'] = '<table border=0 cellpadding="0" cellspacing="0" width="570"><tr><td height="25" width="100%"><div class="module_head"><table border=0 cellspacing=0 cellpadding=0 width="100%"><tr><td width="77" height="25"><div class="module_head">#email_hdr_left#</div></td><td width="493" class="module_head" ><div class="module_head">&nbsp;&nbsp;Je zoek matchende profielen mail </div></td></tr></table></div></td></tr>
<tr><td width="570" class="evenrow" colspan="2" ><div class="evenrow" ><table border="0" cellspacing="0" cellpadding="5"><tr><td height="1"></td></tr><tr><td class="evenrow">Beste #FirstName#,<br><br>Hier volgt een lijst met profielen die overeenkomen met je zoek criteria.</td></tr>
<tr><td height="1" class="evenrow"> </td></tr><tr><td valign="top" class="evenrow">#matchedProfiles#</td></tr><tr><td class="evenrow" colspan="2">Bezoek <a href=\\"#link#\\">SITENAME</a> om deze profielen te bekijken.<br><br>Succes!<br>#AdminName#<br>SITENAME<br></td></tr></table></div> </td></tr></table>';
$lang['mymatches_sub'] = 'SITENAME Bericht: Je zoek matchende profielen mail';
$lang['myprofile'] = 'Mijn Profiel';
$lang['myprofilepreferences'] = 'Profiel vragen';
$lang['mysearchpreferences'] = 'Mijn zoek voorkeur';
$lang['mysettings'] = 'Mijn Berichten instellingen';
$lang['mysettings_updated'] = 'Je voorkeur instellingen zijn Gewijzigdd.';
$lang['my_matches'] = 'Mijn Matches';
$lang['my_page'] = 'Mijn pagina';
$lang['my_searches'] = 'Mijn zoekopdrachten';
$lang['my_templates'] = 'Mijn Voorbeelden';
$lang['name'] = 'Naam: ';
$lang['manage_membership'] = 'Lidmaatschap menu';
$lang['name_col'] = 'Naam';
$lang['near_zip'] = 'Dichtbij postcode';
$lang['new'] = 'Nieuw';
$lang['newest_profiles'] = 'Nieuwste Profielen';
$lang['newest_profpics_hdr'] = 'Nieuwste profielen foto\'s';
$lang['newmemberlist'] = 'Nieuwste Member(s)';
$lang['newmessages'] = 'Nieuwe berichten ontvangen:';
$lang['newpic'] = array(
'html' => '<table border=0 cellpadding="0" cellspacing="0" width="570"><tr><td class="module_head" width="100%" height="25"><div class="module_head"><table border=0 cellspacing=0 cellpadding=0 width="100%"><tr><td width="77" height="25"><div class="module_head">#email_hdr_left#</div>
</td><td width="493" height="25"><div class="module_head">&nbsp;&nbsp;Nieuwe foto Opgeladen door gebruiker </div></td></tr></table></div></td></tr><tr><td width="100%" class="evenrow" colspan="2" ><div class="evenrow" ><table border="0" cellspacing="0" cellpadding="5"><tr><td height="1"></td></tr><tr><td width="50%" valign="top" class="evenrow" >Beste website beheerder,
<br><br>De gebruiker <a href="#SiteUrl##ADMIN_DIR#showprofile.php?username=#UserName#">#UserName#</a> heeft een nieuwe foto Opgeladen. <br><br>Member naam: #UserName#<br>Foto No.: #PicNo#<br><br>#AdminName# <br>SITENAME<br></td><td valign="top" class="evenrow" align="cemter">#smallPic#
</td></tr></table></div></td></tr><tr><td height="6" colspan="2" class="evenrow"></td></tr></table> ',
'text' => 'Beste site beheerder,

De gebruiker #UserName# heeft een nieuwe foto Opgeladen.

Member naam: #UserName#
Foto No.: #PicNo#

#AdminName#
SITENAME',
        );
$lang['newpic_sub'] = 'SITENAME Bericht: Nieuwe foto Opgeladen door gebruiker ';
$lang['news'] = 'Nieuws';
$lang['news_error'] = array(
'1' => 'Nieuws header is een vereist veld.',
'2' => 'Nieuws tekst is een vereist veld.',
'3' => 'Nieuws datum is een vereist veld.',
        );
$lang['news_header'] = 'Header';
$lang['newuser'] = array(
'html' => '<table border=0 cellpadding="0" cellspacing="0" width="570"><tr><td height="25" width="100%"><div class="module_head"><table border=0 cellspacing=0 cellpadding=0 width="100%"><tr><td width="77" height="25" class="module_head"><div class="module_head">#email_hdr_left#</div></td>
<td width="493" class="module_head" ><div class="module_head">&nbsp;&nbsp;Nieuwe gebruiker heeft zich ingeschreven!</div></td></tr></table></div></td></tr><tr><td width="100%" class="evenrow" colspan="2" ><div class="evenrow"><table border="0" cellspacing="0" cellpadding="5"><tr><td width="100%" valign="top" class="evenrow"><br />Beste site beheerder,<br><br>Een nieuwe gebruiker heeft zich ingeschreven op #siteName#.<br><br>Member naam: <a href="#SiteUrl##ADMIN_DIR#showprofile.php?username=#UserName#">#UserName#</a><br><br>#AdminName# <br>#siteName#<br></td></tr></table></div></td></tr><tr><td height="6" colspan="2" class="evenrow"></td></tr></table> ',
'text' => 'Beste site beheerder,

Een nieuwe gebruiker heeft zich ingeschreven op #siteName#.

Member naam: #UserName#

#AdminName#
#siteName#',
        );
$lang['newuser_sub'] = 'Nieuwe gebruiker ingeschreven';
$lang['newvideo'] = array(
'html' => '<table border=0 cellpadding="0" cellspacing="0" width="570"><tr><td height="25" width="100%"><div class="module_head"><table border=0 cellspacing=0 cellpadding=0 width="100%"><tr><td width="77" height="25"><div class="module_head">#email_hdr_left#</div>
</td><td width="493" height="25"><div class="module_head">&nbsp;&nbsp;Nieuwe video Opgeladen door gebruiker! </div></td></tr></table></div></td></tr><tr><td width="100%" class="evenrow" colspan="2" ><div class="evenrow" ><table border="0" cellspacing="0" cellpadding="5"><tr><td height="2"></td></tr><tr><td width="100%" valign="top" class="evenrow">Beste site beheerder,<br><br>De gebruiker #UserName# heeft een nieuwe video Opgeladen. <br><br>Member naam: #UserName#<br>Video No.: #PicNo#<br><br>#AdminName#<br>SITENAME<br></td>
</tr></table></div></td></tr><tr><td height="6" colspan="2" class="evenrow"></td></tr></table> ',
'text' => 'Beste site beheerder,

De gebruiker #UserName# heeft een nieuwe video Opgeladen.

Member naam: #UserName#
Video No.: #PicNo#

#AdminName#
SITENAME',
        );
$lang['newvideo_sub'] = 'SITENAME Bericht: Nieuwe video Opgeladen door gebruiker ';
$lang['new_password'] = 'Nieuw Wachtwoord:';
$lang['next'] = 'Volgende';
$lang['next_day'] = 'Volgende Dag';
$lang['next_month'] = 'Volgende Maand';
$lang['next_section'] = 'Volgend onderdeel';
$lang['next_week'] = 'Volgende Week';
$lang['no'] = 'Nee';
$lang['nonfeatured_profiles_hdr'] = 'Normale Member(s)';
$lang['noone_online'] = 'Geen member(s) Online';
$lang['nopicsloaded'] = 'Geen Foto\'s';
$lang['notify_me'] = 'Meld mij wanneer mijn bericht is gelezen.';
$lang['not_authorize'] = 'Je hebt geen toestemming tot deze pagina. Neem a.u.b. contact up met de bebeheerder.';
$lang['not_a_member'] = 'Geen lid?';
$lang['novideos_loaded'] = 'Geen Video\'s';
$lang['now_showing'] = 'Nu tonend ';
$lang['no_admin_user_msg1'] = 'Er zijn geen niet-super gebruiker bebeheerders. Gelieve er een te cre&euml;ren.';
$lang['no_admin_user_msg2'] = 'Om nu een nieuwe bebeheerder account te maken';
$lang['no_affiliates'] = 'Aantal partners';
$lang['no_affiliate_refs'] = 'Aantal partner verwijzingen';
$lang['no_blog_found'] = 'Geen post gevonden';
$lang['no_event_description'] = 'Geen omschrijving beschikbaar';
$lang['no_event_for_the_day'] = 'Er zijn geen gebeurtenissen voor deze datum.';
$lang['no_flagged_messages_in_box'] = 'Er zijn geen gemarkeerde berichten in deze mailboxmap';
$lang['no_im_msgs'] = 'Geen IM Berichten';
$lang['no_langs'] = 'Aantal talen beschikbaar';
$lang['no_message'] = 'Geen nieuwe berichten in je Inbox.';
$lang['no_messages_in_box'] = 'Er zijn geen berichten in deze mailboxmap';
$lang['no_msg_templates'] = 'Geen voorbeeld berichten gevonden.';
$lang['no_news'] = 'Aantal nieuws items';
$lang['no_note'] = 'Geen Opmerking:';
$lang['no_of_comments'] = 'Aantal commentaren';
$lang['no_pages_refs'] = 'Aantal paginaverwijzingen';
$lang['no_payment'] = 'Geen betaling benodigd (Gratis)';
$lang['no_pics'] = 'Geen Foto\'s';
$lang['no_plugin_found'] = 'Geen Plugin Gevonden';
$lang['no_polls'] = 'Aantal Poll  s';
$lang['no_poll_found'] = 'Geen Poll  s Gevonden';
$lang['no_previous_polls'] = 'Er zijn geen vorige Poll  s.';
$lang['no_promo_data'] = 'Er is geen gegeven van het Promotie gebruik om dit keer te melden.';
$lang['no_rating'] = 'Niet Beoordeeld';
$lang['no_record_found'] = 'Geen overeenkomsten gevonden.';
$lang['no_save'] = 'Niet Opslaan';
$lang['no_search_results'] = '<font color=red><b>0 Resultaten gevonden</b></font><br /><br />Er zijn geen zoekresultaten die overeenkomen met je zoek criteria. Het is misschien handig uitgebreider te zoeken. Probeer het aantal criteria terug te brengen, bijvoorbeeld zoeken naar lengte en leeftijd, inplaats van lengte, leeftijd en lichaamsbouw. Of breid de zoek criteria uit. Bijvoorbeeld van leeftijd tussen 40-50 naar 30-60.<br /><br />';
$lang['no_select_msg'] = 'Je hebt geen optie selecteerd. Klik a.u.b. op de "Terug" knop van de browser om een of meerdere opties te selecteren.';
$lang['no_shipping'] = 'Geen Transport:';
$lang['no_stories'] = 'Aantal verhalen';
$lang['no_subject'] = 'Geen Onderwerp';
$lang['no_such_user'] = 'Er is geen gebruiker beschikbaar met de bepaalde parameter';
$lang['no_thanks'] = 'Antwoord \\"Nee Bedankt\\"';
$lang['no_thanks_message'] = array(
'html' => 'Hoi #recipient_username#,<br><br>Bedankt voor de interesse, maar ik moet je helaas teleurstellen. Ik hoop dat je toch een match vindt op #site_name#.<br><br>Succes,<br><br>#sender_username#',
'text' => 'Hoi #recipient_username#,

Bedankt voor de interesse, maar ik moet je helaas teleurstellen. Ik hoop dat je uiteindelijk toch je match vindt op #site_name#.

Beste wensen,
#sender_username#',
        );
$lang['no_thanks_subject'] = 'Bedankt, maar nee dank je...';
$lang['no_unflagged_messages_in_box'] = 'Er zijn geen ongemarkeerde berichten in deze mailboxmap';
$lang['no_watched_event'] = 'Je houdt nu geen gebeurtenissen in de gaten.
<br /><br />Er komen de komende 30 dagen #eventcount# gebeurtenissen voor. <a #calenderlink#>Open de Kalander</a> om deze gebeurtenissen te bekijken.
<br /><br />Om een gebeurtenis te bekijken, klik erop in de Kalander, en klik daarna op het vergrootglasicoon. #glassicon#
<br /><br />Gebeurtenissen die je in de gaten houdt lopen af na het plaatsvinden ervan.';
$lang['of'] = ' door ';

$lang['of_zip_code'] = 'met deze postcode';
$lang['ok'] = 'Ok';
$lang['old_password'] = 'Oud Wachtwoord:';
$lang['on'] = ' op ';
$lang['online'] = 'Online';
$lang['online_profiles'] = 'Online Profielen';
$lang['online_users'] = 'Member(s) Online: ';
$lang['online_users_txt'] = 'Member(s) online';
$lang['only_jpg'] = 'Alleen JPG, GIF en PNG bestanden zijn toegestaan.';
$lang['on_off_values'] = array(
'0' => 'Nee',
'1' => 'Ja',
        );
$lang['open_search'] = 'Open Zoeken';
$lang['option'] = 'Keuze';
$lang['options_title'] = 'Vraag Opties';
$lang['or'] = 'Of';
$lang['OR'] = 'OF';
$lang['order'] = 'Volgorde';
$lang['order_by'] = 'Volgorde: ';
$lang['osdate_version'] = 'osDate Versie';
$lang['other_user_stats'] = 'Andere Gebruiker statistieken';
$lang['page'] = 'Pagina:';
$lang['pagekey'] = 'Sleutel:';
$lang['pagekey_help'] = 'www.jouwdomein.nl/index.php?page=YOUR_KEY';
$lang['pageno'] = 'Pagina ';
$lang['pages_errormsgs'] = array(
'0' => '',
'1' => 'Pagina titel ontbreekt.',
'2' => 'Pagina sleutel ontbreekt.',
'3' => 'Pagina tekst ontbreekt.',
'4' => 'Pagina sleutel bestaat al. Gelieve een andere te kiezen.',
'5' => 'Pagina is verwijderd.',
        );
$lang['pagetext'] = 'Tekst:';
$lang['pagetitle'] = 'Titel:';
$lang['page_tags_msg'] = 'Pagina titel Poll   & Meta Tags';
$lang['paid_thru'] = 'Betaling via';
$lang['password_changed_successfully'] = 'Je wachtwoord is veranderd.';
$lang['password_change_msg'] = 'Je wachtwoord is aangepast.';
$lang['payment_cancel'] = 'Betaling Geannuleerd';
$lang['payment_fail'] = 'Betaling Mislukt';
$lang['payment_failed'] = 'Verwerken betaling is mislukt. Probeer het a.u.b. opnieuw.';
$lang['payment_methods'] = 'Betaling methodes';
$lang['payment_modules'] = 'Betaal modules';
$lang['payment_msg1'] = 'Beschikbare Betaling methodes:';
$lang['pay_no'] = 'Betaling nummer.';
$lang['pay_status'] = 'Betaling status';
$lang['pending_aff'] = 'Wachtende Partners';
$lang['pending_profiles'] = 'Wachtende Profielen';
$lang['perform_search'] = 'en gaan zoeken.';
$lang['permissions'] = 'Modules';
$lang['permitmsg_1'] = 'Sorry, je lidmaatschap niveau bevat geen';
$lang['permitmsg_2'] = 'Upgrade a.u.b. je lidmaatschap niveau om gebruik te maken van ';
$lang['permitmsg_3'] = 'Vergelijk Lidmaatschap niveaus';
$lang['permitmsg_4'] = 'Verberg Lidmaatschap vergelijking';
$lang['personal_details'] = 'Persoonlijke Details';
$lang['photos_url'] = 'Home Page URL:';
$lang['pics'] = 'Foto\'s';
$lang['picsloaded'] = 'Foto\'s Geladen';
$lang['pict'] = 'Foto';
$lang['picture'] = 'Foto';
$lang['picturegallery'] = 'Mijn Fotogalerij';
$lang['picture_gallery'] = 'Fotogalerij';
$lang['pic_deleted'] = 'selecteerde foto is verwijderd';
$lang['pic_gallery'] = 'Foto\'s';
$lang['play_video'] = 'Speel video';
$lang['please_be_sure'] = 'Zorg er a.u.b. voor dat';
$lang['plugin'] = 'Plugin';
$lang['Plugin_hlp'] = 'Administratieve Plugin kunnen alleen door bebeheerders en moderators met voldoende rechten gebruikt worden, en verschijnen automatisch links-onderin het beheer menu indien geactiveerd. Member plugin kunnen ingesteld worden op het Member menu';
$lang['plugin_access'] = 'Lidmaatschap Toegang';
$lang['plugin_active'] = 'Actief';
$lang['plugin_file'] = 'Upload Plugin .zip bestand';
$lang['plugin_install'] = 'Installeren';
$lang['plugin_installed'] = 'Ge&iuml;nstalleerd';
$lang['plugin_name'] = 'Naam';
$lang['plugin_number'] = 'Nummer';
$lang['plugin_subtitle_edit'] = 'Plugin Bewerken';
$lang['plugin_subtitle_list'] = 'Plugin Lijst';
$lang['pmgmt'] = 'promotie  menu';
$lang['poll'] = 'Poll';
$lang['pollsuggested'] = 'Bedankt! Je poll suggestie is naar de bebeheerder verstuurd.';
$lang['poll_active'] = 'Actief';
$lang['poll_active_hdr'] = 'Actief';
$lang['poll_entries'] = 'Poll toegang';
$lang['poll_errmsg1'] = 'Je hebt al gestemd bij deze poll. Probeer later een andere poll.';
$lang['poll_error'] = array(
'1' => 'Poll mag niet leeg blijven.',
'2' => 'Poll datum mag niet leeg blijven.',
'3' => 'Keuze mag niet leeg blijven.',
'txtpollopt_noblank' => 'Poll keuze is een vereist veld.',
'txtpoll_noblank' => 'Poll is een vereist veld.',
        );
$lang['poll_minimum_two'] = 'Minimaal twee nodig.';
$lang['poll_number'] = 'Aantal';
$lang['poll_options'] = 'Keuzes';
$lang['poll_question'] = 'Vraag';
$lang['poll_question_hdr'] = 'Vragen';
$lang['poll_responses_hdr'] = 'Antwoorden';
$lang['poll_result'] = 'Poll Uitslag';
$lang['poll_subtitle_add'] = 'Maak Poll';
$lang['poll_subtitle_edit'] = 'Poll bewerken';
$lang['poll_subtitle_list'] = 'Poll lijst';
$lang['poll_subtitle_results'] = 'Poll uitslag';
$lang['posted_by'] = 'Gepost door';
$lang['previous'] = 'Vorige';
$lang['previous_day'] = 'Vorige Dag';
$lang['previous_month'] = 'Vorige Maand';
$lang['previous_week'] = 'Vorige Week';
$lang['price'] = 'Prijs: ';
$lang['private_event'] = 'Informatie over deze gebeurtenis is Priv&eacute;';
$lang['private_only'] = 'Alleen Priv&eacute;';
$lang['private_to'] = 'Priv&eacute; Naar:';
$lang['privileges'] = array(
'activedays' => 'Geldig aantal dagen voor dit niveau.',
'allowalbum' => 'Sta foto Priv&eacute;-albums toe.',
'allowim' => 'Instant berichten toestaan.',
'allow_comment_removal' => 'Laat commentaren toe om worden verwijderd.',
'allow_mysettings' => 'Sta member toe instellingen te wijzigen.',
'allow_videos' => 'Mogen member(s) Video opladen?.',
'blog' => 'member(s) mogen deelnemen in blog.',
'chat' => 'member(s) mogen deelnemen in chat.',
'event_mgt' => 'Sta gebeurtenis beheer toe.',
'extsearch' => 'Uitgebreid Zoeken gebruiken.',
'favouritelist' => 'Sta vrienden/geblokkeerden/hot lijst toe.',
'forum' => 'member(s) mogen gebruik maken van forum.',
'hide' => 'Verberg deze lidmaatschap optie.',
'includeinsearch' => 'Bij zoekresultaten voegen.',
'message' => 'Stuur bericht naar mailbox.',
'messages_per_day' => 'member(s) mogen per dag aantal e-mail versturen.',
'message_keep_cnt' => 'Aantal te bewaren e-mail berichten.',
'message_keep_days' => 'Aantal dagen een e-mail bericht bewaren van member(s).',
'poll' => 'member(s) mogen deelnemen in poll.',
'profilepicscnt' => 'Aantal toegestane profiel foto\'s. ',
'saveprofiles' => 'member(s) mogen profielen opslaan',
'saveprofilescnt' => 'Memers mogen <b>aantal</b> profielen opslaan.',
'seepictureprofile' => 'member(s) mogen profiel foto\'s bekijken',
'sendwinks' => 'member(s) mogen aantal knipogen versturen.',
'uploadpicture' => 'member(s) mogen Foto\'s opladen',
'uploadpicturecnt' => 'Aantal foto\'s wat Opgeladen mag worden.',
'videoscnt' => 'Aantal toegestaan aantal video opladen.',
'winks_per_day' => 'Aantal knipogen per dag verstuurd mag worden.',
'allow_php121' => 'Sta php121 directe berichten gebruik toe.',
        );
$lang['privileges_msg'] = 'Rechten';
$lang['profilepics'] = 'Mijn Profiel foto\'s ';
$lang['profilepics_gallery'] = 'Profiel foto\'s';
$lang['profiles'] = 'Profielen';
$lang['profilesearch'] = 'member(s) Zoeken';
$lang['profileviewed'] = 'Aantal keer profiel bekeken:';
$lang['profile_activated'] = array(
'html' => '<table border=0 cellpadding="0" cellspacing="0" width="570"><tr><td height="25" width="100%"><div class="module_head"><table border=0 cellspacing=0 cellpadding=0 width="100%"><tr><td width="77" height="25" ><div class="module_head">
#email_hdr_left#</div></td><td width="493"><div class="module_head">&nbsp;&nbsp;Je profiel is geactiveerd!</div></td></tr></table></div></td></tr><tr>
<td width="100%" class="evenrow" colspan="2"><div class="evenrow"><table border="0" cellspacing="0" cellpadding="5"><tr><td height="2"></td></tr>
<tr><td width="100%" valign="top" class="evenrow">Dear #FirstName#,<br><br>We heten je hartelijk welkom op SITENAME. <br><br>Je profiel is geactiveerd met het lidmaatschap niveau <b>#member(s)hipLevel#</b>, en is geldig tot #ValidDate#.<br><br>Bezoek ons gauw op <a href=\\"#link#\\">SITENAME</a>.<br>
<br>Succes!<br>#AdminName# <br>SITENAME<br></td></tr></table></div></td></tr><tr><td height="6" colspan="2" class="evenrow"></td></tr></table> ',
'text' => 'Beste #FirstName#,

We heten je hartelijk welkom op SITENAME.

Je profiel is geactiveerd met lidmaatschap niveau <b>#member(s)hipLevel#</b>, en is geldig tot en met <b>#ValidDate#</b>.

Bezoek ons gauw op <a href="#link#">SITENAME</a>.

Succes!
#AdminName#
SITENAME',
        );
$lang['profile_activated_sub'] = 'SITENAME Bericht:  Je profiel is geactiveerd!';
$lang['profile_address1'] = 'Adres, regel 1:';
$lang['profile_address2'] = 'Adres, regel 2:';
$lang['profile_appearance_title'] = 'Uiterlijk';
$lang['profile_auto_confirmed'] = 'Bedankt voor het lid worden op SITENAME.<br><br>Als een speciaal gebaar, is je profiel automatisch geactiveerd door ons systeem.<br><br>Gelieve <a href="index.php?page=login">in te loggen</a> om van onze diensten gebruik te kunnen maken.<br><br>';
$lang['profile_basic_title'] = 'Primaire Informatie';
$lang['profile_birthday'] = 'Geboortedatum:';
$lang['profile_city'] = 'Woonplaats';
$lang['profile_confirmation_email'] = array(
'html' => '<table border=0 cellpadding="0" cellspacing="0" width="570">
<tr><td height="25" width="100%"><div class="module_head"><table border=0 cellspacing=0 cellpadding=0 width="100%">
<tr><td width="77" height="25" >#email_hdr_left#</td><td width="493"  height="25"><div class="module_head">&nbsp;&nbsp;Welkom!</div></td></tr></table></div></td></tr><tr><td width="570" class="evenrow" colspan="2" >
<div class="evenrow" ><table border=0 cellspacing=0 cellpadding=5 width="100%"><tr><td>Beste #FirstName#,<br><br>Bedankt voor het registreren op #siteName#! Als nieuwste lid van de community, moedig ik je aan om onze diensten en features te verkennen.<br><br>Om je profiel te bevestigen, klik op de link hieronder. Of als de link niet werkt, kopieer deze naar de adresbalk van je browser om deze zo te bezoeken.<br><br>
<a href=\\"#ConfirmationLink#=#ConfCode#\\">#ConfirmationLink#=#ConfCode#</a><br><br>Als je de laatste pagina van de registratiewizard nog open hebt staan, kune je daar je bevestiging code invoeren.<br><br>Je bevestiging code is: <b>#ConfCode#</b><br><br>We hebben de volgende registratie informatie van je ontvangen:<br>
<br>Member naam: <b>#StrID#</b><br>Wachtwoord: <b>#Password#</b><br>E-Mail: <b>#Email#</b><br><br>Gelieve deze informatie veilig te bewaren, zodat je altijd van onze diensten gebruikt kunt maken. Sommige diensten kunnen een upgrade van je lidmaatschap vereisen, wat je hier kan regelen:<br><br><a href="#SiteUrl#payment.php">#Upgrade#</a><br><br>Nogmaals bedankt voor het gebruiken van onze diensten, en we hopen dat je je match vindt! <br><br>
#AdminName#<br>#siteName#</td></tr></table></div></td></tr>
<tr><td height="6" colspan="2" class="evenrow"></td></tr></table> ',
'text' => 'Bezoek #FirstName#,

Bedankt voor het registreren op #siteName#! Als het nieuwste lid van onze community moedig ik je aan om onze diensten en features te verkennen.

Klik op de link hieronder om het toevoegen van je profiel te bevestigen. Of als de je niet op de link kan klikken, kopieer het adres dan naar de adresbalk en druk op enter om deze zo te bezoeken.

#ConfirmationLink#=#ConfCode#

Als je nog steeds de laatste pagina van de registratiewizard open hebt staan, kun je je bevestiging code daar invoeren.

Je bevestiging code is: #ConfCode#

We hebben de volgende registratieinformatie van je ontvangen:

Member naam: #StrID#
Wachtwoord: #Password#
E-Mail: #Email#

Bewaar deze informatie op een veilige plek, zodat je altijd gebruikt kunt blijven maken van onze diensten en features. Sommige diensten vereisen het upgraden van je lidmaatschap, wat je hier kunt doen:

#SiteUrl#payment.php

Nogmaals bedankt voor het gebruiken van onze diensten, en we hopen dat je je match zult vinden!

#AdminName#
#siteName#',
        );
$lang['profile_confirmation_email_sub'] = 'SITENAME Bericht: Bedankt voor het registreren op SITENAME!';
$lang['profile_country'] = 'Land:';
$lang['profile_delete_confirm_msg'] = 'Weet je zeker dat je dit profiel wil verwijderen?';
$lang['profile_details'] = 'Profiel details';
$lang['profile_email'] = 'E-mailadres:';
$lang['profile_firstname'] = 'Voornaam:';
$lang['profile_gender'] = 'Geslacht:';
$lang['profile_interests_title'] = 'Interesses';
$lang['profile_lastname'] = 'Achternaam:';
$lang['profile_lifestyle_title'] = 'Levensstijl';
$lang['profile_member(s)hip_changed'] = array(
'html' => '<table border=0 cellpadding="0" cellspacing="0" width="570"><tr><td height="25" width="100%"><div class="module_head"><table border=0 cellspacing=0 cellpadding=0 width="100%"><tr><td width="77" height="25" class="module_head">
<div class="module_head">#email_hdr_left#</div></td><td width="493" class="module_head" height="25"><div class="module_head">&nbsp;&nbsp;Je lidmaatschap niveau is Gewijzigdd! </div></td></tr></table></div></td></tr>
<tr><td width="100%" class="evenrow" colspan="2"><div class="evenrow" ><table border="0" cellspacing="0" cellpadding="5"><tr><td height="2"></td></tr><tr><td width="100%" valign="top" class="evenrow">Beste #FirstName#,<br><br>Je huidige lidmaatschap niveau <b>#CurrentLevel#</b> is omgezet naar <b>#NewLevel#</b>, en zal aflopen op <b>#ValidDate#</b>.<br>
<br>Bezoek ons gauw op <a href=\\"#link#\\">SITENAME</a>.<br><br>Succes!<br>#AdminName# <br>SITENAME<br></td></tr></table></div></td></tr><tr><td height="6" colspan="2" class="evenrow"></td></tr></table> ',
'text' => 'Beste #FirstName#,

Je huidige lidmaatschap niveau <b>#CurrentLevel#</b> is omgezet naar <b>#NewLevel#</b> en zal aflopen op <b>#ValidDate#</b>.

Bezoek ons gauw op <a href="#link#">SITENAME</a>.

Succes!
#AdminName#
SITENAME
',
        );
$lang['profile_member(s)hip_changed_sub'] = 'SITENAME Bericht: Je lidmaatschap niveau is Gewijzigdd!';
$lang['profile_modified_now'] = 'U hebt net uw profiel Gewijzigdd. Gelieve te merken op dat uw profiel bekwaam geen onderzoek zal zijn en u geen beelden zult kunnen uploaden tot Admin manueel uw Gewijzigdd profiel heeft herzien. Gelieve geduldig te zijn aangezien dit wat tijd kan vergen.';
$lang['profile_modify_email_confirm'] = array(
'html' => '<table border=0 cellpadding="0" cellspacing="0" width="570">
<tr><td height="25" width="100%"><div class="module_head"><table border=0 cellspacing=0 cellpadding=0 width="100%">
<tr><td width="77" height="25" >#email_hdr_left#</td></tr></table></div></td></tr><tr><td width="570" class="evenrow" colspan="2" >
<div class="evenrow" ><table border=0 cellspacing=0 cellpadding=5 width="100%"><tr><td>Dear #FirstName#,<br><br>Dank u voor het gebruik van #siteName#! Uw profiel is bijgewerkt. <br><br>Als uw e-mail adres is veranderd u alstublieft klik de link hieronder te activeren uw rekening. of, indien de verbinding is niet klikbaar, kopie en past dit in de adres balk van uw web browser, om zich rechtstreeks toegang te krijgen<br><br>
<a href=\\"#ConfirmationLink#=#ConfCode#\\">#ConfirmationLink#=#ConfCode#</a><br><br>We have recorded following email address change: <br /><br />E-Mail: <b>#Email#</b>.<br><br>Dankzij opnieuw voor gebruik maken van onze diensten en we hopen dat u vind uw match ! <br><br>
#AdminName#<br>#siteName#</td></tr></table></div></td></tr>
<tr><td height="6" colspan="2" class="evenrow"></td></tr></table> ',
'text' => 'Dear #FirstName#,

Dank u voor het gebruik van #siteName#.

Als uw e-mail adres is veranderd u alstublieft klik de link hieronder te activeren uw rekening. of, indien de verbinding is niet klikbaar, kopie en past dit in de adres balk van uw web browser, om zich rechtstreeks toegang te krijgen .

#ConfirmationLink#=#ConfCode#

We have recorded the following email address change:

E-Mail: #Email#


Thanks again for using our services, and we hope that you find your match!

#AdminName#
#siteName#',
        );
$lang['profile_modify_email_noconfirm'] = array(
'html' => '<table border=0 cellpadding="0" cellspacing="0" width="570">
<tr><td height="25" width="100%"><div class="module_head"><table border=0 cellspacing=0 cellpadding=0 width="100%">
<tr><td width="77" height="25" >#email_hdr_left#</td></tr></table></div></td></tr><tr><td width="570" class="evenrow" colspan="2" >
<div class="evenrow" ><table border=0 cellspacing=0 cellpadding=5 width="100%"><tr><td>Dear #FirstName#,<br><br>Thank you for using #siteName#! Uw profiel is bijgewerkt. <br><br>Wij hebben genoteerd dat de volgende e-mail adres is veranderd : <br /><br />E-Mail: <b>#Email#</b>.<br><br>Dankzij opnieuw voor gebruik maken van onze diensten en we hopen dat u vind uw match ! <br><br>
#AdminName#<br>#siteName#</td></tr></table></div></td></tr>
<tr><td height="6" colspan="2" class="evenrow"></td></tr></table> ',
'text' => 'Dear #FirstName#,

Dank u voor het gebruik  #siteName#.

Wij hebben genoteerd dat de volgende e-mail adres is veranderd:

E-Mail: #Email#


Dankzij opnieuw voor gebruik maken van onze diensten en we hopen dat u vind uw match !

#AdminName#
#siteName#',
        );
$lang['profile_modify_email_sub'] = 'SITENAME Message: Uw profiel is Gewijzigdd!';
$lang['profile_notset'] = 'Geen profiel gevonden voor de gebruiker.';
$lang['profile_not_confirmed_yet'] = 'Wijst op de gebruiker heeft bevestigde nog de registratie per e-mail.';
$lang['profile_ratings'] = 'Profiel beoordeling';
$lang['profile_reactivated'] = array(
'html' => '<table border=0 cellpadding="0" cellspacing="0" width="570"><tr><td height="25" width="100%"><div class="module_head"><table border=0 cellspacing=0 cellpadding=0 width="100%"><tr><td width="77" height="25" class="module_head">
<div class="module_head">#email_hdr_left#</div></td><td width="493" class="module_head" ><div class="module_head">&nbsp;&nbsp;Je profiel is opnieuw geactiveerd! </div></td></tr></table></div></td></tr><tr><td width="100%" class="evenrow" colspan="2">
<div class="evenrow" ><table border="0" cellspacing="0" cellpadding="5"><tr><td height="2"></td></tr><tr><td width="100%" valign="top" class="evenrow">Beste #FirstName#,<br><br>We zijn blij je mee te mogen delen dat je profiel opnieuw is geactiveerd met niveau <b>#member(s)hipLevel#</b>, en geldig is tot <b>#ValidDate#</b>.<br>
<br>Bezoek ons gauw op <a href=\\"#link#\\">SITENAME</a>.<br><br>Succes!<br>#AdminName# <br>SITENAME<br></td></tr></table></div></td></tr><tr><td height="6" colspan="2" class="evenrow"></td></tr></table> ',
'text' => 'Beste #FirstName#,

We zijn blij je mee te mogen delen dat je lidmaatschap opnieuw is geactiveerd met niveau <b>#member(s)hipLevel#</b> en geldig is tot <b>#ValidDate#</b>.

Bezoek ons gauw op <a href="#link#">SITENAME</a>.

Succes!
#AdminName#
SITENAME',
        );
$lang['profile_reactivated_sub'] = 'SITENAME Bericht: Je profiel is opnieuw geactiveerd!';
$lang['profile_s'] = 'USERNAME\'s Profiel';
$lang['profile_signup_title'] = 'Registratie-informatie';
$lang['profile_state_province'] = 'Provincie/Staat:';
$lang['profile_subtitle_address'] = 'Adres';
$lang['profile_subtitle_appearacnce'] = 'Uiterlijk';
$lang['profile_subtitle_login'] = 'Login details';
$lang['profile_subtitle_preference'] = 'Voorkeuren';
$lang['profile_subtitle_profile'] = 'Profiel';
$lang['profile_title'] = 'Profiel menu';
$lang['profile_username'] = 'Member naam:';
$lang['profile_zip'] = 'Postcode:';
$lang['profpics_gallery'] = 'Profiel foto\'s';
$lang['prof_quest_man'] = 'De verplichte beantwoorde vragen van Profiel';
$lang['prof_quest_nonman'] = 'De niet verplichte beantwoorde vragen van Profiel';
$lang['promorpt'] = 'Promotie Rapport';
$lang['Promotions'] = 'Promotie';
$lang['promo_active'] = 'Actief';
$lang['promo_add'] = 'Voeg Dagen toe';
$lang['promo_add_days'] = 'Voeg dagen toe';
$lang['promo_code'] = 'Speciaal Code';
$lang['promo_code_ins'] = 'Speciale maximum Code. 10 chars';
$lang['promo_desc'] = 'Beschrijving';
$lang['promo_desc_ins'] = 'Maximum beschrijving. 50 chars';
$lang['promo_info'] = '<br>Vul slechts ';
$lang['promo_keep_level'] = 'Houd Huidig Niveau';
$lang['promo_level'] = 'Upgrade Lidmaatschap Niveau';
$lang['promo_mlevel'] = 'Niveau verbetering';
$lang['promo_nousers'] = 'Geen Member(s) hebben dit nog gebruikt';
$lang['promo_numdays'] = 'Upgrade aantal maximum Dagen. 3 chars';
$lang['promo_report'] = 'Promotie Rapport gebruik';
$lang['promo_type'] = 'Upgrade Type';
$lang['public'] = 'Openbaar';
$lang['public_event'] = 'Deze gebeurtenis is door iedereen leesbaar';
$lang['public_only'] = 'Alleen Openbaar';
$lang['public_private'] = 'Openbaar en Priv&eacute;';
$lang['pwd_strength'] = 'Paswoord sterkte';
$lang['question'] = 'Vraag:';
$lang['questions_title'] = 'Vragen menu';
$lang['question_mark'] = '?';
$lang['quick_search'] = 'Snel zoeken';
$lang['random_female_member'] = 'Willekeurige Vrouw';
$lang['random_male_member'] = 'Random Man';
$lang['random_profiles'] = 'Onze member(s) ';
$lang['ranging'] = 'Vari&euml;rend';
$lang['rate_carefully'] = 'De eigenaren van deze website Controleerden de accuraatheid en betrouwbaarheid van deze beoordelingen niet.<br />Beoordelingen komen van gebruikers, en niet van de eigenaren.';
$lang['rate_photos'] = 'Foto\'s beoordelen';
$lang['rate_profile'] = 'Profiel Beoordelen';
$lang['rating'] = 'Beoordeling';
$lang['ratings'] = 'Beoordelingen';
$lang['reactivate'] = 'Profielen Heractiveren';
$lang['read'] = 'Lezen';
$lang['recent_active_users'] = 'Actieve Member(s)';
$lang['recuring_labels'] = array(
'0' => 'nooit',
'1' => 'dagen',
'2' => 'weken',
'3' => 'maanden',
'4' => 'jaren',
        );
$lang['recurring'] = 'Vind Plaats:';
$lang['recur_every'] = 'elke';
$lang['referals'] = 'Verwijzingen';
$lang['ref_no'] = 'Referentie nummer.';
$lang['register'] = 'Nu Registreren';
$lang['register_now'] = 'Registreer je nu om bij onze gemeenschap te komen!';
$lang['regis_referals'] = 'Geregistreerde Verwijzingen';
$lang['reject'] = 'Verwerpen';
$lang['remember_me'] = 'Onthoud Mij';
$lang['Remove'] = 'Verwijderen';
$lang['replace'] = 'Vervangen';
$lang['replied'] = 'Antwoord verzonden';
$lang['reply'] = 'Beantwoorden';
$lang['reqact'] = 'Gewenste Actie';
$lang['reqd_exposures'] = 'Vereiste Weergaven';
$lang['request'] = 'Verzoek';
$lang['required_info_indication'] = 'geeft verplichte informatie aan';
$lang['required_info_indicator'] = '* ';
$lang['required_info_indicator_color'] = 'Red';
$lang['resend_conflink_err1'] = 'Je hebt je profiel al geactiveerd. Gebruik de <a href="forgotpass.php">wachtwoord vergeten</a> optie om een nieuw wachtwoord te genereren.';
$lang['resend_conflink_hdr'] = 'Bevestiging mail opnieuw versturen';
$lang['resend_conflink_hdr1'] = 'bevestiging mail verloren of niet ontvangen na registratie? Geef het voor registratie gebruikte e-mailadres op om de e-mail opnieuw te versturen.';
$lang['resend_conflink_msg'] = 'Je bevestiging mail is opnieuw verstuurd.';
$lang['resend_conflink_msg1'] = 'Gelieve het voor registratie gebruikte e-mailadres in te voeren.';
$lang['reset'] = 'Herstel';
$lang['restore'] = 'Terugzetten';
$lang['results_per_page'] = 'Resultaten Per Pagina';
$lang['results_poll_title'] = 'Uitslag';
$lang['retreieve_info'] = 'Versturen';
$lang['return_message'] = 'Terug naar Bericht';
$lang['review'] = 'Overzicht';
$lang['RIGHT'] = 'rechts';
$lang['save'] = 'Opslaan';
$lang['savepoll'] = 'Poll   Opslaan';
$lang['save_as'] = 'Opslaan Als';
$lang['save_search'] = 'Zoekopdracht Opslaan';
$lang['sb_by'] = 'Gepost door:';
$lang['sb_error'] = 'Ingevoerde tekst is te lang';
$lang['sb_hdr'] = 'Shoutbox';
$lang['sb_msg_blank'] = 'Geen shoutbox bericht?';
$lang['sb_send'] = 'Verzenden';
$lang['sb_show_all'] = 'Alles weergeven';
$lang['search'] = 'Zoeken';
$lang['searching_within'] = 'Zoeken binnen';
$lang['search_advance'] = 'Zoeken';
$lang['search_advance_results'] = 'Zoekresultaten';
$lang['search_at'] = 'Zoeken op';
$lang['search_city'] = 'Zoek op Woonplaats';
$lang['search_country'] = 'Zoek op Land';
$lang['search_genders'] = array(
'C' => 'Koppels',
'F' => 'Vrouw',
'G' => 'Groep',
'M' => 'Man',
        );
$lang['search_location'] = '<b>Zoeken op Plaats:</b>';
$lang['search_options'] = 'Zoek opties';
$lang['search_results'] = 'Zoek resultaten';
$lang['search_results_per_page'] = array(
'10' => '10',
'100' => '100',
'2' => '2',
'20' => '20',
'5' => '5',
'50' => '50',
        );
$lang['search_simple'] = 'Eenvoudig Zoeken';
$lang['search_states'] = 'Zoek op Provincie/Staat';
$lang['search_wildcard_msg'] = 'Je kunt een * intypen om naar alle on naar alle items te zoeken.';
$lang['search_within'] = 'Zoeken binnen';
$lang['search_with_photo'] = 'Alleen gebruikers met foto\'s';
$lang['search_with_video'] = 'Alleen gebruikers met video\'s';
$lang['search_zip'] = 'Zoek op Postcode';
$lang['section'] = 'Onderdeel:';
$lang['section_add_blog'] = 'Maak een Blog post';
$lang['section_add_plugin'] = 'Laad Plugin';
$lang['section_add_poll'] = 'Maak nieuw poll';
$lang['section_appearance_title'] = 'Uiterlijk';
$lang['section_basic_title'] = 'Primaire informatie';
$lang['section_blog_info'] = 'Blog instellingen';
$lang['section_blog_list'] = 'Blog post';
$lang['section_blog_title'] = 'Blog';
$lang['section_interests_title'] = 'Interesses';
$lang['section_lifestyle_title'] = 'Levensstijl';
$lang['section_mypicture'] = 'Mijn Foto\'s';
$lang['section_plugin_list'] = 'Plugin Lijst';
$lang['section_plugin_title'] = 'Plugin';
$lang['section_poll_list'] = 'Poll lijst';
$lang['section_poll_title'] = 'Poll titel';
$lang['section_signup_title'] = 'Aanmeldinformatie';
$lang['section_title'] = 'Profiel vragen bestand maken';
$lang['security_code_txt'] = 'Gelieve de tekst op het plaatje hieronder te lezen en in te voeren. Dit is om er zeker van te zijn dat deze registratie niet via een automatisch systeem verloopt.';
$lang['seeking'] = 'op zoek naar een';
$lang['sef_msg'] = 'Zoekmachine vriendelijke URLs';
$lang['select'] = '- Selecteren -';
$lang['selected'] = 'selecteerd';
$lang['selected_users'] = 'selecteerde Gebruikers';
$lang['select_city'] = 'Selecteer Woonplaats';
$lang['select_country'] = 'Selecteer Land';
$lang['select_county'] = 'Selecteer Regio';
$lang['select_from_list'] = '--Selecteren--';
$lang['select_image_first'] = 'Gelieve eerst een afbeelding te selecteren';
$lang['select_letter'] = 'Selecteer Brief:';
$lang['select_section'] = 'Selecteer Onderdeel voor Vragen';
$lang['select_state'] = 'Selecteer Provincie/Staat';
$lang['select_user_to_send_message'] = 'Selecteer een gebruiker om je bericht naar toe te sturen';
$lang['sel_msgs_deleted'] = 'selecteerde berichten zijn verwijderd';
$lang['sel_msgs_flagged'] = 'selecteerde berichten zijn gemarkeerd';
$lang['sel_msgs_read'] = 'selecteerde berichten zijn gemarkeerd als Gelezen';
$lang['sel_msgs_undeleted'] = 'selecteerde berichten zijn teruggezet';
$lang['sel_msgs_unflagged'] = 'selecteerde berichten zijn niet langer gemarkeerd';
$lang['sel_msgs_unread'] = 'selecteerde berichten zijn gemarkeerd als Nieuw';
$lang['send'] = 'Versturen';
$lang['sendletter_success'] = 'De e-mail is verstuurd.';
$lang['send_a_message'] = 'Verstuur een Bericht';
$lang['send_birthday_message_hdr'] = 'Verzend verjaardag bericht';
$lang['send_birthday_message_thanks'] = 'De verjaardag wensen zijn verzonden.';
$lang['send_invite'] = 'Stuur Uitnodiging';
$lang['send_letter'] = 'Email member(s) versturen';
$lang['send_mail'] = 'Bericht versturen';
$lang['send_message_to'] = 'Stuur bericht naar';
$lang['send_new_password'] = 'Verstuurd nieuw wachtwoord';
$lang['send_to'] = 'Versturen';
$lang['send_wink'] = 'Stuur een Knipoog';
$lang['sent'] = 'Verzonden';
$lang['seo'] = 'SEO Instellingen';
$lang['seo_enable'] = 'URL Rewriting met mod_rewrite gebruiken?';
$lang['seo_head'] = 'Zoekmachine-optimalisatie';
$lang['separate_users_by_coma'] = 'Voer door Komma gescheiden gebruikersnamen in.';
$lang['settings_saved'] = 'Instellingen zijn opgeslagen';
$lang['seks'] = 'Geslacht:';
$lang['seks_without_colon'] = 'Geslacht';
$lang['show'] = 'Weergeven';
$lang['showfulllist'] = 'Laat volledige lijst zien';
$lang['showing'] = 'Weergegeven';
$lang['show_form'] = 'Formulier Weergeven:';
$lang['show_image'] = 'Plaatje Weergeven';
$lang['signonstats'] = 'Login statistieken';
$lang['signup'] = 'Aanmelden';
$lang['signup_address1'] = 'Adres, regel 1:';
$lang['signup_address2'] = 'Adres, regel 2:';
$lang['signup_birthday'] = 'Geboortedatum:';
$lang['signup_city'] = 'Woonplaats:';
$lang['signup_confirm_password'] = 'Wachtwoord Bevestigen:';
$lang['signup_country'] = 'Land:';
$lang['signup_email'] = 'E-mail adres:';
$lang['signup_feet'] = 'voet';
$lang['signup_firstname'] = 'Voornaam:';
$lang['signup_gender'] = 'Ik ben een';
$lang['signup_gender_look'] = array(
'A' => 'Elk Geslacht',
'B' => 'Man of Vrouw',
'C' => 'Koppel',
'F' => 'Vrouw',
'G' => 'Groep',
'M' => 'Man',
        );
$lang['signup_gender_values'] = array(
'C' => 'Koppel',
'F' => 'Vrouw',
'G' => 'Groep',
'M' => 'Man',
        );
$lang['signup_height'] = 'Lengte: ';
$lang['signup_js_errors'] = array(
'about_me_noblank' => 'Gelieve informatie over jezelf op te geven.',
'address1_noblank' => 'Er moet minstens een adres worden opgegeven.',
'address_charset' => 'Geef a.u.b. een geldig adres op.',
'calendarname_charset' => 'Alleen letters zijn toegestaan voor de Kalander naam.',
'calendarname_noblank' => 'Geef a.u.b. een naam voor deze Kalander.',
'ccnumber_noblank' => 'Creditcard Nummer moet worden ingevoerd.',
'ccowner_noblank' => 'Creditcard Eigenaar moet worden ingevoerd.',
'city_charset' => 'Plaatsnaam moet alfabetisch zijn.',
'city_noblank' => 'Woonplaats moet worden opgegeven.',
'comments_noblank' => 'Voer a.u.b. het commentaar in wat je wil verzenden.',
'con_password_noblank' => 'Bevestig Wachtwoord moet worden opgegeven.',
'country_noblank' => 'Gelieve een land te selecteren',
'county_charset' => 'De Regio naam moet alfabetisch zijn.',
'county_noblank' => 'Gelieve de Regio naam op te geven.',
'cvvnumber_noblank' => 'Creditcard Controleer nummer moet worden ingevoerd.',
'email_noblank' => 'E-mail moet worden opgegeven.',
'email_notvalid' => 'E-mailadres is ongeldig.',
'extsearchhead_noblank' => 'Voer a.u.b. de Uitgebreid Zoeken header in.',
'firstname_charset' => 'Alleen letters zijn toegestaan in de Voornaam.',
'firstname_noblank' => 'Voornaam moet worden opgegeven.',
'lastname_charset' => 'Alleen Letters zijn toegestaan in de Achternaam.',
'lastname_noblank' => 'Achternaam moet worden opgegeven.',
'maxlength_charset' => 'Geef a.u.b. een heel nummer voor de maximum lengte.',
'name_charset' => 'Gebruik a.u.b. letters voor de naam velden.',
'name_noblank' => 'Geef a.u.b. je naam op.',
'new_password_noblank' => 'Nieuw Wachtwoord moet worden opgegeven.',
'old_password_noblank' => 'Oud Wachtwoord moet worden opgegeven.',
'password_charset' => 'Alleen letters, cijfers en onderstreept \'_\' zijn toegestaan in het wachtwoord.',
'password_noblank' => 'Geef a.u.b. een wachtwoord op.',
'password_nomatch' => 'Wachtwoorden komen niet overeen.',
'password_outrange' => 'Wachtwoord lengte moet binnen het aangegeven bereik liggen.',
'profpic_noblank' => 'De foto van het profiel moet worden geladen',
'question_charset' => 'Ongeldige tekens in vraag.',
'question_noblank' => 'Voer a.u.b. een vraag in.',
'ratingname_charset' => 'Ongeldige tekens in de beoordeling naam.',
'ratingname_noblank' => 'Gelieve de beoordeling naam op te geven.',
'sectionname_charset' => 'Alleen letters zijn toegestaan voor de onderdeel naam.',
'sectionname_noblank' => 'Geef a.u.b. een naam voor dit onderdeel.',
'select_payment' => 'Selecteer a.u.b. eerst een Betaling methode.',
'sendname_charset' => 'Alleen letters zijn toegestaan voor de verzender naam.',
'sendname_noblank' => 'Geef a.u.b. de naam van de verzender.',
'stateprovince_noblank' => 'Provincie-/staat naam moet beschikbaar zijn.',
'subject_noblank' => 'Gelieve een onderwerp voor de brief in te voeren.',
'timezone_noblank' => 'Gelieve de tijdzone te selecteren.',
'username_charset' => 'Alleen letters, cijfers en onderstreept \'_\' zijn toegestaan in de Member naam.',
'username_email_noblank' => 'Voer uw gebruiker benaming/e-mailadres in.',
'username_noblank' => 'Geef a.u.b. een Member naam op.',
'username_outrange' => 'Aantal tekens in Member naam moet tussen het aangegeven bereik liggen.',
'username_start_alpha' => 'Member naam moet beginnen met een letter.',
'zip_charset' => 'Alleen cijfers zijn toegestaan in de postcode.',
'zip_noblank' => 'Postcode moet worden opgegeven.',
        );
$lang['signup_lastname'] = 'Achternaam:';
$lang['signup_meter_inches'] = 'meter';
$lang['signup_password'] = 'Wachtwoord:';
$lang['signup_picture'] = 'Mijn Foto';
$lang['signup_picture2'] = 'Mijn Foto 2:';
$lang['signup_picture3'] = 'Mijn Foto 3:';
$lang['signup_picture4'] = 'Mijn Foto 4:';
$lang['signup_picture5'] = 'Mijn Foto 5:';
$lang['signup_pounds'] = 'kilogram';
$lang['signup_pref_age_range'] = 'Leeftijd';
$lang['signup_state_province'] = 'Provincie/Staat:';
$lang['signup_subtitle_address'] = 'Adres';
$lang['signup_subtitle_appearacnce'] = 'Uiterlijk';
$lang['signup_subtitle_login'] = 'Login Details';
$lang['signup_subtitle_preference'] = 'Zoek instellingen';
$lang['signup_subtitle_profile'] = 'Mijn Profiel';
$lang['signup_success_message'] = '<b>dank je!</b><br /><br />&nbsp;Je bent nu een geregistreerd lid van SITENAME.';
$lang['signup_username'] = 'Member naam:';
$lang['signup_view_online'] = 'Mogen andere Member(s) zien wanneer ik online ben?';
$lang['signup_weight'] = 'Gewicht:';
$lang['signup_where_should_we_look'] = 'Waar zullen we zoeken?';
$lang['signup_year_old'] = 'jaar';
$lang['signup_zip'] = 'Postcode:';
$lang['sign_in'] = 'Member(s) Login';
$lang['sign_out'] = 'Uitloggen';
$lang['since'] = 'sinds';
$lang['sincelastlogin_hdr'] = 'Sinds laatste login';
$lang['since_last_login'] = 'sinds laatste login';
$lang['siteid'] = 'Site ID:';
$lang['sitestats'] = 'Site statistieken';
$lang['site_links'] = array(
'aboutus' => 'Over Ons',
'affliates' => 'Partner',
'articles' => 'Artikels',
'chat' => 'Chat',
'contactus' => 'Contact Opnemen',
'faq' => 'FAQ\'s',
'feedback' => 'Feedback',
'forgot' => 'Wachtwoord/Login vergeten?',
'forum' => 'Forum',
'home' => 'Home',
'invite_a_friend' => 'Vriend Uitnodigen',
'login' => 'Inloggen',
'privacy' => 'Privacy',
'search' => 'Zoeken',
'services' => 'Diensten',
'signup_now' => 'Nu Inschrijven',
'supreq' => 'Support Verzoek',
'terms_of_use' => 'Gebruiksovereenkomst',
        );
$lang['site_statistics'] = 'Site overzicht';
$lang['size'] = 'Grootte';
$lang['size_px'] = 'Grootte (px)';
$lang['snapapproved'] = array(
'html' => '<table border=0 cellpadding="0" cellspacing="0" width="570"><tr><td height="25" width="100%"><div class="module_head"><table border=0 cellspacing=0 cellpadding=0 width="100%"><tr>
<td width="77" height="25" ><div class="module_head">#email_hdr_left#</div>
</td><td width="493" ><div class="module_head">Uw foto is goedgekeurd </div></td></tr></table></div></td></tr><tr><td width="100%" class="module_head" colspan="2" >
<div class="module_head"><table border="0" cellspacing="0" cellpadding="5"><tr><td width="100%" valign="top" class="module_head">Beste #FirstName#,<br><br>Uw geuploade foto is goedgekeurd!<br><br>Dit zal absoluut tot meer resultaat op brengen van andere members<br><br>Good Luck!<br> #AdminName# <br>SITENAME<br></td></tr></table></div></td></tr><tr><td height="6" colspan="2" class="module_head"></td></tr></table> ',
'text' => 'Beste #FirstName#,

Uw geuploade foto is goedgekeurd!

Dit zal absoluut tot meer resultaat op brengen van andere members.

Veel geluk gewenst!
#AdminName#
SITENAME',
        );
$lang['snapapproved_sub'] = 'SITENAME Message: Uw foto is goedgekeurd';
$lang['snapload_msg'] = 'Laad enkel Hoofd foto. Om een specifieke thumbnail te laden, gebruik de thumbnail laadoptie.';
$lang['snaprejected'] = array(
'html' => '<table border=0 cellpadding="0" cellspacing="0" width="570"><tr><td height="25" width="100%"><div class="module_head"><table border=0 cellspacing=0 cellpadding=0 width="100%"><tr>
<td width="77" height="25" ><div class="module_head">#email_hdr_left#</div>
</td><td width="493" ><div class="module_head">Uw foto is geweigerd </div></td></tr></table></div></td></tr><tr><td width="100%" class="module_head" colspan="2" >
<div class="module_head"><table border="0" cellspacing="0" cellpadding="5"><tr><td width="100%" valign="top" class="module_head">Beste #FirstName#,<br><br>Uw opgeladen foto is door ons afgekeurd.<br><br>De mogelijke redennen hiervan is hieronder toegevoegd:<br><br>- Not a face photo<br>- Geen foto van uw zelf<br>- Een andere persoon is aanwezig op de foto<br>- Onderwerp op foto is niet toegestaan<br><br>Als u nog verdere vragen, kunt u contact opnemen met de site administrateur.<br><br>Good Luck!<br>#AdminName# <br>SITENAME<br></td></tr></table></div></td></tr><tr><td height="6" colspan="2" class="module_head"></td></tr></table> ',
'text' => 'Beste #FirstName#,

Uw opgeladen foto is afgekeurd.

De mogelijke redenen is hieronder toegevoegd:

* Geen gezicht op de foto
* Niet een foto van uw zelf
* Een andere persoon in de foto is aanwezig
* Onderwerp van foto is niet toegestaan

Als u nog verdere vragen, kunt u contact opnemen met de site administrateur .

Veel geluk!
#AdminName#
SITENAME',
        );
$lang['snaprejected_sub'] = 'SITENAME Message: Uw foto is geweigerd';
$lang['snaps_require_approval'] = 'Foto\'s Goedkeuren';
$lang['sort_by'] = 'Sorteren op';
$lang['sort_types'] = array(
'asc' => 'Oplopend',
'desc' => 'Aflopend',
        );
$lang['spammers'] = 'Spammers';
$lang['special_offer'] = 'Speciale Aanbieding!';
$lang['spell_check'] = 'Spelling Controleer';
$lang['split_file_names_hdr'] = 'Bestanden die nu worden geladen';
$lang['startdate'] = 'Begindatum:';
$lang['start_date'] = 'Start Datum';
$lang['start_new_search'] = 'Start een nieuwe zoektocht';
$lang['start_time'] = 'Start Tijd';
$lang['start_user_id'] = 'Aanvang van User-id ';
$lang['section_signup_title'] = 'Informatie inschrijving';
$lang['state'] = 'Provincie/Staat';
$lang['statefile'] = 'Provincie-/Staat code bestand';
$lang['states01'] = 'provincies/Staten';
$lang['states_count'] = 'Aantal provincies/Staten';
$lang['states_loaded'] = 'Provincie-/Staat codes geladen uit ';
$lang['states_sql_created'] = 'Provincie-/Staat code SQL bestand gemaakt ';
$lang['state_code'] = 'Provincie-/Staat code';
$lang['state_ensure'] = 'Gelieve eerst provincie/Staat code bestand naar /staten te verplaatsen. <br /><br />Het bestand moet STATECODE en STATENAME bevatten, gescheiden door Komma.(geen header)<br /><br /> Om staat codes voor  een land te verwijderen, selecteer het land en klik op "Verwijder Provincie/Staat codes"';
$lang['state_name'] = 'Provincie-/staat naam';
$lang['stats_gender_values'] = array(
'C' => 'Koppels',
'F' => 'Vrouwen',
'G' => 'Groepen',
'M' => 'Mannen',
        );
$lang['status_act'] = array(
'active' => 'Activeren',
'approval' => 'Wachtend',
'cancel' => 'Annuleren',
'rejected' => 'Weigeren',
'suspended' => 'Non actief',
        );
$lang['status_disp'] = array(
'active' => 'Actief',
'approval' => 'Wachtend',
'cancel' => 'Geannuleerd',
'rejected' => 'Geweigerd',
'suspended' => 'Geschorst',
        );
$lang['status_enum'] = array(
'active' => 'Actief',
'approval' => 'Wachtend',
'rejected' => 'Weigeren',
'suspended' => 'Non actief',
        );
$lang['story_error'] = array(
'1' => 'Verhaal header is een vereist veld.',
'2' => 'Verhaal tekst is een vereist veld.',
'3' => 'Verhaal datum is een vereist veld.',
'4' => 'Verhaal schrijver is een vereist veld.',
        );
$lang['story_sender'] = 'Verzender';
$lang['story_sender_msg'] = 'Profiel ID [Cijfer]';
$lang['subject'] = 'Onderwerp';
$lang['subject_colon'] = 'Onderwerp:';
$lang['subkey'] = 'Sub Key';
$lang['submit'] = 'Opslaan';
$lang['submitrating'] = 'Rating Versturen';
$lang['success_message'] = 'De ingevoerde informatie is succesvol opgeslagen.<br />Je wordt nu binnen vijf seconden automatisch doorverwezen naar het volgende onderdeel. Als het doorverwijzen mislukt, klik dan op de link hieronder.';
$lang['success_mship_change'] = 'Hartelijk bedankt voor het upgraden/vernieuwen van je lidmaatschap. <br /><br />Je lidmaatschap niveau is succesvol veranderd naar';
$lang['success_stories'] = 'Uw verhaal';
$lang['suggested_by'] = 'Voorgesteld door:';
$lang['suggest_poll'] = 'Stel een Poll   voor';
$lang['superuser'] = 'super gebruiker';
$lang['superuser_noteditable'] = 'Opmerking: super gebruikers kunnen niet Gewijzigdd worden.';
$lang['support_currency'] = array(
'AUD' => 'AU$',
'CD' => 'CAN$',
'EUR' => '&#8364;',
'INR' => 'Rs.',
'UKP' => '',
'USD' => '$',
        );
$lang['supreq'] = 'Support Verzoek';
$lang['supreq_email_to_admin'] = array(
'html' => '<table border=0 cellpadding="0" cellspacing="0" width="570"><tr><td height="25" width="100%"><div class="module_head"><table border=0 cellspacing=0 cellpadding=0 width="100%"><tr><td width="77" height="25"><div class="module_head">
#email_hdr_left#</div></td><td width="493"><div class="module_head">Feedback van member <div></td></tr></table></div></td></tr><tr><td width="100%" class="evenrow" colspan="2" ><div class="evenrow" >
<table border="0" cellspacing="0" cellpadding="5"><tr><td height="2"></td></tr>
<tr><td width="100%" valign="top" class="evenrow">Beste Site administrator,<br><br>U hebt zojuist ontvangen een ondersteunende verzoek van een gebruiker van uw site. De details zijn als volgt :<br><br><table cellspacing="4" cellpadding="2" border="0" width="100%"><tr><td width="20%"> Titel:</td><td width="80%">#txttitle# </td></tr><tr><td>Name:</td> <td>#txtname#</td></tr>
<tr><td>Email:</td><td>#txtemail#</td></tr><tr><td>Land:</td><td>#txtcountry#</td></tr><tr><td>Verzoek:</td><td>#txtcomments#</td></tr></table><br>Dank u wel,<br>#siteName# Daemon<br><br></td></tr></table></div></td></tr></table> ',
'text' => 'Beste Site administrator,

You have just received support Verzoek from a user of your site. The details are as follows:

Titel: #txttitle#
Naam: #txtname#
Email: #txtemail#
Land: #txtcountry#
Verzoek: #txtcomments#

Dank u wel,
#siteName# Daemon',
        );
$lang['supreq_thanks'] = 'Dank u voor uw ondersteuning verzoek. Uw Verzoek is doorgestuurd naar de Beheerder.';
$lang['taboptimize'] = 'Optimaliseer Lijsten';
$lang['taf_errormsgs'] = array(
'0' => 'De uitnodiging is verzonden.',
'2' => 'Vertel een Vriend brief template niet gevonden. Gelieve contact op te nemen met een bebeheerder.',
'3' => 'Er was een probleem met het verzenden van de uitnodiging. Gelieve contact op te nemen met een bebeheerder.',
'recipientemail_charset' => 'Geef a.u.b. een geldig e-mailadres voor de geadresseerde op.',
'recipientemail_noblank' => 'Gelieve het e-mailadres van de geadresseerde op te geven.',
'senderemail_charset' => 'Geef a.u.b. een geldig e-mailadres op.',
'senderemail_noblank' => 'Gelieve je e-mailadres op te geven.',
'sendername_charset' => 'Gelieve alleen letters te gebruiker voor je naam.',
'sendername_noblank' => 'Gelieve je naam op te geven.',
        );
$lang['taf_friendemail'] = 'E-mail vriend:';
$lang['taf_msg1'] = 'Nodig een vriend uit voor SITENAME';
$lang['taf_youremail'] = 'Jouw e-mail:';
$lang['taf_yourname'] = 'Jouw naam:';
$lang['take_poll_title'] = 'Neem Poll  ';
$lang['tellafriend'] = 'Vriend uitnodigen';
$lang['tell_later'] = 'Dat vertel ik je later';
$lang['template_instructions'] = 'De volgende voorbeeld variabelen zijn beschikbaar: <br />
[username], [firstname], [city], [state], [country], [age]<br /><br />Je kunt deze variabelen gebruiken om je berichten persoonlijker over te laten komen. Bijvoorbeeld:<br /><br />hoi [firstname]!<br /><br />Het is me opgevallen dat je uit [city] komt.... ik ook! :) Ik denk dat we een goeie match vormen... stuur me een e-mail als je meer over me wil weten.<br /><br />cheers,<br />Jamie';
$lang['template_intro'] = 'Als je regelmatig dezelfde berichten naar je potenti&euml;le matches stuurt, is het handig om voorbeelden te gebruiken om minder te hoeven typen. Door voorbeeld variabelen te gebruiken, zoals [username] en [firstname], kun je je voorbeelden persoonlijker laten overkomen.';
$lang['template_select'] = 'Gelieve een voorbeeld te selecteren';
$lang['text'] = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz \'/';
$lang['textbannerads_hdr'] = 'Als u de code van Google Adsense, of andere code voor een tekst gebaseerde banneradvertentie hebt, kunt u het in dit gebied kopi�ren. Boven 4 opties niet zal gebruikt worden als de tekst gebaseerde banneradvertentie wordt gegeven.';
$lang['thumbnail'] = 'Thumbnail';
$lang['timesaffiliates'] = 'Aantal keer op partners geklikt';
$lang['timesbanner'] = 'Aantal keer op banner geklikt';
$lang['timesfeedback'] = 'Aantal keer feedback gebruikt';
$lang['timesgallery'] = 'Aantal keer Fotogalerij gebruikt';
$lang['timeshowprofile'] = 'Aantal profiel pagina\'s opgevraagd';
$lang['timesim'] = 'Aantal keer IM gebruikt';
$lang['timesinvitefriend'] = 'Aantal keer Vriend Uitnodigen gebruikt';
$lang['timesmessage'] = 'Aantal berichten verzonden naar mailbox';
$lang['timesnewmember'] = 'Aantal keer op nieuwe Member(s)lijst geklikt';
$lang['timesnews'] = 'Aantal keer op Nieuws geklikt';
$lang['timesonlineusers'] = 'Aantal keer op Online Gebruikers geklikt';
$lang['timespoll'] = 'Aantal keer Poll   gebruikt';
$lang['timessearchmatch'] = 'Aantal keer gezocht naar match';
$lang['timessignup'] = 'Aantal keer op Inschrijven geklikt';
$lang['timesstories'] = 'Aantal keer op verhalen geklikt';
$lang['timessupreq'] = 'De vorm van de Ondersteuning vezoek van tijden werd gebruikt';
$lang['timeswink'] = 'Aantal knipogen verzonden';
$lang['timezone'] = 'Tijdzone:';
$lang['time_col'] = 'Tijd:';
$lang['time_nocol'] = 'Time';
$lang['title'] = 'Welkom bij SITENAME';
$lang['title_colon'] = 'Titel:';
$lang['tnail'] = 'Thumbnail';
$lang['to'] = ' tot ';
$lang['To1'] = 'Naar';
$lang['tools'] = 'Gereedschap';
$lang['Tool tip'] = 'Tool tip:';
$lang['tos_must'] = 'Gelieve de Gebruiksvoorwaarden te lezen alvorens te registreren';
$lang['total'] = 'Totaal';
$lang['totalactiveusers'] = 'Aantal Actieve Gebruikers';
$lang['totalcouples'] = 'Aantal Koppel Member(s):';
$lang['totalfemales'] = 'Totaal Aantal Vrouwelijke Member(s):';
$lang['totalgents'] = 'Totaal Aantal Mannelijke Member(s):';
$lang['totalonlineusers'] = 'Gebruikers Online';
$lang['totalpendingusers'] = 'Aantal Wachtende Gebruikers';
$lang['totalpictureusers'] = 'Gebruikers met foto\'s';
$lang['totalsuspendedusers'] = 'Aantal Non Actieve Gebruikers';
$lang['totalusers'] = 'Totaal Aantal Gebruikers';
$lang['total_admins'] = 'Total Aantal Bebeheerders';
$lang['total_affiliates'] = 'Totaal Aantal Partners';
$lang['total_amt'] = 'Totaal aantal';
$lang['total_articles'] = 'Total Aantal Artikels:';
$lang['total_banner'] = 'Totaal Aantal Banners:';
$lang['total_blogs_found'] = 'Totaal aantal blog post gevonden:';
$lang['total_calendars'] = 'Totaal Aantal Kalanders:';
$lang['total_events'] = 'selecteerde Gebeurtenissen';
$lang['total_events_found'] = 'Totaal Aantal Gebeurtenissen:';
$lang['total_exposures'] = 'Totaal Aantal Weergaven';
$lang['total_news'] = 'Totale Hoeveelheid Nieuws:';
$lang['total_options'] = 'Totaal Aantal Opties:';
$lang['total_polls'] = 'Total Aantal Poll  s';
$lang['total_profiles'] = 'Totaal Aantal Profielen';
$lang['total_profiles_found'] = 'Totaal Aantal Profielen:';
$lang['total_questions'] = 'Totaal Aantal Vragen:';
$lang['total_ratings'] = 'Totaal Aantal Beoordelingen';
$lang['total_referrals'] = 'Totaal Aantal Verwijzingen';
$lang['total_sections'] = 'Totaal Aantal Onderdelen:';
$lang['total_stories'] = 'Total Aantal Verhalen:';
$lang['to_edit_search_preferences'] = 'om zoek voorkeuren te wijzigen';
$lang['tpromo'] = 'Totaal promoties';
$lang['transactions_report'] = 'Betaling transactie rapport';
$lang['trans_count'] = 'Aantal Transacties';
$lang['trans_key'] = 'Transactie sleutel:';
$lang['trans_method'] = 'Transactie methode:';
$lang['trans_method_vals'] = array(
'CC' => 'Creditcard',
	'ECHECK' => 'Elektronische Controle'
        );
$lang['trans_mode'] = 'Transactie modus:';
$lang['trans_mode_vals'] = array(
'AUTH_CAPTURE' => 'AUTH_CAPTURE',
'AUTH_ONLY' => 'AUTH_ONLY',
'CAPTURE_ONLY' => 'CAPTURE_ONLY',
'CREDIT' => 'CREDIT',
'PRIOR_AUTH_CAPTURE' => 'PRIOR_AUTH_CAPTURE',
'VOID' => 'VOID',
        );
$lang['trans_rep'] = 'Betalingen rapport';
$lang['trashcan'] = 'Prullenbak';
$lang['tz'] = array(
'-1.00' => '(GMT -1:00 hour) Azores, Cape Verde Islands',
'-10.00' => '(GMT -10:00) Hawaii',
'-11.00' => '(GMT -11:00) Midway Island, Samoa',
'-12.00' => '(GMT -12:00) Eniwetok, Kwajalein',
'-2.00' => '(GMT -2:00) Mid-Atlantic',
'-25' => '-- Selecteer --',
'-3.00' => '(GMT -3:00) Brazil, Buenos Aires, Georgetown',
'-3.5' => '(GMT -3:30) Newfoundland',
'-4.00' => '(GMT -4:00) Atlantic Time (Canada), Caracas, La Paz',
'-5.00' => '(GMT -5:00) Eastern Time (US & Canada), Bogota, Lima',
'-6.00' => '(GMT -6:00) Central Time (US & Canada), Mexico City',
'-7.00' => '(GMT -7:00) Mountain Time (US & Canada)',
'-8.00' => '(GMT -8:00) Pacific Time (US & Canada)',
'-9.00' => '(GMT -9:00) Alaska',
'0.00' => '(GMT) Western Europe Time, London, Lisbon, Casablanca',
'1.00' => '(GMT +1:00 hour) Brussels, Copenhagen, Madrid, Paris',
'10.00' => '(GMT +10:00) Eastern Australia, Guam, Vladivostok',
'11.00' => '(GMT +11:00) Magadan, Solomon Islands, New Caledonia',
'12.00' => '(GMT +12:00) Auckland, Wellington, Fiji, Kamchatka',
'13.00' => '(GMT + 13)',
'2.00' => '(GMT +2:00) Kaliningrad, South Africa',
'3.00' => '(GMT +3:00) Baghdad, Riyadh, Moscow, St. Petersburg',
'3.5' => '(GMT +3:30) Tehran',
'4' => '(GMT +4:00) Abu Dhabi, Muscat, Baku, Tbilisi',
'4.5' => '(GMT +4:30) Kabul',
'5.00' => '(GMT +5:00) Ekaterinburg, Islamabad, Karachi, Tashkent',
'5.5' => '(GMT +5:30) Bombay, Calcutta, Madras, New Delhi',
'6.00' => '(GMT +6:00) Almaty, Dhaka, Colombo',
'6.5' => 'GMT + 6.30) ',
'7.00' => '(GMT +7:00) Bangkok, Hanoi, Jakarta',
'8.00' => '(GMT +8:00) Beijing, Perth, Singapore, Hong Kong',
'9' => '(GMT +9:00) Tokyo, Seoul, Osaka, Sapporo, Yakutsk',
'9.5' => '(GMT +9:30) Adelaide, Darwin',
        );
$lang['unapproved_user'] = 'Te Bevestigen Profielen';
$lang['undefined_quantity'] = 'Onbekende Hoeveelheid:';
$lang['undelete'] = 'Terugzetten';
$lang['unflag'] = 'Niet markeren';
$lang['unflagged_msg1'] = 'Ongemarkeerde berichten van meer dan ';
$lang['unflagged_msg2'] = ' dagen oud worden automatisch verwijderd.';
$lang['uninstall'] = 'Verwijderen';
$lang['unknown'] = 'Onbekend';
$lang['unread'] = 'Ongelezen';
$lang['un_flagged'] = 'Ongemarkeerd';
$lang['up'] = 'Naar Boven';
$lang['upgrade_member(s)hip'] = 'Lidmaatschap Veranderen';
$lang['upload'] = 'Opladen';
$lang['upload_image'] = 'Plaatje Uploaden';
$lang['upload_pictures'] = 'Foto\'s Beheren';
$lang['upload_picture_caption'] = 'Hoofd foto ';
$lang['upload_profilepics'] = 'Beheer foto\'s van Profiel ';
$lang['upload_successful'] = 'Foto\'s zijn Opgeladen.';
$lang['upload_thumbnail_caption'] = 'Thumbnail ';
$lang['upload_unsuccessful'] = 'Foto kon niet worden Opgeladen.';
$lang['upload_videos'] = 'Video\'s uploaden';
$lang['upload_videos_ext'] = 'flv, swf';
$lang['upload_video_caption'] = 'Opladen Video<br /><br />Alleen het file formaat flv of swf';
$lang['userdetails'] = 'Gebruiker informatie';
$lang['username'] = 'Member naam:';
$lang['username_hdr'] = 'Member naam';
$lang['username_part_msg'] = 'Als je niet zeker bent van de Member naam, type dan een deel van de Member naam om alle mogelijke matches weer te geven. Bijvoorbeeld, het invoeren van \'gebruiker\' zal \'gebruiker123\', \'eengebruiker\', etc. weergeven.';
$lang['username_without_colon'] = 'Member naam';
$lang['useronlinecolor'] = array(
'active_1month' => '#000000',
'active_1week' => '#0000AA',
'active_24hours' => '#00AA00',
'active_3days' => '#AA00A0',
'notactive' => '#838383',
'online_now' => '#FF0000',
        );
$lang['useronlinetext'] = array(
'active_1month' => 'Actief de afgelopen Maand',
'active_1week' => 'Actief de afgelopen Week',
'active_24hours' => 'Actief afgelopen 24 uren',
'active_3days' => 'Actief afgelopen 3 dagen',
'notactive' => 'Niet actief',
'online_now' => 'Nu Online',
        );
$lang['usersinpast10years'] = 'Member(s) afgelopen 10 jaar';
$lang['usersinpast2years'] = 'Member(s) afgelopen 2 jaar';
$lang['usersinpast5years'] = 'Member(s) afgelopen 5 jaar';
$lang['usersinpastday'] = 'Member(s) vandaag';
$lang['usersinpasthour'] = 'Member(s) afgelopen uur';
$lang['usersinpastminute'] = 'Member(s) afgelopen minuut';
$lang['usersinpastmonth'] = 'Member(s) afgelopen maand';
$lang['usersinpastweek'] = 'Member(s) afgelopen week';
$lang['usersinpastyear'] = 'Member(s) afgelopen jaar';
$lang['userstats'] = 'Member(s) statistieken:';
$lang['users_match_your_search'] = 'Member(s) die overeen komen met je zoek criteria';
$lang['user_added1'] = 'Member(s)';
$lang['user_added2'] = ' toegevoegd aan Priv&eacute; lijst';
$lang['user_banned'] = 'Deze Member(s) heeft u verboden of u hebt deze Member verboden';
$lang['user_choices'] = array(
'allow_buddy_view_album' => 'Sta mensen in mijn Vrienden lijst toe mijn privé albums te bekijken.',
'allow_hotlist_view_album' => 'Sta mensen in mijn hot list toe privé albums te bekijken.',
'email_ban_list' => 'Verstuur e-mail als iemand me toevoegt aan zijn Geblokkeerden lijst.',
'email_blog_commented' => 'Verstuur e-mail als iemand commentaar in m\\\'n blog post.',
'email_buddy_list' => 'Verstuur e-mail als iemand me toevoegt aan zijn Vrienden lijst.',
'email_hot_list' => 'Verstuur e-mail als iemand me toevoegt aan zijn hot list.',
'email_match_mail_days' => 'Tijd in dagen om \\\'mijn matches\\\' e-mails te versturen. Geef 0 (nul) op om deze e-mails niet te ontvangen.',
'email_message_read' => 'Verstuur e-mail als ontvanger van mijn bericht bericht heeft gelezen.',
'email_message_received' => 'Verstuur e-mail bij ontvangen nieuw bericht.',
'email_mship_expiry' => 'Stuur herinnering mails bij aflopen lidmaatschap.',
'email_wink_received' => 'Verstuur e-mail als iemand naar me knipoogt.',
        );

$lang['advpluginsettings'] = 'De geavanceerde Opties van de Configuratie';
$lang['control_type'] = 'Controle scherm:';
$lang['plugins_hlp'] = 'Administratieve plugins zijn bruikbaar slechts door admins en moderatoren met voldoende admintoestemmingen, en verschijnen automatisch bij de bodem van het linkeradminmenu wanneer geactiveerd. Het lid plugins kan van het lidpaneel worden betreden';
$lang['user_comments'] = 'Profiel Commentaren';
$lang['user_lists'] = 'Mappen';
$lang['user_stats'] = 'Uw Statistieken';
$lang['use_empty_form'] = 'met een leeg formulier.';
$lang['use_seo_username'] = 'Profiel Member naam gebruiken als parameter in de URL?<br /> Het aanzetten van deze optie geeft URLs het formaat "domein/Member naam". Uitzetten resulteert in URLs in het formaat "domein/id.htm"';
$lang['vds'] = 'Vds';
$lang['video'] = 'Video';
$lang['videoapproved'] = array(
'html' => '<table border=0 cellpadding="0" cellspacing="0" width="570"><tr><td height="25" width="100%"><div class="module_head"><table border=0 cellspacing=0 cellpadding=0 width="100%"><tr>
<td width="77" height="25" ><div class="module_head">#email_hdr_left#</div>
</td><td width="493" ><div class="module_head">Uw video is door ons goed gekeurd </div></td></tr></table></div></td></tr><tr><td width="100%" class="module_head" colspan="2" >
<div class="module_head"><table border="0" cellspacing="0" cellpadding="5"><tr><td width="100%" valign="top" class="module_head">Beste #FirstName#,<br><br>Uw opgeladen video is door ons goed gekeurd!<br><br>Dit betekent een verder dat uw profiel zichtbaarheid tot veel meer potentiële contacten zal leiden .<br><br>Veel geluk gewenst!<br> #AdminName# <br>SITENAME<br></td></tr></table></div></td></tr><tr><td height="6" colspan="2" class="module_head"></td></tr></table> ',
'text' => 'Dear #FirstName#,

Uw video is door ons goed gekeurd!

Dit betekent een verder dat uw profiel zichtbaarheid tot veel meer potentiële contacten zal leiden.

Veel geluk gewenst!
#AdminName#
SITENAME',
        );
$lang['videoapproved_sub'] = 'SITENAME Bericht: Uw video is door ons goed gekeurd';
$lang['videogallery'] = 'Mijn Video galerij';
$lang['videorejected'] = array(
'html' => '<table border=0 cellpadding="0" cellspacing="0" width="570"><tr><td height="25" width="100%"><div class="module_head"><table border=0 cellspacing=0 cellpadding=0 width="100%"><tr>
<td width="77" height="25" ><div class="module_head">#email_hdr_left#</div>
</td><td width="493" ><div class="module_head">Uw video is uitgeschakeld </div></td></tr></table></div></td></tr><tr><td width="100%" class="module_head" colspan="2" >
<div class="module_head"><table border="0" cellspacing="0" cellpadding="5"><tr><td width="100%" valign="top" class="module_head">Dear #FirstName#,<br><br>Your uploaded video has been declined.<br><br>Possible reasons for this include:<br><br>- Not according to standards<br>- Not a videoo about yourself (when comparing to photos you have loaded)<br>- Content not appropriate<br><br>If you have further questions, please contact the site administrator.<br><br>Good Luck!<br>#AdminName# <br>SITENAME<br></td></tr></table></div></td></tr><tr><td height="6" colspan="2" class="module_head"></td></tr></table> ',
'text' => 'Beste #FirstName#,

Uw video is door ons afgekeurd.

De mogelijke redenen hebben wij hieronder toegevoegd:

- niet volgens onze normen
- Niet een video over uzelf (bij het vergelijken met foto\'s u hebben geladen) 
- Inhoud niet passend 

Als u nog verdere vragen, kunt u contact opnemen met de site administrateur.

Veel geluk!
#AdminName#
SITENAME',
        );
$lang['videorejected_sub'] = 'SITENAME Message: Uw video is uitgeschakeld';
$lang['videos_loaded'] = 'Video\'s geladen';
$lang['videos_require_approval'] = 'Keur Video\'s goed';
$lang['videoupload_format_msgs'] = 'Alleen .swf en .flv bestanden zijn toegestaan.';
$lang['video_file'] = 'video bestand';
$lang['video_gallery'] = 'Video galerij';
$lang['video_upload_help'] = 'U kunt bijna alle video formaten uploaden. Gelieve te gebruiken de Browse knop om het te laden file te selecteren. Als u youtube video verwijzing hebt wilt u hier verbinden, kunt u dit doen. Gelieve te geven YouTube verwijzing (b.v. in de youtube video link <b>http://www.youtube.com/watch?v=zkTn5Ef1Oig&feature=dir</b> verwijzing referentie is <b>zkTn5Ef1Oig</b>) van de youtube video.';
$lang['view'] = 'View';

$lang['views'] = 'Keer Bekeken';
$lang['viewslist'] = 'Bekeken Lijst';
$lang['view_all_pics'] = 'Bekijk alle foto\'s';
$lang['view_blog'] = 'Bekijk Blog';
$lang['view_day'] = 'Dag weergave';
$lang['view_month'] = 'Maand weergave';
$lang['view_poll_archive'] = 'Vorige Polls';
$lang['view_profile'] = 'Uw Profiel';
$lang['view_profile_errmsg1'] = 'Je hebt nog geen voorkeuren opgegeven.<br />Geef a.u.b. eerst Profiel details op.<br />';
$lang['view_profile_errmsg2'] = '<br />Klik hier om je voorkeuren nu op te geven.';
$lang['view_profile_errmsg3'] = 'De gebruiker heeft nog geen Profiel details opgegeven.';
$lang['view_profile_restricted'] = 'Je mag dit beperkte profiel niet bekijken.';
$lang['view_type'] = 'Weergave';
$lang['view_week'] = 'Week weergave';
$lang['view_winkslist'] = 'Bekijk knipogen';
$lang['visitorstats'] = 'Bezoeker statistieken';
$lang['visitorstosite'] = 'Bezoekers op site';
$lang['votes'] = 'Stem(men)';
$lang['watchedprofiles'] = 'Bekeken Profielen';
$lang['watchedprofiles_1'] = 'Toevoegen aan Bekeken Profielen';
$lang['watched_events'] = 'Kalander gebeurtenissen';
$lang['weekcnt'] = 'Member(s) Vorige Week:';
$lang['weeksnaps'] = 'Foto\'s Vorige Week:';
$lang['welcome'] = 'Welkom';
$lang['welcome_to'] = 'Welkom bij ';
$lang['welcome_to_site'] = 'Welkom bij SITENAME';
$lang['who_is_from'] = 'vanaf';
$lang['who_is_online'] = 'Alleen online Member(s)';
$lang['winks'] = 'Knipoog versturen';
$lang['winkslist'] = 'Knipogen lijst';
$lang['winks_received'] = 'Aantal knipogen ontvangen:';
$lang['wink_received'] = array(
'html' => '<table border=0 cellpadding="0" cellspacing="0" width="570"><tr><td height="25" width="100%"><div class="module_head"><table border=0 cellspacing=0 cellpadding=0 width="100%"><tr><td width="77" height="25px">#email_hdr_left#</td><td width="493" height="25" ><div class="module_head">&nbsp;&nbsp;Hoi #ReceiverName#, #SenderName# heeft net naar je geknipoogd!</div>
</td></tr></table></div></td></tr><tr><td width="570" class="evenrow" colspan="2" ><div class="evenrow" ><table border="0" cellspacing="2" cellpadding="5"><tr><td height="2"></td></tr><tr><td width="50%" valign="top">#smallProfile#</td><td width="50%" valign="top">Van de vele Member(s), heeft #SenderName# jou uitgekozen om naar te knipogen! Je kunt doorgaan met flirten door terug te knipogen, of door een e-mail te sturen.<br><br><a href="#SiteUrl#compose.php?recipient=#UserId#">E-mail #SenderName# nu</a><br><br><a href="#SiteUrl#sendwinks.php?ref_id=#UserId#&amp;rtnurl=showprofile.php">Terugknipogen</a><br>
<br><b>Niet Geinteresseerd?</b><br>Geef #SenderName# te kennen dat je niet bent geinteresseerd door een "Nee, bedankt" bericht te versturen.<br><br><a href="#SiteUrl#compose.php?recipient=#UserId#&amp;reply=11">Zeg "Nee, bedankt"</a><br><br></td></tr></table></div></td></tr><tr><td height="6" colspan="2" class="evenrow"></td></tr></table> ',
'text' => 'Beste #FirstName# ( #ReceiverName# ),

You have received a wink from #siteName# user \'#SenderName#\'.

Please visit <a href="#link#">#siteName#</a> to send \'#SenderName#\' Een bericht, of het terug zenden van een Wink .

Veel geluk gewenst!
#AdminName#
SITENAME',
        );
$lang['with_photo'] = 'met een foto';
$lang['with_selected'] = 'Met Selectie';
$lang['worst'] = 'Slechts';
$lang['worst1'] = '(slechtste)';
$lang['write_new_msg'] = 'Schrijf een nieuw bericht';
$lang['writing_message'] = 'Bericht schrijven voor ';
$lang['wrong_activationcode'] = 'De opgegeven Veiligheid code Ongeldige karakters op het gebied van de gebruiker benaming is niet correct, of de account is al geactiveerd.';
$lang['wrong_zipfile'] = 'Dit bestand is niet voor het land #COUNTRY#';
$lang['years'] = 'jaar';
$lang['yearsold'] = 'jaar oud';
$lang['yes'] = 'Ja';
$lang['yes_msg'] = 'URL rewriting is een feature die enkel beschikbaar is als onderdeel van de Apache web server, met the mod_rewrite extensie ingeschakeld. Zorg er a.u.b. voor dat je server aan deze vereisten voldoet. Vergeet ook niet het .htaccess.txt te hernoemen naar .htaccess.';
$lang['your_comment'] = 'Jouw Commentaar';
$lang['your_lookgender'] = 'Member(s) van jou Geslacht voorkeur';
$lang['your_reply'] = 'Jouw Antwoord';
$lang['your_search_preferences'] = 'Je huidige zoek voorkeuren:';
$lang['your_user_stats'] = 'Algemene statistieken en overeenkomsten';
$lang['you_currently'] = 'Je bent nu een ';
$lang['ytref'] = 'YouTube verwijzing :';
$lang['y_o'] = 'y/o';
$lang['zipcodes_loaded'] = 'Postcodes geladen uit ';
$lang['zipcodes_sql_created'] = 'Postcode SQL bestand gemaakt ';
$lang['zipfile'] = 'Postcodes Directory';
$lang['zips01'] = 'Zip Codes';
$lang['zips_count'] = 'Aantal Postcodes';
$lang['zip_code'] = 'Postcode';
$lang['zip_ensure'] = 'Gelieve het postcode bestand in de directory /zipcodes/Land naam te plaatsen alvorens verder te gaan. Verdeel grote bestanden in kleinere met /admin/split_zipcodes_file.php. <br /><br />Het bestand moet het volgende bevatten (in deze volgorde): ZIPCODE, LATITUDE, LONGITUDE, STATECODE, COUNTYCODE, CITYCODE (STATECODE, COUNTYCODE en CITYCODE kunnen weggelaten worden en later worden toegevoegd) gescheiden door Komma.<br /><br /><b>Alvorens de postcodes te laden, verwijder het oude bestand voor dat land om dubbele data te voorkomen.</b><br /><br />Om postcodes voor een land te verwijderen, selecteer dat land en druk op Verwijderen';
$lang['zip_loaded'] = 'Postcodes zijn geladen uit dit bestand ';
$lang['zip_load_over'] = 'Laden van postcodes voor #COUNTRY# is voltooid.';
$lang['blog_search_Date'] = 'Datum';

$lang['sections'] = array(
'1' => 'Basisinformatie',
'2' => 'Uiterlijk',
'3' => 'Werk',
'4' => 'Levensstijl',
'5' => 'Interesses',
        );
$lang['upload_format_msgs'] = 'Alleen .jpg, .gif en .png bestanden zijn toegestaan.';
$lang['verboden'] = 'HET IS ABSOLUUT VERBODEN OM JE TE REGISTEREN DAT WANNEER JE ONDER DE 18+ BENT.<br /><br />Wij verzoeken je dan nu ook om EroKiss te verlaten en opzoek te gaan naar 1 van onze andere dating mogelijkheden die wij aanbieden.';
?>