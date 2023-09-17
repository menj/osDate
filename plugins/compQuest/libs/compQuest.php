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

class compQuest extends modPlugin {

   /**
   * Holds the language phrases
   *
   * @access private
   */
   var $lang;

      /**
   * Holds the template data
   *
   * @access private
   */
   var $data;

   /**
   * The ID of logged in USER
   *
   * @access private
   */
   var $uid;


   /**
   * The name name of the plugin class.
   *
   * @access private
   */
   var $plugin_class_name = "compQuest";

   /**
   * Error.
   *
   * @access private
   */

   var $error=0;

   /**
   * The text that appears in the admin plugin list
   *
   * @access private
   */
   var $display_name = "Compatability Questionnaire";

   /**
   * Table that holds the sections
   *
   * @access private
   */
   var $lang_qsection_table = 'compQuest_section';

   /**
   * Table that holds the questions
   *
   * @access private
   */
   var $lang_qquestion_table = 'compQuest_question';

   /**
   * Table that holds the questions content
   *
   * @access private
   */
   var $lang_qcontent_table = 'compQuest_content';

   /**
   * The link text that appears on the user's menu
   *
   * @access private
   */
   var $user_menu_text  = "Compatability Questionnaire";

   /**
   * Table that holds the banners
   *
   * @access private
   */
   var $lang_qanswer_table = 'compQuest_answer';

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
   var $admin_menu_text  = "Compatability Questionnaire";

   /**
   * Appear on admin's menu (true or false)
   *
   * @access private
   */
   var $admin_menu_appear = true;
   var $osDB;
   /**
   * Constructor
   *
   * @return
   * @access public
   */
  function compQuest( )
  {

    $this->modPlugin();
	$this->osDB =& $GLOBALS['osDB'];
	$pluginDir = dirname(__FILE__).'/../';
	$this->lang = $this->modLoadLang($pluginDir);
  	$this->user_menu_text=$this->lang['user_title'];
  	$this->admin_menu_text=$this->lang['admin_title'];
  	$this->display_name=$this->lang['admin_title'];
  } // end of member method pluginClass

   /**
   * Generates a section page for users
   * Parameters: $sid (section ID)
   *
   * @return string
   * @access public
   */

  function showSection($sid)
  {

	$data = $this->modGetAll($this->lang_qquestion_table,array('sid'=>$sid));
	$text = '';
	 foreach ($data as $item)
	 {
	 	if($item['type']==1)
	 	{
	 		$text2=$this->showQuestionType1($item);
	 	}

	 	if($item['type']==2)
	 	{
			$text2=$this->showQuestionType2($item);
	 	}

	 	$text.= isset($text2)?$text2:'';
	 }
	 unset($data);
	 return $text;
  }

   /**
   * Generates a question of type 1;
   * Parameters: $item = array with all fields of the question table
   * Important fields: $item['qid'], $item['maxopt'], $item['question'];
   *
   * @return string
   * @access public
   */

  function showQuestionType1($item)
  {
	$lenopt=7;
	$uresp=array();
	$lenans=100-(2+$lenopt*$item['maxopt']);
	for($i=0;$i<$item['maxopt'];$i++) {
		$nr[$i]=$i+1;
	}
	$ans = $this->modGetAll($this->lang_qcontent_table,array('qid'=>$item['qid']),'ord');
	$uans = $this->modGetAll($this->lang_qanswer_table,array('uid'=>$_SESSION['compQuest']['lookuser'],'qid'=>$item['qid']));
	foreach($uans as $uanswer) {
		$uresp[$uanswer['qcid']]=$uanswer['answer'];
	}
	$i=0;
	foreach($ans as $answer) {
		if (isset($uresp[$answer['qcid']]) ) {
			$ans[$i++]['check']=$uresp[$answer['qcid']];
		}
	}
	if(!isset($_SESSION['compQuest']['lookuser']) || (isset($_SESSION['compQuest']['lookuser']) && $_SESSION['compQuest']['lookuser']!=$this->uid) )
	{
		unset($uresp);
		$uresp = array();
		$uans = $this->modGetAll($this->lang_qanswer_table,array('uid'=>$this->uid,'qid'=>$item['qid']));
		foreach($uans as $uanswer){
			$uresp[$uanswer['qcid']]=$uanswer['answer'];
		}
		$i=0;
		foreach($ans as $answer){
			$ans[$i++]['check2']=$uresp[$answer['qcid']];
		}
	}
	$this->modSmartyAssign('lenopt',$lenopt);
	$this->modSmartyAssign('lenans',$lenans);
	$this->modSmartyAssign('nr',$nr);
	$this->modSmartyAssign('item',$item);
	$this->modSmartyAssign('ans',$ans);
	$this->modSmartyAssign('colspan',$item['maxopt']-2);
	unset($item, $ans, $uresp, $uanswer, $uans, $answer, $lenans, $lenopt);
	$text2=$this->modSmartyFetch("questiontype1.tpl");

	return $text2;
  }

   /**
   * Generates a question of type 2;
   * Parameters: $item = array with all fields of the question table
   * Important fields: $item['qid'], $item['maxopt'], $item['minopt'], $item['showopt'], $item['question'];
   *
   * @return string
   * @access public
   */

  function showQuestionType2($item)
  {
	 	$showopt=$item['showopt'];
	 	$lenans=100/$showopt;
	 	$lenans=(int)$lenans;
	 	if (isset($_SESSION['compQuest']['lookuser']) && $_SESSION['compQuest']['lookuser'] == $this->uid)
	 	{
		 	$ans = $this->modGetAll($this->lang_qcontent_table,array('qid'=>$item['qid']),'ord');
		 	$uans = $this->modGetAll($this->lang_qanswer_table,array('uid'=>$_SESSION['compQuest']['lookuser'],'qid'=>$item['qid']));
		 	foreach($uans as $uanswer){
	        	$uresp[$uanswer['qcid']]=1;
			}
	        $i=0;
	        foreach($ans as $aanswer){
				$ans[$i++]['check']=$uresp[$aanswer['qcid']];
			}
		 	$count=count($ans);
		 	$lin=(int)($count/$showopt);
		 	if($lin*$showopt!=$count) $lin++;
	 		for($i=0;$i<$lin;$i++){
		 		for($j=0;$j<$showopt;$j++){
	 				$answer[$i][$j]['answer']=$ans[$j*$lin+$i]['answer'];
	 				$answer[$i][$j]['qcid']=$ans[$j*$lin+$i]['qcid'];
	 				$answer[$i][$j]['check']=$ans[$j*$lin+$i]['check'];
	 			}
			}
  		}
  		else
  		{
  			$ans = $this->modGetAll($this->lang_qcontent_table,array('qid'=>$item['qid']),'ord');
	 		$uans = $this->modGetAll( $this->lang_qanswer_table,array('uid'=>$_SESSION['compQuest']['lookuser'],'qid'=>$item['qid']));
	 		foreach($uans as $uanswer){
        		$uresp[$uanswer['qcid']]=1;
			}
	 		$uans = $this->modGetAll($this->lang_qanswer_table,array('uid'=>$this->uid,'qid'=>$item['qid']));
	 		foreach($uans as $uanswer){
        		$uresp2[$uanswer['qcid']]=1;
			}
  			$i=0;$s1="";$s2="";
  		    foreach($ans as $aanswer) {
	  		    if($uresp[$aanswer['qcid']] || $uresp2[$aanswer['qcid']]) {
					$answer[$i]['check']=$uresp[$aanswer['qcid']];
					if($uresp[$aanswer['qcid']])$s1=$aanswer['answer'];
					$answer[$i]['check2']=$uresp2[$aanswer['qcid']];
					if($uresp2[$aanswer['qcid']])$s2=$aanswer['answer'];
					$answer[$i]['answer']=$aanswer['answer'];
					$i++;
	  		    }
			}
  		   $this->modSmartyAssign('s1',$s1);
  		   $this->modSmartyAssign('s2',$s2);
  		}
	 	$this->modSmartyAssign('answer',$answer);
	 	$this->modSmartyAssign('lenans',$lenans);
	 	$this->modSmartyAssign('item',$item);
		unset($item, $answer, $lenans, $ans, $aanswer, $uanswer, $uans);
	 	$text2=$this->modSmartyFetch("questiontype2.tpl");

	 return $text2;
  }

   /**
   * Does the processing to display a user page.  Called from plugin.php
   *
   * @return array
   * @access public
   */

   function  displayPluginPage() {


   	 $this->modSmartyAssign('lang', $this->modGetLang());
   	 $this->modSmartyAssign('plugin_name',$this->plugin_class_name);
   	 $udata = $this->modGetLoggedInUser();
	 $this->uid=$udata['id'];

	 $section=isset($_POST['section'])?$_POST['section']:'1';
	 $ok=1;
	 if($section)
	 {
	 	$sid=isset($_POST['sid'])?$_POST['sid']:'';
	 	$data = $this->modGetAll($this->lang_qquestion_table,array('sid'=>$sid));
	 	$ok=1;
	 	foreach ($data as $item)
	 	{
			$qid=$item['qid'];
			$this->modDeleteRows($this->lang_qanswer_table,array('qid'=>$qid,'uid'=>$this->uid));
			$ans = $this->modGetAll($this->lang_qcontent_table,array('qid'=>$qid),'ord');
			$max=count($ans);
			$i=0;
			$minopt=$this->modGetOne($this->lang_qquestion_table,array('qid'=>$item['qid']),'minopt');
			$maxopt=$this->modGetOne($this->lang_qquestion_table,array('qid'=>$item['qid']),'maxopt');

	 		if($item['type']==1)
	 		{
				foreach($ans as $answer)
		 		{
		 			$qcid=$answer['qcid'];
		 			$resp=isset($_POST['sid'])?$_POST['sid']:false;
		 			if($resp) {
		 				$i++;
		 				$this->modAddRec($this->lang_qanswer_table,array('qid'=>$qid,'qcid'=>$qcid,'answer'=>$resp,'uid'=>$this->uid));
	 				}
		 		}
		 		if($max!=$i) $ok=0;
		 	} elseif($item['type']==2){
				foreach($ans as $answer)
		 		{
		 			$qcid=$answer['qcid'];
		 			if(isset($_POST["q{$qid}_{$qcid}"]))
		 			{
		 				$i++;
		 				$this->modAddRec($this->lang_qanswer_table,array('qid'=>$qid,'qcid'=>$qcid,'answer'=>1,'uid'=>$this->uid));
		 			}
		 		}

		 		if($i<$minopt||$i>$maxopt) {$ok=0;}
		 	}

		 }
	  	 if($ok)
		 	$section++;
		 }

		 if(!$section) $section=1;
		 $max=$this->modGetOne($this->lang_qsection_table,array(),'count(*)');
		 if($section>$max)
		 {
		 	$ok=2;
		 	$this->modSmartyAssign('ok',$ok);
		 	$text=$this->modSmartyFetch("sectiontop.tpl");
		 	$text.=$this->modSmartyFetch('thankyou.tpl');
		 	$text.=$this->modSmartyFetch("sectionbottom.tpl");
		 }
		 else
		 {
			 if(isset($_GET['spage']))$section=$_GET['spage'];
			 if(isset($_GET['lookuser'])) {
			 $this->modSmartyAssign('lookuser',$_GET['lookuser']);
			 $lookuser = $this->modGetAllUsers(array('username'=>$_GET['lookuser']));
			 if($lookuser) {$_SESSION['compQuest']['lookuser']=$lookuser[0]['id'];$this->modSmartyAssign('lookid',$lookuser[0]['id']);
			 } else {
				 $eds = $this->modGetUser(array('userid'=>$_SESSION['compQuest']['lookuser']));
				 $this->modSmartyAssign('error',3);
				 $this->modSmartyAssign('lookuser',$eds['username']);
			 }
		} else $_SESSION['compQuest']['lookuser']=$this->uid;

	 $title=$this->modGetOne($this->lang_qsection_table,array('ord'=>$section),'title');
	 $this->modSmartyAssign('title',$title);
	 $this->modSmartyAssign('ok',$ok);

	 $sid=$this->modGetOne($this->lang_qsection_table,array('ord'=>$section),'sid');
	 $this->modSmartyAssign('sid',$sid);
	 $this->modSmartyAssign('section',$section);
	 $this->modSmartyAssign('prev',$section-1);
	 $this->modSmartyAssign('next',$section+1);
	 if($max==$section)$this->modSmartyAssign('next',0);
	 $this->modSmartyAssign('pages',$this->modGetAll($this->lang_qsection_table,array(),'ord'));

	 if((isset($_SESSION['compQuest']['lookuser']) && $_SESSION['compQuest']['lookuser']!=$this->uid)||!isset($_SESSION['compQuest']['lookuser']) ) {
	 	$this->modSmartyAssign('ou',1);
	 	$data = $this->modGetAll($this->lang_qquestion_table,array('sid'=>$sid));
	 	$total=0;
	 	$totalmatch=0;
	 	$totalmatch2=0;
	 	foreach ($data as $item)
	 	{
			$qid=$item['qid'];
			$data2 = $this->modGetAll($this->lang_qanswer_table,array('qid'=>$qid,'uid'=>$this->uid));
			$total+=count($data2);
			foreach ($data2 as $item2)
			{
				$qid=$item2['qid'];
				$qcid=$item2['qcid'];
				$datax = $this->modGetRow($this->lang_qanswer_table,array('qid'=>$qid,'qcid'=>$qcid,'uid'=>$_SESSION['compQuest']['lookuser']));
				if($datax['answer']==$item2['answer']) $totalmatch++;
				if(abs($datax['answer']-$item2['answer'])==1 && ($datax['answer'])) $totalmatch2++;
			}
			unset($data2);
	 	}
	 	if ($total==0) {
	 		$this->modSmartyAssign('proc1',0);
		 	$this->modSmartyAssign('proc2',0);
	 	}
	 	else {
		 	$this->modSmartyAssign('proc1',(int)($totalmatch/$total*100));
		 	$this->modSmartyAssign('proc2',(int)($totalmatch2/$total*100));
	 	}
	 	$totalmatch=0;
	 	$totalmatch2=0;
	 	$data2 = $this->modGetAll($this->lang_qanswer_table,array('uid'=>$this->uid));
	 	$total=count($data2);
		foreach ($data2 as $item2)
		{
			$qid=$item2['qid'];
			$qcid=$item2['qcid'];
			$datax = $this->modGetRow($this->lang_qanswer_table,array('qid'=>$qid,'qcid'=>$qcid,'uid'=>$_SESSION['compQuest']['lookuser']));
			if($datax['answer']==$item2['answer']) $totalmatch++;
			if(abs($datax['answer']-$item2['answer'])==1 && ($datax['answer'])) $totalmatch2++;
		}
		$this->modSmartyAssign('proc3',(int)($totalmatch/$total*100));
	 	$this->modSmartyAssign('proc4',(int)($totalmatch2/$total*100));
	 } 	else $this->modSmartyAssign('ou',0);
	 $text=$this->modSmartyFetch("sectiontop.tpl");
	 $text.=$this->showSection($sid);
	 $this->modSmartyAssign('smax',$max);
	 if($_SESSION['compQuest']['lookuser']!=$this->uid) $this->modSmartyAssign('ok',2);
	 $text.=$this->modSmartyFetch("sectionbottom.tpl");
	 }
	 unset($data, $data2, $item2, $datax, $eds, $ans);
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
   * Display the Sections Page
   *
   * @return string
   * @access public
   */
  function getSections()
  {
  		$this->modSmartyAssign('data', $this->osDB->getAll("SELECT * FROM ! ORDER BY ord",array(DB_PREFIX."_".$this->lang_qsection_table)));
		$text=$this->modSmartyFetch("admin/section.tpl");
		return $text;
  }

  /**
   * Display the Edit Section Page
   *
   * @return string
   * @access public
   */

  function showEditSection($section)
  {
  	$this->modSmartyAssign('data',$this->modGetRow($this->lang_qsection_table,array('sid'=>$section)));
	$text=$this->modSmartyFetch("admin/sectionedit.tpl");
	return $text;
  }

    /**
   * Delete section with ID $section
   *
   * @return none
   * @access public
   */

  function deleteSection($section)
  {
		$ord=$this->modGetOne($this->lang_qsection_table,array('sid'=>$section),'ord');
		$this->modDeleteRows($this->lang_qsection_table,array('sid'=>$section));
		$this->osDB->query("UPDATE ! SET ord=ord-1 WHERE ord>?",array(DB_PREFIX."_".$this->lang_qsection_table,$ord));

  }

   /**
   * Add section with title $title
   *
   * @return none
   * @access public
   */

  function addSection($title)
  {
		$number=$this->modGetOne($this->lang_qsection_table,array(),'count(*)');
		$number++;
		if($title)
			$this->modAddRec($this->lang_qsection_table,array('title'=>$title,'ord'=>$number));
  }

  /**
   * Display the Questions Page of Section with id $section
   *
   * @return string
   * @access public
   */

  function getQuestions($section)
  {
//  	$getdata=$this->modGetAll($this->lang_qquestion_table,array('sid'=>$section),'ord');
  	$this->modSmartyAssign('data',$this->osDB->getAll("SELECT * FROM ! WHERE sid=? ORDER BY ord",array(DB_PREFIX."_".$this->lang_qquestion_table,$section)) );
	$this->modSmartyAssign('sid',$section);
	$text=$this->modSmartyFetch("admin/showquestions.tpl");
	return $text;
  }

   /**
   * Returns the section ID corresponding the Question with id $qid
   *
   * @return integer
   * @access public
   */

  function getSectionID($qid)
  {
  	return $this->modGetOne($this->lang_qquestion_table,array('qid'=>$qid),'sid');
  }

   /**
   * Returns the question ID corresponding the answer with id $qcid
   *
   * @return integer
   * @access public
   */

  function getQuestionID($qcid)
  {
  	return $this->modGetOne($this->lang_qcontent_table,array('qcid'=>$qcid),'qid');
  }

   /**
   * Display the Add Question page (in section with id $section)
   *
   * @return string
   * @access public
   */

  function showAddQuestion($section)
  {
  	$this->modSmartyAssign('data',$this->modGetRow($this->lang_qsection_table,array('sid'=>$section)) );
	$text=$this->modSmartyFetch("admin/addquestion.tpl");
	return $text;
  }

   /**
   * Delete Question with id $qid
   *
   * @return none
   * @access public
   */

  function deleteQuestion($qid)
  {
  	$row = $this->modGetRow($this->lang_qquestion_table,array('qid'=>$qid));
	$ord=$row['ord'];
	$sid=$row['sid'];
	$this->modDeleteRows($this->lang_qquestion_table,array('qid'=>$qid));
  	$this->osDB->query("UPDATE ! SET ord=ord-1 WHERE ord>?",array(DB_PREFIX."_".$this->lang_qquestion_table,$ord));
	unset($row);
  }

   /**
   * Display the Edit Question page. (edits question with id $qid)
   *
   * @return string
   * @access public
   */

  function showEditQuestions($qid)
   {

   	if($this->error==0)
   	{
   	if(isset($_POST['delete']))
	{
		$qcid=$_POST['delete'];
		$ord=$this->modGetOne($this->lang_qcontent_table,array('qcid'=>$qcid),'ord');
		$this->modDeleteRows($this->lang_qcontent_table,array('qcid'=>$qcid));
		$this->osDB->query("UPDATE ! SET ord=ord-1 WHERE ord>? AND qid=?",array(DB_PREFIX."_".$this->lang_qcontent_table,$ord,$qid));
	}

	if(isset($_POST['edit']))
	{
		$i=0;
		$nr=$this->modGetOne($this->lang_qcontent_table,array('qid'=>$qid),'count(*)');
		while (isset($_POST['ans'.$i])) {
			$ans[$i]=$_POST['ans'.$i];
			if($ans[$i])
					{
						$nr++;
						$this->modAddRec($this->lang_qcontent_table,array('answer'=>$ans[$i],'qid'=>$qid,'ord'=>$nr));
					}
			$i++;
		}

		$question=isset($_POST['question'])?$_POST['question']:'';
		$maxopt=isset($_POST['maxopt'])?$_POST['maxopt']:'';
		$minopt=isset($_POST['minopt'])?$_POST['minopt']:'';
		$showopt=isset($_POST['showopt'])?$_POST['showopt']:'';
		if(!$question||!$maxopt||$maxopt==1)
		{
			$this->error=1;
			$this->modSmartyAssign('error',1);
			return $this->showEditQuestions($qid);
		}
		$this->modEditRec($this->lang_qquestion_table,array('question'=>$question,'maxopt'=>$maxopt,'minopt'=>$minopt,'showopt'=>$showopt),array('qid'=>$qid));
	}
   	}

	$row = $this->modGetRow($this->lang_qquestion_table,array('qid'=>$qid));

	$this->modSmartyAssign('question',$row['question']);
   	$this->modSmartyAssign('sid',$this->getSectionID($qid));
   	$this->modSmartyAssign('qid',$qid);
   	$this->modSmartyAssign('type',"questiontype".$row['type']);
   	$this->modSmartyAssign('maxopt',$row['maxopt']);
   	$this->modSmartyAssign('minopt',$row['minopt']);
   	$this->modSmartyAssign('showopt',$row['showopt']);

   	if(isset($_POST['addbtn'])) {
		$add=isset($_POST['add'])?$_POST['add']:'';
   		for($i=0;$i<$add;$i++)
   			$answer[$i]="ans$i";
   		$this->modSmartyAssign('answer',$answer);
	}

  	$this->modSmartyAssign('data',$this->osDB->getAll("SELECT * FROM ! WHERE qid=? ORDER BY ord",array(DB_PREFIX."_".$this->lang_qcontent_table,$qid)) );
   	$text=$this->modSmartyFetch("admin/showqcontent.tpl");
	unset($row, $answer);
   	return $text;
   }

  /**
   * Adds new question in section with id $sid; Returns error if there is one
   * Other parameters: $question=Question text;
   * 				   $type = question type : 1- Radio-Buttons; 2- Check-Boxes; 3- Text;
   * 				   $maxopt = Max Option;
   *
   * @return string
   * @access public
   */

	function addQuestion($sid,$question,$type,$maxopt,$minopt,$showopt)
	{
		$number=$this->modGetOne($this->lang_qquestion_table,array('sid'=>$sid),'count(*)');
		$number++;
		if(!$minopt)$minopt=0;
		if($type==1 && !$showopt) $showopt=0;
		if($type==2 && !$showopt) $showopt=4;
		if(!$question || !$maxopt||$maxopt==1) {$this->modSmartyAssign('error',1);
			$data2['showopt']=$showopt;
			$data2['maxopt']=$maxopt;
			$data2['minopt']=$minopt;
			$data2['question']=$question;
			$data2['type']=$type;
			$this->modSmartyAssign('data2',$data2);
			unset($data2);
			return $this->showAddQuestion($sid);
		}
		$this->modAddRec($this->lang_qquestion_table,array('question'=>$question,'type'=>$type,'sid'=>$sid,'maxopt'=>$maxopt,'ord'=>$number,'minopt'=>$minopt,'showopt'=>$showopt));
	}

  /**
   * Does the processing to display a admin page.  Called from plugin.php
   *
   * @return array
   * @access public
   */

   function  displayPluginAdminPage() {

   	$this->modSmartyAssign('lang', $this->modGetLang());
   	$this->modSmartyAssign('plugin_name',$this->plugin_class_name);

	$do=isset($_GET['do'])?$_GET['do']:'';
	if(!$do)
	{
		$text=$this->getSections();
	}

	if($do=="addsection")
	{
		if(isset($_GET['add']))
		{
			$title=isset($_POST['title'])?$_POST['title']:'';
			$this->addSection($title);
			$text=$this->getSections();
		}
	}

	if($do=="delsection")
	{
		$section=isset($_POST['txtid'])?$_POST['txtid']:1;
		$this->deleteSection($section);
		$text=$this->getSections();
	}

	if($do=="editsection")
	{
		if(isset($_POST['edit']))
		{
			$section=isset($_POST['section'])?$_POST['section']:'';
			$title=isset($_POST['title'])?$_POST['title']:'';
			if(!$title)
			{
				$this->error=1;
				$this->modSmartyAssign('error',1);
				$text=$this->showEditSection($section);
			}
			else
			{
				$this->modEditRec($this->lang_qsection_table,array('title'=>$title),array('sid'=>$section));
				$text=$this->getSections();
			}
		}
		else
		{
			$section=isset($_GET['section'])?$_GET['section']:1;
			$text=$this->showEditSection($section);
		}
	}

	if($do=="showquestions")
	{
			$section=isset($_GET['section'])?$_GET['section']:1;
		$text=$this->getQuestions($section);
	}

	if($do=="addquestion")
	{
		if(isset($_GET['add']))
		{
			$sid=isset($_POST['section'])?$_POST['section']:'';
			$question=isset($_POST['question'])?$_POST['question']:'';
			$type=isset($_POST['type'])?$_POST['type']:'';
			$maxopt=isset($_POST['maxopt'])?$_POST['maxopt']:'';
			$minopt=isset($_POST['minopt'])?$_POST['minopt']:'';
			$showopt=isset($_POST['showopt'])?$_POST['showopt']:'';

			$text=$this->addQuestion($sid,$question,$type,$maxopt,$minopt,$showopt);
			if(!$text)
				$text=$this->getQuestions($sid);
		}
		else {
			$section=isset($_GET['section'])?$_GET['section']:1;

		$text=$this->showAddQuestion($section);
		}
	}

		if($do=="delquestion")
	{

		$qid=isset($_POST['txtid'])?$_POST['txtid']:'';
		$section=$this->getSectionID($qid);
		$this->deleteQuestion($qid);
		$text=$this->getQuestions($section);
	}

		if($do=="editquestion")
	{
		$qid=isset($_GET['qid'])?$_GET['qid']:'';
		$text=$this->showEditQuestions($qid);
	}

		if($do=="editanswer")
		{
			if(isset($_POST['edit2']))
			{
				$qcid=isset($_POST['qcid'])?$_POST['qcid']:'';
				$answer=isset($_POST['answer'])?$_POST['answer']:'';
				$this->modEditRec($this->lang_qcontent_table,array('answer'=>$answer),array('qcid'=>$qcid));
				$text=$this->showEditQuestions($this->getQuestionID($qcid));
			}
			else {
			$qcid=isset($_GET['qcid'])?$_GET['qcid']:'';
			$this->modSmartyAssign("data", $this->modGetRow($this->lang_qcontent_table,array('qcid'=>$qcid)));
			$qid=$this->getQuestionID($qcid);
			$section=$this->getSectionID($qid);
			$this->modSmartyAssign('sid', $section);
			$this->modSmartyAssign('qid', $qid);
			$text=$this->modSmartyFetch("admin/answeredit.tpl");
			}
		}

		if ($do=="moveup")
	{
		$section=$_GET['section'];
		$ord=$this->modGetOne($this->lang_qsection_table,array('sid'=>$section),'ord');
		$ord--;
		$ord2=$ord+1;
		$section2=$this->modGetOne($this->lang_qsection_table,array('ord'=>$ord),'sid');
		if($ord)
		{
			$this->modEditRec($this->lang_qsection_table,array('ord'=>$ord),array('sid'=>$section));
			$this->modEditRec($this->lang_qsection_table,array('ord'=>$ord2),array('sid'=>$section2));
		}
		$text=$this->getSections();
	}

			if ($do=="movequp")
	{
		$qid=isset($_GET['qid'])?$_GET['qid']:'';
		$ord=$this->modGetOne($this->lang_qquestion_table,array('qid'=>$qid),'ord');
		$ord--;
		$ord2=$ord+1;
		$sid=$this->getSectionID($qid);
		$qid2=$this->modGetOne($this->lang_qquestion_table,array('ord'=>$ord),'qid');
		if($ord)
		{
			$this->modEditRec($this->lang_qquestion_table,array('ord'=>$ord),array('qid'=>$qid));
			$this->modEditRec($this->lang_qquestion_table,array('ord'=>$ord2),array('qid'=>$qid2));
		}
		$text=$this->getQuestions($sid);
	}

			if ($do=="moveqcup")
	{
		$qcid=isset($_GET['qcid'])?$_GET['qcid']:'';
		$ord=$this->modGetOne($this->lang_qcontent_table,array('qcid'=>$qcid),'ord');
		$ord--;
		$ord2=$ord+1;
		$qid=$this->getQuestionID($qcid);
		$qcid2=$this->modGetOne($this->lang_qcontent_table,array('ord'=>$ord,'qid'=>$qid),'qcid');
		if($ord)
		{
			$this->modEditRec($this->lang_qcontent_table,array('ord'=>$ord),array('qcid'=>$qcid));
			$this->modEditRec($this->lang_qcontent_table,array('ord'=>$ord2),array('qcid'=>$qcid2));
		}
		$text=$this->showEditQuestions($qid);
	}

		if ($do=="movedown")
	{
		$section=isset($_GET['section'])?$_GET['section']:'';
		$ord=$this->modGetOne($this->lang_qsection_table,array('sid'=>$section),'ord');
		$ord++;
		$ord2=$ord-1;
		$section2=$this->modGetOne($this->lang_qsection_table,array('ord'=>$ord),'sid');
		$max=$this->modGetOne($this->lang_qsection_table,array(),'count(*)');
		if($ord<=$max)
		{
			$this->modEditRec($this->lang_qsection_table,array('ord'=>$ord),array('sid'=>$section));
			$this->modEditRec($this->lang_qsection_table,array('ord'=>$ord2),array('sid'=>$section2));
		}

		$text=$this->getSections();
	}

		if ($do=="moveqdown")
	{
		$qid=isset($_GET['qid'])?$_GET['qid']:'';
		$ord=$this->modGetOne($this->lang_qquestion_table,array('qid'=>$qid),'ord');
		$ord++;
		$ord2=$ord-1;
		$sid=$this->getSectionID($qid);
		$qid2=$this->modGetOne($this->lang_qquestion_table,array('ord'=>$ord),'qid');
		$max=$this->modGetOne($this->lang_qquestion_table,array('sid'=>$sid),'count(*)');
		if($ord<=$max)
		{
			$this->modEditRec($this->lang_qquestion_table,array('ord'=>$ord),array('qid'=>$qid));
			$this->modEditRec($this->lang_qquestion_table,array('ord'=>$ord2),array('qid'=>$qid2));
		}
		$text=$this->getQuestions($sid);
	}

		if ($do=="moveqcdown")
	{
		$qcid=isset($_GET['qcid'])?$_GET['qcid']:'';
		$ord=$this->modGetOne($this->lang_qcontent_table,array('qcid'=>$qcid),'ord');
		$qid=$this->getQuestionID($qcid);
		$ord++;
		$ord2=$ord-1;
		$qcid2=$this->modGetOne($this->lang_qcontent_table,array('ord'=>$ord,'qid'=>$qid),'qcid');
		$max=$this->modGetOne($this->lang_qcontent_table,array('qid'=>$qid),'count(*)');
		if($ord<=$max)
		{
			$this->modEditRec($this->lang_qcontent_table,array('ord'=>$ord),array('qcid'=>$qcid));
			$this->modEditRec($this->lang_qcontent_table,array('ord'=>$ord2),array('qcid'=>$qcid2));
		}
		$text=$this->showEditQuestions($qid);
	}

	return $text;
   }
}
?>