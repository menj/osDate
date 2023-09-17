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


   class featuredProfilesData extends Data {

      var $table = FEATURED_PROFILES_TABLE;

      var $config = array (
  'table' => FEATURED_PROFILES_TABLE,
  'idField' => 'id',
  'addedMsg' => 'Osdate Featured Profiles %s Added',
  'added_err' => 'Can\\\'t Add Osdate Featured Profiles',
  'editMsg' => 'Osdate Featured Profiles %s Updated',
  'editErr' => 'Can\\\'t Update Osdate Featured Profiles',
  'delErr' => 'Can\\\'t Delete Osdate Featured Profiles',
  'delMsg' => 'Osdate Featured Profiles %s Deleted',
  'blankErr' => 'Osdate Featured Profiles Empty',
  'fields' => 
  array (
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
    'start_date' => 
    array (
      'name' => 'start_date',
      'description' => 'Start Date',
      'type' => 'number',
      'min_len' => 0,
      'max_len' => 11,
      'blank_ok' => 0,
      'duplicate_ok' => 1,
    ),
    'end_date' => 
    array (
      'name' => 'end_date',
      'description' => 'End Date',
      'type' => 'number',
      'min_len' => 0,
      'max_len' => 11,
      'blank_ok' => 0,
      'duplicate_ok' => 1,
    ),
    'must_show' => 
    array (
      'name' => 'must_show',
      'description' => 'Must Show',
      'type' => 'text',
      'min_len' => 0,
      'max_len' => 1,
      'blank_ok' => 0,
      'duplicate_ok' => 1,
    ),
    'req_exposures' => 
    array (
      'name' => 'req_exposures',
      'description' => 'Req Exposures',
      'type' => 'number',
      'min_len' => 0,
      'max_len' => 11,
      'blank_ok' => 0,
      'duplicate_ok' => 1,
    ),
    'exposures' => 
    array (
      'name' => 'exposures',
      'description' => 'Exposures',
      'type' => 'number',
      'min_len' => 0,
      'max_len' => 11,
      'blank_ok' => 1,
      'duplicate_ok' => 1,
    ),
  ),
);   

      function featuredProfilesData() {
      
         $this->Data($this->config);
      }
   }

?>
