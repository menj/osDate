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


   class onlineusersData extends Data {

      var $table = ONLINE_USERS_TABLE;

      var $config = array (
  'table' => ONLINE_USERS_TABLE,
  'idField' => 'userid',
  'addedMsg' => 'Osdate Onlineusers %s Added',
  'added_err' => 'Can\'t Add Osdate Onlineusers',
  'editMsg' => 'Osdate Onlineusers %s Updated',
  'editErr' => 'Can\'t Update Osdate Onlineusers',
  'delErr' => 'Can\'t Delete Osdate Onlineusers',
  'delMsg' => 'Osdate Onlineusers %s Deleted',
  'blankErr' => 'Osdate Onlineusers Empty',
  'fields' => 
  array (
    'lastactivitytime' => 
    array (
      'name' => 'lastactivitytime',
      'description' => 'Lastactivitytime',
      'type' => 'number',
      'min_len' => 0,
      'max_len' => 11,
      'blank_ok' => 0,
      'duplicate_ok' => 1,
    ),
    'is_online' => 
    array (
      'name' => 'is_online',
      'description' => 'Is Online',
      'type' => 'text',
      'min_len' => 0,
      'max_len' => 1,
      'blank_ok' => 1,
      'duplicate_ok' => 1,
    ),
    'last_ping' => 
    array (
      'name' => 'last_ping',
      'description' => 'Last Ping',
      'type' => 'number',
      'min_len' => 0,
      'max_len' => 11,
      'blank_ok' => 1,
      'duplicate_ok' => 1,
    ),
    'session_id' => 
    array (
      'name' => 'session_id',
      'description' => 'Session Id',
      'type' => 'text',
      'min_len' => 0,
      'max_len' => 250,
      'blank_ok' => 1,
      'duplicate_ok' => 1,
    ),
  ),
);   

      function onlineusersData() {
      
         $this->Data($this->config);
      }
   }

?>
