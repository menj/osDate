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


   class blogStoryData extends Data {

      var $table = BLOG_STORY_TABLE;

      var $config = array (
  'table' => BLOG_STORY_TABLE,
  'idField' => 'id',
  'addedMsg' => 'Osdate Blog Story %s Added',
  'added_err' => 'Can\\\'t Add Osdate Blog Story',
  'editMsg' => 'Osdate Blog Story %s Updated',
  'editErr' => 'Can\\\'t Update Osdate Blog Story',
  'delErr' => 'Can\\\'t Delete Osdate Blog Story',
  'delMsg' => 'Osdate Blog Story %s Deleted',
  'blankErr' => 'Osdate Blog Story Empty',
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
    'date_posted' => 
    array (
      'name' => 'date_posted',
      'description' => 'Date Posted',
      'type' => 'date',
      'min_len' => 0,
      'max_len' => 10,
      'blank_ok' => 0,
      'duplicate_ok' => 1,
    ),
    'title' => 
    array (
      'name' => 'title',
      'description' => 'Title',
      'type' => 'text',
      'min_len' => 0,
      'max_len' => 65535,
      'blank_ok' => 0,
      'duplicate_ok' => 1,
    ),
    'story' => 
    array (
      'name' => 'story',
      'description' => 'Story',
      'type' => 'text',
      'min_len' => 0,
      'max_len' => 65535,
      'blank_ok' => 0,
      'duplicate_ok' => 1,
    ),
    'views' => 
    array (
      'name' => 'views',
      'description' => 'Views',
      'type' => 'number',
      'min_len' => 0,
      'max_len' => 11,
      'blank_ok' => 0,
      'duplicate_ok' => 1,
    ),
  ),
);   

      function blogStoryData() {
      
         $this->Data($this->config);
      }
   }

?>
