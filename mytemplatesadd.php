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


if (isset($_POST['btnsave']) && $_POST['btnsave']!= '' ) {

	if (isset($_POST["id"]) && $_POST['id'] > 0 ) {
		// editing a template

		$osDB->query('UPDATE ! set text = ?, subject = ? where userid = ? and id = ?', array( USERTEMPLATE_TABLE, $_POST["txttemplate"], $_POST['txtsubject'], $_SESSION['UserId'], $_POST['id'] ) );

	} else {

		// adding a new template
		$osDB->query('INSERT INTO ! (subject, text, userid) values (?, ?, ?)', array( USERTEMPLATE_TABLE, $_POST['txtsubject'], $_POST["txttemplate"], $_SESSION['UserId'] ) );
	
	}

	header( 'location: mytemplates.php?recipient=' . $_POST['recipient'] );
	exit;
}

if ( isset($_GET['id']) ) {

	$t->assign( 'template',$osDB->getRow( 'SELECT * FROM ! WHERE userid = ? and id = ?', array( USERTEMPLATE_TABLE, $_SESSION['UserId'], $_GET["id"] ) ));

}

if ($config['use_profilepopups'] == 'Y') {
	$t->display('mytemplatesadd.tpl');
} else {
	$t->assign('rendered_page', $t->fetch('mytemplatesadd.tpl') );

	$t->display ( 'index.tpl' );
}
?>