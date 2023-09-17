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
 * class pluginTemplate
 *
 *  A template to get you started building templates.  Rename all pluginTemplate
 *  with the name of your plugin
 *
 *  Call with {osdplugin name="pluginTemplate" method="getSomething"} in a template
 *
 */
include_once(MODOSDATE_DIR . 'modPlugin.php');

class paymentHistory extends modPlugin {

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
   var $plugin_class_name = "paymentHistory";

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
   var $user_menu_text;

   /**
   * Appear on users menu (true or false)
   *
   * @access private
   */
   var $user_menu_appear = true;


   /**
   * The link text that appears on the admin's menu
   *
   * @access private
   */
   var $admin_menu_text = '';

   /**
   * Appear on admin's menu (true or false)
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
  function paymentHistory( )
  {

    $this->modPlugin();
	$pluginDir = dirname(__FILE__).'/../';
	$this->lang = $this->modLoadLang($pluginDir);
  	$this->user_menu_text=$this->modGetLang('user_title');
  	$this->display_name = $this->admin_menu_text=$this->modGetLang('admin_title');

  } // end of member method pluginClass
   /**
   * Does the processing to display a user page.  Called from plugin.php
   *
   * @return array
   * @access public
   */
   function  displayPluginPage() {

      $udata = $this->modGetLoggedInUser();

      $param['user_id'] = $udata['id'];
      $tdata = $this->modGetTransaction($param);

	  $transdata = array();

	  foreach ($tdata as $row) {
		  $row['txn_date'] = strtotime($row['txn_date']);
		  $transdata[] = $row;
	  }

	  $this->modSmartyAssign('lang', $GLOBALS['lang']);

      $this->modSmartyAssign('trans', $transdata);

      $this->modSmartyAssign('plang', $this->modGetLang() );

      return $this->modSmartyFetch('paymenthistory.tpl');

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
   * Returns the content that will appear in the left column of a page.  Designed to be overridden by plugins
   *
   * @return array
   * @access public
   */
  function displayLeftCol() {


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