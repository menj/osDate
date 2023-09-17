<?php

include_once(MODOSDATE_DIR . 'data.php');
include_once(MODOSDATE_DIR . 'modPlugin.php');

/**
 * The OsDate plugin API
 *
 * @author Down Home Consutling (www.DownHomeConsulting.com)
 * @version 1.0
 * @package modOsDate
 */
class modOsDate extends modPlugin
{


   /*** Attributes: ***/

   /**
   * Constructor to used to create object.
   *
   * @return void
   * @access public
   */
  function modOsDate( )
  {

  }

  /**
   *
    * Calls an osdate plugin
    *
    * @param string $name - name of the plugin
    * @param string $method - plugin method to call
    * @param array $param - plugin method's parameters
   *
   * @return mixed
   * @access private
   */
  function executePlugin( $name, $method, $param)
  {

     $out = false;

    include_once(MODOSDATE_DIR . 'plugin_data.php');
    $plug = new pluginData();

    $search['name'] = $name;
    $plugin = $plug->getRec($search);

     if ( ! isset($plugin['id']) ) {

         //$this->setErrorMessage("Plugin $name is not installed");
     }
     elseif ( ! $plugin['active'] ) {

         //$this->setErrorMessage("Plugin $name is not active");
     }
     else {

         include_once(PLUGIN_DIR . $name . '/libs/'. $name . '.php');

         $pluginobject =& new $name();

         $out = $pluginobject->$method($param);
     }
     return $out;

  }

  function checkPluginInstalled( $name)
  {

     $out = false;

    include_once(MODOSDATE_DIR . 'plugin_data.php');
    $plug = new pluginData();

    $search['name'] = $name;
    $plugin = $plug->getRec($search);

     if ( ! isset($plugin['id']) ) {

         //$this->setErrorMessage("Plugin $name is not installed");
     }
     elseif ( ! $plugin['active'] ) {

         //$this->setErrorMessage("Plugin $name is not active");
     }
     else {

		$out = $plugin;
     }

     return $out;

  }
  /**
   * Returns an associatve array of the admin menu entries and also saves the array into Smarty variable modosdate_amenu
   *
   * @param array $param an associative array with the following keys:<br><ul>
   *      <li>adminid - id of user (if blank defaults to logged in admin.</li></ul>
   * @return array
   * @access public
   */
  function modGetAdminMenu($param = false) {   // Additional

      $menu = array();

      if ( isset($param['adminid'] ) ) {

          $admindata = $this->modGetAdmin( array('adminid' => $param['adminid']) );
      }
      else {

          $admindata = $this->modGetLoggedInAdmin();
      }



      include_once(MODOSDATE_DIR . 'plugin_data.php');
      $plug   = new pluginData();

      $search['active'] = '1';
      $plugdata = $plug->getAllRec($search);

      // If we found plugins
      foreach ( $plugdata AS $pdata ) {


              $name = $pdata['name'];

              include_once(PLUGIN_DIR . $name . '/libs/'. $name . '.php');

              $pluginobject = new $name();

              $entry = $pluginobject->getAdminMenuEntry();

              if ( $entry ) {

                  $menu[] = $entry;
              }

      }
      $this->modSmartyAssign('modosdate_amenu', $menu);
      return $menu;
  }
  /**
   * Defines content into smarty varibles to appear at different predefined locations on pages
   *
   * @return array
   * @access public
   */
  function modSetContent() {   // Additional

      $this->modSetMenu();

      $this->modSetLeftCol();

      $this->modSetMain();
  }

  /**
   * Defines the left columm content smarty varible modosdate_leftcol
   *
   * @return array
   * @access public
   */
  function modSetLeftCol() {   // Additional


      include_once(MODOSDATE_DIR . 'plugin_data.php');
      $plug   = new pluginData();

      $search['active'] = '1';
      $plugdata = $plug->getAllRec($search);

      $html = '';
      // If we found plugins
      if (count($plugdata) > 0) {
		foreach ( $plugdata AS $pdata ) {
		  $param['for_pluginid'] = $pdata['id'];
		  $accessdata = $this->modGetAccessRights($param);
		  if ( isset($accessdata['access']) && $accessdata['access'] == 1 ) {

			  $name = $pdata['name'];

			  include_once(PLUGIN_DIR . $name . '/libs/'. $name . '.php');

			  $pluginobject = new $name();

		/* Make a DIV for luckyspin to enable dynamic spinning */

				if ($name == 'luckySpin') {

					  $html .= '<table border=0 cellspacing=0 cellpadding=0 width="100%"
					  ><tr><td id="luckySpin_sect" width="100%">'.$pluginobject->displayLeftCol().'</td></tr></table>';

				} else {

				  $html .= $pluginobject->displayLeftCol();
				}

		   }
		}

		$this->modSmartyAssign('modosdate_leftcol', $html);
	 }

  }


  /**
   * Defines the main content into smarty varible modosdate_main
   *
   * @return array
   * @access public
   */
  function modSetMain() {   // Additional

      include_once(MODOSDATE_DIR . 'plugin_data.php');
      $plug   = new pluginData();

      $search['active'] = '1';
      $plugdata = $plug->getAllRec($search);

      $html = '';

      // If we found plugins
      foreach ( $plugdata AS $pdata ) {

		  $param['for_pluginid'] = $pdata['id'];
		  $accessdata = $this->modGetAccessRights($param);

          // If this user has access
          if ( isset($accessdata['access']) && $accessdata['access'] == 1 ) {

			  $name = $pdata['name'];

			if ($name != 'langBanners') {
              include_once(PLUGIN_DIR . $name . '/libs/'. $name . '.php');

              $pluginobject = new $name();

              $html .= $pluginobject->displayMain();
			  }
		  }
      }

      if (count($plugindata) > 0) {
	      $this->modSmartyAssign('modosdate_main', $html);
	  }
  }

  /**
   * Defines the menu entries into a smarty variable for the logged in user or admin
   *
   * @return array
   * @access public
   */
  function modSetMenu() {   // Additional

      if ( isset($_SESSION['AdminId']) ) {

        $this->modGetAdminMenu();
      }
      elseif ( isset($_SESSION['UserId']) ) {

        $this->modGetUserMenu();
      }
  }


  /**
   * Returns an associatve array of the user menu entries and also saves the array into Smarty variable modosdate_umenu
   *
   * @param array $param an associative array with the following keys:<br><ul>
   *      <li>userid - id of user (if blank defaults to logged in user.</li></ul>
   * @return array
   * @access public
   */
  function modGetUserMenu($param = false) {   // Additional

      $menu = array();

      include_once(MODOSDATE_DIR . 'plugin_data.php');
      $plug   = new pluginData();
      $search['active'] = '1';
      $plugdata = $plug->getAllRec($search);

      // If we found plugins
      foreach ( $plugdata AS $pdata ) {

		  $param['for_pluginid'] = $pdata['id'];
		  $accessdata = $this->modGetAccessRights($param);

          // If this user has access
          if ( isset($accessdata['access']) && $accessdata['access'] == 1 ) {

              $name = $pdata['name'];

              include_once(PLUGIN_DIR . $name . '/libs/'. $name . '.php');

              $pluginobject = new $name();

              $entry = $pluginobject->getUserMenuEntry();

              if ( $entry ) {

                  $menu[] = $entry;
              }
          }

      }

      $this->modSmartyAssign('modosdate_umenu', $menu);

      return $menu;
  }
  /**
   * Processes a user plugin page and displays within the index template.
   *
   * @param array $param an associative array with the following keys:<br><ul>
   *      <li>plugin - The name of the plugin.</li></ul>
   * @return void
   * @access public
   */
  function modDisplayPluginPage($param ) {   // Additional

      $out = false;

      if ( isset($param['plugin']) ) {

          $name = $param['plugin'];
          include_once(PLUGIN_DIR . $name . '/libs/'. $name . '.php');

          $pluginobject = new $name();

          $out = $pluginobject->displayPluginPage();
      }
      $this->modSmartyAssign('rendered_page',$out);
      return $out;
  }
  /**
   * Processes a admin plugin page and displays within the index template.
   *
   * @param array $param an associative array with the following keys:<br><ul>
   *      <li>plugin - The name of the plugin.</li></ul>
   * @return void
   * @access public
   */
  function modDisplayPluginAdminPage($param ) {   // Additional

      $out = false;

      if ( isset($param['plugin']) ) {

          $name = $param['plugin'];
          include_once(PLUGIN_DIR . $name . '/libs/'. $name . '.php');

          $pluginobject = new $name();

          $out = $pluginobject->displayPluginAdminPage();
      }
      $this->modSmartyAssign('rendered_page',$out);
      return $out;
  }
  /**
   * Processes a plugin page and displays only the content returned by plugin.  DOES NOT VALIDATE LOGIN so be careful.
   *
   * @param array $param an associative array with the following keys:<br><ul>
   *      <li>plugin - The name of the plugin.</li></ul>
   * @return void
   * @access public
   */
  function modDisplayPluginContent($param ) {   // Additional

      $out = false;

      if ( isset($param['plugin']) ) {

          $name = $param['plugin'];
          include_once(PLUGIN_DIR . $name . '/libs/'. $name . '.php');

          $pluginobject = new $name();

          $out = $pluginobject->displayPluginContent();
      }
      return $out;
  }

  /* 	This function will get user information
  		and return if the user has access rights for this plugin.
		Vijay Nair
  */
	function modGetAccessRights($param) {
/*		include_once(MODOSDATE_DIR . 'plugin_access_data.php');
		$access = new pluginAccessData();

		$asearch1['roleid']   = isset($_SESSION['security']['roleid'])?$_SESSION['security']['roleid']:3;
		$asearch1['pluginid'] = $param['for_pluginid'];

		$accessdata = $access->getRec($asearch1);
		return $accessdata['access'];
		*/
		$asearch1['roleid']   = isset($_SESSION['security']['roleid'])?$_SESSION['security']['roleid']:3;
		$asearch1['pluginid'] = $param['for_pluginid'];
		$access_sql = 'select access from ! where pluginid=? and roleid=?';
		return $GLOBALS['osDB']->getOne($access_sql,array(PLUGIN_ACCESS_TABLE,$asearch1['pluginid'],$asearch1['roleid']) );
	}
} // end of modOsDate
?>
