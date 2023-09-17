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

include ( 'sessioninc.php' );

$id 			= 	trim( $_POST['txtid'] );

$osDB->query("UPDATE ! ".
	      "SET userid = ?, ".
		  "    event	= ?, ".
		  "    description = ?, ".
		  "    calendarid = ?, ".
		  "    enabled = ?, ".
		  "    timezone = ?, ".
		  "    datetime_from = DATE_SUB(?, INTERVAL ".$_POST['txttimezone']." HOUR), ".
		  "    datetime_to = DATE_SUB(?, INTERVAL ".$_POST['txttimezone']." HOUR), ".
		  "    recurring = ?, ".
		  "    recuroption = ?, ".
		  "    private_to = ? ".
		  "where id= ?",
		  array( EVENTS_TABLE,
		  trim( $_POST['txtuserid'] ),
		  stripslashes(trim( $_POST['txtevent'] )),
		  stripslashes(trim( $_POST['txtdescription'] )),
		  $_POST['txtcalendar'],
		  (empty($_POST['txtprivate_to'])?"Y":"N"),
		  $_POST['txttimezone'],
		  $_POST['txtdatefromYear']. "-". $_POST['txtdatefromMonth']."-".$_POST['txtdatefromDay']." ".$_POST['txtdatefromHour'].":".$_POST['txtdatefromMinute'],
		  $_POST['txtdatetoYear']."-".$_POST['txtdatetoMonth']."-".$_POST['txtdatetoDay']." ".$_POST['txtdatetoHour'].":".$_POST['txtdatetoMinute'],
		  $_POST['txtrecurring'],
		  $_POST['txtrecuroption'],
		  stripslashes($_POST['txtprivate_to']),
		  $id
		  )
	);
send_watched_mails($id);
header ( 'location: event.php?event_id='.$id);
?>