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


   class articlesData extends Data {

      var $table = ARTICLES_TABLE;

      var $config = array (
  'table' => ARTICLES_TABLE,
  'idField' => 'articleid',
  'addedMsg' => 'Osdate Articles %s Added',
  'added_err' => 'Can\\\'t Add Osdate Articles',
  'editMsg' => 'Osdate Articles %s Updated',
  'editErr' => 'Can\\\'t Update Osdate Articles',
  'delErr' => 'Can\\\'t Delete Osdate Articles',
  'delMsg' => 'Osdate Articles %s Deleted',
  'blankErr' => 'Osdate Articles Empty',
  'fields' => 
  array (
    'dat' => 
    array (
      'name' => 'dat',
      'description' => 'Dat',
      'type' => 'number',
      'min_len' => 0,
      'max_len' => 11,
      'blank_ok' => 0,
      'duplicate_ok' => 1,
    ),
    'title' => 
    array (
      'name' => 'title',
      'description' => 'Title',
      'type' => 'text',
      'min_len' => 0,
      'max_len' => 255,
      'blank_ok' => 1,
      'duplicate_ok' => 1,
    ),
    'text' => 
    array (
      'name' => 'text',
      'description' => 'Text',
      'type' => 'text',
      'min_len' => 0,
      'max_len' => 16777215,
      'blank_ok' => 1,
      'duplicate_ok' => 1,
    ),
  ),
);   

      function articlesData() {
      
         $this->Data($this->config);
      }
   }

?>
