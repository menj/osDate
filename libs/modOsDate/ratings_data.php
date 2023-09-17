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


   class ratingsData extends Data {

      var $table = RATINGS_TABLE;

      var $config = array (
  'table' => RATINGS_TABLE,
  'idField' => 'osdate_ratings_id',
  'addedMsg' => 'Osdate Ratings %s Added',
  'added_err' => 'Can\\\'t Add Osdate Ratings',
  'editMsg' => 'Osdate Ratings %s Updated',
  'editErr' => 'Can\\\'t Update Osdate Ratings',
  'delErr' => 'Can\\\'t Delete Osdate Ratings',
  'delMsg' => 'Osdate Ratings %s Deleted',
  'blankErr' => 'Osdate Ratings Empty',
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
    'rating' => 
    array (
      'name' => 'rating',
      'description' => 'Rating',
      'type' => 'text',
      'min_len' => 0,
      'max_len' => 255,
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
    'description' => 
    array (
      'name' => 'description',
      'description' => 'Description',
      'type' => 'text',
      'min_len' => 0,
      'max_len' => 255,
      'blank_ok' => 0,
      'duplicate_ok' => 1,
    ),
  ),
);   

      function ratingsData() {
      
         $this->Data($this->config);
      }
   }

?>
