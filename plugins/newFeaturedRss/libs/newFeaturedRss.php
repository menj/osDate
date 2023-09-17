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
 *  RSS feed to output featured/new profile data to any RSS 2.0-compliant reader
 *
 *  Call with http://yourosdatesite.com/osdatedir/pluginraw.php?plugin=newFeaturedRss
 *
 */
include_once(MODOSDATE_DIR . 'modPlugin.php');

class newFeaturedRss extends modPlugin {

   /**
   * Holds the language phrases
   *
   * @access private
   */
   var $lang;

   /**
   * RSS Object
   *
   * @access private
   */
   var $rss;

   /**
   * The name name of the plugin class.
   *
   * @access private
   */
   var $plugin_class_name = "newFeaturedRss";

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
   var $user_menu_appear = false;


   /**
   * The link text that appears on the admin's menu
   *
   * @access private
   */
   var $admin_menu_text ;

   /**
   * Appear on admin menu (true or false)
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
  function newFeaturedRss( )
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

   }
   /**
   * WARNING: USER IS NOT VALIDATED HERE.  BE CAREFUL
   * Does the processing to display 100% plugin content.  Called from pluginraw.php
   *
   * @return array
   * @access public
   */
   function  displayPluginContent() {

      $plugindir = $this->getLibsDir();

      include($plugindir . 'class.rss.php');

	$this->rss = new rss('utf-8');

	$this->rss->channel($this->config['title'], $this->config['link'], $this->config['description']);
	$this->rss->language('en-us');

	$this->rss->startRSS();

        // Get featured users
        //
        $feat = $this->modGetAllFeatured( );

	foreach ( $feat AS $userid ) {

	    $udata = $this->modGetUser( array('userid' => $userid) );

	    $this->addUser($udata, "Featured");
	}

	// Get new users
	//
	$search['limit'] = $this->config['new_members'];
	$search['sort']  = 'regdate DESC';
	$newuser = $this->modGetAllUsers($search);

	foreach ( $newuser AS $udata) {

	    $this->addUser($udata, "New");
	}
        print header ("Content-Type: text/xml");
	return $this->rss->RSSdone();


   }
   function addUser($udata,$type) {

	    $this->rss->itemTitle("$type Member: " . $udata['username']);
	    $this->rss->itemLink($this->modSiteUrl() . 'showprofile.php?id=' . $udata['id']);
	    $this->rss->itemGuid($this->modSiteUrl() . 'showprofile.php?id=' . $udata['id']);
	    $this->rss->itemPubDate(date('r'));


            $this->modSmartyAssign('profile', $udata);

            $this->modSmartyAssign('lang', $this->modGetLang() );
            $this->modSmartyAssign('lang_gender_look', $this->modGetLang('signup_gender_look', $udata['lookgender']) );
            $this->modSmartyAssign('lang_gender', $this->modGetLang('signup_gender_look', $udata['gender']) );

            $description =  $this->modSmartyFetch('profile.tpl');

            $description = htmlentities($description);;
	    $this->rss->itemDescription($description);

	    $this->rss->addItem();

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