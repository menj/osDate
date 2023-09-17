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


   class calendarEventsData extends Data {

      var $table = EVENTS_TABLE;

      var $config = array (
  'table' => EVENTS_TABLE,
  'idField' => 'id',
  'addedMsg' => 'Osdate Calendarevents %s Added',
  'added_err' => 'Can\\\'t Add Osdate Calendarevents',
  'editMsg' => 'Osdate Calendarevents %s Updated',
  'editErr' => 'Can\\\'t Update Osdate Calendarevents',
  'delErr' => 'Can\\\'t Delete Osdate Calendarevents',
  'delMsg' => 'Osdate Calendarevents %s Deleted',
  'blankErr' => 'Osdate Calendarevents Empty',
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
    'event' => 
    array (
      'name' => 'event',
      'description' => 'Event',
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
      'max_len' => 65535,
      'blank_ok' => 0,
      'duplicate_ok' => 1,
    ),
    'recurring' => 
    array (
      'name' => 'recurring',
      'description' => 'Recurring',
      'type' => 'number',
      'min_len' => 0,
      'max_len' => 11,
      'blank_ok' => 0,
      'duplicate_ok' => 1,
    ),
    'recuroption' => 
    array (
      'name' => 'recuroption',
      'description' => 'Recuroption',
      'type' => 'text',
      'min_len' => 0,
      'max_len' => 255,
      'blank_ok' => 1,
      'duplicate_ok' => 1,
    ),
    'calendarid' => 
    array (
      'name' => 'calendarid',
      'description' => 'Calendarid',
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
    'timezone' => 
    array (
      'name' => 'timezone',
      'description' => 'Timezone',
      'type' => 'amount',
      'min_len' => 0,
      'max_len' => 7,
      'blank_ok' => 0,
      'duplicate_ok' => 1,
    ),
    'datetime_from' => 
    array (
      'name' => 'datetime_from',
      'description' => 'Datetime From',
      'type' => 'datetime',
      'min_len' => 0,
      'max_len' => 19,
      'blank_ok' => 0,
      'duplicate_ok' => 1,
    ),
    'datetime_to' => 
    array (
      'name' => 'datetime_to',
      'description' => 'Datetime To',
      'type' => 'datetime',
      'min_len' => 0,
      'max_len' => 19,
      'blank_ok' => 0,
      'duplicate_ok' => 1,
    ),
    'private_to' => 
    array (
      'name' => 'private_to',
      'description' => 'Private To',
      'type' => 'text',
      'min_len' => 0,
      'max_len' => 255,
      'blank_ok' => 1,
      'duplicate_ok' => 1,
    ),
  ),
);   

      function calendarEventsData() {
      
         $this->Data($this->config);
      }
   }

?>
