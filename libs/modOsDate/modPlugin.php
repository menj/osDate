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
 * <b>modPlugin</b> <i>Extend your OsDate capabilities</i><br>
 * <br>
 *  modPlugin is an API alowing you to extend OsDate's capabilities without modifing OsDate itself.  Plugins can be written in packages that can be distributed, uploaded and installed from a single zip file.<br>
 *  <br>
 *  <br>
 *  <b>Plugin File Structure</b><br>
 *  <br>
 *  pluginTemplate - Plugin Directory.  Must be named the same as the plugin.<br>
 *  pluginTemplate/language - Language directory.  Containts language definitions.<br>
 *  pluginTemplate/language/lang_spanish<br>
 *  pluginTemplate/language/lang_spanish/lang_main.php - Spanish language definitions.<br>
 *  pluginTemplate/language/lang_german<br>
 *  pluginTemplate/language/lang_german/lang_main.php - German language definitions.<br>
 *  pluginTemplate/language/lang_english<br>
 *  pluginTemplate/language/lang_english/lang_main.php - English language definitions.<br>
 *  pluginTemplate/language/lang_portuguese<br>
 *  pluginTemplate/language/lang_portuguese/lang_main.php - Portuguese language definitions.<br>
 *  pluginTemplate/language/lang_greek<br>
 *  pluginTemplate/language/lang_greek/lang_main.php - Greek language definitions.<br>
 *  pluginTemplate/language/lang_turkish<br>
 *  pluginTemplate/language/lang_turkish/lang_main.php - Turkish language definitions.<br>
 *  pluginTemplate/language/lang_romanian<br>
 *  pluginTemplate/language/lang_romanian/lang_main.php - Romanian language definitions.<br>
 *  pluginTemplate/language/lang_russian<br>
 *  pluginTemplate/language/lang_russian/lang_main.php - Russian language definitions.<br>
 *  pluginTemplate/language/lang_dutch<br>
 *  pluginTemplate/language/lang_dutch/lang_main.php - Dutch language definitions.<br>
 *  pluginTemplate/language/lang_french<br>
 *  pluginTemplate/language/lang_french/lang_main.php - French language definitions.<br>
 *  pluginTemplate/images - Plugin specific images.<br>
 *  pluginTemplate/sql<br>
 *  pluginTemplate/sql/install.sql - Table creation SQL.<br>
 *  pluginTemplate/includes<br>
 *  pluginTemplate/includes/default_config.php - Default configuration values.<br>
 *  pluginTemplate/templates - Plugin templage directory.<br>
 *  pluginTemplate/templates/default<br>
 *  pluginTemplate/templates/default/helloworld.tpl - User template.<br>
 *  pluginTemplate/templates/default/admin<br>
 *  pluginTemplate/templates/default/admin/helloworld.tpl - Admin template<br>
 *  pluginTemplate/libs - Classes related to plugin.<br>
 *  pluginTemplate/libs/pluginTemplate.php - Main plugin class.  Must be named the same as the plugin.<br>
 *  <br>
 *  <br>
 *  <b>Displaying Content</b><br>
 *  <br>
 *  There are four methods to display content on the OsDate site, displayPluginPage, displayPluginContent, displayLeftCol and displayMain.  These methods return HTML to be displayed.  The modPlugin logic handles the actual display of the HTML.<br>
 *  <br>
 *  <br>
 *  <b>displayPluginPage</b><br>
 *  <br>
 *  displayPluginPage is used when you need a new page on the osdate site.  HTML returned by displayPluginPage is displayed in the main content area of OsDate.  When you set the $user_menu_text variable to the text to appear on the menu, and set user_menu_appear to true, a link to your page will appear on the user menu.  You can also access the page directly using the link plugin.php?plugin=pluginTemplate (assuming your plugin naem is pluginTemplate).<br>
 *  <br>
 *  <br>
 *  <b>displayPluginContent</b><br>
 *  <br>
 *  displayPluginContent is used when you need a new page with only your content.  For example if you need a popup window that displays a simple message.  The HTML returned by displayPluginContent is displayed on the new page.  You can also access the page directly using the link pluginraw.php?plugin=pluginTemplate (assuming your plugin naem is pluginTemplate).<br>
 *  <br>
 *  <br>
 *  <b>displayLeftCol</b><br>
 *  <br>
 *  displayLeftCol will display your content in the left column of OsDate.  The HTML returned by displayLeftCol is displayed.<br>
 *  <br>
 *  <br>
 *  <b>displayMain</b><br>
 *  <br>
 *  displayMain will display your content in the main content area of OsDate below the existing main content.  The HTML returned by displayMain is displayed.<br>
 *  <br>
 *  <br>
 *  <b>Getting Started</b><br>
 *  <br>
 *  To get started on your first plugin, make a directory inside the plugins directory the name of your new plugin (ex. mkdir plugins/myNewPlugin).  Then copy all the files in the plugins/pluginTemplate directory to your new directory (ex. cp -r plugins/pluginTemplate/. plugins/myNewPlugin/).  Now rename pluginTemplate.php to the name of your plugin (ex. mv pluginTemplate.php myNewPlugin.php.  Lastly, open myNewPlugin.php and rename all instances of pluginTemplate to myNewPlugin.<br>
 *  <br>
 *  Now that you have all the files you need, start writing your code using the methods and  documentation listed below.<br>
 *  <br>
 *
 * @author Down Home Consutling (www.DownHomeConsulting.com)
 * @version 1.0
 * @package modOsDate
 */
class modPlugin {

   /**
   * Holds an array of error messages
   * @access private
   */
  var $_errorMessage = array();

   /**
   * Holds the language phrases for the active language in an associative array
   *
   * @access public
   */
   var $lang = array();


   /**
   * Holds the configuration settings
   *
   * @access private
   */
   var $config = array();

   /**
   * The link text that appears on the user's menu
   *
   * @access private
   */
   var $menu_text;

   /**
   * Appear on users menu (true or false)
   *
   * @access private
   */
   var $menu_appear = true;

   /**
   * Constructor, called by modOsDate to initialize plugin class.  There should never be a need to call this directly.
   *
   * @return void
   * @access public
   */
  function modPlugin( )
  {

    // Read the configuration
    $this->_initConfig();

    // Read the configuration
//    include($this->getLanguageDir() . 'lang_main.php');

    // Save language array
//    $this->lang = $lang;

  } // end of member method pluginClass

  /**
   *  add an event to calendar X, event details specified in parameter
   * @param array $param an associative array with the following keys:<br><ul>
   *             <li>userid - user id</li>
   *             <li>event</li>
   *             <li>description  </li>
   *             <li>recurring  - 1 or 0</li>
   *             <li>recuroption -  (0 = none, 1 = days, 2 = weeks, 3 = months, 4 = years)</li>
   *             <li>calendarid </li>
   *             <li>enabled  - Y or N</li>
   *             <li>timezone  </li>
   *             <li>datetime_from  </li>
   *             <li>datetime_to  </li>
   *             <li>private_to</li></ul>
   * @return  bool True on success.  False on failure.
   * @access public
   */
  function modAddEvent( $param )
  {

      $defaults = array(

         'recuroption' => '0',
         'private_to' => '',
      );
      $param = array_merge($defaults,$param);

      include_once(MODOSDATE_DIR . 'calendarevents_data.php');

      $evnt = new calendarEventsData();

      $evnt->addRec($param);

      return $this->_setStatus($evnt);
  }

  /**
   * return a list of permissions available to a particular user
   *
   * @param array $param an associative array with the following keys:<br><ul>
   *        <li>userid - user id of the user to logout</li></ul>
   * @return array
   * @access public
   */
  function modAvailablePermissions($param )
  {
      $perm = array();
      $user = $this->modGetUser($param['userid'] );

      if ( $user['active'] ) {

         $search['roleid'] = $user['level'];
         $perm = $this->modGetMembershipPriviledges($search);

         unset($perm['id']);
         unset($perm['roleid']);
         unset($perm['name']);
         unset($perm['activedays']);
         unset($perm['fullsignup']);
         unset($perm['price']);
         unset($perm['currency']);
         unset($perm['enabled']);
      }

      return $perm;
  }

  /**
   * returns the registration status of a particular user
   *
   * @param array $param an associative array with the following keys:<br><ul>
   *         <li>userid - user id of the user</li></ul>
   * @return string
   * @access public
   */
  function modCheckStatus($param )
  {
      $user = $this->modGetUser($param['userid'] );

      return $user['status'];

  }

  /**
   * clear a ban of user X for user Y
   *
   * @param array $param an associative array with the following keys:<br><ul>
   *           <li>userid - user id of the user to remove ban</li>
   *           <li>type - type of ban to remove, B for ban, H for hotlist, F for buddy</li></ul>
   * @return  bool True on success.  False on failure.
   * @access public
   */
  function modClrBan($param )  // Additional
  {


		$result = true;

		include_once(MODOSDATE_DIR . 'buddy_ban_list_data.php');

		$bud = new buddyBanListData();

		// See if already banned
		//
		$search['act']          = $param['type'];
		$search['ref_userid']     = $param['userid'];
		$search['userid']     = $_SESSION['UserId'];
		//$search['
		$bud->deleteRec($search);

        return $result;

  }

  /**
   * Gets a admin's record
   *
   * @param array $param an associative array with the following keys:<br><ul>
   *        <li>adminid -  id of the admin's record to get</li></ul>
   * @return array
   * @access public
   */
  function modGetAdmin($param )   // Additional
  {

      include_once(MODOSDATE_DIR . 'admin_data.php');
      $admin = new adminData();

      $data = $admin->getRec($param['adminid']);

     return $data;

  }

  /**
   * Returns the picture album that match the provided keys.
   * @param array $param an associative array with the following keys:<br><ul>
   *             <li>id - id of the album</li>
   *             <li>username - username of the album owner</li>
   *             <li>name - name of the album</li></ul>
   *
   * @return array
   * @access public
   */
  function modGetAlbum($param) // Additional
  {

         include_once(MODOSDATE_DIR . 'useralbums_data.php');

         $albm = new userAlbumsData();

         return $albm->getRec($param);
  }

  /**
   * returns all available picture albums or if params are provide, returns all the albums that match those keys.
   * @param array $param an associative array with the following keys:<br><ul>
   *             <li>username - username of the album owner</li>
   *             <li>name - name of the album</li></ul>
   *
   * @return array
   * @access public
   */
  function modGetAllAlbums($param = false)
  {

         include_once(MODOSDATE_DIR . 'useralbums_data.php');

         $albm = new userAlbumsData();

         return $albm->getAllRec($param);
  }

  /**
   * Returns all featured user profiles
   *
   * @return  array user ids of featured users
   * @access public
   */
  function modGetAllFeatured( )
  {
      include_once(MODOSDATE_DIR . 'featured_profiles_data.php');

      $feat = new featuredProfilesData();

      $rows = $feat->getAllRec();

      $data = array();

      foreach ( $rows AS $id => $row ) {

          if (   $row['id']
              && $row['exposures'] < $row['req_exposures'] && time() >=  $row['start_date'] && time() <= $row['end_date'] ) {

              $data[] = $row['userid'] ;
          }
      }
      return $data;
  }

  /**
   * returns all configured languages
   *
   * @return array
   * @access public
   */
  function modGetAllLanguages( )  // Additional
  {
        $sql = "SELECT DISTINCT lang FROM ! ORDER BY lang";

        $data =  $GLOBALS['osDB']->getAll($sql, array(LANGUAGE_TABLE));

        $out = array();
        foreach ($data AS $value ) {

            $out[] = $value['lang'];
        }
        return $out;
  }

  /**
   * returns all available pictures for a user / album
   *
   * @param array $param an associative array with the following keys:<br><ul>
   *          <li>userid - user id of the user</li>
   *          <li>album_id  - id of the album</li>
   *          <li>active  - Y or N</li></ul>
   * @return array <br>
   * Example:<br><br>
   * Array<br>
   * (<br>
   *     [0] => Array<br>
   *         (<br>
   *             [id] => 37<br>
   *             [userid] => 104<br>
   *             [picno] => 1<br>
   *             [ins_time] => 1154301578<br>
   *             [active] => Y<br>
   *             [picext] => jpg<br>
   *             [tnext] => jpg<br>
   *             [album_id] => 0<br>
   *         )<br>
   * <br>
   *     [1] => Array<br>
   *         (<br>
   *             [id] => 38<br>
   *             [userid] => 104<br>
   *             [picno] => 2<br>
   *             [ins_time] => 1154301599<br>
   *             [active] => Y<br>
   *             [picext] => jpg<br>
   *             [tnext] => jpg<br>
   *             [album_id] => 0<br>
   *         )<br>
   * )<br>
   * @access public
   */
  function modGetAllPictures( $param )
  {
      $pictures = array();
      // Don't get the actual pictures or we'll run out of memeory
      //
      $opt['fields'] = array('id', 'userid', 'picno', 'ins_time', 'active', 'picext', 'tnext', 'album_id');

      include_once(MODOSDATE_DIR . 'usersnaps_data.php');

      $snap = new userSnapsData();

      $pictures = $snap->getAllRec($param,$opt);

      return $pictures;

  }

  /**
   * Gets all user's records matching provided parameters
   *
   * @param array $param an associative array with any of the following keys:<br><ul>
   *  <li>sort - field to sort by and direction (ex. "username ASC" or "username DESC"</li>
   *  <li>limit - max number of records to return</li>
   *  <li>id</li>
   *  <li>active, </li>
   *  <li>username</li>
   *  <li>lastvisit</li>
   *  <li>regdate</li>
   *  <li>level</li>
   *  <li>timezone</li>
   *  <li>allow_viewonline</li>
   *  <li>rank</li>
   *  <li>email</li>
   *  <li>country</li>
   *  <li>actkey</li>
   *  <li>firstname</li>
   *  <li>lastname</li>
   *  <li>gender</li>
   *  <li>lookgender</li>
   *  <li>lookagestart</li>
   *  <li>lookageend</li>
   *  <li>address_line1</li>
   *  <li>address_line2</li>
   *  <li>state_province</li>
   *  <li>county</li>
   *  <li>city</li>
   *  <li>zip</li>
   *  <li>birth_date</li>
   *  <li>lookcountry</li>
   *  <li>lookstate_province</li>
   *  <li>lookcounty</li>
   *  <li>lookcity</li>
   *  <li>lookzip</li>
   *  <li>lookradius</li>
   *  <li>radiustype</li>
   *  <li>picture</li>
   *  <li>status</li>
   *  <li>levelend</li>
   *  <li>levelend_date</li></ul>
   * @return array
   * @access public
   */

  function modGetAllUsers($param )  // Additional
  {
      include_once(MODOSDATE_DIR . 'user_data.php');
      $user = new userData();

      $opt = false;
      if ( array_key_exists('sort', $param) ) {
          $opt['sort'] = $param['sort'];
          unset($param['sort']);
      }

      if ( array_key_exists('limit', $param) ) {
          $opt['limit'] = $param['limit'];
         unset($param['limit']);
      }
      $data = $user->getAllRec($param, $opt);
      $alldata = array();
      if ( count($param) == 0 ) {

        unset($param);
      }

      // Get all doesn't get the statename, country name and age, so refetch
      // using modGetUser to get everything
      //
      foreach ( $data AS $value ) {

        $udata = $this->modGetUser( array('userid' => $value['id']) );
        $alldata[] = array_merge($udata,$value);
      }
      return $alldata;
  }

   /**
   *  returns a list of all available calendars
   *
   * @return array
   * @access public
   */
  function modGetCalendars( )
  {

      include_once(MODOSDATE_DIR . 'calendars_data.php');

      $cal = new calendarsData();

      return $cal->getAllRec();
  }

  /**
   *  returns a list of all available events for calendar X
   *
   * @param array $param an associative array with the following keys:<br><ul>
   *             <li>calendarid - id of calendar</li></ul>
   * @return array
   * @access public
   */
  function modGetEvents( $param )
  {
      include_once(MODOSDATE_DIR . 'calendarevents_data.php');

      $evnt = new calendarEventsData();

      $search['calendarid'] = $param['calendarid'];
      return $evnt->getAllRec($search);

  }

 /**
   * Returns the current error messages
   *
   * @return array
   * @access public
   */
   function modGetErrorMessage() {

      return $this->_errorMessage;
   }

  /**
   * returns the currently loaded language
   *
   * @return string
   * @access public
   */
  function modGetLoadedLanguage( )
  {
      $language = 'english';

      if ( isset($_SESSION['opt_lang']) && $_SESSION['opt_lang'] != '' ) {

         $language = $_SESSION['opt_lang'];
      }
      return $language;
  }

  /**
   * Given a picture id, returns the picture
   *
   * @param array $param an associative array with the following keys:<br><ul>
   *             <li>id - id of the picture</li>
   *             <li>type - type of picture ('main' or 'thumbnail')</li></ul>
   * @return string
   * @access public
   */
  function modGetPicture( $param )  // Additional
  {

      if ( isset($param['main']) ) {

         $type = 'tnpicture';
      }
      elseif ( isset($param['thumbnail']) ) {

         $type = 'picture';
      }
      else {

         $type = 'picture';
      }

      include_once(MODOSDATE_DIR . 'usersnaps_data.php');

      $albm = new userSnapsData();

      $picture = $albm->getRecField($param['id'],$type);
      $albm->clrData();

     return $picture;

  }

  /**
   * returns the value of any particular global configuration setting
   *
   * @param array $param an associative array with the following key:<br><ul>
   *            <li>setting - name of the setting</li></ul>
   * @return string|int
   * @access public
   */
  function modGetSetting( $param)
  {

      if (isset($GLOBALS['config'][ $param['setting'] ]) ) {

         $result = $GLOBALS['config'][ $param['setting'] ];
      }
      else {

         $this->_setErrorMessage("Setting doesn't exist");
         $result = false;
      }
      return $result;

  }

  /**
   * Gets a user's record
   *
   * @param array $param an associative array with the following key:<br><ul>
   *        <li>userid - user id of the users record to get</li></ul>
   * @return array <br>
   * Example:<br>
   * Array<br>
   * (<br>
   *     [id] => 104<br>
   *     [active] => 1<br>
   *     [username] => testuser<br>
   *     [password] => 179ad45c6ce2cb97cf1029e212046e81<br>
   *     [lastvisit] => 1154266346<br>
   *     [regdate] => 1152972184<br>
   *     [level] => 1 (role id)<br>
   *     [timezone] => -10.00<br>
   *     [allow_viewonline] => 1<br>
   *     [rank] => 1<br>
   *     [email] => dlhinkley@localhost.localdomain<br>
   *     [country] => US<br>
   *     [actkey] => bf45e84c32babfdcb9bce75381b7c8e5<br>
   *     [firstname] => Test<br>
   *     [lastname] => USer<br>
   *     [gender] => M<br>
   *     [lookgender] => F<br>
   *     [lookagestart] => 16<br>
   *     [lookageend] => 90<br>
   *     [address_line1] => <br>
   *     [address_line2] => <br>
   *     [state_province] => AK<br>
   *     [county] => sadff<br>
   *     [city] => asdff<br>
   *     [zip] => 12345<br>
   *     [birth_date] => 1981-07-15<br>
   *     [lookcountry] => US<br>
   *     [lookstate_province] => AA<br>
   *     [lookcounty] => <br>
   *     [lookcity] => <br>
   *     [lookzip] => <br>
   *     [lookradius] => <br>
   *     [radiustype] => <br>
   *     [picture] => 0<br>
   *     [status] => Active<br>
   *     [levelend] => 1185113123<br>
   *     [countryname] => United States<br>
   *     [statename] => Alaska<br>
   *	 [countyname] => Herbertson<br>
   *	 [cityname] => New York<br>
   *     [age] => 25<br>
   * 	 [levelend_date] => 3-31-2006<br>
   * )<br>
   * @access public
   */
  function modGetUser($param )   // Additional
  {

      include_once(MODOSDATE_DIR . 'user_data.php');
      $user = new userData();

      $data = $user->getRec($param['userid']);

      if ( $data && $data['active'] == '1') {

        // Get the coutry name
        $sql = "select name from ".COUNTRIES_TABLE." where code = '".$data['country']."'";
        $data['countryname'] = $user->getField('name', $sql);

		if (isset($data['state_province']) && $data['state_province'] != '') {

			$sql = "select name from ".STATES_TABLE." where countrycode = '".$data['country']."' and code = '".$data['state_province']."'";

        // Get the state name

	        $data['statename'] = $user->getField('name', $sql);
		}
		if (isset($data['county']) && $data['county'] != '') {
			// Get the county name
			$sql = "select name from ".COUNTIES_TABLE." where code = '".$data['county']."' and countrycode = '".$data['country']."' and statecode = '".$data['state_province']."'";

			$x_countyname = $user->getField('name',$sql);
			if (isset($x_countyname) && $x_countyname != '') {
				$data['countyname'] = $x_countyname;
			} else {
				$data['countyname'] = $data['county'];
			}
		}

		if (isset($data['city']) && $data['city'] != '') {
			// Get the county name
			if ($data['county'] != '') {
				$sql = "select name from ".CITIES_TABLE." where code = '".$data['city']."' and countrycode = '".$data['country']."' and statecode = '".$data['state_province']."' and countycode = '".$data['county']."'" ;
			} else {
				$sql = "select name from ".CITIES_TABLE." where code = '".$data['city']."' and countrycode = '".$data['country']."' and statecode = '".$data['state_province']."' limit 1" ;
			}
			$x_cityname = $user->getField('name',$sql);

			if (isset($x_cityname) && $x_cityname != '') {
				$data['cityname'] = $x_cityname;
			} else {
				$data['cityname'] = $data['city'];
			}
		}

		$data['levelend_date'] = strftime(get_lang('DATE_FORMAT'),$data['levelend']);

        // Use sql to calculate age

        $sql = "SELECT floor((to_days('".date("Y-m-d")."')-to_days('".$data['birth_date']."'))/365.25)  as age";

        $data['age'] = $user->getField('age',$sql);

		$sql = "select count(*) as cnt from ".USER_SNAP_TABLE." where userid = '".$data['id']."' and ( album_id = 0 or album_id is  null ) ";

        $data['photos_cnt'] = $user->getField('cnt',$sql);
      } else {
		  $data=false;
	  }
      return $data;

  }

  /**
   *  check to see if the user has permission to access resource X
   *
   * @param array $param an associative array with the following keys:<br><ul>
   *         <li>userid - user id of the user to logout</li>
   *         <li>resource - name of the resource one of ( chat, forum, blog, poll, includeinsearch, message, message_keep_days, allowim, uploadpicture, uploadpicturecnt, allowalbum, event_mgt, seepictureprofile, favouritelist, sendwinks, extsearch, fullsignup)</li></ul>
   * @return  bool True on success.  False on failure.
   * @access public
   */
  function modHasPermission( $param )
  {
      $permission = true;

      include_once(MODOSDATE_DIR . 'user_data.php');
      $user = new userData();

      $user->getRec($param['userid']);

      if ( ! $user->getData('active') ) {

         $permission = false;
      }
      else {

         $search['roleid'] = $user->getData('level');
         $mdata = $this->modGetMembershipPriviledges($search);

         if ( ! $mdata[ $param['resource'] ] ) {

         $permission = false;
         }
      }

      return $permission;
  }

  /**
   * check to see if user X is banned for user Y
   *
   * @param array $param an associative array with the following keys:<br><ul>
   *        userid -  user id of the user to check
   *           <li>type - type of ban to check, B for ban, H for hotlist, F for buddy</li></ul>
   * @return bool true for banned false for not banned
   * @access public
   */
  function modIsBanned( $param)
  {
	$result = false;

	include_once(MODOSDATE_DIR . 'buddy_ban_list_data.php');

	$bud = new buddyBanListData();

	// See if already banned
	//
	$search['act']          = $param['type'];
	$search['userid']     = $param['userid'];
	$search['ref_userid']     = $param['ref_userid'];
	//$search['
	$bud->getRec($search);

	if ( $bud->getData('id') ) {

	   $result = true;
	}

	return $result;

  }

  /**
   * determines if a user's profile is featured
   *
   * @param array $param an associative array with the following keys:<br><ul>
   *             <li>userid - user id</li></ul>
   * @return  bool True if featured.  False if not featured.
   * @access public
   */
  function modIsFeatured( $param )
  {
      include_once(MODOSDATE_DIR . 'featured_profiles_data.php');

      $feat = new featuredProfilesData();

      $search['userid'] = $param['userid'];
      $feat->getRec($search);

      if (   $feat->getData('id')
          && $feat->getData('exposures') < $feat->getData('req_exposures') && time() >=  $feat->getData('start_date') && time() <= $feat->getData('end_date') ) {

         $featured = true;
      }
      else {

         $featured = false;
      }
      return $featured;

  }

  /**
   * check to see if user with id is logged in
   *
   * @param array $param an associative array with the following keys: <br><ul>
   *           <li>userid - the user id of the user</li></ul>
   * @return bool True if logged in.  False if not logged in.
   * @access public
   */

  function modIsLoggedIn( $param )
  {

      include_once(MODOSDATE_DIR . 'onlineusers_data.php');
      $d = new onlineusersData();

      $search['userid'] = $param['userid'];
      $d->getRec($search);

      return $d->getData('userid');


  }
 /**
   * logout the current user
   *
   * @param array $param an associative array with the following keys:<br><ul>
   *         <li>userid - the user id of the user to logout </li></ul>
   * @return bool True on success.  False on failure.
   * @access public
   */
  function modLogout( $param)
  {
    global $config, $cookie;

      include_once(MODOSDATE_DIR . 'onlineusers_data.php');
      $d = new onlineusersData();

      $search['userid'] = $param['userid'];
      $d->deleteRec($search);

      session_destroy();

      unset( $_COOKIE[$config['cookie_prefix'].'osdate_info'] );
      unset( $cookie );
      unset( $_SESSION );

      return $this->_setStatus($d);
  }

  /**
   *  sets/unsets a user's profile as featured
   *
   *  @param array $param an associative array with the following keys:<br><ul>
   *            <li>userid</li>
   *            <li>start_date - year-mo-day (ex 2006-07-15) </li>
   *            <li>end_date -  year-mo-day (ex 2006-07-15) </li>
   *            <li>must_show - 1 or 0 </li>
   *            <li>req_exposures  - required exposures</li></ul>
   * @return  bool True on success.  False on failure.
   * @access public
   */
  function modMakeFeatured($param )
  {
      include_once(MODOSDATE_DIR . 'featured_profiles_data.php');

      $feat = new featuredProfilesData();
      $data = array(
         'userid'        => $param['userid'],
         'start_date'    => strtotime($param['start_date']),
         'end_date'      => strtotime($param['end_date']),
         'must_show'     => $param['must_show'],
         'req_exposures' => $param['req_exposures'],
      );
      $search['userid'] = $param['userid'];
      $feat->deleteRec($search);

      $feat->addRec($data);

      return $this->_setStatus($feat);
  }

  /**
   * remove album X from the user's albums
   *
   * @param array $param an associative array with the following keys:<br><ul>
   *             <li>album - name of album</li>
   *             <li>userid - user id of user the album belongs</li></ul>
   * @return  bool True on success.  False on failure.
   * @access public
   */
  function modRemoveAlbum($param )
  {
       $result = false;

      if ( isset($param['album']) && isset($param['userid'] ) ) {

         $user = $this->modGetUser( array('userid' => $param['userid']) );

         include_once(MODOSDATE_DIR . 'useralbums_data.php');

         $albm = new userAlbumsData();

         $asearch['name'] = $param['album'];
         $asearch['username'] = $user['username'];

         $albm->getRec($asearch);

         $psearch['album_id'] = $albm->getData('id');
         $psearch['userid'] = $param['userid'];

         $albm->deleteRec( $albm->getData('id') );

         include_once(MODOSDATE_DIR . 'usersnaps_data.php');

         $snap = new userSnapsData();

         $snap->deleteRec($psearch);

         $result = $this->_setStatus($snap);
      }
      return $result;
  }

  /**
   * Given a picture id, remove the picture from the users album
   *
   * @param array $param an associative array with the following keys:<br><ul>
   *        <li>id  - id of the picture</li></ul>
    * @return  bool True on success.  False on failure.
   * @access public
   */
  function modRemovePicture($param )
  {

      include_once(MODOSDATE_DIR . 'usersnaps_data.php');

      $albm = new userSnapsData();

      $albm->deleteRec($param['id']);

      return $this->_setStatus($albm);
  }

  /**
   *  send a wink to a single user
   *
   * @param array $param an associative array with the following keys:<br><ul>
   *         <li>from_userid - the user id the wink is from</li>
   *         <li>to_userid the user id the wink is for</li></ul>
   * @return  bool True on success.  False on failure.
   * @access public
   */

  function modSendWink($param )
  {
      $data['ref_userid']  = $param['from_userid'];
      $data['userid']      = $param['to_userid'];
      $data['act']         = 'W';
      $data['act_time']    = time();

      if ( ! $this->modHasPermission(array('userid'=>$param['from_userid'],'resource'=>'sendwinks')))
      {

         $this->_setErrorMessage($this->modGetLang("insufficientPrivileges"));

         return false;

      }

 	  include_once(MODOSDATE_DIR . 'user_actions_data.php');

	  $userAction = new userActionsData();

      $winks_for_today = 0;

	  /* Check the count of messages sent for today... */
	  $winks_for_today = $GLOBALS['osDB']->getOne('select act_cnt from ! where userid = ? and act_type = ? and act_date = ?',array(USER_ACTIONS, $param['from_userid'], 'W', date('Ymd')));

	  if ($winks_for_today >= $_SESSION['security']['winks_per_day'] ) {

         $this->_setErrorMessage($this->modGetLang("errormsgs","123"));

         return false;

	  }

 	  include_once(MODOSDATE_DIR . 'views_winks_data.php');

	  $wink = new viewWinksData();

	  $wink->addRec($data);

	  $result = $this->_setStatus($wink);

	/* Now add this send wink count */
	  if ($winks_for_today> 0) {
		$GLOBALS['osDB']->query('update ! set act_cnt=act_cnt+1 where userid=? and act_type=? and act_date = ?', array(USER_ACTIONS,$param['from_userid'], 'W', date('Ymd')));
	  } else {
		$GLOBALS['osDB']->query('insert into ! (userid, act_type, act_date, act_cnt) values (?,?,?,?)', array(USER_ACTIONS, $param['from_userid'], 'W', date('Ymd'), 1));
	  }

      return $result;
  }

  /**
   * set a ban of user X for user Y
   *
   * @param array $param an associative array with the following keys:<br><ul>
   *          <li>userid - user id of the user to ban</li>
   *          <li>ref_userid - the user id of the refering user</li>
   *          <li>action - B for ban, H for hotlist, F for buddy</li></ul>
   * @return  bool True on success.  False on failure.
   * @access public
   */
  function modSetBan($param )
  {
         $result = true;
            include_once(MODOSDATE_DIR . 'buddy_ban_list_data.php');

            $bud = new buddyBanListData();

            // See if already banned
            //
            $search['act']          = $param['action'];
            $search['userid']     = $param['userid'];
            $search['ref_userid'] = $param['ref_userid'];
            //$search['
            $bud->getRec($search);

            if ( ! $bud->getData('id') ) {

               $data['act']          = $param['action'];
               $data['userid']     = $param['userid'];
               $data['ref_userid'] = $param['ref_userid'];
               $data['act_date'] = time();
               $bud->addRec($data);
            }
        return $result;

  }

 /**
   * sets the currently loaded language
   *
   *  @param array $param an associative array with the following keys:<br><ul>
   *          <li>language - dutch ,french ,greek ,portuguese ,russian ,turkish ,english ,german  ,romanian or spanish</li></ul>
   * @return void
   * @access public
   */
  function modSetLoadedLanguage( $param)
  {

    $_SESSION['opt_lang'] = $param['language'];

  }


  /**
   *  gets a list of all current banners
   *
   * @return array
   * @access public
   */
  function modGetBanners( )
  {
      $sql1 = 'SELECT id FROM ! WHERE ( startdate <= ? AND  expdate >= ? ) AND enabled = ?';

      return  $GLOBALS['osDB']->getAll( $sql1, array( BANNER_TABLE, time(), time(), 'Y' ) );
  }

  /**
   *  gets the click statistics for banner X
   *
   * @param array $param an associative array with the following keys:<br><ul>
   *        <li>bannerid - id of banner</li></ul>
   * @return int number of clicks
   * @access public
   */
  function modGetBannerStats( $param)
  {
     include_once(MODOSDATE_DIR . 'banners_data.php');

      $ban = new bannersData();
      $search['id'] = $param['bannerid'];

      $ban->getRec($param['bannerid']);

      return $ban->getData('clicks');

  }

  /**
   * gets an array of all affiliate statistics for affiliate X
   *
   * @return array
   * @access public
   */
  function modGetAffiliateStats( )
  {


         $sql = 'SELECT * FROM ! WHERE status in (?, ?)';

         $rs = $GLOBALS['osDB']->getAll( $sql, array( AFFILIATE_TABLE, 'Active', get_lang('status_enum','active') ) );

         $data = array();

         foreach ( $rs as $row ) {

            $sqlc = 'SELECT count(*) as num1 FROM ! WHERE affid = ?';

            $rowc = $GLOBALS['osDB']->getRow( $sqlc, array( AFFILIATE_REFERALS_TABLE, $row['id'] ) );

            $row['totalref'] = $rowc['num1'];

            unset( $rowc );

            $sqlcc = 'SELECT count(*) as num2 FROM ! WHERE affid = ?  and userid <>  ?' ;

            $rowc = $GLOBALS['osDB']->getRow( $sqlcc, array( AFFILIATE_REFERALS_TABLE, $row['id'], '0' ) );

            $row['regref'] = $rowcc['num2'];

            unset( $rowcc );

            $data[] = $row;
         }
      return $data;

  }


  /**
   * gets the membership settings for any particular level
   *
   * @param array $param an associative array with any of the following keys:<br><ul>
   *            <li>roleid - role id</li>
   *            <li>name - (ex. Gold) </li></ul>
   * @return array <br>
   * Example:<br>
   * Array<br>
   * (<br>
   *     [id] => 1<br>
   *     [roleid] => 1<br>
   *     [name] => Gold<br>
   *     [chat] => 1<br>
   *     [forum] => 1<br>
   *     [blog] => 1<br>
   *     [poll] => 1<br>
   *     [includeinsearch] => 1<br>
   *     [message] => 1<br>
   *     [message_keep_cnt] => 0<br>
   *     [message_keep_days] => 0<br>
   *     [allowim] => 1<br>
   *     [uploadpicture] => 1<br>
   *     [uploadpicturecnt] => 20<br>
   *     [allowalbum] => 1<br>
   *     [event_mgt] => 1<br>
   *     [seepictureprofile] => 1<br>
   *     [favouritelist] => 1<br>
   *     [sendwinks] => 1<br>
   *     [extsearch] => 1<br>
   *     [activedays] => 365<br>
   *     [fullsignup] => 1<br>
   *     [price] => 20.00<br>
   *     [currency] => USD<br>
   *     [enabled] => Y<br>
   * )<br>
   * @access public
   */
  function modGetMembershipPriviledges( $param)
  {
         include_once(MODOSDATE_DIR . 'membership_data.php');

         $mem = new membershipData();

         $mem->getRec($param);

      return $mem->getData();

  }

  /**
   *  gets a list of current polls
   *
   * @return array
   * @access public
   */
  function modGetPolls( )
  {
         include_once(MODOSDATE_DIR . 'polls_data.php');

         $poll = new pollsData();

      $search['enabled'] = 'Y';
      $search['active'] = '1';
      return   $poll->getAllRec();

  }

  /**
   * gets a list of poll statistics for poll X
   *
   * @param array $param an associative array with the following keys:<br><ul>
   *          <li>pollid - id of poll</li></ul>
   * @return array
   * @access public
   */
  function modGetPollStats( $param)
  {
         include_once(MODOSDATE_DIR . 'polloptions_data.php');

         $poll = new pollOptionsData();

      $search['pollid'] = $param['pollid'];
      return   $poll->getAllRec($search);

  }

  /**
   * gets a list of all profile ratings for user X
   *
   * @param array $param an associative array with the following keys:<br><ul>
   *         <li>userid - id of user</li></ul>
   * @return array
   * @access public
   */
  function modGetProfileRatings( $param)
  {
         include_once(MODOSDATE_DIR . 'userrating_data.php');

         $rate = new userRatingData();

         $search['userid'] = $param['userid'];
      return   $rate->getAllRec($search);

  }

  /**
   * adds a profile rating for user X
   *
   * @param array $param an associative array with the following keys:<br><ul>
   *           <li>userid - id of user</li>
   *           profileid - users profile id
   *           rating
   *           <li>ratingid (optional)</li></ul>
   * @return  bool True on success.  False on failure.
   * @access public
   */
  function modAddProfileRating($param )
  {
         include_once(MODOSDATE_DIR . 'userrating_data.php');

         $rate = new userRatingData();

         $defaults = array(
            'ratingid' => '0',
         );
         $param = array_merge($defaults,$param);
         $data = array (
             'userid' => $param['userid'],
             'profileid' => $param['profileid'],
             'rating' => $param['rating'],
             'rate_time' => time(),
             'ratingid' => $param['ratingid'],
			'comment_date'	=> date("Y-m-d"),
			'rating_date'	=> date("Y-m-d"),
         );

         $rate->addRec($data);

      return $this->_setStatus($rate);
  }

  /**
   *  get all current articles
   *
   * @return array
   * @access public
   */
  function modGetArticles( )
  {
         include_once(MODOSDATE_DIR . 'articles_data.php');

         $art = new articlesData();

      return $art->getAllRec();

  }

  /**
   * get all current news items
   *
   * @return array
   * @access public
   */
  function modGetNews( )
  {
         include_once(MODOSDATE_DIR . 'news_data.php');

         $news = new newsData();

      return $news->getAllRec();

  }

  /**
   * sets the current news list (all at once).<br>
   * data provided in a multidensional array of the format:<br>
   *<br>
    * $news = array (<br>
    *   0 =><br>
    *   array (<br>
    *     'date' => '1119770866',<br>
    *     'header' => 'Internet Dating More Successful than Thought',<br>
    *     'text' => 'Internet dating is proving a much more successful way to find long-term romance and friendship for thousands of people than was previously thought, new research shows.',<br>
    *   ),<br>
    *   1 =><br>
    *   array (<br>
    *     'date' => '1119770969',<br>
    *     'header' => 'New Dating Guide for Seniors',<br>
    *     'text' => 'Are you over age 65, single and thinking about entering the dating world?<br>
    * ',<br>
    * <br>
    *   ),<br>
    *   2 =><br>
    *   array (<br>
    *     'date' => '1237834800',<br>
    *     'header' => 'Women More Likely to Snoop Than Men',<br>
    *     'text' => 'In the new film, Little Black Book, Brittany Murphy\'s character engages in some high-tech snooping on her new boyfriend. ',<br>
    *   ),<br>
    * );<br>
    *
   * @param array $param an associative array with the following keys:<br><ul>
   *      <li>date -  Unix timestamp</li>
   *      <li>header</li>
   *      <li>text</li></ul>
   * @return  bool True on success.  False on failure.
   * @access public
   */
  function modSetNews($param )
  {
         include_once(MODOSDATE_DIR . 'news_data.php');

         $news = new newsData();

         // Delete all news
         $news->deleteRec(false,true);

         // Add all news
         $news->addRecRows($param);

      return  $this->_setStatus($news);

  }

  /**
   * determines if a zip code CSV file is loaded for a country
   *
   * @param array $param an associative array with the following keys:<br><ul>
   *           <li>countrycode - two letter country code</li></ul>
   * @return  bool True on success.  False on failure.
   * @access public
   */
  function modIsZipLoaded($param )
  {
         include_once(MODOSDATE_DIR . 'zips_data.php');

         $zips = new zipsData();

         $opt['limit'] = 1;
         $search['countrycode'] = $param['countrycode'];
         if ( $zips->getRec($search,$opt) ) {

            $found = true;
         }
         else {

            $found = false;
         }
        return $found;

  }

  /**
   * get data for the currently logged in user
   *
   * @return array
   *
   * @access public
   */
  function modGetLoggedInUser( )
  {
    return $this->modGetUser( array('userid' => $_SESSION['UserId']) );
  }

  /**
   * get data for the currently logged in admin
   *
   * @return array
   * @access public
   */
  function modGetLoggedInAdmin( )
  {
    return $this->modGetAdmin( array('adminid' => $_SESSION['AdminId']) );
  }

  /**
   *  get information related to the currently-loaded payment modules
   *
   * @return array
   * @access public
   */
  function modGetPaymentMods( )
  {
         include_once(MODOSDATE_DIR . 'payment_modules_data.php');

         $mod = new paymentModulesData();

      return $mod->getAllRec();
  }

  /**
   *  get all transactions for a particular user
   *
   * @param array $param an associative array with the following keys:<br><ul>
   *      <li>userid - id of user</li></ul>
   * @return array
   * @access public
   */
  function modGetUserTransactions( $param )
  {
      include_once(MODOSDATE_DIR . 'transactions_data.php');

      $tran = new transactionsData();

      $search['user_id'] = $param['userid'];
      return $tran->getAllRec($search);

  }

  /**
   *  get payment transaction information for a particular transaction
   *  search by one or many paramaters
   *
   * @param array $param an associative array with the following keys:<br><ul>
   *       <li>invoice_no - invoice number</li>
   *       <li>user_id - user id</li>
   *       <li>txn_id - transaction id</li>
   *       <li>txn_date - transaction date</li></ul>
   * @return array
   * @access public
   */
  function modGetTransaction( $param)
  {

      include_once(MODOSDATE_DIR . 'transactions_data.php');

      $tran = new transactionsData();

      return $tran->getAllRec($param);

  }

  /**
   *  get details on a specific blog post
   *
   * @param array $param an associative array with any of the following keys:<br><ul>
   *         <li>id - id of blog post</li>
   *         <li>userid - id of user</li>
   *         <li>adminid - id of admin</li>
   *         <li>date_posted</li>
   *         <li>title</li>
   *         <li>story</li>
   *         <li>views</li></ul>
   * @return array id, userid, adminid, date_posted, title, story, views
   * @access public
   */
  function modGetBlogPost($param )
  {
      include_once(MODOSDATE_DIR . 'blog_story_data.php');

      $blog = new blogStoryData();

      return $blog->getRec($param);
  }

  /**
   * get details on a specific blog
   * @param array $param an associative array with any of the following keys:<br><ul>
   *         <li>id - id of blog</li>
   *         <li>userid - id of user owning blog (if a user blog)</li>
   *         <li>adminid - id of admin owning blog (if a admin blog)</li>
   *         <li>name</li>
   *         <li>description</li>
   *         <li>members_comment</li>
   *         <li>buddies_comment</li>
   *         <li>members_vote</li>
   *         <li>gui_editor </li>
   *         <li>max_comments </li>
   *         <li>bad_words </li>
   *         <li>title_template </li>
   *         <li>story_template</li></ul>
   * @return array  id, userid, adminid, name, description, members_comment, buddies_comment, members_vote, gui_editor, max_comments, bad_words, title_template, story_template
   * @access public
   */
  function modGetBlogInfo($param )
  {
      include_once(MODOSDATE_DIR . 'blog_preferences_data.php');

      $blog = new blogPreferencesData();

      return $blog->getRec($param);

  }


  /**
   * get details on a plugin
   * @param array $param an associative array with any of the following keys:<br><ul>
   *         <li>id - id of plugin</li>
   *         <li>name - name of plugin</li></ul>
   * @return array  id, name, active
   * @access public
   */
  function modGetPlugin($param )  // Additional
  {
      include_once(MODOSDATE_DIR . 'plugin_data.php');

      $plugin = new pluginData();

      return $plugin->getRec($param);

  }

  /**
   * remove a specific blog post
   *
   * @param array $param an associative array with any of the following keys:<br><ul>
   *      <li>id - id of post</li>
   *      <li>userid - id of user owning post (if user post)</li>
   *      <li>adminid - id of admin owning post (if adming post)</li>
   *      <li>date_posted</li>
   *      <li>title</li>
   *      <li>story</li>
   *      <li>views</li></ul>
   * @return  bool True on success.  False on failure.
   * @access public
   */
  function modRemoveBlogPost( $param)
  {
      include_once(MODOSDATE_DIR . 'blog_story_data.php');

      $blog = new blogStoryData();

      return $blog->deleteRec($param);

  }

  /**
   * remove a specific blog comment
   *
   * @param array $param an associative array with the following keys:<br><ul>
   *      <li>id - id of comment</li>
   *      <li>userid - id of user owning comment (if user blog)</li>
   *      <li>adminid - id of admin owning comment (if admin blog)</li>
   *      <li>blogid - id of blog the comment belongs to</li>
   *      <li>datetime</li>
   *      <li>comment</li></ul>
   * @return  bool True on success.  False on failure.
   * @access public
   */
  function modRemoveBlogComment($param )
  {
      include_once(MODOSDATE_DIR . 'blog_story_data.php');

      $blog = new blogStoryData();

      return $blog->deleteRec($param);
  }
  /**
   * Returns a profile matching the search params.
   *
   * @param array $param an associative array with the following keys:<br><ul>
   *          <li>rand - 1 to return a random profile
   *          <li>id - return the profile matching this id</li></ul>
   * @return array
   * @access public
   */
  function modGetProfile($param )
  {

      include_once(MODOSDATE_DIR . 'user_data.php');
      $user = new userData();

      $opt = false;

      // If we want a random profile
      //
      if ( isset($param['rand']) ) {
         $opt['sort'] = "RAND()";
         $opt['limit'] = "1";
         /* Ignore the user id if it was just shown. Select only users who have loaded photo */
   	    $data = $user->getRec(false,$opt);

   	    // Return all the details including country, state and age
   	    //
   	    $data = $this->modGetUser( array('userid' => $data['id']) );

      }
      // If we just want a user id
      else {

          $data = $this->modGetUser( array('userid' => $param['id']) );
      }


      return $data;
  }

  /**
   *  send a message to a single user or group of users
   * @param array $param an associative array with the following keys:<br><ul>
   *            <li>message - can be a templated message using user parameters in # (i.e. #firstname#, #country#))</li>
   *               <li>rcvuserid - userid of member to receive message.</li>
   *               <li>snduserid - userid of member to send message.</li>
   *               <li>subject - message subject.</li>
   *               <li>notify - set to true to notify sender when read</li></ul>
   * @return  bool True on success.  False on failure.
   * @access public
   */
  function modSendMessage( $param )
  {

    if ( isset($param['message']) && isset($param['rcvuserid']) ) {

      $data = $this->modGetUser( array('userid' => $param['rcvuserid']) );

      $message = $this->_fillTemplate($param['message'], $data);

      include_once(MODOSDATE_DIR . 'mailbox_data.php');
      $mail = new mailboxData();

      if ( ! isset($param['notify']) ) {

         $param['notify'] = '0';
      }
      // Put in inbox
      //
      $sdata['owner']       = $param['rcvuserid'];
      $sdata['senderid']    = $param['snduserid'];
      $sdata['recipientid'] = $param['rcvuserid'];;
      $sdata['message']     = stripEmails($message);
      $sdata['subject']     = stripEmails($message);
      $sdata['sendtime']    = time();
      $sdata['folder']      = 'inbox';
      $sdata['notifysender'] = $param['notify'];

      $mail->addRec($sdata);

      // Save a copy in the senders mail box
      //
      if ( ! $mail->isError() ) {

          $sdata['owner']       = $param['snduserid'];
          $sdata['senderid']    = $param['rcvuserid'];
          $sdata['folder']      = 'sent';
          unset($sdata['notifysender']);
          $mail->addRec($sdata);
     }
     if ( ! $mail->isError()
        && $this->modGetSetting('letter_messagereceived') == 'Y' ) {


          $cparam = array(
          'rcvuserid' => $param['rcvuserid'],
          'subject'   => $this->modGetSetting('site_name').' - Intimation mail',
          'message'   => get_lang('message_received', MAIL_FORMAT),
          );

          $this->modSendMail( $cparam );
     }


    }
    return $this->_setStatus($mail);

  }

  /**
   * returns the site home url
   *
   * @return  string the site home url
   *
   * @access public
   */
  function modSiteUrl()  // Additional
  {

    $port = '';
    if ( $_SERVER['SERVER_PORT'] != '80' ) {

        $port = ':' . $_SERVER['SERVER_PORT'];
    }


    return str_replace('forum/','',HTTP_METHOD . $_SERVER['SERVER_NAME'] . $port . $this->modGetDocRoot());
  }
  /**
   * returns the web directory osdate resides in.
   *
   * @return  directory osdate resides in. (ex. /osdate/)
   *
   * @access public
   */
  function modGetDocRoot()  // Additional
  {

    return DOC_ROOT;
  }
  /**
   * returns the web directory images reside in.
   *
   * @return  directory osdate resides in. (ex. /osdate/)
   *
   * @access public
   */
  function modGetDocImages()  // Additional
  {

    return $this->modGetDocRoot() . 'plugins/' . $this->getPluginName() . '/images/';
  }
  /**
   * returns the web directory includes reside in.
   *
   * @return  directory osdate resides in. (ex. /osdate/)
   *
   * @access public
   */
  function modGetDocIncludes()  // Additional
  {

    return $this->modGetDocRoot() . 'plugins/' . $this->getPluginName() . '/includes/';
  }
  /**
   * send an email
   * @param array $param an associative array with the following keys: <br><ul>
   *        <li>message - can be a templated message using user parameters in #  (i.e. #firstname#, #country#))</li>
   *        <li>rcvuserid - userid of member to receive message.</li>
   *        <li>snduserid - userid of member to seend message (optional).</li>
   *        <li>subject - message subject.</li></ul>
   *
   * @return  bool True on success.  False on failure.
   * @access public
   */
  function modSendMail( $param )
  {

      $result = false;

      if ( isset($param['rcvuserid']) &&  isset($param['subject']) && isset($param['message']) ) {


          $udata = $this->modGetUser( array('userid' => $param['rcvuserid']) );

          if ( ! $udata ) {

              $this->_setErrorMessage("Can't find reciever account for rcvuserid: " . $param['rcvuserid']);
              $result = false;
          }

          If (  isset($param['snduserid']) && ! $this->getErrorMessage() ) {

            $sdata = $this->modGetUser( array('userid' => $param['snduserid']) );

            if ( ! $sdata ) {

                $this->_setErrorMessage("Can't find sender account for snduserid: " . $param['snduserid']);
                $result = false;
            }
            else {

               $udata['sendername'] = $sdata['username'];
            }
          }

          If ( ! $this->getErrorMessage() ) {

              $Subject             = $param['subject'];
              $From                = $this->modGetSetting(array('setting'=>'admin_email'));
              $To                  = $udata['email'];
              $udata['link']       = $this->modSiteUrl();
              $udata['sitename']   = $this->modGetSetting('site_name');
              $udata['adminname']  = $this->modGetSetting('admin_name');

              $message = $param['message'];

              $message = $this->_fillTemplate($message, $udata);

           $result =  mailSender($From, $To, $To, $Subject, $message);
        }
     }
     else {

        $result = false;
        $this->_setErrorMessage("rcvuserid, snduserid, subject and message are required");
     }
     return $result;

  }

  /**
   * Returns all error messages
   *
   * @return array - associative array of messages
   * @access public
   */
  function getErrorMessage() {

    return $this->_errorMessage;
  }
  /**
   * Clears all error messages
   *
   * @return void
   * @access public
   */
  function clrErrorMessage() {

     $this->_errorMessage = array();
  }
  /**
  * Returns the current template skin name
   *
   * @return string
   * @access public
   */
  function modGetSkinName() { // Additional

      return $GLOBALS['config']['skin_name'];
  }
   /**
   * Returns the language phrase or the entire language array from class's language definitions.
   *
   * @param string|void $key1 If blank, returns the whole array.  If a string, returns that phrase
   * @param string|void $key2 If a string, returns the second dimension of phrase
   * @return array|string
   * @access public
   */
   function modGetLang($key1 = false, $key2 = false) { // Additional

      if ( ! $key1 ) {

         $lang = $this->lang;
      }
      elseif ( $key2 ) {


         $lang = isset($this->lang[$key1][$key2])?$this->lang[$key1][$key2]:'';
		 if ($lang == '') {
			 $lang = get_lang($key1,$key2);
		 }
//		$lang = get_lang($key1, $key2);
      }
      else {

         $lang = isset($this->lang[$key1])?$this->lang[$key1]:'';
		 if ($lang == '') {
			 $lang = get_lang($key1);
		 }
//		$lang = get_lang($key1);
      }
      return $lang;
   }

   /**
   * Returns the name of the plugin.
   *
   * @return string
   * @access public
   */
  function getPluginName() {

      return $this->plugin_class_name;
  }
   /**
   * Returns the main directory for this plugin
   *
   * @return string
   * @access public
   */
  function getPluginDir() {

      return PLUGIN_DIR . $this->getPluginName() . '/';
  }
   /**
   * Returns the includes directory for this plugin
   *
   * @return string
   * @access public
   */
  function getIncludeDir() {

      return $this->getPluginDir() . 'includes/';
  }
   /**
   * Returns the images directory for this plugin
   *
   * @return string
   * @access public
   */
  function getImagesDir() {

      return $this->getPluginDir() . 'images/';
  }
   /**
   * Returns the language directory for this plugin
   *
   * @return string
   * @access public
   */
  function getLanguageDir() {

      $language = $this->modGetLoadedLanguage();

      return $this->getPluginDir() . 'language/lang_' . $language . '/';
  }
   /**
   * Returns the libs directory for this plugin
   *
   * @return string
   * @access public
   */
  function getLibsDir() {

      return $this->getPluginDir() . 'libs/';
  }
   /**
   * Returns the user menu entry for a plugin.
   *
   * @return array
   * @access public
   */
  function getUserMenuEntry() {

      $menu = array();

      if ( $this->user_menu_appear ) {

          $menu = array(
                        'text'   => $this->user_menu_text,
                        'href' => $this->modSiteUrl().'plugin.php?plugin=' . $this->getPluginName(), // The name of this class
          );
      }
      return $menu;
  }
    /**
   * Returns the admin menu entry for a plugin.
   *
   * @return array
   * @access public
   */
  function getAdminMenuEntry() {

      $menu = array();

      if ( $this->admin_menu_appear ) {
	  $menu = array(
                        'text'   => $this->admin_menu_text,
                        'href' => $this->modSiteUrl().str_replace('/','',ADMIN_DIR).'/plugin.php?plugin=' . $this->getPluginName(), // The name of this class
          );
      }
      return $menu;
  }
    /**
   * Returns the content that will appear in the left column of a page. Override this method in yor class if you have content that needs displayed in the left column.
   *
   * @return string - html that will be displayed
   * @access public
   */
  function displayLeftCol() {


  }
    /**
   * Returns the content that will appear in the main content area of the page.  This content will appear after the existing main content.  Override this method in yor class if you have content that needs displayed in after the existing main content.
   *
   * @return string - html that will be displayed
   * @access public
   */
  function displayMain() {


  }
  /**
   * Returns the content to display a custom user page.  Override this method in your class if you need a new page for your plugin.
   *
   * @return string - html that will be displayed
   * @access public
   */
   function  displayPluginPage() {

      //$this->modSmartyAssign('lang', $this->modGetLang() );

      // This is what makes the template display on the page
      //
      //return $this->modSmartyFetch('helloworld.tpl');

   }
  /**
   * Returns the content to display a custom admin page.  Override this method in your class if you need a new page for your plugin.
   *
   * @return string - html that will be displayed
   * @access public
   */
   function  displayPluginAdminPage() {

//       $this->modSmartyAssign('lang', $this->modGetLang() );
//
//       // This is what makes the template display on the page
//       //
//       return $this->modSmartyFetch('admin/helloworld.tpl');

   }
   /**
   * WARNING: USER IS NOT VALIDATED HERE.  BE CAREFUL<br>
   * Returns all the html for a page.  Override this method in your class if you need a page with only your content.  Often used in downloads
   *
   * @return string - html that will be displayed
   * @access public
   */
   function  displayPluginContent() {


      return "hello world";
   }
   /**
   * Returns the sql directory for this plugin
   *
   * @return string
   * @access public
   */
  function getSqlDir() {

      return $this->getPluginDir() . 'sql/';
  }
   /**
   * Returns the sql directory for this plugin
   *
   * @return string
   * @access public
   */
  function getTemplatesDir() {

      $skin_name = $this->modGetSkinName();
	  if ($skin_name == '') $skin_name='default';

      $templates_base = $this->getPluginDir() . 'templates/';
      if ( ! file_exists($templates_base . $skin_name) ) {

         $skin_name = 'default';
      }
      return $templates_base  . $skin_name . '/';
  }
   /**
   * Returns a parsed Smarty template from this plugins template directory
   *
   * @param string $filename the relative filename of the template file.
   * @return string
   * @access public
   */
  function modSmartyFetch($filename) {  // Additional

	  $tplDir = $this->getTemplatesDir();

      $filename = $tplDir . $filename;

      return $GLOBALS['t']->fetch($filename);

  }
   /**
   * Assigns a varible for use in smarty templates
   *
   * @param string $filename the relative filename of the template file.
   * @return string
   * @access public
   */
  function modSmartyAssign($variable, $value) {  // Additional

     $GLOBALS['t']->assign($variable, $value);
  }
   /**
   * Adds the Javascript tags to the header of the document
   *
   * @param string $filename the relative filename of the template file.
   * @return string
   * @access public
   */
  function modSmartyJS($value) {  // Additional

     $js = $GLOBALS['t']->get_template_vars('addtional_javascript');
     $js .= $value;
     $GLOBALS['t']->assign('addtional_javascript', $js);
  }
   /**
   * Adds the CSS tags to the header of the document
   *
   * @param string $filename the relative filename of the template file.
   * @return string
   * @access public
   */
  function modSmartyCSS($value) {  // Additional

     $css = $GLOBALS['t']->get_template_vars('addtional_css');
     $css .= $value;
     $GLOBALS['t']->assign('addtional_css', $css);
  }
   /**
   * Gets a record from the provided table using the search.  The table
   * must belong to the plugin or this will return false.
   *
   * @param string $table the name of the table to retrieve
   * @param array  $search keys are field names and the value is the value to match (ex.  to find id of 5 use $search['id'] = 5)
   *
   * @return array
   * @access public
   */
  function modGetRow($table, $search) {

      include_once(MODOSDATE_DIR . 'plugin_tables_data.php');

      $tables = new pluginTablesData();

      $result = false;
      $tsearch['name'] = DB_PREFIX . '_' . $table;

      $found = $tables->getRec($tsearch);

      if ($found ) {

        $sql = "SELECT * FROM ! WHERE " . $this->_where($search);
        $result = $GLOBALS['osDB']->getRow($sql, array($tsearch['name']));
      }
      return $result;
  }
   /**
   * Deletes record(s) from the provided table using the search.  The table
   * must belong to the plugin or this will return false.
   *
   * @param string $table the name of the table
   * @param array  $search keys are field names and the value is the value to match (ex.  to find id of 5 use $search['id'] = 5)
   *
   * @return array
   * @access public
   */
  function modDeleteRows($table, $search) {

      include_once(MODOSDATE_DIR . 'plugin_tables_data.php');

      $tables = new pluginTablesData();

      $result = false;
      $tsearch['name'] = DB_PREFIX . '_' . $table;

      $found = $tables->getRec($tsearch);

      if ($found ) {

        $sql = "DELETE FROM ! WHERE " . $this->_where($search);
        $GLOBALS['osDB']->query($sql, array($tsearch['name']));
        $result = true;
      }
      return $result;
  }
   /**
   * Gets all records from the provided table using the search.  The table
   * must belong to the plugin or this will return false.
   *
   * @param string $table the name of the table to retrieve
   * @param array  $search keys are field names and the value is the value to match (ex.  to find id of 5 use $search['id'] = 5)
   * @param sting  $order is the field by which the data in sorter
   * @param int    $ordtype use 1 for sorting ascendent, and 2 for sorting descendent
   *
   * @return array - multidimensional array.  The first level the index.  Second level a associtive array of the records fields and values.<br>
   *
   * @access public
   */
  function modGetAll($table, $search,$order = "",$ordtype = 1,$limitstart = -1,$limitlength = -1) {

      include_once(MODOSDATE_DIR . 'plugin_tables_data.php');

      $tables = new pluginTablesData();

      $result = false;
      $tsearch['name'] = DB_PREFIX . '_' . $table;

      $found = $tables->getRec($tsearch);

      if ($found ) {
        $sql = "SELECT * FROM ! ";

        if($search) $sql.="WHERE " . $this->_where($search);

		if ($tsearch['name'] == DB_PREFIX."_banners" ) {
			if($search)	{
				$sql .= 'AND language is not null ';
			} else {
				$sql .= 'WHERE language is not null ';
			}
		}

		if($order) {
			$sql.="ORDER BY $order ";
			if($ordtype==1) $sql.="ASC";
			else $sql.="DESC";
		}

		if($limitstart!=-1) $sql.=" LIMIT $limitstart,$limitlength";
        $result = $GLOBALS['osDB']->getAll($sql, array($tsearch['name']));
      }
      return $result;
  }
   /**
   * Edits a record from the provided table with the provided data.  The table
   * must belong to the plugin or this will return false.
   *
   * @param string $table the name of the table to retrieve
   * @param array  $data keys are field names and the value is the value to update (ex.  to update field first_name with 'bob' of 5 use $data['first_name'] = 'bob').
   * @param array  $keys  the record to update.  (ex.  to update id 5, include $key['id'] = 5).
   * @return array
   * @access public
   */
  function modEditRec($table, $data, $keys) {

      include_once(MODOSDATE_DIR . 'plugin_tables_data.php');

      $tables = new pluginTablesData();

      $result = false;
      $search['name'] = DB_PREFIX . '_' . $table;

      $found = $tables->getRec($search);

      if ($found ) {

        $GLOBALS['osDB']->autoExecute($search['name'], $data, 'UPDATE', $this->_where($keys));
        $result = true;
      }
      return $result;
  }
   /**
   * Adds a record from the provided table with the provided data.  The table
   * must belong to the plugin or this will return false.
   *
   * @param string $table the name of the table to retrieve
   * @param array  $data keys are field names and the value is the value to match (ex.  to add field first_name with 'bob' of 5 use $data['first_name'] = 'bob').
   * @return array
   * @access public
   */
  function modAddRec($table, $data) {

      include_once(MODOSDATE_DIR . 'plugin_tables_data.php');

      $tables = new pluginTablesData();

      $result = false;
      $search['name'] = DB_PREFIX . '_' . $table;

      $found = $tables->getRec($search);

      if ($found ) {

        $rt = $GLOBALS['osDB']->autoExecute($search['name'], $data, 'INSERT');

        $result = $GLOBALS['osDB']->getOne("SELECT LAST_INSERT_ID()" );
      }
      return $result;
  }
  //
  // Private Methods
  //
 /**
   * Given an array returns a where statement
   *
   * @return bool
   * @access private
   */
  function _where($keys) {

        $w = array();
        $where = ' 1 ';
        while (list($idn, $idv) = each($keys)) {
            $idv = mysql_real_escape_string($idv);
            $w[] = "$idn = '$idv' ";
        }
        if ( $w ) {

            $where = join(' AND ',$w);
        }
        return $where;
  }
 /**
   * Determines if a object had and error
   *
   * @return bool
   * @access private
   */
   function _setStatus($obj) {

      $result = true;
      if ( $obj->isError() ) {

         $this->_setErrorMessage($obj->message);
         $result = false;
      }
      return $result;
   }
   //
 /**
   * Sets the error message
   *
   * @access private
   */
   function _setErrorMessage($message) {

      if ( is_array($message) ) {

         $this->_errorMessage = array_merge($this->_errorMessage, $message);
      }
      else {

         $this->_errorMessage[$message] = $message;
      }
   }
   //
   //
 /**
   * Given a template and data, replace the template vaulues with the data.
   *  Template values in the format of #firstname# #lastname#.
   *
   * @return string
   * @access private
   */
   function _fillTemplate($template, $data) {

      // lowercase tags
      $template = preg_replace('/#([^#]+)#/e', "'#'.strtolower('\\1').'#'", $template);

      foreach (  $data AS $key => $value ) {

        $template = str_replace('#'.$key.'#', $value, $template);
      }

      return $template;
   }
   //
   //

  /**
   * get a config key for a pluginn
   * @param array $param an associative array with any of the following keys:<br><ul>
   *         <li>id - id of plugin</li>
   *         <li>pluginid - id of plugin</li>
   *         <li>name - name of config key</li>
   *         <li>value - value of config key</li></ul>
   * @return array  id, pluginid, name, value
   * @access private
   */
  function _getPluginConfig($param )
  {
      include_once(MODOSDATE_DIR . 'plugin_config_data.php');

      $config = new pluginConfigData();

      return $config->getRec($param);

  }

 /**
   * Initializes the configuration variables
   *
   * @return string
   * @access private
   */
   function _initConfig() {

      include($this->getIncludeDir() . 'default_config.php');

      $search['name'] = $this->getPluginName();
      $pdata = $this->modGetPlugin($search );

      $pluginid = isset($pdata['id'])?$pdata['id']:'';

      if ( isset($config) && is_array($config) ) {

          foreach ( $config AS $name => $value ) {

              $csearch['name'] = $name;
              $csearch['pluginid'] = $pluginid;
              $row = $this->_getPluginConfig($csearch);

              // If in database use that value, otherwise use the default
              if ( $row ) {

                $this->config[$name]  = $row['value'];
              }
              else {

                $this->config[$name]  = $value;
              }
          }
       }
   }

   /**
   * Get Last Search db result
   * It eliminates all banned users by $uid
   *
   * @return array
   * @access private
   */

	function modGetLastSearch($uid)
	{
		if(isset($_SESSION['advsearch']['sql']) && $_SESSION['advsearch']['sql'] != '' )
			$data=$GLOBALS['osDB']->getAll($_SESSION['advsearch']['sql'],array(MEMBERSHIP_TABLE, USER_TABLE, ONLINE_USERS_TABLE,$uid));
		else return 0;
		$i=0;
		$udata=$this->modGetUser(array('userid'=>$uid));

		if($data)
			foreach ($data as $item)
			{
				$valid=$GLOBALS['osDB']->getOne("SELECT id FROM ! WHERE ref_userid=? AND userid=? AND act=?",array(BUDDY_BAN_TABLE,$item['id'],$uid,'B'));
				if(!$valid) $data2[$i++]=$item;

			}
		return $data2;
	}

   /**
   * Gets one field from the provided table using the search.  The table
   * must belong to the plugin or this will return false.
   *
   * @param string $table the name of the table to retrieve
   * @param array  $search keys are field names and the value is the value to match (ex.  to find id of 5 use $search['id'] = 5)
   *
   * @return array - multidimensional array.  The first level the index.  Second level a associtive array of the records fields and values.<br>
   *
   * @access public
   */
  function modGetOne($table, $search , $field) {

      include_once(MODOSDATE_DIR . 'plugin_tables_data.php');

      $tables = new pluginTablesData();

      $result = false;
      $tsearch['name'] = DB_PREFIX . '_' . $table;

      $found = $tables->getRec($tsearch);

      if ($found ) {

        $sql = "SELECT $field FROM ! ";
        if($search) $sql.= "WHERE " . $this->_where($search);

		if ($tsearch['name'] == DB_PREFIX."_banners") {
			$sql .= 'AND language is not null ';
		}

        $result = $GLOBALS['osDB']->getOne($sql, array($tsearch['name']));
      }
      return $result;
  }

   function modGetMyMatches ($uid)
  {

		$user = $GLOBALS['osDB']->getRow( 'SELECT * FROM ! WHERE id = ?',array( USER_TABLE,  $uid) );
		$radius = $user['lookradius'];

		$radiustype = $user['radiustype'];

		$zipcodes_in = "";

		/* Check for zip code proximity search */
		if ($user['lookzip'] != '' && isset($radius) && $radius > 0) {

			$ziprow = $GLOBALS['osDB']->getRow('select * from ! where code=?  and countrycode=?',array(ZIPCODES_TABLE, $user['lookzip'], $user['lookcountry'] ) );

			$lat = $ziprow['latitude'];
			$lng = $ziprow['longitude'];

			if ($lng!='' && $lat!='') {

				if ($radiustype == 'kms') {
					/* Kilometers calculation */
					$sql = "select DISTINCT code, sqrt(power(69.1*(latitude - $lat),2) +  power( 69.1 * (longitude-$lng) * cos(latitude/57.3),2)) as dist from ! where countrycode=? and sqrt(power(69.1*(latitude - $lat),2)+power(69.1*(longitude-$lng)*cos(latitude/57.3),2)) <= " . $radius ;
				} else {
					/* Miles  */
					$sql = "select DISTINCT code, (3958* 3.1415926 * sqrt((latitude - $lat) * (latitude- $lat) + cos(latitude / 57.29578) * cos($lat/57.29578)*(longitude - $lng) * (longitude - $lng))/180) as dist from ! where countrycode=? and (3958* 3.1415926 * sqrt((latitude - $lat) * (latitude- $lat) + cos(latitude / 57.29578) * cos($lat/57.29578)*(longitude - $lng) * (longitude - $lng))/180) <= " . $radius ;
				}

				$zipcodes = $GLOBALS['osDB']->getAll($sql, array(ZIPCODES_TABLE, $user['lookcountry'] ) );

				foreach ($zipcodes as $val) {
					if ($zipcodes_in != '') $zipcodes_in.=", ";
					$zipcodes_in.= "'".$val['code']."'";
				}

				if ($zipcodes_in != '') {
					$zipcodes_in = " and user.zip in (".$zipcodes_in.") ";
				} else {
					$zipcodes_in = " and user.zip is null ";
				}
			}
		}

		$bannedlist = '';
		$bannedusers = $GLOBALS['osDB']->getAll('select bdy.ref_userid from ! as bdy where bdy.act=? and bdy.userid = ? union select bdy1.userid as ref_userid from ! as bdy1 where bdy1.act=? and bdy1.ref_userid = ?', array(BUDDY_BAN_TABLE,  'B', $_SESSION['UserId'], BUDDY_BAN_TABLE,  'B', $_SESSION['UserId'] ) );
		if (count($bannedusers) > 0) {
			$bannedlist=' and user.id not in (';
			$bdylst = '';
			foreach ($bannedusers as $busr) {
				if ($bdylst != '') $bdylst .= ',';
				$bdylst .= "'".$busr['ref_userid']."'";
			}
			$bannedlist .=$bdylst.') ';
		}


		$sqlSelect = 'SELECT user.*, floor((to_days(curdate())-to_days(birth_date))/365.25)  as age';

		$sqlFrom = ' FROM ! user, ! mem ';

		$sqlWhere = ' WHERE user.id > 0  AND mem.roleid=user.level and mem.includeinsearch=1 ';

		$sqlWhere .= $bannedlist;

		$txtgender_search = " AND user.lookgender in  ( 'A', ";

		if ($user['gender'] == 'M' or $user['gender'] == 'F') {
			$txtgender_search .= "'B',";
		}

		$txtgender_search .= "'".$user['gender']."' )";


		$txtlookgender_search = '';

		if ($user['lookgender'] == 'B') {
			$txtlookender_search = " AND user.gender in ('M','F') ";
		} elseif ($user['lookgender'] != 'A') {
			$txtlookgender_search = " AND user.gender = '".$user['lookgender']."' ";
		}

		$sqlWhere .= ' AND status in (\'Active\',\' '.$this->modGetLang('status_enum','active')."') " . $txtlookgender_search . $txtgender_search;

		if( $user['lookcountry'] ){

			if( $user['lookcountry'] == 'AA' ) {

				$sqlWhere .= ' AND country LIKE \'%\' ';

			}else{

			$sqlWhere .= ' AND country = \'' . $user['lookcountry'] ."' ";
			}
		}

		if( $user['lookstate_province'] ){

			if( $user['lookstate_province'] == 'AA' ) {

				$sqlWhere .= ' AND state_province LIKE \'%\' ';

			}else{

			$sqlWhere .= ' AND state_province = \'' . $user['lookstate_province'] ."' ";
			}
		}

		if( $user['lookcounty'] ){

			if( $user['lookcounty'] == 'AA' ) {

				$sqlWhere .= ' AND county LIKE \'%\' ';

			}else{

			$sqlWhere .= ' AND county = \'' . $user['lookcounty'] ."' ";
			}
		}

		if( $user['lookcity'] ){

			if( $user['lookcity'] == 'AA' ) {

				$sqlWhere .= ' AND city LIKE \'%\' ';

			}else{

			$sqlWhere .= ' AND city = \'' . $user['lookcity'] ."' ";
			}
		}

		if( $user['lookzip'] ) {
			if (!isset($radius) ){

				if( $user['lookzip'] == 'AA' ) {

					$sqlWhere .= ' AND zip LIKE \'%\' ';

				}else{

					$sqlWhere .= ' AND zip = \'' . $user['lookzip'] ."' ";
				}
			} else {

				$sqlWhere .= $zipcodes_in;
			}
		}


		$sqlWhere .= ' AND floor(period_diff(extract(year_month from NOW()),extract(year_month from birth_date))/12) BETWEEN '
			. $user['lookagestart'] . ' AND ' . $user['lookageend'] ;

		$sql = $sqlSelect . $sqlFrom . $sqlWhere;

		$rs = $GLOBALS['osDB']->getAll( $sql, array( USER_TABLE, MEMBERSHIP_TABLE ) );

		return $rs;

  }

  function modGetSavedSearchs($uid,$id=0)
  {
  	if(!$id)
  		return $GLOBALS['osDB']->getAll("SELECT * FROM ! WHERE userid=?",array(USER_SEARCH_TABLE,$uid));
  	$data=$GLOBALS['osDB']->getOne("SELECT query FROM ! WHERE id=?",array(USER_SEARCH_TABLE,$id));
  	$data=unserialize($data);
  	$sql=$data['sql'];
  	return $GLOBALS['osDB']->getAll($sql,array(MEMBERSHIP_TABLE, USER_TABLE, ONLINE_USERS_TABLE,$uid));
  }

  function modGetSavedMailTemplates($uid,$id = 0)
  {
  	if($uid)
  		return $GLOBALS['osDB']->getAll("SELECT * FROM ! WHERE userid=?",array(USERTEMPLATE_TABLE,$uid));
  	return $GLOBALS['osDB']->getRow("SELECT * FROM ! WHERE id=?",array(USERTEMPLATE_TABLE,$id));
  }

  function modGetConfig()
  {
  	$configs = $GLOBALS['osDB']->getAll( 'SELECT * from !',array( CONFIG_TABLE ) );

	$config = array();
	foreach( $configs as $index => $row )
		$config[ $row['config_variable'] ] = $row['config_value'];

	return $config;
  }
    /**
   * gets a list of all ratings of user X
   *
   * @param array $param an associative array with the following keys:<br><ul>
   *         <li>userid - id of user</li>
   * 		 <li>ratingid - id of rating</li>
   * 		     </ul>
   * @return array
   * @access public
   */
  function modGetAllRatings( $param)
  {
         include_once(MODOSDATE_DIR . 'userrating_data.php');

         $rate = new userRatingData();
         $search['profileid'] = $param['userid'];
         $search['ratingid'] = $param['ratingid'];

      return   $rate->getAllRec($search);

  }

  function modGetAllRatingSystems()
  {
  	return $this->getAll("SELECT * FROM ".RATINGS_TABLE);
  }

    /**
   * Returns a random users/designed for hot or not plugin
   *
   * @param $userid - does not select this id; $userid is the user for who you get the profile
   * @param $gender - 1 - to select all; 2 - to select men; 3 - to select women;
   * @param $agemin - selects only people over this age
   * @param $agemax - selects only people below this age
   * @return array
   * @access public
   */
  function modGetRandomUser($userid,$gender = 1,$agemin = 0,$agemax = 0,$ratingid)
  {
      $sql="SELECT id FROM !";
      $where="";
      if($userid) {if($where) $where.=" AND "; $where.="id<>'$userid' and id <> '".$_SESSION['UserId']."' ";}
      $udata=$this->modGetUser(array('userid'=>$userid));
      $username=$udata['username'];

      if($gender==2) {if($where) $where.=" AND "; $where.="gender='F'";}
      if($gender==3) {if($where) $where.=" AND "; $where.="gender='M'";}
      if($agemax || $agemin)
      {
      	if($where) $where.=" AND ";
      	if($agemax==0) $agemax=200;
      	$where.="( floor(period_diff(extract(year_month from NOW()),extract(year_month from birth_date))/12) between '$agemin' and '$agemax' )";
      }
	 $where=" WHERE $where and active = 1";
	 $sql=$sql.$where;

      $data=$GLOBALS['osDB']->getAll($sql,array(USER_TABLE));
	  shuffle($data);

	 $showrate=isset($_SESSION['advhotornot_showrate'])?$_SESSION['advhotornot_showrate']:1;
	 if($showrate==1) {$showmin=0; $showmax=11;}
	 if($showrate==2) {$showmin=1; $showmax=5;}
	 if($showrate==3) {$showmin=5; $showmax=8;}
	 if($showrate==4) {$showmin=8; $showmax=10;}

      foreach ($data as $item)
      {
      	$ar=$GLOBALS['osDB']->getOne("SELECT id FROM ! WHERE userid=? AND profileid=? AND ratingid=?",array(USER_RATING_TABLE,$userid,$item['id'],$ratingid));

      	if(!$ar && $this->modIsPluginInstalled('advhotornot') )
      	{

      		$ok=1;
			if(isset($_GET['best']) && isset($this->lang_advhotornot2_table)) $ok=$GLOBALS['osDB']->getOne("SELECT bestof FROM ! WHERE uid=?",array(DB_PREFIX."_".$this->lang_advhotornot2_table,$item['id']));

			if($ok)
			{
				if(isset($this->lang_advhotornot2_table)) $rating_rec=$GLOBALS['osDB']->getRow("SELECT * FROM ! WHERE uid=?",array(DB_PREFIX."_".$this->lang_advhotornot2_table,$item['id']));
				if (isset($rating_rec['rating']))	$rating=$rating_rec['rating'];
				if(!isset($rating)) $rating=0;
				if(($rating>=$showmin && $rating<$showmax && isset($this->lang_advhotornot2_table)) || (!isset($this->lang_advhotornot2_table)))
				{
					$pics=$GLOBALS['osDB']->getOne("SELECT count(*) FROM ! WHERE userid=? and (album_id is null or album_id = 0) ",array(USER_SNAP_TABLE,$item['id']));
					$ban=0;
					if($pics > 0){$userban=$GLOBALS['osDB']->getOne("SELECT userid FROM ! WHERE id=?",array(USER_TABLE,$item['id'])); $ban=$GLOBALS['osDB']->getOne("SELECT count(*) FROM ! WHERE userid=? AND ref_userid=? AND act=?",array(BUDDY_BAN_TABLE,$userid,$userban,"B"));}
					if($ban ==0 && $pics > 0) {return $item['id'];}

				}
			}
      	}
      }
      return 0;
  }

  function modGetAllCities($countrycode, $cnt = -1)
  {
	if ($cnt > 0) {
		return $GLOBALS['osDB']->getAll("SELECT * FROM ! WHERE countrycode=? order by RAND() limit ?",array(CITIES_TABLE,$countrycode, $cnt));
	} else {
		return $GLOBALS['osDB']->getAll("SELECT * FROM ! WHERE countrycode=? order by RAND()",array(CITIES_TABLE,$countrycode));
	}
  }

  function modGetAllCountries()
  {
	return $GLOBALS['osDB']->getAll("SELECT * FROM ! ORDER BY name ASC",array(COUNTRIES_TABLE));
  }

  // add user using params;
  // use $param['image'] to add picture to profile;
  // use $param['ethnicity'] to add ethnicity code
  // designed for autogenprofile plugin
  function modAddUser($param)
  {
  	$firstname=$param['firstname'];
  	$lastname=$param['lastname'];
  	$gender=$param['gender'];
// add lookgender
	$lookgender = 'A';
	$lookgender = ($gender == 'F')?'M':'F';
  	$username=$param['username'];
  	$countrycode=$param['countrycode'];
  	$birth_day=$param['birth_day'];
  	$ethnicity=$param['ethnicity'];
	if (isset($param['image']) ) {
		$image=$param['image'];
		$image_ext=$param['image_ext'];
		$imagetn=$param['imagetn'];
		$imagetn_ext=$param['imagetn_ext'];
	}
  	$city=isset($param['city'])?$param['city']:'';
  	$pwd = DB_PREFIX;
  	$email=$username."@".str_replace('www.','',$_SERVER['SERVER_NAME']);

  	$GLOBALS['osDB']->query("INSERT INTO !(firstname,lastname,gender,username,country,birth_date,regdate,active,rank,city,status,level,levelend,lastvisit,email, password, lookgender) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)",array(USER_TABLE,$firstname,$lastname,$gender,$username,$countrycode,$birth_day,time(),1,1,$city,'active',1,time()+60*60*24*365*10,time()-60*60*24*mt_rand(1,90)+mt_rand(1,3600*24),$email, md5($pwd), $lookgender));

  	$uid=$GLOBALS['osDB']->getOne("SELECT id FROM ! WHERE username=?",array(USER_TABLE,$username));
  	$GLOBALS['osDB']->query("INSERT INTO !(userid,questionid,answer) VALUES(?,?,?)",array(USER_PREFERENCE_TABLE,$uid,'2',$ethnicity));
  	if(isset($image)) {
		if ($GLOBALS['config']['images_in_db'] == 'N') {

			$file = 'pic_1.'.$image_ext;
			$imgfile = $this->modWriteImageToFile($image, $uid, '11', $file);

			$image = 'file:'.$imgfile;

			$file = 'tn_1.'.$image_ext;
			$tnimgfile = $this->modWriteImageToFile($imagetn, $uid, '21', $file);

			$imagetn = 'file:'.$tnimgfile;
		} else {
			$image = base64_encode($image);
			$imagetn = base64_encode($imagetn);
		}

	  	$GLOBALS['osDB']->query("INSERT INTO !(userid,picno,picture,tnpicture,active,picext,tnext,ins_time, album_id) VALUES(?,?,?,?,?,?,?,?,?)",array(USER_SNAP_TABLE,$uid,1,$image,$imagetn,'Y',$image_ext,$imagetn_ext,time(),'0'));
	}
  }

   /**
   * Create and return the image and the thumbnail for database
   * @param string $path = path to file
   * @param string $ext = file extention
   *
   * @return $ret['pic'] and $ret['tn'] which are the base64_encoded of original picture and of thumbnail; the thumbnail has jpg extention;
   */


  function modCreateDbImage($path,$ext)
  {
	$ret = array();
  	$pic = file_get_contents($path);
	$ret['pic']=$pic;
	if($ext == 'bmp') $img=imagecreatefromwbmp($path);
	else if($ext == 'png') $img=imagecreatefrompng($path);
	else if($ext == 'gif') $img=imagecreatefromgif($path);
	else if($ext == 'jpg') $img=imagecreatefromjpeg($path);
	$tnsize = $GLOBALS['config']['upload_snap_tnsize'];
	$w = $nw =imagesx( $img );
	$h = $nh = imagesy( $img );
	if ($w > $tnsize || $h > $tnsize)
	if( $w > $h ) {
		$ratio = $w / $h;
		$nw = $tnsize;
		$nh = $nw / $ratio;
	} else {
		$ratio = $h / $w;
		$nh = $tnsize;
		$nw = $nh /$ratio;
	}
	$img2 = imagecreatetruecolor( $nw, $nh );
	imagecopyresampled ( $img2, $img, 0, 0, 0 , 0, $nw, $nh, $w, $h );
	$filetn=TEMP_DIR.md5($path).".jpg";
	imagejpeg( $img2, $filetn );
	imagedestroy($img2);
	imagedestroy($img);
	$tn = file_get_contents($filetn);
	$ret['tn'] = $tn;

	return $ret;
  }

	function modWriteImageToFile($img, $userid, $picno, $file="") {
	/* This routine will create an image file */
		if ($file == '') {
			$filename= time().$userid.$picno.'.jpg';
		} else {
			$filename = $file;
		}

		$img = imagecreatefromstring( $img );
		imagejpeg($img, USER_IMAGE_DIR.$userid.'/'.$filename);

		return ($filename);
	}
  /**
   * Removes a user from database
   *
   * @param int $uid = user id
   */
/* THis function is removed by Vijay Nair
  function modDeleteUser($uid)
{
  $GLOBALS['osDB']->query("DELETE FROM ! WHERE id=?",array(USER_TABLE,$uid));
  $GLOBALS['osDB']->query("DELETE FROM ! WHERE userid=?",array(USER_SNAP_TABLE,$uid));
}
*/
     function getAll($sql,$replace = array())
   {

   	if($replace)
   		$replace[0]=DB_PREFIX . "_" .$replace[0];
   	return $GLOBALS['osDB']->getAll($sql,$replace);
   }

   function getRow($sql, $replace = array())
   {
   	 if($replace)
   	 	$replace[0]=DB_PREFIX . "_" .$replace[0];
     return $GLOBALS['osDB']->getRow($sql,$replace);
   }

   function query($sql, $replace = array())
   {
   	 if($replace)
   	 	$replace[0]=DB_PREFIX . "_" .$replace[0];
 	 return $GLOBALS['osDB']->query($sql, $replace);
   }

   function getOne($sql, $replace = array())
   {
   	 if($replace)
   	 	$replace[0]=DB_PREFIX . "_" .$replace[0];
 	 return $GLOBALS['osDB']->getOne($sql, $replace);
   }

  /**
   * Load language definition for the plugin based on the language selected
   * by user. First load english and then load the specific language. THis way
   * default will be english.
   *
   * @param $pluginDir Plugin directory
   * @return array
   * @access public
   */
  function modLoadLang($pluginDir )
  {

	  include($pluginDir.'language/lang_english/lang_main.php');
	  if (is_file($pluginDir.'language/lang_'.$_SESSION['opt_lang'].'/lang_main.php')) {
		  include($pluginDir.'language/lang_'.$_SESSION['opt_lang'].'/lang_main.php');
	  }
      return $lang;

  }

  function modIsPluginInstalled($pname)
  {
	$installed = $GLOBALS['osDB']->getOne('select name from ! where name=? and active=?',array(PLUGIN_TABLE, $pname,'1') );
	if (isset($installed) && $installed == $pname) {
		return true;
	} else {
		return false;
	}
  }

}

?>
