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

include_once(LIB_DIR . 'blog_class.php');

$blog =& new Blog();

$blog->addBlogView($_REQUEST['id'], isset($_SESSION['UserId'])?$_SESSION['UserId']:'' );
$blog->loadBlog($_REQUEST['id']);


if ( isset($_POST['action']) && $_POST['action'] == 'add_comment' ) {

 	if (isset($_SESSION['UserId']) && $_SESSION['UserId'] > 0) {

 	   $blog->addComment($_REQUEST['id'], $_SESSION['UserId']);
 	} else {
 	   $blog->addComment($_REQUEST['id'], $_SESSION['AdminId']);
 	}

   $blog->prepComment();
   $comments = $blog->getComment();
   $t->assign ( 'comment', $comments['comment'] );

   $t->assign ( 'error_message', $blog->getErrorMessage() );
} elseif ( isset($_POST['action']) && $_POST['action'] == 'add_vote' ) {

 	if (isset($_SESSION['UserId']) && $_SESSION['UserId'] > 0) {
	   $blog->addBlogVote($_REQUEST['id'], $_SESSION['UserId'], $_REQUEST['vote']);
	} else {
	   $blog->addBlogVote($_REQUEST['id'], $_SESSION['AdminId'], $_REQUEST['vote']);
	}
   $blog->loadBlog($_REQUEST['id']); // make sure we have the new vote counted
} else {

   $t->assign ( 'error_message', '' );
   $t->assign ( 'comment', '' );
}


if (isset($_SESSION['UserId']) && $_SESSION['UserId'] > 0) {
	$user_voted = $osDB->getOne("select count(id) from ! where storyid = ? and userid = ?", array(BLOG_VOTE_TABLE,$_REQUEST['id'], $_SESSION['UserId'] )) ;
	$user_commented = $osDB->getOne("select count(id) from ! where blogid = ? and userid = ?", array(BLOG_COMMENTS_TABLE,$_REQUEST['id'], $_SESSION['UserId'] ) ) ;
} else {
	$user_voted=0;
	$user_commented = 0;
}

$blog_data = $blog->getData();

$blog->loadSettings( $blog_data['userid'] || $blog_data['adminid'] );

$t->assign('blog',  $blog_data);
$t->assign('pref',  $blog->getSettings());
$t->assign('numcomments',  $blog->getCommentCount($_REQUEST['id']));
$t->assign('comments',  $blog->getAllComments($_REQUEST['id']));
$t->assign('now',  date('Y-m-d') );

$t->assign('user_commented', $user_commented );

$t->assign('user_voted', $user_voted );
if (isset($_SESSION['UserId']) ) {
	$t->assign('allowcomments',  $blog->allowComments($_REQUEST['id'], $_SESSION['UserId'] ) );
}
// For debuging.  Says why the user can't post a comment.  Comment out for production
// print $blog->no_comment;


$arr = array();

for( $i=-5; $i<=5; $i++ ) {
        $arr[$i] = $i;
}


$js = '<script type="text/javascript" src="' . DOC_ROOT . 'javascript/functions.js"></script>';
$t->assign('addtional_javascript', $js);

$t->assign('lang', $lang);


$t->assign ( 'vote_values', $arr );

unset( $arr);

$t->assign( 'rendered_page', $t->fetch( 'viewblog.tpl' ) );

$t->display ( 'index.tpl' );


?>
