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
 *  Call with http://yourosdatesite.com/osdatedir/pluginraw.php?plugin=atomfeed
 *
 */
include_once(MODOSDATE_DIR . 'modPlugin.php');

class atomfeed extends modPlugin {

   /**
   * Holds the language phrases
   *
   * @access private
   */
   var $lang;

   /**
   * Atom Object
   *
   * @access private
   */
   var $atom;

   var $count = 0;

   /**
   * The name name of the plugin class.
   *
   * @access private
   */
   var $plugin_class_name = "atomfeed";

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
  function atomfeed( )
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
      	include($plugindir . 'class.AtomBuilder.inc.php');
  		$conf=$this->modGetConfig();

		$this->atom =& new AtomBuilder($this->config['title'], $this->config['link'],'tag:'.$conf['admin_email'].','.date("Y-m-d").':atomfeed');
		$this->atom->setEncoding('utf-8');
		$this->atom->setLanguage($GLOBALS['language_conversion'][$this->modGetLoadedLanguage()]);
		$this->atom->setSubtitle($this->config['description']);
		$this->atom->setAuthor($conf['admin_name']);
		$date=date("Y-m-d\TH:i:s\Z",time());
		$this->atom->setUpdated($date);

		$this->atom->addCategory($this->modGetLang('type1'));

        // Get featured users
        //
        $feat = $this->modGetAllFeatured( );

		foreach ( $feat AS $userid ) {
			$this->count++;
	    	$udata = $this->modGetUser( array('userid' => $userid) );
	    	$this->addUser($udata,1);
		}

		// Get new users
		//
		$search['limit'] = $this->config['Max. items to Display'];
		$search['sort']  = 'regdate DESC';
		$newuser = $this->modGetAllUsers($search);
		$this->atom->addCategory($this->modGetLang('type2'));

		foreach ( $newuser AS $udata) {
			$this->count++;
	    	$this->addUser($udata, 2);
		}
        print header ("Content-Type: text/xml");
		$version = '1.0.0'; // 1.0 is the only version so far
		return $this->atom->getAtomOutput($version);

   }
   function addUser($udata,$type) {

	$entry = $this->atom->newEntry($this->modGetLang('type'.$type.'a').": " . $udata['username'], $this->modSiteUrl() . 'showprofile.php?id=' . $udata['id'],'tag:atomfeed,'.date("Y",$udata['regdate']).':'.$udata['username']);
	$date=date("Y-m-d\TH:i:s\Z",time()+$this->count);
	$entry->setUpdated($date); // required (last modified/updated)
	$entry->setPublished(date('r'));
	$entry->addCategory($this->modGetLang('type'.$type));

	$this->modSmartyAssign('profile', $udata);
	$this->modSmartyAssign('lang', $this->modGetLang() );
	$this->modSmartyAssign('lang_gender_look', $this->modGetLang('signup_gender_look', $udata['lookgender']) );
	$this->modSmartyAssign('lang_gender', $this->modGetLang('signup_gender_look', $udata['gender']) );

	$description =  $this->modSmartyFetch('profile.tpl');

	$entry->setContent($description, 'html');
	$this->atom->addEntry($entry);
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