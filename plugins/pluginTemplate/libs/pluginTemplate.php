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
 *
 *
 */
include_once(MODOSDATE_DIR . 'modPlugin.php');

class pluginTemplate extends modPlugin {

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
   var $plugin_class_name = "pluginTemplate";

   /**
   * The text that appears in the admin plugin list
   *
   * @access private
   */
   var $display_name = "Hello World";

   /**
   * The link text that appears on the user's menu
   *
   * @access private
   */
   var $user_menu_text = "Hello World";

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
   var $admin_menu_text = "Hello World";

   /**
   * Appear on admin's menu (true or false)
   *
   * @access private
   */
   var $admin_menu_appear = true;

   /**
   * Constructor
   *
   * @return
   * @access public
   */
  function pluginTemplate( )
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

      $this->modSmartyAssign('lang', $this->modGetLang() );

      // This is what makes the template display on the page
      //
      return $this->modSmartyFetch('helloworld.tpl');

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

      $this->modSmartyAssign('lang', $this->modGetLang() );

      // This is what makes the template display on the page
      //
      return $this->modSmartyFetch('helloworldleft.tpl');

  }
    /**
   * Returns the content that will appear in the main content area of the page.  This content will appear after the existing main content.  Designed to be overridden by plugins
   *
   * @return array
   * @access public
   */
  function displayMain() {


      $this->modSmartyAssign('lang', $this->modGetLang() );

      // This is what makes the template display on the page
      //
      return $this->modSmartyFetch('helloworldmain.tpl');
  }
  /**
   * Does the processing to display a admin page.  Called from plugin.php
   *
   * @return array
   * @access public
   */
   function  displayPluginAdminPage() {

      $this->modSmartyAssign('lang', $this->modGetLang() );

      // This is what makes the template display on the page
      //
      return $this->modSmartyFetch('admin/helloworld.tpl');
   }
  /**
   * Called from a Smarty tag.  <br>
   * Call with {osdplugin name="pluginTemplate" method="helloWorld"} in a template
   *
   * @return array
   * @access public
   */
   function  helloWorld() {

      $this->modSmartyAssign('lang', $this->modGetLang() );

      // This is what makes the template display on the page
      //
      return $this->modSmartyFetch('admin/helloworldsmarty.tpl');
   }

}


?>