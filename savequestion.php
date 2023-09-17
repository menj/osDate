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

include('sessioninc.php');

$userid = $_SESSION['UserId'];

//Get the next section id

$row = $osDB->getRow( 'SELECT displayorder FROM ! WHERE enabled = ? and id = ?', array( SECTIONS_TABLE, 'Y', $_POST['sectionid'] ) );

$nextsection = $osDB->getRow( 'SELECT id FROM ! WHERE enabled = ? and displayorder = ?', array( SECTIONS_TABLE, 'Y', $row['displayorder'] + 1 ) );


foreach ( $_POST as $questionid => $options ) {
	$j = 0;

	//If request parameter is sectionid, then check for next section and if it is last section then endofsection = 1

	if ( $questionid == 'sectionid' ) {

	}	elseif ( !is_array( $options ) ) {
	//If request variable contains variable=value. This is the case when user option has only one answer.

		$userpref[ $j++ ] = $userid;

		if ( substr( $questionid, -1 ) == 'Y' ) {

			if ( $options == NULL ) {
				header ( 'location: questions.php?sectionid='. $_POST['sectionid'] . '&errid=20' );
				exit;

			}
		}

		$questionid = substr( $questionid, 0, strlen( $questionid) -1  );

		$userpref[ $j ] = $questionid;

		$j++;

		$userpref[ $j ] = $options;

		//Check that user already has answered question
		$row = $osDB->getRow( 'SELECT id FROM ! WHERE userid = ? AND questionid = ?', array( USER_PREFERENCE_TABLE, $userpref[0], $userpref[1] ) );

		if ( $row ) {
			$osDB->query ( 'UPDATE ! SET userid	= ?, questionid	= ?, answer = ?		WHERE id = ?', array(USER_PREFERENCE_TABLE, $userpref[0], $userpref[1], strip_tags($userpref[2]), $row['id']) );
		} else {
			$osDB->query( 'INSERT INTO ! ( userid, questionid, answer ) VALUES ( ?, ?, ? )' , array( USER_PREFERENCE_TABLE, $userpref[0], $userpref[1], strip_tags($userpref[2]) ) );
		}
		unset($row);
	} else {
	//If request variable contains variable=Array. This is the case when user option have many options.
		foreach( $options as $option ) {

			$j = 0;

			$userpref[ $j ] = $userid;

			$j++;

			if ( substr( $questionid, -1 ) == 'Y' ) {

				if ( $options == NULL ) {

					header ( 'location: questions.php?sectionid='. $_POST['sectionid'] . '&errid=20' );
					exit;

				}
			}

			$qid = substr( $questionid, 0, strlen( $questionid) -1 );

			$userpref[ $j ] = $qid;

			$j++;

			$userpref[ $j ] = $option;

			//Check that user already has answered question
			$row = $osDB->getRow ( 'SELECT id FROM ! WHERE userid=? AND questionid=? AND answer=?', array(USER_PREFERENCE_TABLE, $userpref[0], $userpref[1], $userpref[2] ) );

			//$row = $result->fetchRow();
			if ( $row ) {

				$osDB->query ( 'UPDATE ! SET userid	= ?, questionid	= ?, answer = ?		WHERE id = ?', array(USER_PREFERENCE_TABLE, $userpref[0], $userpref[1], strip_tags($userpref[2]), $row['id']) );
			} else {

				$osDB->query( 'INSERT INTO ! ( userid, questionid, answer ) VALUES ( ?, ?, ? )' , array( USER_PREFERENCE_TABLE, $userpref[0], $userpref[1], strip_tags($userpref[2]) ) );

			}
		} //foreach
		unset($row, $userpref, $options, $option);

	} //else

} //foreach

if( $nextsection['id'] == "" ) {

	header ( 'location: signupsuccess.php');
} else {
	header ( 'location: questions.php?sectionid='. $nextsection['id'] );
}

?>