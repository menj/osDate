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

class speedDater extends modPlugin {

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
   * Holds the user id
   *
   * @access private
   */
   var $lang_speeddater_table = "speedDater_speeddater";

   /**
   * The name name of the plugin class.
   *
   * @access private
   */
   var $plugin_class_name = "speedDater";

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
   var $admin_menu_appear = false;

   /**
   * Constructor
   *
   * @return
   * @access public
   */
  function speedDater( )
  {

    $this->modPlugin();
	$pluginDir = dirname(__FILE__).'/../';
	$this->lang = $this->modLoadLang($pluginDir);
  	$this->user_menu_text=$this->lang['user_title'];
  	$this->display_name=$this->lang['user_title'];
  } // end of member method pluginClass

  function showFirstPage()
  {
  	$data=$this->modGetSavedSearchs($this->uid);
   	$this->modSmartyAssign('data',$data);
   	$data2=$this->modGetSavedMailTemplates($this->uid);
   	$this->modSmartyAssign('data2',$data2);
   	$text=$this->modSmartyFetch("speedDater.tpl");
   	return $text;
  }

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
	$get1=1;$get2=1;
	if (!$this->modHasPermission(array('userid'=>$this->uid,'resource'=>'sendwinks')))
	{$get2=2;$this->modSmartyAssign('sendwinks',0);}
	else $this->modSmartyAssign('sendwinks',1);


	if (!$this->modHasPermission(array('userid'=>$this->uid,'resource'=>'message')))
	$this->modSmartyAssign('sendmessage',0);
	else $this->modSmartyAssign('sendmessage',1);

	$this->modSmartyAssign('overlaptime',30);
	$this->modSmartyAssign('overlap',1);
	$this->modSmartyAssign('st',(isset($_POST['st'])?$_POST['st']:''));
	$this->modSmartyAssign('ss',(isset($_POST['ss'])?$_POST['ss']:''));
	if(!file_exists(TEMP_DIR."speeddater")) mkdir(TEMP_DIR."speeddater");
   	if(isset($_POST['send']))
	{

		$get1=$_POST['get1'];
		$get2=$_POST['get2'];

		if($get2==1) $error=4;
		if($get2==2) $error=5;
		if($get2==3) $error=5;
		if($get1==1)
			$data=$this->modGetMyMatches($this->uid);
		if($get1==2)
			$data=$this->modGetLastSearch($this->uid);
		if($get1==3)
			$data=$this->modGetSavedSearchs($this->uid,$_POST['ss']);
		if(!$data) $error=1;

		$i=0;
		$overlaptime=0;
		$this->modSmartyAssign('overlaptime',$_POST['overlaptime']);
		if($_POST['overlap'])
		{
			$overlaptime=$_POST['overlaptime'];
			$overlaptime=time()-($overlaptime*60*60*24);
			$data2 = array();
			if($data) {
				foreach ($data as $item)
				{
					$ts=$this->modGetOne($this->lang_speeddater_table,array('owner'=>$this->uid,'friend'=>$item['id']),'max(ts)');
					if(!$ts) $ts=0;
					if($ts<$overlaptime) $data2[$i++]=$item;
				}
				$data=$data2;
			}
		} else {
			$i=count($data);
			$this->modSmartyAssign('overlap',0);
		}
		$ts=time()-$this->config['Max allowed messages time period'];
		$nr=$GLOBALS['osDB']->getOne("SELECT count(*) FROM ! WHERE owner=? AND ts > ?", array(DB_PREFIX."_".$this->lang_speeddater_table, $this->uid, $ts) );

		if($i) {
			if($this->config['Max allowed messages per time period']>=$nr+$i)
			{

				$time=time();
				$config=$this->modGetConfig();
				$usr=$udata;
				$usr['link']       = $this->modSiteUrl();
				$usr['sitename']   = $config['site_name'];

				if($get2==1) {
					foreach ($data as $item) {
						if($this->modSendWink(array('from_userid'=>$this->uid,'to_userid'=>$item['id'])))
						{
							$this->modAddRec($this->lang_speeddater_table,array('owner'=>$this->uid,'friend'=>$item['id'],'ts'=>$time));
							$message = $this->modGetLang('wink_received',MAIL_FORMAT);
							$Subject = str_replace('#SenderName#',$_SESSION['UserName'], $this->modGetLang('letter_winkreceived_sub')  ) ;
							$From=$config['admin_email'];
							$To = $item['email'];
							$message = str_replace('#FirstName#', $usr['firstname'], $message);
							$message = str_replace('#SenderName#', $_SESSION['UserName'], $message);
							$message = str_replace('#UserId#', $_SESSION['UserId'], $message);

							if (MAIL_FORMAT == 'HTML' or MAIL_FORMAT == 'html') {
								$this->modSmartyAssign('item',$usr);
								$message = str_replace('#smallProfile#', $this->modSmartyFetch('profile_for_html_mail.tpl'), $message);
							}

							$send=array();
							$send['subject']=$Subject;
							$send['from']=$From;
							$send['to']=$To;
							$send['message']=$message;
							$send=serialize($send);
							$file=TEMP_DIR."speeddater/sd_{$time}_{$this->uid}_{$item['id']}.txt";
							$handle=fopen($file,"w");
							fwrite($handle,$send);
							fclose($handle);
						}
					}
				} elseif($get2==2)
				{
					$st=$_POST['st'];
					$template=$this->modGetSavedMailTemplates(0,$st);
					foreach ($data as $item)
					{
						$this->modAddRec($this->lang_speeddater_table, array('owner'=>$this->uid, 'friend'=>$item['id'], 'ts'=>$time));
						$send=array();
						$send['subject']=$template['subject'];
						$send['from']=$config['admin_email'];
						$send['to']=$item['email'];

						$message = $this->_fillTemplate(str_replace(array('[',']'),"#",$template['text']), $usr);
						$message = str_replace('#FirstName#', $usr['firstname'], $message);
						$message = str_replace('#SenderName#', $_SESSION['UserName'], $message);
						$message = str_replace('#UserId#', $_SESSION['UserId'], $message);
						$send['message']= $message;
						$send=serialize($send);
						$file=TEMP_DIR."speeddater/sd_{$time}_{$this->uid}_{$item['id']}.txt";
						$handle=fopen($file,"w");
						fwrite($handle,$send);
						fclose($handle);
					}
				} elseif($get2==3)
				{
					$template['subject']=$_POST['subject'];
					$template['text']=$_POST['body'];
					foreach ($data as $item)
					{
						$this->modAddRec($this->lang_speeddater_table, array('owner'=>$this->uid,'friend'=>$item['id'],'ts'=>$time));
						$send=array();
						$send['subject']=$template['subject'];
						$send['from']=$config['admin_email'];
						$send['to']=$item['email'];

						$message=$this->_fillTemplate(str_replace(array('[',']'),"#",$template['text']), $usr);
						$message=$this->modSmartyFetch("html_emails.tpl");
						$message = str_replace('#FirstName#', $usr['firstname'], $message);
						$message = str_replace('#SenderName#', $_SESSION['UserName'], $message);
						$message = str_replace('#UserId#', $_SESSION['UserId'], $message);
						$message = str_replace('MAIL_HDR', $template['text'], $message);
						$send['message']= $message;
						$send=serialize($send);
						$file=TEMP_DIR."speeddater/sd_{$time}_{$this->uid}_{$item['id']}.txt";
						$handle=fopen($file,"w");
						fwrite($handle,$send);
						fclose($handle);
					}
				}
			} else {
				$error=2;
				$this->modSmartyAssign("left",$this->config['Max allowed messages per time period']-$nr+1);
			}
		} else{
			if($get2==1) {
				$error=3;
			} else { 
				$error=31;
			}
		}
		$this->modSmartyAssign('subject',$_POST['subject']);
		$this->modSmartyAssign('body',$_POST['body']);
	}
   	$this->modSmartyAssign('get1',$get1);
	$this->modSmartyAssign('get2',$get2);
	if (isset($error)) $this->modSmartyAssign('error',$error);
	$text=$this->showFirstPage();

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