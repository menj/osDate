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

$pollid = isset($_GET['pollid'])?$_GET['pollid']:'1';

$rsQ = $osDB->getRow( 'SELECT question, date from ! WHERE pollid = ?', array( POLLS_TABLE, $pollid ) );

$numtotal =  $osDB->getOne( 'SELECT sum( result ) as sm FROM ! WHERE pollid = ?', array( POLLOPTS_TABLE, $pollid ) );

$sqOpt = $osDB->getAll( 'SELECT opt, result FROM ! WHERE pollid = ? order by optionid', array( POLLOPTS_TABLE, $pollid ) );

$date =  date( LONG_DATE_FORMAT, $rsQ['date'] );

$t->assign( 'question', stripslashes( $rsQ['question'] ) );
unset($rsQ);
$i = 1;

$data = array();

foreach( $sqOpt as $index => $rsOpt ) {

	$rsOpt['c'] = $i;

	if( $numtotal !=  0 ) {
		 $rsOpt['numw']  =  number_format( ( $rsOpt['result'] / $numtotal ) * 100, 2 );
	} else {
		$rsOpt['numw']  =  0;
	}

	$data[$index] = $rsOpt;

	$i++;
}

$t->assign( 'data', $data );

unset($sqOpt, $data );

$t->assign( 'numtotal',$numtotal );

$t->assign( 'title', get_lang('poll_result') );

$t->assign( 'err',(isset($err)?$err:'') );

$t->display( 'viewresult.tpl' );


?>