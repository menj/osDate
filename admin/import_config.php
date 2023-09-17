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

@set_time_limit(0);	// No time limits
ignore_user_abort(1);	// Ignoring user aborting

// Given the userid delete the records for the user
//
function delete_user_records($user_id) {

      global $osDB;

      // 1. Deleting users
      $del_username = get_username($user_id);
      // Deleting user albums
      $query="delete from ".USERALBUMS_TABLE." where username = '".$del_username."'";
      $osDB->query($query);

      // Deleting users images
      $query="delete from ".USER_SNAP_TABLE." where userid=".$user_id;
      $osDB->query($query);

      // Deleting users answers
      $query="delete from ".USER_PREFERENCE_TABLE." where userid=".$user_id;
      $osDB->query($query);

      // Deleting winks
      $query="delete from ".VIEWS_WINKS_TABLE." where userid=".$user_id;
      $osDB->query($query);

      // Deleting blogs
      $query="delete from ".BLOG_PREFERENCES_TABLE." where userid=".$user_id;
      $osDB->query($query);
      $query="delete from ".BLOG_STORY_TABLE." where userid=".$user_id;
      $osDB->query($query);
      $query="delete from ".BLOG_COMMENTS_TABLE." where userid=".$user_id;
      $osDB->query($query);

      // Deleting mailbox messages
      $query="delete from ".MAILBOX_TABLE." where owner=".$user_id;
      $osDB->query($query);

      // Deleting buddies
      $query="delete from ".BUDDY_BAN_TABLE." where userid = '".$user_id."' or ref_userid = '".$user_id."'";
      $osDB->query($query);

      // Deleting users
      $query="delete from ".USER_TABLE." where id=".$user_id;
      $osDB->query($query);
}
// Given a filename and path, returns the ftp path to that file
//
function get_ftp_path($filename,$path) {

    return 'ftp://' . $_SESSION[IMPORT_MODULE]["ftp_username"] . ':' . $_SESSION[IMPORT_MODULE]["ftp_password"] . '@' . $_SESSION[IMPORT_MODULE]["ftp_hostname"] . '/' . $_SESSION[IMPORT_MODULE]["ftp_path"] .$path . $filename;
}
// Given blog data, adds blog information
//
function add_blog($data) {

    global $osDB,$blogxref;

    // If there's currently no blog settings for this owner, add them
    //
    $sql = "SELECT id FROM ! WHERE userid = ?";
    $has_settings =  $osDB->getOne( $sql, array( BLOG_PREFERENCES_TABLE, $GLOBALS['imported_user_id'] ) );

    if ( ! $has_settings ) {

        $username = $GLOBALS['username'];
        $sdata = array(
          'userid'          => $GLOBALS['imported_user_id'],
          'name'            => $username."'s Blog",
          'description'     => 'Blog writen by ' . $username,
          'members_comment' => 1,
          'buddies_comment' => 1,
          'members_vote'    => 1,
          'gui_editor'      => 1,
          'max_comments'    => 99,
        );
        $osDB->autoExecute(BLOG_PREFERENCES_TABLE, $sdata, DB_AUTOQUERY_INSERT);
    }

    // If the record id equals the branch, then it's the original story, so add a story
    //
    if ( $data['id'] == $data['branch'] ) {

        $sdata = array(
            'userid'         => $GLOBALS['imported_user_id'],
            'date_posted'    => trim($data['date']),
            'title'          => trim($data['subject']),
            'story'          => trim($data['entry']),
            'views'          => 0,
        );
        $osDB->autoExecute(BLOG_STORY_TABLE, $sdata, DB_AUTOQUERY_INSERT);
        $insert_id = $osDB->getOne("select last_insert_id()");

        $blogxref[ $data['id'] ] = $insert_id;
    }
    // Otherwise it's a comment so add a comment record
    //
    else {
          $maxlen = $GLOBALS['config']['max_comment_length'];
          $comment = array(
              'userid'     => $GLOBALS['imported_user_id'],
              'blogid'     => $blogxref[ $data['branch'] ],
              'comment'    => trim( str_pad($data['entry'],$maxlen) ),
              'datetime'   => trim($data['date']),
          );
          $osDB->autoExecute(BLOG_COMMENTS_TABLE, $comment, DB_AUTOQUERY_INSERT);
    }
    return true;
}
// Saves the config information and sets the image path
//
function save_config($image_path) {

	// Save database configuration if comming from the config page
	//
	if(isset($_POST["db_config"])) {

	     $_SESSION[IMPORT_MODULE]=$_POST;

	     // Special handling for url
	     //
	     $parts = parse_url($_POST['photos_url']);

		if (isset($parts) && is_array($parts)) {
            if ( ! isset($parts['port']) || $parts['port'] == '' ) {

                $parts['port'] = '80';
            }

		     if ( preg_match("/(html|php)$/", $parts['path']) ) {

                $_SESSION[IMPORT_MODULE]['photos_url'] = $parts['scheme'] . '://' . $parts['host'] . ':' . $parts['port'] . dirname($parts['path']) . '/' . $image_path;
		     }
		     else {

		        if ( substr($parts['path'], -1, 1) != '/') {

		             $parts['path'] .= '/';
		        }
	                $_SESSION[IMPORT_MODULE]['photos_url'] = $parts['scheme'] . '://' . $parts['host'] . ':' . $parts['port'] . $parts['path'] . $image_path;
			     }
	        }
		}
}
// Given the userid returns the username
//
function get_username($userid) {

  return $GLOBALS['osDB']->getOne("SELECT username FROM ! WHERE id = ?", array(USER_TABLE, $userid) );

}
// Adds a new album if this is the first photo for the user
//
function add_album($username, $name, $album_id, $passwd = false) {

    global $osDB;

    if ( ! $album_id ) {

        $data['username'] = $username;
        $data['name']     = $name;

        if ( $passwd ) {
            $data['passwd']   = md5($passwd);
        }
        $osDB->autoExecute(USERALBUMS_TABLE, $data, DB_AUTOQUERY_INSERT);

        $album_id = $osDB->getOne("select last_insert_id()");
    }
    return $album_id;
}
// Adds a image to the database
//
function add_image($album_id, $filename,$active) {

      $fields=array();
      $fields["userid"] = $GLOBALS['imported_user_id'];
      $fields["picno"]  = $GLOBALS['picno']++;

      $userid = $GLOBALS['imported_user_id'];
      $img_tmp = createImg(FileExtention($filename),$filename);
      $result = true;
      if ( ! $img_tmp ) {
              $result = false;
      }
      else {
          $jpgfile = createJpeg($img_tmp, 'N');
          $newimg = file_get_contents($jpgfile);

          $img_tmp=createImg(FileExtention($filename),$filename);
          $tnimg_file = createJpeg($img_tmp);
          $tnimg = file_get_contents($tnimg_file);

          if ($GLOBALS['config']['images_in_db'] == 'N')
          {
                  $imgfile = writeImageToFile($newimg, $userid, '1'.$GLOBALS['picno'],"");
                  $newimg = 'file:'.$imgfile;
                  $tnimgfile = writeImageToFile($tnimg, $userid, '2'.$GLOBALS['picno'],"");
                  $tnimg = 'file:'.$tnimgfile;
          }
          else
          {	$newimg = base64_encode($newimg);
                  $tnimg = base64_encode($tnimg);
          }
          $fields["picture"]=$newimg;
          $fields["tnpicture"]=$tnimg;

          $fields["active"]=$active;
          $fields["picext"]="jpg";
          $fields["picext"]="jpg";
          $fields["ins_time"]=time();
          $fields["album_id"] = $album_id;
          $GLOBALS['osDB']->autoExecute(USER_SNAP_TABLE,$fields, DB_AUTOQUERY_INSERT);
      }
      return $result;

}


// Given an array with the question and answer text, finds a match in the
// cross reference table.  If the option exists, adds it to the user
//  preferences table.
//
//  Returns true if a match was found and added.
//
function add_question($data) {

  global $osDB;
  $added = false;

  $query = "
      SELECT  questionoptionid
      FROM !
      WHERE question_text = ? AND  answer_text = ? AND  module = ?";

   $quesid = $osDB->getOne($query, array(IMPORT_QUESTIONS_XREF, $data['question_text'], $data['answer_text'], IMPORT_MODULE));

   $query = "SELECT * FROM ! WHERE id = ?";
   $qdata = $osDB->getRow($query, array( OPTIONS_TABLE, $quesid) );

   // If a option match was found
   //
   if ( isset($qdata['questionid']) ) {

        $idata['userid']     = $GLOBALS['imported_user_id'];
        $idata['questionid'] = $qdata['questionid'];
        $idata['answer']     = $qdata['id'];

        $GLOBALS['osDB']->autoExecute(USER_PREFERENCE_TABLE, $idata, DB_AUTOQUERY_INSERT);
        $added = true;
    }
    return $added;
}
// given an array with with the users id and buddy id, add to the buddy table
//
function add_buddy($b_data,$type) {

      $data['userid']     = $b_data['userid'];
      $data['act']          = $type;
      $data['ref_userid'] = $b_data['ref_userid'];
      $data['act_date']     = time();

	  if ($data['ref_userid'] != '') {
	      $GLOBALS['db']->autoExecute(BUDDY_BAN_TABLE, $data, DB_AUTOQUERY_INSERT);
	  }
      return true;
}
// Checks to make sure the username is unique, it not, it tacks the userid to the end;
function uniq_username($data) {

     $id = $GLOBALS['osDB']->getOne("SELECT id FROM ! WHERE username = ?", array(USER_TABLE, $data['username']) );

      // If the username already exists, tack on the user id so it's uniqe
     if ( $id ) {

        $username = $data['username'].$data['userid'];
     }
     else {

        $username = $data['username'];
     }
     return $username;
}
// Given an array with userid and ref_userid, adds the wink
//
function add_wink($data) {

      $idata['act']        = 'W';
      $idata['act_time']   = time();
      $idata['userid']     = get_new_userid($data['userid']);
      $idata['ref_userid'] = get_new_userid($data['ref_userid']);

	if ($idata['ref_userid'] > 0) {
      $GLOBALS['osDB']->autoExecute(VIEWS_WINKS_TABLE, $idata, DB_AUTOQUERY_INSERT);
	}
      return true;
}
// Given the original userid from the source database returns
// the current username
//
function get_new_username($source_userid) {

      global $osDB;

      $query="select user_id from ! where module = ? AND  source_id = ?";
      $user_id = $osDB->getOne($query,array(IMPORTED_USERS, IMPORT_MODULE, $source_userid));

      return $GLOBALS['osDB']->getOne("SELECT username FROM ! WHERE id = ?", array(USER_TABLE, $user_id) );
}
// Given the original userid from the source database returns
// the current userid
//
function get_new_userid($source_userid) {

      global $osDB;

      $query="select user_id from ! where module = ? AND  source_id = ?";
      return $osDB->getOne($query,array(IMPORTED_USERS, IMPORT_MODULE, $source_userid));
}
// Given the mailbox data, adds the message to the mailbox
//
function add_message($data) {

      $to   = get_new_userid($data['touserid']);
      $from = get_new_userid($data['fromuserid']);
      // Put in inbox
      //
	if ($from != '') {
      $idata['owner']       = $to;
      $idata['senderid']    = $from;
      $idata['recipientid'] = $to;
      $idata['message']     = $data['message'];
      $idata['subject']     = $data['subject'];
      $idata['sendtime']    = $data['sendtime'];
      $idata['flagread']    = $data['flagread'];
      $idata['flagdelete']  = $data['todeleted'];
      $idata['folder']      = 'inbox';
      $idata['notifysender'] = '0';
      $GLOBALS['osDB']->autoExecute(MAILBOX_TABLE, $idata, DB_AUTOQUERY_INSERT);

      $idata['owner']       = $from;
      $idata['senderid']    = $to;
      $idata['flagdelete']  = $data['fromdeleted'];
      $idata['folder']      = 'sent';
      $GLOBALS['osDB']->autoExecute(MAILBOX_TABLE, $idata, DB_AUTOQUERY_INSERT);
	}
      return true;
}
function debug($var)
{	echo("<pre>");
		print_r($var);
		echo("</pre>");
}

function insert_query($table,$set)
{	global $table_prefix;
		$fields=NULL;
		$query="insert into ".$table_prefix.$table." set ";
		foreach($set as $key=>$value)
		{	if($value!=NULL)
				$fields[]=$key."='".mysql_escape_string(trim($value))."'";
		}
		$query.=implode(", ",$fields);
		return($query);
}

function update_query($table,$set,$where)
{	$fields=NULL;
		$query="update ".$table." set ";
		foreach($set as $key=>$value)
		{	if($value!=NULL)
				$fields[]=$key."='".mysql_escape_string(trim($value))."'";
		}
		$query.=implode(", ",$fields);
		$query.=$where;
		return($query);
}

function FileExtention($filename)
{	$path_parts = pathinfo($filename);
		return(strtolower($path_parts["extension"]));
}

function createImg($type,$file) {
	if($type == 'bmp') $img=@imagecreatefromwbmp($file);
	else if($type == 'png') $img=@imagecreatefrompng($file);
	else if($type == 'gif') $img=@imagecreatefromgif($file);
	else if($type == 'jpg') $img=@imagecreatefromjpeg($file);
	else  $img =  @file_get_contents($file);
	return $img;
}



function createJpeg( $img , $reduce='Y') {
	global $config;
	global $userid;
	global $ext;

	$tnsize = $config['upload_snap_tnsize'];
	//$img = imagecreatefrompng($org);
	$w = imagesx( $img );
	$h = imagesy( $img );

	if ($reduce == 'Y') {
		if( $w > $h ) {
			$ratio = $w / $h;
			$nw = $tnsize;
			$nh = $nw / $ratio;
		} else {
			$ratio = $h / $w;
			$nh = $tnsize;
			$nw = $nh /$ratio;
		}
	} else {
		$nh = $h;
		$nw = $w;
	}

	$img2 = imagecreatetruecolor( $nw, $nh );
	imagecopyresampled ( $img2, $img, 0, 0, 0 , 0, $nw, $nh, $w, $h );
	$fimg = 'img_' . $userid . '.jpg';
	$real_tpath = realpath ("../temp");

	if(	$HTTP_ENV_VARS['OS'] == 'Windows_NT'){
		$real_tpath= str_replace( "\\", "\\\\", $real_tpath);
		$file = $real_tpath . "\\" . $fimg;
	}else{
		$file = $real_tpath . "/" . $fimg;
	}

	imagejpeg( $img2, $file );
	imagedestroy($img2);
	imagedestroy($img);
	return $file;
}

function writeImageToFile($img, $userid, $picno, $file="") {
/* This routine will create an image file */
	if ($file == '') {
		$filename= time().$userid.$picno.'.jpg';
	} else {
		$filename = $file;
	}
	$img = imagecreatefromstring( $img );
	imagejpeg($img, USER_IMAGE_DIR.$filename);
	return ($filename);
}
?>