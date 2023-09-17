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

include( 'sessioninc.php' );

include_once(LIB_DIR . 'blog_class.php');

$blog =& new Blog();

$blog_data = array();

$userid = $_SESSION['UserId'];
if (isset($_REQUEST['start_dateYear']) ) {
	$_SESSION['advsearch']['srchusername']  = isset($_REQUEST['srchusername'])?$_REQUEST['srchusername']:'';

	$_SESSION['advsearch']['srchblogtitle'] = isset($_REQUEST['srchblogtitle'])?$_REQUEST['srchblogtitle']:'';

	$_SESSION['advsearch']['srchblogbody']  = isset($_REQUEST['srchblogbody'])?$_REQUEST['srchblogbody']:'';

	$_SESSION['advsearch']['start_date']   = $start_date = $_REQUEST['start_dateYear']."-".$_REQUEST['start_dateMonth'] .'-'. $_REQUEST['start_dateDay'];

	$_SESSION['advsearch']['end_date']   = $end_date = $_REQUEST['end_dateYear']."-".$_REQUEST['end_dateMonth'] .'-'. $_REQUEST['end_dateDay'];
}
if (isset($_REQUEST['advsearch'])  ){

	$where[] = " 1 ";

	$where[] = " ( date_posted between '" . $start_date ."' and '". $end_date. "') ";

	if ( trim($_REQUEST['srchblogbody'])  != '' ) {

		/* Make sure only text, spaces or numbers gets through */
		$srchblogbody = preg_replace("/[^A-Za-z0-9 ]/", '', $_REQUEST['srchblogbody']);

		$where[] = " story LIKE '%" . trim($srchblogbody) . "%' ";
	}

	if ( trim($_REQUEST['srchblogtitle'])  != '' ) {

		/* Make sure only text, spaces or numbers gets through */
		$srchblogtitle = preg_replace("/[^A-Za-z0-9 ]/", '', $_REQUEST['srchblogtitle']);

		$where[] = " title LIKE '%" . trim($srchblogtitle) . "%' ";
	}

	if ( trim($_REQUEST['srchusername'])  != '' ) {

		/* Make sure only text or numbers gets through */
		$srchusername = preg_replace("/[^A-Za-z]/", '', trim($_REQUEST['srchusername']));

		$where[] = " ( a.username  LIKE '%" . $srchusername . "%' OR u.username LIKE '%" . $srchusername . "%' ) ";
	}


	$blog_data = $osDB->getAll("SELECT c.*,
			IF(c.adminid <> '', a.username, u.username ) AS username,
			LEFT(title,75) AS short_title,
			IF(ROUND(AVG(v.vote),0) IS NULL,0, ROUND(AVG(v.vote),0)) AS votes,
			COUNT(v.vote) AS num_votes
		FROM ! c
		LEFT JOIN ".ADMIN_TABLE." a ON c.adminid = a.id
		LEFT JOIN ".USER_TABLE." u  ON c.userid = u.id
		LEFT JOIN ".BLOG_VOTE_TABLE." v ON c.id = v.storyid
		WHERE  " . join(" AND ", $where) . "
		GROUP BY c.id
		ORDER BY " . $blog->SortOrder('date_posted DESC'), array( BLOG_STORY_TABLE));

	$t->assign( 'totalrecs', count($blog_data) );

	// Make the sort links
	//
	$blog->sort_page_values = array(
		'userid'         => $_REQUEST['userid'],
		'srchusername'   => $_REQUEST['srchusername'],
		'srchblogtitle'  => $_REQUEST['srchblogtitle'],
		'srchblogbody'   => $_REQUEST['srchblogbody'],
//		'date_posted'    => $_REQUEST['date_posted'],
		'advsearch'      => $_REQUEST['advsearch'],
		'start_dateYear' => $_REQUEST['start_dateYear'],
		'start_dateMonth' => $_REQUEST['start_dateMonth'],
		'start_dateDay' => $_REQUEST['start_dateDay'],
		'end_dateYear' => $_REQUEST['end_dateYear'],
		'end_dateMonth' => $_REQUEST['end_dateMonth'],
		'end_dateDay' => $_REQUEST['end_dateDay'],
	);
	$blog->sort_page = 'blogsearch.php';
	$t->assign('sort_creator', $blog->SortLink(get_lang('blog_creator'),'username') );
	$t->assign('sort_blog_title',   $blog->SortLink(get_lang('blog_title_hdr'),'title') );
	$t->assign('sort_blog_views',   $blog->SortLink(get_lang('blog_views_hdr'),'views') );
	$t->assign('sort_blog_ratings', $blog->SortLink(get_lang('blog_rating_list_hdr'),'votes') 											);
	$t->assign('sort_date_posted',  $blog->SortLink(get_lang('blog_date_posted_hdr'),'date_posted') );

	$t->assign( 'blogdata', $blog_data );

	unset($blog_data);

	$t->assign ( 'lang', $lang );

	$t->assign('rendered_page', $t->fetch('blogmatch.tpl') );

	$t->display ( 'index.tpl' );

	exit;
}

// Put the javascript and ccs into the head of the document
//
$js = '<script type="text/javascript" src="' . DOC_ROOT . 'javascript/calendar/epoch_classes.js"></script>';

$css = '<link rel="stylesheet" type="text/css" href="' . DOC_ROOT . 'javascript/calendar/epoch_styles.css" />';

if ($blog->getOldestDate('user',$userid) != '') {
	$t->assign("starttime",strtotime($blog->getOldestDate('user',$userid)));
}
$t->assign("endtime", time());

$t->assign('frmname', 'blogsearchfrm');

$t->assign('addtional_javascript', $js);
$t->assign('addtional_css', $css);

$t->assign('lang',$lang);

$t->assign('rendered_page', $t->fetch('blogsearch.tpl') );

$t->display('index.tpl');

?>
