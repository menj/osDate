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
 * class scrollingGallery
 *
 *  A template to get you started building templates.  Rename all scrollingGallery
 *  with the name of your plugin
 *
 *
 *
 */
include_once(MODOSDATE_DIR . 'modPlugin.php');

class scrollingGallery extends modPlugin {

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
   var $plugin_class_name = "scrollingGallery";

   /**
   * The link text that appears on the user's menu
   *
   * @access private
   */
   var $display_name  ;

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
   var $user_menu_appear = true;


   /**
   * The link text that appears on the admin's menu
   *
   * @access private
   */
   var $admin_menu_text = "";

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
  function scrollingGallery( )
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

	if(!isset($_GET['framepic']))
	{
        if ( isset($_REQUEST['id']) ) {

            $userid = $_REQUEST['id'];

            $udata = $this->modGetUser( array('userid' => $userid) );
        }
        else {

             $udata = $this->modGetLoggedInUser();
             $userid = $udata['id'];
       }
        $username = $udata['username'];


        $search = array('username' => $udata['username']);

        $useralbums = $this->modGetAllAlbums($search);


        $album_passwd = isset($_REQUEST['album_passwd'])?$_REQUEST['album_passwd']:'';

        $album_id = isset($_REQUEST['album_id'])?$_REQUEST['album_id']:'';

        if ($album_id != '') {

                $search = array(
                    'username' => $username,
                    'id'       => $album_id,
                );
                $adata = $this->modGetAlbum($search);
                $pwd = isset($adata['passwd'])?$adata['passwd']:'';

                if ($pwd != '' && $pwd != md5($album_passwd) && $userid != $_SESSION['UserId']) {

					$err = $this->lang['invalid_password'];

					$album_id = '';
                }
        }

        if ($album_id != '') {

                $search = array(
                    'userid' => $userid,
                    'album_id' => $album_id,
                );
                $pics = $this->modGetAllPictures($search);
        } else {

                $search = array(
                    'userid' => $userid,
                    'album_id' => 999,
                );
                $pics = $this->modGetAllPictures($search);
        }

        if ( isset($pics[0]['picno']) ) {

          $this->modSmartyAssign('galpicid', $pics[0]['picno']);
        }
        $this->modSmartyAssign('useralbums', $useralbums);

        $this->modSmartyAssign('username',$username);

        $this->modSmartyAssign('pics',$pics);

        $this->modSmartyAssign('userid',$userid);

		if (isset($err)) $this->modSmartyAssign('err', $err);

        $this->modSmartyAssign('album_id', $album_id);

        $this->modSmartyAssign('plugin_name', $this->plugin_class_name);

        $this->modSmartyAssign('link',"showpic.tpl");

        $css = '<link rel="stylesheet" href="' . $this->modGetDocIncludes() . 'gallerystyle.css" type="text/css" />';

        $js = '<script type="text/javascript" src="' . $this->modGetDocIncludes() . 'motiongallery.js"></script>';

        $this->modSmartyJS($js);
        $this->modSmartyCSS($css);

        return $this->modSmartyFetch('scrollinggallery.tpl');
	}
	else
	{
	$this->modSmartyAssign('userid',$_GET['id']);
	$this->modSmartyAssign('galpicid',$_GET['picid']);
	$this->modSmartyAssign('album_id',$_GET['album_id']);

	echo $this->modSmartyFetch('showpic.tpl');die();
	}

   }
   /**
   * WARNING: USER IS NOT VALIDATED HERE.  BE CAREFUL
   * Does the processing to display 100% plugin content.  Called from pluginraw.php
   *
   * @return array
   * @access public
   */
   function  displayPluginContent() {


      return $this->modSmartyFetch('pictureframe.tpl');
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