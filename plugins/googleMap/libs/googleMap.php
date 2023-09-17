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

class googleMap extends modPlugin {

   /**
   * Holds the language phrases for the active language in an associative array
   *
   * @access public
   */
   var $lang = array();

   /**
   * Holds the user id
   *
   * @access private
   */
   var $uid;

   /**
   * The name name of the plugin class.
   *
   * @access private
   */
   var $plugin_class_name = "googleMap";

   /**
   * The text that appears in the admin plugin list
   *
   * @access private
   */
   var $display_name = "Google Map";

   /**
   * The link text that appears on the user's menu
   *
   * @access private
   */
   var $user_menu_text = "Google Map";

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
   var $admin_menu_text = "Google Maps" ;

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
  function googleMap( )
  {

    $this->modPlugin();
	$pluginDir = dirname(__FILE__).'/../';
	$this->lang = $this->modLoadLang($pluginDir);
  	$this->user_menu_text=$this->lang['user_title'];
  	$this->display_name=$this->lang['user_title'];
  	$this->admin_menu_text=$this->lang['user_title'];
  } // end of member method pluginClass


   /**
   * Does the processing to display a user page.  Called from plugin.php
   *
   * @return array
   * @access public
   */
   function  displayPluginPage() {

    $this->modSmartyAssign('lang',$this->lang);
   	$this->modSmartyAssign('plugin_name',$this->plugin_class_name);
   	$udata = $this->modGetLoggedInUser();
   	$this->uid=$udata['id'];
   	$get1=1;
   	$get2=1;
   	if(isset($_GET['city']))
   	{
   		$get1=$_GET['get1'];
   		$get2=$_GET['get2'];
   		$ss=isset($_GET['ss'])?$_GET['ss']:'';
		$searchcity=$_GET['city'];
		$searchcountry=$_GET['country'];
		if ($searchcity[strlen($searchcity)-1]==" ")$searchcity=substr($searchcity,0,strlen($searchcity)-1);
		if ($searchcountry[strlen($searchcountry)-1]==" ")$countryname=substr($searchcountry,0,strlen($searchcountry)-1);
		$this->modSmartyAssign('city',"$searchcity, $searchcountry");
		$searchcity=strtolower($searchcity);
		$searchcountry=strtolower($searchcountry);

   		if($get1==1)
			$data = $this->modGetMyMatches($this->uid);
		if($get1==2)
			$data = $this->modGetLastSearch($this->uid);
		if($get1==3)
			$data = $this->modGetSavedSearchs($this->uid,$ss);
		if($get1==4) $data = $this->modGetAllUsers(array('username'=>$_GET['username']));
		else
		{
		if($get2==2) $search="M";
		if($get2==3) $search="F";

		if($data)
		foreach ($data as $item)
			if( (!isset($search) || ($search && $item['gender']==$search)) )
			{
				$cityname=$item['city'];
				$udr = $this->modGetUser(array("userid"=>$item['id']));
				$countryname=$udr['countryname'];
				if(!$countryname) $countryname=$item['country'];
				$cityname=strtolower($cityname);
				$countryname=strtolower($countryname);
				if ($cityname[strlen($cityname)-1]==" ")$cityname=substr($cityname,0,strlen($cityname)-1);
				if ($countryname[strlen($countryname)-1]==" ")$countryname=substr($countryname,0,strlen($countryname)-1);

				if($cityname==$searchcity && $countryname==$searchcountry) $data2[]=$item;
			}
		$data=$data2;
		}
		$i=0;
		$data2="";
		foreach ($data as $item)
		{
			$data2[$i/4][$i%4]=$item;
			$i++;
		}
		$data=$data2;
		$this->modSmartyAssign('data',$data);
		unset($data, $data2);

		$text=$this->modSmartyFetch("showusers.tpl");
   	}
   	else
   	{
   		//get users data
   		if(isset($_POST['get1']))$get1=$_POST['get1'];
   		if(isset($_POST['get2']))$get2=$_POST['get2'];
   		if($get1==1)
			$data = $this->modGetMyMatches($this->uid);
		if($get1==2)
			$data = $this->modGetLastSearch($this->uid);
		if($get1==3)
			$data= $this->modGetSavedSearchs($this->uid,$_POST['ss']);
		if($get1==4)
			$data = $this->modGetAllUsers(array("username"=>$_POST['showuser']));
		if($get2==2) $search="M";
		if($get2==3) $search="F";
		if($data)
		foreach ($data as $item) {
			if( (isset($search) && ($item['gender']==$search || $get1==4)) || !isset($search))
			{
				$cityname=$item['city'];
				$udr = $this->modGetUser(array("userid"=>$item['id']));
				$countryname=$udr['countryname'];
				if(!$countryname) $countryname=$item['country'];
				$name="{$cityname},{$countryname}";
				$name=strtolower($name);
				if (isset($city[$name])) {
					$city[$name]++;
				} else {
					$city[$name]= 1;
				}
			}
		}
		$i=0;

		if(is_array(isset($city)))
		foreach ($city as $item => $key)
		{

			$citydata[$i]['name']=$item;
			$data=explode(",",$item);
			$cityname=explode(" ",$data[0]);
			$cit="";
			foreach($cityname as $item2 => $key2)
			{
				if (isset($key2[0]) ){
					$key2[0]=strtoupper($key2[0]);
					$cit.="$key2 ";
				}
			}
			$citydata[$i]['city']=$cit;
			$countryname=explode(" ",$data[1]);
			$cit="";
			foreach($countryname as $item2 => $key2)
			{
				if (isset($key2[0]) ){
					$key2[0]=strtoupper($key2[0]);
					$cit.="$key2 ";
				}
			}
			$citydata[$i]['country']=$cit;
			$citydata[$i]['number']=$key;
			$url="?plugin={$this->plugin_class_name}&get1=$get1&get2=$get2";
			if (isset($_POST['ss'])) $url.="&ss={$_POST['ss']}";
			if($get1==4 && isset($_POST['showuser']) )$url.="&username={$_POST['showuser']}";
			$citydata[$i]['url']=$url;

			$i++;
		}
		$this->modSmartyAssign('citydata',(isset($citydata)?$citydata:array()));
		unset($city, $citydata, $data);

   	}

   	$this->modSmartyAssign('data',$this->modGetSavedSearchs($this->uid));
   	$this->modSmartyAssign('get1',$get1);
   	$this->modSmartyAssign('showuser',(isset($_POST['showuser'])?$_POST['showuser']:''));
   	$this->modSmartyAssign('get2',$get2);
   	$this->modSmartyAssign('keyg',$this->config['Google API Key']);
   	$this->modSmartyAssign('clat',$this->config['Map Center Point Latitude']);
	$this->modSmartyAssign('clng',$this->config['Map Center Point Longitude']);
	$this->modSmartyAssign('czoom',$this->config['Map Zoom Level']);
	if (isset($_POST['ss'])) $this->modSmartyAssign('ss',$_POST['ss']);

	if(!isset($text))
   		$text=$this->modSmartyFetch("googleMap.tpl");

   	return $text;
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
  /**
   * Does the processing to display a admin page.  Called from plugin.php
   *
   * @return array
   * @access public
   */
   function  displayPluginAdminPage() {
   }

}


?>