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


   class storiesData extends Data {

      var $table = STORIES_TABLE;

      var $config = array (
  'table' => STORIES_TABLE,
  'idField' => 'osdate_stories_id',
  'addedMsg' => 'Osdate Stories %s Added',
  'added_err' => 'Can\\\'t Add Osdate Stories',
  'editMsg' => 'Osdate Stories %s Updated',
  'editErr' => 'Can\\\'t Update Osdate Stories',
  'delErr' => 'Can\\\'t Delete Osdate Stories',
  'delMsg' => 'Osdate Stories %s Deleted',
  'blankErr' => 'Osdate Stories Empty',
  'fields' => 
  array (
    'storyid' => 
    array (
      'name' => 'storyid',
      'description' => 'Storyid',
      'type' => 'number',
      'min_len' => 0,
      'max_len' => 10,
      'blank_ok' => 0,
      'duplicate_ok' => 1,
    ),
    'date' => 
    array (
      'name' => 'date',
      'description' => 'Date',
      'type' => 'number',
      'min_len' => 0,
      'max_len' => 11,
      'blank_ok' => 0,
      'duplicate_ok' => 1,
    ),
    'sender' => 
    array (
      'name' => 'sender',
      'description' => 'Sender',
      'type' => 'number',
      'min_len' => 0,
      'max_len' => 11,
      'blank_ok' => 0,
      'duplicate_ok' => 1,
    ),
    'header' => 
    array (
      'name' => 'header',
      'description' => 'Header',
      'type' => 'text',
      'min_len' => 0,
      'max_len' => 50,
      'blank_ok' => 0,
      'duplicate_ok' => 1,
    ),
    'text' => 
    array (
      'name' => 'text',
      'description' => 'Text',
      'type' => 'text',
      'min_len' => 0,
      'max_len' => 16777215,
      'blank_ok' => 0,
      'duplicate_ok' => 1,
    ),
    'enabled' => 
    array (
      'name' => 'enabled',
      'description' => 'Enabled',
      'type' => 'text',
      'min_len' => 0,
      'max_len' => 1,
      'blank_ok' => 0,
      'duplicate_ok' => 1,
    ),
  ),
);   

      function storiesData() {
      
         $this->Data($this->config);
      }
   }

?>
