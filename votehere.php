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


if( !defined( 'SMARTY_DIR' ) ) {
	require_once( 'init.php' );
}

$pollid = isset($_GET[ 'pollid' ])?$_GET[ 'pollid' ]:'1';
$aid = isset($_GET[ 'rdo' ])?$_GET[ 'rdo' ]:'1';
$ctime = isset($_GET[ 't' ])?$_GET[ 't' ]:time();

if( $aid > 0 ) {

	if ( getenv( 'HTTP_CLIENT_IP' ) ) {
		$userip = getenv( 'HTTP_CLIENT_IP' );
	} elseif ( getenv( 'HTTP_X_FORWARDED_FOR' ) )	{
		$userip = getenv( 'HTTP_X_FORWARDED_FOR' );
	} else {
		$userip = getenv( 'REMOTE_ADDR' );
	}

	$count = $osDB->getOne( 'SELECT count(*) FROM ! WHERE  ip = ? and ip <> ? and pollid = ?', array( POLLIPS_TABLE, $userip, '', $pollid ) );

	if( $count <= 0 )	{

		$time = time();

		$osDB->query( 'INSERT INTO ! VALUES ( ?, ?, ? )', array( POLLIPS_TABLE, $userip, $pollid, $time ) );

		$osDB->query( 'UPDATE ! set result = result + 1 WHERE optionid = ?', array( POLLOPTS_TABLE, $aid ) );
		addLog('poll');

		header( 'location: viewresult.php?pollid=' . $pollid . '&t=' . $time );
		exit();
	} else {
		header( 'location: viewresult.php?pollid=' . $pollid . '&t=' . $time . '&err='.USERNAME_BLANK );
		exit();
	}
} else {
	header( 'location: viewresult.php?pollid=' . $pollid . '&t=' . $time );
	exit();
}
?>