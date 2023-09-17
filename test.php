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


$temp = $osDB->getAll( 'SELECT * FROM ! where enabled = ? order by date desc limit !', array( STORIES_TABLE, 'Y' , $config['stories_count']) );

$index = 0;

$data = array();

foreach( $temp as $index => $row ) {

	$row1 = $osDB->getRow( 'SELECT * FROM ! where id= ?', array( USER_TABLE, $row['sender'] ) );

	$row[ 'username' ] = $row1['username'];

	if (strlen($row['text']) > $config['length_story'] ) {

		$arrtext = explode( ' ', $row['text'], $config['length_story'] + 1);

		$arrtext[$config['length_story']] = '';

		$row['text'] = trim(implode( ' ', $arrtext)) . '...';

	}

	$row['date'] = date(get_lang('DISPLAY_DATE_FORMAT'), $row['date'] );

	$data[ $index ] = $row;

	$index++;
}


$t->assign ( 'story_data', $data );

unset($data, $temp, $row);

?>