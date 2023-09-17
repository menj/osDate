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


   class pagesData extends Data {

      var $table = PAGES_TABLE;

      var $config = array (
  'table' => PAGES_TABLE,
  'idField' => 'osdate_pages_id',
  'addedMsg' => 'Osdate Pages %s Added',
  'added_err' => 'Can\\\'t Add Osdate Pages',
  'editMsg' => 'Osdate Pages %s Updated',
  'editErr' => 'Can\\\'t Update Osdate Pages',
  'delErr' => 'Can\\\'t Delete Osdate Pages',
  'delMsg' => 'Osdate Pages %s Deleted',
  'blankErr' => 'Osdate Pages Empty',
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
    'pagekey' => 
    array (
      'name' => 'pagekey',
      'description' => 'Pagekey',
      'type' => 'text',
      'min_len' => 0,
      'max_len' => 100,
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
      'blank_ok' => 0,
      'duplicate_ok' => 1,
    ),
    'pagetext' => 
    array (
      'name' => 'pagetext',
      'description' => 'Pagetext',
      'type' => 'text',
      'min_len' => 0,
      'max_len' => 65535,
      'blank_ok' => 0,
      'duplicate_ok' => 1,
    ),
  ),
);   

      function pagesData() {
      
         $this->Data($this->config);
      }
   }

?>
