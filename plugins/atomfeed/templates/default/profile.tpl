<b>{$lang.age}:</b> {$profile.age}<br>
<b>{$lang.sex}</b> {$lang_gender}<br>
<b>{$lang.looking_for}:</b> {$lang_gender_look}<br>
<b>{$lang.location_col}</b> {if $profile.cityname}{$profile.cityname}{else}{$profile.city}{/if}{if $profile.statename}, {$profile.statename}{/if}, {$profile.countryname}<br><br>