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


   class pollsData extends Data {

      var $table = POLLS_TABLE;

      var $config = array (
  'table' => POLLS_TABLE,
  'idField' => 'pollid',
  'addedMsg' => 'Osdate Polls %s Added',
  'added_err' => 'Can\\\'t Add Osdate Polls',
  'editMsg' => 'Osdate Polls %s Updated',
  'editErr' => 'Can\\\'t Update Osdate Polls',
  'delErr' => 'Can\\\'t Delete Osdate Polls',
  'delMsg' => 'Osdate Polls %s Deleted',
  'blankErr' => 'Osdate Polls Empty',
  'fields' => 
  array (
    'question' => 
    array (
      'name' => 'question',
      'description' => 'Question',
      'type' => 'text',
      'min_len' => 0,
      'max_len' => 255,
      'blank_ok' => 1,
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
    'active' => 
    array (
      'name' => 'active',
      'description' => 'Active',
      'type' => 'number',
      'min_len' => 0,
      'max_len' => 1,
      'blank_ok' => 0,
      'duplicate_ok' => 1,
    ),
    'options' => 
    array (
      'name' => 'options',
      'description' => 'Options',
      'type' => 'text',
      'min_len' => 0,
      'max_len' => 255,
      'blank_ok' => 1,
      'duplicate_ok' => 1,
    ),
    'suggested_by' => 
    array (
      'name' => 'suggested_by',
      'description' => 'Suggested By',
      'type' => 'number',
      'min_len' => 0,
      'max_len' => 11,
      'blank_ok' => 1,
      'duplicate_ok' => 1,
    ),
  ),
);   

      function pollsData() {
      
         $this->Data($this->config);
      }
   }

?>
