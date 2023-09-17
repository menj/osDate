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

class hotornot extends modPlugin {

	/**
   * Holds the language phrases
   *
   * @access private
   */
	var $lang;

	/**
   * Holds the user id
   *
   * @access private
   */
	var $uid;

	/**
   * Rating system ID
   *
   * @access private
   */
	var $rid;

	/**
   * Holds the rating system id
   *
   * @access private
   */
	var $lang_hotornot_table = "hotornot";

	/**
   * The name name of the plugin class.
   *
   * @access private
   */
	var $plugin_class_name = "hotornot";

	/**
   * The text that appears in the admin plugin list
   *
   * @access private
   */
	var $display_name;

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
	var $admin_menu_text ;

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
	function hotornot( )
	{

		$this->modPlugin();
		$pluginDir = dirname(__FILE__).'/../';
		$this->lang = $this->modLoadLang($pluginDir);
		$this->user_menu_text=$this->lang['user_title'];
		$this->display_name=$this->lang['user_title'];
		$this->admin_menu_text=$this->lang['user_title'];
		if ($this->modIsPluginInstalled('hotornot')) {
			$this->rid=$GLOBALS['osDB']->getOne("SELECT ratingid FROM !",array(DB_PREFIX."_".$this->lang_hotornot_table));
		}
	} // end of member method pluginClass

	/**
   * Does the processing to display a user page.  Called from plugin.php
   *
   * @return array
   * @access public
   */
	function  displayPluginPage() {

		$this->modSmartyAssign('lang',$this->modGetLang());
		$this->modSmartyAssign('plugin_name',$this->plugin_class_name);
		$udata = $this->modGetLoggedInUser();
		$this->uid=$udata['id'];
		$opt['rand'] = 1;
		if (isset($_GET['lastid']) ) {
			if(isset($_SESSION['hotornot_id']) && $_SESSION['hotornot_id']==$_GET['lastid']) {$error=1;$adderror=1;}
			elseif($GLOBALS['osDB']->getOne("SELECT id FROM ! WHERE userid=? AND profileid=?",array(USER_RATING_TABLE,$this->uid,$_GET['lastid']))) {$error=1;$adderror=1;}
			$_SESSION['hotornot_id']=$_GET['lastid'];
		}

		if(isset($_GET['gender'])) $_SESSION['hotornot_gender']=$_GET['gender'];
		if(!isset($_SESSION['hotornot_gender'])) $_SESSION['hotornot_gender']=1;
		$gender=$_SESSION['hotornot_gender'];

		if(isset($_GET['age'])) $_SESSION['hotornot_age']=$_GET['age'];
		if(!isset($_SESSION['hotornot_age'])) $_SESSION['hotornot_age']=1;
		$age=$_SESSION['hotornot_age'];


		if(isset($_GET['showrate'])) $_SESSION['hotornot_showrate']=$_GET['showrate'];
		if(!isset($_SESSION['hotornot_showrate'])) $_SESSION['hotornot_showrate']=1;
		$showrate=$_SESSION['hotornot_showrate'];

		$this->modSmartyAssign('age',$age);
		$this->modSmartyAssign('gender',$gender);
		$this->modSmartyAssign('showrate',$showrate);
		if (isset($_SESSION['hotornot_id']) ) {
			$lastdata=$this->modGetProfile(array('id'=>$_SESSION['hotornot_id']));
		}
		if(isset($lastdata)  && isset($_GET['rate']))
		{
			$rate=$_GET['rate'];
			if(!isset($error) || !$error) {
				if($rate>0 && $rate<=10) {
					$this->modAddProfileRating(array('userid'=>$this->uid,'rating'=>$rate,'profileid'=>$lastdata['id'],'ratingid'=>$this->rid));
				}
			}
			$lastdata['rate']=$rate;
		}

		if($age==1) {$agemin=0;$agemax=0;}
		if($age==2) {$agemin=18;$agemax=25;}
		if($age==3) {$agemin=26;$agemax=32;}
		if($age==4) {$agemin=33;$agemax=39;}
		if($age==5) {$agemin=40;$agemax=0;}
		$data = $this->modGetRandomUser($this->uid,$gender,$agemin,$agemax,$this->rid);
		if($data) $data = $this->modGetUser(array('userid'=>$data));
		if(!$data) $this->modSmartyAssign('error',1);

		if($data['about_me']){
			$data['about_me']=str_replace("'","'",$data['about_me']);
			$data['about_me']=str_replace("\r","",$data['about_me']);
			$data['about_me']=str_replace("\n","<br/>",$data['about_me']);
			$data['pic_count']=count($this->modGetAllPictures(array('userid'=>$data['id'])));
		}
		$this->modSmartyAssign('data',$data);
		$_SESSION['hotornot_id'] = $data['id'];

		$prof=$this->modGetAllRatings(array('userid'=>$_SESSION['hotornot_id'],'ratingid'=>$this->rid));
		$lastdata['totalratings']=count($prof);
		$x=$lastdata['totalratings'];
		$sum=0;
		foreach ($prof as $item)
		$sum+=$item['rating'];
		if($x)$med=$sum/$x; else $med=0;
		$med=round($med,2);
		$lastdata['rating']=$med;
		if (isset($lastdata['about_me'])) $lastdata['about_me'] = str_replace("\"","'",$lastdata['about_me']);
		$ago=time()-(isset($lastdata['lastvisit'])?$lastdata['lastvisit']:0);
		if($ago>60*60*24*365) {$lastdata['lv']['time1']=$ago/(60*60*24*365);$lastdata['lv']['time2']="years";}
		if($ago<60*60*24*30*12) {$lastdata['lv']['time1']=$ago/(60*60*24*30);$lastdata['lv']['time2']="months";}
		if($ago<60*60*24*30) {$lastdata['lv']['time1']=$ago/(60*60*24);$lastdata['lv']['time2']="days";}
		if($ago<60*60*24) {$lastdata['lv']['time1']=$ago/(60*60);$lastdata['lv']['time2']="hours";}
		if($ago<60*60) {$lastdata['lv']['time1']=$ago/60;$lastdata['lv']['time2']="minutes";}
		if($ago<60) {$lastdata['lv']['time1']=$ago;$lastdata['lv']['time2']="seconds";}
		$lastdata['lv']['time1']=round($lastdata['lv']['time1'],0);

		if(isset($_GET['lastid'])  && $lastdata) {
			$this->modSmartyAssign('lastdata',$lastdata);
		}
		$count=$GLOBALS['osDB']->getOne("SELECT count(*) FROM ! WHERE ratingid=?",array(USER_RATING_TABLE,$this->rid));
		$count2=$GLOBALS['osDB']->getOne("SELECT count(DISTINCT userid) FROM !",array(USER_SNAP_TABLE));
		$this->modSmartyAssign('count',number_format($count));
		$this->modSmartyAssign('count2',number_format($count2));
		$this->modSmartyAssign('profilelink',$this->modSiteUrl()."showprofile.php?id=".$data['id']);
		$text=$this->modSmartyFetch('hotornot.tpl');
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
		$this->modSmartyAssign('lang',$this->modGetLang());
		$this->modSmartyAssign('plugin_name',$this->plugin_class_name);
		$udata = $this->modGetLoggedInUser();
		$this->uid=$udata['id'];
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
		$this->modSmartyAssign('lang',$this->modGetLang());
		$this->modSmartyAssign('plugin_name',$this->plugin_class_name);
		$data=$this->modGetAllRatingSystems();
		$this->modSmartyAssign('data',$data);
		if(isset($_POST['rid']))
		{
			$this->modEditRec($this->lang_hotornot_table,array('ratingid'=>$_POST['rid']),array('ratingid'=>$this->rid));
			$this->modSmartyAssign('error',1);
			$this->rid=$_POST['rid'];
		}
		$this->modSmartyAssign('rid',$this->rid);
		return $this->modSmartyFetch("admin/admin.tpl");

	}

}


?>