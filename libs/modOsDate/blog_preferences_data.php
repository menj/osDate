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


   class blogPreferencesData extends Data {

      var $table = BLOG_PREFERENCES_TABLE;

      var $config = array (
  'table' => BLOG_PREFERENCES_TABLE,
  'idField' => 'id',
  'addedMsg' => 'Osdate Blog Preferences %s Added',
  'added_err' => 'Can\\\'t Add Osdate Blog Preferences',
  'editMsg' => 'Osdate Blog Preferences %s Updated',
  'editErr' => 'Can\\\'t Update Osdate Blog Preferences',
  'delErr' => 'Can\\\'t Delete Osdate Blog Preferences',
  'delMsg' => 'Osdate Blog Preferences %s Deleted',
  'blankErr' => 'Osdate Blog Preferences Empty',
  'fields' => 
  array (
    'userid' => 
    array (
      'name' => 'userid',
      'description' => 'Userid',
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
    'name' => 
    array (
      'name' => 'name',
      'description' => 'Name',
      'type' => 'text',
      'min_len' => 0,
      'max_len' => 255,
      'blank_ok' => 0,
      'duplicate_ok' => 1,
    ),
    'description' => 
    array (
      'name' => 'description',
      'description' => 'Description',
      'type' => 'text',
      'min_len' => 0,
      'max_len' => 65535,
      'blank_ok' => 0,
      'duplicate_ok' => 1,
    ),
    'members_comment' => 
    array (
      'name' => 'members_comment',
      'description' => 'Members Comment',
      'type' => 'text',
      'min_len' => 0,
      'max_len' => 1,
      'blank_ok' => 0,
      'duplicate_ok' => 1,
    ),
    'buddies_comment' => 
    array (
      'name' => 'buddies_comment',
      'description' => 'Buddies Comment',
      'type' => 'text',
      'min_len' => 0,
      'max_len' => 1,
      'blank_ok' => 0,
      'duplicate_ok' => 1,
    ),
    'members_vote' => 
    array (
      'name' => 'members_vote',
      'description' => 'Members Vote',
      'type' => 'text',
      'min_len' => 0,
      'max_len' => 1,
      'blank_ok' => 0,
      'duplicate_ok' => 1,
    ),
    'gui_editor' => 
    array (
      'name' => 'gui_editor',
      'description' => 'Gui Editor',
      'type' => 'text',
      'min_len' => 0,
      'max_len' => 1,
      'blank_ok' => 0,
      'duplicate_ok' => 1,
    ),
    'max_comments' => 
    array (
      'name' => 'max_comments',
      'description' => 'Max Comments',
      'type' => 'number',
      'min_len' => 0,
      'max_len' => 11,
      'blank_ok' => 0,
      'duplicate_ok' => 1,
    ),
    'bad_words' => 
    array (
      'name' => 'bad_words',
      'description' => 'Bad Words',
      'type' => 'text',
      'min_len' => 0,
      'max_len' => 65535,
      'blank_ok' => 0,
      'duplicate_ok' => 1,
    ),
    'title_template' => 
    array (
      'name' => 'title_template',
      'description' => 'Title Template',
      'type' => 'text',
      'min_len' => 0,
      'max_len' => 65535,
      'blank_ok' => 0,
      'duplicate_ok' => 1,
    ),
    'story_template' => 
    array (
      'name' => 'story_template',
      'description' => 'Story Template',
      'type' => 'text',
      'min_len' => 0,
      'max_len' => 65535,
      'blank_ok' => 0,
      'duplicate_ok' => 1,
    ),
  ),
);   

      function blogPreferencesData() {
      
         $this->Data($this->config);
      }
   }

?>
