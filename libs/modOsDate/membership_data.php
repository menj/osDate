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


   class membershipData extends Data {

      var $table = MEMBERSHIP_TABLE;

      var $config = array (
  'table' => MEMBERSHIP_TABLE,
  'idField' => 'id',
  'addedMsg' => 'Osdate Membership %s Added',
  'added_err' => 'Can\\\'t Add Osdate Membership',
  'editMsg' => 'Osdate Membership %s Updated',
  'editErr' => 'Can\\\'t Update Osdate Membership',
  'delErr' => 'Can\\\'t Delete Osdate Membership',
  'delMsg' => 'Osdate Membership %s Deleted',
  'blankErr' => 'Osdate Membership Empty',
  'fields' => 
  array (
    'roleid' => 
    array (
      'name' => 'roleid',
      'description' => 'Roleid',
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
    'forum' => 
    array (
      'name' => 'forum',
      'description' => 'Forum',
      'type' => 'text',
      'min_len' => 0,
      'max_len' => 1,
      'blank_ok' => 0,
      'duplicate_ok' => 1,
    ),
    'blog' => 
    array (
      'name' => 'blog',
      'description' => 'Blog',
      'type' => 'text',
      'min_len' => 0,
      'max_len' => 1,
      'blank_ok' => 0,
      'duplicate_ok' => 1,
    ),
    'poll' => 
    array (
      'name' => 'poll',
      'description' => 'Poll',
      'type' => 'text',
      'min_len' => 0,
      'max_len' => 1,
      'blank_ok' => 0,
      'duplicate_ok' => 1,
    ),
    'includeinsearch' => 
    array (
      'name' => 'includeinsearch',
      'description' => 'Includeinsearch',
      'type' => 'text',
      'min_len' => 0,
      'max_len' => 1,
      'blank_ok' => 0,
      'duplicate_ok' => 1,
    ),
    'message' => 
    array (
      'name' => 'message',
      'description' => 'Message',
      'type' => 'text',
      'min_len' => 0,
      'max_len' => 1,
      'blank_ok' => 0,
      'duplicate_ok' => 1,
    ),
    'message_keep_cnt' => 
    array (
      'name' => 'message_keep_cnt',
      'description' => 'Message Keep Cnt',
      'type' => 'number',
      'min_len' => 0,
      'max_len' => 11,
      'blank_ok' => 0,
      'duplicate_ok' => 1,
    ),
    'message_keep_days' => 
    array (
      'name' => 'message_keep_days',
      'description' => 'Message Keep Days',
      'type' => 'number',
      'min_len' => 0,
      'max_len' => 11,
      'blank_ok' => 0,
      'duplicate_ok' => 1,
    ),
    'allowim' => 
    array (
      'name' => 'allowim',
      'description' => 'Allowim',
      'type' => 'text',
      'min_len' => 0,
      'max_len' => 1,
      'blank_ok' => 0,
      'duplicate_ok' => 1,
    ),
    'uploadpicture' => 
    array (
      'name' => 'uploadpicture',
      'description' => 'Uploadpicture',
      'type' => 'text',
      'min_len' => 0,
      'max_len' => 1,
      'blank_ok' => 0,
      'duplicate_ok' => 1,
    ),
    'uploadpicturecnt' => 
    array (
      'name' => 'uploadpicturecnt',
      'description' => 'Uploadpicturecnt',
      'type' => 'number',
      'min_len' => 0,
      'max_len' => 4,
      'blank_ok' => 0,
      'duplicate_ok' => 1,
    ),
    'allowalbum' => 
    array (
      'name' => 'allowalbum',
      'description' => 'Allowalbum',
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
    'seepictureprofile' => 
    array (
      'name' => 'seepictureprofile',
      'description' => 'Seepictureprofile',
      'type' => 'text',
      'min_len' => 0,
      'max_len' => 1,
      'blank_ok' => 0,
      'duplicate_ok' => 1,
    ),
    'favouritelist' => 
    array (
      'name' => 'favouritelist',
      'description' => 'Favouritelist',
      'type' => 'text',
      'min_len' => 0,
      'max_len' => 1,
      'blank_ok' => 0,
      'duplicate_ok' => 1,
    ),
    'sendwinks' => 
    array (
      'name' => 'sendwinks',
      'description' => 'Sendwinks',
      'type' => 'text',
      'min_len' => 0,
      'max_len' => 1,
      'blank_ok' => 0,
      'duplicate_ok' => 1,
    ),
    'extsearch' => 
    array (
      'name' => 'extsearch',
      'description' => 'Extsearch',
      'type' => 'text',
      'min_len' => 0,
      'max_len' => 1,
      'blank_ok' => 0,
      'duplicate_ok' => 1,
    ),
    'activedays' => 
    array (
      'name' => 'activedays',
      'description' => 'Activedays',
      'type' => 'number',
      'min_len' => 0,
      'max_len' => 11,
      'blank_ok' => 0,
      'duplicate_ok' => 1,
    ),
    'fullsignup' => 
    array (
      'name' => 'fullsignup',
      'description' => 'Fullsignup',
      'type' => 'text',
      'min_len' => 0,
      'max_len' => 1,
      'blank_ok' => 0,
      'duplicate_ok' => 1,
    ),
    'price' => 
    array (
      'name' => 'price',
      'description' => 'Price',
      'type' => 'amount',
      'min_len' => 0,
      'max_len' => 13,
      'blank_ok' => 0,
      'duplicate_ok' => 1,
    ),
    'currency' => 
    array (
      'name' => 'currency',
      'description' => 'Currency',
      'type' => 'text',
      'min_len' => 0,
      'max_len' => 3,
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

      function membershipData() {
      
         $this->Data($this->config);
      }
   }

?>
