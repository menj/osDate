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


   class userRatingData extends Data {

      var $table = USER_RATING_TABLE;

      var $config = array (
  'table' => USER_RATING_TABLE,
  'idField' => 'id',
  'addedMsg' => 'Osdate Userrating %s Added',
  'added_err' => 'Can\\\'t Add Osdate Userrating',
  'editMsg' => 'Osdate Userrating %s Updated',
  'editErr' => 'Can\\\'t Update Osdate Userrating',
  'delErr' => 'Can\\\'t Delete Osdate Userrating',
  'delMsg' => 'Osdate Userrating %s Deleted',
  'blankErr' => 'Osdate Userrating Empty',
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
    'profileid' => 
    array (
      'name' => 'profileid',
      'description' => 'Profileid',
      'type' => 'number',
      'min_len' => 0,
      'max_len' => 11,
      'blank_ok' => 0,
      'duplicate_ok' => 1,
    ),
    'rating' => 
    array (
      'name' => 'rating',
      'description' => 'Rating',
      'type' => 'number',
      'min_len' => 0,
      'max_len' => 11,
      'blank_ok' => 0,
      'duplicate_ok' => 1,
    ),
    'rate_time' => 
    array (
      'name' => 'rate_time',
      'description' => 'Rate Time',
      'type' => 'number',
      'min_len' => 0,
      'max_len' => 32,
      'blank_ok' => 0,
      'duplicate_ok' => 1,
    ),
    'ratingid' => 
    array (
      'name' => 'ratingid',
      'description' => 'Ratingid',
      'type' => 'number',
      'min_len' => 0,
      'max_len' => 11,
      'blank_ok' => 1,
      'duplicate_ok' => 1,
    ),
    'comment' => 
    array (
      'name' => 'comment',
      'description' => 'Comment',
      'type' => 'text',
      'min_len' => 0,
      'max_len' => 250,
      'blank_ok' => 1,
      'duplicate_ok' => 1,
    ),
    'reply' => 
    array (
      'name' => 'reply',
      'description' => 'Reply',
      'type' => 'text',
      'min_len' => 0,
      'max_len' => 250,
      'blank_ok' => 1,
      'duplicate_ok' => 1,
    ),
    'comment_date' => 
    array (
      'name' => 'comment_date',
      'description' => 'Comment Date',
      'type' => 'date',
      'min_len' => 0,
      'max_len' => 10,
      'blank_ok' => 1,
      'duplicate_ok' => 1,
    ),
    'rating_date' => 
    array (
      'name' => 'rating_date',
      'description' => 'Rating Date',
      'type' => 'date',
      'min_len' => 0,
      'max_len' => 10,
      'blank_ok' => 1,
      'duplicate_ok' => 1,
    ),
  ),
);   

      function userRatingData() {
      
         $this->Data($this->config);
      }
   }

?>
