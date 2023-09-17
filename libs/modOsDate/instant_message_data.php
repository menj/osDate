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


   class instant_messageData extends Data {

      var $table = INSTANT_MESSAGE_TABLE;

      var $config = array (
  'table' => INSTANT_MESSAGE_TABLE,
  'idField' => 'osdate_instant_message_id',
  'addedMsg' => 'Osdate Instant Message %s Added',
  'added_err' => 'Can\\\'t Add Osdate Instant Message',
  'editMsg' => 'Osdate Instant Message %s Updated',
  'editErr' => 'Can\\\'t Update Osdate Instant Message',
  'delErr' => 'Can\\\'t Delete Osdate Instant Message',
  'delMsg' => 'Osdate Instant Message %s Deleted',
  'blankErr' => 'Osdate Instant Message Empty',
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
    'senderid' => 
    array (
      'name' => 'senderid',
      'description' => 'Senderid',
      'type' => 'number',
      'min_len' => 0,
      'max_len' => 11,
      'blank_ok' => 1,
      'duplicate_ok' => 1,
    ),
    'recipientid' => 
    array (
      'name' => 'recipientid',
      'description' => 'Recipientid',
      'type' => 'number',
      'min_len' => 0,
      'max_len' => 11,
      'blank_ok' => 1,
      'duplicate_ok' => 1,
    ),
    'message' => 
    array (
      'name' => 'message',
      'description' => 'Message',
      'type' => 'text',
      'min_len' => 0,
      'max_len' => 65535,
      'blank_ok' => 1,
      'duplicate_ok' => 1,
    ),
    'pingflag' => 
    array (
      'name' => 'pingflag',
      'description' => 'Pingflag',
      'type' => 'number',
      'min_len' => 0,
      'max_len' => 1,
      'blank_ok' => 1,
      'duplicate_ok' => 1,
    ),
    'sendtime' => 
    array (
      'name' => 'sendtime',
      'description' => 'Sendtime',
      'type' => 'number',
      'min_len' => 0,
      'max_len' => 11,
      'blank_ok' => 0,
      'duplicate_ok' => 1,
    ),
  ),
);   

      function instant_messageData() {
      
         $this->Data($this->config);
      }
   }

?>
