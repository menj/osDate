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


   class buddyBanListData extends Data {

      var $table = BUDDY_BAN_TABLE;

      var $config = array (
  'table' => BUDDY_BAN_TABLE,
  'idField' => 'id',
  'addedMsg' => 'Osdate Buddy Ban List %s Added',
  'added_err' => 'Can\\\'t Add Osdate Buddy Ban List',
  'editMsg' => 'Osdate Buddy Ban List %s Updated',
  'editErr' => 'Can\\\'t Update Osdate Buddy Ban List',
  'delErr' => 'Can\\\'t Delete Osdate Buddy Ban List',
  'delMsg' => 'Osdate Buddy Ban List %s Deleted',
  'blankErr' => 'Osdate Buddy Ban List Empty',
  'fields' => 
  array (
    'username' => 
    array (
      'name' => 'username',
      'description' => 'Username',
      'type' => 'text',
      'min_len' => 0,
      'max_len' => 25,
      'blank_ok' => 0,
      'duplicate_ok' => 1,
    ),
    'act' => 
    array (
      'name' => 'act',
      'description' => 'Act',
      'type' => 'text',
      'min_len' => 0,
      'max_len' => 1,
      'blank_ok' => 0,
      'duplicate_ok' => 1,
    ),
    'ref_username' => 
    array (
      'name' => 'ref_username',
      'description' => 'Ref Username',
      'type' => 'text',
      'min_len' => 0,
      'max_len' => 25,
      'blank_ok' => 0,
      'duplicate_ok' => 1,
    ),
    'act_date' => 
    array (
      'name' => 'act_date',
      'description' => 'Act Date',
      'type' => 'number',
      'min_len' => 0,
      'max_len' => 11,
      'blank_ok' => 0,
      'duplicate_ok' => 1,
    ),
  ),
);   

      function buddyBanListData() {
      
         $this->Data($this->config);
      }
   }

?>
