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


   class mailboxData extends Data {

      var $table = MAILBOX_TABLE;

      var $config = array (
  'table' => MAILBOX_TABLE,
  'idField' => 'id',
  'addedMsg' => 'Osdate Mailbox %s Added',
  'added_err' => 'Can\\\'t Add Osdate Mailbox',
  'editMsg' => 'Osdate Mailbox %s Updated',
  'editErr' => 'Can\\\'t Update Osdate Mailbox',
  'delErr' => 'Can\\\'t Delete Osdate Mailbox',
  'delMsg' => 'Osdate Mailbox %s Deleted',
  'blankErr' => 'Osdate Mailbox Empty',
  'fields' => 
  array (
    'owner' => 
    array (
      'name' => 'owner',
      'description' => 'Owner',
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
      'blank_ok' => 0,
      'duplicate_ok' => 1,
    ),
    'recipientid' => 
    array (
      'name' => 'recipientid',
      'description' => 'Recipientid',
      'type' => 'number',
      'min_len' => 0,
      'max_len' => 11,
      'blank_ok' => 0,
      'duplicate_ok' => 1,
    ),
    'subject' => 
    array (
      'name' => 'subject',
      'description' => 'Subject',
      'type' => 'text',
      'min_len' => 0,
      'max_len' => 254,
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
      'blank_ok' => 0,
      'duplicate_ok' => 1,
    ),
    'flag' => 
    array (
      'name' => 'flag',
      'description' => 'Flag',
      'type' => 'number',
      'min_len' => 0,
      'max_len' => 1,
      'blank_ok' => 1,
      'duplicate_ok' => 1,
    ),
    'flagread' => 
    array (
      'name' => 'flagread',
      'description' => 'Flagread',
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
      'blank_ok' => 1,
      'duplicate_ok' => 1,
    ),
    'flagdelete' => 
    array (
      'name' => 'flagdelete',
      'description' => 'Flagdelete',
      'type' => 'number',
      'min_len' => 0,
      'max_len' => 1,
      'blank_ok' => 1,
      'duplicate_ok' => 1,
    ),
    'replied' => 
    array (
      'name' => 'replied',
      'description' => 'Replied',
      'type' => 'number',
      'min_len' => 0,
      'max_len' => 1,
      'blank_ok' => 1,
      'duplicate_ok' => 1,
    ),
    'folder' => 
    array (
      'name' => 'folder',
      'description' => 'Folder',
      'type' => 'text',
      'min_len' => 0,
      'max_len' => 10,
      'blank_ok' => 0,
      'duplicate_ok' => 1,
    ),
    'notifysender' => 
    array (
      'name' => 'notifysender',
      'description' => 'Notifysender',
      'type' => 'number',
      'min_len' => 0,
      'max_len' => 1,
      'blank_ok' => 1,
      'duplicate_ok' => 1,
    ),
  ),
);   

      function mailboxData() {
      
         $this->Data($this->config);
      }
   }

?>
