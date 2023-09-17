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
**********************************************/


/**
 * class langBanners
 *
 *  A template to get you started building templates.  Rename all langBanners
 *  with the name of your plugin
 *
 *  Call with {osdplugin name="langBanners" method="getSomething"} in a template
 *
 */
include_once(MODOSDATE_DIR . 'modPlugin.php');

class langBanners extends modPlugin {

   /**
   * The html to be displayed
   *
   * @access private
   */
   var $html;

   /**
   * Holds the language phrases
   *
   * @access private
   */
   var $lang;

   /**
   * Holds the configuration settings
   *
   * @access public
   */
   var $config;


   /**
   * The name name of the plugin class.
   *
   * @access private
   */
   var $plugin_class_name = "langBanners";

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
   var $user_menu_text = "";

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
   * Table that holds the banners
   *
   * @access private
   */
   var $lang_banners_table = 'banners';

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
  function langBanners( )
  {

    $this->modPlugin();
	$pluginDir = dirname(__FILE__).'/../';
	$this->lang = $this->modLoadLang($pluginDir);
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

        $id = $_GET['id'];

        // Get the clicks
        //
        $search['id'] = $id;
        $row = $this->modGetRow($this->lang_banners_table, $search);

        $clicks = $row['clicks'] + 1;
        $linkurl = $row['linkurl'];

        // Update the clicks
        //
        $data['clicks'] = $clicks;
        $key['id'] = $id;
        $this->modEditRec($this->lang_banners_table, $data, $key);

        // Go to the site
        //
        header( 'location: ' . $linkurl );
   }
  /**
   * Does the processing to display a admin page.  Called from plugin.php
   *
   * @return array
   * @access public
   */
   function  displayPluginAdminPage() {

      $this->modSmartyAssign('lang', $this->modGetLang() );
      $this->html = '';

      if ( isset($_REQUEST['action']) && $_REQUEST['action'] == 'addbanner') {
        $this->displayAddBanner();
      }
      elseif ( isset($_REQUEST['action']) && $_REQUEST['action'] == 'savebanner') {
        $this->saveBanner();
      }
      elseif ( isset($_REQUEST['action']) && $_REQUEST['action'] == 'managebanner') {
        $this->manageBanner();
      }
      elseif ( isset($_REQUEST['action']) && $_REQUEST['action'] == 'modifybanner') {
        $this->modifyBanner();
      }
      else {

        $this->displayManageBanner();
      }
      return $this->html;
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


      $banner = array();
      $html = '';
      $time = time();

      $index = 0;

      $search['enabled'] = 'Y';
      $search['language'] = $this->modGetLoadedLanguage();

      $temp = $this->modGetAll($this->lang_banners_table, $search);

      if (  $temp  ) {

              $j = 1;

              foreach( $temp as $index => $row ) {

                      if ( $row['startdate'] <= $time && $row['expdate'] >= $time) {

                          $banner[$j++] = $row[id];
                      }
              }

              $my_banner = $banner[ rand( 1, --$j ) ];

              $bsearch['id'] = $my_banner;
              $bdata = $this->modGetRow($this->lang_banners_table, $bsearch);

              $bdata['bannerurl'] = stripslashes( $bdata['bannerurl'] );

              $this->modSmartyAssign('data', $bdata );
              $this->modSmartyAssign('bannerdir', $this->modSiteUrl() . 'banners/' );

              $html .= $this->modSmartyFetch('banner.tpl');
      }
      return $html;
  }
   function modifyBanner() {


      $err = false;

        if( $_POST['txtlinkurl'] == '' ) {

              $err = $this->lang['link_blank'];

        }


        if ( ! $err ) {

            /// Start Date
            $sdd = $_POST['txtstartDay'];

            $smm = $_POST['txtstartMonth'];

            $syy = $_POST['txtstartYear'];

            $startdate = mktime(0,0,0,$smm,$sdd,$syy,0);

            /// Expity Date
            $edd = $_POST['txtendDay'];

            $emm = $_POST['txtendMonth'];

            $eyy = $_POST['txtendYear'];

            $expirydate = mktime(0,0,0,$emm,$edd,$eyy,0);

            $linkurl = $_POST['txtlinkurl'];

            $tooltip = addslashes( $_POST['txttooltip'] );

            $bannerlink = '';

            $imgsize = '';

            $fname = '';

            if ( $_FILES['txtbanner'] ) {

                    if( is_uploaded_file( $_FILES['txtbanner']['tmp_name'] ) ) {

                            $imgw = 0;

                            $imgh = 0;

                            $ext = explode( "/", $_FILES['txtbanner']['type'] );

                            $size = getimagesize(	$_FILES['txtbanner']['tmp_name'] );

                            if($ext[1] == 'pjpeg' || $ext[1]=='jpeg'){

                                    $imgw =  $size[0];

                                    $imgh =  $size[1];

                                    $ext[1] = 'jpg';

                                    $imgsize = $imgw . ' x '  . $imgh;

                            } elseif( $ext[1] == 'x-shockwave-flash' ){

                                    $ext[1] = 'swf';

                            } elseif( $ext[1] == 'gif' ){

                                    $imgw =  $size[0];

                                    $imgh =  $size[1];

                                    $ext[1] = 'gif';

                                    $imgsize = $imgw . ' x ' . $imgh;

                            }	else {

                                    $err = $this->lang['banner_wrong_type'];
                            }

                            if ( ! $err ) {
                                $fname = 'langBanner'.$_POST['txtid'] . '.' . $ext[1];

                                $real_path = BANNER_DIR;

                                if(	$HTTP_ENV_VARS["OS"] == 'Windows_NT'){

                                        $real_path= str_replace("\\","\\\\",$real_path);

                                        $file = $real_path."\\".$fname;

                                } else {
                                        $file = $real_path."/".$fname;
                                }

                                copy( $_FILES['txtbanner']['tmp_name'], $file);
                                }

                    }



                    if( $ext[1] =='jpg' || $ext[1]=='gif' ){

                            $bannerlink="<a href='pluginraw.php?plugin=langBanners&amp;action=banclick&amp;id=" . $_POST['txtid'] . "' target='_blank'><img src='" . DOC_ROOT. 'banners/' . $fname . "' border='0' width='$imgw' height='$imgh' alt='$tooltip'></a>";
                    } elseif( $ext[1] == 'swf' ){

                            $bannerlink="<object classid='clsid:D27CDB6E-AE6D-11cf-96B8-444553540000' codebase='http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0'>";
                            $bannerlink .= "<param name='movie' value='" . DOC_ROOT. 'banners/' . $fname . "'>";
                            $bannerlink .="<param name='quality' value='high'>";
                            $bannerlink .="<embed src='" . DOC_ROOT. 'banners/' . $fname . "' quality='high' pluginspage='http://www.macromedia.com/go/getflashplayer' type='application/x-shockwave-flash'></embed></object>";
                    }

            }

            if ( ! $err &&  $bannerlink != '' ) {
                    $bannerlink = addslashes( $bannerlink );

                    $data['linkurl']   = $linkurl;
                    $data['name']      = $fname;
                    $data['tooltip']   = $tooltip;
                    $data['size']      = $imgsize;
                    $data['startdate'] = $startdate;
                    $data['expdate']   = $expirydate;
                    $data['bannerurl'] = $bannerlink;
					$data['link_target'] = $_POST['link_target'];
                    $data['language'] = $_POST['language'];
                    $key['id'] = $_POST['txtid'];

                    $this->modEditRec($this->lang_banners_table,$data,$key);

            } elseif ( ! $err ) {

	     			$bsearch['id'] = $_POST['txtid'];
              		$bdata = $this->modGetRow($this->lang_banners_table, $bsearch);
					$bannerlink = addslashes(str_replace("target='". $bdata['link_target'] ."'", "target='".$_POST['link_target']. "'", stripslashes($bdata['bannerurl'])));
                    $data['linkurl']   = $linkurl;
                    $data['tooltip']   = $tooltip;
                    $data['startdate'] = $startdate;
                    $data['expdate']   = $expirydate;
                    $data['language'] = $_POST['language'];
					$data['link_target'] = $_POST['link_target'];
                    $data['bannerurl'] = $bannerlink;
                    $key['id'] = $_POST['txtid'];

                    $this->modEditRec($this->lang_banners_table,$data,$key);
              }

              if ( $err ) {

                  $this->modSmartyAssign('error', $err);
                  $this->displayEditBanner($row);

              }
              else {

                  $this->displayManageBanner();
              }
        }
        else {

            $this->displayManageBanner();
        }
   }
   function getLanguageOptions() {

      $langval = $this->modGetAllLanguages();
      $langopt = array();
      foreach ( $langval AS $val ) {

        $langopt[$val] = ucfirst($val);
      }
      return $langopt;
   }
   function displayEditBanner($row) {


              $this->modSmartyAssign('langopt', $this->getLanguageOptions() );
              $this->modSmartyAssign('data', $row );
              $this->modSmartyAssign('bannerdir', $this->modSiteUrl() . 'banners/' );

              $this->html = $this->modSmartyFetch('admin/banneredit.tpl');

   }
   function manageBanner() {

      //Delete Banner
      if ( $_POST['txtid'] ) {

              $search['id'] = $_POST['txtid'];
              $this->modDeleteRows($this->lang_banners_table, $search);

              $this->displayManageBanner();

      } elseif ( $_POST['enable'] ) {

              foreach( $_POST['txtcheck'] as $val ) {

                      $data['enabled'] = 'Y';
                      $key['id'] = $val;
                      $this->modEditRec($this->lang_banners_table, $data,$key);
              }
              $this->displayManageBanner($row);

      } elseif ( $_POST['disable'] ) {

              foreach( $_POST['txtcheck'] as $val ) {

                      $data['enabled'] = 'N';
                      $key['id'] = $val;
                      $this->modEditRec($this->lang_banners_table, $data,$key);
              }
              $this->displayManageBanner($row);

      } elseif( $_GET['edit'] ) {

              $search['id'] = $_GET['edit'];
              $row = $this->modGetRow($this->lang_banners_table, $search);

              $row['bannerurl'] = stripslashes( $row['bannerurl'] );

              $row['tooltip'] = stripslashes( $row['tooltip'] );

              $dim = explode( 'x', $row['size'] );

              $row['width'] = trim( $dim[0] );

              $row['height'] = trim( $dim[1] );

              $row['type'] = substr( $row['name'], -3, 3 );

              $this->displayEditBanner($row);
      }
      else {

          $this->displayManageBanner();
      }
   }
   function saveBanner() {

      $err = false;

      if ( $_FILES['txtbanner'] == '' ) {

              $err = $this->lang['banner_blank'];
      }
      elseif( $_POST['txtlinkurl'] == '' ) {

              $err = $this->lang['link_blank'];
      }



      if( ! $err && is_uploaded_file( $_FILES['txtbanner']['tmp_name'] ) ) {
              $imgw = 0;

              $imgh = 0;

              $imgsize = '';

              $linkurl = 'http://' . $_POST['txtlinkurl'];

              $tooltip = $_POST['txttooltip'];

              $ext = explode( "/", $_FILES['txtbanner']['type'] );

              $size = getimagesize(	$_FILES['txtbanner']['tmp_name'] );

              if($ext[1] == 'pjpeg' || $ext[1]=='jpeg'){

                      $imgw =  $size[0];

                      $imgh =  $size[1];

                      $ext[1] = 'jpg';

                      $imgsize = $imgw . ' x '  . $imgh;

              } elseif( $ext[1] == 'x-shockwave-flash' ){

                      $ext[1] = 'swf';

              } elseif( $ext[1] == 'gif' ){

                      $imgw =  $size[0];

                      $imgh =  $size[1];

                      $ext[1] = 'gif';

                      $imgsize = $imgw . ' x ' . $imgh;

              } elseif( $ext[1] == 'bmp' ){

                      $imgw =  $size[0];

                      $imgh =  $size[1];

                      $ext[1] = 'bmp';

                      $imgsize = $imgw . ' x ' . $imgh;

              } elseif( $ext[1] == 'x-png' || $ext[1] == 'png' ){

                      $imgw =  $size[0];

                      $imgh =  $size[1];

                      $ext[1] = 'png';

                      $imgsize = $imgw . ' x ' . $imgh;

              } else {

                      $err = $this->lang['banner_wrong_type'];

              }
              if ( ! $err ) {

                  /// Start Date
                  $sdd = $_POST['txtstartDay'];

                  $smm = $_POST['txtstartMonth'];

                  $syy = $_POST['txtstartYear'];

                  $startdate = mktime(0,0,0,$smm,$sdd,$syy,0);

                  /// Expity Date
                  $edd = $_POST['txtendDay'];

                  $emm = $_POST['txtendMonth'];

                  $eyy = $_POST['txtendYear'];

                  $expirydate = mktime(0,0,0,$emm,$edd,$eyy,0);

                  $bdata['linkurl'] = $linkurl;
                  $bdata['tooltip'] = $_POST['txttooltip'];
                  $bdata['size'] = $imgsize;
                  $bdata['startdate'] = $startdate;
                  $bdata['expdate'] = $expirydate;
				  $bdata['link_target'] = $_POST['link_target'];
                  $lastid = $this->modAddRec($this->lang_banners_table, $bdata);

                  $fname = $_POST['language'].'Banner'.$lastid . '.' . $ext[1];

                  $bannerlink = '';

                  if( $ext[1] == 'jpg' || $ext[1] == 'gif' || $ext[1] == 'bmp' || $ext[1] == 'png' || $ext[1] == 'x-png'){

                          $bannerlink="<a href='pluginraw.php?plugin=langBanners&amp;action=banclick&amp;id=$lastid' target='".$bdata['link_target']."'><img src='" . $this->modSiteUrl() . 'banners/' . $fname . "' border='0' width='$imgw' height='$imgh' alt=\"$tooltip\" /></a>";
                  }
                  elseif( $ext[1] == 'swf' ){

                          $bannerlink ="<object classid='clsid:D27CDB6E-AE6D-11cf-96B8-444553540000' codebase='http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0'>";
                          $bannerlink .= "<param name='movie' value='" . $this->modSiteUrl() . 'banners/' . $fname . "'>";
                          $bannerlink .="<param name='quality' value='high'>";
                          $bannerlink .="<embed src='" . $this->modSiteUrl() . 'banners/' . $fname . "' quality='high' pluginspage='http://www.macromedia.com/go/getflashplayer' type='application/x-shockwave-flash'></embed></object>";

                  }
                  $bannerlink = addslashes( $bannerlink );

                  $edata['name'] = $fname;
                  $edata['bannerurl'] = $bannerlink;
                  $edata['language'] = $_POST['language'];
                  $keys['id'] = $lastid;
                  $this->modEditRec($this->lang_banners_table,$edata,$keys);


                  $real_path = BANNER_DIR;

                  if(	$HTTP_ENV_VARS["OS"] == 'Windows_NT'){

                          $real_path= str_replace("\\","\\\\",$real_path);

                          $file = $real_path."\\".$fname;
                  }
                  else {

                          $file = $real_path."/".$fname;

                  }

                  copy( $_FILES['txtbanner']['tmp_name'], $file);
              }

        }

        if ( $err ) {

            $this->modSmartyAssign('error', $err);
            $this->displayAddBanner();
        }
        else {

            $this->displayManageBanner();
        }
   }
   function displayAddBanner() {

      $this->modSmartyAssign('langopt', $this->getLanguageOptions() );
      $this->html =  $this->modSmartyFetch('admin/addbanner.tpl');

   }
   function displayManageBanner() {

      $this->modSmartyAssign('data', $this->getAllBanners() );
      $this->modSmartyAssign('bannerdir', $this->modSiteUrl() . 'banners/' );

      $this->html = $this->modSmartyFetch('admin/managebanner.tpl');

   }
   function getAllBanners() {

      $rs = $this->modGetAll($this->lang_banners_table, array() );

      $data = array();
	if ( $rs ) {
      foreach( $rs as $row ) {

              $row['bannerurl'] = stripslashes( $row['bannerurl'] );

              $dim = explode( 'x', $row['size'] );

              $row['width'] = trim( $dim[0] );

              $row['height'] = trim( $dim[1] );

              $row['type'] = substr( $row['name'], -3, 3 );

              $data[] = $row;
      }
	}
      return $data;
   }
}


?>