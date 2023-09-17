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


   class zipsData extends Data {

      var $table = ZIPCODES_TABLE;

      var $config = array (
  'table' => ZIPCODES_TABLE,
  'idField' => 'id',
  'addedMsg' => 'Osdate Zips %s Added',
  'added_err' => 'Can\\\'t Add Osdate Zips',
  'editMsg' => 'Osdate Zips %s Updated',
  'editErr' => 'Can\\\'t Update Osdate Zips',
  'delErr' => 'Can\\\'t Delete Osdate Zips',
  'delMsg' => 'Osdate Zips %s Deleted',
  'blankErr' => 'Osdate Zips Empty',
  'fields' => 
  array (
    'code' => 
    array (
      'name' => 'code',
      'description' => 'Code',
      'type' => 'text',
      'min_len' => 0,
      'max_len' => 30,
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
    'citycode' => 
    array (
      'name' => 'citycode',
      'description' => 'Citycode',
      'type' => 'text',
      'min_len' => 0,
      'max_len' => 10,
      'blank_ok' => 1,
      'duplicate_ok' => 1,
    ),
    'latitude' => 
    array (
      'name' => 'latitude',
      'description' => 'Latitude',
      'type' => 'amount',
      'min_len' => 0,
      'max_len' => 12,
      'blank_ok' => 1,
      'duplicate_ok' => 1,
    ),
    'longitude' => 
    array (
      'name' => 'longitude',
      'description' => 'Longitude',
      'type' => 'amount',
      'min_len' => 0,
      'max_len' => 12,
      'blank_ok' => 1,
      'duplicate_ok' => 1,
    ),
  ),
);   

      function zipsData() {
      
         $this->Data($this->config);
      }
   }

?>
