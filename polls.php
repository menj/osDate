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



$data = $osDB->getAll( 'SELECT pollid FROM ! WHERE enabled = ? AND active = ? and date >= ?', array( POLLS_TABLE, 'Y', '1', time() ) );

if (count($data) > 0)  {

	srand((float) microtime() * 10000000);

	$key = array_rand($data, 1);

	$pollid = $data[$key]['pollid'];

	$row = $osDB->getAll( 'SELECT * FROM ! WHERE pollid = ? ', array( POLLS_TABLE, $pollid ) );

	$options = $osDB->getAll( 'SELECT * FROM ! WHERE pollid = ? ', array( POLLOPTS_TABLE, $pollid ) );

	$row['curtime'] = time();

	if (isset( $row['question'])){
		$row['question'] = stripslashes( $row['question'] );
	}
	$row['options'] = poll_opts( $options );
	unset($options);
	$t->assign( 'poll_data', $row );

	unset($row);
}

function poll_opts( $options )
{
	$result = array();

	foreach( $options as $index => $row ) {

		$result[ $row['optionid'] ] = $row;
	}

	return $result;
}
?>
