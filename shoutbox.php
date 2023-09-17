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


require_once(dirname(__FILE__).'/init.php');

if (!isset($_REQUEST['a']) || empty($_REQUEST['a']) ) return '';

switch (trim($_REQUEST['a'])) {

	case 'sendSBMsg':

		$text = strip_tags($_REQUEST['msg']);
		$text = nl2br($text);
		// Smilies, Mail, Web Filter
		$replacetext = "-- Adress Removed --";
		$repl_arr = array(
				'|amp|'	=> '&amp;',
				":-)"	=> "<img src=\"".DOC_ROOT."images/smilies/lucky.gif\"\/>",
				":)" 	=> "<img src=\"".DOC_ROOT."images/smilies/lucky.gif\"\/>",
				";)"	=> "<img src=\"".DOC_ROOT."images/smilies/wink.gif\"\/>",
				";-)"	=> "<img src=\"".DOC_ROOT."images/smilies/wink.gif\"\/>",
				"8-)"	=> "<img src=\"".DOC_ROOT."images/smilies/cool.gif\"\/>",
				"8)"	=> "<img src=\"".DOC_ROOT."images/smilies/cool.gif\"\/>",
				":("	=> "<img src=\"".DOC_ROOT."images/smilies/worse.gif\"\/>",
				":-("	=> "<img src=\"".DOC_ROOT."images/smilies/worse.gif\"\/>",
				":-P"	=> "<img src=\"".DOC_ROOT."images/smilies/p.gif\"\/>",
				":P"	=> "<img src=\"".DOC_ROOT."images/smilies/p.gif\"\/>");
		$text = strtr($text, $repl_arr);
		$text = preg_replace( "/[A-Z0-9._%-]+@[A-Z0-9._%-]+\.[A-Z]{2,6}/i", $replacetext, $text );
		$text = preg_replace( "/[A-Z0-9._%-]+ at [A-Z0-9._%-]+ dot [A-Z]{2,6}/i", $replacetext, $text );
		$text = preg_replace( "/[A-Z0-9._%-]+\.[A-Z0-9._%-]+\.[A-Z]{2,6}/i", $replacetext, $text );
		$userid = (isset($_SESSION['UserId']) && $_SESSION['UserId'] != '')?$_SESSION['UserId']:'-1';
		$username = ($userid == '-1')?'Visitor':(isset($_SESSION['UserName'])?$_SESSION['UserName']:'');
		$osDB->query( 'INSERT INTO ! ( from_user, username, act_time, message) values( ?, ?, ?, ?)', array( SHOUTBOX_TABLE, $userid, $username, time(), $text ) );
		unset($text);
		$msg = $osDB->getAll('select id from ! order by act_time', array(SHOUTBOX_TABLE));

		$max_cnt = ($config['shoutbox_msg_maxcnt']>0)?$config['shoutbox_msg_maxcnt']:200;

		if (count($msg) >= $max_cnt) {
			$osDB->query('delete from ! where id = ?', array(SHOUTBOX_TABLE, $msg[0]['id']) );
		}

		print '|||SBmsgArea|:|'.getSBMsg();
		break;

	case 'ping':
		print '|||SBmsgArea|:|'.getSBMsg();
		break;

	default : return ''; break;
}

function getSBMsg() {
	/* Get Messages for this user */
	global $osDB, $config;
	$ret = '';

	$msg_cnt = ($config['shoutbox_msg_dispcnt']>0)?$config['shoutbox_msg_dispcnt']:20;


	if (!isset($_REQUEST['cnt']) || $_REQUEST['cnt'] == '0' || $_REQUEST['cnt'] == '' ) $sql.= ' limit 0,'.$msg_cnt;

	$messages = $osDB->getAll('select * from ! order by act_time desc ', array(SHOUTBOX_TABLE) );

	if (count($messages) <= 0) return '';

	$ret='<table border="0" cellpadding="0" cellspacing="0" width="90%" ><tr><td height="5"></td></tr>';

	foreach ($messages as $msg) {

		$ret .= '<tr><td width="90%" >';
		if ($msg['from_user'] != '-1') {
			/* Not visitor */
			$ret.='<a href="javascript:popUpScrollWindow2(\''.DOC_ROOT;
			if ($config['enable_mod_rewrite'] == 'Y') {
				/* Mode rewrite SEO friendly tags*/
				if ($config['seo_username'] == 'Y') {
					/* Username tag */
					$ret.=$msg['username'];
				} else {
					$ret.=$msg['from_user'].'.htm';
				}
			} else {
				$ret.= 'showprofile.php?';
				if ($config['seo_username'] == 'Y') {
					$ret.='username='.$msg['username'];
				}else{
					$ret.='id='.$msg['from_user'];
				}
			}
			$ret.="','top',650,600)\">";
			$ret.=$msg['username']."</a>";
		} else{
			$ret.=$msg['username'];
		}
		$ret.='&nbsp;&nbsp;&nbsp;';
		$ret.= date(SHOUTBOX_TIME_FORMAT, $msg['act_time']);
		$ret.='</td></tr><tr><td >'.stripslashes($msg['message']).'</td></tr>';
		$ret.='<tr><td height="4"></td></tr>';
	}
	unset($msg);
	$ret.='</table>';
	return $ret;
}
?>
