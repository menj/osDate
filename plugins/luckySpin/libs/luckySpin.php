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


/**
 * class pluginClass
 *
 *  Lucky spin (shows a random profile with a "Spin Again!" link)
 *
 *
 */
include_once(MODOSDATE_DIR . 'modPlugin.php');

class luckySpin extends modPlugin {

   /**
   * Holds the language phrases
   *
   * @access private
   */
   var $lang;

   /**
   * The name name of the plugin class.
   *
   * @access private
   */
   var $plugin_class_name = "luckySpin";

   /**
   * The text that appears in the admin plugin list
   *
   * @access private
   */
   var $display_name ;

   /**
   * The link text that appears on the user's menu
   *
   * @access private
   */
   var $user_menu_text ;

   /**
   * Appear on users menu (true or false)
   *
   * @access private
   */
   var $user_menu_appear = false;


   /**
   * The link text that appears on the admin's menu
   *
   * @access private
   */
   var $admin_menu_text ;

   /**
   * Appear on users menu (true or false)
   *
   * @access private
   */
   var $admin_menu_appear = false;

   /**
   * Constructor
   *
   * @return
   * @access public
   */
  function luckySpin( )
  {

    $this->modPlugin();
	$pluginDir = dirname(__FILE__).'/../';
	$this->lang = $this->modLoadLang($pluginDir);
  	$this->user_menu_text=$this->lang['user_title'];
  	$this->admin_menu_text=$this->lang['admin_title'];
  	$this->display_name=$this->lang['admin_title'];
  } // end of member method pluginClass
   /**
   *
   *
   * @return string - html content
   * @access public
   */
  function getRandomProfile($param )
  {

  } // end of member method pluginClass
   /**
   * Does the processing to display a user page.  Called from plugin.php
   *
   * @return array
   * @access public
   */
   function  displayPluginPage() {

   }
   /**
   * WARNING: USER IS NOT VALIDATED HERE.  BE CAREFUL
   * Does the processing to display 100% plugin content.  Called from pluginraw.php
   *
   * @return array
   * @access public
   */
   function  displayPluginContent() {

   }
  /**
   * Returns a random profile
   *
   * @return array
   * @access public
   */
  function displayLeftCol() {

	$sql = 'select snap.userid as userid, count(snap.userid) as snaps_cnt from ! as snap, ! as usr where snap.active=? and ifnull(snap.album_id,0) = 0 and usr.status =? and usr.active=1 and usr.id = snap.userid and ((snap.userid <> ? and ? is not null) or ? is null) group by snap.userid';

	if (!isset($_SESSION['luckyspin_id'])) $_SESSION['luckyspin_id'] = '';
	$luckySpinRecs=array();

	$luckySpinRecs = $GLOBALS['osDB']->getAll($sql, array(USER_SNAP_TABLE, USER_TABLE, 'Y', 'active',  $_SESSION['luckyspin_id'], $_SESSION['luckyspin_id'], $_SESSION['luckyspin_id'] ) );

	/* Select only users who is not shown immediately before and who has photos */
	if (count($luckySpinRecs) > 0) {
		/* Select random user id from the array */
		$usrrec = array_rand($luckySpinRecs);

		$opt['id'] = $luckySpinRecs[$usrrec]['userid'];

		$data = $this->modGetProfile($opt );
		$_SESSION['luckyspin_id'] = $data['id'];

		$this->modSmartyAssign('lucky', $data);

		$this->modSmartyAssign('lang', $this->modGetLang() );
		$this->modSmartyAssign('lang_gender_look', $this->modGetLang('signup_gender_look', $data['lookgender']) );
		$this->modSmartyAssign('lang_gender', $this->modGetLang('signup_gender_look', $data['gender']) );

		return $this->modSmartyFetch('profilebox.tpl');
	} else {
		return '';
	}
  }

    /**
   * Returns the content that will appear in the main content area of the page.  This content will appear after the existing main content.  Designed to be overridden by plugins
   *
   * @return array
   * @access public
   */
  function displayMain() {


  }

}


?>