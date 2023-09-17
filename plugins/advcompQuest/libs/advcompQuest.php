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

class advcompQuest extends modPlugin {

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
   var $plugin_class_name = "advcompQuest";

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
   var $display_name = "Advanced Compatability Questionnaire";

   /**
   * Table that holds the sections
   *
   * @access private
   */
   var $lang_qsection_table = 'advcompQuest_section';

   /**
   * Table that holds the questions
   *
   * @access private
   */
   var $lang_qquestion_table = 'advcompQuest_question';

   /**
   * Table that holds the questions content
   *
   * @access private
   */
   var $lang_qcontent_table = 'advcompQuest_content';

   /**
   * The link text that appears on the user's menu
   *
   * @access private
   */
   var $user_menu_text  = "Advanced Compatability Questionnaire";

   /**
   * Table that holds the banners
   *
   * @access private
   */
   var $lang_qanswer_table = 'advcompQuest_answer';

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
   var $admin_menu_text  = "Advanced Compatability Questionnaire";

   /**
   * Appear on admin's menu (true or false)
   *
   * @access private
   */
   var $admin_menu_appear = true;
   var $osDB;
   var $quest_answers=array();
   var $type2array = array();
   /**
   * Constructor
   *
   * @return
   * @access public
   */
  function advcompQuest( )
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

  function showQuestion($question, $ok)
  {
	$data = $this->modGetAll($this->lang_qquestion_table,array('qid'=>$question));
	$text = '';
	foreach ($data as $item)
	{
		$this->quest_answers = array();
 	/* Now take answers for each question - Vijay Nair */
		$ans = $this->modGetAll($this->lang_qcontent_table,array('qid'=>$item['qid']),'ord');
		$answers = array();
		foreach($ans as $ansitem) {
			$answers[$ansitem['qcid']]['descr'] = $ansitem['answer'];
		}
	/* Now update the array with logged in user's response - Vijay Nair */

		if ($ok == '0') {
			$uans = $this->type2array;
		} else {
			$uans = $this->modGetAll($this->lang_qanswer_table, array('uid'=>$this->uid, 'qid'=>$item['qid']));
		}
		foreach($uans as $uanswer){
			if ($uanswer['qid'] == $item['qid']) {
				$answers[$uanswer['qcid']]['answer']=$uanswer['answer'];
			}
		}
		if(isset($_SESSION['advcompQuest']['lookuser']) && $_SESSION['advcompQuest']['lookuser'] != $this->uid ) {
	/* Now update the array with compared user's responses - Vijay Nair */
			$uans = $this->modGetAll( $this->lang_qanswer_table,array('uid'=>$_SESSION['advcompQuest']['lookuser'],'qid'=>$item['qid']));
			foreach($uans as $uanswer){
				$answers[$uanswer['qcid']]['comp_answer']=$uanswer['answer'];
			}
		}

		if ($item['maxopt'] == '2' && $item['type'] == '1') {
	/* This is Yes/No answer type - Yes=1 and No=0*/
			$item['type']='3';
		}

		$item['answers'] = $answers;
		$this->quest_answers = $item;
		$this->modSmartyAssign('item',$this->quest_answers);

	 	if($item['type']==1 )
	 	{
			$this->modSmartyAssign('opts',array('1','2','3','4','5','6','7') );
			$this->modSmartyAssign('colspan','3');
			$text2 =  $this->modSmartyFetch("questiontype1.tpl");
	 	} elseif ($item['type']==2)
	 	{
			$showopt=($this->quest_answers['showopt']>0)?$this->quest_answers['showopt']:"4";
			$this->modSmartyAssign('colwidth',100/$showopt);
			$this->modSmartyAssign('showopt',$showopt);
			$text2 = $this->modSmartyFetch("questiontype2.tpl");
	 	} elseif ($item['type']==3)
	 	{
			$text2=	$this->modSmartyFetch("questiontype3.tpl");

	 	}

	 	$text.= isset($text2)?$text2:'';
	}
	$this->modSmartyAssign('question', $question);

	 return $text;
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
		$this->uid=$_SESSION['UserId'];
		if (isset($_GET['matchusers']) && $_GET['matchusers'] == '1') {
			return $this->displayMatchResults();
		}
		$ok=1;

		if (isset($_POST['continue']) ) {
		/* Selected items and Saving  */
			$sid = $_POST['sid'];
			$qid = $_POST['qid'];
			$section = $_POST['section'];
			$item = $this->modGetRow($this->lang_qquestion_table,array('qid'=>$qid));

			$this->modDeleteRows($this->lang_qanswer_table, array('qid'=>$qid, 'uid'=>$this->uid));
			$ans = $this->modGetAll($this->lang_qcontent_table,array('qid'=>$qid),'ord');
			$max=count($ans);
			$i=0;
			$minopt=$item['minopt'];
			$maxopt=$item['maxopt'];
			if ($item['maxopt'] == '2' && $item['type'] == '1') {
		/* This is Yes/No answer type - Yes=1 and No=0*/
				$item['type']='3';
			}

			if($item['type']=='1' || $item['type'] == '3')
			{
				foreach($ans as $answer)
				{
					$qcid=$answer['qcid'];
					$checkid = 'q'.$qid."_".$qcid;
					$resp=isset($_POST[$checkid])?$_POST[$checkid]:false;
					if($resp) {
						$i++;
						$this->modAddRec($this->lang_qanswer_table,array('qid'=>$qid,'qcid'=>$qcid,'answer'=>$resp,'uid'=>$this->uid));
					}
				}
			} elseif($item['type']=='2'){

				foreach($ans as $answer)
				{
					$qcid=$answer['qcid'];
					$checkid = 'q'.$qid."_".$qcid;
					if(isset($_POST[$checkid]) && $_POST[$checkid] )
					{
						$i++;
					}
				}

				if($i<$minopt||$i>$maxopt) {
					$ok=0;
				}
				foreach($ans as $answer)
				{
					$qcid=$answer['qcid'];
					$checkid = 'q'.$qid."_".$qcid;
					if(isset($_POST[$checkid]) && $_POST[$checkid] )
					{
						if ($ok == '0') {
							$rec=array();
							$rec['qid'] = $qid;
							$rec['qcid'] = $qcid;
							$rec['answer']='1';
							$rec['uid'] = $this->uid;
							$this->type2array[]=$rec;
							unset($rec);
						} else {
							$this->modAddRec($this->lang_qanswer_table, array('qid'=>$qid, 'qcid'=>$qcid, 'answer'=>1, 'uid'=>$this->uid ) );
						}
					}
				}

			}

			if($ok != '0' ){
				$qord = $item['ord']+1;
				$nxtrow = $this->modGetRow($this->lang_qquestion_table,array('sid'=>$sid, 'ord'=>$qord));

				if (isset($nxtrow) && isset($nxtrow['qid']) && $nxtrow['qid'] > 0) {
					$question = $nxtrow['qid'];
				} else {
					$section++;
					$question='0';
				}
				$_REQUEST['qid']='0';
			}
		}
		if(!isset($section)) $section=1;
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

			if (isset($_GET['spage']) && $_GET['spage'] > 0 ) {
				$section= $_GET['spage'];
				if (!isset($_GET['lookuser']) ) unset($_SESSION['advcompQuest']['lookuser']);
			} elseif (!isset($section)) $section=1;

			if (isset($_REQUEST['qid']) && $_REQUEST['qid'] > 0) {
				$question = $_REQUEST['qid'];
			} elseif (!isset($question)) $question=0;

			$allsections = $this->modGetAll($this->lang_qsection_table,array());
			$section_row = $this->modGetRow($this->lang_qsection_table, array("ord"=>$section));
			$this->modSmartyAssign('allsections', $allsections) ;
			$sid=$section_row['sid'];
			$data = $this->modGetAll($this->lang_qquestion_table,array('sid'=>$sid),'ord');
			$this->modSmartyAssign('allquestions', $data);
			$question = $qid = ($question=='0')?$data[0]['qid']:$question;
			$this->modSmartyAssign('question', $question);
			$title=$section_row['title'];
			$this->modSmartyAssign('title',$title);
			$this->modSmartyAssign('ok',$ok);
			$this->modSmartyAssign('sid',$sid);
			$this->modSmartyAssign('section',$section);
			if(isset($_REQUEST['lookuser']) && $_REQUEST['lookuser']!= '' ) {
				$this->modSmartyAssign('lookuser',$_REQUEST['lookuser']);
				$lookuser = $this->modGetAllUsers(array('username'=>$_REQUEST['lookuser']));
				if($lookuser) {
					$_SESSION['advcompQuest']['lookuser']=$lookuser[0]['id'];
					$this->modSmartyAssign('lookid',$lookuser[0]['id']);
				} elseif (isset($_SESSION['advcompQuest']['lookuser'])) {
					$eds = $this->modGetUser(array('userid'=>$_SESSION['advcompQuest']['lookuser']));
					$this->modSmartyAssign('lookuser',$eds['username']);
					$this->modSmartyAssign('lookid',$eds['id']);
				}
			}

			if((isset($_SESSION['advcompQuest']['lookuser']) && $_SESSION['advcompQuest']['lookuser'] != $this->uid) ) {

				$this->modSmartyAssign('ou',1);
				$sectcount = $total_mycount = $total_uanscnt = $total_perfect_matchcnt = $total_matchcnt = 0;
				$sect_mycount = $sect_uanscnt = $sect_perfect_matchcnt = $sect_matchcnt = 0;
				$quest_mycount = $quest_uanscnt = $quest_perfect_matchcnt = $quest_matchcnt = 0;
				
				/* First calculate overall matching */
				foreach ($allsections as $sect_row) {
					$qstrecs = 	$this->modGetAll($this->lang_qquestion_table, array('sid'=>$sect_row['sid']) );
					foreach ($qstrecs as $quest)
					{
						$data2 = $this->modGetAll($this->lang_qanswer_table,array('qid'=>$quest['qid'],'uid'=>$this->uid));
						$total_mycount += count($data2);
						if (count($data2) > 0) $sectcount++;
						if ($quest['sid'] == $sid) $sect_mycount += count($data2);
						if ($quest['qid'] == $question) $quest_mycount += count($data2);
						$uans = $this->modGetAll($this->lang_qanswer_table,array('qid'=>$quest['qid'],'uid'=>$_SESSION['advcompQuest']['lookuser']));
						$total_uanscnt += count($uans);
						if ($quest['sid'] == $sid) $sect_uanscnt += count($uans);
						if ($quest['qid'] == $question) $quest_uanscnt += count($uans);
						unset($uans);
						foreach ($data2 as $item2)
						{
							$qid=$item2['qid'];
							$qcid=$item2['qcid'];
							$datax = $this->modGetRow($this->lang_qanswer_table, array('qid'=>$qid,'qcid'=>$qcid, 'uid'=>$_SESSION['advcompQuest']['lookuser']));
							if(isset($datax['answer']) && $datax['answer'] > 0 ) {
								if (($quest['type'] == '2' && $datax['answer'] == $item2['answer']) || ( $quest['type'] == '1' && $quest['maxopt'] == '2' && $datax['answer'] == $item2['answer']) ) {
									$total_matchcnt++;
									if ($quest['sid'] == $sid) $sect_matchcnt++;
									if ($item2['qid'] == $question) $quest_matchcnt++;
									$total_perfect_matchcnt++;
									if ($quest['sid'] == $sid) $sect_perfect_matchcnt++;
									if ($item2['qid'] == $question) $quest_perfect_matchcnt++;
								} elseif ($quest['type']=='1') {
									if ($item2['answer'] == $datax['answer']) {
										$total_perfect_matchcnt++;
										if ($quest['sid'] == $sid) $sect_perfect_matchcnt++;
										if ($item2['qid'] == $question) $quest_perfect_matchcnt++;
									}
									if (($item2['answer'] == '1' || $item2['answer'] == '2') && ($datax['answer'] == '1' || $datax['answer'] == '2') ) {
										$total_matchcnt++;
										if ($quest['sid'] == $sid) $sect_matchcnt++;
										if ($item2['qid'] == $question) $quest_matchcnt++;
									} elseif ( ($item2['answer'] == '3' || $item2['answer'] == '4' || $item2['answer']=='5') && ($datax['answer'] == '3' || $datax['answer'] == '4' || $datax['answer'] == '5' ) ) {
										$total_matchcnt++;
										if ($quest['sid'] == $sid) $sect_matchcnt++;
										if ($item2['qid'] == $question) $quest_matchcnt++;
									} elseif (($item2['answer'] == '6' || $item2['answer'] == '7') && ($datax['answer'] == '6' || $datax['answer'] == '7') ) {
										$total_matchcnt++;
										if ($quest['sid'] == $sid) $sect_matchcnt++;
										if ($item2['qid'] == $question) $quest_matchcnt++;
									}
								}
							}
						}
						unset($data2);
					}
				}
				$this->modSmartyAssign('sectcount',$sectcount);
				$this->modSmartyAssign('total_mycount',$total_mycount);
				$this->modSmartyAssign('sect_mycount',$sect_mycount);
				$this->modSmartyAssign('quest_mycount',$quest_mycount);
				$this->modSmartyAssign('total_uanscnt',$total_uanscnt);
				$this->modSmartyAssign('sect_uanscnt',$sect_uanscnt);
				$this->modSmartyAssign('quest_uanscnt',$quest_uanscnt);
				$this->modSmartyAssign('total_perfect_matchcnt',$total_perfect_matchcnt);
				$this->modSmartyAssign('sect_perfect_matchcnt',$sect_perfect_matchcnt);
				$this->modSmartyAssign('quest_perfect_matchcnt',$quest_perfect_matchcnt);
				$this->modSmartyAssign('total_matchcnt',$total_matchcnt);
				$this->modSmartyAssign('sect_matchcnt',$sect_matchcnt);
				$this->modSmartyAssign('quest_matchcnt',$quest_matchcnt);
				if ($total_mycount > 0) {
					$this->modSmartyAssign('total_perfect_matchpct', round($total_perfect_matchcnt /$total_mycount * 100 ));
					$this->modSmartyAssign('total_matchpct', round($total_matchcnt / $total_mycount* 100) );
					if ($sect_mycount > 0) {
						$this->modSmartyAssign('sect_perfect_matchpct', round($sect_perfect_matchcnt /$sect_mycount * 100 ));
						$this->modSmartyAssign('sect_matchpct', round($sect_matchcnt / $sect_mycount* 100 ));
						if ($quest_mycount > 0) {
							$this->modSmartyAssign('quest_perfect_matchpct', round($quest_perfect_matchcnt / $quest_mycount * 100 ));
							$this->modSmartyAssign('quest_matchpct', round($quest_matchcnt / $quest_mycount* 100) );
						}
					}
				}

			} else {
				$this->modSmartyAssign('ou',0);
			}
			$this->modSmartyAssign('question', $question);
			$text=$this->modSmartyFetch("sectiontop.tpl");
			$text.=$this->showQuestion($question, $ok);
			$this->modSmartyAssign('smax',$max);
			if(isset($_SESSION['advcompQuest']['lookuser']) && $_SESSION['advcompQuest']['lookuser'] != $this->uid) $this->modSmartyAssign('ok',2);
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
   * Display Match Results
   *
   * This will display the list of users who are matching with logged in users' selected options/
   *
   */

  function displayMatchResults() {
	$totanswer=	$this->modGetOne($this->lang_qanswer_table,array('uid'=> $this->uid),'count(*)' );
	$totoptions = $this->modGetOne($this->lang_qquestion_table,array(),'count(*)' );

	$matchingusers=array();

	/* First get all answers for the user */
	$ansusers = $this->getAll("select distinct a.uid from ! as a, ! as b, ! as q where a.uid <> b.uid and b.uid = ? and a.qid = b.qid and b.qid = q.qid and if(q.type='2',b.qcid,a.qcid)=a.qcid", array($this->lang_qanswer_table,  DB_PREFIX.'_'.$this->lang_qanswer_table,  DB_PREFIX.'_'.$this->lang_qquestion_table, $this->uid) );

	/* Now select questions and answers for the logged in user */
	$qanswers = $this->getAll("select distinct q.qid, if(q.type='1' and q.maxopt='2','3',q.type) as type, a.qcid, a.answer from ! as q, ! as a where a.uid = ? and q.qid = a.qid ",array($this->lang_qquestion_table, DB_PREFIX.'_'.$this->lang_qanswer_table, $this->uid));
	$myanswers = array();
	/* Populate my answers in the array with keys ['qid']['qcid'] */
	foreach($qanswers as $qans) {
		$myanswers[$qans['qid']][$qans['qcid']]['type'] = $qans['type'];
		$myanswers[$qans['qid']][$qans['qcid']]['answer'] = $qans['answer'];
	}
	/* For each of the answered users, calculate percentages */
	foreach ($ansusers as $muser) {
		$matchcnt = $perfmatchcnt = 0;

		$muser_answers = $this->getAll("select distinct q.qid, if(q.type='1' and q.maxopt='2','3',q.type) as type, a.qcid, a.answer from ! as q, ! as a where a.uid = ? and q.qid = a.qid ",array($this->lang_qquestion_table, DB_PREFIX.'_'.$this->lang_qanswer_table, $muser['uid'] ) );
		foreach ($muser_answers as $muans) {
			if (($muans['type'] == '2' or $muans['type'] == '3')  && isset($myanswers[$muans['qid']][$muans['qcid']]['answer'])  && $myanswers[$muans['qid']][$muans['qcid']]['answer'] = $muans['answer']) {
				$matchcnt++;
				$perfmatchcnt++;
			} elseif ($muans['type'] == '1' && isset($myanswers[$muans['qid']][$muans['qcid']]['answer']) ) {
				$myresp = $myanswers[$muans['qid']][$muans['qcid']]['answer'];
				if ($myresp == $muans['answer']) {
					$perfmatchcnt++;
				}
				if ((($myresp == '1' || $myresp== '2') && ($muans['answer']=='1' || $muans['answer']=='2')) || (($myresp == '3' || $myresp== '4' ||  $myresp== '5') && ($muans['answer']=='3' || $muans['answer']=='4' ||  $muans['answer']=='5')) || (($myresp == '6' || $myresp== '7') && ($muans['answer']=='6' || $muans['answer']=='7'))  ) {
					$matchcnt++;
				}
			}
		}
		$matchrec=array();
		$matchrec['uid'] = $muser['uid'];
		$matchrec['answers'] = count($muser_answers);
		$matchrec['matchcnt'] = $matchcnt;
		$matchrec['perfmatchcnt'] = $perfmatchcnt;
		$matchrec['matchpct'] = round($matchcnt / $totanswer * 100);
		$matchrec['perfmatchpct'] = round($perfmatchcnt / $totanswer * 100);
		$usrrec = $this->getRow('select username from '.USER_TABLE." where id = '".$muser['uid']."'");
		$matchrec['username'] = $usrrec['username'];
		$matchingusers[]=$matchrec;
		unset($muser_answers, $muans, $myresp, $matchrec);
	}
	$this->modSmartyAssign('totanswer', $totanswer);
	$this->modSmartyAssign('totoptions', $totoptions);
	$perfmatches=array();
	$matches=array();
	foreach ($matchingusers as $k=>$mtch) {
		$perfmatches[$k]=$mtch['perfmatchpct'];
		$matches[$k]=$mtch['matchpct'];
	}
	array_multisort($perfmatches, SORT_DESC, $matches, SORT_DESC, $matchingusers);
	$this->modSmartyAssign('matchingusers', $matchingusers);
	$text =$this->modSmartyFetch("matchingusers.tpl");
	return $text;
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
		$descr = isset($_POST['descr'])?$_POST['descr']:'';
		$maxopt=isset($_POST['maxopt'])?$_POST['maxopt']:'';
		$minopt=isset($_POST['minopt'])?$_POST['minopt']:'';
		$showopt=isset($_POST['showopt'])?$_POST['showopt']:'';
		if(!$question||!$maxopt||$maxopt==1)
		{
			$this->error=1;
			$this->modSmartyAssign('error',1);
			return $this->showEditQuestions($qid);
		}
		$this->modEditRec($this->lang_qquestion_table,array('question'=>$question,'descr'=>$descr, 'maxopt'=>$maxopt,'minopt'=>$minopt,'showopt'=>$showopt),array('qid'=>$qid));
	}
   	}

	$row = $this->modGetRow($this->lang_qquestion_table,array('qid'=>$qid));

	$this->modSmartyAssign('question',$row['question']);
	$this->modSmartyAssign('descr',$row['descr']);
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
			$data2['descr'] = $descr;
			$data2['type']=$type;
			$this->modSmartyAssign('data2',$data2);
			unset($data2);
			return $this->showAddQuestion($sid);
		}
		$this->modAddRec($this->lang_qquestion_table,array('question'=>$question,'descr'=>$descr, 'type'=>$type,'sid'=>$sid,'maxopt'=>$maxopt,'ord'=>$number,'minopt'=>$minopt,'showopt'=>$showopt));
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
			$descr=isset($_POST['descr'])?$_POST['descr']:'';
			$maxopt=isset($_POST['maxopt'])?$_POST['maxopt']:'';
			$minopt=isset($_POST['minopt'])?$_POST['minopt']:'';
			$showopt=isset($_POST['showopt'])?$_POST['showopt']:'';

			$text=$this->addQuestion($sid,$question,$type,$descr, $maxopt,$minopt,$showopt);
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