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


   class transactionsData extends Data {

      var $table = TRANSACTIONS_TABLE;

      var $config = array (
  'table' => TRANSACTIONS_TABLE,
  'idField' => 'id',
  'addedMsg' => 'Osdate Transactions %s Added',
  'added_err' => 'Can\\\'t Add Osdate Transactions',
  'editMsg' => 'Osdate Transactions %s Updated',
  'editErr' => 'Can\\\'t Update Osdate Transactions',
  'delErr' => 'Can\\\'t Delete Osdate Transactions',
  'delMsg' => 'Osdate Transactions %s Deleted',
  'blankErr' => 'Osdate Transactions Empty',
  'fields' => 
  array (
    'invoice_no' => 
    array (
      'name' => 'invoice_no',
      'description' => 'Invoice No',
      'type' => 'text',
      'min_len' => 0,
      'max_len' => 100,
      'blank_ok' => 1,
      'duplicate_ok' => 1,
    ),
    'user_id' => 
    array (
      'name' => 'user_id',
      'description' => 'User Id',
      'type' => 'number',
      'min_len' => 0,
      'max_len' => 11,
      'blank_ok' => 1,
      'duplicate_ok' => 1,
    ),
    'txn_id' => 
    array (
      'name' => 'txn_id',
      'description' => 'Txn Id',
      'type' => 'text',
      'min_len' => 0,
      'max_len' => 254,
      'blank_ok' => 1,
      'duplicate_ok' => 1,
    ),
    'payment_email' => 
    array (
      'name' => 'payment_email',
      'description' => 'Payment Email',
      'type' => 'text',
      'min_len' => 0,
      'max_len' => 100,
      'blank_ok' => 1,
      'duplicate_ok' => 1,
    ),
    'from_membership' => 
    array (
      'name' => 'from_membership',
      'description' => 'From Membership',
      'type' => 'number',
      'min_len' => 0,
      'max_len' => 4,
      'blank_ok' => 1,
      'duplicate_ok' => 1,
    ),
    'to_membership' => 
    array (
      'name' => 'to_membership',
      'description' => 'To Membership',
      'type' => 'number',
      'min_len' => 0,
      'max_len' => 4,
      'blank_ok' => 1,
      'duplicate_ok' => 1,
    ),
    'amount_paid' => 
    array (
      'name' => 'amount_paid',
      'description' => 'Amount Paid',
      'type' => 'amount',
      'min_len' => 0,
      'max_len' => 22,
      'blank_ok' => 1,
      'duplicate_ok' => 1,
    ),
    'txn_date' => 
    array (
      'name' => 'txn_date',
      'description' => 'Txn Date',
      'type' => 'date',
      'min_len' => 0,
      'max_len' => 10,
      'blank_ok' => 1,
      'duplicate_ok' => 1,
    ),
    'payment_mod' => 
    array (
      'name' => 'payment_mod',
      'description' => 'Payment Mod',
      'type' => 'text',
      'min_len' => 0,
      'max_len' => 100,
      'blank_ok' => 1,
      'duplicate_ok' => 1,
    ),
    'payment_status' => 
    array (
      'name' => 'payment_status',
      'description' => 'Payment Status',
      'type' => 'text',
      'min_len' => 0,
      'max_len' => 100,
      'blank_ok' => 1,
      'duplicate_ok' => 1,
    ),
    'payment_vars' => 
    array (
      'name' => 'payment_vars',
      'description' => 'Payment Vars',
      'type' => 'text',
      'min_len' => 0,
      'max_len' => 65535,
      'blank_ok' => 1,
      'duplicate_ok' => 1,
    ),
  ),
);   

      function transactionsData() {
      
         $this->Data($this->config);
      }
   }

?>
