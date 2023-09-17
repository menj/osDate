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


   class payment_configData extends Data {

      var $table = PAYMENT_CONFIG_TABLE;

      var $config = array (
  'table' => PAYMENT_CONFIG_TABLE,
  'idField' => 'osdate_payment_config_id',
  'addedMsg' => 'Osdate Payment Config %s Added',
  'added_err' => 'Can\\\'t Add Osdate Payment Config',
  'editMsg' => 'Osdate Payment Config %s Updated',
  'editErr' => 'Can\\\'t Update Osdate Payment Config',
  'delErr' => 'Can\\\'t Delete Osdate Payment Config',
  'delMsg' => 'Osdate Payment Config %s Deleted',
  'blankErr' => 'Osdate Payment Config Empty',
  'fields' => 
  array (
    'configuration_id' => 
    array (
      'name' => 'configuration_id',
      'description' => 'Configuration Id',
      'type' => 'number',
      'min_len' => 0,
      'max_len' => 11,
      'blank_ok' => 0,
      'duplicate_ok' => 1,
    ),
    'configuration_title' => 
    array (
      'name' => 'configuration_title',
      'description' => 'Configuration Title',
      'type' => 'text',
      'min_len' => 0,
      'max_len' => 64,
      'blank_ok' => 0,
      'duplicate_ok' => 1,
    ),
    'configuration_key' => 
    array (
      'name' => 'configuration_key',
      'description' => 'Configuration Key',
      'type' => 'text',
      'min_len' => 0,
      'max_len' => 64,
      'blank_ok' => 0,
      'duplicate_ok' => 1,
    ),
    'configuration_value' => 
    array (
      'name' => 'configuration_value',
      'description' => 'Configuration Value',
      'type' => 'text',
      'min_len' => 0,
      'max_len' => 255,
      'blank_ok' => 0,
      'duplicate_ok' => 1,
    ),
    'configuration_description' => 
    array (
      'name' => 'configuration_description',
      'description' => 'Configuration Description',
      'type' => 'text',
      'min_len' => 0,
      'max_len' => 255,
      'blank_ok' => 0,
      'duplicate_ok' => 1,
    ),
    'configuration_group_id' => 
    array (
      'name' => 'configuration_group_id',
      'description' => 'Configuration Group Id',
      'type' => 'number',
      'min_len' => 0,
      'max_len' => 11,
      'blank_ok' => 0,
      'duplicate_ok' => 1,
    ),
    'sort_order' => 
    array (
      'name' => 'sort_order',
      'description' => 'Sort Order',
      'type' => 'number',
      'min_len' => 0,
      'max_len' => 5,
      'blank_ok' => 1,
      'duplicate_ok' => 1,
    ),
    'last_modified' => 
    array (
      'name' => 'last_modified',
      'description' => 'Last Modified',
      'type' => 'datetime',
      'min_len' => 0,
      'max_len' => 19,
      'blank_ok' => 1,
      'duplicate_ok' => 1,
    ),
    'date_added' => 
    array (
      'name' => 'date_added',
      'description' => 'Date Added',
      'type' => 'datetime',
      'min_len' => 0,
      'max_len' => 19,
      'blank_ok' => 0,
      'duplicate_ok' => 1,
    ),
    'use_function' => 
    array (
      'name' => 'use_function',
      'description' => 'Use Function',
      'type' => 'text',
      'min_len' => 0,
      'max_len' => 255,
      'blank_ok' => 1,
      'duplicate_ok' => 1,
    ),
    'set_function' => 
    array (
      'name' => 'set_function',
      'description' => 'Set Function',
      'type' => 'text',
      'min_len' => 0,
      'max_len' => 255,
      'blank_ok' => 1,
      'duplicate_ok' => 1,
    ),
    'module_key' => 
    array (
      'name' => 'module_key',
      'description' => 'Module Key',
      'type' => 'text',
      'min_len' => 0,
      'max_len' => 255,
      'blank_ok' => 0,
      'duplicate_ok' => 1,
    ),
  ),
);   

      function payment_configData() {
      
         $this->Data($this->config);
      }
   }

?>
