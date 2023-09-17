<?php
// The format of this file is ---> $lang['message'] = 'text';
//
// You should also try to set a locale and a character encoding (plus direction). The encoding and direction
// will be sent to the template. The locale may or may not work, it's dependent on OS support and the syntax
// varies ... give it your best guess!
//

$lang['ENCODING'] = 'utf-8';
$lang['DIRECTION'] = 'ltr';
$lang['LEFT'] = 'left';
$lang['RIGHT'] = 'right';
$lang['DATE_FORMAT'] =  '%b %d, %Y'; // This should be changed to the default date format for your language, php date() format
$lang['DATE_TIME_FORMAT'] =  '%b %d, %Y %I:%M:%S %P'; // This should be changed to the default date format for your language, php date() format
$lang['DISPLAY_DATE_FORMAT'] =  'M d, Y';
$lang['DISPLAY_DATETIME_FORMAT'] = 'D M-d-Y H:i:s';
$lang['DB_ERROR'] = "Ïðîñòèòå, Âàø çàïðîñ íå ìîæåò áûòü îáðàáîòàí èç-çà îøèáêè â áàçå äàííûõ.<br>Ïîæàëóéñòà, ïîïðîáóéòå ñíîâà.";

$lang['main_menu'] = 'Ãëàâíîå ìåíþ';
$lang['homepage'] = 'Íà÷àëî';
$lang['rate_photos'] = 'Îöåíèòü ôîòîãðàôèè';
$lang['forum'] = 'Ôîðóì';
$lang['manageforum'] = 'Óïðàâëåíèå ôîðóìîì';
$lang['chat'] = '×àò';
$lang['managechat'] = 'Óïðàâëåíèå ÷àòîì';
$lang['member_login'] = 'Âîéòè';
$lang['featured_members'] = 'Ðåêîìåíäóåìûå ïîëüçîâàòåëè';
$lang['quick_search'] = 'Áûñòðûé ïîèñê';
$lang['my_searches'] = 'Ìîé ïîèñê';
$lang['affiliates'] = 'Ïàðòíåðû';
$lang['already_affiliate'] = 'Óæå ïàðòíåð?';
$lang['referals'] = 'Ññûëêè';
$lang['title_colon'] = 'Çàãîëîâîê:';
$lang['comments_colon'] = 'Êîììåíòàðèè:';
$lang['feedback'] = 'Îáðàòíàÿ ñâÿçü';

$lang['profiles'] = 'Àíêåòû';
$lang['profile_s'] = ', àíêåòà';
$lang['total_amt'] = 'Îáùåå êîëè÷åñòâî';
$lang['banner_link'] = 'Áàííåð/ññûëêà';
$lang['clicks'] = 'Êëèêè';
$lang['finance_calc'] = 'Ôèíàíñîâûé êàëüêóëÿòîð';
$lang['flash_chat_msg'] = 'FlashChat âåðñèè 4.1.0 è âûøå âêëþ÷àåò ìîäóëü èíòåãðàöèè ñ osDate.';
$lang['flash_chat_admin_msg'] = 'FlashChat 4.1.0 è âûøå âêëþ÷àåò ìîäóëü èíòåãðàöèè ñ osDate.';
$lang['affiliate_head_msg'] = 'Ñòàíüòå ïàðòíåðîì';
$lang['affiliate_head_msg2'] = 'Ìû ïðåäëàãàåì êîìèññèîííûå âåá-ìàñòåðàì, êîòîðûå áóäóò ïðèâîäèòü ïîñåòèòåëåé íà íàø ñàéò.<br/>';
$lang['affiliate_success_msg1'] = 'ID âàøåãî ïàðòíåðñêîãî ñ÷åòà:';
$lang['affiliate_success_msg2'] = 'Òåïåðü Âû ìîæåòå çàéòè â Âàø ïàðòíåðñêèé àêàóíò.';
$lang['affiliate_login_title'] = "Âõîä äëÿ ïàðòíåðîâ";
$lang['password_changed_successfully'] = 'Ïàðîëü óñïåøíî èçìåíåí.';
$lang['affiliate_registration_success'] = 'Ïàðòíåð óñïåøíî çàðåãèñòðèðîâàí';
$lang['login_now'] = 'Âîéòè ñåé÷àñ';
$lang['must_be_valid'] = 'Äîëæåí áûòü ïðàâèëüíûì';
$lang['characters'] = 'ñèìâîëîâ';
$lang['email'] = 'E-mail:';
$lang['age'] = 'Âîçðàñò';
$lang['years'] = 'ëåò';

$lang['all_states'] = 'Âñå îáëàñòè/øòàòû';
//
// These terms are used at Signup page
//
$lang['welcome'] = 'Äîáðî ïîæàëîâàòü';
$lang['admin_welcome'] = 'Äîáðî ïîæàëîâàòü <br /> íà <br /> Ïàíåëü Àäìèíèñòðàòîðà ñàéòà <br /> ' . stripslashes('SITENAME');
$lang['title'] = 'Äîáðî ïîæàëîâàòü íà ' . 'SITENAME';
$lang['site_links'] = array(
  'home' => 'Ãëàâíàÿ',
  'signup_now' => 'Çàðåãèñòðèðîâàòüñÿ',
  'chat' => '×àò',
  'forum' => 'Ôîðóì',
  'login' => 'Âîéòè',
  'search' => 'Ïîèñê',
  'aboutus' => 'Î íàñ',
  'forgot' => 'Çàáûëè ïàðîëü/ëîãèí?',
  'contactus' => 'Íàøè êîíòàêòû',
  'privacy' => 'Êîíôèäåíöèàëüíîñòü',
  'terms_of_use' => 'Ïðàâèëà ïîëüçîâàíèÿ',
  'services' => 'Óñëóãè',
  'faq' => '×àÂÎ',
  'articles' => 'Ñòàòüè',
  'affliates' => 'Ïàðòíåðû',
  'invite_a_friend' => 'Ïðèãëàñèòü äðóãà',
  'feedback' => 'Îòçûâ'
  );

$lang['success_stories'] = 'Èñòîðèè óñïåõà';
$lang['members_login'] = 'Âîéòè';
$lang['poll'] = 'Îïðîñ';
$lang['news'] = 'Íîâîñòè';
$lang['articles'] = 'Ñòàòüè';
$lang['poll_result'] = 'Ðåçóëüòàòû îïðîñà';
$lang['view_poll_archive'] = 'Ïðåäûäóùèå îïðîñû';
$lang['member_panel'] = 'Ïàíåëü ïîëüçîâàòåëÿ';
$lang['poll_errmsg1'] = 'Âû óæå ãîëîñîâàëè â ýòîì îïðîñå. Ïîïðîáóéòå ïðîãîëîñîâàòü â äðóãîì îïðîñå â èíîé äåíü.';
$lang['close'] = 'Çàêðûòü';
$lang['all_stories'] = 'Âñå èñòîðèè';
$lang['all_news'] = 'Âñå íîâîñòè';
$lang['more'] = 'äàëüøå';
$lang['by'] = 'àâòîð';

$lang['dont_stay_alone'] = 'Íå áóäü îäèí,';
$lang['join_now_for_free'] = 'ïðèñîåäèíèñü ñåé÷àñ, áåñïëàòíî!';
$lang['special_offer'] = 'Ñïåöèàëüíîå ïðåäëîæåíèå!';
$lang['welcome_to'] = 'Äîáðî ïîæàëîâàòü íà ';
$lang['welcome_to_site'] = 'Äîáðî ïîæàëîâàòü íà '.'SITENAME';

$lang['offer_text'] = 'Óçíàé - ïî÷åìó ' . 'SITENAME' . ' - ñàìûé áûñòðîðàñòóùèé ñàéò çíàêîìñòâ â ñåòè. Îòêðîé àíêåòó íà ' . 'SITENAME' . ' è òû áûñòðî ïîëó÷èøü îáúåêòèâíûé îòçûâ íà íåå è íà òâîå îòíîøåíèå ê äðóãèì ëþäÿì. Ñ àíêåòû íà ' . 'SITENAME' . ' íà÷èíàåòñÿ âäîõíîâëÿþùåå ïóòåøåñòâèå íà ïóòè ïîèñêà Âàøåé íàñòîÿùåé ëþáâè!';

$lang['newest_profiles'] = 'Íîâûå àíêåòû';

$lang['edit_profile'] = 'Èçìåíèòü àíêåòó';
$lang['total_profiles'] = 'Âñåãî ïîëüçîâàòåëåé';
$lang['forgot'] = 'Ïîòåðÿëè ïàðîëü?';
$lang['hide'] = 'Ñêðûòü';
$lang['show'] = 'Ïîêàçàòü';
$lang['sex'] = 'Ïîë:';
$lang['sex_without_colon'] = 'Ïîë';
$lang['pageno'] = 'Ñòðàíèöà ';
$lang['page'] = 'Ñòðàíèöà';
$lang['previous'] = 'Ïðåäûäóùèå';
$lang['next'] = 'Ñëåäóþùèå';
$lang['time_col'] = 'Âðåìÿ:';

$lang['save_search'] = 'Ñîõðàíèòü íàéäåííîå';
$lang['find_your_match'] = 'Íàéäè ñâîþ ïîëîâèíó';

$lang['extended_search'] = 'Ðàñøèðåííûé ïîèñê';
$lang['matches_found'] = 'Ïî âàøåìó çàïðîñó íàéäåíî';
$lang['timezone'] = '×àñîâîé ïîÿñ:';
$lang['next_section'] = 'Ñëåäóþùàÿ ñåêöèÿ';
$lang['sign_in'] = 'Âõîä';
$lang['member_panel'] = 'Ïàíåëü ïîëüçîâàòåëÿ';
$lang['aff_panel'] = 'Ïàíåëü ïàðòíåðà';
$lang['login_title'] = 'Çîíà ïîëüçîâàòåëüñêîãî âõîäà';
$lang['sign_out'] = 'Âûéòè';
$lang['login_submit'] = 'Âîéòè';

$lang['change_password'] = 'Èçìåíåíèå ïàðîëÿ';
$lang['old_password'] = 'Ñòàðûé ïàðîëü:';
$lang['new_password'] = 'Íîâûé ïàðîëü:';
$lang['confirm_password'] = 'Ïîäòâåðæäåíèå ïàðîëÿ:';
$lang['password_change_msg'] = 'Âàø ïàðîëü áûë óñïåøíî èçìåíåí.';

$lang['section_signup_title'] = 'Äëÿ ðåãèñòðàöèè';
$lang['signup'] = 'Ðåãèñòðàöèÿ';
$lang['section_basic_title'] = 'Íà÷àëüíûå äàííûå';
$lang['section_appearance_title'] = 'Âíåøíîñòü';
$lang['section_interests_title'] = 'Èíòåðåñû';
$lang['section_lifestyle_title'] = 'Îáðàç æèçíè';

$lang['signup_subtitle_login'] = 'Äëÿ âõîäà íà ñàéò';
$lang['signup_subtitle_profile'] = 'Àíêåòíûå äàííûå';
$lang['signup_subtitle_address'] = 'Àäðåñ';
$lang['signup_subtitle_appearacnce'] = 'Âíåøíîñòü';
$lang['signup_subtitle_preference'] = 'Íàñòðîéêè ïîèñêà';

$lang['signup_username'] = 'Èìÿ ïîëüçîâàòåëÿ:';
$lang['signup_password'] = 'Ïàðîëü:';
$lang['signup_confirm_password'] = 'Ïîäòâåðæäåíèå ïàðîëÿ:';

$lang['signup_firstname'] = 'Èìÿ:';
$lang['signup_lastname'] = 'Ôàìèëèÿ:';
$lang['signup_email'] = 'E-mail àäðåñ:';
$lang['section_mypicture'] = 'Ìîè ôîòîãðàôèè';
$lang['upload'] = 'Çàãðóçèòü';
$lang['upload_pictures'] = 'Çàãðóçèòü ôîòîãðàôèè';
$lang['upload_format_msgs'] = 'Äîïóñêàþòñÿ òîëüêî ôàéëû ôîðìàòîâ .jpg, .gif, .bmp èëè .png.';
$lang['thumbnail'] = 'Óìåíüøåííàÿ ôîòîãðàôèÿ';
$lang['picture'] = 'Ôîòîãðàôèÿ';
$lang['signup_picture'] = 'Ìîÿ ôîòîãðàôèÿ';
$lang['signup_picture2'] = 'Ìîÿ ôîòîãðàôèÿ:';
$lang['signup_picture3'] = 'Ìîÿ ôîòîãðàôèÿ:';
$lang['signup_picture4'] = 'Ìîÿ ôîòîãðàôèÿ:';
$lang['signup_picture5'] = 'Ìîÿ ôîòîãðàôèÿ:';

$lang['signup_gender'] = 'ß ';
$lang['signup_pref_age_range'] = 'Â âîçðàñòå';
$lang['signup_year_old'] = 'ëåò';
$lang['signup_birthday'] = 'Äàòà ðîæäåíèÿ:';
$lang['signup_country'] = 'Ñòðàíà:';
$lang['signup_state_province'] = 'Îáëàñòü/øòàò:';
$lang['signup_zip'] = 'Ïî÷òîâûé èíäåêñ:';
$lang['signup_city'] = 'Ãîðîä / Ìåñòíîñòü: ';
$lang['signup_address1'] = 'Àäðåñ, ñòðîêà 1:';
$lang['signup_address2'] = 'Àäðåñ, ñòðîêà 2:';
$lang['signup_height'] = 'Ðîñò: ';
$lang['signup_feet'] = 'ôóòîâ';
$lang['signup_meter_inches'] = 'äþéìîâ [ ìåòðû - åñëè çà ïðåäåëàìè ÑØÀ ]';
$lang['signup_weight'] = 'Âåñ:';
$lang['signup_pounds'] = 'ôóíòîâ [ êã - åñëè çà ïðåäåëàìè ÑØÀ ]';
$lang['signup_where_should_we_look'] = 'Ãäå èñêàòü?';
$lang['signup_view_online'] = "Ïîêàçûâàòü, ÷òî ÿ îíëàéí?";

$lang['signup_gender_values'] = array(
  'M' => 'Ïàðåíü',
  'F' => 'Äåâóøêà',
  'C' => 'Ïàðà',
  'G' => 'Ãðóïïà'
  );

$lang['signup_gender_look'] = array(
  'M' => 'Ïàðíÿ',
  'F' => 'Äåâóøêó',
  'C' => 'Ïàðó',
  'G' => 'Ãðóïïó',
  'B' => 'Ïàðíÿ èëè äåâóøêó',
  'A' => 'Âñå'
  );

$lang['seeking'] = 'èùó';
$lang['looking_for_a'] = 'èùó';
$lang['looking_for'] = 'Èùó';

$lang['of'] = ' èç ';
$lang['to'] = ' äî ';
$lang['from'] = ' îò ';
$lang['for'] = ' äëÿ ';
$lang['yes'] = 'Äà';
$lang['no'] = 'Íåò';
$lang['cancel'] = 'Îòìåíèòü';

$lang['change'] = 'Èçìåíèòü';
$lang['reset'] = 'Î÷èñòèòü';

//Commonly used words

$lang['required_info_indication'] = 'óêàçûâàåò ÷òî ïîëå îáÿçàòåëüíî äëÿ çàïîëíåíèÿ';
$lang['required_info_indicator'] = '* ';
$lang['required_info_indicator_color'] = 'Red';
$lang['click_here'] = 'ïðîéäèòå ñþäà';

$lang['datetime_dayval']['Sun'] = 'Âñ';
$lang['datetime_dayval']['Mon'] = 'Ïí';
$lang['datetime_dayval']['Tue'] = 'Âò';
$lang['datetime_dayval']['Wed'] = 'Ñð';
$lang['datetime_dayval']['Thu'] = '×ò';
$lang['datetime_dayval']['Fri'] = 'Ïò';
$lang['datetime_dayval']['Sat'] = 'Ñá';

$lang['error_msg_color'] = 'Red';
$lang['success_message'] = "Èíôîðìàöèÿ, êîòîðóþ Âû ââåëè, áûëà óñïåøíî ñîõðàíåíà.<br>Âû áóäåòå àâòîìàòè÷åñêè ïåðåíàïðàâëåíû íà ñëåäóþùóþ ñåêöèþ â òå÷åíèå 5 ñåêóíä. Â ñëó÷àå, åñëè àâòîìàòè÷åñêîå ïåðåíàïðàâëåíèå íå ñðàáîòàåò, ïîæàëóéñòà, êëèêíèòå ìûøêîé íà ññûëêó íèæå.";
$lang['sendletter_success'] = 'Ïèñüìî áûëî óñïåøíî îòïðàâëåíî.';


/*****************Admin Section Labels********************/

//Commonly used labels
$lang['admin_login_title'] = 'Ïàíåëü Àäìèíèñòðàöèè ' . 'SITENAME';
$lang['home_title'] = 'SITENAME' . ' Home';
$lang['admin_login_msg'] = 'Ëîãèí Àäìèíà';
$lang['admin_title_msg'] = 'Ïàíåëü Àäìèíà ' . 'SITENAME';
$lang['admin_panel'] = 'Ïàíåëü Àäìèíà';
$lang['back'] = 'Íàçàä';
$lang['insert_msg'] = 'Âñòàâèòü íîâîå ';
$lang['question_mark'] = '?';
$lang['id'] = 'Id:';
$lang['name'] = 'Èìÿ:';
$lang['name_col'] = 'Èìÿ';
$lang['enabled'] = 'Ðàçðåøåíî:';
$lang['action'] = 'Äåéñòâèå';
$lang['edit'] = 'Ðåäàêòèðîâàòü';
$lang['delete'] = 'Óäàëèòü';
$lang['section'] = 'Ñåêöèÿ:';
$lang['insert_section'] = 'Âñòàâèòü íîâóþ ñåêöèþ';
$lang['modify_section'] = 'Èçìåíèòü ñåêöèþ';
$lang['modify_sections'] = 'Èçìåíèòü ñåêöèè';
$lang['delete_section'] = 'Óäàëèòü ñåêöèþ';
$lang['delete_sections'] = 'Óäàëèòü ñåêöèè';
$lang['enable_selected'] = 'Ðàçðåøèòü';
$lang['disable_selected'] = 'Çàïðåòèòü';
$lang['change_selected'] = 'Èçìåíèòü';
$lang['delete_selected'] = 'Óäàëèòü';
$lang['no_select_msg'] = "Âû íè÷åãî íå âûáðàëè. Ïîæàëóéñòà, íàæìèòå íà êíîïêó ÍÀÇÀÄ áðàóçåðà, ÷òîáû âûáðàòü îäèí èëè áîëåå âàðèàíòîâ.";
$lang['delete_confirm_msg'] = 'Óâåðåíû, ÷òî õîòèòå óäàëèòü ýòó ñåêöèþ?';
$lang['delete_group_confirm_msg'] = 'Óâåðåíû, ÷òî õîòèòå óäàëèòü ýòè ñåêöèè? Ýòî äåéñòâèå íå ìîæåò áûòü îòìåíåíî.';
$lang['enabled_values'] = array(
  'Y' => 'Äà',
  'N' => 'Íåò'
  );
$lang['display_control_type'] = array(
  'checkbox' => 'Ïåðåêëþ÷àòåëü',
  'radio' => 'Ðàäèîêíîïêà',
  'select' => 'Âûïàäàþùèé ñïèñîê',
  'textarea' => 'Ïîëå ââîäà'
  );
$lang['admin_error_color'] = 'Red';

$lang['col_head_srno'] = '#';
$lang['col_head_id'] = 'Id';
$lang['col_head_question'] = 'Âîïðîñ';
$lang['col_head_enabled'] = 'Ðàçðåøåíî';
$lang['col_head_name'] = 'Èìÿ';
$lang['col_head_username'] = 'Èìÿ ïîëüçîâàòåëÿ';
$lang['col_head_firstname'] = 'Èìÿ';
$lang['col_head_lastname'] = 'Ôàìèëèÿ';
$lang['col_head_fullname'] = 'Ïîëíîå èìÿ';
$lang['col_head_status'] = 'Ñòàòóñ';
$lang['col_head_gender'] = 'Ïîë';
$lang['col_head_email'] = 'Email';
$lang['col_head_country'] = 'Ñòðàíà';
$lang['col_head_city'] = 'Ãîðîä';
$lang['col_head_zip'] = 'Ïî÷òîâûé èíäåêñ';
$lang['col_head_register_at'] = 'Çàðåãèñòðèðîâàí';

$lang['section_title'] = 'Óïðàâëåíèå ñåêöèÿìè';
$lang['total_sections'] = 'Ñåêöèé âñåãî:';
$lang['profile_title'] = 'Óïðàâëåíèå àíêåòàìè';
$lang['total_profiles_found'] = 'Íàéäåíî àíêåò: ';
$lang['modify_profile'] = 'Ðåäàêòèðîâàòü àíêåòó';

$lang['profile_signup_title'] = 'Èíôîðìàöèÿ î ðåãèñòðàöèè';
$lang['profile_basic_title'] = 'Íà÷àëüíûå äàííûå';
$lang['profile_appearance_title'] = 'Âíåøíîñòü';
$lang['profile_interests_title'] = 'Èíòåðåñû';
$lang['profile_lifestyle_title'] = 'Îáðàç æèçíè';

$lang['profile_subtitle_login'] = 'Ëîãèí';
$lang['profile_subtitle_profile'] = 'Àíêåòà';
$lang['profile_subtitle_address'] = 'Àäðåñ';
$lang['profile_subtitle_appearacnce'] = 'Âíåøíîñòü';
$lang['profile_subtitle_preference'] = 'Ïðåäïî÷òåíèÿ';
$lang['profile_delete_confirm_msg'] = 'Âû óâåðåíû, ÷òî õîòèòå óäàëèòü ýòó àíêåòó?';
$lang['delete_profile'] = 'Óäàëèòü àíêåòó';
$lang['profile_username'] = 'Èìÿ ïîëüçîâàòåëÿ:';
$lang['profile_firstname'] = 'Èìÿ:';
$lang['profile_lastname'] = 'Ôàìèëèÿ:';
$lang['profile_email'] = 'E-mail àäðåñ:';
$lang['profile_gender'] = 'Ïîë:';
$lang['profile_birthday'] = 'Äàòà ðîæäåíèÿ:';
$lang['profile_country'] = 'Ñòðàíà:';
$lang['profile_state_province'] = 'Îáëàñòü/øòàò:';
$lang['profile_zip'] = 'Ïî÷òîâûé èíäåêñ:';
$lang['profile_city'] = 'Ãîðîä / Ìåñòíîñòü';
$lang['profile_address1'] = 'Àäðåñ, ñòðîêà 1:';
$lang['profile_address2'] = 'Àäðåñ, ñòðîêà 2:';
$lang['find'] = 'Íàéòè';
$lang['search'] = 'Ïîèñê';
$lang['AND'] = 'È';
$lang['OR'] = 'ÈËÈ';
$lang['order_by'] = 'Óïîðÿäî÷èòü ïî ';
$lang['sort_by'] = 'Îòñîðòèðîâàòü ïî ';
$lang['sort_types'] = array(
  'asc' => 'âîçðàñòàíèþ',
  'desc' => 'óáûâàíèþ'
  );
$lang['search_results'] = 'Ðåçóëüòàòû ïîèñêà';
$lang['no_record_found'] = 'Ïî çàïðîñó íè÷åãî íå íàéäåíî.';
$lang['search_options'] = 'Íàñòðîéêè ïîèñêà';
$lang['search_simple'] = 'Ïðîñòîé ïîèñê';
$lang['search_advance'] = 'Ïðîäâèíóòûé ïîèñê';
$lang['search_advance_results'] = 'Ðåçóëüòàòû ïðîäâèíóòîãî ïîèñêà';
$lang['search_country'] = 'Ïîèñê ïî ñòðàíàì';
$lang['search_states'] = 'Ïîèñê ïî îáëàñòÿì';
$lang['search_zip'] = 'Ïîèñê ïî ïî÷òîâîìó èíäåêñó';
$lang['search_city'] = 'Ïîèñê ïî ãîðîäàì';
$lang['search_wildcard_msg'] = 'Âû ìîæåòå ââåñòè * â ïîëå ââîäà, ÷òîáû èñêàòü âñå çàïèñè.';
$lang['search_location'] = '<b>Ïîèñê ïî ìåñòó:</b>';
$lang['select_state'] = 'Îáëàñòü:';
$lang['enter_city'] = 'Ãîðîä:';
$lang['enter_zip'] = 'Ïî÷òîâûé èíäåêñ:';
$lang['enter_username'] = 'Èìÿ ïîëüçîâàòåëÿ:';
$lang['results_per_page'] = 'Ðåçóëüòàòîâ íà ñòðàíèöó';
$lang['search_results_per_page'] = array( 5 => 5 , 10 => 10, 20 => 20, 50 => 50, 100 => 100 );
$lang['order'] = 'Ïîðÿäîê';
$lang['up'] = 'Ââåðõ';
$lang['down'] = 'Âíèç';

$lang['question'] = 'Âîïðîñ:';

$lang['maxlength'] = 'Ìàêñèìàëüíàÿ äëèíà:';
$lang['description'] = 'Îïèñàíèå:';
$lang['mandatory'] = 'Îáÿçàòåëüíî:';
$lang['guideline'] = 'Óêàçàíèÿ:';
$lang['control_type'] = 'Îòîáðàæàåìûé ýëåìåíò óïðàâëåíèÿ (control):';
$lang['include_extsearch'] = 'Âêëþ÷àòü â ðàñøèðåííûé ïîèñê:';
$lang['head_extsearch'] = 'Çàãîëîâîê ðàñøèðåííîãî ïîèñêà:';

$lang['delete_question'] = 'Óäàëèòü âîïðîñ';
$lang['modify_question'] = 'Èçìåíèòü âîïðîñ';
$lang['questions_title'] = 'Óïðàâëåíèå âîïðîñàìè';
$lang['total_options'] = 'Âñåãî âàðèàíòîâ:';
$lang['insert_question'] = 'Âñòàâèòü âîïðîñ';
$lang['total_questions'] = 'Âñåãî âîïðîñîâ:';
$lang['delete_questions'] = 'Óäàëèòü âîïðîñû';
$lang['delete_group_questions_confirm_msg'] = 'Âû óâåðåíû, ÷òî õîòèòå óäàëèòü ýòè âîïðîñû';

$lang['option'] = 'Âàðèàíòû';
$lang['answer'] = 'Îòâåò';
$lang['options_title'] = 'Âàðèàíòû îòâåòà íà âîïðîñ';
$lang['col_head_answer'] = 'Îòâåò';
$lang['with_selected'] = 'Âûäåëåííîå';
$lang['ranging'] = 'Ðàíãàìè';

// Instant messenger
$lang['instant_messenger'] = 'Ìãíîâåííûå ñîîáùåíèÿ';
$lang['instant_message'] = 'Ìãíîâåííîå ñîîáùåíèå';
$lang['im_from'] = 'Îò:';
$lang['im_message'] = 'Ñîîáùåíèå:';
$lang['im_reply'] = 'Îòâåòèòü';
$lang['close_window'] = 'Çàêðûòü îêíî';

// my matches
$lang['my_matches'] = 'Ìîè ïàðû';
$lang['i_am_a'] = 'ß -';
$lang['Between'] = 'ìåæäó';
$lang['who_is_from'] = 'Âîçðàñò, îò';
$lang['showing'] = 'ïîêàçàíû îò';
$lang['your_search_preferences'] = 'Òåêóùèå íàñòðîéêè ïîèñêà:';
$lang['to_edit_search_preferences'] = '÷òîá èçìåíèòü íàñòðîéêè ïîèñêà';

$lang['unapproved_user'] = 'Íåïðîâåðåííûå àíêåòû';
$lang['gbl_settings'] = 'Ãëîáàëüíûå íàñòðîéêè';
$lang['configurations'] = 'Êîíôèãóðàöèè';
$lang['col_head_variable'] = 'Ïåðåìåííûå';
$lang['col_head_value'] = 'Çíà÷åíèÿ';

$lang['affiliate_title'] = 'Óïðàâëåíèå ïàðòíåðàìè';
$lang['col_head_counter'] = 'Ñ÷åò÷èê';
$lang['col_head_status'] = 'Ñòàòóñ';

$lang['tell_later'] = 'Íåò îòâåòà';
$lang['view_profile'] = 'Ïîñìîòðåòü àíêåòó';
$lang['view_profile_errmsg1']  = 'Âû âñå åùå íå óêàçàëè Âàøè ïðåäïî÷òåíèÿ.<br />Ïîæàëóéñòà, çàïîëíèòå ñíà÷àëà äåòàëè àíêåòû.<br />.';
$lang['view_profile_errmsg2'] = '<br>Íàæìèòå ñþäà, ÷òîáû çàïîëíèòü ïðåäïî÷òåíèÿ ñåé÷àñ.';
$lang['view_profile_errmsg3'] = 'Ïîëüçîâàòåëü ïîêà íå çàïîëíèë ñâîþ àíêåòó, ëèáî çàïîëíèë åå íå äî êîíöà.';
$lang['view_profile_restricted'] = 'Ýòà àíêåòà îãðàíè÷åíà äëÿ ïðîñìîòðà, Âû íå ìîæåòå åå óâèäåòü.';
$lang['profile_notset'] = 'Íå íàéäåíà àíêåòà ïîëüçîâàòåëÿ.';
$lang['send_mail'] = 'Íàïèñàòü ñîîáùåíèå';
$lang['mail_messages'] = 'Ìîè ñîîáùåíèÿ';
$lang['col_head_subject'] = 'Òåìà';
$lang['col_head_sendtime'] = 'Äàòà';

$lang['inbox'] = 'Âõîäÿùèå';
$lang['sent'] = 'Ïîñëàííûå';
$lang['trashcan'] = 'Óäàëåííûå';
$lang['reply'] = 'Îòâåòèòü';
$lang['read'] = 'êàê ïðî÷èòàííîå';
$lang['unread'] = 'Íåïðî÷èòàííûå';
$lang['restore'] = 'Âîññòàíîâèòü';
$lang['subject'] = 'Òåìà';
$lang['subject_colon'] = 'Òåìà:';
$lang['message'] = 'Ñîîáùåíèå';
$lang['send'] = 'Ïîñëàòü';

$lang['send_letter'] = 'Ïîñëàòü ïèñüìî';
$lang['image_browser'] = 'Ïðîñìîòðùèê èçîáðàæåíèé';
$lang['upload_image'] = 'Çàãðóçèòü èçîáðàæåíèå';
$lang['delete_image'] = 'Óäàëèòü èçîáðàæåíèå';
$lang['show_image'] = 'Ïîêàçàòü èçîáðàæåíèå';
$lang['send_invite'] = 'Ïîñëàòü ïðèãëàøåíèå';
$lang['letter_title'] = 'Íîâîå ïèñüìî';
$lang['from_email'] = 'Îò (E-mail):';
$lang['from_name'] = 'Îò (Èìÿ):';
$lang['send_to'] = 'Ïîñëàòü';
$lang['email_subject'] = 'Òåìà:';
$lang['save_as'] = 'Ñîõðàíèòü êàê';

$lang['no_message'] = 'Â Âàøåé ïàïêå "Âõîäÿùèå" íåò íîâûõ ñîîáùåíèé.';
$lang['descrip'] = 'Îïèñàíèå';

//forgot password words
$lang['forgotpass_msg1'] = "Íàïîìèíàíèå ïàðîëÿ";
$lang['forgotpass_msg2'] = "Ïîæàëóéñòà, óêàæèòå àäðåñ ýëåêòðîííîé ïî÷òû (êîòîðûé áûë èñïîëüçîâàí ïðè ñîçäàíèè àíêåòû), ïî êîòîðîìó Âàì áóäóò âûñëàíû Âàøè èìÿ ïîëüçîâàòåëÿ è ïàðîëü.";
$lang['retreieve_info'] = 'Ïîñëàòü';
$lang['forgotpass'] = 'Óòåðÿííûé ïàðîëü';

//Tell a friend
$lang['tellafriend'] = 'Ïðèãëàñèòü äðóãà';
$lang['taf_msg1'] = 'Ïðèãëàñèòü äðóãà íà ' . 'SITENAME';
$lang['taf_yourname'] = 'Âàøå èìÿ:';
$lang['taf_youremail'] = 'Âàø e-mail:';
$lang['taf_friendemail'] = "E-mail äðóãà:";

//Auto-mail
$lang['confirm_your_profile'] = 'Ïîäòâåðäèòü ðåãèñòðàöèþ';
$lang['letter_not_avail'] = 'Øàáëîí äëÿ ïèñüìà íå íàéäåí';
$lang['confirm_letter_sent'] = 'Ïèñüìî äëÿ ïîäòâåðæäåíèÿ ðåãèñòðàöèè áûëî îòïðàâëåíî íà Âàø àäðåñ ýëåêòðîííîé ïî÷òû. Ïîæàëóéñòà, îòêðîéòå ýòî ïèñüìî äëÿ çàâåðøåíèÿ Âàøåé ðåãèñòðàöèè.';
$lang['letter_not_sent'] = 'Ïðîáëåìà ïðè îòïðàâêå ýëåêòðîííîãî ñîîáùåíèÿ. Ïîæàëóéñòà, ñâÿæèòåñü ñ Àäìèíèñòðàòîðîì.';
$lang['or'] = 'Èëè';
$lang['enter_confirm_code'] = 'Äëÿ òîãî ÷òîáû çàâåðøèòü Âàøó ðåãèñòðàöèþ, ïîæàëóéñòà, ââåäèòå â ýòî ïîëå êîä ïîäòâåðæäåíèÿ:';
// Affiliate auto-mail

$lang['aff_email_subject'] = 'Ïîäòâåðäèòå Âàø ïàðòíåðñêèé àêêàóíò';
$lang['aff_email_body'] = 'Ñïàñèáî çà ñîçäàíèå ïàðòíåðñêîãî àêêàóíòà íà ' . 'SITENAME' . '. Ïîæàëóéñòà, ââåäèòå ýòîò URL â àäðåñíóþ ñòðîêó Âàøåãî áðàóçåðà äëÿ çàâåðøåíèÿ ðåãèñòðàöèè:<br><br>#ConfirmationLink#';

//Page management

$lang['manage_pages'] = 'Óïðàâëåíèå ñòðàíèöàìè';
$lang['pagetitle'] = 'Çàãîëîâîê:';
$lang['pagetext'] = 'Òåêñò:';
$lang['pagekey'] = 'Êëþ÷:';
$lang['addpage'] = 'Äîáàâèòü ñòðàíèöó';
$lang['page'] = 'Ñòðàíèöà';
$lang['addnew'] = 'Äîáàâèòü íîâóþ';
$lang['modpage'] = 'Èçìåíèòü ñòðàíèöó';
$lang['pagekey_help'] = 'www.yourdomain.com/index.php?key=YOUR_KEY';

$lang['y_o'] = 'y/o';
$lang['lastlogged'] = 'Áûë(à) â ïîñëåäíèé ðàç: ';
$lang['aff_stats'] = 'Ñòàòèñòèêà ïàðòíåðîâ';
$lang['total_referrals'] = 'Âñåãî ðåôåðàëîâ (ïåðåøåäøèõ ïî ññûëêå)';
$lang['regis_referals'] = 'Çàðåãèñòðèðîâàííûõ ðåôåðàëîâ';
$lang['globalconfigurations'] = 'Ãëîáàëüíàÿ êîíôèãóðàöèÿ';

$lang['send_message_to'] = 'Ñîîáùåíèå';
$lang['writing_message'] = 'Ïîñëàòü ñîîáùåíèå ';
$lang['search_at'] = 'Èñêàòü â ';

//Rating module
$lang['rate_profile'] = 'Äàòü ðåéòèíã àíêåòå';
$lang['worst'] = 'Î÷åíü ïëîõî';
$lang['excellent'] = 'Îòëè÷íî';
$lang['rating'] = 'Ðåéòèíã';
$lang['submitrating'] = 'Äàòü ðåéòèíã';

//Payment Modules
$lang['mship_changed'] = 'Óðîâåíü ÷ëåíñòâà èçìåíåí';
$lang['mship_changed_successfull'] = 'Âàø óðîâåíü ÷ëåíñòâà áûë èçìåíåí íà Áåñïëàòíûé.';
$lang['no_payment'] = 'Îòñóòñòâóåò - äëÿ ñëó÷àÿ Áåñïëàòíîãî ÷ëåíñòâà (ñ îãðàíè÷åíèÿìè)';
$lang['payment_modules'] = 'Ìîäóëè îïëàòû';
$lang['payment_methods'] = 'Ñïîñîáû îïëàòû';
$lang['business'] = 'Áèçíåñ:';
$lang['siteid'] = 'Id ñàéòà:';
$lang['undefined_quantity'] = 'Íåîïðåäåëåííîå êîëè÷åñòâî:';
$lang['no_shipping'] = 'Íåò ïîñûëêè:';
$lang['no_note'] = 'Íåò çàìåòîê:';
$lang['on_off_values'] = array( 1 => 'Äà', 0 => 'Íåò' );
$lang['edit_payment_modules'] = 'Ðåäàêòèðîâàòü ìîäóëü îïëàòû';
$lang['trans_key'] = 'Êîä òðàíçàêöèè:';
$lang['trans_mode'] = 'Ñîñòîÿíèå òðàíçàêöèè:';
$lang['trans_method'] = 'Ñïîñîá ñîâåðøåíèÿ òðàíçàêöèè:';
$lang['username'] = 'Èìÿ ïîëüçîâàòåëÿ:';
$lang['username_without_colon'] = 'Èìÿ ïîëüçîâàòåëÿ';
$lang['country'] = 'Ñòðàíà';
$lang['country_colon'] = 'Ñòðàíà:';
$lang['state'] = 'Îáëàñòü/øòàò';
$lang['city'] = 'Ãîðîä';
$lang['location_col'] = 'Àäðåñ:';
$lang['location_no_col'] = 'Àäðåñ';
$lang['zip_code'] = 'Ïî÷òîâûé èíäåêñ';
$lang['attached_files'] = 'Ïðèêðåïëåííûå ôàéëû';
$lang['cc_owner'] = 'Èìÿ âëàäåëüöà êàðòû:';
$lang['cc_number'] = 'Íîìåð êðåäèòíîé êàðòû:';
$lang['cc_type'] = 'Òèï êðåäèòíîé êàðòû:';
$lang['cc_exp_date'] = 'Äàòà èñòå÷åíèÿ ñðîêà êðåäèòíîé êàðòû:';
$lang['cc_cvv_number'] = 'Íîìåð ïðîâåðêè êðåäèòíîé êàðòû (CVV è ò.ï.):';
$lang['cvv_help'] = '(ðàñïîëîæåí íà çàäíåé ïîâåðõíîñòè êðåäèòíîé êàðòû, ïðÿìî ïîä ìàãíèòíîé ïîëîñîé)';
$lang['continue'] = 'Ïðîäîëæèòü';
$lang['trans_method_vals'] = array(
  'CC' => 'Êðåäèòíàÿ êàðòà',
  'ECHECK' => 'Ýëåêòðîííûé ÷åê'
  );
$lang['trans_mode_vals'] = array(
  'AUTH_CAPTURE' => 'AUTH_CAPTURE',
  'AUTH_ONLY' => 'AUTH_ONLY',
  'CAPTURE_ONLY' => 'CAPTURE_ONLY',
  'CREDIT' => 'CREDIT',
  'VOID' => 'VOID',
  'PRIOR_AUTH_CAPTURE' => 'PRIOR_AUTH_CAPTURE'
 );
$lang['cc_unknown'] = 'Êîìïàíèÿ êðåäèòíîé êàðòû íåèçâåñòíà. Ïîæàëóéñòà, ïîïðîáóéòå ñíîâà, ñ ïîìîùüþ ðàáî÷åé êðåäèòíîé êàðòû.';
$lang['cc_invalid_date'] = 'Íåïðàâèëüíûé ñðîê èñòå÷åíèÿ êðåäèòíîé êàðòû. Ïîæàëóéñòà, ïîïðîáóéòå ñíîâà, ñ ïîìîùüþ ðàáî÷åé êðåäèòíîé êàðòû.';
$lang['cc_invalid_number'] = 'Íåïðàâèëüíûé íîìåð êðåäèòíîé êàðòû. Ïîæàëóéñòà, ïîïðîáóéòå ñíîâà, ñ ïîìîùüþ ðàáî÷åé êðåäèòíîé êàðòû.';
$lang['amount'] = 'Êîëè÷åñòâî:';
$lang['confirmation'] = 'Ïîäòâåðæäåíèå';
$lang['confirm'] = 'Ïîäòâåðäèòü';
$lang['upgrade_membership'] = 'Ñòàòóñ ÷ëåíñòâà';
$lang['changeto'] = 'Èçìåíèòü íà';
$lang['current_mship_level'] = 'Òåêóùèé óðîâåíü ÷ëåíñòâà:';
$lang['membership_status'] = 'Óðîâåíü ÷ëåíñòâà';
$lang['you_currently'] = 'Âû ñåé÷àñ - ';
$lang['info_confirm'] = 'Ïîæàëóéñòà, ïîäòâåðäèòå: ';
$lang['change_mship_to'] = 'Èçìåíèòü óðîâåíü ÷ëåíñòâà íà ';
//Membership
$lang['permitmsg_1'] = 'Ïðîñòèòå, Âàø óðîâåíü ÷ëåíñòâà íå âêëþ÷àåò ';
$lang['permitmsg_2'] = 'Ïîæàëóéñòà, ïîâûñüòå Âàø óðîâåíü ÷ëåíñòâà, ÷òîáû èñïîëüçîâàòü ';
$lang['permitmsg_3'] = 'Òàáëèöà ñðàâíåíèÿ óðîâíåé ÷ëåíñòâà';
$lang['permitmsg_4'] = 'Ñêðûòü òàáëèöó ñðàâíåíèÿ óðîâíåé ÷ëåíñòâà';
$lang['membership_packages'] = 'Ïàêåòû ÷ëåíñòâà';
$lang['membership_packages_compare'] = 'Ñðàâíåíèå ïàêåòîâ ÷ëåíñòâà';
$lang['modify'] = 'Ñîõðàíèòü èçìåíåíèÿ';
$lang['manage_membership'] = 'Óïðàâëåíèå ïàêåòàìè';
$lang['privileges_msg'] = 'Ïðèâèëåãèè';
$lang['price'] = 'Öåíà: ';
$lang['currency'] = 'Âàëþòà: ';
$lang['choose_membership'] = 'Âûáåðèòå ïàêåò:';
$lang['add_membership'] = 'Äîáàâèòü íîâûé ïàêåò';
$lang['membership_types'] = 'Ïàêåòû';
$lang['member'] = 'ïàêåòà ïîëüçîâàòåëü';

$lang['select_letter'] = 'Âûáðàòü ïèñüìî:';
$lang['body'] = 'Ñîîáùåíèå:';
$lang['module'] = 'Ìîäóëü';
$lang['uninstall'] = 'Óäàëèòü èíñòàëëÿöèþ';
$lang['install'] = 'Èíñòàëëèðîâàòü';
$lang['modify_option'] = 'Èçìåíèòü îïöèè';

$lang['only_jpg'] = 'Äîïóñêàþòñÿ òîëüêî ôàéëû ôîðìàòîâ .jpg, .gif, .bmp èëè .png.';
$lang['upload_unsuccessful'] = 'Ôîòîãðàôèÿ íå ìîæåò áûòü çàãðóæåíà íà ñàéò.';
$lang['upload_successful'] = 'Ôîòîãðàôèè çàãðóæåíû íà ñàéò.';
$lang['between1'] = 'Ìåæäó';
$lang['and'] = 'è';
$lang['profile_details'] = 'Äåòàëè àíêåòû';
$lang['personal_details'] = 'Ëè÷íûå äàííûå';


//Banner Management
$lang['manage_banners'] = 'Óïðàâëåíèå áàííåðàìè';
$lang['add_banners'] = 'Äîáàâèòü áàííåð';
$lang['edit_banners'] = 'Ðåäàêòèðîâàòü áàííåð';
$lang['size'] = 'Ðàçìåð';
$lang['size_px'] = 'Ðàçìåð (px)';
$lang['banner_linkurl'] = 'Áàííåð / URL ññûëêè';
$lang['banner_sizes'] = array(
  '468X60' => '468 x 60',
  '100X500'=>'100 x 500',
  '120X120'=>'120 x 120'
);
$lang['banner_sizes_name'] = array( 'ãîðèçîíòàëüíûé', 'âåðòèêàëüíûé', 'êâàäðàòíûé' );
$lang['startdate'] = 'Äàòà íà÷àëà:';
$lang['enddate'] = 'Äàòà îêîí÷àíèÿ:';
$lang['tooltip'] = 'Òåêñò ïðè íàâåäåíèè ìûøüþ (Tooltip):';
$lang['linkurl'] = 'Url ññûëêè:';
$lang['banner'] = 'Áàííåð:';
$lang['total_banner'] = 'Âñåãî áàííåðîâ:';
$lang['online_users'] = 'Ñåé÷àñ îíëàéí:';
$lang['site_statistics'] = 'Ñòàòèñòèêà';
$lang['pending_profiles'] = 'Ïîëüçîâàòåëåé æäóùèõ ïîäòâåðæäåíèÿ';
$lang['active_profiles'] = 'Àêòèâíûõ ïîëüçîâàòåëåé';
$lang['online_profiles'] = 'Ïîëüçîâàòåëåé îíëàéí';
$lang['pending_aff'] = 'Ïàðòíåðîâ æäóùèõ ïîäòâåðæäåíèÿ';
$lang['total_affiliates'] = 'Ïàðòíåðîâ âñåãî';
$lang['active_aff'] = 'Ïàðòíåðîâ àêòèâíûõ';
$lang['no_rating'] = 'Íåò ðåéòèíãà';

//SEO Words
$lang['seo'] = 'SEO-íàñòðîéêè';
$lang['seo_head'] = 'Îïòèìèçàöèÿ ïîä ïîèñêîâèêè (Search Engine Optimization)';
$lang['sef_msg'] = 'URL-û, äðóæåñòâåííûå ïîèñêîâûì ìàøèíàì';
$lang['seo_enable'] = 'Ðàçðåøèòü URL Rewriting èñïîëüçóÿ mod_rewrite:';
$lang['yes_msg'] ='URL rewriting - îïöèÿ äîñòóïíàÿ òîëüêî ïðè èñïîëüçîâàíèè âåá-ñåðâåðà Apache, ñî âêëþ÷åííûì ìîäóëåì ðàñøèðåíèé mod_rewrite. Ïîæàëóéñòà óáåäèòåcü, ÷òî Âàø ñåðâåð ïîäõîäèò ïîä ýòè òðåáîâàíèÿ. Ïîìíèòå òàêæå, ïîæàëóéñòà, ÷òî íåîáõîäèìî ïåðåèìåíîâàòü ôàéë .htaccess.txt â .htaccess.';
$lang['keywords'] = 'Êëþ÷åâûå ñëîâà:';
$lang['page_tags_msg'] = 'Çàãîëîâêè ñòðàíèö è ìåòà-òýãè';
$lang['max_255'] = 'Ìàêñèìóì 255 ñèìâîëîâ';

//News / Story / Article Manangement
$lang['manage_news'] = 'Óïðàâëåíèå íîâîñòÿìè';
$lang['manage_story'] = 'Óïðàâëåíèå èñòîðèÿìè';
$lang['manage_article'] = 'Óïðàâëåíèå ñòàòüÿìè';
$lang['news_header'] = 'Çàãîëîâîê';
$lang['total_news'] = 'Âñåãî íîâîñòåé:';
$lang['total_articles'] = 'Âñåãî ñòàòåé:';
$lang['total_stories'] = 'Âñåãî èñòîðèé:';
$lang['article_title'] = 'Çàãîëîâîê';
$lang['story_sender'] = 'Àâòîð';
$lang['story_sender_msg'] = 'ID Àíêåòû [öèôðàìè]';
$lang['modify_article'] = 'Ðåäàêòèðîâàòü ñòàòüþ';
$lang['modify_news'] = 'Ðåäàêòèðîâàòü íîâîñòü';
$lang['modify_story'] = 'Ðåäàêòèðîâàòü èñòîðèþ';
$lang['insert_article'] = 'Äîáàâèòü ñòàòüþ';
$lang['insert_story'] = 'Äîáàâèòü èñòîðèþ';
$lang['insert_news'] = 'Äîáàâèòü íîâîñòü';
$lang['dat'] = 'Äàòà:';

//Poll Words
$lang['manage_polls'] = 'Óïðàâëåíèå îïðîñàìè';
$lang['modify_poll'] = 'Ðåäàêòèðîâàòü îïðîñ';
$lang['total_polls'] = 'Âñåãî îïðîñîâ';
$lang['poll'] = 'Îïðîñ';
$lang['add_polls'] = 'Äîáàâèòü îïðîñû';
$lang['add_options'] = 'Äîáàâèòü âàðèàíò';
$lang['active'] = 'Àêòèâíûé';
$lang['activate'] = 'Àêòèâèðîâàòü';
$lang['option'] = 'Âàðèàíòû';
$lang['modify_options'] = 'Èçìåíèòü âàðèàíòû';
$lang['add_option_now'] = 'Äîáàâèòü âàðèàíò.';
$lang['poll_options'] = 'Íàñòðîéêè îïðîñà';
$lang['votes'] = 'Ãîëîñîâ';
//Filter Records
$lang['filter_options'] = array(
  'id' => 'Id',
  'username' => 'Èìÿ ïîëüçîâàòåëÿ',
  'city' => 'Ãîðîä',
  'zip' => 'Ïî÷òîâûé èíäåêñ',
  'status' => 'Ñòàòóñ'
  );
$lang['first'] = 'Ïåðâûé';
$lang['last'] = 'Ïîñëåäíèé';
$lang['filter_records'] = 'Ôèëüòðîâàòü çàïèñè';
$lang['search_at'] = 'Èñêàòü â ';
$lang['criteria'] = 'Êðèòåðèè';

//Admin Management
$lang['manage_admins'] = 'Óïðàâëåíèå àäìèíàìè';
$lang['total_admins'] = 'Âñåãî àäìèíîâ';
$lang['add_admin'] = 'Äîáàâèòü íîâîãî àäìèíà';
$lang['modify_admin'] = 'Èçìåíèòü àäìèíà';
$lang['fullname'] = 'Ïîëíîå èìÿ';
$lang['please_be_sure'] = 'Ïîæàëóéñòà, óáåäèòåñü, ÷òî Âû';
$lang['change_your_admin_pwd'] = 'èçìåíèëè ïàðîëü àäìèíèñòðàòîðà ïî óìîë÷àíèþ';
$lang['superuser'] = 'Ñóïåð-ïîëüçîâàòåëü';
$lang['no_admin_user_msg1'] = 'Â ñèñòåìå ñåé÷àñ íåò àäìèíîâ, êîòîðûå íå ÿâëÿþòñÿ Ñóïåð-ïîëüçîâàòåëÿìè. ×òîáû èçìåíèòü ïðèâèëåãèè, ïîæàëóéñòà, ñíà÷àëà ñîçäàéòå íîâîãî àäìèíà.';
$lang['no_admin_user_msg2'] = '×òîáû ñîçäàòü íîâîãî àäìèí-ïîëüçîâàòåëÿ';
$lang['access_denied'] = 'Äîñòóï çàïðåùåí';
$lang['not_authorize'] = 'Âàì íå ðàçðåøåí äîñòóï ê ýòîé ñòðàíèöå. Ïîæàëóéñòà, ñâÿæèòåñü ñ âàøèì Ñóïåð-àäìèíîì.';

//Admin Permissions Management
$lang['admin_permissions'] = 'Ïðèâèëåãèè àäìèíîâ';
$lang['manage_admin_permissions'] = 'Óïðàâëåíèå ïðèâèëåãèÿìè àäìèíîâ';
$lang['admin_users'] = 'Ïîëüçîâàòåëè-Àäìèíû';
$lang['permissions'] = 'Ìîäóëè';
$lang['superuser_noteditable'] = 'Ïðèì.: Ñóïåð-ïîëüçîâàòåëè íå ðåäàêòèðóåìû.';
$lang['all'] = 'Âñå';
$lang['selected'] = 'Âûäåëåííûå';
$lang['selected_users'] = 'Âûäåëåííûå ïîëüçîâàòåëè';
$lang['separate_users_by_coma'] = 'Ââåäèòå èìåíà ïîëüçîâàòåëåé, ðàçäåëåííûå çàïÿòûìè';
$lang['admin_rights'] = array(
    'site_stats'        => 'Ñòàòèñòèêà ñàéòà',
    'profie_approval'     => 'Àíêåòû äëÿ ïîäòâåðæäåíèÿ',
    'profile_mgt'         => 'Óïðàâëåíèå àíêåòàìè',
    'section_mgt'         => 'Óïðàâëåíèå ñåêöèÿìè',
    'affiliate_mgt'       => 'Óïðàâëåíèå ïàðòíåðàìè',
    'affiliate_stats'     => 'Ñòàòèñòèêà ïàðòíåðîâ',
    'news_mgt'          => 'Óïðàâëåíèå íîâîñòÿìè',
    'article_mgt'         => 'Óïðàâëåíèå ñòàòüÿìè',
    'story_mgt'         => 'Óïðàâëåíèå èñòîðèÿìè',
    'poll_mgt'          => 'Óïðàâëåíèå îïðîñàìè',
    'search'          => 'Ïîèñê',
    'ext_search'        => 'Ðàñøèðåííûé ïîèñê',
    'send_letter'         => 'Ïîñëàòü ïèñüìî',
    'pages_mgt'         => 'Óïðàâëåíèå ñòðàíèöàìè',
    'chat'            => '×àò',
    'chat_mgt'          => 'Óïðàâëåíèå ÷àòîì',
    'forum_mgt'         => 'Óïðàâëåíèå ôîðóìîì',
    'mship_mgt'         => 'Óïðàâëåíèå ÷ëåíñòâîì',
    'payment_mgt'         => 'Ìîäóëè îïëàòû',
    'banner_mgt'        => 'Óïðàâëåíèå áàííåðàìè',
    'seo_mgt'           => 'SEO-íàñòðîéêè',
    'admin_mgt'         => 'Óïðàâëåíèå àäìèíàìè',
    'admin_permit_mgt'      => 'Ïðèâèëåãèè àäìèíîâ',
    'global_mgt'        => 'Ãëîáàëüíûå íàñòðîéêè ñàéòà',
    'change_pwd'        => 'Èçìåíåíèå ïàðîëÿ',
    'cntry_mgt'         => 'Óïðàâëåíèå Ñòðàíàìè/Îáëàñòÿìè/Ãîðîäàìè',
    'snaps_require_approval'  => 'Ïðîâåðêà ôîòîãðàôèé',
    'featured_profiles_mgt'   => 'Àíêåòû ñ ïîêàçàìè',
    'calendar_mgt'        => 'Êàëåíäàðè',
    'event_mgt'         => 'Ïðîâåðêà ñîáûòèé',
    'import_mgt'        => 'Èìïîðò',
  /* Added in 2.0 */
        'plugin_mgt'              => 'Óïðàâëåíèå ïëàãèíàìè',
    'blog_mgt'          => 'Óïðàâëåíèå áëîãàìè',
    'profile_ratings'     => 'Óïðàâëåíèå ðåéòèíãàìè àíêåò',
    );

$lang['cntry_mgt']  = 'Óïðàâëåíèå Ñòðàíàìè / Îáëàñòÿìè / Ãîðîäàìè';
$lang['register_now'] = 'Íåò àíêåòû? Çàðåãèñòðèðóéòåñü!';
$lang['addtobuddylist'] = 'Äîáàâèòü â ñïèñîê Äðóçåé';
$lang['addtobanlist'] = 'Äîáàâèòü â ×åðíûé ñïèñîê';
$lang['addtohotlist'] = 'Äîáàâèòü â Ãîðÿ÷èå';
$lang['buddylisthdr'] = 'Ïàïêà Äðóçüÿ';
$lang['banlisthdr'] = 'Ïàïêà ×åðíûé ñïèñîê';
$lang['hotlisthdr'] = 'Ïàïêà Ãîðÿ÷èå';
$lang['username_hdr'] = 'Èìÿ ïîëüçîâàòåëÿ';
$lang['fullname_hdr'] = 'Ïîëíîå èìÿ';
$lang['register'] = 'Çàðåãèñòðèðîâàòüñÿ';
$lang['featured_profiles'] = 'Àíêåòû ñ ïîêàçàìè';
$lang['bigger_pic_size'] = 'Ðàçìåð êàðòèíêè áîëüøå äîïóñòèìîãî';
$lang['snaps_require_approval'] = 'Äîïóñê ôîòîãðàôèé';
$lang['events_require_approval'] = 'Ïðîâåðêà ñîáûòèé';
$lang['upload_picture_caption'] = 'Ãëàâíàÿ ôîòîãðàôèÿ: ';
$lang['upload_thumbnail_caption'] = 'Óìåíüøåííàÿ ôîòîãðàôèÿ: ';
$lang['Approve'] = 'Ïîäòâåðäèòü';
$lang['Remove'] = 'Óäàëèòü';
$lang['userdetails'] = 'Èíôîðìàöèÿ î ïîëüçîâàòåëå';
$lang['pict'] = 'Ôîòî';
$lang['tnail'] = 'Óìåíüøåííîå';
$lang['reqact'] = 'Ñîâåðøèòü äåéñòâèå';
$lang['newmemberlist'] = 'Íîâûå ïîëüçîâàòåëè';
$lang['yearsold'] = 'ëåò';
$lang['Male'] = 'Ìóæñêîé';
$lang['Female'] = 'Æåíñêèé';
$lang['showfulllist'] = 'Ïîêàçàòü ïîëíûé ñïèñîê';
$lang['featuredprofiles'] = 'Àíêåòû ñ ïîêàçàìè';
$lang['featured_profiles_hdr'] = 'Àíêåòû ñ ïîêàçàìè';
$lang['nonfeatured_profiles_hdr'] = 'Ïîëüçîâàòåëè áåç ïîêàçîâ';
$lang['level_hdr'] = 'Óðîâåíü';
$lang['date_from'] = 'Äàòà íà÷àëà';
$lang['date_upto'] = 'Äàòà îêîí÷àíèÿ';
$lang['must_show'] = 'Äîëæíî ïîêàçûâàòüñÿ';
$lang['reqd_exposures'] = 'Òðåáóåòñÿ ïîêàçàòü';
$lang['total_exposures'] = 'Ïîêàçàíî âñåãî';
$lang['add_featured'] = 'Äîáàâèòü àíêåòó â ñïèñîê ñ ïîêàçàìè';
$lang['mod_featured'] = 'Ðåäàêòèðîâàòü àíêåòó â ñïèñêå ñ ïîêàçàìè';
$lang['member_since'] = 'Ïîëüçîâàòåëü ñ';
$lang['invalid_username'] = 'Íåïðàâèëüíîå èìÿ ïîëüçîâàòåëÿ';
$lang['weekcnt'] = 'Àíêåò çà íåäåëþ:';
$lang['totalgents'] = 'Âñåãî ïàðíåé:';
$lang['totalfemales'] = 'Âñåãî äåâóøåê:';
$lang['weeksnaps'] = 'Ôîòîãðàôèé çà íåäåëþ:';
$lang['since_last_login'] = 'ñ ïîñëåäíåãî ïîñåùåíèÿ';
$lang['sincelastlogin_hdr'] ='Ñ ïîñëåäíåãî ïîñåùåíèÿ';
$lang['newmessages'] = 'Íîâûõ ñîîáùåíèé:';
$lang['profileviewed'] = 'Âàøó àíêåòó ïðîñìîòðåëè:';
$lang['winks_received'] = 'Ïîäìèãèâàíèé ïîëó÷åíî:';
$lang['send_wink'] = 'Ïîäìèãíóòü';
$lang['listofviews'] = 'Âàøó àíêåòó ïðîñìîòðåëè';
$lang['listofwinks'] = 'Âàì ïîäìèãíóëè';
$lang['winkslist'] = 'Ïîäìèãèâàíèÿ';
$lang['viewslist'] = 'Ïðîñìîòðû';
$lang['suggest_poll'] = 'Ïðåäëîæèòü îïðîñ';
$lang['savepoll'] = 'Ïîñëàòü îïðîñ';
$lang['moreoptions'] = 'Åùå âàðèàíòû';
$lang['minimum_options'] = 'Äëÿ îïðîñà íåîáõîäèìî ìèíèíóì äâà âàðèàíòà';
$lang['pollsuggested'] = 'Ñïàñèáî! Ïðåäëîæåííûé Âàìè îïðîñ ïåðåñëàí Àäìèíèñòðàöèè ñàéòà.';
$lang['suggested_by'] = 'Ïðåäëîæåíî:';
$lang['any_where'] = 'Ëþáîé, ãäå';
$lang['memberpanel'] = "Äîìàøíÿÿ ñòðàíè÷êà ïîëüçîâàòåëÿ";
$lang['feedback_thanks'] = 'Ñïàñèáî çà Âàø îòçûâ.  Âàøå ñîîáùåíèå ïåðåñëàíî Àäìèíèñòðàöèè ñàéòà.';
$lang['cancel_hdr'] = 'Óäàëèòü àíêåòó';
$lang['cancel_txt01'] = 'Âû çàïðîñèëè óäàëåíèå àíêåòû è ïðåêðàùåíèå ÷ëåíñòâà â <b>'.'SITENAME'.'</b>.<br /><br />Âû óâåðåíû, ÷òî Âû õîòèòå ýòîãî? ';
$lang['cancel_opt01'] = 'Äà, ÿ óâåðåí(à)';
$lang['cancel_opt02'] = 'Íåò, ÿ íå õî÷ó ïðåêðàùàòü ÷ëåíñòâî è óäàëÿòü àíêåòó';
$lang['cancel_domsg'] = 'Ñïàñèáî çà èñïîëüçîâàíèå ñàéòà '.'SITENAME'.'. <br /><br /> Ìû ñîæàëååì î òîì, ÷òî Âû áîëåå íå ñ íàìè, íî ìû áóäåì ðàäû Âàì â ëþáîå âðåìÿ, è íàäååìñÿ, ÷òî íàøè óñëóãè áûëè ïîëåçíû äëÿ Âàñ.';
$lang['cancel_nomsg'] = 'Ñïàñèáî çà èñïîëüçîâàíèå ñàéòà '.'SITENAME'.'. <br /><br /> Ìû öåíèì Âàøå ïîñòîÿíñòâî, è íàäååìñÿ, ÷òî íàøè óñëóãè ïîëåçíû äëÿ Âàñ.';
$lang['reject'] = 'Îòêàçàòü';
$lang['unread'] = 'Íåïðî÷èòàííûõ';
$lang['membership_hdr'] = 'Óðîâåíü ïîäïèñêè';
$lang['edit_pict'] = 'Ðåäàêòèðîâàòü ãëàâíóþ ôîòîãðàôèþ';
$lang['edit_thmpnail'] = 'Ðåäàêòèðîâàòü óìåíüøåííóþ ôîòîãðàôèþ';
$lang['letter_options'] = 'Îïöèè ïèñåì';
$lang['pic_gallery'] = 'Ïîñìîòðåòü ôîòîãðàôèè';
$lang['reactivate'] = 'Ðåàêòèâèðîâàòü ïîëüçîâàòåëÿ';
$lang['cancel_list'] = 'Ïðåðâàííûå ïîëüçîâàòåëè';
$lang['cancel_date'] = 'Äàòà ïðåðûâàíèÿ';
$lang['language_opt'] = 'Âûáîð ÿçûêà' ;
$lang['change_language'] = 'Ñìåíèòü ÿçûê';
$lang['with_photo'] = 'Òîëüêî ñ ôîòîãðàôèåé';
$lang['logintime'] = 'Âðåìÿ âõîäà';
$lang['manage_country_states'] = 'Óïðàâëåíèå ñòðàíàìè/îáëàñòÿìè';
$lang['manage_countries'] = 'Óïðàâëåíèå ñòðàíàìè';
$lang['countries_count'] = 'Êîë-âî ñòðàí';
$lang['insert_country'] = 'Äîáàâèòü ñòðàíó';
$lang['modify_country'] = 'Ðåäàêòèðîâàòü ñòðàíó';
$lang['country_code'] = 'Êîä ñòðàíû';
$lang['country_name'] = 'Íàçâàíèå ñòðàíû';
$lang['manage_states'] = 'Óïðàâëåíèå îáëñòÿìè';
$lang['states_count'] = 'Êîë-âî îáëàñòåé';
$lang['insert_state'] = 'Äîáàâèòü îáëàñòü';
$lang['modify_state'] = 'Ðåäàêòèðîâàòü îáëàñòü';
$lang['state_code'] = 'Êîä îáëàñòè';
$lang['state_name'] = 'Èìÿ îáëàñòè';
$lang['totalcouples'] = 'Ïàð-ïîëüçîâàòåëåé, âñåãî:';
$lang['active_days'] = 'Ñêîëüêî äíåé àêòèâíî?';
$lang['activedays_array'] = array('1'=>'1','7'=>'7','30'=>'30','90'=>'90','180'=>'180','365'=>'365');
$lang['expired'] = 'Èñòåê cðîê Âàøåãî ÷ëåíñòâà, <br /><br /><a href="payment.php" class="errors">Çäåñü</a> ìîæíî âîçîáíîâèòü Âàøå ÷ëåíñòâî è ïðîäîëæèòü ïîëüçîâàòüñÿ ñàéòîì '. 'SITENAME';
$lang['compose'] = 'Ñîñòàâèòü';

$lang['logout_login']='×òîáû èñïîëüçîâàòü Âàø íîâûé ïàðîëü, ïîæàëóéñòà, âûéäèòå è çàéäèòå ñíîâà.';
$lang['makefeatured'] = 'Íàæìèòå çäåñü ÷òîáû äîáàâèòü ýòó àíêåòó â ñïèñîê èçáðàííûõ àíêåò';
$lang['col_head_gender_short'] = 'Ïîë ';
$lang['no_subject'] = 'Áåç òåìû';
$lang['admin_col_head_fullname'] = $lang['col_head_fullname'];
$lang['select_from_list'] = '-Âûáåðèòå-';

$lang['default_tz'] = '0.00';

$lang['manage_counties'] = 'Ñòðàíà/ îáëàñòü';
$lang['counties_count'] = 'Êîë-âî ñòðàí/ îáëàñòåé';
$lang['insert_county'] = 'Äîáàâèòü ñòðàíó/ îáëàñòü';
$lang['modify_county'] = 'Èçìåíèòü ñòðàíó/îáëàñòü';
$lang['county_code'] = 'Êîä ñòðàíû/ îáëàñòè';
$lang['county_name'] = 'Íàçâàíèå ñòðàíû/ îáëàñòè';
$lang['manage_cities'] = 'Ãîðîäà';
$lang['cities_count'] = ' Êîë-âî ãîðîäîâ';
$lang['insert_city'] = 'Äîáàâèòü ãîðîä';
$lang['modify_city'] = 'Èçìåíèòü ãîðîä';
$lang['city_code'] = 'Êîä ãîðîäà';
$lang['city_name'] = 'Íàçâàíèå ãîðîäà';
$lang['manage_zips'] = 'Ïî÷òîâûå èíäåêñû';
$lang['zips_count'] = 'Êîë-âî ïî÷òîâûõ èíäåêñîâ';
$lang['insert_zip'] = 'Äîáàâèòü ïî÷òîâûé èíäåêñ';
$lang['modify_zip'] = 'Èçìåíèòü ïî÷òîâûé èíäåêñ';
$lang['zip_code'] = 'Ïî÷òîâûé èíäåêñ';
$lang['show_form'] = 'Ïîêàçàòü ôîðìó:';
$lang['change_album'] = 'Îáíîâèòü';


/* Following array is for Profile Window display heading conversion */
$lang['extsearchhead'] = array(
  'Marital Status'    => 'Ñåìåéíîå ïîëîæåíèå',
  'Ethnicity'       => 'Íàöèîíàëüíîñòü',
  'Religion'        => 'Ðåëèãèÿ',
  'Hobbies'       => 'Õîááè',
  'Height'        => 'Ðîñò',
  'Body Type'       => 'Òåëîñëîæåíèå',
  'Zodiac Sign'     => 'Çíàê çîäèàêà',
  'Eye color'       => 'Öâåò ãëàç',
  'Hair color'      => 'Öâåò âîëîñ',
  'Body art'        => 'Áîäèàðò',
  'Best feature'      => 'Ëó÷øàÿ õàðàêòåðèñòèêà',
  'Hot spots'       => 'Ëîáèìûå ìåñòà',
  'Sports'        => 'Ñïîðò',
  'Favorite things'     => 'Ëþáèìûå âåùè',
  'Last reading'      => 'Ïîñëåäíåå ïðî÷èòàííîå',
  'Common interests'    => 'Îáùèå èíòåðåñû',
  'Sense of humor'    => '×óâñòâî þìîðà',
  'Exercise'        => 'Çàðÿäêà',
  'Daily diet'      => 'Äíåâíîé ðàöèîí',
  'Smoking'       => 'Êóðåíèå',
  'Drinking'        => 'Âûïèâêà',
  'Job schedule'      => 'Ðàñïîðÿäîê äíÿ',
  'Current annual income' => 'Òåêóùìé ãîäîâîé äîõîä',
  'Living situation'    => 'Æèçíåííàÿ ñèòóàöèÿ',
  'Kids'          => 'Äåòè',
  'Want children'     => 'Æåëàíèå èìåòü äåòåé',
  'Weight'        => 'Âåñ',
  'Employment status'   => 'Ñòàòóñ çàíÿòîñòè',
  'Education'       => 'Îáðàçîâàíèå',
  'Languages'       => 'Çíàíèå ÿçûêîâ',
  'Referred by'     => 'Îòêóäà óçíàëè',
);

/* user_stats */

$lang['your_user_stats'] = 'Âàøà ïîëüçîâàòåëüñêàÿ ñòàòèñòèêà';
$lang['other_user_stats'] = 'Äðóãàÿ ïîëüçîâàòåëüñêàÿ ñòàòèñòèêà';

$lang['user_stats'] = 'Ïîëüçîâàòåëüñêàÿ ñòàòèñòèêà';
$lang['users_match_your_search'] = 'Ïîëüçîâàòåëè, êîòîðûå ïîäïàäàþò ïîä êðèòåðèè âàøåãî ïîèñêà';
$lang['in_your_country'] = 'Ïîëüçîâàòåëè, êîòîðûå æèâóò â Âàøåé ñòðàíå';
$lang['in_your_state'] = 'Ïîëüçîâàòåëè, êîòîðûå æèâóò â Âàøåé îáëàñòè/ïðîâèíöèè';
$lang['in_your_county'] = 'Ïîëüçîâàòåëè, êîòîðûå æèâóò â Âàøåé ñòðàíå/îáëàñòè';
$lang['in_your_city'] = 'Ïîëüçîâàòåëè, êîòîðûå æèâóò â Âàøåì ãîðîäå';
$lang['in_your_zip'] = 'Ïîëüçîâàòåëè, ó êîòîðûõ Âàø ïî÷òîâûé èíäåêñ';
$lang['in_same_gender'] = 'Ïîëüçîâàòåëè Âàøåãî ïîëà';
$lang['in_same_age'] = 'Ïîëüçîâàòåëè Âàøåãî âîçðàñòà';
$lang['above_lookagestart'] = 'Ïîëüçîâàòåëè, âûøå ìîåãî íà÷àëüíîãî âîçðàñòíîãî ïðåäåëà';
$lang['below_lookageend'] = 'Ïîëüçîâàòåëè, íèæå ìîåãî êîíå÷íîãî âîçðàñòíîãî ïðåäåëà';
$lang['your_lookgender'] = 'Ïîëüçîâàòåëè, êîòîðûå ïîäïàäàþò ïîä Âàøè ïîëîâûå ïðåäïî÷òåíèÿ';
$lang['in_look_country'] = 'Ïîëüçîâàòåëè, êîòîðûå æèâóò â ñòðàíå Âàøåãî ïîèñêà';
$lang['in_look_state'] = 'Ïîëüçîâàòåëè, êîòîðûå æèâóò â îáëàñòè/ïðîâèíöèè Âàøåãî ïîèñêà';
$lang['in_look_county'] = 'Ïîëüçîâàòåëè, êîòîðûå æèâóò â ñòðàíå/îáëàñòè Âàøåãî ïîèñêà';
$lang['in_look_city'] = 'Ïîëüçîâàòåëè, êîòîðûå æèâóò â ãîðîäå Âàøåãî ïîèñêà';
$lang['in_look_zip'] = 'Ïîëüçîâàòåëè, ó êîòîðûõ ïî÷òîâûé èíäåêñ Âàøåãî ïîèñêà';
$lang['in_same_timezone'] = 'Ïîëüçîâàòåëè, êîòîðûå æèâóò â Âàøåì ÷àñîâîì ïîÿñå';
$lang['album_hdr'] = 'Àëüáîì';
$lang['public'] = 'Ïóáëè÷íûé';
$lang['calendar_admin'] = 'Àäìèíèñòðàòîð Êàëåíäàðÿ';

$lang['mysettings'] = 'Ìîè íàñòðîéêè';
$lang['user_lists'] = 'Ïàïêè';
$lang['login_settings'] = 'Ëîãèí, ïàðîëü';
$lang['no_pics'] = 'Íåò ôîòîãðàôèé';
$lang['my_page'] = 'Ìîÿ ñòðàíèöà';
$lang['write_new_msg'] = 'Íàïèñàòü íîâîå ñîîáùåíèå';
$lang['view_winkslist'] = 'Ïðîñìîòðåòü ïîäìèãèâàíèÿ';

// Import module
$lang['manage_import'] = 'Èìïîðò';
$lang['manage_import_datingpro'] = 'Èìïîðò èç DatingPro';
$lang['manage_import_aedating'] = 'Èìïîðò èç aeDating';
$lang['manage_import_section'] = 'Âûáåðèòå ìîäóëü èìïîðòà';
$lang['manage_import_select'] = 'Âûáåðèòå, ÷òî èìïîðòèðîâàòü';
$lang['module'] = 'Ìîäóëü';
$lang['imported'] = 'Èìïîðòèðîâàí';
$lang['import'] = 'Èìïîðò';
$lang['empty'] = 'Ïóñòî';
$lang['select_section'] = 'Âûáåðèòå ñåêöèè äëÿ âîïðîñîâ';
$lang['import_db_configuration'] = 'Âûáåðèòå êîíôèãóðàöèþ áàçû äàííûõ èñòî÷íèêà';
$lang['db_name'] = 'Èìÿ ÁÄ:';
$lang['db_host'] = 'Õîñò ÁÄ:';
$lang['db_user'] = 'Þçåð ÁÄ:';
$lang['db_pass'] = 'Ïàðîëü ÁÄ:';
$lang['db_prefix'] = 'Ïðåôèêñ òàáëèö:';


// Calendar
$lang['calendar_title'] = 'Óïðàâëåíèå êàëåíäàðåì';
$lang['total_calendars'] = 'Âñåãî êàëåíäàðåé:';
$lang['modify_calendar'] = 'Èçìåíèòü êàëåíäàðü';
$lang['modify_calendars'] = 'Èçìåíèòü êàëåíäàðè';
$lang['delete_calendar'] = 'Óäàëèòü êàëåíäàðü';
$lang['delete_calendars'] = 'Óäàëèòü êàëåíäàðè';

// Calendar Events
$lang['events_title'] = 'Óïðàâëåíèå ñîáûòèÿìè';
$lang['insert_event'] = 'Äîáàâèòü ñîáûòèå';
$lang['modify_event'] = 'Èçìåíèòü ñîáûòèå';
$lang['total_events'] = 'Âûáðàííûå ñîáûòèÿ';
$lang['event'] = 'Ñîáûòèå:';
$lang['calendar_field'] = 'Êàëåíäàðü:';
$lang['private_to'] = '×àñòíûé ê:';
$lang['date_from'] = 'Äàòà íà÷àëà';
$lang['date_to'] = 'Äàòà îêîí÷àíèÿ:';
$lang['col_head_calendar'] = 'Êàëåíäàðü';
$lang['col_head_username'] = 'Èìÿ ïîëüçîâàòåëÿ';
$lang['col_head_fullname'] = 'Ïîëíîå èìÿ';
$lang['col_head_event'] = 'Ñîáûòèå';
$lang['col_head_datefrom'] = 'Äàòà íà÷àëà';
$lang['col_head_dateto'] = 'Äàòà îêîí÷àíèÿ';
$lang['col_head_date'] = 'Äàòà';
$lang['col_head_description'] = 'Îïèñàíèå';

$lang['calendar_title'] = 'Êàëåíäàðü';
$lang['calendar'] = 'Êàëåíäàðü:';
$lang['event_title'] = 'Ñîáûòèå';
$lang['add_event'] = 'Äîáàâèòü ñîáûòèå';
$lang['delete_calendar_group_confirm_msg'] = 'Âû óâåðåíû, ÷òî õîòèòå óäàëèòü ýòè êàëåíäàðè? Ýòî äåéñòâèå íå ìîæåò áûòü îòìåíåíî.';
$lang['private_only'] = 'Òîëüêî ÷àñòíûå';
$lang['public_only'] = 'Òîëüêî ïóáëè÷íûå';
$lang['public_private'] = 'Ïóáëè÷íûå è ÷àñòíûå';
$lang['total_events_found'] = 'Âñåãî íàéäåíî ñîáûòèé:';
$lang['start_date'] = 'Äàòà íà÷àëà';
$lang['start_time'] = 'Âðåìÿ íà÷àëà';
$lang['end_date'] = 'Äàòà îêîí÷àíèÿ';
$lang['end_time'] = 'Âðåìÿ îêîí÷àíèÿ';
$lang['event_description'] = 'Îïèñàíèå ñîáûòèÿ';

$lang['more_events'] = 'åùå ñîáûòèÿ >>';
$lang['daily_events_list'] = "Ñïèñîê ñîáûòèé ";
$lang['add_to_private'] = "Äîáàâèòü ê ïðèâàòíîìó ñïèñêó";
$lang['close_window'] = 'Çàêðûòü îêíî';
$lang['main_window_closed'] = "Èçâèíèòå, Âû çàêðûëè ãëàâíîå îêíî.";
$lang['user_added1'] = "Ïîëüçîâàòåëü ";
$lang['user_added2'] = " äîáàâëåí â ïðèâàòíûé ñïèñîê";
$lang['next_month'] = 'Ñëåäóþùèé ìåñÿö';
$lang['previous_month'] = 'Ïðåäûäóùèé ìåñÿö';
$lang['next_week'] = 'Ñëåäóþùàÿ íåäåëÿ';
$lang['previous_week'] = 'Ïðåäûäóùàÿ íåäåëÿ';
$lang['next_day'] = 'Ñëåäóþùèé äåíü';
$lang['previous_day'] = 'Ïðåäûäóùèé äåíü';
$lang['view_day'] = 'Ïðîñìîòð äíÿ';
$lang['view_week'] = 'Ïðîñìîòð íåäåëè';
$lang['view_month'] = 'Ïðîñìîòð ìåñÿöà';

$lang['watched_events'] = 'Ñîáûòèÿ, êîòîðûå Âû ïðîñìàòðèâàåòå';
$lang['event_notification'] = 'Óâåäîìëåíèå ñîáûòèÿ';

$lang['jump_to'] = 'Ïåðåéòè ê';
$lang['ok'] = 'ÎÊ';

$lang['recurring'] = "Âîçâðàòíûé:";
$lang['recur_every'] = "êàæäûé";

$lang['recuring_labels'] = array(
  '0' => 'íèêîãäà',
  '1' => 'åæåäíåâíî',
  '2' => 'åæåíåäåëüíî',
  '3' => 'åæåìåñÿ÷íî',
  '4' => 'åæåãîäíî'
  );

$lang['calendat_filter_dates_range'] = "Âûáðàííûé äèàïàçîí äàò";
$lang['calendat_filter_last_year'] = "Ïðîøëûé ãîä";
$lang['calendat_filter_last_month'] = "Ïðîøëûé ìåñÿö";
$lang['calendat_filter_last_week'] = "Ïðîøëàÿ íåäåëÿ";
$lang['calendat_filter_yesterday'] = "Â÷åðà";


$lang['cannot_determine_membership'] = 'Âàø óðîâåíü ÷ëåíñòâà íå ìîæåò áûòü îïðåäåëåí';
$lang['no_previous_polls'] = 'Íåò ïðåäûäóùèõ îïðîñîâ.';
$lang['no_event_for_the_day'] = "Íåò ñîáûòèé äëÿ ýòîé äàòû";
$lang['maxsize'] = 'Ìàêñèìàëüíî ðàçðåøåííûé ðàçìåð (KB)';
$lang['views'] = 'Ïðîñìîòðîâ';

/******************************************/
/* ALL ERROR MESSAGES ARE DEFINED BELOW.  */
/******************************************/

// Affiliates error
$lang['affiliates_error'] = array(
  18=>'Ïàðîëè íå ñîâïàäàþò',
  20=>'Âñå ïîëÿ îáÿçàòåëüíû äëÿ çàïîëíåíèÿ.',
  21=>'Âñå ïîëÿ îáÿçàòåëüíû äëÿ çàïîëíåíèÿ.',
  25=>'Àäðåñ e-mail, êîòðûé Âû ââåëè, óæå çàðåãèñòðèðîâàí êàê ïàðòíåð. Ïîæàëóéñòà, ââåäèòå äðóãîé e-mail àäðåñ.'
);


// Javascript error messages
$lang['admin_js_error_msgs'] = array(
  '',
  'Ïîæàëóéñòà, ñíà÷àëà ïîñòàâüòå ãàëî÷êó.',
  'Âû óâåðåíû, ÷òî õîòèòå óäàëèòü?',
  'Âû óâåðåíû, ÷òî õîòèòå óäàëèòü ýòîò áàííåð?'
  );

$lang['admin_js__delete_error_msgs'] = array('',
  1=> 'Âû óâåðåíû, ÷òî õîòèòå ñòåðåòü ýòó ñåêöèþ? Ýòî äåéñòâèå íå ñìîæåò áûòü îòìåíåíî.',
  2=> 'Âû óâåðåíû, ÷òî õîòèòå ñòåðåòü ýòîò âîïðîñ èç ýòîé ñåêöèè? Ýòî äåéñòâèå íå ñìîæåò áûòü îòìåíåíî.',
  3=> 'Âû óâåðåíû, ÷òî õîòèòå ñòåðåòü âàðèàíò ýòîãî âîïðîñà? Ýòî äåéñòâèå íå ñìîæåò áûòü îòìåíåíî.',
  4=> 'Âû óâåðåíû, ÷òî õîòèòå ñòåðåòü ýòó àíêåòó? Ýòî äåéñòâèå íå ñìîæåò áûòü îòìåíåíî.',
  5=> 'Âû óâåðåíû, ÷òî õîòèòå ñòåðåòü ýòó íîâîñòü? Ýòî äåéñòâèå íå ñìîæåò áûòü îòìåíåíî.',
  6=> 'Âû óâåðåíû, ÷òî õîòèòå ñòåðåòü ýòó èñòîðèþ? Ýòî äåéñòâèå íå ñìîæåò áûòü îòìåíåíî.',
  7=> 'Âû óâåðåíû, ÷òî õîòèòå ñòåðåòü ýòó ñòàòüþ? Ýòî äåéñòâèå íå ñìîæåò áûòü îòìåíåíî.',
  8=> 'Âû óâåðåíû, ÷òî õîòèòå ñòåðåòü ýòîò îïðîñ? Ýòî äåéñòâèå íå ñìîæåò áûòü îòìåíåíî.',
  9=> 'Âû óâåðåíû, ÷òî õîòèòå ñòåðåòü âàðèàíò ýòîãî îïðîñà? Ýòî äåéñòâèå íå ñìîæåò áûòü îòìåíåíî.',
  10=> 'Âû óâåðåíû, ÷òî õîòèòå ñòåðåòü ýòîò áàííåð? Ýòî äåéñòâèå íå ñìîæåò áûòü îòìåíåíî.',
  11=> 'Âû óâåðåíû, ÷òî õîòèòå ñòåðåòü ýòîãî àäìèíà? Ýòî äåéñòâèå íå ñìîæåò áûòü îòìåíåíî.',
/* Added in RC6 */
  12=>'Âû óâåðåíû, ÷òî õîòèòå ñòåðåòü ýòó ñòðàíó?',
  13=>'Âû óâåðåíû, ÷òî õîòèòå ñòåðåòü ýòó îáëàñòü?',
  14=>'Âû óâåðåíû, ÷òî õîòèòå ñòåðåòü ýòè ñòðàíû?',
  15=>'Âû óâåðåíû, ÷òî õîòèòå ñòåðåòü ýòè îáëàñòè?',
  16=>'Ïðè ðàñøèðåííîì ïîèñêå äîëæåí áûòü çàäàí çàãîëîâîê ðàñøèðåííîãî ïîèñêà.',
  17 => 'Â ñëó÷àå èíòåðâàëà èìåí ïîëüçîâàòåëåé äîëæíû áûòü çàäàíû íà÷àëüíîå è êîíå÷íîå.',
  18 => 'Âû óâåðåíû, ÷òî õîòèòå ñòåðåòü ýòè àíêåòû?\nÝòî äåéñòâèå íå ñìîæåò áûòü îòìåíåíî.',
/* Added Release 1.0 */
  19=>'Âû óâåðåíû, ÷òî õîòèòå ñòåðåòü ýòó ñòðàíó/îáëàñòü?',
  20=>'Âû óâåðåíû, ÷òî õîòèòå ñòåðåòü ýòè ñòðàíû/ îáëàñòè?',
  21=>'Âû óâåðåíû, ÷òî õîòèòå ñòåðåòü ýòîò ãîðîä?',
  22=>'Âû óâåðåíû, ÷òî õîòèòå ñòåðåòü ýòè ãîðîäà?',
  23=>'Âû óâåðåíû, ÷òî õîòèòå ñòåðåòü ýòîò ïî÷òîâûé èíäåêñ?',
  24=>'Âû óâåðåíû, ÷òî õîòèòå ñòåðåòü ýòè ïî÷òîâûå èíäåêñû?',

  25 => 'Âû óâåðåíû, ÷òî õîòèòå ñòåðåòü ñîáûòèå? Ýòî äåéñòâèå íå ñìîæåò áûòü îòìåíåíî.',
  26 => 'Âû óâåðåíû, ÷òî õîòèòå ñòåðåòü ýòîò êàëåíäàðü? Ýòî äåéñòâèå íå ñìîæåò áûòü îòìåíåíî.',
  27 => 'Âû óâåðåíû, ÷òî õîòèòå ñòåðåòü ýòó ñòðàíèöó? Ýòî äåéñòâèå íå ñìîæåò áûòü îòìåíåíî.',
  );


// Don't use double qoutes(") in the item's text
$lang['signup_js_errors'] = array(
	'username_noblank' => 'Ïîæàëóéñòà, ââåäèòå èìÿ ïîëüçîâàòåëÿ.' ,
	'password_noblank' => 'Ïîæàëóéñòà, ââåäèòå ïàðîëü.',
	'old_password_noblank' => 'Äîëæåí áûòü óêàçàí ñòàðûé ïàðîëü.',
	'new_password_noblank' => 'Äîëæåí áûòü óêàçàí íîâûé ïàðîëü.',
	'con_password_noblank' => 'Äîëæíî áûòü óêàçàíî ïîäòâåðæäåíèå íîâîãî ïàðîëÿ.',
	'firstname_noblank' => 'Èìÿ äîëæíî áûòü óêàçàíî.',
	'name_noblank' => 'Ïîæàëóéñòà, ââåäèòå Âàøå èìÿ.',
	'lastname_noblank' => 'Ôàìèëèÿ äîëæíà áûòü óêàçàíà.',
	'e-mail_noblank' => 'E-mail àäðåñ äîëæåí áûòü óêàçàí.',
	'city_noblank' => 'Ãîðîä äîëæåí áûòü óêàçàí.',
	'zip_noblank' => 'Ïî÷òîâûé èíäåêñ äîëæåí áûòü óêàçàí.',
	'address1_noblank' => 'Àäðåñ (ïî êðàéíåé ìåðå îäèí) äîëæåí áûòü óêàçàí.',
	'sectionname_noblank' => 'Ïîæàëóéñòà, ââåäèòå èìÿ ýòîé ñåêöèè.',
	'sendname_noblank' => 'Ïîæàëóéñòà, ââåäèòå èìÿ ïîñûëàþùåãî.',
	'calendarname_noblank' => 'Ïîæàëóéñòà, ââåäèòå èìÿ ýòîãî êàëåíäàðÿ.',
	'comments_noblank' => 'Ïîæàëóéñòà, ââåäèòå êîììåíòàðèè, êîòîðûå Âû õîòåëè îòïðàâèòü.',
	'question_noblank' => 'Ïîæàëóéñòà, ââåäèòå âîïðîñ.',
	'extsearchhead_noblank' => 'Ïîæàëóéñòà, ââåäèòå çàãîëîâîê ðàñøèðåííîãî ïîèñêà.',
	'username_charset' => 'Â èìåíè ïîëüçîâàòåëÿ (username) äîïóñêàþòñÿ òîëüêî ëàòèíñêèå áóêâû, öèôðû è çíàê ïîä÷åðêèâàíèÿ.',
	'password_charset' => 'Â ïàðîëå äîïóñêàþòñÿ òîëüêî áóêâû, öèôðû è çíàê ïîä÷åðêèâàíèÿ.',
	'firstname_charset' => 'Â èìåíè äîïóñêàþòñÿ òîëüêî áóêâû.',
	'lastname_charset' => 'Â ôàìèëèè äîïóñêàþòñÿ òîëüêî áóêâû.',
	'city_charset' => 'Èìÿ ãîðîäà äîëæíî íà÷èíàòüñÿ íà áóêâó.',
	'zip_charset' => 'Â ïî÷òîâîì èíäåêñå äîïóñêàþòñÿ òîëüêî öèôðû.',
	'address_charset' => 'Ïîæàëóéñòà, ââåäèòå ïðàâèëüíûé àäðåñ.',
	'sectionname_charset' => 'Â èìåíè ñåêöèè äîïóñêàþòñÿ òîëüêî áóêâû.',
	'calendarname_charset' => 'Â èìåíè êàëåíäàðÿ äîïóñêàþòñÿ òîëüêî áóêâû.',
	'sendname_charset' => 'Â èìåíè îòïðàâèòåëÿ äîïóñêàþòñÿ òîëüêî áóêâû.',
	'name_charset' => 'Ïîæàëóéñòà, äëÿ èìåíè èñïîëüçóéòå òîëüêî áóêâû.',
	'maxlength_charset' => 'Ïîæàëóéñòà, ââåäèòå ÷èñëî - äëÿ ìàêñèìàëüíîé äëèíû.',
	'e-mail_notvalid' => 'Íåâåðíûé àäðåñ ïî÷òû.',
	'password_nomatch' => 'Ïàðîëè íå ñîâïàäàþò.',
	'password_outrange' => 'Ïàðîëü äîëæåí áûòü óêàçàííîé äëèíû.',
	'username_outrange' => 'Èìÿ ïîëüçîâàòåëÿ äîëæíî áûòü íå êîðî÷å è íå äëèííåå, ÷åì óêàçàíî.',
	'username_start_alpha' => 'Èìÿ ïîëüçîâàòåëÿ äîëæíî íà÷èíàòüñÿ ñ áóêâû.',
	'ccowner_noblank' => 'Âëàäåëåö êðåäèòíîé êàðòû äîëæåí áûòü óêàçàí.',
	'ccnumber_noblank' => 'Íîìåð êðåäèòíîé êàðòû äîëæåí áûòü óêàçàí.',
	'cvvnumber_noblank' => 'Íîìåð ïðîâåðêè êðåäèòíîé êàðòû (CVV è ò.ï.) äîëæåí áûòü óêàçàí.',
	'select_payment' => 'Ïîæàëóéñòà, óêàæèòå ñíà÷àëà ñïîñîá îïëàòû.',
  'stateprovince_noblank' => 'Îáëàñòü/ïðîâèíöèÿ äîëæíà áûòü óêàçàíà.',
  'subject_noblank' => 'Òåìà ïèñüìà äîëæíà áûòü óêàçàíà.',
  'county_noblank' => 'Ñòðàíà/ îáëàñòü äîëæíà áûòü óêàçàíà.',
  'county_charset' => 'Â íàçâàíèè ñòðàíû/îáëàñòè äîïóñêàþòñÿ òîëüêî áóêâû.',
  'timezone_noblank' => '×àñîâîé ïîÿñ äîëæåí áûòü âûáðàí.',
/* Added in 2.0 */
  'ratingname_noblank' => 'Íàçâàíèå ðåéòèíãà äîëæíî áûòü óêàçàíî.',
  'ratingname_charset' => 'Íåïðàâèëüíûå ñèìâîëû â íàçâàíèè ðåéòèíãà.',
  'about_me_noblank'  => 'Âû äîëæíû íàïèñàòü î ñåáå.',
  );

$lang['letter_errormsgs'] = array(
  0 => 'Âàø ïàðîëü îòîñëàí Âàì ïî ïî÷òå. Ïîæàëóéñòà, ïðîâåðüòå Âàø ïî÷òîâûé ÿùèê.',
  1 => 'Ïîæàëóéñòà, óêàæèòå àäðåñ ýëåêòðîííîé ïî÷òû, êîòîðûé Âû èñïîëüçîâàëè ïðè ðåãèñòðàöèè.',
  2 => 'Øàáëîí ïèñüìà äëÿ ñëó÷àÿ óòåðÿííîãî ïàðîëÿ íå íàéäåí. Ïîæàëóéñòà, ñâÿæèòåñü ñ àäìèíèñòðàòîðîì.',
  4 => 'Âîçíèêëà ïðîáëåìà ïðè ïîñûëêå ýëåêòðîííîãî ñîîáùåíèÿ. Ïîæàëóéñòà, ñâÿæèòåñü ñ àäìèíèñòðàòîðîì.',
  5 => 'Âû íå ÿâëÿåòåñü çàðåãèñòðèðîâàííûì ïîëüçîâàòåëåì ñàéòà SITENAME. Ïîæàëóéñòà, óêàæèòå àäðåñ ýëåêòðîííîé ïî÷òû, êîòîðûé Âû èñïîëüçîâàëè ïðè ðåãèñòðàöèè.'
  );

$lang['taf_errormsgs'] = array(
  0 => 'Ïðèãëàøåíèå ïîñëàíî.',
  'sendername_noblank' => 'Ïîæàëóéñòà, ââåäèòå Âàøå èìÿ.',
  'senderemail_noblank' => 'Ïîæàëóéñòà, ââåäèòå Âàø àäðåñ ýëåêòðîííîé ïî÷òû.',
  'recipientemail_noblank' => 'Ïîæàëóéñòà, ââåäèòå àäðåñ ýëåêòðîííîé ïî÷òû ïîëó÷àòåëÿ.',
  'sendername_charset' => 'Ïîæàëóéñòà, ââåäèòå òîëüêî áóêâû â Âàøåì èìåíè.',
  'senderemail_charset' => 'Ïîæàëóéñòà, ââåäèòå ïðàâèëüíûé àäðåñ ýëåêòðîííîé ïî÷òû.',
  'recipientemail_charset' => 'Ïîæàëóéñòà, ââåäèòå ïðàâèëüíûé àäðåñ ýëåêòðîííîé ïî÷òû ïîëó÷àòåëÿ.',
  2 => 'Øàáëîí ïèñüìà äëÿ ïðèãëàøåíèÿ äðóãà íå íàéäåí. Ïîæàëóéñòà, ñâÿæèòåñü ñ àäìèíèñòðàòîðîì.',
  3 => 'Âîçíèêëà ïðîáëåìà ïðè ïîñûëêå ïðèãëàøåíèÿ. Ïîæàëóéñòà, ñâÿæèòåñü ñ àäìèíèñòðàòîðîì.',
  );
$lang['pages_errormsgs'] = array( '',
  1 => 'Çàãîëîâîê ñòðàíèöû îòñóòñòâóåò.',
  2 => 'Êëþ÷ ñòðàíèöû îòñóòñòâóåò.',
  3 => 'Òåêñò ñòðàíèöû îòñóòñòâóåò.',
  4 => 'Òàêîé êëþ÷ ñòðàíèöû óæå åñòü. Ïîæàëóéñòà, âûáåðèòå äðóãîé êëþ÷.',
  5 => 'Ñòðàíèöà óäàëåíà.',
  );

$lang['article_error'] = array(
  1 => 'Çàãîëîâîê ñòàòüè - îáÿçàòåëüíîå äëÿ çàïîëíåíèÿ ïîëå.',
  2 => 'Òåêñò ñòàòüè - îáÿçàòåëüíîå äëÿ çàïîëíåíèÿ ïîëå.',
  3 => 'Äàòà ñòàòüè - îáÿçàòåëüíîå äëÿ çàïîëíåíèÿ ïîëå.'
);
$lang['story_error'] = array(
  1 => 'Çàãîëîâîê èñòîðèè - îáÿçàòåëüíîå äëÿ çàïîëíåíèÿ ïîëå.',
  2 => 'Òåêñò  èñòîðèè - îáÿçàòåëüíîå äëÿ çàïîëíåíèÿ ïîëå.',
  3 => 'Äàòà èñòîðèè - îáÿçàòåëüíîå äëÿ çàïîëíåíèÿ ïîëå.',
  4 => 'Àâòîð èñòîðèè - îáÿçàòåëüíîå äëÿ çàïîëíåíèÿ ïîëå.'
);
$lang['news_error'] = array(
  1 => 'Çàãîëîâîê íîâîñòè - îáÿçàòåëüíîå äëÿ çàïîëíåíèÿ ïîëå.',
  2 => 'Òåêñò íîâîñòè - îáÿçàòåëüíîå äëÿ çàïîëíåíèÿ ïîëå.',
  3 => 'Äàòà íîâîñòè - îáÿçàòåëüíîå äëÿ çàïîëíåíèÿ ïîëå.'
);

$lang['mship_errors'] = array (
  1=> 'Èìÿ - îáÿçàòåëüíîå äëÿ çàïîëíåíèÿ ïîëå.',
  2=> 'Öåíà - îáÿçàòåëüíîå äëÿ çàïîëíåíèÿ ïîëå.',
  3=> 'Âàëþòà - îáÿçàòåëüíîå äëÿ çàïîëíåíèÿ ïîëå.',
  4 => 'Ñïîñîá îïëàòû "îòñóòñòâóåò" ìîæåò áûòü âûñòàâëåíî òîëüêî êîãäà óðîâåíü ÷ëåíñòâà ìåíÿåòñÿ íà "Áåñïëàòíûé".'
);
$lang['admin_error_msgs'] = array (
  '',
  'Ñåêöèÿ - îáÿçàòåëüíîå äëÿ çàïîëíåíèÿ ïîëå.',
  'Ïîæàëóéñòà, çàïîëíèòå âñå òðåáóåìûå ïîëÿ.'
  );
$lang['admin_error'] = array(
  '',
  1 => 'Èìÿ ïîëüçîâàòåëÿ àäìèíà íå ìîæåò áûòü ïóñòûì.',
  2 => 'Ïàðîëü àäìèíà íå ìîæåò áûòü ïóñòûì.',
  3 => 'Ïîëíîå èìÿ àäìèíà íå ìîæåò áûòü ïóñòûì.',
  4 => 'Ñòàðûé ïàðîëü íå ìîæåò áûòü ïóñòûì.',
  5 => 'Íîâûé ïàðîëü íå ìîæåò áûòü ïóñòûì.',
  6 => 'Ïîäòâåðæäåíèå íîâîãî ïàðîëÿ íå ìîæåò áûòü ïóñòûì.',
  7 => 'Íîâûé ïàðîëü è åãî ïîäòâåðæäåíèå íå ñîâïàäàþò.',
  8 => 'Ñòàðûé ïàðîëü, êîòîðûé Âû ââåëè - íåâåðåí. Ïîæàëóéñòà, ïîïðîáóéòå ñíîâà.',
  9 => 'Óêàçàííîå èìÿ ïîëüçîâàòåëÿ óæå çàíÿòî. Ïîæàëóéñòà, âûáåðèòå äðóãîå.',
  /* added in 1.1.0 */
  10 => 'Ïîæàëóéñòà, èñïîëüçóéòå òîëüêî òåêñòîâûå çíà÷åíèÿ â èìåíè ñåêöèè'
);

$lang['banner_error_msgs'] = array( '',
  1 => 'Ïîëå Áàííåð íå ìîæåò áûòü îñòàâëåíî ïóñòûì.',
  2 => 'Ïîëå URL ññûëêè íå ìîæåò áûòü îñòàâëåíî ïóñòûì.',
  3 => 'Ïîëå ïîäñêàçêè íå ìîæåò áûòü îñòàâëåíî ïóñòûì.',
  4 => 'Äîïóñêàþòñÿ òîëüêî .jpg áàííåðû.'
);
$lang['poll_error'] = array(
  1 => 'Ïîëå Îïðîñ íå ìîæåò áûòü ïóñòûì.',
  2 => 'Ïîëå Äàòà îïðîñà íå ìîæåò áûòü ïóñòûì.',
  3 => 'Ïîëå Âàðèàíò íå ìîæåò áûòü ïóñòûì.',
  'txtpoll_noblank'  => 'Ïîëå Îïðîñ - îáÿçàòåëüíî äëÿ çàïîëíåíèÿ.',
  'txtpollopt_noblank'  => 'Ïîëå Âàðèàíò îïðîñà - îáÿçàòåëüíî äëÿ çàïîëíåíèÿ.'
  );

$lang['datetime_month'] = array(
  1=>'ßíâàðü',
  2=>'Ôåâðàëü',
  3=>'Ìàðò',
  4=>'Àïðåëü',
  5=>'Ìàé',
  6=>'Èþíü',
  7=>'Èþëü',
  8=>'Àâãóñò',
  9=>'Ñåíòÿáðü',
  10=>'Îêòÿáðü',
  11=>'Íîÿáðü',
  12=>'Äåêàáðü'
);
$lang['datetime_day'] = array(
  'sunday' => 'Âîñêðåñåíüå',
  'monday' => 'Ïîíåäåëüíèê',
  'tuesday' => 'Âòîðíèê',
  'wednesday' => 'Ñðåäà',
  'thursday' => '×åòâåðã',
  'friday' => 'Ïÿòíèöà',
  'saturday' => 'Ñóááîòà'
);


/* Release 1.0.2   */
$lang['settings_saved'] = 'Íàñòðîéêè óñïåøíî ñîõðàíåíû';
$lang['select_image_first'] = 'Ïîæàëóéñòà, ñíà÷àëà âûáåðèòå èçîáðàæåíèå';

/* Release 1.1.0 additions */
$lang['day_names'] = array(
  'Sun' => 'Âîñêðåñåíüå',
  'Mon' => 'Ïîíåäåëüíèê',
  'Tue' => 'Âòîðíèê',
  'Wed' => 'Ñðåäà',
  'Thu' => '×åòâåðã',
  'Fri' => 'Ïÿòíèöà',
  'Sat' => 'Ñóááîòà'
);
$lang['view_type'] = 'Òèï ïðîñìîòðà';
$lang['remember_me'] = 'Çàïîìíèòü ìåíÿ';
$lang['review'] = 'Îáçîð';
$lang['spammers'] = 'Ñïàìåðû';
$lang['addquestion'] = 'Äîáàâèòü âîïðîñ';
$lang['mainstats'] = 'Ãëàâíàÿ ñòàòèñòèêà';
$lang['osdate_version'] = 'Âåðñèÿ osDate';
$lang['signonstats'] = 'Ñòàòèñòèêà ðåãèñòðàöèé';
$lang['usersinpastminute'] = 'Ïîëüçîâàòåëè çà ïðîøëóþ ìèíóòó';
$lang['usersinpasthour'] = 'Ïîëüçîâàòåëè çà ïðîøëûé ÷àñ';
$lang['usersinpastday'] = 'Ïîëüçîâàòåëè çà ïðîøëûé äåíü';
$lang['usersinpastweek'] = 'Ïîëüçîâàòåëè çà ïðîøëóþ íåäåëþ';
$lang['usersinpastmonth'] = 'Ïîëüçîâàòåëè çà ïðîøëûé ìåñÿö';
$lang['usersinpastyear'] = 'Ïîëüçîâàòåëè çà ïðîøëûé ãîä';
$lang['usersinpast2years'] = 'Ïîëüçîâàòåëè çà ïðîøëûå 2 ãîäà';
$lang['usersinpast5years'] = 'Ïîëüçîâàòåëè çà ïðîøëûå 5 ëåò';
$lang['usersinpast10years'] = 'Ïîëüçîâàòåëè çà ïðîøëûå 10 ëåò';
$lang['userstats'] = 'Ñòàòèñòèêà ïîëüçîâàòåëåé';
$lang['totalusers'] = 'Âñåãî ïîëüçîâàòåëåé';
$lang['totalactiveusers'] = 'Âñåãî àêòèâíûõ ïîëüçîâàòåëåé';
$lang['totalpendingusers'] = 'Âñåãî ïîëüçîâàòåëåé, æäóùèõ ïîäòâåðæäåíèÿ';
$lang['totalsuspendedusers'] = 'Âñåãî ïðèîñòàíîâëåííûõ ïîëüçîâàòåëåé';
$lang['totalpictureusers'] = 'Âñåãî ïîëüçîâàòåëåé ñ ôîòîãðàôèÿìè';
$lang['totalonlineusers'] = 'Ïîëüçîâàòåëè îíëàéí';
$lang['visitorstats'] = 'Ñòàòèñòèêà ïîñåòèòåëåé';
$lang['sitestats'] = 'Ñòàòèñòèêà ñàéòà';
$lang['visitorstosite'] = 'Ïîñåòèòåëè ñàéòà';
$lang['mostactivepage'] = 'Ñàìàÿ àêòèâíàÿ ñòðàíèöà';
$lang['timesfeedback'] = 'Êîëè÷åñòâî èñïîëüçîâàíèÿ ôîðìû îáðàòíîé ñâÿçè';
$lang['timesim'] = 'Êîëè÷åñòâî èñïîëüçîâàíèé IM';
$lang['timeswink'] = 'Êîëè÷åñòâî ïîäìèãèâàíèé';
$lang['timesmessage'] = 'Êîëè÷åñòâî ïî÷òîâûõ ñîîáùåíèé';
$lang['timesinvitefriend'] = 'Êîëè÷åñòâî ïðèãëàøåíèé äðóçåé';
$lang['timeshowprofile'] = 'Êîëè÷åñòâî ïîêàçîâ àíêåò';
$lang['timesonlineusers'] = 'Êîëè÷åñòâî êëèêîâ ïî îíëàéí ïîëüçîâàòåëÿì';
$lang['timesbanner'] = 'Êîëè÷åñòâî êëèêîâ ïî áàííåðàì';
$lang['timesnewmember'] = 'Êîëè÷åñòâî êëèêîâ ïî ñïèñêó íîâûõ ÷ëåíîâ';
$lang['timespoll'] = 'Êîëè÷åñòâî èñïîëüçîâàíèÿ îïðîñîâ';
$lang['timesgallery'] = 'Êîëè÷åñòâî èñïîëüçîâàíèÿ ãàëåðåè';
$lang['timesaffiliates'] = 'Êîëè÷åñòâî êëèêîâ ïàðòíåðîâ';
$lang['timessignup'] = 'Êîëè÷åñòâî êëèêîâ ïî ðåãèñòðàöèè';
$lang['timesnews'] = 'Êîëè÷åñòâî êëèêîâ ïî íîâîñòÿì';
$lang['timesstories'] = 'Êîëè÷åñòâî êëèêîâ ïî èñòîðèÿì';
$lang['timessearchmatch'] = 'Êîëè÷åñòâî êëèêîâ ïî ðåçóëüòàòàì ïîèñêà';
$lang['no_affiliates'] = '×èñëî ïàðòíåðîâ';
$lang['no_affiliate_refs'] = '×èñëî ïàðòíåðñêèõ ññûëîê';
$lang['no_pages_refs'] = '×èñëî ññûëàþùèõñÿ ñòðàíèö';
$lang['no_polls'] = 'Êîëè÷åñòâî îïðîñîâ';
$lang['no_news'] = 'Êîëè÷åñòâî íîâûõ ýëåìåíòîâ';
$lang['no_stories'] = 'Êîëè÷åñòâî èñòîðèé';
$lang['no_langs'] = 'Êîëè÷åñòâî äîñòóïíûõ ÿçûêîâ';
$lang['glblgroups'] = 'Ãðóïïà ãëîáàëüíûõ íàñòðîåê';
$lang['accept_tos'] = 'ß ïðî÷èòàë è ïîäòâåðæäàþ <a href="javascript:popUpScrollWindow('."'tos.php','center',650,600);".'">Ïðàâèëà ïîëüçîâàíèÿ</a>';
$lang['tos_must'] = 'Ïîæàëóéñòà, ïðî÷èòàéòå è ïîäòâåðäèòå Ïðàâèëà ïîëüçîâàíèÿ ïåðåä ðåãèñòðàöèåé';
$lang['private_event'] = 'Ýòî ÷àñòíàÿ èíôîðìàöèÿ ñîáûòèÿ';
$lang['posted_by'] = 'Ïðèñëàíî ';

$lang['countries01']='Ñòðàíû';
$lang['states01'] = 'Îáëàñòè';
$lang['latitude'] = 'Øèðîòà';
$lang['longitude'] = 'Äîëãîòà';
$lang['search_within'] = 'Ïîèñê âíóòðè';
$lang['miles'] = ' ìèëåé ';
$lang['kms'] = ' êèëîìåòðîâ ';
$lang['no_search_results'] = '<font color=red><b>Íàéäåíî 0 ðåçóëüòàòîâ</b></font><br /><br />Íå íàéäåíî íè îäíîãî ðåçóëüòàòà, ñîîòâåòñòâóþùåãî Âàøåìó çàïðîñó. Âîçìîæíî Âû èñïîëüçóåòå î÷åíü òî÷íûé ïîèñê. Ïîïðîáóéòå óìåíüøèòü êîëè÷åñòâî êðèòåðèåâ, íàïðèìåð èùèòå ïî ðîñòó è âîçðàñòó, à íå ïî ðîñòó, âîçðàñòó è òåëåñëîæåíèþ. Èëè ðàñøèðüòå äèàïàçîí ïîèñêà, íàïðèìåð âìåñòî ïîèñêà ëþäåé ñ âîçðàñòîì 40 - 50, èùèòå ëþäåé ñ âîçðàñòîì 30 - 60.<br /><br />';
$lang['expire_on'] = '×ëåíñòâî èñòåêàåò';
$lang['expire_in'] = 'Äíåé îñòàëîñü äî èñòå÷åíèÿ ÷ëåíñòâà';
$lang['lang_to_load'] = 'ßçûê äëÿ çàãðóçêè';
$lang['load_lang'] = 'Çàãðóçèòü ÿçûê';
$lang['manage_languages'] = 'Óïðàâëåíèå ÿçûêàìè';
$lang['manage_zips'] = 'Óïðàâëåíèå ïî÷òîâûìè èíäåêñàìè';
$lang['zipfile'] = 'Ôàéë ïî÷òîâûõ èíäåêñîâ';
$lang['zip_loaded'] = 'Ïî÷òîâûå èíäåêñû çàãðóæåíû èç ôàéëà ';
$lang['file_not_found'] = 'Äàííûé ôàéë íå íàéäåí â ñèñòåìå';
/* Modified in 1.1.0 */
$lang['success_mship_change'] = 'Âàø óðîâåíü ÷ëåíñòâà áûë óñïåøíî èçìåíåí íà';
$lang['payment_cancel'] = 'Îïëàòà îòìåíåíà';
$lang['checkout_cancel'] = 'Ïî Âàøåé ïðîñüáå îáðàáîòêà îïëàòû áûëà îòìåíåíà.';
$lang['useronlinetext'] = array(
  'online_now'    =>  'Ñåé÷àñ îíëàéí',
  'active_24hours'  =>  'Àêòèâíûé â ïðåäåëàõ 24 ÷àñà',
  'active_3days'    =>  'Àêòèâíûé â ïðåäåëàõ 3-õ äíåé',
  'active_1week'    =>  'Àêòèâíûé â ïðåäåëàõ 1 íåäåëè',
  'active_1month'   =>  'Àêòèâíûé â ïðåäåëàõ 1 ìåñÿöà',
  'notactive'     =>  'Íåàêòèâíûé'
);
$lang['useronlinecolor'] = array(
  'online_now'    =>  '#FF0000',
  'active_24hours'  =>  '#00AA00',
  'active_3days'    =>  '#AA00A0',
  'active_1week'    =>  '#0000AA',
  'active_1month'   =>  '#000000',
  'notactive'     =>  '#838383'
);

$lang['transactions_report'] = 'Îò÷åò òðàíçàêöèé îïëàòû';
$lang['trans_count'] = '×èñëî òðàíçàêöèé';
$lang['pay_no'] = '¹ îïëàòû';
$lang['ref_no'] = '¹ ññûëêè';
$lang['paid_thru'] = 'Êòî';
$lang['pay_status'] = 'Ñòàòóñ îïëàòû';
$lang['trans_rep'] = 'Îò÷åò îá îïëàòàõ';
$lang['expiry_interval'] = array(
  '1'   => '24 ÷àñà',
  '3'   =>  '3 äíÿ',
  '7'   =>  '7 äíåé',
  '15'  =>  '15 äíåé',
  '30'  =>  '30 äíåé',
  '0'   =>  'Èñòåê'
  );
$lang['expiry_hdr'] = 'Ïèñüìî-íàïîìèíàíèå îá èñòå÷åíèè ÷ëåíñòâà';
$lang['expiry_ltr'] = 'Ïèñüìî îá èñòå÷åíèè ÷ëåíñòâà';
$lang['expiry_select'] = 'Âûáåðèòå èíòåðâàë èñòå÷åíèÿ';
$lang['expird'] = 'Èñòåê';
$lang['expiry_ltr_sent'] = 'Ïèñüìà-íàïîìèíàíèÿ îá èñòå÷åíèè îòïðàâëåíû';
$lang['searching_within'] = 'Ïîèñê â ïðåäåëàõ';
$lang['payment_failed'] = 'Ïðîöåññ îïëàòû çàâåðøåí íåóäà÷íî. Ïîæàëóéñòà, ïîâòîðèòå îïëàòó.';
$lang['payment_fail'] = 'Íåâîçìîæíîñòü îïëàòû';
$lang['deactivate'] = 'Äåàêòèâèðîâàòü';

$lang['open_search'] = 'Îòêðûòü ïîèñê';
$lang['replace'] = 'Çàìåíèòü';
$lang['new'] = 'Íîâûé';
$lang['no_save'] = 'Íå ñîõðàíÿòü';
$lang['modify_curr_search'] = 'Èçìåíèòü êðèòåðèè ïîèñêà';
$lang['perform_search'] = 'è âûïîëíèòü ïîèñê.';
$lang['start_new_search'] = 'Íà÷àòü íîâûé ïîèñê';
$lang['use_empty_form'] = 'èñïîëüçóþ ïóñòóþ ôîðìó.';
$lang['of_zip_code'] = 'ïî ýòîìó ïî÷òîâîìó èíäåêñó';

/* MOD START */

$lang['profile_ratings'] = 'Ðåéòèíã àíêåòû';
$lang['total_ratings'] = 'Âñåãî ðåéòèíãîâ';
$lang['delete_ratings'] = 'Óäàëèòü ðåéòèíãè';
$lang['delete_rating_group_confirm_msg'] = 'Âû óâåðåíû, ÷òî õîòèòå óäàëèòü ýòè ðåéòèíãè? Ýòî äåéñòâèå íå ìîæåò áûòü îòìåíåíî.';
$lang['delete_rating_confirm_msg'] = 'Âû óâåðåíû, ÷òî õîòèòå óäàëèòü ýòîò ðåéòèíã? Ýòî äåéñòâèå íå ìîæåò áûòü îòìåíåíî.';
$lang['modify_rating'] = 'Èñïðàâèòü ðåéòèíã';
$lang['modify_ratings'] = 'Èñïðàâèòü ðåéòèíã';

$lang['glblsettings_groups']['50'] = 'Ðåéòèíãè àíêåò';
$lang['mod_lowtohigh']['Low to High'] = 'Îò íèçêîãî ê âûñîêîìó';
$lang['mod_lowtohigh']['High to Low'] = 'Îò âûñîêîãî ñ íèçêîìó';
$lang['admin_rights']['profile_ratings'] = 'Ðåéòèíãè àíêåò';

$lang['custom_message'] = 'Ïîäïèñü';
$lang['notify_me'] = 'Óâåäîìèòü ìåíÿ, êîãäà ìîå ñîîáùåíèå áóäåò ïðî÷èòàíî.';
$lang['include_profile'] = 'Âêëþ÷èòü ïîäïèñü â ìîþ àíêåòó.';
$lang['message_templates'] = 'Øàáëîíû ñîîáùåíèé';
$lang['my_templates'] = 'Ìîè øàáëîíû';
$lang['template_select'] = 'Ïîæàëóéñòà, âûáåðèòå øàáëîí';
$lang['template_intro'] = 'Åñëè Âû ÷àñòî ïîñûëàåòå ñîîáùåíèÿ Âàøèì ïîòåíöèàëüíûì èçáðàííèêàì, Âû ìîæåòå ñîçäàòü øàáëîíû äëÿ ýòèõ ñîîáùåíèé, ÷òîáû óìåíüøèòü ðó÷íîé íàáîð òåêñòà. Èñïîëüçóÿ øàáëîííûå ïåðåìåííûå âèäà [username] è [firstname], Âû ìîæåòå ñäåëàòü Âàøè øàáëîíû áîëåå ïåðñîíèôèöèðîâàííûìè äëÿ ïîëó÷àòåëÿ.';

$lang['add_template'] = 'Äîáàâèòü øàáëîí';
$lang['return_message'] = 'Âîçâðàò ê ñîîáùåíèþ';
$lang['delete_template_confirm_msg'] = 'Âû óâåðåíû, ÷òî õîòèòå óäàëèòü ýòîò øàáëîí? Ýòî äåéñòâèå íå ìîæåò áûòü îòìåíåíî.';
$lang['edit_template'] = 'Èçìåíèòü øàáëîí';

$lang['template_instructions'] = 'Ñëåäóþùèå øàáëîííûå ïåðåìåííûå äîñòóïíû: <br />
[username], [firstname], [city], [state], [country], [age]<br /><br />Âû ìîæåòå èñïîëüçîâàòü ýòè ïåðåìåííûå äëÿ ïåðñîíàëèçàöèè Âàøèì ñîîáùåíèé, íàïðèìåð:<br /><br />Ïðèâåò [firstname]!<br /><br />ß óçíàë, ÷òî òû èç ãîðîäà [city].... ÿ òîæå! :) ß äóìàþ, ÷òî ýòî õîðîøåå ñîâïàäåíèå... îòïðàâü ìíå e-mail, åñëè òû õî÷åøü óçíàòü áîëüøå îáî ìíå.<br /><br />óñïåõîâ,<br />Äæîí';

$lang['your_comment'] = 'Âàøè êîììåíòàðèè';
$lang['your_reply'] = 'Âàø îòâåò';
$lang['comment_note'] = 'Êîììåíòàðèè äëèíîé áîëüøå 255 ñèìâîëîâ áóäóò îáðåçàíû';
$lang['chars_remaining'] = 'ñèìâîëîâ îñòàëîñü';

$lang['delete_comment_confirm_msg'] = 'Âû óâåðåíû, ÷òî õîòèòå óäàëèòü ýòîò øàáëîí? Ýòî äåéñòâèå íå ñìîæåò áûòü îáðàùåíî.';
$lang['no_msg_templates'] = 'Íå íàéäåíî øàáëîíîâ ñîîáùåíèé.';
/* MOD END */

$lang['select'] = '-Âûáåðèòå-';
$lang['select_country'] = 'Ñòðàíà:';
$lang['select_state'] = 'Îáëàñòü:';
$lang['select_county'] = 'Âûáåðèòå ñòðàíó';
$lang['select_city'] = 'Âûáåðèòå ãîðîä';
$lang['confirm_success'] = 'Çàéäèòå ïîä ñâîèì èìåíåì, ÷òîáû íàñëàäèòüñÿ ïðåéìóùåñòâàìè ðåãèñòðàöèè.';
$lang['signup_success_message'] = 'Ïîçäðàâëÿåì!<br>Òåïåðü Âû - çàðåãèñòðèðîâàííûé ïîëüçîâàòåëü SITENAME.';
$lang['noone_online'] = 'Íåò ïîëüçîâàòåëåé îíëàéí';
$lang['in_hot_list'] = 'Ïîëüçîâàòåëü â Ãîðÿ÷åì ñïèñêå';
$lang['in_buddy_list'] = 'Ïîëüçîâàòåëü â ñïèñêå Äðóçåé';
$lang['in_ban_list'] = 'Ïîëüçîâàòåëü â ×åðíîì ñïèñêå';
$lang['delete_search'] = 'Óäàëèòü ýòîò ïîèñê';
$lang['select_user_to_send_message'] = 'Âûáåðèòå ïîëó÷àòåëÿ';
$lang['no_im_msgs'] = 'Íåò IM ñîîáùåíèé';
$lang['public_event'] = 'Ýòî ñîáûòèå äëÿ ïóáëè÷íîãî ïðîñìîòðà';
$lang['no_event_description'] = 'Íå ïðåäîñòàâëåíî îïèñàíèÿ';
$lang['signup_js_errors']['country_noblank'] = 'Ñòðàíà äîëæíà áûòü âûáðàíà';
$lang['msg_sent'] = 'Âàøå ñîîáùåíèå îòïðàâëåíî';
$lang['forgotpass_msg4'] = 'Âû çàáûëè ñâîé ëîãèí? Âàøå èìÿ ïîëüçîâàòåëÿ ñ íîâûì ïàðîëåì ìîæåò áûòü îòïðàâëåíî íà Âàø ïî÷òîâûé ÿùèê. Ïîæàëóéñòà, èñïîëüçóéòå àäðåñ ýëåêòðîííîé ïî÷òû, êîòîðûé Âû ââîäèëè âî âðåìÿ ðåãèñòðàöèè.';

/*  Additions for new email messaging interface
  Vijay Nair
*/
$lang['send_a_message'] = 'Îòïðàâèòü ñîîáùåíèå';
$lang['flagged'] = 'Îòìå÷åíî';
$lang['un_flagged'] = 'Íå îòìå÷åíî';
$lang['unflagged_msg1'] = 'Íåîòìå÷åííûå ñîîáùåíèÿ áîëåå ÷åì ';
$lang['unflagged_msg2'] = ' äíåé àâòîìàòè÷åñêè óäàëÿþòñÿ.';
$lang['no_messages_in_box'] = 'Â ýòîé ïàïêå íåò ñîîáùåíèé';
$lang['no_flagged_messages_in_box'] = 'Â ýòîé ïàïêå íåò îòìå÷åííûõ ñîîáùåíèé';
$lang['no_unflagged_messages_in_box'] = 'Â ýòîé ïàïêå íåò íåîòìå÷åííûõ ñîîáùåíèé';
$lang['mark'] = 'Ìàðêåð';
$lang['flag'] = 'Îòìåòèòü';
$lang['unflag'] = 'Ñíÿòü îòìåòêó';
$lang['msg_flagged'] = 'Ñîîáùåíèå îòìå÷åíî';
$lang['msg_unflagged'] = 'Îòìåòêà ñ ñîîáùåíèÿ ñíÿòà';
$lang['msg_deleted'] = 'Ñîîáùåíèå óäàëåíî';
$lang['sel_msgs_flagged'] = 'Âûáðàííûå ñîîáùåíèÿ îòìå÷åíû';
$lang['sel_msgs_unflagged'] = 'Ñ âûáðàííûõ ñîîáùåíèé ñíÿòà îòìåòêà';
$lang['sel_msgs_deleted'] = 'Âûáðàííûå ñîîáùåíèÿ óäàëåíû';
$lang['sel_msgs_undeleted'] = 'Âûáðàííûå ñîîáùåíèÿ âîññòàíîâëåíû';
$lang['sel_msgs_read'] = 'Âûáðàííûå ñîîáùåíèÿ îòìå÷åíû êàê ïðî÷èòàííûå';
$lang['sel_msgs_unread'] = 'Âûáðàííûå ñîîáùåíèÿ îòìå÷åíû êàê íîâûå';
$lang['FROM1'] = 'Îò';
$lang['no_thanks'] = 'Ñêàçàòü \"Íåò, ñïàñèáî\"';
$lang['reply'] = 'Îòâåòèòü';
$lang['undelete'] = 'Âîññòàíîâèòü';
$lang['back_to_messages'] = 'Îáðàòíî ê ñîîáùåíèÿì';
$lang['replied'] = 'Îòâåò îòïðàâëåí';
$lang['no_thanks_subject'] = 'Ñïàñèáî, íî íå ñòîèò áëàãîäàðíîñòè...';
$lang['total'] = 'Âñåãî';
$lang['max_allowed'] = 'Äîïóñêàåìûé ìàêñèìóì';
$lang['im_msg_long'] = 'IM ñîîáùåíèå áîëüøå äîïóñòèìîãî ðàçìåðà ';
$lang['members'] = '÷ëåíû';
$lang['To1'] = 'Êîìó';

/* Items which are modified in 1.1.0 */


$lang['change_email'] = 'Èçìåíèòü E-mail';

/* Changes made for letters  */
$lang['no_watched_event'] = 'Âû íå íàáëþäàåòå ñîáûòèÿ çà ýòó äàòó.
<br /><br />Â ñëåäóþùèå 30 äíåé ïðîèçîéäåò #eventcount# ñîáûòèé. <a "#calenderlink#">Îòêðûòü êàëåíäàðü</a> äëÿ ïðîñìîòðà ýòèõ ñîáûòèé.
<br /><br />Äëÿ òîãî, ÷òîáû ïîñìîòðåòü ñîáûòèå, íàæìèòå íà ñîáûòèå â êàëåíäàðå, çàòåì íàæìèòå íà óâåëè÷èòåëüíîå ñòåêëî. #glassicon#
<br /><br />Ëþáîé ïðîñìîòð, êîòîðûé Âû äîáàâèòå, èñòå÷åò ïî îêîí÷àíèè ñîáûòèÿ.';

$lang['no_thanks_message']['text'] = 'Ïðèâåò, #recipient_username#,

Ñïàñèáî çà òâîé èíòåðåñ, íî ÿ âûíóæäåí îòêàçàòü òåáå. ß íàäåþñü ÷òî òû â êîíå÷íîì ñ÷åòå íàéäåøü ñâîåãî èçáðàííèêà íà #site_name#.

Ñ íàèëó÷øèìè ïîæåëàíèÿìè,
#sender_username#';

$lang['message_read']['text'] = "Óâàæàåìûé(àÿ) #FirstName#,

Ñîîáùåíèå, îòïðàâëåííîå Âàìè äëÿ '#RecipientName#' áûëî ïðî÷èòàíî.

Óäà÷è!
#AdminName#
SITENAME";


$lang['featured_profile_added']['text'] = "Óâàæàåìûé(àÿ) #FirstName#,

Íàì î÷åíü ïðèÿòíî âêëþ÷èòü Âàøó àíêåòó â ñïèñîê èçáðàííûõ àíêåò íà ñàéòå <a href=\"#link#\">#siteName#</a>.

Âàøà àíêåòà áóäåò â ÷èñëå èçáðàííûõ ñ #FromDate# ïî #UptoDate#.

Ýòî óâåëè÷èò âèäèìîñòü Âàøåé àíêåòû è ìîæåò ïðèíåñòè íàìíîãî áîëüøå ïðîñìîòðîâ îò âîçìîæíûõ ñîèñêàòåëåé.

Óäà÷è!
#AdminName#
SITENAME";

$lang['wink_received']['text'] = "Óâàæàåìûé(àÿ) #FirstName#,

Âû ïîëó÷èëè ïîäìèãèâàíèå îò #siteName# ïîëüçîâàòåëÿ '#SenderName#'.

Ïîæàëóéñòà, ïîñåòèòå <a href=\"#link#\">#siteName#</a> ÷òîáû îòïðàâèòü äëÿ '#SenderName#' ñîîáùåíèå, èëè äëÿ îòâåòà íà ïîäìèãèâàíèå.

Óäà÷è!
#AdminName#
SITENAME";

$lang['invite_a_friend']['text'] = "Ïðèâåò,

ß íàøåë êðóòîé ñàéò çíàêîìñòâ: #SiteUrl#.
ß äóìàþ îí áóäåò òåáå èíòåðåñåí.

Ïîñåòè #SiteUrl#.

#FromName#";

$lang['profile_confirmation_email']['text'] = "Óâàæàåìûé(àÿ) #FirstName#,

Ñïàñèáî çà ðåãèñòðàöèþ íà #SiteName#! Êàê íîâîìó ÷ëåíó íàøåãî ñîîáùåñòâà ÿ ïîìîãó Âàì èçó÷èòü íàøè óñëóãè è âîçìîæíîñòè.

Äëÿ ïîäòâåðæäåíèÿ äîáàâëåíèÿ Âàøåé àíêåòû, ïîæàëóéñòà íàæìèòå íà ññûëêó íèæå. Ëèáî, åñëè Âû íå ìîæåòå íàæàòü íà íåå, ñêîïèðóéòå è âñòàâüòå åå â àäðåñíóþ ñòðîêó Âàøåãî áðàóçåðà.

#ConfirmationLink#=#ConfCode#

Åñëè ó Âàñ âñå åùå îòêðûò ïîñëåäíèé øàã ìàñòåðà ðåãèñòðàöèè, Âû ìîæåòå ââåñòè Âàø êîä ïîäòâåðæäåíèÿ íà òîì øàãå.

Âàø êîä ïîäòâåðæäåíèÿ: #ConfCode#

Ìû çàïèñàëè Âàøó ðåãèñòðàöèîííóþ èíôîðìàöèþ (ñì. íèæå):

Èìÿ ïîëüçîâàòåëÿ: #StrID#
Ïàðîëü: #Password#
E-Mail: #Email#

Ïîæàëóéñòà, äåðæèòå ýòó èíôîðìàöèÿ â áåçîïàñíîì ìåñòå, ÷òîáû Âû ìîãëè èìåòü äîñòóï êî âñåì äîñòóïíûì Âàì ñåðâèñàì. Íåêîòîðûå óñëóãè ìîãóò òðåáîâàòü îáíîâëåíèÿ íà áîëåå âûñîêèé óðîâåíü ÷ëåíñòâà. Ýòî Âû ñìîæåòå ñäåëàòü çäåñü:

#SiteUrl#payment.php

Áëàãîäàðèì çà èñïîëüçîâàíèå íàøèõ óñëóã è íàäååìñÿ, ÷òî Âû íàéäåòå ñâîåãî èçáðàííèêà!

#AdminName#
#SiteName#";

/* Added in 1.1.1 */
$lang['loading'] = 'Loading..';


/* Changes in 1.1.3 */
$lang['support_currency'] = array(
    'USD'   => '$',
    'EUR' =>'€',
    'INR' =>'Rs.',
    'AUD' => 'AU$',
    'CD'  => 'CAN$',
    'UKP' => chr(163)
    );


$lang['ratings'] = 'Ðåéòèíãè';
$lang['comment'] = 'Êîììåíòàðèé';
$lang['comments'] = 'Êîììåíòàðèè';
$lang['loadaction'] = 'Òðåáóåòñÿ âûáîð äåéñòâèÿ';
$lang['loadintodb'] = 'Çàãðóçêà â ÁÄ';
$lang['createsql'] = 'Ñîçäàòü SQL ñêðèïò';

$lang['load_zips'] = 'Îáðàáîòêà ôàéëà ïî÷òîâûõ èíäåêñîâ';



/* Version 2.0 additions and modifications */
/* Modifications */
$lang['zip_ensure'] = 'Ïîæàëóéñòà çàãðóçèòå ôàéë ïî÷òîâûõ èíäåêñîâ â êàòàëîã /zipcodes ïåðåä îáðàáîòêîé. <br /><br />Ôàéë äîëæåí ñîäåðæàòü ZIPCODE, LATITUDE, LONGITUDE, STATECODE, COUNTYCODE, CITYCODE (â òàêîì ïîðÿäêå. STATECODE, COUNTYCODE è CITYCODE ìîãóò áûòü îïóùåíû è îáíîâëåíû ïîçæå) ðàçäåëåííûå çàïÿòûìè.<br /><br />×òîáû óäàëèòü ïî÷òîâûé èíäåêñ äëÿ ñòðàíû, âûáåðèòå ñòðàíó è íàæìèòå êíîïêó "Óäàëèòü"';
$lang['submit'] = 'Îòïðàâèòü';
$lang['lang_ensure'] = 'Ñíà÷àëà îïðåäåëèòå íîâûé ÿçûê è èìÿ ôàéëà â config.php (ñì. îïðåäåëåíèÿ $language_options è $language_files). Çàòåì çàãðóçèòå ÿçûêîâîé ôàéë â êàòàëîã /language/lang_xxxx/ êàê lang_main.php ôàéë ïåðåä îáðàáîòêîé. (xxxx - èìÿ ÿçûêà â íèæíåì ðåãèñòðå. Íàïðèìåð: english, dutch, è ò.ä.).<br /><br /><b>Äëÿ èçìåíåíèÿ è/èëè äîáàâëåíèÿ íîâûõ ôðàç â ñóùåñòâóþùåå îïðåäåëåíèÿ ÿçûêà, ïîæàëóéñòà ñäåëàéòå íåîáõîäèìûå èçìåíåíèÿ â ÿçûêîâîé ôàéë è ïåðåçàãðóçèòå åãî.</b><br /><br />Äëÿ óäàëåíèÿ óæå çàãðóæåííîãî îïðåäåëåíèÿ ÿçûêà äëÿ îäíîãî ÿçûêà, âûáåðèòå ÿçûê è êëèêíèòå êíîïêó "Óäàëèòü ÿçûê èç ÁÄ".';

/* $lang['rate_catefully'] is changed as below */
$lang['rate_carefully'] = 'Îïåðàòîðû ýòîãî âåáñàéòà íå èìåþò íèêàêîãî îòíîøåíèÿ ê òî÷íîñòè è äîñòîâåðíîñòè ýòèõ ðåéòèíãîâ.<br />Ðåéòèíãè îïðåäåëÿþòñÿ ïîëüçîâàòåëÿìè è íå ïðîñìàòðèâàþòñÿ ïåðñîíàëîì.';


$lang['privileges'] = array (
  'chat'        => 'Ó÷àñòèå â ÷àòàõ.',
  'blog'        => 'Ó÷àñòèå â áëîãàõ.',
  'poll'        => 'Ó÷àñòèå â îïðîñàõ.',
  'forum'       => 'Ó÷àñòèå â ôîðóìàõ.',
  'includeinsearch'   => 'Âêëþ÷åíèå â ðåçóëüòàòû ïîèñêîâ.',
  'message'     => 'Îòïðàâêà ñîîáùåíèé íà ýëåêòðîííóþ ïî÷òó.',
  /* Added in 1.1.0 */
  'message_keep_cnt'  => 'Êîëè÷åñòâî õðàíèìûõ ñîîáùåíèé.',
  'message_keep_days' => 'Ñêîëüêî äíåé õðàíÿòñÿ ñîîáùåíèÿ.',
  /* rel 2.0 */
  'messages_per_day'  => 'Ñêîëüêî ñîîáùåíèé ìîæåò áûòü îòïðàâëåíî çà äåíü.',
  /* Rel 1.0 added  */
  'allowim'     => 'Ðàçðåøèòü âõîäÿùèå ñîîáùåíèÿ.',
  'uploadpicture'   => 'Çàãðóçêà êàðòèíîê.',
  'uploadpicturecnt'  => 'Êîëè÷åñòâî çàãðóçîê êàðòèíîê.',
  'allowalbum'    => 'Ðàçðåøèòü ÷àñòíûå àëüáîìû.',
  'event_mgt'     => 'Ðàçðåøèòü îáðàáîòêó ñîáûòèé.',
  /* Above is added in 1.0 */
  'seepictureprofile' => 'Ïðîñìîòð êàðòèíîê â àíêåòàõ.',
  'favouritelist'   => 'Óïðàâëåíèå ñïèñêàìè Äðóçåé/×åðíûì ñïèñêîì/Ãîðÿ÷èì ñïèñêîì.',
  'sendwinks'     => 'Îòïðàâêà ïîäìèãèâàíèé.',
  /* rel 2.0 */
  'winks_per_day'   => 'Ñêîëüêî ïîäìèãèâàíèé ìîæåò áûòü îòïðàâëåíî çà äåíü.',
  'extsearch'     => 'Ïðåäîñòàâëåíèå ðàñøèðåííîãî ïîèñêà.',
  'fullsignup'    => 'Ïîëíàÿ ðåãèñòðàöèÿ.',
  /* RC6 Patch */
  'activedays'    => 'Àêòèâíûå äíè äëÿ ýòîãî óðîâíÿ.',
  /* added in 2.0 */
  'saveprofiles'    => 'Ðàçðåøèòü ñîõðàíÿòü àíêåòû.',
  'saveprofilescnt' => 'Ñêîëüêî àíêåò ìîæíî ñîõðàíÿòü.',
  'allow_videos'    => 'Ðàçðåøèòü çàãðóçêó âèäåî.',
  'videoscnt'     => 'Ñêîëüêî âèäåî ðàçðåøåíî çàãðóæàòü.',
  'allow_mysettings'  => 'Ðàçðåøèòü óñòàíàâëèâàòü ïîëüçîâàòåëüñêèå ïðåäïî÷òåíèÿ.',
  'allow_php121'    => 'Ðàçðåøèòü php121 ïåéäæåð.',

);

/*  Signup Error Messages
  These are the signup error messages, Please do not change the sequence.
*/

$lang['errormsgs']= array(
  00 => '',
  01 => 'Èìÿ ïîëüçîâàòåëÿ - îáÿçàòåëüíîå äëÿ çàïîëíåíèÿ ïîëå.',
  02 => 'Ïàðîëü - îáÿçàòåëüíîå äëÿ çàïîëíåíèÿ ïîëå.',
  03 => 'Ïîäòâåðæäåíèå ïàðîëÿ - îáÿçàòåëüíîå äëÿ çàïîëíåíèÿ ïîëå.',
  04 => 'Èìÿ - îáÿçàòåëüíîå äëÿ çàïîëíåíèÿ ïîëå.',
  05 => 'Ôàìèëèÿ - îáÿçàòåëüíîå äëÿ çàïîëíåíèÿ ïîëå.',
  06 => 'Àäðåñ ýëåêòðîííîé ïî÷òû - îáÿçàòåëüíîå äëÿ çàïîëíåíèÿ ïîëå.',
  07 => 'Ãîðîä - îáÿçàòåëüíîå äëÿ çàïîëíåíèÿ ïîëå.',
  08 => 'Ïî÷òîâûé èíäåêñ - îáÿçàòåëüíîå äëÿ çàïîëíåíèÿ ïîëå.',
  09 => 'Àäðåñ, ñòðîêà 1 - îáÿçàòåëüíîå äëÿ çàïîëíåíèÿ ïîëå.',
  10 => 'Ìàêñèìàëüíàÿ äëèíà äàííûõ â ïîëå èìÿ ïîëüçîâàòåëÿ - 25 ñèìâîëîâ.',
  11 => 'Ìàêñèìàëüíàÿ äëèíà äàííûõ â ïîëå èìÿ - 50 ñèìâîëîâ.',
  12 => 'Ìàêñèìàëüíàÿ äëèíà äàííûõ â ïîëå ôàìèëèÿ - 50 ñèìâîëîâ.',
  13 => 'Ìàêñèìàëüíàÿ äëèíà äàííûõ â ïîëå E-mail àäðåñå 255 ñèìâîëîâ.',
  14 => 'Ìàêñèìàëüíàÿ äëèíà äàííûõ â ïîëå ãîðîä - 100 ñèìâîëîâ.',
  15 => 'Ìàêñèìàëüíàÿ äëèíà äàííûõ â ïîëå Àäðåñ, ñòðîêà 1 - 255 ñèìâîëîâ.',
  16 => 'Èìÿ ïîëüçîâàòåëÿ äîëæíî íà÷èíàòüñÿ ñ áóêâû.',
  17 => 'Ïàðîëü äîëæåí íà÷èíàòüñÿ ñ áóêâû.',
  18 => 'Ïàðîëü è ïîäòâåðæäåíèå ïàðîëÿ äîëæíû ñîâïàäàòü.',
  19 => 'Ïîæàëóéñòà, ââåäèòå ïðàâèëüíûé àäðåñ E-mail',
  20 => 'Îáÿçàòåëüíàÿ èíôîðìàöèÿ äîëæíà áûòü ââåäåíà.',
  21 => "Ëîãèí/ïàðîëü, êîòîðûé Âû äàëè íå äàåò Âàì äîñòóïà ê ñèñòåìå. Ïîæàëóéñòà, ïðîâåðüòå Âàø ââîä è ïîïðîáóéòå ñíîâà.",
  22 => 'Ïîëüçîâàòåëü ñ òàêèì èìåíåì óæå ñóùåñòâóåò, ïîæàëóéñòà, âûáåðèòå ñåáå äðóãîå èìÿ ïîëüçîâàòåëÿ.',
  23 => 'Ñòàðûé ïàðîëü, êîòîðûé Âû äàëè - íåâåðåí. Ïîæàëóéñòà ïðîâåðüòå Âàø ñòàðûé ïàðîëü è ïîïðîáóéòå çàíîâî.',
  25 => 'Ïîëüçîâàòåëü ñ òàêèì e-mail àäðåñîì óæå çàðåãèñòðèðîâàí.' ,
//  26 => "Âàø ñòàòóñ - 'Íå àêòèâíûé'. Ïîæàëóéñòà, ïîäîæäèòå àêòèâàöèè èëè íàïèøèòå àäìèíèñòðàòîðó." ,
  27 => 'Ñîîáùåíèå íå íàøëîñü.',
  28 => 'Ïîæàëóéñòà, ñíà÷àëà âûáåðèòå ôàéë.',
  29 => 'Ôîðìàò ôàéëà íå ïîäåðæèâàåòñÿ, ïîæàëóéñòà âûáåðèòå äðóãîé',
  30 => 'Âîïðîñ óæå è òàê â íà÷àëå.',
  31 => 'Âîïðîñ óæå è òàê â êîíöå.',
  32 => 'Ñïàñèáî çà Âàøè êîììåíòàðèè. Âàø îòçûâ ñêîðî áóäåò îáðàáîòàí.',
  33 => 'Ïî÷òîâûé èíäåêñ íå ñîîòâåòñòâóåò óêàçàííîé îáëàñòè.',
  34 => 'Íåâåðûé ïî÷òîâûé èíäåêñ',
  36 => 'Âàøà àíêåòà ïðèîñòàíîâëåíà. Ïîæàëóéñòà, ñâÿæèòåñü ñ àäìèíèñòðàòîðîì ïî ïîâîäó äåòàëåé.',
  37 => 'Âàøè çàÿâêè îòêëîíåíû. Ïîæàëóéñòà, ñâÿæèòåñü ñ àäìèíèñòðàòîðîì ïî ïîâîäó äåòàëåé.',
  38 => 'Âû óêàçàëè íåâåðíóþ äàòó ðîæäåíèÿ. Ïîæàëóéñòà, ïðîâåðüòå åå è ïîïðîáóéòå ñíîâà.',
  39 => 'Ñòàðûé è íîâûé ïàðîëè äîëæíû íå ñîâïàäàòü',
  40 => 'Âîçðàñò "Îò" äîëæåí áûòü ìåíüøå èëè ðàâåí âîçðàñòà "Äî"',
  51 => 'Äàòà íà÷àëàäîëæíà áûòü äî äàòû îêîí÷àíèÿ',
  52 => 'Äàííûé ïîëüçîâàòåëü óæå ïðèñóñòâóåò â ñïèñêå',
  53 => 'Íåâåðíàÿ äàòà',
  54 => 'Íåâåðíîå èìÿ ïîëüçîâàòåëÿ',
  55 => 'Ñíà÷àëà Âû äîëæíû çàéòè êàê ïîëüçîâàòåëü, ÷òîá ïîñûëàòü ñîîáùåíèÿ',
  56 => $lang['bigger_pic_size'],
  57 => $lang['only_jpg'],
  58 => $lang['upload_unsuccessful'],
  59 => 'Ýòà àíêåòà äîáàâëåíà ê ñïèñêó',
  60 => 'Ðàçìåð óìåíüøåííîé ôîòîãðàôèè ïðåâûøàåò ìàêñèìàëüíî âîçìîæíûé ('.$config['upload_snap_tnsize'].' X '.$config['upload_snap_tnsize'].')',
  61 => 'Óêàçàííûé êîä àêòèâàöèè - íåâåðåí',
  62 => 'Èìÿ ïîëüçîâàòåëÿ óäàëåíî èç ñïèñêà',
  63 => 'Ýòîò ïîëüçîâàòåëü áûë äîáàâëåí â Âàø ñïèñîê "Èçáðàííûå"',
  64 => 'Ýòîò ïîëüçîâàòåëü áûë äîáàâëåí â Âàø "×åðíûé ñïèñîê"',
  65 => 'Ýòîò ïîëüçîâàòåëü áûë äîáàâëåí â Âàø ñïèñîê "Ãîðÿ÷èå"',
  66 => 'Âàøå ïîäìèãèâàíèå áûëî ïîñëàíî ýòîìó ïîëüçîâàòåëþ',
  67 => $lang['upload_successful'],
  68 => 'Ïîäòâåðæäåíèå ôîòîãðàôèè îáíîâëåíî',
  69 => 'Îòêàç â ïðèåìå ôîòîãðàôèè îáíîâëåí',
  70 => 'Çàïèñè î ïðîñìîòðàõ óäàëåíû',
  71 => 'Çàïèñè î ïîäìèãèâàíèÿõ óäàëåíû',
  /* Added in RC6  */
  72 => 'Àíêåòà ïîëüçîâàòåëÿ íå àêòèâèðîâàíà',
  73 => 'Ñòðàíà äîáàâëåíà',
  74 => 'Ñòðàíà óäàëåíà',
  75 => 'Íàçâàíèå èëè êîä ñòðàíû óæå çàíÿò',
  76 => 'Äàííûå ñòðàíû èçìåíåíû',
  77 => 'Äîáàâëåíà îáëàñòü',
  78 => 'Îáëàñòü óäàëåíà',
  79 => 'Íàçâàíèå èëè êîä îáëàñòè óæå çàíÿòû',
  80 => 'Äàííûå îáëàñòè îòðåäàêòèðîâàíû',
  81 => 'Íàçâàíèå ñòðàíû/îáëàñòè äîëæíî ïðèñóñòâîâàòü',
  82 => 'Ïîëüçîâàòåëü íå çàãðóçèë íè îäíîé ôîòîãðàôèè. ',
  83 => 'Àíêåòà óäàëåíà',
  84 => 'Îòìå÷åííûå àíêåòû óäàëåíû.',

  85 => 'Îòìå÷åííûå àíêåòû àêòèâèðîâàíû.',
  86 => 'Îòìå÷åííûå àíêåòû óäàëåíû.',
  87 => 'Îòìå÷åííûå àíêåòû ïðèîñòàíîâëåíû.',

  26 => 'Âàøà àíêåòà åùå íå àêòèâèðîâàíà. <a href=\'completereg.php\'>Àêòèâèðîâàòü Âàø àêàóíò</a>, ââåäÿ êîä ïîäòâåðæäåíèÿ èëè èñïîëüçóÿ ññûëêó, âûñëàííóþ Âàì íà e-mail âî âðåìÿ ðåãèñòðàöèè.',

//  26 => 'Âàø àôèëèýéòíûé àêàóíò åùå íå àêòèâèðîâàí àäìèíèñòðàòîðîì. Ïîæàëóéñòà, ïîäîæäèòå àêòèâàöèè ïåðåä èñïîëüçîâàíèåì âàøåãî àôèëèýéòíîãî àêàóíòà.',

  35 => 'Âàøà àíêåòà åùå íå îäîáðåíà.<br /> Ïîæàëóéñòà, ïîäîæäèòå îäîáðåíèÿ èëè ñâÿæèòåñü ñ Àäìèíèñòðàòîðîì',

/* Release 1.0 additions/modifications  */

  88 => 'Ñòðàíà/Îáëàñòü äîáàâëåíà',
  89 => 'Ñòðàíà/Îáëàñòü óäàëåíà',
  90 => 'Êîä èëè íàçâàíèå ñòðàíû/Îáëàñòè óæå èñïîëüçóåòñÿ',
  91 => 'Ñòðàíà/Îáëàñòü èçìåíåíà',
  92 => 'Ãîðîä äîáàâëåí',
  93 => 'Ãîðîä óäàëåí',
  94 => 'Êîä èëè íàçâàíèå ãîðîäà óæå èñïîëüçóåòñÿ',
  95 => 'Ãîðîä èçìåíåí',
  96 => 'Ïî÷òîâûé èíäåêñ äîáàâëåí',
  97 => 'Ïî÷òîâûé èíäåêñ óäàëåí',
  98 => 'Ïî÷òîâûé èíäåêñ óæå èñïîëüçóåòñÿ',
  99 => 'Ïî÷òîâûé èíäåêñ èçìåíåí',
  100 => 'Ñòðàíà/îáëàñòü - ïîëå, íåîáõîäèìîå äëÿ çàïîëíåíèÿ',
  101 => 'Íåïðàâèëüíûé ïàðîëü',
  102 => 'Ñîáûòèå îäîáðåíî.',
  103 => 'Ñîáûòèå îòìåíåíî.',
  301 => 'Íåïðàâèëüíûé ÷àñîâîé ïîÿñ',
  302 => 'Àëüáîí îáíîâëåí',
/* 1.1.0 additions */
  104 => 'Ëîãèí, ââåäåííûé Âàìè, íå íàéäåí. Ïîæàëóéñòà, ïðîâåðüòå Âàø ââîä â ïîïðîáóéòå ñíîâà, èëè èñïîëüçóéòå îïöèþ íèæå äëÿ åãî íàïîìèíàíèÿ.',
  105 => 'Ïîëüçîâàòåëü â áàí-ëèñòå',
  /* Added in 2.0 */
  120 =>  'Ñåêðåòíûé êîä äîëæåí áûòü ââåäåí',
  121 => 'Íåïðàâèëüíûé ñåêðåòíûé êîä ',
  122 => 'Âû óæå îòîñëàëè ìàêñèìàëüíî ðàçðåøåííîå ÷èñëî ñîîáùåíèé çà ñåãîäíÿ. Ïîæàëóéñòà, ïîïðîáóéòå çàâòðà.',
  123 => 'Âû óæå îòîñëàëè ìàêñèìàëüíîå ðàçðåøåííîå ÷èñëî ïîäìèãèâàíèé çà ñåãîäíÿ. Ïîæàëóéñòà, ïîïðîáóéòå çàâòðà.',
  124 => 'Âèäåî-ôàéë çàãðóæåí',
  125 => 'Âèäåî-ôàéë íå çàãðóæåí èç-çà îøèáêè çàãðóçêè.',
  126 => 'Âû äîëæíû íàïèñàòü î ñåáå.',
  128 => 'Ëè÷íûå èìåíà ïîëüçîâàòåëåé ïàðû äîëæíû áûòü ââåäåíû.',
  129 => 'Èìåíà ïîëüçîâàòåëåé äîëæíû áûòü äîñòóïíû.',
  201 => 'Âû óæå ñîõðàíèëè â ñïèñîê ïðîñìîòðà ìàêñèìàëüíîå ÷èñëî ðàçðåøåííûõ àíêåò',
  202 => 'Ýòà àíêåòà äîáàâëåíà â Âàø ñïèñîê ïðîñìîòðà',
  203 => 'Ýòà àíêåòà óæå åñòü â ñïèñêå ïðîñìîòðà',
  );


$lang['alphanumeric'] = "0123456789.+-_#,/ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyzÀÁÂÃÄÅ¨ÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÚÛÜÝÞßàáâãäå¸æçèêëìíîïðñòóôõö÷øùúûüýþÿ ()_";
$lang['alphanum'] = "0123456789_ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyzÀÁÂÃÄÅ¨ÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÚÛÜÝÞßàáâãäå¸æçèêëìíîïðñòóôõö÷øùúûüýþÿ ";
$lang['text'] = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyzÀÁÂÃÄÅ¨ÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÚÛÜÝÞßàáâãäå¸æçèêëìíîïðñòóôõö÷øùúûüýþÿ '";
$lang['full_chars'] = "0123456789.+-_#,/ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyzÀÁÂÃÄÅ¨ÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÚÛÜÝÞßàáâãäå¸æçèêëìíîïðñòóôõö÷øùúûüýþÿ() _$+=;:?'";
/* Additions  in Version 2.0 */

$lang['save'] = 'Ñîõðàíèòü';
$lang['delete_zips'] = 'Óäàëèòü ïî÷òîâûå èíäåêñû';
$lang['zipcodes_sql_created'] = 'Sql ôàéë ïî÷òîâûõ èíäåêñîâ ñîçäàí ';
$lang['zipcodes_loaded'] = 'Ïî÷òîâûå èíäåêñû çàãðóæåíû ñ ';
$lang['delzips_msg'] = 'Âñå ïî÷òîâûå èíäåêñû äëÿ ýòîé ñòðàíû áóäóò óäàëåíû';
$lang['delzips_succ'] = 'Ïî÷òîâûå èíäåêñû äëÿ #COUNTRY# óäàëåíû';
$lang['wrong_zipfile'] = 'Ýòîò ôàéë íå äëÿ ñòðàíû #COUNTRY#';
$lang['load_states'] = 'Îáðàáîòêà ôàéëà îáëàñòåé';
$lang['state_ensure'] = 'Ïîæàëóéñòà, çàãðóçèòå ôàéë êîäîâ îáëàñòåé â êàòàëîã /states ïåðåä îáðàáîòêîé. <br /><br />Ôàéë äîëæåí ñîäåðæàòü STATECODE è STATENAME, ðàçäåëåííîå çàïÿòûìè.(áåç çàãîëîâêà)<br /><br /> ×òîáû óäàëèòü êîäû îáëàñòåé äëÿ ñòðàíû, âûáåðèòå ñòðàíó è íàæìèòå êíîïêó "Óäàëèòü êîäû îáëàñòåé"';
$lang['statefile'] = 'Ôàéë êîäîâ îáëàñòåé';
$lang['delete_states'] = 'Óäàëèòü êîäû îáëàñòåé';
$lang['delstates_msg'] = 'Âñå êîäû îáëàñòåé äëÿ ýòîé ñòðàíû áóäóò óäàëåíû';
$lang['delstates_succ'] = 'Êîäû îáëàñòåé äëÿ #COUNTRY# óäàëåíû';
$lang['states_sql_created'] = 'Sql ôàéë êîäîâ îáëàñòåé ñîçäàí ';
$lang['states_loaded'] = 'Êîäû îáëàñòåé çàãðóæåíû ñ ';
$lang['delete_lang'] = 'Óäàëèòü ÿçûê èç ÁÄ';
$lang['langfile_loaded'] = 'Îïðåäåëåíèÿ ÿçûêà äëÿ #LANGUAGE# çàãðóæåíû ñ ';
$lang['lang_deleted'] = 'Îïðåäåëåíèÿ ÿçûêà äëÿ #LANGUAGE# óäàëåíû';
$lang['load_counties'] = 'Îáðàáîòêà ôàéëà ñòðàí';
$lang['countyfile'] = 'Ôàéë êîäîâ ñòðàí';
$lang['county_ensure'] = 'Ïîæàëóéñòà, çàãðóçèòå ôàéë êîäîâ ñòðàí â êàòàëîã /counties ïåðåä îáðàáîòêîé. <br /><br />Ôàéë äîëæåí ñîäåðæàòü COUNTYCODE, COUNTYNAME è STATECODE, ðàçäåëåííîå çàïÿòûìè.(â òàêîì ïîðÿäêå, áåç çàãîëîâêà)<br /><br /> ×òîáû óäàëèòü êîäû ñòðàí, âûáåðèòå ñòðàíó è íàæìèòå êíîïêó "Óäàëèòü êîäû ñòðàí"';
$lang['delete_counties'] = 'Óäàëèòü êîäû ñòðàí';
$lang['delcounties_msg'] = 'Âñå êîäû ñòðàí äëÿ ýòîé ñòðàíû áóäóò óäàëåíû';
$lang['delcounties_succ'] = 'Êîäû ñòðàí äëÿ #COUNTRY# óäàëåíû';
$lang['counties_sql_created'] = 'Sql ôàéë êîäîâ ñòðàí ñîçäàí ';
$lang['counties_loaded'] = 'Êîäû ñòðàí çàãðóæåíû ñ ';
$lang['load_cities'] = 'Îáðàáîòêà ôàéëà ãîðîäîâ';
$lang['cityfile'] = 'Ôàéë êîäîâ ãîðîäîâ';
$lang['city_ensure'] = 'Ïîæàëóéñòà, çàãðóçèòå ôàéë êîäîâ ãîðîäîâ â êàòàëîã /cities ïåðåä îáðàáîòêîé. <br /><br />Ôàéë äîëæåí ñîäåðæàòü CITYCODE, CITYNAME, COUNTYCODE and STATECODE, ðàçäåëåííîå çàïÿòûìè.(â òàêîì ïîðÿäêå, áåç çàãîëîâêà)<br /><br /> ×òîáû óäàëèòü êîäû ãîðîäîâ, âûáåðèòå ãîðîä è íàæìèòå êíîïêó "Óäàëèòü êîäû ãîðîäîâ"';
$lang['delete_cities'] = 'Óäàëèòü êîäû ãîðîäîâ';
$lang['delcities_msg'] = 'Âñå êîäû ãîðîäîâ äëÿ ýòîé ñòðàíû áóäóò óäàëåíû';
$lang['delcities_succ'] = 'Êîäû ãîðîäîâ äëÿ #COUNTRY# óäàëåíû';
$lang['cities_sql_created'] = 'Sql ôàéë êîäîâ ãîðîäîâ ñîçäàí ';
$lang['cities_loaded'] = 'Êîäû ãîðîäîâ çàãðóæåíû ñ ';
$lang['online'] = 'Îíëàéí';
$lang['watchedprofiles_1'] = 'Äîáàâèòü ê ïðîñìîòðåííûì àíêåòàì';
$lang['watchedprofiles'] = 'Ïðîñìîòðåííûå àíêåòû';


$lang['poll'] = 'Îïðîñ';
$lang['section_poll_title'] = 'Îïðîñ';
$lang['section_poll_list'] = 'Ñïèñîê îïðîñà';
$lang['section_add_poll'] = 'Ñîçäàòü îïðîñ';
$lang['poll_subtitle_list'] = 'Ñïèñîê îïðîñà';
$lang['poll_subtitle_add'] = 'Ñîçäàòü îïðîñ';
$lang['poll_subtitle_edit'] = 'Ðåäàêòèðîâàòü îïðîñ';
$lang['poll_number'] = 'Êîëè÷åñòâî';
$lang['poll_active_hdr'] = 'Àêòèâíûé';
$lang['poll_question_hdr'] = 'Âîïðîñû';
$lang['poll_responses_hdr'] = 'Îòâåòû';
$lang['no_poll_found'] = 'Íå íàéäåíû îïðîñû';
$lang['poll_question'] = 'Âîïðîñ';
$lang['poll_options'] = 'Íàñòðîéêè îïðîñà';
$lang['poll_active'] = 'Àêòèâíûé';
$lang['poll_minimum_two'] = 'Òðåáóåòñÿ êàê ìèíèìóì äâà.';
$lang['results_poll_title'] = 'Ðåçóëüòàòû';
$lang['poll_subtitle_results'] = 'Ðåçóëüòàòû îïðîñà';
$lang['take_poll_title'] = 'Ïðîãîëîñîâàòü';
$lang['poll_entries'] = 'Îïðîñ';


$lang['plugin'] = 'Ïëàãèíû';
$lang['plugin_access'] = 'Äîñòóï ê ÷ëåíñòâó';
$lang['section_plugin_title'] = 'Ïëàãèíû';
$lang['section_plugin_list'] = 'Ñïèñîê ïëàãèíîâ';
$lang['section_add_plugin'] = 'Çàãðóçèò ïëàãèí';
$lang['plugin_subtitle_list'] = 'Ñïèñîê ïëàãèíîâ';
$lang['plugin_number'] = 'Íîìåð';
$lang['plugin_name'] = 'Íàçâàíèå';
$lang['plugin_active'] = 'Àêòèâíûé';
$lang['plugin_installed'] = 'Óñòàíîâëåí';
$lang['plugin_install'] = 'Óñòàíîâèòü';
$lang['no_plugin_found'] = 'Íå íàéäåíû ïëàãàíû';
$lang['plugin_file'] = 'Çàãðóçèòü Zip ôàéë ïëàãèíà';
$lang['plugin_subtitle_edit'] = 'Ðàäàêòèðîâàòü ïëàãèí';
$lang['add_plugin_summary'] = 'Äîêóìåíòàöèÿ ïî ñîçäàíèþ ïëàãèíà âêëþ÷åíî â Âàøó osDate óñòàíîâêó.';

$lang['blog']['hdr'] = 'Áëîã';
$lang['admin_blog'] = 'Áëîã ñàéòà';
$lang['blog_default_bad_words'] = 'xxx|levitra';
$lang['blog_bad_words'] = 'Ïëîõèå ñëîâà';
$lang['blog_save_template'] = 'Ñîõðàíèòü êàê øàáëîí';
$lang['blog_load_template'] = 'Çàãðóçèòü øàáëîí';
$lang['blog_bad_words_help'] = '(îäíî ñëîâî íà ñòðîêó)';
$lang['blog_search_results'] = 'Ðåçóëüòàòû ïîèñêà ïî áëîãó';
$lang['section_blog_info'] = 'Íàñòðîéêè áëîãà';
$lang['section_blog_list'] = 'Çàïèñè áëîãà';
$lang['section_blog_title'] = 'Áëîã';
$lang['blog_search_menu'] = 'Ïîèñê ïî áëîãó';
$lang['blog_search_username'] = 'Èìÿ ïîëüçîâàòåëÿ';
$lang['blog_search_title'] = 'Çàãîëîâîê';
$lang['blog_search_body'] = 'Òåêñò';
$lang['blog_search_Date'] = 'Äàòà';

$lang['blog_subtitle_list'] = 'Ñïèñîê áëîãà';
$lang['blog_name'] = 'Íàçâàíèå áëîãà';
$lang['blog_description'] = 'Îïèñàíèå áëîãà';
$lang['blog_members_comment'] = 'Êîììåíòàðèè ïîëüçîâàòåëåé';
$lang['blog_buddies_comment'] = 'Êîììåíòàðèè äðóçåé';
$lang['blog_members_vote'] = 'Ãîëîñà ïîëüçîâàòåëåé';
$lang['blog_gui_editor'] = 'WYSIWYG ðåäàêòîð';
$lang['blog_max_comments'] = 'Ìàêñèìóì êîììåíòàðèåâ';
$lang['no_blog_found'] = 'Çàïèñè íå íàéäåíû';
$lang['section_add_blog'] = 'Ñîçäàòü çàïèñü â áëîãå';
$lang['blog_subtitle_add'] = 'Ñîçäàòü çàïèñü â áëîãå';
$lang['blog_subtitle_edit'] = 'Ðåäàêòèðîâàòü áëîã';
$lang['blog_title'] = 'Çàãîëîâîê';
$lang['blog_story'] = 'Ñîäåðæèìîå';
$lang['blog_posted_date'] = 'Äàòà îòïðàâêè';
$lang['blog_title_hdr'] = 'Çàãîëîâîê';
$lang['blog_rating_list_hdr'] = 'Ðåéòèíã';
$lang['blog_number'] = 'Íîìåð';
$lang['blog_date_posted_hdr'] = 'Äàòà';
$lang['blog_views_hdr'] = 'Ïðîñìîòðîâ';
$lang['blog_votes_hdr'] = 'Ãîëîñîâ';
$lang['blog_votes1'] = 'ãîëîñîâ';
$lang['blog_rating_hdr'] = 'îñíîâàíî íà';
$lang['blog_submit_vote'] = 'Ãîëîñîâàòü';
$lang['blog_add_vote'] = 'Ãîëîñîâàòü';
$lang['view_blog'] = 'Ïðîñìîòð áëîãà';
$lang['blog_entries'] = 'Áëîã:';
$lang['blog_creator'] = 'Àâòîð';
$lang['blog_comments'] = 'Êîììåíòàðèé';
$lang['add_comment'] = 'Âàø êîììåíòàðèé';
$lang['total_blogs_found'] = 'Âñåãî íàéäåíî çàïèñåé áëîãà:';

$lang['blog_errors'] = array(
   'nosetup' => 'Íà÷àëüíûå íàñòðîéêè áëîãà äîëíû áûòü óêàçàíû.' ,
   'name_noblank' => 'Íàçâàíèå áëîãà äîëæíî áûòü óêàçàíî.' ,
   'description_noblank' => 'Îïèñàíèå áëîãà äîëæíî áûòü óêàçàíî. ',
   'date_posted_noblank' => 'Äàòà îòïðàâêè äîëæíî áûòü óêàçàíî.' ,
   'title_noblank' => 'Çàãîëîâîê äîëæåí áûòü óêàçàí.' ,
   'story_noblank' => 'Èñòîðèÿ äîëæíà áûòü óêàçàíà.' ,
   'max_stories_warning' => 'Âû äîñòèãëè ìàêñèìàëüíîãî ÷èñëà èñòîðèé. Íîâàÿ èñòîðèÿ íå ìîæåò áûòü äîáàâëåíà.' ,
   'comment_bad_word' => 'Âàø êîììåíòàðèé ñîäåðæèò çàïðåùåííîå ñëîâî %s' ,
);
$lang['spell_check'] = 'Ïðîâåðêà îðôîãðàôèè';

$lang['manage_import_webdate'] = 'Èìïîðò èç Webdate';
$lang['import_config'] = 'Êîíôèãóðàöèÿ';

$lang['forum_values'] = array(
   'None' => 'Íåò',
   'phpBB' => 'phpBB',
   'vBulletin' => 'vBulletin',
   'myBB' => 'myBB',
   'Phorum' => 'Phorum',
   );

$lang['photos_url'] = 'Äîìàøíÿÿ ñòðàíèöà:';
$lang['ftp_username'] = 'FTP Username:';
$lang['ftp_password'] = 'FTP Password:';
$lang['ftp_hostname'] = 'FTP Hostname:';
$lang['ftp_path'] = 'FTP aeDating Path:';
$lang['ftp_path_help'] = 'Ëîêàëüíûé ïóòü ê aeDating êàòàëîãó íà ñåðâåðå.  Íàïð. public_html/aeDating';

$lang['nopicsloaded'] = 'íåò êàðòèíîê';
$lang['loadedpicscnt'] = '#PICSCNT# êàðòèíîê';
$lang['loadedpicscnt1'] = '#PICSCNT# êàðòèíêà';
$lang['picsloaded'] = 'Êàðòèíêè çàãðóæåíû';
$lang['since'] = 'ñ';
$lang['unknown'] = 'Íåèçâåñòíî';

$lang['glblsettings_groups'] = array(
1 =>  'Èíôîðìàöèÿ ñàéòà',
2 =>  'Ïîëüçîâàòåëüñêèå ýëåìåíòû',
3 =>  'Ýëåìåíòû êàëåíäàðÿ',
4 =>  'Íàñòðîéêè ïî÷òû',
5 =>  'Èçîáðàæåíèÿ àíêåò',
6 =>  'Ôîðìàò ñòðàíèöû è òàáëèöû',
);

$lang['who_is_online'] = 'Òîëüêî ïîëüçîâàòåëè îíëàéí';
$lang['search_with_photo'] = 'Òîëüêî ïîëüçîâàòåëè ñ ôîòîãðàôèÿìè';
$lang['search_with_video'] = 'Òîëüêî ïîëüçîâàòåëè ñ âèäåî';
$lang['expire_on_hdr'] = 'Èñòåêàåò ';
$lang['expird'] = 'Èñòåê';
$lang['pics'] = 'Êàðò.';
$lang['pic_deleted'] = 'Îòìå÷åííîå ôîòî óäàëåíî';
$lang['entrycode_chars'] = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyzÀÁÂÃÄÅ¨ÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÚÛÜÝÞßàáâãäå¸æçèêëìíîïðñòóôõö÷øùúûüýþÿ";
$lang['enter_spamcode'] = 'Ñåêðåòíûé êîä';

/* Admin emails portion */

$lang['newpic']['html'] = "Óâàæàåìûé Àäìèíèñòðàòîð ñàéòà,<br><br>Ïîëüçîâàòåëü #UserName# çàãðóçèë íîâóþ êàðòèíêó. <br><br>Èìÿ ïîëüçîâàòåëÿ: #UserName#.<br>¹ êàðòèíêè: #PicNo#<br><br>#AdminName#<br>SITENAME";

$lang['newpic']['text'] = "Óâàæàåìûé Àäìèíèñòðàòîð ñàéòà,

Ïîëüçîâàòåëü #UserName# çàãðóçèë íîâóþ êàðòèíêó.

Èìÿ ïîëüçîâàòåëÿ: #UserName#
¹ êàðòèíêè: #PicNo#

#AdminName#
SITENAME";

$lang['newpic_sub'] = 'SITENAME ñîîáùåíèå: Íîâàÿ êàðòèíêà çàãðóæåíà ïîëüçîâàòåëåì ';

$lang['newvideo']['html'] = "Óâàæàåìûé Àäìèíèñòðàòîð ñàéòà,<br><br>Ïîëüçîâàòåëü #UserName# çàãðóçèë íîâîå âèäåî. <br><br>Èìÿ ïîëüçîâàòåëÿ: #UserName#.<br>¹ âèäåî: #PicNo#<br><br>#AdminName#<br>SITENAME";

$lang['newvideo']['text'] = "Óâàæàåìûé Àäìèíèñòðàòîð ñàéòà,

Ïîëüçîâàòåëü #UserName# çàãðóçèë íîâîå âèäåî.

Èìÿ ïîëüçîâàòåëÿ: #UserName#
¹ âèäåî: #PicNo#

#AdminName#
SITENAME";

$lang['newvideo_sub'] = 'SITENAME ñîîáùåíèå: Íîâîå âèäåî çàãðóæåíî ïîëüçîâàòåëåì ';

/* Modified in 2.0 */
$lang['payment_msg1'] = 'Âîçìîæíûå ñïîñîáû îïëàòû.';

$lang['wrong_activationcode'] = 'Óêàçàííûé êîä ïîäòâåðæäåíèÿ íåâåðåí.';

$lang['security_code_txt'] = 'Ïîæàëóéñòà, ïðî÷òèòå òåêñò íà êàðòèíêå íèæå è íàáåðèòå òåêñò â ïîëå ââîäà ðÿäîì. Âû äîëæíû ýòî ñäåëàòü, ÷òîáû ïîäòâåðäèòü, ÷òî ýòî äåéñòâèå âûïîëíÿåòñÿ íå ðîáîòîì.';
$lang['additional_pics'] = 'Äîïîëíèòåëüíûå êàðòèíêè';
$lang['view_all_pics'] = 'Ñìîòðåòü âñå êàðòèíêè';
$lang['insufficientPrivileges'] = 'Âû íå èìååòå äîñòàòî÷íûõ ïðèâèëåãèé äëÿ ýòîé îïöèè. Ïîæàëóéñòà, îáíîâèòå âàø óðîâåíü ÷ëåíñòâà.';
$lang['username_part_msg'] = "Åñëè âû íå óâåðåíû â èìåíè ïîëüçîâàòåëÿ, ââåäèòå ëþáîé ôðàãìåíò èìåíè äëÿ âûâîäà âñåõ ñîâïàäåíèé. Íàïðèìåð, ââåäÿ 'user' áóäóò ïîêàçàíû 'user123', 'someuser', è ò.ä.";
$lang['featured_profiles_msg01'] = "Ìîæíî ïîêàçàòü: 'Äà' äàñò ðàçðåøåíèå íà îòîáðàæåíèå ýòîé àíêåòû â ñïèñêàõ èçáðàííûõ àíêåò. 'No' óìåíüøèò øàíñ áûòü âûáðàííûì. ";

$lang['featured_profiles_msg02'] = "Ïðîñìîòðû: Ýòî êîëè÷åñòâî ïðîñìîòðîâ, òðåáóåìîå äëÿ òîãî, ÷òîáû ýòà àíêåòà áûëà óäàëåíà èç ñïèñêà èçáðàííûõ àíêåò, åñëè êîëè÷åñòâî ïðîñìîòðîâ áûëè äîñòèãíóòû äî äàòû îêîí÷àíèÿ.";
$lang['lookup'] = 'Ïîëó÷èòü';
/* for use in shoutbox */
$lang['sb_by'] = 'Îòïðàâëåíî:';
$lang['sb_hdr'] = 'Áîëòàëêà';
$lang['sb_send'] = 'Îòïðàâèòü';
$lang['sb_error'] = 'ââåäåííûé òåêñò áîëüøå äîïóñòèìîé äëèíû';
$lang['sb_msg_blank'] = 'Î÷èñòèòü áîëòàëêó?';
$lang['sb_show_all'] = 'Ïîêàçàòü âñå';

$lang['upload_videos'] = 'Çàãðóçèòü âèäåî';
$lang['videoupload_format_msgs'] = 'Òîëüêî .swf èëè .flv ôàéëû ðàçðåøåíû.';
$lang['video'] = 'Âèäåî';
$lang['upload_videos_ext'] = 'flv, swf';
$lang['upload_video_caption'] = 'Çàãðóçèòü âèäåî';
$lang['video_file'] = 'Âèäåî ôàéë';
$lang['vds'] = 'Vds';
$lang['manage_videos'] = 'Óïðàâëåíèå âèäåî';
$lang['videos_loaded'] = 'Videos loaded';
$lang['novideos_loaded'] = 'Íåò âèäåî';
$lang['loadedvdocnt'] = '#PICSCNT# âèäåî';
$lang['loadedvdocnt1'] = '#PICSCNT# âèäåî';
$lang['video_gallery'] = 'Âèäåî ãàëåðåÿ';
$lang['picture_gallery'] = 'Ãàëåðåÿ êàðòèíîê';


/* New timezone display values Modified in 2.0 */
// These are displayed in the timezone select box
$lang['tz']['-25'] = '--Âûáåðèòå--';
$lang['tz']['-12.00'] = 'GMT - 12 ÷àñîâ';
$lang['tz']['-11.00'] = 'GMT - 11 ÷àñîâ';
$lang['tz']['-10.00'] = 'GMT - 10 ÷àñîâ';
$lang['tz']['-9.00'] = 'GMT - 9 ÷àñîâ';
$lang['tz']['-8.00'] = 'GMT - 8 ÷àñîâ';
$lang['tz']['-7.00'] = 'GMT - 7 ÷àñîâ';
$lang['tz']['-6.00'] = 'GMT - 6 ÷àñîâ';
$lang['tz']['-5.00'] = 'GMT - 5 ÷àñîâ';
$lang['tz']['-4.00'] = 'GMT - 4 ÷àñà';
$lang['tz']['-3.5'] = 'GMT - 3.5 ÷àñà';
$lang['tz']['-3.00'] = 'GMT - 3 ÷àñà';
$lang['tz']['-2.00'] = 'GMT - 2 ÷àñà';
$lang['tz']['-1.00'] = 'GMT - 1 ÷àñ';
$lang['tz']['0.00'] = 'GMT';
$lang['tz']['1.00'] = 'GMT + 1 ÷àñ';
$lang['tz']['2.00'] = 'GMT + 2 ÷àñà';
$lang['tz']['3.00'] = 'GMT + 3 ÷àñà';
$lang['tz']['3.5'] = 'GMT + 3.5 ÷àñà';
$lang['tz']['4'] = 'GMT + 4 ÷àñà';
$lang['tz']['4.5'] = 'GMT + 4.5 ÷àñîâ';
$lang['tz']['5.00'] = 'GMT + 5 ÷àñîâ';
$lang['tz']['5.5'] = 'GMT + 5.5 ÷àñîâ';
$lang['tz']['6.00'] = 'GMT + 6 ÷àñîâ';
$lang['tz']['6.5'] = 'GMT + 6.5 ÷àñîâ';
$lang['tz']['7.00'] = 'GMT + 7 ÷àñîâ';
$lang['tz']['8.00'] = 'GMT + 8 ÷àñîâ';
$lang['tz']['9'] = 'GMT + 9 ÷àñîâ';
$lang['tz']['9.5'] = 'GMT + 9.5 ÷àñîâ';
$lang['tz']['10.00'] = 'GMT + 10 ÷àñîâ';
$lang['tz']['11.00'] = 'GMT + 11 ÷àñîâ';
$lang['tz']['12.00'] = 'GMT + 12 ÷àñîâ';
$lang['tz']['13.00'] = 'GMT + 13 ÷àñîâ';

$lang['myprofile'] = 'Ìîÿ àíêåòà';
$lang['myblog'] = 'Ìîé áëîã';
$lang['profilesearch'] = 'Ïîèñê àíêåò';
$lang['mylists'] = 'Ìîè ñïèñêè';
$lang['bans'] = 'Áàíû';
$lang['mybuddies'] = 'Ìîè äðóçüÿ';
$lang['hotprofiles'] = 'Ãîðÿ÷èå àíêåòû';
$lang['winks'] = 'Ïîäìèãèâàíèÿ';
$lang['tools'] = 'Èíñòðóìåíòû';
$lang['picturegallery'] = 'Ìîÿ ãàëåðåÿ êàðòèíîê';
$lang['videogallery'] = 'Ìîÿ âèäåî ãàëåðåÿ';
$lang['membership'] = 'Ìîå ÷ëåíñòâî';
$lang['adminhome'] = 'Àäìèíèñòðàöèÿ';
$lang['membershdr'] = 'Ïîëüçîâàòåëè';
$lang['memberprofiles'] = 'Àíêåòû ïîëüçîâàòåëåé';
$lang['membersearch'] = 'Ïîèñê ïîëüçîâàòåëåé';
$lang['blogs'] = 'Áëîãè';
$lang['blogsearch'] = 'Ïîèñê áëîãîâ';
$lang['affiliateshdr'] = 'Ïàðòíåðû';
$lang['localities'] = 'Ëîêàëüíîñòè';
$lang['contenthdr'] = 'Ñîäåðæèìîå';
$lang['financial'] = 'Ôèíàíñû';
$lang['plugins_hlp'] = 'Àäìèíèñòðàòèâíûå ïëàãèíû èñïîëüçóþòñÿ òîëüêî àäìèíàìè è ìîäåðàòîðàìè ñ äîñòàòî÷íûìè àäìèíèñòðàòîðñêèìè ïðàâàìè è ïîÿâëÿþòñÿ àâòîìàòè÷åñêè âíèçó ëåâîãî ìåíþ àäìèíèñòðàòîðà ïîñëå àêòèâàöèè. Ïîëüçîâàòåëüñêèå ïëàãèíû ìîãóò áûòü äîñòóïíû èç ïîëüçîâàòåëüñêîé ïàíåëè';

/* HTML and some text emails */
$lang['no_thanks_message']['html'] = 'Ïðèâåò #recipient_username#,<br><br>Ñïàñèáî çà òâîé èíòåðåñ, íî ÿ âûíóæäåí îòêàçàòü òåáå. ß íàäåþñü ÷òî òû â êîíå÷íîì ñ÷åòå íàéäåøü ñâîåãî èçáðàííèêà íà #site_name#.<br><br>Ñ íàèëó÷øèìè ïîæåëàíèÿìè,<br><br>#sender_username#';


/* old format
$lang['wink_received']['html'] = "Óâàæàåìûé(àÿ) #FirstName#,<br><br>Âû ïîëó÷èëè ïîäìèãèâàíèå îò #siteName# ïîëüçîâàòåëÿ '#SenderName#'.<br><br>Ïîæàëóéñòà, ïîñåòèòå <a href=\"#link#\">#siteName#</a> ÷òîáû îòïðàâèòü äëÿ '#SenderName#' ñîîáùåíèå, èëè äëÿ îòâåòà íà ïîäìèãèâàíèå.<br><br>Óäà÷è!<br>#AdminName#";
$lang['letter_winkreceived_sub'] = '#SITENAME# - Âû ïîëó÷èëè ïîäìèãèâàíèå';

New format below
*/

$lang['mail']['hdr_text'] = '<font style="color:red; font-size: 9px;">×òîáû ïåðåñòàòü ïîëó÷àòü ýòè ïèñüìà, <a href="#SiteUrl#">âîéäèòå íà ñàéò</a> è èçìåíèòå Âàøè ïî÷òîâûå ïðåäïî÷òåíèÿ â ìåíþ ïîëüçîâàòåëÿ.<br>×òîáû ïîëó÷àòü òàêèå ïèñüìà, ïîæàëóéñòà äîáàâüòå <a href="mailto:#AdminEmail#">#AdminEmail#</a> ê âàøåé àäðåñíîé êíèãå.</font><br><br>';
$lang['mail']['hdr_html'] = '<table border=0 cellspacing=0 cellpadding=0 width="570"><tr><td style="padding: 5px;"><font style="color:red; font-size: 9px;">×òîáû ïåðåñòàòü ïîëó÷àòü ýòè ïèñüìà, <a href="#SiteUrl#">âîéäèòå íà ñàéò</a> è èçìåíèòå Âàøè ïî÷òîâûå ïðåäïî÷òåíèÿ â ìåíþ ïîëüçîâàòåëÿ.<br>×òîáû ïîëó÷àòü ýòè ïèñüìà, ïîæàëóéñòà äîáàâüòå <a href="mailto:#AdminEmail#">#AdminEmail#</a> ê âàøåé àäðåñíîé êíèãå.</font></td></tr><tr><td height="6"></td></tr></table>';

$lang['letter_winkreceived_sub'] = 'SITENAME Ñîîáùåíèå: #SenderName# ïîäìèãíóë(à) Âàì! ';
$lang['wink_received']['html'] = '<table border=0 cellpadding="0" cellspacing="0" width="570"><tr><td width="77" height="25px">#email_hdr_left#</td><td width="493" class="module_head" >&nbsp;&nbsp;#SenderName# ïîäìèãíóë(à) Âàì! </td></tr><tr><td width="570" class="evenrow" colspan="2" style="padding: 5px;"><table border="0" cellspacing="2" cellpadding="2"><tr><td height="6"></td></tr><tr><td width="50%" valign="top">#smallProfile#</td><td width="50%" valign="top">Èç ìíîæåñòâà ïîëüçîâàòåëåé, #SenderName# âûáðàë(à) Âàñ ÷òîáû ïîäìèãíóòü! Âû ìîæåòå ïðîäîëæèòü ôëèðò, îòïðàâèâ îòâåòíîå ïîäìèãèâàíèå, èëè îòïðàâèâ e-mail.<br><br><a href="#SiteUrl#compose.php?recipient=#UserId#">Îòïðàâèòü ïèñüìî äëÿ #SenderName#</a><br><br><a href="#SiteUrl#sendwinks.php?ref_id=#UserId#&amp;rtnurl=showprofile.php">Îòïðàâèòü ïîäìèãèâàíèå</a><br><br>
<b>Íå çàèíòåðåñîâàëèñü?</b><br>Äàéòå #SenderName# çíàòü, ÷òî îí(à) Âàñ íå çàèíòåðåñîâàë(à), îòïðàâèâ ñîîáùåíèå "Íåò, ñïàñèáî"<br><br><a href="#SiteUrl#compose.php?recipient=#UserId#&amp;reply=11">Ñêàçàòü "Íåò, ñïàñèáî"</a><br><br></td></tr></table></td></tr><tr><td height="6" colspan="2" class="evenrow"></td></tr></table> ';

/* old format
$lang['profile_confirmation_email']['html'] = "Óâàæàåìûé(àÿ) #FirstName#,<br><br>Ñïàñèáî çà ðåãèñòðàöèþ íà ñàéòå #SiteName#! Êàê íîâîìó ÷ëåíó íàøåãî ñîîáùåñòâà ÿ ïîìîãó Âàì èçó÷èòü íàøè óñëóãè è âîçìîæíîñòè.<br><br>Äëÿ ïîäòâåðæäåíèÿ äîáàâëåíèÿ Âàøåé àíêåòû, ïîæàëóéñòà, íàæìèòå íà ññûëêó íèæå, ëèáî ñêîïèðóéòå è âñòàâüòå åå â àäðåñíóþ ñòðîêó Âàøåãî áðàóçåðà.<br><br><a href=\"#ConfirmationLink#=#ConfCode#\">#ConfirmationLink#=#ConfCode#</a><br><br>Åñëè ó Âàñ âñå åùå îòêðûò ïîñëåäíèé øàã ìàñòåðà ðåãèñòðàöèè, Âû ìîæåòå ââåñòè Âàø êîä ïîäòâåðæäåíèÿ òàì.<br><br>Âàø êîä ïîäòâåðæäåíèÿ: #ConfCode#<br><br>Ìû çàïèñàëè ñëåäóþùóþ Âàøó ðåãèñòðàöèîííóþ èíôîðìàöèþ:<br><br>Èìÿ ïîëüçîâàòåëÿ: #StrID#<br>Ïàðîëü: #Password#<br>E-Mail: #Email#<br><br>Ïîæàëóéñòà, äåðæèòå ýòó èíôîðìàöèÿ â áåçîïàñíîì ìåñòå, ÷òîáû Âû ìîãëè èìåòü äîñòóï êî âñåì äîñòóïíûì Âàì ñåðâèñàì. Íåêîòîðûå óñëóãè ìîãóò òðåáîâàòü îáíîâëåíèÿ íà áîëåå âûñîêèé óðîâåíü ÷ëåíñòâà. Ýòî Âû ñìîæåòå ñäåëàòü çäåñü:<br><br>#SiteUrl#payment.php<br><br>Áëàãîäàðèì çà èñïîëüçîâàíèå íàøèõ óñëóã è íàäååìñÿ, ÷òî Âû íàéäåòå ñâîåãî èçáðàííèêà!<br><br>#AdminName#<br>#SiteName#";

New format below
*/
$lang['profile_confirmation_email_sub'] = 'SITENAME Ñîîáùåíèå: Ñïàñèáî çà ðåãèñòðàöèþ íà ñàéòå SITENAME!';
$lang['profile_confirmation_email']['html'] = '<table border=0 cellpadding="0" cellspacing="0" width="570"><tr><td width="77" height="25" class="module_head">#email_hdr_left#</td><td width="493" class="module_head" >&nbsp;&nbsp;#Welcome#!</td></tr><tr><td width="570" class="evenrow" colspan="2" style="padding: 5px;">Óâàæàåìûé(àÿ) #FirstName#,<br><br>Ñïàñèáî çà ðåãèñòðàöèþ íà #SiteName#! Êàê íîâîìó ÷ëåíó íàøåãî ñîîáùåñòâà ÿ ïîìîãó Âàì èçó÷èòü íàøè óñëóãè è âîçìîæíîñòè.<br><br>Äëÿ ïîäòâåðæäåíèÿ äîáàâëåíèÿ Âàøåé àíêåòû, ïîæàëóéñòà, íàæìèòå íà ññûëêó íèæå, ëèáî ñêîïèðóéòå è âñòàâüòå åå â àäðåñíóþ ñòðîêó Âàøåãî áðàóçåðà.<br><br><a href=\"#ConfirmationLink#=#ConfCode#\">#ConfirmationLink#=#ConfCode#</a><br><br>Åñëè ó Âàñ âñå åùå îòêðûò ïîñëåäíèé øàã ìàñòåðà ðåãèñòðàöèè, Âû ìîæåòå ââåñòè Âàø êîä ïîäòâåðæäåíèÿ òàì. <br><br>Âàø êîä ïîäòâåðæäåíèÿ: <b>#ConfCode#</b><br><br>Ìû çàïèñàëè ñëåäóþùóþ Âàøó ðåãèñòðàöèîííóþ èíôîðìàöèþ:<br><br>Èìÿ ïîëüçîâàòåëÿ: <b>#StrID#</b><br>Ïàðîëü: <b>#Password#</b><br>E-Mail: <b>#Email#</b><br><br>Ïîæàëóéñòà, äåðæèòå ýòó èíôîðìàöèÿ â áåçîïàñíîì ìåñòå, ÷òîáû Âû ìîãëè èìåòü äîñòóï êî âñåì äîñòóïíûì Âàì ñåðâèñàì. Íåêîòîðûå óñëóãè ìîãóò òðåáîâàòü îáíîâëåíèÿ íà áîëåå âûñîêèé óðîâåíü ÷ëåíñòâà. Ýòî Âû ñìîæåòå ñäåëàòü çäåñü:<br><br><a href="#SiteUrl#payment.php">#Upgrade#</a><br><br>Áëàãîäàðèì çà èñïîëüçîâàíèå íàøèõ óñëóã è íàäååìñÿ ÷òî Âû íàéäåòå ñâîåãî èçáðàííèêà! <br><br>#AdminName#<br>#SiteName#</td></tr><tr><td height="6" colspan="2" class="evenrow"></td></tr></table> ';

/* old format
$lang['message_received']['text'] = "Óâàæàåìûé(àÿ) #FirstName#,

Âû ïîëó÷èëè ñîîáùåíèå îò SITENAME ïîëüçîâàòåëÿ '#SenderName#'.

Ïîæàëóéñòà ïîñåòèòå <a href=\"#link#\">SITENAME</a> ÷òîáû îòâåòèòü íà ñîîáùåíèå.

Óäà÷è!
#AdminName#";

$lang['message_received']['html'] = "Óâàæàåìûé(àÿ) #FirstName#,<br><br>Âû ïîëó÷èëè ñîîáùåíèå îò ïîëüçîâàòåëÿ #siteName# '#SenderName#'.<br><br>Ïîæàëóéñòà, ïîñåòèòå <a href=\"#link#\">#siteName#</a>, ÷òîáû îòâåòèòü íà ñîîáùåíèå.<br><br>Óäà÷è!<br>#AdminName#";

New format below
*/
$lang['message_received_sub'] = 'SITENAME Ñîîáùåíèå: RE: Ïðîñòî ê ñâåäåíèþ...';
$lang['message_received']['text'] = "Óâàæàåìûé(àÿ) #FirstName#,

Âû ïîëó÷èëè ñîîáùåíèå îò SITENAME ïîëüçîâàòåëÿ '#SenderName#'.

Ïîæàëóéñòà ïîñåòèòå <a href=\"#link#\">SITENAME</a> ÷òîáû îòâåòèòü íà ñîîáùåíèå.

Óäà÷è!
#AdminName#
SITENAME";

$lang['message_received']['html'] = '<table border=0 cellpadding="0" cellspacing="0" width="570"><tr><td width="77" height="25">#email_hdr_left#</td><td width="493" class="module_head" >&nbsp;&nbsp;Íîâîå ñîîáùåíèå îò #SenderName#! </td></tr><tr><td width="570" class="evenrow" colspan="2" style="padding: 5px;"><table border="0" cellspacing="2" cellpadding="2"><tr><td height="6"></td></tr><tr><td width="50%" valign="top" class="evenrow">
<table width="100%" border=0 cellspacing=0 cellpadding=2><tr><td width="25%" class="newshead">#From#:</td><td width="75%">#SenderName#</td></tr><tr><td class="newshead" >#TO#:</td><td>#UserName#</td></tr><tr><td class="newshead" >#Date#:</td><td>#MESSAGE_DATE# </td></tr><tr><td class="newshead">#Subject#:</td><td>#MSG_SUBJECT#</td></tr><tr><td colspan="2" height="6"></td></tr><tr><td colspan=2>Dear #FirstName#,<br><br>Âû ïîëó÷èëè ñîîáùåíèå îò #SenderName#.<br><br>Ïîæàëóéñòà ïîñåòèòå <a href=\"#link#\">SITENAME</a> äëÿ îòâåòà íà ýòî ñîîáùåíèå. <br><br>Óäà÷è!<br>#AdminName#<br>SITENAME<br></td></tr></table></td><td width="50%" valign="top" class="oddrow">#smallProfile#</td></tr></table></td></tr><tr><td height="6" colspan="2" class="evenrow"></td></tr></table> ';

/* Old format
$lang['letter_featuredprofile_sub'] = '#SITENAME# - ñïèñîê èçáðàííûõ àíêåò';
$lang['featured_profile_added']['html'] = "Óâàæàåìûé(àÿ) #FirstName#,<br><br>Íàì î÷åíü ïðèÿòíî âêëþ÷èòü Âàøó àíêåòó â ñïèñîê èçáðàííûõ àíêåò íà ñàéòå <a href=\"#link#\">#siteName#</a>.<br><br>Âàøà àíêåòà áóäåò â ÷èñëå èçáðàííûõ ñ #FromDate# ïî #UptoDate#.<br><br>Ýòî óâåëè÷èò âèäèìîñòü Âàøåé àíêåòû è ìîæåò ïðèíåñòè íàìíîãî áîëüøå ïðîñìîòðîâ îò âîçìîæíûõ ñîèñêàòåëåé.<br><br>Óäà÷è!<br>#AdminName#";

new format
*/
$lang['letter_featuredprofile_sub'] = 'SITENAME Ñîîáùåíèå: Âàøà àíêåòà âñêîðå ñòàíåò èçáðàííîé!';
$lang['featured_profile_added']['html'] = '<table border=0 cellpadding="0" cellspacing="0" width="570"><tr><td width="77" height="25" class="module_head">#email_hdr_left#</td><td width="493" class="module_head" >&nbsp;&nbsp;Âàøà àíêåòà âñêîðå ñòàíåò èçáðàííîé! </td></tr><tr><td width="100%" class="evenrow" colspan="2" style="padding: 6px;"><table border="0" cellspacing="0" cellpadding="6"><tr><td height="6"></td></tr><tr><td width="100%" valign="top" class="evenrow">Óâàæàåìûé(àÿ) #FirstName#,<br><br>Íàì î÷åíü ïðèÿòíî âêëþ÷èòü Âàøó àíêåòó â ñïèñîê èçáðàííûõ àíêåò íà ñàéòå <a href=\"#link#\">SITENAME</a>.<br><br>Âàøà àíêåòà áóäåò â ÷èñëå èçáðàííûõ ñ <b>#FromDate#</b> ïî <b>#UptoDate#</b>.<br><br>Ýòî óâåëè÷èò äîñòóïíîñòü Âàøåé àíêåòû è ìîæåò äàòü íàìíîãî áîëüøå ïðîñìîòðîâ âîçìîæíûìè ñîèñêàòåëÿìè.<br><br>Óäà÷è!<br>#AdminName# <br>SITENAME<br></td></tr></table></td></tr><tr><td height="6" colspan="2" class="evenrow"></td></tr></table> ';

/* old format

$lang['profile_activated_sub'] = '#SITENAME# - Âàøà àíêåòà àêòèâèðîâàíà';
$lang['profile_activated']['html'] = "Óâàæàåìûé(àÿ) #FirstName#,<br><br>Ýòî àâòîìàòè÷åñêîå óâåäîìëåíèå î òîì, ÷òî Âàøà àíêåòà íà ñàéòå #siteName# áûëà àêòèâèðîâàíà ñ óðîâíåì ÷ëåíñòâà #MembershipLevel#. Ïîñåòèòå íàñ <a href=\"#link#\">#siteName#</a>.<br><br>Óäà÷è!<br>#AdminName#";

new format */

$lang['profile_activated_sub'] = 'SITENAME Ñîîáùåíèå:  Âàøà àíêåòà àêòèâèðîâàíà!';
$lang['profile_activated']['html'] = '<table border=0 cellpadding="0" cellspacing="0" width="570"><tr><td width="77" height="25" class="module_head">#email_hdr_left#</td><td width="493" class="module_head" >&nbsp;&nbsp;Âàøà àíêåòà àêòèâèðîâàíà! </td></tr><tr><td width="100%" class="evenrow" colspan="2" style="padding: 6px;"><table border="0" cellspacing="0" cellpadding="6"><tr><td height="6"></td></tr><tr><td width="100%" valign="top" class="evenrow">Óâàæàåìûé(àÿ) #FirstName#,<br><br>Íàì î÷åíü ïðèÿòíî ïðèãëàñèòü Âàñ íà ñàéò SITENAME. <br><br>Âàøà àíêåòà áûëà àêòèâèðîâàíà ñ ÷ëåíñêèì óðîâíåì - <b>#MembershipLevel#</b>, äîñòóïíûì äî #ValidDate#.<br><br>Ïîñåòèòå íàñ: <a href=\"#link#\">SITENAME</a>.<br><br>Óäà÷è!<br>#AdminName# <br>SITENAME<br></td></tr></table></td></tr><tr><td height="6" colspan="2" class="evenrow"></td></tr></table> ';
$lang['profile_activated']['text'] = "Óâàæàåìûé(àÿ) #FirstName#,

Íàì î÷åíü ïðèÿòíî ïðèãëàñèòü Âàñ íà ñàéò SITENAME.

Âàøà àíêåòà áûëà àêòèâèðîâàíà ñ óðîâíåì ÷ëåíñòâà -  <b>#MembershipLevel#</b>, äîñòóïíûì äî <b>#ValidDate#</b>.

Ïîñåòèòå íàñ <a href=\"#link#\">SITENAME</a>.

Óäà÷è!
#AdminName#
SITENAME";

/* old format
$lang['profile_reactivated_sub'] = '#SITENAME# - Âàøà àíêåòà ðå-àêòèâèðîâàíà';
$lang['profile_reactivated']['html'] = "Óâàæàåìûé(àÿ) #FirstName#,<br><br>Ýòî àâòîìàòè÷åñêîå óâåäîìëåíèå î òîì, ÷òî Âàøà àíêåòà íà ñàéòå #siteName# áûëà àêòèâèðîâàíà ñ óðîâíåì ÷ëåíñòâà #MembershipLevel#. Ïîñåòèòå íàñ <a href=\"#link#\">#siteName#</a>.<br><br>Óäà÷è!<br>#AdminName#";

New format
*/
$lang['profile_reactivated_sub'] = 'SITENAME ñîîáùåíèå: Âàøà àíêåòà ðå-àêòèâèðîâàíà!';
$lang['profile_reactivated']['text'] = "Óâàæàåìûé(àÿ) #FirstName#,

Íàì î÷åíü ïðèÿòíî ñîîáùèòü, ÷òî Âàøà àíêåòà ðå-àêòèâèðîâàíà ñ ÷ëåíñêèì óðîâíåì - <b>#MembershipLevel#</b>, êîòîðûé èñòåêàåò <b>#ValidDate#</b>.

Ïîñåòèòå íàñ: <a href=\"#link#\">SITENAME</a>.

Óäà÷è!
#AdminName#
SITENAME";

$lang['profile_reactivated']['html'] = '<table border=0 cellpadding="0" cellspacing="0" width="570"><tr><td width="77" height="25" class="module_head">#email_hdr_left#</td><td width="493" class="module_head" >&nbsp;&nbsp;Âàøà àíêåòà ðå-àêòèâèðîâàíà! </td></tr><tr><td width="100%" class="evenrow" colspan="2" style="padding: 6px;"><table border="0" cellspacing="0" cellpadding="6"><tr><td height="6"></td></tr><tr><td width="100%" valign="top" class="evenrow">Óâàæàåìûé(àÿ) #FirstName#,<br><br>Íàì î÷åíü ïðèÿòíî ñîîáùèòü, ÷òî Âàøà àíêåòà ðå-àêòèâèðîâàíà ñ ÷ëåíñêèì óðîâíåì - <b>#MembershipLevel#</b> êîòîðûé èñòåêàåò <b>#ValidDate#</b>.<br><br>Ïîñåòèòå íàñ: <a href=\"#link#\">SITENAME</a>.<br><br>Óäà÷è!<br>#AdminName# <br>SITENAME<br></td></tr></table></td></tr><tr><td height="6" colspan="2" class="evenrow"></td></tr></table> ';

/* old format
$lang['added_banlist_sub'] = '#SITENAME# - Èíôîðìàöèîííîå ñîîáùåíèå';
$lang['added_buddylist_sub'] = '#SITENAME# - Èíôîðìàöèîííîå ñîîáùåíèå';
$lang['added_hotlist_sub'] = '#SITENAME# - Èíôîðìàöèîííîå ñîîáùåíèå';

$lang['added_buddylist']['html'] = "Óâàæàåìûé(àÿ) #FirstName#,<br><br>Âû áûëè äîáàâëåíû â ñïèñîê äðóçåé ïîëüçîâàòåëåì #SenderName#.<br><br>Äëÿ ïðîñìîòðà àíêåòû ýòîãî ïîëüçîâàòåëÿ, ïîñåòèòå <a href=\"#link#\">#siteName#</a>.<br><br>Óäà÷è!<br>#AdminName#";

$lang['added_hotlist']['html'] = "Óâàæàåìûé(àÿ) #FirstName#,<br><br>Âû áûëè äîáàâëåíû â ãîðÿ÷èé ñïèñîê ïîëüçîâàòåëÿ #SenderName#.<br><br>Äëÿ ïðîñìîòðà àíêåòû ýòîãî ïîëüçîâàòåëÿ, ïîñåòèòå <a href=\"#link#\">#siteName#</a>.<br><br>Óäà÷è!<br>#AdminName#";

$lang['added_banlist']['html'] = "Óâàæàåìûé(àÿ) #FirstName#,<br><br>Âû áûëè äîáàâëåíû â ÷åðíûé ñïèñîê ïîëüçîâàòåëåì #SenderName#.<br><br>Äëÿ ïðîñìîòðà àíêåòû ýòîãî ïîëüçîâàòåëÿ, ïîñåòèòå <a href=\"#link#\">#siteName#</a>.<br><br>#AdminName#";

$lang['added_buddylist']['text'] = "Óâàæàåìûé(àÿ) #FirstName#,

Âû áûëè äîáàâëåíû â ñïèñîê äðóçåé ïîëüçîâàòåëåì #SenderName#.

Äëÿ ïðîñìîòðà àíêåòû ýòîãî ïîëüçîâàòåëÿ, ïîñåòèòå <a href=\"#link#\">#siteName#</a>.

Óäà÷è!
#AdminName#
SITENAME";

$lang['added_hotlist']['text'] = "Óâàæàåìûé(àÿ) #FirstName#,

Âû áûëè äîáàâëåíû â ãîðÿ÷èé ñïèñîê ïîëüçîâàòåëÿ #SenderName#.

Äëÿ ïðîñìîòðà àíêåòû ýòîãî ïîëüçîâàòåëÿ, ïîñåòèòå <a href=\"#link#\">#siteName#</a>.

Óäà÷è!
#AdminName#
SITENAME";

$lang['added_banlist']['text'] = "Óâàæàåìûé(àÿ) #FirstName#,

Âû áûëè äîáàâëåíû â ÷åðíûé ñïèñîê ïîëüçîâàòåëåì #SenderName#.

Äëÿ ïðîñìîòðà àíêåòû ýòîãî ïîëüçîâàòåëÿ, ïîñåòèòå <a href=\"#link#\">#siteName#</a>.

#AdminName#";

New format
*/
$lang['added_list_sub'] = "SITENAME ñîîáùåíèå: Âû áûëè äîáàâëåíû â #ListName# ïîëüçîâàòåëÿ #SenderName#!";
$lang['added_list']['text'] = "Óâàæàåìûé(àÿ) #FirstName#,

Ïîëüçîâàòåëü #SenderName# äîáàâèë Âàñ â ñâîé #ListName#.

Äëÿ ïðîñìîòðà àíêåòû ýòîãî ïîëüçîâàòåëÿ, ïîñåòèòå <a href=\"#link#\">SITENAME</a>.

Óäà÷è!
#AdminName#
SITENAME";
$lang['added_list']['html'] = '<table border=0 cellpadding="0" cellspacing="0" width="570"><tr><td width="77" height="25px" class="module_head">#email_hdr_left#</td><td width="493" class="module_head" >&nbsp;&nbsp;Âû áûëè äîáàâëåíû â #ListName# ïîëüçîâàòåëÿ #SenderName#!</td></tr><tr><td width="100%" class="evenrow" colspan="2" style="padding: 6px;"><table border="0" cellspacing="0" cellpadding="6"><tr><td height="6"></td></tr><tr><td width="50%" valign="top" class="evenrow">Óâàæàåìûé(àÿ) #FirstName#,<br><br>Ïîëüçîâàòåëü <b>#SenderName#</b> äîáàâèë Âàñ â ñâîé <b>#ListName#</b>.<br><br>Äëÿ ïðîñìîòðà àíêåòû ýòîãî ïîëüçîâàòåëÿ, ïîñåòèòå <a href=\"#link#\">SITENAME</a>.<br><br>Óäà÷è!<br>#AdminName# <br>SITENAME<br></td><td valign="top">#smallProfile#</td></tr></table></td></tr><tr><td height="6" colspan="2" class="evenrow"></td></tr></table> ';

/* old format
$lang['invite_a_friend_sub'] = 'Ïðèãëàñèòü äðóãà';
$lang['invite_a_friend']['html'] = "Ïðèâåò,<br><br>ß íàøåë êðóòîé ñàéò çíàêîìñòâ: #Link#.<br>ß äóìàþ îí áóäåò òåáå èíòåðåñåí.<br><br>#FromName#";

New format
*/
$lang['invite_a_friend_sub'] = "SITENAME ñîîáùåíèå: Ïðèãëàøåíèå îò #FromName#! ";
$lang['invite_a_friend']['html'] = '<table border=0 cellpadding="0" cellspacing="0" width="570"><tr><td width="77"  class="module_head" valign="top">#email_hdr_left#</td><td width="493" class="module_head" >&nbsp;&nbsp;Ïðèãëàøåíèå îò #FromName#! </td></tr><tr><td width="100%" class="evenrow" colspan="2" style="padding: 5px;"><table border="0" cellspacing="0" cellpadding="6" width="100%"><tr><td height="6"></td></tr><tr><td width="100%" valign="top" class="evenrow">Ïðèâåò,<br><br>ß íàøåë êðóòîé ñàéò çíàêîìñòâ: <a href=\"#SiteUrl#\"><b>SITENAME</b></a><br>ß äóìàþ îí áóäåò òåáå èíòåðåñåí.<br><br>Ïîñåòè <a href=\"#SiteUrl#\">SITENAME</a>.<br><br>Óäà÷è!<br>#FromName# <br><br></td></tr></table></td></tr><tr><td height="12" class="evenrow" colspan="2" ></td></tr></table>';

/* old format
$lang['message_read_sub'] = '#SITENAME# - èíôîðìàöèîííîå ñîîáùåíèå';
$lang['message_read']['html'] = "Óâàæàåìûé(àÿ) #FirstName#,<br><br>Ñîîáùåíèå, ïîñëàííîå Âàìè äëÿ '#RecipientName#' áûëî ïðî÷èòàíî.<br><br>Óäà÷è!<br>#AdminName#";

New format */
$lang['message_read_sub'] = 'SITENAME ñîîáùåíèå: Âàøå ñîîáùåíèå äëÿ #RecipientName# ïðî÷èòàíî!';
$lang['message_read']['html'] = '<table border=0 cellpadding="0" cellspacing="0" width="570"><tr><td width="77" height="25" class="module_head">#email_hdr_left#</td><td width="493" class="module_head" >&nbsp;&nbsp;Âàøå ñîîáùåíèå äëÿ #RecipientName# ïðî÷èòàíî! </td></tr><tr><td width="100%" class="evenrow" colspan="2" style="padding: 5px;"><table border="0" cellspacing="0" cellpadding="6"><tr><td height="6"></td></tr><tr><td width="50%" valign="top" class="evenrow">Óâàæàåìûé(àÿ) #FirstName#,<br><br>Ñîîáùåíèå, ïîñëàííîå Âàìè äëÿ <b>#RecipientName#</b> áûëî ïðî÷èòàíî.<br><br>Äëÿ ïðîñìîòðà àíêåòû ýòîãî ïîëüçîâàòåëÿ, ïîñåòèòå <a href=\"#link#\">SITENAME</a>.<br><br>Óäà÷è!<br>#AdminName# <br>SITENAME<br></td><td valign="top">#smallProfile#</td></tr></table></td></tr><tr><td height="6" colspan="2" class="evenrow"></td></tr></table> ';

/* old format
$lang['email_feedback_subject'] = 'Îòçûâ îò Ïîëüçîâàòåëÿ ñàéòà '.SITENAME;
$lang['feedback_email_to_admin']['text'] = 'Óâàæàåìûé Àäìèíèñòðàòîð ñàéòà,

Âû ïîëó÷èëè êîììåíòàðèé îò ïîñåòèòåëÿ Âàøåãî ñàéòà çíàêîìñòâ. Íèæå ïîäðîáíîñòè ýòîãî êîììåíòàðèÿ:

Çàãîëîâîê: #txttitle#
Èìÿ: #txtname#
E-mail: #txtemail#
Ñòðàíà: #txtcountry#
Êîììåíòàðèé: #txtcomments#

Ñïàñèáî,
#SITENAME# , ñëóæáà ðàññûëêè';

$lang['feedback_email_to_admin']['html'] = 'Óâàæàåìûé Àäìèíèñòðàòîð ñàéòà,<br><br>Âû ïîëó÷èëè êîììåíòàðèé îò ïîñåòèòåëÿ Âàøåãî ñàéòà çíàêîìñòâ. Íèæå ïîäðîáíîñòè ýòîãî êîììåíòàðèÿ:<br><br>Çàãîëîâîê: #txttitle#<br>Èìÿ: #txtname#<br>E-mail: #txtemail#<br>Ñòðàíà: #txtcountry#<br>Êîììåíòàðèé: #txtcomments#<br><br>Ñïàñèáî,<br>#SITENAME# äåìîí';

New format */
$lang['email_feedback_subject'] = 'Îòçûâ îò Ïîëüçîâàòåëÿ ñàéòà SITENAME';
$lang['feedback_email_to_admin']['text'] = 'Óâàæàåìûé Àäìèíèñòðàòîð ñàéòà,

Âû ïîëó÷èëè êîììåíòàðèé îò ïîñåòèòåëÿ Âàøåãî ñàéòà çíàêîìñòâ. Íèæå ïîäðîáíîñòè ýòîãî êîììåíòàðèÿ:

Çàãîëîâîê: #txttitle#
Èìÿ: #txtname#
E-mail: #txtemail#
Ñòðàíà: #txtcountry#
Êîììåíòàðèé: #txtcomments#

Ñïàñèáî,
SITENAME , ñëóæáà ðàññûëêè';
$lang['feedback_email_to_admin']['html'] = '<table border=0 cellpadding="0" cellspacing="0" width="570"><tr><td width="77" height="25" class="module_head">#email_hdr_left#</td><td width="493" class="module_head" >&nbsp;&nbsp;Îòçûâ îò ïîëüçîâàòåëÿ </td></tr><tr><td width="100%" class="evenrow" colspan="2" style="padding: 5px;"><table border="0" cellspacing="0" cellpadding="0"><tr><td height="6"></td></tr><tr><td width="100%" valign="top" class="evenrow">Óâàæàåìûé(àÿ) Àäìèíèñòðàòîð ñàéòà,<br><br>Âû ïîëó÷èëè êîììåíòàðèé îò ïîñåòèòåëÿ Âàøåãî ñàéòà çíàêîìñòâ. Íèæå ïîäðîáíîñòè ýòîãî êîììåíòàðèÿ:<br><br><table cellspacing="4" cellpadding="2" border="0" width="100%"><tr><td width="20%"> Çàãîëîâîê:</td><td width="80%">#txttitle# </td></tr><tr><td>Èìÿ:</td> <td>#txtname#</td></tr><tr><td>E-mail:</td><td>#txtemail#</td></tr><tr><td>Ñòðàíà:</td><td>#txtcountry#</td></tr><tr><td>Êîììåíòàðèé:</td><td>#txtcomments#</td></tr></table><br>Ñïàñèáî,<br>SITENAME äåìîí<br><br></td></tr></table></td></tr></table> ';

/* old format
$lang['forgot_password_sub'] = 'Çàïðîñ ïàðîëÿ';
$lang['forgot_password']['text'] = "Óâàæàåìûé(àÿ) #Name#,

Âàø ID ïîëüçîâàòåëÿ: #ID#
Âàø ïàðîëü:  #Password#

Äëÿ âõîäà, ïðîéäèòå ïî ýòîé ññûëêå: #LoginLink#.

Ñïàñèáî çà èñïîëüçîâàíèå íàøèõ óñëóã!

Ñèñòåìà îòïðàâêè ïèñåì #SiteTitle#
<Àâòîìàòè÷åñêè ñãåíåðèðîâàííîå ïèñüìî, ïîæàëóéñòà íå îòâå÷àéòå>";
$lang['forgot_password']['html'] = "Óâàæàåìûé(àÿ) #Name#,<br><br>Âàø ID ïîëüçîâàòåëÿ: #ID#<br>Âàø ïàðîëü: #Password#<br><br>Äëÿ âõîäà ïðîéäèòå ïî ýòîé ññûëêå: #LoginLink#.<br><br>Ñïàñèáî çà èñïîëüçîâàíèå íàøèõ óñëóã!<br><br>Ñèñòåìà îòïðàâêè ïèñåì #SiteTitle#<br><Àâòîìàòè÷åñêè ñãåíåðèðîâàííîå ïèñüìî, ïîæàëóéñòà íå îòâå÷àéòå>";



New format */
$lang['forgot_password_sub'] = 'SITENAME ñîîáùåíèå: Âàø çàïðîñ íà ñáðîñ ïàðîëÿ';
$lang['forgot_password']['text'] = "Óâàæàåìûé(àÿ) #Name#,

Ýòî îòâåò íà Âàøó ïðîñüáó î ñáðîñå ïàðîëÿ äëÿ äîñòóïà ê Âàøåìó àêàóíòó.

Âàø ID ïîëüçîâàòåëÿ: #ID#
Âàø íîâûé ïàðîëü:  #Password#

Äëÿ âõîäà, ïðîéäèòå ïî ýòîé ññûëêå: #LoginLink#.

Ñïàñèáî çà èñïîëüçîâàíèå íàøèõ óñëóã!

#AdminName#
SITENAME";
$lang['forgot_password']['html'] = '<table border=0 cellpadding="0" cellspacing="0" width="570"><tr><td width="77" height="25" class="module_head">#email_hdr_left#</td><td width="493" class="module_head" >&nbsp;&nbsp;Âàø çàïðîñ íà ñáðîñ ïàðîëÿ</td></tr><tr><td width="100%" class="evenrow" colspan="2" style="padding: 5px;"><table border="0" cellspacing="0" cellpadding="0"><tr><td height="6"></td></tr><tr><td width="100%" valign="top" class="evenrow">Óâàæàåìûé(àÿ) #Name#,<br><br>Ýòî îòâåò íà Âàøó ïðîñüáó î ñáðîñå ïàðîëÿ äëÿ äîñòóïà ê Âàøåìó àêêàóíòó.<br><br>Âàø ID ïîëüçîâàòåëÿ: <b>#ID#</b><br>Âàø íîâûé ïàðîëü: <b>#Password#</b><br><br>Äëÿ âõîäà ïðîéäèòå ïî ýòîé ññûëêå: <a href=\"#LoginLink#\">SITENAME</a>.<br><br>Ñïàñèáî çà èñïîëüçîâàíèå íàøèõ óñëóã!<br><br>#AdminName#<br>SITENAME<br></td></tr> </table></td></tr><tr><td height="6" colspan="2" class="evenrow"></td></tr></table> ';

/* old format
$lang['expiry_ltr_sub'] = 'Reminder of Membership Expiry';
$lang['mship_expired_note']['text'] = "Óâàæàåìûé(àÿ) #FirstName#,

Ýòî àâòîìàòè÷åñêîé óâåäîìëåíèå î òîì, ÷òî Âàøå ÷ëåíñòâî óðîâíÿ #MembershipLevel# íà #siteName# èñòåêëî #ExpiryDate#.

Ïîæàëóéñòà, <a href=\"#link#\">çàéäèòå íà #siteName#</a>, ÷òîáû îáíîâèòü Âàøå ÷ëåíñòâî è ïðîäîëæàòü ïîëó÷àòü íàøè óñëóãè.

Óäà÷è!
#AdminName#";
$lang['mship_expired_note']['html'] = "Óâàæàåìûé(àÿ) #FirstName#,<br><br>Ýòî àâòîìàòè÷åñêîå óâåäîìëåíèå î òîì, ÷òî Âàøå ÷ëåíñòâî óðîâíÿ #MembershipLevel# íà #siteName# èñòåêëî #ExpiryDate#.<br><br>Ïîæàëóéñòà, <a href=\"#link#\">çàéäèòå íà #siteName#</a>, ÷òîáû îáíîâèòü Âàøå ÷ëåíñòâî è ïðîäîëæàòü ïîëó÷àòü íàøè óñëóãè.<br><br>Óäà÷è!<br>#AdminName#";

New format */
$lang['expiry_ltr_sub'] = 'SITENAME ñîîáùåíèå: Íàïîìèíàíèå îá èñòå÷åíèè ñðîêà ÷ëåíñòâà';

$lang['mship_expired_note']['text'] = "Óâàæàåìûé(àÿ) #FirstName#,

Ñïàñèáî çà èñïîëüçîâàíèå SITENAME!

Ýòî ïèñüìî èíôîðìèðóåò Âàñ, ÷òî ñðîê Âàøåãî ÷ëåíñòâà óðîâíÿ #MembershipLevel# íà ñàéòå SITENAME èñòåêàåò #ExpiryDate#.

Ïîæàëóéñòà, <a href=\"#link#\">çàéäèòå íà SITENAME</a>, ÷òîáû îáíîâèòü Âàøå ÷ëåíñòâî è ïðîäîëæàòü ïîëó÷àòü íàøè óñëóãè.

Óäà÷è!
#AdminName#
SITENAME";

$lang['mship_expired_note']['html'] = '<table border=0 cellpadding="0" cellspacing="0" width="570"><tr><td width="77" height="25" class="module_head">#email_hdr_left#</td><td width="493" class="module_head" >&nbsp;&nbsp;Âàøå ÷ëåíñòâî èñòåêàåò! </td></tr><tr><td width="100%" class="evenrow" colspan="2" style="padding: 5px;"><table border="0" cellspacing="0" cellpadding="6"><tr><td height="6"></td></tr><tr><td width="100%" valign="top" class="evenrow">Óâàæàåìûé(àÿ) #FirstName#,<br><br>Ñïàñèáî çà èñïîëüçîâàíèå ñàéòà SITENAME!<br><br>Ýòî ïèñüìî èíôîðìèðóåò Âàñ, ÷òî ñðîê Âàøåãî óðîâíÿ ÷ëåíñòâà - <b>#MembershipLevel#</b> íà ñàéòå <a href="\"#link#\"><b>SITENAME</b></a> èñòåêàåò <b>#ExpiryDate#</b>.<br><br>Ïîæàëóéñòà <a href=\"#link#\">çàéäèòå íà ñàéò SITENAME</a> äëÿ îáíîâëåíèÿ Âàøåãî ÷ëåíñòâà äëÿ ïðîäîëæåíèÿ èñïîëüçîâàíèÿ íàøèõ óñëóã.<br><br>Óäà÷è!<br>#AdminName# <br>SITENAME<br></td></tr></table></td></tr><tr><td height="6" colspan="2" class="evenrow"></td></tr></table> ';

/* old format
$lang['mship_expiry_note']['text'] = 'Óâàæàåìûé(àÿ) #FirstName#,

Ýòî ïèñüìî èíôîðìèðóåò Âàñ, ÷òî ñðîê Âàøåãî ÷ëåíñòâà íà ñàéòå #siteName# èñòåêàåò #ExpiryDate#.

Ïîæàëóéñòà <a href="#link#">çàéäèòå íà #siteName#</a> è îáíîâèòå Âàøå ÷ëåíñòâî.

Óäà÷è!
#AdminName#';

$lang['mship_expiry_note']['html'] = 'Óâàæàåìûé(àÿ) #FirstName#,<br><br>Ýòî ïèñüìî èíôîðìèðóåò Âàñ, ÷òî ñðîê Âàøåãî ÷ëåíñòâà íà ñàéòå #siteName# èñòåêàåò #ExpiryDate#.<br><br>Ïîæàëóéñòà <a href="#link#">çàéäèòå íà ñàéò #siteName#</a> è îáíîâèòå Âàøå ÷ëåíñòâî.<br><br>Óäà÷è!<br>#AdminName#';


New format */
$lang['mship_expiry_note']['text'] = 'Óâàæàåìûé(àÿ) #FirstName#,

Ñïàñèáî çà èñïîëüçîâàíèå SITENAME!

Ýòî ïèñüìî èíôîðìèðóåò Âàñ, ÷òî ñðîê Âàøåãî óðîâíÿ ÷ëåíñòâà - #MembershipLevel# íà ñàéòå SITENAME èñòåêàåò #ExpiryDate#.

Ïîæàëóéñòà <a href="#link#">çàéäèòå íà SITENAME</a>, ÷òîáû îáíîâèòü Âàøå ÷ëåíñòâî è ïðîäîëæàòü ïîëó÷àòü íàøè óñëóãè.


Óäà÷è!
#AdminName#
SITENAME';

$lang['mship_expiry_note']['html'] = '<table border=0 cellpadding="0" cellspacing="0" width="570"><tr><td width="77" height="25" class="module_head">#email_hdr_left#</td><td width="493" class="module_head" >&nbsp;&nbsp;Âàøå ÷ëåíñòâî èñòåêàåò! </td></tr><tr><td width="100%" class="evenrow" colspan="2" style="padding: 5px;"><table border="0" cellspacing="0" cellpadding="6"><tr><td height="6"></td></tr><tr><td width="100%" valign="top" class="evenrow">Óâàæàåìûé(àÿ) #FirstName#,<br><br>Ñïàñèáî çà èñïîëüçîâàíèå ñàéòà SITENAME!<br><br>Ýòî ïèñüìî èíôîðìèðóåò Âàñ, ÷òî ñðîê Âàøåãî óðîâíÿ ÷ëåíñòâà - <b>#MembershipLevel#</b> íà ñàéòå <a href="\"#link#\"><b>SITENAME</b></a> èñòåêàåò <b>#ExpiryDate#</b>.<br><br>Ïîæàëóéñòà <a href=\"#link#\">çàéäèòå íà ñàéò SITENAME</a> äëÿ îáíîâëåíèÿ Âàøåãî ÷ëåíñòâà äëÿ ïðîäîëæåíèÿ èñïîëüçîâàíèÿ íàøèõ óñëóã.<br><br>Óäà÷è!<br>#AdminName# <br>SITENAME<br></td></tr></table></td></tr><tr><td height="6" colspan="2" class="evenrow"></td></tr></table> ';

/* Newly added - mail to be sent to member when admin changes membership level */

$lang['profile_membership_changed_sub'] = 'SITENAME ñîîáùåíèå:  Âàø óðîâåíü ÷ëåíñòâà èçìåíåí!';
$lang['profile_membership_changed']['html'] = '<table border=0 cellpadding="0" cellspacing="0" width="570"><tr><td width="77" height="25" class="module_head">#email_hdr_left#</td><td width="493" class="module_head" >&nbsp;&nbsp;Âàø óðîâåíü ÷ëåíñòâà èçìåíåí! </td></tr><tr><td width="100%" class="evenrow" colspan="2" style="padding: 5px;"><table border="0" cellspacing="0" cellpadding="3"><tr><td height="4"></td></tr><tr><td width="100%" valign="top" class="evenrow">Óâàæàåìûé(àÿ) #FirstName#,<br><br>Âàø òåêóùèé óðîâåíü ÷ëåíñòâà <b>#CurrentLevel#</b> èçìåíåí íà <b>#NewLevel#</b> êîòîðûé èñòå÷åò <b>#ValidDate#</b>.<br><br>Ïîñåòèòå íàñ: <a href=\"#link#\">SITENAME</a>.<br><br>Óäà÷è!<br>#AdminName# <br>SITENAME<br></td></tr></table></td></tr><tr><td height="6" colspan="2" class="evenrow"></td></tr></table> ';

$lang['profile_membership_changed']['text'] = "Óâàæàåìûé(àÿ) #FirstName#,

Âàø òåêóùèé óðîâåíü ÷ëåíñòâà <b>#CurrentLevel#</b> èçìåíåí íà <b>#NewLevel#</b> êîòîðûé èñòåêàåò <b>#ValidDate#</b>.

Ïîñåòèòå íàñ: <a href=\"#link#\">SITENAME</a>.

Óäà÷è!
#AdminName#
SITENAME
";

$lang['comment_received_sub'] = 'SITENAME Ñîîáùåíèå: Ïîëüçîâàòåëü äîáàâèë íîâûé êîììåíòàðèé â Âàø áëîã';
$lang['comment_received']['text'] = "Óâàæàåìûé(àÿ) #FirstName#,

Âû ïîëó÷èëè êîììåíòàðèé îò ïîñåòèòåëÿ ñàéòà SITENAME '<b>#SenderName#</b>'.

Ïîæàëóéñòà ïîñåòèòå <a href=\"#link#\"><b>SITENAME</b></a> äëÿ ïðîñìîòðà êîììåíòàðèÿ îò '<b>#SenderName#</b>'.

Óäà÷è!
#AdminName#
SITENAME";

$lang['comment_received']['html'] = '<table border=0 cellpadding="0" cellspacing="0" width="570"><tr><td width="77" height="25" class="module_head">#email_hdr_left#</td><td width="493" class="module_head" >&nbsp;&nbsp;Ïîëüçîâàòåëü äîáàâèë íîâûé êîììåíòàðèé â Âàø áëîã! </td></tr><tr><td width="100%" class="evenrow" colspan="2" style="padding: 5px;"><table border="0" cellspacing="0" cellpadding="6"><tr><td height="6"></td></tr><tr><td width="100%" valign="top" class="evenrow">Óâàæàåìûé(àÿ) #FirstName#,<br><br>Âû ïîëó÷èëè êîììåíòàðèé îò ïîñåòèòåëÿ ñàéòà <b>#SenderName#</b>.<br><br>Ïîæàëóéñòà ïîñåòèòå <a href=\"#link#\"><b>SITENAME</b></a> äëÿ ïðîñìîòðà êîììåíòàðèÿ îò <b>#SenderName#</b>.<br><br>Óäà÷è!<br>#AdminName# <br>SITENAME<br></td></tr></table></td></tr><tr><td height="6" colspan="2" class="evenrow"></td></tr></table> ';
$lang['aff_added_sub'] = 'SITENAME ñîîáùåíèå: Âû äîáàâëåíû êàê ïàðòíåð!';
$lang['aff_added']['text'] = "Óâàæàåìûé(àÿ) #Name#,

Ìû ðàäû ñîîáùèòü Âàì, ÷òî Âû äîáàâëåíû êàê ïàðòíåð ñàéòà SITENAME.

Âàø ID: #Affid#
Âàø ïàðîëü: #Password#

Ïîæàëóéñòà ïîñåòèòå <a href=\"#SiteUrl#\"><b>SITENAME</b></a>, çàéäèòå â ðàçäåë äëÿ ïàðòíåðîâ è èçìåíèòå Âàø ïàðîëü íà áîëåå óäîáíûé äëÿ Âàñ.

Óäà÷è!
#AdminName#
SITENAME";

$lang['aff_added']['html'] = '<table border=0 cellpadding="0" cellspacing="0" width="570"><tr><td width="77" height="25" class="module_head">#email_hdr_left#</td><td width="493" class="module_head" >&nbsp;&nbsp;Âû äîáàâëåíû êàê àôèëèýéò! </td></tr><tr><td width="100%" class="evenrow" colspan="2" style="padding: 5px;"><table border="0" cellspacing="0" cellpadding="6"><tr><td height="6"></td></tr><tr><td width="100%" valign="top" class="evenrow">Óâàæàåìûé(àÿ) #Name#,<br><br>Ìû ðàäû ñîîáùèòü Âàì, ÷òî Âû äîáàâëåíû êàê àôèëèýéò ñàéòà SITENAME.<br><br><b>Âàø ID: #Affid#</b><br><b>Âàø ïàðîëü: #Password#</b><br><br>Ïîæàëóéñòà ïîñåòèòå <a href=\"#SiteUrl#\"><b>SITENAME</b></a> è çàéäèòå â àôèëèýéòíóþ ñåêöèþ è èçìåíèòå Âàø ïàðîëü íà áîëåå óäîáíûé äëÿ Âàñ.<br><br>Óäà÷è!<br>#AdminName# <br>SITENAME<br></td></tr></table></td></tr><tr><td height="6" colspan="2" class="evenrow"></td></tr></table> ';

$lang['aff_newpwd_sub'] = 'SITENAME ñîîáùåíèå: Âàø ïàðòíåðñêèé àêêàóíò!';
$lang['aff_newpwd']['text'] = "Óâàæàåìûé(àÿ) #Name#,

Íîâûé ïàðîëü ñãåíåðèðîâàí äëÿ âàøåãî ïàðòíåðñêîãî àêêàóíòà íà ñàéòå SITENAME ïî Âàøåìó çàïðîñó.

Âàø íîâûé ïàðîëü: #Password#

Ïîæàëóéñòà ïîñåòèòå <a href=\"#SiteUrl#\"><b>SITENAME</b></a>, çàéäèòå â ðàçäåë äëÿ ïàðòíåðîâ è èçìåíèòå Âàø ïàðîëü íà áîëåå óäîáíûé äëÿ Âàñ.

Óäà÷è!
#AdminName#
SITENAME";

$lang['aff_newpwd']['html'] = '<table border=0 cellpadding="0" cellspacing="0" width="570"><tr><td width="77" height="25" class="module_head">#email_hdr_left#</td><td width="493" class="module_head" >&nbsp;&nbsp;Âàø àôèëèýéòíûé àêàóíò! </td></tr><tr><td width="100%" class="evenrow" colspan="2" style="padding: 5px;"><table border="0" cellspacing="0" cellpadding="6"><tr><td height="6"></td></tr><tr><td width="100%" valign="top" class="evenrow">Óâàæàåìûé(àÿ) #Name#,<br><br>Íîâûé ïàðîëü ñãåíåðèðîâàí äëÿ âàøåãî àôèëèýéòíîãî àêàóíòà íà ñàéòå SITENAME ïî Âàøåìó çàïðîñó.<br><br><b>Âàø ïàðîëü: #Password#</b><br><br>Ïîæàëóéñòà ïîñåòèòå <a href=\"#SiteUrl#\"><b>SITENAME</b></a> è çàéäèòå â àôèëèýéòíóþ ñåêöèþ è èçìåíèòå Âàø ïàðîëü íà áîëåå óäîáíûé äëÿ Âàñ.<br><br>Óäà÷è!<br>#AdminName# <br>SITENAME<br></td></tr></table></td></tr><tr><td height="6" colspan="2" class="evenrow"></td></tr></table> ';

$lang['add_affiliate'] = 'Äîáàâèòü ïàðòíåðà';
$lang['mod_affiliate'] = 'Èçìåíèòü ïàðòíåðà';
$lang['aff_modified'] = 'Èíôîðìàöèÿ î ïàðòíåðå èçìåíåíà';

$lang['newuser']['html'] = '<table border=0 cellpadding="0" cellspacing="0" width="570"><tr><td width="77" height="25" class="module_head">#email_hdr_left#</td><td width="493" class="module_head" >&nbsp;&nbsp;Çàðåãèñòðèðîâàí íîâûé ïîëüçîâàòåëü!</td></tr><tr><td width="100%" class="evenrow" colspan="2" style="padding: 5px;"><table border="0" cellspacing="0" cellpadding="6"><tr><td height="6"></td></tr><tr><td width="100%" valign="top" class="evenrow">Óâàæàåìûé(àÿ) Àäìèíèñòðàòîð ñàéòà,<br><br>Íîâûé ïîëüçîâàòåëü çàðåãèñòðèðîâàí íà #SiteName#.<br><br>Èìÿ ïîëüçîâàòåëÿ: #UserName#<br><br>#AdminName# <br>SITENAME<br></td></tr></table></td></tr><tr><td height="6" colspan="2" class="evenrow"></td></tr></table> ';

$lang['newuser']['text'] = "Óâàæàåìûé Àäìèíèñòðàòîð ñàéòà,

Íîâûé ïîëüçîâàòåëü çàðåãèñòðèðîâàí íà #SiteName#.

Èìÿ ïîëüçîâàòåëÿ: #UserName#

#AdminName#
SITENAME";

$lang['newuser_sub'] = 'Çàðåãèñòðèðîâàí íîâûé ïîëüçîâàòåëü';

/* Following user options are managed. Please modify only the description and not these keys */

$lang['user_choices'] = array(
  'email_message_received'  => "Îòïðàâèòü e-mail ïðè ïîëó÷åíèè íîâîãî ñîîáùåíèÿ.",
  'email_wink_received'   => "Îòïðàâèòü e-mail, êîãäà êòî-íèáóäü ïîäìèãíåò ìíå.",
  'email_blog_commented'    => "Îòïðàâèòü e-mail, êîãäà êòî-íèáóäü äîáàâèò êîììåíòàðèé â ìîé áëîã.",
  'email_mship_expiry'    => "Îòïðàâëÿòü íàïèìèíàíèÿ ïî e-mail îá èñòå÷åíèè ñðîêà ÷ëåíñòâà.",
  'email_message_read'    => "Îòïðàâëÿòü e-mail, êîãäà ïîëó÷àòåëü ìîåãî ñîîáùåíèÿ ïðî÷òåò åãî.",
  'email_buddy_list'      => "Îòïðàâëÿòü e-mail, êîãäà êòî-íèáóäü äîáàâèò ìåíÿ â ñâîé ñïèñîê äðóçåé.",
  'email_ban_list'      => "Îòïðàâëÿòü e-mail, êîãäà êòî-íèáóäü äîáàâèò ìåíÿ â ñâîé ÷åðíûé ñïèñîê.",
  'email_hot_list'      => "Îòïðàâëÿòü e-mail, êîãäà êòî-íèáóäü äîáàâèò ìåíÿ â ñâîé ãîðÿ÷èé ñïèñîê.",
  "allow_buddy_view_album"  => "Ðàçðåøèòü ïîëüçîâàòåëÿì èç ñïèñêà äðóçåé ñìîòðåòü ìîè ÷àñòíûå àëüáîìû.",
  "allow_hotlist_view_album"  => "Ðàçðåøèòü ïîëüçîâàòåëÿì èç ãîðÿ÷åãî ñïèñêà ñìîòðåòü ìîè ÷àñòíûå àëüáîìû.",
  'email_match_mail_days'   => "×àñòîòà, â äíÿõ, îòïðàâëåíèÿ ïèñåì \'ìîèõ ñîâïàäåíèé\'. Ââåäèòå 0, åñëè Âû íå æåëàåòå ïîëó÷àòü òàêèå ïèñüìà.",
  );
$lang['mysettings_updated'] = 'Âàøè ïðåäïî÷òåíèÿ ïîëó÷åíèÿ ïèñåì îáíîâëåíû';
$lang['mysettings_updated'] = 'Âàøè ïðåäïî÷òåíèÿ ïîëó÷åíèÿ ïèñåì îáíîâëåíû';
$lang['resend_conflink_hdr'] = 'Ïîâòîðíî ïîñëàòü ïèñüìî ñ ïîäòâåðæäåíèåì ðåãèñòðàöèè';
$lang['resend_conflink_hdr1'] = 'Ïîòåðÿëè èëè íå ïîëó÷èëè ñâîå ïèñüìî ñ ïîäòâåðæäåíèåì ïîñëå ðåãèñòðàöèè? Ââåäèòå àäðåñ ýëåêòðîííîé ïî÷òû, êîòîðûé Âû èñïîëüçîâàëè âî âðåìÿ ðåãèñòðàöèèäëÿ ïîâòîðíîé îòïðàâêè ïèñüìà.';
$lang['resend_conflink_msg'] = 'Âàøå ïèñüìî ñ ïîäòâåðæäåíèåì ïîâòîðíî îòïðàâëåíî íà Âàø e-mail.';
$lang['resend_conflink_msg1'] = 'Ïîæàëóéñòà ââåäèòå e-mail àäðåñ, êîòîðûéÂû èñïîëüçîâàëè âî âðåìÿ ðåãèñòðàöèè.';
$lang['resend_conflink_err1'] = 'Âû óæå ïîäòâåðäèëè ñâîþ àíêåòó. Ïîæàëóéñòà èñïîëüçóéòå <a href="forgotpass.php">Çàáûëè ïàðîëü</a> ññûëêó äëÿ ãåíåðàöèè íîâîãî ïàðîëÿ.';
$lang['about_me'] = 'Russian Text: Обо мне German Umlaut: ä ö ü';
$lang['about_me_hlp'] = 'Ââåäèòå íåáîëüøîå îïèñàíèå î Âàñ, êîòîðîå áóäåò èíòåðåñíî äðóãèì è ñìîæåò ïîìî÷ü ïîëó÷èòü áîëüøå îòâåòîâ.';
$lang['aff_forgot_pass'] = 'Çàáûëè Âàø ïàðîëü? Ââåäèòå Âàø email àäðåñ çäåñü äëÿ ïîëó÷åíèÿ íîâîãî ïàðîëÿ:';
$lang['send_new_password'] = 'Îòïðàâèòü íîâûé ïàðîëü';
$lang['not_a_member'] = 'Íå çàðåãèñòðèðîâàíû?';
$lang['login_reminded'] = 'Íàïîìèíàíèå î Âàøèõ èìåíè ïîëüçîâàòåëÿ è ïàðîëå.';
$lang['lost_confemail'] = 'Ïîòåðÿëè ïèñüìî ñ ïîäòâåðæäåíèåì?';
$lang['couple_usernames'] = 'Ïàðà / Ãðóïïà èìåí ïîëüçîâàòåëåé';
$lang['couple_usernames_hlp'] = 'Ïàðà èëè ãðóïïà ñîñòîèò èç äâóõ è áîëåå ëèö. Ïîæàëóéñòà, ââåäèòå èìåíà ÷ëåíîâ ýòîé ïàðû èëè ãðóïïû â òåêñòîâîå ïîëå ñíèçó. Íàïðèìåð: user_1,user_2,user_3. Ýòè ïîëüçîâàòåëè äîëæíû óæå èìåòü ñîáñòâåííûå àíêåòû.';
$lang['blog']['del01'] = 'Âû äåéñòâèòåëüíî õîòèòå óäàëèòü ýòîò êîììåíòàðèé?';
$lang['blog']['del02'] = 'Âû äåéñòâèòåëüíî õîòèòå óäàëèòü îòìå÷åííûå ';
$lang['feat_prof_del_msg'] = 'Âû õîòèòå óäàëèòü ýòó àíêåòó èç ñïèñêà èçáðàííûõ?';
$lang['feat_prof_deleted'] = 'Îòìå÷åííûå àíêåòû óäàëåíû èç ñïèñêà èçáðàííûõ.';

$lang['mymatches_sub'] = 'SITENAME ñîîáùåíèå: Ïèñüìî ñ àíêåòàìè Âàøèõ ïîèñêîâûõ êðèòåðèåâ!';
$lang['mymatches_body']['html'] = '<table border=0 cellpadding="0" cellspacing="0" width="570"><tr><td width="77" height="25">#email_hdr_left#</td><td width="493" class="module_head" >&nbsp;&nbsp;Ïèñüìî ñ àíêåòàìè Âàøèõ ïîèñêîâûõ êðèòåðèåâ! </td></tr><tr><td width="570" class="evenrow" colspan="2" style="padding: 5px;"><table border="0" cellspacing="2" cellpadding="2"><tr><td height="6"></td></tr><tr><td class="evenrow">Óâàæàåìûé(àÿ) #FirstName#,<br><br>Ñïèñîê àíêåò, ïîäõîäÿùèõ ïîä Âàøè ïîèñêîâûå êðèòåðèè:</td></tr><tr><td height="10" class="evenrow"> </td></tr><tr><td valign="top" class="evenrow">#matchedProfiles#</td></tr><tr><td height="10" class="evenrow"> </td></tr><tr><td class="evenrow">Ïîæàëóéñòà ïîñåòèòå <a href=\"#link#\">SITENAME</a> äëÿ ïðîñìîòðà ýòèõ àíêåò.<br><br>Óäà÷è!<br>#AdminName#<br>SITENAME<br></td></tr></table> </td></tr></table>';
$lang['on'] = ' ïî ';

$lang['use_seo_username'] = 'Èñïîëüçîâàòü èìÿ ïîëüçîâàòåëÿ â êà÷åñòâå ïàðàìåòðà â URL. Âêëþ÷åíèå ýòîé îïöèè ïðåäîñòàâèò URL àíêåò â ôîðìàòå "domain/èìÿ_ïîëüçîâàòåëÿ". Îòêëþ÷åíèå ýòîé îïöèè ïðåäîñòàâèò URL àíêåò â ôîðìàòå "domain/id.htm"';
$lang['leave_blank_no_change'] = '(îñòàâüòå ïóñòûì åñëè áåç èçìåíåíèé)';

$lang['adminltr']['html']='<table border=0 cellpadding="0" cellspacing="0" width="570"><tr><td width="77" height="25" class="module_head">#email_hdr_left#</td><td width="493" class="module_head" >&nbsp;&nbsp;#Subject#</td></tr><tr><td width="100%" class="evenrow" colspan="2" style="padding: 5px;"><table border="0" cellspacing="0" cellpadding="6"><tr><td height="6"></td></tr><tr><td width="100%" valign="top" class="evenrow">#LetterContent#</td></tr></table></td></tr><tr><td height="6" colspan="2" class="evenrow"></td></tr></table> ';

$lang['adminltr']['text'] = '#LetterContent#';

/* Following is the section headers in appropriate languages */

$lang['sections'] = array(
	'1'	=> 	'Îáùàÿ èíôîðìàöèÿ',
	'2'	=>	'Ôèçè÷åñêîå ðàçâèòèå',
	'3'	=>	'Ïðîôåñññèîíàëüíàÿ æèçíü',
	'4'	=>	'Ñòèëü æèçíè',
	'5'	=>	'Èíòåðåñû'
	);

/* Following is for mail encoding */
$lang['mail_text_encoding'] = '8bit';
$lang['mail_html_encoding'] = '8bit';
$lang['mail_html_charset'] = 'windows-1251';
$lang['mail_text_charset'] = 'windows-1251';
$lang['mail_head_charset'] = 'windows-1251';

$lang['status_disp'] = array(
  'approval' => 'Îæèäàþùèå ïîäòâåðæäåíèÿ',
  'active' => 'Àêòèâíûå',
  'rejected' => 'Îòêëîíåííûå',
  'suspended' => 'Ïðèîñòàíîâëåííûå',
  /* added in 1.1.0 */
  'cancel' => 'Îòìåíåííûå'
  );

$lang['status_enum'] = array(
  'approval' => 'Îæèäàþùèå ïîäòâåðæäåíèÿ',
  'active' => 'Àêòèâíûå',
  'rejected' => 'Îòêëîíåííûå',
  'suspended' => 'Ïðèîñòàíîâëåííûå',
  );
$lang['status_act'] = array(
  'approval' => 'Ïîäòâåðäèòü',
  'active' => 'Àêòèâèðîâàòü',
  'rejected' => 'Îòêëîíèòü',
  'suspended' => 'Ïðèîñòàíîâèòü',
  /* added in 1.1.0 */
  'cancel' => 'Îòìåíèòü'
  );

?>
