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

class Blog {

  var $valid;              // Validation class
  var $osDB;                 // Db class
  var $errorMessage;
  var $data;              // Holds blog data
  var $settings;          // Holds settings
  var $comment;          // Holds comment
  var $userfield = 'userid';
  var $admin = false; // Admin flag
  var $no_comment = 'None';  // The reason no comment allowed
  var $owner_data; // info about the owner of a blog
  var $sort_page;      // The name of the process for the list page to sort
  var $sort_page_values = array(); // A array of values to add to the url

	/* Blog Title image sizes are used only for the purpose of displaying the menu . */
  var $blog_title_image_tn_height = 100; /* Blog title image thumbnail height, if any image is given */
  var $blog_title_image_tn_width = 100; /* Blog title image thumbnail width, if any image is given */

  var $blog_title_image_height = 150; /* Normal title image height */
  var $blog_title_image_width = 350; /* Normal titel image width */

  function Blog($is_admin = false) {

    $this->valid = new Validation();
    $this->osDB    =& $GLOBALS['osDB'];
    $this->setDefaultSettings();
    $this->setDefaultComment();
    $this->setDefaultData();

    if ( $is_admin ) {

      $this->admin = true;
      $this->userfield = 'adminid';
    }
  }
  function setDefaultData() {

      $this->data = array(       // Holds blog data
         'title' => '',
         'story' => '',
         'date_posted' => date('Y-m-d'),
      );
  }
  function setDefaultSettings() {

      // Change default words to be cr delimited
      //
      $default_bad_words = get_lang('blog_default_bad_words');
      $bad_word_array = explode('\|', $default_bad_words);
      $bad_words = join("\n\r",$bad_word_array);

      $this->settings = array(    // Holds settings
         'name' => '',
         'description' => '',
         'members_comment' => 1,
         'buddies_comment' => 1,
         'members_vote' => 1,
         'gui_editor' => 1,
         'max_comments' => 99,
         'bad_words' => $bad_words,
         'title_template' => '',
         'story_template' => '',
       );
  }
  function setDefaultComment() {

      $this->comment = array(    // Holds settings
         'userid' => '0',
         'adminid' => '0',
         'comment' => '',
         'datetime'   => date('Y-m-d h:m:s'),
      );
  }
  function allowComments($blog_id, $userid) {

	$this->loadBlog($blog_id);

    $allow = 'Y';

    if ( $this->data['userid'] ) {

      $this->owner_data  = $this->getUserRec($this->data['userid']);
      $this->userfield = 'userid';
    } else {

      $this->owner_data  = $this->getAdminRec($this->data['adminid']);
      $this->userfield = 'adminid';
    }
    // Load the blog settings

    //
    $this->loadSettings($this->owner_data['id']);

	if (isset($_SESSION['AdminId']) && $_SESSION['AdminId'] > 0) {
	    $poster_data  = $this->getAdminRec($userid);
	} else {
	    $poster_data  = $this->getUserRec($userid);
	    $buddy_data = $this->getBuddyRec($this->owner_data['username'], $poster_data['username']);
	}

    $user_comment_count = $this->getCommentCount($blog_id);

    // If the user record is not found, no posting
    //
	if ( ! $poster_data['id'] ) {

        $allow = 'N';
        $this->no_comment = 'No user record found';
    } elseif ( $user_comment_count >= $this->settings['max_comments'] ) {

        $allow = 'N';
        $this->no_comment = 'Reached max comments';
    } elseif ( isset($buddy_data['act']) && $buddy_data['act'] == 'B' ) {
   // If the user is banned, no posting
    //
        $allow = 'N';
        $this->no_comment = 'User baned';
    }     elseif ( $this->settings['buddies_comment'] == 1 && isset($buddy_data['act']) && $buddy_data['act'] == 'F') {

    // If buddy posting is yes, and the user is a buddy, allow posting
    //
        $allow = 'Y';
        $this->no_comment = 'Is a buddy.';
    }     elseif ( $this->settings['members_comment'] == 0 ) {

    // If member posting is set to no, don't allow posting
    //
        $allow = 'N';
        $this->no_comment = 'Member posting not allowed';
    }

     return $allow;
  }

  function getUserRec($userid) {

     return $this->osDB->getRow( "SELECT * FROM ! WHERE id = ?", array( USER_TABLE, $userid ) );
  }
  function getAdminRec($adminid) {

     return $this->osDB->getRow( "SELECT * FROM ! WHERE id = ?", array( ADMIN_TABLE, $adminid ) );
  }
  function getBuddyRec($userid, $ref_userid) {

     return $this->osDB->getRow( "SELECT * FROM ! WHERE userid = ? AND ref_userid = ?", array( BUDDY_BAN_TABLE, $userid, $ref_userid ) );
  }
  // If a blog settings entry exists, return true
  //
  function settingsExist($userid) {

    return $this->osDB->getOne("SELECT id FROM ! WHERE  " . $this->userfield . " = ?", array( BLOG_PREFERENCES_TABLE, $userid ) );
  }
  function validateBlogDate() {

     //$field_name ,$desc ,$type ,$min_len, $max_len, $blank_ok, $duplicate_ok) {
     if ( ! $this->valid->validate('date_posted'  ,'Post Date'  ,'date'   ,5 ,8   ,0, 1) ) {

        $this->setErrorMessage($this->valid->get_error_message() );
     }
  }
  function validateBlogTitle() {

     //$field_name ,$desc ,$type ,$min_len, $max_len, $blank_ok, $duplicate_ok) {
     if ( ! $this->valid->validate('title'  ,'Title'  ,'text'   ,5 ,64000   ,0, 1) ) {

        $this->setErrorMessage($this->valid->get_error_message() );
     }
  }
  function validateBlogStory() {

      global $config;

      $max_len = $config['max_blog_length'];
     //$field_name ,$desc ,$type ,$min_len, $max_len, $blank_ok, $duplicate_ok) {
     if ( ! $this->valid->validate('story'  ,'Story'  ,'text'   ,5 ,$max_len   ,0, 1) ) {

        $this->setErrorMessage($this->valid->get_error_message() );
     }
  }
  function validateBlogComment() {

      global $config;

      $max_len = $config['max_comment_length'];
     //$field_name ,$desc ,$type ,$min_len, $max_len, $blank_ok, $duplicate_ok) {
     if ( ! $this->valid->validate('comment'  ,'Comment'  ,'text'   ,5 ,$max_len   ,0, 1) ) {

        $this->setErrorMessage($this->valid->get_error_message() );
     } elseif ( $badword = $this->hasBadWord() ) {

          $error = sprintf(get_lang('blog_errors','comment_bad_word'), $badword);
          $this->setErrorMessage($error);
     }
  }
  function hasBadWord() {

      $bad_word_array = preg_split("/\s+/", $this->settings['bad_words']);

      $bad_word = false;

      foreach ( $bad_word_array AS $word ) {

         if ( stristr($this->comment['comment'], $word) !== FALSE ) {

            $bad_word = $word;
         }
      }
      return $bad_word;
  }
  function validateBlogId() {

     //$field_name ,$desc ,$type ,$min_len, $max_len, $blank_ok, $duplicate_ok) {
     if ( ! $this->valid->validate('blogid' ,'Blog Id' ,'number' ,0 ,11   ,0, 1) ) {

        $this->setErrorMessage($this->valid->get_error_message() );
     }
  }
  function addComment($blog_id, $userid) {

   $this->comment = array(
      'blogid'     => $blog_id,
      'comment'    => strip_tags(trim($_POST['comment'])),
      'datetime'   => date('Y-m-d h:m:s'),
   );
	if ($_SESSION['UserId'] == $userid) {
		$this->comment['userfield'] = 'userid';
	} else {
		$this->comment['userfield'] = 'adminid';
	}

    if ( $this->allowComments($blog_id,$userid) == 'Y' ) {

         $this->validateBlogComment();

         if ( ! $this->getErrorMessage() ) {
			$inssql = 'insert into ! ('.$this->comment['userfield'].', blogid, comment, datetime) values (?, ?, ?, ?)';
			$this->osDB->query($inssql,array(BLOG_COMMENTS_TABLE, $userid, $this->comment['blogid'], $this->comment['comment'], $this->comment['datetime']) );

        /* $this->osDB->autoExecute(BLOG_COMMENTS_TABLE, $this->comment,'INSERT'); */
			if (!isset($_SESSION['AdminId']) || $_SESSION['AdminId'] == '') {
					$recipient_choice = $this->osDB->getOne('select choice_value from ! where userid=? and choice_name=?', array(USER_CHOICES_TABLE, $userid, 'email_blog_commented') );

				if ($recipient_choice == '1' or $recipient_choice == '' or !isset($recipient_choice) ) {
	        	    $this->sendCommentEmail($userid);
				}
			}
         }
      } else {
		  $this->setErrorMessage($this->no_comment);
	  }
  }
  function sendCommentEmail($userid) {

      global $config, $t;

      if ($config['letter_blogcommentreceived'] == 'Y') {
         /* Now intimate the user about this  */


         $message = get_lang('comment_received', MAIL_FORMAT);

         $Subject = get_lang('comment_received_sub');

         $From = $config['admin_email'];

         $To = $this->owner_data['email'];

         $message = str_replace('#FirstName#', $this->owner_data['firstname'], $message);

         $message = str_replace('#siteName#', $config['site_name'],$message);

         $message = str_replace('#SenderName#', $_SESSION['UserName'], $message);

         $success = mailSender($From, $To, $To, $Subject, $message);

         unset($message, $Subject, $To, $From);

      }

  }
  function loadTemplate() {

   $this->data = array(
      'date_posted'    => trim($_POST['date_posted']),
      'title'          => $this->settings['title_template'],
      'story'          => $this->settings['story_template'],
      'views'          => 0,
   );
  }

  function addBlog($userid) {

   global $config;

   $this->data = array(
      $this->userfield => $userid,
      'date_posted'    => trim($_POST['date_posted']),
      'title'          => strip_tags(trim($_POST['title'])),
      'story'          => trim($_POST['story']),
      'views'          => 0,
   );

    $this->validateBlogDate();
    $this->validateBlogTitle();
    $this->validateBlogStory();

    // If a user reached the limit, don't allow any new stories
    //
    if ( ! $this->admin && $this->getStoryCount($userid) >= $config['max_blog_stories'] ) {

        $this->setErrorMessage( get_lang('blog_errors', 'max_stories_warning') );
    }

	if ($this->data['story'] == "") {

        $this->setErrorMessage( get_lang('blog_errors', 'story_noblank') );

	}

	if ($this->data['title'] == "") {

        $this->setErrorMessage( get_lang('blog_errors', 'title_noblank') );

	}
   if ( ! $this->getErrorMessage() ) {
		$this->osDB->query('insert into ! ('.$this->userfield.', date_posted, title, story, views) values (?, ?, ?, ?, ?)',array(BLOG_STORY_TABLE, $userid, $this->data['date_posted'], $this->data['title'], $this->data['story'], $this->data['views']) );
/*      $this->osDB->autoExecute(BLOG_STORY_TABLE, $this->data,'INSERT'); */
      // If the user checked the save template box, save this as the template
      if ( isset($_POST['save_template']) ) {

         $story_template = trim($_POST['story']);
         $title_template = trim($_POST['title']);

         $this->osDB->query( "UPDATE ! SET story_template = ?, title_template = ? WHERE " . $this->userfield . " = ?", array(BLOG_PREFERENCES_TABLE, $story_template, $title_template, $userid));
      }
    }
  }
  function editBlog($blog_id) {

   $this->data = array(
      'date_posted'  => trim($_POST['date_posted']),
      'title'        => trim($_POST['title']),
      'story'        => trim($_POST['story']),
   );

    $this->validateBlogDate();
    $this->validateBlogTitle();
    $this->validateBlogStory();

   if ( ! $this->getErrorMessage() ) {

		$this->osDB->query('update ! set date_posted=?, title=?, story=? where id=?', array(BLOG_STORY_TABLE, $this->data['date_posted'], $this->data['title'], $this->data['story'], $blog_id) );

/*      $this->osDB->autoExecute(BLOG_STORY_TABLE, $this->data, 'UPDATE', "id = '$blog_id'");  */

    }
  }
  function addBlogView($blog_id, $userid) {

    // Don't increment counter if it's the users looking at his own blog to edit
    //
    $this->osDB->query("UPDATE ! SET views = (views + 1) WHERE id = ? AND  " . $this->userfield . " <> ? ", array(BLOG_STORY_TABLE, $blog_id, $userid));

  }
  function addBlogVote($blog_id, $userid, $vote) {

    $found = $this->osDB->getOne("SELECT id FROM ! WHERE storyid = ? AND " . $this->userfield . " = ?", array(BLOG_VOTE_TABLE, $blog_id, $userid));

    if ( isset($found) && $found  > 0) {

      $this->osDB->query("UPDATE ! SET vote = ? WHERE storyid = ? AND " . $this->userfield . " = ?", array(BLOG_VOTE_TABLE, $vote, $blog_id, $userid));
    } else {

		$this->osDB->query('insert into ! (vote, storyid, '.$this->userfield.') values (?, ?, ?)', array(BLOG_VOTE_TABLE, $vote, $blog_id, $userid) );
    }
  }
  function getVotes($story_id) {

    // Don't increment counter if it's the users looking at his own blog to edit
    //
    $votes = $this->osDB->getRow("SELECT ROUND(AVG(vote),0) AS votes, COUNT(vote) AS num_votes FROM !  WHERE storyid = ? ", array(BLOG_VOTE_TABLE, $story_id) );

    if ( ! isset($votes['votes']) ) {

        $votes['votes'] = 0;
    }
    if ( !  isset($votes['num_votes']) ) {

        $votes['num_votes'] = 0;
    }
    return $votes;
  }


  function deleteStory($id) {

    $this->osDB->query("DELETE FROM ! WHERE id = ?", array(BLOG_STORY_TABLE,$id));
  }
  // Delete the comment if the userid is the owner of the comment's blog story
  //
  function deleteComment($id, $userid) {

    // Get the blog id from the comment
    $this->loadComment($id);

    // See if the blog belongs to the user
    //
    $this->loadBlog($this->comment['blogid']);

    if ( $this->data[ $this->userfield ] ==  $userid ) {

         $this->osDB->query("DELETE FROM ! WHERE id = ?", array(BLOG_COMMENTS_TABLE,$id));
    } else {

      $this->setErrorMessage("You must own the blog to delete");
    }
  }
  // Delete the comment if the userid is the owner of the comment's blog story
  //
  function adminDeleteComment($id) {
         $this->osDB->query("DELETE FROM ! WHERE id = ?", array(BLOG_COMMENTS_TABLE,$id));
  }

  function multipleDeleteStory($ids) {

    foreach ( $ids AS $key => $value ) {

        $this->deleteStory($value);
    }
  }
  function getAllStories($userid, $title_image_tn_size = 'N') {

	if ($userid > 0) {
		$recs = $this->osDB->getAll(" SELECT s.id, s.userid, s.adminid, s.date_posted, s.title, s.story, s.views, IF(ROUND(AVG(v.vote),0) IS NULL,0, ROUND(AVG(v.vote),0)) AS votes, COUNT(v.vote) AS num_votes FROM ! s LEFT JOIN ! v ON s.id = v.storyid
		  WHERE  s." . $this->userfield . " = ? GROUP BY s.id ORDER by " . $this->SortOrder('date_posted DESC'), array( BLOG_STORY_TABLE, BLOG_VOTE_TABLE, $userid ) );
	} else {
		$recs = $this->osDB->getAll(" SELECT s.id, s.userid, s.adminid, s.date_posted, s.title, s.story, s.views, IF(ROUND(AVG(v.vote),0) IS NULL,0, ROUND(AVG(v.vote),0)) AS votes, COUNT(v.vote) AS num_votes FROM ! s LEFT JOIN ! v ON s.id = v.storyid
		  WHERE  s." . $this->userfield . " <> ? GROUP BY s.id ORDER by " . $this->SortOrder('date_posted DESC'), array( BLOG_STORY_TABLE, BLOG_VOTE_TABLE, $_SESSION['UserId'] ) );		
	}
	$stories = array();

	if (isset($recs) && is_array($recs) && count($recs) > 0) {
		foreach ($recs as $rec) {

			if (isset($rec['userid']) && $rec['userid'] > 0) {
				$rec['username'] = $this->osDB->getOne('select username from ! where id = ?', array(USER_TABLE,$rec['userid']) );
			}
			if (substr_count(strtolower($rec['title']),'<img')>0) {
				/* Image in title. Let us limit the size */
				if ($title_image_tn_size == 'Y') {
					/* Thymbnail image sizing */
					$width = $this->blog_title_image_tn_width;
					$height = $this->blog_title_image_tn_height;
				} else {
					$width = $this->blog_title_image_width;
					$height = $this->blog_title_image_height;
				}
				$rec['title'] = str_replace('<img','<img height="'.$height.'" width="'.$width.'" ',$rec['title']);
				$rec['short_title'] = $rec['title'];
			} else {
				$rec['short_title'] = substr($rec['title'],0,75);
			}
			$rec['short_title'] = str_replace('<p>','',$rec['short_title']);
			$rec['short_title'] = str_replace('</p>','&nbsp;',$rec['short_title']);
			$rec['title'] = addslashes($rec['title']);
			$stories[] = $rec;
		}
	}
	unset($recs);

	return $stories;
  }

  function getAllAdminStories($title_image_tn_size = 'N', $cnt = 0) {

	if ($cnt > 0) {
	    $recs=  $this->osDB->getAll(" SELECT s.id, s.userid, s.adminid, s.date_posted, s.title, s.story, s.views, IF(ROUND(AVG(v.vote),0) IS NULL,0, ROUND(AVG(v.vote),0)) AS votes, COUNT(v.vote) AS num_votes FROM ! s LEFT JOIN ! v ON s.id = v.storyid WHERE  s.adminid > 0      GROUP BY s.id ORDER by date_posted DESC limit !", array( BLOG_STORY_TABLE, BLOG_VOTE_TABLE, $cnt ) );
	} else {
	    $recs=  $this->osDB->getAll(" SELECT s.id, s.userid, s.adminid, s.date_posted, s.title, s.story, s.views, IF(ROUND(AVG(v.vote),0) IS NULL,0, ROUND(AVG(v.vote),0)) AS votes, COUNT(v.vote) AS num_votes FROM ! s LEFT JOIN ! v ON s.id = v.storyid WHERE  s.adminid > 0      GROUP BY s.id ORDER by date_posted DESC", array( BLOG_STORY_TABLE, BLOG_VOTE_TABLE ) );
	}
	$stories = array();

	if (isset($recs) && is_array($recs) && count($recs) > 0) {
		foreach ($recs as $rec) {

			if (substr_count(strtolower($rec['title']),'<img')>0) {
				/* Image in title. Let us limit the size */
				if ($title_image_tn_size == 'Y') {
					/* Thymbnail image sizing */
					$width = $this->blog_title_image_tn_width;
					$height = $this->blog_title_image_tn_height;
				} else {
					$width = $this->blog_title_image_width;
					$height = $this->blog_title_image_height;
				}
				$rec['title'] = str_replace('<img','<img height="'.$height.'" width="'.$width.'" ',$rec['title']);
				$rec['short_title'] = $rec['title'];
			} else {
				$rec['short_title'] = substr($rec['title'],0,75);
			}

			$rec['short_title'] = str_replace('<p>','',$rec['short_title']);
			$rec['short_title'] = str_replace('</p>','&nbsp;',$rec['short_title']);

			$rec['title'] = addslashes($rec['title']);
			$stories[] = $rec;
		}
	}
	unset($recs);

	return $stories;
  }

  function getAllUserStories($title_image_tn_size = 'N', $cnt=0) {

	if ($cnt > 0) {
	    $recs = $this->osDB->getAll("SELECT s.id, s.userid, s.adminid, s.date_posted, s.title, s.story, s.views, IF(ROUND(AVG(v.vote),0) IS NULL,0, ROUND(AVG(v.vote),0)) AS votes, COUNT(v.vote) AS num_votes FROM ! s LEFT JOIN ! v ON s.id = v.storyid WHERE  s.userid > 0 GROUP BY s.id ORDER by date_posted DESC limit !", array( BLOG_STORY_TABLE, BLOG_VOTE_TABLE, $cnt ) );
	} else {
	    $recs = $this->osDB->getAll("SELECT s.id, s.userid, s.adminid, s.date_posted, s.title, s.story, s.views, IF(ROUND(AVG(v.vote),0) IS NULL,0, ROUND(AVG(v.vote),0)) AS votes, COUNT(v.vote) AS num_votes FROM ! s LEFT JOIN ! v ON s.id = v.storyid WHERE  s.userid > 0 GROUP BY s.id ORDER by date_posted DESC", array( BLOG_STORY_TABLE, BLOG_VOTE_TABLE ) );
	}
	$stories = array();
	
	if (isset($recs) && is_array($recs) && count($recs) > 0) {
		foreach ($recs as $rec) {

			if (substr_count(strtolower($rec['title']),'<img')>0) {
				/* Image in title. Let us limit the size */
				if ($title_image_tn_size == 'Y') {
					/* Thymbnail image sizing */
					$width = $this->blog_title_image_tn_width;
					$height = $this->blog_title_image_tn_height;
				} else {
					$width = $this->blog_title_image_width;
					$height = $this->blog_title_image_height;
				}
				$rec['title'] = str_replace('<img','<img height="'.$height.'" width="'.$width.'" ',$rec['title']);
				$rec['short_title'] = $rec['title'];
			} else {
				$rec['short_title'] = substr($rec['title'],0,75);
			}
			$rec['short_title'] = str_replace('<p>','',$rec['short_title']);
			$rec['short_title'] = str_replace('</p>','&nbsp;',$rec['short_title']);

			$rec['title'] = addslashes($rec['title']);
			$stories[] = $rec;
		}
	}
	unset($recs);
	return $stories;

  }

  function getAllComments($blog_id) {

    return $this->osDB->getAll(" SELECT c.*,
                  IF(
                     IF(u.id IS NULL, a.username ,u.username ) IS NULL,
                     'Anonymous',
                     IF(u.id IS NULL, a.username ,u.username )
                     ) AS username
            FROM ! c LEFT JOIN ".USER_TABLE." u  ON c.userid = u.id
            LEFT JOIN ".ADMIN_TABLE." a ON c.adminid = a.id
            WHERE  blogid = ? ORDER by c.id DESC", array( BLOG_COMMENTS_TABLE, $blog_id ) );
  }
  // Return the story count for a user
  //
  function getStoryCount($userid) {

    // If not admin, check the story count
    //
    if ( ! $this->admin ) {
		$field = 'userid';
    } else {
		$field = 'adminid';
	}
    return ($this->osDB->getOne("SELECT COUNT(id) FROM ! WHERE ! = ?", array(BLOG_STORY_TABLE , $field,  $userid ) ) ) ;
  }
  function getCommentCount($blog_id) {

    return $this->osDB->getOne("SELECT COUNT(id) FROM ! WHERE  blogid = ?", array(BLOG_COMMENTS_TABLE , $blog_id ) );
  }

  function getUserCommentCount($blog_id, $userid) {

    return $this->osDB->getOne("SELECT COUNT(id) FROM ! WHERE  blogid = ? AND ! = ?", array(BLOG_COMMENTS_TABLE, $blog_id, $this->userfield, $userid) );
  }

  function getUserVotesCount($blog_story_id, $userid) {

     return $this->osDB->getRow("SELECT * FROM ! WHERE  storyid = ? AND userid = ?", array(BLOG_VOTE_TABLE, $blog_story_id, $userid) );

  }
  // If a blog settings entry exists, return true
  //
  function getOldestDate($type, $userid) {

	if ($type == 'admin') {
		$field = 'adminid';
	} else {
		$field = 'userid';
	}
    return ($this->osDB->getOne("SELECT min(date_posted) FROM ! WHERE ! = ? ", array(BLOG_STORY_TABLE, $field, $userid ) ) );

  }
  function blogExist($userid) {

    return $this->osDB->getOne( "SELECT id FROM ! WHERE  ! = ?", array( BLOG_STORY_TABLE, $this->userfield, $userid ) );
  }
  function validateSettingsName() {

     //$field_name ,$desc ,$type ,$min_len, $max_len, $blank_ok, $duplicate_ok) {
     if ( ! $this->valid->validate('name'  ,'Blog Name'  ,'text'   ,5 ,255   ,0, 1) ) {

        $this->setErrorMessage($this->valid->get_error_message() );
     }
  }
  function validateSettingsDescription() {

     //$field_name ,$desc ,$type ,$min_len, $max_len, $blank_ok, $duplicate_ok) {
     if ( ! $this->valid->validate('description' ,'Blog Description' ,'text' ,0 ,64000   ,0, 1) ) {

        $this->setErrorMessage($this->valid->get_error_message() );
     }
  }
  function validateSettingsMembersComment() {

     //$field_name ,$desc ,$type ,$min_len, $max_len, $blank_ok, $duplicate_ok) {
     if ( ! $this->valid->validate('members_comment' ,'Members Comment' ,'number' ,0 ,1   ,0, 1) ) {

        $this->setErrorMessage($this->valid->get_error_message() );
     }
  }
  function validateSettingsBuddiesComment() {

     //$field_name ,$desc ,$type ,$min_len, $max_len, $blank_ok, $duplicate_ok) {
     if ( ! $this->valid->validate('buddies_comment' ,'Buddies Comment' ,'number' ,0 ,1   ,0, 1) ) {

        $this->setErrorMessage($this->valid->get_error_message() );
     }
  }
  function validateSettingsMembersVote() {

     //$field_name ,$desc ,$type ,$min_len, $max_len, $blank_ok, $duplicate_ok) {
     if ( ! $this->valid->validate('members_vote' ,'Members Vote' ,'number' ,0 ,1   ,0, 1) ) {

        $this->setErrorMessage($this->valid->get_error_message() );
     }
  }
  function validateSettingsGuiEditor() {

     //$field_name ,$desc ,$type ,$min_len, $max_len, $blank_ok, $duplicate_ok) {
     if ( ! $this->valid->validate('gui_editor' ,'GUI Editor' ,'number' ,0 ,1   ,0, 1) ) {

        $this->setErrorMessage($this->valid->get_error_message() );
     }
  }
  function validateSettingsMaxComments() {

     //$field_name ,$desc ,$type ,$min_len, $max_len, $blank_ok, $duplicate_ok) {
     if ( ! $this->valid->validate('max_comments' ,'Max Comments' ,'number' ,0 ,11 ,0, 1) ) {

        $this->setErrorMessage($this->valid->get_error_message() );
     }
  }
  function validateSettingsBadWords() {

     // Make sure the words are in alphabetical order and have proper cr delimited
     //
     $word_list = strtolower($this->valid->data_in['bad_words']);
     $word_array = preg_split("/\s+/", $word_list);

     // Sort
     //
     asort($word_array);

     // Change back to cr delimited and save
     //
     $word_list  = join(" ", $word_array);
     $this->valid->data_in['bad_words'] = $word_list;

     //$field_name ,$desc ,$type ,$min_len, $max_len, $blank_ok, $duplicate_ok) {
     if ( ! $this->valid->validate('bad_words' ,'Bad Words' ,'name' ,0 ,64000 ,0, 1) ) {

        $this->setErrorMessage($this->valid->get_error_message() );
     } else {
         // If no error, put the clean formated list here to use
         $this->settings['bad_words'] = join("\n\r", $word_array);
     }
  }
  function saveSettings($userid) {

	$this->settings = array(
	  $this->userfield => $userid,
	 'name'            => strip_tags(trim($_POST['name'])),
	 'description'     => $_POST['description'],
	 'members_comment' => $_POST['members_comment'] || 0,
	 'buddies_comment' => $_POST['buddies_comment'] || 0,
	 'members_vote'    => $_POST['members_vote'] || 0,
	 'gui_editor'      => $_POST['gui_editor'] || 0,
	 'max_comments'    => $_POST['max_comments'],
	 'bad_words'       => strip_tags($_POST['bad_words']),
	);
	// Validate data
	//

	$this->validateSettingsName();
	$this->validateSettingsDescription();
	$this->validateSettingsMembersComment();
	$this->validateSettingsBuddiesComment();
	$this->validateSettingsMembersVote();
	$this->validateSettingsGuiEditor();
	$this->validateSettingsMaxComments();
	$this->validateSettingsBadWords();

	if ($this->settings['name'] == "") {

        $this->setErrorMessage( get_lang('blog_errors', 'name_noblank') );

	}

	if ($this->settings['description'] == "") {

        $this->setErrorMessage( get_lang('blog_errors', 'description_noblank') );

	}

	if ( ! $this->getErrorMessage() ) {
		$blog_id = $this->osDB->getOne( "SELECT id FROM ! WHERE  ! = ?", array( BLOG_PREFERENCES_TABLE, $this->userfield, $userid ) );

		// If record exists, add it.
		if ( $blog_id ) {

			$updsql = "update ! set name=?, description=?, members_comment=?, buddies_comment=?, members_vote=?, gui_editor=?, max_comments=?, bad_words=? where id=?";
			$this->osDB->query($updsql,array(BLOG_PREFERENCES_TABLE, $this->settings['name'], $this->settings['description'], $this->settings['members_comment'], $this->settings['buddies_comment'], $this->settings['members_vote'], $this->settings['gui_editor'], $this->settings['max_comments'], $this->settings['bad_words'], $blog_id) );

			/*			$this->osDB->autoExecute(BLOG_PREFERENCES_TABLE, $this->settings, 'UPDATE', "id = '$blog_id'");  */
		} else {
		// Otherwise, update it
			$inssql = 'insert into ! ('.$this->userfield.', name, description, members_comment, buddies_comment, members_vote, gui_editor, max_comments, bad_words) values (?, ?, ?, ?, ?, ?, ?, ?, ?)';
			$this->osDB->query($inssql,array(BLOG_PREFERENCES_TABLE, $userid, $this->settings['name'], $this->settings['description'], $this->settings['members_comment'], $this->settings['buddies_comment'], $this->settings['members_vote'], $this->settings['gui_editor'], $this->settings['max_comments'], $this->settings['bad_words']) );

		/*		$this->osDB->autoExecute(BLOG_PREFERENCES_TABLE, $this->settings,'INSERT');  */
		}
	}
  }
  function loadComment($comment_id) {

     $this->comment = $this->osDB->getRow( "SELECT * FROM ! WHERE id = ?", array( BLOG_COMMENTS_TABLE, $comment_id ) );
   }
  // Get's the settings from the database
  //
  function loadBlog($blog_id) {

     $this->data = $this->osDB->getRow( "SELECT * FROM ! WHERE id = ?", array( BLOG_STORY_TABLE, $blog_id ) );


     // If no settings found, reset them to the default settings
     if ( ! $this->data['id'] ) {

        $this->setDefaultData();
     } else {

        if ( $this->data['adminid'] > 0 ) {

            $user_data = $this->getAdminRec( $this->data['adminid'] );
        } else {

            $user_data = $this->getUserRec( $this->data['userid'] );
        }
        if ( is_array($user_data) ) {

          $this->data = array_merge($user_data, $this->data);
        }
     }

 	$this->data['date_posted'] = strtotime($this->data['date_posted']);
     $votes = $this->getVotes($blog_id);
     $this->data['votes']     = $votes['votes'];
     $this->data['num_votes'] = $votes['num_votes'];

  }
  // Get's the settings from the database
  //
  function loadSettings($userid) {
     $this->settings = $this->osDB->getRow( "SELECT * FROM ! WHERE  ! = ?", array( BLOG_PREFERENCES_TABLE, $this->userfield, $userid ) );

     // If no settings found, reset them to the default settings
     if ( !isset( $this->settings['id']) ) {

        $this->setDefaultSettings();
     }


  }
  // Makes the settings form friendly
  //
  function prepComment() {

      foreach ( $this->comment AS $key => $value ) {

          $this->comment[$key] = $this->formFriendly($value);
      }
  }
  function prepSettings() {

      foreach ( $this->settings AS $key => $value ) {

          $this->settings[$key] = $this->formFriendly($value);
      }
  }
  // Makes the blog data form friendly
  //
  function prepData() {

      foreach ( $this->data AS $key => $value ) {

          $this->data[$key] = $this->formFriendly($value);
      }
  }

  // Prepares data to display in a form
  //
  function formFriendly($string) {

    return htmlentities(stripslashes($string), ENT_QUOTES);
  }
  function getData() {

    return $this->data;
  }
  function getSettings() {

    return $this->settings;
  }
  function getComment() {

    return $this->comment;
  }
  function setErrorMessage($message) {

    $this->errorMessage = $message;
  }
  function getErrorMessage() {

    return $this->errorMessage;
  }
  function SortLink($label,$field) {

      $value = $this->sort_page_values;

      $value['sortField'] = $field;

      if ( array_key_exists('sortField', $_REQUEST) && $_REQUEST['sortField'] == $field && $_REQUEST['sortDir'] == 'ASC' ) {

         $value['sortDir'] = 'DESC';
      } elseif ( array_key_exists('sortField', $_REQUEST) && $_REQUEST['sortField'] == $field && $_REQUEST['sortDir'] == 'DESC' ) {

         $value['sortDir'] = 'ASC';
      } else {

         $value['sortDir'] = 'ASC';
      }
      return '<a href="' . $this->sort_page . '?' . $this->formValues($value) . '">' . $label . '</a>';
   }
   function SortOrder($default) {

      if ( array_key_exists('sortField', $_REQUEST) && $_REQUEST['sortField'] ) {

		$order_by = $_REQUEST['sortField'] . ' ' . $_REQUEST['sortDir'];
      } else {

         $order_by = $default;
      }
      return $order_by;
   }

   function formValues($form_values) {

      $line = '';

      if ( is_array($form_values) ) {

         while(list($k,$v)=each($form_values)) {

            $line .= "&amp;" . $k . "=$v";
         }
      }
      return $line;
   }

   function deleteUserBlog($userid) {
	  /* This function will delete all blog references for the given userid */
		/* First get all blogs owned by this user */


   }

}
?>