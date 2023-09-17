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


   class glblsettingsData extends Data {

      var $table = GLBLSETTINGS_TABLE;

      var $config = array (
  'table' => GLBLSETTINGS_TABLE,
  'idField' => 'osdate_glblsettings_id',
  'addedMsg' => 'Osdate Glblsettings %s Added',
  'added_err' => 'Can\\\'t Add Osdate Glblsettings',
  'editMsg' => 'Osdate Glblsettings %s Updated',
  'editErr' => 'Can\\\'t Update Osdate Glblsettings',
  'delErr' => 'Can\\\'t Delete Osdate Glblsettings',
  'delMsg' => 'Osdate Glblsettings %s Deleted',
  'blankErr' => 'Osdate Glblsettings Empty',
  'fields' => 
  array (
    'config_variable' => 
    array (
      'name' => 'config_variable',
      'description' => 'Config Variable',
      'type' => 'text',
      'min_len' => 0,
      'max_len' => 50,
      'blank_ok' => 0,
      'duplicate_ok' => 1,
    ),
    'config_value' => 
    array (
      'name' => 'config_value',
      'description' => 'Config Value',
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
    'groupid' => 
    array (
      'name' => 'groupid',
      'description' => 'Groupid',
      'type' => 'number',
      'min_len' => 0,
      'max_len' => 2,
      'blank_ok' => 1,
      'duplicate_ok' => 1,
    ),
  ),
);   

      function glblsettingsData() {
      
         $this->Data($this->config);
      }
   }

?>
