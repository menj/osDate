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


   class admin_permissionsData extends Data {

      var $table = ADMIN_PERMISSIONS_TABLE;

      var $config = array (
  'table' => ADMIN_PERMISSIONS_TABLE,
  'idField' => 'osdate_admin_permissions_id',
  'addedMsg' => 'Osdate Admin Permissions %s Added',
  'added_err' => 'Can\\\'t Add Osdate Admin Permissions',
  'editMsg' => 'Osdate Admin Permissions %s Updated',
  'editErr' => 'Can\\\'t Update Osdate Admin Permissions',
  'delErr' => 'Can\\\'t Delete Osdate Admin Permissions',
  'delMsg' => 'Osdate Admin Permissions %s Deleted',
  'blankErr' => 'Osdate Admin Permissions Empty',
  'fields' => 
  array (
    'id' => 
    array (
      'name' => 'id',
      'description' => 'Id',
      'type' => 'number',
      'min_len' => 0,
      'max_len' => 11,
      'blank_ok' => 0,
      'duplicate_ok' => 1,
    ),
    'adminid' => 
    array (
      'name' => 'adminid',
      'description' => 'Adminid',
      'type' => 'number',
      'min_len' => 0,
      'max_len' => 11,
      'blank_ok' => 0,
      'duplicate_ok' => 1,
    ),
    'site_stats' => 
    array (
      'name' => 'site_stats',
      'description' => 'Site Stats',
      'type' => 'text',
      'min_len' => 0,
      'max_len' => 1,
      'blank_ok' => 0,
      'duplicate_ok' => 1,
    ),
    'profie_approval' => 
    array (
      'name' => 'profie_approval',
      'description' => 'Profie Approval',
      'type' => 'text',
      'min_len' => 0,
      'max_len' => 1,
      'blank_ok' => 0,
      'duplicate_ok' => 1,
    ),
    'profile_mgt' => 
    array (
      'name' => 'profile_mgt',
      'description' => 'Profile Mgt',
      'type' => 'text',
      'min_len' => 0,
      'max_len' => 1,
      'blank_ok' => 0,
      'duplicate_ok' => 1,
    ),
    'section_mgt' => 
    array (
      'name' => 'section_mgt',
      'description' => 'Section Mgt',
      'type' => 'text',
      'min_len' => 0,
      'max_len' => 1,
      'blank_ok' => 0,
      'duplicate_ok' => 1,
    ),
    'affiliate_mgt' => 
    array (
      'name' => 'affiliate_mgt',
      'description' => 'Affiliate Mgt',
      'type' => 'text',
      'min_len' => 0,
      'max_len' => 1,
      'blank_ok' => 0,
      'duplicate_ok' => 1,
    ),
    'affiliate_stats' => 
    array (
      'name' => 'affiliate_stats',
      'description' => 'Affiliate Stats',
      'type' => 'text',
      'min_len' => 0,
      'max_len' => 1,
      'blank_ok' => 0,
      'duplicate_ok' => 1,
    ),
    'news_mgt' => 
    array (
      'name' => 'news_mgt',
      'description' => 'News Mgt',
      'type' => 'text',
      'min_len' => 0,
      'max_len' => 1,
      'blank_ok' => 0,
      'duplicate_ok' => 1,
    ),
    'article_mgt' => 
    array (
      'name' => 'article_mgt',
      'description' => 'Article Mgt',
      'type' => 'text',
      'min_len' => 0,
      'max_len' => 1,
      'blank_ok' => 0,
      'duplicate_ok' => 1,
    ),
    'story_mgt' => 
    array (
      'name' => 'story_mgt',
      'description' => 'Story Mgt',
      'type' => 'text',
      'min_len' => 0,
      'max_len' => 1,
      'blank_ok' => 0,
      'duplicate_ok' => 1,
    ),
    'poll_mgt' => 
    array (
      'name' => 'poll_mgt',
      'description' => 'Poll Mgt',
      'type' => 'text',
      'min_len' => 0,
      'max_len' => 1,
      'blank_ok' => 0,
      'duplicate_ok' => 1,
    ),
    'search' => 
    array (
      'name' => 'search',
      'description' => 'Search',
      'type' => 'text',
      'min_len' => 0,
      'max_len' => 1,
      'blank_ok' => 0,
      'duplicate_ok' => 1,
    ),
    'ext_search' => 
    array (
      'name' => 'ext_search',
      'description' => 'Ext Search',
      'type' => 'text',
      'min_len' => 0,
      'max_len' => 1,
      'blank_ok' => 0,
      'duplicate_ok' => 1,
    ),
    'send_letter' => 
    array (
      'name' => 'send_letter',
      'description' => 'Send Letter',
      'type' => 'text',
      'min_len' => 0,
      'max_len' => 1,
      'blank_ok' => 0,
      'duplicate_ok' => 1,
    ),
    'pages_mgt' => 
    array (
      'name' => 'pages_mgt',
      'description' => 'Pages Mgt',
      'type' => 'text',
      'min_len' => 0,
      'max_len' => 1,
      'blank_ok' => 0,
      'duplicate_ok' => 1,
    ),
    'chat' => 
    array (
      'name' => 'chat',
      'description' => 'Chat',
      'type' => 'text',
      'min_len' => 0,
      'max_len' => 1,
      'blank_ok' => 0,
      'duplicate_ok' => 1,
    ),
    'chat_mgt' => 
    array (
      'name' => 'chat_mgt',
      'description' => 'Chat Mgt',
      'type' => 'text',
      'min_len' => 0,
      'max_len' => 1,
      'blank_ok' => 0,
      'duplicate_ok' => 1,
    ),
    'forum_mgt' => 
    array (
      'name' => 'forum_mgt',
      'description' => 'Forum Mgt',
      'type' => 'text',
      'min_len' => 0,
      'max_len' => 1,
      'blank_ok' => 0,
      'duplicate_ok' => 1,
    ),
    'blog_mgt' => 
    array (
      'name' => 'blog_mgt',
      'description' => 'Blog Mgt',
      'type' => 'text',
      'min_len' => 0,
      'max_len' => 1,
      'blank_ok' => 0,
      'duplicate_ok' => 1,
    ),
    'mship_mgt' => 
    array (
      'name' => 'mship_mgt',
      'description' => 'Mship Mgt',
      'type' => 'text',
      'min_len' => 0,
      'max_len' => 1,
      'blank_ok' => 0,
      'duplicate_ok' => 1,
    ),
    'payment_mgt' => 
    array (
      'name' => 'payment_mgt',
      'description' => 'Payment Mgt',
      'type' => 'text',
      'min_len' => 0,
      'max_len' => 1,
      'blank_ok' => 0,
      'duplicate_ok' => 1,
    ),
    'banner_mgt' => 
    array (
      'name' => 'banner_mgt',
      'description' => 'Banner Mgt',
      'type' => 'text',
      'min_len' => 0,
      'max_len' => 1,
      'blank_ok' => 0,
      'duplicate_ok' => 1,
    ),
    'seo_mgt' => 
    array (
      'name' => 'seo_mgt',
      'description' => 'Seo Mgt',
      'type' => 'text',
      'min_len' => 0,
      'max_len' => 1,
      'blank_ok' => 0,
      'duplicate_ok' => 1,
    ),
    'admin_mgt' => 
    array (
      'name' => 'admin_mgt',
      'description' => 'Admin Mgt',
      'type' => 'text',
      'min_len' => 0,
      'max_len' => 1,
      'blank_ok' => 0,
      'duplicate_ok' => 1,
    ),
    'admin_permit_mgt' => 
    array (
      'name' => 'admin_permit_mgt',
      'description' => 'Admin Permit Mgt',
      'type' => 'text',
      'min_len' => 0,
      'max_len' => 1,
      'blank_ok' => 0,
      'duplicate_ok' => 1,
    ),
    'global_mgt' => 
    array (
      'name' => 'global_mgt',
      'description' => 'Global Mgt',
      'type' => 'text',
      'min_len' => 0,
      'max_len' => 1,
      'blank_ok' => 0,
      'duplicate_ok' => 1,
    ),
    'change_pwd' => 
    array (
      'name' => 'change_pwd',
      'description' => 'Change Pwd',
      'type' => 'text',
      'min_len' => 0,
      'max_len' => 1,
      'blank_ok' => 0,
      'duplicate_ok' => 1,
    ),
    'cntry_mgt' => 
    array (
      'name' => 'cntry_mgt',
      'description' => 'Cntry Mgt',
      'type' => 'text',
      'min_len' => 0,
      'max_len' => 1,
      'blank_ok' => 0,
      'duplicate_ok' => 1,
    ),
    'snaps_require_approval' => 
    array (
      'name' => 'snaps_require_approval',
      'description' => 'Snaps Require Approval',
      'type' => 'text',
      'min_len' => 0,
      'max_len' => 1,
      'blank_ok' => 0,
      'duplicate_ok' => 1,
    ),
    'featured_profiles_mgt' => 
    array (
      'name' => 'featured_profiles_mgt',
      'description' => 'Featured Profiles Mgt',
      'type' => 'text',
      'min_len' => 0,
      'max_len' => 1,
      'blank_ok' => 0,
      'duplicate_ok' => 1,
    ),
    'calendar_mgt' => 
    array (
      'name' => 'calendar_mgt',
      'description' => 'Calendar Mgt',
      'type' => 'text',
      'min_len' => 0,
      'max_len' => 1,
      'blank_ok' => 0,
      'duplicate_ok' => 1,
    ),
    'event_mgt' => 
    array (
      'name' => 'event_mgt',
      'description' => 'Event Mgt',
      'type' => 'text',
      'min_len' => 0,
      'max_len' => 1,
      'blank_ok' => 0,
      'duplicate_ok' => 1,
    ),
    'import_mgt' => 
    array (
      'name' => 'import_mgt',
      'description' => 'Import Mgt',
      'type' => 'text',
      'min_len' => 0,
      'max_len' => 1,
      'blank_ok' => 0,
      'duplicate_ok' => 1,
    ),
    'profile_ratings' => 
    array (
      'name' => 'profile_ratings',
      'description' => 'Profile Ratings',
      'type' => 'text',
      'min_len' => 0,
      'max_len' => 1,
      'blank_ok' => 0,
      'duplicate_ok' => 1,
    ),
    'plugin_mgt' => 
    array (
      'name' => 'plugin_mgt',
      'description' => 'Plugin Mgt',
      'type' => 'text',
      'min_len' => 0,
      'max_len' => 1,
      'blank_ok' => 0,
      'duplicate_ok' => 1,
    ),
  ),
);   

      function admin_permissionsData() {
      
         $this->Data($this->config);
      }
   }

?>
