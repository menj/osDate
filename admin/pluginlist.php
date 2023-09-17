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

include(LIB_DIR . 'plugin_class.php');

$plugin =& new Plugin();


// If user clicked the remove button and confirmed the delete, delete it
//
if (isset($_REQUEST['action'])&& $_REQUEST['action']!='') {
	if ( $_REQUEST['action'] == 'delete' && isset($_GET['delete']) && $_GET['delete'] == 'Y' ) {

	   $plugin->deletePlugin($_GET['name']);
	}
	elseif ( $_REQUEST['action'] == 'multiple_delete'  ) {

	  $plugin->multipleDeletePlugin($_POST['delete']);

	}
	elseif ( $_REQUEST['action'] == 'install'  ) {

		$plugin->installPlugin($_GET['name']);
	}
}
if ( $plugin->getErrorMessage() ) {

      $t->assign ( 'error_message', $plugin->getErrorMessage() );
}
else {

      $t->assign ( 'error_message', '' );
}

$t->assign('list', $plugin->getAllPlugins() );


$js = '<script type="text/javascript" src="'. DOC_ROOT . 'javascript/functions.js"></script>';
$t->assign('addtional_javascript', $js);

// Make the page
//
$t->assign('rendered_page', $t->fetch('admin/pluginlist.tpl') );

$t->display( 'admin/index.tpl' );

exit;

?>