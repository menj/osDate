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


   class citiesData extends Data {

      var $table = CITIES_TABLE;

      var $config = array (
  'table' => CITIES_TABLE,
  'idField' => 'osdate_cities_id',
  'addedMsg' => 'Osdate Cities %s Added',
  'added_err' => 'Can\\\'t Add Osdate Cities',
  'editMsg' => 'Osdate Cities %s Updated',
  'editErr' => 'Can\\\'t Update Osdate Cities',
  'delErr' => 'Can\\\'t Delete Osdate Cities',
  'delMsg' => 'Osdate Cities %s Deleted',
  'blankErr' => 'Osdate Cities Empty',
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
    'code' => 
    array (
      'name' => 'code',
      'description' => 'Code',
      'type' => 'text',
      'min_len' => 0,
      'max_len' => 10,
      'blank_ok' => 1,
      'duplicate_ok' => 1,
    ),
    'name' => 
    array (
      'name' => 'name',
      'description' => 'Name',
      'type' => 'text',
      'min_len' => 0,
      'max_len' => 100,
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
      'blank_ok' => 1,
      'duplicate_ok' => 1,
    ),
    'countrycode' => 
    array (
      'name' => 'countrycode',
      'description' => 'Countrycode',
      'type' => 'text',
      'min_len' => 0,
      'max_len' => 5,
      'blank_ok' => 0,
      'duplicate_ok' => 1,
    ),
    'statecode' => 
    array (
      'name' => 'statecode',
      'description' => 'Statecode',
      'type' => 'text',
      'min_len' => 0,
      'max_len' => 10,
      'blank_ok' => 1,
      'duplicate_ok' => 1,
    ),
    'countycode' => 
    array (
      'name' => 'countycode',
      'description' => 'Countycode',
      'type' => 'text',
      'min_len' => 0,
      'max_len' => 10,
      'blank_ok' => 1,
      'duplicate_ok' => 1,
    ),
  ),
);   

      function citiesData() {
      
         $this->Data($this->config);
      }
   }

?>
