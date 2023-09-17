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
 * class adultQuest
 *
 *  A template to get you started building templates.  Rename all adultQuest
 *  with the name of your plugin
 *
 *
 *
 */
include_once(MODOSDATE_DIR . 'modPlugin.php');

class adultQuest extends modPlugin {

   /**
   * Holds the language phrases
   *
   * @access private
   */
	var $lang=array();
   /**
   * The name name of the plugin class.
   *
   * @access private
   */
   var $plugin_class_name = "adultQuest";

   /**
   * The text that appears in the admin plugin list
   *
   * @access private
   */
   var $display_name ;

   /**
   * User ID
   *
   * @access private
   */
   var $uid;

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
   * Questionnaire Pages table
   *
   * @access private
   */
   var $lang_aqpages_table="adultQuest_pages";

   /**
   * Answers table
   *
   * @access private
   */
   var $lang_aqanswers_table="adultQuest_answers";

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
  function adultQuest()
  {

    $this->modPlugin();
	$pluginDir = dirname(__FILE__).'/../';
	$this->lang = $this->modLoadLang($pluginDir);
  	$this->user_menu_text=$this->modGetLang('user_title');
  	$this->display_name = $this->admin_menu_text=$this->modGetLang('admin_title');
  } // end of member method pluginClass

  function showPage($pid)
  {
	 $data = array();
  	$tname=$this->modGetOne($this->lang_aqpages_table,array('pid'=>$pid),'tname');
  	$datax = $this->modGetAll($this->lang_aqanswers_table,array('pid'=>$pid,'uid'=>$this->uid,"qid"));
	if (count($datax) > 0) {
	  	for($i=0;$i<=$datax[count($datax)-1]['qid'];$i++) {
	  		$data[$i][0]=0;
		}
	  	foreach ($datax as $item) {
	  		$data[$item['qid']][++$data[$item['qid']][0]]=$item;
		}
	}
  	$this->modSmartyAssign('pid',$pid);
  	$this->modSmartyAssign('data',$data);
  	unset($data, $datax);
  	return $this->modSmartyFetch($tname);
  }

  function showFirstPage()
  {
  	  $data = $this->modGetAll($this->lang_aqpages_table,array(),"ord");
      $i=0;
	  $text = '';
      foreach ($data as $item)
      {
      	$pid=$item['pid'];
      	$qnumber=$item['qnumber'];
      	$ans=array();
      	for($i=0;$i<$qnumber;$i++)
      	{
      		$answer = $this->modGetAll($this->lang_aqanswers_table,array('pid'=>$pid,'uid'=>$this->uid,'qid'=>($i+1)));
      		foreach($answer as $item2)
      		{
				if (isset($ans[$i]['answer'])) {
	      			$ans[$i]['answer'].="; ".$item2['answer'];
				} else {
	      			$ans[$i]['answer']= $item2['answer'];
				}
      		}
			unset($answer);
			if (isset($ans[$i]['answer']) ) {
	      		$ans[$i]['answer']=nl2br(htmlspecialchars(substr($ans[$i]['answer'],1)));
			}
      		$ans[$i]['page']="q$pid";
      	}
      	$this->modSmartyAssign('pid',$pid);
      	$this->modSmartyAssign('ans',$ans);
      	$text.=$this->modSmartyFetch("showpage.tpl");
      }
	  unset($data, $ans);
      return $text;
  }

   /**
   * Does the processing to display a user page.  Called from plugin.php
   *
   * @return array
   * @access public
   */
   function  displayPluginPage() {
	$text='';
      $this->modSmartyAssign('lang', $this->modGetLang() );
   	  $this->modSmartyAssign('plugin', $this->plugin_class_name );
   	  $udata = $this->modGetLoggedInUser();
	  $this->uid=$udata['id'];

      if(isset($_GET['showpage']))
      {
      	$pid=$_GET['showpage'];
      	if(isset($_POST['edit'])) {
      		$this->modDeleteRows($this->lang_aqanswers_table,array('pid'=>$pid,'uid'=>$this->uid));
      		$max=$this->modGetOne($this->lang_aqpages_table,array('pid'=>$pid),'qnumber');
      		for($i=1;$i<=$max;$i++)
      		{
      			$ans=(isset($_POST['q'.$i])?$_POST['q'.$i]:0);
      			if($ans=="checkbox"){
      				for($j=1;$j<=99;$j++)
      				{
      					$ans=(isset($_POST['q'.$i.'_'.$j])?$_POST['q'.$i.'_'.$j]:0);
      					if($ans)
      							$this->modAddRec($this->lang_aqanswers_table,array('qid'=>$i,'answer'=>$ans,'pid'=>$pid,'uid'=>$this->uid));
      				}
      			}
      			else
      				$this->modAddRec($this->lang_aqanswers_table,array('qid'=>$i,'answer'=>$ans,'pid'=>$pid,'uid'=>$this->uid));
      		}
      		header("Location: ?plugin=$this->plugin_class_name#p$pid");
      	}
      	else
      		$text=$this->showPage($pid);
      }
      else
      {
		$text=$this->showFirstPage();
      }


	  $text = $this->modSmartyFetch("hdr.tpl").$text;
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

   	$this->modSmartyAssign('lang',$this->modGetLang());
   	$this->modSmartyAssign('plugin', $this->plugin_class_name );

   	$do=isset($_GET['do'])?$_GET['do']:'';

   	if ($do=="moveup")
	{
		$page=isset($_GET['page'])?$_GET['page']:1;
		$ord=$this->modGetOne($this->lang_aqpages_table,array('pid'=>$page),'ord');
		$ord2=$ord;
		$ord = $ord - 1;
		$page2=$this->modGetOne($this->lang_aqpages_table,array('ord'=>$ord),'pid');
		if($ord)
		{
			$this->modEditRec($this->lang_aqpages_table,array('ord'=>$ord),array('pid'=>$page));
			$this->modEditRec($this->lang_aqpages_table,array('ord'=>$ord2),array('pid'=>$page2));
		}
	}

	if ($do=="movedown")
	{
		$page=isset($_GET['page'])?$_GET['page']:1;
		$ord=$this->modGetOne($this->lang_aqpages_table,array('pid'=>$page),'ord');
		$ord++;
		$ord2=$ord-1;
		$page2=$this->modGetOne($this->lang_aqpages_table,array('ord'=>$ord),'pid');
		$max=$this->modGetOne($this->lang_aqpages_table,array(),'count(*)');
		if($ord<=$max)
		{
			$this->modEditRec($this->lang_aqpages_table,array('ord'=>$ord),array('pid'=>$page));
			$this->modEditRec($this->lang_aqpages_table,array('ord'=>$ord2),array('pid'=>$page2));
		}
	}

   	$data = $this->modGetAll($this->lang_aqpages_table,array(),'ord');
   	$this->modSmartyAssign('data',$data);
   	unset($data);
   	return $this->modSmartyFetch("admin/showpages.tpl");
   }
}


?>