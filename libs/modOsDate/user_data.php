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


   class userData extends Data {

      var $table = USER_TABLE;

      var $config = array (
  'table' => USER_TABLE,
  'idField' => 'id',
  'addedMsg' => 'Osdate User %s Added',
  'added_err' => 'Can\\\'t Add Osdate User',
  'editMsg' => 'Osdate User %s Updated',
  'editErr' => 'Can\\\'t Update Osdate User',
  'delErr' => 'Can\\\'t Delete Osdate User',
  'delMsg' => 'Osdate User %s Deleted',
  'blankErr' => 'Osdate User Empty',
  'fields' => 
  array (
    'active' => 
    array (
      'name' => 'active',
      'description' => 'Active',
      'type' => 'number',
      'min_len' => 0,
      'max_len' => 1,
      'blank_ok' => 1,
      'duplicate_ok' => 1,
    ),
    'username' => 
    array (
      'name' => 'username',
      'description' => 'Username',
      'type' => 'text',
      'min_len' => 0,
      'max_len' => 25,
      'blank_ok' => 0,
      'duplicate_ok' => 1,
    ),
    'password' => 
    array (
      'name' => 'password',
      'description' => 'Password',
      'type' => 'text',
      'min_len' => 0,
      'max_len' => 32,
      'blank_ok' => 0,
      'duplicate_ok' => 1,
    ),
    'lastvisit' => 
    array (
      'name' => 'lastvisit',
      'description' => 'Lastvisit',
      'type' => 'number',
      'min_len' => 0,
      'max_len' => 11,
      'blank_ok' => 0,
      'duplicate_ok' => 1,
    ),
    'regdate' => 
    array (
      'name' => 'regdate',
      'description' => 'Regdate',
      'type' => 'number',
      'min_len' => 0,
      'max_len' => 11,
      'blank_ok' => 0,
      'duplicate_ok' => 1,
    ),
    'level' => 
    array (
      'name' => 'level',
      'description' => 'Level',
      'type' => 'number',
      'min_len' => 0,
      'max_len' => 4,
      'blank_ok' => 1,
      'duplicate_ok' => 1,
    ),
    'timezone' => 
    array (
      'name' => 'timezone',
      'description' => 'Timezone',
      'type' => 'amount',
      'min_len' => 0,
      'max_len' => 7,
      'blank_ok' => 1,
      'duplicate_ok' => 1,
    ),
    'allow_viewonline' => 
    array (
      'name' => 'allow_viewonline',
      'description' => 'Allow Viewonline',
      'type' => 'number',
      'min_len' => 0,
      'max_len' => 1,
      'blank_ok' => 0,
      'duplicate_ok' => 1,
    ),
    'rank' => 
    array (
      'name' => 'rank',
      'description' => 'Rank',
      'type' => 'number',
      'min_len' => 0,
      'max_len' => 11,
      'blank_ok' => 1,
      'duplicate_ok' => 1,
    ),
    'email' => 
    array (
      'name' => 'email',
      'description' => 'Email',
      'type' => 'text',
      'min_len' => 0,
      'max_len' => 255,
      'blank_ok' => 1,
      'duplicate_ok' => 1,
    ),
    'country' => 
    array (
      'name' => 'country',
      'description' => 'Country',
      'type' => 'text',
      'min_len' => 0,
      'max_len' => 11,
      'blank_ok' => 0,
      'duplicate_ok' => 1,
    ),
    'actkey' => 
    array (
      'name' => 'actkey',
      'description' => 'Actkey',
      'type' => 'text',
      'min_len' => 0,
      'max_len' => 32,
      'blank_ok' => 1,
      'duplicate_ok' => 1,
    ),
    'firstname' => 
    array (
      'name' => 'firstname',
      'description' => 'Firstname',
      'type' => 'text',
      'min_len' => 0,
      'max_len' => 50,
      'blank_ok' => 1,
      'duplicate_ok' => 1,
    ),
    'lastname' => 
    array (
      'name' => 'lastname',
      'description' => 'Lastname',
      'type' => 'text',
      'min_len' => 0,
      'max_len' => 50,
      'blank_ok' => 1,
      'duplicate_ok' => 1,
    ),
    'gender' => 
    array (
      'name' => 'gender',
      'description' => 'Gender',
      'type' => 'text',
      'min_len' => 0,
      'max_len' => 1,
      'blank_ok' => 0,
      'duplicate_ok' => 1,
    ),
    'lookgender' => 
    array (
      'name' => 'lookgender',
      'description' => 'Lookgender',
      'type' => 'text',
      'min_len' => 0,
      'max_len' => 1,
      'blank_ok' => 0,
      'duplicate_ok' => 1,
    ),
    'lookagestart' => 
    array (
      'name' => 'lookagestart',
      'description' => 'Lookagestart',
      'type' => 'number',
      'min_len' => 0,
      'max_len' => 11,
      'blank_ok' => 0,
      'duplicate_ok' => 1,
    ),
    'lookageend' => 
    array (
      'name' => 'lookageend',
      'description' => 'Lookageend',
      'type' => 'number',
      'min_len' => 0,
      'max_len' => 11,
      'blank_ok' => 0,
      'duplicate_ok' => 1,
    ),
    'address_line1' => 
    array (
      'name' => 'address_line1',
      'description' => 'Address Line1',
      'type' => 'text',
      'min_len' => 0,
      'max_len' => 100,
      'blank_ok' => 1,
      'duplicate_ok' => 1,
    ),
    'address_line2' => 
    array (
      'name' => 'address_line2',
      'description' => 'Address Line2',
      'type' => 'text',
      'min_len' => 0,
      'max_len' => 100,
      'blank_ok' => 1,
      'duplicate_ok' => 1,
    ),
    'state_province' => 
    array (
      'name' => 'state_province',
      'description' => 'State Province',
      'type' => 'text',
      'min_len' => 0,
      'max_len' => 50,
      'blank_ok' => 1,
      'duplicate_ok' => 1,
    ),
    'county' => 
    array (
      'name' => 'county',
      'description' => 'County',
      'type' => 'text',
      'min_len' => 0,
      'max_len' => 50,
      'blank_ok' => 1,
      'duplicate_ok' => 1,
    ),
    'city' => 
    array (
      'name' => 'city',
      'description' => 'City',
      'type' => 'text',
      'min_len' => 0,
      'max_len' => 100,
      'blank_ok' => 1,
      'duplicate_ok' => 1,
    ),
    'zip' => 
    array (
      'name' => 'zip',
      'description' => 'Zip',
      'type' => 'text',
      'min_len' => 0,
      'max_len' => 30,
      'blank_ok' => 1,
      'duplicate_ok' => 1,
    ),
    'birth_date' => 
    array (
      'name' => 'birth_date',
      'description' => 'Birth Date',
      'type' => 'date',
      'min_len' => 0,
      'max_len' => 10,
      'blank_ok' => 0,
      'duplicate_ok' => 1,
    ),
    'lookcountry' => 
    array (
      'name' => 'lookcountry',
      'description' => 'Lookcountry',
      'type' => 'text',
      'min_len' => 0,
      'max_len' => 255,
      'blank_ok' => 0,
      'duplicate_ok' => 1,
    ),
    'lookstate_province' => 
    array (
      'name' => 'lookstate_province',
      'description' => 'Lookstate Province',
      'type' => 'text',
      'min_len' => 0,
      'max_len' => 50,
      'blank_ok' => 1,
      'duplicate_ok' => 1,
    ),
    'lookcounty' => 
    array (
      'name' => 'lookcounty',
      'description' => 'Lookcounty',
      'type' => 'text',
      'min_len' => 0,
      'max_len' => 50,
      'blank_ok' => 1,
      'duplicate_ok' => 1,
    ),
    'lookcity' => 
    array (
      'name' => 'lookcity',
      'description' => 'Lookcity',
      'type' => 'text',
      'min_len' => 0,
      'max_len' => 100,
      'blank_ok' => 1,
      'duplicate_ok' => 1,
    ),
    'lookzip' => 
    array (
      'name' => 'lookzip',
      'description' => 'Lookzip',
      'type' => 'text',
      'min_len' => 0,
      'max_len' => 100,
      'blank_ok' => 1,
      'duplicate_ok' => 1,
    ),
    'lookradius' => 
    array (
      'name' => 'lookradius',
      'description' => 'Lookradius',
      'type' => 'text',
      'min_len' => 0,
      'max_len' => 5,
      'blank_ok' => 1,
      'duplicate_ok' => 1,
    ),
    'radiustype' => 
    array (
      'name' => 'radiustype',
      'description' => 'Radiustype',
      'type' => 'text',
      'min_len' => 0,
      'max_len' => 5,
      'blank_ok' => 1,
      'duplicate_ok' => 1,
    ),
    'picture' => 
    array (
      'name' => 'picture',
      'description' => 'Picture',
      'type' => 'text',
      'min_len' => 0,
      'max_len' => 1,
      'blank_ok' => 0,
      'duplicate_ok' => 1,
    ),
    'status' => 
    array (
      'name' => 'status',
      'description' => 'Status',
      'type' => 'text',
      'min_len' => 0,
      'max_len' => 20,
      'blank_ok' => 0,
      'duplicate_ok' => 1,
    ),
    'levelend' => 
    array (
      'name' => 'levelend',
      'description' => 'Levelend',
      'type' => 'number',
      'min_len' => 0,
      'max_len' => 11,
      'blank_ok' => 1,
      'duplicate_ok' => 1,
    ),
  ),
);   

      function userData() {
      
         $this->Data($this->config);
      }
   }

?>
