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

if ( !defined( 'SMARTY_DIR' ) ) {
	include_once( 'init.php' );
}


if( isset($_GET['username']) && $_GET['username'] != '') {
	$userid = $osDB->getOne( 'SELECT id FROM ! WHERE username = ? AND status = ? ', array( USER_TABLE, $_GET['username'], 'active' ) );

     $_REQUEST['id'] = $userid;
	if (!$userid || $userid =='') {
		/* No such user. Display error message and exit */
		$t->assign('error_message', get_lang('no_such_user'));
		$t->assign('errid',"999");
		$t->assign('rendered_page', $t->fetch('nickpage.tpl'));
		$t->display('index.tpl');
		exit;
	}
}


if(isset($_REQUEST['id']) &&  $_REQUEST['id'] != '' && (int)$_REQUEST['id'] != 0 ){

	if (isset($_REQUEST['action']) && $_REQUEST["action"] == "removecomment") {

		$osDB->query( 'UPDATE ! SET reply = ? WHERE id = ?', array( USER_RATING_TABLE, '', $_REQUEST["commentid"] ) );

	}

	$user = $osDB->getRow('SELECT id, username , level, country , firstname , lastname, gender , lookgender, state_province , lastvisit, about_me, couple_usernames,
		picture , city , county, floor((to_days(curdate())-to_days(birth_date))/365.25)  as age
		FROM ! WHERE id = ? AND status <> ?' ,array( USER_TABLE, $_REQUEST['id'], 'suspend' ));

	if (!$user || $user['id'] != $_REQUEST['id']) {
		/* No such user. Display error message and exit */
		$t->assign('error_message', get_lang('no_such_user'));
		$t->assign('errid',"999");
		$t->assign('rendered_page', $t->fetch('nickpage.tpl'));
		$t->display('index.tpl');
		exit;
	}

	if (isset($_SESSION['UserId']) && $_SESSION['UserId'] > 0) {
		$is_banned = $osDB->getOne('select 1 from ! where act = ? and ((userid = ? and ref_userid = ?) or (userid = ? and ref_userid = ?))',array(BUDDY_BAN_TABLE, 'B', $_SESSION['UserId'], $user['id'],$user['id'], $_SESSION['UserId']) );
		$user['is_banned'] = ($is_banned == 1)?1:0;
	}
	/* Get countryname and statename */
	$user['countryname'] = getCountryName( $user['country'] );

	$user['statename'] = getStateName( $user['country'], $user['state_province'] );

	$user['m_status'] = checkOnlineStats( $user['id']  );

	$user['pub_pics'] = $osDB->getAll('select picno, pic_descr from ! where userid=? and (album_id is null or album_id = 0) order by picno', array(USER_SNAP_TABLE, $user['id']) );

	$dataSections = $osDB->getAll( 'SELECT sect.* FROM ! sect WHERE sect.enabled = ? and sect.id in (select distinct section from ! where gender in (?,?)) ORDER BY displayorder', array( SECTIONS_TABLE, 'Y', QUESTIONS_TABLE,$user['gender'],'A'   ) );

	$user['countyname'] = getCountyName( $user['country'], $user['state_province'], $user['county']  );

	$found = false;

	foreach( $dataSections as $section ){
		$prefs = array();

		$rsPref = $osDB->getAll( 'SELECT DISTINCT q.id, q.question, q.extsearchhead,
			q.control_type as type FROM ! pref INNER JOIN ! q ON pref.questionid = q.id WHERE pref.userid = ? AND q.section = ?  and q.gender in (?,?) and q.enabled = ? ORDER BY q.displayorder ',array( USER_PREFERENCE_TABLE, QUESTIONS_TABLE, $_REQUEST['id'], $section['id'],$user['gender'],'A','Y') );

		foreach( $rsPref as $row ){

			if ($_SESSION['opt_lang'] != 'english') {
			/* THis is made to adjust for multi-language */
				$lang_question = $_SESSION['profile_questions'][$row['id']]['question'];
				$lang_extsearchhead = $_SESSION['profile_questions'][$row['id']]['extsearchhead'];
				if ($lang_question != '') {
					$row['question'] = $lang_question;
					$row['extsearchhead'] = $lang_extsearchhead;
				}
			}

			if ($row['type'] != 'textarea') {

				$rsOptions = $osDB->getAll('SELECT distinct pref.answer as answer, opt.answer as anstxt from ! pref left join ! opt on pref.questionid = opt.questionid and opt.id = pref.answer where pref.userid = ? and opt.questionid = ? order by opt.questionid, opt.displayorder', array( USER_PREFERENCE_TABLE, OPTIONS_TABLE, $_REQUEST['id'], $row['id'] ) );

			} else {

				$rsOptions = $osDB->getAll('select distinct pref.answer as answer, pref.answer as anstxt from ! pref where pref.userid = ? and pref.questionid = ?', array( USER_PREFERENCE_TABLE, $_REQUEST['id'], $row['id'] ) );
			}

			$opts = array();
			foreach( $rsOptions as $key=>$opt ){
				if ($_SESSION['opt_lang'] != 'english') {
				/* THis is made to adjust for multi-language */
					$lang_ansopt = isset($_SESSION['profile_questions'][$row['id']][$opt['answer']])?$_SESSION['profile_questions'][$row['id']][$opt['answer']]:'';
					if ($lang_ansopt != '') {$opts[] = $lang_ansopt;
					}else{ $opts[] = $opt['anstxt'];}
				} else {
					$opts[] = $opt['anstxt'];
				}
			}

			if (count($opts)>0) {
				$optsPhr = implode( ', ', $opts);
			} else {
				$optsPhr = "";
			}

			$row['options'] = $optsPhr;
			unset($optsPhr, $rsOptions, $opts);

			$prefs[] = $row;

			$found = true;
		}

		if( count($prefs) > 0 ){

			$pref[] = array( 'SectionName' => $lang['sections'][$section['id']], 'preferences' => $prefs, 'SectionId' => $section['id'] );
		}
	}

	unset($dataSections, $rsPref);


	if (isset($_SESSION['UserId']) && $_SESSION['UserId']>0) {

	     $in_savedprofiles = $osDB->getOne('select count(*) from ! where userid = ? and ref_userid = ?', array( USER_WATCHED_PROFILES, $_SESSION['UserId'], $_REQUEST['id'] ) );

		$t->assign('in_savedprofiles', $in_savedprofiles);

	}

	hasRight('');
	$cplusers = array();

	if ($user['couple_usernames'] != '' && $user['gender'] == 'C') {

		foreach (explode(',',$user['couple_usernames']) as $cpl) {
			$refuid = $osDB->getOne('select id from ! where username = ?', array(USER_TABLE, trim($cpl)));

			$cplusers[]=array('username' => trim($cpl),
								'uid' => $refuid) ;
		}

		$user['cplusers'] = $cplusers;
		unset($cplusers);
	}

	$t->assign('title',str_replace('USERNAME', $user['username'], get_lang('profile_s')) );

	$t->assign( 'user', $user );

	unset($user);

	$arr = array();

	for( $i=-5; $i<=5; $i++ ) {
		$arr[$i] = $i;
	}

	$t->assign ( 'rate_values', $arr );

	unset($arr);
	/* MOD START */

	if (isset($_REQUEST['txtrating']))  $rt = $_REQUEST['txtrating'] + 0;

	if (isset($_GET['action']) && $_GET["action"] == "rate" && ($rt > 0 && $rt <= 10)) {

		$alreadyrated = $osDB->getOne('select count(ratingid) from ! where userid = ? and profileid = ?  and ratingid = ? ', array(USER_RATING_TABLE,$_SESSION['UserId'],$_GET['id'], $_GET['ratingid']) );
		if ($alreadyrated <= 0) {
			$osDB->query( 'INSERT INTO ! ( userid, profileid, rating, rate_time, ratingid, rating_date ) VALUES (  ?, ?, ?, ?, ?, ? )', array( USER_RATING_TABLE, $_SESSION['UserId'], $_GET['id'], $rt, time(), $_REQUEST['ratingid'], date("Y/m/d") ) );
		}
	}


	if (isset($_REQUEST['action']) && $_REQUEST["action"] == "comment") {

		$commented = $osDB->getOne('select comment from ! where userid = ? and profileid = ? and ratingid = ?', array(USER_RATING_TABLE,$_SESSION['UserId'], $_REQUEST['id'],$_REQUEST['ratingid']) );
		if ($commented == '') {
			$osDB->query( 'update ! set comment=? , comment_date=? where userid=? and profileid=? and ratingid=?', array( USER_RATING_TABLE, substr(stripEmails(strip_tags($_POST["txtcomment"])),0,250), date("Y/m/d"), $_SESSION['UserId'], $_REQUEST['id'], $_REQUEST['ratingid']) );
		}
	}

	// record reply //

	if (isset($_GET['action']) && $_GET["action"] == "reply") {

		$osDB->query( 'UPDATE ! SET reply = ? WHERE id = ?', array( USER_RATING_TABLE, strip_tags($_POST["txtcomment"]), $_GET["commentid"] ) );

	}

	// get ratings //

	if (isset($_REQUEST['id']) ) {
	     $t->assign( 'profileid', $_REQUEST['id'] );
	}
	if (isset($_REQUEST['ratingid']) ) {

		$t->assign( 'ratingid', $_GET['ratingid'] );
	}
	$data = $osDB->getAll( 'SELECT id, rating, displayorder, enabled, description from ! where enabled = ? order by displayorder asc ', array(RATINGS_TABLE, 'Y') );

	$total_ratingscnt = 0;

	$newdata = array();

	foreach ($data as $item) {

		// comment count //

		$futuredate1 = date("Y/m/d", mktime(0,0,0,date("m"),(date("d") - $config['mod_rating_rem_com']),date("Y")));

		$comments = $osDB->getAll('SELECT distinct rat.id, rat.comment, rat.reply, rat.userid, usr.username FROM ! as rat, ! as usr WHERE rat.profileid = ? and rat.ratingid = ? and rat.comment <> ? and rat.comment_date >= ? and usr.id = rat.userid', array( USER_RATING_TABLE, USER_TABLE, $_REQUEST['id'], $item['id'], '', $futuredate1 ) );

		$item["commentcount"] = count($comments);

		$item['comments'] = $comments;

		unset($comments);
		// rating count //

		$futuredate2 = date("Y/m/d", mktime(0,0,0,date("m"),(date("d") - $config['mod_rating_rem_rat']),date("Y")));

		$ratingcount = $osDB->getOne('SELECT count(id) as ratingcount FROM ! WHERE profileid = ? and ratingid = ? and rating > ? and rating_date >= ?', array( USER_RATING_TABLE, $_REQUEST['id'], $item["id"], '0', $futuredate2 ) );

		$item["ratingcount"] = $ratingcount;

		$total_ratingscnt += $ratingcount;

		// rating value //

		$rowrate = $osDB->getRow('SELECT count(rating) as tv , sum(rating) as sm FROM ! WHERE profileid = ? and ratingid = ? and rating > ? and rating_date >= ?', array( USER_RATING_TABLE, $_REQUEST['id'], $item["id"], '0', $futuredate2 ) );

		$tv = $rowrate['tv'];

		$sm = $rowrate['sm'];

		unset($rowrate);

		if ( $tv == 0 ) {

			$ratingvalue = 0;

		} else {

			$tv = ($tv == 0) ? 1 : $tv;

			$ratingvalue = round( $sm / $tv );

		}

		$item["ratingvalue"] = $ratingvalue;

		// check user has already rated //

		if ( isset($_SESSION['UserId']) && isset($_GET['id']) && $_SESSION['UserId'] != $_GET["id"] ) {

			$c = $osDB->getOne( 'SELECT count(*) as c  FROM !  WHERE userid = ? AND profileid = ? and ratingid = ? and rating > ?', array( USER_RATING_TABLE, $_SESSION['UserId'], $_REQUEST['id'], $item["id"], '0' ));

			if ( $c == 0 ) {
				$item["has_rated"] = '0';
			}else {
				$item["has_rated"] = '1';
			}

		}

		if ( isset($_SESSION['UserId']) && isset($_GET['id']) && $_SESSION['UserId'] != $_GET["id"] ) {

			$c = $osDB->getOne( 'SELECT count(*) as c  FROM !  WHERE userid = ? AND profileid = ? and ratingid = ? and comment <> ?', array( USER_RATING_TABLE, $_SESSION['UserId'], $_REQUEST['id'], $item["id"],' ' ));

			if ( $c == 0 ) {
				$item["has_commented"] = '0';
			}else {
				$item["has_commented"] = '1';
			}

		}

		// check if user has already commented //

		array_push($newdata, $item);

	}

	$t->assign('total_ratingscnt', $total_ratingscnt);

	$t->assign( 'ratings', $newdata );

	unset($newdata, $data, $item);
	// get options //

	$optionlist = array();
	$optionlist_note = array();

	$div = $config['mod_rating_inc'] - 1;

	for($i=$config['mod_rating_min']; $i<=$config['mod_rating_max']; $i++) {

		$div++;

		if ($i == $config['mod_rating_min']) {

			$thename = "&nbsp;".get_lang('worst1');

		} else if ($i == $config['mod_rating_max']) {

			$thename = "&nbsp;".get_lang('best1');

		} else {

			$thename = "";

		}

		if ($div == $config['mod_rating_inc']) {

			$temparray = array();

			$temparray["name"] = $i . $thename;
			$temparray["value"] = $i;

			array_push($optionlist, $temparray);

			$div = 0;

		}

	}

	if ($config['mod_rating_inc_order'] == "High to Low") {

		$optionlist = array_reverse($optionlist);

	}

	$t->assign( 'ratingoptions', $optionlist );

	unset($optionlist);


	/* MOD END */

	if( $found ){

		$t->assign ( 'found', 1);

		$t->assign( 'pref', $pref);

	}

	/* Now add this view to profile_views table, if no user logged, make it -1  */

	$byuser = (isset($_SESSION['UserId']) && $_SESSION['UserId']>0)?$_SESSION['UserId']:-1;

     if (isset($_SESSION['UserId']) && $_REQUEST['id'] != $_SESSION['UserId'] && !isset($_REQUEST['ratingid']) && $byuser != '-1') {

          $osDB->query('insert into ! (userid, ref_userid, act_time, act) values (?, ?, ?, ?)', array( VIEWS_WINKS_TABLE, $_REQUEST['id'], $byuser, time(), 'V' ) );

	}

     $t->assign('profile_views', $osDB->getOne('select count(*) from ! where userid = ? and act = ?', array( VIEWS_WINKS_TABLE, $_REQUEST['id'], 'V' ) ) );

	if (isset($_GET['errid']) ) {
		$t->assign("error_message", get_lang('errormsgs',$_GET['errid']));
	}
      // If there's a blog show this user the blog link
      //
      include_once(LIB_DIR . 'blog_class.php');

      $blog =& new Blog();

      if ( $blog->blogExist($_REQUEST['id'])  ) {

         $view_blog = get_lang('view_blog');
         $blog->loadSettings($_REQUEST['id']);

         $t->assign('blogs', $blog->getAllStories($_REQUEST['id']) );
         $t->assign('bpref',  $blog->getSettings() );
         $t->assign('lang',  $lang );
      }
      // Make the blog sort links
      //
      $blog->sort_page_values = array(
			'id'   => $_REQUEST['id'],
      );
      $blog->sort_page = 'showprofile.php';
      $t->assign('sort_blog_views',   $blog->SortLink(get_lang('blog_views_hdr'),'views') );
      $t->assign('sort_blog_ratings', $blog->SortLink(get_lang('blog_rating_list_hdr'),'votes') );
      $t->assign('sort_blog_title',   $blog->SortLink(get_lang('blog_title_hdr'),'title') );
      $t->assign('sort_date_posted',  $blog->SortLink(get_lang('blog_date_posted_hdr'),'date_posted') );


      // If there's a poll to show, get it
      //
      include(LIB_DIR . 'poll_class.php');

      $poll =& new Poll();

      if (isset($_POST['action'] ) &&  $_POST['action'] == 'vote_poll' ) {

         $poll->saveVote($_SESSION['UserId']);
      }

      $poll->loadRandPoll($_REQUEST['id']);
      $question = $poll->getQuestion();
      $answer   = $poll->getAnswer();

		if (isset($question['id'])) {
	      $t->assign( 'questionid', $question['id'] ) ;
		}
      $t->assign( 'question',   $question);
      $t->assign( 'answer',     $answer );
      $t->assign( 'profileid',  $_REQUEST['id'] );


		$t->assign('lang',$lang);

	if ( $config['use_profilepopups'] == 'Y' ) {
		$cached_data = $t->fetch( 'nickpage.tpl' );
	}
	else {
		$t->assign('rendered_page', $t->fetch('nickpage.tpl') );
		$cached_data = $t->fetch( 'index.tpl' );
	}
	if ((isset($_SESSION['UserId']) && $_SESSION['UserId'] == '') || !isset($_SESSION['UserId'])) {
	/* Cache checking enabled only for general public i.e. the user is not logged in */

		require_once FULL_PATH.'includes/internal/osdate_save_cache.php';

	}
	echo($cached_data);
	unset($cached_data);

}
?>
