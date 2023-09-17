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


   class poll_questionData extends Data {

      var $table = POLL_QUESTION_TABLE;

      var $config = array (
  'table' => POLL_QUESTION_TABLE,
  'idField' => 'osdate_poll_question_id',
  'addedMsg' => 'Osdate Poll Question %s Added',
  'added_err' => 'Can\\\'t Add Osdate Poll Question',
  'editMsg' => 'Osdate Poll Question %s Updated',
  'editErr' => 'Can\\\'t Update Osdate Poll Question',
  'delErr' => 'Can\\\'t Delete Osdate Poll Question',
  'delMsg' => 'Osdate Poll Question %s Deleted',
  'blankErr' => 'Osdate Poll Question Empty',
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
    'question' => 
    array (
      'name' => 'question',
      'description' => 'Question',
      'type' => 'text',
      'min_len' => 0,
      'max_len' => 255,
      'blank_ok' => 0,
      'duplicate_ok' => 1,
    ),
    'active' => 
    array (
      'name' => 'active',
      'description' => 'Active',
      'type' => 'text',
      'min_len' => 0,
      'max_len' => 1,
      'blank_ok' => 0,
      'duplicate_ok' => 1,
    ),
  ),
);   

      function poll_questionData() {
      
         $this->Data($this->config);
      }
   }

?>
