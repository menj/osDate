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

include(LIB_DIR . 'poll_class.php');

$poll =& new Poll();



// If user clicked the remove button and confirmed the delete, delete it
//
if ( $_GET['action'] == 'delete' && $_GET['delete'] == 'Y' ) {

   $poll->deletePoll($_GET['id']);
}
elseif ( $_POST['action'] == 'multiple_delete'  ) {

  $poll->multipleDeletePoll($_POST['delete']);

}

$t->assign('list', $poll->getAllPolls($_SESSION['UserId']) );

$js = '<script type="text/javascript" src="' . DOC_ROOT . 'javascript/functions.js"></script>';
$t->assign('addtional_javascript', $js);

// Make the page
//
$t->assign('rendered_page', $t->fetch('polllist.tpl') );

$t->display( 'index.tpl' );

exit;

?>