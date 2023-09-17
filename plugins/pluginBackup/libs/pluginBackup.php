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
 * class pluginBackup
 *
 *
 *
 *
 */
include_once(MODOSDATE_DIR . 'modPlugin.php');

class pluginBackup extends modPlugin {

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
   * Holds the user name
   *
   * @access private
   */
   var $username;

   /**
   * Timestamp
   *
   * @access private
   */
   var $time;

   /**
   * Backup Table
   *
   * @access private
   */
   var $lang_backup_table = "pluginBackup_backup";

   /**
   * The name name of the plugin class.
   *
   * @access private
   */
   var $plugin_class_name = "pluginBackup";

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
  function pluginBackup()
  {

    $this->modPlugin();
	$pluginDir = dirname(__FILE__).'/../';
	$this->lang = $this->modLoadLang($pluginDir);
  	$this->user_menu_text=$this->lang['user_title'];
  	$this->display_name=$this->lang['user_title'];
  } // end of member method pluginClass

  function getHash()
  {
  	$vars=array(
		0 => md5(36*$this->time),
		1 => md5(12*$this->time),
		2 => md5(24*$this->time),
		3 => md5(16*$this->time),
		4 => md5(32*$this->time),
		5 => md5(128*$this->time),
		6 => md5(64*$this->time),
		7 => md5(512*$this->time),
		8 => md5(256*$this->time),
		9 => md5(374*$this->time)
		);
	$var=substr(time(),(strlen(time())-1));
	return $vars[$var];
  }

   /**
   * Backup main function
   *
   * @return none
   * @access public
   */
  function backup()
  {
  	$date=date("Y_m_d_H_i_s",$this->time);
  	$hash=$this->getHash();
  	$max=$this->getOne("SELECT count(*) FROM ! WHERE ts>? AND uid=?",array($this->lang_backup_table,$this->time-$this->config['backup_limit_time'],$this->uid));
	$error=1;
  	if($max<$this->config['backup_limit_op'])
	{
  	$file=TEMP_DIR."backup_{$hash}_{$this->uid}_{$date}.xml";
  	$this->modSmartyAssign('path',"temp/backup_{$hash}_{$this->uid}_{$date}.xml");
	$this->modSmartyAssign('hash',$hash);
  	$this->modSmartyAssign('ts',$this->time);

  	$ok=1;
	$text=$this->modSmartyFetch("xmltop.tpl");
	if(isset($_POST['b1']) && $_POST['b1'] != '' ) {$text.=$this->backup1();$ok=0;}
	if(isset($_POST['b2']) && $_POST['b2'] != '' ) {$text.=$this->backup2();$ok=0;}
	if(isset($_POST['b3']) && $_POST['b3'] != '' ) {$text.=$this->backup3();$ok=0;}
	if(isset($_POST['b4']) && $_POST['b4'] != '' ) {$text.=$this->backup4();$ok=0;}
	if(isset($_POST['b5']) && $_POST['b5'] != '' ) {$text.=$this->backup5();$ok=0;}
	if(isset($_POST['b6']) && $_POST['b6'] != '' ) {$text.=$this->backup6();$ok=0;}
	if($ok)
		return $this->modSmartyFetch("backuprestore.tpl");

	$text.=$this->modSmartyFetch("xmlbottom.tpl");

	$handle=fopen("$file","w");
	fwrite($handle,$text);
	fclose($handle);
	$this->query("INSERT INTO !(hash,uid,ts,size) VALUES(?,?,?,?)",array($this->lang_backup_table,$hash,$this->uid,$this->time,filesize($file)));
	$file2="backup_{$hash}_{$this->uid}_{$date}.xml";

header('Content-type: application/xml');
header("Content-Disposition: attachment; filename=\"$file2\"");
readfile($file);
exit;
	$error=0;
	}

	if($error)
	{
		$this->modSmartyAssign('error',$error);
		return $this->modSmartyFetch("backup2.tpl");
	}
	else return $this->modSmartyFetch("backuprestore.tpl");
  }

   /**
   * Remove certain fields from an array
   *
   * @return none
   * @access public
   */
  function except($data,$fields)
  {
  	foreach($data as $item=>$key)
  	{
  		if(!in_array($item,$fields)) {
			if (is_array($key)) {
				$k = array();
				foreach($key as $kx => $v) {
					$k[$kx]= htmlspecialchars($v);
				}
				$data2[$item]=$k;
			} else {
				$data2[$item]=htmlspecialchars($key);
			}
		}
  	}
  	return $data2;
  }

   /**
   * Backup the profile data of user
   *
   * @return none
   * @access public
   */
  function backup1()
  {
  	$profile=$this->modGetProfile(array('id'=>$this->uid));

	$data=$this->getRow("SELECT * FROM ".USER_TABLE." WHERE id='$this->uid'");
	$fields=array('id','active','username','password','lastvisit','regdate','level','rank','actkey','picture','status','levelend'); //except these fields
	$data=$this->except($data,$fields);
	$this->modSmartyAssign('data',$data);

	$data2=$this->getAll("SELECT * FROM ".USER_PREFERENCE_TABLE." WHERE userid='$this->uid' ORDER BY questionid ASC");
	$this->modSmartyAssign('data2',$data2);

	$data3=$this->getAll("SELECT * FROM ".USER_CHOICES_TABLE." WHERE userid='$this->uid'");
	$fields=array('id','userid','last_act_value','last_act_date');
	$data3=$this->except($data3,$fields);
	$this->modSmartyAssign('data3',$data3);

	$text=$this->modSmartyFetch('xmlbackup1.tpl');
	return $text;

  }

   /**
   * Backup pictures
   *
   * @return none
   * @access public
   */
  function backup2()
  {
  	$data=$this->getAll("SELECT * FROM ".USER_SNAP_TABLE." WHERE userid='$this->uid'");
  	$this->modSmartyAssign("data",$data);
  	$text=$this->modSmartyFetch('xmlbackup2.tpl');
  	return $text;
  }

   /**
   * Backup messages
   *
   * @return none
   * @access public
   */
  function backup3()
  {
  	$data=$this->getAll("SELECT * FROM ".MAILBOX_TABLE." WHERE owner='$this->uid'");
  	$fields=array('id','owner');
  	foreach ($data as $item=>$key)
  	{
  		$item2=$this->except($key,$fields);
  		$data[$item]=$item2;
  	}
  	$this->modSmartyAssign("data",$data);
  	$text=$this->modSmartyFetch('xmlbackup3.tpl');

  	return $text;
  }

   /**
   * Backup views & winks
   *
   * @return none
   * @access public
   */
  function backup4()
  {
  	$data=$this->getAll("SELECT * FROM ".VIEWS_WINKS_TABLE." WHERE userid='$this->uid'");
  	$fields=array('id','userid');
  	foreach ($data as $item=>$key)
  	{
  		$item2=$this->except($key,$fields);
  		$data[$item]=$item2;
  	}
  	$this->modSmartyAssign("data",$data);
  	$text=$this->modSmartyFetch('xmlbackup4.tpl');

  	return $text;
  }

   /**
   * Backup buddy & ban list
   *
   * @return none
   * @access public
   */
  function backup5()
  {
  	$data=$this->getAll("SELECT * FROM ".BUDDY_BAN_TABLE." WHERE userid='$this->uid'");
  	$fields=array('id','userid');
  	foreach ($data as $item=>$key)
  	{
  		$item2=$this->except($key,$fields);
  		$data[$item]=$item2;
  	}
  	$this->modSmartyAssign("data",$data);
  	$text=$this->modSmartyFetch('xmlbackup5.tpl');

  	return $text;
  }

   /**
   * Backup blog data
   *
   * @return none
   * @access public
   */
  function backup6()
  {
	$data=$this->getRow("SELECT * FROM ".BLOG_PREFERENCES_TABLE." WHERE userid='$this->uid'");
	$fields=array('id','userid','adminid'); //except these fields
	$data=$this->except($data,$fields);
	$this->modSmartyAssign('data',$data);

	$data=$this->getAll("SELECT * FROM ".BLOG_STORY_TABLE." WHERE userid='$this->uid'");
	$fields=array('id','userid','adminid','views'); //except these fields
  	foreach ($data as $item=>$key)
  	{
  		$item2=$this->except($key,$fields);
  		$item2['title']=htmlspecialchars($item2['title']);
  		$item2['story']=htmlspecialchars($item2['story']);
  		$data[$item]=$item2;
  	}
  	$this->modSmartyAssign("data2",$data);
	$text=$this->modSmartyFetch('xmlbackup6.tpl');

  	return $text;
  }

/**
 * XML Parser
 * $data will contain the parsed xml file
 */

   var $parser;
   var $data = array();
   var $datas = array();

   function parse($data)
   {
       $this->parser = xml_parser_create('UTF-8');
       xml_set_object($this->parser, $this);
       xml_parser_set_option($this->parser, XML_OPTION_SKIP_WHITE, 1);
       xml_set_element_handler($this->parser, 'tag_open', 'tag_close');
       xml_set_character_data_handler($this->parser, 'cdata');
       xml_parse($this->parser, $data);
           $this->data = $this->data['child'];
       xml_parser_free($this->parser);
   }

   function tag_open($parser, $tag, $attribs)
   {
       $this->data['child'][$tag][] = array('data' => '', 'attribs' => $attribs, 'child' => array());
       $this->datas[] = $this->data;
       $this->data = $this->data['child'][$tag][count($this->data['child'][$tag])-1];
   }

   function cdata($parser, $cdata)
   {
       $this->data['data'] .= $cdata;
   }

   function tag_close($parser, $tag)
   {
       $this->data = $this->datas[count($this->datas)-1];
       array_pop($this->datas);
   }

   /**
   * Restores by parsing the uploaded file
   *
   * @return none
   * @access public
   */

  function restore()
  {
	//geting vars
	$file=$_FILES['userfile']['name'];
	$fis=explode(".",$file);
	$file=explode("_",$fis[0]);
	$size=$_FILES['userfile']['size'];

	//getting restoration file content
	$restoreFile = TEMP_DIR."restore_{$hash}_{$this->uid}.xml";
	move_uploaded_file($_FILES['userfile']['tmp_name'], $restoreFile);
	$handle=fopen($restoreFile,"r");
	$content=fread($handle,filesize($restoreFile));
	fclose($handle);
	unlink($restoreFile);

	// parsing restoration file
	$this->parse($content);
	if ($this->datas)
		$data=$this->datas;
	else $data=$this->data;

	//testing if file is valid
	$error=0;

	if ($data[0]['child']['DATA'])	 $data=$data[0]['child'];

	$userid=$data['DATA']['0']['attribs']['USERID'];
	$hash=$data['DATA']['0']['attribs']['HASH'];
	$rtime=$data['DATA']['0']['attribs']['TS'];

	$data=$data['DATA'][0]['child'];

	if($userid!=$this->uid) $error=1;
	$max=$this->getRow("SELECT * FROM ! WHERE uid=? AND hash=? AND size=? AND ts=?",array($this->lang_backup_table,$this->uid,$hash,$size,$rtime));
	if(!$max) $error=1;
	if($fis[1]!="xml") $error=1;
	if($error==0)
	{
	//restoring personal profile
	$p1=$data['PERSONAL_DETAILS'][0]['child'];
	if ($p1)
	{
		//print_r($p1);
		$fields=array('id','active','username','password','lastvisit','regdate','level','rank','actkey','picture','status','levelend'); //except these fields
		foreach ($p1 as $field => $key)
		{
			$fielddata=$key[0]['data'];
			$field=strtolower($field);
			if(!in_array($field,$fields))
				$this->query("UPDATE ".USER_TABLE." SET $field='$fielddata' WHERE id='{$this->uid}'");
		}
	}

	$p2=$data['USER_PREFERENCE'][0]['child']['QUESTION'];
	if($p2)
	{
		$this->query("DELETE FROM ".USER_PREFERENCE_TABLE." WHERE userid='{$this->uid}'");
		foreach($p2 as $field => $key)
		{
			$questionid=$key['attribs']['ID'];
			$answer=$key['attribs']['ANSWERID'];
			$this->query("INSERT INTO ".USER_PREFERENCE_TABLE."(userid,questionid,answer) VALUES('{$this->uid}','{$questionid}','{$answer}')");
		}

	}

	$p3=$data['PICS'][0]['child']['SNAP'];
	if ($p3)
	{
		$this->query("DELETE FROM ".USER_SNAP_TABLE." WHERE userid='{$this->uid}'");
		$fields=array('id');
		foreach ($p3 as $item)
		{
			$pic['picno']=$item['attribs']['ID'];
			foreach ($item['child'] as $item2=>$key2)
				$pic[$item2]=$key2[0]['data'];
			$field="";
			$values="";
			$pic['userid']=$this->uid;
			foreach ($pic as $item=>$key)
			{
				if(!in_array($item,$fields))
				{
					$field.=strtolower($item).",";
					$values.="'".$key."',";
				}
			}
			$field="(".substr($field,0,strlen($field)-1).")";
			$values="(".substr($values,0,strlen($values)-1).")";
			$query="INSERT INTO ".USER_SNAP_TABLE."$field VALUES$values";
			$this->query($query);
		}
	}

	$p4=$data['MAILBOX'][0]['child']['MESSAGE'];
	if($p4)
	{
		$this->query("DELETE FROM ".MAILBOX_TABLE." WHERE owner='{$this->uid}' AND sendtime<'$rtime'");
		$fields=array('id');
		foreach ($p4 as $item) {
			foreach ($item['child'] as $item2=>$key2)
				$mailbox[$item2]=$key2[0]['data'];
			$field="";
			$values="";
			$mailbox['owner']=$this->uid;
			foreach ($mailbox as $item=>$key)
			{
				if(!in_array($item,$fields))
				{
					$field.=strtolower($item).",";
					$values.="'".$key."',";
				}
			}
			$field="(".substr($field,0,strlen($field)-1).")";
			$values="(".substr($values,0,strlen($values)-1).")";
			$query="INSERT INTO ".MAILBOX_TABLE."$field VALUES$values";
			$this->query($query);
		}
	}
	$p5=$data['WINKS'][0]['child']['WINK'];
	if($p5)
	{
		$this->query("DELETE FROM ".VIEWS_WINKS_TABLE." WHERE userid='{$this->uid}' AND act_time<'$rtime'");
		$fields=array('id');
		foreach ($p5 as $item=>$key)
		{
			foreach ($key['child'] as $item2=>$key2)
				$wink[$item2]=$key2[0]['data'];
			$field="";
			$values="";
			$wink['userid']=$this->uid;
			foreach ($wink as $item=>$key)
			{
				if(!in_array($item,$fields))
				{
					$field.=strtolower($item).",";
					$values.="'".$key."',";
				}
			}
			$field="(".substr($field,0,strlen($field)-1).")";
			$values="(".substr($values,0,strlen($values)-1).")";
			$query="INSERT INTO ".VIEWS_WINKS_TABLE."$field VALUES$values";
			$this->query($query);
		}
	}
	$p6=$data['BUDDYBANHOTLIST'][0]['child']['ITEM'];
	if ($p6)
	{
		$this->query("DELETE FROM ".BUDDY_BAN_TABLE." WHERE userid='{$this->userid}' AND act_date<'$rtime'");
		foreach ($p6 as $item=>$key) {
			$act=$key['child']['ACT']['0']['data'];
			$ref_userid=$key['child']['REF_USERID']['0']['data'];
			$act_date=$key['child']['ACT_DATE']['0']['data'];
			$this->query("INSERT INTO ".BUDDY_BAN_TABLE."(userid,act,ref_userid,act_date) VALUES('$this->uid','$act','$ref_userid','$act_date')");
		}
	}

	$p7=$data['BLOG_PREFERENCE'][0]['child'];
	if($p7)
	{
		$this->query("DELETE FROM ".BLOG_PREFERENCES_TABLE." WHERE userid='$this->uid'");
		$fields=array('id','userid','adminid'); //except these fields
		$this->query("INSERT INTO ".BLOG_PREFERENCES_TABLE."(userid) VALUES('$this->uid')");
		foreach ($p7 as $item => $key)
		{
			$value=$key['0']['data'];
			if(!in_array($item,$fields))
				$this->query("UPDATE ".BLOG_PREFERENCES_TABLE." SET $item='$value' WHERE userid='{$this->uid}'");
		}
	}

	$p8=$data['BLOG_STORY'][0]['child'];
	if($p8)
	{
		$this->query("DELETE FROM ".BLOG_STORY_TABLE." WHERE userid='{$this->uid}'");
		$fields=array('id','userid','adminid','views'); //except these fields
		foreach ($p8 as $item=>$key)
		{
			$field="";
			$values="";
			foreach ($key[0]['child'] as $item2=>$key2)
			{
				if(!in_array($item2,$fields))
				{
					$field.=strtolower($item2).",";
					$values.="'".$key2[0]['data']."',";
				}
			}
			$field="({$field}userid)";
			$values="({$values}$this->uid)";
			$query="INSERT INTO ".BLOG_STORY_TABLE."$field VALUES$values";
			$this->query($query);
		}
	}
	$p9=$data['USER_CHOICES'][0]['child'];
	if($p9)
	{
		$this->query("DELETE FROM ".USER_CHOICES_TABLE." WHERE userid='{$this->uid}'");
		foreach ($p9 as $item=>$key)
		{
			$iteml=strtolower($item);
			$this->query("INSERT INTO ".USER_CHOICES_TABLE."(userid,choice_name,choice_value) VALUES('{$this->uid}','{$iteml}','{$key['0']['data']}')");
		}
	}
	}
  	$this->modSmartyAssign("error",$error);
	return  $this->modSmartyFetch("restore2.tpl");

  }

   /**
   * Deletes backup files from temp folder which are have been made by more than $this->config['backup_save_time'] seconds.
   *
   * @return none
   * @access public
   */

  function deleteBackupFiles()
  {
  	$time=time()-$this->config['backup_save_time'];
  	$data=$this->getAll("SELECT * FROM ! WHERE deleted=? AND ts<?",array($this->lang_backup_table,0,$time));
  	foreach ($data as $row)
  	{
  		$hash=$row['hash'];
  		$ts=$row['ts'];
  		$bid=$row['id'];
  		$uid=$row['uid'];
  		$date=date("Y_m_d_H_i_s",$ts);
  		$file=TEMP_DIR."backup_{$hash}_{$uid}_{$date}.xml";
		if (file_exists($file)){
	  		unlink($file);
		}
  		$this->query("UPDATE ! SET deleted=? WHERE id=?",array($this->lang_backup_table,1,$bid));
  	}
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
   	 $this->modSmartyAssign('udata',$udata);
	 $this->uid=$udata['id'];
	 $this->username=$udata['username'];
	 $this->time=time();
	 include LANG_DIR."lang_".$this->modGetLoadedLanguage()."/profile_questions.php";
	 $this->modSmartyAssign('question',$profile_questions);

	 $text=$this->modSmartyFetch("backuprestore.tpl");

	 $this->deleteBackupFiles();

   	 if(isset($_POST['backup']) && $_POST['backup'] ==1)
   	 	$text=$this->backup();
   	 if(isset($_POST['restore']) && $_POST['restore']==1)
   	 	$text=$this->restore();

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