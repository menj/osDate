<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */


/**
 * Smarty {checkuser} function plugin
 *
 * Type:     function<br>
 * Name:     Vijay Nair<br>
 * Date:     March 29, 2006<br>
 * Purpose:  Take languave specific texts from database to display
 * @link     To be attached with osdate package and topied to Smarty/plugins directory
 * @author   Vijay Nair <vijay@nairvijay.com>
 * @version  1.0
 * @param    userid, checkfor
 * @return   string
 */

function smarty_function_checkuser($params, &$smarty )
{  	global $osDB, $config, $lang;
   	$returnme = '';
	$checkfor = $params['checkfor'];
	$userid = $params['userid'];
	$username = $params['username'];
   	if ($checkfor == 'online') {
		/* Check if the user is online */
   		$online=$osDB->getOne('select count(onl.userid) from ! as onl, ! as usr where onl.userid = ? and usr.id = onl.userid and usr.allow_viewonline = ? ', array(ONLINE_USERS_TABLE, USER_TABLE, $userid,'1'));
   		if (isset($online) && $online > 0) {
   			$returnme='<b><font color="'.$lang['useronlinecolor']['online_now'].'">'.$lang['useronlinetext']['online_now'].'</font></b>';
   		} else {
			$lastvisit = $osDB->getOne('select lastvisit from ! where id = ?', array(USER_TABLE, $userid) );
			if (!isset($lastvisit) ) $lastvisit = time() - 3456000; /* 4-0 days back */
			$time_now = time();
			if ($lastvisit > ($time_now-86400) ) {
				/* Active in last 24 hours */
	   			$returnme='<b><font color="'.$lang['useronlinecolor']['active_24hours'].'">'.$lang['useronlinetext']['active_24hours'].'</font></b>';
			} elseif ($lastvisit > ($time_now-259200) ) {
				/* Active in last 3 days */
	   			$returnme='<b><font color="'.$lang['useronlinecolor']['active_3days'].'">'.$lang['useronlinetext']['active_3days'].'</font></b>';
			} elseif ($lastvisit > ($time_now-604800) ) {
				/* Active in last 7 days */
	   			$returnme='<b><font color="'.$lang['useronlinecolor']['active_1week'].'">'.$lang['useronlinetext']['active_1week'].'</font></b>';
			} elseif ($lastvisit > ($time_now-2592000) ) {
				/* Active in last 30 days */
	   			$returnme='<b><font color="'.$lang['useronlinecolor']['active_1month'].'">'.$lang['useronlinetext']['active_1month'].'</font></b>';
			} else {
	   			$returnme='<b><font color="'.$lang['useronlinecolor']['notactive'].'">'.$lang['useronlinetext']['notactive'].'</font></b>';
			}
   		}
   	} elseif ($checkfor == 'buddy' or $checkfor == 'ban' or $checkfor == 'hot') {
		/* Check if the user is in the buddy list */
		if ($checkfor == 'buddy') {$act = 'F'; $tit="User is in Buddy List";}
		elseif ($checkfor == 'ban') {$act = 'B'; $tit="User is in Banned Liat";}
		else {$act = 'H'; $tit = "User is in Hot List";}
		$isthere = $osDB->getOne('select count(*) from ! where userid = ? and ref_userid = ? and act=?', array(BUDDY_BAN_TABLE, $_SESSION['UserId'], $userid ,$act) );
		if (isset($isthere) && $isthere > 0) {
			if ($act == 'H') {
				$returnme = '<img src="images/hot_list.gif" height="12" width="12" alt="" align="baseline" title="'.$tit.'" />';
			} elseif ($act == 'F') {
				$returnme = '<img src="images/buddy_list.gif" height="12" width="12" alt="" align="baseline" title="'.$tit.'" />';
			} else {
				$returnme = '<img src="images/cross.jpg" height="12" width="12" alt="" align="baseline" title="'.$tit.'" />';
			}
		}
   	} elseif ($checkfor == 'message') {
   		/* check if you have received a message from this user and mail is still in the mailbox */
		$mail = $osDB->getOne("select count(*) from ! where senderid = ? and recipientid = ?",array(MAILBOX_TABLE, $userid, $_SESSION['UserId']) );
		if (isset($mail) && $mail > 0) {
			$returnme = '<img src="images/unread.jpg" height="12" width="12" alt="" align="baseline" title="User has sent message to you" />';
		}
	} elseif ($checkfor == 'featured') {
		/* Check if this user is in featured list */
		$feat = $osDB->getOne('select 1 from ! where userid = ? and exposures < req_exposures and ? between start_date and end_date', array(FEATURED_PROFILES_TABLE, $userid, time()));
		if (isset($feat) && $feat > 0) {
			$returnme = '<img src="images/featured.gif" height="12" width="12" alt="" align="baseline" title="User is in Featured List" />';
		}
	} elseif ($checkfor == 'picscnt') {
		/* Get the number of pictures loaded for this user */
		$picscnt = $osDB->getOne('select count(*)  from ! where userid = ? and (album_id is null or album_id = 0) ', array(USER_SNAP_TABLE, $userid));
		if ($picscnt == 1) {
			if ($_SESSION['AdminId'] > 0) {
				$returnme = '<a href="#" onclick="javascript:popUpScrollWindow(\''.DOC_ROOT.ADMIN_DIR.'userpicgallery.php?type=profilepics&amp;id='.$userid.'\',\'center\',600,600);">'.str_replace('#PICSCNT#',$picscnt,get_lang('loadedpicscnt1'))."</a>";
			} else {
				$returnme = '<a href="#" onclick="javascript:popUpScrollWindow2(\''.DOC_ROOT.'userpicgallery.php?type=profilepics&amp;id='.$userid.'\',\'center\',600,600);">'.str_replace('#PICSCNT#',$picscnt,get_lang('loadedpicscnt1'))."</a>";
			}
		} elseif ($picscnt > 1) {
			if ($_SESSION['AdminId'] > 0) {
				$returnme = '<a href="#" onclick="javascript:popUpScrollWindow(\''.DOC_ROOT.ADMIN_DIR.'userpicgallery.php?type=profilepics&amp;id='.$userid.'\',\'center\',600,600);">'.str_replace('#PICSCNT#',$picscnt,get_lang('loadedpicscnt'))."</a>";
			} else {
				$returnme = '<a href="#" onclick="javascript:popUpScrollWindow2(\''.DOC_ROOT.'userpicgallery.php?type=profilepics&amp;id='.$userid.'\',\'center\',600,600);">'.str_replace('#PICSCNT#',$picscnt,get_lang('loadedpicscnt'))."</a>";
			}
		} else {
			$returnme = get_lang('nopicsloaded');
		}
	} elseif ($checkfor == 'albumscnt') {
		/* Get the number of pictures loaded for this user */
		$albums = $osDB->getRow('select count(distinct(album_id)) as albumscnt, count(id) as piccnt  from ! where userid = ? and album_id > 0 ', array(USER_SNAP_TABLE, $userid));
		$albumscnt = $albums['albumscnt'];
		if ($albumscnt > 0) {
			if ($albumscnt == 1) {
				if ($_SESSION['AdminId'] > 0) {
					$returnme = '<a href="#" onclick="javascript:popUpScrollWindow(\''.DOC_ROOT.ADMIN_DIR.'userpicgallery.php?type=gallery&amp;id='.$userid.'\',\'center\',600,600);">'.str_replace('#ALBUMSCNT#',$albumscnt,get_lang('album'))."</a>";
				} else {
					$returnme = '<a href="#" onclick="javascript:popUpScrollWindow2(\''.DOC_ROOT.'userpicgallery.php?type=gallery&amp;id='.$userid.'\',\'center\',600,600);">'.str_replace('#ALBUMSCNT#',$albumscnt,get_lang('album'))."</a>";
				}
			} elseif ($albumscnt > 1) {
				if ($_SESSION['AdminId'] > 0) {
					$returnme = '<a href="#" onclick="javascript:popUpScrollWindow(\''.DOC_ROOT.ADMIN_DIR.'userpicgallery.php?type=gallery&amp;id='.$userid.'\',\'center\',600,600);">'.str_replace('#ALBUMSCNT#',$albumscnt,get_lang('albums'))."</a>";
				} else {
					$returnme = '<a href="#" onclick="javascript:popUpScrollWindow2(\''.DOC_ROOT.'userpicgallery.php?type=gallery&amp;id='.$userid.'\',\'center\',600,600);">'.str_replace('#ALBUMSCNT#',$albumscnt,get_lang('albums'))."</a>";
				}
			}
			$returnme .= '&nbsp;(&nbsp;'.$albums['piccnt'].'&nbsp;'.get_lang('pic_gallery').' )';
		} else {
			$returnme = get_lang('nopicsloaded');
		}
	} elseif ($checkfor == 'videoscnt') {
		/* Get the number of pictures loaded for this user */
		$picscnt = $osDB->getOne('select count(*)  from ! where userid = ? ', array(USER_VIDEOS_TABLE, $userid));
		if ($picscnt == 1) {
			if ($_SESSION['AdminId'] > 0) {
				$returnme = '<a href="#" onclick="javascript:popUpScrollWindow(\''.DOC_ROOT.ADMIN_DIR.'uservideogallery.php?userid='.$userid.'\',\'center\',600,600);">'.str_replace('#PICSCNT#',$picscnt,get_lang('loadedvdocnt1'))."</a>";
			} else {
				$returnme = '<a href="#" onclick="javascript:popUpScrollWindow2(\''.DOC_ROOT.'uservideogallery.php?userid='.$userid.'\',\'center\',600,600);">'.str_replace('#PICSCNT#',$picscnt,get_lang('loadedvdocnt1'))."</a>";
			}
		} elseif ($picscnt > 1) {
			if ($_SESSION['AdminId'] > 0) {
				$returnme = '<a href="#" onclick="javascript:popUpScrollWindow(\''.DOC_ROOT.ADMIN_DIR.'uservideogallery.php?userid='.$userid.'\',\'center\',600,600);">'.str_replace('#PICSCNT#',$picscnt,get_lang('loadedvdocnt'))."</a>";
			} else {
				$returnme = '<a href="#" onclick="javascript:popUpScrollWindow2(\''.DOC_ROOT.'uservideogallery.php?userid='.$userid.'\',\'center\',600,600);">'.str_replace('#PICSCNT#',$picscnt,get_lang('loadedvdocnt'))."</a>";
			}
		} else {
			$returnme = get_lang('novideos_loaded');
		}
	} elseif ($checkfor == "send_message") {
		$isthere = $osDB->getOne('select count(*) from ! where (userid = ? and ref_userid = ?) or (userid=? and ref_userid=?) and act=?', array(BUDDY_BAN_TABLE, $userid, $_SESSION['UserId'],$_SESSION['UserId'], $userid, 'B') );
		if ($isthere == 0) {
			$returnme = '<a href="javascript:popUpScrollWindow2('."'".DOC_ROOT."compose.php?recipient=".$userid."','center',650,600)".'">';
			$returnme .= get_lang('send_mail').'</a>';
		}
	}
	return $returnme;
}

/* vim: set expandtab: */

?>
