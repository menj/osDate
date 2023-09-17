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

	$lang['user_title']="Auto Profile Generator";

	$lang['desc']="This profile generator can make your new dating website look active quickly. Sample user profiles are randomly generated, but to fine-tune the results, you may specify the constraints shown below.";
	$lang['desc2']=' Before completing this form you must fill the following files with corresponding names:<br/>
    PLUGIN_PATHsample_data/lastnames.txt<br/>
    PLUGIN_PATHsample_data/female_firstnames.txt<br/>
    PLUGIN_PATHsample_data/male_firstnames.txt<br/><br/>
    Sample profile images should be placed in the folder : PLUGIN_PATHsample_data/profile_images/<br/>
    The image names must use the following format rules: {gender}_{age}_{ethnicity}_{anythere_here}.{extension}<br/>
    {gender} -  must be "m" or "f" corresponding to "male" or "female"<br/>
    {age} - must be a integer number between 16 and 90<br/>
    {ethnicity} - must be one of these: "w" for white; "b" for black; "a" for asian; "o" for other;<br />
    This first part of the file name is required: {gender}_{age}_{ethnicity}. Additional text can be appended with an additional "_" separator after {ethnicity}. For example m_20_b_01.jpg and m_20_b_02.jpg if you have two 20-yr old black males.<br/>';
	$plugindir=str_replace("\\","/",PLUGIN_DIR);
	$lang['desc2']=str_replace("PLUGIN_PATH",$plugindir,$lang['desc2']);
	$lang['opt1']="Number of profiles to generate:";
	$lang['atleast']="At least";
	$lang['opt2']="of profiles should be males.";
	$lang['opt3']="of profiles should be females.";
	$lang['opt4']="Choose the number of countries to use:";
	$lang['opt5']="of profiles should be in";
	$lang['opt6']="Choose the number of age ranges to use:";
	$lang['opt7']="of profiles should be within ages";
	$lang['opt8']="of profiles should have white ethnicity.";
	$lang['opt9']="of profiles should have black ethnicity.";
	$lang['opt10']="of profiles should have asian ethnicity.";
	$lang['opt11']="of profiles should have other ethnicity.";

	$lang['generate']="Generate";
	$lang['and']="and";
	$lang['showforms']="View previously generated data.";
	$lang['total_forms']="Total generated forms:";
	$lang['total_users']="Total generated users:";
	$lang['forminfo']="Statistics for this generated form:";
	$lang['form_date']="Run Date";
	$lang['malegen']="Males";
	$lang['femalegen']="Females";

	$lang['username']="Username";
	$lang['gender']="Gender";
	$lang['fullname']="Full Name";
	$lang['birth_date']="Birth Date";
	$lang['ethnicity']="Ethnicity";
	$lang['country']="Country";

	$lang['form1']="Users generated by gender:";
	$lang['form2']="Users generated by ethnicity:";
	$lang['form3']="Users generated by age:";
	$lang['form4']="Users generated by country:";

	$lang['etn1']="White";
	$lang['etn2']="Black";
	$lang['etn3']="Asian";
	$lang['etn4']="Other";

	$lang['next']="Next page";
	$lang['previous']="Previous page";

	$lang['random']="Random";
	$lang['between']="Between";


	$lang['error2']="profiles have been created succesfully.";
	$lang['error3']="Are you sure you want to remove all profiles that were generated in this instance?";
	$lang['error4']="Please specify a positive integer value for the number of profiles.";
	$lang['error5']="Please specify a positive integer value for the number of countries.";
	$lang['error6']="Please specify a positive integer value for the number of age ranges.";
?>