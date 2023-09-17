<?php
//##############################################################################
// File:         $Source: /home/cvs/osdate/libs/modOsDate/data.php,v $
//
// RCS:          $Header: /home/cvs/osdate/libs/modOsDate/data.php,v 1.7 2006/07/22 16:41:39 cvs Exp $
//
// Modified:     $Date: 2006/07/22 16:41:39 $
//
// By:           $Locker:  $
//
//
//##############################################################################

include_once(MODOSDATE_DIR."db_class.php");
include_once(LIB_DIR . "validation_class.php");

class Data {

   var $osDB;     // Database Object Reference
   var $_tableName;  // Name of Table
   var $_dbName; // Name of database
   var $message = array();     // Last Message
   var $_error = FALSE;
   var $_data;  // Array that holds the row data
   var $valid;        // Validation Class
   var $id;   // Service id number used on current query
   var $fields;
   var $_idField;
   var $form = FALSE; // Output data compatable with a form
   var $config;
   var $rows;
   var $request_vars;
   var $_eof = true;
   var $_nextPage;         // The next page to display
   var $_ignoreField = array();   // An array of fields to ignore when adding
               // a row
   var $_deleteRows;       // The number of rows that was available to delete
   var $_EmptySetDeleteOk = false; // Indicates if an error should be reported if there are no rec found to delete
   var $sort_process;      // The name of the process for the list page to sort
   var $_DataRows;                 // Array of data from a row mode add or edit;
   var $_insertId = false; // this insert id for the last insert
   var $_table_prefix;  // Prefix to database table

    # Constructor for Option Name object
   // Call with a config array as described above, or with a table name
   //
   function Data($table) {

      if ( is_array($table) ) {

         $this->config = $table;
         $this->db = new myDb();
         $this->setTableName($this->config['table']);
         $this->setIdField($this->config['idField']);
      }
      else {

            $this->setTableName($table);


            $this->db = new myDb();
            $this->setIdField('id');


            $this->makeConfig();
      }
      if (isset($this->config['fields']) ) {
	      $this->fields     = $this->config['fields'];
	   }
      // Initilize Validation
      //
      $this->valid      = new Validation($this->db);
      $this->valid->db_table  = $this->getDbTableName();

   }
   // Indicates if an error should be reported if there are no rec found to delete
   //
   function setEmptySetDeleteOk() {

      $this->_EmptySetDeleteOk = true;
   }
   function clrEmptySetDeleteOk() {

      $this->_EmptySetDeleteOk = false;
   }
   function getEmptySetDeleteOk() {

      return $this->_EmptySetDeleteOk;
   }
   function getIdField() {

     return $this->_idField;
   }
   function setIdField($field) {

      $this->_idField  = $field;
      $this->valid->id_field = $field;
   }
    function getInsertId() {

      return $this->_insertId;
    }
    // Works
    //
   //  Example:
   //            $data['name'] = 'isdn_address';
   //            $data['description'] = "ISDN Address";
   //            $data['amount'] = 5.95;
   //            $data = $serv->add_service($data);
   //            if ( $serv->error ) {
   //
   //                print "Error: $serv->message\n";
   //            }
   //
    function insertQuery($data,$print = 0) {

      $this->setEof();
      $result  = $this->db->insert_query($data, $this->getDbTableName(), $print);

      if ( $this->getIdField() != "" ) {

          $this->_insertId     = $this->db->get_insert_id($this->getIdField());
      }

      if ( ! $result ) {

         $this->setErrorMessage( $this->getAddErrorMsg() );
      }
      return $result;
   }
    function addRec($data, $opt = false, $print = 0) {


         $this->setEof();

         if (  ! is_array($opt) || ! array_key_exists('novalidate',$opt) ) {

            $this->validateData($data);
         }

         if ( ! $this->valid->error ) {


            if ( ! is_array($opt) ||  ! array_key_exists('nosave',$opt) ) {
               $this->setData( $this->valid->data_out );
               $this->insertQuery( $this->getData() , $print);

            }
         }
         else {

            $this->setErrorMessage($this->valid->get_error_message() );
            $this->setData( $data );

         }

         return $this->getData();
    }
    // Sets the error flag and adds a message
    //
    function setErrorMessage($message) {

       $this->setError();
       $this->setMessage($message);
    }
    // Sets error flag and sets failur page info
    //
    function isError() {

       return $this->_error;
    }
    function getError() {

       return $this->_error;
    }
    // Sets error flag and sets failur page info
    //
    function setError($error = true) {

         if ( $error ) {

            $this->_error = true;
         }
         else {

            $this->clrError();
         }
    }
    // Clears error flag and sets success page info
    //
    function clrError() {

      $this->_error = false;
    }

    function editRec($data, $opt = false,$print = 0) {

        $data = $this->_editRec($data,$opt, $print);

        return $data;
    }
    function _editRec($data, $opt = false,$print = 0) {


      if ( is_array($opt)  ) {

         $key_field = '';

         if ( array_key_exists('key_field',$opt) ) {

            $key_field = $opt['key_field'];
            $this->valid->key_field($key_field);
         }
      }
      elseif ( is_string($opt) ) {

         $key_field = $opt;
         $this->valid->key_field($key_field);
         $opt = array();
      }
      else {

         $key_field = false;
         $this->valid->key_field($this->getIdField());
         $opt = array();

      }

      $this->setEof();
      $this->setData( $data );


      // Don't validate if this is set
      //
      if ( ! array_key_exists('novalidate',$opt) ) {

         $this->validateData($data,"update");
      }

      if ( ! $this->valid->error ) {


         if ( ! array_key_exists('nosave',$opt) ) {
            $save_data        = $this->valid->data_out;
            // Get the key to use for updating
            //
            if ( $key_field != "" ) {

               $key[$key_field] = $data[$key_field];
            }
            else {

               $key[$this->getIdField()]     = $data[$this->getIdField()];
            }

            $result = $this->updateQuery($save_data, $key, $print);

            if ( $result ) {

               // just to keep php from generating a warning about this missing key
               if ( ! array_key_exists($this->getIdField(), $data) ) {

                  $data[$this->getIdField()] = '';
               }

               $this->setMessage( $this->getIdMessage( $this->getEditMsg(), $data[ $this->getIdField() ] ) );
            }
            else {
               $this->setErrorMessage($this->getEditErrorMsg() );
            }
         }
      }
      else {

            $this->setErrorMessage( $this->valid->get_error_array() );
            $this->setData( $data );
      }
       return $this->getData();
   }
   function formatArray($data) {

      $data_out = array();

      foreach ( $data AS $key => $value ) {

         foreach ( $value AS $k => $v ) {

            $data_out[$k][$key] = $v;
         }
      }
      return $data_out;
   }
   function addRecRows($data, $opt = false,$print = 0) {


      // Get options
      if ( is_array($opt) ) {

         if ( array_key_exists('key_field',$opt) ) {

            $key_field = $opt['key_field'];
         }
      }
      else {

         $opt = array();
      }
      $this->setEof();
      $error = false;
      $message = "";
      $all_blank = true;


      // Validate all records
      //
      foreach( $data as $key => $record ) {


         if ( array_key_exists('empty_lines',$opt) && $this->allBlank($record) ) {

            // Remove the line so it's not saved
            //
            unset($data[$key]);
         }
         else {

            $this->validateData($record);

            // If there's one error, it's all an error
            //
            if ( $this->valid->error ) {

               $error = true;
               $message .= "Line " . $key . ": " . $this->valid->error_message . "<br>";
            }
            $all_blank = false;
         }
      }

      $this->setData( $data );

      if ( ! $error) {

         if ( ! array_key_exists('nosave',$opt) ) {

            foreach( $data as $record ) {


               $save_data = $record;

               $this->insertQuery($save_data, $print);
               $this->_DataRows[$this->_insertId] = $save_data;

               // If there's one error, it's all an error
               //
               if ( $this->isError() ) {

                  $error = true;
                  $message .= $this->Message() . "<br>";
               }
            }
         }
         $this->setMessage($message);
         $this->setError($error);
      }
      else {

         $this->setErrorMessage($message);

         foreach ( $data AS $id => $rec ) {

            $data[$id] = $rec;
         }

         $this->setData( $data );
      }

      if ( $all_blank ) {

         $this->setErrorMessage($this->getBlankErrorMsg() );

      }

      return $this->getData();
   }
   // An overridable method to do something on the data before it is validates and adds.
   // For example set default data
   //
   function preRowAdd($data) {

      return $data;
   }
   function setMessage($message) {

      if ( is_array($message) ) {

         $this->message = array_merge($this->message, $message);
      }
      else {

         $this->message[$message] = $message;
      }
   }
   function clrMessage() {

      //$this->message = "";
   }
   function Message() {

      return join('<br>', $this->message);
   }
   // Adds additional items that if found in field is considered duplicate
   //
   function addDuplicate($field,$value) {

      $this->valid->add_duplicate($field,$value);
   }
   // Adds sets of fields that must be unique.  Accepts a field name or an array of field names
   //
   function addDuplicateSet($field) {

      $this->valid->add_duplicate_field_set($field);
   }
   function getMessage() {

      return $this->Message();
   }
        // Overridable method to do something before saving the rows
        //
   function preEditRecRows($data, $opt = false, $print = 0) {

       return $data;
   }
   // editRec_rows($data,$key_field)
   //
   // or
   //
   // editRec_rows($data,$opt_array)
   //
   // $opt_array = array(
   //         empty_lines   => true,   // Allow empty data lines
   //         nosave      => true,   // Don't save data to db
   //         common_key   => array('order_id' => 5), // apply to all records
   //       )
   //
   function editRecRows($data, $opt = false, $print = 0) {

      if ( is_array($opt) ) {

         if ( array_key_exists('key_field',$opt) ) {

            $key_field = $opt['key_field'];
         }
      }
      else {

         $key_field = '';
         $opt = array();
      }

      $this->setEof();
      $error = false;
      $message = "";
      $all_blank = true;

      // Validate all records
      //
      foreach( $data as $key => $record ) {

         if ( array_key_exists('empty_lines',$opt) && $this->all_blank($record) ) {

            // Remove the line so it's not saved
            //
            unset($data[$key]);
         }
         else {

            $this->validateData($record, "update");
            $save_data[$key]        = $this->valid->data_out;

            // If there's one error, it's all an error
            //
            if ( $this->valid->error ) {

               $error = true;
               $message .= "Line " . $key . ": " . $this->valid->error_message . "<br>";
            }
            $all_blank = false;
         }
      }

      $this->setData( $data);

      if ( ! $error) {

                        // Go ahead and save the data
         if ( ! array_key_exists('nosave',$opt) ) {

            foreach( $save_data as $key => $save ) {


               if ( $data[$key][$this->getIdField()] ) {

                   $id_key[$this->getIdField()] = $data[$key][$this->getIdField()];
                   $save[$this->getIdField()]   = $data[$key][$this->getIdField()];
               }
               else {

                   $id_key[$this->getIdField()] = $key;
                   $save[$this->getIdField()] = $key;
               }
;
               $result = $this->updateQuery($save, $id_key, $print);

               if ( ! $result ) {

                  $this->setErrorMessage($this->getEditErrorMsg() );
               }
               // If there's one error, it's all an error
               //
               if ( $this->isError() ) {

                  $error = true;
                  $message .= $this->Message() . "<br>";
               }
            }
         }
         // Just run the pre update methods
         //
         else {

            foreach( $save_data as $key => $save ) {

               $id_key[$this->getIdField()] = $data[$key][$this->getIdField()];
               $save[$this->getIdField()] = $data[$key][$this->getIdField()];

            }
         }
         $this->setMessage($message);
         $this->setError($error);
      }
      else {

         $this->setErrorMessage($message);
         $this->setData( $data  );
      }

      if ( $all_blank ) {

         $this->setErrorMessage($this->getBlankError() );

      }
      elseif ( $this->isError() ) {

         $this->setErrorMessage($this->getEditErrorMsg() );
      }
      else {

         $this->setMessage($this->getEditMsg() );
      }
      return $this->getData();
   }
   // When validating rows, this is a field to ignore to determine if the row is all blank
   //
   function addIgnoreField($fieldname) {

      $this->_ignoreField[] = $fieldname;
   }
   function getIgnoreFields() {

      return $this->_ignoreField;
   }
   // Returns true if all array values are blank
   //
   function allBlank($array) {

      $blank = true;

      foreach( $array as $key => $value ) {

         if ( $value != '' && $key != $this->getIdField()  && ! in_array($key, $this->getIgnoreFields() ) ) {

            $blank = false;
         }
      }
      return $blank;
   }
    function validateData($data, $mode = "") {


      $this->valid->reset();
      $this->clrError();
      $this->clrMessage();
      $this->valid->data_in       = $data;

      if ( $mode == "update" ) {

         $this->validateGivenFields();
      }
      else {

         $this->validateAllFields();
      }
      return $this->valid;
   }
    function validateGivenFields() {

         $data = $this->valid->data_in;

         $key_array = array_keys($this->fields);

         while (list($index, $key) = each ($key_array)) {

            if ( $key != $this->getIdField() ) {

               $field  = $this->fields[$key];

               // Only validate if it's a field that's already defined.  If it's a type date, it's been defined
               //
               if ( array_key_exists('type', $field) && $field['type'] == 'password' && $data[$key] ) {

                   $this->valid->validate_password($field['min_len'],$field['max_len'],$field['name'],$field['name'] . '2');
               }
               elseif ( isset($data[$key])
                  || (
                     array_key_exists('type', $field)
                     && $field['type'] == 'time'
                     && array_key_exists($key . "_hours", $data)
                     && $data[$key . "_hours"] != ""
                     && array_key_exists($key . "_minutes", $data)
                     && $data[$key . "_minutes"] != ""
                     && array_key_exists($key . "_am_pm", $data)
                     && $data[$key . "_am_pm"] != ""
                  )
                  || (
                     array_key_exists('type', $field)
                     && $field['type'] == 'date'
                     && array_key_exists($key . "_m", $data)
                     && $data[$key . "_m"] != ""
                     && array_key_exists($key . "_y", $data)
                     && $data[$key . "_y"] != ""
                     && array_key_exists($key . "_d", $data)
                     && $data[$key . "_d"] != ""
                  )
                  || (
                     array_key_exists('type', $field)
                     && $field['type'] == 'cc_exp'
                     && array_key_exists($key . "_m", $data)
                     && $data[$key . "_m"] != ""
                     && array_key_exists($key . "_y", $data)
                     && $data[$key . "_y"] != ""
                  )
               ) {
                  // Just to fix warnings about non-existant keys
                  $default = array( 'name' => '', 'description' => '', 'type' => '', 'min_len' => '', 'max_len' => '', 'blank_ok' => '', 'duplicate_ok' => '');

                  $field = array_merge($default, $field);


                  $this->valid->validate($field['name'], $field['description'], $field['type'], $field['min_len'], $field['max_len'], $field['blank_ok'], $field['duplicate_ok']);
               }
            }
         }
    }
       function validateAllFields() {

      $data_def                   = $this->fields;

      $f = array(
         'name'      => '',
         'description'   => '',
         'type'      => '',
         'min_len'   => '',
         'max_len'   => '',
         'blank_ok'   => '',
         'duplicate_ok'   => '',
      );
      while (list($key, $field) = each ($data_def)) {

         // Keeps php from complaining about missing fields
         $field = array_merge($f,$field);

         if ( $field['type'] == 'password' ) {

            $this->valid->validate_password($field['min_len'],$field['max_len'],$field['name'],$field['name'] . '2');
         }
         else {

            $this->valid->validate($field['name'], $field['description'], $field['type'], $field['min_len'], $field['max_len'], $field['blank_ok'], $field['duplicate_ok']);
         }
      }

      // If a id field value is provided, validate it
      //
      if ( array_key_exists($this->getIdField(), $this->valid->data_in)
       &&  $this->valid->data_in[ $this->getIdField() ] ) {

         $this->valid->validate($this->getIdField(), $this->nameToDescription($this->getIdField()), 'number', '1', '11', '0', '0');
      }
   }
   function getFieldMessage($field) {

      return $this->valid->get_field_error($field);
   }
   function setEof() {

      $this->_eof = true;
   }
   function clrEof() {

      $this->_eof = false;
   }
   function getEof() {

      return $this->_eof;
   }
   function getRow($sql,$print = 0) {

      $this->setEof();

      $data =  $this->db->get_row($sql,$print);



      $this->setData($data);


      return $data;
   }
   function getField($field, $sql,$print = 0) {

      $data = $this->db->getOne($sql,$print);

      return $data;
   }
   function query($sql,$print = 0) {

      $this->setEof();
             return $this->db->query($sql,$print);
   }
        // Overridable method to change data before an update
        //
   function updateQuery($data, $key, $print = 0)  {

             return $this->_updateQuery($data, $key, $print) ;
   }
   function _updateQuery($data, $key, $print = 0)  {


      $this->setEof();

      $table = $this->getDbTableName();



       $result = $this->db->update_query($data, $this->getDbTableName(), $key, $print) ;
      return $result;
   }
 /**
   * Delete the specified record
   *
   * @param string|array $id either the id for the _idField or a array.  If the id = all, everything is deleted.
   * @return
   * @access public
   */
   function deleteRec($id,$confirm = false,$print = 0) {

      $this->clrError();
      $this->setEof();

      $where = $this->where($id);

      $this->_deleteRows = $this->db->not_empty("SELECT * FROM " . $this->getDbTableName() . " $where",$print);

      if ( ( $where || $confirm ) && $this->_deleteRows ) {

         $this->db->query("DELETE FROM " . $this->getDbTableName() . " $where",$print);
         $rval = true;

         //$this->setMessage($this->getIdMessage($this->getDelMsg()));
      }
      elseif ( $this->getEmptySetDeleteOk() ) {

         $rval = true;
     }
     else {

         $rval = false;
         $this->setErrorMessage($this->getDelErrorMsg());
      }
      return $rval;
   }
   // After running a delete, returns the number of rows there was to delete
   //
   function getDeleteRows() {

      return $this->_deleteRows;
   }
   // Adds the record number to the message by figuring out if the id
   // is in a array or passed as a number
   //
   function getIdMessage($message,$id) {

      if ( is_array($id) ) {

         $number = $id[ $this->getIdField() ];
      }
      else {

         $number = $id;
      }
      return sprintf($message,$number);
   }
   function deleteAllData($sure) {

         $this->setEof();
           $this->clrError();

           if ( $sure == "Y" ) {

               $this->db->query("DELETE FROM " . $this->getDbTableName() . "",0);
               $rval = true;
               $this->setMessage($this->config['delMsg']);
           }
           else {

               $rval = false;
               $this->setErrorMessage("Syntax Error:  To delete all records pass a 'Y'");
           }
           return $rval;
   }
   function rewindRec() {

      $this->setEof();
   }
   //
   function _initQuery($sql, $print = 0) {


         $this->db->query( $sql,$print);
         $this->clrEof();
         $this->rows = 0;
   }
   function buildSql($search = "",$fields = false,$sort = "", $print = 0, $limit = false) {

      $order_by = "";
      if ( $sort != "" ) {

         $order_by = " ORDER BY $sort ";
      }
      if ( is_array($fields) ) {

         $fld = join(',',$fields);
      }
      else {
         $fld = '*';
      }
      $sql = "SELECT $fld FROM " . $this->getDbTableName() . " " . $this->where($search) . $order_by;

      if ( $limit ) {

         $sql .= " LIMIT $limit";
      }
      return $sql;
   }
   function _initList($search = "",$fields = false,$sort = "", $print = 0, $limit = false) {

      $sql = $this->buildSql($search,$fields,$sort, $print, $limit);

      $this->db->query($sql,$print);
      $this->clrEof();
      $this->rows = 0;

   }
   function displayPrevious($page,$values) {

      return $this->more->display_previous($page,$values);
   }
   function displayNext($page,$values) {

      return $this->more->display_next($page,$values);
   }
   function where($search = "") {

      if ( is_array($search) ) {  // Search by array key/value matches

                 $where =  $this->db->where_statement($search);
      }
      elseif ( $search > 0 ) {  // Search by id number

                 $where =  "WHERE " . $this->getIdField() . " = '$search'";
      }
      else {  // list all

                 $where = "";
      }
      return $where;
   }
/*
    while ( $data = $dc->listRec() ) {

       while (list($key, $value) = each ($data)) {

                print "$key: " . $value . "\n";
       }
       print "\n";
    }
*/
    function listRec($search = false,$opt = false,$print = 0) {

         $fields = false;
         $sort = false;
         $limit = false;
         if ( is_array($opt) ) {

            if ( array_key_exists('fields', $opt) ) {
                $fields = $opt['fields'];
            }
            if ( array_key_exists('sort', $opt) ) {
               $sort = $opt['sort'];
            }
            if ( array_key_exists('print', $opt) ) {
               $print = $opt['print'];
            }
            if ( array_key_exists('limit', $opt) ) {
               $limit = $opt['limit'];
            }
         }

         if ( $this->getEof() ) {

            $this->_initList($search,$fields,$sort,$print,$limit);
         }
         // Read database
         //

         if ( $this->notEmpty() ) {

            $this->getRowArray();
         }
         else {

            $this->setData( array() );
            $this->setEof();
         }

         return $this->getData();
    }
    function getRowArray() {


         $data_out = $this->db->get_row_array();


      $this->setData($data_out );

       return $this->getData();
    }

   function isEmpty($where = false, $print = 0) {

      // Run a query if data was given
      //
      if ( $where ) {

         $this->_initList($where,false,false,$print);
      }

      return $this->db->is_empty("",$print);
   }
   function notEmpty($where = false, $print = 0) {

      // Run a query if data was given
      //
      if ( $where ) {

         $this->_initList($where,false,"", $print);
      }
      return $this->db->not_empty(false,$print);
   }
   function getAllRecSql($sql) {

      return $this->db->getAllRows($sql);
   }
   function getAllRec($search = false,$opt = false) {

         $dataout = '';
         $fields = false;
         $sort = false;
         $limit = false;
         $print = false;
         if ( is_array($opt) ) {

            if ( array_key_exists('fields', $opt) ) {
                $fields = $opt['fields'];
            }
            if ( array_key_exists('sort', $opt) ) {
               $sort = $opt['sort'];
            }
            if ( array_key_exists('print', $opt) ) {
               $print = $opt['print'];
            }
            if ( array_key_exists('limit', $opt) ) {
               $limit = $opt['limit'];
            }
         }

         $sql = $this->buildSql($search,$fields,$sort, $print, $limit);;
         return $this->db->getAllRows($sql);
   }
   // Gets one row of data from a matching database record
   //
    function getRec($search,$opt = false, $print = 0) {

            $this->rewindRec();
            $data = $this->listRec($search,$opt, $print);

        return $data;
     }
    // Gets one field of data from a matching database record
    //
     function getRecField($search,$field,$opt = false,$print = 0) {

         $this->setEof();

         // Only search if there really is a value in the search
         //
         if ( is_array($search) || $search > 0 ) {

               $data = $this->getRec($search,$opt,$print);
         }
         else {

            $data[$field] = '';
         }

         if ( isset( $data[$field]) ) {

            $result = $data[$field];
         }
         else {
             $result = false;
         }
           return $result;
     }
     function setRecField($search,$field,$value, $opt = false,$print = 0) {

      $this->setEof();

      // Only search if there really is a value in the search
      //
      if ( is_array($search) || $search > 0 ) {

         $search[$field] = $value;
              $this->editRec($search,$form,$print);

         $result = ! $this->getError();
      }
      else {

         $result = false;
      }
           return $result;
     }
   function translateType($type, $name) {

      if ($type == "string") {

         $type = "text";
      }
      elseif ($type == "blob") {

         $type = "text";
      }
      elseif ($type == "real") {

         $type = "amount";
      }
      elseif ($type == "int") {

         $type = "number";
      }
      return $type;
   }
   function nameToDescription($string) {

      return ucwords(str_replace("_", " ", $string));
   }
   function form_values($form_values) {

      $line = '';

      if ( is_array($form_values) ) {

         while(list($k,$v)=each($form_values)) {

            $line .= "&" . $k . "=$v";
         }
      }
      return $line;
   }
   function now() {

   return date("Y-m-d H:i:s");
   }
   function today() {

   return date("Y-m-d");
   }
   function dumpConfig() {

   return var_export( $this->config, true );
   }
   function setMsg($key, $value) {

         if ( array_key_exists($name, $this->config) ) {

            $this->config[$key] = $value;
         }
   }
   function setEditMsg($string) {

      $this->config['editMsg'] = $string;
   }
   function setAddMsg($string) {

      $this->config['addedMsg'] = $string;
   }
   function getAddMsg() {

      return $this->config['addedMsg'];
   }
   function setEditErrorMsg($string) {

      $this->config['editErr'] = $string;
   }
   function setAddErrorMsg($string) {

      $this->config['addedErr'] = $string;
   }
   function setDelErrorMsg($string) {

      $this->config['delErr'] = $string;
   }
   function setDelMsg($string) {

      $this->config['delMsg'] = $string;
   }
   function getEditMsg() {

      return $this->config['editMsg'];
   }
   function getEditErrorMsg() {

      return $this->config['editErr'];
   }
   function getAddErrorMsg() {

      return $this->config['addedErr'];
   }
   function getDelErrorMsg() {

      return $this->config['delErr'];
   }
   function getDelMsg() {

      return $this->config['delMsg'];
   }
   function setBlankErrorMsg($string) {

      $this->config['blankErr'] = $string;
   }
   function getBlankErrorMsg() {

      return $this->config['blankErr'];
   }
   // See if the table exists.  If it doesn't and the create sql is present, create it
   //
    function numRows() {

      return $this->db->num_rows();
    }
   function makeConfig() {


         $table_name = $this->getTableName();

         $stable_name = $this->nameToDescription($table_name);

         $idField = $table_name . "_id";
         $fields = $this->db->table_info( $this->getDbTableName() );
         //$rows   = $this->db->num_rows();
         //$table = mysql_field_table($result, 0);


         $this->config = array(
                                    'table'     => $table_name,
                                   'idField'  => $table_name . '_id',
                                   'addedMsg' => "$stable_name %s Added",
                                   'added_err' => "Can\'t Add $stable_name",
                                   'editMsg'  => "$stable_name %s Updated",
                                   'editErr'  => "Can\'t Update $stable_name",
                                   'delErr'   => "Can\'t Delete $stable_name",
                                   'delMsg'   => "$stable_name %s Deleted",
                                   'blankErr' => "$stable_name Empty",
                                'fields'    => array()
                            );


         foreach ($fields AS $field ) {

            $type  = $field['type'];
            $name  = $field['name'];
            $type  = $this->translateType($type,$name);
            $len   = $field['len'];
            $flags = explode(' ',$field['flags']);

            $description = $this->nameToDescription($name);

            if (  $idField != $name ) {

                  $field_array[$name] = array(
                                             'name'         => $name,
                                             'description'  => $description,
                                             'type'         => $type,
                                             'min_len'      => 0,
                                             'max_len'      => $len,
                                             'blank_ok'     => $this->isBlankOk($flags),
                                             'duplicate_ok' => $this->isDuplicateOk($flags)
                                 );
            }
         }

         $this->config['fields'] = $field_array;
       //print "<pre>";
       //print_r($this->config);
       //print "</pre>";
   }
   function isblankOk($flags) {

       if ( $this->inArray($flags, 'not_null') ) {

         $blank_ok = 0;
      }
      else {

         $blank_ok = 1;
      }
      return $blank_ok;
   }
   function isDuplicateOk($flags) {

       if ( $this->inArray($flags, 'unique_key') ) {

         $duplicate_ok = 0;
      }
      else {

         $duplicate_ok = 1;
      }
      return $duplicate_ok;
   }

   function inArray($array,$needle) {

      $match = false;

      foreach ($array as $value) {

           if ( $value == $needle) {

            $match = true;
           }
     }
     return $match;
   }
   function setDuplicateFieldMsg($message) {

      $this->valid->set_duplicate_field_set_msg($message);
   }
   function clrDuplicateOk($field) {

      $this->fields[$field]['duplicate_ok'] = 0;
   }
   function setDuplicateOk($field) {

      $this->fields[$field]['duplicate_ok'] = 1;
   }
   function clrBlankOk($field) {

      $this->fields[$field]['blank_ok'] = 0;
   }
   function setBlankOk($field) {

      $this->fields[$field]['blank_ok'] = 1;
   }
   // Sets the data type for a field used in validation and determining the type of form
   //
   function setFieldType($field,$type) {

      $this->fields[$field]['type'] = $type;
   }
   function setFieldName($field,$name) {

      $this->fields[$field]['name'] = $name;
   }
   // Sets the data type for a field used in validation and determining the type of form
   //
   function setFieldDescription($field,$description) {

      $this->fields[$field]['description'] = $description;
   }
   // Defines variables for checkboxes from forms since they don't return anything if not checked
   //
   // Accessor to set the value of a key or the entire array
   //
   function setData($key, $value = false) {

      return $this->_setData($key, $value);
   }
   function _setData($key, $value = false) {

      if ( is_array($key) ) {

         $this->_data = $key;
      }
      else {

         $this->_data[$key] =  $value;
      }
      return $this->_data;
   }
   // Accessor to read the value of a key or the entire array if blank
   //
   function clrData() {

      $this->_data = array();
   }
   function getData($key = false) {

      return $this->_getData($key);
   }
   function getDataRows() {

      return $this->_DataRows;
   }

   function _getData($key = false) {

      $value = false;
      if ( $key && is_array( $this->_data) ) {

         if ( array_key_exists($key, $this->_data ) ) {

            $value = $this->_data[$key];
         }
      }
      else {

         $value = $this->_data;
      }
      return $value;
   }
   function FormatAmount($number) {

      $result = '';
      if ( is_numeric($number) ) {

         $result = sprintf("%0.2f",$number);
      }
      return $result;
   }
   function getTableName($showprefix = true) {

      $name = $this->_tableName;

      if ( $showprefix ) {

        $name = $this->_table_prefix . $this->_tableName;
      }
      return $name;
   }
   function setTableName($name) {

      if ( strpos($name, '.') !== false ) {

         list($osDB, $name) = explode('.', $name);

         $this->setDbName($osDB);
      }
      $this->_tableName = $name;
   }
   function getDbTableName() {

      if ( $this->_dbName ) {

         $table = "$this->_dbName.$this->_tableName";
      }
      else {

         $table = $this->_tableName;
      }
      return $table;
   }
   function getDbName() {

      return $this->_dbName;
   }
   function setDbName($name) {

      $this->_dbName = $name;
   }
   function formatDate($date, $format = "m/d/y H:i") {

      return date($format, strtotime($date) );
   }
   function getAlphaRand($length = 20) {

         $sid = 0;
         srand ((double) microtime() * 1000000);

         $Puddle = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

         for( $index = 0; $index < $length - 1; $index++ ) {

            $sid .= substr($Puddle, (rand()%(strlen($Puddle))), 1);
         }

         return $sid;

   }
}


 // End of Class
?>
