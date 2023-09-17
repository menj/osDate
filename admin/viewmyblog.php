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
	include_once( '../init.php' );
}

include( 'sessioninc.php' );
include_once(LIB_DIR . 'blog_class.php');

$blog =& new Blog(true);

// If the preferences are missing, go to the settings page
//
if ( ! $blog->settingsExist($_SESSION['AdminId']) ) {

      header( 'location: blogsettings.php?error_name=nosetup' );
      exit;
}

if (isset($_POST['action'] ) &&  $_POST['action'] == 'add_comment' ) {

   $blog->addComment($_REQUEST['id'], $_SESSION['AdminId']);
   $blog->prepComment();
   $comments = $blog->getComment();
   $t->assign ( 'comment', $comments['comment'] );

   $t->assign ( 'error_message', $blog->getErrorMessage() );
}

// Edit the preferences if save button pressed
//
if ( isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['delete']) && $_GET['delete'] == 'Y'  ) {

      $blog->deleteComment($_REQUEST['deleteid'], $_SESSION['AdminId']);
}
// Set the values to show on the page
//

$blog->loadBlog($_REQUEST['id']);

$t->assign( 'blog',  $blog->getData() );

$t->assign('now',  date('Y-m-d') );
$t->assign('numcomments',  $blog->getCommentCount($_REQUEST['id']));
$t->assign('comments',  $blog->getAllComments($_REQUEST['id']));
$t->assign('allowcomments',  $blog->allowComments($_REQUEST['id'], $_SESSION['AdminId']) );


// Make the page
//

$t->assign('lang',$lang);

$t->assign('rendered_page', $t->fetch('admin/viewmyblog.tpl') );

$t->display( 'admin/index.tpl' );

exit;

?>
