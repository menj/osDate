##
## Table structure for table `[prefix]_admin`
##

CREATE TABLE `[prefix]_admin` (
  `id` int(11) NOT NULL auto_increment,
  `username` varchar(25) NOT NULL default '',
  `password` varchar(32) NOT NULL default '',
  `fullname` varchar(100) NOT NULL default '',
  `lastvisit` int(11) NOT NULL default '0',
  `super_user` char(1) NOT NULL default 'N',
  `enabled` char(1) NOT NULL default 'Y',
  PRIMARY KEY  (`id`)
) TYPE=MyISAM CHARACTER SET utf8 COLLATE utf8_general_ci;

## ########################################################

##
## Table structure for table `[prefix]_admin_permissions`
##

CREATE TABLE `[prefix]_admin_permissions` (
  `id` int(11) NOT NULL auto_increment,
  `adminid` int(11) NOT NULL default '0',
  `site_stats` char(1) NOT NULL default '0',
  `profie_approval` char(1) NOT NULL default '0',
  `profile_mgt` char(1) NOT NULL default '0',
  `section_mgt` char(1) NOT NULL default '0',
  `affiliate_mgt` char(1) NOT NULL default '0',
  `affiliate_stats` char(1) NOT NULL default '0',
  `news_mgt` char(1) NOT NULL default '0',
  `article_mgt` char(1) NOT NULL default '0',
  `story_mgt` char(1) NOT NULL default '0',
  `poll_mgt` char(1) NOT NULL default '0',
  `search` char(1) NOT NULL default '0',
  `ext_search` char(1) NOT NULL default '0',
  `send_letter` char(1) NOT NULL default '0',
  `pages_mgt` char(1) NOT NULL default '0',
  `chat` char(1) NOT NULL default '0',
  `chat_mgt` char(1) NOT NULL default '0',
  `forum_mgt` char(1) NOT NULL default '',
  `blog_mgt` char(1) NOT NULL default '0',
  `mship_mgt` char(1) NOT NULL default '0',
  `payment_mgt` char(1) NOT NULL default '0',
  `banner_mgt` char(1) NOT NULL default '0',
  `seo_mgt` char(1) NOT NULL default '0',
  `admin_mgt` char(1) NOT NULL default '0',
  `admin_permit_mgt` char(1) NOT NULL default '0',
  `global_mgt` char(1) NOT NULL default '0',
  `change_pwd` char(1) NOT NULL default '0',
  `cntry_mgt` char(1)	NOT NULL default '0',
  `snaps_require_approval` char(1)	NOT NULL	default 'N',
  `featured_profiles_mgt` char(1)	NOT NULL	default 'N',
  `calendar_mgt` char(1) NOT NULL	default '0',
  `event_mgt` char(1) NOT NULL	default '0',
  `import_mgt` char(1) NOT NULL	default '0',
  `profile_ratings` char(1) NOT NULL	default '0',
  `plugin_mgt` char(1) NOT NULL default '0',
  `promo_mgt` char(1) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) TYPE=MyISAM CHARACTER SET utf8 COLLATE utf8_general_ci;


## ########################################################

##
## Table structure for table `[prefix]_adminemails`
##

CREATE TABLE `[prefix]_adminemails` (
  `id` int(11) NOT NULL auto_increment,
  `email` varchar(100) NOT NULL default '',
  PRIMARY KEY  (`id`)
  ) TYPE=MyISAM CHARACTER SET utf8 COLLATE utf8_general_ci;


## ########################################################

##
## Table structure for table `[prefix]_aff_referals`
##

CREATE TABLE `[prefix]_aff_referals` (
  `id` int(11) NOT NULL auto_increment,
  `affid` int(11) NOT NULL default '0',
  `userid` int(11) NOT NULL default '0',
  `ip` varchar(255) default NULL,
  PRIMARY KEY  (`id`),
  KEY `affid` (`affid`)
  ) TYPE=MyISAM CHARACTER SET utf8 COLLATE utf8_general_ci;

## ########################################################

##
## Table structure for table `[prefix]_affiliates`
##

CREATE TABLE `[prefix]_affiliates` (
  `id` int(10) NOT NULL auto_increment,
  `name` varchar(255) NOT NULL default '',
  `email` varchar(255) NOT NULL default '',
  `password` varchar(32) NOT NULL default '',
  `status` varchar(255) NOT NULL default '',
  `regdate` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `email` (`email`)
) TYPE=MyISAM PACK_KEYS=0 CHARACTER SET utf8 COLLATE utf8_general_ci;

## ########################################################

##
## Table structure for table `[prefix]_articles`
##

CREATE TABLE `[prefix]_articles` (
  `articleid` int(11) NOT NULL auto_increment,
  `lang` varchar(30) null,
  `dat` int(11) NOT NULL default '0',
  `title` varchar(255) default NULL,
  `text` longtext,
  PRIMARY KEY  (`articleid`)
) TYPE=MyISAM CHARACTER SET utf8 COLLATE utf8_general_ci;

## ########################################################

##
## Table structure for table `[prefix]_banners`
##

CREATE TABLE `[prefix]_banners` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(255) NOT NULL default '',
  `bannerurl` text,
  `language` varchar(255) default NULL,
  `linkurl` varchar(255) default NULL,
  `tooltip` varchar(255) default NULL,
  `size` varchar(20) default NULL,
  `startdate` int(11) NOT NULL default '0',
  `expdate` int(11) NOT NULL default '0',
  `link_target` varchar(10) NULL default '_blank',
  `clicks` int(11) NOT NULL default '0',
  `enabled` char(1) NOT NULL default 'Y',
  PRIMARY KEY  (`id`)
) TYPE=MyISAM CHARACTER SET utf8 COLLATE utf8_general_ci;

## ########################################################

##
## Table structure for table `[prefix]_blog_comments`
##

CREATE TABLE `[prefix]_blog_comments` (
  `id` int(11) NOT NULL auto_increment,
  `userid` int(11) default '0',
  `adminid` int(11) default '0',
  `blogid` int(11) NOT NULL default '0',
  `datetime` datetime NOT NULL default '0000-00-00 00:00:00',
  `comment` mediumtext NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `blogid` (`blogid`),
  KEY `adminid` (`adminid`,`blogid`),
  KEY `userid` (`userid`,`blogid`)
) TYPE=MyISAM CHARACTER SET utf8 COLLATE utf8_general_ci;


## ########################################################

##
## Table structure for table `[prefix]_blog_preferences`
##

CREATE TABLE `[prefix]_blog_preferences` (
  `id` int(11) NOT NULL auto_increment,
  `userid` int(11) NOT NULL default '0',
  `adminid` int(11) NOT NULL default '0',
  `name` varchar(255) NOT NULL default '',
  `description` text NOT NULL,
  `members_comment` char(1) NOT NULL default '0',
  `buddies_comment` char(1) NOT NULL default '0',
  `members_vote` char(1) NOT NULL default '0',
  `gui_editor` char(1) NOT NULL default '0',
  `max_comments` int(11) NOT NULL default '0',
  `bad_words` text NOT NULL,
  `title_template` text NULL,
  `story_template` text NULL,
  PRIMARY KEY  (`id`)
) TYPE=MyISAM CHARACTER SET utf8 COLLATE utf8_general_ci;


## ########################################################

##
## Table structure for table `[prefix]_blog_story`
##

CREATE TABLE `[prefix]_blog_story` (
  `id` int(11) NOT NULL auto_increment,
  `userid` int(11) NOT NULL default '0',
  `adminid` int(11) NOT NULL default '0',
  `date_posted` date NOT NULL default '0000-00-00',
  `title` text NOT NULL,
  `story` text NOT NULL,
  `views` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) TYPE=MyISAM CHARACTER SET utf8 COLLATE utf8_general_ci;


## ########################################################

##
## Table structure for table `[prefix]_blog_vote`
##

CREATE TABLE `[prefix]_blog_vote` (
  `id` int(11) NOT NULL auto_increment,
  `storyid` int(11) NOT NULL default '0',
  `userid` int(11) NOT NULL default '0',
  `adminid` int(11) NOT NULL default '0',
  `vote` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `storyid` (`storyid`,`userid`,`adminid`)
) TYPE=MyISAM CHARACTER SET utf8 COLLATE utf8_general_ci;


## ########################################################

##
## Table structure for table `[prefix]_buddy_ban_list`
## act ( F=Friend, B=Banned, H=Hotlist )

CREATE TABLE `[prefix]_buddy_ban_list` (
	`id` 			int(11) 		NOT NULL auto_increment,
	`userid` 		varchar(30) 	NOT NULL,
	`act`			char(1)			NOT NULL,
	`ref_userid` 	varchar(30) 	NOT NULL,
	`act_date` 		int(11)			NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `act`(`act`),
  KEY `act_userid` (`act`,`userid`),
  KEY `act_ref_userid` (`act`, `ref_userid`)
) TYPE=MyISAM CHARACTER SET utf8 COLLATE utf8_general_ci;

# --------------------------------------------------------

#
# Table structure for table `[prefix]_calendars`
#

CREATE TABLE `[prefix]_calendars` (
  `id` int(8) NOT NULL auto_increment,
  `calendar` varchar(255) NOT NULL default '',
  `displayorder` tinyint(2) NOT NULL default '0',
  `enabled` char(1) NOT NULL default '',
  PRIMARY KEY  (`id`),
  KEY `enabled` (`enabled`),
  KEY `displayorder` (`displayorder`)
) TYPE=MyISAM CHARACTER SET utf8 COLLATE utf8_general_ci;

## ########################################################
# --------------------------------------------------------
#
# Table structure for table `[prefix]_calendarevents`
#

CREATE TABLE `[prefix]_calendarevents` (
  `id` int(11) NOT NULL auto_increment,
  `userid` int(11) NOT NULL default '0',
  `event` varchar(255) NOT NULL default '',
  `description` text NOT NULL,
  `recurring` int(11) NOT NULL default '0',
  `recuroption` varchar(255) NOT NULL default '0',
  `calendarid` int(11) NOT NULL default '0',
  `enabled` char(1) NOT NULL default '',
  `timezone` decimal(5,2) NOT NULL default '0.00',
  `datetime_from` datetime NOT NULL default '0000-00-00 00:00:00',
  `datetime_to` datetime NOT NULL default '0000-00-00 00:00:00',
  `private_to` text ,
  PRIMARY KEY  (`id`)
) TYPE=MyISAM CHARACTER SET utf8 COLLATE utf8_general_ci;

# ########################################################

#
# Table structure for table `[prefix]_calendarwatchevents`
#

CREATE TABLE `[prefix]_calendarwatchevents` (
  `userid` int(11) NOT NULL default '0',
  `eventid` int(11) NOT NULL default '0',
  PRIMARY KEY  (`userid`,`eventid`)
) TYPE=MyISAM CHARACTER SET utf8 COLLATE utf8_general_ci;


## ########################################################

##
## Table structure for table `[prefix]_cities`
##

CREATE TABLE `[prefix]_cities` (
  `id` int(8) NOT NULL auto_increment,
  `code` varchar(100) default NULL,
  `name` varchar(100) default NULL,
  `enabled` char(1) default 'Y',
  `countrycode` varchar(5) NOT NULL default 'US',
  `statecode` varchar(100) NULL,
  `countycode` varchar(100) NULL,
  PRIMARY KEY  (`id`),
  KEY `code` (`code`),
  KEY `countrystate` (`countrycode`,`statecode`),
  KEY `countrystatecounty` (`countrycode`,`statecode`,`countycode`)
) TYPE=MyISAM CHARACTER SET utf8 COLLATE utf8_general_ci;


## ########################################################

##
## Table structure for table `[prefix]_counties`
##

CREATE TABLE `[prefix]_counties` (
  `id` int(8) NOT NULL auto_increment,
  `code` varchar(100) default NULL,
  `name` varchar(100) default NULL,
  `enabled` char(1) default 'Y',
  `countrycode` varchar(5) NOT NULL default 'US',
  `statecode` varchar(100) NULL,
  PRIMARY KEY  (`id`),
  KEY `code` (`code`),
  KEY `countrystate` (`countrycode`,`statecode`)
) TYPE=MyISAM CHARACTER SET utf8 COLLATE utf8_general_ci;


## ########################################################

##
## Table structure for table `[prefix]_countries`
##

CREATE TABLE `[prefix]_countries` (
  `id` int(11) NOT NULL auto_increment,
  `loc` char(2) default NULL,
  `code` char(2) default NULL,
  `name` varchar(100) default NULL,
  `enabled` char(1) default 'Y',
  PRIMARY KEY  (`id`),
  KEY `name` (`name`),
  KEY `code` (`code`)
) TYPE=MyISAM CHARACTER SET utf8 COLLATE utf8_general_ci;

## ########################################################

##
## Table structure for table `[prefix]_featured_profiles`
##

CREATE TABLE `[prefix]_featured_profiles` (
	`id` 			int(11) 	NOT NULL auto_increment,
	`userid` 		int(11) 	NOT NULL ,
	`start_date` 	int(11)		NOT NULL ,
	`end_date` 		int(11)		NOT NULL ,
	`must_show` 	char(1) 	NOT NULL default 'N',
	`req_exposures` int(11) 	NOT NULL default '0',
	`exposures` 	int(11) 	NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `userid` (`userid`)
) TYPE=MyISAM CHARACTER SET utf8 COLLATE utf8_general_ci;

## ########################################################

##
## Table structure for table `[prefix]_glblsettings`
##

CREATE TABLE `[prefix]_glblsettings` (
  `config_variable` varchar(50) NOT NULL default '',
  `config_value` varchar(255) NOT NULL default '',
  `description` varchar(255) default NULL,
  `groupid`		int(2),
  `update_time`		int(11) ,
  PRIMARY KEY  (`config_variable`)
) TYPE=MyISAM CHARACTER SET utf8 COLLATE utf8_general_ci;

# ########################################################

#
# Table structure for table `[prefix]_imported_users`
#

CREATE TABLE `[prefix]_imported_users` (
  `id` int(11) NOT NULL auto_increment,
  `source_id` int(11) NOT NULL default '0',
  `user_id` int(11) NOT NULL default '0',
  `module` varchar(50) NOT NULL default '',
  PRIMARY KEY  (`id`)
) TYPE=MyISAM CHARACTER SET utf8 COLLATE utf8_general_ci;


## ########################################################

#
# Table structure for table `[prefix]_import_questions_xref`
#

 CREATE TABLE `[prefix]_import_questions_xref` (
   `id` int(11) NOT NULL auto_increment,
   `questionoptionid` int(11) NOT NULL default '0',
   `question_text` varchar(255) NOT NULL default '',
   `answer_text` varchar(255) NOT NULL default '',
   `module` varchar(50) NOT NULL default '',
   PRIMARY KEY  (`id`),
   KEY `questionoptionid` (`questionoptionid`,`module`),
   KEY `question_text` (`question_text`),
   KEY `answer_text` (`answer_text`)
 ) TYPE=MyISAM CHARACTER SET utf8 COLLATE utf8_general_ci;


## ########################################################

##
## Table structure for table `[prefix]_instant_message`
##

CREATE TABLE `[prefix]_instant_message` (
  `id` int(11) NOT NULL auto_increment,
  `senderid` int(11) NULL ,
  `recipientid` int(11) NULL,
  `message` text NULL,
  `pingflag` tinyint(1) NULL ,
  `sendtime` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `senderid` (`senderid`),
  KEY `recipientid` (`recipientid`),
  KEY `sendtime` (`sendtime`)
) TYPE=MyISAM CHARACTER SET utf8 COLLATE utf8_general_ci;


## ########################################################

#
# Table structure for table `[prefix]_languages`
#

CREATE TABLE `[prefix]_languages` (
  `id` int(11) NOT NULL auto_increment,
  `lang` varchar(30) NOT NULL default 'english',
  `mainkey` varchar(100) ,
  `subkey` varchar(100) ,
  `descr` text,
  PRIMARY KEY  (`id`),
  KEY `lang_mainkey_subkey` (`lang`,`mainkey`, `subkey` )
) TYPE=MyISAM CHARACTER SET utf8 COLLATE utf8_general_ci;

## ########################################################

##
## Table structure for table `[prefix]_letters`
##

CREATE TABLE `[prefix]_letters` (
  `id` int(8) NOT NULL auto_increment,
  `title` varchar(100) NOT NULL ,
  `subject` varchar(254) NOT NULL ,
  `MODIFY` int(8) NOT NULL default '0',
  `bodytext` text NOT NULL,
  `autosendsignup` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `subject` (`subject`),
  KEY `title` (`title`)
) TYPE=MyISAM CHARACTER SET utf8 COLLATE utf8_general_ci;

## ########################################################

##
## Table structure for table `[prefix]_log`
##

CREATE TABLE `[prefix]_log` (
  `id` int(11) NOT NULL auto_increment,
  `page` varchar(250) NOT NULL default '',
  `visits` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) TYPE=MyISAM CHARACTER SET utf8 COLLATE utf8_general_ci;


## ########################################################

##
## Table structure for table `[prefix]_mailbox`
##

CREATE TABLE `[prefix]_mailbox` (
  `id` bigint(20) NOT NULL auto_increment,
  `owner` int(11) NOT NULL default '0',
  `senderid` int(11) NOT NULL default '0',
  `recipientid` int(11) NOT NULL default '0',
  `subject` varchar(254) default NULL,
  `message` text NOT NULL,
  `flag` tinyint(1) NOT NULL default '0',
  `flagread` tinyint(1) NOT NULL default '0',
  `sendtime` int(11) NOT NULL default '0',
  `flagdelete` tinyint(1) NOT NULL default '0',
  `replied` tinyint(1) NOT NULL default '0',
  `folder` varchar(10) NOT NULL default 'inbox',
  `notifysender` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `senderid` (`senderid`),
  KEY `recipientid` (`recipientid`),
  KEY `flagread` (`flagread`),
  KEY `sendtime` (`sendtime`),
  KEY `flagdelete` (`flagdelete`),
  KEY `folder` (`folder`)
) TYPE=MyISAM CHARACTER SET utf8 COLLATE utf8_general_ci;


## ########################################################

##
## Table structure for table `[prefix]_membership`
##

CREATE TABLE `[prefix]_membership` (
  `id` int(11) NOT NULL auto_increment,
  `roleid` int(11) NOT NULL default '0',
  `hide` char(1) NOT NULL default '0',  
  `name` varchar(255) NOT NULL default '',
  `chat` char(1) NOT NULL default '0',
  `forum` char(1) NOT NULL default '0',
  `blog` char(1) NOT NULL default '0',
  `poll` char(1) NOT NULL default '0',
  `includeinsearch` char(1) NOT NULL default '0',
  `message` char(1) NOT NULL default '0',
  `message_keep_cnt` int(11) NOT NULL default '0',
  `message_keep_days` int(11) NOT NULL default '0',
  `messages_per_day` int(11) NULL default '10',
  `allowim` char(1) NOT NULL default '0',
  `profilepicscnt` int(4) NOT NULL default '1',
  `uploadpicture` char(1) NOT NULL default '0',
  `uploadpicturecnt` int(4) NOT NULL default '1',
  `allowalbum` char(1) NOT NULL default '0',
  `event_mgt` char(1) NOT NULL default '0',
  `seepictureprofile` char(1) NOT NULL default '0',
  `favouritelist` char(1) NOT NULL default '0',
  `sendwinks` char(1) NOT NULL default '0',
  `winks_per_day` int(11) NULL default '10',
  `extsearch` char(1) NOT NULL default '0',
  `activedays` int(11) NOT NULL default '0',
  `fullsignup` char(1) NOT NULL default '0',
  `saveprofiles` char(1) NOT NULL default '0',
  `saveprofilescnt` int(11) NULL,
  `allow_videos` char(1) NULL default '0',
  `videoscnt` int(11) NULL default 0,
  `allow_mysettings` char(1) NULL default 0,
  `allow_comment_removal` char(1) NULL default '0',
  `allow_php121` char(1) NULL default 0,
  `price` decimal(11,2) NOT NULL default '0',
  `currency` char(3) NOT NULL default '',
  `enabled` char(1) NOT NULL default 'Y',
  PRIMARY KEY  (`id`),
  KEY `name` (`name`),
  KEY `roleid` (`roleid`)
) TYPE=MyISAM CHARACTER SET utf8 COLLATE utf8_general_ci;


## ########################################################

##
## Table structure for table `[prefix]_news`
##

CREATE TABLE `[prefix]_news` (
  `newsid` int(10) unsigned NOT NULL auto_increment,
  `lang` varchar(50) null,
  `date` int(11) NOT NULL default '0',
  `header` varchar(50) NOT NULL default '',
  `text` longtext NOT NULL,
  PRIMARY KEY  (`newsid`),
  KEY `date` (`date`),
  KEY `header` (`header`)
) TYPE=MyISAM CHARACTER SET utf8 COLLATE utf8_general_ci;

## ########################################################

##
## Table structure for table `[prefix]_onlineusers`
##

CREATE TABLE `[prefix]_onlineusers` (
  `userid` int(11) NOT NULL default '0',
  `lastactivitytime` int(11) NOT NULL default '0',
  `is_online` varchar(1) NULL,
  `last_ping` int(11) NULL,
  `session_id` varchar(250) NULL,
  KEY `userid` (`userid`),
  KEY `online_time` (`last_ping`),
  KEY `is_online` (`is_online`)
) TYPE=MyISAM CHARACTER SET utf8 COLLATE utf8_general_ci;

## ########################################################

##
## Table structure for table `[prefix]_pages`
##

CREATE TABLE `[prefix]_pages` (
  `id` int(11) NOT NULL auto_increment,
  `lang` varchar(50) null,
  `pagekey` varchar(100) NOT NULL default '',
  `title` varchar(255) NOT NULL default '',
  `pagetext` text NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `pagekey` (`pagekey`),
  KEY `title` (`title`)
) TYPE=MyISAM CHARACTER SET utf8 COLLATE utf8_general_ci;

## ########################################################

##
## Table structure for table `[prefix]_payment_config`
##

CREATE TABLE `[prefix]_payment_config` (
  `configuration_id` int(11) NOT NULL auto_increment,
  `configuration_title` varchar(64) NOT NULL default '',
  `configuration_key` varchar(64) NOT NULL default '',
  `configuration_value` varchar(255) NOT NULL default '',
  `configuration_description` varchar(255) NOT NULL default '',
  `configuration_group_id` int(11) NOT NULL default '0',
  `sort_order` int(5) default NULL,
  `last_modified` datetime default NULL,
  `date_added` datetime NOT NULL default '0000-00-00 00:00:00',
  `use_function` varchar(255) default NULL,
  `set_function` varchar(255) default NULL,
  `module_key` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`configuration_id`)
) TYPE=MyISAM CHARACTER SET utf8 COLLATE utf8_general_ci;

## ########################################################

##
## Table structure for table `[prefix]_payment_modules`
##

CREATE TABLE `[prefix]_payment_modules` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(255) NOT NULL default '',
  `module_key` varchar(255) NOT NULL default '',
  `class_file` varchar(255) NOT NULL default '',
  `formfile` varchar(255) NOT NULL default '',
  `enabled` char(1) NOT NULL default 'N',
  PRIMARY KEY  (`id`),
  KEY `name` (`name`)
) TYPE=MyISAM CHARACTER SET utf8 COLLATE utf8_general_ci;


## ########################################################

#
# Table structure for table `[prefix]_plugin`
#

CREATE TABLE `[prefix]_plugin` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(255) NOT NULL default '',
  `active` tinyint(4) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) TYPE=MyISAM CHARACTER SET utf8 COLLATE utf8_general_ci;

## ########################################################

#
# Table structure for table `[prefix]_plugin_access`
#

CREATE TABLE `[prefix]_plugin_access` (
  `id` int(11) NOT NULL auto_increment,
  `pluginid` int(11) NOT NULL default '0',
  `roleid` int(11) NOT NULL default '0',
  `access` tinyint(4) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) TYPE=MyISAM CHARACTER SET utf8 COLLATE utf8_general_ci;

## ########################################################

#
# Table structure for table `[prefix]_plugin_config`
#

CREATE TABLE `[prefix]_plugin_config` (
  `id` int(11) NOT NULL auto_increment,
  `pluginid` int(11) NOT NULL default '0',
  `name` varchar(100) NOT NULL default '',
  `value` text NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `pluginid` (`pluginid`)
) TYPE=MyISAM CHARACTER SET utf8 COLLATE utf8_general_ci;

## ########################################################

#
# Table structure for table `[prefix]_plugin_tables`
#

CREATE TABLE `[prefix]_plugin_tables` (
  `id` int(11) NOT NULL auto_increment,
  `pluginid` int(11) NOT NULL default '0',
  `name` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`id`)
) TYPE=MyISAM CHARACTER SET utf8 COLLATE utf8_general_ci;


## ########################################################

##
## Table structure for table `[prefix]_pollips`
##

CREATE TABLE `[prefix]_pollips` (
  `ip` varchar(15) default NULL,
  `pollid` int(11) default NULL,
  `time` int(11) default NULL,
  KEY `pollid` (`pollid`),
  KEY `time` (`time`),
  KEY `ip` (`ip`)
) TYPE=MyISAM CHARACTER SET utf8 COLLATE utf8_general_ci;

## ########################################################

##
## Table structure for table `[prefix]_polloptions`
##

CREATE TABLE `[prefix]_polloptions` (
  `optionid` int(11) NOT NULL auto_increment,
  `lang` varchar(50) null,
  `pollid` int(11) default NULL,
  `opt` varchar(255) default NULL,
  `result` int(11) NOT NULL default '0',
  `enabled` char(1) NOT NULL default 'Y',
  PRIMARY KEY  (`optionid`),
  KEY `enabled` (`enabled`),
  KEY `pollid` (`pollid`)
) TYPE=MyISAM CHARACTER SET utf8 COLLATE utf8_general_ci;

## ########################################################

##
## Table structure for table `[prefix]_polls`
##

CREATE TABLE `[prefix]_polls` (
  `pollid` int(11) NOT NULL auto_increment,
  `lang` varchar(50) null,
  `question` varchar(255) default NULL,
  `date` int(11) NOT NULL default '0',
  `enabled` char(1) NOT NULL default 'Y',
  `active` tinyint(1) NOT NULL default '0',
  `options` varchar(255) default NULL,
  `suggested_by` int(11) default 0,
  PRIMARY KEY  (`pollid`),
  KEY `active` (`active`),
  KEY `date` (`date`),
  KEY `enabled` (`enabled`)
) TYPE=MyISAM CHARACTER SET utf8 COLLATE utf8_general_ci;

## ########################################################

##
## Table structure for table `[prefix]_poll_answer`
##

CREATE TABLE `[prefix]_poll_answer` (
  `id` int(11) NOT NULL auto_increment,
  `questionid` int(11) NOT NULL default '0',
  `userid` int(11) NOT NULL default '0',
  `optionid` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `questionid` (`questionid`),
  KEY `userid` (`userid`)
) TYPE=MyISAM CHARACTER SET utf8 COLLATE utf8_general_ci;


## ########################################################

##
## Table structure for table `[prefix]_poll_option`
##

CREATE TABLE `[prefix]_poll_option` (
  `id` int(11) NOT NULL auto_increment,
  `questionid` int(11) NOT NULL default '0',
  `answeroption` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`id`),
  KEY `questionid` (`questionid`)
) TYPE=MyISAM CHARACTER SET utf8 COLLATE utf8_general_ci;


## ########################################################

##
## Table structure for table `[prefix]_poll_question`
##

CREATE TABLE `[prefix]_poll_question` (
  `id` int(11) NOT NULL auto_increment,
  `userid` int(11) NOT NULL default '0',
  `question` varchar(255) NOT NULL default '',
  `active` char(1) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `storyid` (`userid`)
) TYPE=MyISAM CHARACTER SET utf8 COLLATE utf8_general_ci;


## ########################################################

##
## Table structure for table `[prefix]_promo`
##

CREATE TABLE `[prefix]_promo` (
  `id` int(11) NOT NULL auto_increment,
  `promocode` varchar(10) NOT NULL,
  `pdesc` varchar(50) NOT NULL,
  `promotype` varchar(7) NOT NULL,
  `memberlevel` int(1) NOT NULL,
  `increasedays` int(3) NOT NULL,
  `active` int(1) NOT NULL,
  PRIMARY KEY  (`id`)
) CHARACTER SET utf8 COLLATE utf8_general_ci;

## ########################################################

##
## Table structure for table `[prefix]_promo_used`
##

CREATE TABLE `[prefix]_promo_used` (
  `id` int(11) NOT NULL auto_increment,
  `userid` int(11) NOT NULL,
  `promocode` varchar(10) NOT NULL,
  `used_date` date ,
  PRIMARY KEY  (`id`)
) CHARACTER SET utf8 COLLATE utf8_general_ci;

## ########################################################

##
## Table structure for table `[prefix]_questionoptions`
##

CREATE TABLE `[prefix]_questionoptions` (
  `id` mediumint(8) NOT NULL auto_increment,
  `lang` varchar(50) null,
  `answer` text,
  `questionid` mediumint(8) NOT NULL default '0',
  `enabled` char(1) NOT NULL default 'Y',
  `displayorder` tinyint(2) ,
  PRIMARY KEY  (`id`),
  KEY `questionid` (`questionid`),
  KEY `enabled` (`enabled`)
) TYPE=MyISAM COMMENT='Store information about question options' CHARACTER SET utf8 COLLATE utf8_general_ci;

## ########################################################

##
## Table structure for table `[prefix]_questions`
##

CREATE TABLE `[prefix]_questions` (
  `id` int(8) NOT NULL auto_increment,
  `lang` varchar(50) null,
  `question` varchar(255) NOT NULL default '',
  `description` varchar(255) default NULL,
  `guideline` varchar(255) default NULL,
  `control_type` varchar(100) NOT NULL default '',
  `maxlength` int(3) NOT NULL default '0',
  `mandatory` char(1) NOT NULL default 'Y',
  `section` tinyint(2) NOT NULL default '0',
  `displayorder` tinyint(2) NOT NULL default '0',
  `extsearchable` char(1) NOT NULL default 'N',
  `extsearchhead` varchar(255) default NULL,
  `gender` varchar(1) default 'A',
  `enabled` char(1) NOT NULL default 'Y',
  PRIMARY KEY  (`id`),
  KEY `enabled` (`enabled`)
) TYPE=MyISAM COMMENT='Stores information about questions' CHARACTER SET utf8 COLLATE utf8_general_ci;

## ########################################################

#
# Table structure for table `[prefix]_ratings`
#

CREATE TABLE `[prefix]_ratings` (
  `id` int(8) NOT NULL auto_increment,
  `rating` varchar(255) NOT NULL default '',
  `displayorder` tinyint(2) NOT NULL default '0',
  `enabled` char(1) NOT NULL default '',
  `description` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`id`),
  KEY `enabled` (`enabled`),
  KEY `displayorder` (`displayorder`)
) TYPE=MyISAM CHARACTER SET utf8 COLLATE utf8_general_ci;

## ########################################################

##
## Table structure for table `[prefix]_sections`
##

CREATE TABLE `[prefix]_sections` (
  `id` int(8) NOT NULL auto_increment,
  `lang` varchar(50) null,
  `section` varchar(255) NOT NULL default '',
  `displayorder` tinyint(2) NOT NULL default '0',
  `enabled` char(1) NOT NULL default '',
  PRIMARY KEY  (`id`),
  KEY `enabled` (`enabled`),
  KEY `displayorder` (`displayorder`)
) TYPE=MyISAM CHARACTER SET utf8 COLLATE utf8_general_ci;

## ########################################################

##
## Table structure for table `[prefix]_shoutbox`
##
CREATE TABLE `[prefix]_shoutbox` (
  `id` int(11) NOT NULL auto_increment,
  `from_user` int(11) NOT NULL default '0',
  `username` varchar(30),
  `act_time` int(11) NOT NULL default '0',
  `message` text ,
  PRIMARY KEY  (`id`),
  KEY `userid` (`from_user`)
) TYPE=MyISAM CHARACTER SET utf8 COLLATE utf8_general_ci;

## ########################################################

##
## Table structure for table `[prefix]_states`
##

CREATE TABLE `[prefix]_states` (
  `id` int(8) NOT NULL auto_increment,
  `code` varchar(100) default NULL,
  `name` varchar(100) default NULL,
  `enabled` char(1) default 'Y',
  `countrycode` varchar(5) NOT NULL default 'US',
  PRIMARY KEY  (`id`),
  KEY `code` (`code`),
  KEY `enabled` (`enabled`),
  KEY `countrycode` (`countrycode`)
) TYPE=MyISAM CHARACTER SET utf8 COLLATE utf8_general_ci;

## ########################################################

##
## Table structure for table `[prefix]_stories`
##

CREATE TABLE `[prefix]_stories` (
  `storyid` int(10) unsigned NOT NULL auto_increment,
  `lang` varchar(50) null,
  `date` int(11) NOT NULL default '0',
  `sender` int(11) unsigned NOT NULL default '0',
  `header` varchar(50) NOT NULL default '',
  `text` longtext NOT NULL,
  `enabled` char(1) NOT NULL default '',
  PRIMARY KEY  (`storyid`),
  KEY `date` (`date`),
  KEY `sender` (`sender`),
  KEY `header` (`header`),
  KEY `enabled` (`enabled`)
) TYPE=MyISAM CHARACTER SET utf8 COLLATE utf8_general_ci;

## ########################################################

##
## Table structure for table `[prefix]_transactions`
##

CREATE TABLE `[prefix]_transactions` (
  `id` int(11) NOT NULL auto_increment,
  `invoice_no` varchar(100) NULL,
  `user_id` int(11) NULL,
  `txn_id` varchar(254) NULL,
  `payment_email` varchar(100) NULL,
  `from_membership` tinyint(4) ,
  `to_membership` tinyint(4) ,
  `amount_paid` double NULL ,
  `txn_date` date NULL ,
  `payment_mod` varchar(100) NULL,
  `payment_status` varchar(100) NULL,
  `payment_vars` text NULL,
  PRIMARY KEY  (`id`),
  KEY `invoice_no` (`invoice_no`)
) TYPE=MyISAM CHARACTER SET utf8 COLLATE utf8_general_ci;


## ########################################################

##
## Table structure for table `[prefix]_user`
##

CREATE TABLE `[prefix]_user` (
  `id` int(11) NOT NULL auto_increment,
  `active` tinyint(1) default '0',
  `username` varchar(25) NOT NULL default '',
  `password` varchar(32) NOT NULL default '',
  `lastvisit` int(11) NOT NULL default '0',
  `regdate` int(11) NOT NULL default '0',
  `level` tinyint(4) default '4',
  `timezone` decimal(5,2) default '0',
  `allow_viewonline` tinyint(1) default '1',
  `rank` int(11) default '0',
  `email` varchar(255) default NULL,
  `country` varchar(11) default '',
  `actkey` varchar(32) default NULL,
  `firstname` varchar(50) default NULL,
  `lastname` varchar(50) default NULL,
  `gender` char(1) NOT NULL default 'M',
  `lookgender` char(1)  default '',
  `lookagestart` int(11)  default '0',
  `lookageend` int(11)  default '0',
  `address_line1` varchar(100) default NULL,
  `address_line2` varchar(100) default NULL,
  `state_province` varchar(100) default NULL,
  `county` varchar(100) default NULL,
  `city` varchar(100) default NULL,
  `zip` varchar(30) default NULL,
  `birth_date` date NOT NULL,
  `lookcountry` varchar(255) default '',
  `lookstate_province` varchar(100) default NULL,
  `lookcounty` varchar(100) default NULL,
  `lookcity` varchar(100) default NULL,
  `lookzip` varchar(100) default NULL,
  `lookradius` varchar(5) default NULL,
  `radiustype` varchar(5) default 'miles',
  `picture` char(1)  default '0',
  `pictures_cnt` int(4)  default '0',
  `videos_cnt` int(4)  default '0',
  `about_me` text  default NULL,
  `couple_usernames` varchar(255)  default NULL,
  `zip_latitude` float default NULL,
  `zip_longitude` float default NULL,
  `status` varchar(20) NOT NULL default 'approval',
  `levelend` int(11) default NULL ,
  `regIP` varchar(100) default NULL ,
  `lastLoginIP` varchar(100) default NULL ,
  `p_firstname` varchar(50) default NULL ,
  `p_lastname` varchar(50) default NULL ,
  `p_gender` char(1) default NULL ,
  `p_birth_date` date default NULL ,
  PRIMARY KEY  (`id`),
  KEY `username` (`username`),
  KEY `email` (`email`),
  KEY `fullname` (`firstname`),
  KEY `city` (`city`),
  KEY `zip` (`zip`),
  KEY `country` (`country`),
  KEY `lastvisit` (`lastvisit`),
  KEY `lookgender` (`lookgender`),
  KEY `state_province` (`state_province`),
  KEY `lookcountry` (`lookcountry`),
  KEY `lookageend` (`lookageend`),
  KEY `lookagestart` (`lookagestart`),
  KEY `status` (`status`)
) TYPE=MyISAM CHARACTER SET utf8 COLLATE utf8_general_ci;

## ########################################################

#
# Table structure for table `[prefix]_user_watched_profiles`
#

CREATE TABLE `[prefix]_user_watched_profiles` (
  `id` int(11) NOT NULL auto_increment,
  `userid` int(11) NOT NULL default '0',
  `ref_userid` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `userid` (`userid`)
  ) TYPE=MyISAM CHARACTER SET utf8 COLLATE utf8_general_ci;

## ########################################################

##
## Table structure for table `[prefix]_user_actions`
##

CREATE TABLE `[prefix]_user_actions` (
  `id` int(11) NOT NULL auto_increment,
  `userid` int(11) NULL default '0',
  `act_date` date NULL,
  `act_type` char(1) NULL default 'M',
  `act_cnt` int(11) NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `user_actions_userid` (`userid`)
) TYPE=MyISAM CHARACTER SET utf8 COLLATE utf8_general_ci;

## ########################################################

##
## Table structure for table `[prefix]_useralbums`
##

CREATE TABLE `[prefix]_useralbums` (
  `id` 		 	int(8) NOT NULL auto_increment,
  `username` 	varchar(25) NOT NULL,
  `name` 		varchar(100) default NULL,
  `passwd` 		varchar(100) default NULL,
  PRIMARY KEY  (`id`),
  KEY `usernamename` (`username`,`name`)
) TYPE=MyISAM CHARACTER SET utf8 COLLATE utf8_general_ci;

## ########################################################

##
## Table structure for table `[prefix]_user_choices`
##

CREATE TABLE `[prefix]_user_choices` (
  `id` bigint(11) NOT NULL auto_increment,
  `userid` int(11) NOT NULL default '0',
  `choice_name` varchar(250) NULL,
  `choice_value` varchar(250) NULL,
  `last_act_date` int(11) NULL default 0,
  `last_act_value` varchar(255) NULL,
  PRIMARY KEY  (`id`),
  KEY `user_choices` (`userid`,`choice_name` )
) CHARACTER SET utf8 COLLATE utf8_general_ci;

## ########################################################

##
## Table structure for table `[prefix]_userpreference`
##

CREATE TABLE `[prefix]_userpreference` (
  `id` bigint(12) NOT NULL auto_increment,
  `userid` int(11) NOT NULL default '0',
  `questionid` int(8) NOT NULL default '0',
  `answer` text default null,
  PRIMARY KEY  (`id`),
  KEY `userid` (`userid`),
  KEY `questionid_answer` (`questionid`)
) TYPE=MyISAM CHARACTER SET utf8 COLLATE utf8_general_ci;

## ########################################################

##
## Table structure for table `[prefix]_userrating`
##

CREATE TABLE `[prefix]_userrating` (
  `id` int(11) NOT NULL auto_increment,
  `userid` int(11) NOT NULL default '0',
  `profileid` int(11) NOT NULL default '0',
  `rating` int(11) NOT NULL default '0',
  `rate_time` int(32) NOT NULL default '0',
  `ratingid` int(11) NOT NULL default '0',
  `comment` varchar(250) NOT NULL default '',
  `reply` varchar(250) NOT NULL default '',
  `comment_date` date default NULL,
  `rating_date` date default NULL,
  PRIMARY KEY  (`id`),
  KEY `userid` (`userid`),
  KEY `profileid` (`profileid`),
  KEY `rating` (`rating`)
) TYPE=MyISAM CHARACTER SET utf8 COLLATE utf8_general_ci;

## ########################################################

##
## Table structure for table `[prefix]_usersearches`
##

CREATE TABLE `[prefix]_usersearches` (
  `id` int(11) NOT NULL auto_increment,
  `userid` int(11) NOT NULL default '0',
  `search_name` varchar(100) NULL,
  `query` text NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `userid` (`userid`)
) TYPE=MyISAM CHARACTER SET utf8 COLLATE utf8_general_ci;

## ########################################################

##
## Table structure for table `[prefix]_usersnaps`
##

CREATE TABLE `[prefix]_usersnaps` (
  `id` bigint(11) NOT NULL auto_increment,
  `userid` int(11) NOT NULL default '0',
  `picno` int(11) NOT NULL default '0',
  `picture` mediumtext NOT NULL,
  `tnpicture` mediumtext NOT NULL,
  `ins_time` int(11) NULL,
  `active` char(1) NOT NULL default 'N',
  `picext` varchar(10) not null default 'jpg',
  `tnext` varchar(10) not null default 'jpg',
  `album_id` int(11) default null,
  `default_pic` char(1) default 'N',
  `pic_descr` text,
  PRIMARY KEY  (`id`),
  KEY `albumids` (`userid`,`album_id`,`picno` ),
  KEY `ins_times` (`ins_time`)
) TYPE=MyISAM CHARACTER SET utf8 COLLATE utf8_general_ci;

## ########################################################

#
# Table structure for table `[prefix]_usertemplates`
#

CREATE TABLE `[prefix]_usertemplates` (
  `id` int(11) NOT NULL auto_increment,
  `userid` int(11) NOT NULL default '0',
  `subject` varchar(255) NOT NULL default '',
  `text` text NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `userid` (`userid`)
) TYPE=MyISAM CHARACTER SET utf8 COLLATE utf8_general_ci;

## ########################################################

##
## Table structure for table `[prefix]_uservideos`
##

CREATE TABLE `[prefix]_uservideos` (
  `id` bigint(11) NOT NULL auto_increment,
  `userid` int(11) NOT NULL default '0',
  `videono` int(11) NOT NULL default '0',
  `filename` varchar(250) NULL,
  `ins_time` int(11) NULL,
  `active` char(1) NULL default 'N',
  `album_id` int(11) default null,
  `video_descr` text,
  PRIMARY KEY  (`id`),
  KEY `albumids` (`userid`,`album_id`,`videono` )
) TYPE=MyISAM CHARACTER SET utf8 COLLATE utf8_general_ci;


## ########################################################

##
## Table structure for table `[prefix]_views_winks`
##  act = V=View, W=Wink

CREATE TABLE `[prefix]_views_winks` (
	`id` 			int(11) 	NOT NULL auto_increment,
	`userid` 		int(11) 	NOT NULL ,
	`ref_userid` 	int(11)		NOT NULL ,
	`act_time` 		int(11)		NOT NULL ,
	`act`			char(1)		NOT NULL default 'V',
	`wink_msg`		varchar(200) NULL,
  PRIMARY KEY  (`id`),
  KEY `act` (`act`),
  KEY `userid`(`userid`),
  KEY `ref_userid` (`ref_userid`)
) TYPE=MyISAM CHARACTER SET utf8 COLLATE utf8_general_ci;

## ########################################################

##
## Table structure for table `[prefix]_zips`
##

CREATE TABLE `[prefix]_zips` (
  `id` int(8) NOT NULL auto_increment,
  `code` varchar(30) default NULL,
  `enabled` char(1) default 'Y',
  `countrycode` varchar(5) NOT NULL default 'US',
  `statecode` varchar(100) NULL,
  `countycode` varchar(100) NULL,
  `citycode` varchar(100) NULL,
  `latitude` float NULL,
  `longitude` float NULL,
  PRIMARY KEY  (`id`),
  KEY `code` (`code`),
  KEY `countryzipcode` (`countrycode`,`code`),
  KEY `countrystatecountycity` (`countrycode`,`statecode`,`countycode`, `citycode`),
  KEY `latitudecountry` (`latitude`,`countrycode`),
  KEY `longitudecountry` (`longitude`,`countrycode`)
) TYPE=MyISAM CHARACTER SET utf8 COLLATE utf8_general_ci;

## ########################################################

##
## Tables added in osDate 2.5
##

## ########################################################

##
## Table structure for table `[prefix]_mails`
##
CREATE TABLE `[prefix]_mails` (
	`id` 			bigint 	NOT NULL auto_increment,
	`hdr_from` 		varchar(200) NULL ,
	`hdr_to` 		text	NULL ,
	`email` 		varchar(250) NULL ,
	`mail_subject`	varchar(250) NULL ,
	`message`		text NULL,
	`attachment`	text NULL,
  PRIMARY KEY  (`id`)
) TYPE=MyISAM CHARACTER SET utf8 COLLATE utf8_general_ci;
