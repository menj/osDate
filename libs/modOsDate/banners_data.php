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


   class bannersData extends Data {

      var $table = BANNER_TABLE;

      var $config = array (
  'table' => BANNER_TABLE,
  'idField' => 'id',
  'addedMsg' => 'Osdate Banners %s Added',
  'added_err' => 'Can\\\'t Add Osdate Banners',
  'editMsg' => 'Osdate Banners %s Updated',
  'editErr' => 'Can\\\'t Update Osdate Banners',
  'delErr' => 'Can\\\'t Delete Osdate Banners',
  'delMsg' => 'Osdate Banners %s Deleted',
  'blankErr' => 'Osdate Banners Empty',
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
    'name' =>
    array (
      'name' => 'name',
      'description' => 'Name',
      'type' => 'text',
      'min_len' => 0,
      'max_len' => 255,
      'blank_ok' => 0,
      'duplicate_ok' => 1,
    ),
    'bannerurl' =>
    array (
      'name' => 'bannerurl',
      'description' => 'Bannerurl',
      'type' => 'text',
      'min_len' => 0,
      'max_len' => 65535,
      'blank_ok' => 1,
      'duplicate_ok' => 1,
    ),
    'language' =>
    array (
      'name' => 'language',
      'description' => 'language',
      'type' => 'text',
      'min_len' => 0,
      'max_len' => 255,
      'blank_ok' => 1,
      'duplicate_ok' => 1,
    ),
    'linkurl' =>
    array (
      'name' => 'linkurl',
      'description' => 'Linkurl',
      'type' => 'text',
      'min_len' => 0,
      'max_len' => 255,
      'blank_ok' => 1,
      'duplicate_ok' => 1,
    ),
    'tooltip' =>
    array (
      'name' => 'tooltip',
      'description' => 'Tooltip',
      'type' => 'text',
      'min_len' => 0,
      'max_len' => 255,
      'blank_ok' => 1,
      'duplicate_ok' => 1,
    ),
    'size' =>
    array (
      'name' => 'size',
      'description' => 'Size',
      'type' => 'text',
      'min_len' => 0,
      'max_len' => 20,
      'blank_ok' => 1,
      'duplicate_ok' => 1,
    ),
    'startdate' =>
    array (
      'name' => 'startdate',
      'description' => 'Startdate',
      'type' => 'number',
      'min_len' => 0,
      'max_len' => 11,
      'blank_ok' => 0,
      'duplicate_ok' => 1,
    ),
    'expdate' =>
    array (
      'name' => 'expdate',
      'description' => 'Expdate',
      'type' => 'number',
      'min_len' => 0,
      'max_len' => 11,
      'blank_ok' => 0,
      'duplicate_ok' => 1,
    ),
    'clicks' =>
    array (
      'name' => 'clicks',
      'description' => 'Clicks',
      'type' => 'number',
      'min_len' => 0,
      'max_len' => 11,
      'blank_ok' => 0,
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

      function bannersData() {

         $this->Data($this->config);
      }
   }

?>
