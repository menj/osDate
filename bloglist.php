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


if ( ! $blog->settingsExist($_SESSION['UserId']) ) {

      header( 'location: blogsettings.php?error_name=nosetup' );
      exit;
}

if ($blog->getStoryCount($_SESSION['UserId']) <= 0){
      header( 'location: addblog.php' );
      exit;

}

// If user clicked the remove button and confirmed the delete, delete it
//
if ( isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['delete']) && $_GET['delete'] == 'Y' ) {

   	$blog->deleteStory($_GET['id']);
	$t->assign("error_message",get_lang('blog','deleted'));
} elseif ( isset($_POST['action']) && $_POST['action'] == 'multiple_delete'  ) {
 	$blog->multipleDeleteStory($_POST['delete']);
	$t->assign("error_message",get_lang('blog','deleted'));
}

// Make the sort links
//
$blog->sort_page = 'bloglist.php';
$t->assign('sort_blog_views',   $blog->SortLink(get_lang('blog_views_hdr'),'views') );
$t->assign('sort_blog_ratings', $blog->SortLink(get_lang('blog_rating_list_hdr'),'votes') );
$t->assign('sort_blog_title',   $blog->SortLink(get_lang('blog_title_hdr'),'title') );
$t->assign('sort_date_posted',  $blog->SortLink(get_lang('blog_date_posted_hdr'),'date_posted') );

$t->assign('list', $blog->getAllStories($_SESSION['UserId']) );
$t->assign( 'lang', $lang );


$js = '<script type="text/javascript" src="'. DOC_ROOT . 'javascript/functions.js"></script>';
$t->assign('addtional_javascript', $js);

// Make the page
//

$t->assign('rendered_page', $t->fetch('bloglist.tpl') );

$t->display( 'index.tpl' );

exit;

?>
