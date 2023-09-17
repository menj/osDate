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


   class viewWinksData extends Data {

      var $table = VIEWS_WINKS_TABLE;

      var $config = array (
  'table' => VIEWS_WINKS_TABLE,
  'idField' => 'id',
  'addedMsg' => 'Osdate Views Winks %s Added',
  'added_err' => 'Can\\\'t Add Osdate Views Winks',
  'editMsg' => 'Osdate Views Winks %s Updated',
  'editErr' => 'Can\\\'t Update Osdate Views Winks',
  'delErr' => 'Can\\\'t Delete Osdate Views Winks',
  'delMsg' => 'Osdate Views Winks %s Deleted',
  'blankErr' => 'Osdate Views Winks Empty',
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
    'ref_userid' => 
    array (
      'name' => 'ref_userid',
      'description' => 'Ref Userid',
      'type' => 'number',
      'min_len' => 0,
      'max_len' => 11,
      'blank_ok' => 0,
      'duplicate_ok' => 1,
    ),
    'act_time' => 
    array (
      'name' => 'act_time',
      'description' => 'Act Time',
      'type' => 'number',
      'min_len' => 0,
      'max_len' => 11,
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
    'wink_msg' => 
    array (
      'name' => 'wink_msg',
      'description' => 'Wink Msg',
      'type' => 'text',
      'min_len' => 0,
      'max_len' => 200,
      'blank_ok' => 1,
      'duplicate_ok' => 1,
    ),
  ),
);   

      function viewWinksData() {
      
         $this->Data($this->config);
      }
   }

?>
