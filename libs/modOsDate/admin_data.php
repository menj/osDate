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


   class adminData extends Data {

      var $table = ADMIN_TABLE;

      var $config = array (
  'table' => ADMIN_TABLE,
  'idField' => 'id',
  'addedMsg' => 'Osdate Admin %s Added',
  'added_err' => 'Can\\\'t Add Osdate Admin',
  'editMsg' => 'Osdate Admin %s Updated',
  'editErr' => 'Can\\\'t Update Osdate Admin',
  'delErr' => 'Can\\\'t Delete Osdate Admin',
  'delMsg' => 'Osdate Admin %s Deleted',
  'blankErr' => 'Osdate Admin Empty',
  'fields' => 
  array (
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
    'fullname' => 
    array (
      'name' => 'fullname',
      'description' => 'Fullname',
      'type' => 'text',
      'min_len' => 0,
      'max_len' => 100,
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
    'super_user' => 
    array (
      'name' => 'super_user',
      'description' => 'Super User',
      'type' => 'text',
      'min_len' => 0,
      'max_len' => 1,
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

      function adminData() {
      
         $this->Data($this->config);
      }
   }

?>
