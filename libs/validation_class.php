<?php
//##############################################################################
// File:         $Id: validation_class.php,v 1.2 2006/07/23 16:07:16 cvs Exp $
//
// Modified:     $Date: 2006/07/23 16:07:16 $
//
// Author:       Down Home Consulting, www.DownHomeConsulting.com
//
//
//##############################################################################
//
/*
    Example

    $valid = new  Validation();

	//$valid->validate($field_name     ,$desc               ,$type       ,$min_len,$max_len,$blank_ok,$duplicate_ok) {
    $valid->validate('account_number'  ,'Account Number'    ,'text'      ,0 ,255   ,0,1);
    $valid->validate('amount'          ,'Payment Amount'    ,'number'    ,0 ,255   ,0,1);
    $valid->validate('full_name'       ,'Name'              ,'number'    ,0 ,255   ,0,1);
    $valid->validate('street'         ,'Address'           ,'number'    ,0 ,255   ,0,1);
    $valid->validate('state'           ,'State'             ,'number'    ,0 ,255   ,0,1);
    $valid->validate('city'            ,'City'              ,'number'    ,0 ,255   ,0,1);
    $valid->validate('zip'             ,'Zip'               ,'number'    ,'',''    ,0,'');
    $valid->validate('phone'           ,'Phone'             ,'phone'     ,'',''    ,0,'');
    $valid->validate('email'           ,'Email'             ,'email'     ,0 ,255   ,0,1);
*/

// Basic style left and right functions.
//
function right($string, $num) {

      if ( strlen($string) > $num ) {

         $string = substr($string, strlen($string) - $num, $num);
      }
      return $string;
}
function left($string, $num) {

   if ( strlen($string) > $num ) {

      $string = substr($string, 0, $num);
   }
   return $string;
}
class Validation {


   var $dblink;
   var $error_message;
   var $field_error_message = array();
   var $error = false;
   var $db_table;
   var $data_in = array();
   var $database;
   var $duplicate_email_message = "The email address is already in use.  Try the email password option to have your username and password sent to you.";
   var $duplicate_username_message = "The username is already in use.  Try the email password option to have your username and password sent to you.";
   var $duplicate_field_set_message = "Duplicate values combination found";

   var $duplicate_list = array();  // An associative array of duplicate field and values to check
   var $duplicate_field_set = array(); // An array holding the names of fields that together must be unique
   var $id_field;  // The field that holds the database id
   // Object Constructor
   //
   function Validation( $db_link = false ) {

      global $_POST, $_GET, $_SERVER, $PHP_SELF, $_FILES;

      $this->error = FALSE;



      if ( isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'GET' ) {

         $this->set_data_in($_GET);
      }
      else {

         $this->set_data_in($_POST);
      }

      if ( $_FILES ) {

         $this->file_vars = $_FILES;
      }


      // Make sure database link exists
      //
      if ( ! $db_link ) {

		 $this->database = false;
      }
      else {

         $this->dblink = $db_link;
		 $this->database = true;
      }
   }
   // Add a dupplicate field and value.  The value can also be an array of
   // values to add
   function add_duplicate($field,$value) {

      // If array, merge it
      if ( is_array($value) ) {

         $this->duplicate_list[$field] = array_merge($this->duplicate_list, $value);
      }
      else {

         $this->duplicate_list[$field][] = $value;
      }
   }
   function reset() {

	   $this->error = false;
	   $this->error_message = array();
	   $this->data_in = array();
	   $this->data_out = array();
   }
   function validate($field_name,$desc,$type,$min_len,$max_len,$blank_ok,$duplicate_ok) {

	if ( $field_name && $type ) {

		if ( ! $duplicate_ok ) {

			$this->duplicate_item($field_name, $desc, $type, $this->get_data($this->id_field) );
		}
		// Checks to see if it's a duplicate set match
		//
		$this->duplicate_field_set($field_name);

		if ( $type == "text" ) {

			$this->validate_textbox($field_name,$min_len,$max_len,$desc,$blank_ok);
		}
		elseif ( $type == "checkbox" ) {

			$value = $max_len;
			$this->validate_checkbox($field_name,$desc,$value,$blank_ok);
		}
		elseif ( $type == "delayed_upload" ) {

			$this->validate_upload($field_name,$desc,$blank_ok, $max_len,true);
		}
		elseif ( $type == "upload" ) {

			$this->validate_upload($field_name,$desc,$blank_ok, $max_len,false);
		}
		elseif ( $type == "name" ) {

			$this->validate_string($field_name,$min_len,$max_len,$desc,$blank_ok);
		}
		elseif ( $type == "street" ) {

			$this->validate_string($field_name,$min_len,$max_len,$desc,$blank_ok);
		}
		elseif ( $type == "city" ) {

			$this->validate_string($field_name,$min_len,$max_len,$desc,$blank_ok);
		}
		elseif ( $type == "state" ) {

			$this->validate_state($field_name,$max_len,$desc,$blank_ok);
		}
		elseif ( $type == "zip" ) {

			$this->validate_zip($field_name,$desc,$blank_ok);
		}
		elseif ( $type == "ssn" ) {

			$this->validate_ssn($field_name,$desc,$blank_ok);
		}
		elseif ( $type == "phone" ) {

			$this->validate_phone($field_name,$desc,$blank_ok);
		}
		elseif ( $type == "username" ) {

			$this->validate_username($field_name,$min_len,$max_len,$desc,$blank_ok);
		}
		elseif ( $type == "database" ) {

			$this->validate_database($field_name,$min_len,$max_len,$desc,$blank_ok);
		}
		elseif ( $type == "date" || $type == "textdate" ) {

			$this->validate_date($field_name,$min_len,$max_len,$desc,$blank_ok);
		}
		elseif ( $type == "datetime" ) {

			$this->validate_datetime($field_name,$min_len,$max_len,$desc,$blank_ok);
		}
		elseif ( $type == "time" ) {

			$this->validate_time($field_name,$min_len,$max_len,$desc,$blank_ok);
		}
		elseif ( $type == "url" ) {

			$this->validate_url($field_name,$desc,$min_len,$max_len,$blank_ok);
		}
		elseif ( $type == "email" ) {

			$this->validate_email($field_name,$desc,$max_len,$blank_ok);
		}
		elseif ( $type == "domain" ) {

			$this->validate_domain($field_name,$desc,$max_len,$blank_ok);
		}
		elseif ( $type == "ip_address" ) {

			$this->validate_ip_address($field_name,$desc,$max_len,$blank_ok);
		}
		elseif ( $type == "number" ) {

			$this->validate_number($field_name,$desc,$max_len,$blank_ok);
		}
		elseif ( $type == "amount" ) {

			$this->validate_amount($field_name,$desc,$max_len,$blank_ok);
		}
		elseif ( $type == "sku" ) {

			$this->validate_sku($field_name,$min_len,$max_len,$desc,$blank_ok);
		}
		elseif ( $type == "filename" ) {

			$this->validate_filename($field_name,$min_len,$max_len,$desc,$blank_ok);
		}
		else {

			$this->set_error("Invalid type: $type for field: $field_name");
		}
	}
        return ! $this->error;
   }
   function set_error($message) {

         $this->error_message = $message;
         $this->error = TRUE;
   }
   function get_error_message() {

      return $this->error_message;
   }
   function get_error() {

      return $this->error;
   }

   // Sets the variables that are passed via the url and strips the slashes
   // from quotes, etc..
   //
   function set_data_in($vars) {


      while (list($key,$val) = each($vars) ) {

         if ( ! is_array($val) ) {

            $this->data_in[$key] = stripslashes($val);
         }
      }
      if ( isset($this->data_in['submit']) ) {

         unset($this->data_in['submit']);
      }

   }
   function validate_number($field,$name,$max_len,$blank_ok) {

	$number = $this->get_data($field);

	if ( $number == "" ) {

		$this->is_blank_ok($name,$number,$field,$blank_ok);
	}
	elseif ( ! ereg("^([0-9]+)$", $number) ) {

		$this->set_error("$name not a number", $field);
	}
	elseif ( strlen($number) > $max_len ) {

		$this->set_error("$name too long.  Must be less than $max_len charcters.", $field);
	}
	else {

		$this->data_out[$field] = $number;
	}
   }
   function validate_amount($field,$name,$max_len,$blank_ok) {

	$number = $this->get_data($field);

      if ( $number == "" ) {

         $this->is_blank_ok($name,$number,$field,$blank_ok);
      }
      elseif ( ! ereg("^([1-9]{1}[0-9]*[.]{1}[0-9]{2})|([0-9]+)$", $number) ) {

         $this->set_error("$name not a valid amount",$field);
      }
      elseif ( strlen($number) > $max_len ) {

         $this->set_error("$name too long.  Must be less than $max_len charcters.",$field);
      }
      else {

         $this->data_out[$field] = $number;
      }
   }
   function validate_domain($field,$name,$max_len,$blank_ok) {

      $domain = strtolower($this->get_data($field));

      if ( $domain == "" ) {

         $this->is_blank_ok($name,$domain,$field,$blank_ok);
      }
      elseif ( !ereg("([[:alnum:]\.\-]+\.+)", $domain) ) {
         $this->set_error("Domain address not valid",$field);
      }
      elseif ( strlen($domain) > $max_len ) {

         $this->set_error("$name too long.  Must be less than $max_len charcters.",$field);
      }
      else {

         $this->data_out[$field] = $domain;
      }
   }
   function validate_ip_address($field,$name,$max_len,$blank_ok) {

      $ip = strtolower($this->get_data($field));

      if ( $ip == "" ) {

         $this->is_blank_ok($name,$domain,$field,$blank_ok);
      }
      elseif ( !ereg("(([0-1]?[0-9]{1,2}\.)|(2[0-4][0-9]\.)|(25[0-5]\.)){3}(([0-1]?[0-9]{1,2})|(2[0-4][0-9])|(25[0-5]))", $ip) ) {
         $this->set_error("IP address not valid",$field);
      }
      elseif ( strlen($ip) > $max_len ) {

         $this->set_error("$name too long.  Must be less than $max_len charcters.",$field);
      }
      else {

         $this->data_out[$field] = $ip;
      }
   }

   // Validates the email address
   //
   function validate_email($field,$name,$max_len,$blank_ok) {

      $email = strtolower($this->get_data($field));

      if ( $email== "" ) {

         $this->is_blank_ok($name,$email,$field,$blank_ok);
      }
      elseif ( !ereg("([[:alnum:]\.\-]+)(\@[[:alnum:]\.\-]+\.+)", $email) ) {
         $this->set_error("Email address not valid",$field);
      }
      elseif ( strlen($email) > $max_len ) {

         $this->set_error("$name too long.  Must be less than $max_len charcters.",$field);
      }
      else {

         $this->data_out[$field] = $email;
      }
   }
   function is_blank_ok($name,$string,$field,$blank_ok) {

         if ( ! $blank_ok ) {

	        $this->set_error("$name is Blank",$field);
         }
		 else {

            // If it's blank we still need to save it
			$this->data_out[$field] = $string;
         }
   }

   function validate_ssn($ssn_field,$name,$blank_ok) {

      $ssn = trim( $this->data_in[$ssn_field] );

      if ( $ssn == "" ) {

         $this->is_blank_ok($name,$ssn,$ssn_field,$blank_ok);
      }
      elseif ( ! ereg("^([0-9]{3})-([0-9]{2})-([0-9]{4})$", $ssn) &&  ! ereg("^([0-9]{2})-([0-9]{7})$", $ssn)) {

         $this->set_error("Invalid $name.  Should be in the format 000-00-0000 or 00-0000000",$ssn_field);
      }
      else {

         $this->data_out[$ssn_field] = $ssn;
      }
   }
   function validate_phone($phone_field,$name,$blank_ok) {

      $phone = trim( $this->data_in[$phone_field] );
      $phone = str_replace(" ", "", $phone);
      $phone = str_replace(")", "", $phone);
      $phone = str_replace("(", "", $phone);
      $phone = str_replace("-", "", $phone);
      $phone = str_replace(".", "", $phone);

      if ( $phone == "" ) {

         $this->is_blank_ok($name,$phone,$phone_field,$blank_ok);
      }
      elseif ( ! ereg("^([0-9]{10})$", $phone)) {

         $this->set_error("Invalid $name",$phone_field);
      }
      else {

         $this->data_out[$phone_field] = "(" . substr($phone, 0, 3) . ") " . substr($phone, 3, 3) . "-" . substr($phone, 6, 4);
      }
   }
   function validate_zip($zip_field,$name,$blank_ok) {

      $zip = trim( $this->data_in[$zip_field] );

      if ( $zip == "" ) {

         $this->is_blank_ok($name,$zip,$zip_field,$blank_ok);
      }
      #elseif ( ! ereg("^([0-9]{5}\-[0-9]{4})$", $zip) && ! ereg("^([0-9]{5})$", $zip) ) {
      elseif ( ! ereg("^[0-9]{5}-[0-9]{4}|[0-9]{5}|[A-Z][0-9][A-Z] [0-9][A-Z][0-9]$", $zip) ) {

         $this->set_error("Invalid $name Zip Code",$zip_field);
      }
      else {

         $this->data_out[$zip_field] = $zip;
      }
   }
   function validate_state($field_name,$max_len,$desc,$blank_ok) {

      $state = trim( $this->data_in[$field_name] );

      if ( $state == "-Choose State-" ) {

         $this->set_error("Select a $desc",$field_name);
      }
      else {

         $this->data_in[$field_name] = $state;
         $this->validate_string($field_name,0,$max_len,$desc,$blank_ok);
      }
   }
   function validate_textbox($field,     $min_len,$max_len,$desc,$blank_ok) {

	$string = $this->get_data($field);

	if ( $string == "" ) {

		$this->is_blank_ok($desc,$string,$field,$blank_ok);
	}
	elseif ( strlen($string) > $max_len ) {

		$this->set_error("$desc is too long.  Can't be longer than $max_len characters.",$field);
	}
	else {

		$this->data_out[$field] = $string;
	}
    }

   function validate_date($field,$min_len,$max_len,$name,$blank_ok) {

	// If select was used to set the date then the date is sent as three fields
	//
	if ( $this->get_data($field . "_m") != "" && $this->get_data($field . "_d") != "" && $this->get_data($field . "_y") != "" ) {

		$date = $this->get_data($field . "_m") . "/" . $this->get_data($field . "_d") . "/" . $this->get_data($field . "_y");
	}
	else {

		$date = $this->get_data($field);
	}
	if ( $date == "" ) {

		$this->is_blank_ok($name,$date,$field,$blank_ok);
	}
	elseif ( strtotime($date) < 0 ) {

		$this->set_error("$name has an invalid date",$field);
	}
	else {
		if ( strstr($date, '-') ) {

			list($year,$month,$day) = explode("-", $date);
		}
		else {

			list($month,$day,$year) = explode("/", $date);
		}
		$this->data_out[$field] = "$year-$month-$day";
	}
   }
   function validate_time($field,$min_len,$max_len,$name,$blank_ok) {

        if ( $this->data_in[$field . "_hours"] != "" && $this->data_in[$field . "_minutes"] != "" && $this->data_in[$field . "_am_pm"] != "" ) {

                $hour = $this->data_in[$field . "_hours"];
                $min  = $this->data_in[$field . "_minutes"];
                $am_pm = $this->data_in[$field . "_am_pm"];

                if ($am_pm == 'pm' ) {

                        $hour += 12;
                }
                $time = sprintf("%02d:%02d:%02d",$hour,$min,'00');
        }
        else {
                $time = trim( $this->data_in[$field] );
        }
        if ( $time == "" ) {

                $this->is_blank_ok($name,$time,$field,$blank_ok);
        }
        elseif ( ! strtotime($time) ) {

                $this->set_error("$name is not a valid time",$field);
        }
        else {

                $this->data_out[$field] = $time;
        }
   }
   function get_data($field) {

	$value = "";

	if ( isset($this->data_in[$field]) ) {

		$value = $this->data_in[$field];
	}

	return $value;
   }
   function validate_datetime($field,$min_len,$max_len,$name,$blank_ok) {

	$date = $this->get_data($field);


	if ( $date == "" ) {

		$this->is_blank_ok($name,$date,$field,$blank_ok);
	}
	elseif ( ! strtotime($date) ) {

		$this->set_error("$name is not a valid datetime",$field);
	}
	else {

		$this->data_out[$field] = date( "Y-m-d H:i:s", strtotime($date) );;
	}
   }
   function validate_string($field,$min_len,$length,$name,$blank_ok) {

      $string = $this->get_data($field);

      if ( $string == "" ) {

         $this->is_blank_ok($name,$string,$field,$blank_ok);
      }
      elseif ( !ereg("^([_[:alnum:]\,\'\ \.\-])+$", $string)) {

         $this->set_error("Illegal Characters in $name",$field);
      }
      elseif ( strlen($string) < $min_len ) {

         $this->set_error("$name is too short.  Can't be shorter than $min_len characters.",$field);
      }
      elseif ( strlen($string) > $length ) {

         $this->set_error("$name is too long.  Can't be longer than $length characters.",$field);
      }
      else {

         $this->data_out[$field] = $string;
      }
   }

   function validate_checkbox($field_name,$desc,$value,$blank_ok) {

	if ( ! $blank_ok && $this->data_in[$field_name] != $value ) {

		$this->set_error("You must check the $desc box",$field_name);
	}
	else {

		$this->data_out[$field_name] = $this->data_in[$field_name];
	}
   }
   function validate_username($field_name,$min_len,$max_len,$desc,$blank_ok) {

      $this->validate_string($field_name,$min_len,$max_len,$desc,$blank_ok);

      if ( trim($this->data_in[$field_name]) != ""
		  && ! $this->error
		  && ! ereg("^([[:alnum:]])+$", $this->data_in[$field_name] ) ) {

         $this->set_error("Invalid characters in username.",$field_name);
      }
   }
   function validate_database($field_name,$min_len,$max_len,$desc,$blank_ok) {

      $this->validate_string($field_name,$min_len,$max_len,$desc,$blank_ok);

      if ( trim($this->data_in[$field_name]) != ""
		  && ! $this->error
		  && ! ereg("^[_0-9A-Za-z]+$", $this->data_in[$field_name] ) ) {

         $this->set_error("Invalid characters in database.",$field);
      }
   }
   function validate_sku($field,$min_len,$length,$name,$blank_ok) {

      $string = $this->get_data($field);

      if ( $string == "" ) {

         $this->is_blank_ok($name,$string,$field,$blank_ok);
      }
      elseif ( !ereg("^([[:alnum:]\_\.\-])+$", $string)) {

         $this->set_error("Illegal Characters in $name",$field);
      }
      elseif ( strlen($string) < $min_len ) {

         $this->set_error("$name is too short.  Can't be shorter than $min_len characters.",$field);
      }
      elseif ( strlen($string) > $length ) {

         $this->set_error("$name is too long.  Can't be longer than $length characters.",$field);
      }
      else {

         $this->data_out[$field] = $string;
      }
   }
   function validate_filename($field,$min_len,$length,$name,$blank_ok) {

      $string = $this->get_data($field);

      if ( $string == "" ) {

         $this->is_blank_ok($name,$string,$field,$blank_ok);
      }
      elseif ( !ereg("^([[:alnum:]\_\/\.\-])+$", $string)) {

         $this->set_error("Illegal Characters in $name",$field);
      }
      elseif ( strlen($string) < $min_len ) {

         $this->set_error("$name is too short.  Can't be shorter than $min_len characters.",$field);
      }
      elseif ( strlen($string) > $length ) {

         $this->set_error("$name is too long.  Can't be longer than $length characters.",$field);
      }
      else {

         $this->data_out[$field] = $string;
      }
   }

   function validate_upload($field,$desc,$blank_ok,$max_size = 65536,$delayed_upload = false ) {

      $user_file = $this->file_vars[$field];


      if ( $user_file['tmp_name'] != 'none' AND $user_file['tmp_name'] != '' ) {

         if ( $user_file['size'] > $max_size ) {

             $this->set_error("File Size Too Large",$field);
	     }
		 elseif ( ! $delayed_upload ) {

               $fd = fopen($user_file['tmp_name'], "r");
               $x = fread($fd, $user_file['size']);
               $my_file = AddSlashes($x);
		 }
		 elseif ( $delayed_upload ) {

			 $my_file = $user_file;
		 }
      }
      else {

         $this->is_blank_ok($desc,'',$field,$blank_ok);
      }
      if ( ! $this->error ) {

         $this->data_out[$field] = $my_file;
         $this->data_out[$field . "_file_type"] = $user_file['type'];
      }
   }
   function get_file_extension($file_name) {

	   $extension = '';
       $parts = explode('\.', $file_name);

       if (count($parts) > 1) {

	      $extension = end($parts);
	   }
       if (!$extension && count($parts) > 2) {

		   $ext = prev($parts);
	   }
       return $extension;
   }
   // If the field is in our duplicate list, see if the value is in the array
   //
   function duplicate_array_match($field) {

      $match = false;
      if ( array_key_exists($field, $this->duplicate_list) ) {

         $array = $this->duplicate_list[$field];
         $value = $this->get_data($field);

         $match = in_array( $value, $array);
      }
      return $match;
   }
   // Adds a field name or an array of field names to the duplicate set
   //
   function add_duplicate_field_set($field) {

		if ( is_array($field) ) {

			$this->duplicate_field_set = array_merge($this->duplicate_field_set, $field);
		}
		else {

			$this->duplicate_field_set[] = $field;
		}
   }
   // Sets the error message that will be displayed if a duplicate field set is found
   //
   function set_duplicate_field_set_msg($message) {

		$this->duplicate_field_set_message = $message;
   }
   // if there are two fields that together make a duplicate record, c
   // check the set of fields
   //
   function duplicate_field_set($field) {

		$match = false;
		if ( in_array($field, $this->duplicate_field_set) ) {

		 foreach ( $this->duplicate_field_set AS $field ) {

				$where[$field] = $this->data_in[$field];
		 }

         $sql = "SELECT $field FROM $this->db_table" . $this->dblink->where_statement($where);

         // If the id field has a value greater than one, we shouldn't match it
		 //
         if ( $this->data_in[ $this->id_field ] != "" ) {

			$id = $this->data_in[ $this->id_field ];
            $sql = $sql . " AND $this->id_field <> '$id'";

         }
		 $match = $this->dblink->not_empty($sql,0);

		 if ( $match ) {

               $this->set_error( $this->duplicate_field_set_message );
		 }
		}
		return $match;
   }
  function duplicate_item($field,$name,$type, $id = -1 ) {

     // If it is blank, we don't need to check for dupplicates.  If blank is
	 // ok, there will be blank dupplicates.  If blank is not ok, you'll
	 // get an error from the blank validation
	 //

     if ( $this->database && $this->get_data($field) != "" ) {

        if (   $this->duplicate_array_match($field)
               || $this->duplicate_item_match($field,$name,$type, $id)
				  ) {

           // Use a different message if it's a duplicate email or username
           if ( $type == 'email' ) {

               $this->set_error($this->duplicate_email_message,$field);
		   }
		   elseif ( $type == 'username' ) {

               $this->set_error( sprintf($this->duplicate_username_message, $name), $field );
		   }
		   else {

               $this->set_error("$name is already in use.  ", $field);
		   }
        }
	 }

  } // end duplicate

   // Searches for a duplicate item in the database
   //
   function duplicate_item_match($field,$name,$type, $id = -1 ) {

         $sql = "SELECT $field FROM $this->db_table WHERE $field = '" . mysql_escape_string($this->data_in[$field]) . "'";

         // If the id field has a value greater than one, we shouldn't match it
		 //
         if ( $this->get_data( $this->id_field ) != "" ) {

            $sql = $sql . " AND $this->id_field <> '$id'";

         }
	   $result = $this->dblink->not_empty($sql,0);
	   return $result;
   }
   // Validates the passwords to insure they match and follow rules
   //
   function validate_password($min_length,$max_length,$pwfield1,$pwfield2) {

      $password1 = trim( $this->data_in[$pwfield1] );
      $password2 = trim( $this->data_in[$pwfield2] );

      unset($this->data_in[$pwfield2]);

      // Make sure they both match
      //
      if ( $password1 == "" ) {

         $this->set_error("Password is Blank",$pwfield1);
      }
      elseif ( $password2 == "" ) {

         $this->set_error("Confirm Password is Blank",$pwfield1);
      }
      elseif ( $password1 != $password2 ) {

         $this->set_error("Your Passwords Don't Match.",$pwfield1);
      }
      elseif ( strlen($password1) < $min_length ) {

         $this->set_error("Password is too short.  Must be at least $min_length characters.",$pwfield1);
         $this->error = TRUE;
      }
      elseif ( strlen($password1) > $max_length ) {

         $this->set_error("Password is too long.  Can't be longer than $max_length characters.",$pwfield1);
         $this->error = TRUE;
      }
      elseif ( !ereg("^([[:alnum:]\,\'\ \.\-])+$", $password1)) {

         $this->set_error("Illegal Characters in Password",$pwfield1);
      }
      else {

         $this->data_out[$pwfield1] = $this->data_in[$pwfield1];
      }
   }
   // Validate url
   //
   function validate_url($field_name,$desc,$min_len,$max_len,$blank_ok) {

      $url = strtolower($this->data_in[$field_name]);

      // Make sure url is prefixed with scheme (ex. http://)
      //
      if ( $url == "" ) {

         $this->is_blank_ok($desc,$url,$field_name,$blank_ok);
      }
      else  {
          if (ereg ("^[^http://]",$url)) {

             $url=(("http://").$url);
          }

         // Put the url in the standard format we want
         //
         $urlarr = parse_url($url);

         if ( $urlarr[scheme] == '' ) {

            $urlarr[scheme] = "http";
         }
         if ($urlarr[path] != "") {

            $pth = $urlarr[path];
            //$pth = substr($urlarr[path], 0, strrpos($urlarr[path], "/") + 1);
         }
         else {

            $pth = "/";
         }
         $hld_url = $urlarr[scheme] . "://" . $urlarr[host] . $pth;

         if ( !ereg("([[:alnum:]\-\_]+\.+)", $urlarr[host])) {


             $this->set_error("Invalid $desc.  Check the $desc for errors.",$field_name);
         }
         elseif ( strlen($hld_url) > $max_len ) {

            $this->set_error("$desc too long.  Must be less than $max_len charcters.",$field_name);
         }
         else {

             $this->data_out[$field_name] = $hld_url;
             $this->data_in[$field_name] = $hld_url;
         }
      }
   }
   function key_field($inkey = '') {

      // If we were passed no parameters, return the current value
      //
      if ( $inkey == '' ) {

         $inkey = $this->id_field;
      }
      else {   // set the new value

        $this->id_field = $inkey;
      }

      return $inkey;
   }


}

?>
