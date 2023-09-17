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

class myFriends extends modPlugin {

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
   * Holds the username
   *
   * @access private
   */
   var $username;

   /**
   * The name name of the plugin class.
   *
   * @access private
   */
   var $plugin_class_name = "myFriends";

   /**
   * Name of the friends database table
   *
   * @access private
   */
   var $lang_friends_table = "myFriends_friends";

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
  function myFriends( )
  {

    $this->modPlugin();
	$pluginDir = dirname(__FILE__).'/../';
	$this->lang = $this->modLoadLang($pluginDir);
  	$this->user_menu_text=$this->lang['user_title'];
  	$this->display_name=$this->lang['user_title'];
  } // end of member method pluginClass

   /**
   * Adds request for $friend id
   *
   * @return array
   * @access public
   */

   function addrequest($friend)
   {
   	$test=$this->modGetOne($this->lang_friends_table,array('owner'=>$this->uid,'friend'=>$friend),'id');
   	if(!$test && $friend!=$this->uid)
   		{
   			$this->modAddRec($this->lang_friends_table,array('owner'=>$this->uid,'friend'=>$friend,'conf'=>0,'ts'=>time()));
   			$param['message']=$this->modSmartyFetch('mailtype1.tpl');
   			$param['rcvuserid']=$friend;
   			$param['snduserid']=$this->uid;
   			$param['subject']=$this->lang['subject1'];
   			$this->modSendMail($param);
   			return 1;
   		}
   	return 0;
   }


   /**
   * View Friends
   *
   * @return array
   * @access public
   */

   function viewfriends($id, $page = 0)
   {
   		$data=$this->modGetAll($this->lang_friends_table,array('owner'=>$id,'conf'=>1));
   		$i=0;
   		foreach ($data as $item)
   		{
   			$friend=$item['friend'];
   			$udatax=$this->modGetUser(array('userid'=>$friend));
			$user=$udatax['username'];
			$pic=$udatax['id'];
			$data[$i]['user']=$user;
			$data[$i]['pic']=$pic;
   			$i++;
   		}
   		if(!$page) $page=0;
   		$i=0;
   		$start=$this->config['Max Allowed Friends']*$page;
   		$da=0;
   		$count=count($data);
   		$count=(int)($count/($this->config['Max Allowed Friends']));

   		foreach($data as $item)
   		{
   			if(!$da && $i==$start) {$i=0;$da=1;}
   			if($da==1)
   				$data2[$i/$this->config['Number of Columns']][$i%$this->config['Number of Columns']]=$item;
   			if($da==1 && $i==$this->config['Max Allowed Friends']-1) break;
   			$i++;
   		}
   		if($id==$this->uid) $this->modSmartyAssign('you',1);
		if(!isset($data2)) $data2=1;
   		$this->modSmartyAssign('data',$data2);
   		$this->modSmartyAssign('previous',$page-1);
   		if($count==$page) $this->modSmartyAssign('next',0);
   		else $this->modSmartyAssign('next',$page+1);
   		return $this->modSmartyFetch('viewfriends.tpl');
   }

   function removeFriend($friend)
   {
   	$this->modDeleteRows($this->lang_friends_table,array('friend'=>$friend,'owner'=>$this->uid));
   	$this->modDeleteRows($this->lang_friends_table,array('friend'=>$this->uid,'owner'=>$friend));
   }

   /**
   * Does the processing to display a user page.  Called from plugin.php
   *
   * @return array
   * @access public
   */

   function  displayPluginPage() {
	$text='';
   	$this->modSmartyAssign('lang',$this->modGetLang());
   	$this->modSmartyAssign('plugin_name',$this->plugin_class_name);
   	$udata = $this->modGetLoggedInUser();
   	$this->uid=$udata['id'];
   	$this->username=$udata['username'];
   	$this->modSmartyAssign('user',$this->username);
   	$do=isset($_GET['do'])?$_GET['do']:'';
   	if($do=="viewfriends")
   		if(isset($_GET['id']))
   	{
   		$udatax=$this->modGetUser(array('userid'=>$_GET['id']));
   		$this->modSmartyAssign('user',$udatax['username']);
   	}


   	for($i=0;$i<$this->config['Number of Columns'];$i++)
   		$col[$i]=100/$this->config['Number of Columns'];
   	$this->modSmartyAssign('col',$col);

   	if($do=="viewfriends")
		if(isset($_GET['id']))
   			$text.=$this->viewfriends($_GET['id'],$_GET['page']);
   		else $do="";

   	if($do=="removefriend")
   		{$this->removeFriend($_GET['id']);$do="";}

   	if(!$do)
   		$text.=$this->viewfriends($this->uid,(isset($_GET['page'])?$_GET['page']:'1'));

   	if($do=="addfriend")
   	{
   		$ok=0;
   		if(isset($_POST['add']) && $_POST['add'] ==1)
   		{
		    $ok=1;
   			if($_POST['search']==0)
   			{
   				$username=$_POST['username'];
   				$udatax=$this->modGetAllUsers(array('username'=>$username));
   				$friend=$udatax[0]['id'];
   				if($friend) {$ok=$this->addrequest($friend); if(!$ok)$error=8;}
   					else {$ok=0; $error=5;}
   				if($this->modIsBanned(array('userid'=>$this->uid,'ref_userid'=>$friend,'type'=>'B')))
   				 	{$ok=0;if(!$error) $error=9; $this->removeFriend($friend);}

   			}
   			else
   			{
   				$nr=$_POST['nr'];
   				$k=0;
   				for($i=1;$i<=$nr;$i++)
   				{
   					if($_POST['f'.$i]) {
   						$friend=$_POST['f'.$i];
   						if($friend) {$this->addrequest($friend);$k++;}
   					}
   				}
   				if(!$k) {$ok=0;$error=6;}
   			}
   		}

   		if(!$ok)
   		{
   		$search=0;
   		if(isset($_GET['search']) && $_GET['search'] ==1)
   		{
   			$search=1;
   			$data=$this->modGetLastSearch($this->uid);
   			$this->modSmartyAssign('data',$data);
   		}
   		$this->modSmartyAssign('search',$search);
   		$this->modSmartyAssign('name',(isset($_GET['name'])?$_GET['name']:''));
   		$text.=$this->modSmartyFetch('addfriend.tpl');
   		}
   		else
   		{
   			$error=7;
   			$text.=$this->viewfriends($this->uid,(isset($_GET['page'])?$_GET['page']:'1'));
   		}

   	}

   	if($do=="myrequests")
   	{
   		if(isset($_GET['remove']))
   			{
   				$this->removeFriend($_GET['remove']);
   				$error=4;
   			}
   		$data=$this->modGetAll($this->lang_friends_table,array('owner'=>$this->uid,'conf'=>0));
   		$i=0;
   		foreach ($data as $item)
   		{
   			$id=$item['friend'];
   			$udatax=$this->modGetUser(array('userid'=>$id));
   			$data[$i]['username']=$udatax['username'];
   			$i++;
   		}
   		$this->modSmartyAssign('data',$data);
   		$text.=$this->modSmartyFetch('myrequests.tpl');
   	}

   	if($do=="othersrequests")
   	{
   		if(isset($_GET['opt']) && $_GET['opt']==1)
   		{
   			$id=$_GET['id'];
   			$this->addrequest($id);
			$this->modEditRec($this->lang_friends_table,array('conf'=>1),array('owner'=>$id,'friend'=>$this->uid));
   			$param['message']=$this->modSmartyFetch('mailtype2.tpl');
   			$param['rcvuserid']=$id;
   			$param['snduserid']=$this->uid;
   			$param['subject']=$this->lang['subject2'];
   			$this->modSendMail($param);

   			$error=1;
   		} elseif(isset($_GET['opt']) && $_GET['opt']==2)
   		{
   			$id=$_GET['id'];
			$this->modEditRec($this->lang_friends_table,array('conf'=>1),array('owner'=>$id,'friend'=>$this->uid));

   			$param['message']=$this->modSmartyFetch('mailtype2.tpl');
   			$param['rcvuserid']=$id;
   			$param['snduserid']=$this->uid;
   			$param['subject']=$this->lang['subject2'];
   			$this->modSendMail($param);

   			$error=2;
   		} elseif (isset($_GET['opt']) && $_GET['opt']==3)
   		{
   			$id=$_GET['id'];
   			$this->modDeleteRows($this->lang_friends_table,array('owner'=>$id,'friend'=>$this->uid));
   			$error=3;
   		}
   		$data=$this->modGetAll($this->lang_friends_table,array('friend'=>$this->uid,'conf'=>0));
   		$i=0;
   		foreach ($data as $item)
   		{
   			$id=$item['owner'];
   			$udatax=$this->modGetUser(array('userid'=>$id));
   			$data[$i]['username']=$udatax['username'];
   			$i++;
   		}
   		$this->modSmartyAssign('data',$data);
   		$text.=$this->modSmartyFetch('othersrequests.tpl');
   	}

   	$nr1=$this->modGetOne($this->lang_friends_table,array('owner'=>$this->uid,'conf'=>0),'count(*)');
   	$nr2=$this->modGetOne($this->lang_friends_table,array('friend'=>$this->uid,'conf'=>0),'count(*)');
   	$nr3=$this->modGetOne($this->lang_friends_table,array('owner'=>$this->uid,'conf'=>1),'count(*)');
   	$this->modSmartyAssign('nr1',$nr1);
   	$this->modSmartyAssign('nr2',$nr2);
   	$this->modSmartyAssign('nr3',$nr3);

   	if (isset($error)) $this->modSmartyAssign('error',$error);
   	$text=$this->modSmartyFetch('header.tpl').$text.$this->modSmartyFetch('bottom.tpl');
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