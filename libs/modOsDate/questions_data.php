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


   class questionsData extends Data {

      var $table = QUESTIONS_TABLE;

      var $config = array (
  'table' => QUESTIONS_TABLE,
  'idField' => 'osdate_questions_id',
  'addedMsg' => 'Osdate Questions %s Added',
  'added_err' => 'Can\\\'t Add Osdate Questions',
  'editMsg' => 'Osdate Questions %s Updated',
  'editErr' => 'Can\\\'t Update Osdate Questions',
  'delErr' => 'Can\\\'t Delete Osdate Questions',
  'delMsg' => 'Osdate Questions %s Deleted',
  'blankErr' => 'Osdate Questions Empty',
  'fields' => 
  array (
    'id' => 
    array (
      'name' => 'id',
      'description' => 'Id',
      'type' => 'number',
      'min_len' => 0,
      'max_len' => 8,
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
    'description' => 
    array (
      'name' => 'description',
      'description' => 'Description',
      'type' => 'text',
      'min_len' => 0,
      'max_len' => 255,
      'blank_ok' => 1,
      'duplicate_ok' => 1,
    ),
    'guideline' => 
    array (
      'name' => 'guideline',
      'description' => 'Guideline',
      'type' => 'text',
      'min_len' => 0,
      'max_len' => 255,
      'blank_ok' => 1,
      'duplicate_ok' => 1,
    ),
    'control_type' => 
    array (
      'name' => 'control_type',
      'description' => 'Control Type',
      'type' => 'text',
      'min_len' => 0,
      'max_len' => 100,
      'blank_ok' => 0,
      'duplicate_ok' => 1,
    ),
    'maxlength' => 
    array (
      'name' => 'maxlength',
      'description' => 'Maxlength',
      'type' => 'number',
      'min_len' => 0,
      'max_len' => 3,
      'blank_ok' => 0,
      'duplicate_ok' => 1,
    ),
    'mandatory' => 
    array (
      'name' => 'mandatory',
      'description' => 'Mandatory',
      'type' => 'text',
      'min_len' => 0,
      'max_len' => 1,
      'blank_ok' => 0,
      'duplicate_ok' => 1,
    ),
    'section' => 
    array (
      'name' => 'section',
      'description' => 'Section',
      'type' => 'number',
      'min_len' => 0,
      'max_len' => 2,
      'blank_ok' => 0,
      'duplicate_ok' => 1,
    ),
    'displayorder' => 
    array (
      'name' => 'displayorder',
      'description' => 'Displayorder',
      'type' => 'number',
      'min_len' => 0,
      'max_len' => 2,
      'blank_ok' => 0,
      'duplicate_ok' => 1,
    ),
    'extsearchable' => 
    array (
      'name' => 'extsearchable',
      'description' => 'Extsearchable',
      'type' => 'text',
      'min_len' => 0,
      'max_len' => 1,
      'blank_ok' => 0,
      'duplicate_ok' => 1,
    ),
    'extsearchhead' => 
    array (
      'name' => 'extsearchhead',
      'description' => 'Extsearchhead',
      'type' => 'text',
      'min_len' => 0,
      'max_len' => 255,
      'blank_ok' => 1,
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

      function questionsData() {
      
         $this->Data($this->config);
      }
   }

?>
