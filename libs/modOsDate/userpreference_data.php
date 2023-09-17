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


   class userpreferenceData extends Data {

      var $table = USERPREFERENCE_TABLE;

      var $config = array (
  'table' => USERPREFERENCE_TABLE,
  'idField' => 'osdate_userpreference_id',
  'addedMsg' => 'Osdate Userpreference %s Added',
  'added_err' => 'Can\\\'t Add Osdate Userpreference',
  'editMsg' => 'Osdate Userpreference %s Updated',
  'editErr' => 'Can\\\'t Update Osdate Userpreference',
  'delErr' => 'Can\\\'t Delete Osdate Userpreference',
  'delMsg' => 'Osdate Userpreference %s Deleted',
  'blankErr' => 'Osdate Userpreference Empty',
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
    'questionid' => 
    array (
      'name' => 'questionid',
      'description' => 'Questionid',
      'type' => 'number',
      'min_len' => 0,
      'max_len' => 8,
      'blank_ok' => 0,
      'duplicate_ok' => 1,
    ),
    'answer' => 
    array (
      'name' => 'answer',
      'description' => 'Answer',
      'type' => 'text',
      'min_len' => 0,
      'max_len' => 65535,
      'blank_ok' => 1,
      'duplicate_ok' => 1,
    ),
  ),
);   

      function userpreferenceData() {
      
         $this->Data($this->config);
      }
   }

?>
