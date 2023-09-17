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


include_once(LIB_DIR . "/validation_class.php") ;

class Poll {

  var $valid;              // Validation class
  var $osDB;                 // Db class
  var $errorMessage;
  var $qdata;             // Question data
  var $odata;             // Option data
  var $adata;             // Answer data

  function Poll() {

    $this->valid =& new Validation();
    $this->osDB    =& $GLOBALS['osDB'];
    $this->setDefaultQuestion();
    $this->setDefaultAnswer();
    $this->setDefaultOption();
  }
  function setDefaultQuestion() {

      $this->data = array(
         'id' => 0,
         'storyid' => 0,
         'question' => '',
      );
  }
  function setDefaultOption() {

      $this->data = array(
         'id' => 0,
         'questionid' => 0,
         'answer' => '',
      );
  }
  function setDefaultAnswer() {

      $this->data = array(
         'id' => 0,
         'storyid' => 0,
         'answer' => '',
      );
  }
  function deletePoll($id) {
    $this->osDB->query("DELETE FROM ! WHERE id = ?", array(POLL_QUESTION_TABLE,$id));
    $this->osDB->query("DELETE FROM ! WHERE questionid = ?", array(POLL_OPTION_TABLE,$id));
    $this->osDB->query("DELETE FROM ! WHERE questionid = ?", array(POLL_ANSWER_TABLE,$id));
  }
  function multipleDeleteStory($ids) {

    foreach ( $ids AS $key => $value ) {

        $this->deletePoll($value);
    }
  }
  function getAllPolls($userid) {


    return $this->osDB->getAll(" SELECT
                  q.id,
                  q.userid,
                  q.question,
                  q.active,
                  LEFT(question,75) AS short_question,
                  IF(active = 1,'Y','N') AS active_yn,
                  IF( COUNT(DISTINCT a.id) = '','0', COUNT(DISTINCT a.id)) AS responses
          FROM ! q
          LEFT JOIN ".POLL_ANSWER_TABLE." a ON q.id = a.questionid
          WHERE  q.userid = ?
          GROUP BY q.id
          ORDER by question DESC", array( POLL_QUESTION_TABLE, $userid ) );
  }
  function validateQuestion() {

     //$field_name ,$desc ,$type ,$min_len, $max_len, $blank_ok, $duplicate_ok) {
     if ( ! $this->valid->validate('question'  ,'Question'  ,'text'   ,5 ,255   ,0, 1) ) {

        $this->setErrorMessage($this->valid->get_error_message() );
     }
  }
  function validateActive() {

     //$field_name ,$desc ,$type ,$min_len, $max_len, $blank_ok, $duplicate_ok) {
     if ( ! $this->valid->validate('active'  ,'Active'  ,'number'   ,1 ,1   ,0, 1) ) {

        $this->setErrorMessage($this->valid->get_error_message() );
     }
  }
  function validateOption($option) {

      $this->valid->data_in['option'] = $option;

     //$field_name ,$desc ,$type ,$min_len, $max_len, $blank_ok, $duplicate_ok) {
     if ( ! $this->valid->validate('option'  ,"Option: " . $option  ,'text'   ,5 ,255   ,0, 1) ) {

        $this->setErrorMessage($this->valid->get_error_message() );
     }
  }
  function validateUserId() {

     //$field_name ,$desc ,$type ,$min_len, $max_len, $blank_ok, $duplicate_ok) {
     if ( ! preg_match("/^\d+$/", $this->qdata['userid']) ) {

        $this->setErrorMessage("Invalid user id");
     }
  }
  function validateQuestionId() {

     //$field_name ,$desc ,$type ,$min_len, $max_len, $blank_ok, $duplicate_ok) {
     if ( ! preg_match("/^\d+$/", $this->qdata['id']) ) {

        $this->setErrorMessage("Invalid question id");
     }
  }
  function addPoll($userid) {

   global $config;

   $this->qdata = array(
      'userid'         => $userid,
      'question'       => trim($_POST['question']),
      'active'         => 0,
   );
    $options = $_POST['option'];

    $count = 0;

    // Validate options
    foreach ($options AS $o ) {

      if ( trim($o) != '' ) {

        $count++;
        $this->validateOption($o);
      }
    }

    if ( $count < 2 ) {

        $this->setErrorMessage("You must give at least two options");
    }
    $this->validateQuestion();
    $this->validateUserId();


    // Actually add record if no errors
    //
    if ( ! $this->getErrorMessage() ) {

      $this->osDB->autoExecute(POLL_QUESTION_TABLE, $this->qdata);

      $odata['questionid'] = $this->osDB->getOne("SELECT LAST_INSERT_ID()" );


      foreach ($options AS $o ) {

        // If the option is not blank, add it
        if ( trim($o) != '' ) {

          $odata['answeroption'] = $o;
          $this->osDB->autoExecute(POLL_OPTION_TABLE, $odata);
        }
      }
    }
  }
  function editPoll($questionid) {

   $this->qdata = array(
      'id'             => $questionid,
      'question'       => trim($_POST['question']),
      'active'         => $_POST['active'],
   );
    $options = $_POST['option'];

    // Validate options
    $this->odata = array();
    $ctr = 0;
    foreach ($options AS $key => $o ) {

        $this->odata[$ctr]['option'] = $o;
        $this->odata[$ctr]['id']     = $key;

        $this->validateOption($o);
        $ctr++;
    }
    $this->validateQuestion();
    $this->validateQuestionId();
    $this->validateActive();

   if ( ! $this->getErrorMessage() ) {

      $this->osDB->autoExecute(POLL_QUESTION_TABLE, $this->qdata, DB_AUTOQUERY_UPDATE, "id = '$questionid'");

      foreach ($options AS $key => $o ) {

          $odata['answeroption'] = $o;
          $this->osDB->autoExecute(POLL_OPTION_TABLE, $odata, DB_AUTOQUERY_UPDATE, "id = '$key'");
      }
    }
  }
  function saveVote($userid) {

    // If there's a poll id and it's a number and there's a option and it's a number
    //
    if ( $_POST['questionid'] && preg_match("/^\d+$/", $_POST['questionid'] ) &&  $_POST['option'] && preg_match("/^\d+$/", $_POST['option'] ) ) {

        $data['optionid']   = $_POST['option'];
        $data['questionid'] = $_POST['questionid'];
        $data['userid']     = $userid;
        $answ_id = $this->osDB->getOne( "SELECT id FROM ! WHERE  userid = ? AND questionid = ?", array( POLL_ANSWER_TABLE, $data['userid'], $data['questionid'] ) );

        // If record exists, update it.
        if ( $answ_id ) {

            $this->osDB->autoExecute(POLL_ANSWER_TABLE, $data, DB_AUTOQUERY_UPDATE, "id = '$answ_id'");
        }
        // Otherwise, add it
        else {

            $this->osDB->autoExecute(POLL_ANSWER_TABLE, $data);
        }
    }

  }
  function loadQuestion($questionid) {

     $this->qdata =  $this->osDB->getRow( "SELECT * FROM ! WHERE id = ? ", array( POLL_QUESTION_TABLE, $questionid ) );
  }
  function loadRandQuestion($userid) {

     $this->qdata =  $this->osDB->getRow("SELECT * FROM ! WHERE active = 1 AND userid = ? ORDER BY RAND() ", array( POLL_QUESTION_TABLE,  $userid) );
  }
  function loadOption($questionid) {

     $this->odata = $this->osDB->getAll("SELECT * FROM ! WHERE questionid = ? ORDER BY id", array( POLL_OPTION_TABLE, $questionid ) );
  }
  function loadAnswer($questionid) {

     $this->adata = $this->osDB->getAll("SELECT
                    o.id,
                    a.optionid,
                    o.answeroption,
                    COUNT(a.id) AS votes
            FROM ! o
            LEFT JOIN ".POLL_ANSWER_TABLE." a ON a.optionid = o.id AND a.questionid = o.questionid
            WHERE o.questionid = ?
            GROUP BY o.answeroption
            ORDER BY o.answeroption", array(POLL_OPTION_TABLE , $questionid ) );

  }
  function loadPoll($questionid) {

     $this->loadQuestion($questionid);
     $this->loadOption($questionid);
     $this->loadAnswer($questionid);
  }
  // Loads a random active poll, if one exists
  function loadRandPoll($userid) {

     $this->loadRandQuestion($userid);

	if (isset($this->qdata['id']) ) {
	     $this->loadOption($this->qdata['id']);
	     $this->loadAnswer($this->qdata['id']);
	}
  }
  // Makes the poll data form friendly
  //
  function prepPoll() {

    $this->prepQuestion();
    $this->prepOption();
    $this->prepAnswer();
  }
  function prepQuestion() {

      foreach ( $this->qdata AS $key => $value ) {

          $this->qdata[$key] = $this->formFriendly($value);
      }
  }
  function prepOption() {

      foreach ( $this->odata AS $id => $row ) {

        foreach ( $row AS $key => $value ) {

          $this->odata[$id][$key] = $this->formFriendly($value);
        }
      }
  }
  function prepAnswer() {

      foreach ( $this->adata AS $id => $row ) {

        foreach ( $row AS $key => $value ) {

          $this->adata[$id][$key] = $this->formFriendly($value);
        }
      }
  }
  function getQuestion() {

    return $this->qdata;
  }
  function getOption() {

    return $this->odata;
  }
  function getAnswer() {

    return $this->adata;
  }
  // Prepares data to display in a form
  //
  function formFriendly($string) {

    return htmlentities(stripslashes($string), ENT_QUOTES);
  }
  function setErrorMessage($message) {

    $this->errorMessage = $message;
  }
  function getErrorMessage() {

    return $this->errorMessage;
  }

}