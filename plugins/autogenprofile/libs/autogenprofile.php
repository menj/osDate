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
 * class pluginTemplate
 *
 *  A template to get you started building templates.  Rename all pluginTemplate
 *  with the name of your plugin
 *
 *
 *
 */
include_once(MODOSDATE_DIR . 'modPlugin.php');

class autogenprofile extends modPlugin {

   /**
   * Holds the language phrases
   *
   * @access private
   */
   var $lang;

   /**
   * Table with generated users
   *
   * @access private
   */
   var $lang_autogenprofile_table = "autogenprofile_autogenprofile";
   /**
   * Table with generated forms
   *
   * @access private
   */
   var $lang_autogenprofile_forms_table = "autogenprofile_forms";

   /**
   * The name name of the plugin class.
   *
   * @access private
   */
   var $plugin_class_name = "autogenprofile";

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
   var $user_menu_appear = false;


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
   var $osDB;
   /**
   * Constructor
   *
   * @return
   * @access public
   */
  function autogenprofile( )
  {

    $this->modPlugin();
	$this->osDB =& $GLOBALS['osDB'];
	$pluginDir = dirname(__FILE__).'/../';
	$this->lang = $this->modLoadLang($pluginDir);
  	$this->admin_menu_text=$this->lang['user_title'];
  	$this->display_name=$this->lang['user_title'];
  } // end of member method pluginClass


   /**
   * Does the processing to display a user page.  Called from plugin.php
   *
   * @return array
   * @access public
   */
   function  displayPluginPage() {

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

  function getUserName($firstname,$lastname)
  {
  	$len=(strlen($firstname)+strlen($lastname)+mt_rand(0,9999))%10;
  	if($len==1) return substr(trim($firstname).trim($lastname),0,24);
  	if($len==2) return substr(trim($firstname)."_".trim($lastname),0,24);
  	if($len==3) return $firstname[0].trim($lastname);
  	if($len==4) return trim($firstname).$lastname[0];
  	if($len==5) return trim(substr($firstname,0,mt_rand(1,strlen($firstname)))).trim(substr($lastname,0,mt_rand(1,strlen($lastname))));
  	if($len==6) return trim(substr($firstname,0,mt_rand(1,strlen($firstname)))).trim(substr($lastname,0,mt_rand(1,strlen($lastname)))).mt_rand(1,999);
  	if($len==7) return $firstname[0].trim($lastname).mt_rand(1,999);
  	if($len==8) return trim($firstname).$lastname[0].mt_rand(1,999);
  	if($len==9) return trim($firstname)."_".trim(substr($lastname,0,mt_rand(1,strlen($lastname))));
  	if($len==0) return trim($firstname).$lastname[0].mt_rand(1,999);
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
	$file_male="male_firstnames.txt";
	$file_female="female_firstnames.txt";
   	$file_firstname="lastnames.txt";
   	$countries = $this->modGetAllCountries();
   	foreach ($countries as $item => $key)
   	{
   		if($key['code']=="AA") unset($countries[$item]);
/*   Vijay Nair - Want to take cities only for selected countries for generating profiles.
			else {
   			$cities=$this->modGetAllCities($key['code']);
   			if($cities)
   				$city[$key['code']]=$cities;
   		}
*/
   	}
   	$path=PLUGIN_DIR.$this->plugin_class_name."/sample_data/";
//   	$pathimages=TEMP_DIR."profile_images/";
   	$pathimages=$path."profile_images/";


	/* Generation process starts  */
	if(isset($_POST['generate']))
	{
//		@ini_set('time_limit','0');
		//set_time_limit(0);
		//getting data from form
		$opt1=$_POST['opt1']; //number of profiles;
		$opt2=$_POST['opt2']; //percentage of males
		$opt3=$_POST['opt3']; //percentage of females
		$opt4=$_POST['opt4']; //number of countries
		$opt6=$_POST['opt6']; //percentage of age ranges
		$opt8=isset($_POST['opt8'])?$_POST['opt8']:0; 		//percentage of white ethnicity
		$opt9=isset($_POST['opt9'])?$_POST['opt9']:0; 		//percentage of black ethnicity
		$opt10=isset($_POST['opt10'])?$_POST['opt10']:0; 	//percentage of asian ethnicity
		$opt11=isset($_POST['opt11'])?$_POST['opt11']:0; 	//percentage of other ethnicity

		if ($opt2 == '' && $opt3 != '') {
			$opt2 = 100 - $opt3;
		} else if ( $opt3 == '' && $opt2 != '') {
			$opt3 = 100 - $opt2;
		} else if ($opt2 == '' && $opt3 == '') {
			$opt2 = $opt3 = 50;
		}

		$nrmales=(int)($opt1*$opt2/100);
		$nrfemales=($opt1-$nrmales);

		$etn['w']="0"; $etns[0]="10020";
		$etn['b']="1"; $etns[1]="10019";
		$etn['a']="2"; $etns[2]="10018";
		$etn['m']="3"; $etns[3]="10027";

		$nocount=0;
		$sum = 0;
		$etnpct = 0;
		if ($opt8 > 0) {
			$ethnicity[0]['number']=(int)($opt1*$opt8/100);
			$sum+=$ethnicity[0]['number'];
			$etnpct+=$opt8;
		} else {
			$nocount++;
			$ethnicity[0]['number']=0;
		}
		if ($opt9 > 0) {
			$ethnicity[1]['number']=(int)($opt1*$opt9/100);
			$sum+=$ethnicity[1]['number'];
			$etnpct+=$opt9;
		} else {
			$nocount++;
			$ethnicity[1]['number']=0;
		}
		if ($opt10 > 0) {
			$ethnicity[2]['number']=(int)($opt1*$opt10/100);
			$sum+=$ethnicity[2]['number'];
			$etnpct+=$opt10;
		} else {
			$nocount++;
			$ethnicity[2]['number']=0;
		}
		if ($opt11 > 0) {
			$ethnicity[3]['number']=(int)($opt1*$opt11/100);
			$sum+=$ethnicity[3]['number'];
			$etnpct+=$opt11;
		} else {
			$nocount++;
			$ethnicity[3]['number']=0;
		}
	/* Check if any percentage is left to be allocated for ethnicity */
		$etnpct_alloc=0;
		if ($etnpct < 100 && $nocount > 0) {
			$etnpct_alloc = (100 - $etnpct)/$nocount;
		}

		$ethnicity[0]['ethnicity']="10020";
		$ethnicity[1]['ethnicity']="10019";
		$ethnicity[2]['ethnicity']="10018";
		$ethnicity[3]['ethnicity']="10027";
	/* if there is balance percentage, allocate it to balance non allocated ethnicities */
		if ($etnpct_alloc > 0) {
			for($i=0;$i<4;$i++)
			{
				if ($ethnicity[$i]['number'] == 0 ) $ethnicity[$i]['number'] = (int)($opt1*$etnpct_alloc/100);
				$sum+=$ethnicity[$i]['number'];
			}
		}
		if($sum<$opt1) {
			$ethnicity[0]['number']=$ethnicity[0]['number']+($opt1-$sum);
		}

		for($i=0;$i<4;$i++)
		{
			if ($ethnicity[$i]['number'] == 0  ) unset($ethnicity[$i]);
		}
		$forms['ethnicity']=$ethnicity;

		if(file_exists($pathimages))
		{
   		$handle = opendir($pathimages);	$file = readdir($handle); $file = readdir($handle);
    	while (false !== ($file = readdir($handle)))
    	{
    		$itemx=explode(".",$file);
     		$item=explode("_",$itemx[0]);
			if (isset($item[1]) && $item[1] > 0) {
	    		$img['file']=$file;
	    		$img['age']=isset($item[1])?$item[1]:'';
		    	$img['ethnicity']=$item[2];
		    	$img['ext']=strtolower($itemx[1]);
				$images[strtoupper($item[0])][]=$img;
			}
    	}
        unset($images['THUMBS']);
		}

		/* Countries start */
		$sum=0;
		$nocount = 0;
		for($i=1;$i<=$opt4;$i++)
		{
			$field1="opt5_$i";
			$field2="opt5_{$i}c";
			if (!isset($_POST[$field2])) {
			/* If country is not selected, take random country */
				$_POST[$field2] =  mt_rand(0,count($countries)-1);
			}
			if (isset($_POST[$field1]) && $_POST[$field1] > 0 ) {
				$country[$i-1]['number']=(int)($opt1*$_POST[$field1]/100);
			} else {
				$country[$i-1]['number']=0;
				$nocount++;
			}
			$country[$i-1]['country']=$countries[$_POST[$field2]]['name'];
			$country[$i-1]['code']=$countries[$_POST[$field2]]['code'];
			$sum+=$country[$i-1]['number'];
		}
		if($sum<$opt1 && $nocount == 0) $country[0]['number']=$opt1-$sum;
		if ($nocount > 0) {
			/* There are countries records without any percentage allocated. Let us
			   allocate balance numbers equally to these countries. */
			$cnt = $opt1 - $sum;
			$cnt1 = 0;
			for ($i=0;$i<$opt4;$i++) {
				if ($country[$i]['number']==0) {
					$country[$i]['number'] = (int)($cnt / $nocount);
					$cnt1 += $country[$i]['number'];
				}
			}
			if ($cnt1 < $cnt) {
				$country[0]['number']+=$cnt-$cnt1;
			}
		}

		$forms['country']=$country;

/* Countries end */

		$sum=0;
		$nocount = 0;
		if ($opt6 == '') {
			$age[0]['min']=16;
			$age[0]['max']=90;
			$age[0]['number']=$opt1;
		} else {
			for($i=1;$i<=$opt6;$i++)
			{
				$field1="opt7_{$i}a";
				$field2="opt7_{$i}b";
				$field3="opt7_{$i}c";
				if (isset($_POST[$field1]) && $_POST[$field1] > 0) {
					$age[$i-1]['number']=(int)($opt1*$_POST[$field1]/100);
				} else {
					$age[$i-1]['number']=0;
					$nocount++;
				}
				if (!isset($_POST[$field2]) || $_POST[$field2] == '') {
					$_POST[$field2] = 16;
				}
				if (!isset($_POST[$field3]) || $_POST[$field3] == '') {
					$_POST[$field3] = 90;
				}
				$age[$i-1]['min']=$_POST[$field2];
				$age[$i-1]['max']=$_POST[$field3];
				$sum+=$age[$i-1]['number'];
			}
			if($opt1 > $sum && $nocount == 0 ) $age[0]['number']=$opt1 - $sum;

			if ($nocount > 0) {
				/* There are age records without any percentage allocated. Let us
				   allocate balance numbers equally to these. */

				$cnt = $opt1 - $sum;
				$cnt1 = 0;
				for ($i=0;$i<$opt6;$i++) {
					if ($age[$i]['number']==0) {
						$age[$i]['number'] = (int)($cnt / $nocount);
						$cnt1 += $age[$i]['number'];
					}
				}
				if ($cnt1 < $cnt) {
					$age[0]['number']+=$cnt-$cnt1;
				}
			}
		}
		$forms['age']=$age;

		$male = $female = array();

		//getting data from name files
		$males=file($path.$file_male);
		$females=file($path.$file_female);
		$firstnames=file($path.$file_firstname);
		/* Modified by Vijay Nair to keep only the required number of males and females
			names in the $male and $female array. Unnecessary to have all combinations
			to be built into array. System errors occur because of this. */

		$male_names_cnt = count($males);
		$female_names_cnt = count($females);
		$firstnames_cnt = count($firstnames);

		// firstnames array is infact last names array
		//getting all possible numbers

		for($i=0;$i<$nrmales;$i++) {
			$r1 = rand(0, ($male_names_cnt-1));
			$r2 = rand(0,($firstnames_cnt-1));
			$male[$i]['firstname'] = $firstnames[$r2];
			$male[$i]['lastname'] = $males[$r1];
		}

		for($i=0;$i<$nrfemales;$i++) {
			$r1 = rand(0,$female_names_cnt-1);
			$r2 = rand(0,$firstnames_cnt-1);
			$female[$i]['firstname'] = $firstnames[$r2];
			$female[$i]['lastname'] = $females[$r1];
		}

		$h=0;
		$j=0;
		while($h<$nrmales)
		{
			$result[$j]=$male[$h];
			$result[$j]['gender']="M";
			$h++;
			$j++;
		}
		$forms['gender']['male']=$j;
		$h=0;
		while($h<$nrfemales)
		{
			$result[$j]=$female[$h];
			$result[$j++]['gender']="F";
			$h++;
		}
		$forms['gender']['female']=$j-$forms['gender']['male'];

		if($forms['gender']['male']+$forms['gender']['female']==0) {$this->modSmartyAssign('error',1);$error=1;}
			else {$this->modSmartyAssign('error',2);$this->modSmartyAssign('nrerror',$j);}
		$forms=serialize($forms);
		$ts=time();
		$this->modAddRec($this->lang_autogenprofile_forms_table,array('ts'=>$ts,'form'=>$forms));
		$fid=$this->modGetOne($this->lang_autogenprofile_forms_table,array('ts'=>$ts),'id');
		$this->modSmartyAssign('fid',$fid);
		//select user data and add to database
		if(!isset($error) )
		{
		foreach ($result as $item => $key)
		{
			do {
				$username=$this->getUserName($key['firstname'],$key['lastname']);
				$ret = $this->modGetAllUsers(array('username'=>$username));
			} while($ret);
			$resultitem=$key;
			$resultitem['username']=$username;

			$sel=array_rand($country);
			$cntryprflcnt = $country[$sel]['number'];
			$country[$sel]['number']--;
			if(!isset($country[$sel]['country'])) {$sel2=array_rand($countries);$resultitem['country']=$countries[$sel2]['name'];$code=$countries[$sel2]['code'];}
			else {$resultitem['country']=$country[$sel]['country'];$code=$country[$sel]['code'];}
			$resultitem['countrycode']=$code;
			if(!$country[$sel]['number']) unset($country[$sel]);

	/* Take cities for the selected country  - Vijay Nair */

			if (!isset($city[$code])  || empty($city[$code]) ) {
				$city[$code] = array();
				$city[$code] = $this->modGetAllCities($code, $cntryprflcnt);
			}
			if(isset($city[$code]) && !empty($city[$code]) ) {
				$citycd = array_rand($city[$code]);
				$resultitem['city']=$city[$code][$citycd]['name'];
			}
			$ok=0;
			if($images[$key['gender']])
			foreach ($images[$key['gender']] as $item2 => $key2) {
				$selage=$key2['age'];
				$seletn=isset($etn[$key2['ethnicity']])?$etn[$key2['ethnicity']]:0;
				$selfile=$key2['file'];
				$selext=$key2['ext'];
				$selpath=$pathimages.$selfile;
				$ok=0;
				if(isset($ethnicity[$seletn]['number']) && $ethnicity[$seletn]['number']>0) $ok=1;
				else if(isset($ethnicity[0]['number']) && $ethnicity[0]['number']>0) $ok=1;
				if($ok)
					foreach ($age as $item3 => $key3)
					{
						$selmin=$key3['min'];
						$selmax=$key3['max'];
						if($selmin<=$selage && $selage<=$selmax) {$ok=2;break;}
					}
				if($ok==2) {$resultitem['age']=$selage;
							if(isset($ethnicity[$seletn]['ethnicity'])){
								$resultitem['ethnicity']=$ethnicity[$seletn]['ethnicity'];
								$ethnicity[$seletn]['number']--;
								if(!$ethnicity[$seletn]['number']) unset($ethnicity[$seletn]);
							} else {
								$resultitem['ethnicity']=$etns[$etn[$key2['ethnicity']]];
								$ethnicity[0]['number']--;
								if(!$ethnicity[0]['number']) unset($ethnicity[0]);
							}

							$dbimg = $this->modCreateDbImage($selpath,$selext);
							unlink($selpath);

							$resultitem['image']=$dbimg['pic'];
							$resultitem['image_ext']=$selext;

							$resultitem['imagetn']=$dbimg['tn'];
							$resultitem['imagetn_ext']="jpg";

							unset($images[$key['gender']][$item2]);
							$age[$item3]['number']--;
							if(!$age[$item3]['number']) unset($age[$item3]);

							break;}
			}
			if($ok!=2)
			{
				$sel=array_rand($age);
				$age[$sel]['number']--;
				$resultitem['age']=mt_rand($age[$sel]['min'],$age[$sel]['max']);
				if(!$age[$sel]['number']) unset($age[$sel]);

				$sel=array_rand($ethnicity);
				if($sel!=0)
				{
				$ethnicity[$sel]['number']--;
				$resultitem['ethnicity']=$ethnicity[$sel]['ethnicity'];
				}
				else $resultitem['ethnicity']=$etns[mt_rand(0,3)];
				if (isset($sel)) {
					if(!isset($ethnicity[$sel]['number']) || $ethnicity[$sel]['number'] == 0) unset($ethnicity[$sel]);
				}
			}
			$tsage = $resultitem['age']*365;
			$tsage = mt_rand($tsage+364, $tsage);
			$resultitem['birth_day'] = $this->osDB->getOne('select date_add(curdate(), interval -'.$tsage.' day)');

			$this->modAddUser($resultitem);
			$this->modAddRec($this->lang_autogenprofile_table,array('username'=>$resultitem['username'],'fid'=>$fid));

		}
		}

	}
	/* End of generation process */
	if(isset($_GET['showforms']) && $_GET['showforms']==0  )
	{
		if(isset($_POST['txtdelete']))
		{
			$fid=$_POST['txtdelete'];			$deldata =& $this->modGetAll($this->lang_autogenprofile_table,array('fid'=>$fid));
			foreach ($deldata as $item)
			{
				$user = $this->modGetAllUsers(array('username'=>$item['username']));
				$uid=$user[0]['id'];
				if($uid)$this->modDeleteUser($uid);
			}
			$this->modDeleteRows($this->lang_autogenprofile_forms_table,array('id'=>$fid));
			$this->modDeleteRows($this->lang_autogenprofile_table,array('fid'=>$fid));
			unset($deldata);
		}
		$data = $this->modGetAll($this->lang_autogenprofile_forms_table,array(),'ts',2);
		foreach($data as $item => $key)
		{
			$form=$key['form'];
			$form=unserialize($form);
			if (isset($form['ts']) ) {
				$date=date("Y-m-d H:i:s",$form['ts']);
			} else {
				$date=date("Y-m-d H:i:s");
			}
			$data[$item]['date']=$date;
			$data[$item]['male']=$form['gender']['male'];
			$data[$item]['female']=$form['gender']['female'];
		}
		$this->modSmartyAssign('data',$data);
		unset($data);
		$this->modSmartyAssign('dateformat',DATE_TIME_FORMAT);
		$text=$this->modSmartyFetch("admin/showforms.tpl");
	}

	if(isset($_GET['showforms']) && $_GET['showforms']>0)
	{
		$fid=$_GET['showforms'];
		$rpp=$this->config['Users shown per page'];
		$page=isset($_GET['page'])?$_GET['page']:'1';
		$begin=($page-1)*$rpp;
		$end=$rpp*$page-1;
		$start=($page-1)*$rpp;

		$data = $this->modGetAll($this->lang_autogenprofile_table,array('fid'=>$fid),"",1,$start,$rpp);
		$count=$this->modGetOne($this->lang_autogenprofile_table,array('fid'=>$fid),"count(*)");
		$countries = $this->modGetAllCountries();
		foreach ($countries as $item)
			$country[$item['code']]=$item['name'];
		$form =$this->modGetRow($this->lang_autogenprofile_forms_table,array('id'=>$fid));
		$date=date("Y-m-d H:i:s",$form['ts']);
		$form=unserialize($form['form']);
		foreach ($data as $item => $key)
		{
			$user=$this->modGetAllUsers(array('username'=>$key['username']));
			$user=$user[0];
			$data[$item]['gender']=$user['gender'];
			$data[$item]['country']=$country[$user['country']];
			$data[$item]['birth_date']=$user['birth_date'];
			$data[$item]['id']=$user['id'];
			$data[$item]['fullname']=$user['lastname']." ".$user['firstname'];
		}

		if($page!=1) $yprev=1; else $yprev=0;
		$lastpage=(int)($count/$rpp)+1;
		if($count%$rpp==0) $lastpage--;
		if($page!=$lastpage) $ynext=1; else $ynext=0;

		$this->modSmartyAssign('data',$data);
		$this->modSmartyAssign('total',count($data));
		unset($data);
		$this->modSmartyAssign('date',$date);
		$this->modSmartyAssign('start',$start);
		$this->modSmartyAssign('previous',"plugin.php?plugin={$this->plugin_class_name}&amp;showforms=$fid&amp;page=".($page-1));
		$this->modSmartyAssign('next',"plugin.php?plugin={$this->plugin_class_name}&amp;showforms=$fid&amp;page=".($page+1));
		$this->modSmartyAssign('form',$form);
		unset($form);
		$this->modSmartyAssign('ynext',$ynext);
		$this->modSmartyAssign('yprev',$yprev);
		$this->modSmartyAssign('dateformat',DATE_FORMAT);
		$text=$this->modSmartyFetch("admin/showusers.tpl");
	}

	if(!isset($text) ) {
   		$this->modSmartyAssign("country",$countries);
   		$text =$this->modSmartyFetch("admin/autogenprofile.tpl");
	}
   	return $text;
   }

}

?>